<!DOCTYPE html>
<html>
    <head>
        <title>Fedena</title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/datepicker.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dashboard.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/student.css" />
    </head>
    <body>
        <div id="wrapper" class="page_wrapper">
            <!-- start menu content-->
            <div class="menu_bar">
                <div class="row">
                    <div class="menu-title pull-left">
                        <label class="app_title " >Foradian School</label>
                    </div> 
                    <div class="sub-menus pull-right">
                        <label class="  pull-left"><i class="icon-user icon-white"></i>SUMESH</label>
                        <label class="pull-left"><i class="icon-off icon-white"></i>Log out</label>
                    </div>

                </div>

                <div class="row">
                    <div class="tabbable">
                        <ul id="menu-list" class="nav nav-tabs">
                            <li class="active"><a href="#">Dashboard</a></li>
                            <li><a href="#">Students</a></li>
                            <li class="dropdown ">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Attendance<b class="caret"></b></a>
                                <ul  class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                            <li class="dropdown ">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Settings<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                            <li class="dropdown ">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Time Table<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                            <li class="dropdown ">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">More<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end menu content-->
            <!-- start page content-->
            <div id="content_wrapper">
                <div id="content"> 
                    <div id="content-header" class="row">
                        <div class="span2 pull-left">
                             <img src="<?php echo base_url() ?>/assets/images/dashboard/news-icon.jpg" alt="Manage_news_logo" class="pull-left">
                        </div>
                        <ul class="unstyled pull-left">
                            <li><h1>Finance</h1></li>
                             <li><h3>Step - 1 Student details</h3></li>
                        </ul>
                       
                    </div>
                    
                    <div class="extender"></div>
                    <div class="div_divider" ></div>
                    <div class="extender"></div>
                    <div class="student_form">
                        <label style="font-weight: bold;">Fields marked with <span class="required">*</span> must be filled.</label>
                        <form action="" method="">
                            <fieldset>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Admission ID</label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Admission Date</label>
                                    <div class="controls">
                                        <input  type="text"  class="example1">
                                       <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <legend>Personal Details</legend>
                                <div class="control-group error">
                                    <label for="inputError" class="control-label input-lable pull-left">First Name<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <span class="help-inline">Please correct the error</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Surname<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Date of Birth<span class="required">*</span></label>
                                    <div class="controls">
                                        <input  type="text"  class="example1">
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Gender<span class="required">*</span></label>
                                    <div class="controls">
                                        <select >
                                            <option>Female</option>
                                            <option>Male</option>
                                        </select>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>


                                <legend>Contact Details</legend>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Address Line 1<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Address Line 2</label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">City<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">State</label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">PIN Code</label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Country</label>
                                    <div class="controls">
                                        <select >
                                            <option>India</option>
                                            <option>Sri Lanka</option>
                                        </select>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Phone<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Mobile</label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Email</label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <span class="help-inline">Associated help text!</span>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">

                                    <div class="controls">
                                        <label class="inlineCheckbox1" for="colors-1-toggle-1">Enable SMS Feature
                                            <input type="checkbox" checked="true" style="margin-left: 20px;" id="colors-1-toggle-1" name="colors-1[]" value="color_m" />
                                        </label>
                                    </div>
                                </div>

                                <legend>Parent - Personal Details</legend>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">First Name<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Last Name</label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputError" class="control-label input-lable pull-left">Relation<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <!--<span class="help-inline">Please correct the error</span>-->
                                    </div>
                                </div>
                                <div class="control-group error">
                                    <label for="inputError" class="control-label input-lable pull-left">Phone<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" value=""/>
                                        <span class="help-inline">Please enter valid data. </span>
                                    </div>
                                </div>
                                <div class="form-actions">
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
        <!-- start footer-->
        <footer class="footer">
            <div id="footer_logo">
                <div id="powered_by">

                </div>
            </div>
        </footer>
        <!-- end content-->

        <!-- Load jQuery and bootstrap datepicker scripts -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function() {

                $('.example1').datepicker({
                    format: "dd/mm/yyyy",
                    autoclose: true
                });

            });
        </script>
    </body>
</html>
