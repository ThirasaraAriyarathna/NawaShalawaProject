<!DOCTYPE html>
<html>
    <head>
        <title>Fedena</title>
<!--
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/datepicker.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dashboard.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/student.css" />
        
    -->
    <?php
    $css_path = $this->config->item('css_path');
    $js_path = $this->config->item('js_path');
    $css_3rd_path = $this->config->item('css_3rd');
    $js_script_path = $this->config->item('script');

    $scriptfiles = $this->session->userdata('scripts');

 
    if (!empty($scriptfiles['css_3rd'])) {
        foreach ($scriptfiles['css_3rd'] as $css_3rd) {
            ?>
            <link rel="stylesheet" href="<?php echo $css_3rd_path . $css_3rd ?>">
            <?php
        }
    }
       if (!empty($scriptfiles['css'])) {
        foreach ($scriptfiles['css'] as $css) {
            ?>
            <link rel="stylesheet" href="<?php echo $css_path . $css ?>">
            <?php
        }
    }
    $UserDetails = $this->session->userdata('login_data');
     
    ?>
    </head>
    <body>
        
       <div class="navbar navbar-properties navbar-fixed-top">
              <div class="navbar-inner">
                <div class="container">
                  <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a href="<?php echo base_url() ; ?>" class="brand">Fedena</a>
                  <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                        <li <?php if(isset($selected_menu) && $selected_menu == "dashboard") echo 'class="active"'; ?> ><a href="<?php echo base_url() ; ?>user/dashboard">Dashboard</a></li>
                        <li  class="dropdown <?php if(isset($selected_menu) && $selected_menu == "student") echo 'active'; ?> ">
                            <a href="<?php echo base_url() ; ?>students/index" data-toggle="dropdown" class="dropdown-toggle">Students<b class="caret"></b></a>
                            <ul  class="dropdown-menu">
                                <li><a href="<?php echo base_url() ; ?>students/add">Add Students</a></li>
                                <li><a href="<?php echo base_url() ; ?>students/search">Search Students</a></li>
                            </ul>
                        </li>
                        <li class="dropdown <?php if(isset($selected_menu) && $selected_menu == "teacher") echo 'active'; ?> ">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Teachers<b class="caret"></b></a>
                            <ul  class="dropdown-menu">
                                 <?php if($user_data['UserType']==1){ ?>
                                <li><a href="<?php echo base_url() ; ?>teachers/add">Add</a></li>
                                 <?php } ?>
                                <li><a href="<?php echo base_url() ; ?>teachers/search">Search</a></li>
                            </ul>
                        </li>
                        <?php if($user_data['UserType']==1){ ?>
                        <li class="dropdown <?php if(isset($selected_menu) && $selected_menu == "assistant") echo 'active'; ?>">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Assistants<b class="caret"></b></a>
                            <ul  class="dropdown-menu">
                                <li><a href="<?php echo base_url() ; ?>assistants/add">Add</a></li>
                                <li><a href="<?php echo base_url() ; ?>assistants/search">Search</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li <?php if(isset($selected_menu) && $selected_menu == "classes") echo 'class="active"'; ?> ><a href="<?php echo base_url() ; ?>classes/">Classes</a></li>
                        <li <?php if(isset($selected_menu) && $selected_menu == "attendance") echo 'class="active"'; ?> ><a href="<?php echo base_url() ; ?>classes/view">Attendance</a></li>
                      <li class="dropdown <?php if(isset($selected_menu) && $selected_menu == "settings") echo 'active'; ?>">
                            <a href="<?php echo base_url() ; ?>settings/change_password" >Settings</a>
                           
                        </li> 
                      
                    </ul>
                   
                    <ul class="nav pull-right">
                       <?php if($user_data['UserType']==2){ ?>
                        <li><a href="<?php  echo base_url() ; ?>assistants/details/<?php echo $UserDetails['AssistantId']; ?>"><i class="fa fa-user"> <?php echo $UserDetails['FirstName']; ?></i></a></li>
                        <?php }else{ ?>
                         <li><a href="javascript:void(0);"><i class="fa fa-user"> </i> <?php echo $UserDetails['FirstName']; ?></a></li>
                        <?php } ?>
                        <li><a href="<?php echo base_url(); ?>login/logout" class="pull-left"><i class="fa fa-power-off"> </i> Log out</a></li>
                    </ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div>
         <div  class="container">
         <div id="wrapper" class="page_wrapper">
      

                