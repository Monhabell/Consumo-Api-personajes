<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personajes extends Model
{
    protected $fillable =[
        'name',
        'status',
        'species',
        'type',
        'sex',
        'origin_name',
        'origin_url',
        'image',
    ];
}
