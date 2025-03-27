<?php

namespace Database\Seeders;

use App\Models\Surveys\PersonalityType;
use App\Models\Surveys\Survey;
use App\Models\Surveys\SurveyQuestion;
use App\Models\User;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    protected readonly array $personalityTypes;

    public function __construct()
    {
        $this->personalityTypes = config('personality-types');
    }

    public function run(): void
    {
        $createdTypes = [];
        foreach ($this->personalityTypes as $type) {
            $createdTypes[$type['name']] = PersonalityType::firstOrCreate(
                ['name' => $type['name']],
                ['description' => $type['description']]
            );
        }

        $admin = User::where('name', 'Super Admin')->first();
        $adminTeam = $admin->currentTeam;

        $survey = Survey::create([
            'description' => 'This is the questionaire',
            'status' => 'active',
            'team_id' => $adminTeam->id,
            'is_template' => true,
        ]);

        $questions = [
            [
                'left_statement' => 'Ik ben goed in het motiveren van mensen.',
                'right_statement' => 'Ik onderwijs graag uit de Bijbel.',
                'left_personality' => 'Evangelist',
                'right_personality' => 'Teacher',
            ],
            [
                'left_statement' => 'Ik zie vaak hoe dingen in de toekomst zullen ontwikkelen.',
                'right_statement' => 'Ik vind het belangrijk om voor mensen te zorgen.',
                'left_personality' => 'Prophet',
                'right_personality' => 'Pastor',
            ],
        ];

        foreach ($questions as $index => $question) {
            SurveyQuestion::create([
                'survey_id' => $survey->id,
                'left_statement' => $question['left_statement'],
                'right_statement' => $question['right_statement'],
                'left_personality_id' => $createdTypes[$question['left_personality']]->id,
                'right_personality_id' => $createdTypes[$question['right_personality']]->id,
                'order' => $index + 1,
            ]);
        }
    }
}
