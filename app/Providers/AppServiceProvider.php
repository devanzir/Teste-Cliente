<?php

namespace App\Providers;

use App\Repositories\ClientRepository;
use App\Services\ClientService;
use App\Repositories\WizardRepository;
use App\Services\WizardService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
{
    $this->app->singleton(ClientService::class, fn($app) => new ClientService($app->make(ClientRepository::class)));

    $this->app->singleton(WizardRepository::class, fn() => new WizardRepository());
    $this->app->singleton(WizardService::class, fn($app) => new WizardService($app->make(WizardRepository::class)));
}

}
