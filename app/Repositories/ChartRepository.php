<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

class ChartRepository
{
    public function getTeamRoleDistributionScores(): Collection
    {
        return collect([
            ['role' => 'Apostel', 'scores' => [20, 15, 10, 5, 10]],
            ['role' => 'Profeet', 'scores' => [10, 70, 5, 5, 5]],
            ['role' => 'Leraar', 'scores' => [30, 5, 5, 5, 5]],
            ['role' => 'Evangelist', 'scores' => [5, 5, 5, 5, 5]],
            ['role' => 'Herder', 'scores' => [100, 10, 10, 10, 15]],
        ]);
    }
}
