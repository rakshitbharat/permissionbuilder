<?php

namespace Rakshitbharat\PermissionBuilder\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class PermissionBuilderServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot() {
        require __DIR__ .'\..\Http\routes.php';
        Schema::defaultStringLength(191);
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig() {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('permissionBuilder.php'),
                ], 'config');
        $this->mergeConfigFrom(
                __DIR__ . '/../Config/config.php', 'permissionBuilder'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews() {
        $viewPath = base_path('resources/views/Rakshitbharat/permissionBuilder');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
                            return $path . '/Rakshitbharat/permissionBuilder';
                        }, \Config::get('view.paths')), [$sourcePath]), 'permissionBuilder');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations() {
        $langPath = base_path('resources/lang/Rakshitbharat/permissionBuilder');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'permissionBuilder');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'permissionBuilder');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

}
