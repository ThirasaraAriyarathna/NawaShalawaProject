<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ClassModel extends CI_Model {

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

    function addClass($data) {     
        $this->db->trans_begin();

        $this->db->insert('classes', $data);
        $insertedId=$this->db->insert_id();
        
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        
        return $insertedId;
    }
    
    function addClassFees($data){
        return $this->db->insert('classfees', $data);
    }
            
    function updateClass($where,$data){
        return $this->db->update('classes',$data,$where);
    }
            
    function updateClassInstance($classId,$classGroup,$date){
        $this->db->trans_begin();
        $this->db->insert('classdates', array('ClassId'=>$classId,'Date'=>$date,'ClassGroupId'=>$classGroup));
        $cdate=$this->db->insert_id();
        $this->db->update('classgroups', array('IsActive'=>1),array('ClassGroupId'=>$classGroup));
       
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        return $cdate;
    }
    function createClassInstance($classId,$class_groups,$date,$extra_class_data){
        $this->db->trans_begin();
        $this->db->insert('extragroupclasses', $extra_class_data);
        $extraId=$this->db->insert_id();
        $this->db->insert('classdates', array('ClassId'=>$classId,'Date'=>$date,'ClassGroupId'=>  implode(',', $class_groups),'ExtraClassId'=>$extraId));
        $classdate=$this->db->insert_id();
        foreach($class_groups as $class_group ){
            $this->db->update('classgroups', array('IsActive'=>1),array('ClassGroupId'=>$class_group));
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        return $classdate;
    }

    function selectClasses() {
        $this->db->select('c.ClassId,c.Name AS ClassName,c.Description,s.Name AS SubjectName,t.*,b.Name AS BatchName, b.Year as BatchYear', true);
        $this->db->from('classes as c');
        $this->db->join('teachers as t','t.TeacherId=c.TeacherId');
        $this->db->join('subjects as s','s.SubjectId=c.SubjectId');
        $this->db->join('batches as b','b.BatchId=c.BatchId');
        $this->db->where('c.IsDelete',0);
        $this->db->order_by('c.Name');
        $this->db->group_by('c.ClassId');
        $query = $this->db->get();
        return $query->result_array();
    }
    function searchClassesByClassName($className,$where,$limit=NULL,$offset=0,$type=NULL) {
        if($type!=NULL && $type==1){
            $this->db->select('SQL_CALC_FOUND_ROWS c.ClassId,c.Name AS ClassName,c.Description,s.Name AS SubjectName,t.*,b.Name AS BatchName, b.Year as BatchYear,cd.ClassDateId as ClassDateId',FALSE);
        }
        else{
            $this->db->select('SQL_CALC_FOUND_ROWS c.ClassId,c.Name AS ClassName,c.Description,s.Name AS SubjectName,t.*,b.Name AS BatchName, b.Year as BatchYear,cd.IsActive AS ActiveInstance,cd.ClassDateId as ClassDateId',FALSE);
        }
        $this->db->from('classes as c');
        $this->db->join('teachers as t', 't.TeacherId=c.TeacherId');
        $this->db->join('subjects as s', 's.SubjectId=c.SubjectId');
        $this->db->join('batches as b', 'b.BatchId=c.BatchId');
//        if($type==NULL || $type==2){
//        $this->db->join('classgroups as cg', 'cg.ClassId=c.ClassId','left');
//        }
        $this->db->join('classdates as cd', 'cd.ClassId=c.ClassId AND cd.IsActive=1','left');
        $this->db->where('c.IsDelete', 0);
        $this->db->where($where);
        $this->db->like('c.Name', $className, 'after');
        $this->db->order_by('c.Name');

        if ($offset) {
            $this->db->limit($limit, $offset);
        } else {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        $result['results']= $query->result_array();
        $count_query = $this->db->query('SELECT FOUND_ROWS()  as TotalRecords');
	$result["TotalRecords"] = $count_query->row()->TotalRecords;
        return $result;
    }
    
    function selectClassesByDay($day) {
        $this->db->select('cdt.ClassDateId,c.ClassId,c.Name AS ClassName,c.Description,s.Name AS SubjectName,t.*,b.Name AS BatchName, b.Year as BatchYear,cd.IsActive AS ActiveInstance', true);
        $this->db->from('classgroups as cd');
        $this->db->join('classes as c', 'c.ClassId=cd.ClassId AND c.IsDelete=0');
        $this->db->join('classdates as cdt', 'c.ClassId=cdt.ClassId AND cdt.IsDelete=0 ');
        $this->db->join('teachers as t', 't.TeacherId=c.TeacherId');
        $this->db->join('subjects as s', 's.SubjectId=c.SubjectId');
        $this->db->join('batches as b', 'b.BatchId=c.BatchId');
        $this->db->where('cd.DayOfWeek', $day);
        $this->db->group_by('c.ClassId');
        $this->db->order_by('c.Name');
        $query = $this->db->get();

        return $query->result_array();
    }
    function selectExtraClassesByDay($day) {
        $this->db->select('cdt.ClassDateId, c.ClassId,c.Name AS ClassName,c.Description,s.Name AS SubjectName,t.*,b.Name AS BatchName, b.Year as BatchYear,cd.IsActive AS ActiveInstance', true);
        $this->db->from('extragroupclasses as cd');
        $this->db->join('classes as c', 'c.ClassId=cd.ClassId AND c.IsDelete=0');
        $this->db->join('classdates as cdt', 'c.ClassId=cdt.ClassId AND cdt.IsDelete=0 AND cdt.IsActive=1 ');
        $this->db->join('teachers as t', 't.TeacherId=c.TeacherId');
        $this->db->join('subjects as s', 's.SubjectId=c.SubjectId');
        $this->db->join('batches as b', 'b.BatchId=c.BatchId');
        $this->db->where('cd.DayOfWeek', $day);
        $this->db->where('cd.IsActive', 1);
        $this->db->where('cd.IsDelete', 0);
        $this->db->group_by('c.ClassId');
        $this->db->order_by('c.Name');
        $query = $this->db->get();

        return $query->result_array();
    }
    
    function updateSubjectDetails($data,$where){
		return $this->db->update('subjects', $data,$where);
    }
	
    
    function  autoSuggestStates(){
         $this->db->select('ProvinceName', true);
        $this->db->from('province');
          // $this->db->like('DistrictName',$term,'after');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    function updateClassDateByOption($where,$data){
        return $this->db->update('classdates', $data,$where);
    }
    
    function updateClassGroupByOption($where,$data){
        return $this->db->update('classgroups', $data,$where);
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
    function  getClassGroupsByID($id){  
        $this->db->select('cg.*');
        $this->db->from('classgroups as cg');
        $this->db->where('cg.ClassGroupId', $id);
        $this->db->where('cg.IsDelete', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    function  getClassGroupsByClassID($id){  
        $this->db->select('cg.*');
        $this->db->from('classgroups as cg');
        $this->db->where('cg.ClassId', $id);
        $this->db->where('cg.IsDelete', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    function  getCurrentClassFeesByClassID($id){  
        $this->db->select('cf.*');
        $this->db->from('classfees as cf');
        $this->db->where('cf.ClassId', $id);
        $this->db->order_by('cf.DueDate', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    function  getClassGroupsByCondition($where){  
        $this->db->select('cg.*,c.Name as ClassName,b.Name AS BatchName, b.Year as BatchYear');
        $this->db->from('classgroups as cg');
        $this->db->join('classes as c', 'c.ClassId=cg.ClassId AND c.IsDelete=0','inner');
        $this->db->join('batches as b', 'b.BatchId=c.BatchId');
        $this->db->where($where);
        $this->db->where('cg.IsDelete', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function  getClassGroupsArrayByCondition($Ids){  
        $this->db->select('cg.*');
        $this->db->from('classgroups as cg');
        $this->db->where_in('cg.ClassGroupId',$Ids);
        $this->db->where('cg.IsDelete', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function  getAsistanstByClassID($class){  
        $this->db->select('a.Title,a.FirstName,a.LastName');
        $this->db->from('classassistants as ca');
        $this->db->join('assistants as a', 'ca.AssistantId=a.AssistantId AND a.IsActive=1','inner');
        $this->db->where('ca.IsActive', 1);
        $this->db->where('ca.ClassId', $class);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getClassDatesByCondition($where){
        $this->db->select('cd.Date');
        $this->db->from('classdates as cd');
        $this->db->where($where);
        $this->db->where('cd.IsDelete', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function getAllDetailsClassDatesByCondition($where){
        $this->db->select('cd.*');
        $this->db->from('classdates as cd');
        $this->db->where($where);
        $this->db->where('cd.IsDelete', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function getAttendanceByCondition($where){
        $this->db->select('a.ClassDateId,a.Time');
        $this->db->from('attendances as a');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getClassFeesByCondition($where){
        $this->db->select('cf.*');
        $this->db->from('classfees as cf');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }
    function  getClassByID($id){ 
        $this->db->select('c.*');
        $this->db->from('classes as c');
        $this->db->where('c.ClassId',$id);
        $this->db->where('c.IsDelete',0);
        $query = $this->db->get();
        return $query->row_array();
    } 
    function  getallClassID(){ 
        $this->db->select('c.ClassId');
        $this->db->from('classes as c');
        $this->db->where('c.IsDelete',0);
        $query = $this->db->get();
        return $query->result_array();
    } 
    function  getClassDetailsByID($id){  
        $this->db->select('c.ClassId,c.Name AS ClassName,c.Description,s.Name AS SubjectName,t.*,b.BatchId,b.Name AS BatchName, b.Year as BatchYear,GROUP_CONCAT(cg.ClassGroupId) AS ClassGroupId', true);//cd.*,cd.IsActive As IsActiveClassDate'
        $this->db->from('classes as c');
        $this->db->join('classgroups as cg', 'c.ClassId=cg.ClassId AND 	cg.IsExtraClass=0 AND cg.IsDelete=0','left');
        $this->db->join('teachers as t', 't.TeacherId=c.TeacherId');
        $this->db->join('subjects as s', 's.SubjectId=c.SubjectId');
        $this->db->join('batches as b', 'b.BatchId=c.BatchId');
        $this->db->where('c.IsDelete', 0);
        $this->db->where('c.ClassId', $id);
        $this->db->order_by('c.Name');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    
    function getClassDetailByName($query,$where){
        $this->db->select("c.ClassId,  c.Name  AS ClassName , t.FirstName , t.LastName",TRUE);
        $this->db->from('classes as c');
        $this->db->join('teachers as t', 't.TeacherId=c.TeacherId');
        $this->db->like('c.Name',$query,'after');
        $this->db->where('c.IsDelete', 0);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }
            
    function  getClassInstanceByID($classdate_id){  
        $this->db->select('c.ClassId,c.Name AS ClassName,c.Description,t.FirstName AS TFName,t.LastName AS TLName,b.Name AS BatchName, b.Year as BatchYear,cd.IsActive As IsActiveClassDate,cd.ClassDateId AS ClassDateId,IFNULL(ec.StartTime,cg.StartTime) AS StartTime,IFNULL(ec.EndTime,cg.EndTime) AS EndTime,cd.Date as ClassDate, cd.ExtraClassId,cd.ClassGroupId as ClassGropIds ', false);//cd.*,cd.IsActive As IsActiveClassDate'
        $this->db->from('classdates as cd');
        $this->db->join('classes as c', 'cd.ClassId=c.ClassId AND c.IsDelete=0','left');
        $this->db->join('extragroupclasses as ec', 'ec.ClassId=c.ClassId AND ec.ExtraClassId=cd.ExtraClassId AND ec.IsActive=1 AND ec.IsDelete=0','left');
        $this->db->join('classgroups as cg', 'cg.ClassId=c.ClassId AND cg.IsActive=1 AND cg.IsDelete=0','left');
        $this->db->join('teachers as t', 't.TeacherId=c.TeacherId');
        $this->db->join('batches as b', 'b.BatchId=c.BatchId');
        $this->db->where('cd.IsDelete', 0);
        $this->db->where('cd.IsActive', 1);
        $this->db->where('cd.ClassDateId', $classdate_id);
        $query = $this->db->get();
      //  echo $this->db->last_query();
        return $query->row_array();
    }

    function getClassDetails($where=array()){
       $this->db->select('s.*', true);
        $this->db->from('classstudents AS cs');
        $this->db->join ( "attendances as a", "a.ClassStudentId=cs.ClassStudentId  ", 'left');
        $this->db->join ( "subjects as sb", "c.SubjectId=sb.SubjectId", 'left');
        $this->db->where($where);
        $query2 = $this->db->get();
        $results= $query2->row_array();
       // $results['Subjects'] = $subject;
        return $results;
    }
    
    function isValidClassAssistant($classId,$key=NULL){
        $this->db->select('a.*', true);
        $this->db->from('classes AS c');
        $this->db->join ( "classassistants as ca", "ca.ClassId=c.ClassId AND ca.IsActive=1 ", 'inner');
        if($key==NULL){
            $this->db->join ( "assistants as a", "a.AssistantId=ca.AssistantId AND a.IsActive=1", 'inner');
        }
        else{
            $this->db->join ( "assistants as a", "a.AssistantId=ca.AssistantId AND a.IsActive=1 AND a.AssistantKey='$key'", 'inner');
        }
        $this->db->where('c.ClassId',$classId);
        $query2 = $this->db->get();
        $results= $query2->row_array();
       // $results['Subjects'] = $subject;
        return $results;
    }
    function create_group($data){
        $this->db->insert('classgroups', $data);
        return $this->db->insert_id();
    }
    
    function getStudentCountByGroup($groupid){
        $this->db->select('count(*) count', true);
        $this->db->from('groupstudents AS gs');
        $this->db->join ( "students as s", "gs.StudentId=s.StudentId AND s.IsActive=1 ", 'inner');
        $this->db->where('gs.ClassGroupId',$groupid);
        $this->db->where('gs.IsActive',1);
        $query2 = $this->db->get();
        $results= $query2->result_array();
       // $results['Subjects'] = $subject;
        return $results;
    }

    function getStudentNamesByClass($classid){

        $this->db->select('*', true);
        $this->db->from('students AS s');
        $this->db->join ( "classstudents as cs", "s.StudentId=cs.StudentId AND s.IsActive=1 ", 'inner');
        $this->db->where('cs.ClassId',$classid);
        $query = $this->db->get();
        $results = $query->result_array();
        return $results;

    }

    function getStudentNamesByGroup($groupid){

        $this->db->select('*', true);
        $this->db->from('students AS s');
        $this->db->join ( "groupstudents AS gs", "s.StudentId=gs.StudentId AND s.IsActive=1 ", 'inner');
        $this->db->where('gs.ClassGroupId',$groupid);
        $this->db->where('gs.IsActive',1);
        $query = $this->db->get();
        $results = $query->result_array();
        return $results;

    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */