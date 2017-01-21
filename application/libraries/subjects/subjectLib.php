<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SubjectLib {

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

        $this->CI->load->model('subjects/subjectmodel');
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
        
		$response = array("status" => "error", "html" => "", "messages" => "");
        $subjectDetail = array();
      
        $data = array();
       // if ($this->CI->loginlib->logged_in()) {
            $this->CI->form_validation->set_rules('subjectName', 'Subject Name', 'trim|required|xss_clean');
           
            if ($this->CI->form_validation->run()) {
               
                $subjectDetail['Name'] = $this->CI->input->post('subjectName',true);
                $subjectDetail['Description'] = $this->CI->input->post('description',true);
				
				
				$id = $this->CI->subjectmodel->addSubject($subjectDetail); 
                    if ($id) {
						$subjectDetail['subjectId']=$id;
						
						$response['status']="success";
                        $response['detail']['id'] = $id;
                    } else {
                        $response['messages'] = "Please try again.";
                    }
               // } else {
                //    $data['messages'] = "Please try again.";
                  //  $data['messages_type'] = "error";
               // }
                // save data to db
            } else {
                //if($this->CI->form_validation->error())
                // {

                $response['messages'] = validation_errors();
             
                //}
            }
       // } else {
         //    redirect('');
        //}
       
        echo json_encode($response);
        exit;
    }
	
	public function delete() {        
        
		$response = array("status" => "error", "html" => "", "msg" => "");
		$id=$this->CI->input->post('id', true);
		if($id){
			 if($this->CI->subjectmodel->updateSubjectDetails(array('IsDelete'=>1),array('SubjectId'=>$id)))
			 {
				$response['status']='success';
			 }
		}
       echo json_encode($response);
        exit;
    }

    function selectSubjects() {
        return $this->CI->subjectmodel->selectSubjects();
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

    function searchStudent() {
        $searchTerm = $this->CI->input->post('term');
        $this->CI->form_validation->set_rules('term', 'Search Term', 'trim|required|xss_clean');

        $response = array("status" => "error", "html" => "", "msg" => "");
        $result = $this->CI->studentmodel->searchStudentByAdmissionId($searchTerm);
        if ($this->CI->form_validation->run()) {
            if ($result) {

                $response['html'] = $this->CI->load->view('students/search_partial_view', array('search_results' => $result), true);
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
            $result= $this->CI->studentmodel->getStudentDetailByID($studentId);
			$response['html'] = $this->CI->load->view('students/details', array('details' => $result), true);
        }
        echo json_encode($response);
        exit;
    }
    
    function loadEditSubject(){
        $id = $this->CI->input->post('id');
        $subject=$this->CI->subjectmodel->getSubjectByCondition(array('SubjectId'=>$id));
        $response = array("status" => "error", "html" => "", "msg" => "");
        if($subject){
            $response['html'] = $this->CI->load->view('classes/edit_subject', array('details' => $subject), true);
            $response['status']='success';
        }
        echo json_encode($response);
        exit;
    }
    function  edit($id){
        $response = array("status" => "error", "html" => "", "messages" => "");
        $subject=$this->CI->subjectmodel->getSubjectByCondition(array('SubjectId'=>$id));
        if($subject){
            $subjectDetail['Name'] = $this->CI->input->post('subjectName',true);
            $subjectDetail['Description'] = $this->CI->input->post('description',true);
            $result=$this->CI->subjectmodel->updateSubject(array('SubjectId'=>$id),$subjectDetail);
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