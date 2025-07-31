<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Passport Guard
    |--------------------------------------------------------------------------
    |
    | This configuration option defines the authentication guard that will be
    | used while authenticating users. This value should correspond with one
    | of your guards that is already present in your "auth" configuration file.
    |
    */

    'guard' => 'api',

    /*
    |--------------------------------------------------------------------------
    | Passport Storage Database Connection
    |--------------------------------------------------------------------------
    |
    | This configuration option allows you to specify the database connection
    | that Passport will use while storing all of its data. You may use any
    | of the connections defined in your application's "database" config.
    |
    */

    'storage_database_connection' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Client UUIDs
    |--------------------------------------------------------------------------
    |
    | This value determines if Passport will use UUIDs when generating client
    | identifiers. This will override any existing clients and create new
    | entries using UUIDs instead of incremental numeric IDs.
    |
    */

    'client_uuids' => false,

    /*
    |--------------------------------------------------------------------------
    | Personal Access Client
    |--------------------------------------------------------------------------
    |
    | This client is used to generate personal access tokens. You should set
    | the ID and unencrypted secret of the personal access client that you
    | created when running the `passport:install` Artisan command.
    |
    */

    'personal_access_client' => [
        'id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
        'secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Passport Private and Public Keys
    |--------------------------------------------------------------------------
    |
    | Passport uses encryption keys while generating secure access tokens for
    | your application. You may use these environment variables to override
    | the default behavior of storing the keys as local files.
    |
    */

    'private_key' => env('PASSPORT_PRIVATE_KEY'),

    'public_key' => env('PASSPORT_PUBLIC_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Replicate Claims As Headers
    |--------------------------------------------------------------------------
    |
    | Passport will replicate some of the token claims as headers when it is
    | decoding an access token. This can be helpful when using a token to
    | make internal requests without needing to parse its JWT payload.
    |
    */

    'replicate_claims_as_headers' => false,

    /*
    |--------------------------------------------------------------------------
    | Token Lifetimes
    |--------------------------------------------------------------------------
    |
    | Here you may specify the lifetimes of the issued tokens. These values
    | are used when issuing personal access tokens and when issuing tokens
    | via the "password" grant and the "authorization_code" grant.
    |
    */

    'tokens_expire_in' => now()->addDays(15),

    'refresh_tokens_expire_in' => now()->addDays(30),

    'personal_access_tokens_expire_in' => now()->addMonths(6),

];
