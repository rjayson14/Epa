<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'id','user_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class,'id','user_id');
    }
    public function guardian()
    {
        return $this->belongsTo(Guardian::class,'id','user_id');
    }
    public function attendances_time_in()
    {
        return $this->hasMany(GateAttendance::class)->orderBy('time','asc');
    }
    public function attendances_time_out()
    {
        return $this->hasMany(GateAttendance::class)->orderBy('time','desc');
    }

    public function attendances_time_in_room()
    {
        return $this->hasMany(ClassroomAttendance::class)->orderBy('time','asc');
    }
    public function attendances_time_out_room()
    {
        return $this->hasMany(ClassroomAttendance::class)->orderBy('time','desc');
    }
}
