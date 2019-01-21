<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Carbon;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        //
        Schema::defaultStringLength(191);
        Carbon::setLocale('pt_BR');
        //
        
        $this->registerPolicies($gate);
        
        $gate->before(function ($user) {
            return ($user->hasRole('administrator') ?: null);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
