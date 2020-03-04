<?php 

class Admin extends CI_Controller{

	function __construct(){
		parent::__construct();
		// method jika status tidak sama dengan login maka akan dirahkan ke halaman login kembali
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
	// fungsi index untuk menampilkan halaman admin yg sudah login
	function index(){
		$this->load->view('v_admin');
	}
}