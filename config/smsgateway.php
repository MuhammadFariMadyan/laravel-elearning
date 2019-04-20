<?php

return [
    'email'    => env('SMS_EMAIL', 'mail@laravel.web.id'),    // insert your email here
    'password' => env('SMS_PASSWORD', ''), // insert your password here
    'device'   => env('SMS_DEVICE', ''),   // insert your device ID here
    'token'   => env('SMS_TOKEN', ''),   // insert your token in https://smsgateway.me/dashboard/settings here
];
