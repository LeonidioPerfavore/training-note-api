<?php

namespace App\Repositories;

use App\Models\TrainingDay;

class TrainingRepository
{
    public function byId($id, $userId)
    {
        return TrainingDay::where('id', $id)->where('user_id', $userId)->first();
    }

    public function firstByDate($date, $userId)
    {
       return TrainingDay::where('date', $date)->where('user_id', $userId)->first();
    }

    public function month($userId, $year, $month): array
    {
        $trainings = TrainingDay::where('user_id', $userId)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'ASC')
            ->pluck('date')
            ->toArray();

        $result = [];
        foreach ($trainings as $date) {
            $result[date('j', strtotime($date))] = in_array($date, $trainings);
        }

        return $result;
    }
}