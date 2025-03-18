<?php

use App\Livewire\DisbandChurch;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(DisbandChurch::class)
        ->assertStatus(200);
});
