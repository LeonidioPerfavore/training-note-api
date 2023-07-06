<?php

namespace App\Http\Requests\Training;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MonthDataRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'year' => 'required|integer|min:2000|max:3000',
            'month' => 'required|integer|min:1|max:12'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors(),
        ], 422));
    }

    public function messages(): array
    {
        return [
            'year.required' => 'The year is required.',
            'year.integer' => 'The year must be integer.',
            'year.min' => 'There are only 2023 year.',
            'year.max' => 'There are only 2023 year.',
            'month.required' => 'The month is required.',
            'month.integer' => 'The year must be integer.',
            'month.min' => 'There are only 12 months.',
            'month.max' => 'There are only 12 months.',
        ];
    }
}