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
                    <h4 class="card-title">Gates <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-outline-success btn-sm btn-icon-text"   >
                        <i class="ti-plus btn-icon-prepend"></i>                                                    
                        New
                      </button></h4>
                    <div class="table-responsive">
                        <table class="table table-hover tableExport"   style="width:100%;">
                        <thead>
                            <tr>
                                <th class="pt-1 ps-0">
                                    Gate Name
                                </th>
                                <th class="pt-1 ps-0">
                                    Scanner
                                </th>
                                <th class="pt-1">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gates as $gate)
                            <tr>
                                <td class="pt-1 ps-0">
                                    {{$gate->name}}
                                </td>
                                <td class="pt-1 ps-0">
                                    <a href='{{url('scanner/gate/'.$gate->id)}}' target='_blank'><i class="fa fa-qrcode"></i></a>
                                </td>
                                <td class="pt-1">
                                    <button type="button" data-toggle="modal" data-target="#edit_gate{{$gate->id}}"  class="btn btn-sm btn-outline-warning btn-icon-text">
                                        <i class="ti-pencil btn-icon-prepend"></i>                                                    
                                        Edit
                                      </button>
                                </td>
                            </tr>
                            @include('edit_gate')
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
                    <h4 class="card-title">Rooms <button data-toggle="modal" data-target="#new_room" type="button" class="btn btn-outline-success btn-sm btn-icon-text"   >
                        <i class="ti-plus btn-icon-prepend"></i>                                                    
                        New
                      </button>


                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover tableExport"  style="width:100%;">
                        <thead>
                            <tr>
                                <th class="pt-1 ps-0">
                                    Name
                                </th>
                                <!-- <th class="pt-1 ps-0">
                                    Scanner
                                </th> -->
                                <th class="pt-1">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                            <tr>
                                <td class="pt-1 ps-0">
                                    {{$room->name}}
                                </td>
                                <!-- <td class="pt-1 ps-0">
                                    <a href='{{url('scanner/room/'.$room->id)}}' target='_blank'><i class="fa fa-qrcode"></i></a>
                                </td> -->
                                <td class="pt-1">
                                    <button type="button" data-toggle="modal" data-target="#edit_room{{$room->id}}"  class="btn btn-sm btn-outline-warning btn-icon-text">
                                        <i class="ti-pencil btn-icon-prepend"></i>                                                    
                                        Edit
                                      </button>
                                </td>
                            </tr>
                            @include('edit_room')
                            @endforeach
                            
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('new_gate')
@include('new_room')
@endsection
