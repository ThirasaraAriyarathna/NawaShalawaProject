<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AssistantLib {

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
         $this->CI->load->model('class/classmodel');
        $this->CI->load->library('session');
        $this->CI->load->model('assistant/assistantmodel');
        $this->CI->load->helper('cookie');
        $this->loginUser = $this->CI->session->userdata('login_data');
    }
    public function add(){

        // if ($this->CI->loginlib->logged_in()) {
        $this->CI->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('nic', 'NIC', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('email', 'Email', 'trim|email|xss_clean');
       
        if(!$this->CI->input->post('assign_all_class')){
            $this->CI->form_validation->set_rules('class_list', 'Class List', 'required|xss_clean');
        }
        
        if ($this->CI->form_validation->run()) {
            date_default_timezone_set('UTC');
            $userDetail['DateAdded']=time();
            $user = $this->CI->loginlib->register("pa55word", 2, $userDetail['DateAdded'],1);//$this->loginUser['UserId']
            if($user){
                $data['Title'] = $this->CI->input->post('title', true);
                $data['FirstName'] = $this->CI->input->post('firstname', true);
                $data['LastName'] = $this->CI->input->post('lastname', true);
                $data['NIC'] = $this->CI->input->post('nic', true);
                $data['UserId'] = $user;
                $data['Phone'] = $this->CI->input->post('phone', true);
                $data['AdditionalPhone'] = $this->CI->input->post('mobile', true);
                $data['Address'] = $this->CI->input->post('address', true);
                $data['Email'] = $this->CI->input->post('email', true);
                $data['Description'] = $this->CI->input->post('description', true);
                $assistant=$this->CI->assistantmodel->addAssistant($data);
                if($assistant){
                    $assId=$assistant['AssistantId'];
                    $classAssitantData=array();
                    if($this->CI->input->post('assign_all_class')){
                        $classList=$this->CI->classmodel->getallClassID();
                        array_walk($classList, function(&$item, $key,$assId) {
                            $item['AssistantId'] = $assId;
                       },$assId);
                       $classAssitantData=$classList;
                    }
                    else{
                        $classList=$this->CI->input->post('class_list', true);
                        
                        foreach ($classList as $class){
                            $classAssitantData[]=array('ClassId'=>$class,'AssistantId'=>$assId);
                        }
                        
                    }
                   
                   $result= $this->CI->assistantmodel->addClassAssistant($classAssitantData);
                   if($result){
                       $htmlMessage='<ul><li>Assistant Id : '.$assistant['AdmissionID'].'</li><li>Assistant Key : '.$assistant['AssistantKey'].'</li></ul>';
                      
                       $this->CI->session->set_flashdata('message-success', 'Successfuly added. '.$htmlMessage);
                   }
                   else{
                       $this->CI->session->set_flashdata('message-error', 'Please try again.');
                   }
                }
                else{
                       $this->CI->session->set_flashdata('message-error', 'Please try again.');
                   }
            }
            else{
                       $this->CI->session->set_flashdata('message-error', 'Please try again.');
                   }
        
        } else {
            var_dump(validation_errors());
            $this->CI->session->set_flashdata('message-error', validation_errors());
        }
        redirect('assistants/add');
    
    }
    
    public function edit($id){

        // if ($this->CI->loginlib->logged_in()) {
        $this->CI->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('nic', 'NIC', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('email', 'Email', 'trim|email|xss_clean');
       
        if(!$this->CI->input->post('assign_all_class')){
            $this->CI->form_validation->set_rules('class_list', 'Class List', 'required|xss_clean');
        }
        
        if ($this->CI->form_validation->run()) {
            date_default_timezone_set('UTC');
            
                $data['Title'] = $this->CI->input->post('title', true);
                $data['FirstName'] = $this->CI->input->post('firstname', true);
                $data['LastName'] = $this->CI->input->post('lastname', true);
                $data['NIC'] = $this->CI->input->post('nic', true);
                $data['Phone'] = $this->CI->input->post('phone', true);
                $data['AdditionalPhone'] = $this->CI->input->post('mobile', true);
                $data['Address'] = $this->CI->input->post('address', true);
                $data['Email'] = $this->CI->input->post('email', true);
                $data['Description'] = $this->CI->input->post('description', true);
                $result=$this->CI->assistantmodel->updateAssistant(array('AssistantId'=>$id),$data);
                if($result){
                    $assId=$id;
                    $classAssitantData=array();
                    $allocatedList=$this->CI->assistantmodel->getAllClassesByAssistant($assId);
                    if($this->CI->input->post('assign_all_class')){
                        $classList=$this->CI->classmodel->getallClassID();
                        foreach ($classList as $c=>$assitant){
                            $i=array_search($assitant, $allocatedList);
                            if($i!==FALSE){
                                unset($classList[$c]);
                                unset($allocatedList[$i]);
                            }
                        }
                        $deactiveassistance=$allocatedList;
                        
                        array_walk($classList, function(&$item, $key,$assId) {
                            $item['AssistantId'] = $assId;
                       },$assId);
                       $classAssitantData=$classList;
                    }
                    else{
                        $classList=$this->CI->input->post('class_list', true);
                        
                        foreach ($classList as $class){
                            $extraclass[]=array('ClassId'=>$class);
                        }
                        foreach ($extraclass as $c=>$assitant){
                            $i=array_search($assitant, $allocatedList);
                            if($i!==FALSE){
                                unset($extraclass[$c]);
                                unset($allocatedList[$i]);
                            }
                        }
                        
                        array_walk($extraclass, function(&$item, $key,$assId) {
                            $item['AssistantId'] = $assId;
                       },$assId);
                        
                        $deactiveassistance=$allocatedList;
                        
                        $classAssitantData=$extraclass;
                    
                    }
                   $result= $this->CI->assistantmodel->addClassAssistant($classAssitantData);
                   if($result){
                       array_walk($deactiveassistance, function(&$item, $key,$assId) {
                            $item['AssistantId'] = $assId;
                       },$assId);
                      
                       if(!empty($deactiveassistance)){
                           foreach ($deactiveassistance as $val){
                               $this->CI->assistantmodel->updateClassAssistant($val,array('IsActive'=>0));
                           }
                       }
                       $this->CI->session->set_flashdata('message-success', 'Successfuly updated. ');
                   }
                   else{
                       $this->CI->session->set_flashdata('message-error', 'Please try again.');
                   }
                }
                else{
                       $this->CI->session->set_flashdata('message-error', 'Please try again.');
                   }
           
        
        } else {
            var_dump(validation_errors());
            $this->CI->session->set_flashdata('message-error', validation_errors());
        }
        redirect('assistants/details/'.$id);
    
    }
    
    function searchbyfield(){
        
        $searchTerm = $this->CI->input->post('term');
        $this->CI->form_validation->set_rules('term', 'Search Term', 'trim|required|xss_clean');

        $response = array("status" => "error", "html" => "", "msg" => "");
        
        $result = $this->CI->assistantmodel->searchAssistantByAdmissionId($searchTerm);
        
        if ($this->CI->form_validation->run()) {
            $response['status']="success";
            if ($result) {
                    $response['html'] = $this->CI->load->view('assistants/search_partial_view', array('search_results' => $result), true);
            }
        } else {
            $response['msg'] = validation_errors();
        }
        echo json_encode($response);
        exit;
        
    }
    function details($id){
        $result = $this->CI->assistantmodel->searchAssistantById($id);
        if($result && isset($result['results'][0])){
            $classes = explode(',',$result['results'][0]['Classes']);
            $batchesName = explode(',',$result['results'][0]['BatchName']);
            $batchesYear = explode(',',$result['results'][0]['BatchYear']);
            $classId = explode(',',$result['results'][0]['ClassIds']);
            $class_list=array();
            if(count($classes)>0){
            foreach ($classes as $k=>$class){ 
                if(!empty($class)){
                    $class_list[$k]['classId']=$classId[$k];
                    $class_list[$k]['className']=$class;
                    $class_list[$k]['batchName']=$batchesName[$k].'-'.$batchesYear[$k];
                }
                }
            }
          
            $result['results'][0]['ClassList']=$class_list;
            return $result['results'][0];
        }
        else{
            show_404();
        }
    }
    
    function active_deactive($id,$status){
        if(is_numeric($status) && in_array($status, array(0,1))){
            $result=$this->CI->assistantmodel->updateAssistant(array('AssistantId'=>$id),array('IsActive'=>$status));
            if($result){
                $this->CI->session->set_flashdata('message-success', 'Successfuly updated.');
            }
            else{
                $this->CI->session->set_flashdata('message-error', 'Please try again.');
            }
            
        }
        else{
                $this->CI->session->set_flashdata('message-error', 'Please try again.');
        }
        redirect('assistants/details/'.$id);
    }
}