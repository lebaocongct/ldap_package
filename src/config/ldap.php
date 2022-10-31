<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default LDAP Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the LDAP connections below you wish
    | to use as your default connection for all LDAP operations. Of
    | course you may add as many connections you'd like below.
    |
    */

    'default' => env('LDAP_CONNECTION', 'default'),

    /*
    |--------------------------------------------------------------------------
    | LDAP Connections
    |--------------------------------------------------------------------------
    |
    | Below you may configure each LDAP connection your application requires
    | access to. Be sure to include a valid base DN - otherwise you may
    | not receive any results when performing LDAP search operations.
    |
    */

    'connections' => [

        'default' => [
            'hosts' => [env('LDAP_HOST', '127.0.0.1')],
            'username' => env('LDAP_USERNAME', 'cn=user,dc=local,dc=com'),
            'password' => env('LDAP_PASSWORD', 'secret'),
            'port' => env('LDAP_PORT', 389),
            'base_dn' => env('LDAP_BASE_DN', 'dc=local,dc=com'),
            'timeout' => env('LDAP_TIMEOUT', 5),
            'use_ssl' => env('LDAP_SSL', false),
            'use_tls' => env('LDAP_TLS', false),
        ],

        'AD' => [
            'hosts' => [env('LDAP_AD_HOST', '192.168.6.237')],
            'port' => env('LDAP_AD_PORT', 389),
            'base_dn' => env('LDAP_AD_BASE_DN', 'ou=ASEAN,OU=Plott Corporation,dc=plott,dc=local'),
            'timeout' => env('LDAP_AD_TIMEOUT', 5),
            'use_ssl' => env('LDAP_AD_SSL', false),
            'use_tls' => env('LDAP_AD_TLS', false),
        ],

        'OL' => [
            'hosts' => [env('LDAP_OL_HOST', '192.168.20.199')],
            'port' => env('LDAP_OL_PORT', 389),
            'base_dn' => env('LDAP_OL_BASE_DN', 'ou=ASEAN,ou=Plott Corporation,dc=plott,dc=local'),
            'timeout' => env('LDAP_OL_TIMEOUT', 5),
            'use_ssl' => env('LDAP_OL_SSL', false),
            'use_tls' => env('LDAP_OL_TLS', false),
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | LDAP Logging
    |--------------------------------------------------------------------------
    |
    | When LDAP logging is enabled, all LDAP search and authentication
    | operations are logged using the default application logging
    | driver. This can assist in debugging issues and more.
    |
    */

    'logging' => env('LDAP_LOGGING', true),
    'version' => env('LDAP_AD_PROTOCOL_VERSION', 3),
//    'upn_suffix' => env('LDAP_AD_UPN_SUFFIX', "plott.local"),


    /*
    |--------------------------------------------------------------------------
    | LDAP Cache
    |--------------------------------------------------------------------------
    |
    | LDAP caching enables the ability of caching search results using the
    | query builder. This is great for running expensive operations that
    | may take many seconds to complete, such as a pagination request.
    |
    */

    'cache' => [
        'enabled' => env('LDAP_CACHE', false),
        'driver' => env('CACHE_DRIVER', 'file'),
    ],

];
