@extends('layouts.app')

@section('title', 'Contact — Réserver & Nous Joindre | Chez Théo les Bains Possotomé')
@section('description', 'Contactez Chez Théo les Bains pour réserver votre hébergement, organiser une excursion ou toute autre demande. Email, WhatsApp, téléphone ou formulaire. Possotomé, Bénin.')

@push('styles')
<style>
/* ── UTILITAIRES ───────────────────────────────────────────── */
.wrap{max-width:1300px;margin:0 auto;padding:0 2rem}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;font-family:var(--f3);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.9rem 2.2rem;border-radius:999px;transition:all .4s var(--spring);cursor:pointer;border:none;white-space:nowrap}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 6px 26px var(--teal-glow)}
.btn-p:hover{transform:translateY(-3px) scale(1.03);box-shadow:0 12px 42px var(--teal-glow);color:#fff}
.btn-lg{padding:1.1rem 2.8rem;font-size:.82rem}
.sec-lbl{display:inline-flex;align-items:center;gap:.8rem;font-family:var(--f3);font-size:.66rem;font-weight:700;text-transform:uppercase;letter-spacing:.32em;color:var(--teal);margin-bottom:1rem}
.sec-lbl::before{content:'';width:28px;height:1.5px;background:linear-gradient(90deg,var(--teal),var(--teal-light));flex-shrink:0}
[data-r]{opacity:0;transition:opacity .8s var(--ease),transform .8s var(--ease)}
[data-r="up"]{transform:translateY(50px)}
[data-r="left"]{transform:translateX(-50px)}
[data-r="right"]{transform:translateX(50px)}
[data-r].in{opacity:1;transform:none}
[data-d="1"]{transition-delay:.1s}[data-d="2"]{transition-delay:.2s}[data-d="3"]{transition-delay:.3s}[data-d="4"]{transition-delay:.4s}

/* ── PAGE HERO ─────────────────────────────────────────────── */
.page-hero{position:relative;height:55vh;min-height:400px;display:flex;align-items:flex-end;overflow:hidden;background:var(--dark)}
.ph-bg{position:absolute;inset:0}
.ph-bg img{width:100%;height:100%;object-fit:cover}
.ph-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.96) 0%,rgba(8,19,30,.4) 60%,transparent 100%)}
.ph-body{position:relative;z-index:2;max-width:1300px;margin:0 auto;padding:0 2rem 4rem;width:100%}
.ph-title{font-family:var(--f1);font-size:clamp(2.5rem,6vw,5rem);font-weight:600;color:#fff;line-height:1.05;letter-spacing:-.03em;margin-bottom:.6rem}
.ph-sub{font-size:1rem;color:#1a3a50;max-width:500px;line-height:1.75}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-family:var(--f3);font-size:.68rem;text-transform:uppercase;letter-spacing:.15em;color:#fff;margin-bottom:1rem}
.breadcrumb a{color:#fff;transition:.2s}
.breadcrumb a:hover{color:var(--teal)}
.breadcrumb span{color:var(--teal)}
.breadcrumb i{font-size:.5rem;opacity:.5}

/* ── SECTION PRINCIPALE ────────────────────────────────────── */
.contact-section{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 50%);padding:6rem 0 7rem}
.contact-grid{display:grid;grid-template-columns:1.1fr 1fr;gap:5rem;align-items:start}

/* ── FORMULAIRE ────────────────────────────────────────────── */
.form-card{background:#fff;border-radius:28px;padding:3rem 3rem 3.5rem;box-shadow:0 20px 60px rgba(13,27,42,.1);border:1px solid rgba(110,193,228,.15)}
.form-title{font-family:var(--f1);font-size:2rem;font-weight:600;color:var(--dark);margin-bottom:.5rem;letter-spacing:-.02em}
.form-sub{font-size:.9rem;color:#fff;margin-bottom:2.2rem;line-height:1.65}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem}
.form-group{display:flex;flex-direction:column;gap:.5rem;margin-bottom:1.2rem}
.form-group:last-of-type{margin-bottom:0}
.form-label{font-family:var(--f3);font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.18em;color:var(--dark)}
.form-label span{color:var(--teal)}
.form-input,.form-textarea,.form-select{width:100%;font-family:var(--f2,inherit);font-size:.92rem;color:var(--dark);background:#fafcfe;border:1.5px solid rgba(110,193,228,.25);border-radius:12px;padding:.85rem 1.1rem;transition:.3s ease;outline:none;-webkit-appearance:none}
.form-input:focus,.form-textarea:focus,.form-select:focus{border-color:var(--teal);background:#fff;box-shadow:0 0 0 3px rgba(110,193,228,.12)}
.form-input::placeholder,.form-textarea::placeholder{color:rgba(13,27,42,.3)}
.form-textarea{resize:vertical;min-height:130px;line-height:1.65}
.form-select{cursor:pointer;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none' stroke='%236ec1e4' stroke-width='2'%3E%3Cpath d='M1 1l5 5 5-5'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 1rem center}
.form-btn{width:100%;margin-top:1.8rem;padding:1.1rem;font-size:.78rem;border-radius:14px}
.form-btn:disabled{opacity:.6;cursor:not-allowed;transform:none !important}
.form-success{display:none;background:rgba(110,193,228,.1);border:1px solid rgba(110,193,228,.3);border-radius:14px;padding:1.2rem 1.4rem;margin-top:1.2rem;font-size:.9rem;color:var(--teal-dark);text-align:center;font-family:var(--f3);font-weight:600;letter-spacing:.05em}
.form-success.show{display:block}

/* ── INFOS CONTACT ─────────────────────────────────────────── */
.contact-infos{display:flex;flex-direction:column;gap:1.2rem}
.contact-infos h2{font-family:var(--f1);font-size:2.2rem;color:var(--dark);letter-spacing:-.02em;margin-bottom:.4rem}
.contact-infos > p{font-size:.95rem;color:#1a3a50;line-height:1.8;margin-bottom:1rem}

/* ── CARTE INFO ────────────────────────────────────────────── */
.info-card{display:flex;align-items:flex-start;gap:1.1rem;background:#fff;border:1px solid rgba(110,193,228,.18);border-radius:20px;padding:1.4rem 1.6rem;transition:.35s var(--ease);text-decoration:none}
.info-card:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(13,27,42,.1);border-color:rgba(110,193,228,.35)}
.ic-icon{width:44px;height:44px;min-width:44px;border-radius:12px;background:linear-gradient(135deg,var(--teal-xlight),rgba(110,193,228,.15));display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ic-icon i,.ic-icon svg{width:20px;height:20px;stroke:var(--teal-dark);stroke-width:1.75}
.ic-body{display:flex;flex-direction:column;gap:.15rem}
.ic-label{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;color:var(--teal-dark)}
.ic-value{font-family:var(--f1);font-size:1.05rem;color:var(--dark);line-height:1.3}
.ic-sub{font-size:.8rem;color:#fff;margin-top:.1rem}

/* ── CARTE WHATSAPP ────────────────────────────────────────── */
.wa-card{background:linear-gradient(135deg,#25D366,#128C7E);border-radius:20px;padding:1.6rem 1.8rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;text-decoration:none;transition:.35s var(--ease);margin-top:.4rem}
.wa-card:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(37,211,102,.3)}
.wa-left{display:flex;align-items:center;gap:1rem}
.wa-icon{font-size:1.8rem;display:flex;align-items:center}
.wa-icon i,.wa-icon svg{width:28px;height:28px;stroke:#fff;stroke-width:1.75}
.wa-arrow{display:flex;align-items:center}
.wa-arrow i,.wa-arrow svg{width:20px;height:20px;stroke:rgba(255,255,255,.7);stroke-width:2}

/* ── CARTE CARTE GOOGLE MAPS ───────────────────────────────── */
.map-card{border-radius:20px;overflow:hidden;border:1px solid rgba(110,193,228,.18);margin-top:.4rem}
.map-iframe{width:100%;height:220px;display:block;border:none;filter:grayscale(20%) contrast(1.05)}
.map-footer{background:#fff;padding:1rem 1.4rem;display:flex;align-items:center;justify-content:space-between;gap:1rem}
.mf-addr{font-size:.85rem;color:#fff;display:flex;align-items:center;gap:.5rem}
.mf-addr span{font-size:1rem}
.mf-link{font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;color:var(--teal);text-decoration:none;transition:.2s}
.mf-link:hover{color:var(--teal-dark)}

/* ── HORAIRES BANDE ────────────────────────────────────────── */
.horaires-section{background:var(--dark);padding:5rem 0}
.horaires-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:rgba(110,193,228,.1);border-radius:24px;overflow:hidden;margin-top:3rem}
.h-cell{background:var(--dark2);padding:2rem 1.8rem;text-align:center;transition:.3s ease}
.h-cell:hover{background:rgba(110,193,228,.06)}
.h-icon{display:block;margin:0 auto .8rem;width:32px;height:32px;stroke:var(--teal);stroke-width:1.5}
.h-title{font-family:var(--f3);font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;color:var(--teal);display:block;margin-bottom:.5rem}
.h-time{font-family:var(--f1);font-size:1.3rem;color:#fff;display:block;margin-bottom:.2rem}
.h-note{font-size:.78rem;color:rgb(255, 255, 255);line-height:1.5}

/* ── RESPONSIVE ────────────────────────────────────────────── */
@media(max-width:1024px){.contact-grid{grid-template-columns:1fr;gap:3rem}}
@media(max-width:768px){
  .form-row{grid-template-columns:1fr}
  .horaires-grid{grid-template-columns:repeat(2,1fr)}
  .form-card{padding:2rem}
}
@media(max-width:480px){.horaires-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

{{-- ═══ PAGE HERO ═══════════════════════════════════════════════ --}}
<div class="page-hero">
  <div class="ph-bg">
    <img src="https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?w=1920" alt="Contact — Chez Théo les Bains Possotomé Bénin">
  </div>
  <div class="ph-ov"></div>
  <div class="ph-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Accueil</a>
      <i>›</i>
      <span>Contact</span>
    </div>
    <div class="sec-lbl">Parlons-nous</div>
    <h1 class="ph-title">Contactez-nous</h1>
    <p class="ph-sub">Une question, une réservation ou une demande particulière ? Nous répondons rapidement par email ou WhatsApp.</p>
  </div>
</div>

{{-- ═══ FORMULAIRE + INFOS ═══════════════════════════════════════ --}}
<section class="contact-section">
  <div class="wrap">
    <div class="contact-grid">

      {{-- ── FORMULAIRE ── --}}
      <div data-r="left">
        <div class="form-card">
          <div class="sec-lbl">Formulaire de contact</div>
          <h2 class="form-title">Envoyez-nous<br>un message</h2>
          <p class="form-sub">Réservations, excursions, locations, demandes spéciales — toutes vos questions sont les bienvenues.</p>

          <form id="contactForm" action="{{ route('contact.send') }}" method="POST" novalidate>
            @csrf

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="prenom">Prénom</label>
                <input class="form-input" type="text" id="prenom" name="prenom" placeholder="Jean" autocomplete="given-name">
              </div>
              <div class="form-group">
                <label class="form-label" for="nom">Nom <span>*</span></label>
                <input class="form-input" type="text" id="nom" name="nom" placeholder="Dupont" required autocomplete="family-name">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="email">E-mail <span>*</span></label>
              <input class="form-input" type="email" id="email" name="email" placeholder="jean.dupont@email.com" required autocomplete="email">
            </div>

            <div class="form-group">
              <label class="form-label" for="sujet">Sujet</label>
              <select class="form-select form-input" id="sujet" name="sujet">
                <option value="" disabled selected>Choisissez un sujet…</option>
                <option value="hebergement">Réservation hébergement</option>
                <option value="restaurant">Réservation restaurant</option>
                <option value="bains">Bains thermaux & soins</option>
                <option value="excursion">Excursions & circuit 7 jours</option>
                <option value="location">Location (salle, canoë, véhicule)</option>
                <option value="evenement">Événement & privatisation</option>
                <option value="autre">Autre demande</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="message">Message <span>*</span></label>
              <textarea class="form-textarea" id="message" name="message" placeholder="Décrivez votre demande, les dates souhaitées, le nombre de personnes…" required></textarea>
            </div>

            <button type="submit" class="btn btn-p btn-lg form-btn" id="submitBtn">
              Envoyer le message &nbsp;→
            </button>

            <div class="form-success" id="formSuccess">
              ✅ Votre message a bien été envoyé ! Nous vous répondrons dans les plus brefs délais.
            </div>

            @if(session('success'))
              <div class="form-success show">✅ {{ session('success') }}</div>
            @endif
            @if($errors->any())
              <div class="form-success show" style="background:rgba(220,50,50,.08);border-color:rgba(220,50,50,.25);color:#c0392b">
                ⚠️ Veuillez remplir tous les champs obligatoires.
              </div>
            @endif
          </form>
        </div>
      </div>

      {{-- ── INFORMATIONS ── --}}
      <div class="contact-infos" data-r="right">
        <div>
          <div class="sec-lbl">Nos coordonnées</div>
          <h2>Nos Informations</h2>
          <p>Vous pouvez aussi nous joindre directement par email, téléphone ou WhatsApp. Théo et son équipe sont disponibles 7j/7.</p>
        </div>

        <a href="mailto:auberge_theo@yahoo.fr" class="info-card">
          <div class="ic-icon"><i data-lucide="mail"></i></div>
          <div class="ic-body">
            <span class="ic-label">Email</span>
            <span class="ic-value">auberge_theo@yahoo.fr</span>
            <span class="ic-sub">Réponse sous 24h</span>
          </div>
        </a>

        <a href="tel:+22901971831188" class="info-card">
          <div class="ic-icon"><i data-lucide="phone"></i></div>
          <div class="ic-body">
            <span class="ic-label">Téléphone principal</span>
            <span class="ic-value">+229 01 97 18 31 18</span>
            <span class="ic-sub">Du lundi au dimanche</span>
          </div>
        </a>

        <a href="tel:+22901950553155" class="info-card">
          <div class="ic-icon"><i data-lucide="smartphone"></i></div>
          <div class="ic-body">
            <span class="ic-label">Téléphone secondaire</span>
            <span class="ic-value">+229 01 95 05 53 15</span>
            <span class="ic-sub">Du lundi au dimanche</span>
          </div>
        </a>

        <a href="https://wa.me/22901971831188" target="_blank" class="wa-card">
          <div class="wa-left">
            <span class="wa-icon"><i data-lucide="message-circle"></i></span>
            <div class="wa-text">
              <h4>WhatsApp Direct</h4>
              <p>La façon la plus rapide de nous joindre — réponse en quelques minutes</p>
            </div>
          </div>
          <span class="wa-arrow"><i data-lucide="arrow-right"></i></span>
        </a>

        <div class="map-card">
          <iframe
            class="map-iframe"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5!2d1.9708641!3d6.53268!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10248fc23c63a619%3A0xe09c56e91e007af6!2sH%C3%B4tel%20Chez%20Theo!5e0!3m2!1sfr!2sfr!4v1700000000000"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
            title="Localisation Chez Théo les Bains — Possotomé, Bénin">
          </iframe>
          <div class="map-footer">
            <div class="mf-addr">
              <i data-lucide="map-pin" style="width:16px;height:16px;color:var(--teal);flex-shrink:0"></i>
              GXMC +38H, Possotomé, Bénin
            </div>
            <a href="https://www.google.com/maps/place/H%C3%B4tel+Chez+Theo/@6.5355607,1.9758113,14.96z" target="_blank" class="mf-link">
              Ouvrir dans Maps <i data-lucide="external-link" style="width:12px;height:12px;vertical-align:middle"></i>
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

{{-- ═══ HORAIRES ══════════════════════════════════════════════════ --}}
<section class="horaires-section">
  <div class="wrap">
    <div class="tc" data-r="up">
      <div class="sec-lbl" style="justify-content:center;color:var(--teal)">Heures d'ouverture</div>
      <h2 style="font-family:var(--f1);font-size:clamp(2rem,4vw,3.2rem);color:#fff;letter-spacing:-.025em;line-height:1.1">Nos Horaires</h2>
    </div>
    <div class="horaires-grid" data-r="up">
      <div class="h-cell">
        <i data-lucide="sunrise" class="h-icon"></i>
        <span class="h-title">Petit-déjeuner</span>
        <span class="h-time">7h – 10h</span>
        <span class="h-note">Tous les jours</span>
      </div>
      <div class="h-cell">
        <i data-lucide="utensils" class="h-icon"></i>
        <span class="h-title">Déjeuner</span>
        <span class="h-time">12h – 14h</span>
        <span class="h-note">Tous les jours</span>
      </div>
      <div class="h-cell">
        <i data-lucide="moon" class="h-icon"></i>
        <span class="h-title">Dîner</span>
        <span class="h-time">18h – 22h</span>
        <span class="h-note">Tous les jours</span>
      </div>
      <div class="h-cell">
        <i data-lucide="calendar-heart" class="h-icon"></i>
        <span class="h-title">Buffet Dominical</span>
        <span class="h-time">12h – 15h</span>
        <span class="h-note">Chaque dimanche<br>10 000 FCFA / pers.</span>
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
}, {threshold:.08});
document.querySelectorAll('[data-r]').forEach(el => obs.observe(el));

// Feedback visuel sur submit
document.getElementById('contactForm').addEventListener('submit', function(e) {
  const btn = document.getElementById('submitBtn');
  btn.textContent = 'Envoi en cours…';
  btn.disabled = true;
});
</script>
@endpush
