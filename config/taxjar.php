<?php

return [
    'api_key' => env('TAXJAR_API_KEY'),

    'default_timeout' => 30,

    'logging_enabled' => true,

    'table_names' => [
        'logs' => 'taxjar_api_logs'
    ],

    'column_names' => [
        'log_owner_key' => ''
    ],

    'model_names' => [
        'log_owner' => 'App\Models\User'
    ],
];
