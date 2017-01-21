<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {
   function __construct() {
       parent::__construct();
        $this->scriptloader->set_module_code('settings');
        $this->load->library('settings/settingsLib');
        $this->load->library('login/loginlib');
         if (!$this->loginlib->logged_in()) {
             redirect('');
        }
        $this->data=array('user_data'=>$this->session->userdata('login_data'));
   }
   
   function change_password(){
        $this->data["selected_menu"] = "settings";
        if ($this->input->post()) {
            $this->settingslib->change_password();
        }
        $this->load->view('settings/change_password', $this->data);
   }
}
