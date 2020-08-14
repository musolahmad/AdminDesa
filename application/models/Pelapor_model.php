<?php
/**
* 
*/
class Pelapor_model extends CI_Model
{	
	function get_all($limit,$start)
	{	
		$this->db->order_by('tgl_buat', 'DESC');
		return $this->db->get('tb_user',$limit,$start)->result_array();
	}
	function jml()
	{	
		return $this->db->get('tb_user')->num_rows();
	}
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_user',$data);
	}
	function hapus($kd_user)
	{
		# code...
		$this->db->delete('tb_user',['kd_user'=>$kd_user]);
	}
	function cari($kd_user)
	{	
		return $this->db->where(['kd_user'=>$kd_user])->get('tb_user')->result_array();
	}
	function cekemail($email)
	{	
		return $this->db->where(['email'=>$email])->get('tb_user')->result_array();
	}
	function cektanggal($tgl)
	{	
		return $this->db->where(['tgl_buat'=>$tgl])->get('tb_user')->result_array();
	}
	function verifikasi($kd_user,$email)
	{	
		return $this->db->where(['kd_user'=>$kd_user,'email'=>$email])->get('tb_user')->result_array();
	}
	function login($kd_user,$pass)
	{	
		return $this->db->where(['kd_user'=>$kd_user,'pass'=>$pass])->get('tb_user')->result_array();
	}
	function ubah($kd_user,$data)
	{	
		return $this->db->where(['kd_user'=>$kd_user])->update('tb_user',$data);
	}
}