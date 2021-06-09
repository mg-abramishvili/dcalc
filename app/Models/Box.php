<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price'
    ];

    public function types()
    {
        return $this->belongsToMany('App\Models\Type');
    }

    public function elements()
    {
        return $this->belongsToMany('App\Models\Element');
    }
}
