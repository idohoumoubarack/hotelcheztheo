@extends('layouts.app')

@section('title', 'Bains Thermaux Possotomé — Chez Théo les Bains')
@section('description', 'Piscine thermale à débordement, bain de boue à l\'argile, spa et massages. Eau de source naturelle de Possotomé jusqu\'à 40°C. Dès 15€.')

@push('styles')
<style>
/* ── RESET UTILITAIRES ─────────────────────────────────────── */
.wrap{max-width:1300px;margin:0 auto;padding:0 2rem}
.wrap-xl{max-width:1620px;margin:0 auto;padding:0 2rem}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;font-family:var(--f3);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.9rem 2.2rem;border-radius:999px;transition:all .4s var(--spring);cursor:pointer;border:none;white-space:nowrap}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 6px 26px var(--teal-glow)}
.btn-p:hover{transform:translateY(-3px) scale(1.03);box-shadow:0 12px 42px var(--teal-glow);color:#fff}
.btn-gl{background:rgba(255,255,255,.16);backdrop-filter:blur(22px);border:1px solid rgba(255,255,255,.28);color:#fff}
.btn-gl:hover{background:rgba(255,255,255,.24);transform:translateY(-2px);color:#fff}
.btn-dk{background:var(--dark);color:#fff}
.btn-dk:hover{background:var(--dark3);transform:translateY(-3px);color:#fff}
.btn-w{background:#fff;color:var(--teal-dark)}
.btn-w:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(0,0,0,.15);color:var(--teal-dark)}
.btn-lg{padding:1.1rem 2.8rem;font-size:.82rem}
.btn-sm{padding:.55rem 1.3rem;font-size:.67rem}
.sec-lbl{display:inline-flex;align-items:center;gap:.8rem;font-family:var(--f3);font-size:.66rem;font-weight:700;text-transform:uppercase;letter-spacing:.32em;color:var(--teal);margin-bottom:1rem}
.sec-lbl::before{content:'';width:28px;height:1.5px;background:linear-gradient(90deg,var(--teal),var(--teal-light));flex-shrink:0}
.tc{text-align:center}
.mb4{margin-bottom:2rem}.mb6{margin-bottom:3rem}.mb8{margin-bottom:4rem}
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

/* ── ÉLÉMENTS INTRO BAND ───────────────────────────────────── */
.elements-band{background:var(--dark);border-bottom:1px solid rgba(110,193,228,.1);padding:0}
.elements-inner{display:grid;grid-template-columns:repeat(3,1fr)}
.element-item{padding:3rem 2.5rem;border-right:1px solid rgba(110,193,228,.1);position:relative;overflow:hidden;transition:.4s var(--ease)}
.element-item:last-child{border-right:none}
.element-item::before{content:'';position:absolute;inset:0;opacity:0;transition:.4s var(--ease)}
.element-item:hover::before{opacity:1}
.element-item.feu::before{background:linear-gradient(135deg,rgba(245,107,35,.08),transparent)}
.element-item.eau::before{background:linear-gradient(135deg,rgba(110,193,228,.1),transparent)}
.element-item.terre::before{background:linear-gradient(135deg,rgba(139,94,60,.08),transparent)}
.element-item:hover{transform:translateY(-4px)}
.elem-icon{font-size:2.5rem;margin-bottom:1.2rem;display:block}
.elem-tag{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.3em;margin-bottom:.6rem;display:block}
.feu .elem-tag{color:#f56b23}
.eau .elem-tag{color:var(--teal)}
.terre .elem-tag{color:#a07850}
.elem-title{font-family:var(--f1);font-size:1.6rem;font-weight:600;color:#fff;margin-bottom:.8rem;line-height:1.1}
.elem-desc{font-size:.88rem;color:#ffffff;line-height:1.78}

/* ── PISCINE SPLIT ─────────────────────────────────────────── */
.piscine-section{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 60%);padding:7rem 0}
.piscine-grid{display:grid;grid-template-columns:1.1fr 1fr;gap:5rem;align-items:center}
.piscine-visual{position:relative}
.piscine-main{border-radius:28px;overflow:hidden;height:500px;box-shadow:0 24px 70px rgba(13,27,42,.2)}
.piscine-main img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.piscine-main:hover img{transform:scale(1.04)}
.piscine-stat-card{position:absolute;bottom:-2rem;right:-2rem;background:var(--dark);border:1px solid rgba(110,193,228,.25);border-radius:22px;padding:1.5rem 1.8rem;box-shadow:0 20px 50px rgba(0,0,0,.35);display:flex;flex-direction:column;gap:1rem;min-width:200px}
.psc-item{display:flex;align-items:center;gap:.9rem}
.psc-ic{width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0}
.psc-val{font-family:var(--f1);font-size:1.4rem;font-weight:700;color:var(--teal);line-height:1;display:block}
.psc-lbl{font-family:var(--f3);font-size:.58rem;font-weight:600;text-transform:uppercase;letter-spacing:.15em;color:#fff}
.piscine-text h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.2rem);color:var(--dark);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.2rem}
.piscine-text p{font-size:1rem;color:#ffffff;line-height:1.85;margin-bottom:1.5rem}
.piscine-feats{display:flex;flex-direction:column;gap:.7rem;margin:2rem 0}
.pf-item{display:flex;align-items:flex-start;gap:.8rem;font-size:.94rem;color:#000000;line-height:1.6}
.pf-dot{width:22px;height:22px;min-width:22px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;margin-top:1px;font-size:.65rem;color:#fff;flex-shrink:0}

/* ── SOINS SECTION ─────────────────────────────────────────── */
.soins-section{background:var(--dark2);padding:7rem 0}
.soins-header{display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;margin-bottom:5rem}
.soins-header h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.5rem);color:#fff;letter-spacing:-.025em;line-height:1.1}
.soins-header p{font-size:1rem;color:#ffffff;line-height:1.85}
.soins-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.soin-card{border-radius:28px;overflow:hidden;background:rgba(255,255,255,.03);border:1px solid rgba(110,193,228,.12);transition:.45s var(--ease)}
.soin-card:hover{transform:translateY(-10px);box-shadow:0 28px 60px rgba(0,0,0,.35);border-color:rgba(110,193,228,.3)}
.soin-img{height:280px;overflow:hidden;position:relative}
.soin-img img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.soin-card:hover .soin-img img{transform:scale(1.08)}
.soin-img-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.6) 0%,transparent 50%)}
.soin-body{padding:2rem 1.8rem 2.2rem}
.soin-icon{font-size:1.8rem;margin-bottom:.8rem;display:block}
.soin-name{font-family:var(--f1);font-size:1.6rem;font-weight:600;color:#fff;margin-bottom:.6rem}
.soin-desc{font-size:.88rem;color:#ffffff;line-height:1.75;margin-bottom:1.5rem}
.soin-price{display:flex;align-items:baseline;gap:.3rem;margin-bottom:1.4rem}
.sp-from{font-family:var(--f3);font-size:.62rem;font-weight:600;text-transform:uppercase;letter-spacing:.15em;color:#fff}
.sp-val{font-family:var(--f1);font-size:2rem;font-weight:700;color:var(--teal);line-height:1}
.sp-cur{font-family:var(--f3);font-size:.82rem;font-weight:700;color:var(--teal)}
.sp-alt{font-family:var(--f3);font-size:.68rem;color:rgba(255,255,255,.3);display:block;margin-top:.2rem}

/* ── EAU DE POSSOTOMÉ INFO ─────────────────────────────────── */
.eau-section{background:#fff;padding:7rem 0}
.eau-grid{display:grid;grid-template-columns:1fr 1.1fr;gap:5rem;align-items:center}
.eau-text h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.2rem);color:var(--dark);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.2rem}
.eau-text p{font-size:1rem;color:#1a3a50;line-height:1.85;margin-bottom:1.2rem}
.eau-facts{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin:2.5rem 0}
.eau-fact{background:var(--teal-xlight);border:1px solid rgba(110,193,228,.3);border-radius:18px;padding:1.4rem;text-align:center}
.ef-val{font-family:var(--f1);font-size:2.4rem;font-weight:700;color:var(--teal-dark);line-height:1;display:block}
.ef-lbl{font-family:var(--f3);font-size:.6rem;font-weight:600;text-transform:uppercase;letter-spacing:.18em;color:#fff;display:block;margin-top:.3rem}
.eau-visual{position:relative}
.eau-img-stack{position:relative;height:520px}
.eis-main{position:absolute;top:0;left:0;width:75%;height:80%;border-radius:24px;overflow:hidden;box-shadow:0 20px 60px rgba(13,27,42,.2);z-index:2}
.eis-acc{position:absolute;bottom:0;right:0;width:55%;height:52%;border-radius:24px;overflow:hidden;box-shadow:0 20px 60px rgba(13,27,42,.2);z-index:3;border:4px solid #fff}
.eis-main img,.eis-acc img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.eis-main:hover img,.eis-acc:hover img{transform:scale(1.06)}
.eis-badge{position:absolute;top:30%;right:-12px;z-index:5;background:var(--dark);border:1px solid rgba(110,193,228,.25);border-radius:18px;padding:1rem 1.2rem;text-align:center;box-shadow:0 20px 50px rgba(0,0,0,.35);min-width:110px}
.eib-n{font-family:var(--f1);font-size:2.2rem;font-weight:700;color:var(--teal);line-height:1;display:block}
.eib-l{font-family:var(--f3);font-size:.56rem;font-weight:600;text-transform:uppercase;letter-spacing:.17em;color:#fff;display:block;margin-top:.3rem}

/* ── CTA ───────────────────────────────────────────────────── */
.cta-section{background:linear-gradient(135deg,var(--teal-dark),var(--teal));padding:5rem 0;text-align:center}
.cta-title{font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);font-weight:600;color:#fff;margin-bottom:1rem}
.cta-sub{font-size:1rem;color:rgba(255,255,255,.78);margin-bottom:2.5rem;line-height:1.7}

/* ── RESPONSIVE ────────────────────────────────────────────── */
@media(max-width:1024px){
  .piscine-grid,.eau-grid,.soins-header{grid-template-columns:1fr;gap:3rem}
  .piscine-stat-card{position:static;margin-top:2rem;flex-direction:row;flex-wrap:wrap;gap:1.5rem}
  .eau-img-stack{height:380px}
  .elements-inner{grid-template-columns:1fr}
  .element-item{border-right:none;border-bottom:1px solid rgba(110,193,228,.1)}
  .element-item:last-child{border-bottom:none}
}
@media(max-width:768px){
  .soins-grid{grid-template-columns:1fr}
  .eau-facts{grid-template-columns:1fr 1fr}
  .eis-acc{display:none}
  .eis-main{width:100%;height:100%;position:relative}
  .eau-img-stack{height:300px}
}
</style>
@endpush

@section('content')

{{-- ═══ PAGE HERO ═══════════════════════════════════════════════ --}}
<div class="page-hero">
  <div class="ph-bg">
    <img src="https://www.occitanie-thermale.com/uploads/2020/12/station-thermale-balaruc-les-bains-bains-interieur-vue-etang-de-thau-emmanuel-morel-2018.jpg" alt="Piscine thermale — Chez Théo les Bains Possotomé">
  </div>
  <div class="ph-ov"></div>
  <div class="ph-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Accueil</a>
      <i>›</i>
      <span>Bains</span>
    </div>
    <div class="sec-lbl">Bien-être & Soins</div>
    <h1 class="ph-title">Les Bains</h1>
    <p class="ph-sub">Piscine thermale à débordement, bain de boue à l'argile, spa et massages. Venez tester votre résistance aux éléments.</p>
  </div>
</div>

{{-- ═══ LES 3 ÉLÉMENTS ══════════════════════════════════════════ --}}
<div class="elements-band">
  <div class="elements-inner">

    <div class="element-item feu" data-r="up" data-d="1">
      <span class="elem-icon"><i data-lucide="flame" class="lucide-icon"></i></span>
      <span class="elem-tag">Le Feu</span>
      <div class="elem-title">Soin à l'Argile</div>
      <p class="elem-desc">Une fois filtrée et travaillée par nos équipes, l'argile du lac Ahémé devient un véritable soin qui purifie, régule et assainit votre peau.</p>
    </div>

    <div class="element-item eau" data-r="up" data-d="2">
      <span class="elem-icon"><i data-lucide="droplets" class="lucide-icon"></i></span>
      <span class="elem-tag">L'Eau</span>
      <div class="elem-title">Bain Thermal</div>
      <p class="elem-desc">Profitez des vertus de l'eau de source naturelle de Possotomé dans un bain relaxant et hydromassant face au lac Ahémé.</p>
    </div>

    <div class="element-item terre" data-r="up" data-d="3">
      <span class="elem-icon"><i data-lucide="leaf" class="lucide-icon"></i></span>
      <span class="elem-tag">La Terre</span>
      <div class="elem-title">Massage Corps</div>
      <p class="elem-desc">Un massage de l'ensemble de votre corps avec une huile naturelle qui va hydrater votre peau en profondeur. Seul ou en duo.</p>
    </div>

  </div>
</div>

{{-- ═══ LA PISCINE THERMALE ═════════════════════════════════════ --}}
<section class="piscine-section">
  <div class="wrap">
    <div class="piscine-grid">

      <div class="piscine-visual" data-r="left">
        <div class="piscine-main">
          <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=900" alt="Piscine thermale à débordement — Chez Théo les Bains">
        </div>
        <div class="piscine-stat-card">
          <div class="psc-item">
            <div class="psc-ic">🌡️</div>
            <div>
              <span class="psc-val">40°C</span>
              <span class="psc-lbl">Température max</span>
            </div>
          </div>
          <div class="psc-item">
            <div class="psc-ic">📏</div>
            <div>
              <span class="psc-val">15m</span>
              <span class="psc-lbl">Longueur du bassin</span>
            </div>
          </div>
          <div class="psc-item">
            <div class="psc-ic"><i data-lucide="waves" class="lucide-icon"></i></div>
            <div>
              <span class="psc-val">2m</span>
              <span class="psc-lbl">Profondeur</span>
            </div>
          </div>
        </div>
      </div>

      <div class="piscine-text" data-r="right">
        <div class="sec-lbl">La piscine thermale</div>
        <h2>Une Piscine à Débordement sur le Lac Ahémé</h2>
        <p>L'eau de Possotomé sort d'une <strong>source thermale naturelle</strong> et peut atteindre les <strong>40°C</strong>. Elle est exploitée et commercialisée dans tout le Bénin pour ses vertus thérapeutiques reconnues.</p>
        <p>Le bassin principal fait <strong>15 mètres</strong> de long et atteint <strong>2 mètres</strong> de profondeur. La piscine est à <strong>débordement</strong> avec une vue imprenable sur le lac Ahémé.</p>
        <div class="piscine-feats">
          <div class="pf-item">
            <div class="pf-dot">✓</div>
            Eau de source thermale naturelle de Possotomé
          </div>
          <div class="pf-item">
            <div class="pf-dot">✓</div>
            Piscine à débordement avec vue sur le lac Ahémé
          </div>
          <div class="pf-item">
            <div class="pf-dot">✓</div>
            Bassin de 15m × 2m de profondeur
          </div>
          <div class="pf-item">
            <div class="pf-dot">✓</div>
            Eau bénéfique pour la peau et les articulations
          </div>
          <div class="pf-item">
            <div class="pf-dot">✓</div>
            Salle de sport disponible avant ou après la baignade
          </div>
        </div>
        <a href="{{ route('reservation.index') }}" class="btn btn-p btn-lg">Réserver une séance</a>
      </div>

    </div>
  </div>
</section>

{{-- ═══ LES 3 SOINS ═════════════════════════════════════════════ --}}
<section class="soins-section">
  <div class="wrap">

    <div class="soins-header">
      <div data-r="left">
        <div class="sec-lbl" style="color:var(--teal)">Nos soins</div>
        <h2>Venez tester votre<br>résistance aux éléments</h2>
      </div>
      <p data-r="right">Trois soins inspirés des éléments naturels de Possotomé — l'argile du lac, l'eau thermale et les huiles naturelles — pour une expérience de bien-être unique au Bénin.</p>
    </div>

    <div class="soins-grid">

      {{-- Soin argile --}}
      <div class="soin-card" data-r="up" data-d="1">
        <div class="soin-img">
          <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=700" alt="Soin du corps à l'argile — Chez Théo les Bains">
          <div class="soin-img-ov"></div>
        </div>
        <div class="soin-body">
          <span class="soin-icon"><i data-lucide="flame" class="lucide-icon"></i></span>
          <div class="soin-name">Soin du Corps à l'Argile</div>
          <p class="soin-desc">L'argile du lac Ahémé, filtrée et travaillée par nos équipes, purifie, régule et assainit votre peau en profondeur. Un rituel unique ancré dans les traditions béninoises.</p>
          <div class="soin-price">
            <span class="sp-from">À partir de</span>
            <span class="sp-val">15</span>
            <span class="sp-cur">€</span>
          </div>
          <span class="sp-alt">~ 10 000 FCFA</span>
          <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm" style="margin-top:1rem">Réserver</a>
        </div>
      </div>

      {{-- Spa détente --}}
      <div class="soin-card" data-r="up" data-d="2">
        <div class="soin-img">
          <img src="https://images.unsplash.com/photo-1600334129128-685c5582fd35?w=700" alt="Spa détente — Chez Théo les Bains">
          <div class="soin-img-ov"></div>
        </div>
        <div class="soin-body">
          <span class="soin-icon"><i data-lucide="droplets" class="lucide-icon"></i></span>
          <div class="soin-name">Spa Détente</div>
          <p class="soin-desc">Profitez des vertus de l'eau de source naturelle de Possotomé dans un bain relaxant et hydromassant face au lac Ahémé. Une expérience de détente absolue.</p>
          <div class="soin-price">
            <span class="sp-from">À partir de</span>
            <span class="sp-val">15</span>
            <span class="sp-cur">€</span>
          </div>
          <span class="sp-alt">~ 10 000 FCFA</span>
          <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm" style="margin-top:1rem">Réserver</a>
        </div>
      </div>

      {{-- Massage --}}
      <div class="soin-card" data-r="up" data-d="3">
        <div class="soin-img">
          <img src="https://images.unsplash.com/photo-1519823551278-64ac92734fb1?w=700" alt="Massage corps et visage — Chez Théo les Bains">
          <div class="soin-img-ov"></div>
        </div>
        <div class="soin-body">
          <span class="soin-icon"><i data-lucide="leaf" class="lucide-icon"></i></span>
          <div class="soin-name">Massage Corps & Visage</div>
          <p class="soin-desc">Un massage de l'ensemble de votre corps avec une huile naturelle qui va hydrater votre peau en profondeur. Disponible en solo ou en duo pour les couples.</p>
          <div class="soin-price">
            <span class="sp-from">À partir de</span>
            <span class="sp-val">15</span>
            <span class="sp-cur">€</span>
          </div>
          <span class="sp-alt">~ 10 000 FCFA</span>
          <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm" style="margin-top:1rem">Réserver</a>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ EAU DE POSSOTOMÉ ════════════════════════════════════════ --}}
<section class="eau-section">
  <div class="wrap">
    <div class="eau-grid">

      <div class="eau-text" data-r="left">
        <div class="sec-lbl">L'eau de Possotomé</div>
        <h2>Une Source Thermale<br>Reconnue dans Tout le Bénin</h2>
        <p>L'eau de Possotomé sort d'une source thermale naturelle et peut atteindre les <strong>40°C</strong>. Elle est <strong>exploitée et commercialisée dans tout le Bénin</strong> pour ses propriétés thérapeutiques reconnues depuis des générations.</p>
        <p>Ses vertus sont bénéfiques pour la peau, les articulations et le système nerveux. Un soin naturel à portée de main au cœur du Bénin.</p>
        <div class="eau-facts">
          <div class="eau-fact">
            <span class="ef-val">40°C</span>
            <span class="ef-lbl">Température source</span>
          </div>
          <div class="eau-fact">
            <span class="ef-val">3</span>
            <span class="ef-lbl">Sources naturelles</span>
          </div>
          <div class="eau-fact">
            <span class="ef-val">100%</span>
            <span class="ef-lbl">Naturelle</span>
          </div>
          <div class="eau-fact">
            <span class="ef-val">∞</span>
            <span class="ef-lbl">Bienfaits</span>
          </div>
        </div>
        <a href="{{ route('reservation.index') }}" class="btn btn-p btn-lg">Réserver mes bains</a>
      </div>

      <div class="eau-visual" data-r="right">
        <div class="eau-img-stack">
          <div class="eis-main">
            <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=900" alt="Bains thermaux Possotomé">
          </div>
          <div class="eis-acc">
            <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=600" alt="Piscine thermale">
          </div>
          <div class="eis-badge">
            <span class="eib-n">40°C</span>
            <span class="eib-l">Source<br>naturelle</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ CTA ══════════════════════════════════════════════════════ --}}
<section class="cta-section">
  <div class="wrap">
    <div data-r="up">
      <h2 class="cta-title">Prêt pour votre moment de bien-être ?</h2>
      <p class="cta-sub">Réservez votre séance de bains, soin ou massage directement par WhatsApp ou par email.<br>Notre équipe vous répondra rapidement.</p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('contact.index') }}" class="btn btn-w btn-lg">Réserver par email</a>
        <a href="https://wa.me/22901950553155" target="_blank" class="btn btn-lg" style="background:rgba(255,255,255,.2);color:#fff;border:1.5px solid rgba(255,255,255,.4)">
          <i data-lucide="message-circle" class="lucide-icon"></i> WhatsApp direct
        </a>
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
