<?php

namespace App\View\Components\Charts;

use App\Charts\TeamRoleDistributionChart as ChartsTeamRoleDistributionChart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TeamRoleDistributionChart extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        protected ChartsTeamRoleDistributionChart $teamRoleDistribution
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.charts.team-role-distribution-chart', [
            'chart' => $this->teamRoleDistribution->createChart()
        ]);
    }
}
