<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'pre_rub',
        'pre_usd',
        'marzha',
        'sborka',
        'price',
        'length',
        'width',
        'height',
        'weight',
        'description',
        'descriptionmanager',
        'box_images',
    ];

    protected $casts=['box_images'=>'json'];

    public function types()
    {
        return $this->belongsToMany('App\Models\Type');
    }

    public function elements()
    {
        return $this->belongsToMany('App\Models\Element');
    }

    public function calculations()
    {
        return $this->belongsToMany('App\Models\Calculation');
    }
}
