<?php
include(APPPATH . 'views/common/header.php');
date_default_timezone_set($this->config->item("time_zone"));
?>


<div class="container">
    <div class="row main-page">
        <div class="vd-page-container">
            <div class="vd-page-content">
                
          
                <div class="col-md-12">
                    <div class="inline-container">
                       
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
                    
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#change_password" aria-controls="home" role="tab" data-toggle="tab">Change Password</a></li>
<!--                          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
                          <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                          <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>-->
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="change_password">
                                <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                <div class="inline-container">
                                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>settings/change_password">
                                    <div class="form-group">
                                        <label for="old_password">Old Password</label> 
                                        <input type="password" name="old_password" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label> 
                                        <input type="password" name="new_password" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="new_confirm_password">New Confirm Password</label> 
                                        <input type="password" name="new_confirm_password" class="form-control" />
                                    </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success pull-right" >Change Password</button>
                                        </div>
                                </form>
                                
                                </div>
                                </div>
                                </div>
                            </div>
                      
                        </div>


                </div>
                
            </div>
            </div>
            
        </div>

    </div>
</div>
<?php
include(APPPATH . 'views/common/footer.php');
?>