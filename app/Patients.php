<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patients extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'last_name', 'phone', 'photo',
        'address', 'description', 'user_id', 'email', 'extra','images',
        'emergency_name', 'emergency_last_name', 'emergency_phone', 'age',
        'institutions_id'
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }

    public function scopeGallery($query)
    {
        try {
            $data = $query->first();
            $raw = explode(',', $data->images);
            $images = Media::whereIn('id', $raw)
                ->with(['user'])
                ->get();
            $data->images = $images;
            return $data;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return $query->first();
        }
    }
}
