  <div class="modal-dialog">
    <div class="modal-content" >
        <form id="editsubject-form"  onsubmit="return false;" role="form"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="subjectModalLabel">Edit Subject</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label  class="input-lable" for="batch-name">Subject Name<span class="required">*</span></label>
                            <input  class="form-control input-flat" type="text" value="<?php echo $details['Name']; ?>" id="subjectName" name="subjectName"/>
                        </div>
                        <div class="form-group">
                            <label  class="input-lable" >Description</label>
                            <textarea class="form-control input-flat" rows="3" id="description"  name="description"><?php echo $details['Description']; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button subid="<?php echo $details['SubjectId']; ?>" class="btn btn-primary btn-flat"  id="btn_subject_edit">Save</button>
            </div>
        </form>
    </div>
  </div>