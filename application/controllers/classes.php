<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Classes extends CI_Controller {

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
        $this->scriptloader->set_module_code('classes');
        $this->load->helper('text');
        $this->load->library('teachers/teacherLib');
        $this->load->library('subjects/subjectLib');
        $this->load->library('batch/batchLib');
        $this->load->library('class/classLib');
        $this->load->library('login/loginlib');
        if (!$this->loginlib->logged_in()) {
             redirect('');
        }
        $this->data=array('user_data'=>$this->session->userdata('login_data'));
    }

    public function index() {
        $this->data["selected_menu"] = "classes";
        $this->data['batches'] = $this->batchlib->selectBatches();
        $this->data['subjects'] = $this->subjectlib->selectSubjects();
        $this->data['classes'] = $this->classlib->selectClasses(1);
        $this->data['teachers'] = $this->teacherlib->selectTeachers();
        $this->data['user_data']=$this->session->userdata('login_data');
        $this->load->view('classes/index', $this->data);
    }

    public function view() {
        $this->data["selected_menu"] = "attendance";
        $this->data['batches'] = $this->batchlib->selectBatches();
        // $this->data['subjects'] = $this->subjectlib->selectSubjects();
        $this->data['classes'] = $this->classlib->selectClasses(2);
        $this->data['user_data']=$this->session->userdata('login_data');
        $this->load->view('classes/view', $this->data);
    }

    public function add() {
        if ($this->data['user_data']['UserType']!=1){
            show_404();
        }
        if ($this->input->post()) {
            $this->classlib->add();
        }
          $this->data["selected_menu"] = "classes";
        $this->data['batches'] = $this->batchlib->selectBatches();
        $this->data['subjects'] = $this->subjectlib->selectSubjects();
        $this->data['teachers'] = $this->teacherlib->selectTeachers();
        $this->load->view('classes/add', $this->data);
    }
    public function edit($id) {
        $user_data=$this->session->userdata('login_data');
        if($user_data['UserType']==1){ 
            if ($this->input->post()) {
                 $this->classlib->edit($id);
            }
              $this->data["selected_menu"] = "classes";
            $this->data['class_detail']=$this->classlib->getClassByID($id);
            $this->data['batches'] = $this->batchlib->selectBatches();
            $this->data['subjects'] = $this->subjectlib->selectSubjects();
            $this->data['teachers'] = $this->teacherlib->selectTeachers();
            $this->load->view('classes/edit', $this->data);
        }
        else{
            show_404();
        }
    }

    public function delete($id){
        $this->classlib->delete($id);
    }

    public function search($type=NULL) {
        $this->classlib->search($type);
    }

    public function search_more($type=NULL) {
        $this->classlib->search_more($type);
    }

    public function getClassDetails() {
        $this->classlib->getClassDetails();
    }
    public function getClassDetailView($classid) {
        $this->classlib->getClassDetailView($classid);
    }

    public function create_instance($classId) {
        $this->classlib->create_instance($classId);
    }
    
    public function create_group($classId) {
        if ($this->data['user_data']['UserType']!=1){
            show_404();
        }
        $this->classlib->create_group($classId);
    }
    public function edit_group($classId,$classGroupId) {
        $this->classlib->edit_group($classId,$classGroupId);
    }
    public function delete_group($class_groupId) {
        return $this->classlib->delete_group($class_groupId);
    }
    public function load_edit_group($class_groupId) {
        return $this->classlib->load_edit_group($class_groupId);
    }
    public function profile($classId){
        $this->data=$this->classlib->getClassProfile($classId);
          $this->data["selected_menu"] = "classes";
          $this->data['user_data']=$this->session->userdata('login_data');
        $this->load->view('classes/profile', $this->data);
    }
    
    public function autosuggestClasses(){
        $this->classlib->autosuggestClasses();
    }
    public function getClassPartialView(){
        $this->classlib->getClassPartialView();
    }
   
    
    public function get_group_list(){
        $this->classlib->get_group_list();
    }
    
    public function change_fees($id){
        $this->classlib->change_fees($id);
    }
    
    public function get_students_of_class($classid){
        $this->data["students"] = $this->classlib->getStudentsByClass($classid);
        $this->load->view('classes/test', $this->data);
    }

    public function get_students_of_group($groupid){
        $this->data["students"] = $this->classlib->getStudentsByGroup($groupid);
        $this->load->view('classes/group_students', $this->data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */