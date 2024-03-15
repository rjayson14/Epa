<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        table {
            border-spacing: 0;
            border-collapse: collapse;
        }
        body{
            font-family: Calibri;
            font-size : 12px;
        }
        .font-design
        {
            font-family: Arial, Helvetica, sans-serif;

        }
        @page { }
        #header { position: fixed; left: -500px; right: 0px; text-align: center; }
        .content td{
        padding-bottom: 5px;
        }

        #footer { position: fixed;  bottom: 70px; }
    </style>
</head>
<body class='font-design'>
    <div id="header">
        <h1><img src='{{asset('images/logo.png')}}' width='100px' ></h1>
    </div>


    <table width="100%" border="0" cellspacing="0" cellpadding="0" style='padding-bottom:5px;'>
        <tr >
            <td>
                    <p align='center' class='font-design'><span style='font-size:14px;padding-bottom:3px;' ><strong> &nbsp;</strong></span></p>
                    <p align='center' class='font-design'><span style='font-size:22px;padding-bottom:5px;' ><strong> Attendance Report - {{date('M. d, Y',strtotime($date))}}</strong></span></p>
                    <p align='center' class='font-design'><span style='font-size:14px;padding-bottom:5px;' ><strong> &nbsp;</strong></span></p>

                </p>
            </td>
        </tr>
    </table>
    <hr>
    <table width="100%" border="1" cellspacing="0" cellpadding="0" style='padding-bottom:5px;'>
                <thead>
                  <tr>
                    <th>Student</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    @if($type == "Student")
                    <th>Course</th>
                    @else
                    <th>Position</th>
                    @endif
                  </tr>  
                </thead>
                @foreach($users->where('role',$type) as $user)
                  @php
                  $timein = ($user->attendances_time_in)->where('type','Time In')->where('date',$date)->first();
                  if($timein == null)
                  {
                    $time_in = "No Time In";
                  }
                  else {
                    
                    $time_in = date('h:i A',strtotime($timein->time));
                  }
                  $timeout = ($user->attendances_time_out)->where('type','Time Out')->where('date',$date)->first();
                  if($timeout == null)
                  {
                    $time_out = "No Time Out";
                  }
                  else {
                    
                    $time_out =  date('h:i A',strtotime($timeout->time));
                  }
              @endphp
                  <tr>
                  <td>{{$user->name}}</td>
                  <td  @if($time_in == "No Time In") style='background-color:red;color:white;' @endif>{{$time_in}}</td>
                  <td @if($time_out == "No Time Out") style='background-color:red;color:white;' @endif>{{$time_out}}</td>
                  @if($type == "Student")
                    <td>{{$user->student->course}}</td>
                    @else
                    <td>{{$user->teacher->position}}</td>
                    @endif
                  <td></td>

                </tr>
                  @endforeach
                </tbody>
    </table>
              

   
</body>
</html>
