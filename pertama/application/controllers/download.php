<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','download'));				
	}
	//menampilkan halaman v_download
	public function index(){		
		$this->load->view('v_download');
	}

	//melakukan aksi download file yang telah ter-link pada web
	public function lakukan_download(){			
		force_download('images/foto.jpg',NULL);
	}	

}