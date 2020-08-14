<?php
/**
* 
*/
class Promethee_model extends CI_Model
{	
	function get_all()
	{	
		return $this->db->get('tb_promethee')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_promethee',$data);
	}
	function hapus($kd_rencana)
	{
		# code...
		$this->db->delete('tb_promethee',['kd_rencana'=>$kd_rencana]);
	}
	
	function prioritas($tahun,$kd_bidang)
	{
		$this->db->order_by('nilai_net_flow', 'DESC');
		$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_promethee', 'tb_rencana_pembangunan.kd_rencana = tb_promethee.kd_rencana', 'inner');				
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun', 'inner');	
		return $this->db->where(['tb_rencana_pembangunan.tahun'=>$tahun,'tb_rencana_pembangunan.kd_bidang'=>$kd_bidang])->get('tb_rencana_pembangunan')->result_array();
	}
	function cari($kd_rencana)
	{	
		return $this->db->where(['kd_rencana'=>$kd_rencana])->get('tb_promethee')->result_array();
	}
	function ubah($kd_rencana,$data)
	{	
		return $this->db->where(['kd_rencana'=>$kd_rencana])->update('tb_promethee',$data);
	}
}