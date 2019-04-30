<?php

namespace Techlify\FileManager;

use Illuminate\Support\ServiceProvider;

/**
 * Description of FileManagerServiceProvider
 *
 * @author 
 */
class FileManagerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FileManager::class, function ()
        {
            return new FileManager();
        });

        $this->app->alias(FileManager::class, 'file-manager');
    }

}
