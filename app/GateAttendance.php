<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GateAttendance extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function gate()
    {
        return $this->belongsTo(Gate::class,'gate_id','id');
    }
    public function classroom()
    {
        return $this->belongsTo(Room::class,'classroom_id','id');
    }
}
