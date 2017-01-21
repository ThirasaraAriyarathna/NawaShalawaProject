<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attendanceLib
 *
 * @author Thilani
 */
class AttendanceLib {
    protected $CI;
    function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->helper(array('form', 'url'));
        $this->CI->load->library('form_validation');
        $this->CI->load->model('attendance/attendancemodel');
        $this->CI->load->model('class/classmodel');
        $this->CI->load->model('class/classmodel');

    }
    
    function  show_mark_attendance($classdate_id){
        
       $class_details = $this->CI->classmodel->getClassInstanceByID($classdate_id);
       
       
       
       if($class_details){
           if($class_details['IsActiveClassDate']!=1){
               //$result=$this->CI->classmodel->updateClassDateByOption(array('ClassDateId'=>$class_details[0]['ClassDateId']),array('IsActive'=>1));
               $class_details['IsActiveClassDate']=1;
               if($result){
                     return $class_details;
               }
               
           }
           return $class_details;
       }
       else{
           show_404();
       }
       
    }
    
    function do_mark_attendance($studentClassId,$classdateId){
       date_default_timezone_set('UTC');
       $class_details = $this->CI->classmodel->getClassDatesByCondition(array('cd.ClassDateID'=>$classdateId,'cd.IsActive'=>1));
       //var_dump($class_details);die;
       if($class_details){
           $result=$this->CI->attendancemodel->insert_attendance(array('ClassDateId'=>$classdateId,'ClassStudentId'=>$studentClassId,'Time'=>(time())));
           if(!$result){
               $this->CI->session->set_flashdata('message-error', 'Attendance marking faled. Please try again.');
           }
           redirect('attendance/marking/'.$classdateId);
       }
       else{
           show_404();
       }
    }
    
    public function do_topUpStudent($studentClassId,$classFeeId,$classDateId){
        $this->CI->form_validation->set_rules('feesValue', 'Amount', 'trim|required|xss_clean');
        $response=array('status'=>'error','msg'=>'');
        if ($this->CI->form_validation->run()) {
             $amount=  $this->CI->input->post('feesValue',TRUE);
             $remarks=  $this->CI->input->post('remarkValue',TRUE);
             $data=array(
               'ClassStudentId'=>  $studentClassId,
                 'ClassDateId'=>$classDateId,
                 'ClassFeeId'=>$classFeeId,
                 'Amount'=>$amount,
                 'Remarks'=>$remarks,
                 'Date'=>time()
             );
             $result=$this->CI->attendancemodel->insert_studentfees($data);
             if($result){
                $response['status']='success';
             }
             else{
                $response['msg'] = 'Somthing went wrong.';
             }
        }
        else {
            $response['msg'] = validation_errors();
        }
        
        echo json_encode($response);
        exit();
        
    }
    public function generate_reports($classDateId){
        $class_data=$this->CI->classmodel->getClassInstanceByID($classDateId);
        if($class_data){
            $data['class_detail']=$class_data;
            $data['students']=$report_data=$this->CI->attendancemodel->getAllAttendanceandFeesByClassDate($classDateId);
            return $data;
        }
        else{
            show_404();
        }
      
    }
    
    public function deactive($class_dateId){
        $class_data=$this->CI->classmodel->getClassInstanceByID($class_dateId);
               
        if($class_data){
           $data['classdate']=array('IsActive'=>0);
           if($class_data['ExtraClassId']!=NULL){
               $data['extradate']=array('IsActive'=>0);
               $where['extradate']=array('ExtraClassId'=>$class_data['ExtraClassId']);
           }
           $data['class_groups']=  explode(',', $class_data['ClassGropIds']);
           $where['classdate']=array('ClassDateId'=>$class_dateId);
           $result=$this->CI->attendancemodel->deactive_clssdate($where,$data);
           
           if($result){
               $this->CI->session->set_flashdata('message-success', 'Class date deactivated successfully');
               redirect('classes/view');
               
           }
           else{
               $this->CI->session->set_flashdata('message-error', 'Attendance deactivating faled. Please try again.');
               redirect('attendance/marking/'.$classdateId);
           }
        }
        else{
            show_404();
        }
    }
    
    
}
