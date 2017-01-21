<?php 
 include(APPPATH . 'views/common/header.php');
 ?>
<div class="container">
   
        <div class="row main-page">

            <div class="vd-page-container">

                <div class="vd-page-content">
                    <?php 
                                            if($this->session->flashdata('message-success')){ ?>
                                                <div class="alert alert-success vd-alert"><?php echo $this->session->flashdata('message-success'); ?></div>
                                          <?php  }
                                            else if($this->session->flashdata('message-error')){ ?>
                                                <div class="alert alert-danger vd-alert"><?php echo $this->session->flashdata('message-error'); ?></div>
                                        <?php    }
                                            else if($this->session->flashdata('message-info')){ ?>
                                                <div class="alert alert-info vd-alert"><?php echo $this->session->flashdata('message-info'); ?></div>
                                         <?php   }
                                        ?>
                    <div class="row">
                        <div  class="col-md-12  ">
                                <div class="inline-container">
                                <div  class="col-md-8  ">
                                            <form role="form" id="class-add-form" method="post" action="<?php echo base_url().'classes/add' ?>" >
                                              

                                                <div class="form-group"  >
                                                    <label class="input-lable">Class Name</label>
                                                    <input type="text" class="form-control input-flat"  id="class_name" autocomplete="off"  name="class_name"  >
                                                </div>
                                                <div class="form-group">
                                                    <label class="input-lable">Description</label>
                                                    <textarea rows="3"  class="form-control input-flat"  name="description"  ></textarea>
                                                </div>
                                                <div class="form-group">
                                                         <label class="input-lable">Class Fees</label>
                                                         <input type="text" class="form-control input-flat"  id="class_fees" autocomplete="off"  name="class_fees"  >
                                                </div>
                                                <div class="form-group"  >
                                                    <label class="input-lable">Teacher</label>

                                                    <select id="teachers" class="form-control input-flat" name="teachers"  >
                                                       <option value="0">Select Teacher</option>
                                                        <?php
                                                        if (isset($teachers) && count($teachers) > 0) {
                                                            foreach ($teachers as $teacher) {
                                                                ?>
                                                                <option value="<?php echo $teacher['TeacherId']; ?>"><?php echo $teacher['FirstName'] . ' ' . $teacher['LastName']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <option value="add">Add Teachers</option>
                                                    </select>


                                                </div>
                                                <div class="form-group">
                                                    <label class="input-lable">Batch</label>
                                                    <div class="input-group">
                                                        <select name="batches" class=" form-control input-flat" id="batches"  >
                                                            <option value="0">Select Batch</option>
                                                            <?php
                                                            if (isset($batches) && count($batches) > 0) {
                                                                foreach ($batches as $batch) {
                                                                    ?>
                                                                    <option value="<?php echo $batch['BatchId']; ?>" ><?php echo $batch['Name'] . '-' . $batch['Year']; ?></option>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="input-group-btn">
                                                            <a href="#" data-toggle="modal" data-target="#batchModal" class="btn btn-default btn-flat" >
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                            </a>
                                                            <button type="button" id="btn_edit_batch" class="btn btn-default btn-flat">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </button>
                                                            <button type="button" class="btn btn-default btn-flat" id="batchDeleteBtn" >
                                                                <span class="glyphicon glyphicon-remove"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="input-lable">Subject</label>
                                                    <div class="input-group"  >

                                                        <select name="subjects" class=" form-control input-flat" id="subjects"  >
                                                            <option value="0">Select Subject</option>
                                                            <?php
                                                            if (isset($subjects) && count($subjects) > 0) {
                                                                foreach ($subjects as $subject) {
                                                                    ?>
                                                                    <option value="<?php echo $subject['SubjectId']; ?>" ><?php echo $subject['Name']; ?></option>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="input-group-btn">
                                                            <a href="#" data-toggle="modal" data-target="#subjectModal" class="btn btn-default  btn-flat" >
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                            </a>
                                                            <button type="button" id="btn_edit_subject" class="btn btn-default  btn-flat">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </button>
                                                            <button type="button" class="btn btn-default  btn-flat" id="subjectDeleteBtn" >
                                                                <span class="glyphicon glyphicon-remove"></span>    
                                                            </button>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class=" clearfix"></div>
                                                    <input type="submit" class="btn btn-primary btn-flat" id="addBtn" value="Save"/>
                                                    <input type="reset" class="btn btn-default btn-flat" value="Clear"/>
                                                
                                            </form>
                            </div>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<!--Batch Modal-->
<div class="modal fade" id="editBatchModal" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel" aria-hidden="true" data-backdrop="static">
</div>
<div class="modal fade" id="batchModal" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="subjectModalLabel">Add a Batch</h4>
    </div>
    <form id="batch-detail"  onsubmit="return false;" >
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                 <div class="form-group">
                <label  class="input-label" for="batch-name">Batch Name<span class="required">*</span></label>
                    <!--<input type="text" value="" id="batchName" name="batchName" class=" form-control input-flat"/>-->
                <select id="batchName" name="batchName" class=" form-control input-flat">
                    <option value="AL" >AL</option> 
                    <option value="OL" >OL</option> 
                    <option value="GRADE9" >GRADE9</option> 
                </select>
                        
            </div>
            <div class="form-group">
                <label  class="input-label">Description</label>
                    <textarea rows="3" name="description" id="description" class=" form-control input-flat"></textarea>
            </div>
            <div class="form-group">
                <label  class="input-label ">Year<span class="required">*</span></label>
                    <input   type="text" name="year" id="year" class=" form-control input-flat select-year">
            </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_batch_add" class="btn btn-primary btn-flat">Save</button>
        <button data-dismiss="modal" class="btn  btn-default btn-flat">Close</button>
    </div>
    </form>
    </div>
    </div>
    
</div>
<!--End student detail view-->

<div class="modal fade" id="batch_delete_confermationModal" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="subjectModalLabel">Confirm deletion</h4>
        </div>
        <div class="modal-body" id="delete-msg">
            
        </div>
        <div class="modal-footer">
            <button id="delete-conf-yes-btn" class="btn btn-primary btn-flat">Yes</button>
        <button  class="btn  btn-default btn-flat" data-dismiss="modal" >No</button>
        </div>
    </div>
  </div>
</div>


<!--Delete Confirmation Modal-->

<div class="modal fade" id="subject_delete_confermationModal" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="subjectModalLabel">Confirm Deletion</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="subject-delete-msg"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0);" id="delete-yes-btn" class="btn btn-primary btn-flat">Yes</a>
            <a data-dismiss="modal" class="btn btn-default btn-flat">No</a>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="subjectModal1" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="subjectModalLabel">Add a Subject</h4>
        </div>
        <div class="modal-body">
            
        </div>
        <div class="modal-footer">
            
        </div>
    </div>
  </div>
</div>

<!--Subject Modal-->
<div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel" aria-hidden="true" data-backdrop="static">
</div>
<div class="modal fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content" >
        <form id="subject-detail"  onsubmit="return false;" role="form"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="subjectModalLabel">Add a Subject</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label  class="input-lable" for="batch-name">Subject Name<span class="required">*</span></label>
                            <input  class="form-control input-flat" type="text" value="" id="subjectName" name="subjectName"/>
                        </div>
                        <div class="form-group">
                            <label  class="input-lable" >Description</label>
                            <textarea class="form-control input-flat" rows="3" id="description"  name="description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-flat"  id="btn_subject_add">Save</button>
                <button class="btn btn-default btn-flat" type="reset">Clear</button>
            </div>
        </form>
    </div>
  </div>
</div>
<?php 
 include(APPPATH . 'views/common/footer.php');
 ?>