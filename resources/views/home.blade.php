@extends('layouts.header')

@section('content')
@if(auth()->user()->role == "Administrator")
<div class="content-wrapper">
    <div class="row">
         <div class="col-md-3 mb-4 stretch-card transparent">
            <div class="card card-tale">
              <div class="card-body">
                <p class="mb-4">Total Students</p>
                <p class="fs-30 mb-2">{{count($users->where('role','Student'))}}</p>
                <p class='text-danger'>{{count($users->where('role','Student')->where('status','!=',null))}} Deactivated</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
              <div class="card-body">
                <p class="mb-4">Total Teachers</p>
                <p class="fs-30 mb-2">{{count($users->where('role','Teacher'))}}</p>
                <p class='text-danger'>{{count($users->where('role','Teacher')->where('status','!=',null))}} Deactivated</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4 stretch-card transparent">
            <div class="card card-light-blue">
              <div class="card-body">
                <p class="mb-4">Time In (Students) - Today ({{date('F d, Y')}})</p>
                <p class="fs-30 mb-2">{{count($time_in->where('role','Student'))}}</p>
                <p>{{count($users->where('role','Student'))-count($time_in->where('role','Student'))}} : No Time-In</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4 stretch-card transparent">
            <div class="card card-light-danger">
              <div class="card-body">
                <p class="mb-4">Time In (Teachers) - Today</p>
                <p class="fs-30 mb-2">{{count($time_in->where('role','Teacher'))}}</p>
                <p>{{count($users->where('role','Teacher'))-count($time_in->where('role','Teacher'))}} : No Time-In</p>
              </div>
            </div>
          </div>
    </div>
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title mb-0">Students</p>
            <div class="table-responsive">
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
                  $timein = ($student->attendances_time_in)->where('type','Time In')->where('date',date('Y-m-d'))->first();
                  if($timein == null)
                  {
                    $time_in = "No Time In";
                  }
                  else {
                    
                    $time_in = date('h:i A',strtotime($timein->time));
                  }
                  $timeout = ($student->attendances_time_out)->where('type','Time Out')->where('date',date('Y-m-d'))->first();
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
                  <td>{{$student->course}}</td>

                </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title mb-0">Teachers</p>
            <div class="table-responsive">
              <table border="1" class="table table-hover tableExport"   style="width:100px;">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Position</th>
                  </tr>  
                </thead>
                <tbody>
                  @foreach($users->where('role','Teacher') as $teacher)
                  @php
                      $timein = ($teacher->attendances_time_in)->where('type','Time In')->where('date',date('Y-m-d'))->first();
                      if($timein == null)
                      {
                        $time_in = "No Time In";
                      }
                      else {
                        
                        $time_in = date('h:i A',strtotime($timein->time));
                      }
                      $timeout = ($teacher->attendances_time_out)->where('type','Time Out')->where('date',date('Y-m-d'))->first();
                      if($timeout == null)
                      {
                        $time_out = "No Time Out";
                      }
                      else {
                        
                        $time_out =  date('h:i A',strtotime($timeout->time));
                      }
                  @endphp
                  <tr>
                    <td>{{$teacher->name}}</td>
                    <td>{{$time_in}}</td>
                    <td>{{$time_out}}</td>
                    <td>{{$teacher->position}}</td>
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
@endif
@if(auth()->user()->role == "Teacher")
<div class="content-wrapper container">
  <div class='row'> 
    <div class='col-md-6 border-right'>
        <div class='row'>
            <div class='col-md-12'> 
                <h2>Information</h2>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6 text-center'> 
                <img id='avatar' src="{{URL::asset(auth()->user()->avatar)}}"  onerror="this.src='{{URL::asset('/images/no-image.JPEG')}}';"  alt="profile" height='180px;'> <br>
              
            </div>
            <div class='col-md-6'> 
                <label >Faculty ID</label>
                <input name='student_id' value='{{auth()->user()->teacher->facultystaff_id}}' class='form-control mb-2 mr-sm-2' type='text' readonly>
                <label >Position</label>
                <input name='course' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->teacher->position}}' type='text' readonly>
                <label >Email</label>
                <input name='email' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->email}}' type='text' readonly>
                <label >Contact #</label>
                <input name='contact_number' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->teacher->cellphone}}' type='text' readonly>
            </div>
           
        </div>
        <div class='row'>
            <div class='col-md-5'> 
                <label >Surname</label>
                <input name='lastname' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->teacher->lastname}}' type='text' readonly>
            </div>
            <div class='col-md-5'> 
                <label >Given Name</label>
                <input name='firstname' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->teacher->firstname}}' type='text' readonly>
            </div>
            <div class='col-md-2'> 
                <label >M. I.</label>
                <input name='middlename' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->teacher->middlename}}' type='text' readonly>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6'> 
                <label >Gender</label>
                <input name='gender' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->teacher->gender}}' type='text' readonly>
            </div>
            <div class='col-md-6'> 
                <label >Birth Date</label>
                <input name='birthdate' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->teacher->birthdate}}' type='date' readonly>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-12'> 
                <label >Address</label>
                <textarea onkeyup="setHeight('address');" style="height: 100px;" onkeydown="setHeight('address');" id='address' name='address' class="form-control" placeholder="Address" readonly>{{auth()->user()->teacher->address}}</textarea>
            </div>
        </div>
    </div>
    <div class='col-md-6 '>
        <div class='row'>
            <div class='col-md-12'> 
                <h2>Guardian</h2>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-12'> 
                <label >Name</label>
                <input name='guardian_name' value="{{auth()->user()->guardian->name}}"  class='form-control mb-2 mr-sm-2' type='text' readonly>
            </div>
            <div class='col-md-12'> 
                <label >Contact No.</label>
                <input name='guardian_contact_number' value="{{auth()->user()->guardian->contact_number}}" class='form-control mb-2 mr-sm-2' type='text' readonly>
            </div>
            <div class='col-md-12'> 
                <label >Email</label>
                <input name='guardian_email' value="{{auth()->user()->guardian->email}}" class='form-control mb-2 mr-sm-2' type='email' readonly>
            </div>
            <div class='col-md-12'> 
                <label >Relationship</label>
                <input name='relationship' value="{{auth()->user()->guardian->relationship}}" class='form-control mb-2 mr-sm-2' type='text' readonly>
            </div>
            <div class='col-md-12 pt-5 text-right'>
              <a  href='{{url('qr-code/?id='.auth()->user()->password)}}' target="_blank">
                <button type="button" class="btn btn-outline-info btn-icon-text">
                  Generate QR Code
                  <i class="ti-qr btn-icon-append"></i>                                                                              
                </button>
              </a>
            </div>
        </div>
       
    </div>
  
  </div>
  </div>
