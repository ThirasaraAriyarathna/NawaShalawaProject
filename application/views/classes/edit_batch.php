<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="subjectModalLabel">Add a Batch</h4>
    </div>
    <form id="edit_batch_form"  onsubmit="return false;" >
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                 <div class="form-group">
                <label  class="input-label" for="batch-name">Batch Name<span class="required">*</span></label>
                    <input type="text" value="<?php echo $details['Name']; ?>" id="batchName" name="batchName" class=" form-control input-flat"/>
            </div>
            <div class="form-group">
                <label  class="input-label">Description</label>
                    <textarea rows="3" name="description" id="description" class=" form-control input-flat"><?php echo $details['Description']; ?></textarea>
            </div>
            <div class="form-group">
                <label  class="input-label ">Year<span class="required">*</span></label>
                <input   type="text" name="year" value="<?php echo $details['Year']; ?>" id="year" class=" form-control input-flat select-year">
            </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn  btn-default btn-flat" data-dismiss="modal" >Close</button>
        <button id="btn_batch_edit" class="btn btn-primary btn-flat" batchid="<?php echo $details['BatchId']; ?>">Save</button>
    </div>
    </form>
    </div>
    </div>