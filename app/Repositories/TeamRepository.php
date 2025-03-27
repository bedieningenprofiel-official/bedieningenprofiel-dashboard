<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Team;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

class TeamRepository
{
    private const string TEAMLEADER = 'teamleader';
    private readonly array $permissions;

    public function __construct()
    {
        $this->permissions = config('permissions');
    }

    public function createTeam(
        array $data
    ): Team|RedirectResponse {
        $data['church_id'] = auth()->user()->church_id;
        $data['user_id'] = auth()->user()->id;

        if (Team::where('name', $data['name'])->exists()) {
            Notification::make()
                ->title(__('notification.teams.team_already_exists'))
                ->duration(2500)
                ->danger()
                ->send();

            return redirect()->route('teams.create');
        }

        $church = auth()->user()->church;
        $createdTeam = $church->teams()->create($data);

        $this->teamPermissions($createdTeam, $this->permissions);

        $createdTeam->members()->attach(auth()->user(), [
            'role_id' => Role::where('name', self::TEAMLEADER)->value('id'),
        ]);

        auth()->user()->update(['current_team_id' => $createdTeam->id]);

        return $createdTeam;
    }

    public function switchTeamId(
        int $teamId
    ): void {
        auth()->user()->update(['current_team_id' => $teamId]);

        auth()->user()->refresh();
    }

    public function getAllTeams(): Collection
    {
        $teamWithMembers = Team::with('members')->get();

        return collect($teamWithMembers);
    }

    public function teamPermissions(Team $team, array $permissions): void
    {
        foreach ($permissions as $role => $permissions) {
            $team->roles()->create([
                'name' => $role,
                'permissions' => array_keys($permissions),
            ]);
        }
    }
}
