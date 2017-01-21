<?php include(APPPATH.'views/common/page-header.php') ?>
<?php //include(APPPATH.'views/common/menu-bar.php') ?>          
            <!-- start page content-->
            <div id="content_wrapper">
                <div class="alert-content">
                <?php if (isset($messages)) { ?>
                    <div class="<?php echo 'alert alert-'.$messages_type; ?> ">
                        <?php if($messages_type=="error"){?>
                        <h4>Error!</h4>
                        <?php } else {?>
                        <h4>Well done!</h4>
                        <?php }?>
                        <?php echo $messages; ?>
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
                             <li><h3>Step - 1 Student details</h3></li>
                        </ul>
                       
                    </div>
                    
                    <div class="extender"></div>
                    <div class="div_divider" ></div>
                    <div class="extender"></div>
                    <div class="student_form"> 
                        <label style="font-weight: bold;">Fields marked with <span class="required">*</span> must be filled.</label>
                        <form id="student-detail" action="<?php echo base_url(); ?>students/add" method="post" >
                            <fieldset>
                                <legend>Admission Details</legend>
                                <div class="control-group">
                                    <!--<label  class="control-label input-lable pull-left">Admission ID<span class="required">*</span></label>-->
                                    <div class="controls">
                                        <select name="batches" id="batches-dropdown">
                                            <option value="0" >Select Batch</option>
                                            <?php 
                                            foreach($batches as $batch){ ?>
                                                 <option value="<?php echo $batch['BatchId']; ?>" ><?php echo $batch['Name'].'-'.$batch['Year'];?></option>
                                          <?php  }?>
                                        </select>
                                        <input type="hidden" value="" name="admissionID" id="admissionID"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
<!--                                
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Admission ID<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="" name="admissionID" id="admissionID"/>
                                        <span class="help-inline">Please correct the error</span>
                                    </div>
                                </div>-->
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Admission Date<span class="required">*</span></label>
                                    <div class="controls">
                                        <input  type="text"  class="example1" name="admissionDate">
                                       <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <legend>Personal Details</legend>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">First Name<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="" name="firstName"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Last Name<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="" name="lastname"/>
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
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left" >District</label>
                                    <div class="controls">
                                        <!--<input type="text" autocomplete="off"  name="district" id="district" data-source="['Abc','CDE','Anjana','ISURA','Thilani']" />-->
                                        <input type="text" autocomplete="off" data-source="<?php echo $districts;?>"  name="district" data-items="4" data-provide="typeahead" style="margin: 0 auto;" class="span3 district">
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left" >School</label>
                                    <div class="controls">
                                        <input type="text" value="" name="school"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>


                                <legend>Contact Details</legend>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Address Line 1<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="" name="addressLine1" id="addressLine1"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Address Line 2</label>
                                    <div class="controls">
                                        <input type="text" value="" name="addressLine2" id="addressLine2"/>
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
                                        <!--<input type="text" value="" name="state"/>-->
                                        <input type="text" autocomplete="off" data-source="<?php echo $states;?>"  name="state" data-items="4" data-provide="typeahead" style="margin: 0 auto;" class="span3 state">

                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
<!--                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">PIN Code</label>
                                    <div class="controls">
                                        <input type="text" value="" name="pincode"/>
                                        <span class="help-inline">Please correct the error</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Country</label>
                                    <div class="controls">
                                        <select name="country">
                                            <option>India</option>
                                            <option>Sri Lanka</option>
                                        </select>
                                        <span class="help-inline">Please correct the error</span>
                                    </div>
                                </div>-->
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Phone</label>
                                    <div class="controls">
                                        <input type="text" value="" name="phone" id="phone"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Mobile</label>
                                    <div class="controls">
                                        <input type="text" value="" name="mobile" id="mobile"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Email</label>
                                    <div class="controls">
                                        <input type="text" value="" name="email"/>
<!--                                        <span class="help-inline">Associated help text!</span>-->
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
<!--                                <div class="control-group">

                                    <div class="controls">
                                        <label class="inlineCheckbox1" for="colors-1-toggle-1">Enable SMS Feature
                                            <input type="checkbox" checked="true" style="margin-left: 20px;" id="enableSMS" name="colors-1[]" value="" />
                                        </label>
                                    </div>
                                </div>-->

                                <legend>Parent - Personal Details</legend>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">First Name<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="" name="p_firstName"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Last Name</label>
                                    <div class="controls">
                                        <input type="text" value="" name="p_lastName"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Relation<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="" name="relation"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Phone</label>
                                    <div class="controls">
                                        <input type="text" value="" name="p_phone"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="inlineCheckbox1" for="colors-1-toggle-1">Same address  
                                            <input type="checkbox"  style="margin-left: 20px;" id="sameAddress" name="isSameAddress" />
                                        </label>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left ">Address<span class="required">*</span></label>
                                    <div class="controls">
                                        <textarea type="text" name="p_address" id="p_address" ></textarea>
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
