<?php 

namespace almakano\botsmanager;

use Illuminate\Support\ServiceProvider;

class ManagerServiceProvider extends ServiceProvider
{
	protected $commands = [
		app\Console\Commands\Install::class,
		app\Console\Commands\LogicsRun::class,
	];

	public function boot(\Illuminate\Routing\Router $router)
	{
		$this->loadRoutesFrom(__DIR__.'/routes/botsmanager.php');
		$this->loadViewsFrom(__DIR__.'/resources/views', 'botsmanager');
		$this->publishes([__DIR__.'/../database/migrations/' => database_path('/migrations')]);
		// $this->publishes([__DIR__.'/resources/views' => resource_path('views/vendor/botsmanager')]);
		$this->publishes([__DIR__.'/resources/assets' => public_path('vendor/botsmanager')]);
	}

	public function register() {

		$this->commands($this->commands);
	}
}
