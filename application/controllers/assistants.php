<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assistants extends CI_Controller {

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
        $this->scriptloader->set_module_code('assistant');
        $this->load->library('assistant/assistantLib');
        $this->load->library('batch/batchLib');
        $this->load->library('class/classLib');
        $this->load->library('login/loginlib');
        if (!$this->loginlib->logged_in()) {
             redirect('');
        }
        $this->data=array('user_data'=>$this->session->userdata('login_data'));
    }
    
    
    function add(){
        if ($this->data['user_data']['UserType']!=1){
            show_404();
        }
        $this->data["selected_menu"] = "assistant";
        if ($this->input->post()) {
            $this->assistantlib->add();
        }
        $this->data['batches'] = $this->batchlib->selectBatches();
        $this->load->view('assistants/add', $this->data);
    }
    
    function edit($id){
        if ($this->data['user_data']['UserType']!=1){
            show_404();
        }
        $this->data["selected_menu"] = "assistant";
        if ($this->input->post()) {
            $this->assistantlib->edit($id);
        }
        $this->data['assistant']=$this->assistantlib->details($id);
        $this->data['batches'] = $this->batchlib->selectBatches();
        $this->load->view('assistants/edit', $this->data);
    }
    
    function details($id=0){
        $this->data["selected_menu"] = "assistant";
        $this->data['assistant']=$this->assistantlib->details($id);
       
        $this->load->view('assistants/details', $this->data);
    }
    function search(){
        if ($this->data['user_data']['UserType']!=1){
            show_404();
        }
        $this->data["selected_menu"] = "assistant";
        $this->load->view('assistants/search',$this->data);
    }
    function deactive($id){
        if ($this->data['user_data']['UserType']!=1){
            show_404();
        }
       $this->assistantlib->active_deactive($id,0);
    }
    function active($id){
        if ($this->data['user_data']['UserType']!=1){
            show_404();
        }
        $this->assistantlib->active_deactive($id,1);
    }
    function searchbyfield(){
        if ($this->data['user_data']['UserType']!=1){
            show_404();
        }
        $this->assistantlib->searchbyfield();
    }

}
?>