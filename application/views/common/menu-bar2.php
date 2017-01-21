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