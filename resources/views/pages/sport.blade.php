@extends('layouts.app')

@section('title', 'Salle de Sport Possotomé — Chez Théo les Bains')
@section('description', 'Salle de sport face à la piscine thermale avec vue sur le lac Ahémé. Gratuite pour les clients de l\'hôtel. Visiteurs extérieurs : 8€ / 5 000 FCFA la journée.')

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
[data-d="1"]{transition-delay:.1s}[data-d="2"]{transition-delay:.2s}[data-d="3"]{transition-delay:.3s}[data-d="4"]{transition-delay:.4s}[data-d="5"]{transition-delay:.5s}

/* ── PAGE HERO ─────────────────────────────────────────────── */
.page-hero{position:relative;height:60vh;min-height:440px;display:flex;align-items:flex-end;overflow:hidden;background:var(--dark)}
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

/* ── AVANTAGES BAND ────────────────────────────────────────── */
.avantages-band{background:var(--dark2);border-bottom:1px solid rgba(110,193,228,.1);padding:2rem 0}
.av-inner{display:flex;align-items:center;justify-content:center;flex-wrap:wrap;gap:3rem}
.av-item{display:flex;align-items:center;gap:.7rem;font-family:var(--f3);font-size:.7rem;font-weight:600;text-transform:uppercase;letter-spacing:.14em;color:#fff}
.av-icon{font-size:1.2rem}
.av-sep{width:1px;height:22px;background:rgba(255,255,255,.1)}

/* ── SECTION PRINCIPALE (SPLIT) ────────────────────────────── */
.main-section{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 60%);padding:7rem 0}
.main-split{display:grid;grid-template-columns:1.05fr 1fr;gap:5rem;align-items:center}

/* ── GALERIE ───────────────────────────────────────────────── */
.sport-gallery{display:grid;grid-template-columns:1fr 1fr;gap:.7rem;border-radius:24px;overflow:hidden}
.sg-main{grid-column:span 2;height:300px;overflow:hidden;position:relative}
.sg-sub{height:180px;overflow:hidden;position:relative}
.sg-main img,.sg-sub img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.sg-main:hover img,.sg-sub:hover img{transform:scale(1.07)}

