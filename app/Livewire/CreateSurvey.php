<?php

namespace App\Livewire;

use App\Enums\SurveyStatus;
use App\Models\Surveys\Survey;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Livewire\Component;

class CreateSurvey extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $surveyData = [];

    public function mount(): void
    {
        $this->surveyForm->fill();
    }

    public function surveyForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('surveys/create.header'))
                    ->description(__('surveys/create.description'))
                    ->aside()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('surveys/create.fields.name'))
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('description')
                            ->label(__('surveys/create.fields.description'))
                            ->columnSpanFull(),
                        Toggle::make('is_template')
                            ->label(__('surveys/create.fields.is_template'))
                            ->onIcon('lucide-book-text')
                            ->offIcon('lucide-book-text')
                            ->onColor(Color::Slate),
                        Select::make('status')
                            ->required()
                            ->options(SurveyStatus::class)
                            ->columnSpanFull(),
                    ])->footerActions([
                        Action::make(__('surveys/create.buttons.create'))
                            ->color(Color::Slate)
                            ->action('createSurvey')
                    ])->footerActionsAlignment(Alignment::End)
            ])
            ->columns(3)
            ->statePath('surveyData');
    }

    protected function getForms(): array
    {
        return [
            'surveyForm',
        ];
    }

    public function createSurvey(): void
    {
        $data = $this->surveyForm->getState();

        if (Survey::where('name', $data['name'])->exists()) {
            Notification::make()
                ->title(__('notification.surveys.already_exists'))
                ->danger()
                ->duration(2500)
                ->send();

            return;
        }

        Survey::create($data);

        Notification::make()
            ->title(__('notification.surveys.created'))
            ->success()
            ->duration(2500)
            ->send();

        $this->surveyForm->fill();
    }

    public function render()
    {
        return view('livewire.create-survey');
    }
}
