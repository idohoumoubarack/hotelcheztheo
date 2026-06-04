<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirmation de réservation — Chez Théo les Bains</title>
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body { font-family: 'Segoe UI', Arial, sans-serif; background:#f0f4f8; color:#1a3a50; }
  .wrapper { max-width:620px; margin:0 auto; padding:2rem 1rem; }
  .card { background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,.08); }

  /* Header */
  .header { background:linear-gradient(135deg,#08131e 0%,#1a3a50 100%); padding:2.5rem 2rem; text-align:center; }
  .header-logo { font-size:1.5rem; font-weight:800; color:#fff; letter-spacing:-.02em; }
  .header-logo span { color:#6ec1e4; }
  .header-sub { font-size:.72rem; text-transform:uppercase; letter-spacing:.3em; color:rgba(255,255,255,.5); margin-top:.3rem; }
  .header-badge { display:inline-block; margin-top:1.5rem; background:rgba(110,193,228,.15); border:1px solid rgba(110,193,228,.3); color:#6ec1e4; font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.2em; padding:.45rem 1.2rem; border-radius:999px; }

  /* Hero message */
  .hero { background:linear-gradient(160deg,#e8f4fb 0%,#fff 100%); padding:2rem 2rem 1.5rem; text-align:center; border-bottom:1px solid #e0eef7; }
  .hero h1 { font-size:1.5rem; font-weight:800; color:#08131e; letter-spacing:-.02em; margin-bottom:.5rem; }
  .hero p { font-size:.9rem; color:#4a7a9b; line-height:1.7; }

  /* Récapitulatif */
  .section { padding:1.8rem 2rem; }
  .section-title { font-size:.62rem; font-weight:700; text-transform:uppercase; letter-spacing:.28em; color:#6ec1e4; border-bottom:1px solid #e0eef7; padding-bottom:.8rem; margin-bottom:1.4rem; }

  .recap-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem; }
  .recap-item { background:#f8fbfd; border:1px solid #e0eef7; border-radius:10px; padding:.9rem 1rem; }
  .recap-label { font-size:.6rem; font-weight:700; text-transform:uppercase; letter-spacing:.18em; color:#4a7a9b; display:block; margin-bottom:.3rem; }
  .recap-value { font-size:.95rem; font-weight:700; color:#08131e; }
  .recap-full { grid-column:1 / 3; }

  /* Prix */
  .price-box { background:linear-gradient(135deg,#08131e,#1a3a50); border-radius:12px; padding:1.4rem 1.6rem; display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem; }
  .price-label { font-size:.65rem; font-weight:700; text-transform:uppercase; letter-spacing:.2em; color:rgba(255,255,255,.5); display:block; margin-bottom:.3rem; }
  .price-big { font-size:2rem; font-weight:800; color:#fff; letter-spacing:-.03em; line-height:1; }
  .price-alt { font-size:.8rem; color:rgba(255,255,255,.45); margin-top:.25rem; display:block; }
  .price-note { font-size:.72rem; color:rgba(255,255,255,.4); text-align:right; max-width:160px; line-height:1.5; }

  /* Inclus */
  .inclus-list { display:flex; flex-direction:column; gap:.55rem; }
  .inclus-item { display:flex; align-items:center; gap:.7rem; font-size:.85rem; color:#1a3a50; }
  .inclus-dot { width:18px; height:18px; min-width:18px; border-radius:50%; background:linear-gradient(135deg,#4ab8e0,#1a7aa8); display:flex; align-items:center; justify-content:center; }
  .inclus-dot::after { content:'✓'; font-size:.55rem; color:#fff; font-weight:700; }

  /* Étapes suivantes */
  .steps { background:#f8fbfd; border:1px solid #e0eef7; border-radius:12px; padding:1.4rem 1.6rem; }
  .step { display:flex; align-items:flex-start; gap:1rem; margin-bottom:1rem; }
  .step:last-child { margin-bottom:0; }
  .step-num { width:26px; height:26px; min-width:26px; border-radius:50%; background:linear-gradient(135deg,#6ec1e4,#2d8ab8); display:flex; align-items:center; justify-content:center; font-size:.68rem; font-weight:800; color:#fff; flex-shrink:0; }
  .step-text strong { display:block; font-size:.85rem; font-weight:700; color:#08131e; margin-bottom:.15rem; }
  .step-text span { font-size:.8rem; color:#4a7a9b; line-height:1.5; }

  /* CTA */
  .cta-section { text-align:center; padding:1.5rem 2rem 2rem; }
  .cta-btn { display:inline-block; background:linear-gradient(135deg,#4ab8e0,#1a7aa8); color:#fff; font-size:.78rem; font-weight:700; text-transform:uppercase; letter-spacing:.18em; padding:.9rem 2.2rem; border-radius:999px; text-decoration:none; margin:0 .4rem .8rem; }
  .cta-btn-wa { background:linear-gradient(135deg,#25D366,#128C7E); }
  .cta-note { font-size:.75rem; color:#4a7a9b; line-height:1.6; }

  /* Footer email */
  .email-footer { text-align:center; padding:1.5rem 2rem; border-top:1px solid #e0eef7; }
  .email-footer p { font-size:.73rem; color:#4a7a9b; line-height:1.8; }
  .email-footer a { color:#1a7aa8; text-decoration:none; }
</style>
</head>
<body>
<div class="wrapper">
<div class="card">

  {{-- HEADER --}}
  <div class="header">
    <div class="header-logo">Chez Théo <span>les Bains</span></div>
    <div class="header-sub">Possotomé · Bénin · Lac Ahémé</div>
    <div class="header-badge">✅ Demande reçue</div>
  </div>

  {{-- HERO --}}
  <div class="hero">
    <h1>Bonjour {{ $data['prenom'] }}, merci pour votre demande !</h1>
    <p>Nous avons bien reçu votre demande de réservation. Notre équipe va l'examiner et vous contactera dans les <strong>24 heures</strong> pour confirmer votre séjour et vous donner les modalités de paiement.</p>
  </div>

  {{-- RÉCAPITULATIF --}}
  <div class="section">
    <div class="section-title">Récapitulatif de votre demande</div>
    <div class="recap-grid">
      <div class="recap-item">
        <span class="recap-label">Hébergement</span>
        <span class="recap-value">{{ $data['chambre'] }}</span>
      </div>
      <div class="recap-item">
        <span class="recap-label">Voyageurs</span>
        <span class="recap-value">{{ $data['adultes'] }} adulte(s){{ $data['enfants'] ? ', '.$data['enfants'].' enfant(s)' : '' }}</span>
      </div>
      <div class="recap-item">
        <span class="recap-label">Arrivée</span>
        <span class="recap-value">{{ \Carbon\Carbon::parse($data['date_arrivee'])->locale('fr')->isoFormat('ddd D MMM YYYY') }}</span>
      </div>
      <div class="recap-item">
        <span class="recap-label">Départ</span>
        <span class="recap-value">{{ \Carbon\Carbon::parse($data['date_depart'])->locale('fr')->isoFormat('ddd D MMM YYYY') }}</span>
      </div>
      <div class="recap-item recap-full">
        <span class="recap-label">Durée du séjour</span>
        <span class="recap-value">{{ $data['nuits'] }} nuit(s)</span>
      </div>
    </div>

    {{-- PRIX ESTIMATIF --}}
    <div class="price-box">
      <div>
        <span class="price-label">Total estimatif</span>
        <div class="price-big">{{ number_format($data['prix_eur'] * $data['nuits'], 0) }} €</div>
        <span class="price-alt">≈ {{ number_format($data['prix_fcfa'] * $data['nuits'], 0, ',', ' ') }} FCFA</span>
      </div>
      <div class="price-note">{{ $data['prix_eur'] }}€ × {{ $data['nuits'] }} nuit(s)<br>Petit-déjeuner {{ $data['petit_dej'] ? 'inclus' : 'non inclus' }}</div>
    </div>
  </div>

  {{-- CE QUI EST INCLUS --}}
  <div class="section" style="padding-top:0">
    <div class="section-title">Ce qui est inclus dans votre séjour</div>
    <div class="inclus-list">
      <div class="inclus-item"><div class="inclus-dot"></div> Accès à la piscine thermale</div>
      <div class="inclus-item"><div class="inclus-dot"></div> Salle de bain privée</div>
      <div class="inclus-item"><div class="inclus-dot"></div> Accès canoë sur le lac Ahémé</div>
      <div class="inclus-item"><div class="inclus-dot"></div> Accès salle de sport</div>
      <div class="inclus-item"><div class="inclus-dot"></div> Taxes de nuitée</div>
      @if($data['petit_dej'])
      <div class="inclus-item"><div class="inclus-dot"></div> Petit-déjeuner chaque matin</div>
      @endif
    </div>
  </div>

  {{-- ÉTAPES SUIVANTES --}}
  <div class="section">
    <div class="section-title">Prochaines étapes</div>
    <div class="steps">
      <div class="step">
        <div class="step-num">1</div>
        <div class="step-text">
          <strong>Confirmation sous 24h</strong>
          <span>Notre équipe vous contacte par email ou WhatsApp pour confirmer la disponibilité de votre hébergement.</span>
        </div>
      </div>
      <div class="step">
        <div class="step-num">2</div>
        <div class="step-text">
          <strong>Paiement des arrhes</strong>
          <span>Un acompte de 30% est demandé pour sécuriser votre réservation. Paiement par virement, Mobile Money ou espèces à l'arrivée.</span>
        </div>
      </div>
      <div class="step">
        <div class="step-num">3</div>
        <div class="step-text">
          <strong>Bienvenue à Possotomé !</strong>
          <span>Le solde est réglé à votre arrivée. Check-in à partir de 14h, check-out avant 11h.</span>
        </div>
      </div>
    </div>
  </div>

  {{-- CTA --}}
  <div class="cta-section">
    <a href="https://wa.me/22901971831188?text=Bonjour, je viens d'envoyer une demande de réservation pour {{ urlencode($data['chambre']) }}" class="cta-btn cta-btn-wa">Nous contacter sur WhatsApp</a>
    <a href="mailto:auberge_theo@yahoo.fr" class="cta-btn">Envoyer un email</a>
    <p class="cta-note">Une question ? Notre équipe est disponible tous les jours de 8h à 20h.<br>Nous faisons tout pour rendre votre séjour inoubliable.</p>
  </div>

</div>

{{-- FOOTER EMAIL --}}
<div class="email-footer">
  <p>
    <strong>Chez Théo les Bains</strong> — GXMC+38H, Possotomé, Bénin<br>
    <a href="tel:+22901950553155">+229 01 95 05 53 15</a> · <a href="mailto:auberge_theo@yahoo.fr">auberge_theo@yahoo.fr</a><br>
    <a href="http://chez-theo-les-bains.com">chez-theo-les-bains.com</a>
  </p>
</div>
</div>
</body>
</html>
