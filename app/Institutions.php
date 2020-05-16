<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institutions extends Model
{
    protected $fillable = [
        'name', 'address', 'description', 'user_id', 'extra'
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }
}
