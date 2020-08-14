<?php
/**
* 
*/
class BobotKriteria_model extends CI_Model
{	
	function get_all()
	{	
		return $this->db->get('tb_bobotkriteria')->result_array();
	}
	function nomor()
	{	
		$this->db->order_by('kd_bobot', 'DESC');
		$this->db->limit(1);		
		return $this->db->get('tb_bobotkriteria')->result_array();
	}
	function totalbobot($kd_bidang,$tahun)
	{	
		$this->db->select('sum(bobot) as nilai');
		return $this->db->where(['kd_bidang'=>$kd_bidang,'tahun'=>$tahun])->get('tb_bobotkriteria')->result_array();
	}
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_bobotkriteria',$data);
	}
	function hapus($kd_bobot)
	{
		# code...
		$this->db->delete('tb_bobotkriteria',['kd_bobot'=>$kd_bobot]);
	}
	function cari($kd_bidang,$tahun)
	{	
		$this->db->join('tb_kriteria','tb_kriteria.kd_kriteria=tb_bobotkriteria.kd_kriteria','inner');
		return $this->db->where(['kd_bidang'=>$kd_bidang,'tahun'=>$tahun])->get('tb_bobotkriteria')->result_array();
	}
	function login($kd_bobot,$pass)
	{	
		return $this->db->where(['kd_bobot'=>$kd_bobot,'pass'=>$pass])->get('tb_bobotkriteria')->result_array();
	}
	function ubah($kd_bobot,$data)
	{	
		return $this->db->where(['kd_bobot'=>$kd_bobot])->update('tb_bobotkriteria',$data);
	}
	function listkriteria($kd_bidang,$tahun)
	{
		# code...
		return $this->db->get('tb_kriteria WHERE kd_kriteria NOT IN (SELECT kd_kriteria FROM tb_bobotkriteria WHERE kd_bidang="'.$kd_bidang.'" AND tahun="'.$tahun.'")')->result_array();
	}
}