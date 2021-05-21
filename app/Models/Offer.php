<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'client'
    ];

    public function calculations()
    {
        return $this->belongsToMany('App\Models\Calculation');
    }
}
