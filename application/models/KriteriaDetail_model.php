<?php
/**
* 
*/
class KriteriaDetail_model extends CI_Model
{	
	function get_all($kd_kriteria)
	{	
		return $this->db->where(['kd_kriteria'=>$kd_kriteria])->get('tb_detailkriteria')->result_array();
	}	
	function nomor($kd_kriteria)
	{	
		$this->db->order_by('kd_dtl_kriteria', 'DESC');
		$this->db->limit(1);		
		return $this->db->where(['kd_kriteria'=>$kd_kriteria])->get('tb_detailkriteria')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_detailkriteria',$data);
	}
	function hapus($kd_dtl_kriteria)
	{
		# code...
		$this->db->delete('tb_detailkriteria',['kd_dtl_kriteria'=>$kd_dtl_kriteria]);
	}
	function cari($kd_dtl_kriteria)
	{	
		return $this->db->where(['kd_dtl_kriteria'=>$kd_dtl_kriteria])->get('tb_detailkriteria')->result_array();
	}
	function login($kd_dtl_kriteria,$pass)
	{	
		return $this->db->where(['kd_dtl_kriteria'=>$kd_dtl_kriteria,'pass'=>$pass])->get('tb_detailkriteria')->result_array();
	}
	function ubah($kd_dtl_kriteria,$data)
	{	
		return $this->db->where(['kd_dtl_kriteria'=>$kd_dtl_kriteria])->update('tb_detailkriteria',$data);
	}
}