<div class="modal fade" id="change_password{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method='post' action='change-password/{{$teacher->id}}' onsubmit='show();'  enctype="multipart/form-data">
            
            {{ csrf_field() }}
            <div class="modal-body">
                        <div class='row'>
                            <div class='col-md-12'> 
                                <label >New Password</label>
                                <input name='password'  class='form-control mb-2 mr-sm-2' type='password' required>
                            </div>
                            <div class='col-md-12'> 
                                <label >Confirm Password</label>
                                <input name='password_confirmation'  class='form-control mb-2 mr-sm-2' type='password' required>
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