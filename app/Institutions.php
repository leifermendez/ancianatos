<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institutions extends Model
{
    protected $fillable = [
        'id',
        'name', 'address', 'description', 'user_id', 'extra', 'images', 'phone', 'zone', 'type'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
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
