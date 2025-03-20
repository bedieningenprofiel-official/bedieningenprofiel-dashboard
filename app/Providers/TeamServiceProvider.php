<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TeamServiceProvider extends ServiceProvider
{
    private readonly array $permissions;

    public function __construct()
    {
        $this->permissions = config('permissions');
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('create_church', fn (User $user) => $user->canCreateChurch());
        Gate::define('create_teams', fn (User $user) => $user->canCreateTeams());
        Gate::define('view_current_team', fn (User $user) => $user->currentTeam()->exists());
        Gate::define('view_any_attached_team', fn (User $user) => $user->teams()->count() >= 0);

        foreach ($this->permissions as $role => $permissions) {
            foreach ($permissions as $permission => $callback) {
                Gate::define($permission, $callback);
            }
        }

        View::composer('layouts.navigation', function ($view) {
            $user = auth()->user();

            $view->with([
                'currentTeam' => $user->teams->find($user->current_team_id),
            ]);
        });
    }
}
