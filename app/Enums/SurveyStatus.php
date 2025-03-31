<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum SurveyStatus: string implements HasLabel
{
    case Inactive = 'inactive';
    case Active = 'active';
    case Archived = 'archived';

    public function getLabel(): string
    {
        return match ($this) {
            self::Inactive => __('surveys/statuses.inactive'),
            self::Active => __('surveys/statuses.active'),
            self::Archived => __('surveys/statuses.archived')
        };
    }
}
