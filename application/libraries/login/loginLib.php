<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginLib {

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
        $this->CI->load->model('login/loginmodel');
        $this->CI->load->helper('cookie');
    }
   

    public function logged_in() {
        return (bool) $this->CI->session->userdata('login_data');
    }

    public function login() {
        $username = $this->CI->input->post('username', true);
        $password = $this->CI->input->post('password', true);
        $this->CI->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('password', 'Password', 'trim|required');
        $data = array();

        if ($this->CI->form_validation->run()) {
            $results = $this->CI->loginmodel->login($username, $password);
            if ($results) {
                if ($results['UserType'] == 1 || $results['UserType'] == 2){
                    if ($this->_set_login_session($results))
                        redirect('user/dashboard');
                }
                else {
                    $data['message'] = "Not allow to log in.";
                }
            } else {
                $data['message'] = "Incorrect username or password.";
            }
        } else {
            $data['message'] = validation_errors();
        }
        return $data;
    }

    public function logout() {
        $this->CI->session->unset_userdata('login_data');
        //delete the remember me cookies if they exist
        if (get_cookie('Email')) {
            delete_cookie('Email');
        }
        if (get_cookie('RememberCode')) {
            delete_cookie('RememberCode');
        }
        $this->CI->session->sess_destroy();
        return TRUE;
    }

    /**
     * set login session data
     *
     * @return void
     * @author Thilani
     * */
    private function _set_login_session($user_data = false) {
        if ($user_data) {
            $this->CI->session->set_userdata('login_data', $user_data);
            return TRUE;
        }
        return FALSE;
    }

    function register($password, $userType, $date, $dataAddedBy) {
        return $this->CI->loginmodel->register($password, $userType, $date, $dataAddedBy);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */