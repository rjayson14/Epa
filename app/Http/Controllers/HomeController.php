<?php

namespace App\Http\Controllers;
use App\Student;
use App\Teacher;
use App\User;
use Twilio\Rest\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private function sendMessage($message, $recipients)
    {
        $account_sid = config('app.twilio_sid');
        $auth_token = config('app.twilio_auth');
        $twilio_number = config('app.twilio_number');
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
        return json_encode($client);
    }
    public function send_message(Request $request)
    {
        $number = $request->number;
        $body = "\nHello from EP Access!  \n [Name] successfully scanned the QR code at the [Gate]\n Time : ".date('M d, Y h:i A')."\n Type : [In or Out]";
                  
        $a = $this->sendMessage($body, $number);
        return $a;
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $date = $request->date;
        if($date == null)
        {
            $date = date("Y-m-d");
        }
        $time_in = User::whereHas('attendances_time_in', function ($query) use ($date) { $query->where('date',$date); })->get();
        $users = User::orderBy('name','asc')->get();
        return view('home',
        array(
            'users' => $users,
            'time_in' => $time_in,
            'date' => $date
        )
        );
    }
}
