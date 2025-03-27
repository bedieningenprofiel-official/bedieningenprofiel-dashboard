<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Repositories\TeamRepository;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    protected readonly array $permissions;

    public function __construct(
        protected TeamRepository $teamRepository
    ) {
        $this->permissions = config('permissions');
    }

    public function run(): void
    {
        $admin = User::where('name', 'Super Admin')->first();

        $newChurch = $admin->ownedChurch()->create([
            'church_name' => 'HoH Purmerend',
            'church_email' => $admin->email,
            'church_address' => 'Spinnekop 2-3, 1444GN Purmerend',
            'church_owner_id' => $admin->id,
        ]);

        $admin->church()->associate($newChurch);

        $church = $admin->church;
        $teamUnderChurch = $church->teams()->create([
            'name' => 'Testing Team',
            'description' => 'This is a team test',
            'user_id' => $admin->id,
        ]);

        $admin->update([
            'current_team_id' => $teamUnderChurch->id,
        ]);

        $this->teamRepository->teamPermissions($teamUnderChurch, $this->permissions);

        $teamUnderChurch->members()->attach($admin, [
            'role_id' => Role::where('name', 'teamleader')->value('id'),
        ]);
    }
}
