@extends('layouts.header')

@section('content')
<div class="content-wrapper container">
    @include('error')
    <div class="row">
      
        <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Students <button data-toggle="modal" data-target="#new_student" type="button" class="btn btn-outline-success btn-sm btn-icon-text"   >
                        <i class="ti-plus btn-icon-prepend"></i>                                                    
                        New Student
                      </button></h4>
                    <div class="table-responsive">
                        <table class="table table-hover" id="employees-table"  style="width:100%;">
                        <thead>
                            <tr>
                                <th class="pt-1 ps-0">
                                    
                                </th>
                                <th class="pt-1 ps-0">
                                    Bio Code
                                </th>
                                <th class="pt-1 ps-0">
                                    Name
                                </th>
                                <th class="pt-1 ps-0">
                                    Course
                                </th>
                                <th class="pt-1 ps-0">
                                    Email
                                </th>
                                <th class="pt-1 ps-0">
                                    Contact #
                                </th>
                                <th class="pt-1 ps-0">
                                    Generate QR
                                </th>
                                <th class="pt-1">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td class="pt-1 ps-0">
                                        <img  src="{{URL::asset($student->avatar)}}"  onerror="this.src='{{URL::asset('/images/no-image.JPEG')}}';"  alt="profile">
                                    </td>
                                    <td class="pt-1 ps-0">
                                        {{$student->id}}
                                    </td>
                                    <td class="pt-1 ps-0">
                                        {{$student->name}}
                                    </td>
                                    <td class="pt-1 ps-0">
                                        {{$student->student->course}}
                                    </td>
                                    <td class="pt-1 ps-0">
                                        {{$student->email}}
                                    </td>
                                    <td class="pt-1 ps-0">
                                        {{$student->student->cellphone}}
                                    </td>
                                    <td class="pt-1 ps-0 text-center" >
                                        <a href='{{url('qr-code/?id='.$student->password)}}' target='_blank'><i class="fa fa-qrcode"></i></a>
                                    </td>
                                    <td class="pt-1">
                                        <button type="button" data-toggle="modal" data-target="#edit_student{{$student->id}}"  class="btn btn-sm btn-outline-warning btn-icon-text">
                                            <i class="ti-pencil btn-icon-prepend"></i>                                                    
                                            Edit
                                          </button>
                                        <button type="button" data-toggle="modal" data-target="#upload_avatar{{$student->id}}"  class="btn btn-sm btn-outline-danger btn-icon-text">
                                            <i class="ti-image btn-icon-prepend"></i>                                                    
                                            Avatar
                                        </button>
                                        <a href='{{url('remove-user/'.$student->id)}}'
                                            <button type="button"  class="btn btn-sm btn-outline-danger btn-icon-text">
                                                <i class="ti-trash btn-icon-prepend"></i>                                                    
                                                <!-- Delete -->
                                            </button>
                                        </a>
                                    </td>
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
@include('students.new_student')
<script>
function uploadimageEdit(input,id)
{
    if (input.files && input.files[0]) {
        var id = id;
        console.log(id);
        var reader = new FileReader();
        var that = this;
        reader.onload = function(e) use (id){
            console.log(id);
            $('#avatar'+id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>


@foreach($students as $student)
@include('students.edit_student')
@include('upload_avatar')
@endforeach
@endsection
