<?php

return [
    'mode' => 'sandbox',        // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username' => 'SWIFTFLINGS_api1.gmail.com',       // Api Username
        'password' => 'G4LFSQGGN6SVD39A',       // Api Password
        'secret' => 'AJjtUEC2-zvkp.2Yz8a-.FGmZ2b3A349W.YJheHtzctgLNgqyzln2Mph',         // This refers to api signature
        'certificate' => '',    // Link to paypals cert file, storage_path('cert_key_pem.txt')
        //'app_id'      => 'APP-80W284485P519543T', // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username' => '',       // Api Username
        'password' => '',       // Api Password
        'secret' => '',         // This refers to api signature
        'certificate' => '',    // Link to paypals cert file, storage_path('cert_key_pem.txt')
    ],
    'payment_action' => 'Sale', // Can Only Be 'Sale', 'Authorization', 'Order'
    'currency' => 'USD',
    'notify_url' => 'http://www.alivenetsolutions.com/paypal/notify',         // Change this accordingly for your application.
    //'validate_ssl' => true,     // Validate SSL when creating api client.
];
