<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class StudentModel extends CI_Model {

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

    function mergeStudentByClass($class_data,$group_data) {
        //begin transaction
        $this->db->trans_begin();
        if(!empty($class_data)){
           if(array_key_exists('ClassId', $class_data) ){
            $this->db->insert('classstudents',$class_data);
               
           }
           else{
            $this->db->insert_batch('classstudents',$class_data);
               
           }
        }
      
        if(!empty($group_data)){
            if(array_key_exists('ClassGroupId', $group_data)){
            $this->db->insert('groupstudents',$group_data);
                
            }
            else{
            $this->db->insert_batch('groupstudents',$group_data);
                
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        $this->db->trans_commit();
        return TRUE;
        
    }
    function mergeStudentByGroup($group_data) {
        //begin transaction
        $this->db->trans_begin();
        
        $this->db->insert_batch('groupstudents',$group_data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        $this->db->trans_commit();
        return TRUE;
        
    }
    function addStudent($bathchId,$dataSet) {
        //begin transaction
        $this->db->trans_begin();
        
        $classStudents=(isset($dataSet['classStudent']))?$dataSet['classStudent']:NULL;
        unset($dataSet['classStudent']);
        $groupStudents=(isset($dataSet['groupStudent']))?$dataSet['groupStudent']:NULL;
        unset($dataSet['groupStudent']);
        $this->db->select('LastStudentId', true);
        $this->db->from('batches');
        $this->db->where('BatchId',$bathchId);
        $query = $this->db->get();
        $batch= $query->row_array();
        $id=(int)$batch['LastStudentId'];
        $id++;
        
        $this->db->update('batches', array('LastStudentId' => $id), array('BatchId' => $bathchId));
        
        
        $admitionIdTerm = $dataSet['AdmissionID'];
        $dataSet['AdmissionID']='STD-'. $admitionIdTerm . '-' . $batch['LastStudentId'];
        
        $this->db->insert('students', $dataSet);
        $studentId=$this->db->insert_id();
        $this->db->update('users', array('UserName' => $dataSet['AdmissionID']), array('UserId' => $dataSet['UserId']));
        
       if(isset($classStudents)){
        array_walk($classStudents, function (&$item, $key,$studentId){
                   $item['StudentId'] =intval($studentId);
               },$studentId);
               
        $this->db->insert_batch('classstudents', $classStudents);
       }
       if(isset($groupStudents)){
        array_walk($groupStudents, function (&$item, $key,$studentId){
                    $item['StudentId'] =intval($studentId);
               },$studentId);
               
        $this->db->insert_batch('groupstudents', $groupStudents);
    }       
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        $this->db->trans_commit();
        return $studentId;
    }
    
    function updateStudentByCondition($where,$dataSet) {
        return $this->db->update('students',$dataSet,$where);
    }
    function updateStudent($studentId,$dataSet) { //print_r($dataSet);die;
        //begin transaction
        $this->db->trans_begin();
        if(isset($dataSet['classStudent'])){
            $classStudents=$dataSet['classStudent'];
            unset($dataSet['classStudent']);
        }
        if(isset($dataSet['groupStudent'])){
            $groupStudents=$dataSet['groupStudent'];
            unset($dataSet['groupStudent']);
        }
        if(isset($dataSet['up_classStudent'])){
            $up_classStudents=$dataSet['up_classStudent'];
            unset($dataSet['up_classStudent']);
        }
        if(isset($dataSet['up_groupStudent'])){
            $up_groupStudents=$dataSet['up_groupStudent'];
            unset($dataSet['up_groupStudent']);
        }
       
        $this->db->update('students', $dataSet,array('StudentId'=>$studentId));
        if(isset($classStudents)){
            $this->db->insert_batch('classstudents', $classStudents);
        }
        if(isset($groupStudents)){
            $this->db->insert_batch('groupstudents', $groupStudents);
        }
        if(isset($up_classStudents)){
            foreach($up_classStudents as &$data){
                $where=array('StudentId'=>$studentId,'ClassId'=>$data['ClassId']); unset($data['ClassId']);
                $this->db->update('classstudents', $data,$where);
            }
        }
        if(isset($up_groupStudents)){
            foreach($up_groupStudents as &$data){
                $where = array('StudentId'=>$studentId,'ClassGroupId'=>$data['ClassGroupId']);unset($data['ClassGroupId']);
                $this->db->update('groupstudents', $data,$where);
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        $this->db->trans_commit();
        return TRUE;
    }

    function selectBatches() {
        $this->db->select('*', true);
        $this->db->from('batches');
        //$this->db->group_by('Name');
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
         $this->db->where('s.IsActive',1);
          $this->db->group_by('s.StudentId');
        $query = $this->db->get();
       // echo $this->db->last_query();
        $results['results']=$query->result_array();
        return $results;
        
    }
    
  
    function viewFullDetailStudentByAdmissionId($term,$classID,$date){
        $this->db->select("s.*,cs.*,b.*,c.Name AS ClassName,c.Description AS ClassDescription,cs.ClassStudentId,cs.FeesRate,cf.Amount AS ClassFees,(cs.FeesRate*cf.Amount) AS classPayment,GROUP_CONCAT(DISTINCT gs.ClassGroupId) AS ClassGroups,GROUP_CONCAT(DISTINCT IF(cg.IsActive=1,1,0)) AS IsActiveClassGroups,GROUP_CONCAT( DISTINCT cg.DayOfWeek) AS ClassGroupDays,GROUP_CONCAT(DISTINCT cg.StartTime) AS ClassGroupStartTime,GROUP_CONCAT(DISTINCT cg.EndTime) AS ClassGroupEndTime,GROUP_CONCAT(cf.Month) AS FeesDates",false);
        $this->db->from('students As s');
        $this->db->join ( "classstudents as cs", "s.StudentId=cs.StudentId AND cs.ClassId=".$classID, 'left' );			
        $this->db->join ( "batches as b", "b.BatchId=s.BatchId", 'inner');
        $this->db->join ( "classes as c", "c.ClassId=cs.ClassId AND c.BatchId = b.BatchId ", 'inner');
        $this->db->join ( "classfees as cf", "cf.ClassId=c.ClassId " , 'left');
        $this->db->join ( "classgroups as cg", "cg.ClassId=c.ClassId", 'left');
        $this->db->join ( "groupstudents as gs", "s.StudentId=gs.StudentId AND gs.ClassGroupId=cg.ClassGroupId", 'inner' );			

        if(preg_match("/^STD/i", $term)){
            $this->db->like('s.AdmissionID',$term,'after');
        }
        else{
              $this->db->like('CONCAT(s.FirstName," ",s.LastName)',$term,'after');
             $this->db->or_like('s.LastName',$term,'after');
        }
       $this->db->group_by('s.StudentId');
        $query = $this->db->get();
        //echo $this->db->last_query();
        $results['results']=$query->result_array();
        return $results;
    }
    
  
    function  getStudentClassFeesByCondition($classStdID,$date,$where){
        $this->db->select('*', true);
        $this->db->from('classfees AS cf');
        $this->db->join('studentclassfees scf', "cf.ClassFees=scf.ClassFeeId AND scf.ClassStudentId = $classStdID  AND scf.Date>= $date",'left');
        $this->db->where($where);
        $query2 = $this->db->get();
        $results= $query2->result_array();
       // $results['Subjects'] = $subject;
        return $results;
        
    }
    
    function  getClassStudentDetailByID($id){
        $this->db->select('cs.*,c.Name as ClassName,t.FirstName,t.LastName', true);
        $this->db->from('classstudents AS cs');
        $this->db->join('classes c', 'cs.ClassId=c.ClassId','left');
        $this->db->join('teachers t', 't.TeacherId=c.TeacherId','left');
        $this->db->where('cs.StudentId',$id);
        $this->db->where('cs.IsActive',1);
        $query2 = $this->db->get();
        $results= $query2->result_array();
       // $results['Subjects'] = $subject;
        return $results;
        
    }
    
    function  getGroupStudentDetailByID($id){
        $this->db->select('gs.*,cg.*', true);
        $this->db->from('groupstudents AS gs');
        $this->db->join('classgroups cg', 'gs.ClassGroupId=cg.ClassGroupId','left');
        $this->db->where('gs.StudentId',$id);
        $this->db->where('gs.IsActive',1);
        $query2 = $this->db->get();
        $results= $query2->result_array();
       // $results['Subjects'] = $subject;
        return $results;
        
    }
    
    function  getStudentDetailByID($id){
        //$firstDate=  strftime($format)
        $this->db->select('s.*,u.DateAdded', true);
        $this->db->from('students AS s');
        $this->db->join('users u', 's.UserId=u.UserId','inner');
        $this->db->join('classstudents cs', 'cs.StudentId=s.StudentId','left');
        $this->db->join('attendances a', 'cs.ClassStudentId=a.ClassStudentId','left');
        $this->db->join('studentclassfees scf', 'scf.ClassStudentId=cs.ClassStudentId','left');
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
    
    function getStudentFullDetails($studentId){
        $this->db->select('s.*', true);
        $this->db->from('students AS s');
        $this->db->where('s.StudentId',$studentId);
        $query2 = $this->db->get();
        $results['results']=$query->result_array();
        return $results;
    }
    
    function getStudentByFilters($classId=NULL,$groupId=NULL,$studentId=NULL){
        $this->db->select('s.StudentId', true);
        if($classId!=NULL)
            $this->db->from('classstudents AS cs');
        if($groupId!=NULL)
            $this->db->from('groupstudents AS cs');
        $this->db->join ( "students as s", "cs.StudentId=s.StudentId AND s.IsActive=1", 'left');
        if($classId!=NULL)
            $this->db->where('cs.ClassId',$classId);
        if($groupId!=NULL)
            $this->db->where('cs.ClassGroupId',$groupId);
        if($studentId!=NULL)
            $this->db->where('cs.StudentId',$studentId);
        
        $query2 = $this->db->get();
        
        $results= $query2->result_array();
        return $results;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */