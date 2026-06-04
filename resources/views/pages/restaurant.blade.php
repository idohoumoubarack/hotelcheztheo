@extends('layouts.app')

@section('title', 'Restaurant Possotomé | Chez Théo les Bains — Sur le Lac Ahémé')
@section('description', 'Restaurant sur pilotis au-dessus du lac Ahémé. Cuisine locale, crevettes et mulets frais du matin. Buffet dominical 15€. Réceptions et événements.')

@push('styles')
<style>
/* ── UTILITAIRES ───────────────────────────────────────────── */
.wrap{max-width:1300px;margin:0 auto;padding:0 2rem}
.wrap-xl{max-width:1620px;margin:0 auto;padding:0 2rem}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;font-family:var(--f3);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.9rem 2.2rem;border-radius:999px;transition:all .4s var(--spring);cursor:pointer;border:none;white-space:nowrap}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 6px 26px var(--teal-glow)}
.btn-p:hover{transform:translateY(-3px) scale(1.03);box-shadow:0 12px 42px var(--teal-glow);color:#fff}
.btn-dk{background:var(--dark);color:#fff}
.btn-dk:hover{background:var(--dark3);transform:translateY(-3px);color:#fff}
.btn-gl{background:rgba(255,255,255,.14);backdrop-filter:blur(22px);border:1px solid rgba(255,255,255,.22);color:#fff}
.btn-gl:hover{background:rgba(255,255,255,.22);transform:translateY(-2px);color:#fff}
.btn-w{background:#fff;color:var(--teal-dark)}
.btn-w:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(0,0,0,.15);color:var(--teal-dark)}
.btn-lg{padding:1.1rem 2.8rem;font-size:.82rem}
.btn-sm{padding:.55rem 1.3rem;font-size:.67rem}
.sec-lbl{display:inline-flex;align-items:center;gap:.8rem;font-family:var(--f3);font-size:.66rem;font-weight:700;text-transform:uppercase;letter-spacing:.32em;color:var(--teal);margin-bottom:1rem}
.sec-lbl::before{content:'';width:28px;height:1.5px;background:linear-gradient(90deg,var(--teal),var(--teal-light));flex-shrink:0}
.tc{text-align:center}
.mb4{margin-bottom:2rem}.mb6{margin-bottom:3rem}.mb8{margin-bottom:4rem}.mt4{margin-top:2rem}
[data-r]{opacity:0;transition:opacity .8s var(--ease),transform .8s var(--ease)}
[data-r="up"]{transform:translateY(50px)}
[data-r="left"]{transform:translateX(-50px)}
[data-r="right"]{transform:translateX(50px)}
[data-r="scale"]{transform:scale(.88)}
[data-r].in{opacity:1;transform:none}
[data-d="1"]{transition-delay:.1s}[data-d="2"]{transition-delay:.2s}[data-d="3"]{transition-delay:.3s}[data-d="4"]{transition-delay:.4s}

/* ── PAGE HERO ─────────────────────────────────────────────── */
.page-hero{position:relative;height:65vh;min-height:480px;display:flex;align-items:flex-end;overflow:hidden;background:var(--dark)}
.ph-bg{position:absolute;inset:0}
.ph-bg img{width:100%;height:100%;object-fit:cover}
.ph-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.92) 0%,rgba(8,19,30,.35) 60%,transparent 100%)}
.ph-body{position:relative;z-index:2;max-width:1300px;margin:0 auto;padding:0 2rem 4rem;width:100%}
.ph-title{font-family:var(--f1);font-size:clamp(2.5rem,6vw,5.5rem);font-weight:600;color:#fff;line-height:1.05;letter-spacing:-.03em;margin-bottom:.8rem}
.ph-sub{font-size:1.05rem;color:#fff;max-width:560px;line-height:1.7}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-family:var(--f3);font-size:.68rem;text-transform:uppercase;letter-spacing:.15em;color:#fff;margin-bottom:1rem}
.breadcrumb a{color:#fff;transition:.2s}
.breadcrumb a:hover{color:var(--teal)}
.breadcrumb span{color:var(--teal)}
.breadcrumb i{font-size:.5rem;opacity:.5}

/* ── ESPACES BAND ──────────────────────────────────────────── */
.espaces-band{background:var(--dark);border-bottom:1px solid rgba(110,193,228,.1);padding:0}
.espaces-inner{display:grid;grid-template-columns:repeat(3,1fr)}
.espace-item{padding:2.8rem 2.5rem;border-right:1px solid rgba(110,193,228,.1);transition:.4s var(--ease);position:relative;overflow:hidden}
.espace-item:last-child{border-right:none}
.espace-item::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--teal),var(--teal-light));transform:scaleX(0);transition:.4s var(--ease)}
.espace-item:hover::after{transform:scaleX(1)}
.espace-item:hover{background:rgba(110,193,228,.04)}
.ei-icon{font-size:2.2rem;margin-bottom:1rem;display:block}
.ei-title{font-family:var(--f1);font-size:1.5rem;font-weight:600;color:#fff;margin-bottom:.6rem}
.ei-desc{font-size:.86rem;color:rgba(255,255,255,.48);line-height:1.75}

/* ── CADRE UNIQUE SPLIT ────────────────────────────────────── */
.cadre-section{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 60%);padding:7rem 0}
.cadre-grid{display:grid;grid-template-columns:1fr 1.05fr;gap:5rem;align-items:center}
.cadre-mosaic{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:280px 200px;gap:.8rem;border-radius:24px;overflow:hidden}
.cm-i{overflow:hidden;position:relative}
.cm-i:first-child{grid-column:span 2;border-radius:20px 20px 0 0}
.cm-i img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.cm-i:hover img{transform:scale(1.07)}
.cadre-text h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.3rem);color:var(--dark);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.4rem}
.cadre-text p{font-size:1rem;color:#1a3a50;line-height:1.85;margin-bottom:1.2rem}
.cadre-feats{display:flex;flex-direction:column;gap:.65rem;margin:2rem 0}
.cf-item{display:flex;align-items:flex-start;gap:.8rem;font-size:.94rem;color:#fff;line-height:1.6}
.cf-dot{width:22px;height:22px;min-width:22px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;margin-top:1px;font-size:.65rem;color:#fff;flex-shrink:0}

/* ── MENU APERÇU ───────────────────────────────────────────── */
.menu-section{background:var(--dark);padding:7rem 0;overflow:hidden}
.menu-grid{display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center}
.menu-img{position:relative;border-radius:28px;overflow:hidden;height:560px}
.menu-img img{width:100%;height:100%;object-fit:cover;transition:transform .9s var(--ease)}
.menu-img:hover img{transform:scale(1.04)}
.menu-img-badge{position:absolute;top:2rem;left:2rem;background:rgba(8,19,30,.85);backdrop-filter:blur(16px);border:1px solid rgba(110,193,228,.2);border-radius:16px;padding:1.2rem 1.5rem}
.mib-title{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.25em;color:var(--teal);display:block;margin-bottom:.3rem}
.mib-val{font-family:var(--f1);font-size:1.1rem;color:#08131e;font-weight:600}
.menu-content h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.3rem);color:#fff;letter-spacing:-.025em;line-height:1.1;margin-bottom:1rem}
.menu-content p{font-size:.94rem;color:#1a3a50;line-height:1.85;margin-bottom:2rem}
.menu-list{display:flex;flex-direction:column;gap:.55rem;margin-bottom:2.5rem}
.ml-item{display:flex;align-items:center;justify-content:space-between;padding:.75rem 1.1rem;border-radius:12px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.07);transition:.2s ease}
.ml-item:hover{background:rgba(110,193,228,.08);border-color:rgba(110,193,228,.2)}
.ml-cat{font-family:var(--f3);font-size:.55rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;color:var(--teal);display:block;margin-bottom:.15rem}
.ml-name{font-family:var(--f1);font-size:1.05rem;color:#fff;line-height:1.2}
.ml-right{text-align:right;flex-shrink:0;margin-left:1rem}
.ml-price{font-family:var(--f3);font-size:.72rem;font-weight:700;color:var(--teal);display:block}
.ml-fcfa{font-family:var(--f3);font-size:.6rem;color:rgba(255,255,255,.3);display:block;margin-top:.1rem}

/* ── CUISINE LOCALE ────────────────────────────────────────── */
.locale-section{background:#fff;padding:7rem 0}
.locale-grid{display:grid;grid-template-columns:1.05fr 1fr;gap:5rem;align-items:center}
.locale-text h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.3rem);color:var(--dark);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.4rem}
.locale-text p{font-size:1rem;color:#1a3a50;line-height:1.85;margin-bottom:1.2rem}
.locale-badges{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin:2.5rem 0}
.lb-card{background:var(--teal-xlight);border:1px solid rgba(110,193,228,.28);border-radius:18px;padding:1.5rem;text-align:center;transition:.3s var(--ease)}
.lb-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(110,193,228,.18)}
.lb-ic{font-size:1.8rem;margin-bottom:.6rem;display:block}
.lb-title{font-family:var(--f3);font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;color:var(--teal-dark);display:block;margin-bottom:.3rem}
.lb-desc{font-size:.8rem;color:#1a3a50;line-height:1.6}
.locale-img-stack{position:relative;height:520px}
.lis-main{position:absolute;top:0;right:0;width:75%;height:78%;border-radius:24px;overflow:hidden;box-shadow:0 20px 60px rgba(13,27,42,.18);z-index:2}
.lis-acc{position:absolute;bottom:0;left:0;width:55%;height:52%;border-radius:24px;overflow:hidden;box-shadow:0 20px 60px rgba(13,27,42,.18);z-index:3;border:4px solid #fff}
.lis-main img,.lis-acc img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.lis-main:hover img,.lis-acc:hover img{transform:scale(1.06)}

/* ── ÉVÉNEMENTS ────────────────────────────────────────────── */
.events-section{background:var(--dark2);padding:7rem 0}
.events-grid{display:grid;grid-template-columns:1fr 1fr;gap:2rem}
.ev-card{border-radius:28px;overflow:hidden;position:relative;min-height:380px;display:flex;flex-direction:column;justify-content:flex-end;transition:.45s var(--ease)}
.ev-card:hover{transform:translateY(-8px);box-shadow:0 28px 60px rgba(0,0,0,.35)}
.ev-bg{position:absolute;inset:0}
.ev-bg img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.ev-card:hover .ev-bg img{transform:scale(1.06)}
.ev-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.95) 0%,rgba(8,19,30,.3) 60%,transparent 100%)}
.ev-body{position:relative;z-index:2;padding:2.5rem}
.ev-tag{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.28em;color:var(--teal);display:block;margin-bottom:.6rem}
.ev-title{font-family:var(--f1);font-size:1.8rem;font-weight:600;color:#fff;margin-bottom:.8rem;line-height:1.1}
.ev-desc{font-size:.87rem;color:#1a3a50;line-height:1.75;margin-bottom:1.4rem}
.ev-detail{display:flex;align-items:center;gap:.6rem;font-family:var(--f3);font-size:.65rem;font-weight:600;text-transform:uppercase;letter-spacing:.12em;color:#fff;margin-bottom:.4rem}
.ev-detail span:first-child{color:var(--teal)}

/* ── HORAIRES BAND ─────────────────────────────────────────── */
.horaires-band{background:linear-gradient(135deg,var(--teal-dark),var(--teal));padding:3.5rem 0}
.horaires-inner{display:flex;align-items:center;justify-content:space-around;flex-wrap:wrap;gap:2rem}
.h-item{text-align:center;color:#fff}
.h-icon{font-size:1.8rem;margin-bottom:.6rem;display:block}
.h-label{font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;opacity:.72;display:block;margin-bottom:.3rem}
.h-val{font-family:var(--f1);font-size:1.3rem;font-weight:600}
.h-sep{width:1px;height:50px;background:rgba(255,255,255,.2)}

/* ── CTA ───────────────────────────────────────────────────── */
.cta-section{background:var(--dark);padding:5rem 0;text-align:center;border-top:1px solid rgba(110,193,228,.08)}
.cta-title{font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);font-weight:600;color:#fff;margin-bottom:1rem}
.cta-sub{font-size:1rem;color:#1a3a50;margin-bottom:2.5rem;line-height:1.7}

/* ── RESPONSIVE ────────────────────────────────────────────── */
@media(max-width:1024px){
  .cadre-grid,.menu-grid,.locale-grid{grid-template-columns:1fr;gap:3rem}
  .menu-img{height:380px}
  .locale-img-stack{height:380px}
  .espaces-inner{grid-template-columns:1fr}
  .espace-item{border-right:none;border-bottom:1px solid rgba(110,193,228,.1)}
  .espace-item:last-child{border-bottom:none}
}
@media(max-width:768px){
  .events-grid{grid-template-columns:1fr}
  .locale-badges{grid-template-columns:1fr 1fr}
  .cadre-mosaic{grid-template-rows:220px 160px}
  .h-sep{display:none}
  .lis-acc{display:none}
  .lis-main{width:100%;height:100%;position:relative}
  .locale-img-stack{height:280px}
}
</style>
@endpush

@section('content')

{{-- ═══ PAGE HERO ═══════════════════════════════════════════════ --}}
<div class="page-hero">
  <div class="ph-bg">
    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1920" alt="Restaurant sur le lac Ahémé — Chez Théo Possotomé">
  </div>
  <div class="ph-ov"></div>
  <div class="ph-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Accueil</a>
      <i>›</i>
      <span>Restaurant</span>
    </div>
    <div class="sec-lbl">Gastronomie & Cadre unique</div>
    <h1 class="ph-title">Le Restaurant</h1>
    <p class="ph-sub">Situé au-dessus des flots du lac Ahémé, notre restaurant vous propose un cadre unique au Bénin. Cuisine locale, poissons frais et vue sur l'autre rive.</p>
  </div>
</div>

{{-- ═══ LES 3 ESPACES DE RESTAURATION ══════════════════════════ --}}
<div class="espaces-band">
  <div class="espaces-inner">

    <div class="espace-item" data-r="up" data-d="1">
      <span class="ei-icon"><i data-lucide="sailboat" class="lucide-icon"></i></span>
      <div class="ei-title">Sur l'embarcation</div>
      <p class="ei-desc">Dînez à bord de l'une de nos embarcations sur les eaux du lac Ahémé pour une expérience gastronomique hors du commun.</p>
    </div>

    <div class="espace-item" data-r="up" data-d="2">
      <span class="ei-icon"><i data-lucide="utensils" class="lucide-icon"></i></span>
      <div class="ei-title">Espace principal</div>
      <p class="ei-desc">Notre grande salle de restaurant sur pilotis, directement au-dessus de l'eau, avec vue panoramique sur le lac et la rive opposée.</p>
    </div>

    <div class="espace-item" data-r="up" data-d="3">
      <span class="ei-icon"><i data-lucide="lock" class="lucide-icon"></i></span>
      <div class="ei-title">Espaces privés</div>
      <p class="ei-desc">Des espaces de restauration privatisables pour vos repas en famille, réunions d'entreprise ou soirées en amoureux. Tous sur l'eau.</p>
    </div>

  </div>
</div>

{{-- ═══ UN CADRE UNIQUE AU BÉNIN ════════════════════════════════ --}}
<section class="cadre-section">
  <div class="wrap">
    <div class="cadre-grid">

      <div class="cadre-mosaic" data-r="left">
        <div class="cm-i">
          <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=900" alt="Restaurant sur pilotis lac Ahémé">
        </div>
        <div class="cm-i">
          <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600" alt="Intérieur restaurant">
        </div>
        <div class="cm-i">
          <img src="https://images.unsplash.com/photo-1578474846511-04ba529f0b88?w=600" alt="Vue lac restaurant">
        </div>
      </div>

      <div class="cadre-text" data-r="right">
        <div class="sec-lbl">Un cadre unique au Bénin</div>
        <h2>Dîner sur les Eaux du Lac Ahémé</h2>
        <p>Situé <strong>au-dessus des flots du lac Ahémé</strong>, notre restaurant vous propose un cadre que vous ne trouverez nulle part ailleurs au Bénin. Rafraîchis par la brise marine de notre lagune, vous serez <strong>au frais et à l'ombre</strong> tout au long de votre repas.</p>
        <p>Vous pourrez admirer <strong>l'autre rive du lac Ahémé</strong> ainsi que tous <strong>les pêcheurs en exercice</strong> tout au long de la journée, pour un spectacle vivant et authentique.</p>
        <div class="cadre-feats">
          <div class="cf-item"><div class="cf-dot">✓</div>Tous les espaces sont situés sur l'eau</div>
          <div class="cf-item"><div class="cf-dot">✓</div>Rafraîchi en permanence par la brise du lac</div>
          <div class="cf-item"><div class="cf-dot">✓</div>Vue sur l'autre rive et les pêcheurs</div>
          <div class="cf-item"><div class="cf-dot">✓</div>Embarcation, espace principal et salles privées</div>
          <div class="cf-item"><div class="cf-dot">✓</div>Petit-déjeuner inclus dans le prix des hébergements</div>
        </div>
        <a href="{{ route('reservation.index') }}" class="btn btn-p btn-lg mt4">Réserver une table</a>
      </div>

    </div>
  </div>
</section>

{{-- ═══ APERÇU DU MENU ══════════════════════════════════════════ --}}
<section class="menu-section">
  <div class="wrap">
    <div class="menu-grid">

      <div class="menu-img" data-r="left">
        <img src="https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=900" alt="Cuisine béninoise locale — Chez Théo">
        <div class="menu-img-badge">
          <span class="mib-title">Ouvert</span>
          <span class="mib-val">7h – 14h · 18h – 22h</span>
        </div>
      </div>

      <div class="menu-content" data-r="right">
        <div class="sec-lbl" style="color:var(--teal)">Menu & Spécialités</div>
        <h2>Une Cuisine Béninoise<br>Fraîche et Authentique</h2>
        <p>Nos plats sont préparés chaque jour avec des produits locaux, des poissons pêchés le matin même par les pêcheurs du village et les légumes de nos producteurs partenaires.</p>

        <div class="menu-list">
          <div class="ml-item">
            <div>
              <span class="ml-cat">Plat phare</span>
              <div class="ml-name">Poisson du lac grillé</div>
            </div>
            <div class="ml-right">
              <span class="ml-price">4 500 FCFA</span>
              <span class="ml-fcfa">~ 6,90 €</span>
            </div>
          </div>
          <div class="ml-item">
            <div>
              <span class="ml-cat">Fruits de mer</span>
              <div class="ml-name">Crevettes fraîches sautées</div>
            </div>
            <div class="ml-right">
              <span class="ml-price">5 500 FCFA</span>
              <span class="ml-fcfa">~ 8,40 €</span>
            </div>
          </div>
          <div class="ml-item">
            <div>
              <span class="ml-cat">Tradition béninoise</span>
              <div class="ml-name">Akassa sauce gombo</div>
            </div>
            <div class="ml-right">
              <span class="ml-price">2 800 FCFA</span>
              <span class="ml-fcfa">~ 4,30 €</span>
            </div>
          </div>
          <div class="ml-item">
            <div>
              <span class="ml-cat">Viande</span>
              <div class="ml-name">Brochettes de viande grillée</div>
            </div>
            <div class="ml-right">
              <span class="ml-price">3 500 FCFA</span>
              <span class="ml-fcfa">~ 5,35 €</span>
            </div>
          </div>
          <div class="ml-item">
            <div>
              <span class="ml-cat">Mulets du lac</span>
              <div class="ml-name">Mulets frits sauce tomate</div>
            </div>
            <div class="ml-right">
              <span class="ml-price">4 000 FCFA</span>
              <span class="ml-fcfa">~ 6,10 €</span>
            </div>
          </div>
          <div class="ml-item">
            <div>
              <span class="ml-cat">Boissons</span>
              <div class="ml-name">Jus de fruits tropicaux frais</div>
            </div>
            <div class="ml-right">
              <span class="ml-price">1 200 FCFA</span>
              <span class="ml-fcfa">~ 1,85 €</span>
            </div>
          </div>
        </div>

        <a href="{{ route('reservation.index') }}" class="btn btn-p btn-lg">Réserver une table</a>
      </div>

    </div>
  </div>
</section>

{{-- ═══ CUISINE LOCALE ══════════════════════════════════════════ --}}
<section class="locale-section">
  <div class="wrap">
    <div class="locale-grid">

      <div class="locale-text" data-r="left">
        <div class="sec-lbl">Une cuisine locale</div>
        <h2>Du Lac à votre Assiette</h2>
        <p>Nous favorisons une <strong>nourriture locale et saine</strong>. Nous travaillons en <strong>coopération étroite avec les pêcheurs du village</strong> de Possotomé. Ainsi, vous pouvez déguster les <strong>crevettes et mulets pêchés le matin même</strong>.</p>
        <p>Nous avons récemment développé <strong>deux bassins de pisciculture</strong> en face de nos deux espaces d'hébergement, pour bientôt proposer nos propres poissons aux clients de notre restaurant.</p>
        <div class="locale-badges">
          <div class="lb-card">
            <span class="lb-ic">🎣</span>
            <span class="lb-title">Pêcheurs locaux</span>
            <span class="lb-desc">Partenariat direct avec les pêcheurs du village de Possotomé</span>
          </div>
          <div class="lb-card">
            <span class="lb-ic"><i data-lucide="sunrise" class="lucide-icon"></i></span>
            <span class="lb-title">Pêche du matin</span>
            <span class="lb-desc">Crevettes et mulets pêchés le matin même pour votre repas</span>
          </div>
          <div class="lb-card">
            <span class="lb-ic">🐟</span>
            <span class="lb-title">Pisciculture propre</span>
            <span class="lb-desc">2 bassins de pisciculture en face des espaces d'hébergement</span>
          </div>
          <div class="lb-card">
            <span class="lb-ic"><i data-lucide="leaf" class="lucide-icon"></i></span>
            <span class="lb-title">Produits locaux</span>
            <span class="lb-desc">Collaboration avec les producteurs locaux de la région</span>
          </div>
        </div>
      </div>

      <div data-r="right">
        <div class="locale-img-stack">
          <div class="lis-main">
            <img src="https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=900" alt="Fruits de mer frais — Restaurant Chez Théo">
          </div>
          <div class="lis-acc">
            <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600" alt="Cuisine béninoise locale">
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ ÉVÉNEMENTS CULINAIRES ════════════════════════════════════ --}}
<section class="events-section">
  <div class="wrap">
    <div class="tc mb8" data-r="up">
      <div class="sec-lbl" style="justify-content:center;color:var(--teal)">Événements & Réceptions</div>
      <h2 style="font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);color:#fff;letter-spacing:-.025em;line-height:1.1">Organisation d'Événements<br>Culinaires</h2>
    </div>
    <div class="events-grid">

      <div class="ev-card" data-r="left">
        <div class="ev-bg">
          <img src="https://images.unsplash.com/photo-1555244162-803834f70033?w=900" alt="Buffet dominical — Chez Théo les Bains">
        </div>
        <div class="ev-ov"></div>
        <div class="ev-body">
          <span class="ev-tag">Chaque dimanche</span>
          <div class="ev-title">Buffet Dominical</div>
          <p class="ev-desc">Un événement convivial hebdomadaire pour déguster un bon repas en quantité illimitée et profiter d'une opportunité de rencontre exclusive.</p>
          <div class="ev-detail">
            <span><i data-lucide="clock" class="lucide-icon"></i></span> Chaque dimanche · 12h à 15h
          </div>
          <div class="ev-detail">
            <span><i data-lucide="banknote" class="lucide-icon"></i></span> 10 000 FCFA / personne · ~ 15 €
          </div>
          <div class="ev-detail">
            <span>♾️</span> Quantité illimitée
          </div>
          <a href="{{ route('contact.index') }}" class="btn btn-gl btn-sm" style="margin-top:1.2rem">Réserver ma place</a>
        </div>
      </div>

      <div class="ev-card" data-r="right">
        <div class="ev-bg">
          <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=900" alt="Réceptions et événements — Chez Théo les Bains">
        </div>
        <div class="ev-ov"></div>
        <div class="ev-body">
          <span class="ev-tag">Sur demande</span>
          <div class="ev-title">Réceptions & Privatisations</div>
          <p class="ev-desc">Nous organisons de nombreux rassemblements culinaires : déjeuners d'entreprise, buffets familiaux, sorties scolaires, fêtes privées.</p>
          <div class="ev-detail">
            <span>🏢</span> Déjeuners d'entreprise
          </div>
          <div class="ev-detail">
            <span>👨‍👩‍👧‍👦</span> Buffets familiaux & fêtes
          </div>
          <div class="ev-detail">
            <span>🎭</span> Spectacles & animations à la demande
          </div>
          <a href="{{ route('contact.index') }}" class="btn btn-gl btn-sm" style="margin-top:1.2rem">Organiser un événement</a>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ HORAIRES ═════════════════════════════════════════════════ --}}
<div class="horaires-band">
  <div class="horaires-inner">
    <div class="h-item">
      <span class="h-icon"><i data-lucide="sunrise" class="lucide-icon"></i></span>
      <span class="h-label">Petit-déjeuner</span>
      <span class="h-val">7h00 – 10h00</span>
    </div>
    <div class="h-sep"></div>
    <div class="h-item">
      <span class="h-icon"><i data-lucide="sun" class="lucide-icon"></i></span>
      <span class="h-label">Déjeuner</span>
      <span class="h-val">12h00 – 14h00</span>
    </div>
    <div class="h-sep"></div>
    <div class="h-item">
      <span class="h-icon"><i data-lucide="moon" class="lucide-icon"></i></span>
      <span class="h-label">Dîner</span>
      <span class="h-val">18h00 – 22h00</span>
    </div>
    <div class="h-sep"></div>
    <div class="h-item">
      <span class="h-icon"><i data-lucide="calendar" class="lucide-icon"></i></span>
      <span class="h-label">Buffet dominical</span>
      <span class="h-val">Dimanche 12h – 15h</span>
    </div>
    <div class="h-sep"></div>
    <div class="h-item">
      <span class="h-icon"><i data-lucide="phone" class="lucide-icon"></i></span>
      <span class="h-label">Réservations</span>
      <span class="h-val">+229 01 95 05 53 15</span>
    </div>
  </div>
</div>

{{-- ═══ CTA ══════════════════════════════════════════════════════ --}}
<section class="cta-section">
  <div class="wrap">
    <div data-r="up">
      <h2 class="cta-title">Réservez votre table</h2>
      <p class="cta-sub">Pour une table, le buffet dominical ou l'organisation d'un événement,<br>contactez-nous directement par WhatsApp ou par email.</p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('reservation.index') }}" class="btn btn-p btn-lg">Réserver par email</a>
        <a href="https://wa.me/22901950553155" target="_blank" class="btn btn-gl btn-lg"><i data-lucide="message-circle" class="lucide-icon"></i> WhatsApp direct</a>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('in'); });
}, {threshold:.1});
document.querySelectorAll('[data-r]').forEach(el => obs.observe(el));
</script>
@endpush
