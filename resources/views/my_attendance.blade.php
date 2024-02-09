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
                <div class=row>
                  
                  <div class='col-md-2'>
                    <div class="form-group">
                      <input type="date" value='{{$date}}' class="form-control" name="date" max='{{date('Y-m-d')}}' required/>
                    </div>
                  </div>
                  <div class='col-md-3'>
                    <button type="submit" class="btn btn-primary mb-2">Search</button>
              
                
                </div>
                </div>
                
                </form>
              </p>
              <hr>
            <div class='row'>
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <h3><strong>Gate</strong></h3>
                        <table border="1" class="table table-hover tableExport"   style="width:100%;">
      
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Gate</th>
                                    <th>Time</th>
                                    <th>Type</th>
      
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances->where('gate_id','!=',null) as $attendance)
                                <tr>
                                    <td>{{$attendance->user->name}}</td>
                                    <td>{{$attendance->gate->name}}</td>
                                    <td>{{date('h:i a',strtotime($attendance->time))}}</td>
                                    <td>{{$attendance->type}}</td>
                                </tr>
                                @endforeach
                            </tbody>
      
                        </table>
                      </div>
                    </div>
      
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <h3><strong>Classroom</strong></h3>
                        <table border="1" class="table table-hover table-bordered tableExport"   style="width:100%;">
      
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Classroom</th>
                                    <th>Date</th>
                                    <th>Time</th>
      
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances->where('gate_id',null) as $attendance)
                                <tr>
                                    <td>{{$attendance->user->name}}</td>
                                    <td>{{$attendance->classroom->name}}</td>
                                    <td>{{date('h:i a',strtotime($attendance->time))}}</td>
                                    <td>{{$attendance->type}}</td>
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
@endsection
