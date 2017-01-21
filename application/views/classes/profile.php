<?php 
 include(APPPATH . 'views/common/header.php');
 date_default_timezone_set($this->config->item("time_zone"));

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
                    <div class="col-md-12">
                        <div class="col-md-10">
                            <div class="inline-container">
                                <h1><?php echo $class['ClassName'];?> <small> - <?php echo $class['Description'];?></small></h1>
                            </div>
                        </div>
                        <div class="col-md-2 text-right">
                            <div class="inline-container">
                                <?php if($user_data['UserType']==1){ ?>
                                <a class="btn btn-success" type="button" href="<?php  echo base_url().'classes/edit/'.$class['ClassId'];?>">Edit</a>
                                <a target="_blank" class="btn btn-success" type="button" href="<?php  echo base_url().'classes/get_students_of_class/'.$class['ClassId'];?>">Show Students</a>
                                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#delete_class" type="button">Delete</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="inline-container">
                            <?php if(isset($assistants) && !empty($assistants)){
                                $assist=array();
                                 foreach ($assistants as $asst){
                                     $assist[]=$asst['Title'].' '.$asst['FirstName'].' '.$asst['LastName'];
                                 }
                                ?>
                            <div class="col-md-3"><i class="fa fa-link"></i> Assisted By <?php echo implode(', ',$assist); ;?> 
                            </div>
                            <?php }?>
                            <div class="col-md-3"><i class="fa fa-link"></i> Conducted By <?php echo $class['FirstName'].' '.$class['LastName'];?> </div>
                            <div class="col-md-2"><i class="fa fa-link"></i> <?php echo $class['BatchName'].'-'.$class['BatchYear'];?></div>
                            <div class="col-md-2">
                                <i class="fa fa-money"></i> <strong><?php echo date('M', mktime(0, 0, 0, $fees['Month'], 10))." : "; ?></strong> <?php echo 'Rs '.$fees['Amount'];?> 
                                <?php if(date('m')!=$fees['Month'] && date('Y')==$fees['Year']){?>
                                    <a href="#" data-toggle="modal" data-target="#class_fees_modal">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <span class="label label-warning">Please change for this month</span>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="inline-container">
                            <div class="col-md-12">
                                <fieldsets>
                                    <legend> Class Groups <?php if($user_data['UserType']==1){ ?> <a href="#" data-toggle="modal" data-target="#class_groupModal" classId="<?php echo $class['ClassId']; ?>"><i class="fa fa-plus-circle "></i></a><?php } ?></legend>
                                    <div class="row" id="class_group_container">
                                        <?php if(isset($groups) && count($groups)>0){
                                                foreach ($groups as $group){?>
                                        <div class="col-md-4" id="<?php echo 'group_'.$group['ClassGroupId']; ?>">
                                            <div class=" alert-info margin-bottum-5 ">
                                                <div class="inline-container clearfix ">
                                                    <div class="col-md-10">
                                                        <div class="col-md-12">
                                                            <strong>
                                                                <?php echo $group['DayOfWeek'].' ( '.date('h:i a',$group['StartTime']).'-'.date('h:i a',$group['EndTime']).' )'; ?>
                                                            </strong>
                                                        </div>
                                                    <div class="col-md-10"><small><?php echo $group['Description'];?></small></div>
                                                    </div>
                                                    <div class="col-md-2 text-right">
                                                        <span class="label label-success"><?php echo $group['student_count']; ?></span>
                                                        <a href="#" data-toggle="modal" data-target="#group_studentsModal" classId="<?php echo $class['ClassId']; ?>"><i class="fa fa-users "></i></a>
                                                        <?php if($group['IsActive']==0){ ?>
                                                        <a href="javascript:void(0);" class="btn-edit-group" classId="<?php echo $group['ClassId']; ?>" class_group_id="<?php echo $group['ClassGroupId']; ?>"><i class="fa fa-edit"></i></a>
                                                        <?php    if(count($groups)>1 && $user_data['UserType']==1){?>
                                                        <a href="javascript:void(0);" class="btn-remove-group" classId="<?php echo $group['ClassId']; ?>" class_group_id="<?php echo $group['ClassGroupId']; ?>"><i class="fa fa-remove"></i></a>
                                                            <?php } ?>
                                                        <?php  } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                
                                                      <?php      } }else{ ?>
                                        <div class="col-md-12">
                                            <div class="inline-container">
                                                <div class="alert alert-danger vd-alert">Please add at least one group.</div>
                                            </div>
                                        </div>
                                                   <?php   } ?>
                                        
                                        


                                    </div>
                                </fieldsets>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="inline-container">
                                <div class="col-filter_student "><h4>Assign Class Students</h4></div>
                                <div class="col-md-2">
                                    <div class="dropdown " id="filter_student">
                                        <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                            <h4> <i class="fa fa-filter"></i>
                                                <span class="caret"></span></h4>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#assign_byclass">By Class</a></li>
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#assign_bygroup">By Group</a></li>
                                        </ul>
                                  </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="inline-container">
                            <div class="col-md-12">
                                <fieldsets>
                                 
                                     <form id="searchForm" onsubmit="return false;"  >
                                        <div class="form-group col-md-3">
                                            <input type="text" id="searchedText" class="form-control input-flat" autocomplete="off" name="searchedText" id="student" placeholder="Student Id / Name">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success" id="btnSearch">Search</button>
                                        </div>
                                
                                    </form>
                                </fieldsets>
                            </div>
                        </div>
                    </div>
                </div>
             
                <div class="row">
                    <div class="col-md-12">
                        <div class="inline-container">
                            <div id="search_result" class="col-md-12 ">
                            
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- class group Modal -->
<div class="modal fade" id="class_groupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $class['ClassName'].' : '.$class['BatchName'].' - '.$class['BatchYear']; ?></h4>
        </div>
        <form id="class_group_form" method="post" action="<?php echo base_url(); ?>classes/create_group/<?php echo $class['ClassId']; ?>"> 
        <div class="modal-body">
            <div class="row">
                <div  class="col-md-12">
                   
                        <h5><?php echo $class['ClassName'].' : '.$class['BatchName'].' - '.$class['BatchYear']; ?></h5>
                       
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="class_date" class="input-lable" >Date</label>
                            <input type="text" class="form-control input-flat"  autocomplete="off" id="class_group_date" name="class_date"/>
                        </div>
                       
                            <div class="form-group">
                                <label for="description" class="input-lable" >Description</label>
                                <input type="text" class="form-control input-flat" name="description"/>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="start" class="input-lable " >Start Time</label>
                                    <input type="text" class="form-control input-flat timepicker vd-timepicker" name="start" id="classgroup_start"/>
                                </div>
                                <div class="col-md-4">
                                    <label for="end" class="input-lable" >End Time</label>
                                    <input type="text" class="form-control input-flat timepicker  vd-timepicker" name="end" id="classgroup_end"/>
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
</div>

<!-- class group Modal -->
<div class="modal fade" id="class_fees_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Class Fees</h4>
        </div>
        <form id="changeclassfees_form" method="post" action="<?php echo base_url(); ?>classes/change_fees/<?php echo $class['ClassId']; ?>"> 
        <div class="modal-body">
            <div class="row">
                <div  class="col-md-12">
                   
                        <h5><?php echo $class['ClassName'].' : '.$class['BatchName'].' - '.$class['BatchYear']; ?></h5>
                       
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="amount" class="input-lable" >Amount</label>
                            <input type="text" class="form-control input-flat" value="" name="amount"/>
                        </div>
                        <div class="form-group">
                            <label for="due_date" class="input-lable" >Due Date</label>
                            <input type="text" class="form-control input-flat" value="<?php echo $fees['Month'].'/1/'.$fees['Year'] ?>"  autocomplete="off" id="due_date" name="due_date"/>
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
</div>

<!--  edit class group Modal -->
<div class="modal fade" id="edit_class_groupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<div class="modal fade" id="class_group_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Delete Class Group</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div  class="col-md-12">
                   Are you sure want to delete this?
                        
                       
                   
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button class_group_id="" classId="" type="button" class="btn btn-danger " id="btn-delete-classgroup-yes">Yes</button>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="assign_byclass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Assign By Class</h4>
        </div>
   <form id="student_assign_byClass_form" class="form-horizontal" role="form" action="<?php echo base_url().'students/mergeStudentByClass/'.$class['ClassId']; ?>" method="post" >
        <div class="modal-body">
            <div class="row">
                <div  class="col-md-12">
                    <div class="inline-container">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label class="input-lable">From</label>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <input type="text" autocomplete="off" name="class_detail" class="form-control input-flat typeahead" id="class_list" placeholder="Class">
                            </div>
                            <div class="col-md-6">
                                <select class="form-control input-flat" name="from_group" id="from_group">
                                    <option selected="true" value="0">Select Group</option>
                                    
                                </select>
                            </div>
                            <input type="hidden" name="batchId" id="batchId" value="<?php echo $class['BatchId'];?>"/>
                            <input type="hidden" name="selectclassId" id="selectclassId" value=""/>
                            <input type="hidden" name="profileclassId" id="profileclassId" value="<?php echo $class['ClassId'];?>"/>
                        </div>
                        <div class="form-group">
                            <label class="input-lable">To</label>
                            <div class="clearfix"></div>
                            
                            <div class="col-md-6">
                                <select class="form-control input-flat" id="to_group" name="to_group" >
                                    <option selected="true" value="0">Select Group</option>
                                    <?php if(isset($groups) && count($groups)>0){
                                            foreach ($groups as $group){ ?>
                                    <option value="<?php echo $group['ClassGroupId'];?>"><?php echo $group['DayOfWeek'].' ( '.date('h:i a',$group['StartTime']).'-'.date('h:i a',$group['EndTime']).' )'; ?></option>
                                    <?php        }
                                    }?>
                                </select>
                            </div>
                           
                        </div>
                       
                       
                        </div>
                    </div>
                        <!--<button type="submit" class="btn btn-success">Search</button>-->
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class_group_id="" classId="" type="submit" class="btn btn-primary" id="btn-assign-by-class-yes">Assign</button>
        </div>
        </form>

    </div>
</div>
</div>

<div class="modal fade" id="assign_bygroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Assign By Group</h4>
        </div>
       <form id="student_assign_byGroup_form" class="form-horizontal" role="form" action="<?php echo base_url().'students/mergeStudentByGroup/'.$class['ClassId']; ?>" method="post" >
        <div class="modal-body">
            <div class="row">
                <div  class="col-md-12">
                   <div class="inline-container">
                       <div class="col-md-12">
                           <div class="form-group">
                               <label class="input-lable">From</label>
                               <select class="form-control input-flat" id="Fromgroup" name="Fromgroup" >
                                    <option selected="true" value="0">Select Group</option>
                                    <?php if(isset($groups) && count($groups)>0){
                                            foreach ($groups as $group){ ?>
                                    <option value="<?php echo $group['ClassGroupId'];?>"><?php echo $group['DayOfWeek'].' ( '.date('h:i a',$group['StartTime']).'-'.date('h:i a',$group['EndTime']).' )'; ?></option>
                                    <?php        }
                                    }?>
                                </select>
                           </div>
                           <div class="form-group">
                               <label class="input-lable">To</label>
                               <select class="form-control input-flat" id="Togroup" name="Togroup" >
                                    <option selected="true" value="0">Select Group</option>
                                    <?php if(isset($groups) && count($groups)>0){
                                            foreach ($groups as $group){ ?>
                                    <option value="<?php echo $group['ClassGroupId'];?>"><?php echo $group['DayOfWeek'].' ( '.date('h:i a',$group['StartTime']).'-'.date('h:i a',$group['EndTime']).' )'; ?></option>
                                    <?php        }
                                    }?>
                                </select>
                           </div>
                       </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Assign</button>
        </div>
       </form>
    </div>
</div>
</div>

<div class="modal fade" id="assign_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Assign to Group</h4>
        </div>
       <form id="student_assign_byGroup_form" class="form-horizontal" role="form" action="<?php echo base_url().'students/assignStudentByGroup/'.$class['ClassId']; ?>" method="post" >
        <div class="modal-body">
            <div class="row">
                <div  class="col-md-12">
                   <div class="inline-container">
                       <div class="col-md-12">
                           
                           <div class="form-group">
                               <label class="input-lable">To</label>
                               <select class="form-control input-flat" id="Togroup" name="Togroup" >
                                    <?php if(isset($groups) && count($groups)>0){
                                            foreach ($groups as $group){ ?>
                                    <option value="<?php echo $group['ClassGroupId'];?>"><?php echo $group['DayOfWeek'].' ( '.date('h:i a',$group['StartTime']).'-'.date('h:i a',$group['EndTime']).' )'; ?></option>
                                    <?php        }
                                    }?>
                                </select>
                               <input type="hidden" name="studentId" id="studentId" value=""/>
                           </div>
                       </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Assign</button>
        </div>
       </form>
    </div>
</div>
</div>

<div class="modal fade" id="delete_class" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Delete the class</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div  class="col-md-12">
                   <div class="inline-container">
                       <div class="col-md-12">
                           Are you sure want to delete this class ?
                       </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <a href="<?php echo base_url().'classes/delete/'.$class['ClassId']; ?>" class="btn btn-danger">Yes</a>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="group_studentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Group Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div  class="col-md-12">
                    <li><a target="_blank" href="<?php  echo base_url().'classes/get_students_of_group/'.$group['ClassGroupId'];?>"><i class="fa fa-list"></i> Show list of students</a></li>
                    <li><a target="_blank" href="<?php  echo base_url().'classes/get_past_logs_attendance/'.$group['ClassGroupId'];?>"><i class="fa fa-book"></i> Past logs</a></li>



                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php 
 include(APPPATH . 'views/common/footer.php');
 ?>
