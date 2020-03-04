<?php 

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');

	}
	//fungsi untuk menampilkan halaman v_login
	function index(){
		$this->load->view('v_login');
	}
	//fungsi aksi login
	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		//dilakukan pengecekan data database menggunakan model m_login fungsi cek_login 
		$cek = $this->m_login->cek_login("admin",$where)->num_rows();
		if($cek > 0){

			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);
			$this->session->set_userdata($data_session);
			redirect(base_url("admin"));

		}else{
			//kondisi jika password atau username salah
            echo "Username dan password salah !
            <br><a href='../login'>Kembali</a>";
		}
	}
	//fungsi logout untuk menonaktifkan session
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}