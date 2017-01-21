    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance extends CI_Controller {

/**
* Index Page for this controller.
*
* Maps to the following URL
* 		http://example.com/index.php/welcome
*	- or -  
* 		http://example.com/index.php/welcome/index
*	- or -
* Since this controller is set as the default controller in 
* config/routes.php, it's displayed at http://example.com/
*
* So any other public methods not prefixed with an underscore will
* map to /index.php/welcome/<method_name>
* @see http://codeigniter.com/user_guide/general/urls.html
*/
    
    function __construct() {
            parent::__construct();
            $this->scriptloader->set_module_code('attendance');
            $this->load->library('attendance/attendanceLib');
            $this->load->library('login/loginlib');
            if (!$this->loginlib->logged_in()) {
                 redirect('');
            }
            $this->data=array('user_data'=>$this->session->userdata('login_data'));
        }
   

    public function fees(){
            $this->load->view('finance/fees');
        }
    public function pay_slips(){
            $this->load->view('finance/pay_slip');
        }
    public function payment_details(){
            $this->load->view('finance/payment_details');
        }
        
    public function marking($classdate_id){
        $this->data["selected_menu"] = "attendance";
       $this->data['class_details']=$this->attendancelib->show_mark_attendance($classdate_id);
       $this->load->view('attendance/index',$this->data);
    }
    public function mark_attendance($studentClassId,$classdateId){
        $this->attendancelib->do_mark_attendance($studentClassId,$classdateId);
    }
    public function topUpStudent($studentClassId,$classFeeId,$classDateId){
        return $this->attendancelib->do_topUpStudent($studentClassId,$classFeeId,$classDateId);
    }
    public function generate_reports($classDateId){
        
        $this->data= $this->attendancelib->generate_reports($classDateId);
        $this->data["user_data"]=$this->session->userdata('login_data');
        $this->data["selected_menu"] = "attendance";
        $this->load->view('attendance/report',$this->data);
    }
    public function deactive($class_dateId){

        return $this->attendancelib->deactive($class_dateId);
    }

    public function createPdf($classDateId){

        $this->data= $this->attendancelib->generate_reports($classDateId);
        $this->data["user_data"]=$this->session->userdata('login_data');
        $this->data["selected_menu"] = "attendance";
        $this->load->view('attendance/pdf',$this->data);

    }
    


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */