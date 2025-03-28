<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSurveyRequest;
use App\Models\Surveys\Survey;
use App\Repositories\SurveyRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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

    public function store(CreateSurveyRequest $request): RedirectResponse
    {
        $validated = $request->validated();
    }
}
