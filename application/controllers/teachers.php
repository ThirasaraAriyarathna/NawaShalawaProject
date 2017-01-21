<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teachers extends CI_Controller {

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
      
        $this->scriptloader->set_module_code('teacher');
        $this->load->library('students/studentLib');
        $this->load->library('teachers/teacherLib');
        $this->load->library('batch/batchLib');
        $this->load->library('login/loginlib');
        if (!$this->loginlib->logged_in()) {
             redirect('');
        }
        $this->data=array('user_data'=>$this->session->userdata('login_data'));
    }

    public function add() {
        
         if ($this->data['user_data']['UserType']!=1){
            show_404();
        }
        
         if($this->input->post())
        {
            $this->data['data']=$this->teacherlib->add();
        }
       
        $this->data["selected_menu"] = "teacher";
        
       $states =$this->studentlib->autoSuggestStates();
       $stateString = implode("&quot;,&quot;",$states);
       $this->data["states"]='[&quot;'.$stateString.'&quot;]';
       $this->load->view('teachers/add', $this->data);
    }


 

  
    public function search()
    {
        if($this->input->post())
        {
            $this->teacherlib->searchTeacher();
        }
        $this->data["selected_menu"] = "teacher";
        $this->load->view('teachers/search', $this->data);
    }
    
     public function edit($id) {
        if (!isset($id) || $this->data['user_data']['UserType']!=1){
            show_404();
        }
            
         if($this->input->post())
        {
            $this->data['data']=$this->teacherlib->edit($id);
        }
        $this->data["selected_menu"] = "teacher";
        $this->data["details"] = $this->teacherlib->getTeacherById($id);
        $states = $this->teacherlib->autoSuggestStates();
        $stateString = implode("&quot;,&quot;", $states);
        $this->data["states"] = '[&quot;' . $stateString . '&quot;]';
        $this->load->view('teachers/edit', $this->data);
    }
    
  
    
     public function delete()
    {
        if ($this->data['user_data']['UserType']!=1){
            show_404();
        }
        $this->teacherlib->delete();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */