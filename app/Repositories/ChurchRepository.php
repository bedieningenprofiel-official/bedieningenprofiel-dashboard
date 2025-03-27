<?php

namespace App\Repositories;

class ChurchRepository
{
    public function createChurch(string $name, string $email, string $address): self
    {
        $church = auth()->user()->ownedChurch()->create([
            'church_name' => $name,
            'church_email' => $email,
            'church_address' => $address,
        ]);

        auth()->user()->church()->associate($church);
        auth()->user()->save();

        return $this;
    }
}
