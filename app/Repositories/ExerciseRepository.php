<?php

namespace App\Repositories;

use App\Models\Exercise;
use App\Models\User;

class ExerciseRepository
{
    public function all()
    {
        return Exercise::select('name')->get();
    }

    public function idAndNames()
    {
        return Exercise::select('id', 'name')->get();
    }

    public function create($data)
    {
        return Exercise::create([
            'name' => $data->input('name'),
            'user_id' => $data->user()->id
        ]);
    }
}