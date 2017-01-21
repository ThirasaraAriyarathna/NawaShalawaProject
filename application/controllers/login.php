<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

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
        $this->load->library('login/loginlib');
        $this->scriptloader->set_module_code('login-user');
    }

    public function index() {
        if ($this->loginlib->logged_in()) {
            redirect('user/dashboard');
        } else {
            $this->load->view('login/index');
        }
    }

    public function me() {
        //check the user is login
	if ($this->loginlib->logged_in()) {
            redirect('user/dashboard');
        } else {
            $data=  array();
            if($this->input->post()){
            $data = $this->loginlib->login();
            }
            $this->load->view('login/index', $data);
        }
    }
    
    public function logout(){
       $this->loginlib->logout();
       redirect('');
    }
  

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */