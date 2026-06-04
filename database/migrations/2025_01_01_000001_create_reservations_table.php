<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // ── Client ──────────────────────────────────────────
            $table->string('prenom', 60);
            $table->string('nom', 60);
            $table->string('email');
            $table->string('telephone', 25);

            // ── Séjour ──────────────────────────────────────────
            $table->string('chambre');           // nom exact de l'hébergement
            $table->date('date_arrivee');
            $table->date('date_depart');
            $table->tinyInteger('adultes')->default(1);
            $table->tinyInteger('enfants')->default(0);
            $table->boolean('petit_dej')->default(false);
            $table->text('message')->nullable();

            // ── Tarification ────────────────────────────────────
            $table->integer('nuits');
            $table->integer('prix_nuit_eur');    // €  par nuit
            $table->integer('prix_nuit_fcfa');   // FCFA par nuit
            $table->integer('total_eur');        // total en €
            $table->integer('total_fcfa');       // total en FCFA

            // ── Paiement FedaPay ─────────────────────────────────
            $table->string('fedapay_transaction_id')->nullable()->unique();
            $table->string('fedapay_token')->nullable();        // token de paiement
            $table->enum('statut_paiement', [
                'en_attente',   // formulaire soumis, pas encore payé
                'initie',       // transaction FedaPay créée, client redirigé
                'approuve',     // paiement validé par FedaPay
            ])->default('en_attente');
            $table->timestamp('paye_le')->nullable();

            // ── Statut réservation ────────────────────────────────
            $table->enum('statut', [
                'pending',      // en attente de paiement
                'confirmed',    // paiement reçu, réservation confirmée
                'cancelled',    // annulée
            ])->default('pending');

            $table->timestamps();

            // ── Index pour les requêtes de disponibilité ─────────
            $table->index(['chambre', 'date_arrivee', 'date_depart']);
            $table->index('statut_paiement');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
