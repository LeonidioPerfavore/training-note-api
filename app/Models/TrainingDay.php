<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingDay extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'training_day_id'
    ];

    public function setSets($index, $sets)
    {
        if (isset($this->components[$index])) {
            $component = $this->components[$index];
            if ($component instanceof Exercise) {
                $component->setSets($sets);
            }
        }
    }

    public function sets()
    {
        return $this->hasMany(Set::class);
    }

}
