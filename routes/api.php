<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ExerciseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
|                               API Routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
    return response()->json(['user' => $request->user()]);

});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/training-month', [TrainingController::class, 'getTrainingMonth']);
    Route::get('/training-show', [TrainingController::class, 'trainingShow']);
    Route::post('/training-create', [TrainingController::class, 'createTraining']);
    Route::put('/training-update/{id}', [TrainingController::class, 'update']);
    Route::delete('/training-delete', [TrainingController::class, 'delete']);
    Route::get('/exercise/list', [ExerciseController::class, 'list']);
    Route::get('/exercise/create-list', [ExerciseController::class, 'getExercisesForCreate']);
    Route::post('/exercise/create', [ExerciseController::class, 'createExercise']);
//    Route::post('/statistic', [TrainingController::class, 'Statistic']);
});

//Route::get('/training-week', [TrainingController::class, 'getTrainingWeek']);

