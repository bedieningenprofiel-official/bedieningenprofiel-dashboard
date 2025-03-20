<?php

namespace App\Charts;

use IcehouseVentures\LaravelChartjs\Builder;

abstract class BaseChart
{
    /**
    * Returns the ChartJS Builder. This creates the chart so make sure to have data ready!
    */
    abstract public function createChart(): Builder;

    /**
    * Returns colors for a specific chart.
    */
    public function colors(array $color): array
    {
        return $color;
    }

    /**
    * Translates the given string.
    */
    public function getTranslatedString(string $translation): string
    {
        return __($translation);
    }
}
