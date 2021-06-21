<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'priority',
        'deadline',
        'payment',
        'description',
    ];

    public function calculations()
    {
        return $this->belongsToMany('App\Models\Calculation');
    }
}
