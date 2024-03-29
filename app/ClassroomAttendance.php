<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomAttendance extends Model
{
    //
    public function classroom()
    {
        return $this->belongsTo(Room::class,'classroom_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
