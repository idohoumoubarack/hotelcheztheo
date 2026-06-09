@extends('layouts.app')

@section('title', 'Excursions Bénin — Circuit 7 Jours & Excursions Locales | Chez Théo les Bains')
@section('description', '12 excursions autour de Possotomé + circuit Bénin 7 jours en pension complète à 1 050€/personne. Ouidah, Abomey UNESCO, Grand-Popo, Porto-Novo avec guides locaux.')

@push('styles')
<style>
/* ── UTILITAIRES ───────────────────────────────────────────── */
.wrap{max-width:1300px;margin:0 auto;padding:0 2rem}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;font-family:var(--f3);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.9rem 2.2rem;border-radius:999px;transition:all .4s var(--spring);cursor:pointer;border:none;white-space:nowrap}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 6px 26px var(--teal-glow)}
.btn-p:hover{transform:translateY(-3px) scale(1.03);box-shadow:0 12px 42px var(--teal-glow);color:#fff}
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
[data-d="1"]{transition-delay:.1s}[data-d="2"]{transition-delay:.2s}[data-d="3"]{transition-delay:.3s}
[data-d="4"]{transition-delay:.4s}[data-d="5"]{transition-delay:.5s}[data-d="6"]{transition-delay:.6s}

/* ── PAGE HERO ─────────────────────────────────────────────── */
.page-hero{position:relative;height:70vh;min-height:500px;display:flex;align-items:flex-end;overflow:hidden;background:var(--dark)}
.ph-bg{position:absolute;inset:0}
.ph-bg img{width:100%;height:100%;object-fit:cover}
.ph-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.95) 0%,rgba(8,19,30,.4) 55%,transparent 100%)}
.ph-body{position:relative;z-index:2;max-width:1300px;margin:0 auto;padding:0 2rem 5rem;width:100%}
.ph-title{font-family:var(--f1);font-size:clamp(2.5rem,6vw,5.5rem);font-weight:600;color:#fff;line-height:1.05;letter-spacing:-.03em;margin-bottom:.8rem}
.ph-sub{font-size:1.05rem;color:#fff;max-width:600px;line-height:1.75}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-family:var(--f3);font-size:.68rem;text-transform:uppercase;letter-spacing:.15em;color:#fff;margin-bottom:1rem}
.breadcrumb a{color:#fff;transition:.2s}
.breadcrumb a:hover{color:var(--teal)}
.breadcrumb span{color:var(--teal)}
.breadcrumb i{font-size:.5rem;opacity:.5}
.ph-stats{display:flex;gap:2.5rem;margin-top:2rem;flex-wrap:wrap}
.ph-stat{display:flex;flex-direction:column;gap:.2rem}
.ps-val{font-family:var(--f1);font-size:2rem;font-weight:700;color:var(--teal);line-height:1}
.ps-lbl{font-family:var(--f3);font-size:.62rem;font-weight:600;text-transform:uppercase;letter-spacing:.18em;color:#fff}

/* ── EXCURSIONS LOCALES GRID ───────────────────────────────── */
.locales-section{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 50%);padding:7rem 0}
.exc-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.4rem;margin-top:4rem}
.exc-card{background:#fff;border-radius:22px;overflow:hidden;box-shadow:0 4px 20px rgba(13,27,42,.08);transition:all .4s var(--ease);border:1px solid rgba(110,193,228,.12)}
.exc-card:hover{transform:translateY(-10px);box-shadow:0 24px 56px rgba(13,27,42,.16),0 0 0 1px rgba(110,193,228,.2)}
.exc-img{height:200px;overflow:hidden;position:relative}
.exc-img img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.exc-card:hover .exc-img img{transform:scale(1.08)}
.exc-img-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.5) 0%,transparent 55%)}
.exc-dur{position:absolute;bottom:.8rem;left:.9rem;font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;color:#fff;background:rgba(8,19,30,.7);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.15);padding:.28rem .75rem;border-radius:999px}
.exc-loc-tag{position:absolute;top:.8rem;right:.8rem;font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;padding:.25rem .7rem;border-radius:999px;background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff}
.exc-body{padding:1.4rem 1.5rem 1.6rem}
.exc-name{font-family:var(--f1);font-size:1.25rem;font-weight:600;color:var(--dark);margin-bottom:.4rem;line-height:1.2}
.exc-place{font-family:var(--f3);font-size:.65rem;font-weight:600;text-transform:uppercase;letter-spacing:.14em;color:var(--teal-dark);margin-bottom:.7rem}
.exc-desc{font-size:.85rem;color:#1a3a50;line-height:1.7}

/* ── LISTE COMPLÈTE ────────────────────────────────────────── */
.liste-section{background:var(--dark);padding:6rem 0}
.liste-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.7rem;margin-top:3rem}
.li-item{display:flex;align-items:center;justify-content:space-between;gap:1rem;padding:.9rem 1.2rem;border-radius:14px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);transition:.25s ease}
.li-item:hover{background:rgba(110,193,228,.07);border-color:rgba(110,193,228,.2)}
.li-left{display:flex;align-items:center;gap:.75rem}
.li-dot{width:8px;height:8px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));flex-shrink:0}
.li-name{font-family:var(--f1);font-size:1rem;color:#ffffff;line-height:1.2}
.li-place{font-family:var(--f3);font-size:.6rem;font-weight:600;text-transform:uppercase;letter-spacing:.13em;color:rgba(255,255,255,.35);margin-top:.15rem}
.li-dur{font-family:var(--f3);font-size:.62rem;font-weight:600;text-transform:uppercase;letter-spacing:.13em;color:var(--teal);white-space:nowrap;flex-shrink:0;background:rgba(110,193,228,.1);padding:.25rem .7rem;border-radius:999px;border:1px solid rgba(110,193,228,.18)}

/* ── CIRCUIT 7 JOURS ─────────────────────────────────────────*/
.circuit-section{background:#fff;padding:7rem 0}

/* ── PRIX CARD (remplace le hero image trop grand) ─────────── */
.circuit-header{display:grid;grid-template-columns:1fr auto;gap:3rem;align-items:start;background:var(--dark);border-radius:28px;padding:3rem 3.5rem;margin-bottom:4rem;border:1px solid rgba(110,193,228,.15)}
.ch-title{font-family:var(--f1);font-size:clamp(2rem,4vw,3.2rem);color:#fff;letter-spacing:-.025em;line-height:1.05;margin-bottom:.8rem}
.ch-desc{font-size:.97rem;color:#ffffff;line-height:1.75;max-width:580px;margin-bottom:1.2rem}
.ch-tags{display:flex;flex-wrap:wrap;gap:.5rem}
.ch-tag{font-family:var(--f3);font-size:.62rem;font-weight:600;text-transform:uppercase;letter-spacing:.14em;padding:.32rem .85rem;border-radius:999px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:#fff}
.ch-price-box{background:rgba(110,193,228,.08);border:1px solid rgba(110,193,228,.28);border-radius:22px;padding:2rem 2.2rem;text-align:center;min-width:200px;flex-shrink:0}
.cp-from{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;color:#fff;display:block;margin-bottom:.4rem}
.cp-val{font-family:var(--f1);font-size:3rem;font-weight:700;color:var(--teal);line-height:1;display:block}
.cp-cur{font-family:var(--f3);font-size:.9rem;font-weight:700;color:var(--teal)}
.cp-pp{font-family:var(--f3);font-size:.65rem;color:#fff;display:block;margin-top:.3rem}
.cp-alt{font-family:var(--f3);font-size:.82rem;font-weight:600;color:#fff;display:block;margin-top:.5rem}
.cp-note{font-family:var(--f3);font-size:.6rem;color:rgba(255,255,255,.3);display:block;margin-top:.5rem;line-height:1.55}

/* ── INCLUS CIRCUIT ────────────────────────────────────────── */
.inclus-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:5rem}
.inc-card{background:var(--teal-xlight);border:1px solid rgba(110,193,228,.25);border-radius:18px;padding:1.5rem;text-align:center;transition:.3s var(--ease)}
.inc-card:hover{transform:translateY(-4px);box-shadow:0 12px 30px rgba(110,193,228,.18)}
.inc-ic{font-size:1.8rem;display:block;margin-bottom:.6rem}
.inc-title{font-family:var(--f3);font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;color:var(--teal-dark);display:block;margin-bottom:.3rem}
.inc-desc{font-size:.8rem;color:#1a3a50;line-height:1.6}

/* ── TIMELINE ──────────────────────────────────────────────── */
.timeline-wrap{background:var(--dark);border-radius:28px;padding:3.5rem}
.timeline{position:relative;padding-left:3rem}
.timeline::before{content:'';position:absolute;left:.9rem;top:0;bottom:0;width:2px;background:linear-gradient(to bottom,var(--teal),rgba(110,193,228,.15))}
.tl-day{position:relative;margin-bottom:1.8rem}
.tl-day:last-child{margin-bottom:0}
.tl-marker{position:absolute;left:-2.1rem;top:.5rem;width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;font-family:var(--f3);font-size:.62rem;font-weight:800;color:#fff;box-shadow:0 4px 12px var(--teal-glow);z-index:2}
.tl-card{background:rgba(255,255,255,.04);border:1px solid rgba(110,193,228,.12);border-radius:20px;padding:1.6rem 1.8rem}
.tl-day-label{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;color:var(--teal);display:block;margin-bottom:.4rem}
.tl-route{font-family:var(--f1);font-size:1.3rem;font-weight:600;color:#fff;line-height:1.2;margin-bottom:1rem}
.tl-activities{display:flex;flex-direction:column;gap:.45rem}
.tl-act{display:flex;align-items:flex-start;gap:.6rem;font-size:.88rem;color:#ffffff;line-height:1.6}
.tl-act::before{content:'→';color:var(--teal);font-size:.75rem;margin-top:.15rem;flex-shrink:0}

/* ── CTA ───────────────────────────────────────────────────── */
.cta-section{background:linear-gradient(135deg,var(--teal-dark),var(--teal));padding:5.5rem 0;text-align:center}
.cta-title{font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);font-weight:600;color:#fff;margin-bottom:1rem}
.cta-sub{font-size:1rem;color:rgba(255,255,255,.78);margin-bottom:2.5rem;line-height:1.75}

/* ── RESPONSIVE ────────────────────────────────────────────── */
@media(max-width:1100px){.exc-grid{grid-template-columns:repeat(2,1fr)}.inclus-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:1024px){.circuit-header{grid-template-columns:1fr;gap:2rem}}
@media(max-width:768px){
  .exc-grid{grid-template-columns:1fr}
  .liste-grid{grid-template-columns:1fr}
  .timeline{padding-left:2.2rem}
  .timeline-wrap{padding:2rem}
  .ph-stats{gap:1.5rem}
}
@media(max-width:480px){.inclus-grid{grid-template-columns:1fr 1fr}}
</style>
@endpush

@section('content')

{{-- ═══ PAGE HERO ═══════════════════════════════════════════════ --}}
<div class="page-hero">
  <div class="ph-bg">
    <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=1920" alt="Excursions Bénin — Chez Théo les Bains Possotomé">
  </div>
  <div class="ph-ov"></div>
  <div class="ph-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Accueil</a>
      <i>›</i>
      <a href="#">Services annexes</a>
      <i>›</i>
      <span>Excursions</span>
    </div>
    <div class="sec-lbl">Découverte & Aventure</div>
    <h1 class="ph-title">Les Excursions</h1>
    <p class="ph-sub">Explorez le Bénin avec nos guides locaux — du canoë sur le lac Ahémé aux palais royaux d'Abomey, de la Route des Esclaves d'Ouidah aux lagunes de Grand-Popo.</p>
    <div class="ph-stats">
      <div class="ph-stat"><span class="ps-val">12</span><span class="ps-lbl">Excursions locales</span></div>
      <div class="ph-stat"><span class="ps-val">07</span><span class="ps-lbl">Jours de circuit</span></div>
      <div class="ph-stat"><span class="ps-val">04</span><span class="ps-lbl">Villes emblématiques</span></div>
    </div>
  </div>
</div>

{{-- ═══ 6 EXCURSIONS PHARES ═════════════════════════════════════ --}}
<section class="locales-section">
  <div class="wrap">
    <div class="tc" data-r="up">
      <div class="sec-lbl" style="justify-content:center">Autour de Possotomé</div>
      <h2 style="font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);color:var(--dark);letter-spacing:-.025em;line-height:1.1">Excursions à la Journée</h2>
      <p style="font-size:1rem;color:#1a3a50;max-width:540px;margin:1rem auto 0;line-height:1.8">Plusieurs excursions organisées au départ de Possotomé pour découvrir le patrimoine culturel et naturel du département du Mono.</p>
    </div>
    <div class="exc-grid">
      <a href="{{ route('excursions.show', 'canoe-lac-aheme') }}" class="exc-card" data-r="up" data-d="1" style="text-decoration:none;display:block">
        <div class="exc-img">
          <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=700" alt="Canoë lac Ahémé">
          <div class="exc-img-ov"></div>
          <span class="exc-dur"><i data-lucide="clock" class="lucide-icon"></i> 3 heures</span>
          <span class="exc-loc-tag">Possotomé</span>
        </div>
        <div class="exc-body">
          <div class="exc-name">Canoë sur le lac Ahémé</div>
          <div class="exc-place"><i data-lucide="map-pin" class="lucide-icon"></i> Possotomé</div>
          <p class="exc-desc">Pagayez sur les eaux du lac, rencontrez les pêcheurs locaux et admirez les reflets du soleil sur le lac.</p>
        </div>
      </a>
      <a href="{{ route('excursions.show', 'source-thermale') }}" class="exc-card" data-r="up" data-d="2" style="text-decoration:none;display:block">
        <div class="exc-img">
          <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=700" alt="Source thermale Possotomé">
          <div class="exc-img-ov"></div>
          <span class="exc-dur"><i data-lucide="clock" class="lucide-icon"></i> 1 heure</span>
          <span class="exc-loc-tag">Possotomé</span>
        </div>
        <div class="exc-body">
          <div class="exc-name">Source Thermale</div>
          <div class="exc-place"><i data-lucide="map-pin" class="lucide-icon"></i> Possotomé</div>
          <p class="exc-desc">Découvrez l'origine de l'eau thermale naturelle de Possotomé, jaillissant à 40°C depuis des sources ancestrales.</p>
        </div>
      </a>
      <a href="{{ route('excursions.show', 'marche-poterie') }}" class="exc-card" data-r="up" data-d="3" style="text-decoration:none;display:block">
        <div class="exc-img">
          <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=700" alt="Marché poterie Sé">
          <div class="exc-img-ov"></div>
          <span class="exc-dur"><i data-lucide="clock" class="lucide-icon"></i> ½ journée</span>
          <span class="exc-loc-tag">Sé</span>
        </div>
        <div class="exc-body">
          <div class="exc-name">Marché International de Poterie</div>
          <div class="exc-place"><i data-lucide="map-pin" class="lucide-icon"></i> Sé</div>
          <p class="exc-desc">L'un des plus grands marchés de poterie du Bénin. Artisans, céramiques et ambiance de marché africain authentique.</p>
        </div>
      </a>
      <a href="{{ route('excursions.show', 'palais-royal-doutou') }}" class="exc-card" data-r="up" data-d="4" style="text-decoration:none;display:block">
        <div class="exc-img">
          <img src="https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=700" alt="Palais Royal Doutou">
          <div class="exc-img-ov"></div>
          <span class="exc-dur"><i data-lucide="clock" class="lucide-icon"></i> 1 heure</span>
          <span class="exc-loc-tag">Doutou</span>
        </div>
        <div class="exc-body">
          <div class="exc-name">Palais Royal</div>
          <div class="exc-place"><i data-lucide="map-pin" class="lucide-icon"></i> Doutou</div>
          <p class="exc-desc">Visite du Palais Royal, témoin de l'histoire du royaume du Dahomey et de ses traditions royales ancestrales.</p>
        </div>
      </a>
      <a href="{{ route('excursions.show', 'temple-pythons') }}" class="exc-card" data-r="up" data-d="5" style="text-decoration:none;display:block">
        <div class="exc-img">
          <img src="https://images.unsplash.com/photo-1520209759809-a9bcb6cb3241?w=700" alt="Temple des pythons Ouidah">
          <div class="exc-img-ov"></div>
          <span class="exc-dur"><i data-lucide="clock" class="lucide-icon"></i> 1 heure</span>
          <span class="exc-loc-tag">Ouidah</span>
        </div>
        <div class="exc-body">
          <div class="exc-name">Temple des Pythons & Route des Esclaves</div>
          <div class="exc-place"><i data-lucide="map-pin" class="lucide-icon"></i> Ouidah</div>
          <p class="exc-desc">Temple des pythons sacrés, forêt sacrée, Fort Français, musée historique et Porte du Non-Retour.</p>
        </div>
      </a>
      <a href="{{ route('excursions.show', 'refuge-tortues') }}" class="exc-card" data-r="up" data-d="6" style="text-decoration:none;display:block">
        <div class="exc-img">
          <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=700" alt="Refuge tortues marines">
          <div class="exc-img-ov"></div>
          <span class="exc-dur"><i data-lucide="clock" class="lucide-icon"></i> 1 heure</span>
          <span class="exc-loc-tag">Agbanakin</span>
        </div>
        <div class="exc-body">
          <div class="exc-name">Refuge des Tortues Marines</div>
          <div class="exc-place"><i data-lucide="map-pin" class="lucide-icon"></i> Agbanakin</div>
          <p class="exc-desc">Visitez le refuge qui protège les tortues marines sur les côtes béninoises. Une expérience de conservation rare.</p>
        </div>
      </a>
    </div>
  </div>
</section>

{{-- ═══ LISTE COMPLÈTE DES 12 ════════════════════════════════════ --}}
<section class="liste-section">
  <div class="wrap">
    <div class="tc mb6" data-r="up">
      <div class="sec-lbl" style="justify-content:center;color:var(--teal)">Toutes nos excursions</div>
      <h2 style="font-family:var(--f1);font-size:clamp(1.8rem,3vw,2.8rem);color:#fff;letter-spacing:-.02em">Les 12 excursions disponibles</h2>
    </div>
    <div class="liste-grid" data-r="up">
      @php
      $excursions = [
        ['name'=>'Canoë sur le lac Ahémé',       'place'=>'Possotomé', 'dur'=>'3 heures',  'slug'=>'canoe-lac-aheme'],
        ['name'=>'Source thermale',               'place'=>'Possotomé', 'dur'=>'1 heure',   'slug'=>'source-thermale'],
        ['name'=>'Marché international de poterie','place'=>'Sé',        'dur'=>'½ journée', 'slug'=>'marche-poterie'],
        ['name'=>'Palais Royal',                  'place'=>'Doutou',    'dur'=>'1 heure',   'slug'=>'palais-royal-doutou'],
        ['name'=>'Temple des pythons',            'place'=>'Ouidah',    'dur'=>'1 heure',   'slug'=>'temple-pythons'],
        ['name'=>'Musée historique',              'place'=>'Ouidah',    'dur'=>'1 heure',   'slug'=>'musee-historique'],
        ['name'=>'Forêt sacrée',                  'place'=>'Ouidah',    'dur'=>'1 heure',   'slug'=>'foret-sacree'],
        ['name'=>'Fort Français',                 'place'=>'Ouidah',    'dur'=>'1 heure',   'slug'=>'fort-francais'],
        ['name'=>'Centre Artisanal',              'place'=>'Cotonou',   'dur'=>'1 heure',   'slug'=>'centre-artisanal'],
        ['name'=>'Statue de l\'Amazone',          'place'=>'Cotonou',   'dur'=>'1 heure',   'slug'=>'statue-amazone'],
        ['name'=>'Mémorial de Zoungbodji',        'place'=>'Ouidah',    'dur'=>'1 heure',   'slug'=>'memorial-zoungbodji'],
        ['name'=>'Refuge des tortues marines',    'place'=>'Agbanakin', 'dur'=>'1 heure',   'slug'=>'refuge-tortues'],
      ];
      @endphp
      @foreach($excursions as $e)
      <a href="{{ route('excursions.show', $e['slug']) }}" class="li-item" style="text-decoration:none">
        <div class="li-left">
          <div class="li-dot"></div>
          <div>
            <div class="li-name">{{ $e['name'] }}</div>
            <div class="li-place"><i data-lucide="map-pin" class="lucide-icon"></i> {{ $e['place'] }}</div>
          </div>
        </div>
        <span class="li-dur">{{ $e['dur'] }} →</span>
      </a>
      @endforeach
    </div>
    <div class="tc mt4" data-r="up">
      <a href="{{ route('reservation.index') }}" class="btn btn-p btn-lg">Organiser mes excursions</a>
    </div>
  </div>
</section>

{{-- ═══ CIRCUIT 7 JOURS ═════════════════════════════════════════ --}}
<section class="circuit-section">
  <div class="wrap">

    {{-- Header circuit — card sombre, PAS d'image géante --}}
    <div class="circuit-header" data-r="up">
      <div>
        <div class="sec-lbl" style="color:var(--teal)">Circuit national</div>
        <div class="ch-title">Circuit Bénin 7 Jours</div>
        <p class="ch-desc">Un circuit guidé associant culture, aventure et gastronomie. Découvrez les mystères de la religion vodoun et les secrets naturels du patrimoine national béninois. Guides locaux, pension complète, transports inclus.</p>
        <div class="ch-tags">
          <span class="ch-tag"><i data-lucide="utensils" class="lucide-icon"></i> Pension complète</span>
          <span class="ch-tag"><i data-lucide="bus" class="lucide-icon"></i> Transports inclus</span>
          <span class="ch-tag"><i data-lucide="compass" class="lucide-icon"></i> Guides locaux</span>
          <span class="ch-tag"><i data-lucide="landmark" class="lucide-icon"></i> Abomey UNESCO</span>
          <span class="ch-tag"><i data-lucide="sailboat" class="lucide-icon"></i> Pirogue lagune</span>
          <span class="ch-tag"><i data-lucide="plane" class="lucide-icon"></i> Billet non inclus</span>
        </div>
      </div>
      <div class="ch-price-box">
        <span class="cp-from">À partir de</span>
        <span class="cp-val">1 050<span class="cp-cur"> €</span></span>
        <span class="cp-pp">par personne</span>
        <span class="cp-alt">~ 690 000 FCFA</span>
        <span class="cp-note">Billet d'avion et boissons<br>non inclus dans le prix</span>
        <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm" style="margin-top:1.4rem;width:100%">Réserver</a>
      </div>
    </div>

    {{-- Ce qui est inclus --}}
    <div class="inclus-grid" data-r="up">
      <div class="inc-card">
        <span class="inc-ic"><i data-lucide="building-2" class="lucide-icon"></i></span>
        <span class="inc-title">Hébergement</span>
        <span class="inc-desc">Nuitées en pension complète à l'hôtel Chez Théo en bord de lac</span>
      </div>
      <div class="inc-card">
        <span class="inc-ic"><i data-lucide="utensils" class="lucide-icon"></i></span>
        <span class="inc-title">Repas complets</span>
        <span class="inc-desc">Petit-déjeuner, déjeuner et dîner inclus chaque jour du circuit</span>
      </div>
      <div class="inc-card">
        <span class="inc-ic"><i data-lucide="bus" class="lucide-icon"></i></span>
        <span class="inc-title">Transports</span>
        <span class="inc-desc">Tous les déplacements entre les sites sont inclus dans le prix</span>
      </div>
      <div class="inc-card">
        <span class="inc-ic"><i data-lucide="compass" class="lucide-icon"></i></span>
        <span class="inc-title">Guides locaux</span>
        <span class="inc-desc">Accompagnement par des guides locaux passionnés tout au long du séjour</span>
      </div>
    </div>

    {{-- Timeline 7 jours — fond sombre, textes blancs toujours visibles --}}
    <div class="tc mb6" data-r="up">
      <div class="sec-lbl" style="justify-content:center">Programme détaillé</div>
      <h2 style="font-family:var(--f1);font-size:clamp(2rem,3.5vw,3rem);color:var(--dark);letter-spacing:-.02em">Le programme jour par jour</h2>
    </div>

    <div class="timeline-wrap" data-r="up">
      <div class="timeline">

        <div class="tl-day">
          <div class="tl-marker">1</div>
          <div class="tl-card">
            <span class="tl-day-label">Jour 1</span>
            <div class="tl-route">Arrivée à Cotonou → Possotomé</div>
            <div class="tl-activities">
              <div class="tl-act">Accueil à l'aéroport de Cotonou</div>
              <div class="tl-act">Transfert vers Possotomé et installation à l'hôtel</div>
              <div class="tl-act">Relaxation en bord du lac Ahémé</div>
              <div class="tl-act">Dîner et nuitée en bordure du lac</div>
            </div>
          </div>
        </div>

        <div class="tl-day">
          <div class="tl-marker">2</div>
          <div class="tl-card">
            <span class="tl-day-label">Jour 2</span>
            <div class="tl-route">Possotomé → Ouidah</div>
            <div class="tl-activities">
              <div class="tl-act">Route vers Ouidah, ville historique du vodoun et de la traite négrière</div>
              <div class="tl-act">Visite du temple des pythons et de la basilique de l'Immaculée Conception</div>
              <div class="tl-act">Visite de la Fondation Zinsou</div>
              <div class="tl-act">Parcours de la Route des Esclaves jusqu'à la Porte du Non-Retour</div>
              <div class="tl-act">Retour sur Possotomé — soirée relax, dîner et nuitée</div>
            </div>
          </div>
        </div>

        <div class="tl-day">
          <div class="tl-marker">3</div>
          <div class="tl-card">
            <span class="tl-day-label">Jour 3</span>
            <div class="tl-route">Possotomé → Abomey (Palais Royaux UNESCO)</div>
            <div class="tl-activities">
              <div class="tl-act">Départ pour Abomey, ancienne capitale du royaume du Dahomey</div>
              <div class="tl-act">Visite des palais royaux d'Abomey — site classé au patrimoine UNESCO</div>
              <div class="tl-act">Rencontre avec des artisans locaux : tisserands et sculpteurs</div>
              <div class="tl-act">Visite de la place Goho</div>
              <div class="tl-act">Retour sur Possotomé en soirée — dîner et nuitée</div>
            </div>
          </div>
        </div>

        <div class="tl-day">
          <div class="tl-marker">4</div>
          <div class="tl-card">
            <span class="tl-day-label">Jour 4</span>
            <div class="tl-route">Possotomé → Grand-Popo (Lagune & Plage)</div>
            <div class="tl-activities">
              <div class="tl-act">Balade en pirogue sur la lagune Mono : île au sel, mangroves, île aux oiseaux</div>
              <div class="tl-act">Découverte de l'embouchure du roi</div>
              <div class="tl-act">Visite de l'écloserie de tortues marines</div>
              <div class="tl-act">Détente à la plage de Grand-Popo</div>
              <div class="tl-act">Route vers Possotomé — nuitée au bord du lac</div>
            </div>
          </div>
        </div>

        <div class="tl-day">
          <div class="tl-marker">5</div>
          <div class="tl-card">
            <span class="tl-day-label">Jour 5</span>
            <div class="tl-route">Possotomé — Sources Thermales & Vodoun</div>
            <div class="tl-activities">
              <div class="tl-act">Découverte des sources thermales naturelles de Possotomé</div>
              <div class="tl-act">Balade en pirogue sur le lac Ahémé, rencontre avec les pêcheurs</div>
              <div class="tl-act">Découverte des rites vodoun dans le respect des traditions locales</div>
              <div class="tl-act">Cérémonie Zangbeto</div>
              <div class="tl-act">Nuitée à Possotomé</div>
            </div>
          </div>
        </div>

        <div class="tl-day">
          <div class="tl-marker">6</div>
          <div class="tl-card">
            <span class="tl-day-label">Jour 6</span>
            <div class="tl-route">Possotomé → Porto-Novo (Capitale)</div>
            <div class="tl-activities">
              <div class="tl-act">Route vers Porto-Novo, capitale administrative du Bénin</div>
              <div class="tl-act">Visite du musée Honmey, ancien palais royal</div>
              <div class="tl-act">Découverte du quartier brésilien et son architecture afro-brésilienne</div>
              <div class="tl-act">Visite du centre Songhai</div>
              <div class="tl-act">Balade sur la rivière noire à Adjarra</div>
              <div class="tl-act">Artisanat local : vannerie et fabrication de tambours</div>
              <div class="tl-act">Retour sur Possotomé — dîner et nuitée</div>
            </div>
          </div>
        </div>

        <div class="tl-day">
          <div class="tl-marker">7</div>
          <div class="tl-card">
            <span class="tl-day-label">Jour 7</span>
            <div class="tl-route">Possotomé → Cotonou → Départ</div>
            <div class="tl-activities">
              <div class="tl-act">Retour matinal à Cotonou</div>
              <div class="tl-act">Shopping artisanal au marché de Dantokpa et au marché des souvenirs</div>
              <div class="tl-act">Balade au pied du plus long mur de graffitis</div>
              <div class="tl-act">Découverte du monument de l'Amazone et de Bio Guera</div>
              <div class="tl-act">Relaxation proche de la plage</div>
              <div class="tl-act">Transfert à l'aéroport pour le départ</div>
            </div>
          </div>
        </div>

      </div>
    </div>{{-- /timeline-wrap --}}

  </div>
</section>

{{-- ═══ CTA ══════════════════════════════════════════════════════ --}}
<section class="cta-section">
  <div class="wrap">
    <div data-r="up">
      <h2 class="cta-title">Prêt à découvrir le Bénin ?</h2>
      <p class="cta-sub">Contactez-nous pour organiser vos excursions à la journée ou réserver<br>le circuit complet 7 jours en pension complète.</p>
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
}, {threshold:.08});
document.querySelectorAll('[data-r]').forEach(el => obs.observe(el));
</script>
@endpush
