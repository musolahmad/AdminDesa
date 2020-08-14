<?php
/**
* 
*/
class Bidang_model extends CI_Model
{	
	function get_all()
	{	
		return $this->db->get('tb_bidang')->result_array();
	}
	function nomor()
	{	
		$this->db->order_by('kd_bidang', 'DESC');
		$this->db->limit(1);		
		return $this->db->where(['kd_induk'=>'0'])->get('tb_bidang')->result_array();
	}
	function nomorakun($kd_bidang)
	{	
		$this->db->order_by('kd_bidang', 'DESC');
		$this->db->limit(1);		
		return $this->db->where(['kd_induk'=>$kd_bidang])->get('tb_bidang')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_bidang',$data);
	}
	function hapus($kd_bidang)
	{
		# code...
		$this->db->delete('tb_bidang',['kd_bidang'=>$kd_bidang]);
	}
	function cari($kd_bidang)
	{	
		return $this->db->where(['kd_bidang'=>$kd_bidang])->get('tb_bidang')->result_array();
	}
	function ubah($kd_bidang,$data)
	{	
		return $this->db->where(['kd_bidang'=>$kd_bidang])->update('tb_bidang',$data);
	}
	function listbidang($tahun)
	{	
		return $this->db->where('kd_bidang NOT IN (SELECT kd_bidang FROM tb_paguanggaran WHERE tahun="'.$tahun.'") AND tipe_akun="2"')->get('tb_bidang')->result_array();
	}
}