/* ── CONTENU ───────────────────────────────────────────────── */
.sport-content h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.3rem);color:var(--dark);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.4rem}
.sport-content p{font-size:1rem;color:#1a3a50;line-height:1.85;margin-bottom:1.2rem}

/* ── TARIFS ACCÈS ──────────────────────────────────────────── */
.acces-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin:2rem 0}
.acces-card{border-radius:20px;padding:1.8rem 1.5rem;text-align:center;transition:.35s var(--ease)}
.acces-card.gratuit{background:linear-gradient(135deg,rgba(110,193,228,.12),rgba(110,193,228,.05));border:1.5px solid rgba(110,193,228,.35)}
.acces-card.gratuit:hover{transform:translateY(-5px);box-shadow:0 14px 36px rgba(110,193,228,.2)}
.acces-card.payant{background:var(--teal-xlight);border:1px solid rgba(110,193,228,.28)}
.acces-card.payant:hover{transform:translateY(-5px);box-shadow:0 14px 36px rgba(110,193,228,.15)}
.ac-icon{font-size:1.8rem;margin-bottom:.8rem;display:block}
.ac-label{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;color:var(--teal-dark);display:block;margin-bottom:.5rem}
.ac-price{font-family:var(--f1);font-size:2.2rem;font-weight:700;color:var(--teal-dark);line-height:1;display:block}
.ac-unit{font-family:var(--f3);font-size:.68rem;color:#fff;display:block;margin-top:.3rem}
.ac-alt{font-family:var(--f3);font-size:.62rem;color:#fff;display:block;margin-top:.2rem}
.ac-who{font-family:var(--f3);font-size:.72rem;font-weight:600;color:var(--teal-dark);display:block;margin-top:.6rem}

/* ── ÉQUIPEMENTS SECTION ───────────────────────────────────── */
.equip-section{background:var(--dark);padding:7rem 0}
.equip-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:1.2rem;margin-top:4rem}
.equip-card{background:rgba(255,255,255,.03);border:1px solid rgba(110,193,228,.1);border-radius:22px;padding:2rem 1.5rem;text-align:center;transition:.4s var(--ease);position:relative;overflow:hidden}
.equip-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,var(--teal),transparent);transform:scaleX(0);transition:.4s var(--ease)}
.equip-card:hover{background:rgba(110,193,228,.07);border-color:rgba(110,193,228,.28);transform:translateY(-8px);box-shadow:0 20px 50px rgba(0,0,0,.3)}
.equip-card:hover::before{transform:scaleX(1)}
.eq-icon{font-size:2.4rem;margin-bottom:1.2rem;display:block}
.eq-name{font-family:var(--f1);font-size:1.1rem;font-weight:600;color:#fff;line-height:1.3}

/* ── CADRE SECTION ─────────────────────────────────────────── */
.cadre-section{background:#fafcfe;padding:7rem 0}
.cadre-split{display:grid;grid-template-columns:1fr 1.05fr;gap:5rem;align-items:center}
.cadre-img{border-radius:28px;overflow:hidden;height:500px;box-shadow:0 24px 70px rgba(13,27,42,.18)}
.cadre-img img{width:100%;height:100%;object-fit:cover;transition:transform .9s var(--ease)}
.cadre-img:hover img{transform:scale(1.04)}
.cadre-text h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.2rem);color:var(--dark);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.2rem}
.cadre-text p{font-size:1rem;color:#1a3a50;line-height:1.85;margin-bottom:1.2rem}
.cadre-feats{display:flex;flex-direction:column;gap:.65rem;margin:2rem 0}
.cf-item{display:flex;align-items:flex-start;gap:.8rem;font-size:.94rem;color:#000000;line-height:1.6}
.cf-dot{width:22px;height:22px;min-width:22px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;margin-top:1px;font-size:.65rem;color:#fff;flex-shrink:0}

/* ── COMBO BAINS+SPORT ─────────────────────────────────────── */
.combo-section{background:var(--dark2);padding:5rem 0}
.combo-inner{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem}
.combo-card{border-radius:24px;overflow:hidden;position:relative;min-height:280px;display:flex;flex-direction:column;justify-content:flex-end;transition:.4s var(--ease)}
.combo-card:hover{transform:translateY(-6px);box-shadow:0 24px 50px rgba(0,0,0,.35)}
.cc-bg{position:absolute;inset:0}
.cc-bg img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.combo-card:hover .cc-bg img{transform:scale(1.06)}
.cc-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.92) 0%,rgba(8,19,30,.2) 60%,transparent 100%)}
.cc-body{position:relative;z-index:2;padding:2rem}
.cc-tag{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.28em;color:var(--teal);display:block;margin-bottom:.5rem}
.cc-title{font-family:var(--f1);font-size:1.6rem;font-weight:600;color:#fff;margin-bottom:.5rem}
.cc-desc{font-size:.85rem;color:#ffffff;line-height:1.65;margin-bottom:1rem}

/* ── CTA ───────────────────────────────────────────────────── */
.cta-section{background:linear-gradient(135deg,var(--teal-dark),var(--teal));padding:5rem 0;text-align:center}
.cta-title{font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);font-weight:600;color:#fff;margin-bottom:1rem}
.cta-sub{font-size:1rem;color:rgba(255,255,255,.78);margin-bottom:2.5rem;line-height:1.7}

/* ── RESPONSIVE ────────────────────────────────────────────── */
@media(max-width:1200px){.equip-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:1024px){
  .main-split,.cadre-split{grid-template-columns:1fr;gap:3rem}
  .combo-inner{grid-template-columns:1fr}
}
@media(max-width:768px){
  .acces-grid{grid-template-columns:1fr 1fr}
  .equip-grid{grid-template-columns:repeat(2,1fr)}
  .av-sep{display:none}
  .sg-main{height:220px}.sg-sub{height:150px}
}
@media(max-width:480px){.equip-grid{grid-template-columns:1fr 1fr}}
</style>
@endpush

@section('content')

{{-- ═══ PAGE HERO ═══════════════════════════════════════════════ --}}
<div class="page-hero">
  <div class="ph-bg">
    <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=1920" alt="Salle de sport — Chez Théo les Bains Possotomé">
  </div>
  <div class="ph-ov"></div>
  <div class="ph-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Accueil</a>
      <i>›</i>
      <a href="#">Services annexes</a>
      <i>›</i>
      <span>Salle de sport</span>
    </div>
    <div class="sec-lbl">Fitness & Bien-être</div>
    <h1 class="ph-title">La Salle de Sport</h1>
    <p class="ph-sub">Face à la piscine thermale, vue sur le lac Ahémé. Le lieu idéal pour s'entraîner dans un cadre naturel unique en Afrique de l'Ouest.</p>
  </div>
</div>

{{-- ═══ AVANTAGES BAND ══════════════════════════════════════════ --}}
<div class="avantages-band">
  <div class="av-inner">
    <div class="av-item"><span class="av-icon"><i data-lucide="gift" class="lucide-icon"></i></span> Gratuite pour les clients</div>
    <div class="av-sep"></div>
    <div class="av-item"><span class="av-icon"><i data-lucide="waves" class="lucide-icon"></i></span> Vue sur le lac Ahémé</div>
    <div class="av-sep"></div>
    <div class="av-item"><span class="av-icon"><i data-lucide="waves" class="lucide-icon"></i></span> Face à la piscine thermale</div>
    <div class="av-sep"></div>
    <div class="av-item"><span class="av-icon"><i data-lucide="dumbbell" class="lucide-icon"></i></span> 05 équipements disponibles</div>
    <div class="av-sep"></div>
    <div class="av-item"><span class="av-icon"><i data-lucide="banknote" class="lucide-icon"></i></span> 08€ pour les visiteurs</div>
  </div>
</div>

{{-- ═══ SECTION PRINCIPALE ══════════════════════════════════════ --}}
<section class="main-section">
  <div class="wrap">
    <div class="main-split">

      <div data-r="left">
        <div class="sport-gallery">
          <div class="sg-main">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=900" alt="Salle de sport Possotomé vue lac">
          </div>
          <div class="sg-sub">
            <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=600" alt="Équipements salle de sport">
          </div>
          <div class="sg-sub">
            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600" alt="Musculation vue lac Bénin">
          </div>
        </div>
      </div>

      <div class="sport-content" data-r="right">
        <div class="sec-lbl">La salle de sport</div>
        <h2>S'entraîner avec Vue<br>sur le Lac Ahémé</h2>
        <p>Située <strong>face à la piscine thermale</strong> et avec <strong>vue directe sur le lac Ahémé</strong>, notre salle de sport est le lieu idéal pour s'entraîner dans un cadre naturel exceptionnel. La brise du lac vous accompagne tout au long de votre séance.</p>
        <p>La salle est <strong>entièrement gratuite</strong> pour tous les clients de l'hôtel et du restaurant. Les visiteurs extérieurs sont également les bienvenus.</p>

        <div class="acces-grid">
          <div class="acces-card gratuit">
            <span class="ac-icon"><i data-lucide="gift" class="lucide-icon"></i></span>
            <span class="ac-label">Clients hôtel & restaurant</span>
            <span class="ac-price">Gratuit</span>
            <span class="ac-unit">accès illimité</span>
            <span class="ac-who">Pour tous nos clients</span>
          </div>
          <div class="acces-card payant">
            <span class="ac-icon"><i data-lucide="banknote" class="lucide-icon"></i></span>
            <span class="ac-label">Visiteurs extérieurs</span>
            <span class="ac-price">08 €</span>
            <span class="ac-unit">/ journée</span>
            <span class="ac-alt">~ 5 000 FCFA / jour</span>
          </div>
        </div>

        <a href="{{ route('reservation.index') }}" class="btn btn-p btn-lg mt4">Nous contacter</a>
      </div>

    </div>
  </div>
</section>

{{-- ═══ ÉQUIPEMENTS ═════════════════════════════════════════════ --}}
<section class="equip-section">
  <div class="wrap">
    <div class="tc mb8" data-r="up">
      <div class="sec-lbl" style="justify-content:center;color:var(--teal)">Ce qui vous attend</div>
      <h2 style="font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);color:#fff;letter-spacing:-.025em;line-height:1.1">Les Équipements</h2>
      <p style="font-size:1rem;color:#ffffff;max-width:500px;margin:1rem auto 0;line-height:1.8">5 machines pour un entraînement complet du corps, disponibles 7j/7.</p>
    </div>

    <div class="equip-grid">
      <div class="equip-card" data-r="scale" data-d="1">
        <span class="eq-icon"><i data-lucide="dumbbell" class="lucide-icon"></i></span>
        <div class="eq-name">Banc droit de développé-couché</div>
      </div>
      <div class="equip-card" data-r="scale" data-d="2">
        <span class="eq-icon"><i data-lucide="settings" class="lucide-icon"></i></span>
        <div class="eq-name">Banc incliné pour abdominaux</div>
      </div>
      <div class="equip-card" data-r="scale" data-d="3">
        <span class="eq-icon"><i data-lucide="bike" class="lucide-icon"></i></span>
        <div class="eq-name">Vélo d'appartement</div>
      </div>
      <div class="equip-card" data-r="scale" data-d="4">
        <span class="eq-icon"><i data-lucide="dumbbell" class="lucide-icon"></i></span>
        <div class="eq-name">Machine pour pectoraux</div>
      </div>
      <div class="equip-card" data-r="scale" data-d="5">
        <span class="eq-icon"><i data-lucide="footprints" class="lucide-icon"></i></span>
        <div class="eq-name">Entraîneur elliptique</div>
      </div>
    </div>
  </div>
</section>

{{-- ═══ LE CADRE ════════════════════════════════════════════════ --}}
<section class="cadre-section">
  <div class="wrap">
    <div class="cadre-split">

      <div class="cadre-img" data-r="left">
        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=900" alt="Vue piscine thermale et lac Ahémé depuis la salle de sport">
      </div>

      <div class="cadre-text" data-r="right">
        <div class="sec-lbl">Un cadre unique</div>
        <h2>S'entraîner Face<br>à la Piscine Thermale</h2>
        <p>La salle de sport de Chez Théo bénéficie d'une position exceptionnelle : <strong>directement face à la piscine thermale</strong>, avec une vue dégagée sur le <strong>lac Ahémé</strong> et la végétation tropicale environnante.</p>
        <p>Après votre séance d'entraînement, enchaînez directement avec un <strong>bain thermal récupérateur</strong> dans notre piscine à débordement — une combinaison sport + bien-être que vous ne trouverez nulle part ailleurs au Bénin.</p>
        <div class="cadre-feats">
          <div class="cf-item">
            <div class="cf-dot">✓</div>
            Vue directe sur le lac Ahémé depuis les machines
          </div>
          <div class="cf-item">
            <div class="cf-dot">✓</div>
            Face à la piscine thermale à débordement
          </div>
          <div class="cf-item">
            <div class="cf-dot">✓</div>
            Brise naturelle du lac — pas de climatisation nécessaire
          </div>
          <div class="cf-item">
            <div class="cf-dot">✓</div>
            Accès 7j/7 pour les clients de l'hôtel
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ COMBO SPORT + BAINS ══════════════════════════════════════ --}}
<section class="combo-section">
  <div class="wrap">
    <div class="tc mb8" data-r="up">
      <div class="sec-lbl" style="justify-content:center;color:var(--teal)">L'expérience complète</div>
      <h2 style="font-family:var(--f1);font-size:clamp(2rem,4vw,3.2rem);color:#fff;letter-spacing:-.025em;line-height:1.1">Sport &amp; Bien-être,<br>tout en un</h2>
    </div>
    <div class="combo-inner">
      <div class="combo-card" data-r="left">
        <div class="cc-bg">
          <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=900" alt="Salle de sport Chez Théo">
        </div>
        <div class="cc-ov"></div>
        <div class="cc-body">
          <span class="cc-tag">Avant ou après les bains</span>
          <div class="cc-title">La Salle de Sport</div>
          <p class="cc-desc">Entraînez-vous sur nos 5 machines avec vue sur le lac. Idéal pour commencer ou terminer votre journée bien-être.</p>
          <a href="{{ route('contact.index') }}" class="btn btn-gl" style="font-size:.65rem;padding:.5rem 1.2rem">Accès gratuit pour les clients</a>
        </div>
      </div>
      <div class="combo-card" data-r="right">
        <div class="cc-bg">
          <img src="https://tse2.mm.bing.net/th/id/OIP.qY1XkIbBXserkkNNN95caQHaE7?cb=thfvnextfalcon2&rs=1&pid=ImgDetMain&o=7&rm=3?w=900" alt="Piscine thermale Chez Théo">
        </div>
        <div class="cc-ov"></div>
        <div class="cc-body">
          <span class="cc-tag">Récupération active</span>
          <div class="cc-title">Les Bains Thermaux</div>
          <p class="cc-desc">Après l'effort, plongez dans notre piscine thermale à 40°C. L'eau de Possotomé soulage muscles et articulations.</p>
          <a href="{{ route('bains.index') }}" class="btn btn-gl" style="font-size:.65rem;padding:.5rem 1.2rem">Découvrir les bains →</a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ═══ CTA ══════════════════════════════════════════════════════ --}}
<section class="cta-section">
  <div class="wrap">
    <div data-r="up">
      <h2 class="cta-title">Prêt à vous entraîner ?</h2>
      <p class="cta-sub">La salle de sport est incluse gratuitement dans votre séjour à l'hôtel.<br>Visiteurs extérieurs : contactez-nous pour organiser votre accès.</p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('hebergements.index') }}" class="btn btn-w btn-lg">Réserver un hébergement</a>
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
