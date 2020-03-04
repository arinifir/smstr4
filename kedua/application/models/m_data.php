<?php 
 
class M_data extends CI_Model{
	//untuk menampilkan seluruh data pasa tabel user
	function tampil_data(){
		return $this->db->get('user');
    }
	
	//aksi menambahkan data
    function input_data($data,$table){
		$this->db->insert($table,$data);
    }
 
	//untuk menghapus data
	function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
    }
	
	//untuk menampilkan data berdasarkan id
    function edit_data($where,$table){		
		return $this->db->get_where($table,$where);
	}
 
	//mengubah data
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
}