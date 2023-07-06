<?php

namespace App\Actions;

use App\Models\Exercise;
use App\Models\Set;
use App\Models\TrainingDay;
use App\Repositories\TrainingRepository;
use Illuminate\Support\Facades\DB;

class TrainingCreateAction
{
    protected TrainingRepository $trainingRepository;

    public function __construct(TrainingRepository $trainingRepository)
    {
        $this->trainingRepository = $trainingRepository;
    }

    public function handle($request): array
    {
        if($this->trainingRepository->firstByDate($request->input('date'), $request->user()->id)){
            return ['msg' => 'Training already exist to date: '.$request->input('date'), 'status' => 400];
        }

        try {

            DB::transaction(function () use ($request) {
                $trainingDay = TrainingDay::create(['date' => $request->input('date'), 'user_id' => $request->user()->id]);

                $data = $request->input('data');

                foreach ($data as $item) {
                    $id = $item['id'];
                    $sets = $item['sets'];

                    foreach ($sets as $set) {
                        $reps = $set['reps'];
                        $weight = $set['weight'] ?? 0; // Используется значение 0, если 'weight' не указан

                        // Создание сущности Set
                        Set::create([
                            'training_day_id' => $trainingDay->id,
                            'exercise_id' => $id,
                            'reps' => $reps,
                            'weight' => $weight
                        ]);
                    }
                }
            });


            return ['msg' => 'Training day created', 'status' => 201];

        } catch (\Exception $e) {
            return ['msg' => $e->getMessage(), 'status' => 500];
        }
    }
}