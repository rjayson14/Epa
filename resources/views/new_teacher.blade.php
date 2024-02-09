<div class="modal fade" id="new_teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Staff</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method='post' action='new-teacher' onsubmit='show();'  enctype="multipart/form-data">
            
            {{ csrf_field() }}
            <div class="modal-body">
                <div class='row'> 
                    <div class='col-md-6 border-right'>
                        <div class='row'>
                            <div class='col-md-12'> 
                                <h2>Staff Information</h2>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-6 text-center'> 
                                <img id='avatar' src="{{URL::asset('/images/no-image.JPEG')}}"  alt="profile" height='155px;'> <br>
                                <label title="Upload image file" for="inputImage" class="btn btn-primary btn-sm ">
                                    <input type="file" accept="image/*" name="file" id="inputImage" style="display:none" onchange='uploadimage(this)'>
                                    Upload Avatar
                                </label><br>
                            </div>
                            <div class='col-md-6'> 
                                <label >Staff ID</label>
                                <input name='staff_id' class='form-control mb-2 mr-sm-2' type='text' required>
                                <label >Position</label>
                                <input name='position' class='form-control mb-2 mr-sm-2' type='text' required>
                                <label >Email</label>
                                <input name='email' class='form-control mb-2 mr-sm-2' type='text' required>
                                <label >Contact #</label>
                                <input name='contact_number' class='form-control mb-2 mr-sm-2' type='text' required>
                            </div>
                           
                        </div>
                        <div class='row'>
                            <div class='col-md-5'> 
                                <label >Surname</label>
                                <input name='lastname' class='form-control mb-2 mr-sm-2' type='text' required>
                            </div>
                            <div class='col-md-5'> 
                                <label >Given Name</label>
                                <input name='firstname' class='form-control mb-2 mr-sm-2' type='text' required>
                            </div>
                            <div class='col-md-2'> 
                                <label >M. I.</label>
                                <input name='middlename' class='form-control mb-2 mr-sm-2' type='text' required>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-6'> 
                                <label >Gender</label>
                                <input name='gender' class='form-control mb-2 mr-sm-2' type='text' required>
                            </div>
                            <div class='col-md-6'> 
                                <label >Birth Date</label>
                                <input name='birthdate' class='form-control mb-2 mr-sm-2' type='date' required>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-12'> 
                                <label >Address</label>
                                <textarea onkeyup="setHeight('address');" style="height: 100px;" onkeydown="setHeight('address');" id='address' name='address' class="form-control" placeholder="Address" required></textarea>
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
                                <input name='guardian_name' class='form-control mb-2 mr-sm-2' type='text' required>
                            </div>
                            <div class='col-md-12'> 
                                <label >Contact No.</label>
                                <input name='guardian_contact_number' placeholder="09xxxxxxxxx" class='form-control mb-2 mr-sm-2' type='text' required>
                            </div>
                            <div class='col-md-12'> 
                                <label >Email</label>
                                <input name='guardian_email' class='form-control mb-2 mr-sm-2' type='email' required>
                            </div>
                            <div class='col-md-12'> 
                                <label >Relationship</label>
                                <input name='relationship' class='form-control mb-2 mr-sm-2' type='text' required>
                            </div>
                        </div>
                       
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
<script>
      function uploadimage(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#avatar').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    
</script>