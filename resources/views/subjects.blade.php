@extends('layouts.header')

@section('content')
<div class="content-wrapper container">
    @if(session()->has('status'))
        <div class="alert alert-success alert-dismissable">
        {{-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> --}}
        {{session()->get('status')}}
        </div>
    @endif
    <div class="row">
      
        <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Subjects <button data-toggle="modal" data-target="#new_subject" type="button" class="btn btn-outline-success btn-sm btn-icon-text"   >
                        <i class="ti-plus btn-icon-prepend"></i>                                                    
                        New
                      </button></h4>
                    <div class="table-responsive">
                        <table class="table table-hover tableExport"   style="width:100%;">
                        <thead>
                            <tr>
                                <th class="pt-1 ps-0">
                                    Code
                                </th>
                                <th class="pt-1 ps-0">
                                    Name
                                </th>
                                <th class="pt-1">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                            <tr>
                                <td class="pt-1 ps-0">
                                    {{$subject->code}}
                                </td>
                                <td class="pt-1 ps-0">
                                    {{$subject->name}}
                                </td>
                                <td class="pt-1">
                                    <button type="button" data-toggle="modal" data-target="#edit_subject{{$subject->id}}"  class="btn btn-sm btn-outline-warning btn-icon-text">
                                        <i class="ti-pencil btn-icon-prepend"></i>                                                    
                                        Edit
                                      </button>
                                </td>
                            </tr>
                            @include('edit_subject')
                            @endforeach
                         
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Schedules <button data-toggle="modal" data-target="#new_room" type="button" class="btn btn-outline-success btn-sm btn-icon-text"   >
                        <i class="ti-plus btn-icon-prepend"></i>                                                    
                        New
                      </button>


                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover tableExport"  style="width:100%;">
                        <thead>
                            <tr>
                                <th class="pt-1 ps-0">
                                    Date - Time
                                </th>
                                <th class="pt-1 ps-0">
                                    Room
                                </th>
                                <th class="pt-1 ps-0">
                                    Subject
                                </th>
                                <th class="pt-1">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('new_subject')
@endsection
