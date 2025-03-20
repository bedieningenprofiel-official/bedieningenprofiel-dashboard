<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChurchRequest;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChurchController extends Controller
{
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

        $this->createChurch(
            $validated['church_name'],
            $validated['church_email'],
            $validated['church_address'],
        );

        Notification::make()
            ->title('Church has been created.')
            ->success()
            ->duration(2500)
            ->send();

        return redirect()->route('dashboard');
    }

    protected function createChurch(string $name, string $email, string $address): self
    {
        $church = auth()->user()->ownedChurch()->create([
            'church_name' => $name,
            'church_email' => $email,
            'church_address' => $address,
        ]);

        auth()->user()->update([
            'church_id' => $church->id,
        ]);

        return $this;
    }
}
