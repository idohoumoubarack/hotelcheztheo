<footer id="site-footer" role="contentinfo">
  <div class="wrap-xl">

    <div class="footer-grid">

      {{-- ── COL 1 : Présentation ── --}}
      <div class="footer-about">
        <div class="footer-logo">
          <span class="footer-logo-main">Chez <em>Théo</em></span>
          <span class="footer-logo-sub">les Bains</span>
        </div>
        <p>
          Hôtel-restaurant au bord du lac Ahémé à Possotomé.
          Bains thermaux naturels, restaurant sur pilotis et excursions authentiques au cœur du Bénin.
        </p>
        {{-- Notes plateformes --}}
        <div class="footer-notes">
          <a href="https://www.google.com/maps/place/Hotel+Chez+Th%C3%A9o" target="_blank" rel="noopener" class="footer-note-badge">
            <span class="fnb-stars">★</span>
            <span class="fnb-val">3.9</span>
            <span class="fnb-source">Google</span>
          </a>
          <a href="https://www.tripadvisor.fr/Hotel_Review-g293765-d3201024" target="_blank" rel="noopener" class="footer-note-badge">
            <span class="fnb-stars">★</span>
            <span class="fnb-val">3.7</span>
            <span class="fnb-source">TripAdvisor</span>
          </a>
          <a href="https://www.petitfute.com/v49369-possotome/c1166-hebergement/c158-hotel/196262-chez-theo.html" target="_blank" rel="noopener" class="footer-note-badge">
            <span class="fnb-stars">★</span>
            <span class="fnb-val">4.0</span>
            <span class="fnb-source">Petit Futé</span>
          </a>
        </div>
      </div>

      {{-- ── COL 2 : Navigation ── --}}
      <div class="footer-col">
        <h4>Explorer</h4>
        <nav class="footer-links" aria-label="Liens footer">
          <a href="{{ route('hebergements.index') }}">Hébergements</a>
          <a href="{{ route('bains.index') }}">Bains thermaux</a>
          <a href="{{ route('restaurant.index') }}">Restaurant</a>
          <a href="{{ route('excursions.index') }}">Excursions</a>
          <a href="{{ route('locations.index') }}">Locations</a>
          <a href="{{ route('sport.index') }}">Salle de sport</a>
        </nav>
      </div>

      {{-- ── COL 3 : Infos ── --}}
      <div class="footer-col">
        <h4>L'hôtel</h4>
        <nav class="footer-links">
          <a href="{{ route('about.index') }}">À propos de Théo</a>
          <a href="{{ route('espace.index') }}">Notre espace</a>
          <a href="{{ route('contact.index') }}">Nous contacter</a>
          <a href="{{ route('contact.index') }}">Réserver un séjour</a>
          <a href="https://www.booking.com/hotel/bj/restaurant-chez-theo.fr.html" target="_blank" rel="noopener">Réserver sur Booking</a>
        </nav>
      </div>

      {{-- ── COL 4 : Contact ── --}}
      <div class="footer-col">
        <h4>Nous contacter</h4>
        <address class="footer-address">

          <div class="footer-contact-item">
            <i data-lucide="mail" style="width:16px;height:16px;stroke:var(--teal);stroke-width:2;flex-shrink:0;margin-top:2px"></i>
            <a href="mailto:auberge_theo@yahoo.fr">auberge_theo@yahoo.fr</a>
          </div>

          <div class="footer-contact-item">
            <i data-lucide="phone" style="width:16px;height:16px;stroke:var(--teal);stroke-width:2;flex-shrink:0;margin-top:2px"></i>
            <a href="tel:+22901950553155">+229 01 95 05 53 15</a>
          </div>

          <div class="footer-contact-item">
            <i data-lucide="smartphone" style="width:16px;height:16px;stroke:var(--teal);stroke-width:2;flex-shrink:0;margin-top:2px"></i>
            <a href="tel:+2290197183118">+229 01 97 18 31 18</a>
          </div>

          <div class="footer-contact-item">
            <i data-lucide="map-pin" style="width:16px;height:16px;stroke:var(--teal);stroke-width:2;flex-shrink:0;margin-top:2px"></i>
            <a href="https://www.google.com/maps/place/H%C3%B4tel+Chez+Theo/@6.5355607,1.9758113,14.96z" target="_blank" rel="noopener">
              GXMC+38H, Possotomé
            </a>
          </div>

        </address>
      </div>

    </div>{{-- /footer-grid --}}

    {{-- ── BAS DE FOOTER ── --}}
    <div class="footer-bottom">
      <p>&copy; {{ date('Y') }} Chez Théo les Bains &middot; Possotomé, Bénin &middot; Tous droits réservés</p>
      <div class="footer-legal">
        <a href="{{ route('contact.index') }}">Mentions légales</a>
        <a href="{{ route('contact.index') }}">Confidentialité</a>
      </div>
    </div>

  </div>
</footer>
