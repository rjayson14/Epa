<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
class UserController extends Controller
{
    //

    public function change(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        $user = User::where('id', $id)->first();
        $user->password = bcrypt($request->password);
        $user->save();
        Alert::success('Successfully Change Password')->persistent('Dismiss');
        return back();
    }
}
