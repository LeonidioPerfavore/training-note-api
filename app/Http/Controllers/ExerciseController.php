<?php

namespace App\Http\Controllers;

use App\Http\Requests\Exercise\CreateExerciseRequest;
use App\Repositories\ExerciseRepository;
use Illuminate\Http\JsonResponse;

class ExerciseController extends Controller
{
    protected ExerciseRepository $exerciseRepository ;

    public function __construct(ExerciseRepository $exerciseRepository)
    {
        $this->exerciseRepository = $exerciseRepository;
    }

    public function list(): JsonResponse
    {
        return response()->json($this->exerciseRepository->all());
    }

    public function getExercisesForCreate(): JsonResponse
    {
        return response()->json($this->exerciseRepository->idAndNames());
    }

    public function createExercise(CreateExerciseRequest $request): JsonResponse
    {
        $this->exerciseRepository->create($request);

        return response()->json(['msg' => 'Exercise created success']);
    }

    /** For admin **/
//    public function updateExercise()
//    {
//
//    }
}