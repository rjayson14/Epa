<?php

namespace App\Http\Controllers;
use App\Room;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:rooms|max:255',
        ]);
        $new_room = new Room;
        $new_room->name = $request->name;
        $new_room->save();

        Alert::success('Successfully Created.')->persistent('Dismiss');
        return back();
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:rooms,name,'.$id.'|max:255',
        ]);

        $new_room = Room::findOrfail($id);
        $new_room->name = $request->name;
        $new_room->save();

        Alert::success('Successfully Updated.')->persistent('Dismiss');
        return back();
    }
}
