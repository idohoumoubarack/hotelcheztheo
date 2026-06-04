@extends('layouts.app')
@section('title', 'Réservation confirmée | Chez Théo les Bains')

@push('styles')
<style>
.wrap{max-width:780px;margin:0 auto;padding:0 2rem}
.confirm-section{min-height:85vh;display:flex;align-items:center;background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 60%);padding:5rem 0}
.confirm-card{background:#fff;border-radius:28px;box-shadow:0 12px 60px rgba(13,27,42,.12);overflow:hidden;width:100%}
.confirm-header{padding:3rem;text-align:center}
.confirm-header.ok{background:linear-gradient(135deg,#08131e,#0d3a27)}
.confirm-header.manuel{background:linear-gradient(135deg,#08131e,#1a3a50)}
.confirm-anim{width:72px;height:72px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;animation:popIn .5s cubic-bezier(.175,.885,.32,1.275) both}
@keyframes popIn{from{transform:scale(0);opacity:0}to{transform:scale(1);opacity:1}}
.confirm-anim.ok{background:linear-gradient(135deg,#25D366,#1a7a4a)}
.confirm-anim.pending{background:linear-gradient(135deg,var(--teal),var(--teal-dark))}
.confirm-anim [data-lucide]{width:34px;height:34px;stroke:#fff;stroke-width:2.5}
.confirm-header h1{font-family:var(--f1);font-size:2rem;font-weight:800;color:#fff;letter-spacing:-.03em;margin-bottom:.5rem}
.confirm-header p{font-size:.9rem;color:rgba(255,255,255,.5);line-height:1.7}
.confirm-body{padding:2.5rem 3rem}
.cb-title{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.28em;color:var(--teal-dark);border-bottom:1px solid #e0eef7;padding-bottom:.7rem;margin:0 0 1.4rem}
.cb-grid{display:grid;grid-template-columns:1fr 1fr;gap:.8rem;margin-bottom:1.5rem}
.cb-item{background:#f8fbfd;border:1px solid #d4e8f5;border-radius:10px;padding:.9rem 1.1rem}
.cb-key{font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;color:#4a7a9b;display:block;margin-bottom:.3rem}
.cb-val{font-size:.92rem;font-weight:700;color:#08131e}
.price-box{background:linear-gradient(135deg,#08131e,#1a3a50);border-radius:14px;padding:1.4rem 1.6rem;display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem}
.pb-lbl{font-size:.6rem;text-transform:uppercase;letter-spacing:.2em;color:rgba(255,255,255,.35);display:block}
.pb-eur{font-family:var(--f1);font-size:2rem;font-weight:800;color:#fff;letter-spacing:-.04em}
.pb-fcfa{font-size:.75rem;color:rgba(255,255,255,.3);display:block;margin-top:.25rem}
.pb-note{font-size:.72rem;color:rgba(255,255,255,.3);text-align:right;line-height:1.6}
.status-badge{display:inline-flex;align-items:center;gap:.5rem;padding:.4rem 1rem;border-radius:999px;font-family:var(--f3);font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;margin-bottom:1.5rem}
.status-confirmed{background:#e8fdf0;color:#1a7a4a}
.status-pending{background:#e8f4fb;color:#1a5a8a}
.steps{display:flex;flex-direction:column;gap:.8rem;margin-bottom:2rem}
.step-item{display:flex;align-items:flex-start;gap:1rem;padding:1rem 1.2rem;background:#f8fbfd;border:1px solid #e0eef7;border-radius:12px}
.step-num{width:28px;height:28px;min-width:28px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:800;color:#fff;flex-shrink:0}
.step-content strong{display:block;font-size:.88rem;font-weight:700;color:#08131e;margin-bottom:.2rem}
.step-content span{font-size:.78rem;color:#4a7a9b;line-height:1.5}
.confirm-actions{display:flex;gap:1rem;flex-wrap:wrap}
.confirm-actions .btn{flex:1;justify-content:center;border-radius:12px;min-width:150px}
.btn{display:inline-flex;align-items:center;gap:.5rem;font-family:var(--f3);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.9rem 2rem;border-radius:999px;transition:all .3s ease;cursor:pointer;border:none;text-decoration:none}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 6px 26px var(--teal-glow)}
</style>
@endpush

@section('content')
<section class="confirm-section">
  <div class="wrap">
    <div class="confirm-card">

      @if($paiement_ok)
        {{-- Paiement réussi --}}
        <div class="confirm-header ok">
          <div class="confirm-anim ok"><i data-lucide="check"></i></div>
          <h1>Réservation confirmée !</h1>
          <p>Votre paiement a été accepté. Un email de confirmation a été envoyé à <strong>{{ $reservation->email }}</strong>.</p>
        </div>
      @else
        {{-- Paiement manuel / FedaPay indisponible --}}
        <div class="confirm-header manuel">
          <div class="confirm-anim pending"><i data-lucide="clock"></i></div>
          <h1>Demande reçue !</h1>
          <p>Notre équipe va vous contacter sous 24h pour finaliser votre réservation et les modalités de paiement.</p>
        </div>
      @endif

      <div class="confirm-body">

        @if($paiement_ok)
          <span class="status-badge status-confirmed"><i data-lucide="check-circle" style="width:14px;height:14px;stroke:currentColor"></i> Réservation & Paiement confirmés</span>
        @else
          <span class="status-badge status-pending"><i data-lucide="clock" style="width:14px;height:14px;stroke:currentColor"></i> En attente de paiement</span>
        @endif

        <div class="cb-title">Récapitulatif</div>
        <div class="cb-grid">
          <div class="cb-item"><span class="cb-key">Hébergement</span><span class="cb-val">{{ $reservation->chambre }}</span></div>
          <div class="cb-item"><span class="cb-key">Voyageurs</span><span class="cb-val">{{ $reservation->adultes }} adulte(s){{ $reservation->enfants ? ', '.$reservation->enfants.' enfant(s)' : '' }}</span></div>
          <div class="cb-item"><span class="cb-key">Arrivée</span><span class="cb-val">{{ $reservation->date_arrivee->locale('fr')->isoFormat('ddd D MMM YYYY') }}</span></div>
          <div class="cb-item"><span class="cb-key">Départ</span><span class="cb-val">{{ $reservation->date_depart->locale('fr')->isoFormat('ddd D MMM YYYY') }}</span></div>
        </div>

        <div class="price-box">
          <div>
            <span class="pb-lbl">{{ $paiement_ok ? 'Montant payé' : 'Total estimatif' }} · {{ $reservation->nuits }} nuit(s)</span>
            <div class="pb-eur">{{ number_format($reservation->total_eur, 0) }} €</div>
            <span class="pb-fcfa">{{ number_format($reservation->total_fcfa, 0, ',', ' ') }} FCFA</span>
          </div>
          <div class="pb-note">{{ $reservation->prix_nuit_eur }}€ / nuit<br>Petit-déj {{ $reservation->petit_dej ? 'inclus' : 'non inclus' }}</div>
        </div>

        <div class="cb-title">Prochaines étapes</div>
        <div class="steps">
          @if($paiement_ok)
            <div class="step-item"><div class="step-num">✓</div><div class="step-content"><strong>Paiement confirmé</strong><span>Votre chambre est bloquée pour vos dates. Un email de confirmation vous a été envoyé.</span></div></div>
            <div class="step-item"><div class="step-num">2</div><div class="step-content"><strong>Check-in le {{ $reservation->date_arrivee->locale('fr')->isoFormat('D MMM') }} à partir de 14h</strong><span>Présentez-vous à la réception avec votre email de confirmation.</span></div></div>
            <div class="step-item"><div class="step-num">3</div><div class="step-content"><strong>Bienvenue à Possotomé !</strong><span>Notre équipe vous accueille et vous guide vers votre hébergement.</span></div></div>
          @else
            <div class="step-item"><div class="step-num">1</div><div class="step-content"><strong>Confirmation sous 24h</strong><span>Notre équipe vous contacte par email et WhatsApp pour finaliser.</span></div></div>
            <div class="step-item"><div class="step-num">2</div><div class="step-content"><strong>Paiement sécurisé</strong><span>Vous recevrez un lien de paiement FedaPay pour MTN MoMo, Moov ou carte.</span></div></div>
            <div class="step-item"><div class="step-num">3</div><div class="step-content"><strong>Bienvenue à Possotomé !</strong><span>Check-in le {{ $reservation->date_arrivee->locale('fr')->isoFormat('D MMM YYYY') }} à partir de 14h.</span></div></div>
          @endif
        </div>

        <div class="confirm-actions">
          <a href="https://wa.me/22901971831188" target="_blank" class="btn btn-p">
            <i data-lucide="message-circle"></i> WhatsApp
          </a>
          <a href="{{ route('home') }}" class="btn" style="background:#f0f8fc;color:var(--teal-dark)">
            <i data-lucide="home"></i> Accueil
          </a>
        </div>

      </div>
    </div>
  </div>
</section>
@endsection
@push('scripts')<script>lucide.createIcons();</script>@endpush
