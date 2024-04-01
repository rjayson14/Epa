<?php

namespace App\Http\Controllers;
use App\Schedule;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class ScheduleController extends Controller
{
    //

    public function create(Request $request)
    {
        $schedule = new Schedule;
        $schedule->subject_id  = $request->subject;
        $schedule->classroom_id = $request->classroom;
        $schedule->date = $request->date;
        $schedule->time_from = $request->time_from;
        $schedule->time_to = $request->time_to;
        $schedule->user_id  = auth()->user()->id;
        $schedule->save();

        Alert::success('Successfully Created.')->persistent('Dismiss');
        return back();



    }

    public function update(Request $request,$id){
        $schedule = Schedule::findOrfail($id);
        $schedule->subject_id  = $request->subject;
        $schedule->classroom_id = $request->classroom;
        $schedule->date = $request->date;
        $schedule->time_from = $request->time_from;
        $schedule->time_to = $request->time_to;
        $schedule->user_id  = auth()->user()->id;
        $schedule->save();

        
        Alert::success('Successfully Updated.')->persistent('Dismiss');
        return back();

    }
}
