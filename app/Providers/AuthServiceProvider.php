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

        // access to admins manager
        Gate::define('accessAdminpanelAdmins', function($user) {
            return $user->role('superadmin');
        });

        // access to companies manager
        Gate::define('accessAdminpanelCompanies', function($user) {
            return $user->role(['superadmin', 'admin']);
        });

        // access to dashboard
        Gate::define('accessAdminpanel', function($user) {
            return $user->role(['superadmin', 'admin']);
        });

        // access to profile
        Gate::define('accessProfile', function($user) {
            return $user->role('company');
        });

        // access to profile
        Gate::define('accessAddOffer', function($user) {
            return $user->role('company');
        });
    }
}
