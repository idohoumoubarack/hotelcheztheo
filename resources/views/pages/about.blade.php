@extends('layouts.app')

@section('title', 'À Propos — Chez Théo les Bains | Notre Histoire depuis 2006')
@section('description', 'Fondé en 2006 à Possotomé, Chez Théo les Bains est né d\'un restaurant et a grandi jusqu\'à devenir un hôtel-resort unique au bord du lac Ahémé. Découvrez notre histoire et notre équipe.')

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
[data-d="1"]{transition-delay:.1s}[data-d="2"]{transition-delay:.2s}[data-d="3"]{transition-delay:.3s}
[data-d="4"]{transition-delay:.4s}[data-d="5"]{transition-delay:.5s}[data-d="6"]{transition-delay:.6s}
[data-d="7"]{transition-delay:.7s}[data-d="8"]{transition-delay:.8s}

/* ── PAGE HERO ─────────────────────────────────────────────── */
.page-hero{position:relative;height:65vh;min-height:480px;display:flex;align-items:flex-end;overflow:hidden;background:var(--dark)}
.ph-bg{position:absolute;inset:0}
.ph-bg img{width:100%;height:100%;object-fit:cover}
.ph-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.95) 0%,rgba(8,19,30,.4) 55%,transparent 100%)}
.ph-body{position:relative;z-index:2;max-width:1300px;margin:0 auto;padding:0 2rem 4.5rem;width:100%}
.ph-title{font-family:var(--f1);font-size:clamp(2.5rem,6vw,5.5rem);font-weight:600;color:#fff;line-height:1.05;letter-spacing:-.03em;margin-bottom:.8rem}
.ph-sub{font-size:1.05rem;color:#fff;max-width:560px;line-height:1.75}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-family:var(--f3);font-size:.68rem;text-transform:uppercase;letter-spacing:.15em;color:#fff;margin-bottom:1rem}
.breadcrumb a{color:#fff;transition:.2s}
.breadcrumb a:hover{color:var(--teal)}
.breadcrumb span{color:var(--teal)}
.breadcrumb i{font-size:.5rem;opacity:.5}

/* ── CHIFFRES CLÉS ─────────────────────────────────────────── */
.chiffres-band{background:var(--dark2);border-bottom:1px solid rgba(110,193,228,.1);padding:0}
.chiffres-inner{display:grid;grid-template-columns:repeat(4,1fr)}
.ci-item{padding:2.8rem 2rem;border-right:1px solid rgba(110,193,228,.1);text-align:center;transition:.3s ease}
.ci-item:last-child{border-right:none}
.ci-item:hover{background:rgba(110,193,228,.04)}
.ci-val{font-family:var(--f1);font-size:3rem;font-weight:700;color:var(--teal);line-height:1;display:block}
.ci-lbl{font-family:var(--f3);font-size:.65rem;font-weight:600;text-transform:uppercase;letter-spacing:.2em;color:#fff;display:block;margin-top:.5rem}

/* ── HISTOIRE SECTION ──────────────────────────────────────── */
.histoire-section{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 55%);padding:7rem 0}
.histoire-split{display:grid;grid-template-columns:1fr 1.1fr;gap:5rem;align-items:center}
.histoire-text h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.3rem);color:var(--dark);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.4rem}
.histoire-text p{font-size:1rem;color:#1a3a50;line-height:1.88;margin-bottom:1.2rem}

/* ── TIMELINE HISTOIRE ─────────────────────────────────────── */
.hist-timeline{display:flex;flex-direction:column;gap:0;position:relative}
.hist-timeline::before{content:'';position:absolute;left:1.1rem;top:0;bottom:0;width:2px;background:linear-gradient(to bottom,var(--teal),rgba(110,193,228,.15))}
.ht-item{display:flex;align-items:flex-start;gap:1.5rem;padding-bottom:2.2rem;position:relative}
.ht-item:last-child{padding-bottom:0}
.ht-dot{width:24px;height:24px;min-width:24px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));box-shadow:0 4px 12px var(--teal-glow);z-index:2;margin-top:.25rem;flex-shrink:0}
.ht-year{font-family:var(--f3);font-size:.65rem;font-weight:800;text-transform:uppercase;letter-spacing:.22em;color:var(--teal);display:block;margin-bottom:.3rem}
.ht-desc{font-size:.95rem;color:#1a3a50;line-height:1.75}
.ht-desc strong{color:var(--dark)}

/* ── VISUEL HISTOIRE (stack images) ────────────────────────── */
.hist-visual{position:relative;height:540px}
.hv-main{position:absolute;top:0;left:0;width:72%;height:76%;border-radius:24px;overflow:hidden;box-shadow:0 20px 60px rgba(13,27,42,.2);z-index:2}
.hv-acc{position:absolute;bottom:0;right:0;width:52%;height:50%;border-radius:24px;overflow:hidden;box-shadow:0 20px 60px rgba(13,27,42,.18);z-index:3;border:4px solid #fff}
.hv-main img,.hv-acc img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.hv-main:hover img,.hv-acc:hover img{transform:scale(1.06)}
.hv-badge{position:absolute;top:42%;right:-14px;z-index:5;background:var(--dark);border:1px solid rgba(110,193,228,.25);border-radius:16px;padding:.9rem 1.2rem;text-align:center;box-shadow:0 20px 50px rgba(0,0,0,.35);min-width:105px}
.hvb-n{font-family:var(--f1);font-size:2rem;font-weight:700;color:var(--teal);line-height:1;display:block}
.hvb-l{font-family:var(--f3);font-size:.56rem;font-weight:600;text-transform:uppercase;letter-spacing:.17em;color:#fff;display:block;margin-top:.25rem;line-height:1.4}

/* ── CE QUI NOUS DIFFÉRENCIE ───────────────────────────────── */
.diff-section{background:var(--dark);padding:7rem 0}
.diff-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:4rem}
.diff-card{background:rgba(255,255,255,.03);border:1px solid rgba(110,193,228,.1);border-radius:24px;padding:2.2rem 2rem;transition:.4s var(--ease);position:relative;overflow:hidden}
.diff-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,var(--teal),transparent);transform:scaleX(0);transition:.4s var(--ease)}
.diff-card:hover{background:rgba(110,193,228,.07);border-color:rgba(110,193,228,.28);transform:translateY(-8px);box-shadow:0 24px 56px rgba(0,0,0,.3)}
.diff-card:hover::before{transform:scaleX(1)}
.diff-ic{font-size:2.4rem;margin-bottom:1.2rem;display:block}
.diff-title{font-family:var(--f1);font-size:1.5rem;font-weight:600;color:#fff;margin-bottom:.8rem}
.diff-desc{font-size:.9rem;color:#ffffff;line-height:1.78}

/* ── THÉO — LE FONDATEUR ───────────────────────────────────── */
.theo-section{background:#fafcfe;padding:7rem 0}
.theo-split{display:grid;grid-template-columns:1fr 1.1fr;gap:5rem;align-items:center}
.theo-img-wrap{position:relative}
.theo-img{border-radius:28px;overflow:hidden;height:520px;box-shadow:0 24px 70px rgba(13,27,42,.18)}
.theo-img img{width:100%;height:100%;object-fit:cover;transition:transform .9s var(--ease)}
.theo-img:hover img{transform:scale(1.04)}
.theo-quote{position:absolute;bottom:-2rem;right:-2rem;background:var(--dark);border:1px solid rgba(110,193,228,.22);border-radius:22px;padding:1.6rem 1.8rem;max-width:280px;box-shadow:0 20px 50px rgba(0,0,0,.3)}
.tq-text{font-family:var(--f1);font-size:1.05rem;color:#fff;line-height:1.6;font-style:italic;margin-bottom:.8rem}
.tq-author{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;color:var(--teal)}
.theo-text h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.3rem);color:var(--dark);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.2rem}
.theo-text p{font-size:1rem;color:#1a3a50;line-height:1.88;margin-bottom:1.2rem}
.theo-feats{display:flex;flex-direction:column;gap:.65rem;margin:2rem 0}
.tf-item{display:flex;align-items:flex-start;gap:.8rem;font-size:.94rem;color:#000000;line-height:1.6}
.tf-dot{width:22px;height:22px;min-width:22px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;margin-top:1px;font-size:.65rem;color:#fff;flex-shrink:0}

/* ── ÉQUIPE ────────────────────────────────────────────────── */
.equipe-section{background:var(--dark2);padding:7rem 0}
.equipe-intro{display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;margin-bottom:5rem}
.equipe-intro h2{font-family:var(--f1);font-size:clamp(2rem,3.5vw,3.3rem);color:#fff;letter-spacing:-.025em;line-height:1.1}
.equipe-intro p{font-size:1rem;color:#ffffff;line-height:1.85}
.team-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.2rem}
.team-card{background:rgba(255,255,255,.04);border:1px solid rgba(110,193,228,.1);border-radius:22px;overflow:hidden;transition:.4s var(--ease);text-align:center}
.team-card:hover{transform:translateY(-8px);box-shadow:0 22px 50px rgba(0,0,0,.3);border-color:rgba(110,193,228,.28)}
.team-img{height:200px;overflow:hidden;position:relative}
.team-img img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.team-card:hover .team-img img{transform:scale(1.08)}
.team-img-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.6) 0%,transparent 50%)}
.team-body{padding:1.3rem 1rem 1.5rem}
.team-name{font-family:var(--f1);font-size:1.15rem;font-weight:600;color:#fff;margin-bottom:.25rem}
.team-role{font-family:var(--f3);font-size:.62rem;font-weight:600;text-transform:uppercase;letter-spacing:.18em;color:var(--teal)}

/* ── CTA ───────────────────────────────────────────────────── */
.cta-section{background:linear-gradient(135deg,var(--teal-dark),var(--teal));padding:5.5rem 0;text-align:center}
.cta-title{font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);font-weight:600;color:#fff;margin-bottom:1rem}
.cta-sub{font-size:1rem;color:rgba(255,255,255,.78);margin-bottom:2.5rem;line-height:1.75}

/* ── RESPONSIVE ────────────────────────────────────────────── */
@media(max-width:1100px){.team-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:1024px){
  .histoire-split,.theo-split{grid-template-columns:1fr;gap:3rem}
  .equipe-intro{grid-template-columns:1fr;gap:2rem}
  .diff-grid{grid-template-columns:1fr 1fr}
  .chiffres-inner{grid-template-columns:repeat(2,1fr)}
  .hist-visual{height:380px}
  .theo-quote{position:static;margin-top:1.5rem;max-width:100%}
}
@media(max-width:768px){
  .diff-grid{grid-template-columns:1fr}
  .team-grid{grid-template-columns:repeat(2,1fr)}
  .hv-acc{display:none}
  .hv-main{width:100%;height:100%;position:relative}
  .hist-visual{height:280px}
}
@media(max-width:480px){.team-grid{grid-template-columns:1fr 1fr}}
</style>
@endpush

@section('content')

{{-- ═══ PAGE HERO ═══════════════════════════════════════════════ --}}
<div class="page-hero">
  <div class="ph-bg">
    <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=1920" alt="À propos — Chez Théo les Bains Possotomé">
  </div>
  <div class="ph-ov"></div>
  <div class="ph-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Accueil</a>
      <i>›</i>
      <span>À propos</span>
    </div>
    <div class="sec-lbl">Notre Histoire</div>
    <h1 class="ph-title">Chez Théo<br>les Bains</h1>
    <p class="ph-sub">Né d'un restaurant en 2006, devenu l'un des établissements les plus uniques du Bénin. Découvrez l'histoire, les valeurs et l'équipe derrière Chez Théo.</p>
  </div>
</div>

{{-- ═══ CHIFFRES CLÉS ═══════════════════════════════════════════ --}}
<div class="chiffres-band">
  <div class="chiffres-inner">
    <div class="ci-item" data-r="up" data-d="1">
      <span class="ci-val">2006</span>
      <span class="ci-lbl">Année de fondation</span>
    </div>
    <div class="ci-item" data-r="up" data-d="2">
      <span class="ci-val">10</span>
      <span class="ci-lbl">Ans d'expérience</span>
    </div>
    <div class="ci-item" data-r="up" data-d="3">
      <span class="ci-val">06</span>
      <span class="ci-lbl">Types d'hébergements</span>
    </div>
    <div class="ci-item" data-r="up" data-d="4">
      <span class="ci-val">08</span>
      <span class="ci-lbl">Membres d'équipe</span>
    </div>
  </div>
</div>

{{-- ═══ NOTRE HISTOIRE ══════════════════════════════════════════ --}}
<section class="histoire-section">
  <div class="wrap">
    <div class="histoire-split">

      <div class="histoire-text" data-r="left">
        <div class="sec-lbl">D'où venons-nous ?</div>
        <h2>Une Histoire Née<br>au Bord du Lac</h2>
        <p>L'histoire de « Chez Théo » commence avec celle d'un <strong>restaurant</strong>. Fondé en <strong>2006</strong>, ce restaurant a commencé à grandir et en <strong>2010</strong>, des premières habitations ont vu le jour.</p>
        <p>Fort de son succès, l'établissement n'a cessé de croître et en <strong>2012</strong>, une nouvelle parcelle est achetée. Cette parcelle accueillera ce qui fait l'une des plus grandes particularités de notre espace : une <strong>piscine à débordement</strong> située à <strong>moins de 10 mètres</strong> de la berge du lac Ahémé.</p>
        <p>Depuis, nous continuons à donner le meilleur de nous-mêmes pour accueillir nos clients dans <strong>les meilleures conditions</strong> et leur faire vivre un <strong>séjour mémorable</strong>.</p>

        <div class="hist-timeline" style="margin-top:2.5rem">
          <div class="ht-item">
            <div class="ht-dot"></div>
            <div>
              <span class="ht-year">2006</span>
              <p class="ht-desc"><strong>Fondation du restaurant</strong> — Théo ouvre son restaurant à Possotomé, au bord du lac Ahémé.</p>
            </div>
          </div>
          <div class="ht-item">
            <div class="ht-dot"></div>
            <div>
              <span class="ht-year">2010</span>
              <p class="ht-desc"><strong>Premiers hébergements</strong> — Le restaurant devient hôtel. Les premières habitations sortent de terre.</p>
            </div>
          </div>
          <div class="ht-item">
            <div class="ht-dot"></div>
            <div>
              <span class="ht-year">2012</span>
              <p class="ht-desc"><strong>Nouvelle parcelle & piscine</strong> — Achat d'un second terrain. Construction de la piscine à débordement à 10m du lac.</p>
            </div>
          </div>
          <div class="ht-item">
            <div class="ht-dot"></div>
            <div>
              <span class="ht-year">Aujourd'hui</span>
              <p class="ht-desc"><strong>Un établissement complet</strong> — 6 types d'hébergements, restaurant, bains thermaux, salle de sport et excursions.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="hist-visual" data-r="right">
        <div class="hv-main">
          <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=900" alt="Chez Théo les Bains — Vue lac Ahémé Possotomé">
        </div>
        <div class="hv-acc">
          <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600" alt="Hébergements Chez Théo Resort">
        </div>
        <div class="hv-badge">
          <span class="hvb-n">2006</span>
          <span class="hvb-l">Fondé à<br>Possotomé</span>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ CE QUI NOUS DIFFÉRENCIE ══════════════════════════════════ --}}
<section class="diff-section">
  <div class="wrap">
    <div class="tc mb8" data-r="up">
      <div class="sec-lbl" style="justify-content:center;color:var(--teal)">Nos singularités</div>
      <h2 style="font-family:var(--f1);font-size:clamp(2rem,4vw,3.5rem);color:#fff;letter-spacing:-.025em;line-height:1.1">Ce qui nous différencie</h2>
      <p style="font-size:1rem;color:#ffffff;max-width:520px;margin:1rem auto 0;line-height:1.8">Trois atouts qui font de Chez Théo les Bains un lieu unique dans toute la région de Possotomé.</p>
    </div>
    <div class="diff-grid">
      <div class="diff-card" data-r="scale" data-d="1">
        <span class="diff-ic"><i data-lucide="waves" class="lucide-icon"></i></span>
        <div class="diff-title">La Piscine à Débordement</div>
        <p class="diff-desc">Notre piscine thermale à débordement est située à <strong style="color:rgba(255,255,255,.75)">moins de 10 mètres</strong> de la berge du lac Ahémé. Un caractère unique qui nous distingue de tous les concurrents de la région.</p>
      </div>
      <div class="diff-card" data-r="scale" data-d="2">
        <span class="diff-ic"><i data-lucide="home" class="lucide-icon"></i></span>
        <div class="diff-title">Architecture Unique</div>
        <p class="diff-desc">Nos habitations allient <strong style="color:rgba(255,255,255,.75)">architecture traditionnelle béninoise</strong> et <strong style="color:rgba(255,255,255,.75)">confort haut de gamme</strong>. Chaque hébergement offre une expérience authentique et raffinée.</p>
      </div>
      <div class="diff-card" data-r="scale" data-d="3">
        <span class="diff-ic"><i data-lucide="utensils" class="lucide-icon"></i></span>
        <div class="diff-title">Restaurant sur l'Eau</div>
        <p class="diff-desc">Notre restaurant, cœur de métier initial de Chez Théo, propose une <strong style="color:rgba(255,255,255,.75)">cuisine locale de grande qualité</strong> dans un cadre sur pilotis au-dessus du lac — unique au Bénin.</p>
      </div>
    </div>
  </div>
</section>

{{-- ═══ THÉO — LE FONDATEUR ═════════════════════════════════════ --}}
<section class="theo-section">
  <div class="wrap">
    <div class="theo-split">

      <div class="theo-img-wrap" data-r="left">
        <div class="theo-img">
          <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800" alt="Théo — Fondateur de Chez Théo les Bains Possotomé">
        </div>
        <div class="theo-quote">
          <p class="tq-text">« Je veux que chaque client se sente comme à la maison, au bord de notre magnifique lac. »</p>
          <span class="tq-author">— Théo, fondateur</span>
        </div>
      </div>

      <div class="theo-text" data-r="right">
        <div class="sec-lbl">Le fondateur</div>
        <h2>Théo, un Hôte Accueillant et Bienveillant</h2>
        <p>Originaire de <strong>Possotomé</strong>, Théo est le fondateur de cet hôtel-restaurant. Formé dans l'hôtellerie, cet entrepreneur audacieux a su créer un petit <strong>espace de paradis</strong> au bord du lac.</p>
        <p>Avec plus de <strong>10 années</strong> passées dans le monde de <strong>l'hôtellerie</strong> et de la <strong>restauration</strong>, Théo saura vous accueillir au mieux.</p>
        <p>Il marque un point d'honneur à <strong>échanger avec ses clients</strong> et à les <strong>faire se sentir comme à la maison</strong>.</p>
        <div class="theo-feats">
          <div class="tf-item">
            <div class="tf-dot">✓</div>
            Originaire de Possotomé, connaît chaque recoin du lac
          </div>
          <div class="tf-item">
            <div class="tf-dot">✓</div>
            Formé professionnellement en hôtellerie et restauration
          </div>
          <div class="tf-item">
            <div class="tf-dot">✓</div>
            Plus de 10 ans d'expérience dans le secteur
          </div>
          <div class="tf-item">
            <div class="tf-dot">✓</div>
            Présent sur place pour accueillir personnellement ses clients
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ L'ÉQUIPE ════════════════════════════════════════════════ --}}
<section class="equipe-section">
  <div class="wrap">

    <div class="equipe-intro" data-r="up">
      <h2>Notre Équipe</h2>
      <p>Notre équipe est composée de <strong style="color:#fff">jeunes dynamiques</strong> de la région. Motivés et volontaires, ils donnent le meilleur d'eux-mêmes chaque jour. Formés à l'hôtellerie et à la restauration, ils sauront vous faire profiter des <strong style="color:#fff">spécialités locales</strong> dans les meilleures conditions.</p>
    </div>

    @php
    $team = [
      ['name'=>'Thomas',   'role'=>'Gérant',                  'img'=>'1472099645785-5658abf4ff4e'],
      ['name'=>'Wahourou', 'role'=>'Chef Cuisinier',           'img'=>'1472099645785-5658abf4ff4e'],
      ['name'=>'Monica',   'role'=>'Responsable service client','img'=>'1438761681033-6461ffad8d80'],
      ['name'=>'Denis',    'role'=>'Guide',                    'img'=>'1507003211169-0a1dd7228f2d'],
      ['name'=>'Johannes', 'role'=>'Cuisinier',                'img'=>'1506794778202-cad84cf45f1d'],
      ['name'=>'Honorine', 'role'=>'Stagiaire',                'img'=>'1544005313-94ddf0286df2'],
      ['name'=>'Joseph',   'role'=>'Stagiaire',                'img'=>'1519085360753-af0119f7cbe7'],
      ['name'=>'Rosalie',  'role'=>'Stagiaire',                'img'=>'1489424731084-a5d8b219a5bb'],
    ];
    @endphp

    <div class="team-grid">
      @foreach($team as $i => $m)
      <div class="team-card" data-r="scale" data-d="{{ ($i % 4) + 1 }}">
        <div class="team-img">
          <img src="https://images.unsplash.com/photo-{{ $m['img'] }}?w=400&h=400&fit=crop&crop=face" alt="{{ $m['name'] }} — {{ $m['role'] }} Chez Théo les Bains">
          <div class="team-img-ov"></div>
        </div>
        <div class="team-body">
          <div class="team-name">{{ $m['name'] }}</div>
          <div class="team-role">{{ $m['role'] }}</div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>

{{-- ═══ CTA ══════════════════════════════════════════════════════ --}}
<section class="cta-section">
  <div class="wrap">
    <div data-r="up">
      <h2 class="cta-title">Venez nous rendre visite</h2>
      <p class="cta-sub">Théo et son équipe seront ravis de vous accueillir à Possotomé.<br>Réservez votre séjour ou contactez-nous pour plus d'informations.</p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('hebergements.index') }}" class="btn btn-w btn-lg">Voir les hébergements</a>
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
