<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institutions extends Model
{
    protected $fillable = [
        'name', 'address', 'description', 'user_id', 'extra'
    ];
}
