<?php

namespace App\Http\Controllers;
use App\User;
use App\Teacher;
use App\Guardian;
use App\Notifications\Registration;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //
    public function index()
    {
        $teachers = User::where('role','Teacher')->get();
        
        return view('teachers.teachers',
        array(
            'teachers' => $teachers,
        )
        );
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users|max:255',
            'staff_id' => 'required|unique:teachers|max:255',
        ]);
        
        $file_name='';
        if($request->hasFile('file'))
        {
            $attachment = $request->file('file');
            $original_name = $attachment->getClientOriginalName();
            $name = time().'_'.$attachment->getClientOriginalName();
            $attachment->move(public_path().'/avatar/', $name);
            $file_name = '/avatar/'.$name;
           
        }
        $password = $this->getRandomStringRand();
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->firstname." ".$request->lastname;
        $user->password = bcrypt($password);
        $user->role = "Teacher";
        $user->avatar = $file_name;
        $user->save();

        $teacher = new Teacher;
        $teacher->staff_id = $request->staff_id;
        $teacher->cellphone = $request->contact_number;
        $teacher->position = $request->position;
        $teacher->firstname = $request->firstname;
        $teacher->middlename = $request->middlename;
        $teacher->lastname = $request->lastname;
        $teacher->gender = $request->gender;
        $teacher->birthdate = $request->birthdate;
        $teacher->address = $request->address;
        $teacher->user_id = $user->id;
        $teacher->save();

        $guardian = new Guardian;
        $guardian->name = $request->guardian_name;
        $guardian->contact_number = $request->guardian_contact_number;
        $guardian->email = $request->guardian_email;
        $guardian->relationship = $request->relationship;
        $guardian->user_id = $user->id;
        $guardian->save();
        $user->notify(new Registration($user,$password));


        Alert::success('Successfully Created.')->persistent('Dismiss');
        return back();
    }
    
    public function Update(Request $request,$id)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users,email,'.$id.'|max:255',
        ]);
        
        $file_name='';
        if($request->hasFile('file'))
        {
            $attachment = $request->file('file');
            $original_name = $attachment->getClientOriginalName();
            $name = time().'_'.$attachment->getClientOriginalName();
            $attachment->move(public_path().'/avatar/', $name);
            $file_name = '/avatar/'.$name;
           
        }
        $user = User::findOrfail($id);
        $user->name = $request->firstname." ".$request->lastname;
        $user->avatar = $file_name;
        $user->save();

        $teacher = Teacher::where('user_id',$id)->first();
        $teacher->cellphone = $request->contact_number;
        $teacher->position = $request->position;
        $teacher->firstname = $request->firstname;
        $teacher->middlename = $request->middlename;
        $teacher->lastname = $request->lastname;
        $teacher->gender = $request->gender;
        $teacher->birthdate = $request->birthdate;
        $teacher->address = $request->address;
        $teacher->user_id = $user->id;
        $teacher->save();

        $guardian = Guardian::where('user_id',$id)->first();
        $guardian->name = $request->guardian_name;
        $guardian->contact_number = $request->guardian_contact_number;
        $guardian->email = $request->guardian_email;
        $guardian->relationship = $request->relationship;
        $guardian->user_id = $user->id;
        $guardian->save();


        Alert::success('Successfully Updated.')->persistent('Dismiss');
        return back();
    }
    public function upload_image(Request $request,$id)
    {
        $user = User::findOrfail($id);
        if($request->hasFile('file'))
        {
            $attachment = $request->file('file');
            $original_name = $attachment->getClientOriginalName();
            $name = time().'_'.$attachment->getClientOriginalName();
            $attachment->move(public_path().'/avatar/', $name);
            $file_name = '/avatar/'.$name;
            $user->avatar = $file_name;
            $user->save();
        }
        Alert::success('Successfully Updated.')->persistent('Dismiss');
        return back();
    }

    function getRandomStringRand($length = 16)
    {
        $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $stringLength = strlen($stringSpace);
        $randomString = '';
        for ($i = 0; $i < $length; $i ++) {
            $randomString = $randomString . $stringSpace[rand(0, $stringLength - 1)];
        }
        return $randomString;
    } 
}
