<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit your post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       
      <div class="modal-body">
       <!-- load edit content here -->
       <form id="posteditform">
        {{ csrf_field() }}
         <div class="form-group">
                <input type="hidden" class="form-control" id="id" name="id" value="">
              </div>
         <div class="form-group">
                <input class="form-control" id="subject_edit" name="subject_edit" placeholder="Enter Your Subject" value="">
              </div>
              <div class="form-group">
                <textarea class="form-control" id="description_edit" rows="3" placeholder="Type your post" name="description_edit"></textarea>
              </div>
       <div class="form-group">
            <label>Tags:</label>
            <br/>
            
            <input class="form-control" id="tags_edit" class="tags" data-role="tagsinput" type="text" name="tags[]" required>
            
        </div> 
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitEditForm()">Save changes</button>
      </div>
    </div>
  </div>
</div>