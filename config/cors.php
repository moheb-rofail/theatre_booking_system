<?php

return [
    'paths' => [
        'api/*',
        'posters/*', 
    ],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],  // أو حط لينك الـ frontend بدل *
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
