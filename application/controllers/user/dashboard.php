<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
      
        $this->scriptloader->set_module_code('dashboard');
        $this->load->library('login/loginlib');
        if (!$this->loginlib->logged_in()) {
             show_404();
        }
        $this->data=array('user_data'=>$this->session->userdata('login_data'));
    }

    public function index() {
        
            $this->data["selected_menu"] = "dashboard";
            $this->data["UserDetails"]=$this->session->userdata('login_data');
            $this->load->view('user/dashboard/index', $this->data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */