<?php 
 
class Crud extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('m_data');
                $this->load->helper('url');
	}
  //fungsi utama untuk mengambil data dari database tabel user untuk ditampilkan di halaman v_tampil
	function index(){
		$data['user'] = $this->m_data->tampil_data()->result();
		$this->load->view('v_tampil',$data);
    }
    //fungsi untuk pergi ke halaman v_input atau tambah data
    function tambah(){
		$this->load->view('v_input');
    }
    //fungsi aksi tambah data di halaman v_input untuk ditambahkan ke database 
    function tambah_aksi(){
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$pekerjaan = $this->input->post('pekerjaan');
 
		$data = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'pekerjaan' => $pekerjaan
			);
    $this->m_data->input_data($data,'user');
    //setelah data ditambahkan, akan kembali ke halaman v_tampil yg ada di method index
		redirect('crud/index');
    }
    //fungsi aksi hapus data dari database
    function hapus($id){
		$where = array('id' => $id);
		$this->m_data->hapus_data($where,'user');
		redirect('crud/index');
    }
    //fungsi mengambil data yg akan di edit untuk ditampilkan di halaman v_edit
    function edit($id){
        $where = array('id' => $id);
        $data['user'] = $this->m_data->edit_data($where,'user')->result();
        $this->load->view('v_edit',$data);
    }
    //suatu kontrol penghubung antara model m_data fungdi update data dengan view v_edit untuk melakukan aksi update data di v_edit
    function update(){
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $pekerjaan = $this->input->post('pekerjaan');
    
        $data = array(
            'nama' => $nama,
            'alamat' => $alamat,
            'pekerjaan' => $pekerjaan
        );
    
        $where = array(
            'id' => $id
        );
    
        $this->m_data->update_data($where,$data,'user');
        redirect('crud/index');
    }
}