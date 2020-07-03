<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'last_name', 'phone', 'photo', 'address', 'description',
        'email', 'user_id', 'extra', 'images', 'age', 'institutions_id', 'zone'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function institution()
    {
        return $this->hasOne('App\Institutions', 'id', 'institutions_id');
    }

    public function scopeGallery($query)
    {
        try {
            $data = $query->first();
            $raw = explode(',', $data->images);
            $images = Media::whereIn('id', $raw)->get();
            $data->images = $images;
            return $data;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return $query->first();
        }
    }
}
