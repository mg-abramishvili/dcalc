<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'inn',
        'phone',
        'email',
    ];

    public function projects_by_endclients()
    {
        return $this->belongsToMany('App\Models\Project', 'cendclient_project');
    }

    public function projects_by_partners()
    {
        return $this->belongsToMany('App\Models\Project', 'cpartner_project');
    }
}
