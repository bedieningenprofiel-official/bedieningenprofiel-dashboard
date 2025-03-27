<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Repositories\TeamRepository;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamsController extends Controller
{
    public function __construct(
        protected TeamRepository $teamRepository
    ) {}

    public function show(Team $currentTeam): View
    {
        return view('teams.show', compact('currentTeam'));
    }

    public function create(): View
    {
        return view('teams.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->teamRepository->createTeam($request->only('name', 'description'));

        Notification::make()
            ->title(__('notification.teams.team_created'))
            ->success()
            ->duration(2500)
            ->send();

        return redirect()->route('dashboard');
    }

    public function switchTeam(Team $team): RedirectResponse
    {
        if (auth()->user()->currentTeam->id === $team->id) {
            Notification::make()
                ->title(__('notification.switch.already_on_team'))
                ->info()
                ->duration(2500)
                ->send();

            return redirect()->route('dashboard');
        }

        $this->teamRepository->switchTeamId(
            $team->id
        );

        Notification::make()
            ->title(__('notification.switch.title', ['team' => auth()->user()->currentTeam->name]))
            ->success()
            ->duration(2500)
            ->send();

        return redirect()->route('dashboard');
    }

    public function showAllTeams(): View
    {
        $allTeams = $this->teamRepository->getAllTeams();

        return view('teams.show-all', [
            'allTeams' => $allTeams,
        ]);
    }
}
