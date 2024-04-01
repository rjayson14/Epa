<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    //
   

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
