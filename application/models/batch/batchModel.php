<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BatchModel extends CI_Model {

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

    function addBatch($batchDetail) {      
        $this->db->insert('batches', $batchDetail);
        return $this->db->insert_id();
    }
	
    function selectBatches() {
        $this->db->select('*', true);
        $this->db->from('batches');
		$this->db->where('IsDelete',0);
        $this->db->order_by('Name');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function getBatchByCondition($where) {
        $this->db->select('*', true);
        $this->db->from('batches');
		$this->db->where('IsDelete',0);
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();
    }
	
	function updateBatchDetails($data,$where){
		return $this->db->update('batches', $data,$where);
	}
    
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */