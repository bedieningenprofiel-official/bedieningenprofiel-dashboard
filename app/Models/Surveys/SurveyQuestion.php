<?php

namespace App\Models\Surveys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    /** @use hasfactory<\database\factories\SurveyQuestionFactory> */
    use HasFactory;

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function leftPersonality()
    {
        return $this->belongsTo(PersonalityType::class, 'left_personality_id');
    }

    public function rightPersonality()
    {
        return $this->belongsTo(PersonalityType::class, 'right_personality_id');
    }
}
