<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Students extends CI_Controller {

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
   
    
    function __construct() {
        parent::__construct();
        $this->scriptloader->set_module_code('student');
        $this->load->library('students/studentLib');
        $this->load->library('login/loginlib');
        if (!$this->loginlib->logged_in()) {
            redirect('');
        }
        $this->data=array('user_data'=>$this->session->userdata('login_data'));
    }

    public function index() {
        $this->data["selected_menu"] = "student";
        $this->load->view('students/index', $this->data);
    }

    public function add() {
        
         if($this->input->post())
        {
            $this->data['data']=$this->studentlib->add();
        }
        $this->data['batches'] = $this->studentlib->selectBatches();
        $this->data["selected_menu"] = "student";
        $districts = $this->studentlib->autoSuggestDistrict();
        $districtString = implode("&quot;,&quot;",$districts);
       $this->data["districts"]='[&quot;'.$districtString.'&quot;]';
       $states =$this->studentlib->autoSuggestStates();
       $stateString = implode("&quot;,&quot;",$states);
       $this->data["states"]='[&quot;'.$stateString.'&quot;]';
        $this->load->view('students/add_student', $this->data);
    }

    public function edit($id) {
        if (!isset($id))
            show_404();
         if($this->input->post())
        {
            $this->data['data']=$this->studentlib->edit($id);
        }
        $this->data["selected_menu"] = "student";
        $this->data["details"] = $this->studentlib->getStudentById($id);
        $this->data['batches'] = $this->studentlib->selectBatches();
         $this->data['user_data']=$this->session->userdata('login_data');
        $districts = $this->studentlib->autoSuggestDistrict();
        $districtString = implode("&quot;,&quot;", $districts);
        $this->data["districts"] = '[&quot;' . $districtString . '&quot;]';
        $states = $this->studentlib->autoSuggestStates();
        $stateString = implode("&quot;,&quot;", $states);
        $this->data["states"] = '[&quot;' . $stateString . '&quot;]';
        $this->load->view('students/edit_student', $this->data);
    }

    public function search($flag=NULL) {        
        if($this->input->post())
        {
            $this->studentlib->searchStudent($flag);
        }
        $this->data["selected_menu"] = "student";
        $this->load->view('students/search', $this->data);
    }
    
    public function delete()
    {
        $this->studentlib->delete();
    }
    public function getStudentDetail()
    {
        $this->studentlib->getStudentDetail();
    }
    public function viewStudentDetail()
    {
        $this->studentlib->viewFullStudent();
    }
    public function mergeStudentByClass($classId){
        $this->studentlib->mergeStudentByClass($classId);
    }
    public function mergeStudentByGroup($classId){
       $this->studentlib->mergeStudentByGroup($classId);
    }
    public function assignStudentByGroup($classId){
       $this->studentlib->assignStudentByGroup($classId);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */