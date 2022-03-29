<?php

return [
    'default' => config('app.locale', 'en'),

    'locales' => config('app.available_locales', ['en', 'de', 'fr', 'es']),

    'fallback' => config('app.fallback_locale', 'en'),

    'required' => config('app.locale', ['en'])
];
