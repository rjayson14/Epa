<?php

namespace App\Http\Controllers;
use App\Student;
use App\Teacher;
use App\GateAttendance;
use App\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function index(Request $request,$type)
    {
        $user_name = $request->user_name;
        $date = $request->date;
        $users = User::where('role',$type)->get();
        $attendances = GateAttendance::where('date',date('1'))->get();
        if($date)
        {
            $attendances = GateAttendance::where('date',$date)->orderBy('time','desc')->get(); 
            if($user_name)
            {
                $attendances = GateAttendance::where('date',$date)->where('user_id',$user_name)->orderBy('time','desc')->get(); 
            }
        }
        return view('attendances',
            array(
                'users' => $users,
                'attendances' => $attendances,
                'date' => $date,
                'user_name' => $user_name,
            )
        );
    }

    public function myAttendance(Request $request)
    {
        $user_name = auth()->user()->id;
        $date = $request->date;
        $attendances = GateAttendance::where('date',date('Y-m-d'))->where('user_id',$user_name)->get();
        if($date)
        {
            $attendances = GateAttendance::where('date',$date)->orderBy('time','desc')->get(); 
            if($user_name)
            {
                $attendances = GateAttendance::where('date',$date)->where('user_id',$user_name)->orderBy('time','desc')->get(); 
            }
        }
        return view('my_attendance',
            array(
                'attendances' => $attendances,
                'date' => $date,
            )
        );
    }
}
