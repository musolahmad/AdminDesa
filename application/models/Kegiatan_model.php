<?php
/**
* 
*/
class Kegiatan_model extends CI_Model
{	
	function get_all()
	{	
		return $this->db->get('tb_kegiatan')->result_array();
	}
	function nomor()
	{	
		$this->db->order_by('kd_kegiatan', 'DESC');
		$this->db->limit(1);		
		return $this->db->get('tb_kegiatan')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_kegiatan',$data);
	}
	function hapus($kd_kegiatan)
	{
		# code...
		$this->db->delete('tb_kegiatan',['kd_kegiatan'=>$kd_kegiatan]);
	}
	function cari($kd_kegiatan)
	{	
		return $this->db->where(['kd_kegiatan'=>$kd_kegiatan])->get('tb_kegiatan')->result_array();
	}
	function login($kd_kegiatan,$pass)
	{	
		return $this->db->where(['kd_kegiatan'=>$kd_kegiatan,'pass'=>$pass])->get('tb_kegiatan')->result_array();
	}
	function ubah($kd_kegiatan,$data)
	{	
		return $this->db->where(['kd_kegiatan'=>$kd_kegiatan])->update('tb_kegiatan',$data);
	}
}