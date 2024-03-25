<?php

namespace App\Http\Controllers;
use App\Gate;
use App\Room;
use App\User;
use App\Teacher;
use App\Student;
use App\Guardian;
use Rats\Zkteco\Lib\ZKTeco;
use Twilio\Rest\Client;
use App\GateAttendance;
use App\ClassroomAttendance;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    //

    public function index ()
    {
        $gates = Gate::get();
        $rooms = Room::get();

            return view('settings',
            array(
                'gates' => $gates,
                'rooms' => $rooms,
            )
        );

    }

    public function scanner($type,$id)
    {
       if($type == 'gate')
       {
        $gate = Gate::findOrfail($id);
        return view('scanner',array(
            'gate' => $gate,
        ));
       }
       else
       {
        $gate = Room::findOrfail($id);
        return view('scanner',array(
            'gate' => $gate,
        ));
       }
    }
    public function qrcode(Request $request)
    {

        $user = User::where('password',$request->id)->first();
        if($user == null)
        {
            
        }
        else
        {
            return view('generate_qr_code',array(
                'user' => $user,
                'id' =>$request->id,
            ));
        }
    }
    private function sendMessage($message, $recipients)
    {
        $account_sid = config('app.twilio_sid');
        $auth_token = config('app.twilio_auth');
        $twilio_number = config('app.twilio_number');
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }
    public function checkuser(Request $request)
    {
        $course = "";
        $attendance = [];
        $time = "";
        $type = "";
		 $result =0;

         if ($request->data) {
            // dd($request->data);
            $user = User::where('password',$request->data)->first();
        //    dd($user->role);
            if ($user) {
                if($user->role == "Teacher")
                {
                    $teacher = Teacher::where('user_id',$user->id)->first();
                    $course = $teacher->position;
                }
                else
                {
                    $student = Student::where('user_id',$user->id)->first();
                    $course = $student->course;

                    $guardian = Guardian::where('user_id',$user->id)->first();
                    
                    $str_to_replace = '+63';

                    $gate = Gate::where('id',$request->id)->first();
                    $output_str = $str_to_replace . substr($guardian->contact_number, 1);
                    $body = "\nHello from EP Access!  \n ".$user->name." successfully scanned the QR code at the ".$gate->name."\n Time : ".date('M d, Y h:i A')."\n Type : ".$request->type;
                    if($guardian)
                    {
                        // try {
                        $this->sendMessage($body, $output_str);
                        // }
                        // catch ( \Exception $e )
                        // {
                        // }
                    }
                }
                $attendance = new GateAttendance;
                $attendance->gate_id = $request->id; 
                $attendance->type = $request->type;
                $attendance->time = date('Y-m-d h:i:s');
                $attendance->date = date('Y-m-d');
                $attendance->user_id =  $user->id;
                $attendance->save();
                $type = $request->type;
                $time = date('h:i a',strtotime($attendance->time));
                $result =1;
            }
            else{
                $result =0;
            }

            return array(
				'user' => $user,
				'attendance' => $attendance,
				'course' => $course,
				'time' => $time,
				'type' => $type,
			);


         }



    }

    public function gates()
    {
        $gates = Gate::get();
        return view('gates',array(
            'gates' => $gates,
        ));
    }
    public function classrooms()    
    {
        $classrooms = Room::get();
        return view('classrooms',array(
            'classrooms' => $classrooms,
        ));
    }
    public function get_attendances()   
    {
        $zk = new ZKTeco("192.168.0.201");

        $zk->connect();
        // $zk->enableDevice();   
        $attendances = $zk->getAttendance();
        $classroom = Room::where('ip_address','192.168.0.201')->first();
        $last_attendance = ClassroomAttendance::orderBy('time','desc')->first();
        $compare = null;
        if($last_attendance != null)
        {
            $last_attendance_tieout = ClassroomAttendance::orderBy('time_out','desc')->first();
            $compare = $last_attendance->time;
            if($last_attendance_tieout > $last_attendance)
            {
                $compare = $last_attendance_tieout->time_out; 
            }
        }
       
        if($compare != null)
        {
            $attendances = collect($attendances)->where('timestamp','>',$compare)->take(100);
        }
        foreach($attendances as $attendance)
        {
            // $user = User::where('id',$attendance['id'])->first();
            // //    dd($user->role);
            //     if ($user) {
            //         if($user->role == "Teacher")
            //         {
            //             $teacher = Teacher::where('user_id',$user->id)->first();
            //             $course = $teacher->position;
            //         }
            //         else
            //         {
            //             $student = Student::where('user_id',$user->id)->first();
            //             $course = $student->course;
    
            //             $guardian = Guardian::where('user_id',$user->id)->first();
                        
            //             $str_to_replace = '+63';
    
            //             $output_str = $str_to_replace . substr($guardian->contact_number, 1);
            //             $body = "\nHello from EP Access!  \n ".$user->name." successfully scanned the QR code at the Face Recognition Device\n Time : ".date('M d, Y h:i A');
            //             if($guardian)
            //             {
            //                 $this->sendMessage($body, $output_str);
                          
            //             }
            //         }
            //     }
                $insert = new ClassroomAttendance;
                if($attendance['type'] == 0)
                {
                    
                    $insert->type = "Time In";
                }
                else
                {
                    $insert->type = "Time Out"; 
                }
                $insert->time = $attendance['timestamp'];
                $insert->classroom_id = $classroom->id;
                $insert->date = date('Y-m-d',strtotime($attendance['timestamp']));
                $insert->user_id =  $attendance['id'];
                $insert->save();
        }
        Alert::success('Successfully Sync Biometrics')->persistent('Dismiss');
        return back();
    }
}
