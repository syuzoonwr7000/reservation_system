<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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
    public function boot()
    {
        $this->registerPolicies();
        // 開発者
        Gate::define('developer', function (User $user) {
            return ($user->role === 1);
        });

        // 管理者
        Gate::define('admin', function (User $user) {
            return ($user->role === 2);
        });

        // 一般ユーザー
        Gate::define('user', function (User $user) {
            return ($user->role === 3);
        });

        //
    }
}
