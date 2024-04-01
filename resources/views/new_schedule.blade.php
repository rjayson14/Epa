<div class="modal fade" id="new_schedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Schedule</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method='post' action='new-schedule' onsubmit='show();'  enctype="multipart/form-data">
        <div class="modal-body">
           
                {{ csrf_field() }}
            <label >Subject</label>
            <select name='subject' class='form-control' required >
                <option value=''>Subject</option>
                @foreach($subjects as $subject)
                <option value='{{$subject->id}}'>{{$subject->code}} - {{$subject->name}}</option>
                @endforeach
            </select>
       
            <label >Classroom</label>
            <select name='classroom' class='form-control' required >
                <option value=''>Classroom</option>
                @foreach($rooms as $room)
                <option value='{{$room->id}}'>{{$room->name}}</option>
                @endforeach
            </select>
            <label >Date</label>
           <input type='date' name='date' class='form-control' required>
           <label >Time </label>
            <div class='row'>
                <div class='col-6'>
                    <input type='time' min='07:00:00' max='18:00:00' name='time_from' class='form-control' step="300" required>
                </div>
                <div class='col-6'>
                    <input type='time' min='07:00:00' max='18:00:00' name='time_to' class='form-control' step="300" required>
                </div>
            </div>


       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
      </div>
    </div>
  </div>