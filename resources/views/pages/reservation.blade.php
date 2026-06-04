@extends('layouts.app')

@section('title', 'Réserver votre séjour | Chez Théo les Bains — Possotomé')
@section('description', 'Réservez et payez en ligne votre hébergement à Chez Théo les Bains. Paiement sécurisé par MTN Mobile Money, Moov Money ou carte bancaire via FedaPay.')

@push('styles')
<style>
.wrap{max-width:1100px;margin:0 auto;padding:0 2rem}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;font-family:var(--f3);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.9rem 2.2rem;border-radius:999px;transition:all .35s var(--spring);cursor:pointer;border:none;white-space:nowrap;text-decoration:none}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 6px 26px var(--teal-glow)}
.btn-p:hover{transform:translateY(-3px);box-shadow:0 12px 42px var(--teal-glow)}
.sec-lbl{display:inline-flex;align-items:center;gap:.8rem;font-family:var(--f3);font-size:.66rem;font-weight:700;text-transform:uppercase;letter-spacing:.32em;color:var(--teal)}
.sec-lbl::before{content:'';width:28px;height:1.5px;background:linear-gradient(90deg,var(--teal),var(--teal-light));flex-shrink:0}
[data-r]{opacity:0;transition:opacity .8s var(--ease),transform .8s var(--ease)}
[data-r="up"]{transform:translateY(40px)}[data-r="left"]{transform:translateX(-40px)}[data-r="right"]{transform:translateX(40px)}
[data-r].in{opacity:1;transform:none}
[data-d="1"]{transition-delay:.1s}[data-d="2"]{transition-delay:.2s}[data-d="3"]{transition-delay:.3s}

/* HERO */
.page-hero{position:relative;height:52vh;min-height:380px;display:flex;align-items:center;overflow:hidden}
.ph-bg{position:absolute;inset:0}.ph-bg img{width:100%;height:100%;object-fit:cover}
.ph-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.97) 0%,rgba(8,19,30,.55) 50%,rgba(8,19,30,.2) 100%)}
.ph-body{position:relative;z-index:2;max-width:1100px;margin:0 auto;padding:0 2rem}
.ph-tag{font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.3em;color:var(--teal);margin-bottom:.8rem}
.ph-title{font-family:var(--f1);font-size:clamp(2.2rem,6vw,4.5rem);font-weight:800;color:#fff;line-height:1.05;letter-spacing:-.04em}
.ph-sub{font-size:.92rem;color:rgba(255,255,255,.7);margin-top:.8rem}

/* LAYOUT */
.resa-section{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 55%);padding:5rem 0 7rem}
.resa-grid{display:grid;grid-template-columns:1fr 360px;gap:3rem;align-items:start}

