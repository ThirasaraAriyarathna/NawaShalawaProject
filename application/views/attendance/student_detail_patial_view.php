<?php 
$date_limit1= strtotime(strftime('%d-%m-%Y',time()))-$this->config->item("time_zone_offset");
date_default_timezone_set($this->config->item("time_zone"));
$disable_attendance=false;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">Student Detail</h4>
     <?php 
                    $student = $student_details['results'][0];
                ?>
</div>
<div class="modal-body">
    <div class="inline-container">
         <?php if($student['isactive_student']!=1){ ?>
                                    <div class="alert alert-danger"> do not allow for this group</div>
                                    <?php }?>
        <div class="row">
            <div class="col-md-12">
                <div class="vd-page-container">
                    <div class="inline-container">
                        <div class="row ">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                         <?php $gender_class=array('fa-female','fa-male'); ?>
                                        <span><h4><?php echo $student['FirstName'].' '.$student['LastName']; ?> <i class="fa <?php echo $gender_class[$student['Gender']] ?>"></i></h4></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                       <?php echo $student['AdmissionID']; ?>
                                    </div>
                                    <div class="col-md-3">
                                        <span><i class="fa fa-chain"></i> <?php echo $student['Name'].' - '.$student['Year']; ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <span><i class="fa fa-calendar"></i> <?php echo date('d-m-Y',$student['RegDate']); ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                        <?php if(isset($student['classGroupDetails'])){
                                            
                                            foreach ($student['classGroupDetails'] as $index=>$group){ ?>
                                                <div class="col-md-5" >
                                                    <div class="alert-info  margin-bottum-5 margin-right-5 ">
                                                        <div class="inline-container clearfix">
                                                    <div class="col-md-1 "><span><i class="fa fa-users "></i></span></div>
                                                    <div class="col-md-9">
                                                        <div class=""> <?php echo $group['DayOfWeek']; ?></div>
                                                        <div class=""><?php echo date('h:i a',$group['StartTime']).'-'.date('h:i a',$group['EndTime']);  ?></div>
                                                    </div>
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                        <?php    }
                                        } ?>
                                        
                                       
                             

                                </div>
                          


                                <h3 class="col-md-8"><?php echo $student['ClassName']  ?> - <small><?php echo $student['ClassDescription']; ?></small></h3>
<!--                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="inline-container">
                                        <span>
                                            <i class="fa fa-money"> <?php if(isset($student['FeesRate']) && $student['FeesRate']==0){ echo 'Free Card';} else{ echo 'Rs '.$student['ClassFees'].' x '.$student['FeesRate'].' = Rs '.($student['classPayment']); } ?></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>-->
                                
                            </div>
                            <div class="col-md-4 pull-right">
                                <img width="150px" class="pull-right" src="<?php echo base_url(); ?>assets/images/profile-pic.png"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <!-- tabs right -->
                                <div class="tabbable tabs-right">
                                    <ul class="nav nav-tabs" id="month_menu">
                                        
                                         <?php  
                                                       
                                                                $tabs_list=array();
                                                                    foreach($student['class_dates'] as $m=>$dates){
                                                                        $tabs_list[$m] =strtolower(date('F', mktime(0, 0, 0, $m, 10))); 
                                                                        $tab_ind=(int)$m;
                                                                        
                                                                     ?>
                                                    <li class="<?php if(count($tabs_list)==1) echo 'active'; ?> "><a class="<?php if(!isset($student['FeesDates'][$tab_ind]) && isset($student['FeesRate']) && $student['FeesRate']>0){ ?>red-back<?php }else{ echo 'green-back';} ?>" href="#<?php echo strtolower(date('F', mktime(0, 0, 0, $m, 10)));?>" data-toggle="tab"><?php echo date('F', mktime(0, 0, 0, $m, 10));?></a></li>

                                                                <?php 
                                                                    }
                                                         ?>
                                    </ul>
                                    <div class="tab-content">
                                        <?php $j=0; foreach ($tabs_list as $k=>$tab){  ?>
                                                      <div role="tabpanel" class="tab-pane <?php if($j==0) echo 'active'; ?>" id="<?php echo $tab; ?>">
                                                          <div class=" row  tab-detail">
                                                          <?php 
                                                         $class_dates=$student['class_dates'][$k];
                                                          if(is_array($class_dates))
                                                                sort($class_dates);
                                                            foreach ($class_dates as $date){
                                                                
                                                                    ?>
                                                              <span class="col-md-1"><i class="fa <?php if(isset($student['AttendanceDate'][$k][date('d',$date)])){ if($date==$date_limit1){$disable_attendance=true;} echo 'fa-check-square-o';} else{echo 'fa-square-o';} ?>"> <?php echo date('d',$date); ?></i></span>
                                                              <?php 
                                                            }
                                                           ?>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                <div class="inline-container">
                                                                    <?php 
                                                                    $tab_ind=(int)$k;
                                                                    if(isset($student['ClassFees'][$tab_ind])){  ?>
                                                                    <span class="label label-success">
                                                                    <i class="fa fa-money"> <?php if(isset($student['FeesRate']) && $student['FeesRate']==0){ echo 'Free Card';} else{ echo 'Rs '.$student['ClassFees'][$tab_ind].' x '.$student['FeesRate'].' = Rs '.(intval($student['ClassFees'][$tab_ind])*($student['FeesRate'])); } ?></i>
                                                                </span>
                                                                    <?php }else{?>
                                                                         <span class="label label-danger">Update Class Fees for this month</span>
                                                                   <?php }?>

                                                                </div>
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                              <div class="inline-container">
                                                              <div class="col-md-12">
                                                                  <?php 
                                                                 
                                                                  if(!isset($student['FeesDates'][$tab_ind]) && isset($student['ClassFees'][$tab_ind]) && isset($student['FeesRate']) && $student['FeesRate']>0){ ?>
                                                                   <a href="javascript:void(0);" id="btn-topup" classStudentId="<?php echo $student['ClassStudentId']; ?>" classFeesId="<?php if(isset($student['ClassFeesId'][$tab_ind])) echo $student['ClassFeesId'][$tab_ind]; ?>" fees="<?php echo intval($student['ClassFees'][$tab_ind])*($student['FeesRate']);?>" class="btn btn-primary">Top up</a>
                                                                   <?php }?>
                                                              </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  <?php $j++; } ?>
                                    </div>
                                </div>
                                <!-- /tabs -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <a <?php if($disable_attendance){ ?> disabled="disabled" <?php } ?>  href="<?php echo base_url().'attendance/mark_attendance/'.$student['ClassStudentId'].'/'.$student['ClassDateID']; ?>" class="btn btn-primary">Mark Attendance</a>
</div>