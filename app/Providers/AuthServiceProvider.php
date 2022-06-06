<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
// use App\Models\User;

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

        // Gate::define('isSuperAdmin', function (User $user) {
        //     return $user->role === 'superAdmin';
        // });

        // Gate::define('isAdmin', function (User $user) {
        //     return $user->role === 'admin';
        // });

        // Gate::define('isDosen', function (User $user) {
        //     return $user->role === 'dosen';
        // });

        // Gate::define('isStudent', function (User $user) {
        //     return $user->role === 'student';
        // });

        // Gate::define('isFakultas', function (User $user) {
        //     return $user->role === 'faculty';
        // });

        // Gate::define('isSuperAdminAdmin', function (User $user) {
        //     return $user->role === 'superAdmin' or 'admin';
        // });
    }
}
