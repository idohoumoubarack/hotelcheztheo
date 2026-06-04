@extends('layouts.app')

@section('title', $h['nom'] . ' — ' . $h['espace'] . ' | Chez Théo les Bains Possotomé')
@section('description', 'Réservez le ' . $h['nom'] . ' à Chez Théo les Bains Possotomé. À partir de ' . $h['prix_eur'] . '€ / nuit — ' . $h['personnes'] . '. Petit-déjeuner inclus, bord du lac Ahémé.')

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
.btn-dk{background:rgba(8,19,30,.85);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,.15);color:#fff}
.btn-dk:hover{background:var(--dark);transform:translateY(-2px);color:#fff}
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
.detail-hero{position:relative;height:80vh;min-height:550px;display:flex;align-items:flex-end;overflow:hidden;background:var(--dark)}
.dh-bg{position:absolute;inset:0}
.dh-bg img{width:100%;height:100%;object-fit:cover;transition:transform 12s ease}
.detail-hero:hover .dh-bg img{transform:scale(1.04)}
.dh-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.96) 0%,rgba(8,19,30,.35) 60%,transparent 100%)}
.dh-body{position:relative;z-index:2;max-width:1300px;margin:0 auto;padding:0 2rem 5rem;width:100%}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-family:var(--f3);font-size:.68rem;text-transform:uppercase;letter-spacing:.15em;color:#fff;margin-bottom:1.2rem}
.breadcrumb a{color:#fff;transition:.2s;text-decoration:none}
.breadcrumb a:hover{color:var(--teal)}
.breadcrumb span{color:var(--teal)}
.breadcrumb i{font-size:.5rem;opacity:.5}
.dh-badges{display:flex;align-items:center;gap:.6rem;margin-bottom:1rem;flex-wrap:wrap}
.dh-badge-espace{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;padding:.32rem .9rem;border-radius:999px;color:#fff}
.badge-resort{background:linear-gradient(135deg,var(--teal-dark),var(--teal))}
.badge-hotel{background:linear-gradient(135deg,#1a7a5e,#0f5c46)}
.dh-badge-pers{font-family:var(--f3);font-size:.6rem;font-weight:600;text-transform:uppercase;letter-spacing:.15em;padding:.32rem .9rem;border-radius:999px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.8);display:flex;align-items:center;gap:.4rem}
.dh-badge-pers svg{width:12px;height:12px}
.dh-title{font-family:var(--f1);font-size:clamp(2.8rem,7vw,6rem);font-weight:600;color:#fff;line-height:1;letter-spacing:-.04em;margin-bottom:1.5rem}
.dh-price-row{display:flex;align-items:flex-end;gap:2rem;flex-wrap:wrap}
.dp-main{display:flex;flex-direction:column;gap:.2rem}
.dp-from{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;color:#fff}
.dp-val{font-family:var(--f1);font-size:3.5rem;font-weight:700;color:var(--teal);line-height:1}
.dp-cur{font-size:1.4rem}
.dp-per{font-family:var(--f3);font-size:.65rem;color:#fff;margin-top:.15rem}
.dp-alt{font-family:var(--f3);font-size:.85rem;font-weight:600;color:#fff;align-self:flex-end;padding-bottom:.4rem}
.dh-actions{display:flex;gap:1rem;margin-top:2rem;flex-wrap:wrap}

/* ── GALERIE ───────────────────────────────────────────────── */
.galerie-section{background:var(--dark2);padding:4rem 0}
.galerie-grid{display:grid;grid-template-columns:2fr 1fr;grid-template-rows:1fr 1fr;gap:.8rem;height:460px}
.gal-item{overflow:hidden;border-radius:18px;cursor:pointer;position:relative}
.gal-item img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.gal-item:hover img{transform:scale(1.06)}
.gal-item:first-child{grid-row:1 / 3}
.gal-ov{position:absolute;inset:0;background:rgba(8,19,30,0);transition:.3s ease}
.gal-item:hover .gal-ov{background:rgba(8,19,30,.15)}
.gal-count{position:absolute;bottom:.8rem;right:.8rem;font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;color:#fff;background:rgba(8,19,30,.7);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.15);padding:.28rem .75rem;border-radius:999px}

/* ── CORPS PRINCIPAL ───────────────────────────────────────── */
.detail-body{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 50%);padding:6rem 0}
.detail-cols{display:grid;grid-template-columns:1fr 360px;gap:4rem;align-items:start}

/* ── CONTENU GAUCHE ────────────────────────────────────────── */
.dc-left h2{font-family:var(--f1);font-size:clamp(1.8rem,3vw,2.8rem);color:var(--dark);letter-spacing:-.025em;line-height:1.1;margin-bottom:1rem}
.dc-left p{font-size:1rem;color:#1a3a50;line-height:1.9;margin-bottom:1.5rem}

/* ── ÉQUIPEMENTS ───────────────────────────────────────────── */
.equip-title{font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.28em;color:var(--teal-dark);border-bottom:1px solid rgba(110,193,228,.25);padding-bottom:.8rem;margin-bottom:1.5rem;margin-top:2.5rem}
.equip-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.7rem}
.eq-item{display:flex;align-items:center;gap:.75rem;padding:.75rem 1rem;background:#fff;border:1px solid rgba(110,193,228,.18);border-radius:12px;transition:.25s ease}
.eq-item:hover{border-color:rgba(110,193,228,.4);transform:translateY(-2px);box-shadow:0 6px 20px rgba(110,193,228,.12)}
.eq-icon{width:34px;height:34px;min-width:34px;border-radius:9px;background:var(--teal-xlight);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.eq-icon [data-lucide]{width:16px;height:16px;stroke:var(--teal-dark);stroke-width:1.75}
.eq-label{font-size:.87rem;color:var(--dark);font-weight:500;line-height:1.3}

/* ── STICKY SIDEBAR ────────────────────────────────────────── */
.sidebar{position:sticky;top:100px}
.price-card{background:var(--dark);border-radius:24px;padding:2.2rem;border:1px solid rgba(110,193,228,.18);box-shadow:0 20px 60px rgba(0,0,0,.25);margin-bottom:1.2rem}
.pc-from{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;color:#fff;display:block;margin-bottom:.3rem}
.pc-price{font-family:var(--f1);font-size:3.2rem;font-weight:700;color:var(--teal);line-height:1;margin-bottom:.2rem}
.pc-per{font-family:var(--f3);font-size:.65rem;color:rgba(255,255,255,.35);margin-bottom:.3rem;display:block}
.pc-alt{font-family:var(--f3);font-size:.82rem;font-weight:600;color:#fff;display:block;margin-bottom:1.6rem}
.pc-divider{height:1px;background:rgba(255,255,255,.07);margin:1.4rem 0}
.pc-inclus{display:flex;flex-direction:column;gap:.6rem;margin-bottom:1.8rem}
.pi-item{display:flex;align-items:center;gap:.65rem;font-size:.85rem;color:#fff}
.pi-dot{width:18px;height:18px;min-width:18px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;flex-shrink:0}
.pi-dot [data-lucide]{width:10px;height:10px;stroke:#fff;stroke-width:2.5}
.pc-btn{width:100%;margin-bottom:.7rem;padding:1rem;font-size:.75rem;border-radius:14px}
.pc-note{font-family:var(--f3);font-size:.6rem;color:rgba(255,255,255,.25);text-align:center;line-height:1.6;display:block}

/* ── CARD INFOS PRATIQUES ──────────────────────────────────── */
.info-prat{background:#fff;border:1px solid rgba(110,193,228,.2);border-radius:20px;padding:1.5rem 1.8rem}
.ip-title{font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;color:var(--teal-dark);margin-bottom:1.2rem}
.ip-row{display:flex;align-items:center;justify-content:space-between;padding:.55rem 0;border-bottom:1px solid rgba(110,193,228,.1);font-size:.87rem}
.ip-row:last-child{border-bottom:none}
.ip-key{color:#fff;display:flex;align-items:center;gap:.5rem}
.ip-key [data-lucide]{width:14px;height:14px;stroke:var(--teal-dark)}
.ip-val{font-weight:600;color:var(--dark)}

/* ── NAVIGATION HÉBERGEMENTS ───────────────────────────────── */
.nav-heberge{background:var(--dark);padding:4rem 0}
.nh-inner{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1.5rem;align-items:center}
.nh-nav-btn{display:flex;align-items:center;gap:1rem;padding:1.2rem 1.5rem;background:rgba(255,255,255,.04);border:1px solid rgba(110,193,228,.1);border-radius:18px;text-decoration:none;transition:.3s var(--ease)}
.nh-nav-btn:hover{background:rgba(110,193,228,.08);border-color:rgba(110,193,228,.28);transform:translateY(-3px)}
.nh-nav-btn.next-btn{flex-direction:row-reverse;text-align:right}
.nh-img{width:54px;height:54px;min-width:54px;border-radius:12px;overflow:hidden;flex-shrink:0}
.nh-img img{width:100%;height:100%;object-fit:cover}
.nh-dir{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.18em;color:rgba(255,255,255,.35);display:block}
.nh-name{font-family:var(--f1);font-size:1rem;color:#1a3a50;display:block;margin-top:.15rem}
.nh-price{font-family:var(--f3);font-size:.65rem;color:var(--teal);display:block;margin-top:.15rem;font-weight:600}
.nh-center{text-align:center}
.nh-all-link{font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.18em;color:#fff;text-decoration:none;transition:.2s;padding:.6rem 1.2rem;border:1px solid rgba(255,255,255,.1);border-radius:999px;display:inline-block}
.nh-all-link:hover{color:var(--teal);border-color:rgba(110,193,228,.3)}
.nh-empty{visibility:hidden}

/* ── AUTRES HÉBERGEMENTS ───────────────────────────────────── */
.autres-section{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 50%);padding:6rem 0}
.autres-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.2rem;margin-top:3rem}
.autre-card{background:#fff;border-radius:20px;overflow:hidden;border:1px solid rgba(110,193,228,.15);box-shadow:0 4px 20px rgba(13,27,42,.07);transition:.4s var(--ease);text-decoration:none;display:block}
.autre-card:hover{transform:translateY(-8px);box-shadow:0 22px 50px rgba(13,27,42,.14)}
.ac-img{height:170px;overflow:hidden}
.ac-img img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.autre-card:hover .ac-img img{transform:scale(1.07)}
.ac-body{padding:1.2rem 1.3rem 1.4rem}
.ac-badge{font-family:var(--f3);font-size:.55rem;font-weight:700;text-transform:uppercase;letter-spacing:.16em;padding:.22rem .65rem;border-radius:999px;color:#fff;display:inline-block;margin-bottom:.6rem}
.ac-name{font-family:var(--f1);font-size:1.1rem;color:var(--dark);margin-bottom:.2rem}
.ac-price{font-family:var(--f3);font-size:.7rem;font-weight:700;color:var(--teal);display:flex;align-items:center;justify-content:space-between}
.ac-arrow{font-size:.8rem;opacity:.5}

/* ── RESPONSIVE ────────────────────────────────────────────── */
@media(max-width:1100px){.autres-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:1024px){
  .detail-cols{grid-template-columns:1fr;gap:3rem}
  .sidebar{position:static}
  .galerie-grid{height:340px}
  .nh-inner{grid-template-columns:1fr 1fr}
  .nh-center{display:none}
}
@media(max-width:768px){
  .galerie-grid{grid-template-columns:1fr;grid-template-rows:280px 140px 140px;height:auto}
  .gal-item:first-child{grid-row:auto}
  .equip-grid{grid-template-columns:1fr}
  .nh-inner{grid-template-columns:1fr 1fr}
  .autres-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:480px){.autres-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

{{-- ═══ HERO ════════════════════════════════════════════════════ --}}
<div class="detail-hero">
  <div class="dh-bg">
    <img src="{{ $h['hero_img'] }}" alt="{{ $h['nom'] }} — Chez Théo les Bains Possotomé">
  </div>
  <div class="dh-ov"></div>
  <div class="dh-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Accueil</a>
      <i>›</i>
      <a href="{{ route('hebergements.index') }}">Hébergements</a>
      <i>›</i>
      <span>{{ $h['nom'] }}</span>
    </div>

    <div class="dh-badges">
      <span class="dh-badge-espace badge-{{ $h['badge'] }}">
        {{ $h['espace'] }}
      </span>
      <span class="dh-badge-pers">
        <i data-lucide="users"></i>
        {{ $h['personnes'] }}
      </span>
    </div>

    <h1 class="dh-title">{{ $h['nom'] }}</h1>

    <div class="dh-price-row">
      <div class="dp-main">
        <span class="dp-from">À partir de</span>
        <span class="dp-val">{{ $h['prix_eur'] }}<span class="dp-cur"> €</span></span>
        <span class="dp-per">par nuit · petit-déjeuner inclus</span>
      </div>
      <span class="dp-alt">~ {{ $h['prix_fcfa'] }} FCFA</span>
    </div>

    <div class="dh-actions">
      <a href="{{ route('reservation.index') }}" class="btn btn-p btn-lg">Réserver cet hébergement</a>
      <a href="{{ route('hebergements.index') }}" class="btn btn-gl">Voir tous les hébergements</a>
    </div>
  </div>
</div>

{{-- ═══ GALERIE ══════════════════════════════════════════════════ --}}
<section class="galerie-section">
  <div class="wrap">
    <div class="galerie-grid" data-r="up">
      @foreach($h['galerie'] as $i => $img)
      <div class="gal-item">
        <img src="{{ $img }}" alt="{{ $h['nom'] }} — photo {{ $i + 1 }} — Chez Théo les Bains">
        <div class="gal-ov"></div>
        @if($i === count($h['galerie']) - 1)
          <span class="gal-count">{{ count($h['galerie']) }} photos</span>
        @endif
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ═══ CORPS : DESCRIPTION + SIDEBAR PRIX ══════════════════════ --}}
<section class="detail-body">
  <div class="wrap">
    <div class="detail-cols">

      {{-- ── GAUCHE ── --}}
      <div data-r="left">
        <div class="sec-lbl">Description</div>
        <h2>{{ $h['nom'] }}<br>au bord du lac Ahémé</h2>
        <p>{{ $h['description'] }}</p>
        <p>Tous nos hébergements sont situés aux abords du <strong>lac Ahémé</strong> pour vous offrir un cadre naturel idyllique. Chaque hébergement dispose d'une <strong>salle de bain et de toilettes privées</strong>. Les <strong>taxes de nuitée sont incluses</strong> dans les prix affichés et le <strong>petit-déjeuner est offert</strong>.</p>

        <div class="equip-title">Équipements & commodités</div>
        <div class="equip-grid">
          @foreach($h['equipements'] as $eq)
          <div class="eq-item">
            <div class="eq-icon"><i data-lucide="{{ $eq['icon'] }}"></i></div>
            <span class="eq-label">{{ $eq['label'] }}</span>
          </div>
          @endforeach
        </div>
      </div>

      {{-- ── SIDEBAR ── --}}
      <div class="sidebar" data-r="right">
        <div class="price-card">
          <span class="pc-from">À partir de</span>
          <div class="pc-price">{{ $h['prix_eur'] }} <span style="font-size:1.4rem">€</span></div>
          <span class="pc-per">par nuit · par hébergement</span>
          <span class="pc-alt">~ {{ $h['prix_fcfa'] }} FCFA</span>

          <div class="pc-divider"></div>

          <div class="pc-inclus">
            @foreach($h['inclus'] as $inc)
            <div class="pi-item">
              <div class="pi-dot"><i data-lucide="check"></i></div>
              {{ $inc }}
            </div>
            @endforeach
          </div>

          <a href="{{ route('reservation.index') }}" class="btn btn-p pc-btn">Réserver par email</a>
          <a href="https://wa.me/22901971831188" target="_blank" class="btn btn-gl pc-btn" style="background:rgba(37,211,102,.15);border-color:rgba(37,211,102,.3);color:#25D366">
            <i data-lucide="message-circle"></i>
            Réserver par WhatsApp
          </a>
          <span class="pc-note">Réservation directe sans frais de commission<br>Annulation à voir avec l'hôtel</span>
        </div>

        <div class="info-prat">
          <div class="ip-title">Informations pratiques</div>
          <div class="ip-row">
            <span class="ip-key"><i data-lucide="map-pin"></i> Espace</span>
            <span class="ip-val">{{ $h['espace'] }}</span>
          </div>
          <div class="ip-row">
            <span class="ip-key"><i data-lucide="users"></i> Capacité</span>
            <span class="ip-val">{{ $h['personnes'] }}</span>
          </div>
          <div class="ip-row">
            <span class="ip-key"><i data-lucide="coffee"></i> Petit-déj.</span>
            <span class="ip-val" style="color:var(--teal-dark)">Inclus</span>
          </div>
          <div class="ip-row">
            <span class="ip-key"><i data-lucide="shield-check"></i> Taxes</span>
            <span class="ip-val" style="color:var(--teal-dark)">Incluses</span>
          </div>
          <div class="ip-row">
            <span class="ip-key"><i data-lucide="sailboat"></i> Canoë</span>
            <span class="ip-val" style="color:var(--teal-dark)">Gratuit</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ NAVIGATION HÉBERGEMENT PRÉCÉDENT / SUIVANT ═══════════════ --}}
<nav class="nav-heberge">
  <div class="wrap">
    <div class="nh-inner">

      {{-- Précédent --}}
      @if($prev)
      <a href="{{ route('hebergements.show', $prev['slug']) }}" class="nh-nav-btn prev-btn" data-r="left">
        <div class="nh-img">
          <img src="{{ $prev['hero_img'] }}" alt="{{ $prev['nom'] }}">
        </div>
        <div>
          <span class="nh-dir">← Précédent</span>
          <span class="nh-name">{{ $prev['nom'] }}</span>
          <span class="nh-price">dès {{ $prev['prix_eur'] }}€ / nuit</span>
        </div>
      </a>
      @else
      <div class="nh-empty"></div>
      @endif

      {{-- Centre --}}
      <div class="nh-center" data-r="up">
        <a href="{{ route('hebergements.index') }}" class="nh-all-link">
          ← Tous les hébergements →
        </a>
      </div>

      {{-- Suivant --}}
      @if($next)
      <a href="{{ route('hebergements.show', $next['slug']) }}" class="nh-nav-btn next-btn" data-r="right">
        <div class="nh-img">
          <img src="{{ $next['hero_img'] }}" alt="{{ $next['nom'] }}">
        </div>
        <div>
          <span class="nh-dir">Suivant →</span>
          <span class="nh-name">{{ $next['nom'] }}</span>
          <span class="nh-price">dès {{ $next['prix_eur'] }}€ / nuit</span>
        </div>
      </a>
      @else
      <div class="nh-empty"></div>
      @endif

    </div>
  </div>
</nav>

{{-- ═══ AUTRES HÉBERGEMENTS ══════════════════════════════════════ --}}
<section class="autres-section">
  <div class="wrap">
    <div data-r="up">
      <div class="sec-lbl">À découvrir aussi</div>
      <h2 style="font-family:var(--f1);font-size:clamp(1.8rem,3vw,2.8rem);color:var(--dark);letter-spacing:-.025em">
        Nos autres hébergements
      </h2>
    </div>
    <div class="autres-grid">
      @foreach($all as $other)
        @if($other['slug'] !== $h['slug'])
        <a href="{{ route('hebergements.show', $other['slug']) }}" class="autre-card" data-r="scale">
          <div class="ac-img">
            <img src="{{ $other['hero_img'] }}" alt="{{ $other['nom'] }} — Chez Théo les Bains">
          </div>
          <div class="ac-body">
            <span class="ac-badge badge-{{ $other['badge'] }}">{{ $other['espace'] }}</span>
            <div class="ac-name">{{ $other['nom'] }}</div>
            <div class="ac-price">
              <span>dès {{ $other['prix_eur'] }}€ / nuit · {{ $other['personnes'] }}</span>
              <span class="ac-arrow">→</span>
            </div>
          </div>
        </a>
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
