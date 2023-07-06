<?php

namespace App\Http\Controllers;

use App\Actions\DeleteTrainingAction;
use App\Actions\ShowTrainingDay;
use App\Actions\TrainingCreateAction;
use App\Http\Requests\Training\MonthDataRequest;
use App\Http\Requests\Training\TrainingRequest;
use App\Repositories\TrainingRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    protected TrainingRepository $trainingRepository;

    public function __construct(TrainingRepository $trainingRepository)
    {
        $this->trainingRepository = $trainingRepository;
    }

    public function getTrainingMonth(MonthDataRequest $request): JsonResponse
    {
        return response()->json([
            $this->trainingRepository->month($request->user()->id, $request->input('year'), $request->input('month')),
        ]);
    }

    public function createTraining(TrainingRequest $request, TrainingCreateAction $action): JsonResponse
    {
        $create = $action->handle($request);

        return response()->json(['msg' => $create['msg']], $create['status']);
    }

    public function trainingShow(Request $request, ShowTrainingDay $action): JsonResponse
    {
        return response()->json($action->handle($request));
    }

    public function delete(Request $request, DeleteTrainingAction $action): JsonResponse
    {
        $delete = $action->handle($request);

        return response()->json(['msg' => $delete['msg']], $delete['status']);
    }


//    public function update(Request $request, $id)
//    {
//
//    }
}