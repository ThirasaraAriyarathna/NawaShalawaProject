<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SubjectModel extends CI_Model {

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
    }

    function addSubject($data) {      
        $this->db->insert('subjects', $data);
        return $this->db->insert_id();
    }
    function updateSubject($where,$data) {      
        return $this->db->update('subjects', $data,$where);
    }

    function selectSubjects() {
        $this->db->select('*', true);
        $this->db->from('subjects');
		$this->db->where('IsDelete',0);
        $this->db->order_by('Name');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getSubjectByCondition($where) {
        $this->db->select('*', true);
        $this->db->from('subjects');
	$this->db->where('IsDelete',0);
	$this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();
    }
    function updateSubjectDetails($data,$where){
		return $this->db->update('subjects', $data,$where);
	}
	
    function  autoSuggestDistrict(){
         $this->db->select('DistrictName', true);
        $this->db->from('districts');
          // $this->db->like('DistrictName',$term,'after');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    
    function  autoSuggestStates(){
         $this->db->select('ProvinceName', true);
        $this->db->from('province');
          // $this->db->like('DistrictName',$term,'after');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    
    function searchStudentByAdmissionId($term){
        $this->db->select('s.*, GROUP_CONCAT(sb.Name) AS Subjects',true);
        $this->db->from('students As s');
        $this->db->join ( "classstudents as cs", "s.StudentId=cs.StudentId", 'left' );			
        $this->db->join ( "classes as c", "cs.ClassId=c.ClassId", 'left');
        $this->db->join ( "subjects as sb", "c.SubjectId=sb.SubjectId", 'left');

        if(preg_match("/^STD/i", $term)){
            $this->db->like('s.AdmissionID',$term,'after');
        }
        else{
              $this->db->like('CONCAT(s.FirstName," ",s.LastName)',$term,'after');
             $this->db->or_like('s.LastName',$term,'after');
        }
          $this->db->group_by('s.StudentId');
        $query = $this->db->get();
       // echo $this->db->last_query();
        $results['results']=$query->result_array();
        return $results;
        
    }
    
    function  getStudentDetailByID($id){  
        $this->db->select('s.*', true);
        $this->db->from('students AS s');
        $this->db->where('s.StudentId',$id);
        $query2 = $this->db->get();
        $results= $query2->row_array();
       // $results['Subjects'] = $subject;
        return $results;
    }

    function getClassDetails($where=array()){
       $this->db->select('s.*', true);
        $this->db->from('classstudents AS cs');
        $this->db->join ( "attendances as a", "a.ClassStudentId=cs.ClassStudentId AND ", 'left');
        $this->db->join ( "subjects as sb", "c.SubjectId=sb.SubjectId", 'left');
        $this->db->where($where);
        $query2 = $this->db->get();
        $results= $query2->row_array();
       // $results['Subjects'] = $subject;
        return $results;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */