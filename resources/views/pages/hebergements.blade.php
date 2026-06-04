@extends('layouts.app')

@section('title', 'Hébergements Possotomé — Chez Théo les Bains')
@section('description', '6 types d\'hébergements au bord du lac Ahémé à Possotomé. Suite supérieure, bungalows, chambres B&B. Petit-déjeuner inclus. Dès 28€/nuit.')

@push('styles')
<style>
/* ── PAGE HERO ─────────────────────────────────────────────── */
.page-hero{position:relative;height:65vh;min-height:480px;display:flex;align-items:flex-end;overflow:hidden;background:var(--dark)}
.ph-bg{position:absolute;inset:0}
.ph-bg img{width:100%;height:100%;object-fit:cover}
.ph-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.92) 0%,rgba(8,19,30,.35) 60%,transparent 100%)}
.ph-body{position:relative;z-index:2;max-width:1300px;margin:0 auto;padding:0 2rem 4rem;width:100%}
.ph-title{font-family:var(--f1);font-size:clamp(2.5rem,6vw,5.5rem);font-weight:600;color:#fff;line-height:1.05;letter-spacing:-.03em;margin-bottom:.8rem}
.ph-sub{font-size:1.05rem;color:#fff;max-width:520px}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-family:var(--f3);font-size:.68rem;text-transform:uppercase;letter-spacing:.15em;color:#fff;margin-bottom:1rem}
.breadcrumb a{color:#fff;transition:.2s}
.breadcrumb a:hover{color:var(--teal)}
.breadcrumb span{color:var(--teal)}
.breadcrumb i{font-size:.5rem;opacity:.5}
.sec-lbl{display:inline-flex;align-items:center;gap:.8rem;font-family:var(--f3);font-size:.66rem;font-weight:700;text-transform:uppercase;letter-spacing:.32em;color:var(--teal);margin-bottom:1rem}
.sec-lbl::before{content:'';width:28px;height:1.5px;background:linear-gradient(90deg,var(--teal),var(--teal-light));flex-shrink:0}

/* ── COMMODITÉS BAND ───────────────────────────────────────── */
.commo-band{background:var(--dark2);border-bottom:1px solid rgba(110,193,228,.1);padding:1.8rem 0}
.commo-inner{display:flex;align-items:center;justify-content:center;flex-wrap:wrap;gap:2.5rem}
.commo-item{display:flex;align-items:center;gap:.65rem;font-family:var(--f3);font-size:.7rem;font-weight:600;text-transform:uppercase;letter-spacing:.14em;color:#fff}
.commo-item .ci{font-size:1.1rem}
.commo-sep{width:1px;height:20px;background:rgba(255,255,255,.1)}

/* ── TABS ──────────────────────────────────────────────────── */
.tabs-wrap{padding:3rem 0 0}
.tabs-nav{display:flex;align-items:center;gap:.5rem;padding-bottom:1.5rem;border-bottom:1px solid rgba(110,193,228,.12);margin-bottom:3.5rem;flex-wrap:wrap}
.tab-btn{font-family:var(--f3);font-size:.72rem;font-weight:600;text-transform:uppercase;letter-spacing:.15em;padding:.55rem 1.3rem;border-radius:999px;color:#fff;cursor:pointer;transition:.2s ease;border:1.5px solid transparent;background:none}
.tab-btn:hover{color:var(--teal);background:var(--teal-xlight)}
.tab-btn.active{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;border-color:transparent;box-shadow:0 4px 16px var(--teal-glow)}

/* ── ROOM CARDS ────────────────────────────────────────────── */
.rooms-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-bottom:5rem}
.rc{background:#fff;border-radius:24px;overflow:hidden;box-shadow:0 4px 20px rgba(110,193,228,.1);transition:all .45s var(--ease);cursor:pointer}
.rc:hover{transform:translateY(-14px);box-shadow:0 28px 60px rgba(13,27,42,.22),0 0 0 1px rgba(110,193,228,.15)}
.rc-img{position:relative;height:265px;overflow:hidden}
.rc-img img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.rc:hover .rc-img img{transform:scale(1.1)}
.rc-badge{position:absolute;top:1rem;left:1rem;font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.14em;padding:.3rem .8rem;border-radius:999px;background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 4px 14px var(--teal-glow)}
.rc-badge.resort{background:linear-gradient(135deg,#f5a623,#e8920a)}
.rc-location{position:absolute;top:1rem;right:1rem;font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;padding:.28rem .7rem;border-radius:999px;background:rgba(8,19,30,.7);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.8)}
.rc-reveal{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.85) 0%,transparent 55%);opacity:0;transition:.4s var(--ease);display:flex;align-items:flex-end;padding:1.4rem}
.rc:hover .rc-reveal{opacity:1}
.rc-body{padding:1.5rem 1.6rem 1.8rem}
.rc-name{font-family:var(--f1);font-size:1.5rem;font-weight:600;color:var(--dark);margin-bottom:.55rem;letter-spacing:-.01em}
.rc-meta{display:flex;flex-wrap:wrap;gap:.7rem;margin-bottom:.85rem}
.rc-m{display:flex;align-items:center;gap:.3rem;font-family:var(--f3);font-size:.65rem;font-weight:500;text-transform:uppercase;letter-spacing:.1em;color:#2d5a7a}
.rc-m [data-lucide]{width:12px;height:12px;stroke:#2d5a7a;stroke-width:2;flex-shrink:0}
.rc-price{display:flex;align-items:baseline;gap:.22rem;margin-bottom:.6rem}
.price-n{font-family:var(--f1);font-size:2.3rem;font-weight:700;color:var(--teal-dark);line-height:1}
.price-c{font-family:var(--f3);font-size:.88rem;font-weight:700;color:var(--teal-dark)}
.price-p{font-size:.78rem;color:#4a7a9b}
.price-alt{font-family:var(--f3);font-size:.7rem;color:#4a7a9b;margin-bottom:1rem}
.rc-tags{display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:1.1rem}
.rct{font-family:var(--f3);font-size:.6rem;font-weight:600;text-transform:uppercase;letter-spacing:.1em;padding:.26rem .68rem;border-radius:999px;background:var(--teal-xlight);color:var(--teal-dark);border:1px solid rgba(110,193,228,.28)}
.rc-foot{display:flex;align-items:center;justify-content:space-between;gap:.8rem}

/* ── DEUX ESPACES ──────────────────────────────────────────── */
.espaces-section{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 60%);padding:6rem 0}
.espaces-grid{display:grid;grid-template-columns:1fr 1fr;gap:2rem}
.espace-card{border-radius:28px;overflow:hidden;position:relative;min-height:420px;display:flex;flex-direction:column;justify-content:flex-end}
.espace-card img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.espace-card:hover img{transform:scale(1.05)}
.espace-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.92) 0%,rgba(8,19,30,.2) 60%,transparent 100%)}
.espace-body{position:relative;z-index:2;padding:2.5rem}
.espace-tag{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.28em;color:var(--teal);display:block;margin-bottom:.6rem}
.espace-title{font-family:var(--f1);font-size:2.2rem;font-weight:600;color:#fff;margin-bottom:.7rem;line-height:1.1}
.espace-desc{font-size:.88rem;color:#1a3a50;line-height:1.7;margin-bottom:1.2rem}
.espace-list{display:flex;flex-direction:column;gap:.35rem;margin-bottom:1.5rem}
.espace-li{display:flex;align-items:center;gap:.5rem;font-family:var(--f3);font-size:.67rem;font-weight:500;text-transform:uppercase;letter-spacing:.1em;color:#fff}
.espace-li::before{content:'';width:6px;height:6px;border-radius:50%;background:var(--teal);flex-shrink:0}

/* ── INCLUS SECTION ────────────────────────────────────────── */
.inclus-section{background:var(--dark);padding:5rem 0}
.inclus-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem}
.inclus-card{background:rgba(255,255,255,.03);border:1px solid rgba(110,193,228,.12);border-radius:22px;padding:2rem 1.5rem;text-align:center;transition:.4s var(--ease)}
.inclus-card:hover{background:rgba(110,193,228,.07);border-color:rgba(110,193,228,.28);transform:translateY(-6px)}
.inclus-ic{width:28px;height:28px;stroke:var(--teal);stroke-width:1.8;fill:none;margin-bottom:1.2rem;display:block}
.inclus-title{font-family:var(--f1);font-size:1.2rem;font-weight:600;color:#fff;margin-bottom:.5rem}
.inclus-desc{font-size:.82rem;color:#1a3a50;line-height:1.65}

/* ── CTA BOTTOM ────────────────────────────────────────────── */
.cta-section{background:linear-gradient(135deg,var(--teal-dark),var(--teal));padding:5rem 0;text-align:center}
.cta-title{font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);font-weight:600;color:#fff;margin-bottom:1rem}
.cta-sub{font-size:1rem;color:rgba(255,255,255,.75);margin-bottom:2.5rem}

/* ── UTILS ─────────────────────────────────────────────────── */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;font-family:var(--f3);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.9rem 2.2rem;border-radius:999px;transition:all .4s var(--spring);cursor:pointer;border:none;white-space:nowrap}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 6px 26px var(--teal-glow)}
.btn-p:hover{transform:translateY(-3px) scale(1.03);box-shadow:0 12px 42px var(--teal-glow);color:#fff}
.btn-gl{background:rgba(255,255,255,.16);backdrop-filter:blur(22px);border:1px solid rgba(255,255,255,.18);color:#fff}
.btn-gl:hover{background:rgba(255,255,255,.22);transform:translateY(-2px);color:#fff}
.btn-dk{background:var(--dark);color:#fff;box-shadow:0 4px 16px rgba(0,0,0,.3)}
.btn-dk:hover{background:var(--dark3);transform:translateY(-3px);color:#fff}
.btn-w{background:#fff;color:var(--teal-dark);}
.btn-w:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(0,0,0,.2);color:var(--teal-dark)}
.btn-sm{padding:.55rem 1.3rem;font-size:.67rem}
.btn-lg{padding:1.1rem 2.8rem;font-size:.82rem}
.wrap{max-width:1300px;margin:0 auto;padding:0 2rem}
.tc{text-align:center}
.mb4{margin-bottom:2rem}.mb8{margin-bottom:4rem}
[data-r]{opacity:0;transition:opacity .8s var(--ease),transform .8s var(--ease)}
[data-r="up"]{transform:translateY(50px)}
[data-r="left"]{transform:translateX(-50px)}
[data-r="right"]{transform:translateX(50px)}
[data-r="scale"]{transform:scale(.88)}
[data-r].in{opacity:1;transform:none}
[data-d="1"]{transition-delay:.1s}[data-d="2"]{transition-delay:.2s}[data-d="3"]{transition-delay:.3s}[data-d="4"]{transition-delay:.4s}[data-d="5"]{transition-delay:.5s}[data-d="6"]{transition-delay:.6s}

@media(max-width:1024px){.rooms-grid{grid-template-columns:repeat(2,1fr)}.espaces-grid{grid-template-columns:1fr}.inclus-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:768px){.rooms-grid{grid-template-columns:1fr}.inclus-grid{grid-template-columns:repeat(2,1fr)}.commo-inner{gap:1.5rem}.commo-sep{display:none}}
@media(max-width:480px){.inclus-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

{{-- ═══ PAGE HERO ═══════════════════════════════════════════════ --}}
<div class="page-hero">
  <div class="ph-bg">
    <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?w=1920" alt="Hébergements Chez Théo les Bains — Possotomé">
  </div>
  <div class="ph-ov"></div>
  <div class="ph-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Accueil</a>
      <i>›</i>
      <span>Hébergements</span>
    </div>
    <div class="sec-lbl">Nos chambres & suites</div>
    <h1 class="ph-title">Hébergements</h1>
    <p class="ph-sub">Du confort authentique à la suite premium avec vue sur le lac Ahémé. 6 types d'hébergements répartis sur deux espaces.</p>
  </div>
</div>

{{-- ═══ COMMODITÉS BAND ═════════════════════════════════════════ --}}
<div class="commo-band">
  <div class="commo-inner">
    <div class="commo-item"><span class="ci"><i data-lucide="bath" class="lucide-icon"></i></span> SDB & toilettes privées</div>
    <div class="commo-sep"></div>
    <div class="commo-item"><span class="ci"><i data-lucide="coffee" class="lucide-icon"></i></span> Petit-déjeuner inclus</div>
    <div class="commo-sep"></div>
    <div class="commo-item"><span class="ci"><i data-lucide="banknote" class="lucide-icon"></i></span> Taxes incluses</div>
    <div class="commo-sep"></div>
    <div class="commo-item"><span class="ci"><i data-lucide="waves" class="lucide-icon"></i></span> Abords du lac Ahémé</div>
    <div class="commo-sep"></div>
    <div class="commo-item"><span class="ci"><i data-lucide="users" class="lucide-icon"></i></span> 2 à 6 personnes</div>
    <div class="commo-sep"></div>
    <div class="commo-item"><span class="ci"><i data-lucide="building-2" class="lucide-icon"></i></span> 2 espaces à 200m</div>
  </div>
</div>

{{-- ═══ GRILLE HÉBERGEMENTS ══════════════════════════════════════ --}}
<section style="background:#fafcfe;padding:4rem 0 2rem">
  <div class="wrap">

    {{-- Tabs filtre --}}
    <div class="tabs-wrap">
      <div class="tabs-nav">
        <button class="tab-btn active" data-filter="all">Tous</button>
        <button class="tab-btn" data-filter="resort">Resort</button>
        <button class="tab-btn" data-filter="hotel">Hôtel</button>
      </div>
    </div>

    <div class="rooms-grid">

      {{-- 1 · Suite supérieure --}}
      <div class="rc" data-r="up" data-d="1" data-type="resort">
        <div class="rc-img">
          <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800" alt="Suite supérieure — Chez Théo Resort">
          <div class="rc-badge resort">Suite supérieure</div>
          <div class="rc-location">Resort</div>
          <div class="rc-reveal">
            <a href="{{ route('contact.index') }}" class="btn btn-gl btn-sm">Réserver →</a>
          </div>
        </div>
        <div class="rc-body">
          <h2 class="rc-name">Suite supérieure</h2>
          <div class="rc-meta">
            <span class="rc-m"><i data-lucide="users"></i> 4–6 personnes</span>
            <span class="rc-m"><i data-lucide="trees"></i> Resort</span>
          </div>
          <div class="rc-price">
            <span class="price-n">120</span>
            <span class="price-c">€</span>
            <span class="price-p">&nbsp;/ nuit</span>
          </div>
          <div class="price-alt">~ 78 000 FCFA / nuit</div>
          <div class="rc-tags">
            <span class="rct">Terrasse privée</span>
            <span class="rct">Vue lac</span>
            <span class="rct">Spa</span>
            <span class="rct">Salon</span>
          </div>
          <div class="rc-foot">
            <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm">Réserver</a>
            <a href="{{ route('hebergements.show', 'suite-superieure') }}" class="btn btn-dk btn-sm">Détails</a>
          </div>
        </div>
      </div>

      {{-- 2 · Suite standard --}}
      <div class="rc" data-r="up" data-d="2" data-type="resort">
        <div class="rc-img">
          <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800" alt="Suite standard — Chez Théo Resort">
          <div class="rc-badge resort">Suite standard</div>
          <div class="rc-location">Resort</div>
          <div class="rc-reveal">
            <a href="{{ route('contact.index') }}" class="btn btn-gl btn-sm">Réserver →</a>
          </div>
        </div>
        <div class="rc-body">
          <h2 class="rc-name">Suite standard</h2>
          <div class="rc-meta">
            <span class="rc-m"><i data-lucide="users"></i> 4 personnes</span>
            <span class="rc-m"><i data-lucide="trees"></i> Resort</span>
          </div>
          <div class="rc-price">
            <span class="price-n">96</span>
            <span class="price-c">€</span>
            <span class="price-p">&nbsp;/ nuit</span>
          </div>
          <div class="price-alt">~ 63 000 FCFA / nuit</div>
          <div class="rc-tags">
            <span class="rct">Terrasse</span>
            <span class="rct">Clim</span>
            <span class="rct">Vue jardin</span>
          </div>
          <div class="rc-foot">
            <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm">Réserver</a>
            <a href="{{ route('hebergements.show', 'suite-standard') }}" class="btn btn-dk btn-sm">Détails</a>
          </div>
        </div>
      </div>

      {{-- 3 · Bungalow Deluxe --}}
      <div class="rc" data-r="up" data-d="3" data-type="hotel">
        <div class="rc-img">
          <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?w=800" alt="Bungalow Deluxe — Chez Théo Hôtel">
          <div class="rc-badge">Bungalow Deluxe</div>
          <div class="rc-location">Hôtel</div>
          <div class="rc-reveal">
            <a href="{{ route('contact.index') }}" class="btn btn-gl btn-sm">Réserver →</a>
          </div>
        </div>
        <div class="rc-body">
          <h2 class="rc-name">Bungalow Deluxe</h2>
          <div class="rc-meta">
            <span class="rc-m"><i data-lucide="users"></i> 2–3 personnes</span>
            <span class="rc-m"><i data-lucide="building-2" class="lucide-icon"></i> Hôtel</span>
          </div>
          <div class="rc-price">
            <span class="price-n">74</span>
            <span class="price-c">€</span>
            <span class="price-p">&nbsp;/ nuit</span>
          </div>
          <div class="price-alt">~ 48 000 FCFA / nuit</div>
          <div class="rc-tags">
            <span class="rct">Terrasse</span>
            <span class="rct">Clim</span>
            <span class="rct">SDB privée</span>
          </div>
          <div class="rc-foot">
            <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm">Réserver</a>
            <a href="{{ route('hebergements.show', 'bungalow-deluxe') }}" class="btn btn-dk btn-sm">Détails</a>
          </div>
        </div>
      </div>

      {{-- 4 · Bungalow supérieur --}}
      <div class="rc" data-r="up" data-d="4" data-type="resort">
        <div class="rc-img">
          <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=800" alt="Bungalow supérieur — Chez Théo Resort">
          <div class="rc-badge resort">Bungalow supérieur</div>
          <div class="rc-location">Resort</div>
          <div class="rc-reveal">
            <a href="{{ route('contact.index') }}" class="btn btn-gl btn-sm">Réserver →</a>
          </div>
        </div>
        <div class="rc-body">
          <h2 class="rc-name">Bungalow supérieur</h2>
          <div class="rc-meta">
            <span class="rc-m"><i data-lucide="users"></i> 2 personnes</span>
            <span class="rc-m"><i data-lucide="trees"></i> Resort</span>
          </div>
          <div class="rc-price">
            <span class="price-n">60</span>
            <span class="price-c">€</span>
            <span class="price-p">&nbsp;/ nuit</span>
          </div>
          <div class="price-alt">~ 39 000 FCFA / nuit</div>
          <div class="rc-tags">
            <span class="rct">Vue lac</span>
            <span class="rct">Clim</span>
            <span class="rct">Terrasse</span>
          </div>
          <div class="rc-foot">
            <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm">Réserver</a>
            <a href="{{ route('hebergements.show', 'bungalow-superieur') }}" class="btn btn-dk btn-sm">Détails</a>
          </div>
        </div>
      </div>

      {{-- 5 · Bungalow standard --}}
      <div class="rc" data-r="up" data-d="5" data-type="hotel">
        <div class="rc-img">
          <img src="https://images.unsplash.com/photo-1595576508898-0ad5c879a061?w=800" alt="Bungalow standard — Chez Théo Hôtel">
          <div class="rc-badge">Bungalow standard</div>
          <div class="rc-location">Hôtel</div>
          <div class="rc-reveal">
            <a href="{{ route('contact.index') }}" class="btn btn-gl btn-sm">Réserver →</a>
          </div>
        </div>
        <div class="rc-body">
          <h2 class="rc-name">Bungalow standard</h2>
          <div class="rc-meta">
            <span class="rc-m"><i data-lucide="users"></i> 2 personnes</span>
            <span class="rc-m"><i data-lucide="building-2" class="lucide-icon"></i> Hôtel</span>
          </div>
          <div class="rc-price">
            <span class="price-n">38</span>
            <span class="price-c">€</span>
            <span class="price-p">&nbsp;/ nuit</span>
          </div>
          <div class="price-alt">~ 25 000 FCFA / nuit</div>
          <div class="rc-tags">
            <span class="rct">Clim</span>
            <span class="rct">WiFi</span>
            <span class="rct">SDB privée</span>
          </div>
          <div class="rc-foot">
            <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm">Réserver</a>
            <a href="{{ route('hebergements.show', 'bungalow-standard') }}" class="btn btn-dk btn-sm">Détails</a>
          </div>
        </div>
      </div>

      {{-- 6 · Chambres B&B --}}
      <div class="rc" data-r="up" data-d="6" data-type="hotel">
        <div class="rc-img">
          <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800" alt="Chambres B&B — Chez Théo Hôtel">
          <div class="rc-badge">Populaire</div>
          <div class="rc-location">Hôtel</div>
          <div class="rc-reveal">
            <a href="{{ route('contact.index') }}" class="btn btn-gl btn-sm">Réserver →</a>
          </div>
        </div>
        <div class="rc-body">
          <h2 class="rc-name">Chambres B&amp;B</h2>
          <div class="rc-meta">
            <span class="rc-m"><i data-lucide="users"></i> 2 personnes</span>
            <span class="rc-m"><i data-lucide="building-2" class="lucide-icon"></i> Hôtel</span>
            <span class="rc-m"><i data-lucide="leaf" class="lucide-icon"></i> Cour fleurie</span>
          </div>
          <div class="rc-price">
            <span class="price-n">28</span>
            <span class="price-c">€</span>
            <span class="price-p">&nbsp;/ nuit</span>
          </div>
          <div class="price-alt">~ 18 000 FCFA / nuit</div>
          <div class="rc-tags">
            <span class="rct">Lit King size</span>
            <span class="rct">Clim</span>
            <span class="rct">50m du lac</span>
          </div>
          <div class="rc-foot">
            <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm">Réserver</a>
            <a href="{{ route('hebergements.show', 'chambres-bb') }}" class="btn btn-dk btn-sm">Détails</a>
          </div>
        </div>
      </div>

    </div>{{-- /rooms-grid --}}
  </div>
</section>

{{-- ═══ LES DEUX ESPACES ════════════════════════════════════════ --}}
<section class="espaces-section">
  <div class="wrap">
    <div class="tc mb8" data-r="up">
      <div class="sec-lbl" style="justify-content:center">Organisation des espaces</div>
      <h2 style="font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);letter-spacing:-.025em;line-height:1.1;color:var(--dark)">Deux Espaces,<br>Une Même Âme</h2>
      <p style="font-size:1rem;color:#1a3a50;max-width:520px;margin:1rem auto 0;line-height:1.8">L'hôtel et le resort sont situés à seulement <strong>200 mètres</strong> l'un de l'autre, tous deux aux abords du lac Ahémé.</p>
    </div>
    <div class="espaces-grid">

      <div class="espace-card" data-r="left">
        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=900" alt="Le Resort — Chez Théo les Bains">
        <div class="espace-ov"></div>
        <div class="espace-body">
          <span class="espace-tag">Espace premium</span>
          <div class="espace-title">Le Resort</div>
          <p class="espace-desc">Un cadre naturel d'exception directement au bord du lac. Nos hébergements les plus premium avec vues panoramiques et équipements haut de gamme.</p>
          <ul class="espace-list">
            <li class="espace-li">Suite supérieure — dès 120€</li>
            <li class="espace-li">Suite standard — dès 96€</li>
            <li class="espace-li">Bungalow supérieur — dès 60€</li>
          </ul>
          <a href="{{ route('contact.index') }}" class="btn btn-gl btn-sm">Réserver au Resort</a>
        </div>
      </div>

      <div class="espace-card" data-r="right">
        <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=900" alt="L'Hôtel — Chez Théo les Bains">
        <div class="espace-ov"></div>
        <div class="espace-body">
          <span class="espace-tag">Espace classique</span>
          <div class="espace-title">L'Hôtel</div>
          <p class="espace-desc">À 50m du lac, dans un cadre verdoyant avec cour fleurie. Le meilleur rapport qualité-prix pour découvrir Possotomé et ses bains thermaux.</p>
          <ul class="espace-list">
            <li class="espace-li">Bungalow Deluxe — dès 74€</li>
            <li class="espace-li">Bungalow standard — dès 38€</li>
            <li class="espace-li">Chambres B&amp;B — dès 28€</li>
          </ul>
          <a href="{{ route('contact.index') }}" class="btn btn-gl btn-sm">Réserver à l'Hôtel</a>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ INCLUS DANS TOUS LES HÉBERGEMENTS ══════════════════════ --}}
<section class="inclus-section">
  <div class="wrap">
    <div class="tc mb8" data-r="up">
      <div class="sec-lbl" style="justify-content:center;color:var(--teal)">Compris dans le prix</div>
      <h2 style="font-family:var(--f1);font-size:clamp(2rem,4vw,3rem);color:#fff;letter-spacing:-.025em;line-height:1.1">Tout est inclus</h2>
    </div>
    <div class="inclus-grid">
      <div class="inclus-card" data-r="scale" data-d="1">
        <i data-lucide="coffee" class="inclus-ic"></i>
        <div class="inclus-title">Petit-déjeuner</div>
        <p class="inclus-desc">Offert chaque matin pour tous les hébergements. Fruits frais, jus d'ananas pressé, confiture et miel local.</p>
      </div>
      <div class="inclus-card" data-r="scale" data-d="2">
        <span class="inclus-ic"><i data-lucide="bath" class="lucide-icon"></i></span>
        <div class="inclus-title">SDB privée</div>
        <p class="inclus-desc">Chaque hébergement dispose de sa salle de bain et toilettes privées, entièrement équipées.</p>
      </div>
      <div class="inclus-card" data-r="scale" data-d="3">
        <span class="inclus-ic"><i data-lucide="banknote" class="lucide-icon"></i></span>
        <div class="inclus-title">Taxes incluses</div>
        <p class="inclus-desc">Les taxes de nuitées sont intégralement incluses dans les prix affichés. Aucune surprise à l'arrivée.</p>
      </div>
      <div class="inclus-card" data-r="scale" data-d="4">
        <span class="inclus-ic"><i data-lucide="waves" class="lucide-icon"></i></span>
        <div class="inclus-title">Accès au lac</div>
        <p class="inclus-desc">Tous nos hébergements sont situés aux abords du lac Ahémé pour un cadre naturel idyllique.</p>
      </div>
    </div>
  </div>
</section>

{{-- ═══ CTA RÉSERVATION ══════════════════════════════════════════ --}}
<section class="cta-section">
  <div class="wrap">
    <div data-r="up">
      <h2 class="cta-title">Prêt à réserver votre séjour ?</h2>
      <p class="cta-sub">Contactez-nous directement par email ou WhatsApp pour vérifier les disponibilités et réserver votre hébergement.</p>
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
// Scroll reveal
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('in'); });
}, {threshold:.1});
document.querySelectorAll('[data-r]').forEach(el => obs.observe(el));

// Tabs filtre
document.querySelectorAll('.tab-btn').forEach(btn => {
  btn.addEventListener('click', function(){
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
    const filter = this.dataset.filter;
    document.querySelectorAll('.rc').forEach(card => {
      if(filter === 'all' || card.dataset.type === filter){
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  });
});
</script>
@endpush
