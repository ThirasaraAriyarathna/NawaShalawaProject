<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Finance extends CI_Controller {

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
	public function index()
	{
            $this->load->view('finance/index');
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
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */