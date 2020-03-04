<?php 
 
class M_data extends CI_Model{
	//fungsi mengambil data user dari database
	function ambil_data(){
		return $this->db->get('user');
	}
}