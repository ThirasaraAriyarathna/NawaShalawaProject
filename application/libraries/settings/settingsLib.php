<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of settingsLib
 *
 * @author wachiral
 */
class settingsLib {
    
    function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->helper(array('form', 'url'));
        $this->CI->load->library('form_validation');
        $this->CI->load->model('login/loginmodel');
        $this->CI->load->model('settings/settingmodel');
        $this->CI->load->helper('cookie');
    }
    
    function change_password(){
        $this->CI->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
        $this->CI->form_validation->set_rules('new_password', 'New Password', 'trim|required|matches[new_confirm_password]|xss_clean');
        $this->CI->form_validation->set_rules('new_confirm_password', 'New Confirm Password', 'trim|required|xss_clean');
        if ($this->CI->form_validation->run()) {
            $old_password=$this->CI->input->post('old_password');
            $new_password=$this->CI->input->post('new_password');
            $new_confirm_password=$this->CI->input->post('new_confirm_password');
            $user_data=$this->CI->session->userdata('login_data');
            $oldPassword=$this->CI->loginmodel->hash_password($old_password,$user_data['Salt']);
            if($oldPassword==$user_data['Password']){
                $newPassword=$this->CI->loginmodel->createPassword($new_password);
                $data=array(
                    'Password'=>$newPassword['password'],
                    'Salt'=>$newPassword['salt']
                );
                $result = $this->CI->settingmodel->updatePassword(array('UserId'=>$user_data['UserId']),$data);
                if($result){
                    
                    $this->CI->session->set_flashdata('message-success', 'Password changed successfully.');
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
                else{
                    $this->CI->session->set_flashdata('message-error', 'Sorry, Password changeing fail.');
                }
            }
            else{
                $this->CI->session->set_flashdata('message-error', 'Please enter correct old password.');
            }
        }
        else{
            $messages = validation_errors();
            $this->CI->session->set_flashdata('message-error', $messages);
        }
        redirect('settings/change_password');
    }
}
