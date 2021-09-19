<?php

Route::get('megaads/traffic-blocking/index', ['as' => 'megaads.traffic-blocking.index', 'uses' => 'Megaads\TrafficBlocking\Controllers\TrafficController@index']);
Route::post('megaads/traffic-blocking/update', ['as' => 'megaads.traffic-blocking.update', 'uses' => 'Megaads\TrafficBlocking\Controllers\TrafficController@update']);
