<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Supported Locales
    |--------------------------------------------------------------------------
    |
    | Define the locales allowed for translatable attributes. By default we
    | mirror the locales declared in config/app.php so the UI toggle and
    | database stay in sync.
    |
    */

    'locales' => array_keys(config('app.available_locales', ['en' => 'English'])),

    /*
    |--------------------------------------------------------------------------
    | Source Locale
    |--------------------------------------------------------------------------
    |
    | This locale represents the "native" content that previously lived in
    | non-translated columns (e.g. `name`). We treat it as the minimum
    | required translation when migrating legacy data.
    |
    */

    'source_locale' => env('TRANS_SOURCE_LOCALE', 'id'),

    /*
    |--------------------------------------------------------------------------
    | Fallback Locale
    |--------------------------------------------------------------------------
    |
    | When a translation is missing, Spatie's package will use this locale.
    | We align it with Laravel's fallback so behaviour stays predictable.
    |
    */

    'fallback_locale' => env('TRANS_FALLBACK_LOCALE', config('app.fallback_locale', 'en')),
];
