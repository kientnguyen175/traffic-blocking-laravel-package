<?php

namespace Megaads\TrafficBlocking\Controllers;

use Illuminate\Routing\Controller;
use Cache;
use View;
use Redirect;
use Config;

class TrafficController extends Controller
{
    public function index()
    {
        $blockedCountries = Cache::get('megaads-blocked-countries');
        if (!$blockedCountries) {
            $blockedCountries = file_get_contents(__DIR__ . '/../../public/blocked-countries.txt');
            Cache::forever('megaads-blocked-countries', $blockedCountries);
        };
        $blockedCountries = explode(',', $blockedCountries);

        return View::make('traffic-blocking::index', ['blockedCountries' => $blockedCountries]);
    }

    public function update()
    {   
        $request = $_REQUEST;
        $keyError = true;
        $success = false;
        $blockedCountries = '';
        $keys = Config::get('packages/megaads/traffic-blocking/keys.list') ?? Config::get('packages.megaads.traffic-blocking.keys.list');
        if (in_array($request['key'], $keys)) {
            if (!empty($request['blockedCountries'])) {
                $blockedCountries = implode (",", $request['blockedCountries']);
            }
            file_put_contents(__DIR__ . '/../../public/blocked-countries.txt', $blockedCountries, LOCK_EX);
            Cache::forever('megaads-blocked-countries', $blockedCountries);
            $keyError = false;
            $success = true;
        }

        return Redirect::route('megaads.traffic-blocking.index')->with([
            'keyError' => $keyError,
            'success' => $success
        ]);
    } 
}
