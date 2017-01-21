<?php
include(APPPATH . 'views/common/header.php');
date_default_timezone_set($this->config->item("time_zone"));
?>


<div class="container">
    <div class="row main-page">
        <div class="vd-page-container">
            <div class="vd-page-content">
                <?php if ($this->session->flashdata('message-success')) { ?>
                    <div class="alert alert-success vd-alert"><?php echo $this->session->flashdata('message-success'); ?></div>
                <?php } else if ($this->session->flashdata('message-error')) {
                    ?>
                    <div class="alert alert-danger vd-alert"><?php echo $this->session->flashdata('message-error'); ?></div>
                <?php } else if ($this->session->flashdata('message-info')) {
                    ?>
                    <div class="alert alert-info vd-alert"><?php echo $this->session->flashdata('message-info'); ?></div>
                <?php }
                ?>
                <div class="row">
                    <div class="col-md-12">
                    <div class="col-md-10 ">
                        <div class="inline-container">
                            <div class="col-md-12 col-sm-4 col-xs-3">
                                <div class="col-md-12 "><h2><?php echo $assistant['Title'].' '.$assistant['FirstName'].' '.$assistant['LastName']; ?></h2></div>
                                <div class="col-md-12 "><div class="inline-container"><i class="fa fa-map-marker"></i> <?php echo $assistant['Address']; ?>  <i class="fa fa-phone"></i> <?php echo $assistant['Phone']; ?> <?php if(isset($assistant['AdditionalPhone']) && !empty($assistant['AdditionalPhone'])) { ?>  <i class="fa fa-mobile-phone"></i> <?php echo $assistant['AdditionalPhone']; } ?>  <?php if(isset($assistant['Email']) && !empty($assistant['Email'])) { ?>  <i class="fa fa-envelope"></i> <?php echo $assistant['Email']; } ?> </div></div>
                                <div class="col-md-12 "><i class="fa fa-newspaper-o"></i> <?php echo $assistant['NIC']; ?>  <i class="fa fa-paw"></i> <?php echo $assistant['AdmissionID']; ?>  <i class="fa fa-key"></i> <?php echo $assistant['AssistantKey']; ?></div>
                                <div class="col-md-12"><div class="inline-container"><sub><?php echo $assistant['Description']; ?> </sub></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                            <div class="inline-container">
                                <?php if($user_data['UserType']==1){ ?>
                                <a class="btn btn-success" type="button" href="<?php echo base_url().'assistants/edit/'.$assistant['AssistantId']; ?>">Edit</a>
                                <?php if(isset($assistant['IsActive']) && $assistant['IsActive']==1){?>
                                            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#delete_assistant" type="button">Deactive</a>
                            <?php    } else{ ?>
                                            <a class="btn btn-success" href="<?php echo base_url().'assistants/active/'.$assistant['AssistantId']; ?>" type="button">Active</a>
                                <?php    } }
?>
                                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!--                <hr>-->
                <div class="col-md-12">
                    <div class="inline-container">
                        <div class="col-md-12">
                                <fieldsets>
                                    <legend>Assigned classes</legend>
                                    <div class="form-group">
                                        <div class="row " id="class_list">
                                            <?php
                                            if(isset($assistant['ClassList']) && count($assistant['ClassList'])>0){
                                                foreach ($assistant['ClassList'] as $class){?>
                                            <div class="col-md-3" >
                                                <div class=" alert-info bottom-margin-5 ">
                                                    <div class="inline-container clearfix ">
                                                        <div class="col-md-10"><?php echo $class['className'].' - '.$class['batchName']; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                                    
                                             <?php   }
                                            }
                                            else{?>
                                            <div class="col-md-10">
                                                <div class="inline-container">
                                                    <span class="label label-danger">Assign at least one class. </span>
                                                </div>
                                            </div>
                                        <?php    }
                                            ?>
                                        </div>
                                    </div>

                                </fieldsets>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="delete_assistant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">De-active the assistant</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div  class="col-md-12">
                   <div class="inline-container">
                       <div class="col-md-12">
                           Are you sure want to delete this assistant ?
                       </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <a href="<?php echo base_url().'assistants/deactive/'.$assistant['AssistantId']; ?>" class="btn btn-danger">Yes</a>
        </div>
    </div>
</div>
</div>
<?php
include(APPPATH . 'views/common/footer.php');
?>