<div class="modal fade" id="edit_gate{{$gate->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Gate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method='post' action='edit-gate/{{$gate->id}}' onsubmit='show();'  enctype="multipart/form-data">
        <div class="modal-body">
           
                {{ csrf_field() }}
            <label >Title</label>
            <input name='name' class='form-control mb-2 mr-sm-2' value='{{$gate->name}}' type='text' id='new_gate' required>
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>