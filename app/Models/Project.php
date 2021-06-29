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

    public function offers()
    {
        return $this->belongsToMany('App\Models\Offer');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function partners()
    {
        return $this->belongsToMany('App\Models\Client');
    }
}
