<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HebergementController extends Controller
{
    // Données statiques des 6 hébergements
    private function getData(): array
    {
        return [
            'suite-superieure' => [
                'slug'        => 'suite-superieure',
                'nom'         => 'Suite Supérieure',
                'espace'      => 'Resort',
                'badge'       => 'resort',
                'personnes'   => '4 – 6 personnes',
                'prix_eur'    => '120',
                'prix_fcfa'   => '78 000',
                'hero_img'    => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1800',
                'description' => 'Notre hébergement le plus spacieux et le plus luxueux. La Suite Supérieure offre un espace de vie exceptionnel au bord du lac Ahémé, avec une terrasse privée donnant directement sur l\'eau. Architecture traditionnelle béninoise sublimée par un confort haut de gamme.',
                'galerie'     => [
                    'https://images.unsplash.com/photo-1631049552057-403cdb8f0658?w=800',
                    'https://images.unsplash.com/photo-1591088398332-8596b4d0ea9e?w=800',
                    'https://images.unsplash.com/photo-1566195992011-5f6b21e539aa?w=800',
                    'https://images.unsplash.com/photo-1560185127-6ed189bf02f4?w=800',
                ],
                'equipements' => [
                    ['icon' => 'users',          'label' => '4 à 6 personnes'],
                    ['icon' => 'bed-double',      'label' => '2 chambres doubles'],
                    ['icon' => 'sofa',            'label' => 'Salon / séjour'],
                    ['icon' => 'sun',             'label' => 'Terrasse privée vue lac'],
                    ['icon' => 'wind',            'label' => 'Climatisation'],
                    ['icon' => 'bath',            'label' => 'Salle de bain privée'],
                    ['icon' => 'lock',            'label' => 'Toilettes privées'],
                    ['icon' => 'coffee',          'label' => 'Petit-déjeuner inclus'],
                    ['icon' => 'waves',           'label' => 'Vue panoramique sur le lac'],
                    ['icon' => 'shield-check',    'label' => 'Taxes de nuitée incluses'],
                ],
                'inclus' => ['Petit-déjeuner offert', 'Taxes de nuitée incluses', 'Salle de bain & WC privés', 'Accès piscine thermale', 'Canoë gratuit sur le lac'],
                'prev' => null,
                'next' => 'suite-standard',
            ],
            'suite-standard' => [
                'slug'        => 'suite-standard',
                'nom'         => 'Suite Standard',
                'espace'      => 'Resort',
                'badge'       => 'resort',
                'personnes'   => '4 personnes',
                'prix_eur'    => '96',
                'prix_fcfa'   => '63 000',
                'hero_img'    => 'https://www.brp.ch/fileadmin/documents/brp.ch/images/chambres-suites/tuiles/superior_room_lake_view_1.jpg?w=1920',
                'description' => 'La Suite Standard associe espace, confort et vue imprenable sur le lac Ahémé. Avec sa chambre double et son salon séparé, elle est idéale pour les couples ou petites familles souhaitant profiter pleinement du Resort et de la piscine à débordement.',
                'galerie'     => [
                    'https://images.unsplash.com/photo-1591088398332-8596b4d0ea9e?w=800',
                    'https://images.unsplash.com/photo-1631049552057-403cdb8f0658?w=800',
                    'https://images.unsplash.com/photo-1560185127-6ed189bf02f4?w=800',
                    'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?w=800',
                ],
                'equipements' => [
                    ['icon' => 'users',          'label' => 'Jusqu\'à 4 personnes'],
                    ['icon' => 'bed-double',      'label' => '1 chambre double'],
                    ['icon' => 'sofa',            'label' => 'Salon séparé'],
                    ['icon' => 'sun',             'label' => 'Terrasse avec vue lac'],
                    ['icon' => 'wind',            'label' => 'Climatisation'],
                    ['icon' => 'bath',            'label' => 'Salle de bain privée'],
                    ['icon' => 'lock',            'label' => 'Toilettes privées'],
                    ['icon' => 'coffee',          'label' => 'Petit-déjeuner inclus'],
                    ['icon' => 'waves',           'label' => 'Vue sur le lac Ahémé'],
                    ['icon' => 'shield-check',    'label' => 'Taxes de nuitée incluses'],
                ],
                'inclus' => ['Petit-déjeuner offert', 'Taxes de nuitée incluses', 'Salle de bain & WC privés', 'Accès piscine thermale', 'Canoë gratuit sur le lac'],
                'prev' => 'suite-superieure',
                'next' => 'bungalow-deluxe',
            ],
            'bungalow-deluxe' => [
                'slug'        => 'bungalow-deluxe',
                'nom'         => 'Bungalow Deluxe',
                'espace'      => 'Hôtel',
                'badge'       => 'hotel',
                'personnes'   => '2 – 3 personnes',
                'prix_eur'    => '74',
                'prix_fcfa'   => '48 000',
                'hero_img'    => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1920',
                'description' => 'Le Bungalow Deluxe est notre hébergement phare côté Hôtel. Alliant architecture traditionnelle béninoise et confort contemporain, il propose une terrasse couverte face au lac, une décoration soignée et tous les équipements pour un séjour mémorable.',
                'galerie'     => [
                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800',
                    'https://images.unsplash.com/photo-1595576508898-0ad5c879a061?w=800',
                    'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800',
                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800',
                ],
                'equipements' => [
                    ['icon' => 'users',          'label' => '2 à 3 personnes'],
                    ['icon' => 'bed-double',      'label' => 'Lit double ou twin'],
                    ['icon' => 'home',            'label' => 'Architecture traditionnelle'],
                    ['icon' => 'sun',             'label' => 'Terrasse couverte'],
                    ['icon' => 'wind',            'label' => 'Climatisation'],
                    ['icon' => 'bath',            'label' => 'Salle de bain privée'],
                    ['icon' => 'lock',            'label' => 'Toilettes privées'],
                    ['icon' => 'coffee',          'label' => 'Petit-déjeuner inclus'],
                    ['icon' => 'utensils',        'label' => 'Accès restaurant sur pilotis'],
                    ['icon' => 'shield-check',    'label' => 'Taxes de nuitée incluses'],
                ],
                'inclus' => ['Petit-déjeuner offert', 'Taxes de nuitée incluses', 'Salle de bain & WC privés', 'Accès restaurant', 'Canoë gratuit sur le lac'],
                'prev' => 'suite-standard',
                'next' => 'bungalow-superieur',
            ],
            'bungalow-superieur' => [
                'slug'        => 'bungalow-superieur',
                'nom'         => 'Bungalow Supérieur',
                'espace'      => 'Resort',
                'badge'       => 'resort',
                'personnes'   => '2 personnes',
                'prix_eur'    => '60',
                'prix_fcfa'   => '39 000',
                'hero_img'    => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1920',
                'description' => 'Le Bungalow Supérieur est idéalement placé au cœur du Resort, à quelques pas de la piscine à débordement et du lac Ahémé. Confort supérieur, décoration soignée et accès direct aux infrastructures bien-être du Resort.',
                'galerie'     => [
                    'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800',
                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800',
                    'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=800',
                    'https://images.unsplash.com/photo-1566195992011-5f6b21e539aa?w=800',
                ],
                'equipements' => [
                    ['icon' => 'users',          'label' => '2 personnes'],
                    ['icon' => 'bed-double',      'label' => 'Lit double'],
                    ['icon' => 'sun',             'label' => 'Terrasse privée'],
                    ['icon' => 'waves',           'label' => 'Proche piscine à débordement'],
                    ['icon' => 'wind',            'label' => 'Climatisation'],
                    ['icon' => 'bath',            'label' => 'Salle de bain privée'],
                    ['icon' => 'lock',            'label' => 'Toilettes privées'],
                    ['icon' => 'coffee',          'label' => 'Petit-déjeuner inclus'],
                    ['icon' => 'sparkles',        'label' => 'Accès spa & bains thermaux'],
                    ['icon' => 'shield-check',    'label' => 'Taxes de nuitée incluses'],
                ],
                'inclus' => ['Petit-déjeuner offert', 'Taxes de nuitée incluses', 'Salle de bain & WC privés', 'Accès piscine thermale', 'Canoë gratuit sur le lac'],
                'prev' => 'bungalow-deluxe',
                'next' => 'bungalow-standard',
            ],
            'bungalow-standard' => [
                'slug'        => 'bungalow-standard',
                'nom'         => 'Bungalow Standard',
                'espace'      => 'Hôtel',
                'badge'       => 'hotel',
                'personnes'   => '2 personnes',
                'prix_eur'    => '38',
                'prix_fcfa'   => '25 000',
                'hero_img'    => 'https://images.unsplash.com/photo-1595576508898-0ad5c879a061?w=1920',
                'description' => 'Le Bungalow Standard propose un hébergement confortable et authentique au sein de l\'Hôtel, en plein cœur de la nature béninoise. Un excellent rapport qualité-prix pour découvrir Possotomé et profiter du lac Ahémé.',
                'galerie'     => [
                    'https://images.unsplash.com/photo-1595576508898-0ad5c879a061?w=800',
                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800',
                    'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800',
                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800',
                ],
                'equipements' => [
                    ['icon' => 'users',          'label' => '2 personnes'],
                    ['icon' => 'bed-double',      'label' => 'Lit double'],
                    ['icon' => 'home',            'label' => 'Architecture traditionnelle'],
                    ['icon' => 'leaf',            'label' => 'Cadre naturel verdoyant'],
                    ['icon' => 'thermometer',     'label' => 'Ventilateur'],
                    ['icon' => 'bath',            'label' => 'Salle de bain privée'],
                    ['icon' => 'lock',            'label' => 'Toilettes privées'],
                    ['icon' => 'coffee',          'label' => 'Petit-déjeuner inclus'],
                    ['icon' => 'utensils',        'label' => 'Accès restaurant sur pilotis'],
                    ['icon' => 'shield-check',    'label' => 'Taxes de nuitée incluses'],
                ],
                'inclus' => ['Petit-déjeuner offert', 'Taxes de nuitée incluses', 'Salle de bain & WC privés', 'Accès restaurant', 'Canoë gratuit sur le lac'],
                'prev' => 'bungalow-superieur',
                'next' => 'chambres-bb',
            ],
            'chambres-bb' => [
                'slug'        => 'chambres-bb',
                'nom'         => 'Chambres B&B',
                'espace'      => 'Hôtel',
                'badge'       => 'hotel',
                'personnes'   => '2 personnes',
                'prix_eur'    => '28',
                'prix_fcfa'   => '18 000',
                'hero_img'    => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1920',
                'description' => 'Les Chambres B&B (Bed & Breakfast) sont notre offre la plus accessible. Confortables, propres et bien situées au sein de l\'Hôtel, elles conviennent parfaitement aux voyageurs souhaitant découvrir Possotomé et le lac Ahémé avec un budget maîtrisé. Le petit-déjeuner est inclus.',
                'galerie'     => [
                    'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800',
                    'https://images.unsplash.com/photo-1595576508898-0ad5c879a061?w=800',
                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800',
                    'https://images.unsplash.com/photo-1560185127-6ed189bf02f4?w=800',
                ],
                'equipements' => [
                    ['icon' => 'users',          'label' => '2 personnes'],
                    ['icon' => 'bed-double',      'label' => 'Lit double'],
                    ['icon' => 'leaf',            'label' => 'Cadre naturel'],
                    ['icon' => 'thermometer',     'label' => 'Ventilateur'],
                    ['icon' => 'bath',            'label' => 'Salle de bain privée'],
                    ['icon' => 'lock',            'label' => 'Toilettes privées'],
                    ['icon' => 'coffee',          'label' => 'Petit-déjeuner inclus'],
                    ['icon' => 'utensils',        'label' => 'Accès restaurant sur pilotis'],
                    ['icon' => 'sailboat',        'label' => 'Canoë gratuit'],
                    ['icon' => 'shield-check',    'label' => 'Taxes de nuitée incluses'],
                ],
                'inclus' => ['Petit-déjeuner offert', 'Taxes de nuitée incluses', 'Salle de bain & WC privés', 'Accès restaurant', 'Canoë gratuit sur le lac'],
                'prev' => 'bungalow-standard',
                'next' => null,
            ],
        ];
    }

    public function index()
    {
        return view('pages.hebergements', ['hebergements' => $this->getData()]);
    }

    public function show($slug)
    {
        $data = $this->getData();
        if (!isset($data[$slug])) {
            abort(404);
        }
        $h    = $data[$slug];
        $prev = $h['prev'] ? $data[$h['prev']] : null;
        $next = $h['next'] ? $data[$h['next']] : null;
        $all  = array_values($data);
        return view('pages.hebergement-detail', compact('h', 'prev', 'next', 'all'));
    }
}
