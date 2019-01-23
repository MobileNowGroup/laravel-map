<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Map Provider
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default map provider that should be used
    | by the askjerry cms.
    |
    */
    'default' => env('MAP_PROVIDER', null),

    'city' => env('MAP_DEFAULT_CITY', '上海'),

    'providers' => [
        'baidu' => [
            'key' => env('MAP_KEY', null),
        ],

        'tencent' => [
            'key' => env('MAP_KEY', null),
        ],
    ],

];