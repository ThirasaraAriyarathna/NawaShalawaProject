<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My Calendar</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/colorbox.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dashboard.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/calandar.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-responsive.min.css" />
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.colorbox-min.js"></script>
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
                </div>
                <div class="pull-left menu-level2">
                    <div class="left-menu pull-left">
                        <a class="dashboard-btn pull-left"><p>Dashboard</p></a>

                        <div class="more-detail dropdown ">
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
            </div>
            <div id="content_wrapper">
                <div id="content"> 
                    <div class="col-left pull-left">
                        <div class="calander">
                            <div class="pull-left " id="calendar-legend">
                                <div class="legend-entry pull-left">
                                    <div class="legend-symbol"> <div class="legend-icon pull-left" style='background:#000000;'></div></div>
                                    <div class="legend-text">Events</div>
                                </div>
                                <div class="legend-entry pull-left">
                                    <div class="legend-symbol"> <div class="legend-icon pull-left" style='background:#0C6C92;'></div></div>
                                    <div class="legend-text">Examinations</div>
                                </div>
                                <div class="legend-entry pull-left">
                                    <div class="legend-symbol"> <div class="legend-icon pull-left" style='background:#00b400;'></div></div>
                                    <div class="legend-text">Holidays</div>
                                </div>
                                <div class="legend-entry pull-left">
                                    <div class="legend-symbol"> <div class="legend-icon pull-left" style='background:#b40000;'></div></div>
                                    <div class="legend-text">Dues</div>
                                </div>
                            </div>
                            <div align="center">
		<?php echo $notes?>
		<span> </span>
	</div>
                           
                            
                            
                        </div>
                    </div>
                    <div class="col-right pull-right">
<!--                        calander events-->
                    </div>
                </div>
                <div class="extender"></div>
            </div>
        </div>
	<br/>
    
	<script>
	$(function(){
		$(".act_note").colorbox({ 
				overlayClose: false,
				data:{year:<?php echo $year;?>,mon:<?php echo $mon;?>}
		});
	});
</script>
<div id="footer" class="pull-left">
            <div id="footer_logo">
                <div id="powered_by">

                </div>
            </div>
        </div>
</body>
</html>