<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Title           ScriptLoader class library
 *
 * @package        LMJ-elephanti
 * Location        application/frontend/libraries/util
 *
 * @author         Hayesha - <<hayeshais[at]gmail[dot]com>>
 * @copyright      Cyber L-M-J
 *
 * created on      07-09-2011, 10:30AM by Hayesha
 * updated on      dd-mm-yyy, hh:mm by {name}
 *
 * Description     This file have many functions associate with ScriptLoader module
 *
 * */

class ScriptLoader
{

    /**
     * CodeIgniter global
     *
     * @var string
     **/
    protected $ci;


    /**
     * Array varialble to hold scripts
     *
     * @var string
     **/
    protected $scripts = array();


    /**
     * String varialble to hold the module code
     *
     * @var string
     **/
    private $module_code = '';
    
    
    /**
     * String varialble to hold the module code
     *
     * @var string
     **/
    private $layout = 'sidebar-left';


    /**
     * Array varialble to hold all the resources
     *
     * @var string
     **/
    protected $resources = array();


    /**
     * Array varialble to hold metadata
     *
     * @var string
     **/
    protected $metadata = array();


    /**
     * Array varialble to hold metadata resources
     *
     * @var string
     **/
    protected $meta_resources = array();



    /**
     * __construct
     *
     * @param none
     * @access public
     * @return void
     * @author Hayesha - hayesha.somarathne@cyberlmj.com
     **/
    public function __construct()
    {
        $this->ci =& get_instance();
        //load the script config file located as config/scriptfiles.php
        $this->ci->load->config('scriptfiles', TRUE);
	$this->scripts = $this->ci->config->item('scriptfiles');
		//load the script config file located as config/seo_metadata.php
        $this->ci->load->config('seo_metadata', TRUE);
	$this->meta_resources = $this->ci->config->item('seo_metadata');
    }


    /**
     * This set the module code
     *
     * @param string $module_code
     * @access public
     * @return none
     * @author Hayesha - hayesha.somarathne@cyberlmj.com
     **/
	public function set_module_code($module_code = NULL,$layout="sidebar-left") {
		
		//$last_update = date("M d Y H:i:s", strtotime("2012-07-20"));

		//set the header parameter 
		/* $this->ci->output->set_header("HTTP/1.0 200 OK");
		$this->ci->output->set_header("HTTP/1.1 200 OK");
		//$this->ci->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_update).' GMT');
		$this->ci->output->set_header('Last-Modified: '.$last_update.' GMT');
		$this->ci->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->ci->output->set_header("Cache-Control: post-check=0, pre-check=0");
		$this->ci->output->set_header("Pragma: no-cache");  */

		$this->module_code = $module_code;

		$this->set_scripts();
		$this->ci->session->set_userdata('scripts', $this->get_scripts());

		$this->set_metadata();
                //load the module specific SEO Metadata
                $this->ci->session->set_userdata('metadata', $this->get_metadata());
                
                //layout defined here
                $this->set_layout($layout);
                $this->ci->session->set_userdata('layout', $this->get_layout());
	}


    /**
     * This set the module code
     *
     * @param none
     * @access public
     * @return string $module_code
     * @author Hayesha - hayesha.somarathne@cyberlmj.com
     **/
	public function get_module_code() {

		return $this->module_code;

	}



    /**
     * This will extract the respective JavaScript & CSS files belongs to the current module
     * (that matches the module code) that is pass form the config/scriptfiles.php
     *
     * @param none
     * @access public
     * @return none
     * @author Hayesha - hayesha.somarathne@cyberlmj.com
     **/
    private function set_scripts()
    {
    	//set CSS & JavaScript files
    	$this->resources['css'] = $this->scripts['css-'.$this->get_module_code()];
    	$this->resources['css_ie'] = $this->scripts['css-'.$this->get_module_code().'-ie'];
    	$this->resources['css_3rd'] = $this->scripts['css-'.$this->get_module_code().'-3rd'];
    	$this->resources['css_print'] = $this->scripts['css-'.$this->get_module_code().'-print'];
    	$this->resources['js'] = $this->scripts['js-'.$this->get_module_code()];
    	$this->resources['js_ie'] = $this->scripts['js-'.$this->get_module_code().'-ie'];
    	$this->resources['js_scripts'] = $this->scripts['js-'.$this->get_module_code().'-scripts'];
    	$this->resources['js_3rd'] = $this->scripts['js-'.$this->get_module_code().'-3rd'];
        // Hemantha Wijesinghe - 25-07-2013 
        $this->resources['js_external'] = @$this->scripts['js-'.$this->get_module_code().'-external']; 
    }




    /**
     * This will extract the respective SEO Metadata files belongs to the current module
     * (that matches the module code) that is pass form the config/scriptfiles.php
     *
     * @param none
     * @access public
     * @return none
     * @author Hayesha - hayesha.somarathne@cyberlmj.com
     **/
    private function set_metadata()
    {
		//set SEO metadata
    	//$this->metadata['keywords'] = $this->meta_resources[$this->get_module_code().'-meta-keywords'];
    	//$this->metadata['description'] = $this->meta_resources[$this->get_module_code().'-meta-description'];
    }



    /**
     * This will pass all the related JavaScript & CSS files that belongs to the current module to view.
     *
     * @param none
     * @access public
     * @return array
     * @author Hayesha - hayesha.somarathne@cyberlmj.com
     **/
    public function get_scripts()
    {
    	return $this->resources;
    }


    /**
     * This will pass all the related SEO Metadata that belongs to the current module to the View.
     *
     * @param none
     * @access public
     * @return array
     * @author Hayesha - hayesha.somarathne@cyberlmj.com
     **/
    public function get_metadata()
    {
    	return $this->metadata;
    }
    
    
    /**
     * This set the module code
     *
     * @param string
     * @access public
     * @return string $layout
     * @author Hayesha - hayesha.somarathne@cyberlmj.com
     **/
    public function set_layout($layout) {
        $this->layout = $layout;
    }
    
    /**
     * This set the module code
     *
     * @param none
     * @access public
     * @return string $layout
     * @author Hayesha - hayesha.somarathne@cyberlmj.com
     **/
    public function get_layout() {
        return $this->layout;
    }



}

/* End of file ScriptLoader.php */
/* Location: ./application/frontend/libraries/util/ScriptLoader.php */