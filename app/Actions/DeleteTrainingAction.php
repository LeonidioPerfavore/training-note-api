<?php

namespace App\Actions;

use App\Models\TrainingDay;

class DeleteTrainingAction
{
    public function handle($request)
    {
        if(!$request->input('id')){
            return ['msg' => 'Id param required', 'status' => 400];
        }

        $trainingDay = TrainingDay::where('user_id', $request->user()->id)
            ->where('id', $request->input('id'))
            ->first();

        if(!$trainingDay){
            return ['msg' => 'Training not found', 'status' => 404];
        }

        $trainingDay->sets()->delete();
        $trainingDay->delete();

        return ['msg' => 'Training deleted success!', 'status' => 200];
    }

}