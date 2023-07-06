<?php

namespace App\Actions;

use App\Models\TrainingDay;

class ShowTrainingDay
{
    public function handle($request)
    {
        $data = [];

        $user_id = $request->user()->id;
        $date = $request->input('date');

        $trainingDay = TrainingDay::where('user_id', $user_id)
            ->where('date', $date)
            ->with(['sets', 'sets.exercise'])
            ->first();

        if(!$trainingDay){
            return $data;
        }

        $sets = $trainingDay->sets;

        foreach ($sets as $set) {
            $exercise = $set->exercise;
            $name = $exercise->name;

            $key = array_search($set->exercise_id, array_column($data, 'id'));

            if ($key === false) {
                $data[] = [
                    'id' => $set->exercise_id,
                    'training_id' => $trainingDay->id,
                    'name' => $name,
                    'sets' => [
                        [
                            'reps' => $set->reps,
                            'weight' => $set->weight
                        ]
                    ]
                ];
            } else {
                $data[$key]['sets'][] = [
                    'reps' => $set->reps,
                    'weight' => $set->weight
                ];
            }
        }

        return $data;
    }
}