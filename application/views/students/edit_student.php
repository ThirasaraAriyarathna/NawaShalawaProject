<?php include(APPPATH.'views/common/page-header.php') ?>
<?php // include(APPPATH.'views/common/menu-bar.php') ?>          
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
                             <img src="<?php echo base_url() ?>/assets/default/images/dashboard/add-student.png" alt="Manage_news_logo" class="pull-left">
                        </div>
                        <ul class="unstyled pull-left">
                            <li><h1>Edit Student</h1></li>
                             <li><h3>Step - 1 Student details</h3></li>
                        </ul>
                       
                    </div>
                    
                    <div class="extender"></div>
                    <div class="div_divider" ></div>
                    <div class="extender"></div>
                    <div class="student_form"> 
                        <label style="font-weight: bold;">Fields marked with <span class="required">*</span> must be filled.</label>
                        <form id="student-detail" action="<?php echo base_url(); ?>students/edit/<?php echo $details['StudentId'];?>" method="post" >
                            <fieldset>
                                <legend>Admission Details</legend>
                                <div class="control-group">
                                    <!--<label  class="control-label input-lable pull-left">Admission ID<span class="required">*</span></label>-->
                                    <div class="controls">
                                        <?php 
                                        $options=array();
                                            foreach($batches as $batch){
                                                $options[$batch['BatchId']]=$batch['Name'].'-'.$batch['Year'];
                                            } 
                                            echo form_dropdown('batches', $options, $details['BatchId'],'id="batches-dropdown"');
                                            ?>
                                        
                                     
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
                                        <input  type="text" value="<?php if(isset($details['DateAdded'])) echo date('m/d/Y',$details['DateAdded']); ?>"  class="example1" name="admissionDate">
                                       <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <legend>Personal Details</legend>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">First Name<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" autocomplete="off" value="<?php if(isset($details['FirstName'])) echo $details['FirstName']; ?>" name="firstName"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Last Name</label>
                                    <div class="controls">
                                        <input type="text" autocomplete="off" value="<?php if(isset($details['LastName'])) echo $details['LastName']; ?>" name="lastname"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Date of Birth<span class="required">*</span></label>
                                    <div class="controls">
                                        <input  type="text" name="DOB" value="<?php if(isset($details['DateOfBirth'])) echo date('m/d/Y',$details['DateOfBirth']); ?>" class="example1">
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Gender<span class="required">*</span></label>
                                    <div class="controls">
                                        <select name="gender" >
                                            <?php  if(isset($details['Gender']) && $details['Gender']==0 ){ ?>
                                                    <option value="0" selected="selected">Female</option>
                                                    <option value="1">Male</option>
                                        <?php    }elseif(isset($details['Gender']) && $details['Gender']==1){?>
                                                    <option value="0">Female</option>
                                                    <option value="1" selected="selected">Male</option>
                                        <?php    }else{  ?>
                                                    <option value="0">Female</option>
                                                    <option value="1">Male</option>
                                        <?php    }  ?>
                                           
                                        </select>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left" >District</label>
                                    <div class="controls">
                                        <!--<input type="text" autocomplete="off"  name="district" id="district" data-source="['Abc','CDE','Anjana','ISURA','Thilani']" />-->
                                        <input type="text" autocomplete="off" data-source="<?php echo $districts;?>"  name="district" data-items="4" data-provide="typeahead" value="<?php if(isset($details['District'])) echo $details['District']; ?>" style="margin: 0 auto;" class="span3 district">
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left" >School</label>
                                    <div class="controls">
                                        <input type="text" autocomplete="on" value="<?php if(isset($details['School'])) echo $details['School']; ?>" name="school" />
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>


                                <legend>Contact Details</legend>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Address Line 1<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" autocomplete="off" value="<?php if(isset($details['AddressLine1'])) echo $details['AddressLine1']; ?>" name="addressLine1" id="addressLine1"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Address Line 2</label>
                                    <div class="controls">
                                        <input type="text" autocomplete="off" value="<?php if(isset($details['AddressLine2'])) echo $details['AddressLine2']; ?>" name="addressLine2" id="addressLine2"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">City<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="<?php if(isset($details['City'])) echo $details['City']; ?>" name="city" id="city"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left" >State</label>
                                    <div class="controls">
                                        <!--<input type="text" value="" name="state"/>-->
                                        <input type="text" value="<?php if(isset($details['State'])) echo $details['State']; ?>" autocomplete="off" data-source="<?php echo $states;?>"  name="state" data-items="4" data-provide="typeahead" style="margin: 0 auto;" class="span3 state">

                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                    <!--       <div class="control-group">
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
                                </div> -->
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Phone</label>
                                    <div class="controls">
                                        <input type="text" autocomplete="off" value="<?php if(isset($details['Phone'])) echo $details['Phone']; ?>" name="phone" id="phone"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Mobile</label>
                                    <div class="controls">
                                        <input type="text" autocomplete="off" value="<?php if(isset($details['Mobile'])) echo $details['Mobile']; ?>" name="mobile" id="mobile"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Email</label>
                                    <div class="controls">
                                        <input autocomplete="off" type="text" value="<?php if(isset($details['Email'])) echo $details['Email']; ?>" name="email"/>
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
                                        <input autocomplete="off" type="text" value="<?php if(isset($details['ParentFirstName'])) echo $details['ParentFirstName']; ?>" name="p_firstName"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Last Name</label>
                                    <div class="controls">
                                        <input autocomplete="off" type="text" value="<?php if(isset($details['ParentLastName'])) echo $details['ParentLastName']; ?>" name="p_lastName"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Relation<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="<?php if(isset($details['Relation'])) echo $details['Relation']; ?>" name="relation"/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label input-lable pull-left">Phone</label>
                                    <div class="controls">
                                        <input autocomplete="off" type="text" value="<?php if(isset($details['ParentPhone'])) echo $details['ParentPhone']; ?>" name="p_phone"/>
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
                                        <textarea type="text" name="p_address" id="p_address" ><?php if(isset($details['ParentAddress'])) echo $details['ParentAddress']; ?></textarea>
                                    </div>
                                </div>
                                <legend>Acadamic Details</legend>
                               
                                <div id='class_detail_container' class="control-group">
                                        <?php if(isset($details['classes']) && count($details['classes'])>0){
                                            foreach($details['classes'] as $class){ ?>
                                              <div class="alert alert alert-block alert-success class_group_container">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <input type="hidden" name='class_id[]' value="<?php echo $class['ClassId']; ?>" />
                                                <strong><?php echo $class['ClassName'].'-'.$class['FirstName'].' '.$class['LastName'] ; ?></strong> 
                                                <p>
                                                <label  class="control-label input-lable pull-left ">Fees rate</label>
                                                <select name="class_fees[<?php echo $class['ClassId']; ?>]"  <?php if($user_data['UserType']!=1){ ?>  disabled="disabled" <?php } ?> >
                                                    <?php
                                                    if($class['FeesRate']==1){ ?>
                                                    <option selected="selected" value="1">1</option>
                                                    <option value="0">0</option>
                                                    <option value="0.5">1/2</option>
                                                    <option value="0.75">3/4</option>
                                                   <?php }
                                                    elseif($class['FeesRate']==0){ ?>
                                                         <option  value="1">1</option>
                                                    <option selected="selected" value="0">0</option>
                                                    <option value="0.5">1/2</option>
                                                    <option value="0.75">3/4</option>
                                                   <?php }
                                                    elseif($class['FeesRate']==0.5){ ?>
                                                        <option  value="1">1</option>
                                                    <option  value="0">0</option>
                                                    <option selected="selected" value="0.5">1/2</option>
                                                    <option value="0.75">3/4</option>
                                                   <?php }
                                                    elseif($class['FeesRate']==0.75){ ?>
                                                        <option  value="1">1</option>
                                                    <option  value="0">0</option>
                                                    <option  value="0.5">1/2</option>
                                                    <option selected="selected" value="0.75">3/4</option>
                                                   <?php }
                                                    ?>
                                                   
                                                </select>
                                                </p>
                                                <?php if(isset($class['groups']) && count($class['groups'])>0){ ?>
                                                <div class="clear-fix margin-top-10">
                                                    <?php foreach ($class['groups'] as $group){ ?>

                                                    <div class="alert alert-info span3">
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                        <?php echo substr($group['DayOfWeek'], 0,3). ' ( '.  date('h:i A',$group['StartTime']).'-'.date('h:i A',$group['EndTime']).' )'  ?>
                                                        <p><small><?php echo $group['Description'];?></small></p>
                                                        <input type="hidden" name='class_groups[<?php echo $class['ClassId']; ?>][]' value="<?php echo $group['ClassGroupId'];?>" />
                                                    </div>
                                                   <?php } ?>

                                                </div>
                                                <?php } ?>
                                            </div>
                                            <?php  
                                            }
                                        } ?>
                                </div>
                                 <div class="control-group">
                                    <label  class="control-label input-lable pull-left ">Classes<span class="required">*</span></label>
                                    <div class="controls">
                                         <input type="text" autocomplete="off" name="class_detail" class="form-control input-flat typeahead" id="class_list" placeholder="Class">
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
