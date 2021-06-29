<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'inn',
        'phone',
        'email',
    ];

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project');
    }
}
