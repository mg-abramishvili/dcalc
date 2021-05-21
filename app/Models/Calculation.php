<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment'
    ];

    public function elements()
    {
        return $this->belongsToMany('App\Models\Element')->withPivot(['amount', 'price']);
    }

    public function offers()
    {
        return $this->belongsToMany('App\Models\Offer');
    }
}
