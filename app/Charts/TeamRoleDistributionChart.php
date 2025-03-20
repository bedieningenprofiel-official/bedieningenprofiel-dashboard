<?php

namespace App\Charts;

use App\Repositories\ChartRepository;
use IcehouseVentures\LaravelChartjs\Builder;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

class TeamRoleDistributionChart extends BaseChart
{
    protected const translation = 'charts/index.total_all_roles';

    public function __construct(
        protected ChartRepository $chartRepository,
    ) {
    }

    public function createChart(): Builder
    {
        $data = $this->chartRepository->getTeamRoleDistributionScores();
        $labels = [];
        $datasets = [
            'label' => $this->getTranslatedString(self::translation),
            'data' => []
        ];

        // This is for five people, later this is substituted for the amount of people in a team.
        $personScores = [0, 0, 0, 0, 0];

        foreach ($data as $value) {
            $labels[] = $value['role'];

            $roleTotal = array_sum($value['scores']);
            $datasets['data'][] = $roleTotal;

            foreach ($value['scores'] as $index => $score) {
                $personScores[$index] += $score;
            }
        }

        return Chartjs::build()
            ->name('TeamRoleDistributionChart')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([$datasets])
            ->options($this->options());
    }

    public function options(string $title = 'Placeholder', bool $display = false): array
    {
        return [
            'scales' => [
                'y' => [
                    'suggestedMax' => 200
                ],
            ],
            'plugins' => [
                'title' => [
                    'display' => $display,
                    'text' => $title
                ]
            ],
            // temporary measure to not take the whole fucking screen over.
            'responsive' => false,
        ];
    }
}
