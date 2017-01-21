<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BatchLib {

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
    protected $CI;

    function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->helper(array('form', 'url'));
        $this->CI->load->library('form_validation');
        $this->CI->load->library('login/loginlib');
        $this->CI->load->model('batch/batchmodel');
        $this->CI->load->helper('cookie');
        $this->loginUser = $this->CI->session->userdata('login_data');
    }


    public function add() {
        $batchDetail = array();
		$response = array("status" => "error", "html" => "", "msg" => "");
        $data = array();
       // if ($this->CI->loginlib->logged_in()) {
            $this->CI->form_validation->set_rules('batchName', 'Batch Name', 'trim|required|xss_clean');
			$this->CI->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');
            if ($this->CI->form_validation->run()) { 
                $batchDetail['AddDate']=time();
				$batchDetail['Name']=$this->CI->input->post('batchName');
				$batchDetail['Description']=$this->CI->input->post('description');
				$batchDetail['Year']=$this->CI->input->post('year');
				
				$id = $this->CI->batchmodel->addBatch($batchDetail); 
					
                    if ($id) {
						$batchDetail['id']=$id;
						$response['status']="success";
						$response['detail']=$batchDetail;
                    } else {
                        $response['messages'] = "Please try again.";
                    }
               // } else {
                //    $data['messages'] = "Please try again.";
                  //  $data['messages_type'] = "error";
               // }
                // save data to db
            } else {
                //if($this->CI->form_validation->error())
                // {

                $response['messages'] = validation_errors();
             
                //}
            }
       // } else {
         //    redirect('');
        //}
		echo json_encode($response);
        exit;
	   }
	
	public function delete() {
		$response = array("status" => "error", "html" => "", "msg" => "");
		$id=$this->CI->input->post('id', true);
		if($id){
			 if($this->CI->batchmodel->updateBatchDetails(array('IsDelete'=>1),array('BatchId'=>$id)))
			 {
				$response['status']='success';
			 }
		}
       echo json_encode($response);
        exit;
    }

    function selectBatches() {
       return $this->CI->batchmodel->selectBatches();
    }

     function loadEditBatch(){
        $id = $this->CI->input->post('id');
        $batch=$this->CI->batchmodel->getBatchByCondition(array('BatchId'=>$id));
        $response = array("status" => "error", "html" => "", "msg" => "");
        if($batch){
            $response['html'] = $this->CI->load->view('classes/edit_batch', array('details' => $batch), true);
            $response['status']='success';
        }
        echo json_encode($response);
        exit;
    }
    function  edit($id){
        $response = array("status" => "error", "html" => "", "messages" => "");
        $batch=$this->CI->batchmodel->getBatchByCondition(array('BatchId'=>$id));
        if($batch){
            $batchDetail['Name'] = $this->CI->input->post('batchName',true);
            $batchDetail['Description'] = $this->CI->input->post('description',true);
            $batchDetail['Year'] = $this->CI->input->post('year',true);
            $result=$this->CI->batchmodel->updateBatchDetails($batchDetail,array('BatchId'=>$id));
            if($result){
                $response['status']='success';
            }
        }
        echo json_encode($response);
        exit;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */