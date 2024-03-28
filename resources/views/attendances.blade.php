@extends('layouts.header')

@section('content')
<div class="content-wrapper">
    <div class='row'>
         
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Attendances</h4>
              <p class="card-description">
                
              <form method='get' onsubmit='show();'  enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class=row>
                  <!-- <div class='col-md-4'>
                      <div class="form-group">
                        <select data-placeholder="Filter" class="form-control form-control-sm required js-example-basic-single" style='width:100%;' name='user_name'>
                            <option value="">-- Filter --</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($user_name == $user->id)selected @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                      </div> 
                  </div> -->
                  
                  <div class='col-md-2'>
                    <div class="form-group">
                      <input class='form-control form-control-sm' type='date' value='{{$date}}' name='date' required>
                    </div>
                  </div>
                  <div class='col-md-3'>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
              
                
                </div>
                </div>
                
                </form>
              </p>
              <hr>
              
            <div class='row'>
            <div class="col-md-12 col-xl-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="true">Gate</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Classroom</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                      <div class="media">
                      <div class="col-lg-12">
                    <div class="table-responsive">
                        <h3><strong>Gate</strong></h3>
                        <table border="1" class="table table-hover tableExport"   style="width:100%;">
      
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Course</th>
                                    
      
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users->where('role','Student') as $student)
                            @php
                            $timein = ($student->attendances_time_in)->where('type','Time In')->where('date',$date)->first();
                            if($timein == null)
                             {
                               $time_in = "No Time In";
                             }
                             else {
                    
                               $time_in = date('h:i A',strtotime($timein->time));
                              }
                              $timeout = ($student->attendances_time_out)->where('type','Time Out')->where('date',$date)->first();
                              if($timeout == null)
                               {
                                 $time_out = "No Time Out";
                               }
                              else {
                    
                                $time_out =  date('h:i A',strtotime($timeout->time));
                               }
                               @endphp
                                <tr>
                                
                                <td>{{$student->name}}</td>
                                <td>{{$time_in}}</td>
                                <td>{{$time_out}}</td>
                                <td>{{$student->student->course}}</td>
                                

                              </tr>
                                @endforeach
                            </tbody>
      
                        </table>
                      </div>
                    </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="media">
                        
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <h3><strong>Classroom</strong></h3>
                        <table border="1" class="table table-hover table-bordered tableExport"   style="width:100%;">
      
                            <thead>
                                
                            </thead>
                            <tbody>
                            <tr>
                                    <td>Student</td>
                                    <td>Time In</td>
                                    <td>Time Out</td>
                                    <td>Course</td>
                                    
      
                                </tr>
                            @foreach($users->where('role','Student') as $student)
                            @php
                            $timein = ($student->attendances_time_in_room)->where('type','Time In')->where('date',$date)->first();
                            if($timein == null)
                             {
                               $time_in = "No Time In";
                             }
                             else {
                    
                               $time_in = date('h:i A',strtotime($timein->time));
                              }
                              $timeout = ($student->attendances_time_out_room)->where('type','Time Out')->where('date',$date)->first();
                              if($timeout == null)
                               {
                                 $time_out = "No Time Out";
                               }
                              else {
                    
                                $time_out =  date('h:i A',strtotime($timeout->time));
                               }
                               @endphp
                  <tr>
                  
                  <td>{{$student->name}}</td>
                  <td>{{$time_in}}</td>
                  <td>{{$time_out}}</td>
                  <td>{{$student->student->course}}</td>
                  

                </tr>
                  @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                
      
      
            </div>              
          </div>
        </div>
      
      </div>
</div>
@endsection
