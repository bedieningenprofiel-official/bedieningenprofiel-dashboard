<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'salt' => 'N/fhGvZjjP0kggCeziCZ592f3qKtr4WB3sITtOTKkA8=',
            'length' => 12,
            // 'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
        ],

        'alternative' => [
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
            // 'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
        ],

        'teams' => [
            'salt' => env('HASHIDS_TEAM_SALT', 'IybWX4QQCAM68Gw5ZiGxVvW7jYMh2HpV7EQdLfDs/5M='),
            'length' => 12,
        ],

        'users' => [
            'salt' => env('HASHIDS_USERS_SALT', 'VegmkORzAFBGWEkmk/Pxf8P7Kh8bg2Tix9iDbP5kOYk='),
            'length' => 12,
        ],

    ],

];
