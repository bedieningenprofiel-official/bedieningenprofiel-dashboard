<?php

namespace App\Livewire;

use App\Models\Surveys\PersonalityType;
use App\Models\Surveys\Survey;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconPosition;
use Livewire\Component;

class CreateQuestions extends Component implements HasForms
{
    public Survey $survey;
    public ?array $data = [];

    use InteractsWithForms;

    public function mount(): void
    {
        $this->surveyQuestionsForm->fill();
    }

    public function surveyQuestionsForm(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()
                    ->tabs([
                        Tab::make('Manual')
                            ->schema([
                                TextInput::make('left_statement')
                                    ->label('Left statement')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('right_statement')
                                    ->label('Right statement')
                                    ->required()
                                    ->columnSpanFull(),
                                Select::make('left_personality_id')
                                    ->label('Left statement personality type')
                                    ->required()
                                    ->options(PersonalityType::all()->pluck('name', 'id'))
                                    ->columnSpan(1),
                                Select::make('right_personality_id')
                                    ->label('Right statement personality type')
                                    ->required()
                                    ->options(PersonalityType::all()->pluck('name', 'id'))
                                    ->columnSpan(1),
                                Actions::make([
                                    Action::make('createQuestion')
                                        ->label('Create Question')
                                        ->color(Color::Slate)
                                        ->action('createSurveyQuestion')
                                ])->fullWidth()->columnSpanFull(2),
                            ])->columns(2),
                        Tab::make('Excel Import')
                            ->badge('Experimental')
                            ->schema([

                            ])
                    ])
            ])->statePath('data');
    }

    public function getForms(): array
    {
        return [
            'surveyQuestionsForm'
        ];
    }

    public function createSurveyQuestion(): void
    {
        $data = $this->surveyQuestionsForm->getState();
        $latestQuestion = $this->survey->questions->last();

        $data['order'] = $latestQuestion->order + 1;

        $this->survey->questions()->create($data);

        Notification::make()
            ->title('Successfully created a question for ' . $this->survey->name)
            ->success()
            ->duration(2500)
            ->send();

        $this->surveyQuestionsForm->fill();
    }

    public function render()
    {
        return view('livewire.create-questions');
    }
}
