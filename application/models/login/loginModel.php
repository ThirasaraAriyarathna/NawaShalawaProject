<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginModel extends CI_Model {

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
        $this->load->database();
        $this->load->config('auth', TRUE);
        $this->store_salt = $this->config->item('store_salt', 'auth');
        $this->salt_length = $this->config->item('salt_length', 'auth');
    }

    /**
     * Generates a random salt value.
     *
     * @return void
     * @author Thilani
     * */
    public function salt() {
        return substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
    }

    /**
     * Hashes the password to be stored in the database.
     *
     * @return void
     * @author Thilani
     * */
    public function hash_password($password, $salt = false) {
        if (empty($password)) {
            return FALSE;
        }

        if ($this->store_salt && $salt) {
            return sha1($password . $salt);
        } else {
            $salt = $this->salt(); //get salt key
            return $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
        }
    }

    /**
     * This function takes a password and validates it
     * against an entry in the users table.
     *
     * @return void
     * @author Thilani
     * */
    public function hash_password_db($email, $password) {
        if (empty($email) || empty($password)) {
            return FALSE;
        }

        $query = $this->db->select('password')
                ->select('salt')
                ->where('UserName', $email)
                ->limit(1)
                ->get('users');

        $result = $query->row();
        if ($query->num_rows() !== 1) {
            return FALSE;
        }

        if ($this->store_salt) {//check store_salt is set
            return sha1($password . $result->salt);
        } else {
            $salt = substr($result->password, 0, $this->salt_length); //get salt
            //return new password
            return $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
        }
    }

    /**
     * This function is used to get login detail relavent username
     * @param string $userName , string $password
     * @return array
     * @author Thilani
     */
    function login($email, $password) {

        $password = $this->hash_password_db($email, $password);

        $this->db->select('*', true);
        $this->db->from('users');
        $this->db->where('UserName', $email);
        $this->db->where('password', $password);
        $query = $this->db->get();
        $result = $query->row();
        if ($query->num_rows() == 1) {
            $user_data = $this->get_loged_user_data($result->UserId);
       // var_dump($user_data);die;
            if ($user_data)
                return $user_data;
            else
                return false;
        }
        return false;
    }

    /**
     * Get Loged User Details
     * @param type $userId
     * @return array 
     */
    function get_loged_user_data($userId) {
        $this->db->select('a.*,u.*', true);
        $this->db->from('assistants as a');
        $this->db->join ( "users as u", "a.UserId=u.UserId");		
        $this->db->where('a.UserId', $userId);
        $this->db->where('a.IsActive', 1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function createPassword($password){
        $salt = $this->store_salt ? $this->salt() : FALSE;
        $password = $this->hash_password($password, $salt);
        return array('password'=>$password,'salt'=>$salt);
    }
    function register( $password, $userType, $date, $dataAddedBy) {

        $salt = $this->store_salt ? $this->salt() : FALSE;
        $password = $this->hash_password($password, $salt);

        // Users table.
        $data = array(
            'UserName' => '',
            'Password' => $password,
            'Salt' => $salt,
            'UserType' => $userType,
            'DateAdded' => $date,
            'AddedBy' => $dataAddedBy
        );
        //begin transaction
        $insertedId=0;
        $this->db->trans_begin();

        $this->db->insert('users', $data);
        $insertedId=$this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return $insertedId;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */