<?php
/**
* 
*/
class ReferensiAduan_model extends CI_Model
{	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_referensi_aduan',$data);
	}
	function hapus($kd_aduan)
	{
		# code...
		$this->db->delete('tb_referensi_aduan',['kd_aduan'=>$kd_aduan]);
	}
	function cari($kd_rencana)
	{	
		return $this->db->where(['kd_rencana'=>$kd_rencana])->get('tb_referensi_aduan')->result_array();
	}
	function lihat($kd_aduan)
	{	
		return $this->db->where(['kd_aduan'=>$kd_aduan])->get('tb_referensi_aduan')->result_array();
	}
	function ubah($kd_aduan,$data)
	{	
		return $this->db->where(['kd_aduan'=>$kd_aduan])->update('tb_referensi_aduan',$data);
	}
}