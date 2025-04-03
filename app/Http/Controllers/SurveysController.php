<?php

namespace App\Http\Controllers;

use App\Imports\SurveyQuestionsImport;
use App\Models\Surveys\Survey;
use App\Repositories\SurveyRepository;
use App\Services\UploadFileMechanic;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Facades\Excel;

class SurveysController extends Controller
{
    public function __construct(
        protected SurveyRepository $surveyRepository,
    ) {
    }

    public function index(): View
    {
        return view('surveys.index', [
            'surveys' => Survey::all(),
        ]);
    }

    public function show(Survey $survey): View
    {
        return view('surveys.show', [
            'survey' => $survey,
        ]);
    }

    public function create(): View
    {
        return view('surveys.create');
    }

    public function handleExcel(Request $request, Survey $survey): RedirectResponse
    {
        $path = 'excel/' . $request->excel_file;
        Excel::import(new SurveyQuestionsImport($survey), $path, 'public', ExcelType::XLSX);

        $survey->update([
            'excel_file' => $request->excel_file,
        ]);

        Storage::exists($path);
        Storage::delete($path);

        Notification::make()
            ->title('Excel file has been imported')
            ->success()
            ->duration(2500)
            ->send();

        return redirect()->back();
    }
}
