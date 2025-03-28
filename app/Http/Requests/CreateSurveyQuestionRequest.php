<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSurveyQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'questions' => 'required|array|min:1',
            'questions.*.left_statement' => 'required|string|max:255',
            'questions.*.right_statement' => 'required|string|max:255',
            'questions.*.left_personality_id' => 'nullable|exists:personality_types,id',
            'questions.*.right_personality_id' => 'nullable|exists:personality_types,id',
            'questions.*.order' => 'sometimes|integer|min:0'
        ];
    }
}
