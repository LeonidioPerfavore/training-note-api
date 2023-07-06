<?php

namespace App\Http\Requests\Training;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use function response;

class TrainingRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'data' => 'required|array',
            'data.*.id' => 'required',
            'data.*.sets' => 'required|array',
            'data.*.sets.*.reps' => 'required',

//            'data' => 'required|array',
//            'data.*.name' => 'required|string',
//            'data.*.sets' => 'required|integer',
//            'data.*.reps' => 'required|array',
//            'data.*.reps.*' => 'required|integer',
//            'data.*.weight' => 'required|array',
//            'data.*.weight.*' => 'required|integer',
            'date' => 'required|date_format:Y-m-d'
        ];
    }

//    public function withValidator($validator)
//    {
//        $validator->after(function ($validator) {

//            $data = $this->input('data');
//            foreach ($data as $r){
//                if($r['sets'] != count($r['reps'])){
//                    $validator->errors()->add('reps', 'The number of reps must match the sets.');
//                }

//                if(count($r['reps']) != count($r['weight'])){
//                    $validator->errors()->add('reps', 'The number of reps must match the weight.');
//                }
//            }

//        });
//    }

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
            'data.required' => 'The data field is required.',
            'data.array' => 'The data field must be an array.',
            'data.*.id' => 'Id of exercises is required.',
            'data.*.sets' => 'Sets is required.',
            'data.*.sets.*.reps' => 'Reps is required.',

//            'data.*.name.required' => 'The name field is required.',
//            'data.*.name.string' => 'The name field must be a string.',
//
//            'data.*.sets.required' => 'The sets field is required.',
//            'data.*.sets.integer' => 'The sets field must be an integer.',
//
//            'data.*.reps.required' => 'The reps field is required.',
//            'data.*.reps.array' => 'The reps field must be an array.',
//            'data.*.reps.*.required' => 'Each rep in reps must have a value.',
//            'data.*.reps.*.integer' => 'Each rep in reps must be an integer.',

//            'data.*.weight.required' => 'The weight field is required.',
//            'data.*.weight.array' => 'The weight field must be an array.',
//            'data.*.weight.*.required' => 'Each weight in weights must have a value.',
//            'data.*.weight.*.integer' => 'Each weight in weights must be an integer.',

            'date.required' => 'The date field is required.',
            'date.date_format:Y-m-d' => 'The date must be in Y-m-d format.',
        ];
    }
}