<?php

return [

    'nom'      => 'Chez Théo les Bains',
    'nom_court'=> 'Chez Théo',
    'slogan'   => 'Hôtel-Restaurant & Bains Thermaux',
    'lieu'     => 'Possotomé, Bénin',
    'lac'      => 'Lac Ahémé',

    'contact' => [
        'email'      => 'auberge_theo@yahoo.fr',
        'tel1'       => '+229 01 95 05 53 15',
        'tel2'       => '+229 01 97 18 31 18',
        'whatsapp'   => '22901950553155',
        'adresse'    => 'GXMC+38H, Possotomé',
        'maps'       => 'https://www.google.com/maps/place/H%C3%B4tel+Chez+Theo/@6.5355607,1.9758113,14.96z',
        'coords'     => ['lat' => 6.5338988, 'lng' => 1.9662823],
    ],

    'notes' => [
        ['plateforme' => 'Google',      'note' => '3.9/5', 'url' => 'https://www.google.com/maps/place/Hotel+Chez+Th%C3%A9o/@6.5338988,1.9662823'],
        ['plateforme' => 'TripAdvisor', 'note' => '3.7/5', 'url' => 'https://www.tripadvisor.fr/Hotel_Review-g293765-d3201024-Reviews-Auberge_Chez_Theo-Porto_Novo_Oueme_Department.html'],
        ['plateforme' => 'Petit Futé',  'note' => '4.0/5', 'url' => 'https://www.petitfute.com/v49369-possotome/c1166-hebergement/c158-hotel/196262-chez-theo.html'],
        ['plateforme' => 'Booking',     'note' => 'Bien',  'url' => 'https://www.booking.com/hotel/bj/restaurant-chez-theo.fr.html'],
    ],

    'nav' => [
        ['label' => 'Hébergements', 'route' => 'hebergements.index'],
        ['label' => 'Bains',        'route' => 'bains.index'],
        ['label' => 'Restaurant',   'route' => 'restaurant.index'],
        ['label' => 'Excursions',   'route' => 'excursions.index'],
        ['label' => 'Locations',    'route' => 'locations.index'],
        ['label' => 'Salle de sport','route'=> 'sport.index'],
        ['label' => 'À propos',     'route' => 'about.index'],
        ['label' => 'Contact',      'route' => 'contact.index'],
    ],

];
