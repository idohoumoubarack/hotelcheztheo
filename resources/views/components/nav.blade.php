<header id="site-header" role="banner">
  <div class="nav-inner wrap-xl">

    {{-- ── LOGO ── --}}
    <a href="{{ route('home') }}" class="nav-logo" aria-label="Chez Théo les Bains — Accueil">
      <span class="logo-main">Chez <em>Théo</em></span>
      <span class="logo-sub">les Bains &middot; Possotomé</span>
    </a>

    {{-- ── MENU ── --}}
    <nav id="main-nav" aria-label="Menu principal">
      <ul class="nav-menu">

        <li class="{{ request()->routeIs('hebergements*') ? 'nav-item current' : 'nav-item' }}">
          <a href="{{ route('hebergements.index') }}">Hébergements</a>
        </li>

        <li class="{{ request()->routeIs('bains*') ? 'nav-item current' : 'nav-item' }}">
          <a href="{{ route('bains.index') }}">Bains</a>
        </li>

        <li class="{{ request()->routeIs('restaurant*') ? 'nav-item current' : 'nav-item' }}">
          <a href="{{ route('restaurant.index') }}">Restaurant</a>
        </li>

        {{-- Services annexes --}}
        <li class="nav-item nav-has-drop {{ request()->routeIs('excursions*') || request()->routeIs('locations*') || request()->routeIs('sport*') ? 'current' : '' }}">
          <a href="#" aria-haspopup="true" aria-expanded="false">
            Services
            <svg class="nav-arrow" width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
          </a>
          <ul class="nav-dropdown" role="menu">
            <li role="none"><a href="{{ route('excursions.index') }}" role="menuitem">Excursions</a></li>
            <li role="none"><a href="{{ route('locations.index') }}" role="menuitem">Locations</a></li>
            <li role="none"><a href="{{ route('sport.index') }}"     role="menuitem">Salle de sport</a></li>
          </ul>
        </li>

        <li class="nav-item nav-has-drop {{ request()->routeIs('about*') || request()->routeIs('espace*') ? 'current' : '' }}">
          <a href="#" aria-haspopup="true" aria-expanded="false">
            À propos
            <svg class="nav-arrow" width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
          </a>
          <ul class="nav-dropdown" role="menu">
            <li role="none"><a href="{{ route('about.index') }}"  role="menuitem">À propos</a></li>
            <li role="none"><a href="{{ route('espace.index') }}" role="menuitem">Notre espace</a></li>
          </ul>
        </li>

        <li class="{{ request()->routeIs('contact*') ? 'nav-item current' : 'nav-item' }}">
          <a href="{{ route('contact.index') }}">Contact</a>
        </li>

      </ul>
    </nav>

    {{-- ── ACTIONS DROITE ── --}}
    <div class="nav-actions">

      {{-- Téléphone --}}
      <a href="tel:+22901950553155" class="nav-tel" aria-label="Appeler Chez Théo">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 8.81 2 2 0 012 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6z"/>
        </svg>
        <span>+229 01 95 05 53 15</span>
      </a>

      {{-- CTA Réserver --}}
      <a href="{{ route('reservation.index') }}" class="btn btn-p btn-sm nav-cta">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
          <rect x="3" y="4" width="18" height="18" rx="2"/>
          <line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8"  y1="2" x2="8"  y2="6"/>
          <line x1="3"  y1="10" x2="21" y2="10"/>
        </svg>
        Réserver
      </a>

      {{-- Burger mobile --}}
      <button class="nav-burger" id="nav-burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="main-nav">
        <span></span>
        <span></span>
        <span></span>
      </button>

    </div>

  </div>
</header>
