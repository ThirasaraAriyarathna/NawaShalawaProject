<!--<html>
    <head> 
        <title>Fedena</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dashboard.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-responsive.min.css" />
    </head>

    <body>

        <div id="wrapper" class="page_wrapper">

            <div class="menu_bar">
                <div class="pull-left menu-level">
                    <div class="menu-title pull-left">
                        <label class="app_title " >Foradian School</label>
                    </div> 
                    <div class="sub-menus pull-right">
                        <a class=" profile-name-btn pull-right"><p>SUMESH</p></a>
                        <a class="logout-btn pull-right"><p>Log out</p></a>
                    </div>
                </div> -->
<?php include(APPPATH.'views/common/page-header.php'); ?>
<?php //include(APPPATH.'views/common/menu-bar.php') ?>  
    <!--            <div class="pull-left menu-level2">
                    <div class="left-menu pull-left">
                        <a class="dashboard-btn pull-left"><p>Dashboard</p></a>

                        <div class="more-detail dropdown open">
                            <a href="#" data-toggle="dropdown" role="button" id="drop4" class="dropdown-toggle">More <b class="caret"></b></a>
                            <ul aria-labelledby="drop4" role="menu" class="dropdown-menu" id="menu1">
                                <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Calendar</a></li>
                                <li role="presentation"><a href="#" tabindex="-1" role="menuitem">News</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="pull-right ">
                        <form class="navbar-search pull-left">
                            <input type="text" class="search-query search-area" placeholder="Search">
                        </form>
                    </div>

                </div>
            </div> -->
            <div id="content_wrapper">
                <div id="content"> 
<!--                    <div id="news_bar">

                        <div class="news_box first-news">
                            <h5 class="news-title"><a href="/news/view/208">Next Class</a></h5>
                            <small class="news-time">Chemistry</small>
                            <small class="comments-count"><a href="#">8.00 am</a></small>
                        </div>

                        <div class="news_box ">
                            <h5 class="news-title"><a href="/news/view/207">Next Exam</a></h5>
                            <small class="news-time">Physics</small>
                            <small class="comments-count"><a href="#">April  4</a></small>
                        </div>

                        <div class="news_box ">
                            <h5 class="news-title"><a href="/news/view/205">Results Release</a></h5>
                            <small class="news-time">Coming soon </small>
                            <small class="comments-count"><a href="#"></a></small>
                        </div>

                    </div>-->

                    <div id="user_options">

                        <div class="button-box left-button">
                            <a id="student_details_button" class="option_buttons"  href="<?php echo base_url() ; ?>students/add" nicetitle="Admission">
                                <div class="button-label"><p>Admission</p></div>
                            </a>
                        </div>
                        <div class="button-box">
                            <a id="manage_student_button" class="option_buttons"href="<?php echo base_url() ; ?>students/search" nicetitle="Manage Students"><div class="button-label"><p>Manage Students</p></div></a>
                        </div>
                        <div class="button-box">
                            <a id="mark_attendance_button" class="option_buttons"href="<?php echo base_url() ; ?>classes/view" nicetitle="Mark Attendance"><div class="button-label"><p>Mark Attendance</p></div></a>
                        </div>
                        <div class="button-box">
                            <a id="manage_class_button" class="option_buttons"href="<?php echo base_url() ; ?>classes/" nicetitle="Mark Attendance"><div class="button-label"><p>Manage Class</p></div></a>
                        </div>
                        
<!--                        <div class="button-box">
                            <a id="timetable_button" class="option_buttons" href="/timetable/student_view/9" nicetitle="Timetable management module  "><div class="button-label"><p>Timetable</p></div></a>
                        </div>
                        <div class="button-box">

                            <a id="reminders_button" class="option_buttons" href="/reminder" nicetitle="         Student messages"><div class="button-label"><p>Reminders</p></div></a>

                        </div>
                        <div class="button-box">
                            <a id="academic_button" class="option_buttons" href="/student/reports/9" nicetitle="         Academic  reports   "><div class="button-label"><p>Academics</p></div></a>
                        </div>-->




                    </div>

                    <div id="option_description"> </div>


                <div class="extender"></div>
            </div>
        </div>
    </div>
<?php include(APPPATH.'views/common/page-footer.php') ?> 
    <script type="text/javascript">
                        jQuery('#user_options .button-box').each(function(ele, index) {
                            if (index % 5 == 0) {
                                ele.addClassName("left-button");
                            }
                        });

                        $('.dropdown-toggle').dropdown()


                    </script> 
                    
        <!--  <div id="login_area_bg" class="login_area">
        
            
          <div id="help_forgot_pw">
        
          </div>
          <div class="clearfooter"></div>
        </div>-->
<!--
        <div id="footer">
            <div id="footer_logo">
                <div id="powered_by">

                </div>
            </div>
        </div>

        <script type="text/javascript">
            document.getElementById('user_username').focus();
        </script>

    </body>
</html>
-->
 
