<?php
/**
* 
*/
class Aduan_masyarakat_model extends CI_Model
{	
	function jmlditerima($kd_user)
	{	
		$where = "status_aduan ='Diterima' AND kd_user='".$kd_user."' ";
		$this->db->where($where);
		return $this->db->get('tb_aduan')->num_rows();
	}
	function jmldiajukan($kd_user)
	{	
		$where = "status_aduan ='Diajukan' AND kd_user='".$kd_user."' ";
		$this->db->where($where);
		return $this->db->get('tb_aduan')->num_rows();
	}
	function jmlditolak($kd_user)
	{	
		$where = "kd_user='".$kd_user."' AND status_aduan ='Ditolak'";
		$this->db->where($where);
		return $this->db->get('tb_aduan')->num_rows();
	}
	function jmlmasuk($kd_user)
	{	
		$where = "kd_user='".$kd_user."' AND status_aduan ='Masuk'";
		$this->db->where($where);
		return $this->db->get('tb_aduan')->num_rows();
	}
	function jmltotal($kd_user)
	{	
		$where = "kd_user='".$kd_user."'";
		$this->db->where($where);
		return $this->db->get('tb_aduan')->num_rows();
	}
}