<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('assistant.access', fn ($user) =>
            $user->tenant_id !== null && $user->can_use_database_assistant);

        Gate::define('assistant.read', fn ($user, string $resource) =>
            $resource === 'projects' && $user->can_use_database_assistant);

        Gate::define('assistant.write', fn ($user, string $resource) =>
            $resource === 'projects' && $user->can_use_database_assistant);
    }
}
