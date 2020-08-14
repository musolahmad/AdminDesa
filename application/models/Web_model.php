<?php
/**
* 
*/
class Web_model extends CI_Model
{	
	function get_all()
	{	
		return $this->db->get('tb_website')->result_array();
	}
	function nomor()
	{	
		$this->db->order_by('kd_web', 'DESC');
		$this->db->limit(1);		
		return $this->db->get('tb_website')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_website',$data);
	}
	function hapus($kd_web)
	{
		# code...
		$this->db->delete('tb_website',['kd_web'=>$kd_web]);
	}
	function cari($kd_web)
	{	
		return $this->db->where(['kd_web'=>$kd_web])->get('tb_website')->result_array();
	}
	function login($kd_web,$pass)
	{	
		return $this->db->where(['kd_web'=>$kd_web,'pass'=>$pass])->get('tb_website')->result_array();
	}
	function ubah($kd_web,$data)
	{	
		return $this->db->where(['kd_web'=>$kd_web])->update('tb_website',$data);
	}
}