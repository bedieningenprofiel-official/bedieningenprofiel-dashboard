<?php

namespace App\Imports;

use App\Models\Surveys\PersonalityType;
use App\Models\Surveys\Survey;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SurveyQuestionsImport implements ToCollection
{
    public function __construct(
        protected Survey $survey,
    ) {
    }

    public function collection(Collection $rows): void
    {
        $personalityTypes = PersonalityType::all();
        $letterArray = [];

        foreach($personalityTypes as $index => $personality) {
            $letter = substr($personality->name, 0, 1);
            $lowercaseLetter = strtolower($letter);

            $letterArray[$lowercaseLetter] = $personality->name;
        }

        foreach ($rows as $row) {
            if (trim($row[0]) === '') {
                break;
            }

            if (array_key_exists($row[1], $letterArray)) {
                $leftPersonality = $letterArray[$row[1]];
            }

            if (array_key_exists($row[3], $letterArray)) {
                $rightPersonality = $letterArray[$row[3]];
            }

            $leftPersonalityOutOfDB = PersonalityType::where('name', $leftPersonality)->first();
            $rightPersonalityOutOfDB = PersonalityType::where('name', $rightPersonality)->first();

            // ONLY IMPORT WHEN THERE ARE NO QUESTIONS
            $this->survey->questions()->create([
                'left_statement' => trim($row[0]),
                'right_statement' => trim($row[4]),
                'left_personality_id' => $leftPersonalityOutOfDB->id,
                'right_personality_id' => $rightPersonalityOutOfDB->id,
                'order' => $row[2],
                'imported_through_excel' => true,
            ]);
        }
    }
}
