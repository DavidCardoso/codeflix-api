<?php

namespace CodeFlix\Providers;

use CodeFlix\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'CodeFlix\Model' => 'CodeFlix\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // todo: variavel $user nao definida
        \Gate::define('admin', function($user){
            return $this->role == User::ROLE_ADMIN;
        });
    }
}
