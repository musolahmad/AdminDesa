<?php
/**
* 
*/
class TopikAduan_model extends CI_Model
{	
	function get_all()
	{	
		return $this->db->get('tb_topik_aduan')->result_array();
	}
	function nomor()
	{	
		$this->db->order_by('kd_topik', 'DESC');
		$this->db->limit(1);		
		return $this->db->get('tb_topik_aduan')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_topik_aduan',$data);
	}
	function hapus($kd_topik)
	{
		# code...
		$this->db->delete('tb_topik_aduan',['kd_topik'=>$kd_topik]);
	}
	function cari($kd_topik)
	{	
		return $this->db->where(['kd_topik'=>$kd_topik])->get('tb_topik_aduan')->result_array();
	}
	function login($kd_topik,$pass)
	{	
		return $this->db->where(['kd_topik'=>$kd_topik,'pass'=>$pass])->get('tb_topik_aduan')->result_array();
	}
	function ubah($kd_topik,$data)
	{	
		return $this->db->where(['kd_topik'=>$kd_topik])->update('tb_topik_aduan',$data);
	}
}