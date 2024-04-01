<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    public function room()
    {
        return $this->belongsTo(Room::class,'classroom_id','id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
