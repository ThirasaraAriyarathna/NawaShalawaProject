<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TeacherModel extends CI_Model {

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

    function addTeacher($dataSet) {
        //begin transaction
        $this->db->trans_begin();
		$this->db->insert('teachers', $dataSet);
		$id = $this->db->insert_id();
		$admissionID = 'TCH-'.$id;
		$this->db->update('teachers', array('AdmissionID' => $admissionID), array('TeacherId' => $id));

        $this->db->update('users', array('UserName' => $admissionID), array('UserId' => $dataSet['UserId']));
        
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        $this->db->trans_commit();
        return TRUE;
    }

    function updateTeacherBycondition($where,$data){
        return $this->db->update('teachers', $data, $where);;   
    }
    function selectTeachers() {
        $this->db->select('*', true);
        $this->db->from('teachers');
		$this->db->where('IsActive',1);
        $this->db->order_by('FirstName');
        $query = $this->db->get();
        return $query->result_array();
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
    
    function  getTeacherDetailByID($id){  
        $this->db->select('t.*,u.DateAdded', true);
        $this->db->from('teachers AS t');
        $this->db->join ( "users as u", "u.UserId=t.UserId", 'inner');
        $this->db->where('t.TeacherId',$id);
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
      function searchTeacherByAdmissionId($term){
         $this->db->select('t.*',true);
        $this->db->from('teachers As t');
        if(preg_match("/^TCH/i", $term)){
            $this->db->like('t.AdmissionID',$term,'after');
        }
        else{
              $this->db->like('CONCAT(t.FirstName," ",t.LastName)',$term,'after');
             $this->db->or_like('t.LastName',$term,'after');
        }
         $this->db->where('t.IsActive',1);
          $this->db->group_by('t.TeacherId');
        $query = $this->db->get();
       // echo $this->db->last_query();
        $results['results']=$query->result_array();
        return $results;
        
    }
    
    function getClassesByTeacherId($id){
        $this->db->select('c.Name as ClassName,b.Name as BatchName,b.Year as BatchYear',true);
        $this->db->from('classes As c');
        $this->db->join ( "batches as b", "c.BatchId=b.BatchId", 'left');

        $this->db->where('c.IsDelete',0);
        $this->db->where('c.TeacherId',$id);
        $this->db->group_by('c.ClassId');
        $query = $this->db->get();
       
        return $query->result_array();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */