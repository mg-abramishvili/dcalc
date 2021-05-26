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

    public function connected_elements()
    {
        return $this->belongsToMany('App\Models\Element', 'element_element', 'element_id', 'celement_id');
    }

    public function boxes()
    {
        return $this->belongsToMany('App\Models\Box');
    }
}
