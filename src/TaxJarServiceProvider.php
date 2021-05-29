<?php

namespace LaraJar;

use Illuminate\Support\ServiceProvider;
use TaxJar\Client;

class TaxJarServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->offerPublishing();

        $this->app->bind(TaxJarApi::class, function ($app) {
            return new TaxJarApi(Client::withApiKey(config('taxjar.api_key')));
        });
    }

    protected function offerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/taxjar.php' => config_path('taxjar.php'),
        ], 'config');
    }
}
