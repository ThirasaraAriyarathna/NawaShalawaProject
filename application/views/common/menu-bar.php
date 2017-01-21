<div class="row">
                    <div class="tabbable">
                        <ul id="menu-list" class="nav nav-tabs">
                            <li <?php if(isset($selected_menu) && $selected_menu == "dashboard") echo 'class="active"'; ?> ><a href="<?php echo base_url() ; ?>user/dashboard">Dashboard</a></li>
<!--                            <li  ><a href="<?php echo base_url() ; ?>students/index">Students</a></li>-->
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
                                     <?php }?>
                                    <li><a href="<?php echo base_url() ; ?>teachers/search">Search</a></li>
                                </ul>
                            </li>
                            <?php if($user_data['UserType']==1){ ?>
                            <li class="dropdown ">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Assistants<b class="caret"></b></a>
                                <ul  class="dropdown-menu">
                                    <li><a href="<?php echo base_url() ; ?>assistants/add">Add</a></li>
                                    <li><a href="<?php echo base_url() ; ?>assistants/search">Search</a></li>
                                </ul>
                            </li>
                            <?php }?>
                            <li <?php if(isset($selected_menu) && $selected_menu == "classes") echo 'class="active"'; ?> ><a href="<?php echo base_url() ; ?>classes/">Classes</a></li>
                        <li <?php if(isset($selected_menu) && $selected_menu == "attendance") echo 'class="active"'; ?> ><a href="<?php echo base_url() ; ?>classes/view">Attendance</a></li>
                            
                            
                        </ul>
                    </div>
                </div>
            </div>
              <!-- end menu content-->