<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormsValues extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'forms_id',
        'values',
        'user_id',
        'target_id',
        'extra'
    ];

    //

}
