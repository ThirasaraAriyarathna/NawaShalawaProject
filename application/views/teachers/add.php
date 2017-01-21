<?php include(APPPATH.'views/common/page-header.php'); ?>
<?php // include(APPPATH.'views/common/menu-bar.php'); ?>          
            <!-- start page content-->
            <div id="content_wrapper">
                <div class="alert-content">
                <?php if (isset($data['messages'])) { ?>
                    <div class="<?php echo 'alert alert-'.$data['messages_type']; ?> ">
                        <?php if($data['messages_type']=="error"){?>
                        <h4>Error!</h4>
                        <?php } else {?>
                        <h4>Well done!</h4>
                        <?php }?>
                        <?php echo $data['messages']; ?>
                    </div>
                <?php } ?>
            </div>
              
                <div id="content"> 
                    <div id="content-header" class="row">
                        <div class="span2 pull-left">
                             <img src="<?php echo base_url() ?>/assets/images/dashboard/news-icon.jpg" alt="Manage_news_logo" class="pull-left">
                        </div>
                        <ul class="unstyled pull-left">
                            <li><h1>Admission</h1></li>
                             <li><h3>Step - 1 Teacher details</h3></li>
                        </ul>
                       
                    </div>
                    
                    <div class="extender"></div>
                    <div class="div_divider" ></div>
                    <div class="extender"></div>
                    <div class="student_form"> 
                        <label style="font-weight: bold;">Fields marked with <span class="required">*</span> must be filled.</label>
						
                        <form id="teachers-detail" class="form-horizontal" action="<?php echo base_url(); ?>teachers/add" method="post" >
                            <fieldset>
                               
                                <legend>Personal Details</legend>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">First Name<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="" autocomplete="off" name="firstName"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Last Name</label>
                                    <div class="controls">
                                        <input type="text" value="" autocomplete="off" name="lastname"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Date of Birth<span class="required">*</span></label>
                                    <div class="controls">
                                        <input  type="text" name="DOB" class="example1">
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Gender<span class="required">*</span></label>
                                    <div class="controls">
                                        <select name="gender" >
                                            <option value="0">Female</option>
                                            <option value="1">Male</option>
                                        </select>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>

                                <legend>Contact Details</legend>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Address Line 1<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="" name="addressLine1" id="addressLine1" autocomplete="off"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Address Line 2</label>
                                    <div class="controls">
                                        <input type="text" value="" name="addressLine2" id="addressLine2" autocomplete="off"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">City<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="" name="city" id="city"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left" >State</label>
                                    <div class="controls">
                                        <input type="text" autocomplete="off" data-source="<?php echo $states;?>"  name="state" data-provide="typeahead"  class="span3 state">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Phone</label>
                                    <div class="controls">
                                        <input type="text" value="" name="phone" id="phone" autocomplete="off"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Mobile</label>
                                    <div class="controls">
                                        <input type="text" value="" name="mobile" id="mobile" autocomplete="off" />
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Email</label>
                                    <div class="controls">
                                        <input type="text" value="" name="email" autocomplete="off"/>
<!--                                        <span class="help-inline">Associated help text!</span>-->
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>

								
                                
                                <div class="form-actions" >
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <button class="btn" type="reset">Clear</button>
                                </div>
                            </fieldset>
                        </form>

                    </div>
                </div>
            </div>
            <!-- end page content-->
        </div>
        <?php include(APPPATH.'views/common/page-footer.php') ?>      
         <script type="text/javascript">
            // When the document is ready
            $(document).ready(function() {

                $('.example1').datepicker({
                     startView: 2,
                     autoclose: true
                });

            });
        </script>
