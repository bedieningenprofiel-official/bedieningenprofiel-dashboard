<?php

namespace App\Models\Surveys;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Survey extends Model
{
    /** @use hasfactory<\database\factories\surveyfactory> */
    use HasFactory;

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function parentSurvey(): BelongsTo
    {
        return $this->belongsTo(Survey::class, 'parent_survey_id');
    }

    public function copies(): HasMany
    {
        return $this->hasMany(Survey::class, 'parent_survey_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(SurveyQuestion::class)->orderBy('order');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(SurveyResponse::class);
    }

    public function copyForTeam(Team $team)
    {
        return DB::transaction(function () use ($team) {
            $surveyCopy = $this->replicate();

            $surveyCopy->team_id = $team->id;
            $surveyCopy->parent_survey_id = $this->id;
            $surveyCopy->is_template = false;
            $surveyCopy->save();

            foreach ($this->questions as $question) {
                $questionCopy = $question->replicate();

                $questionCopy->survey_id = $surveyCopy->id;
                $questionCopy->save();
            }

            return $surveyCopy;
        });
    }
}
