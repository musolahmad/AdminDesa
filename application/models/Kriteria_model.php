<?php
/**
* 
*/
class Kriteria_model extends CI_Model
{	
	function get_all()
	{	
		return $this->db->get('tb_kriteria')->result_array();
	}
	function nomor()
	{	
		$this->db->order_by('kd_kriteria', 'DESC');
		$this->db->limit(1);		
		return $this->db->get('tb_kriteria')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_kriteria',$data);
	}
	function hapus($kd_kriteria)
	{
		# code...
		$this->db->delete('tb_kriteria',['kd_kriteria'=>$kd_kriteria]);
	}
	function cari($kd_kriteria)
	{	
		return $this->db->where(['kd_kriteria'=>$kd_kriteria])->get('tb_kriteria')->result_array();
	}
	function login($kd_kriteria,$pass)
	{	
		return $this->db->where(['kd_kriteria'=>$kd_kriteria,'pass'=>$pass])->get('tb_kriteria')->result_array();
	}
	function ubah($kd_kriteria,$data)
	{	
		return $this->db->where(['kd_kriteria'=>$kd_kriteria])->update('tb_kriteria',$data);
	}
}