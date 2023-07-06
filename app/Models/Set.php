<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reps',
        'exercise_id',
        'weight',
        'training_day_id',
    ];

    public function trainingDay()
    {
        return $this->belongsTo(TrainingDay::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}