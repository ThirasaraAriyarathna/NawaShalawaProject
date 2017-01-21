<?php 
//    echo '<pre>';
//    print_r($details);
//    echo '</pre>';
    date_default_timezone_set($this->config->item("time_zone"));
    
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $details['ClassName'].' : '.$details['BatchName'].' - '.$details['BatchYear']; ?></h4>
        </div>
        <form id="class_instance_form" method="post" action="<?php echo base_url(); ?>classes/create_instance/<?php echo $details['ClassId']; ?>"> 
        <div class="modal-body">
            <div class="row">
                <div  class="col-md-12">
                   
                        <h5><?php echo $details['ClassName'].' : '.$details['BatchName'].' - '.$details['BatchYear']; ?></h5>
                        <div class="form-group pull-right">
                            <label for="assistanKey" class="input-lable" >Assistant Key</label>
                            <input type="text" class="form-control input-flat" id="assistanKey" name="assistanKey"/>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="class_date" class="input-lable" >Date</label>
                            <input type="text" class="form-control input-flat" id="class_date" name="class_date"/>
                        </div>
                        <div class="form-group">
                            <label for="class" class="input-lable" >Class </label>
                            <div class="clearfix"></div>
                            <div  id="group_set">
                            <?php if(isset($details['classGroups'])){
                                foreach ($details['classGroups'] as $class_group){
                                   
                             ?>
                            
                            <div class="col-md-5 class-groups alert-info <?php echo strtolower($class_group[0]['DayOfWeek']); ?>" >
                                
                                    <div class="col-md-13">
                                    <span><?php echo $class_group[0]['DayOfWeek']; ?></span>
                                    <div class="clearfix"></div>
                                    <span><?php echo date('h:i a',$class_group[0]['StartTime']).'-'.date('h:i a',$class_group[0]['EndTime']); ?></span>
                                    <span class="pull-right">
                                        
                                            <i class="fa check-icon "></i>
                                       
                                    </span>
                                    </div>
                             
                            <input class="class_group_d" type="hidden" value="0" name="class_groups[<?php echo $class_group[0]['ClassGroupId']; ?>]"/>
                            </div>
                            <?php }} ?>
                            </div>
                        </div>
                         <input id="is_new_group" type="hidden" value="0" name="is_new_group"/>
                        <div class="clearfix">
                            <a class="btn btn-flat pull-right btn-default add_extra_class_instance">
                            <span class=" glyphicon glyphicon-plus"></span> 
                            </a>
                        </div>
                        <div class="col-md-12 extra_class" style="display: none" >
                            <h3>Add extra class</h3>
                            <div class="form-group">
                                <label for="description" class="input-lable" >Description</label>
                                <input type="text" class="form-control input-flat" name="description"/>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="start" class="input-lable " >Start Time</label>
                                    <input type="text" class="form-control input-flat timepicker" name="start" id="start"/>
                                </div>
                                <div class="col-md-4">
                                    <label for="end" class="input-lable" >End Time</label>
                                    <input type="text" class="form-control input-flat timepicker" name="end" id="end"/>
                                </div>
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