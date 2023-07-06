<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'name',
        'user_id'
    ];

    public function setReps($index, $sets)
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