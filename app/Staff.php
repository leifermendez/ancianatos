<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'last_name', 'phone', 'photo', 'address', 'description',
        'email', 'user_id', 'extra'
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }
}
