<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Mail\ConfirmationClient;
use App\Mail\NotificationHotel;
use App\Services\FedaPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * WebhookController
 *
 * Reçoit les notifications POST de FedaPay après chaque événement de paiement.
 * Cette route est appelée par les serveurs FedaPay, pas par le navigateur.
 *
 * À configurer dans FedaPay dashboard → Paramètres → Webhooks :
 *   URL : https://votre-domaine.com/webhook/fedapay
 */
class WebhookController extends Controller
{
    public function fedapay(Request $request, FedaPayService $fedapay)
    {
        // ── 1. Récupérer le payload brut ────────────────────────
        $payload   = $request->getContent();
        $signature = $request->header('X-FEDAPAY-SIGNATURE', '');

        Log::info('FedaPay webhook reçu', [
            'signature' => $signature,
            'payload'   => $payload,
        ]);

        // ── 2. Vérifier la signature ────────────────────────────
        if (!$fedapay->verifierSignatureWebhook($payload, $signature)) {
            Log::warning('FedaPay webhook : signature invalide');
            return response()->json(['error' => 'Signature invalide'], 403);
        }

        // ── 3. Décoder l'événement ──────────────────────────────
        $event = json_decode($payload, true);

        if (!$event) {
            Log::warning('FedaPay webhook : payload JSON invalide');
            return response()->json(['error' => 'Payload invalide'], 400);
        }

        $eventName     = $event['name'] ?? null;
        $transactionId = $event['data']['object']['id']
                      ?? $event['transaction']['id']
                      ?? null;

        Log::info('FedaPay webhook event', [
            'event'          => $eventName,
            'transaction_id' => $transactionId,
        ]);

        // ── 4. Traiter uniquement les paiements approuvés ───────
        if ($eventName !== 'transaction.approved' || !$transactionId) {
            // Autres événements (declined, cancelled…) → on logge et on répond 200
            Log::info('FedaPay webhook : événement ignoré', ['event' => $eventName]);
            return response()->json(['status' => 'ignored'], 200);
        }

        // ── 5. Retrouver la réservation ─────────────────────────
        $reservation = Reservation::where('fedapay_transaction_id', (string) $transactionId)->first();

        if (!$reservation) {
            Log::error('FedaPay webhook : réservation introuvable', [
                'transaction_id' => $transactionId,
            ]);
            // On retourne 200 pour que FedaPay n'insiste pas
            return response()->json(['status' => 'not_found'], 200);
        }

        // Éviter le double traitement
        if ($reservation->statut === 'confirmed') {
            Log::info('FedaPay webhook : réservation déjà confirmée', [
                'reservation_id' => $reservation->id,
            ]);
            return response()->json(['status' => 'already_confirmed'], 200);
        }

        // ── 6. Confirmer la réservation ─────────────────────────
        $reservation->update([
            'statut_paiement' => 'approuve',
            'statut'          => 'confirmed',
            'paye_le'         => now(),
        ]);

        Log::info('FedaPay webhook : réservation confirmée', [
            'reservation_id' => $reservation->id,
            'chambre'        => $reservation->chambre,
            'client'         => $reservation->prenom . ' ' . $reservation->nom,
        ]);

        // ── 7. Envoyer les emails de confirmation ───────────────
        $data = [
            'prenom'       => $reservation->prenom,
            'nom'          => $reservation->nom,
            'email'        => $reservation->email,
            'telephone'    => $reservation->telephone,
            'chambre'      => $reservation->chambre,
            'date_arrivee' => $reservation->date_arrivee->format('Y-m-d'),
            'date_depart'  => $reservation->date_depart->format('Y-m-d'),
            'adultes'      => $reservation->adultes,
            'enfants'      => $reservation->enfants,
            'petit_dej'    => $reservation->petit_dej,
            'message'      => $reservation->message,
            'nuits'        => $reservation->nuits,
            'prix_eur'     => $reservation->prix_nuit_eur,
            'prix_fcfa'    => $reservation->prix_nuit_fcfa,
            'total_eur'    => $reservation->total_eur,
            'total_fcfa'   => $reservation->total_fcfa,
            'statut'       => 'confirmed',
        ];

        try {
            Mail::to($reservation->email)->send(new ConfirmationClient($data));
            Mail::to(env('HOTEL_EMAIL', 'auberge_theo@yahoo.fr'))->send(new NotificationHotel($data));
            Log::info('FedaPay webhook : emails envoyés pour réservation #' . $reservation->id);
        } catch (\Exception $e) {
            Log::error('FedaPay webhook : erreur envoi email : ' . $e->getMessage());
        }

        // ── 8. Répondre 200 à FedaPay ───────────────────────────
        return response()->json(['status' => 'ok'], 200);
    }
}
