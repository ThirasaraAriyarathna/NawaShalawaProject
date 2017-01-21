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
                    <div class="col-md-12 col-xs-12 col-sm-6">
                        <div class="inline-container">
                            <div class="col-img col-sm-4 col-xs-3">
                                <img class='header-icon' src='<?php echo base_url(); ?>assets/boostrap/images/assistant.png'/>
                            </div>
                            <div class="col-md-7 col-sm-4 col-xs-3">
                                <div class="col-md-12 "><h2>Edit Assistant</h2></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!--                <hr>-->
                <div class="col-md-12">
                    <div class="inline-container">
                        <div class="col-md-12">
                            <form action="<?php echo base_url() . 'assistants/edit/'.$assistant['AssistantId']; ?>" method="post" id="assistant_add_form">
                                <fieldsets>
                                    <legend>Personal Details</legend>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <div class="inline-container">
                                                <label for="title">Title</label><span class="required">*</span>
                                                <?php $titles=array('Mr','Ms','Mrs'); ?>
                                                <select class="form-control input-flat" name="title">
                                                    <?php foreach ($titles as $title){
                                                        if(strcmp($title, $assistant['Title'])===0){ ?>
                                                    <option selected="true" value="<?php echo $title; ?>"><?php echo $title; ?></option>
                                                       <?php }else{ ?>
                                                    <option value="<?php echo $title; ?>"><?php echo $title; ?></option>
                                                    <?php    }
                                                    } ?>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="inline-container">
                                                <label for="firstname">First Name</label><span class="required">*</span>
                                                <input type="text" autocomplete="off" value="<?php echo $assistant['FirstName']; ?>" class="form-control input-flat" name="firstname" id="firstname" >
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="inline-container">
                                                <label for="lastname">Last Name</label>
                                                <input autocomplete="off" value="<?php echo $assistant['LastName']; ?>" type="text" class="form-control input-flat" name="lastname" id="lastname" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <div class="inline-container">
                                                <label for="nic">NIC</label><span class="required">*</span>
                                                <input autocomplete="off" value="<?php echo $assistant['NIC']; ?>" type="text" class="form-control" id="nic" name="nic" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="inline-container">
                                                <label for="description">Description</label>
                                                <input  value="<?php echo $assistant['Description']; ?>" type="text" class="form-control" id="description" name="description" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <legend>Contact Details</legend>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <div class="inline-container">
                                                <label for="address">Address</label><span class="required">*</span>
                                                <textarea type="text" class="form-control" name="address" id="address" ><?php echo $assistant['Address']; ?></textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <div class="inline-container">
                                                <label for="phone">Phone</label><span class="required">*</span>
                                                <input autocomplete="off" type="text" value="<?php echo $assistant['Phone']; ?>" class="form-control input-flat" name="phone" id="phone" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="inline-container">
                                                <label for="mobile">Additional Phone</label>
                                                <input autocomplete="off" type="text" value="<?php echo $assistant['AdditionalPhone']; ?>" class="form-control input-flat" name="mobile" id="mobile" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="inline-container">
                                                <label for="email">Email</label>
                                                <input autocomplete="off" type="text" value="<?php echo $assistant['Email']; ?>" class="form-control input-flat" name="email" id="email" >

                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <legend>Assign to class</legend>
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="assign_all_class" id="assign_all_class"> Assign to All
                                        </label>
                                    </div>
                                    <div class="form-group">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="inline-container">
                                                    <label for="batches">Batch</label>
                                                    <select class="form-control" name="batches" id="batches">
                                                        <?php foreach ($batches as $batch) { ?>
                                                            <option value="<?php echo $batch['BatchId']; ?>" ><?php echo $batch['Name'] . '-' . $batch['Year']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="inline-container">
                                                    <label for="class_name">Class</label>
                                                    <input type="text" class="form-control input-flat typeahead" autocomplete="off" id="class_name">
                                                    <?php if($user_data['UserType']==1){ ?>
                                                    <a target="_blank" title="Add Class" href="<?php echo base_url() . 'classes/add' ?>" class="pull-right"><i class="fa fa-plus-square"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3 hidden" id="class_list_error">
                                                <div class="inline-container">
                                                    <span class="label label-danger">All ready added.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row " id="class_list">
                                             <?php
                                            if(isset($assistant['ClassList']) && count($assistant['ClassList'])>0){
                                                foreach ($assistant['ClassList'] as $class){ ?>
                                            <div class="col-md-3" id="class_<?php echo $class['classId'];?>">
                                                <div class=" alert-info bottom-margin-5 ">
                                                    <div class="inline-container clearfix ">
                                                        <div class="col-md-10"><?php echo $class['className'].' - '.$class['batchName']; ?></div>
                                                        <div class="col-md-2 text-right">
                                                            <a href="javascript:void(0);" class="btn_close_class" classId="<?php echo $class['classId'];?>"><i class="fa fa-remove"></i></a>
                                                        </div>
                                                        <input class="classname" type="hidden" name="class_list[]" value="<?php echo $class['classId'];?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }}?>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="reset" class="btn btn-default">Clear</button>

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
<?php
include(APPPATH . 'views/common/footer.php');
?>