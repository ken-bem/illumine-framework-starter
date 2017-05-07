<?php if(!defined('ABSPATH')){ die(); }

return [
    'namespace' => 'IlluminePlugin1',
    'mode' => 'development', // development: Show Framework Admin Panel

    'database' => [
        'enabled' => true,
    ],

    'encryption' => [
        'enabled' => true, //or false to disable
        'cipher' => 'AES-256-CBC', //or false to disable
        'key' => 'nInrMfTMQngxqRvoFpjstYjZX0qH1Nlr',
    ],

    'routes' => [
        'enabled' => true,
        'loading' => 'eager',
        //eager: (overwrite wp routes),
        //lazy: (intercept wp 404 during template redirect)
        'cache' => false,
        'compiled' => __DIR__.'/cache/routes.cache'
    ],

    'cache' => [
        'enabled' => true,
        'prefix' => 'IlluminePlugin1',
        'default' => 'database', //default store
        'stores' => [
            'file' => [
                'driver' => 'file',
                'path' => __DIR__.'/cache/objects/',
            ],
            'database' => [
                'driver' => 'database', //Requires Encryption Package (below)
                'table' => 'illumine_test1_cache', //Defined in Activation Class
                'connection' => null,
            ],
        ]
    ],

    //Session
    'session' => [
        'enabled' => true,
        'driver' => 'database',
        'connection' => null,
        'table' => 'illumine_test1_sessions',
        'store' => null,
        'lottery' => [2, 100],
        'lifetime' => 120,
        'expire_on_close' => false,
        'encrypt' => false,
        'files' => __DIR__.'/cache/sessions/',

        //Cookies
        'cookie' => 'IlluminePlugin1',
        'path' => '/',
        'domain' => '.'.parse_url(get_bloginfo('url'))['host'], //Evaluates to .domain.com
        'secure' => is_ssl(),
        'http_only' => false, //HTTP Access Only
    ],

    //Validator
    'validator' => [
        'enabled' => true,
        'locale' => get_locale(),
    ],

    //View
    'view' => [
        'paths' => [
            __DIR__.'/resources/views/',
        ],
        'compiled' => __DIR__.'/cache/views',
    ],

    //Providers
    'providers' => [
        \Illuminate\Encryption\Encrypter::class, //"illuminate/encryption": "5.4.*"
    ]
];
