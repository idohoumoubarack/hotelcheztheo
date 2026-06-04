<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Mail\ConfirmationClient;
use App\Mail\NotificationHotel;
use App\Models\Reservation;
use App\Services\FedaPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    /** Catalogue des hébergements avec prix */
    private array $chambres = [
        'Suite Supérieure'   => ['eur' => 120, 'fcfa' => 78000, 'max' => 6, 'type' => 'Resort'],
        'Suite Standard'     => ['eur' => 96,  'fcfa' => 63000, 'max' => 4, 'type' => 'Resort'],
        'Bungalow Deluxe'    => ['eur' => 74,  'fcfa' => 48000, 'max' => 3, 'type' => 'Hôtel'],
        'Bungalow Supérieur' => ['eur' => 60,  'fcfa' => 39000, 'max' => 2, 'type' => 'Resort'],
        'Bungalow Standard'  => ['eur' => 38,  'fcfa' => 25000, 'max' => 2, 'type' => 'Hôtel'],
        'Chambres B&B'       => ['eur' => 28,  'fcfa' => 18000, 'max' => 2, 'type' => 'Hôtel'],
    ];

    // ────────────────────────────────────────────────────────────
    // GET /reservation
    // ────────────────────────────────────────────────────────────
    public function index(Request $request)
    {
        $arrivee = $request->query('arrivee', now()->addDay()->format('Y-m-d'));
        $depart  = $request->query('depart',  now()->addDays(3)->format('Y-m-d'));

        // Chambres indisponibles pour la période demandée
        $indisponibles = Reservation::chambresIndisponibles($arrivee, $depart);

        return view('pages.reservation', [
            'chambres'      => $this->chambres,
            'indisponibles' => $indisponibles,
            'arrivee'       => $arrivee,
            'depart'        => $depart,
        ]);
    }

    // ────────────────────────────────────────────────────────────
    // API GET /reservation/disponibilite
    // Retourne JSON des chambres indisponibles pour des dates données
    // ────────────────────────────────────────────────────────────
    public function disponibilite(Request $request)
    {
        $request->validate([
            'arrivee' => ['required', 'date', 'after_or_equal:today'],
            'depart'  => ['required', 'date', 'after:arrivee'],
        ]);

        $indisponibles = Reservation::chambresIndisponibles(
            $request->arrivee,
            $request->depart
        );

        return response()->json([
            'indisponibles' => $indisponibles,
            'disponibles'   => array_keys(
                array_diff_key($this->chambres, array_flip($indisponibles))
            ),
        ]);
    }

    // ────────────────────────────────────────────────────────────
    // POST /reservation
    // Étape 1 : valide, vérifie dispo, crée la réservation en DB,
    //           initialise la transaction FedaPay, redirige vers paiement
    // ────────────────────────────────────────────────────────────
    public function store(ReservationRequest $request, FedaPayService $fedapay)
    {
        $prix  = $request->prixChambre();
        $nuits = $request->nuits();

        // 1. Vérifier la disponibilité
        if (!Reservation::estDisponible($request->chambre, $request->date_arrivee, $request->date_depart)) {
            return back()
                ->withInput()
                ->withErrors(['chambre' => 'Désolé, cet hébergement n\'est plus disponible pour les dates sélectionnées. Veuillez choisir un autre hébergement ou d\'autres dates.']);
        }

        // 2. Créer la réservation en base avec statut pending
        $reservation = Reservation::create([
            'prenom'         => $request->prenom,
            'nom'            => $request->nom,
            'email'          => $request->email,
            'telephone'      => $request->telephone,
            'chambre'        => $request->chambre,
            'date_arrivee'   => $request->date_arrivee,
            'date_depart'    => $request->date_depart,
            'adultes'        => $request->adultes,
            'enfants'        => $request->input('enfants', 0),
            'petit_dej'      => $request->boolean('petit_dej'),
            'message'        => $request->input('message', ''),
            'nuits'          => $nuits,
            'prix_nuit_eur'  => $prix['eur'],
            'prix_nuit_fcfa' => $prix['fcfa'],
            'total_eur'      => $prix['eur'] * $nuits,
            'total_fcfa'     => $prix['fcfa'] * $nuits,
            'statut_paiement'=> 'en_attente',
            'statut'         => 'pending',
        ]);

        // 3. Créer la transaction FedaPay
        $fedaData = $fedapay->creerTransaction([
            'reservation_id' => $reservation->id,
            'prenom'         => $reservation->prenom,
            'nom'            => $reservation->nom,
            'email'          => $reservation->email,
            'telephone'      => $reservation->telephone,
            'chambre'        => $reservation->chambre,
            'date_arrivee'   => $reservation->date_arrivee->format('d/m/Y'),
            'date_depart'    => $reservation->date_depart->format('d/m/Y'),
            'nuits'          => $reservation->nuits,
            'total_fcfa'     => $reservation->total_fcfa,
        ]);

        if (!$fedaData) {
            // FedaPay indisponible — on garde la réservation et on envoie un email manuel
            Log::warning('FedaPay indisponible pour réservation #' . $reservation->id);
            $this->envoyerEmailsManuel($reservation);

            return redirect()
                ->route('reservation.confirmation', ['id' => $reservation->id])
                ->with('paiement_manuel', true);
        }

        // 4. Sauvegarder le token FedaPay et marquer comme initié
        $reservation->update([
            'fedapay_transaction_id' => $fedaData['transaction_id'],
            'fedapay_token'          => $fedaData['token'],
            'statut_paiement'        => 'initie',
        ]);

        // 5. Rediriger vers la page de paiement FedaPay
        return redirect($fedaData['payment_url']);
    }

    // ────────────────────────────────────────────────────────────
    // GET /reservation/callback  (FedaPay redirige ici après paiement)
    // ────────────────────────────────────────────────────────────
    public function callback(Request $request, FedaPayService $fedapay)
    {
        $transactionId = $request->query('id') ?? $request->query('transaction_id');

        if (!$transactionId) {
            return redirect()->route('reservation.index')
                ->with('error', 'Paiement annulé ou non abouti.');
        }

        // Retrouver la réservation
        $reservation = Reservation::where('fedapay_transaction_id', $transactionId)->first();

        if (!$reservation) {
            Log::warning('Callback FedaPay : réservation introuvable pour transaction ' . $transactionId);
            return redirect()->route('reservation.index')
                ->with('error', 'Réservation introuvable. Contactez-nous.');
        }

        // Vérifier le statut réel auprès de FedaPay
        $statut = $fedapay->verifierStatut($transactionId);

        if ($statut === 'approved') {
            $reservation->update([
                'statut_paiement' => 'approuve',
                'statut'          => 'confirmed',
                'paye_le'         => now(),
            ]);

            // Envoyer les emails de confirmation
            $this->envoyerEmailsManuel($reservation);

            return redirect()
                ->route('reservation.confirmation', ['id' => $reservation->id])
                ->with('paiement_ok', true);
        }

        // Paiement échoué ou annulé
        $reservation->update([
            'statut_paiement' => 'en_attente',
            'statut'          => 'pending',
        ]);

        return redirect()
            ->route('reservation.index')
            ->with('error', 'Le paiement n\'a pas abouti. Vous pouvez réessayer.')
            ->withInput();
    }

    // ────────────────────────────────────────────────────────────
    // GET /reservation/confirmation/{id}
    // ────────────────────────────────────────────────────────────
    public function confirmation(Request $request, int $id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('pages.reservation-confirmation', [
            'reservation'    => $reservation,
            'paiement_ok'    => $request->session()->get('paiement_ok', false),
            'paiement_manuel'=> $request->session()->get('paiement_manuel', false),
        ]);
    }

    // ────────────────────────────────────────────────────────────
    // Envoi des emails
    // ────────────────────────────────────────────────────────────
    private function envoyerEmailsManuel(Reservation $r): void
    {
        $data = [
            'prenom'       => $r->prenom,
            'nom'          => $r->nom,
            'email'        => $r->email,
            'telephone'    => $r->telephone,
            'chambre'      => $r->chambre,
            'date_arrivee' => $r->date_arrivee->format('Y-m-d'),
            'date_depart'  => $r->date_depart->format('Y-m-d'),
            'adultes'      => $r->adultes,
            'enfants'      => $r->enfants,
            'petit_dej'    => $r->petit_dej,
            'message'      => $r->message,
            'nuits'        => $r->nuits,
            'prix_eur'     => $r->prix_nuit_eur,
            'prix_fcfa'    => $r->prix_nuit_fcfa,
            'total_eur'    => $r->total_eur,
            'total_fcfa'   => $r->total_fcfa,
            'statut'       => $r->statut,
        ];

        try {
            Mail::to($r->email)->send(new ConfirmationClient($data));
            Mail::to(env('HOTEL_EMAIL', 'auberge_theo@yahoo.fr'))->send(new NotificationHotel($data));
        } catch (\Exception $e) {
            Log::error('Erreur envoi email : ' . $e->getMessage());
        }
    }
}
