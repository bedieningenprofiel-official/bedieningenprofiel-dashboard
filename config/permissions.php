<?php

use App\Models\Team;
use App\Models\User;

return [
    'teamleader' => [
        'edit_team' => fn (User $user, Team $team) => $user->isOwnerOfTeam($team),
        'delete_team' => fn (User $user, Team $team) => $user->isOwnerOfTeam($team),
        'add_team_member' => fn (User $user, Team $team) => $user->isOwnerOfTeam($team) && $user->canAddMembers(),
        'add_notes' => fn (User $user, Team $team) => $user->isOwnerOfTeam($team) && $user->canAddMembers(),
    ],
    'member' => []
];