/* FORM CARD */
.form-card{background:#fff;border-radius:24px;box-shadow:0 8px 40px rgba(13,27,42,.1);overflow:hidden}
.form-header{background:var(--dark);padding:2rem 2.5rem}
.form-header h2{font-family:var(--f1);font-size:1.5rem;font-weight:700;color:#fff;letter-spacing:-.02em}
.form-header p{font-size:.82rem;color:rgba(255,255,255,.55);margin-top:.3rem}
.form-body{padding:2.5rem}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:1.2rem}
.form-group{display:flex;flex-direction:column;gap:.5rem;margin-bottom:1.2rem}
.form-label{font-family:var(--f3);font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;color:var(--teal-dark)}
.form-label .req{color:#e84d4d}
.form-input,.form-select,.form-textarea{width:100%;padding:.85rem 1.1rem;background:#f8fbfd;border:1.5px solid #d4e8f5;border-radius:12px;font-family:var(--f2);font-size:.9rem;color:#08131e;transition:.25s ease;outline:none;appearance:none;-webkit-appearance:none}
.form-input:focus,.form-select:focus,.form-textarea:focus{border-color:var(--teal);background:#fff;box-shadow:0 0 0 4px rgba(110,193,228,.12)}
.form-input::placeholder{color:#9bbfcc}
.form-input.error,.form-select.error{border-color:#e84d4d}
.form-error{font-size:.72rem;color:#e84d4d;display:flex;align-items:center;gap:.3rem;margin-top:.2rem}
.form-select{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%234a7a9b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' viewBox='0 0 24 24'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 1rem center;padding-right:2.5rem}
.form-textarea{resize:vertical;min-height:110px;line-height:1.65}
.form-divider{height:1px;background:linear-gradient(90deg,transparent,#d4e8f5,transparent);margin:1.8rem 0}
.form-section-title{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.28em;color:var(--teal-dark);margin-bottom:1.2rem;display:flex;align-items:center;gap:.6rem}
.form-section-title [data-lucide]{width:14px;height:14px;stroke:var(--teal-dark);stroke-width:2}
.form-section-title::after{content:'';flex:1;height:1px;background:#d4e8f5}

/* OPTION CHAMBRE CUSTOM */
.chambre-grid{display:flex;flex-direction:column;gap:.7rem;margin-bottom:1.2rem}
.chambre-option{position:relative;cursor:pointer}
.chambre-option input[type=radio]{position:absolute;opacity:0;width:0;height:0}
.chambre-label{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.2rem;background:#f8fbfd;border:1.5px solid #d4e8f5;border-radius:14px;transition:.2s ease;gap:1rem}
.chambre-option input:checked + .chambre-label{border-color:var(--teal);background:#e8f6fb;box-shadow:0 0 0 3px rgba(110,193,228,.15)}
.chambre-option.indispo .chambre-label{opacity:.45;cursor:not-allowed;background:#f5f5f5;border-color:#e0e0e0}
.chambre-left{display:flex;align-items:center;gap:.9rem}
.chambre-radio-dot{width:18px;height:18px;min-width:18px;border-radius:50%;border:2px solid #9bbfcc;display:flex;align-items:center;justify-content:center;transition:.2s;flex-shrink:0}
.chambre-option input:checked + .chambre-label .chambre-radio-dot{border-color:var(--teal);background:var(--teal)}
.chambre-option input:checked + .chambre-label .chambre-radio-dot::after{content:'';width:6px;height:6px;border-radius:50%;background:#fff;display:block}
.chambre-info{}
.chambre-name{font-size:.92rem;font-weight:700;color:#08131e}
.chambre-type{font-family:var(--f3);font-size:.58rem;font-weight:600;text-transform:uppercase;letter-spacing:.15em;color:#4a7a9b}
.chambre-right{text-align:right;flex-shrink:0}
.chambre-price{font-family:var(--f1);font-size:1.1rem;font-weight:700;color:var(--teal-dark);letter-spacing:-.02em}
.chambre-price-fcfa{font-size:.7rem;color:#4a7a9b}
.chambre-dispo-badge{font-family:var(--f3);font-size:.55rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;padding:.2rem .6rem;border-radius:999px}
.badge-dispo{background:#e8f9ee;color:#1a7a4a}
.badge-indispo{background:#fde8e8;color:#c0392b}

/* CHECKBOX PETIT-DEJ */
.checkbox-group{display:flex;align-items:center;gap:.9rem;padding:1rem 1.2rem;background:#f0f8fc;border:1.5px solid #c4dff0;border-radius:12px;cursor:pointer;transition:.2s}
.checkbox-group:hover{border-color:var(--teal)}
.checkbox-group input[type=checkbox]{display:none}
.checkbox-box{width:22px;height:22px;min-width:22px;border-radius:6px;border:2px solid #9bbfcc;background:#fff;display:flex;align-items:center;justify-content:center;transition:.2s;flex-shrink:0}
.checkbox-group input:checked + .checkbox-box{background:var(--teal);border-color:var(--teal)}
.checkbox-group input:checked + .checkbox-box::after{content:'✓';color:#fff;font-size:.7rem;font-weight:700}
.checkbox-text strong{display:block;font-size:.88rem;font-weight:600;color:#08131e}
.checkbox-text span{font-size:.75rem;color:#4a7a9b}

/* PAYMENT METHODS */
.payment-methods{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:.6rem}
.pm-badge{display:flex;align-items:center;gap:.4rem;padding:.4rem .9rem;background:#f0f8fc;border:1px solid #c4dff0;border-radius:8px;font-size:.72rem;font-weight:600;color:#2d5a7a}
.pm-badge [data-lucide]{width:13px;height:13px;stroke:var(--teal-dark)}

/* SUBMIT */
.form-submit{width:100%;padding:1.1rem;font-size:.8rem;border-radius:14px;margin-top:1.5rem}
.form-submit [data-lucide]{width:18px;height:18px}
.form-note{font-size:.72rem;color:#4a7a9b;text-align:center;margin-top:.8rem;line-height:1.6}

/* SIDEBAR */
.sidebar{position:sticky;top:100px;display:flex;flex-direction:column;gap:1.2rem}
.price-card{background:var(--dark);border-radius:20px;padding:2rem;border:1px solid rgba(110,193,228,.15)}
.pc-lbl{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;color:rgba(255,255,255,.4);display:block;margin-bottom:.5rem}
.pc-name{font-family:var(--f1);font-size:1.2rem;font-weight:700;color:#fff;margin-bottom:1.2rem;line-height:1.2}
.pc-rows{display:flex;flex-direction:column;margin-bottom:1.2rem}
.pc-row{display:flex;align-items:center;justify-content:space-between;padding:.65rem 0;border-bottom:1px solid rgba(255,255,255,.06)}
.pc-row:last-child{border-bottom:none}
.pc-key{font-size:.75rem;color:rgba(255,255,255,.4);display:flex;align-items:center;gap:.4rem}
.pc-key [data-lucide]{width:13px;height:13px;stroke:rgba(255,255,255,.35);stroke-width:2}
.pc-val{font-size:.85rem;font-weight:600;color:#fff}
.pc-total{background:rgba(110,193,228,.08);border:1px solid rgba(110,193,228,.15);border-radius:14px;padding:1.2rem 1.4rem;margin-bottom:1rem}
.pc-total-lbl{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;color:rgba(255,255,255,.35);display:block;margin-bottom:.5rem}
.pc-total-eur{font-family:var(--f1);font-size:2.2rem;font-weight:800;color:#fff;letter-spacing:-.04em;line-height:1}
.pc-total-fcfa{font-size:.75rem;color:rgba(255,255,255,.35);margin-top:.3rem;display:block}

/* INFO */
.info-card{background:#fff;border:1px solid rgba(110,193,228,.2);border-radius:18px;padding:1.5rem}
.ic-title-sm{font-family:var(--f3);font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;color:var(--teal-dark);display:block;margin-bottom:1rem}
.ic-item{display:flex;align-items:flex-start;gap:.7rem;margin-bottom:.8rem;font-size:.82rem;color:#2d5a7a;line-height:1.5}
.ic-item:last-child{margin-bottom:0}
.ic-item [data-lucide]{width:14px;height:14px;stroke:var(--teal-dark);stroke-width:2;flex-shrink:0;margin-top:2px}

/* ALERT */
.alert-error{background:#fde8e8;border:1px solid #f5a0a0;border-radius:12px;padding:1rem 1.2rem;display:flex;align-items:flex-start;gap:.8rem;margin-bottom:1.5rem;font-size:.88rem;color:#c0392b}
.alert-error [data-lucide]{width:18px;height:18px;stroke:#c0392b;flex-shrink:0;margin-top:1px}

@media(max-width:1024px){.resa-grid{grid-template-columns:1fr}.sidebar{position:static}}
@media(max-width:640px){.form-row{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

{{-- HERO --}}
<div class="page-hero">
  <div class="ph-bg"><img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1920" alt="Réservation Chez Théo"></div>
  <div class="ph-ov"></div>
  <div class="ph-body">
    <div class="ph-tag">Réservation & Paiement en ligne</div>
    <h1 class="ph-title">Réservez votre<br><em style="color:var(--teal);font-style:normal">séjour</em></h1>
    <p class="ph-sub">Possotomé, Lac Ahémé · Confirmation et paiement immédiat · MTN MoMo · Moov · Carte</p>
  </div>
</div>

{{-- ALERTS --}}
@if(session('error'))
<div style="max-width:1100px;margin:2rem auto;padding:0 2rem">
  <div class="alert-error">
    <i data-lucide="alert-triangle"></i>
    {{ session('error') }}
  </div>
</div>
@endif

<section class="resa-section">
  <div class="wrap">
    <div class="resa-grid">

      {{-- FORMULAIRE --}}
      <div data-r="left">
        <div class="sec-lbl" style="margin-bottom:1.5rem">Votre demande</div>
        <div class="form-card">
          <div class="form-header">
            <h2>Formulaire de réservation</h2>
            <p>Remplissez le formulaire · Payez en ligne · Confirmation immédiate</p>
          </div>
          <div class="form-body">
            <form action="{{ route('reservation.store') }}" method="POST" id="resa-form" novalidate>
              @csrf

              {{-- DATES D'ABORD (pour calculer la dispo) --}}
              <div class="form-section-title"><i data-lucide="calendar"></i> Dates de séjour</div>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="date_arrivee">Arrivée <span class="req">*</span></label>
                  <input type="date" name="date_arrivee" id="date_arrivee"
                    class="form-input {{ $errors->has('date_arrivee') ? 'error' : '' }}"
                    value="{{ old('date_arrivee', $arrivee) }}"
                    min="{{ now()->format('Y-m-d') }}" required>
                  @error('date_arrivee') <span class="form-error"><i data-lucide="alert-circle"></i> {{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="date_depart">Départ <span class="req">*</span></label>
                  <input type="date" name="date_depart" id="date_depart"
                    class="form-input {{ $errors->has('date_depart') ? 'error' : '' }}"
                    value="{{ old('date_depart', $depart) }}"
                    min="{{ now()->addDay()->format('Y-m-d') }}" required>
                  @error('date_depart') <span class="form-error"><i data-lucide="alert-circle"></i> {{ $message }}</span> @enderror
                </div>
              </div>

              {{-- HÉBERGEMENT --}}
              <div class="form-section-title"><i data-lucide="home"></i> Choisissez votre hébergement</div>

              @error('chambre')
                <div class="alert-error"><i data-lucide="alert-triangle"></i> {{ $message }}</div>
              @enderror

              <div class="chambre-grid" id="chambre-grid">
                @foreach($chambres as $nom => $info)
                @php $isIndispo = in_array($nom, $indisponibles); @endphp
                <div class="chambre-option {{ $isIndispo ? 'indispo' : '' }}" data-chambre="{{ $nom }}" data-eur="{{ $info['eur'] }}" data-fcfa="{{ $info['fcfa'] }}">
                  <input type="radio" name="chambre" id="ch_{{ Str::slug($nom) }}"
                    value="{{ $nom }}"
                    {{ old('chambre') === $nom ? 'checked' : '' }}
                    {{ $isIndispo ? 'disabled' : '' }}>
                  <label class="chambre-label" for="ch_{{ Str::slug($nom) }}">
                    <div class="chambre-left">
                      <div class="chambre-radio-dot"></div>
                      <div class="chambre-info">
                        <div class="chambre-name">{{ $nom }}</div>
                        <div class="chambre-type">{{ $info['type'] }} · max {{ $info['max'] }} pers.</div>
                      </div>
                    </div>
                    <div class="chambre-right">
                      <div class="chambre-price">{{ $info['eur'] }} €<span style="font-size:.72rem;font-weight:400;color:inherit"> /nuit</span></div>
                      <div class="chambre-price-fcfa">{{ number_format($info['fcfa'], 0, ',', ' ') }} FCFA</div>
                      <div class="chambre-dispo-badge {{ $isIndispo ? 'badge-indispo' : 'badge-dispo' }}" id="badge_{{ Str::slug($nom) }}">
                        {{ $isIndispo ? 'Indisponible' : 'Disponible' }}
                      </div>
                    </div>
                  </label>
                </div>
                @endforeach
              </div>

              {{-- VOYAGEURS --}}
              <div class="form-section-title"><i data-lucide="users"></i> Voyageurs</div>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="adultes">Adultes <span class="req">*</span></label>
                  <select name="adultes" id="adultes" class="form-select" required>
                    @for($i = 1; $i <= 6; $i++)
                    <option value="{{ $i }}" {{ old('adultes', 2) == $i ? 'selected' : '' }}>{{ $i }} adulte{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label" for="enfants">Enfants</label>
                  <select name="enfants" id="enfants" class="form-select">
                    @for($i = 0; $i <= 4; $i++)
                    <option value="{{ $i }}" {{ old('enfants', 0) == $i ? 'selected' : '' }}>{{ $i }} enfant{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                  </select>
                </div>
              </div>

              {{-- PETIT-DEJ --}}
              <div class="form-group">
                <label class="checkbox-group" for="petit_dej">
                  <input type="checkbox" name="petit_dej" id="petit_dej" value="1" {{ old('petit_dej') ? 'checked' : '' }}>
                  <div class="checkbox-box"></div>
                  <div class="checkbox-text">
                    <strong>Inclure le petit-déjeuner</strong>
                    <span>Fruits frais, jus d'ananas pressé, pain local — chaque matin</span>
                  </div>
                </label>
              </div>

              <div class="form-divider"></div>

              {{-- COORDONNÉES --}}
              <div class="form-section-title"><i data-lucide="user"></i> Vos coordonnées</div>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="prenom">Prénom <span class="req">*</span></label>
                  <input type="text" name="prenom" id="prenom" class="form-input {{ $errors->has('prenom') ? 'error' : '' }}" value="{{ old('prenom') }}" placeholder="Votre prénom" required>
                  @error('prenom') <span class="form-error"><i data-lucide="alert-circle"></i> {{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="nom">Nom <span class="req">*</span></label>
                  <input type="text" name="nom" id="nom" class="form-input {{ $errors->has('nom') ? 'error' : '' }}" value="{{ old('nom') }}" placeholder="Votre nom" required>
                  @error('nom') <span class="form-error"><i data-lucide="alert-circle"></i> {{ $message }}</span> @enderror
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="email">Email <span class="req">*</span></label>
                  <input type="email" name="email" id="email" class="form-input {{ $errors->has('email') ? 'error' : '' }}" value="{{ old('email') }}" placeholder="vous@email.com" required>
                  @error('email') <span class="form-error"><i data-lucide="alert-circle"></i> {{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="telephone">Téléphone <span class="req">*</span></label>
                  <input type="tel" name="telephone" id="telephone" class="form-input {{ $errors->has('telephone') ? 'error' : '' }}" value="{{ old('telephone') }}" placeholder="+229 00 00 00 00" required>
                  @error('telephone') <span class="form-error"><i data-lucide="alert-circle"></i> {{ $message }}</span> @enderror
                </div>
              </div>
              <div class="form-group">
                <label class="form-label" for="message">Demandes spéciales</label>
                <textarea name="message" id="message" class="form-textarea" placeholder="Allergies, lit bébé, occasion spéciale, heure d'arrivée...">{{ old('message') }}</textarea>
              </div>

              <div class="form-divider"></div>

              {{-- PAIEMENT --}}
              <div class="form-section-title"><i data-lucide="credit-card"></i> Paiement sécurisé via FedaPay</div>
              <div class="payment-methods">
                <div class="pm-badge"><i data-lucide="smartphone"></i> MTN Mobile Money</div>
                <div class="pm-badge"><i data-lucide="smartphone"></i> Moov Money</div>
                <div class="pm-badge"><i data-lucide="credit-card"></i> Carte bancaire</div>
                <div class="pm-badge"><i data-lucide="shield-check"></i> Paiement 100% sécurisé</div>
              </div>
              <p style="font-size:.78rem;color:#4a7a9b;margin-top:.8rem;line-height:1.6">
                Vous serez redirigé vers la page de paiement sécurisée FedaPay. Le paiement intégral est requis pour confirmer votre réservation.
              </p>

              <button type="submit" class="btn btn-p form-submit" id="submit-btn">
                <i data-lucide="lock"></i>
                <span>Procéder au paiement sécurisé</span>
              </button>
              <p class="form-note">
                <i data-lucide="shield-check" style="width:13px;height:13px;stroke:var(--teal-dark);stroke-width:2;vertical-align:middle"></i>
                Paiement sécurisé par FedaPay · Votre chambre est bloquée dès le paiement confirmé
              </p>
            </form>
          </div>
        </div>
      </div>

      {{-- SIDEBAR --}}
      <div class="sidebar" data-r="right">

        {{-- Calculateur --}}
        <div class="price-card">
          <span class="pc-lbl">Estimation du séjour</span>
          <div class="pc-name" id="pc-name">Sélectionnez un hébergement</div>
          <div class="pc-rows">
            <div class="pc-row"><span class="pc-key"><i data-lucide="calendar"></i> Arrivée</span><span class="pc-val" id="pc-arrivee">—</span></div>
            <div class="pc-row"><span class="pc-key"><i data-lucide="calendar-check"></i> Départ</span><span class="pc-val" id="pc-depart">—</span></div>
            <div class="pc-row"><span class="pc-key"><i data-lucide="moon"></i> Nuits</span><span class="pc-val" id="pc-nuits">—</span></div>
            <div class="pc-row"><span class="pc-key"><i data-lucide="users"></i> Voyageurs</span><span class="pc-val" id="pc-voyageurs">—</span></div>
          </div>
          <div class="pc-total">
            <span class="pc-total-lbl">Total à payer</span>
            <div class="pc-total-eur" id="pc-total-eur">—</div>
            <span class="pc-total-fcfa" id="pc-total-fcfa"></span>
          </div>
          <p style="font-size:.7rem;color:rgba(255,255,255,.25);line-height:1.6">Paiement intégral via FedaPay. MTN MoMo, Moov Money ou carte.</p>
        </div>

        {{-- Infos --}}
        <div class="info-card">
          <span class="ic-title-sm">Informations importantes</span>
          <div class="ic-item"><i data-lucide="check-circle"></i> Confirmation immédiate après paiement</div>
          <div class="ic-item"><i data-lucide="clock"></i> Check-in 14h · Check-out 11h</div>
          <div class="ic-item"><i data-lucide="x-circle"></i> Annulation gratuite jusqu'à 72h avant</div>
          <div class="ic-item"><i data-lucide="shield"></i> Paiement 100% sécurisé par FedaPay</div>
          <div class="ic-item"><i data-lucide="map-pin"></i> GXMC+38H, Possotomé, Bénin</div>
        </div>

        {{-- Contact --}}
        <div class="info-card" style="text-align:center">
          <span class="ic-title-sm" style="text-align:left;display:block">Besoin d'aide ?</span>
          <p style="font-size:.82rem;color:#2d5a7a;margin-bottom:1.2rem;line-height:1.6">Notre équipe répond de 8h à 20h, tous les jours.</p>
          <a href="https://wa.me/22901971831188" target="_blank" class="btn btn-p" style="width:100%;border-radius:12px;margin-bottom:.6rem;justify-content:center">
            <i data-lucide="message-circle"></i> WhatsApp
          </a>
          <a href="tel:+22901950553155" class="btn" style="width:100%;border-radius:12px;background:#f0f8fc;color:var(--teal-dark);justify-content:center">
            <i data-lucide="phone"></i> +229 01 95 05 53 15
          </a>
        </div>

      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
lucide.createIcons();

const obs = new IntersectionObserver(e => e.forEach(el => { if(el.isIntersecting) el.target.classList.add('in'); }),{threshold:.08});
document.querySelectorAll('[data-r]').forEach(el => obs.observe(el));

// ── Calculateur temps réel ──────────────────────────────────
const arriveeEl  = document.getElementById('date_arrivee');
const departEl   = document.getElementById('date_depart');
const adultesEl  = document.getElementById('adultes');
const enfantsEl  = document.getElementById('enfants');

function formatDate(str) {
  if (!str) return '—';
  return new Date(str + 'T00:00:00').toLocaleDateString('fr-FR', {weekday:'short',day:'numeric',month:'short'});
}

function getSelectedChambre() {
  const checked = document.querySelector('input[name=chambre]:checked');
  if (!checked) return null;
  const opt = checked.closest('.chambre-option');
  return { nom: checked.value, eur: parseInt(opt.dataset.eur), fcfa: parseInt(opt.dataset.fcfa) };
}

function updateCalc() {
  const arrivee  = arriveeEl.value;
  const depart   = departEl.value;
  const adultes  = parseInt(adultesEl.value) || 0;
  const enfants  = parseInt(enfantsEl.value) || 0;
  const chambre  = getSelectedChambre();

  document.getElementById('pc-arrivee').textContent  = formatDate(arrivee);
  document.getElementById('pc-depart').textContent   = formatDate(depart);
  document.getElementById('pc-voyageurs').textContent = adultes + enfants > 0
    ? `${adultes} adulte${adultes>1?'s':''}${enfants ? ', '+enfants+' enfant'+(enfants>1?'s':'') : ''}` : '—';

  if (chambre) document.getElementById('pc-name').textContent = chambre.nom;

  if (chambre && arrivee && depart) {
    const nuits = Math.round((new Date(depart) - new Date(arrivee)) / 86400000);
    if (nuits > 0) {
      document.getElementById('pc-nuits').textContent    = nuits + ' nuit' + (nuits>1?'s':'');
      document.getElementById('pc-total-eur').textContent  = (chambre.eur * nuits).toLocaleString('fr-FR') + ' €';
      document.getElementById('pc-total-fcfa').textContent = '≈ ' + (chambre.fcfa * nuits).toLocaleString('fr-FR') + ' FCFA';
      return;
    }
  }
  document.getElementById('pc-nuits').textContent    = '—';
  document.getElementById('pc-total-eur').textContent  = '—';
  document.getElementById('pc-total-fcfa').textContent = '';
}

document.querySelectorAll('input[name=chambre]').forEach(r => r.addEventListener('change', updateCalc));
[arriveeEl, departEl, adultesEl, enfantsEl].forEach(el => el.addEventListener('change', updateCalc));

arriveeEl.addEventListener('change', function() {
  if (departEl.value && departEl.value <= this.value) {
    const d = new Date(this.value + 'T00:00:00'); d.setDate(d.getDate()+1);
    departEl.value = d.toISOString().split('T')[0];
  }
  departEl.min = this.value;
  checkDisponibilite();
});
departEl.addEventListener('change', checkDisponibilite);

// ── Vérification dispo en temps réel ───────────────────────
let dispoTimer = null;
function checkDisponibilite() {
  const arrivee = arriveeEl.value;
  const depart  = departEl.value;
  if (!arrivee || !depart || depart <= arrivee) return;

  clearTimeout(dispoTimer);
  dispoTimer = setTimeout(async () => {
    try {
      const res  = await fetch(`{{ route('reservation.disponibilite') }}?arrivee=${arrivee}&depart=${depart}`);
      const data = await res.json();
      const indispo = data.indisponibles || [];

      document.querySelectorAll('.chambre-option').forEach(opt => {
        const nom    = opt.dataset.chambre;
        const radio  = opt.querySelector('input[type=radio]');
        const badge  = opt.querySelector('.chambre-dispo-badge');
        const isOff  = indispo.includes(nom);

        opt.classList.toggle('indispo', isOff);
        radio.disabled = isOff;
        if (isOff && radio.checked) { radio.checked = false; updateCalc(); }
        badge.textContent = isOff ? 'Indisponible' : 'Disponible';
        badge.className   = 'chambre-dispo-badge ' + (isOff ? 'badge-indispo' : 'badge-dispo');
      });
    } catch(e) { /* silencieux */ }
  }, 600);
}

// ── Spin au submit ──────────────────────────────────────────
document.getElementById('resa-form').addEventListener('submit', function() {
  const btn = document.getElementById('submit-btn');
  btn.disabled = true;
  btn.innerHTML = '<i data-lucide="loader-2" style="animation:spin .7s linear infinite"></i><span>Redirection vers le paiement...</span>';
  lucide.createIcons();
});

updateCalc();
</script>
@endpush
