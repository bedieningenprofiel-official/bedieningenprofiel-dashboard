<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Team;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;

class TeamRepository
{
    private readonly array $permissions;

    public function __construct()
    {
        $this->permissions = config('permissions');
    }

    public function createTeam(
        array $data
    ): Team|RedirectResponse {
        $data['church_id'] = auth()->user()->church->id;

        if ($this->teamExists($data['name'])) {
            Notification::make()
                ->title(__('notification.teams.team_already_exists'))
                ->duration(2500)
                ->danger()
                ->send();

            return redirect()->route('teams.create');
        }

        $team = auth()->user()->ownedTeams()->create($data);

        $this->teamPermissions($team, $this->permissions);

        $team->members()->attach(auth()->user(), [
            'role_id' => $this->getRole('teamleader')->id,
        ]);

        auth()->user()->update(['current_team_id' => $team->id]);

        return $team;
    }

    public function switchTeamId(
        int $teamId
    ): void {
        auth()->user()->update(['current_team_id' => $teamId]);

        auth()->user()->refresh();
    }

    public function teamExists(
        string $teamName
    ): bool {
        return Team::where('name', $teamName)->exists();
    }

    protected function getRole(
        string $roleName
    ): Role {
        return Role::where('name', $roleName)->first();
    }

    protected function teamPermissions(Team $team, array $permissions): void
    {
        foreach ($permissions as $role => $permissions) {
            $team->roles()->create([
                'name' => $role,
                'permissions' => array_keys($permissions),
            ]);
        }
    }
}
