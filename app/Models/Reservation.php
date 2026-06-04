<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Reservation extends Model
{
    protected $fillable = [
        'prenom', 'nom', 'email', 'telephone',
        'chambre', 'date_arrivee', 'date_depart',
        'adultes', 'enfants', 'petit_dej', 'message',
        'nuits', 'prix_nuit_eur', 'prix_nuit_fcfa', 'total_eur', 'total_fcfa',
        'fedapay_transaction_id', 'fedapay_token',
        'statut_paiement', 'statut', 'paye_le',
    ];

    protected $casts = [
        'date_arrivee' => 'date',
        'date_depart'  => 'date',
        'petit_dej'    => 'boolean',
        'paye_le'      => 'datetime',
    ];

    // ────────────────────────────────────────────────────────────
    // SCOPES
    // ────────────────────────────────────────────────────────────

    /**
     * Réservations actives (confirmed ou pending avec paiement initié).
     * On exclut les "en_attente" depuis plus de 30 min (abandon de paiement)
     * pour ne pas bloquer les chambres indéfiniment.
     */
    public function scopeActives(Builder $q): Builder
    {
        return $q->where(function ($q) {
            $q->where('statut', 'confirmed')
              ->orWhere(function ($q) {
                  $q->where('statut', 'pending')
                    ->where('statut_paiement', 'initie')
                    ->where('created_at', '>=', now()->subMinutes(30));
              });
        });
    }

    /**
     * Vérifie si une chambre est disponible pour des dates données.
     */
    public static function estDisponible(string $chambre, string $arrivee, string $depart): bool
    {
        $count = static::actives()
            ->where('chambre', $chambre)
            ->where('date_arrivee', '<', $depart)
            ->where('date_depart',  '>', $arrivee)
            ->count();

        return $count === 0;
    }

    /**
     * Retourne toutes les chambres indisponibles pour une période.
     */
    public static function chambresIndisponibles(string $arrivee, string $depart): array
    {
        return static::actives()
            ->where('date_arrivee', '<', $depart)
            ->where('date_depart',  '>', $arrivee)
            ->pluck('chambre')
            ->unique()
            ->values()
            ->toArray();
    }

    // ────────────────────────────────────────────────────────────
    // ACCESSORS
    // ────────────────────────────────────────────────────────────

    public function getNomCompletAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function estConfirmee(): bool
    {
        return $this->statut === 'confirmed' && $this->statut_paiement === 'approuve';
    }
}
