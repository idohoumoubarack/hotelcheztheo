@extends('layouts.app')

@section('title', 'Locations Possotomé — Salles, Canoës & Véhicules | Chez Théo les Bains')
@section('description', 'Location de salles de réunion (50 et 100 personnes), canoës sur le lac Ahémé, Toyota Land Cruiser Prado et moto Haojue. Dès 9€/jour à Possotomé.')

@push('styles')
<style>
/* ── UTILITAIRES ───────────────────────────────────────────── */
.wrap{max-width:1300px;margin:0 auto;padding:0 2rem}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;font-family:var(--f3);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.9rem 2.2rem;border-radius:999px;transition:all .4s var(--spring);cursor:pointer;border:none;white-space:nowrap}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 6px 26px var(--teal-glow)}
.btn-p:hover{transform:translateY(-3px) scale(1.03);box-shadow:0 12px 42px var(--teal-glow);color:#fff}
.btn-dk{background:var(--dark);color:#fff}
.btn-dk:hover{background:var(--dark3);transform:translateY(-3px);color:#fff}
.btn-gl{background:rgba(255,255,255,.14);backdrop-filter:blur(22px);border:1px solid rgba(255,255,255,.22);color:#fff}
.btn-gl:hover{background:rgba(255,255,255,.22);transform:translateY(-2px);color:#fff}
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
[data-d="1"]{transition-delay:.1s}[data-d="2"]{transition-delay:.2s}[data-d="3"]{transition-delay:.3s}[data-d="4"]{transition-delay:.4s}

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

/* ── RÉSUMÉ BAND ───────────────────────────────────────────── */
.resume-band{background:var(--dark2);border-bottom:1px solid rgba(110,193,228,.1);padding:2rem 0}
.resume-inner{display:flex;align-items:center;justify-content:center;flex-wrap:wrap;gap:3rem}
.ri-item{display:flex;align-items:center;gap:.7rem;font-family:var(--f3);font-size:.7rem;font-weight:600;text-transform:uppercase;letter-spacing:.14em;color:#fff}
.ri-icon{font-size:1.2rem}
.ri-sep{width:1px;height:22px;background:rgba(255,255,255,.1)}

/* ── SECTION GÉNÉRIQUE ─────────────────────────────────────── */
.loc-section{padding:7rem 0}
.loc-section.dark{background:var(--dark)}
.loc-section.light{background:#fafcfe}
.loc-section.teal-light{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 60%)}

/* ── LOC SPLIT (image + contenu) ───────────────────────────── */
.loc-split{display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center}
.loc-split.reverse{direction:rtl}
.loc-split.reverse > *{direction:ltr}

/* ── GALERIE IMAGES ────────────────────────────────────────── */
.loc-gallery{display:grid;grid-template-columns:1fr 1fr;gap:.7rem;border-radius:24px;overflow:hidden}
.lg-main{grid-column:span 2;height:280px;overflow:hidden;position:relative}
.lg-sub{height:180px;overflow:hidden;position:relative}
.lg-main img,.lg-sub img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.lg-main:hover img,.lg-sub:hover img{transform:scale(1.07)}

/* ── IMAGE SIMPLE ──────────────────────────────────────────── */
.loc-img-single{border-radius:24px;overflow:hidden;height:460px;position:relative;box-shadow:0 20px 60px rgba(13,27,42,.25)}
.loc-img-single img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.loc-img-single:hover img{transform:scale(1.05)}

/* ── CONTENU TEXTE ─────────────────────────────────────────── */
.loc-content h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.2rem);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.2rem}
.loc-content h2.dark-title{color:var(--dark)}
.loc-content h2.white-title{color:#fff}
.loc-content p{font-size:.97rem;line-height:1.85;margin-bottom:1.2rem}
.loc-content p.dark-p{color:#000000}
.loc-content p.white-p{color:#fff}

/* ── TARIFS ────────────────────────────────────────────────── */
.tarifs-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin:2rem 0}
.tarif-card{border-radius:18px;padding:1.6rem 1.4rem;text-align:center;transition:.35s var(--ease)}
.tarif-card.light-card{background:var(--teal-xlight);border:1px solid rgba(110,193,228,.28)}
.tarif-card.light-card:hover{transform:translateY(-5px);box-shadow:0 14px 36px rgba(110,193,228,.2)}
.tarif-card.dark-card{background:rgba(255,255,255,.05);border:1px solid rgba(110,193,228,.15)}
.tarif-card.dark-card:hover{transform:translateY(-5px);background:rgba(110,193,228,.08);border-color:rgba(110,193,228,.3)}
.tc-label{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;display:block;margin-bottom:.6rem}
.light-card .tc-label{color:var(--teal-dark)}
.dark-card .tc-label{color:var(--teal)}
.tc-price{font-family:var(--f1);font-size:2.4rem;font-weight:700;line-height:1;display:block}
.light-card .tc-price{color:var(--teal-dark)}
.dark-card .tc-price{color:var(--teal)}
.tc-unit{font-family:var(--f3);font-size:.68rem;font-weight:600;display:block;margin-top:.2rem}
.light-card .tc-unit{color:#000000}
.dark-card .tc-unit{color:#fff}
.tc-alt{font-family:var(--f3);font-size:.62rem;display:block;margin-top:.3rem}
.light-card .tc-alt{color:#000000}
.dark-card .tc-alt{color:rgba(255,255,255,.3)}

/* ── SPECS VÉHICULE ────────────────────────────────────────── */
.specs-list{display:flex;flex-wrap:wrap;gap:.5rem;margin:1.5rem 0}
.spec-tag{display:inline-flex;align-items:center;gap:.4rem;font-family:var(--f3);font-size:.65rem;font-weight:600;text-transform:uppercase;letter-spacing:.12em;padding:.4rem 1rem;border-radius:999px}
.spec-tag.light{background:var(--teal-xlight);color:var(--teal-dark);border:1px solid rgba(110,193,228,.28)}
.spec-tag.dark{background:rgba(255,255,255,.06);color:#fff;border:1px solid rgba(255,255,255,.1)}

/* ── NOTE GRATUIT ──────────────────────────────────────────── */
.gratuit-note{display:flex;align-items:flex-start;gap:.8rem;background:rgba(110,193,228,.08);border:1px solid rgba(110,193,228,.2);border-radius:14px;padding:1.1rem 1.3rem;margin:1.5rem 0}
.gn-icon{font-size:1.2rem;flex-shrink:0;margin-top:.1rem}
.gn-text{font-size:.85rem;color:#ffffff;line-height:1.65}
.gn-text strong{color:var(--teal)}

/* ── CTA FINAL ─────────────────────────────────────────────── */
.cta-section{background:linear-gradient(135deg,var(--teal-dark),var(--teal));padding:5rem 0;text-align:center}
.cta-title{font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);font-weight:600;color:#fff;margin-bottom:1rem}
.cta-sub{font-size:1rem;color:rgba(255,255,255,.78);margin-bottom:2.5rem;line-height:1.7}

/* ── RESPONSIVE ────────────────────────────────────────────── */
@media(max-width:1024px){
  .loc-split{grid-template-columns:1fr;gap:3rem}
  .loc-split.reverse{direction:ltr}
  .resume-inner{gap:1.5rem}
}
@media(max-width:768px){
  .tarifs-grid{grid-template-columns:1fr 1fr}
  .ri-sep{display:none}
  .lg-main{height:220px}
  .lg-sub{height:140px}
  .loc-img-single{height:300px}
}
@media(max-width:480px){.tarifs-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

{{-- ═══ PAGE HERO ═══════════════════════════════════════════════ --}}
<div class="page-hero">
  <div class="ph-bg">
    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1920" alt="Locations Possotomé — Chez Théo les Bains">
  </div>
  <div class="ph-ov"></div>
  <div class="ph-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Accueil</a>
      <i>›</i>
      <a href="#">Services annexes</a>
      <i>›</i>
      <span>Locations</span>
    </div>
    <div class="sec-lbl">Mobilité & Espaces</div>
    <h1 class="ph-title">Les Locations</h1>
    <p class="ph-sub">Salles de réunion, canoës sur le lac Ahémé, Toyota Land Cruiser Prado et moto Haojue. Tout ce qu'il vous faut pour explorer Possotomé et ses environs.</p>
  </div>
</div>

{{-- ═══ RÉSUMÉ BAND ═════════════════════════════════════════════ --}}
<div class="resume-band">
  <div class="resume-inner">
    <div class="ri-item"><span class="ri-icon"><i data-lucide="landmark" class="lucide-icon"></i></span> 2 salles de réunion</div>
    <div class="ri-sep"></div>
    <div class="ri-item"><span class="ri-icon"><i data-lucide="sailboat" class="lucide-icon"></i></span> Canoës sur le lac</div>
    <div class="ri-sep"></div>
    <div class="ri-item"><span class="ri-icon"><i data-lucide="car" class="lucide-icon"></i></span> Toyota Land Cruiser Prado</div>
    <div class="ri-sep"></div>
    <div class="ri-item"><span class="ri-icon"><i data-lucide="bike" class="lucide-icon"></i></span> Moto Haojue Express</div>
    <div class="ri-sep"></div>
    <div class="ri-item"><span class="ri-icon"><i data-lucide="calendar" class="lucide-icon"></i></span> Journée ou demi-journée</div>
  </div>
</div>

{{-- ═══ SALLES DE RÉUNION ═══════════════════════════════════════ --}}
<section class="loc-section teal-light">
  <div class="wrap">
    <div class="loc-split">

      <div data-r="left">
        <div class="loc-gallery">
          <div class="lg-main">
            <img src="https://images.unsplash.com/photo-1431540015161-0bf868a2d407?w=900" alt="Grande salle de réunion — Chez Théo les Bains">
          </div>
          <div class="lg-sub">
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=600" alt="Salle de réunion Possotomé">
          </div>
          <div class="lg-sub">
            <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600" alt="Espace de travail Chez Théo">
          </div>
        </div>
      </div>

      <div class="loc-content" data-r="right">
        <div class="sec-lbl">Espaces professionnels</div>
        <h2 class="dark-title">Salles de Réunion</h2>
        <p class="dark-p">Nous proposons de louer deux salles de réunion pour la <strong>journée</strong> ou la <strong>demi-journée</strong>. Un cadre calme et naturel en bord de lac, idéal pour vos séminaires, formations ou réunions d'équipe loin de l'agitation urbaine.</p>
        <p class="dark-p">Nous disposons d'une salle de <strong>50 personnes</strong> et d'une salle de <strong>100 personnes</strong>, toutes deux entièrement équipées.</p>

        <div class="tarifs-grid">
          <div class="tarif-card light-card">
            <span class="tc-label">Petite salle · 50 pers.</span>
            <span class="tc-price">50 €</span>
            <span class="tc-unit">/ jour</span>
            <span class="tc-alt">~ 35 000 FCFA / jour</span>
          </div>
          <div class="tarif-card light-card">
            <span class="tc-label">Grande salle · 100 pers.</span>
            <span class="tc-price">91 €</span>
            <span class="tc-unit">/ jour</span>
            <span class="tc-alt">~ 60 000 FCFA / jour</span>
          </div>
        </div>

        <div class="specs-list">
          <span class="spec-tag light"><i data-lucide="landmark" class="lucide-icon"></i> 50 personnes</span>
          <span class="spec-tag light"><i data-lucide="landmark" class="lucide-icon"></i> 100 personnes</span>
          <span class="spec-tag light"><i data-lucide="calendar" class="lucide-icon"></i> Journée ou demi-journée</span>
          <span class="spec-tag light"><i data-lucide="leaf" class="lucide-icon"></i> Cadre naturel</span>
        </div>

        <a href="{{ route('reservation.index') }}" class="btn btn-p btn-lg mt4">Réserver une salle</a>
      </div>

    </div>
  </div>
</section>

{{-- ═══ CANOËS ══════════════════════════════════════════════════ --}}
<section class="loc-section dark">
  <div class="wrap">
    <div class="loc-split reverse">

      <div class="loc-content" data-r="left">
        <div class="sec-lbl" style="color:var(--teal)">Sur le lac Ahémé</div>
        <h2 class="white-title">Location de Canoës</h2>
        <p class="white-p">Nous proposons de louer des <strong>canoës</strong> pour la <strong>journée</strong> ou la <strong>demi-journée</strong>. Nous offrons également la possibilité de vous accompagner avec un <strong>guide local</strong> qui connaît parfaitement le lac et ses environs.</p>

        <div class="gratuit-note">
          <span class="gn-icon"><i data-lucide="gift" class="lucide-icon"></i></span>
          <p class="gn-text">Les canoës sont <strong>accessibles gratuitement</strong> pour <strong>l'ensemble des clients</strong> de notre hôtel-restaurant.</p>
        </div>

        <div class="tarifs-grid">
          <div class="tarif-card dark-card">
            <span class="tc-label">Sans guide</span>
            <span class="tc-price">09 €</span>
            <span class="tc-unit">/ jour</span>
            <span class="tc-alt">~ 6 000 FCFA / jour</span>
          </div>
          <div class="tarif-card dark-card">
            <span class="tc-label">Avec guide local</span>
            <span class="tc-price">13 €</span>
            <span class="tc-unit">/ jour</span>
            <span class="tc-alt">~ 8 500 FCFA / jour</span>
          </div>
        </div>

        <div class="specs-list">
          <span class="spec-tag dark"><i data-lucide="sailboat" class="lucide-icon"></i> Lac Ahémé</span>
          <span class="spec-tag dark"><i data-lucide="compass" class="lucide-icon"></i> Guide disponible</span>
          <span class="spec-tag dark"><i data-lucide="gift" class="lucide-icon"></i> Gratuit pour les clients</span>
          <span class="spec-tag dark"><i data-lucide="calendar" class="lucide-icon"></i> Journée ou demi-journée</span>
        </div>

        <a href="{{ route('reservation.index') }}" class="btn btn-p btn-lg mt4">Réserver un canoë</a>
      </div>

      <div data-r="right">
        <div class="loc-img-single">
          <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=900" alt="Canoës sur le lac Ahémé — Chez Théo les Bains Possotomé">
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ TOYOTA LAND CRUISER PRADO ═══════════════════════════════ --}}
<section class="loc-section light">
  <div class="wrap">
    <div class="loc-split">

      <div data-r="left">
        <div class="loc-gallery">
          <div class="lg-main">
            <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=900" alt="Toyota Land Cruiser Prado — Location Possotomé">
          </div>
          <div class="lg-sub">
            <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=600" alt="4x4 tout terrain Bénin">
          </div>
          <div class="lg-sub">
            <img src="https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=600" alt="Location véhicule Possotomé">
          </div>
        </div>
      </div>

      <div class="loc-content" data-r="right">
        <div class="sec-lbl">Véhicule 4×4</div>
        <h2 class="dark-title">Toyota Land Cruiser<br>Prado</h2>
        <p class="dark-p">Un 4×4 robuste et polyvalent, idéal pour explorer les pistes et villages du département du Mono. Parfait pour vos excursions hors route au Bénin et vos transferts depuis Cotonou.</p>

        <div class="tarifs-grid" style="grid-template-columns:1fr">
          <div class="tarif-card light-card" style="max-width:240px">
            <span class="tc-label">Toyota Land Cruiser Prado</span>
            <span class="tc-price">100 €</span>
            <span class="tc-unit">/ jour</span>
            <span class="tc-alt">~ 65 000 FCFA / jour</span>
          </div>
        </div>

        <div class="specs-list">
          <span class="spec-tag light"><i data-lucide="calendar" class="lucide-icon"></i> Année : 2006</span>
          <span class="spec-tag light"><i data-lucide="armchair" class="lucide-icon"></i> 05 places</span>
          <span class="spec-tag light"><i data-lucide="settings" class="lucide-icon"></i> Manuelle</span>
          <span class="spec-tag light">🛻 4×4 tout-terrain</span>
        </div>

        <p class="dark-p" style="font-size:.85rem">Consultez la fiche technique officielle Toyota pour plus de détails sur le véhicule.</p>

        <div style="display:flex;gap:1rem;flex-wrap:wrap" class="mt4">
          <a href="{{ route('reservation.index') }}" class="btn btn-p">Réserver le véhicule</a>
          <a href="https://www.toyota.ci/media/gamme/modeles/files/FP_950_Prado_TX-TX-L_2021_CFAO_fr_BD-1.pdf" target="_blank" class="btn btn-out btn-sm">Fiche technique →</a>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ HAOJUE EXPRESS (MOTO) ═══════════════════════════════════ --}}
<section class="loc-section dark">
  <div class="wrap">
    <div class="loc-split reverse">

      <div class="loc-content" data-r="left">
        <div class="sec-lbl" style="color:var(--teal)">Deux roues</div>
        <h2 class="white-title">Haojue Express</h2>
        <p class="white-p">La moto idéale pour explorer librement les villages et routes de Possotomé et ses environs. Économique et maniable, la Haojue Express vous offre une totale liberté de mouvement au quotidien.</p>

        <div class="tarifs-grid" style="grid-template-columns:1fr">
          <div class="tarif-card dark-card" style="max-width:240px">
            <span class="tc-label">Haojue Express</span>
            <span class="tc-price">10 €</span>
            <span class="tc-unit">/ jour</span>
            <span class="tc-alt">~ 6 500 FCFA / jour</span>
          </div>
        </div>

        <div class="specs-list">
          <span class="spec-tag dark"><i data-lucide="calendar" class="lucide-icon"></i> Année : 2006</span>
          <span class="spec-tag dark"><i data-lucide="armchair" class="lucide-icon"></i> 02 places</span>
          <span class="spec-tag dark"><i data-lucide="settings" class="lucide-icon"></i> Manuelle</span>
          <span class="spec-tag dark"><i data-lucide="bike" class="lucide-icon"></i> Moto légère</span>
        </div>

        <div style="display:flex;gap:1rem;flex-wrap:wrap" class="mt4">
          <a href="{{ route('reservation.index') }}" class="btn btn-p">Réserver la moto</a>
          <a href="https://www.haojuemotor.com/fr/products/xpress/" target="_blank" class="btn btn-gl btn-sm">Fiche technique →</a>
        </div>
      </div>

      <div data-r="right">
        <div class="loc-img-single">
          <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=900" alt="Moto Haojue Express — Location Possotomé Bénin">
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ CTA ══════════════════════════════════════════════════════ --}}
<section class="cta-section">
  <div class="wrap">
    <div data-r="up">
      <h2 class="cta-title">Besoin d'une location ?</h2>
      <p class="cta-sub">Contactez-nous directement pour vérifier les disponibilités et réserver votre salle, canoë ou véhicule.<br>Réponse rapide par WhatsApp ou email.</p>
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
