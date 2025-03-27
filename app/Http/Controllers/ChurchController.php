<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChurchRequest;
use App\Repositories\ChurchRepository;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChurchController extends Controller
{
    public function __construct(
        protected ChurchRepository $churchRepository
    ) {}

    public function show(): View
    {
        return view('churches.create');
    }

    public function store(CreateChurchRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (! $validated) {
            Notification::make()
                ->title('Something went wrong.')
                ->danger()
                ->duration(2500)
                ->send();

            return redirect()->route('churches.create');
        }

        $this->churchRepository->createChurch(
            $validated['church_name'],
            $validated['church_email'],
            $validated['church_address'],
        );

        Notification::make()
            ->title(__('notification.churches.created'))
            ->success()
            ->duration(2500)
            ->send();

        return redirect()->route('dashboard');
    }
}
