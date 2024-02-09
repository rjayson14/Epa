<?php

namespace App\Http\Controllers;
use App\Gate;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class GateController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:gates|max:255',
        ]);
        $new_gate = new Gate;
        $new_gate->name = $request->name;
        $new_gate->save();

        Alert::success('Successfully Created.')->persistent('Dismiss');
        return back();
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:gates,name,'.$id.'|max:255',
        ]);

        $gate = Gate::findOrfail($id);
        $gate->name = $request->name;
        $gate->save();

        Alert::success('Successfully Updated.')->persistent('Dismiss');
        return back();
    }
}
