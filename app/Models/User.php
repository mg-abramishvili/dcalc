<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'elements_prices',
        'elements_edit',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function calculations()
    {
        return $this->belongsToMany('App\Models\Calculation');
    }

    public function offers()
    {
        return $this->belongsToMany('App\Models\Offer');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project');
    }
}
