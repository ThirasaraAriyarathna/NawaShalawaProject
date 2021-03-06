<?php
 date_default_timezone_set($this->config->item("time_zone"));
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $class['ClassName'] . ' : ' . $class['BatchName'] . ' - ' . $class['BatchYear']; ?></h4>
        </div>
        <form id="edit_class_group_form" method="post" action="<?php echo base_url(); ?>classes/edit_group/<?php echo $class['ClassId'].'/'.$class['ClassGroupId']; ?>"> 
            <div class="modal-body">
                <div class="row">
                    <div  class="col-md-12">
                        <h5><?php echo $class['ClassName'] . ' : ' . $class['BatchName'] . ' - ' . $class['BatchYear']; ?></h5>

                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="class_date" class="input-lable" >Date</label>
                            <input type="text" class="form-control input-flat" value="<?php if(isset($class['Date'])) echo date('m/d/Y',$class['Date']); ?>"  autocomplete="off" id="class_group_date" name="class_date"/>
                        </div>

                        <div class="form-group">
                            <label for="description" class="input-lable" >Description</label>
                            <input type="text" class="form-control input-flat" value="<?php if(isset($class['Description'])) echo $class['Description']; ?>" name="description"/>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label for="start" class="input-lable " >Start Time</label>
                                <input type="text" class="form-control input-flat timepicker vd-timepicker" value="<?php if(isset($class['StartTime'])) echo date('h:i A',$class['StartTime']); ?>" name="start" id="classgroup_start"/>
                            </div>
                            <div class="col-md-4">
                                <label for="end" class="input-lable" >End Time</label>
                                <input type="text" class="form-control input-flat timepicker  vd-timepicker" value="<?php if(isset($class['EndTime'])) echo date('h:i A',$class['EndTime']); ?>" name="end" id="classgroup_end"/>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>