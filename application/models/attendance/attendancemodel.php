<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attendancemodel
 *
 * @author Thilani
 */
class Attendancemodel extends CI_Model  {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function insert_attendance($data){
        return $this->db->insert('attendances', $data);
    }
    
    function insert_studentfees($data){
        return $this->db->insert('studentclassfees', $data);
    }
    
    function getAllAttendanceandFeesByClassDate($classDate){
        $this->db->select('s.*,scf.Amount,cs.FeesRate,a.Time', true);
        $this->db->from('attendances AS a');
        $this->db->join ( "studentclassfees as scf", "scf.ClassDateId=a.ClassDateId AND a.ClassStudentId=scf.ClassStudentId", 'left');
        $this->db->join ( "classstudents as cs", "a.ClassStudentId=cs.ClassStudentId", 'left');
        $this->db->join ( "students as s", "s.StudentId=cs.StudentId", 'left');
        $this->db->where('a.ClassDateId',$classDate);
        $query2 = $this->db->get();
        $results= $query2->result_array();
        return $results;
    }
    
    function deactive_clssdate($where,$data){
        $this->db->trans_begin();
        $this->db->update('classdates',$data['classdate'],$where['classdate']);
        if(isset($data['extradate'])){
            $this->db->update('extragroupclasses',$data['extradate'],$where['extradate']);
        }
        foreach ($data['class_groups'] as $group){
            $this->db->update('classgroups',array('IsActive'=>0),array('ClassGroupId'=>$group));
        }
        
        
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        
        return TRUE;
    }
}
