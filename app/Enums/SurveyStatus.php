<?php

namespace App\Enums;

enum SurveyStatus: string
{
    case Inactive = 'inactive';
    case Active = 'active';
    case Archived = 'archived';

    public function translation(): string
    {
        return __("surveys.statuses.{$this->value}");
    }
}
