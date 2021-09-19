<?php 

namespace Megaads\TrafficBlocking\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class TrafficBlockingServiceProvider extends ServiceProvider {

	protected $defer = false;

	public function boot()
	{
		$laravelVersion = json_decode(file_get_contents(base_path('composer.json')), true)['require']["laravel/framework"];
		include __DIR__ . '/../routes.php';
		View::addNamespace('traffic-blocking', __DIR__ . '/../views');
		if (version_compare($laravelVersion, "5.0", "<=")) {
			$this->package('megaads/traffic-blocking');
			include __DIR__ . '/../filters.php';
		} else {
			$this->app['router']->aliasMiddleware('megaads-block-traffic', 'Megaads\TrafficBlocking\Middleware\BlockTraffic');
			$this->publishes([
				__DIR__ . '/../config' => config_path('packages/megaads/traffic-blocking'),
			], 'config');
		}
	}

	public function register()
	{
		//
	}
}
