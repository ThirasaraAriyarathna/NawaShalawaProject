<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class StudentLib {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    protected $CI;
    private $loginUser;
                function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->helper(array('form', 'url'));
        $this->CI->load->library('form_validation');
        $this->CI->load->library('login/loginlib');
        $this->CI->load->model('students/studentmodel');
        $this->CI->load->model('class/classmodel');
        $this->CI->load->helper('cookie');
        $this->loginUser = $this->CI->session->userdata('login_data');
    }

    public function valid_batch($value) {
       // var_dump('value');
        if ($value > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add() {
        

        $studentDetail = array();
        $userDetail = array();
        $data = array();
        if ($this->CI->loginlib->logged_in()) {
            $this->CI->form_validation->set_rules('batches', 'Batch', 'trim|xss_clean|valid_batch');
            $this->CI->form_validation->set_rules('firstName', 'First Name', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('admissionDate', 'Admission Date', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('DOB', 'Date of Birth', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('addressLine1', 'Address Line 1', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('email', 'Email', 'valid_email|xss_clean');
            $this->CI->form_validation->set_rules('relation', 'Relation', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('p_firstName', "Parent's First Name", 'trim|required|xss_clean');
            if ($this->CI->input->post('p_address')) {
                $this->CI->form_validation->set_rules('p_address', "Parent's Address", 'trim|required|xss_clean');
            }
            if ($this->CI->form_validation->run()) {
                $dateAdded=strtotime($this->CI->input->post('admissionDate', true));
                $userDetail['DateAdded'] = $dateAdded;

                $batchId = $this->CI->input->post('batches', true);
                $studentDetail['AdmissionID'] = $this->CI->input->post('admissionID', true);

                $studentDetail['FirstName'] = $this->CI->input->post('firstName', true);

                $studentDetail['LastName'] = $this->CI->input->post('lastname', true);
                $studentDetail['DateOfBirth'] = strtotime($this->CI->input->post('DOB', true));
                $studentDetail['Gender'] = (int)$this->CI->input->post('gender', true);
                $studentDetail['District'] = $this->CI->input->post('district', true);
                $studentDetail['AddressLine1'] = $this->CI->input->post('addressLine1', true);
                $studentDetail['AddressLine2'] = $this->CI->input->post('addressLine2', true);
                $studentDetail['City'] = $this->CI->input->post('city', true);
                $studentDetail['School'] = $this->CI->input->post('school', true);
                $studentDetail['State'] = $this->CI->input->post('state', true);
                $studentDetail['Phone'] = $this->CI->input->post('phone', true);
                $studentDetail['Mobile'] = $this->CI->input->post('mobile', true);
                $studentDetail['BatchId'] = $batchId;
                $studentDetail['Email'] = $this->CI->input->post('email', true);
                $studentDetail['ParentFirstName'] = $this->CI->input->post('p_firstName', true);
                $studentDetail['ParentLastName'] = $this->CI->input->post('p_lastName', true);
                $studentDetail['Relation'] = $this->CI->input->post('relation', true);
                $studentDetail['ParentPhone'] = $this->CI->input->post('p_phone', true);
            
                $isSameAddress = $this->CI->input->post('isSameAddress', true);
                if ($this->CI->input->post('p_address')) {
                    $studentDetail['ParentAddress'] = $this->CI->input->post('p_address', true);
                } else {
                    $address = array();
                    array_push($address, $studentDetail['AddressLine1']);
                    if (!empty($studentDetail['AddressLine2']))
                        array_push($address, $studentDetail['AddressLine2']);
                    array_push($address, $studentDetail['City']);

                    $studentDetail['ParentAddress'] = implode(",", $address);
                }

                if($this->CI->input->post('class_id') && ($this->loginUser['UserType']!=1 || $this->CI->input->post('class_fees'))){
                    $class_fees=$this->CI->input->post('class_fees');
                    $class_groups=$this->CI->input->post('class_groups');
                    $i=0;$j=0;
                    foreach($this->CI->input->post('class_id') as $class){
                        $studentDetail['classStudent'][$i]['ClassId']=$class;
                        $studentDetail['classStudent'][$i]['FeesRate']=($this->loginUser['UserType']==1)?$class_fees[$class]:1;
                        $studentDetail['classStudent'][$i]['StudentId']='';
                        $studentDetail['classStudent'][$i]['RegDate']=$dateAdded;
                        $i++;
                        
                        foreach ($class_groups[$class] as $grp){
                            $studentDetail['groupStudent'][$j]['ClassGroupId']=$grp;
                            $studentDetail['groupStudent'][$j]['StudentId']='';
                            $studentDetail['groupStudent'][$j]['RegDate']=$dateAdded;
                            $j++;
                        }
                    }
                }
                $user = $this->CI->loginlib->register("pa55word", 4, $userDetail['DateAdded'], $this->loginUser['UserId']);

                
                if ($user) {

                    $studentDetail['UserId'] = $user;
                   
                    $sID = $this->CI->studentmodel->addStudent($batchId, $studentDetail);
                   
                    if ($sID) {
                        $data['messages'] = "You successfully added.";
                        $data['messages_type'] = "success";
                    } else {
                        $data['messages'] = "Please try again.";
                        $data['messages_type'] = "error";
                    }
                } else {
                    $data['messages'] = "Please try again.";
                    $data['messages_type'] = "error";
                }
                // save data to db
            } else {
                //if($this->CI->form_validation->error())
                // {

                $data['messages'] = validation_errors();
                $data['messages_type'] = "error";
                
                //}
            }
        } else {
             redirect('');
        }
       
        return $data;
    }
    public function edit($studentId) {
        

        $studentDetail = array();
        $userDetail = array();
        $data = array();
        if ($this->CI->loginlib->logged_in()) {
            $this->CI->form_validation->set_rules('batches', 'Batch', 'trim|xss_clean|valid_batch');
            $this->CI->form_validation->set_rules('firstName', 'First Name', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('admissionDate', 'Admission Date', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('DOB', 'Date of Birth', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('addressLine1', 'Address Line 1', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean');
            $this->CI->form_validation->set_rules('relation', 'Relation', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('p_firstName', "Parent's First Name", 'trim|required|xss_clean');
            if ($this->CI->input->post('p_address')) {
                $this->CI->form_validation->set_rules('p_address', "Parent's Address", 'trim|required|xss_clean');
            }
            if ($this->CI->form_validation->run()) {
                $dateAdded=strtotime($this->CI->input->post('admissionDate', true));
                $userDetail['DateAdded'] = $dateAdded;

                $batchId = $this->CI->input->post('batches', true);

                $studentDetail['FirstName'] = $this->CI->input->post('firstName', true);

                $studentDetail['LastName'] = $this->CI->input->post('lastname', true);
                $studentDetail['DateOfBirth'] = strtotime($this->CI->input->post('DOB', true));
                $studentDetail['Gender'] = (int)$this->CI->input->post('gender', true);
                $studentDetail['District'] = $this->CI->input->post('district', true);
                $studentDetail['AddressLine1'] = $this->CI->input->post('addressLine1', true);
                $studentDetail['AddressLine2'] = $this->CI->input->post('addressLine2', true);
                $studentDetail['City'] = $this->CI->input->post('city', true);
                $studentDetail['School'] = $this->CI->input->post('school', true);
                $studentDetail['State'] = $this->CI->input->post('state', true);
                $studentDetail['Phone'] = $this->CI->input->post('phone', true);
                $studentDetail['Mobile'] = $this->CI->input->post('mobile', true);
                $studentDetail['BatchId'] = $batchId;
                $studentDetail['Email'] = $this->CI->input->post('email', true);
                $studentDetail['ParentFirstName'] = $this->CI->input->post('p_firstName', true);
                $studentDetail['ParentLastName'] = $this->CI->input->post('p_lastName', true);
                $studentDetail['Relation'] = $this->CI->input->post('relation', true);
                $studentDetail['ParentPhone'] = $this->CI->input->post('p_phone', true);
            
                $isSameAddress = $this->CI->input->post('isSameAddress', true);
                if ($this->CI->input->post('p_address')) {
                    $studentDetail['ParentAddress'] = $this->CI->input->post('p_address', true);
                } else {
                    $address = array();
                    array_push($address, $studentDetail['AddressLine1']);
                    if (!empty($studentDetail['AddressLine2']))
                        array_push($address, $studentDetail['AddressLine2']);
                    array_push($address, $studentDetail['City']);

                    $studentDetail['ParentAddress'] = implode(",", $address);
                }

                $classstudents= $this->CI->studentmodel->getClassStudentDetailByID($studentId);
                               
                $class_array=array();
                $groupstudents= $this->CI->studentmodel->getGroupStudentDetailByID($studentId);
                 $group_array=array();
                 
                if($classstudents){
                    foreach ($classstudents as $cs){
                        array_push($class_array, $cs['ClassId']);
                    }
                }
                if($groupstudents){
                    foreach ($groupstudents as $gs){
                        array_push($group_array, $gs['ClassGroupId']);
                    }
                }
                if($this->CI->input->post('class_id') && ($this->loginUser['UserType']!=1 || $this->CI->input->post('class_fees'))){
                    $class_fees=$this->CI->input->post('class_fees');
                    $class_groups=$this->CI->input->post('class_groups');
                    $i=0;$j=0;
                   
                    foreach($this->CI->input->post('class_id') as $class){                        
                        if(!in_array($class, $class_array)){
                            $studentDetail['classStudent'][$i]['ClassId']=$class;
                            $studentDetail['classStudent'][$i]['FeesRate']=($this->loginUser['UserType']==1)?$class_fees[$class]:1;
                            $studentDetail['classStudent'][$i]['StudentId']=$studentId;
                            $studentDetail['classStudent'][$i]['RegDate']=$dateAdded;
                            $i++;
                        }
                        else{
                            $ind=array_search($class,$class_array);
                            unset($class_array[$ind]);
                            if($this->loginUser['UserType']==1){
                                $studentDetail['up_classStudent'][]=array('ClassId'=>$class,'FeesRate'=>$class_fees[$class]);
                            }
                        }
                        foreach ($class_groups[$class] as $grp){
                            if(!in_array($grp, $group_array)){
                                $studentDetail['groupStudent'][$j]['ClassGroupId']=$grp;
                                $studentDetail['groupStudent'][$j]['StudentId']=$studentId;
                                $studentDetail['groupStudent'][$j]['RegDate']=$dateAdded;
                                $j++;
                            }
                            else{
                                $gnd=array_search($grp,$group_array);
                                unset($group_array[$gnd]);
                            }
                        }
                    }
                   
                }
                if(!empty($class_array)){
                  foreach($class_array as $class){
                      $studentDetail['up_classStudent'][]=array('ClassId'=>$class,'IsActive'=>0);
                  }  
                }
                if(!empty($group_array)){
                    $j=0;
                  foreach($group_array as $grp){
                      $studentDetail['up_groupStudent'][$j]['ClassGroupId']=$grp;
                      $studentDetail['up_groupStudent'][$j]['IsActive']=0;
                      $j++;
                  }  
                }
             //   print_r($studentDetail);die;
//print_r($studentDetail);die;
                    $result = $this->CI->studentmodel->updateStudent($studentId, $studentDetail);
                   
                    if ($result) {
                        $data['messages'] = "You successfully updated.";
                        $data['messages_type'] = "success";
                    } else {
                        $data['messages'] = "Please try again.";
                        $data['messages_type'] = "error";
                    }
               
                // save data to db
            } else {
                //if($this->CI->form_validation->error())
                // {

                $data['messages'] = validation_errors();
                $data['messages_type'] = "error";
                //}
            }
        } else {
             redirect('students/edit/'.$studentId);
        }
       
        return $data;
    }

    function selectBatches() {
        return $this->CI->studentmodel->selectBatches();
    }

    function autoSuggestDistrict() {
        $term = $this->CI->input->post('term', true);
        // die($term);
        $districts = $this->CI->studentmodel->autoSuggestDistrict($term);
        $data = array();
        foreach ($districts as $district) {
            array_push($data, $district['DistrictName']);
        }
        return $data;
    }

    function autoSuggestStates() {

        $states = $this->CI->studentmodel->autoSuggestStates();
        $data = array();
        foreach ($states as $state) {
            array_push($data, $state['ProvinceName']);
        }
        return $data;
    }

    function searchStudent($flag) {
        $searchTerm = $this->CI->input->post('term');
        $this->CI->form_validation->set_rules('term', 'Search Term', 'trim|required|xss_clean');

        $response = array("status" => "error", "html" => "", "msg" => "");
        
        $result = $this->CI->studentmodel->searchStudentByAdmissionId($searchTerm);
        

        if ($this->CI->form_validation->run()) {
            if ($result) {
                if($flag==1){
                    $response['html'] = $this->CI->load->view('classes/search_partial_view', array('search_results' => $result), true);
                }
                else{
                    $response['html'] = $this->CI->load->view('students/search_partial_view', array('search_results' => $result), true);
                }
            }
        } else {
            $response['msg'] = validation_errors();
        }
        echo json_encode($response);
        exit;
    }
    function viewFullStudent() {
        date_default_timezone_set('UTC');
        $searchTerm = $this->CI->input->post('term');
        $classID = $this->CI->input->post('classId');
        $classDateID = $this->CI->input->post('classDateId');
        $this->CI->form_validation->set_rules('term', 'Search Term', 'trim|required|xss_clean');

        $response = array("status" => "error", "html" => "", "msg" => "",'count'=>0);
    
        if ($this->CI->form_validation->run()) {
            $details=$this->CI->classmodel->getAllDetailsClassDatesByCondition(array('cd.ClassDateId'=>$classDateID));     
            $today_group=explode(',',$details[0]['ClassGroupId']);
           // print_r($details);die;
            $current_month = date('m');
            $date='';
            $month = $current_month-3;
            if($month<0){
                $month=$month+12;
                $date=  strtotime((date('Y')-1).'-'.$month.'-01 00:00')-$this->CI->config->item('time_zone_offset');
            }
            else{
                $date=  strtotime((date('Y')).'-'.$month.'-01 00:00')-$this->CI->config->item('time_zone_offset');
            }
            $class_dates_array=array();
           
            $result = $this->CI->studentmodel->viewFullDetailStudentByAdmissionId($searchTerm,$classID,$date);
           
            if ($result['results'] && count($result['results'])==1) {
                $response['count']=count($result['results']);
                $classStudentId=$result['results'][0]['ClassStudentId'];
                $atendance_dates = $this->CI->classmodel->getAttendanceByCondition(array('a.ClassStudentId'=>$classStudentId,'a.Time >= '=>$date)); 
                $atendance_dates_array=array();
                if($atendance_dates){
                    date_default_timezone_set($this->CI->config->item("time_zone"));
                    $firstClassDAteId=$atendance_dates[0]['ClassDateId'];
                    foreach ($atendance_dates as $att_date){
                        $atendance_dates_array[date('m',$att_date['Time'])][date('d',$att_date['Time'])][]=$att_date['Time'];
                    }
                }
                else{
                    $firstClassDAteId=$classDateID;
                }
                $result['results'][0]['AttendanceDate']=$atendance_dates_array;
                //print_r($result);die;
                $where =array(
                    'cd.Date >= '=>$date,
                    'cd.ClassId'=>$classID,
                    'cd.ClassDateId >= '=>$firstClassDAteId
                );
                $class_held_dates = $this->CI->classmodel->getClassDatesByCondition($where);          
                $class_held_dates=  array_reverse($class_held_dates);

                if(isset($class_held_dates[0]['Date'])){
                    foreach ($class_held_dates as $class_held_date){
                        $class_dates_array[date('m',$class_held_date['Date'])][]= $class_held_date['Date'];
                    }
                    date_default_timezone_set('UTC');
                }
                
                $class_group_days=  explode(',',$result['results'][0]['ClassGroupDays']);    
                
                $activity_group=  explode(',',$result['results'][0]['IsActiveClassGroups']);  
                $clsgroups=  explode(',',$result['results'][0]['ClassGroups']);  
                
                $current_days=array();
                $date_order=array('first','second','third','fourth','fifth');
                if(is_array($class_group_days) && count($class_group_days)>0){
                    foreach ($class_group_days as $group_day){
                        for($d=0;$d<count($date_order);$d++){
                            $newDate=strtotime($date_order[$d].' '.  strtolower($group_day).' of this month')-$this->CI->config->item('time_zone_offset');
                            if(!in_array($newDate, $current_days) && date('d')<date('d',$newDate) && date('m')==date('m',$newDate)){
                                $class_dates_array[date('m')][]=$newDate;
                            }
                        }
                    }
                }
                
                $class_grs = $this->CI->classmodel->getClassGroupsArrayByCondition($clsgroups);
                
                $result['results'][0]['classGroupDetails']=$class_grs;
                //sort($class_dates_array);
                $result['results'][0]['class_dates']=$class_dates_array;
                $result['results'][0]['isactive_student']=0;
                foreach ($today_group as $g){
                    if(in_array($g,$clsgroups)){
                        $result['results'][0]['isactive_student']=1;
                    }
                }
               
                if(!empty($result['results'][0]['presentDays']))
                    $present_days=  explode(',',$result['results'][0]['presentDays']);     
                else {
                    $present_days=array();
                }
                rsort($present_days);
                $result['results'][0]['present_dates']=$present_days;
                $fees_array=array();
                $feesid_array=array();
                $classFees=$this->CI->studentmodel->getStudentClassFeesByCondition($classStudentId,$date,array('cf.ClassId'=>$classID));
                foreach($classFees as $cf){
                    if(isset($cf['ClassFeeId']))
                    $fees_array[$cf['Month']]=$cf['Month'];
                    $feesid_array[$cf['Month']]=$cf['ClassFees'];
                }
               
                $result['results'][0]['FeesDates']=$fees_array;
                $result['results'][0]['ClassFeesId']=$feesid_array;
                $class_fees = $this->CI->classmodel->getClassFeesByCondition(array('cf.ClassId'=>$result['results'][0]['ClassId'],'cf.DueDate >= '=>$date)); 
                //print_r($class_fees);die;
                $classfees_array=array();
                 if($class_fees && count($class_fees)){
                    
                    foreach ($class_fees as $fee){
                        $classfees_array[$fee['Month']]=$fee['Amount'];
                    }
                }
                $result['results'][0]['ClassFees']=$classfees_array;
                $result['results'][0]['ClassDateID']=$classDateID;
               // print_r($result['results'][0]);die;
                $response['status']="success";
                $response['html'] = $this->CI->load->view('attendance/student_detail_patial_view', array('student_details' => $result), true);
            }
            else{
                $response['status']="success";
                $response['count']=count($result['results']);
                 $response['html'] = $this->CI->load->view('attendance/search_partial_view', array('search_results' => $result), true);
            }
        } else {
            $response['msg'] = validation_errors();
        }
        echo json_encode($response);
        exit;
    }

    function getStudentDetail() {
        $studentId = $this->CI->input->post('studentId');
        $response = array("status" => "error", "html" => "", "msg" => "");
        if ($studentId) {
            $result= $this->getStudentById($studentId);
            $response['html'] = $this->CI->load->view('students/details', array('details' => $result), true);
        }
        echo json_encode($response);
        exit;
    }
    function getStudentById($studentId) {
        
        $result= $this->CI->studentmodel->getStudentDetailByID($studentId);
        if(!$result){
            show_404();
        }
        $classstudents= $this->CI->studentmodel->getClassStudentDetailByID($studentId);
        if($classstudents){
            foreach ($classstudents as $cs){
                $result['classes'][$cs['ClassId']]=$cs;
            }
        }
        $groupstudents= $this->CI->studentmodel->getGroupStudentDetailByID($studentId);
        if($groupstudents){
            foreach ($groupstudents as $gs){
                $result['classes'][$gs['ClassId']]['groups'][]=$gs;
            }
        }
        return $result;
    }
    
    public function mergeStudentByClass($classId){
        $this->CI->form_validation->set_rules('selectclassId', 'From Class', 'trim|required|numeric|xss_clean');
        $this->CI->form_validation->set_rules('from_group', 'From Group', 'trim|required|numeric|xss_clean');
        $this->CI->form_validation->set_rules('to_group', 'To Group', 'trim|required|numeric|xss_clean');
        if ($this->CI->form_validation->run()) {
            $from_classId=$this->CI->input->post('selectclassId',TRUE);
            $from_groupId=$this->CI->input->post('from_group',TRUE);
            $to_groupId=$this->CI->input->post('to_group',TRUE);
            
            $from_classStudents= $this->CI->studentmodel->getStudentByFilters(intval($from_classId)); 
            $from_groupStudents= $this->CI->studentmodel->getStudentByFilters(NULL,intval($from_groupId));
            $currentStudents= $this->CI->studentmodel->getStudentByFilters(intval($classId));
            $currentGroupStudents= $this->CI->studentmodel->getStudentByFilters(NULL,intval($to_groupId));
            foreach ($from_classStudents as $s=>$student){
                if(in_array($student,$currentStudents)){
                    unset($from_classStudents[$s]);
                }
            }
            $resultsclass_students= $from_classStudents;
            foreach ($from_groupStudents as $s=>$student){
                if(in_array($student,$currentGroupStudents)){
                    unset($from_groupStudents[$s]);
                }
            }
            $results_group_students= $from_groupStudents;
            
            if($results_group_students && count($results_group_students)>0){
                
               array_walk($resultsclass_students, function (&$item, $key,$classId){
                    $item['ClassId'] =intval($classId);
                    $item['RegDate'] = time();
               },$classId);
               
               array_walk($results_group_students, function(&$item, $key,$to_groupId) {
                    $item['ClassGroupId']=intval($to_groupId);
                    $item['RegDate'] = time();
               },$to_groupId);
             
               $result=$this->CI->studentmodel->mergeStudentByClass($resultsclass_students,$results_group_students); 
               if($result){
                   $this->CI->session->set_flashdata('message-success','Students are asigned successfully.');
               }
               else{
                   $this->CI->session->set_flashdata('message-error','Students are asigning failed.');
               }
            }
            else{
                $this->CI->session->set_flashdata('message-info','All students are already asigned.');
            }
         
        }
        else{
            $this->CI->session->set_flashdata('message-error',validation_errors());
        }
        redirect('classes/profile/'.$classId);
       
    }
    
    public function mergeStudentByGroup($classId){
        $this->CI->form_validation->set_rules('Fromgroup', 'From Group', 'trim|required|numeric|xss_clean');
        $this->CI->form_validation->set_rules('Togroup', 'To Group', 'trim|required|numeric|xss_clean');
        if ($this->CI->form_validation->run()) {
            $from_groupId=$this->CI->input->post('Fromgroup',TRUE);
            $to_groupId=$this->CI->input->post('Togroup',TRUE);
            
            $from_groupStudents= $this->CI->studentmodel->getStudentByFilters(NULL,intval($from_groupId));
            $currentGroupStudents= $this->CI->studentmodel->getStudentByFilters(NULL,intval($to_groupId));

             foreach ($from_groupStudents as $s=>$student){
                if(in_array($student,$currentGroupStudents)){
                    unset($from_groupStudents[$s]);
                }
            }
            $results_group_students=$from_groupStudents;
            if($results_group_students && count($results_group_students)>0){
             
               array_walk($results_group_students, function(&$item, $key,$to_groupId) {
                    $item['ClassGroupId']=intval($to_groupId);
                    $item['RegDate'] = time();
               },$to_groupId);
               
               $result=$this->CI->studentmodel->mergeStudentByGroup($results_group_students); 
               if($result){
                   $this->CI->session->set_flashdata('message-success','Students are asigned successfully.');
               }
               else{
                   $this->CI->session->set_flashdata('message-error','Students are asigning failed.');
               }
            }
            else{
                $this->CI->session->set_flashdata('message-info','All students are already asigned.');
            }
         
        }
        else{
            $this->CI->session->set_flashdata('message-error',validation_errors());
        }
        redirect('classes/profile/'.$classId);
       
    }
    public function assignStudentByGroup($classId){
        $this->CI->form_validation->set_rules('Togroup', 'To Group', 'trim|required|numeric|xss_clean');
        $this->CI->form_validation->set_rules('studentId', 'Student Id', 'trim|required|numeric|xss_clean');
        if ($this->CI->form_validation->run()) {

            $to_groupId = $this->CI->input->post('Togroup', TRUE);
            $student_id = $this->CI->input->post('studentId', TRUE);
            $currentClassStudents = $this->CI->studentmodel->getStudentByFilters(intval($classId), NULL, intval($student_id));
            $classStudent = array();
            if (!$currentClassStudents) {
                $classStudent = array(
                    'ClassId' => intval($classId),
                    'StudentId' => intval($student_id),
                    'RegDate' => time()
                );
            }
            $currentGroupStudents = $this->CI->studentmodel->getStudentByFilters(NULL, intval($to_groupId), intval($student_id));
            $groupStudent = array();
            if (!$currentGroupStudents) {
                $groupStudent = array(
                    'ClassGroupId' => intval($to_groupId),
                    'StudentId' => intval($student_id),
                    'RegDate' => time()
                );
            }
            if (!empty($groupStudent) || !empty($classStudent)) {
                $result = $this->CI->studentmodel->mergeStudentByClass($classStudent, $groupStudent);
                if ($result) {
                    $this->CI->session->set_flashdata('message-success', 'Student is asigned successfully.');
                } else {
                    $this->CI->session->set_flashdata('message-error', 'Student is asigning failed.');
                }
            } else {
                $this->CI->session->set_flashdata('message-info', 'Student is already asigned.');
            }
        } else {
            $this->CI->session->set_flashdata('message-error', validation_errors());
        }
        redirect('classes/profile/' . $classId);
    }
    
    public function delete(){
        $studentId = $this->CI->input->post('id', TRUE);
        $student=$this->CI->studentmodel->getStudentDetailByID($studentId);
        $response = array("status" => "error", "html" => "", "messages" => "");
        if($student){
            $data=array('IsActive'=>0);
            $result = $this->CI->studentmodel->updateStudentByCondition(array('StudentId'=>$studentId),$data);
            if($result){
               $response['status']='success';
            }
        }
        echo json_encode($response);
        exit;
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */