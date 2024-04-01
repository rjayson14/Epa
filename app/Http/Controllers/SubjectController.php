<?php

namespace App\Http\Controllers;
use App\Subject;
use App\Room;
use App\Schedule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //

    public function index(Request $request)
    {
        $subjects= Subject::where('user_id',auth()->user()->id)->get();
        $schedules = Schedule::where('user_id',auth()->user()->id)->get();
        $rooms = Room::get();
        return view('subjects',array(
            'subjects' => $subjects,
            'rooms' => $rooms,
            'schedules' => $schedules,
        ));
    }
    public function store(Request $request)
    {
        $new = new Subject;
        $new->name = $request->name;
        $new->code = $request->code;
        $new->user_id = auth()->user()->id;
        $new->save();

        Alert::success('Successfully Created.')->persistent('Dismiss');
        return back();
    }
    public function update(Request $request,$id)
    {

        $subject = Subject::findOrfail($id);
        $subject->name = $request->name;
        $subject->code = $request->code;
        $subject->save();

        Alert::success('Successfully Updated.')->persistent('Dismiss');
        return back();
    }
}
