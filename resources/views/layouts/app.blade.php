<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#08131e">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- SEO --}}
  <title>@yield('title', 'Chez Théo les Bains') — Possotomé, Bénin</title>
  <meta name="description" content="@yield('description', 'Hôtel-restaurant au bord du lac Ahémé à Possotomé. Bains thermaux naturels, restaurant sur pilotis, excursions. Réservez dès maintenant !')">
  @stack('meta')

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Inter:wght@300;400;500&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

  {{-- CSS --}}
  <link rel="stylesheet" href="css/main.css">

  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  @stack('styles')
</head>
<body class="@yield('body-class')">

  {{-- ── LOADER ── --}}
  <div id="page-loader" aria-hidden="true">
    <div class="loader-brand">Chez <span>Théo</span> les Bains</div>
    <div class="loader-track"><div class="loader-fill"></div></div>
    <div class="loader-sub">Possotomé &middot; Bénin &middot; Lac Ahémé</div>
  </div>

  {{-- ── NAVIGATION ── --}}
  @include('components.nav')

  {{-- ── CONTENU DE LA PAGE ── --}}
  <main id="main-content">
    @yield('content')
  </main>

  {{-- ── FOOTER ── --}}
  @include('components.footer')

  {{-- ── FABs (WhatsApp + retour haut) ── --}}
  @include('components.fabs')

  {{-- ── JS ── --}}
  <script src="js/main.js"></script>
  <script>lucide.createIcons();</script>
  @stack('scripts')

</body>
</html>
