<div class="modal fade" id="new_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Room</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method='post' action='new-room' onsubmit='show();'  enctype="multipart/form-data">
        <div class="modal-body">
           
                {{ csrf_field() }}
            <label >Title</label>
            <input name='name' class='form-control mb-2 mr-sm-2' type='text' id='new_room' required>
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
      </div>
    </div>
  </div>