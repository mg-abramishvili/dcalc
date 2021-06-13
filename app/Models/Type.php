<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function boxes()
    {
        return $this->belongsToMany('App\Models\Box');
    }

    public function calculations()
    {
        return $this->belongsToMany('App\Models\Calculation');
    }
}
