<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patients extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'last_name', 'phone', 'photo', 'address', 'description', 'user_id', 'email', 'extra'
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }
}
