<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nouvelle réservation</title>
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body { font-family: 'Segoe UI', Arial, sans-serif; background:#f0f4f8; color:#1a3a50; }
  .wrapper { max-width:600px; margin:0 auto; padding:2rem 1rem; }
  .card { background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,.08); }
  .header { background:#08131e; padding:1.8rem 2rem; }
  .header-tag { font-size:.65rem; font-weight:700; text-transform:uppercase; letter-spacing:.25em; color:#6ec1e4; margin-bottom:.6rem; }
  .header h1 { font-size:1.3rem; font-weight:800; color:#fff; letter-spacing:-.02em; }
  .header p { font-size:.82rem; color:rgba(255,255,255,.45); margin-top:.3rem; }
  .section { padding:1.6rem 2rem; border-bottom:1px solid #e0eef7; }
  .section:last-child { border-bottom:none; }
  .section-title { font-size:.6rem; font-weight:700; text-transform:uppercase; letter-spacing:.28em; color:#6ec1e4; margin-bottom:1.2rem; }
  .row { display:flex; align-items:flex-start; justify-content:space-between; padding:.55rem 0; border-bottom:1px solid #f0f4f8; }
  .row:last-child { border-bottom:none; }
  .row-key { font-size:.78rem; font-weight:600; color:#4a7a9b; }
  .row-val { font-size:.85rem; font-weight:700; color:#08131e; text-align:right; }
  .highlight { background:linear-gradient(135deg,#08131e,#1a3a50); border-radius:12px; padding:1.3rem 1.6rem; margin:1rem 0; display:flex; align-items:center; justify-content:space-between; }
  .hl-label { font-size:.6rem; text-transform:uppercase; letter-spacing:.2em; color:rgba(255,255,255,.4); }
  .hl-val { font-size:1.8rem; font-weight:800; color:#fff; letter-spacing:-.03em; }
  .hl-alt { font-size:.75rem; color:rgba(255,255,255,.4); margin-top:.2rem; }
  .msg-box { background:#f8fbfd; border:1px solid #e0eef7; border-radius:10px; padding:1rem 1.2rem; font-size:.85rem; color:#1a3a50; line-height:1.7; font-style:italic; }
  .actions { display:flex; gap:.8rem; padding:1.5rem 2rem; }
  .action-btn { display:inline-block; flex:1; text-align:center; padding:.8rem 1rem; border-radius:10px; font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.15em; text-decoration:none; }
  .btn-email { background:#e8f4fb; color:#1a7aa8; }
  .btn-wa { background:#e8fdf0; color:#128C7E; }
  .btn-tel { background:#f0f4f8; color:#1a3a50; }
  .footer { text-align:center; padding:1.2rem 2rem; background:#f8fbfd; }
  .footer p { font-size:.72rem; color:#4a7a9b; line-height:1.7; }
</style>
</head>
<body>
<div class="wrapper">
<div class="card">

  <div class="header">
    <div class="header-tag">🏨 Nouvelle demande de réservation</div>
    <h1>{{ $data['prenom'] }} {{ $data['nom'] }}</h1>
    <p>Reçue le {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY [à] HH[h]mm') }}</p>
  </div>

  {{-- CLIENT --}}
  <div class="section">
    <div class="section-title">Informations client</div>
    <div class="row"><span class="row-key">Nom complet</span><span class="row-val">{{ $data['prenom'] }} {{ $data['nom'] }}</span></div>
    <div class="row"><span class="row-key">Email</span><span class="row-val">{{ $data['email'] }}</span></div>
    <div class="row"><span class="row-key">Téléphone</span><span class="row-val">{{ $data['telephone'] }}</span></div>
  </div>

  {{-- SÉJOUR --}}
  <div class="section">
    <div class="section-title">Détails du séjour</div>
    <div class="row"><span class="row-key">Hébergement</span><span class="row-val">{{ $data['chambre'] }}</span></div>
    <div class="row"><span class="row-key">Arrivée</span><span class="row-val">{{ \Carbon\Carbon::parse($data['date_arrivee'])->locale('fr')->isoFormat('ddd D MMM YYYY') }}</span></div>
    <div class="row"><span class="row-key">Départ</span><span class="row-val">{{ \Carbon\Carbon::parse($data['date_depart'])->locale('fr')->isoFormat('ddd D MMM YYYY') }}</span></div>
    <div class="row"><span class="row-key">Durée</span><span class="row-val">{{ $data['nuits'] }} nuit(s)</span></div>
    <div class="row"><span class="row-key">Adultes</span><span class="row-val">{{ $data['adultes'] }}</span></div>
    @if($data['enfants'])
    <div class="row"><span class="row-key">Enfants</span><span class="row-val">{{ $data['enfants'] }}</span></div>
    @endif
    <div class="row"><span class="row-key">Petit-déjeuner</span><span class="row-val">{{ $data['petit_dej'] ? '✅ Oui' : '❌ Non' }}</span></div>
    <div class="highlight">
      <div><div class="hl-label">Total estimatif</div><div class="hl-val">{{ number_format($data['prix_eur'] * $data['nuits'], 0) }} €</div><div class="hl-alt">≈ {{ number_format($data['prix_fcfa'] * $data['nuits'], 0, ',', ' ') }} FCFA</div></div>
      <div style="text-align:right;color:rgba(255,255,255,.35);font-size:.75rem">{{ $data['prix_eur'] }}€ / nuit<br>× {{ $data['nuits'] }} nuit(s)</div>
    </div>
  </div>

  {{-- MESSAGE --}}
  @if($data['message'])
  <div class="section">
    <div class="section-title">Message du client</div>
    <div class="msg-box">« {{ $data['message'] }} »</div>
  </div>
  @endif

  {{-- ACTIONS RAPIDES --}}
  <div class="section">
    <div class="section-title">Répondre rapidement</div>
    <div class="actions">
      <a href="mailto:{{ $data['email'] }}?subject=Confirmation de votre réservation — Chez Théo les Bains&body=Bonjour {{ $data['prenom'] }}, ..." class="action-btn btn-email">✉ Répondre par email</a>
      <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $data['telephone']) }}?text=Bonjour {{ $data['prenom'] }}, nous avons bien reçu votre demande de réservation pour le {{ \Carbon\Carbon::parse($data['date_arrivee'])->format('d/m/Y') }}..." class="action-btn btn-wa">💬 WhatsApp</a>
      <a href="tel:{{ $data['telephone'] }}" class="action-btn btn-tel">📞 Appeler</a>
    </div>
  </div>

</div>
<div class="footer">
  <p>Email automatique — Système de réservation Chez Théo les Bains<br>Ne pas répondre directement à cet email</p>
</div>
</div>
</body>
</html>
