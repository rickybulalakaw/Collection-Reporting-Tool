<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\AccountableForm;
use App\Models\AccountableFormItem;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        AccountableForm::class => AccountableFormPolicy::class,
        AccountableFormItem::class => AccountableFormItemPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('collector', function (User $user) {
            return $user->function === User::IS_COLLECTOR;
        });

        Gate::define('is-admin', function (User $user) {
            return $user->function === User::IS_ADMIN;
        });

        Gate::define('review-accountable-forms', function (User $user) {
            $allowed_function_roles = [
                // User::IS_COLLECTOR,
                User::IS_CUSTODIAN,
                User::IS_TREASURER
            ];

            return in_array($user->function, $allowed_function_roles);
        });

        Gate::define('consolidator', function (User $user) {
            return $user->function === User::IS_CONSOLIDATOR;
        });

        Gate::define('custodian', function (User $user) {
            $allowed = [
                User::IS_CUSTODIAN,
                User::IS_TREASURER,
                User::IS_ADMIN
            ];
            return in_array($user->function, $allowed);
        });




    }
}
