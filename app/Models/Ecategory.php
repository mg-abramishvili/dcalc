<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecategory extends Model
{
    use HasFactory;

    public function elements()
    {
        return $this->belongsToMany('App\Models\Element');
    }
}
