<?php
/**
 * File: PrepaidHosterApiProvider.php
 * Created: Feb 2025
 * Project: PPH-Virt-Manager
 */

namespace DeZio\PrepaidHoster\API;

use DeZio\PrepaidHoster\API\Client\ApiClient;
use Illuminate\Support\ServiceProvider;

class PrepaidHosterApiProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/pph-api.php', 'prepaid-hoster-api');
        $this->publishes([
            __DIR__ . '/../config/pph-api.php' => config_path('pph-api.php'),
        ], 'prepaid-hoster-api-config');

        $this->app->singleton(ApiClient::class, function () {
            return new ApiClient(config('prepaid-hoster-api'));
        });
    }
}
