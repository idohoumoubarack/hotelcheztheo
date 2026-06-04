<?php

return [
    /*
    |-----------------------------------------------------------
    | Environnement FedaPay
    |-----------------------------------------------------------
    | 'sandbox' pour les tests, 'live' pour la production.
    | Changer dans .env : FEDAPAY_ENV=live
    */
    'env' => env('FEDAPAY_ENV', 'sandbox'),

    /*
    |-----------------------------------------------------------
    | Clés API
    |-----------------------------------------------------------
    | Récupérer sur https://live.fedapay.com/settings/api
    | et https://sandbox.fedapay.com/settings/api
    */
    'sandbox_key' => env('FEDAPAY_SANDBOX_KEY', ''),
    'live_key'    => env('FEDAPAY_LIVE_KEY', ''),
];
