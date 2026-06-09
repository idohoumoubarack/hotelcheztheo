@extends('layouts.app')

@section('title', 'Hôtel Restaurant Possotomé — Chez Théo les Bains')
@section('description', 'Hôtel-restaurant au bord du lac Ahémé à Possotomé. Bains thermaux naturels, restaurant sur pilotis, excursions au Bénin.')

@push('styles')
<style>
/* ── Classes spécifiques page accueil ── */
.hero{position:relative;height:100vh;min-height:680px;display:flex;align-items:center;justify-content:center;overflow:hidden;background:var(--dark)}
.hero-bg{position:absolute;inset:0;background:url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1920') center/cover no-repeat;transform:scale(1.08)}
.hero-ov{position:absolute;inset:0;background:linear-gradient(160deg,rgba(8,19,30,.90) 0%,rgba(8,19,30,.62) 50%,rgba(8,19,30,.3) 80%,rgba(110,193,228,.08) 100%)}
.hero-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(110,193,228,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(110,193,228,.04) 1px,transparent 1px);background-size:60px 60px;transform:perspective(600px) rotateX(20deg) scale(1.2);transform-origin:center bottom;pointer-events:none;opacity:.6}
.hero-orb{position:absolute;border-radius:50%;filter:blur(60px);pointer-events:none}
.orb1{width:600px;height:600px;background:radial-gradient(circle,rgba(110,193,228,.18) 0%,transparent 70%);top:-10%;right:-15%;animation:orbFloat 8s ease-in-out infinite}
.orb2{width:400px;height:400px;background:radial-gradient(circle,rgba(58,158,199,.12) 0%,transparent 70%);bottom:-5%;left:-10%;animation:orbFloat 10s ease-in-out infinite reverse}
@keyframes orbFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-30px)}}
.particles{position:absolute;inset:0;overflow:hidden;pointer-events:none}
.p{position:absolute;border-radius:50%;background:var(--teal);animation:pFloat var(--d,6s) var(--dl,0s) ease-in-out infinite}
@keyframes pFloat{0%{opacity:0;transform:translate(0,0) scale(.5)}20%{opacity:.5}80%{opacity:.2}100%{opacity:0;transform:translate(var(--tx,30px),var(--ty,-120px)) scale(1.3)}}
.hero-body{position:relative;z-index:2;text-align:center;max-width:980px;padding:0 2rem}
.hero-ey{display:inline-flex;align-items:center;gap:1rem;font-family:var(--f3);font-size:.68rem;font-weight:600;text-transform:uppercase;letter-spacing:.35em;color:var(--teal);margin-bottom:1.8rem}
.hero-ey::before,.hero-ey::after{content:'';width:36px;height:1px;background:linear-gradient(90deg,transparent,var(--teal))}
.hero-ey::after{background:linear-gradient(90deg,var(--teal),transparent)}
.hero-title{font-family:var(--f1);font-size:clamp(3.2rem,8vw,7.5rem);font-weight:800;color:#fff;line-height:1.05;letter-spacing:-.04em;margin-bottom:1.8rem}
.hero-title em{color:var(--teal);font-style:normal;font-weight:800}
.hero-sub{font-family:var(--f2);font-size:clamp(1rem,1.5vw,1.18rem);color:#fff;max-width:520px;margin:0 auto 2.8rem;line-height:1.85}
.hero-btns{display:flex;align-items:center;justify-content:center;gap:1rem;flex-wrap:wrap}
.hero-scroll{position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);z-index:2;display:flex;flex-direction:column;align-items:center;gap:.4rem;font-family:var(--f3);font-size:.58rem;text-transform:uppercase;letter-spacing:.3em;color:#fff;cursor:pointer}
.scroll-line{width:1px;height:46px;background:linear-gradient(to bottom,var(--teal),transparent);animation:sl 2s ease-in-out infinite}
@keyframes sl{0%,100%{opacity:.5}50%{opacity:1;transform:scaleY(.65)}}
.hero-stats{position:absolute;bottom:1rem;left:50%;transform:translateX(-50%);z-index:2;display:flex;gap:3rem;align-items:center}
.hs-item{text-align:center}
.hs-num{font-family:var(--f1);font-size:2rem;font-weight:700;color:var(--teal);line-height:1;display:block}
.hs-lbl{font-family:var(--f3);font-size:.58rem;text-transform:uppercase;letter-spacing:.2em;color:rgba(255,255,255,.42);display:block;margin-top:.3rem}
.hs-sep{width:1px;height:36px;background:rgba(255,255,255,.12)}

/* Booking bar */
#bbar{position:fixed;bottom:1.5rem;left:50%;transform:translateX(-50%) translateY(120px);z-index:900;width:calc(100% - 3rem);max-width:940px;background:rgba(6,14,24,.95);backdrop-filter:blur(28px) saturate(180%);border:1px solid rgba(110,193,228,.22);border-radius:999px;padding:.95rem 1.2rem;display:flex;align-items:center;gap:.8rem;box-shadow:0 24px 60px rgba(0,0,0,.45),inset 0 1px 0 rgba(255,255,255,.04);transition:transform .55s var(--ease),opacity .45s ease;opacity:0}
#bbar.vis{transform:translateX(-50%) translateY(0);opacity:1}
.bf{flex:1;min-width:0;display:flex;flex-direction:column;gap:1px}
.bf label{font-family:var(--f3);font-size:.57rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;color:var(--teal);white-space:nowrap}
.bf input,.bf select{background:transparent;border:none;outline:none;font-family:var(--f2);font-size:.87rem;color:#fff;width:100%;cursor:pointer}
.bf input::placeholder{color:#fff}
.bf select option{background:var(--dark2)}
.bsep{width:1px;height:30px;background:rgba(110,193,228,.15);flex-shrink:0}

/* Services band */
#services-band{background:var(--dark2);padding:2.2rem 0;border-top:1px solid rgba(110,193,228,.1);border-bottom:1px solid rgba(110,193,228,.1)}
.sb-inner{display:flex;align-items:center;justify-content:center;gap:3rem;flex-wrap:wrap}
.sb-item{display:flex;align-items:center;gap:.7rem;font-family:var(--f3);font-size:.72rem;font-weight:600;text-transform:uppercase;letter-spacing:.14em;color:#fff}
.sb-item .ic{width:32px;height:32px;min-width:32px;border-radius:8px;background:rgba(110,193,228,.12);backdrop-filter:blur(12px);border:1px solid rgba(110,193,228,.22);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sb-item .ic [data-lucide]{width:14px;height:14px;stroke:var(--teal);stroke-width:2}
.sb-sep{width:1px;height:24px;background:rgba(255,255,255,.1)}

/* Rooms */
.rooms-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2rem}
.rc{background:#fff;border-radius:24px;overflow:hidden;box-shadow:0 4px 20px rgba(110,193,228,.1);transition:all .45s var(--ease)}
.rc:hover{transform:translateY(-14px);box-shadow:0 28px 60px rgba(13,27,42,.22),0 0 0 1px rgba(110,193,228,.15)}
.rc-img{position:relative;height:265px;overflow:hidden}
.rc-img img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.rc:hover .rc-img img{transform:scale(1.1)}
.rc-badge{position:absolute;top:1rem;left:1rem;font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.14em;padding:.3rem .8rem;border-radius:999px;background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 4px 14px var(--teal-glow)}
.rc-reveal{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.85) 0%,transparent 55%);opacity:0;transition:.4s var(--ease);display:flex;align-items:flex-end;padding:1.4rem}
.rc:hover .rc-reveal{opacity:1}
.rc-body{padding:1.5rem 1.6rem 1.8rem}
.rc-name{font-family:var(--f1);font-size:1.5rem;font-weight:600;color:var(--dark);margin-bottom:.55rem}
.rc-meta{display:flex;flex-wrap:wrap;gap:.7rem;margin-bottom:.85rem}
.rc-m{display:flex;align-items:center;gap:.3rem;font-family:var(--f3);font-size:.65rem;font-weight:500;text-transform:uppercase;letter-spacing:.1em;color:#fff}
.rc-price{display:flex;align-items:baseline;gap:.22rem;margin-bottom:1rem}
.price-n{font-family:var(--f1);font-size:2.3rem;font-weight:700;color:var(--teal-dark);line-height:1}
.price-c{font-family:var(--f3);font-size:.88rem;font-weight:700;color:var(--teal-dark)}
.price-p{font-size:.78rem;color:#fff}
.rc-tags{display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:1.1rem}
.rct{font-family:var(--f3);font-size:.6rem;font-weight:600;text-transform:uppercase;letter-spacing:.1em;padding:.26rem .68rem;border-radius:999px;background:var(--teal-xlight);color:var(--teal-dark);border:1px solid rgba(110,193,228,.28)}
.rc-foot{display:flex;align-items:center;justify-content:space-between;gap:.8rem}

/* Stats */
#stats{background:linear-gradient(135deg,var(--dark) 0%,var(--dark2) 100%);padding:7rem 0;position:relative;overflow:hidden}
#stats::before{content:'';position:absolute;top:-40%;right:-10%;width:700px;height:700px;border-radius:50%;background:radial-gradient(circle,rgba(110,193,228,.08) 0%,transparent 70%);pointer-events:none}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem}
.stat-b{text-align:center;padding:2.5rem 1rem;border-radius:20px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.05);transition:.4s var(--ease)}
.stat-b:hover{background:rgba(110,193,228,.06);border-color:rgba(110,193,228,.2);transform:translateY(-4px)}
.stat-n{font-family:var(--f1);font-size:clamp(3rem,5vw,4.8rem);font-weight:700;color:var(--teal);line-height:1;display:block;margin-bottom:.5rem}
.stat-l{font-family:var(--f3);font-size:.66rem;font-weight:600;text-transform:uppercase;letter-spacing:.28em;color:#fff}

/* Bains */
#bains{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 60%);padding:7rem 0}
.wellness-grid{display:grid;grid-template-columns:1.15fr 1fr;gap:4rem;align-items:center}
.wstack{position:relative;height:550px}
.ws-main{position:absolute;top:0;left:0;width:73%;height:78%;border-radius:24px;overflow:hidden;box-shadow:0 20px 60px rgba(13,27,42,.25);z-index:2}
.ws-acc{position:absolute;bottom:0;right:0;width:53%;height:55%;border-radius:24px;overflow:hidden;box-shadow:0 20px 60px rgba(13,27,42,.25);z-index:3;border:4px solid #fff}
.ws-main img,.ws-acc img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.ws-main:hover img,.ws-acc:hover img{transform:scale(1.06)}
.ws-badge{position:absolute;top:32%;right:-16px;z-index:5;background:var(--dark);border:1px solid rgba(110,193,228,.25);border-radius:18px;padding:1rem 1.2rem;text-align:center;box-shadow:0 20px 50px rgba(0,0,0,.35);min-width:108px}
.wsb-n{font-family:var(--f1);font-size:2.3rem;font-weight:700;color:var(--teal);line-height:1;display:block}
.wsb-l{font-family:var(--f3);font-size:.57rem;font-weight:600;text-transform:uppercase;letter-spacing:.17em;color:#fff;display:block;margin-top:.28rem}
.wellness-list{margin:1.5rem 0;display:flex;flex-direction:column;gap:.7rem}
.wli{display:flex;align-items:flex-start;gap:.75rem;font-size:.94rem;color:#000000;line-height:1.6}
.wli-dot{width:20px;height:20px;min-width:20px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;margin-top:2px;font-size:.6rem;color:#fff;flex-shrink:0}

/* Restaurant */
#resto{padding:0;overflow:hidden}
.resto-split{display:grid;grid-template-columns:1fr 1fr;min-height:600px}
.resto-media{position:relative;overflow:hidden}
.resto-media img{width:100%;height:100%;object-fit:cover;transition:transform .9s var(--ease)}
.resto-split:hover .resto-media img{transform:scale(1.04)}
.resto-media-overlay{position:absolute;inset:0;background:linear-gradient(to right,transparent,rgba(8,19,30,.08))}
.resto-body{background:var(--dark);padding:5rem 4.5rem;display:flex;flex-direction:column;justify-content:center}
.menu-preview{margin:1.5rem 0;display:flex;flex-direction:column;gap:.6rem}
.mp-item{display:flex;align-items:center;justify-content:space-between;padding:.7rem 1rem;border-radius:10px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06);transition:.2s ease}
.mp-item:hover{background:rgba(110,193,228,.08);border-color:rgba(110,193,228,.2)}
.mp-name{font-family:var(--f1);font-size:1.1rem;color:#ffffff}
.mp-dots{flex:1;height:1px;border-top:1px dotted rgba(255,255,255,.12);margin:0 .8rem}
.mp-price{font-family:var(--f3);font-size:.75rem;font-weight:700;color:var(--teal);letter-spacing:.05em}

/* Excursions */
#excursions{background:var(--teal-xlight);padding:7rem 0}
.exc-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.2rem}
.exc{position:relative;border-radius:22px;overflow:hidden;aspect-ratio:2/3;cursor:pointer;transition:.4s var(--ease)}
.exc:hover{transform:translateY(-8px);box-shadow:0 28px 60px rgba(13,27,42,.22)}
.exc-img{position:absolute;inset:0}
.exc-img img{width:100%;height:100%;object-fit:cover;transition:transform .8s var(--ease)}
.exc:hover .exc-img img{transform:scale(1.1)}
.exc-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,19,30,.94) 0%,rgba(8,19,30,.3) 60%,transparent 100%);transition:.4s var(--ease)}
.exc:hover .exc-ov{background:linear-gradient(to top,rgba(8,19,30,.97) 0%,rgba(8,19,30,.5) 60%,transparent 100%)}
.exc-body{position:absolute;bottom:0;left:0;right:0;padding:1.8rem 1.4rem}
.exc-cat{font-family:var(--f3);font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.22em;color:var(--teal);display:block;margin-bottom:.4rem}
.exc-name{font-family:var(--f1);font-size:1.3rem;font-weight:600;color:#fff;margin-bottom:.3rem;line-height:1.2}
.exc-dur{font-family:var(--f3);font-size:.68rem;color:rgba(255,255,255,.48);text-transform:uppercase;letter-spacing:.1em}
.exc-btn{display:inline-flex;align-items:center;gap:.38rem;font-family:var(--f3);font-size:.66rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;color:#fff;background:rgba(110,193,228,.18);backdrop-filter:blur(8px);border:1px solid rgba(110,193,228,.4);padding:.42rem .95rem;border-radius:999px;margin-top:.85rem;opacity:0;transform:translateY(8px);transition:.4s var(--ease)}
.exc:hover .exc-btn{opacity:1;transform:translateY(0)}

/* Galerie */
#galerie{background:var(--dark);padding:5rem 0}
.gallery-mosaic{display:grid;grid-template-columns:repeat(4,1fr);grid-template-rows:repeat(2,250px);gap:.7rem;border-radius:20px;overflow:hidden}
.g-i{position:relative;overflow:hidden;cursor:zoom-in}
.g-i:first-child{grid-column:span 2;grid-row:span 2}
.g-i img{width:100%;height:100%;object-fit:cover;transition:transform .7s var(--ease)}
.g-i:hover img{transform:scale(1.08)}
.g-i::after{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(110,193,228,.25),transparent);opacity:0;transition:.3s ease}
.g-i:hover::after{opacity:1}

/* Avis */
#avis{background:linear-gradient(160deg,var(--teal-xlight) 0%,#fff 80%);padding:7rem 0}
.avis-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.8rem}
.av{background:#fff;border-radius:22px;padding:2rem;border:1px solid #e8f0f5;box-shadow:0 4px 20px rgba(110,193,228,.09);transition:.4s var(--ease);position:relative}
.av:hover{box-shadow:0 16px 44px rgba(110,193,228,.18);transform:translateY(-6px);border-color:var(--teal-light)}
.av-stars{display:flex;gap:.15rem;margin-bottom:.9rem;color:#f5a623;font-size:.88rem}
.av-q{font-family:var(--f1);font-size:4rem;color:var(--teal-xlight);line-height:.6;margin-bottom:.3rem}
.av-text{font-size:.91rem;color:#030101;line-height:1.78;font-style:italic;margin-bottom:1.4rem}
.av-user{display:flex;align-items:center;gap:.75rem}
.av-ava{width:42px;height:42px;border-radius:50%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));display:flex;align-items:center;justify-content:center;font-family:var(--f1);font-size:1rem;font-weight:700;color:#fff;flex-shrink:0}
.av-name{font-family:var(--f3);font-size:.8rem;font-weight:700;color:var(--dark)}
.av-loc{font-size:.73rem;color:#fff}
.av-plat{position:absolute;top:1.1rem;right:1.1rem;font-family:var(--f3);font-size:.57rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--teal-dark);background:var(--teal-xlight);padding:.2rem .6rem;border-radius:999px}

/* Info barre */
#infobarre{background:linear-gradient(135deg,var(--teal-dark),var(--teal));padding:3rem 0}
.ib-inner{display:flex;align-items:center;justify-content:space-around;flex-wrap:wrap;gap:2rem}
.ib-item{display:flex;align-items:center;gap:1rem;color:#fff}
.ib-icon{width:46px;height:46px;min-width:46px;border-radius:13px;background:rgba(255,255,255,.14);border:1px solid rgba(255,255,255,.22);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ib-icon [data-lucide]{width:18px;height:18px;stroke:#fff;stroke-width:1.8}
.ib-title{font-family:var(--f3);font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;opacity:.75}
.ib-val{font-family:var(--f1);font-size:1.15rem;font-weight:600;margin-top:.1rem}
.ib-val a{color:inherit}

/* Utils */
.tc{text-align:center}.mxa{margin:0 auto}
.mb8{margin-bottom:4rem}.mb4{margin-bottom:2rem}.mt6{margin-top:3rem}.mt4{margin-top:2rem}
.fcj{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1.5rem}
.sec-lbl{display:inline-flex;align-items:center;gap:.8rem;font-family:var(--f3);font-size:.66rem;font-weight:700;text-transform:uppercase;letter-spacing:.32em;color:var(--teal);margin-bottom:1rem}
.sec-lbl::before{content:'';width:28px;height:1.5px;background:linear-gradient(90deg,var(--teal),var(--teal-light));flex-shrink:0}
.sec-title{font-family:var(--f1);letter-spacing:-.025em;line-height:1.1;margin-bottom:1.2rem;color:var(--dark)}
.sec-title.w{color:#fff}
.sec-desc{font-size:1.04rem;color:#ffffff;line-height:1.83;max-width:560px}
.sec-desc.w{color:#ffffff}


.btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;font-family:var(--f3);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;padding:.9rem 2.2rem;border-radius:999px;transition:all .4s var(--spring);cursor:pointer;border:none;white-space:nowrap}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 6px 26px var(--teal-glow)}
.btn-p:hover{transform:translateY(-3px) scale(1.03);box-shadow:0 12px 42px var(--teal-glow);color:#fff}
.btn-ow{background:transparent;color:#fff;border:1.5px solid rgba(255,255,255,.45)}
.btn-ow:hover{background:rgba(255,255,255,.1);border-color:var(--teal);color:var(--teal);transform:translateY(-3px)}
.btn-gl{background:rgba(255,255,255,.16);backdrop-filter:blur(22px) saturate(180%);border:1px solid rgba(255,255,255,.18);color:#fff}
.btn-gl:hover{background:rgba(255,255,255,.22);transform:translateY(-2px);color:#fff}
.btn-dk{background:var(--dark);color:#fff;box-shadow:0 4px 16px rgba(0,0,0,.3)}
.btn-dk:hover{background:var(--dark3);transform:translateY(-3px);color:#fff}
.btn-sm{padding:.55rem 1.3rem;font-size:.67rem}
.btn-lg{padding:1.1rem 2.8rem;font-size:.82rem}
[data-r]{opacity:0;transition:opacity .8s var(--ease),transform .8s var(--ease)}
[data-r="up"]{transform:translateY(50px)}
[data-r="left"]{transform:translateX(-50px)}
[data-r="right"]{transform:translateX(50px)}
[data-r="scale"]{transform:scale(.88)}
[data-r].in{opacity:1;transform:none}
[data-d="1"]{transition-delay:.1s}[data-d="2"]{transition-delay:.2s}[data-d="3"]{transition-delay:.3s}[data-d="4"]{transition-delay:.4s}
@media(max-width:1024px){.wellness-grid{grid-template-columns:1fr}.wstack{height:420px}.resto-split{grid-template-columns:1fr}.resto-media{height:360px}.resto-body{padding:3rem 2rem}.exc-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:768px){.rooms-grid{grid-template-columns:1fr}.stats-grid{grid-template-columns:repeat(2,1fr)}.avis-grid{grid-template-columns:1fr}.hero-stats{flex-wrap:wrap;gap:1rem;position:relative;bottom:auto;left:auto;transform:none;margin-top:2rem}.hs-sep{display:none}.gallery-mosaic{grid-template-columns:repeat(2,1fr);grid-template-rows:auto}.g-i{height:160px}.g-i:first-child{grid-column:span 2;height:220px;grid-row:span 1}.fcj{flex-direction:column;align-items:flex-start}.exc-grid{grid-template-columns:repeat(2,1fr)}#bbar{border-radius:16px;flex-wrap:wrap;padding:1rem}.bf{width:100%}.bsep{display:none}}
@media(max-width:480px){.exc-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

{{-- ═══ HERO ══════════════════════════════════════════════════ --}}
<section class="hero" id="home">
  <div class="hero-bg" id="hero-bg"></div>
  <div class="hero-ov"></div>
  <div class="hero-grid"></div>
  <div class="hero-orb orb1"></div>
  <div class="hero-orb orb2"></div>
  <div class="particles" id="particles"></div>

  <div class="hero-body">
    <div class="hero-ey">Lac Ahémé · Possotomé · Bénin</div>
    <h1 class="hero-title">L'Écrin <em>des Bains</em><br>Thermaux</h1>
    <p class="hero-sub">Un paradis naturel entre lac sacré et forêt tropicale. Ressourcez-vous au cœur de l'Afrique de l'Ouest.</p>
    <div class="hero-btns">
      <a href="{{ route('hebergements.index') }}" class="btn btn-p btn-lg">Voir les hébergements</a>
      <a href="{{ route('bains.index') }}" class="btn btn-ow btn-lg">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.9" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M10 8l6 4-6 4V8z"/></svg>
        Découvrir
      </a>
    </div>
  </div>

  <div class="hero-stats">
    <div class="hs-item"><span class="hs-num">28€</span><span class="hs-lbl">Nuit depuis</span></div>
    <div class="hs-sep"></div>
    <div class="hs-item"><span class="hs-num">06</span><span class="hs-lbl">Types d'héberg.</span></div>
    <div class="hs-sep"></div>
    <div class="hs-item"><span class="hs-num">100%</span><span class="hs-lbl">Naturel</span></div>
    <div class="hs-sep"></div>
    <div class="hs-item"><span class="hs-num">4.0</span><span class="hs-lbl">Petit Futé</span></div>
  </div>

  <div class="hero-scroll" onclick="document.getElementById('services-band').scrollIntoView({behavior:'smooth'})">
    <div class="scroll-line"></div>
    <span>Découvrir</span>
  </div>
</section>

{{-- ═══ BOOKING BAR ════════════════════════════════════════════ --}}
<div id="bbar">
  <div class="bf">
    <label>Arrivée</label>
    <input type="date">
  </div>
  <div class="bsep"></div>
  <div class="bf">
    <label>Départ</label>
    <input type="date">
  </div>
  <div class="bsep"></div>
  <div class="bf">
    <label>Voyageurs</label>
    <select>
      <option>01 adulte</option>
      <option>02 adultes</option>
      <option>02 adultes, 01 enfant</option>
      <option>02 adultes, 02 enfants</option>
    </select>
  </div>
  <div class="bsep"></div>
  <div class="bf">
    <label>Hébergement</label>
    <select>
      <option>Tous types</option>
      <option>Chambre Standard</option>
      <option>Suite Vue Lac</option>
      <option>Chalet Resort</option>
    </select>
  </div>
  <div style="flex-shrink:0">
    <a href="{{ route('reservation.index') }}" class="btn btn-p">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      Vérifier disponibilité
    </a>
  </div>
</div>

{{-- ═══ SERVICES BAND ══════════════════════════════════════════ --}}
<div id="services-band">
  <div class="wrap">
    <div class="sb-inner">
      <div class="sb-item"><div class="ic"><i data-lucide="waves" class="lucide-icon"></i></div> Bains Thermaux</div>
      <div class="sb-sep"></div>
      <div class="sb-item"><div class="ic"><i data-lucide="utensils" class="lucide-icon"></i></div> Restaurant Lacustre</div>
      <div class="sb-sep"></div>
      <div class="sb-item"><div class="ic">🚣</div> Excursions Lac</div>
      <div class="sb-sep"></div>
      <div class="sb-item"><div class="ic"><i data-lucide="dumbbell" class="lucide-icon"></i></div> Salle de Sport</div>
      <div class="sb-sep"></div>
      <div class="sb-item"><div class="ic"><i data-lucide="leaf" class="lucide-icon"></i></div> Nature & Vodoun</div>
      <div class="sb-sep"></div>
      <div class="sb-item"><div class="ic">🚗</div> Location Véhicules</div>
    </div>
  </div>
</div>

{{-- ═══ HÉBERGEMENTS ════════════════════════════════════════════ --}}
<section id="rooms" style="padding:7rem 0">
  <div class="wrap">
    <div class="tc mb8" data-r="up">
      <div class="sec-lbl mxa">Hébergements</div>
      <h2 class="sec-title" style="font-size:clamp(2rem,4vw,3.5rem)">Votre Refuge au<br>Cœur de la Nature</h2>
      <p class="sec-desc mxa tc">6 types d'hébergements pour tous les budgets et toutes les envies, du confort simple à la suite panoramique sur le lac Ahémé.</p>
    </div>
    <div class="rooms-grid">

      <div class="rc" data-r="up" data-d="1">
        <div class="rc-img">
          <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800" alt="Chambre Standard">
          <div class="rc-badge">Populaire</div>
          <div class="rc-reveal"><a href="{{ route('hebergements.index') }}" class="btn btn-gl btn-sm" style="color:#fff">Voir les détails →</a></div>
        </div>
        <div class="rc-body">
          <h3 class="rc-name">Chambre Standard</h3>
          <div class="rc-meta">
            <span class="rc-m"><i data-lucide="users"></i> 02 pers.</span>
            <span class="rc-m"><i data-lucide="house" class="lucide-icon"></i> Hôtel</span>
            <span class="rc-m"><i data-lucide="leaf" class="lucide-icon"></i> Vue jardin</span>
          </div>
          <div class="rc-price"><span class="price-n">28</span><span class="price-c">€</span><span class="price-p">&nbsp;/ nuit</span></div>
          <div class="rc-tags"><span class="rct">Clim</span><span class="rct">WiFi</span><span class="rct">SDB privée</span></div>
          <div class="rc-foot">
            <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm">Réserver</a>
            <a href="{{ route('hebergements.index') }}" class="btn btn-dk btn-sm">Détails</a>
          </div>
        </div>
      </div>

      <div class="rc" data-r="up" data-d="2">
        <div class="rc-img">
          <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800" alt="Suite Vue Lac">
          <div class="rc-badge" style="background:linear-gradient(135deg,#f5a623,#e8920a)">Premium</div>
          <div class="rc-reveal"><a href="{{ route('hebergements.index') }}" class="btn btn-gl btn-sm" style="color:#fff">Voir les détails →</a></div>
        </div>
        <div class="rc-body">
          <h3 class="rc-name">Suite Vue Lac</h3>
          <div class="rc-meta">
            <span class="rc-m"><i data-lucide="users"></i> 2 pers.</span>
            <span class="rc-m"><i data-lucide="waves" class="lucide-icon"></i> Lac Ahémé</span>
          </div>
          <div class="rc-price"><span class="price-n">75</span><span class="price-c">€</span><span class="price-p">&nbsp;/ nuit</span></div>
          <div class="rc-tags"><span class="rct">Terrasse</span><span class="rct">Clim</span><span class="rct">Mini-bar</span><span class="rct">WiFi</span></div>
          <div class="rc-foot">
            <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm">Réserver</a>
            <a href="{{ route('hebergements.index') }}" class="btn btn-dk btn-sm">Détails</a>
          </div>
        </div>
      </div>

      <div class="rc" data-r="up" data-d="3">
        <div class="rc-img">
          <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?w=800" alt="Chalet Resort">
          <div class="rc-badge">Exclusif</div>
          <div class="rc-reveal"><a href="{{ route('hebergements.index') }}" class="btn btn-gl btn-sm" style="color:#fff">Voir les détails →</a></div>
        </div>
        <div class="rc-body">
          <h3 class="rc-name">Chalet Resort</h3>
          <div class="rc-meta">
            <span class="rc-m"><i data-lucide="users"></i> 4 pers.</span>
            <span class="rc-m">🏔️ Vue panoramique</span>
          </div>
          <div class="rc-price"><span class="price-n">120</span><span class="price-c">€</span><span class="price-p">&nbsp;/ nuit</span></div>
          <div class="rc-tags"><span class="rct">Piscine privée</span><span class="rct">Clim</span><span class="rct">Cuisine</span></div>
          <div class="rc-foot">
            <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm">Réserver</a>
            <a href="{{ route('hebergements.index') }}" class="btn btn-dk btn-sm">Détails</a>
          </div>
        </div>
      </div>

    </div>
    <div class="tc mt6" data-r="up">
      <a href="{{ route('hebergements.index') }}" class="btn btn-dk btn-lg">Voir tous les hébergements</a>
    </div>
  </div>
</section>

{{-- ═══ STATS ═══════════════════════════════════════════════════ --}}
<section id="stats">
  <div class="wrap">
    <div class="stats-grid">
      <div class="stat-b" data-r="scale" data-d="1"><span class="stat-n">30</span><span class="stat-l">Années d'expérience</span></div>
      <div class="stat-b" data-r="scale" data-d="2"><span class="stat-n">06</span><span class="stat-l">Types d'hébergements</span></div>
      <div class="stat-b" data-r="scale" data-d="3"><span class="stat-n">03</span><span class="stat-l">Sources thermales</span></div>
      <div class="stat-b" data-r="scale" data-d="4"><span class="stat-n">4.0</span><span class="stat-l">Note Petit Futé</span></div>
    </div>
  </div>
</section>

{{-- ═══ BAINS THERMAUX ═════════════════════════════════════════ --}}
<section id="bains">
  <div class="wrap">
    <div class="wellness-grid">
      <div class="wstack" data-r="left">
        <div class="ws-main">
          <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=900" alt="Bains thermaux Possotomé">
        </div>
        <div class="ws-acc">
          <img src="https://images.unsplash.com/photo-1600334129128-685c5582fd35?w=600" alt="Sources thermales naturelles">
        </div>
        <div class="ws-badge">
          <span class="wsb-n">03</span>
          <span class="wsb-l">Sources<br>thermales</span>
        </div>
      </div>
      <div data-r="right">
        <div class="sec-lbl">Bains & Wellness</div>
        <h2 class="sec-title" style="font-size:clamp(2rem,3.5vw,3.2rem)">Les Vertus<br>des Eaux<br>Thermales</h2>
        <p class="sec-desc mb4">Les eaux sulfurées de Possotomé sont reconnues depuis des générations pour leurs propriétés curatives. Trois sources naturelles à des températures différentes vous offrent une expérience de bien-être incomparable.</p>
        <ul class="wellness-list">
          <li class="wli"><div class="wli-dot">✓</div>Eaux sulfurées naturelles reconnues thérapeutiques</li>
          <li class="wli"><div class="wli-dot">✓</div>Propriétés bénéfiques pour la peau et les articulations</li>
          <li class="wli"><div class="wli-dot">✓</div>Piscine thermale extérieure avec vue sur la forêt</li>
          <li class="wli"><div class="wli-dot">✓</div>Massages et soins traditionnels béninois disponibles</li>
        </ul>
        <a href="{{ route('bains.index') }}" class="btn btn-p" style="margin-top:2rem">Réserver une séance de bains</a>
      </div>
    </div>
  </div>
</section>

{{-- ═══ RESTAURANT ══════════════════════════════════════════════ --}}
<section id="resto">
  <div class="resto-split">
    <div class="resto-media">
      <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=900" alt="Restaurant sur pilotis — Lac Ahémé">
      <div class="resto-media-overlay"></div>
    </div>
    <div class="resto-body">
      <div class="sec-lbl">Restaurant</div>
      <h2 class="sec-title w" style="font-size:clamp(2rem,3.5vw,3.2rem)">Dîner sur<br>les Eaux du Lac</h2>
      <p class="sec-desc w mb4">Notre restaurant sur pilotis vous offre une expérience gastronomique unique. Cuisine béninoise authentique et saveurs locales préparées avec des produits frais de la région.</p>
      <div class="menu-preview">
        <div class="mp-item"><span class="mp-name">Poisson du lac grillé</span><div class="mp-dots"></div><span class="mp-price">4 500 FCFA</span></div>
        <div class="mp-item"><span class="mp-name">Akassa sauce gombo</span><div class="mp-dots"></div><span class="mp-price">2 800 FCFA</span></div>
        <div class="mp-item"><span class="mp-name">Brochettes de viande</span><div class="mp-dots"></div><span class="mp-price">3 500 FCFA</span></div>
        <div class="mp-item"><span class="mp-name">Jus de fruits tropicaux</span><div class="mp-dots"></div><span class="mp-price">1 200 FCFA</span></div>
      </div>
      <a href="{{ route('restaurant.index') }}" class="btn btn-p" style="margin-top:2rem">Voir le menu complet</a>
    </div>
  </div>
</section>

{{-- ═══ EXCURSIONS ══════════════════════════════════════════════ --}}
<section id="excursions">
  <div class="wrap">
    <div class="fcj mb8">
      <div data-r="left">
        <div class="sec-lbl">Excursions & Activités</div>
        <h2 class="sec-title" style="font-size:clamp(2rem,3.5vw,3rem)">Explorer le<br>Bénin Authentique</h2>
      </div>
      <a href="{{ route('excursions.index') }}" class="btn btn-dk" data-r="right">Toutes les excursions</a>
    </div>
    <div class="exc-grid">
      <div class="exc" data-r="up" data-d="1">
        <div class="exc-img"><img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600" alt="Tour du Lac Ahémé"></div>
        <div class="exc-ov"></div>
        <div class="exc-body">
          <span class="exc-cat">Lac & Nature</span>
          <div class="exc-name">Tour du Lac Ahémé</div>
          <div class="exc-dur">Demi-journée · Depuis 15 000 FCFA</div>
          <a href="{{ route('excursions.index') }}" class="exc-btn">Réserver →</a>
        </div>
      </div>
      <div class="exc" data-r="up" data-d="2">
        <div class="exc-img"><img src="https://images.unsplash.com/photo-1519451241324-20b4ea2c4220?w=600" alt="Circuit Culturel Béninois"></div>
        <div class="exc-ov"></div>
        <div class="exc-body">
          <span class="exc-cat">Culture & Vodoun</span>
          <div class="exc-name">Circuit Culturel Béninois</div>
          <div class="exc-dur">7 jours · Depuis 1 050€</div>
          <a href="{{ route('excursions.index') }}" class="exc-btn">Réserver →</a>
        </div>
      </div>
      <div class="exc" data-r="up" data-d="3">
        <div class="exc-img"><img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=600" alt="Ganvié Venise d'Afrique"></div>
        <div class="exc-ov"></div>
        <div class="exc-body">
          <span class="exc-cat">Patrimoine UNESCO</span>
          <div class="exc-name">Ganvié, Venise d'Afrique</div>
          <div class="exc-dur">Journée · Depuis 25 000 FCFA</div>
          <a href="{{ route('excursions.index') }}" class="exc-btn">Réserver →</a>
        </div>
      </div>
      <div class="exc" data-r="up" data-d="4">
        <div class="exc-img"><img src="https://images.unsplash.com/photo-1521651201144-634f700b36ef?w=600" alt="Pêche Traditionnelle"></div>
        <div class="exc-ov"></div>
        <div class="exc-body">
          <span class="exc-cat">Traditions</span>
          <div class="exc-name">Pêche Traditionnelle</div>
          <div class="exc-dur">Matin · Depuis 8 000 FCFA</div>
          <a href="{{ route('excursions.index') }}" class="exc-btn">Réserver →</a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ═══ GALERIE ═════════════════════════════════════════════════ --}}
<section id="galerie">
  <div class="wrap-xl">
    <div class="tc mb8" data-r="up">
      <div class="sec-lbl" style="justify-content:center">Galerie Photos</div>
      <h2 class="sec-title w" style="font-size:clamp(2rem,4vw,3.2rem)">Immergez-vous dans<br>l'Ambiance Chez Théo</h2>
    </div>
    <div class="gallery-mosaic">
      <div class="g-i"><img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=900" alt="Vue lac Ahémé"></div>
      <div class="g-i"><img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600" alt="Chambre Chez Théo"></div>
      <div class="g-i"><img src="https://th.bing.com/th/id/R.2bb0d129f82c878aa3b2c2d694f0bf88?rik=SXoAiPr7ddfQpA&pid=ImgRaw&r=0?w=600" alt="Piscine thermale"></div>
      <div class="g-i"><img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600" alt="Restaurant sur pilotis"></div>
      <div class="g-i"><img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=600" alt="Bains thermaux"></div>
    </div>
    <div class="tc mt6" data-r="up">
      <a href="{{ route('about.index') }}" class="btn btn-gl btn-lg">Voir toute la galerie</a>
    </div>
  </div>
</section>

{{-- ═══ AVIS CLIENTS ════════════════════════════════════════════ --}}
<section id="avis">
  <div class="wrap">
    <div class="tc mb8" data-r="up">
      <div class="sec-lbl mxa">Avis clients</div>
      <h2 class="sec-title" style="font-size:clamp(2rem,4vw,3.2rem)">Ce que disent<br>nos Voyageurs</h2>
    </div>
    <div class="avis-grid">

      <div class="av" data-r="up" data-d="1">
        <div class="av-stars">★★★★★</div>
        <div class="av-plat">Google</div>
        <div class="av-q">"</div>
        <p class="av-text">Établissement PARFAIT ! Les chambres sont juste magnifiques et vraiment très propres, le service est très agréable on y mange très bien, nous avons pu profiter d'un petit tour en pirogue j'y retournerais très vite et je recommandes les yeux fermés.</p>
        <div class="av-user">
          <div class="av-ava">M</div>
          <div><div class="av-name">Maeva</div><div class="av-loc">🇫🇷 France</div></div>
        </div>
      </div>

      <div class="av" data-r="up" data-d="2">
        <div class="av-stars">★★★★★</div>
        <div class="av-plat">Google</div>
        <div class="av-q">"</div>
        <p class="av-text">Nous avons adoré l'environnement, le lac et le bungalow sur pilotis ! Le restaurant est excellent, le petit déjeuner aussi et le personnel très gentil !</p>
        <div class="av-user">
          <div class="av-ava">C</div>
          <div><div class="av-name">Charlotte</div><div class="av-loc">🇫🇷 France</div></div>
        </div>
      </div>

      <div class="av" data-r="up" data-d="3">
        <div class="av-stars">★★★★★</div>
        <div class="av-plat">Petit Futé</div>
        <div class="av-q">"</div>
        <p class="av-text">Hôtel très agréable, propre et calme. Nous avons passé un séjour reposant ! Le petit déjeuner est top, avec des fruits frais et du jus d'ananas pressé. Probablement le meilleur hôtel que nous ayons eu au Bénin !</p>
        <div class="av-user">
          <div class="av-ava">L</div>
          <div><div class="av-name">Lucille</div><div class="av-loc">🇫🇷 France</div></div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══ INFO BARRE ══════════════════════════════════════════════ --}}
<div id="infobarre">
  <div class="wrap">
    <div class="ib-inner">
      <div class="ib-item">
        <div class="ib-icon"><i data-lucide="map-pin" class="lucide-icon"></i></div>
        <div><div class="ib-title">Localisation</div><div class="ib-val">Possotomé, Bénin</div></div>
      </div>
      <div class="ib-item">
        <div class="ib-icon"><i data-lucide="phone" class="lucide-icon"></i></div>
        <div><div class="ib-title">Téléphone</div><div class="ib-val"><a href="tel:+22901950553155">+229 01 95 05 53 15</a></div></div>
      </div>
      <div class="ib-item">
        <div class="ib-icon"><i data-lucide="mail" class="lucide-icon"></i></div>
        <div><div class="ib-title">Email</div><div class="ib-val"><a href="mailto:auberge_theo@yahoo.fr">auberge_theo@yahoo.fr</a></div></div>
      </div>
      <div class="ib-item">
        <div class="ib-icon"><i data-lucide="clock" class="lucide-icon"></i></div>
        <div><div class="ib-title">Réception</div><div class="ib-val">7h – 22h · 7j/7</div></div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
// Scroll reveal
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('in'); });
}, {threshold:.12});
document.querySelectorAll('[data-r]').forEach(el => obs.observe(el));

// Booking bar
window.addEventListener('scroll', () => {
  document.getElementById('bbar').classList.toggle('vis', window.scrollY > 500);
}, {passive:true});

// Parallax hero
window.addEventListener('scroll', () => {
  const bg = document.getElementById('hero-bg');
  if(bg && window.scrollY < window.innerHeight)
    bg.style.transform = `scale(1.08) translateY(${window.scrollY * 0.3}px)`;
}, {passive:true});

// Particules
const pc = document.getElementById('particles');
if(pc){
  for(let i=0;i<18;i++){
    const p = document.createElement('div');
    p.className = 'p';
    const s = Math.random()*5+3;
    p.style.cssText = `width:${s}px;height:${s}px;left:${Math.random()*100}%;bottom:${Math.random()*30}%;--d:${Math.random()*4+5}s;--dl:${Math.random()*4}s;--tx:${(Math.random()-.5)*80}px;--ty:${-(Math.random()*150+80)}px`;
    pc.appendChild(p);
  }
}
</script>
@endpush
