<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TeacherLib {

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
        $this->CI->load->model('students/studentmodel');
        $this->CI->load->model('user/usermodel');
        $this->CI->load->model('teachers/teachermodel');
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
        

        $teacherDetail = array();
        $userDetail = array();
        $data = array();
        if ($this->CI->loginlib->logged_in()) {
            $this->CI->form_validation->set_rules('firstName', 'First Name', 'trim|required|xss_clean');
//            $this->CI->form_validation->set_rules('admissionDate', 'Admission Date', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('DOB', 'Date of Birth', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('addressLine1', 'Address Line 1', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean');
           
            if ($this->CI->form_validation->run()) {
                $dateAdded=time();//strtotime($this->CI->input->post('admissionDate', true));
                $userDetail['DateAdded'] = $dateAdded;

                $batchId = $this->CI->input->post('batches', true);
                $teacherDetail['AdmissionID'] = null;//$this->CI->input->post('admissionID', true);

                $teacherDetail['FirstName'] = $this->CI->input->post('firstName', true);

                $teacherDetail['LastName'] = $this->CI->input->post('lastname', true);
                $teacherDetail['DateOfBirth'] = strtotime($this->CI->input->post('DOB', true));
                $teacherDetail['Gender'] = (int)$this->CI->input->post('gender', true);
                $teacherDetail['AddressLine1'] = $this->CI->input->post('addressLine1', true);
                $teacherDetail['AddressLine2'] = $this->CI->input->post('addressLine2', true);
                $teacherDetail['City'] = $this->CI->input->post('city', true);
                $teacherDetail['State'] = $this->CI->input->post('state', true);
                $teacherDetail['Phone'] = $this->CI->input->post('phone', true);
                $teacherDetail['Mobile'] = $this->CI->input->post('mobile', true);
                $teacherDetail['Email'] = $this->CI->input->post('email', true);

                $user = $this->CI->loginlib->register("pa55word", 3, $userDetail['DateAdded'], $this->loginUser['UserId']);
			
                
                if ($user) {

                    $teacherDetail['UserId'] = $user;
                  
                    $result = $this->CI->teachermodel->addTeacher($teacherDetail);
                  
                    if ($result) {
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
    public function edit($id) {
        
        $teacher= $this->CI->teachermodel->getTeacherDetailByID($id);
        if(!$teacher){
            show_404();
        }
        $teacherDetail = array();
        $userDetail = array();
        $data = array();
        if ($this->CI->loginlib->logged_in()) {
            $this->CI->form_validation->set_rules('firstName', 'First Name', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('admissionDate', 'Admission Date', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('DOB', 'Date of Birth', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('addressLine1', 'Address Line 1', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->CI->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean');
           
            if ($this->CI->form_validation->run()) {
                $dateAdded=strtotime($this->CI->input->post('admissionDate', true));
                $userDetail['DateAdded'] = $dateAdded;

                $batchId = $this->CI->input->post('batches', true);

                $teacherDetail['FirstName'] = $this->CI->input->post('firstName', true);

                $teacherDetail['LastName'] = $this->CI->input->post('lastname', true);
                $teacherDetail['DateOfBirth'] = strtotime($this->CI->input->post('DOB', true));
                $teacherDetail['Gender'] = (int)$this->CI->input->post('gender', true);
                $teacherDetail['AddressLine1'] = $this->CI->input->post('addressLine1', true);
                $teacherDetail['AddressLine2'] = $this->CI->input->post('addressLine2', true);
                $teacherDetail['City'] = $this->CI->input->post('city', true);
                $teacherDetail['State'] = $this->CI->input->post('state', true);
                $teacherDetail['Phone'] = $this->CI->input->post('phone', true);
                $teacherDetail['Mobile'] = $this->CI->input->post('mobile', true);
                $teacherDetail['Email'] = $this->CI->input->post('email', true);

                $result = $this->CI->teachermodel->updateTeacherBycondition(array('TeacherId'=>$id),$teacherDetail);
                  
                if ($result) {
                    $result = $this->CI->usermodel->updateUserBycondition(array('UserId'=>$teacher['UserId']),$userDetail);
                    
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
             redirect('');
        }
       
        return $data;
    }
    
    public function delete(){
        $teacherId = $this->CI->input->post('id', TRUE);
        $teacher=$this->CI->teachermodel->getTeacherDetailByID($teacherId);
        $response = array("status" => "error", "html" => "", "messages" => "");
        if($teacher){
            $data=array('IsActive'=>0);
            $result = $this->CI->teachermodel->updateTeacherBycondition(array('TeacherId'=>$teacherId),$data);
            if($result){
               $response['status']='success';
            }
        }
        echo json_encode($response);
        exit;
        
    }

    
    function selectTeachers() {
        return $this->CI->teachermodel->selectTeachers();
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

    function searchTeacher() {
        $searchTerm = $this->CI->input->post('term');
        $this->CI->form_validation->set_rules('term', 'Search Term', 'trim|required|xss_clean');

        $response = array("status" => "error", "html" => "", "msg" => "");
        if ($this->CI->form_validation->run()) {
            $result = $this->CI->teachermodel->searchTeacherByAdmissionId($searchTerm);
            if ($result) {
                foreach ($result['results'] as &$r){
                    $r['classes']=$this->CI->teachermodel->getClassesByTeacherId($r['TeacherId']);
                }
                $response['html'] = $this->CI->load->view('teachers/search_partial_view', array('search_results' => $result,'user_data'=>$this->loginUser), true);
            }
        } else {
            $response['msg'] = validation_errors();
        }
        echo json_encode($response);
        exit;
    }

   function getTeacherById($Id) {
        
        $result= $this->CI->teachermodel->getTeacherDetailByID($Id);
        if(!$result){
            show_404();
        }
        
        return $result;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */