<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forms extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'scheme',
        'declaration',
        'source'
    ];
    //

    public function scopeValues($query, $id)
    {
        try {
            $data = $query->first();
//            $raw = explode(',', $data->images);

            $values = FormsValues::where('forms_id',$data->id)
                ->where('target_id',$id)
                ->first();
            $data->retrieved = wrapper_values($values);
            $data = wrapper_scheme($data);
            return $data;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return $query->first();
        }
    }
}
