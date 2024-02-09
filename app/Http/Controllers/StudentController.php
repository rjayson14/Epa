<?php

namespace App\Http\Controllers;
use App\Student;
use App\Guardian;
use App\User;
use App\Notifications\Registration;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //


    public function index()
    {
        $students = User::where('role','Student')->get();


        return view('students.studentsPage',
        array(
            'students' => $students,
        )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users|max:255',
            'student_id' => 'required|unique:students|max:255',
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
        $user->role = "Student";
        $user->avatar = $file_name;
        $user->save();

        $student = new Student;
        $student->student_id = $request->student_id;
        $student->cellphone = $request->contact_number;
        $student->course = $request->course;
        $student->firstname = $request->firstname;
        $student->middlename = $request->middlename;
        $student->lastname = $request->lastname;
        $student->gender = $request->gender;
        $student->birthdate = $request->birthdate;
        $student->address = $request->address;
        $student->user_id = $user->id;
        $student->save();

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
    public function update(Request $request,$id)
    {
       
        $user = User::findOrfail($id);
        $user->name = $request->firstname." ".$request->lastname;
        $user->save();

        $student = Student::where('user_id',$id)->first();
        $student->cellphone = $request->contact_number;
        $student->course = $request->course;
        $student->firstname = $request->firstname;
        $student->middlename = $request->middlename;
        $student->lastname = $request->lastname;
        $student->gender = $request->gender;
        $student->birthdate = $request->birthdate;
        $student->address = $request->address;
        $student->save();

        $guardian = Guardian::where('user_id',$id)->first();
        $guardian->name = $request->guardian_name;
        $guardian->contact_number = $request->guardian_contact_number;
        $guardian->email = $request->guardian_email;
        $guardian->relationship = $request->relationship;
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
