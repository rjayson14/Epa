<?php

namespace App\Http\Controllers;
use App\Student;
use App\Teacher;
use App\GateAttendance;
use App\ClassroomAttendance;
use App\User;
use PDF;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function index(Request $request,$type)
    {
        $user_name = $request->user_name;
        $date = $request->date;
        $users = User::where('role',$type)->get();
        if($date == null)
        {
           
            $date = date('Y-m-d');
        }
        return view('attendances',
            array(
                'users' => $users,
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
        $classroom_attendances = ClassroomAttendance::where('date',date('Y-m-d'))->where('user_id',$user_name)->get();
        if($date)
        {
            $attendances = GateAttendance::where('date',$date)->orderBy('time','desc')->get(); 
            $classroom_attendances = ClassroomAttendance::where('date',$date)->orderBy('time','desc')->get(); 
            if($user_name)
            {
                $attendances = GateAttendance::where('date',$date)->where('user_id',$user_name)->orderBy('time','desc')->get(); 
                $classroom_attendances = ClassroomAttendance::where('date',$date)->where('user_id',$user_name)->orderBy('time','desc')->get(); 
            }
        }
        return view('my_attendance',
            array(
                'attendances' => $attendances,
                'classroom_attendances' => $classroom_attendances,
                'date' => $date,
            )
        );
    }

    public function attendanceReport(Request $request,$type,$date)
    {
        $time_in = User::whereHas('attendances_time_in', function ($query) use ($date) { $query->where('date',$date); })->get();
        $users = User::orderBy('name','asc')->get();
        $pdf = PDF::loadView('PrintAttendance',array(
                'date' => $date,
                'users' => $users,
                'time_in' => $time_in,
                'type' => $type,
   
           ));
           return $pdf->stream('PrintAttendance.pdf');
    }
}
