<?php

return [
    'api_key'        => env('AMAZON_API_KEY', ''),
    'api_secret_key' => env('AMAZON_API_SECRET_KEY', ''),
    'associate_tag'  => env('AMAZON_ASSOCIATE_TAG', ''),
    'host'           => env('AMAZON_HOST', 'webservices.amazon.co.jp'),
    'region'         => env('AMAZON_REGION', 'us-west-2'),
    'marketplace'    => env('AMAZON_MARKETPLACE', 'www.amazon.com'),
    'language'       => env('AMAZON_LANGUAGE', 'en_US'),
    'currency'       => env('AMAZON_CURRENCY', 'USD')
];
