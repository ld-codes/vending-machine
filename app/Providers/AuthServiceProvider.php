<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        $gate->define('deposit', function ($user) {
          return $user->balance == 0;
        });

        $gate->define('withdraw', function ($user) {
          return $user->balance > 0;
        });

        $gate->define('purchase', function ($user, $snack) {
          return $user->balance >= $snack->price;
        });
    }
}
