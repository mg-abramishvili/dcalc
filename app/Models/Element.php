<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'pre_rub',
        'pre_usd',
        'price'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function calculations()
    {
        return $this->belongsToMany('App\Models\Calculation');
    }

    public function boxes()
    {
        return $this->belongsToMany('App\Models\Box');
    }
}
