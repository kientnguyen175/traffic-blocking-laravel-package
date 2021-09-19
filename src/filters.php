<?php

$db = new \IP2Location\Database(base_path('vendor/ip2location/ip2location-php/databases/IP2LOCATION-LITE-DB1.BIN'), \IP2Location\Database::FILE_IO);

Route::filter('megaads-block-traffic', function() use ($db) {
    $countryCode = $db->lookup(Request::ip(), \IP2Location\Database::COUNTRY_CODE);
    $blockedCountries = Cache::get('megaads-blocked-countries');
    $blockedCountries = explode(',', $blockedCountries);
    if ($countryCode && in_array($countryCode, $blockedCountries) && ($_SERVER['REQUEST_URI'] !== '/megaads/traffic-blocking/index')) {
        App::abort(403);
    }
});
