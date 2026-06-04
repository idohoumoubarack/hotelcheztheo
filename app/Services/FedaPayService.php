<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service FedaPay
 * Doc officielle : https://docs.fedapay.com
 * Dashboard      : https://live.fedapay.com / https://sandbox.fedapay.com
 */
class FedaPayService
{
    private string $apiKey;
    private string $baseUrl;
    private string $env;

    public function __construct()
    {
        $this->env     = config('fedapay.env', 'sandbox');
        $this->apiKey  = $this->env === 'live'
            ? config('fedapay.live_key')
            : config('fedapay.sandbox_key');
        $this->baseUrl = $this->env === 'live'
            ? 'https://api.fedapay.com/v1'
            : 'https://sandbox-api.fedapay.com/v1';
    }

    /**
     * Crée une transaction FedaPay et retourne le token + l'URL de paiement.
     *
     * @param  array  $reservation  Données de la réservation
     * @return array{transaction_id: string, token: string, payment_url: string}|null
     */
    public function creerTransaction(array $reservation): ?array
    {
        try {
            // 1. Créer la transaction
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->post($this->baseUrl . '/transactions', [
                'description' => 'Réservation ' . $reservation['chambre']
                               . ' — ' . $reservation['nuits'] . ' nuit(s)'
                               . ' — ' . $reservation['prenom'] . ' ' . $reservation['nom'],
                'amount'   => $reservation['total_fcfa'],   // FedaPay travaille en FCFA
                'currency' => ['iso' => 'XOF'],
                'callback_url' => route('reservation.callback'),
                'customer'  => [
                    'firstname' => $reservation['prenom'],
                    'lastname'  => $reservation['nom'],
                    'email'     => $reservation['email'],
                    'phone_number' => [
                        'number'   => preg_replace('/[^0-9]/', '', $reservation['telephone']),
                        'country'  => 'BJ',
                    ],
                ],
                'metadata' => [
                    'reservation_id' => $reservation['reservation_id'],
                    'chambre'        => $reservation['chambre'],
                    'date_arrivee'   => $reservation['date_arrivee'],
                    'date_depart'    => $reservation['date_depart'],
                ],
            ]);

            if (!$response->successful()) {
                Log::error('FedaPay creerTransaction erreur', [
                    'status' => $response->status(),
                    'body'   => $response->json(),
                ]);
                return null;
            }

            $transactionData = $response->json('v1/transaction');
            $transactionId   = $transactionData['id'];

            // 2. Générer le token de paiement
            $tokenResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->post($this->baseUrl . '/transactions/' . $transactionId . '/token');

            if (!$tokenResponse->successful()) {
                Log::error('FedaPay generateToken erreur', [
                    'status' => $tokenResponse->status(),
                    'body'   => $tokenResponse->json(),
                ]);
                return null;
            }

            $token      = $tokenResponse->json('token');
            $paymentUrl = $tokenResponse->json('url');

            return [
                'transaction_id' => (string) $transactionId,
                'token'          => $token,
                'payment_url'    => $paymentUrl,
            ];

        } catch (\Exception $e) {
            Log::error('FedaPay exception : ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Vérifie le statut d'une transaction.
     *
     * @return string|null  'approved' | 'declined' | 'pending' | null
     */
    public function verifierStatut(string $transactionId): ?string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->get($this->baseUrl . '/transactions/' . $transactionId);

            if (!$response->successful()) return null;

            return $response->json('v1/transaction.status') ?? null;

        } catch (\Exception $e) {
            Log::error('FedaPay verifierStatut exception : ' . $e->getMessage());
            return null;
        }
    }
}
