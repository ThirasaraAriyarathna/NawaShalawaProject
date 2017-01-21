<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/*
 |--------------------------------------------------------------------------
| LOAD LOGIN SCRIPTS
|--------------------------------------------------------------------------
|
|TODO:please consider Need to cache script files 
*/

$config['css-login-user']	= array('main.css','login.css'); // 'ui/jquery-ui-1.10.3.custom.min.css' array('html-elements.css','layout.css','form-elements.css','typography.css','ad-center.css','pop-up-dialog.css');
$config['css-login-user-ie'] = array();
$config['css-login-user-3rd'] = array('bootstrap/bootstrap.css','bootstrap/bootstrap.min.css','bootstrap/bootstrap-responsive.css','bootstrap/bootstrap-responsive.min.css');
$config['css-login-user-print'] = array();
$config['js-login-user']	= array();
$config['js-login-user-ie'] = array();
$config['js-login-user-scripts'] = array('login.js');
$config['js-login-user-3rd'] = array('jquery-1.7.2.min.js','bootstrap.js','jquery.validate1.11.js');
$config['js-login-user-external'] = array();

/*
 |--------------------------------------------------------------------------
| LOAD DASHBOARD SCRIPTS
|--------------------------------------------------------------------------
|
|TODO:please consider Need to cache script files 
*/

$config['css-dashboard']	= array('main.css','dashboard.css'); // 'ui/jquery-ui-1.10.3.custom.min.css' array('html-elements.css','layout.css','form-elements.css','typography.css','ad-center.css','pop-up-dialog.css');
$config['css-dashboard-ie'] = array();
$config['css-dashboard-3rd'] = array('bootstrap/bootstrap.css','bootstrap/bootstrap-responsive.min.css','bootstrap/font-awesome.min.css');
$config['css-dashboard-print'] = array();
$config['js-dashboard']	= array();
$config['js-dashboard-ie'] = array();
$config['js-dashboard-scripts'] = array();
$config['js-dashboard-3rd'] = array('jquery-1.7.2.min.js','bootstrap.js');
$config['js-dashboard-external'] = array();

/*
 |--------------------------------------------------------------------------
| LOAD STUDENT PAGE SCRIPTS
|--------------------------------------------------------------------------
|
|TODO:please consider Need to cache script files 
*/

$config['css-student']	= array('main.css','student.css'); // 'ui/jquery-ui-1.10.3.custom.min.css' array('html-elements.css','layout.css','form-elements.css','typography.css','ad-center.css','pop-up-dialog.css');
$config['css-student-ie'] = array();
$config['css-student-3rd'] = array('bootstrap/bootstrap.css','bootstrap/datepicker.css','bootstrap/font-awesome.min.css');
$config['css-student-print'] = array();
$config['js-student']	= array();
$config['js-student-ie'] = array();
$config['js-student-scripts'] = array('student.js');
$config['js-student-3rd'] = array('jquery-1.7.2.min.js','bootstrap.js','bootstrap-datepicker.js','jquery.validate1.11.js','bootstrap-typeahead.min.js');
$config['js-student-external'] = array();

/*
 |--------------------------------------------------------------------------
| LOAD SUBJECTS PAGE SCRIPTS
|--------------------------------------------------------------------------
|
|TODO:please consider Need to cache script files 
*/

$config['css-classes']	= array('main.css','classes.css'); // 'ui/jquery-ui-1.10.3.custom.min.css' array('html-elements.css','layout.css','form-elements.css','typography.css','ad-center.css','pop-up-dialog.css');
$config['css-classes-ie'] = array();
$config['css-classes-3rd'] = array('bootstrap/bootstrap3.min.css','bootstrap/font-awesome.min.css','bootstrap/bootstrap-datetimepicker.min.css','bootstrap/bootstrap-timepicker.min.css');
$config['css-classes-print'] = array();
$config['js-classes']	= array();
$config['js-classes-ie'] = array();
$config['js-classes-scripts'] = array('classes.js');
$config['js-classes-3rd'] = array('jquery.js','bootstrap3.min.js','bootstrap-datepicker.js','bootstrap-timepicker.js','jquery.validate.min.js','bootstrap-typeahead.min.js');
$config['js-classes-external'] = array();

/*
 |--------------------------------------------------------------------------
| LOAD TEACHER PAGE SCRIPTS
|--------------------------------------------------------------------------
|
|TODO:please consider Need to cache script files 
*/

