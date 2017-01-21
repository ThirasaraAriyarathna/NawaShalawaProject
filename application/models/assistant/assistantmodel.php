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
class Assistantmodel extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function updateAssistant($where,$data){
        return $this->db->update('assistants',$data,$where);
    }
    function addAssistant($dataSet) {
        //begin transaction
        $this->db->trans_begin();
        $this->db->insert('assistants', $dataSet);
        $id = $this->db->insert_id();
        $admissionID = 'ASST-' .(ucfirst(substr($dataSet['FirstName'], 0,1))).(ucfirst(substr($dataSet['LastName'], 0,1))).'-'. $id;
        $assistantKey = 'ASST-' . $id. rand(1000, 9999);
        $this->db->update('assistants', array('AdmissionID'=>$admissionID,'AssistantKey'=>$assistantKey), array('AssistantId' => $id));

        $this->db->update('users', array('UserName' => $admissionID), array('UserId' => $dataSet['UserId']));

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        $this->db->trans_commit();
        return array('AdmissionID'=>$admissionID,'AssistantId'=>$id,'AssistantKey'=>$assistantKey);
    }
    
    function addClassAssistant($data){
        $this->db->trans_begin();
        if(!empty($data))
        $this->db->insert_batch('classassistants',$data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        $this->db->trans_commit();
        return TRUE;
        
    }
     function updateClassAssistant($where,$data){
        return $this->db->update('classassistants',$data,$where);
    }
    function searchAssistantByAdmissionId($term){
        $this->db->select('a.*, GROUP_CONCAT(c.ClassId) AS ClassIds,GROUP_CONCAT(c.Name) AS Classes , GROUP_CONCAT( b.Name) AS BatchName, GROUP_CONCAT( b.Year) AS BatchYear',true);
        $this->db->from('assistants As a');
        $this->db->join ( "classassistants as ca", "a.AssistantId=ca.AssistantId AND ca.IsActive=1", 'left' );			
        $this->db->join ( "classes as c", "ca.ClassId=c.ClassId", 'left');
        $this->db->join ( "batches as b", "b.BatchId=c.BatchId", 'left');

        if(preg_match("/^ASST/i", $term)){
            $this->db->like('a.AdmissionID',$term,'after');
        }
        else{
              $this->db->like('CONCAT(a.FirstName," ",a.LastName)',$term,'after');
             $this->db->or_like('a.LastName',$term,'after');
        }
        $this->db->group_by('a.AssistantId');
        $query = $this->db->get();
       // echo $this->db->last_query();
        $results['results']=$query->result_array();
        return $results;
    }
     function searchAssistantById($id){
        $this->db->select('a.*, GROUP_CONCAT(c.ClassId) AS ClassIds,GROUP_CONCAT(c.Name) AS Classes , GROUP_CONCAT( b.Name) AS BatchName, GROUP_CONCAT( b.Year) AS BatchYear',true);
        $this->db->from('assistants As a');
        $this->db->join ( "classassistants as ca", "a.AssistantId=ca.AssistantId AND ca.IsActive=1", 'left' );			
        $this->db->join ( "classes as c", "ca.ClassId=c.ClassId", 'left');
        $this->db->join ( "batches as b", "b.BatchId=c.BatchId", 'left');

        $this->db->where('a.AssistantId',$id);
        $query = $this->db->get();
       // echo $this->db->last_query();
        $results['results']=$query->result_array();
        return $results;
    }
    function getAllClassesByAssistant($assistantId){
        $this->db->select('ca.ClassId',true);
        $this->db->from('classassistants As ca');
        $this->db->where('ca.IsActive',1);
        $this->db->where('ca.AssistantId',$assistantId);
         $query = $this->db->get();      
         return $query->result_array();
    }

}
