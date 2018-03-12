<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // access authorized by all different users
        Gate::define('allUsersAccess', function($user) {
            return $user->role(['superadmin', 'admin', 'company']);
        });

        // access authorized by superadmins and admins
        Gate::define('allAdminsAccess', function($user) {
            return $user->role(['superadmin', 'admin']);
        });

        // access authorized by superadmin
        Gate::define('superAdminAccess', function($user) {
            return $user->role('superadmin');
        });

        // access authorized by admins
        Gate::define('adminsAccess', function($user) {
            return $user->role('admin');
        });

        // access authorized by companies
        Gate::define('companyAccess', function($user) {
            return $user->role('company');
        });
    }
}
