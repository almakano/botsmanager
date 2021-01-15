<?php 

namespace almakano\botsmanager;

use Illuminate\Support\ServiceProvider;

class ManagerServiceProvider extends ServiceProvider
{
	protected $commands = [
        \almakano\botsmanager\app\Console\Commands\Install::class,
    ];

	public function boot(\Illuminate\Routing\Router $router)
    {
        $this->setupRoutes($this->app->router);
        $this->publishFiles();
    }

    public function publishFiles()
    {
    	$this->publishes([__DIR__.'/resources/views' => resource_path('views/vendor/almakano/botsmanager')], 'views');
    }

    public function setupRoutes(Router $router)
    {
    	$this->loadRoutesFrom(base_path().__DIR__.'/routes/botsmanager.php');
    }
}
