<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'price_total'
    ];

    public function elements()
    {
        return $this->belongsToMany('App\Models\Element')->withPivot('price');
    }

    public function types()
    {
        return $this->belongsToMany('App\Models\Type');
    }

    public function boxes()
    {
        return $this->belongsToMany('App\Models\Box');
    }

    public function offers()
    {
        return $this->belongsToMany('App\Models\Offer');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
