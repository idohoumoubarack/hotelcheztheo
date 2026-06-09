@extends('layouts.app')

@section('title', 'Notre Espace — L\'Hôtel & Le Resort | Chez Théo les Bains Possotomé')
@section('description', 'Deux espaces à 200m l\'un de l\'autre au bord du lac Ahémé : L\'Hôtel (restaurant, bungalows, chambres B&B) et Le Resort (suites, piscine, spa, salle de sport). Reliés en canoë.')

@push('styles')
<style>
/* ── UTILITAIRES ───────────────────────────────────────────── */
.wrap{max-width:1300px;margin:0 auto;padding:0 2rem}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;font-family:var(--f3);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.9rem 2.2rem;border-radius:999px;transition:all .4s var(--spring);cursor:pointer;border:none;white-space:nowrap}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 6px 26px var(--teal-glow)}
.btn-p:hover{transform:translateY(-3px) scale(1.03);box-shadow:0 12px 42px var(--teal-glow);color:#fff}
.btn-out{background:transparent;color:var(--teal);border:1.5px solid var(--teal)}
.btn-out:hover{background:var(--teal);color:#fff;transform:translateY(-2px)}
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
[data-d="1"]{transition-delay:.1s}[data-d="2"]{transition-delay:.2s}[data-d="3"]{transition-delay:.3s}
[data-d="4"]{transition-delay:.4s}[data-d="5"]{transition-delay:.5s}[data-d="6"]{transition-delay:.6s}

/* ── PAGE HERO ─────────────────────────────────────────────── */
.page-hero{position:relative;height:65vh;min-height:480px;display:flex;align-items:flex-end;overflow:hidden;background:var(--dark)}
.ph-bg{position:absolute;inset:0}
.ph-bg img{width:100%;height:100%;object-fit:cover}
.ph-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.95) 0%,rgba(8,19,30,.4) 55%,transparent 100%)}
.ph-body{position:relative;z-index:2;max-width:1300px;margin:0 auto;padding:0 2rem 4.5rem;width:100%}
.ph-title{font-family:var(--f1);font-size:clamp(2.5rem,6vw,5.5rem);font-weight:600;color:#fff;line-height:1.05;letter-spacing:-.03em;margin-bottom:.8rem}
.ph-sub{font-size:1.05rem;color:#fff;max-width:600px;line-height:1.75}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-family:var(--f3);font-size:.68rem;text-transform:uppercase;letter-spacing:.15em;color:#fff;margin-bottom:1rem}
.breadcrumb a{color:#fff;transition:.2s}
.breadcrumb a:hover{color:var(--teal)}
.breadcrumb span{color:var(--teal)}
.breadcrumb i{font-size:.5rem;opacity:.5}

/* ── INTRO BAND (2 espaces) ────────────────────────────────── */
.intro-band{background:var(--dark2);border-bottom:1px solid rgba(110,193,228,.1);padding:3rem 0}
.intro-inner{display:grid;grid-template-columns:1fr auto 1fr;gap:2rem;align-items:center;max-width:900px;margin:0 auto}
.ii-space{text-align:center;padding:1.5rem 2rem;border-radius:20px;background:rgba(255,255,255,.03);border:1px solid rgba(110,193,228,.1);transition:.3s ease}
.ii-space:hover{background:rgba(110,193,228,.07);border-color:rgba(110,193,228,.25)}
.ii-icon{font-size:2rem;display:block;margin-bottom:.6rem}
.ii-name{font-family:var(--f1);font-size:1.5rem;font-weight:600;color:#fff;display:block;margin-bottom:.3rem}
.ii-tag{font-family:var(--f3);font-size:.62rem;font-weight:600;text-transform:uppercase;letter-spacing:.18em;color:var(--teal)}
.ii-sep{display:flex;flex-direction:column;align-items:center;gap:.4rem}
.ii-dist{font-family:var(--f3);font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;color:rgba(255,255,255,.35);text-align:center}
.ii-line{width:2px;height:40px;background:linear-gradient(to bottom,transparent,var(--teal),transparent)}
.ii-canoe{font-size:1.3rem}

/* ── SECTION ESPACE GÉNÉRIQUE ──────────────────────────────── */
.espace-section{padding:7rem 0}
.espace-section.bg-light{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 55%)}
.espace-section.bg-dark{background:var(--dark)}

/* ── EN-TÊTE ESPACE ────────────────────────────────────────── */
.espace-header{display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;margin-bottom:5rem}
.eh-visual{border-radius:28px;overflow:hidden;height:420px;position:relative;box-shadow:0 24px 70px rgba(13,27,42,.2)}
.eh-visual img{width:100%;height:100%;object-fit:cover;transition:transform .9s var(--ease)}
.eh-visual:hover img{transform:scale(1.04)}
.eh-badge{position:absolute;top:1.2rem;left:1.2rem;font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.45rem 1rem;border-radius:999px;color:#fff}
.badge-hotel{background:linear-gradient(135deg,#1a7a5e,#0f5c46)}
.badge-resort{background:linear-gradient(135deg,var(--teal-dark),var(--teal))}
.eh-content h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.2rem);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.2rem}
.eh-content h2.dark-h{color:var(--dark)}
.eh-content h2.white-h{color:#fff}
.eh-content p{font-size:1rem;line-height:1.85;margin-bottom:1rem}
.eh-content p.dark-p{color:#000000}
.eh-content p.white-p{color:#fff}
.eh-feats{display:flex;flex-direction:column;gap:.55rem;margin:1.5rem 0}
.ef-item{display:flex;align-items:center;gap:.7rem;font-size:.92rem}
.ef-item.dark-i{color:#000000}
.ef-item.white-i{color:#fff}
.ef-dot{width:20px;height:20px;min-width:20px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;font-size:.6rem;color:#fff;flex-shrink:0}

/* ── GRILLE LOGEMENTS ──────────────────────────────────────── */
.logements-title{font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.28em;margin-bottom:1.8rem;padding-bottom:.8rem;border-bottom:1px solid}
.lt-light{color:var(--teal-dark);border-color:rgba(110,193,228,.25)}
.lt-dark{color:var(--teal);border-color:rgba(110,193,228,.15)}
.logements-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem}

/* ── CARTE LOGEMENT ────────────────────────────────────────── */
.log-card{border-radius:20px;overflow:hidden;transition:.4s var(--ease);cursor:pointer;position:relative}
.log-card.light-card{background:#fff;border:1px solid rgba(110,193,228,.18);box-shadow:0 4px 16px rgba(13,27,42,.07)}
.log-card.dark-card{background:rgba(255,255,255,.04);border:1px solid rgba(110,193,228,.1)}
.log-card:hover{transform:translateY(-8px)}
.log-card.light-card:hover{box-shadow:0 20px 50px rgba(13,27,42,.15),0 0 0 1px rgba(110,193,228,.25)}
.log-card.dark-card:hover{background:rgba(110,193,228,.08);border-color:rgba(110,193,228,.3);box-shadow:0 20px 50px rgba(0,0,0,.3)}
.lc-img{height:160px;overflow:hidden;position:relative}
.lc-img img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.log-card:hover .lc-img img{transform:scale(1.08)}
.lc-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.45) 0%,transparent 55%)}
.lc-body{padding:1.1rem 1.2rem 1.3rem}
.lc-name{font-family:var(--f1);font-size:1.05rem;font-weight:600;margin-bottom:.25rem}
.light-card .lc-name{color:var(--dark)}
.dark-card .lc-name{color:#fff}
.lc-type{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.17em}
.light-card .lc-type{color:var(--teal-dark)}
.dark-card .lc-type{color:var(--teal)}
.lc-arrow{position:absolute;top:1rem;right:1rem;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;opacity:0;transform:translateX(-6px);transition:.3s ease}
.light-card .lc-arrow{background:var(--teal-xlight);color:var(--teal-dark)}
.dark-card .lc-arrow{background:rgba(110,193,228,.15);color:var(--teal)}
.log-card:hover .lc-arrow{opacity:1;transform:none}

/* ── CARTE SERVICE (non-hébergement) ───────────────────────── */
.svc-card{border-radius:20px;overflow:hidden;transition:.4s var(--ease);cursor:pointer;position:relative;background:rgba(255,255,255,.04);border:1px solid rgba(110,193,228,.1)}
.svc-card:hover{transform:translateY(-8px);background:rgba(110,193,228,.08);border-color:rgba(110,193,228,.3);box-shadow:0 20px 50px rgba(0,0,0,.3)}
.sc-img{height:160px;overflow:hidden}
.sc-img img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.svc-card:hover .sc-img img{transform:scale(1.08)}
.sc-body{padding:1.1rem 1.2rem 1.3rem}
.sc-name{font-family:var(--f1);font-size:1.05rem;font-weight:600;color:#fff;margin-bottom:.25rem}
.sc-tag{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.17em;color:var(--teal)}

/* ── CONNEXION CANOË ───────────────────────────────────────── */
.canoe-band{background:var(--dark3,#060f18);border-top:1px solid rgba(110,193,228,.1);border-bottom:1px solid rgba(110,193,228,.1);padding:3.5rem 0}
.canoe-inner{display:flex;align-items:center;justify-content:space-between;gap:3rem;flex-wrap:wrap}
.ci-left{display:flex;align-items:center;gap:1.5rem}
.ci-icon-big{font-size:3rem;opacity:.9}
.ci-text h3{font-family:var(--f1);font-size:1.7rem;color:#fff;margin-bottom:.4rem}
.ci-text p{font-size:.92rem;color:#fff;line-height:1.7;max-width:500px}

/* ── CTA ───────────────────────────────────────────────────── */
.cta-section{background:linear-gradient(135deg,var(--teal-dark),var(--teal));padding:5.5rem 0;text-align:center}
.cta-title{font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);font-weight:600;color:#fff;margin-bottom:1rem}
.cta-sub{font-size:1rem;color:rgba(255,255,255,.78);margin-bottom:2.5rem;line-height:1.75}

/* ── RESPONSIVE ────────────────────────────────────────────── */
@media(max-width:1024px){
  .espace-header{grid-template-columns:1fr;gap:3rem}
  .intro-inner{grid-template-columns:1fr;gap:1.2rem}
  .ii-sep{flex-direction:row;justify-content:center}
  .ii-line{width:40px;height:2px;background:linear-gradient(to right,transparent,var(--teal),transparent)}
}
@media(max-width:768px){
  .logements-grid{grid-template-columns:1fr 1fr}
  .canoe-inner{flex-direction:column;text-align:center}
  .ci-left{flex-direction:column;text-align:center}
}
@media(max-width:480px){.logements-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

{{-- ═══ PAGE HERO ═══════════════════════════════════════════════ --}}
<div class="page-hero">
  <div class="ph-bg">
    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1920" alt="Notre Espace — Chez Théo les Bains Possotomé lac Ahémé">
  </div>
  <div class="ph-ov"></div>
  <div class="ph-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Accueil</a>
      <i>›</i>
      <a href="{{ route('about.index') }}">À propos</a>
      <i>›</i>
      <span>Notre espace</span>
    </div>
    <div class="sec-lbl">Plan & Organisation</div>
    <h1 class="ph-title">Notre Espace</h1>
    <p class="ph-sub">Deux espaces distincts au bord du lac Ahémé, séparés de 200 mètres et reliés par canoë. L'Hôtel et Le Resort, chacun avec ses hébergements et ses services.</p>
  </div>
</div>

{{-- ═══ INTRO : 2 ESPACES ═══════════════════════════════════════ --}}
<div class="intro-band">
  <div class="wrap">
    <div class="intro-inner">
      <div class="ii-space" data-r="left">
        <span class="ii-icon"><i data-lucide="building-2" class="lucide-icon"></i></span>
        <span class="ii-name">L'Hôtel</span>
        <span class="ii-tag">Restaurant · Bungalows · Chambres B&B</span>
      </div>
      <div class="ii-sep" data-r="up">
        <span class="ii-dist">200 m</span>
        <div class="ii-line"></div>
        <span class="ii-canoe"><i data-lucide="sailboat" class="lucide-icon"></i></span>
        <div class="ii-line"></div>
        <span class="ii-dist">canoë</span>
      </div>
      <div class="ii-space" data-r="right">
        <span class="ii-icon"><i data-lucide="palmtree" class="lucide-icon"></i></span>
        <span class="ii-name">Le Resort</span>
        <span class="ii-tag">Suites · Piscine · Spa · Salle de sport</span>
      </div>
    </div>
    <p style="text-align:center;font-size:.9rem;color:#fff;margin-top:2rem;font-family:var(--f3);font-size:.7rem;letter-spacing:.05em">
      Il faut utiliser la route pour passer d'un espace à l'autre — ou emprunter nos canoës sur le lac Ahémé.
    </p>
  </div>
</div>

{{-- ═══ L'HÔTEL ═════════════════════════════════════════════════ --}}
<section class="espace-section bg-light">
  <div class="wrap">

    <div class="espace-header">

      <div class="eh-visual" data-r="left">
        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=900" alt="L'Hôtel — Chez Théo les Bains Possotomé">
        <span class="eh-badge badge-hotel"><i data-lucide="building-2" class="lucide-icon"></i> L'Hôtel</span>
      </div>

      <div class="eh-content" data-r="right">
        <div class="sec-lbl">Espace 1</div>
        <h2 class="dark-h">L'Hôtel</h2>
        <p class="dark-p">Le premier espace de Chez Théo, là où tout a commencé. L'Hôtel accueille le <strong>restaurant sur pilotis</strong> au-dessus de l'eau, ainsi que plusieurs types d'hébergements allant des chambres B&B aux bungalows.</p>
        <p class="dark-p">C'est le cœur de métier originel de Chez Théo — la gastronomie locale et l'hébergement authentique, en pleine nature, à deux pas du lac.</p>
        <div class="eh-feats">
          <div class="ef-item dark-i"><div class="ef-dot"><i data-lucide="utensils" class="lucide-icon"></i></div> Restaurant sur pilotis au-dessus du lac</div>
          <div class="ef-item dark-i"><div class="ef-dot"><i data-lucide="home" class="lucide-icon"></i></div> Chambres B&B dès 28€ / nuit</div>
          <div class="ef-item dark-i"><div class="ef-dot"><i data-lucide="house" class="lucide-icon"></i></div> Bungalows Standard et Deluxe</div>
          <div class="ef-item dark-i"><div class="ef-dot"><i data-lucide="leaf" class="lucide-icon"></i></div> Architecture traditionnelle béninoise</div>
        </div>
      </div>

    </div>

    {{-- Logements de l'hôtel --}}
    <div data-r="up">
      <div class="logements-title lt-light">Hébergements &amp; Services de l'Hôtel</div>
      <div class="logements-grid">

        <a href="{{ route('hebergements.index') }}" class="log-card light-card" style="text-decoration:none">
          <div class="lc-img">
            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=500" alt="Chambres B&B — Chez Théo Hôtel">
            <div class="lc-ov"></div>
          </div>
          <div class="lc-body">
            <div class="lc-name">Chambres B&B</div>
            <div class="lc-type">Hôtel · 2 pers · dès 28€</div>
          </div>
          <div class="lc-arrow">→</div>
        </a>

        <a href="{{ route('hebergements.index') }}" class="log-card light-card" style="text-decoration:none">
          <div class="lc-img">
            <img src="https://images.unsplash.com/photo-1595576508898-0ad5c879a061?w=500" alt="Bungalow Standard — Chez Théo Hôtel">
            <div class="lc-ov"></div>
          </div>
          <div class="lc-body">
            <div class="lc-name">Bungalow Standard</div>
            <div class="lc-type">Hôtel · 02 pers · dès 38€</div>
          </div>
          <div class="lc-arrow">→</div>
        </a>

        <a href="{{ route('hebergements.index') }}" class="log-card light-card" style="text-decoration:none">
          <div class="lc-img">
            <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=500" alt="Bungalow Deluxe — Chez Théo Hôtel">
            <div class="lc-ov"></div>
          </div>
          <div class="lc-body">
            <div class="lc-name">Bungalow Deluxe</div>
            <div class="lc-type">Hôtel · 02-03 pers · dès 74€</div>
          </div>
          <div class="lc-arrow">→</div>
        </a>

        <a href="{{ route('restaurant.index') }}" class="log-card light-card" style="text-decoration:none">
          <div class="lc-img">
            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=500" alt="Restaurant sur pilotis — Chez Théo Hôtel">
            <div class="lc-ov"></div>
          </div>
          <div class="lc-body">
            <div class="lc-name">Restaurant</div>
            <div class="lc-type">Sur pilotis · Vue lac · Cuisine locale</div>
          </div>
          <div class="lc-arrow">→</div>
        </a>

      </div>
    </div>

  </div>
</section>

{{-- ═══ CONNEXION CANOË ══════════════════════════════════════════ --}}
<div class="canoe-band">
  <div class="wrap">
    <div class="canoe-inner" data-r="up">
      <div class="ci-left">
        <span class="ci-icon-big"><i data-lucide="sailboat" class="lucide-icon"></i></span>
        <div class="ci-text">
          <h3>Reliés par Canoë</h3>
          <p>Nous offrons à nos clients des <strong style="color:#fff">transports en canoë</strong> pour accéder d'un espace à l'autre, en glissant sur les eaux du lac Ahémé. Les canoës sont <strong style="color:#fff">gratuits pour tous les clients</strong> de l'hôtel-restaurant.</p>
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:2rem;flex-wrap:wrap;justify-content:center">
        <div style="text-align:center">
          <span style="font-family:var(--f1);font-size:2.5rem;color:var(--teal);display:block;line-height:1">200 m</span>
          <span style="font-family:var(--f3);font-size:.6rem;font-weight:600;text-transform:uppercase;letter-spacing:.18em;color:rgb(255, 255, 255)">Entre les 2 espaces</span>
        </div>
        <div style="width:1px;height:40px;background:rgba(255, 255, 255, 0.1)"></div>
        <div style="text-align:center">
          <span style="font-family:var(--f1);font-size:2.5rem;color:var(--teal);display:block;line-height:1"><i data-lucide="gift" class="lucide-icon"></i></span>
          <span style="font-family:var(--f3);font-size:.6rem;font-weight:600;text-transform:uppercase;letter-spacing:.18em;color:rgb(255, 255, 255)">Canoë gratuit</span>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ═══ LE RESORT ════════════════════════════════════════════════ --}}
<section class="espace-section bg-dark">
  <div class="wrap">

    <div class="espace-header">

      <div class="eh-content" data-r="left">
        <div class="sec-lbl" style="color:var(--teal)">Espace 2</div>
        <h2 class="white-h">Le Resort</h2>
        <p class="white-p">Le Resort est la partie la plus exclusive de Chez Théo. C'est ici que se trouvent notre <strong style="color:rgba(255,255,255,.8)">piscine à débordement</strong> à moins de 10 mètres du lac Ahémé, ainsi que nos hébergements les plus haut de gamme — suites et bungalows supérieurs.</p>
        <p class="white-p">Le Resort abrite également notre <strong style="color:rgba(255,255,255,.8)">espace bien-être</strong> complet : bains thermaux, spa, massages et salle de sport face à la piscine.</p>
        <div class="eh-feats">
          <div class="ef-item white-i"><div class="ef-dot"><i data-lucide="waves" class="lucide-icon"></i></div> Piscine à débordement à 10m du lac</div>
          <div class="ef-item white-i"><div class="ef-dot"><i data-lucide="crown" class="lucide-icon"></i></div> Suites supérieures et standards</div>
          <div class="ef-item white-i"><div class="ef-dot"><i data-lucide="sparkles" class="lucide-icon"></i></div> Spa, massages et bains thermaux</div>
          <div class="ef-item white-i"><div class="ef-dot"><i data-lucide="dumbbell" class="lucide-icon"></i></div> Salle de sport vue sur le lac</div>
        </div>
      </div>

      <div class="eh-visual" data-r="right">
        <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=900" alt="Le Resort — Piscine à débordement Chez Théo Possotomé">
        <span class="eh-badge badge-resort"><i data-lucide="palmtree" class="lucide-icon"></i> Le Resort</span>
      </div>

    </div>

    {{-- Logements du resort --}}
    <div data-r="up">
      <div class="logements-title lt-dark">Hébergements &amp; Services du Resort</div>
      <div class="logements-grid">

        <a href="{{ route('hebergements.index') }}" class="log-card dark-card" style="text-decoration:none">
          <div class="lc-img">
            <img src="https://images.unsplash.com/photo-1631049552057-403cdb8f0658?w=500" alt="Suite Supérieure — Le Resort Chez Théo">
            <div class="lc-ov"></div>
          </div>
          <div class="lc-body">
            <div class="lc-name">Suite Supérieure</div>
            <div class="lc-type">Resort · 4-6 pers · dès 120€</div>
          </div>
          <div class="lc-arrow">→</div>
        </a>

        <a href="{{ route('hebergements.index') }}" class="log-card dark-card" style="text-decoration:none">
          <div class="lc-img">
            <img src="https://www.brp.ch/fileadmin/documents/brp.ch/images/chambres-suites/tuiles/superior_room_lake_view_1.jpg?w=500" alt="Suite Standard — Le Resort Chez Théo">
            <div class="lc-ov"></div>
          </div>
          <div class="lc-body">
            <div class="lc-name">Suite Standard</div>
            <div class="lc-type">Resort · 04 pers · dès 96€</div>
          </div>
          <div class="lc-arrow">→</div>
        </a>

        <a href="{{ route('hebergements.index') }}" class="log-card dark-card" style="text-decoration:none">
          <div class="lc-img">
            <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=500" alt="Bungalow Supérieur — Le Resort Chez Théo">
            <div class="lc-ov"></div>
          </div>
          <div class="lc-body">
            <div class="lc-name">Bungalow Supérieur</div>
            <div class="lc-type">Resort · 02 pers · dès 60€</div>
          </div>
          <div class="lc-arrow">→</div>
        </a>

        <a href="{{ route('bains.index') }}" class="svc-card" style="text-decoration:none">
          <div class="sc-img">
            <img src="https://naturellementluxe.com/wp-content/uploads/Copie-de-Le_Spa_Privatif-Naturellement_Luxe_Paris_FRK_302189_4_8.jpg?w=500" alt="Spa & Massage — Le Resort Chez Théo">
          </div>
          <div class="sc-body">
            <div class="sc-name">Spa & Massage</div>
            <div class="sc-tag">Bains thermaux · Soins · 15€</div>
          </div>
        </a>

        <a href="{{ route('sport.index') }}" class="svc-card" style="text-decoration:none">
          <div class="sc-img">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=500" alt="Salle de sport — Le Resort Chez Théo">
          </div>
          <div class="sc-body">
            <div class="sc-name">Salle de Sport</div>
            <div class="sc-tag">Vue lac · Gratuit clients · 8€ visiteurs</div>
          </div>
        </a>

        <a href="{{ route('bains.index') }}" class="svc-card" style="text-decoration:none">
          <div class="sc-img">
            <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=500" alt="Piscine thermale — Le Resort Chez Théo">
          </div>
          <div class="sc-body">
            <div class="sc-name">Piscine Thermale</div>
            <div class="sc-tag">40°C · À débordement · Vue lac</div>
          </div>
        </a>

      </div>
    </div>

  </div>
</section>

{{-- ═══ CTA ══════════════════════════════════════════════════════ --}}
<section class="cta-section">
  <div class="wrap">
    <div data-r="up">
      <h2 class="cta-title">Choisissez votre espace</h2>
      <p class="cta-sub">Hôtel ou Resort — les deux sont au bord du lac Ahémé avec vue imprenable.<br>Réservez votre hébergement ou contactez-nous pour vous aider à choisir.</p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('hebergements.index') }}" class="btn btn-w btn-lg">Voir tous les hébergements</a>
        <a href="{{ route('contact.index') }}" class="btn btn-lg" style="background:rgba(255,255,255,.2);color:#fff;border:1.5px solid rgba(255,255,255,.4)">
          Nous contacter
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
}, {threshold:.08});
document.querySelectorAll('[data-r]').forEach(el => obs.observe(el));
</script>
@endpush
