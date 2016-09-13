<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fact extends Model
{
    use SoftDeletes;
    //
    //


    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