@endif
@if((auth()->user()->role == "Student"))
<div class="content-wrapper container">
<div class='row'> 
  <div class='col-md-6 border-right'>
      <div class='row'>
          <div class='col-md-12'> 
              <h2>Information</h2>
          </div>
      </div>
      <div class='row'>
          <div class='col-md-6 text-center'> 
              <img id='avatar' src="{{URL::asset(auth()->user()->avatar)}}"  onerror="this.src='{{URL::asset('/images/no-image.JPEG')}}';"  alt="profile" height='180px;'> <br>
            
          </div>
          <div class='col-md-6'> 
              <label >Student ID</label>
              <input name='student_id' value='{{auth()->user()->student->student_id}}' class='form-control mb-2 mr-sm-2' type='text' readonly>
              <label >Course</label>
              <input name='course' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->student->course}}' type='text' readonly>
              <label >Email</label>
              <input name='email' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->email}}' type='text' readonly>
              <label >Contact #</label>
              <input name='contact_number' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->student->cellphone}}' type='text' readonly>
          </div>
         
      </div>
      <div class='row'>
          <div class='col-md-5'> 
              <label >Surname</label>
              <input name='lastname' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->student->lastname}}' type='text' readonly>
          </div>
          <div class='col-md-5'> 
              <label >Given Name</label>
              <input name='firstname' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->student->firstname}}' type='text' readonly>
          </div>
          <div class='col-md-2'> 
              <label >M. I.</label>
              <input name='middlename' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->student->middlename}}' type='text' readonly>
          </div>
      </div>
      <div class='row'>
          <div class='col-md-6'> 
              <label >Gender</label>
              <input name='gender' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->student->gender}}' type='text' readonly>
          </div>
          <div class='col-md-6'> 
              <label >Birth Date</label>
              <input name='birthdate' class='form-control mb-2 mr-sm-2' value='{{auth()->user()->student->birthdate}}' type='date' readonly>
          </div>
      </div>
      <div class='row'>
          <div class='col-md-12'> 
              <label >Address</label>
              <textarea onkeyup="setHeight('address');" style="height: 100px;" onkeydown="setHeight('address');" id='address' name='address' class="form-control" placeholder="Address" readonly>{{auth()->user()->student->address}}</textarea>
          </div>
      </div>
  </div>
  <div class='col-md-6 '>
      <div class='row'>
          <div class='col-md-12'> 
              <h2>Guardian</h2>
          </div>
      </div>
      <div class='row'>
          <div class='col-md-12'> 
              <label >Name</label>
              <input name='guardian_name' value="{{auth()->user()->guardian->name}}"  class='form-control mb-2 mr-sm-2' type='text' readonly>
          </div>
          <div class='col-md-12'> 
              <label >Contact No.</label>
              <input name='guardian_contact_number' value="{{auth()->user()->guardian->contact_number}}" class='form-control mb-2 mr-sm-2' type='text' readonly>
          </div>
          <div class='col-md-12'> 
              <label >Email</label>
              <input name='guardian_email' value="{{auth()->user()->guardian->email}}" class='form-control mb-2 mr-sm-2' type='email' readonly>
          </div>
          <div class='col-md-12'> 
              <label >Relationship</label>
              <input name='relationship' value="{{auth()->user()->guardian->relationship}}" class='form-control mb-2 mr-sm-2' type='text' readonly>
          </div>
          <div class='col-md-12 pt-5 text-right'>
            <a  href='{{url('qr-code/?id='.auth()->user()->password)}}' target="_blank">
              <button type="button" class="btn btn-outline-info btn-icon-text">
                Generate QR Code
                <i class="ti-qr btn-icon-append"></i>                                                                              
              </button>
            </a>
          </div>
      </div>
     
  </div>

</div>
</div>
@endif
@endsection
