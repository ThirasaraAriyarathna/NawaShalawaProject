
<?php 
        
        include(APPPATH . 'views/common/header.php'); ?>
<?php // include(APPPATH . 'views/common/menu-bar.php');
$date_limit1= strtotime(strftime('%d-%m-%Y',time()))-$this->config->item("time_zone_offset");
$date_limit2= $date_limit1+3600*24;
date_default_timezone_set($this->config->item("time_zone"));
?> 
<div class="container">
   
        <div class="row main-page">

            <div class="vd-page-container">

                <div class="vd-page-content">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-6">
                            <div class="inline-container">
                                <div class="col-img col-sm-4 col-xs-3">
                                    <img class='header-icon' src='<?php echo base_url(); ?>assets/boostrap/images/attendance.png'/>
                                </div>
                                <div class="col-md-7 col-sm-4 col-xs-3">
                                    <div class="col-md-12 "><h2><?php echo $class_details['ClassName'].' Class'; ?></h2></div>
                                    <div class="col-md-12 "><h4><?php echo 'By '.$class_details['TFName'].' '.$class_details['TLName']; ?></h4></div>
                                    <div class="col-md-12 "><i class="fa fa-link"> <?php echo $class_details['BatchName'].' '.$class_details['BatchYear']; ?></i></div>
                                    
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-3 text-right pull-right">
                                    <div class="col-md-12 "><h2><?php echo date('d - M - Y',$class_details['ClassDate']); ?></h2></div>
                                    <div class="col-md-12 "><h4><?php echo date('h:i a',(int)$class_details['StartTime']).' - '.date('h:i a',(int)$class_details['EndTime']); ?></h4></div>
                                    <div class="col-md-12 pull-right text-right ">
                                        <div class="col-md-2">
                                            <a target="_blank" href="<?php echo base_url().'attendance/generate_reports/'.$class_details['ClassDateId']; ?>" class="btn btn-primary btn-flat " title="Reports"><i class="fa  fa-file"></i></a>
                                        </div>
                                        <div class="col-md-5">
                                            <a target="_blank" href="<?php echo base_url().'attendance/createPdf/'.$class_details['ClassDateId']; ?>" class="btn btn-success btn-flat " title="PDF">Create PDF</a>
                                        </div>
                                        <?php if($class_details['IsActiveClassDate']==1){
                                            ?>
                                        <div class="col-md-15">
                                            <a href="<?php echo base_url().'attendance/deactive/'.$class_details['ClassDateId']; ?>" class="btn btn-danger btn-flat " title="Deactive">Deactive</a>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="inline-container">
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
                                <div class="well col-md-6 col-md-offset-3 div-padding">
                                    <form id="attendanceForm" onsubmit="return false;"  class="form-attendance">
                                        <div class="form-group ">
                                            <input type="text"  name="searchedText" <?php if($date_limit1>(int)$class_details['ClassDate'] && $date_limit2<(int)$class_details['ClassDate']){ ?> disabled="disabled" <?php  } ?> id="searchedText" class="form-control input-flat input-lg" placeholder="Enter Student ID" class_date_id="<?php echo $class_details['ClassDateId']; ?>" autocomplete="off" class_id="<?php echo $class_details['ClassId']; ?>" />
                                        </div>                              
                                        <!--<button class="btn" type="button" id="btnSearch">Search</button>-->                               
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="clearfix"></div>
                     <div class="row">
                         <div class="col-md-12">
                             <div id="multiple-result" class="inline-container">
                                 
                             </div>
                         </div>
                     </div>
                </div>
            </div>

    </div>
</div>
<!--Start student detail view-->
<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-labelledby="DetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
        </div>
    </div>
</div>
<!--End student detail view-->

<!--Start student detail view-->
<div class="modal fade" id="TopUpConfermationModal" tabindex="-1" role="dialog" aria-labelledby="TopUpConfermationModalLabel" aria-hidden="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Top Up Student</h4>
            </div>
            <form action="" method="post" id="topup_form" onsubmit="return false;">
            <div class="modal-body">
                    <div class="row">
                        <div class="inline-container">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input readonly="" class="input-flat form-control" id="feesValue" name="feesValue" placeholder="Ammount"/>
                                </div>
                                <div class="col-md-2">
                                    <a href="javascript:void(0);" id="btn-edit"><i class="fa fa-edit"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="inline-container">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea name="remarkValue" class="input-flat form-control" placeholder="Remarks"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                 <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-default">Close</a>
                 <input id="topup_btn_yes" class_date_id="<?php echo $class_details['ClassDateId']; ?>"  classStudentId="" classFeesId="" feesRate="" class="btn btn-primary" type="button" value="Top up"/>
            </div>
            </form>
        </div>
    </div>
</div>
<!--End student detail view-->

<script>
    var classID=<?php echo $class_details['ClassId']; ?>;
</script>
<?php include(APPPATH . 'views/common/footer.php'); ?>  
<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {
        $('#searchedText').focus();
    });
</script>

