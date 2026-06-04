@extends('layouts.app')

@section('title', $e['nom'] . ' — ' . $e['ville'] . ' | Excursions Chez Théo les Bains')
@section('description', 'Excursion ' . $e['nom'] . ' à ' . $e['ville'] . ' — ' . $e['duree'] . '. Organisée depuis Chez Théo les Bains à Possotomé, Bénin. ' . $e['categorie'] . '.')

@push('styles')
<style>
/* ── UTILITAIRES ───────────────────────────────────────────── */
.wrap{max-width:1300px;margin:0 auto;padding:0 2rem}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;font-family:var(--f3);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.9rem 2.2rem;border-radius:999px;transition:all .4s var(--spring);cursor:pointer;border:none;white-space:nowrap;text-decoration:none}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 6px 26px var(--teal-glow)}
.btn-p:hover{transform:translateY(-3px) scale(1.03);box-shadow:0 12px 42px var(--teal-glow);color:#fff}
.btn-gl{background:rgba(255,255,255,.12);backdrop-filter:blur(22px);border:1px solid rgba(255,255,255,.22);color:#fff}
.btn-gl:hover{background:rgba(255,255,255,.2);transform:translateY(-2px);color:#fff}
.btn-out{background:transparent;border:1.5px solid var(--teal);color:var(--teal)}
.btn-out:hover{background:var(--teal);color:#fff;transform:translateY(-2px)}
.btn-lg{padding:1.1rem 2.8rem;font-size:.82rem}
.btn-sm{padding:.55rem 1.3rem;font-size:.67rem}
.sec-lbl{display:inline-flex;align-items:center;gap:.8rem;font-family:var(--f3);font-size:.66rem;font-weight:700;text-transform:uppercase;letter-spacing:.32em;color:var(--teal);margin-bottom:1rem}
.sec-lbl::before{content:'';width:28px;height:1.5px;background:linear-gradient(90deg,var(--teal),var(--teal-light));flex-shrink:0}
[data-r]{opacity:0;transition:opacity .8s var(--ease),transform .8s var(--ease)}
[data-r="up"]{transform:translateY(50px)}
[data-r="left"]{transform:translateX(-50px)}
[data-r="right"]{transform:translateX(50px)}
[data-r="scale"]{transform:scale(.88)}
[data-r].in{opacity:1;transform:none}
[data-d="1"]{transition-delay:.1s}[data-d="2"]{transition-delay:.2s}[data-d="3"]{transition-delay:.3s}
[data-d="4"]{transition-delay:.4s}[data-d="5"]{transition-delay:.5s}

/* ── HERO ──────────────────────────────────────────────────── */
.detail-hero{position:relative;height:75vh;min-height:520px;display:flex;align-items:flex-end;overflow:hidden;background:var(--dark)}
.dh-bg{position:absolute;inset:0}
.dh-bg img{width:100%;height:100%;object-fit:cover;transition:transform 14s ease}
.detail-hero:hover .dh-bg img{transform:scale(1.05)}
.dh-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.97) 0%,rgba(8,19,30,.3) 65%,transparent 100%)}
.dh-body{position:relative;z-index:2;max-width:1300px;margin:0 auto;padding:0 2rem 5rem;width:100%}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-family:var(--f3);font-size:.68rem;text-transform:uppercase;letter-spacing:.15em;color:#fff;margin-bottom:1.2rem}
.breadcrumb a{color:#fff;transition:.2s;text-decoration:none}
.breadcrumb a:hover{color:var(--teal)}
.breadcrumb span{color:var(--teal)}
.breadcrumb i{font-size:.5rem;opacity:.5}
.dh-tags{display:flex;align-items:center;gap:.6rem;margin-bottom:1rem;flex-wrap:wrap}
.dh-tag{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.18em;padding:.3rem .85rem;border-radius:999px;display:flex;align-items:center;gap:.4rem}
.tag-cat{background:linear-gradient(135deg,var(--teal-dark),var(--teal));color:#fff}
.tag-dur{background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.8)}
.tag-dur [data-lucide]{width:11px;height:11px}
.tag-ville{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:#fff}
.tag-ville [data-lucide]{width:11px;height:11px}
.dh-title{font-family:var(--f1);font-size:clamp(2.5rem,7vw,5.5rem);font-weight:600;color:#fff;line-height:1.05;letter-spacing:-.04em;margin-bottom:2rem}
.dh-actions{display:flex;gap:1rem;flex-wrap:wrap}

/* ── GALERIE ───────────────────────────────────────────────── */
.galerie-section{background:var(--dark2);padding:3.5rem 0}
.galerie-grid{display:grid;grid-template-columns:2fr 1fr 1fr;gap:.8rem;height:360px}
.gal-item{overflow:hidden;border-radius:18px;position:relative}
.gal-item img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.gal-item:hover img{transform:scale(1.06)}
.gal-item:first-child{grid-row:1}
.gal-ov{position:absolute;inset:0;background:rgba(8,19,30,0);transition:.3s}
.gal-item:hover .gal-ov{background:rgba(8,19,30,.12)}

/* ── CORPS ─────────────────────────────────────────────────── */
.detail-body{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 55%);padding:6rem 0}
.detail-cols{display:grid;grid-template-columns:1fr 340px;gap:4rem;align-items:start}

/* ── CONTENU GAUCHE ────────────────────────────────────────── */
.dc-title{font-family:var(--f1);font-size:clamp(1.8rem,3vw,2.8rem);color:var(--dark);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.2rem}
.dc-p{font-size:1rem;color:#1a3a50;line-height:1.9;margin-bottom:1.2rem}

/* ── HIGHLIGHTS ────────────────────────────────────────────── */
.hl-title{font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.28em;color:var(--teal-dark);border-bottom:1px solid rgba(110,193,228,.25);padding-bottom:.8rem;margin:2.5rem 0 1.4rem}
.hl-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.7rem;margin-bottom:2.5rem}
.hl-item{display:flex;align-items:center;gap:.75rem;padding:.8rem 1rem;background:#fff;border:1px solid rgba(110,193,228,.18);border-radius:12px;transition:.25s ease}
.hl-item:hover{border-color:rgba(110,193,228,.4);transform:translateX(3px)}
.hl-dot{width:8px;height:8px;min-width:8px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));flex-shrink:0}
.hl-label{font-size:.88rem;color:var(--dark);font-weight:500}

/* ── INCLUS LIST ───────────────────────────────────────────── */
.inc-title{font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.28em;color:var(--teal-dark);border-bottom:1px solid rgba(110,193,228,.25);padding-bottom:.8rem;margin:2.5rem 0 1.4rem}
.inc-list{display:flex;flex-direction:column;gap:.55rem}
.inc-item{display:flex;align-items:center;gap:.7rem;font-size:.9rem;color:#fff}
.inc-check{width:20px;height:20px;min-width:20px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;flex-shrink:0}
.inc-check [data-lucide]{width:10px;height:10px;stroke:#fff;stroke-width:2.5}

/* ── SIDEBAR ───────────────────────────────────────────────── */
.sidebar{position:sticky;top:100px}
.info-card{background:var(--dark);border-radius:24px;padding:2.2rem;border:1px solid rgba(110,193,228,.18);box-shadow:0 20px 60px rgba(0,0,0,.25);margin-bottom:1.2rem}
.ic-title{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;color:#fff;margin-bottom:1.5rem;display:block}
.ic-big-icon{width:52px;height:52px;border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:1.2rem}
.ic-big-icon [data-lucide]{width:24px;height:24px;stroke:var(--teal);stroke-width:1.5}
.ic-rows{display:flex;flex-direction:column;gap:0}
.ic-row{display:flex;align-items:center;justify-content:space-between;padding:.75rem 0;border-bottom:1px solid rgba(255,255,255,.06)}
.ic-row:last-child{border-bottom:none}
.ic-key{font-family:var(--f3);font-size:.62rem;font-weight:600;text-transform:uppercase;letter-spacing:.15em;color:rgba(255,255,255,.35);display:flex;align-items:center;gap:.5rem}
.ic-key [data-lucide]{width:13px;height:13px;stroke:rgba(255,255,255,.35)}
.ic-val{font-size:.88rem;font-weight:600;color:#fff}
.ic-val.teal{color:var(--teal)}
.ic-divider{height:1px;background:rgba(255,255,255,.06);margin:1.2rem 0}
.ic-btn{width:100%;margin-bottom:.65rem;padding:.95rem;font-size:.73rem;border-radius:14px}
.ic-note{font-family:var(--f3);font-size:.58rem;color:rgba(255,255,255,.22);text-align:center;line-height:1.6;display:block;margin-top:.4rem}

/* ── CARD CIRCUIT 7J ───────────────────────────────────────── */
.circuit-card{background:linear-gradient(135deg,rgba(110,193,228,.12),rgba(110,193,228,.04));border:1px solid rgba(110,193,228,.25);border-radius:20px;padding:1.6rem;text-align:center}
.cc-icon{font-size:1.6rem;display:block;margin-bottom:.6rem}
.cc-title{font-family:var(--f1);font-size:1.1rem;color:#08131e;margin-bottom:.4rem}
.cc-desc{font-size:.8rem;color:#1a3a50;line-height:1.6;margin-bottom:1rem}
.cc-price{font-family:var(--f1);font-size:1.5rem;color:var(--teal);display:block;margin-bottom:.2rem}

/* ── NAV EXCURSIONS ────────────────────────────────────────── */
.nav-exc{background:var(--dark);padding:4rem 0}
.ne-inner{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1.5rem;align-items:center}
.ne-btn{display:flex;align-items:center;gap:1rem;padding:1.2rem 1.5rem;background:rgba(255,255,255,.04);border:1px solid rgba(110,193,228,.1);border-radius:18px;text-decoration:none;transition:.3s var(--ease)}
.ne-btn:hover{background:rgba(110,193,228,.08);border-color:rgba(110,193,228,.28);transform:translateY(-3px)}
.ne-btn.next-btn{flex-direction:row-reverse;text-align:right}
.ne-icon{width:46px;height:46px;min-width:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ne-icon [data-lucide]{width:20px;height:20px;stroke:var(--teal);stroke-width:1.5}
.ne-dir{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.18em;color:rgba(255,255,255,.35);display:block}
.ne-name{font-family:var(--f1);font-size:1rem;color:#1a3a50;display:block;margin-top:.15rem}
.ne-ville{font-family:var(--f3);font-size:.63rem;color:var(--teal);display:block;margin-top:.1rem;font-weight:600}
.ne-center{text-align:center}
.ne-all{font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.18em;color:#fff;text-decoration:none;transition:.2s;padding:.6rem 1.2rem;border:1px solid rgba(255,255,255,.1);border-radius:999px;display:inline-block}
.ne-all:hover{color:var(--teal);border-color:rgba(110,193,228,.3)}
.ne-empty{visibility:hidden}

/* ── AUTRES EXCURSIONS ─────────────────────────────────────── */
.autres-section{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 50%);padding:6rem 0}
.autres-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-top:3rem}
.autre-card{background:#fff;border-radius:18px;overflow:hidden;border:1px solid rgba(110,193,228,.15);box-shadow:0 4px 16px rgba(13,27,42,.07);transition:.4s var(--ease);text-decoration:none;display:block}
.autre-card:hover{transform:translateY(-6px);box-shadow:0 20px 46px rgba(13,27,42,.13)}
.ac-img{height:140px;overflow:hidden;position:relative}
.ac-img img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.autre-card:hover .ac-img img{transform:scale(1.07)}
.ac-body{padding:1rem 1.1rem 1.2rem}
.ac-cat{font-family:var(--f3);font-size:.55rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;color:var(--teal-dark);margin-bottom:.4rem;display:block}
.ac-name{font-family:var(--f1);font-size:.95rem;color:var(--dark);margin-bottom:.3rem;line-height:1.2}
.ac-meta{display:flex;align-items:center;justify-content:space-between;font-family:var(--f3);font-size:.6rem;color:#fff}
.ac-dur{display:flex;align-items:center;gap:.3rem}
.ac-dur [data-lucide]{width:11px;height:11px;stroke:var(--teal-dark)}

/* ── RESPONSIVE ────────────────────────────────────────────── */
@media(max-width:1200px){.autres-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:1024px){
  .detail-cols{grid-template-columns:1fr;gap:3rem}
  .sidebar{position:static}
  .galerie-grid{grid-template-columns:1fr 1fr;height:280px}
  .gal-item:first-child{grid-column:1 / 3}
  .ne-inner{grid-template-columns:1fr 1fr}
  .ne-center{display:none}
}
@media(max-width:768px){
  .galerie-grid{grid-template-columns:1fr;height:auto}
  .gal-item{height:220px}
  .gal-item:first-child{grid-column:auto}
  .hl-grid{grid-template-columns:1fr}
  .autres-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:480px){.autres-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

{{-- ═══ HERO ════════════════════════════════════════════════════ --}}
<div class="detail-hero">
  <div class="dh-bg">
    <img src="{{ $e['hero_img'] }}" alt="{{ $e['nom'] }} — {{ $e['ville'] }} — Excursion Chez Théo les Bains">
  </div>
  <div class="dh-ov"></div>
  <div class="dh-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Accueil</a>
      <i>›</i>
      <a href="{{ route('excursions.index') }}">Excursions</a>
      <i>›</i>
      <span>{{ $e['nom'] }}</span>
    </div>

    <div class="dh-tags">
      <span class="dh-tag tag-cat">{{ $e['categorie'] }}</span>
      <span class="dh-tag tag-dur">
        <i data-lucide="clock"></i>
        {{ $e['duree'] }}
      </span>
      <span class="dh-tag tag-ville">
        <i data-lucide="map-pin"></i>
        {{ $e['ville'] }}
      </span>
    </div>

    <h1 class="dh-title">{{ $e['nom'] }}</h1>

    <div class="dh-actions">
      <a href="{{ route('reservation.index') }}" class="btn btn-p btn-lg">Réserver cette excursion</a>
      <a href="{{ route('excursions.index') }}" class="btn btn-gl">Toutes les excursions</a>
    </div>
  </div>
</div>

{{-- ═══ GALERIE ══════════════════════════════════════════════════ --}}
<section class="galerie-section">
  <div class="wrap">
    <div class="galerie-grid" data-r="up">
      @foreach($e['galerie'] as $i => $img)
      <div class="gal-item">
        <img src="{{ $img }}" alt="{{ $e['nom'] }} — photo {{ $i + 1 }}">
        <div class="gal-ov"></div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ═══ CORPS ════════════════════════════════════════════════════ --}}
<section class="detail-body">
  <div class="wrap">
    <div class="detail-cols">

      {{-- ── GAUCHE ── --}}
      <div data-r="left">
        <div class="sec-lbl">Description</div>
        <h2 class="dc-title">{{ $e['nom'] }}<br><span style="color:var(--teal-dark)">{{ $e['ville'] }}</span></h2>
        <p class="dc-p">{{ $e['description'] }}</p>
        <p class="dc-p">{{ $e['details'] }}</p>

        <div class="hl-title">Points forts de l'excursion</div>
        <div class="hl-grid">
          @foreach($e['highlights'] as $hl)
          <div class="hl-item">
            <div class="hl-dot"></div>
            <span class="hl-label">{{ $hl }}</span>
          </div>
          @endforeach
        </div>

        <div class="inc-title">Ce qui est inclus</div>
        <div class="inc-list">
          @foreach($e['inclus'] as $inc)
          <div class="inc-item">
            <div class="inc-check"><i data-lucide="check"></i></div>
            {{ $inc }}
          </div>
          @endforeach
        </div>
      </div>

      {{-- ── SIDEBAR ── --}}
      <div class="sidebar" data-r="right">
        <div class="info-card">
          <span class="ic-title">Informations pratiques</span>
          <div class="ic-big-icon">
            <i data-lucide="{{ $e['icon'] }}"></i>
          </div>
          <div class="ic-rows">
            <div class="ic-row">
              <span class="ic-key"><i data-lucide="clock"></i> Durée</span>
              <span class="ic-val teal">{{ $e['duree'] }}</span>
            </div>
            <div class="ic-row">
              <span class="ic-key"><i data-lucide="map-pin"></i> Lieu</span>
              <span class="ic-val">{{ $e['ville'] }}</span>
            </div>
            @foreach($e['pratique'] as $key => $val)
            <div class="ic-row">
              <span class="ic-key">{{ $key }}</span>
              <span class="ic-val">{{ $val }}</span>
            </div>
            @endforeach
          </div>
          <div class="ic-divider"></div>
          <a href="{{ route('reservation.index') }}" class="btn btn-p ic-btn">Réserver par email</a>
          <a href="https://wa.me/22901971831188" target="_blank" class="btn ic-btn" style="background:rgba(37,211,102,.15);border:1px solid rgba(37,211,102,.3);color:#25D366;width:100%">
            <i data-lucide="message-circle"></i> WhatsApp
          </a>
          <span class="ic-note">Réservation directe — sans frais de commission</span>
        </div>

        {{-- Circuit 7 jours --}}
        <div class="circuit-card">
          <span class="cc-icon"><i data-lucide="compass" style="width:1.6rem;height:1.6rem;stroke:var(--teal);stroke-width:1.5"></i></span>
          <div class="cc-title">Circuit Bénin 7 Jours</div>
          <p class="cc-desc">Découvrez le Bénin en entier avec nos guides locaux — culture, vodoun, nature, gastronomie. Pension complète incluse.</p>
          <span class="cc-price">1 050 € <span style="font-size:.8rem;color:#fff">/ pers.</span></span>
          <a href="{{ route('excursions.index') }}#circuit" class="btn btn-out btn-sm" style="width:100%;margin-top:.6rem">Voir le programme</a>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ NAVIGATION PRÉCÉDENTE / SUIVANTE ════════════════════════ --}}
<nav class="nav-exc">
  <div class="wrap">
    <div class="ne-inner">

      @if($prev)
      <a href="{{ route('excursions.show', $prev['slug']) }}" class="ne-btn prev-btn" data-r="left">
        <div class="ne-icon"><i data-lucide="{{ $prev['icon'] }}"></i></div>
        <div>
          <span class="ne-dir">← Précédente</span>
          <span class="ne-name">{{ $prev['nom'] }}</span>
          <span class="ne-ville">{{ $prev['ville'] }} · {{ $prev['duree'] }}</span>
        </div>
      </a>
      @else
      <div class="ne-empty"></div>
      @endif

      <div class="ne-center" data-r="up">
        <a href="{{ route('excursions.index') }}" class="ne-all">← Toutes les excursions →</a>
      </div>

      @if($next)
      <a href="{{ route('excursions.show', $next['slug']) }}" class="ne-btn next-btn" data-r="right">
        <div class="ne-icon"><i data-lucide="{{ $next['icon'] }}"></i></div>
        <div>
          <span class="ne-dir">Suivante →</span>
          <span class="ne-name">{{ $next['nom'] }}</span>
          <span class="ne-ville">{{ $next['ville'] }} · {{ $next['duree'] }}</span>
        </div>
      </a>
      @else
      <div class="ne-empty"></div>
      @endif

    </div>
  </div>
</nav>

{{-- ═══ AUTRES EXCURSIONS ════════════════════════════════════════ --}}
<section class="autres-section">
  <div class="wrap">
    <div data-r="up">
      <div class="sec-lbl">À découvrir aussi</div>
      <h2 style="font-family:var(--f1);font-size:clamp(1.8rem,3vw,2.8rem);color:var(--dark);letter-spacing:-.025em">Autres excursions</h2>
    </div>
    <div class="autres-grid">
      @php $count = 0; @endphp
      @foreach($all as $other)
        @if($other['slug'] !== $e['slug'] && $count < 4)
        <a href="{{ route('excursions.show', $other['slug']) }}" class="autre-card" data-r="scale" data-d="{{ $count + 1 }}">
          <div class="ac-img">
            <img src="{{ $other['hero_img'] }}" alt="{{ $other['nom'] }}">
          </div>
          <div class="ac-body">
            <span class="ac-cat">{{ $other['categorie'] }}</span>
            <div class="ac-name">{{ $other['nom'] }}</div>
            <div class="ac-meta">
              <span class="ac-dur">
                <i data-lucide="clock"></i>
                {{ $other['duree'] }}
              </span>
              <span>{{ $other['ville'] }} →</span>
            </div>
          </div>
        </a>
        @php $count++; @endphp
        @endif
      @endforeach
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
lucide.createIcons();
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('in'); });
}, {threshold:.08});
document.querySelectorAll('[data-r]').forEach(el => obs.observe(el));
</script>
@endpush