$config['css-teacher']	= array('main.css','teacher.css'); // 'ui/jquery-ui-1.10.3.custom.min.css' array('html-elements.css','layout.css','form-elements.css','typography.css','ad-center.css','pop-up-dialog.css');
$config['css-teacher-ie'] = array();
$config['css-teacher-3rd'] = array('bootstrap/bootstrap.css','bootstrap/datepicker.css','bootstrap/font-awesome.min.css');
$config['css-teacher-print'] = array();
$config['js-teacher']	= array();
$config['js-teacher-ie'] = array();
$config['js-teacher-scripts'] = array('teacher.js');
$config['js-teacher-3rd'] = array('jquery-1.7.2.min.js','bootstrap.js','bootstrap-datepicker.js','jquery.validate1.11.js','bootstrap-typeahead.min.js');
$config['js-teacher-external'] = array();
/*
 |--------------------------------------------------------------------------
| LOAD ASSISTANT PAGE SCRIPTS
|--------------------------------------------------------------------------
|
|TODO:please consider Need to cache script files 
*/

$config['css-assistant']	= array('main.css','attendance.css'); // 'ui/jquery-ui-1.10.3.custom.min.css' array('html-elements.css','layout.css','form-elements.css','typography.css','ad-center.css','pop-up-dialog.css');
$config['css-assistant-ie'] = array();
$config['css-assistant-3rd'] = array('bootstrap/bootstrap3.min.css','bootstrap/font-awesome.min.css','bootstrap/bootstrap-datetimepicker.min.css','bootstrap/bootstrap-timepicker.min.css');
$config['css-assistant-print'] = array();
$config['js-assistant']	= array();
$config['js-assistant-ie'] = array();
$config['js-assistant-scripts'] = array('assistants.js');
$config['js-assistant-3rd'] = array('jquery.js','bootstrap3.min.js','bootstrap-datepicker.js','bootstrap-timepicker.js','jquery.validate.min.js','bootstrap-typeahead.min.js','jquery.blockUI.js');
$config['js-assistant-external'] = array();
/*
 |--------------------------------------------------------------------------
| LOAD SETTINGS PAGE SCRIPTS
|--------------------------------------------------------------------------
|
|TODO:please consider Need to cache script files 
*/

$config['css-settings']	= array('main.css'); // 'ui/jquery-ui-1.10.3.custom.min.css' array('html-elements.css','layout.css','form-elements.css','typography.css','ad-center.css','pop-up-dialog.css');
$config['css-settings-ie'] = array();
$config['css-settings-3rd'] = array('bootstrap/bootstrap3.min.css','bootstrap/font-awesome.min.css','bootstrap/bootstrap-datetimepicker.min.css','bootstrap/bootstrap-timepicker.min.css');
$config['css-settings-print'] = array();
$config['js-settings']	= array();
$config['js-settings-ie'] = array();
$config['js-settings-scripts'] = array();
$config['js-settings-3rd'] = array('jquery.js','bootstrap3.min.js','bootstrap-datepicker.js','bootstrap-timepicker.js','jquery.validate.min.js','bootstrap-typeahead.min.js','jquery.blockUI.js');
$config['js-settings-external'] = array();

/*
 |--------------------------------------------------------------------------
| LOAD Attendance PAGE SCRIPTS
|--------------------------------------------------------------------------
|
|TODO:please consider Need to cache script files 
*/

$config['css-attendance']	= array('main.css','attendance.css'); // 'ui/jquery-ui-1.10.3.custom.min.css' array('html-elements.css','layout.css','form-elements.css','typography.css','ad-center.css','pop-up-dialog.css');
$config['css-attendance-ie'] = array();
$config['css-attendance-3rd'] = array('bootstrap/bootstrap3.min.css','bootstrap/font-awesome.min.css','bootstrap/datepicker.css');
$config['css-attendance-print'] = array();
$config['js-attendance']	= array();
$config['js-attendance-ie'] = array();
$config['js-attendance-scripts'] = array('attendance.js');
$config['js-attendance-3rd'] = array('jquery.js','bootstrap3.min.js','bootstrap-datepicker.js','jquery.validate.min.js','bootstrap-typeahead.min.js');
$config['js-attendance-external'] = array();



/* End of file scriptfiles.php */
/* Location: ./application/config/scriptfiles.php */