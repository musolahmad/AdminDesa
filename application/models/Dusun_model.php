<?php
/**
* 
*/
class Dusun_model extends CI_Model
{	
	function get_all()
	{	
		return $this->db->get('tb_dusun')->result_array();
	}
	function nomor()
	{	
		$this->db->order_by('kd_dusun', 'DESC');
		$this->db->limit(1);		
		return $this->db->get('tb_dusun')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_dusun',$data);
	}
	function hapus($kd_dusun)
	{
		# code...
		$this->db->delete('tb_dusun',['kd_dusun'=>$kd_dusun]);
	}
	function cari($kd_dusun)
	{	
		return $this->db->where(['kd_dusun'=>$kd_dusun])->get('tb_dusun')->result_array();
	}
	function login($kd_dusun,$pass)
	{	
		return $this->db->where(['kd_dusun'=>$kd_dusun,'pass'=>$pass])->get('tb_dusun')->result_array();
	}
	function ubah($kd_dusun,$data)
	{	
		return $this->db->where(['kd_dusun'=>$kd_dusun])->update('tb_dusun',$data);
	}
	function rt()
	{	
		$this->db->order_by('jml_rt', 'DESC');
		$this->db->limit(1);
		return $this->db->get('tb_dusun')->result_array();
	}
}