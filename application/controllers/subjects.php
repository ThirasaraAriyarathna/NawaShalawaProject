<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subjects extends CI_Controller {

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
        //$this->scriptloader->set_module_code('subject');
        $this->load->library('subjects/subjectLib');
         $this->load->library('batch/batchLib');
         $this->load->library('login/loginlib');
        if (!$this->loginlib->logged_in()) {
             redirect('');
        }
        $this->data=array('user_data'=>$this->session->userdata('login_data'));
    }

    public function index() {
        $this->data["selected_menu"] = "student";
		$this->data['batches'] = $this->batchlib->selectBatches();
        $this->load->view('subjects/view', $this->data);
    }

    public function edit($id){
        $this->subjectlib->edit($id);
    }

    public function add() {
        if($this->input->post())
        {
            $this->data=$this->subjectlib->add();
        }
      
        $this->load->view('subjects/view', $this->data);
    }

   

 

    public function delete() {        
        $this->subjectlib->delete();
    }

    public function loadEditSubject() {        
        $this->subjectlib->loadEditSubject();
    }
    
    public function getStudentDetail()
    {
        $this->studentlib->getStudentDetail();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */