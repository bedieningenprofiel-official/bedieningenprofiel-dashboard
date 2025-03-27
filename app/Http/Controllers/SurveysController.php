<?php

namespace App\Http\Controllers;

use App\Models\Surveys\Survey;
use Illuminate\View\View;

class SurveysController extends Controller
{
    public function index(): View
    {
        return view('surveys.index', [
            'surveys' => Survey::all(),
        ]);
    }
}
