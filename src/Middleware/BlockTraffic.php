<?php

namespace Megaads\TrafficBlocking\Middleware;

use Closure;
use Cache;

class BlockTraffic
{
    protected $db;

    public function __construct()
    {
        $this->db = new \IP2Location\Database(base_path('vendor/ip2location/ip2location-php/databases/IP2LOCATION-LITE-DB1.BIN'), \IP2Location\Database::FILE_IO);
    }
    
    public function handle($request, Closure $next)
    {
        $countryCode = $this->db->lookup($request->ip(), \IP2Location\Database::COUNTRY_CODE);
        $blockedCountries = Cache::get('megaads-blocked-countries');
        $blockedCountries = explode(',', $blockedCountries);
        if ($countryCode && in_array($countryCode, $blockedCountries) && ($_SERVER['REQUEST_URI'] !== '/megaads/traffic-blocking/index')) {
            abort(403);
        }

        return $next($request);
    }
}
