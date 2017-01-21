<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ClassLib {

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

    function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->helper(array('form', 'url'));
        $this->CI->load->library('form_validation');
        $this->CI->load->library('login/loginlib');
        $this->CI->load->library('session');
        $this->CI->load->model('subjects/subjectmodel');
        $this->CI->load->model('class/classmodel');
        $this->CI->load->model('assistant/assistantmodel');
        $this->CI->load->helper('cookie');
        $this->loginUser = $this->CI->session->userdata('login_data');
    }

    public function valid_selection($value) {
        // var_dump('value');
        if ($value > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add() {
        //var_dump(strtotime('1970-01-01 05:30'));die();
        $response = array("status" => "error", "html" => "", "messages" => "");
        $classTable = array();

        $data = array();
        // if ($this->CI->loginlib->logged_in()) {
        $this->CI->form_validation->set_rules('class_name', 'Class Name', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('class_fees', 'Class Fees', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('teachers', 'Teachers', 'trim|valid_selection|xss_clean');
        $this->CI->form_validation->set_rules('batches', 'Batch', 'trim|valid_selection|xss_clean');
        $this->CI->form_validation->set_rules('subjects', 'Subject', 'trim|valid_selection|xss_clean');

        if ($this->CI->form_validation->run()) {
            date_default_timezone_set('UTC');
            $classTable['Name'] = $this->CI->input->post('class_name', true);
            $classTable['Description'] = $this->CI->input->post('description', true);
            $classTable['TeacherId'] = $this->CI->input->post('teachers', true);
            $classTable['BatchId'] = $this->CI->input->post('batches', true);
            $classTable['SubjectId'] = $this->CI->input->post('subjects', true);
            $classTable['AddDate'] = time();
            
            $id = $this->CI->classmodel->addClass($classTable);
            if ($id) {
                $data=array(
                    'ClassId'=>$id,
                    'Year'=>date('Y'),
                    'Month'=>date('m'),
                    'DueDate'=>strtotime('second sunday of this month')-$this->CI->config->item('time_zone_offset'),
                    'Amount'=>$this->CI->input->post('class_fees', true)
                    );
                $this->CI->classmodel->addClassFees($data);
                
                $this->CI->session->set_flashdata('message-success', 'Successfuly added.');
                redirect('classes/profile/'.$id);
            } else {
                $this->CI->session->set_flashdata('message-error', 'Please try again.');
            }
        
        } else {
            $this->CI->session->set_flashdata('message-error', validation_errors());
        }
        redirect('classes/add');
    }
    public function edit($id) {
        $response = array("status" => "error", "html" => "", "messages" => "");
        $classTable = array();

        $data = array();
        // if ($this->CI->loginlib->logged_in()) {
        $this->CI->form_validation->set_rules('class_name', 'Class Name', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('teachers', 'Teachers', 'trim|valid_selection|xss_clean');
        $this->CI->form_validation->set_rules('batches', 'Batch', 'trim|valid_selection|xss_clean');
        $this->CI->form_validation->set_rules('subjects', 'Subject', 'trim|valid_selection|xss_clean');

        if ($this->CI->form_validation->run()) {
            date_default_timezone_set('UTC');
            $classTable['Name'] = $this->CI->input->post('class_name', true);
            $classTable['Description'] = $this->CI->input->post('description', true);
            $classTable['TeacherId'] = $this->CI->input->post('teachers', true);
            $classTable['BatchId'] = $this->CI->input->post('batches', true);
            $classTable['SubjectId'] = $this->CI->input->post('subjects', true);
            $classTable['AddDate'] = time();
         //   print_r($classTable);die;
            $result = $this->CI->classmodel->updateClass(array('ClassId'=>$id),$classTable);
            if ($result) {
                $this->CI->session->set_flashdata('message-success', 'Successfuly updated.');
            } else {
                $response['messages'] = "Please try again.";
                $this->CI->session->set_flashdata('message-error', 'Please try again.');
            }
        } else {
            $this->CI->session->set_flashdata('message-error', validation_errors());
        }
        redirect('classes/profile/'.$id);
    }
    
    function delete($id){
        $result = $this->CI->classmodel->updateClass(array('ClassId'=>$id),array('IsDelete'=>1));
        if ($result) {
            $this->CI->session->set_flashdata('message-success', 'Successfuly deleted.');
        } else {
            $this->CI->session->set_flashdata('message-error', 'Please try again.');
        }
        redirect('classes/');
    }
    /**
     * 
     * @param int $type (1 - all classes / 2 - classes by date )
     * @return type
     */
    function selectClasses($type) {
        if($type==1){
                    return $this->CI->classmodel->selectClasses();
        }
        else{
            date_default_timezone_set('UTC');
            $date_timestamp=(time()-$this->CI->config->item("time_zone_offset"));
            date_default_timezone_set($this->CI->config->item("time_zone"));
            $day = date('l',$date_timestamp);
            $data = $this->CI->classmodel->selectClassesByDay($day);
            
            if(!$data){
                $data=array();
            }
            $data2 = $this->CI->classmodel->selectExtraClassesByDay($day);
            foreach ($data2 as $d){
                array_push($data, $d);
            }
            return $data;
        }
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
/**
 * 
 * @param type $type : 1 - serch index class list
 */
    function search($type=null) {
        
        $class_name = $this->CI->input->post('class_name');
        $batch_id = $this->CI->input->post('batch');
        
        $this->CI->form_validation->set_rules('batch', 'Batch', 'trim|required|xss_clean');

        $response = array("status" => "error", "html" => "", "msg" => "");
        
        if ($this->CI->form_validation->run()) {
            $search_limit=9;
            $where=array('c.BatchId'=>$batch_id);
            $result = $this->CI->classmodel->searchClassesByClassName($class_name,$where,$search_limit,0,$type);
           // print_r($result);die;
            if ($result['results']) {
                $loadmore=FALSE;
                if($search_limit<$result['TotalRecords']){
                    $loadmore=TRUE;
                }
                $response['status']='success';
                $response['loadmore']=$loadmore;
                $response['offset']=$search_limit;
                //print_r($result['results']);die;
                if($type==1){
                    $response['html'] = $this->CI->load->view('classes/detail_partial_index', array('class_details' => $result['results'],'user_data'=>$this->loginUser), true);
                }
                else{
                    $response['html'] = $this->CI->load->view('classes/detail_partial', array('class_details' => $result['results'],'user_data'=>$this->loginUser), true);
                }
            }
        } else {
            $response['msg'] = validation_errors();
        }
        echo json_encode($response);
        exit;
    }
    /**
     * 
     * @param type $type : 1 - search more index class list
     */
    function search_more($type=null) {
        
        $class_name = $this->CI->input->post('class_name');
        $batch_id = $this->CI->input->post('batch');
        $offset = $this->CI->input->post('offset');
        
        $this->CI->form_validation->set_rules('batch', 'Batch', 'trim|required|xss_clean');

        $response = array("status" => "error", "html" => "", "msg" => "");
        
        if ($this->CI->form_validation->run()) {
            $search_limit=9;
            $where=array('c.BatchId'=>$batch_id);
            $result = $this->CI->classmodel->searchClassesByClassName($class_name,$where,$search_limit,$offset);
            
            if ($result['results']) {
                $loadmore=FALSE;
                if(($search_limit+(int)$offset)<$result['TotalRecords']){
                    $loadmore=TRUE;
                }
                $response['loadmore']=$loadmore;
                $response['status']='success';
                $response['offset']=$search_limit+(int)$offset;
                if($type==1){
                    $response['html'] = $this->CI->load->view('classes/detail_partial_index', array('class_details' => $result['results'],'user_data'=>$this->loginUser), true);
                }
                else{
                    $response['html'] = $this->CI->load->view('classes/detail_partial', array('class_details' => $result['results'],'user_data'=>$this->loginUser), true);
                }
            }
        } else {
            $response['msg'] = validation_errors();
        }
        echo json_encode($response);
        exit;
    }

    function getClassDetails() {
        $class_id = $this->CI->input->post('class_id');
        $response = array("status" => "error", "html" => "", "msg" => "");
        if ($class_id) {
            $response['status']="success";
            $result = $this->CI->classmodel->getClassDetailsByID($class_id);
            $classGroups=explode(',', $result[0]['ClassGroupId']);
            foreach ($classGroups as $classGroup){
                $result[0]['classGroups'][]=$this->CI->classmodel->getClassGroupsByID($classGroup);
            }
            $response['html'] = $this->CI->load->view('classes/class_instance_partial_view', array('details' => $result[0]), true);
        }
        echo json_encode($response);
        exit;
    }
    
    public function getClassProfile($classId){
        $result = $this->CI->classmodel->getClassDetailsByID($classId);
        if($result){
            $data['class']= $result[0] ;
            $data['groups'] = $this->CI->classmodel->getClassGroupsByClassID($classId);
            foreach ($data['groups'] as &$group){
                $count=$this->CI->classmodel->getStudentCountByGroup($group['ClassGroupId']);
                if($count){
                    $group['student_count']=$count[0]['count'];
                }
            }
            $data['assistants'] = $this->CI->classmodel->getAsistanstByClassID($classId);
           
            $data['fees'] = $this->CI->classmodel->getCurrentClassFeesByClassID($classId);
            //print_r($data['fees']);die;
           return $data;
        }
        else{
            show_404();
        }
    }
    public function create_instance($classId){
        date_default_timezone_set('UTC');
        $this->CI->form_validation->set_rules('class_date', 'Date', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('assistanKey', 'Assistant Key', 'trim|required|xss_clean');
        if($this->CI->input->post('is_new_group',TRUE)==1){
            $this->CI->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('start', 'Start', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('end', 'End', 'trim|required|xss_clean');
        }
       
        if ($this->CI->form_validation->run()) {
            $assKey=$this->CI->input->post('assistanKey',TRUE);
            
            
            $result=$this->CI->classmodel->isValidClassAssistant($classId);
            
            if($result){
            $result=$this->CI->classmodel->isValidClassAssistant($classId,$assKey);
            if($result){
                $date=strtotime($this->CI->input->post('class_date',TRUE))-$this->CI->config->item("time_zone_offset");
                 $class_groups= $this->CI->input->post('class_groups');
                if($this->CI->input->post('is_new_group',TRUE)==1){
                    $classg=array();
                    foreach($class_groups as $k=>$val){
                        if($val==1){
                            array_push($classg, $k);
                        }
                    }
                    date_default_timezone_set($this->CI->config->item("time_zone"));
                    $dayOfWeek=date('l',$date);
                    date_default_timezone_set('UTC');
                    $extra_class_data=array(
                        'ClassId'=>$classId,
                        'DayOfWeek'=>$dayOfWeek,
                        'Description'=>$this->CI->input->post('description',TRUE),
                        'Date'=>$date,
                        'StartTime'=>  strtotime('1970-01-01 '.$this->CI->input->post('start',TRUE))-$this->CI->config->item("time_zone_offset"),
                        'EndTime'=>  strtotime('1970-01-01 '.$this->CI->input->post('end',TRUE))-$this->CI->config->item("time_zone_offset")
                        
                    );
                    $classdateId=$this->CI->classmodel->createClassInstance($classId,$classg,$date,$extra_class_data);
                    if($classdateId){
                        redirect('attendance/marking/'.$classdateId);
                    }
                    else{
                        $this->CI->session->set_flashdata('message-error', 'Class Instance create failed. Please try again.');
                    }
                }
                else{
                   
                    $groupId='';
                    foreach ($class_groups as $key=>$val){
                        if($val==1){
                            $groupId=$key;
                            break;
                        }
                    }
                    $classdateId=$this->CI->classmodel->updateClassInstance($classId,$groupId,$date);
                    if($classdateId){
                        redirect('attendance/marking/'.$classdateId);
                    }
                    else{
                        $this->CI->session->set_flashdata('message-error', 'Class Instance create failed. Please try again.');
                    }
                }                                              
            }
            else {
                $this->CI->session->set_flashdata('message-error', 'You do not have authentication. Please try again.');
            }
            }
            else {
                $this->CI->session->set_flashdata('message-error', 'You do not have assigned an active assistant. Please try again.');
            }
            
        }
        else{
            $this->CI->session->set_flashdata('message-error',validation_errors());
        }
        redirect('classes/view');
    }
    
    public function create_group($classId) {
        $this->CI->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('start', 'Start', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('end', 'End', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('class_date', 'Date', 'trim|required|xss_clean');
        if ($this->CI->form_validation->run()) {
            date_default_timezone_set('UTC');
            $date = strtotime($this->CI->input->post('class_date', TRUE)) - $this->CI->config->item("time_zone_offset");
            date_default_timezone_set($this->CI->config->item("time_zone"));
            $dayOfWeek = date('l', $date);
            date_default_timezone_set('UTC');
            
            $class_group_data = array(
                'ClassId' => $classId,
                'DayOfWeek' => $dayOfWeek,
                'Description' => $this->CI->input->post('description', TRUE),
                'Date' => $date,
                'StartTime' => strtotime('1970-01-01 ' . $this->CI->input->post('start', TRUE)) - $this->CI->config->item("time_zone_offset"),
                'EndTime' => strtotime('1970-01-01 ' . $this->CI->input->post('end', TRUE)) - $this->CI->config->item("time_zone_offset")
            );
            $classgroupId=$this->CI->classmodel->create_group($class_group_data);
            if($classgroupId){
                $this->CI->session->set_flashdata('message-success', 'Class group created successfully');
            }
            else{
                $this->CI->session->set_flashdata('message-error', 'Class group create failed. Please try again.');
            }
            
        } 
        else{
            $this->CI->session->set_flashdata('message-error',validation_errors());
        }
        redirect('classes/profile/'.$classId);
    }
    public function edit_group($classId,$classGroupId) {
        $this->CI->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('start', 'Start', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('end', 'End', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('class_date', 'Date', 'trim|required|xss_clean');
        if ($this->CI->form_validation->run()) {
            date_default_timezone_set('UTC');
            $date = strtotime($this->CI->input->post('class_date', TRUE)) - $this->CI->config->item("time_zone_offset");
            date_default_timezone_set($this->CI->config->item("time_zone"));
            $dayOfWeek = date('l', $date);
            date_default_timezone_set('UTC');
            $where=array(
                'ClassGroupId'=>$classGroupId,
                'ClassId'=>$classId,
                'IsDelete'=>0
            );
            $data = array(
                'DayOfWeek' => $dayOfWeek,
                'Description' => $this->CI->input->post('description', TRUE),
                'Date' => $date,
                'StartTime' => strtotime('1970-01-01 ' . $this->CI->input->post('start', TRUE)) - $this->CI->config->item("time_zone_offset"),
                'EndTime' => strtotime('1970-01-01 ' . $this->CI->input->post('end', TRUE)) - $this->CI->config->item("time_zone_offset")
            );
            $classgroupId=$this->CI->classmodel->updateClassGroupByOption($where,$data);
            if($classgroupId){
                $this->CI->session->set_flashdata('message-success', 'Class group updated successfully');
            }
            else{
                $this->CI->session->set_flashdata('message-error', 'Class group updating failed. Please try again.');
            }
            
        } 
        else{
            $this->CI->session->set_flashdata('message-error',validation_errors());
        }
        redirect('classes/profile/'.$classId);
    }
    
    public function delete_group($class_groupId){
        $class_Id=$this->CI->input->post('class_id', TRUE);
        $where=array(
            'ClassId'=>$class_Id,
            'ClassGroupId'=>$class_groupId
        );
        $data=array(
            'IsDelete'=>1
        );
        $response = array("status" => "error", "html" => "", "msg" => "");
        $result=$this->CI->classmodel->updateClassGroupByOption($where,$data);
        if($result){
            $response['status']='success';
            $this->CI->session->set_flashdata('message-success', 'Class group deleted successfully');
        }
        else{
            $this->CI->session->set_flashdata('message-error', 'Class group deleting failed. Please try again.');
        }
        echo json_encode($response);
        exit;
    }
    public function load_edit_group($class_groupId){
        $class_Id=$this->CI->input->post('class_id', TRUE);
        $where=array(
            'cg.ClassId'=>$class_Id,
            'cg.ClassGroupId'=>$class_groupId
        );
        
        $response = array("status" => "error", "html" => "", "msg" => "");
        $result=$this->CI->classmodel->getClassGroupsByCondition($where);
//        print_r($result);die;
        if($result){
            $response['status']='success';
            $response['html'] = $this->CI->load->view('classes/edit_class_group', array('class' => $result[0]), true);
            $this->CI->session->set_flashdata('message-success', 'Class group deleted successfully');
        }
        else{
            $this->CI->session->set_flashdata('message-error', 'Class group deleting failed. Please try again.');
        }
        echo json_encode($response);
        exit;
    }
    
    public function autosuggestClasses(){
        $query=  $this->CI->input->get('search');
        $batchId=  $this->CI->input->get('batchId');
        $profileClass=  $this->CI->input->get('profileClass');
        
        $results=$this->CI->classmodel->getClassDetailByName($query,array('c.BatchId'=>$batchId,'c.ClassId != '=>$profileClass));
        if($results){
            $classlist=array();
            foreach($results as $result){
                $classlist[]=array('ClassId'=>$result['ClassId'],'ClassName'=> $result['ClassName'].'-'.$result['FirstName'].' '.$result['LastName']);
            }
            echo json_encode(array('classList'=>$classlist));
            exit;
        }
        else{
            echo json_encode(array('classList'=>array()));
            exit;
        }
        
    }
    public function getClassDetailView($class_id){
        $response = array("status" => "error", "html" => "", "msg" => "");
        if ($class_id) {
            $result = $this->CI->classmodel->getClassDetailsByID($class_id);
            if($result){
                $response['status']="success";
                $classGroups=explode(',', $result[0]['ClassGroupId']);
                foreach ($classGroups as $classGroup){
                    $result[0]['classGroups'][]=$this->CI->classmodel->getClassGroupsByID($classGroup);
                }
                $response['html']=$this->CI->load->view('students/class_detail_partialview', array('details' =>$result[0],'user_data'=>$this->loginUser), true);
            }
        }
        echo json_encode($response);
        exit;
        
    }
    public function getClassPartialView(){
        $c_name=  $this->CI->input->post('c_name');
        $batch=  $this->CI->input->post('batch');
        $c_id=  $this->CI->input->post('c_id');
        
            $html =$this->CI->load->view('assistants/class_partial_view', array('classId' =>$c_id,'className'=>$c_name,'batch'=> $batch), true);
            echo json_encode(array('html'=>$html));
            exit;
        
       
        
    }
    function getClassByID($id){
        return $this->CI->classmodel->getClassByID($id);
    }
            
    function get_group_list(){
        $class_id=  $this->CI->input->post('class_id');
        $results=$this->CI->classmodel->getClassGroupsByClassID($class_id);
        date_default_timezone_set($this->CI->config->item("time_zone"));
        if($results){
            $groupList=array();
            foreach ($results as $result){
                $groupList[]=array('value'=>$result['ClassGroupId'],'text'=>$result["DayOfWeek"].'('.date('h:i a',$result["StartTime"]).'-'.date('h:i a',$result["EndTime"]).')');
            }
            echo json_encode(array('groupList'=>$groupList));
            exit;
        }
        else{
            echo json_encode(array('groupList'=>array()));
            exit;
        }
    }
    
    function change_fees($classId){
        $this->CI->form_validation->set_rules('amount', 'Amount', 'trim|required|integer|xss_clean');
        $this->CI->form_validation->set_rules('due_date', 'Due-Date', 'trim|required|xss_clean');
        if ($this->CI->form_validation->run()) {
            date_default_timezone_set('UTC');
            $due_date=strtotime($this->CI->input->post('due_date', true))-$this->CI->config->item('time_zone_offset');
            $data=array(
                    'ClassId'=>$classId,
                    'Year'=>date('Y',  $due_date),
                    'Month'=>date('m',strtotime($this->CI->input->post('due_date', true))),
                    'DueDate'=>$due_date,
                    'Amount'=>$this->CI->input->post('amount', true)
                    );
           
            $result=$this->CI->classmodel->addClassFees($data);
            
            if($result){
                $this->CI->session->set_flashdata('message-success', 'Class fees changed successfully');
            }
            else{
                $this->CI->session->set_flashdata('message-error', 'Class fees changing failed. Please try again.');
            }
        }
        else{
            $this->CI->session->set_flashdata('message-error',validation_errors());
        }
        redirect('classes/profile/'.$classId);
    }
    
    function getStudentsByClass($classid){
        return $this->CI->classmodel->getStudentNamesByClass($classid);
    }

    function getStudentsByGroup($groupid){
        return $this->CI->classmodel->getStudentNamesByGroup($groupid);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */