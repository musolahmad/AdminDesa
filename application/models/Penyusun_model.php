<?php
/**
* 
*/
class Penyusun_model extends CI_Model
{	
	function get_all()
	{	
		$this->db->select('tb_penyusun.*, b.nm_pegawai as nm_pegawai1, b.nm_jabatan as jabatan1, a.nm_pegawai as nm_pegawai2, a.nm_jabatan as jabatan2');
		$this->db->join('tb_admin a','a.kd_admin=tb_penyusun.kd_penanggungjawab');
		$this->db->join('tb_admin b','b.kd_admin=tb_penyusun.kd_ketua');
		return $this->db->get('tb_penyusun')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_penyusun',$data);
	}
	function hapus($th_penyusunan)
	{
		# code...
		$this->db->delete('tb_penyusun',['th_penyusunan'=>$th_penyusunan]);
	}
	function cari($th_penyusunan)
	{	
		$this->db->select('tb_penyusun.*, b.nm_pegawai as nm_pegawai1, b.nm_jabatan as jabatan1, a.nm_pegawai as nm_pegawai2, a.nm_jabatan as jabatan2');
		$this->db->join('tb_admin a','a.kd_admin=tb_penyusun.kd_penanggungjawab');
		$this->db->join('tb_admin b','b.kd_admin=tb_penyusun.kd_ketua');
		return $this->db->where(['th_penyusunan'=>$th_penyusunan])->get('tb_penyusun')->result_array();
	}
	function ubah($th_penyusunan,$data)
	{	
		return $this->db->where(['th_penyusunan'=>$th_penyusunan])->update('tb_penyusun',$data);
	}
}