<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Ecategory');
    }

    public function calculations()
    {
        return $this->belongsToMany('App\Models\Calculation');
    }
}
