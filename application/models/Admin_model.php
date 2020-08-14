<?php
/**
* 
*/
class Admin_model extends CI_Model
{	
	function get_all_perangkat()
	{	
		return $this->db->get('tb_admin')->result_array();
	}
	function get_all()
	{	
		return $this->db->get('tb_admin')->result_array();
	}
	function nomor()
	{	
		$this->db->order_by('kd_admin', 'DESC');
		$this->db->limit(1);		
		return $this->db->get('tb_admin')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_admin',$data);
	}
	function hapus($kd_admin)
	{
		# code...
		$this->db->delete('tb_admin',['kd_admin'=>$kd_admin]);
	}
	function cari($kd_admin)
	{	
		return $this->db->where(['kd_admin'=>$kd_admin])->get('tb_admin')->result_array();
	}
	function cekemaillogin($kd_admin)
	{	
		return $this->db->where(['email'=>$kd_admin])->get('tb_admin')->result_array();
	}
	function login($kd_admin,$pass)
	{	
		return $this->db->where(['kd_admin'=>$kd_admin,'pass'=>$pass])->get('tb_admin')->result_array();
	}
	function ubah($kd_admin,$data)
	{	
		return $this->db->where(['kd_admin'=>$kd_admin])->update('tb_admin',$data);
	}
	function cekemailuser($email)
	{	
		return $this->db->where(['email'=>$email])->get('tb_user')->result_array();
	}
	function cekemailadmin($email)
	{	
		return $this->db->where(['email'=>$email])->get('tb_admin')->result_array();
	}
}