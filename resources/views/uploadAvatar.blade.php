<div class="modal fade" id="upload_avatar{{$teacher->id}}" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Avatar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method='post' action='upload-avatar/{{$teacher->id}}' onsubmit='show();'  enctype="multipart/form-data">
            
            {{ csrf_field() }}
            <div class="modal-body">
                <div class='row'> 
                    <div class='col-md-12'>
                                <input type="file" accept="image/*" name="file" id="inputImage" required>
                                
                
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>