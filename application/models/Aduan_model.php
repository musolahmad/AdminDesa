<?php
/**
* 
*/
class Aduan_model extends CI_Model
{	
	function jml_masuk()
	{
		# code...
		$this->db->select('*,COUNT(*) as jml');
		$this->db->group_by('kd_aduan');
		$this->db->order_by('kd_aduan','DESC');
		$this->db->join('tb_user','tb_user.kd_user=tb_aduan.kd_user');		
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik');
		return $this->db->get('tb_aduan')->result_array();
	}
	function jml_hariini()
	{
		# code...
		$this->db->select('*,COUNT(*) as jml');
		$this->db->group_by('kd_aduan');
		$this->db->order_by('kd_aduan','DESC');
		$this->db->join('tb_user','tb_user.kd_user=tb_aduan.kd_user');
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik');
		return $this->db->where(['date(tgl_aduan)'=>date('Y-m-d')])->get('tb_aduan')->result_array();
	}
	function jml_blmbaca()
	{
		# code...
		$this->db->select('*,COUNT(*) as jml');
		$this->db->group_by('kd_aduan');
		$this->db->order_by('kd_aduan','DESC');
		$this->db->join('tb_user','tb_user.kd_user=tb_aduan.kd_user');
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik');
		return $this->db->where(['dibaca'=>'T'])->get('tb_aduan')->result_array();
	}
	function jml_blmbaca1()
	{
		# code...
		$this->db->select('*,COUNT(*) as jml');
		$this->db->group_by('kd_aduan');
		$this->db->limit(5);
		$this->db->order_by('kd_aduan','DESC');
		$this->db->join('tb_user','tb_user.kd_user=tb_aduan.kd_user');
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik');
		return $this->db->where(['dibaca'=>'T'])->get('tb_aduan')->result_array();
	}
	function jml_diterima()
	{
		# code...
		$this->db->select('*,COUNT(*) as jml');
		$this->db->group_by('kd_aduan');
		$this->db->order_by('kd_aduan','DESC');
		$this->db->join('tb_user','tb_user.kd_user=tb_aduan.kd_user');	
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik');
		$where = "status_aduan='Diterima' OR status_aduan='Diajukan'";
		return $this->db->where($where)->get('tb_aduan')->result_array();
	}
	function jml_ditolak()
	{
		# code...
		$this->db->select('*,COUNT(*) as jml');
		$this->db->group_by('kd_aduan');
		$this->db->order_by('kd_aduan','DESC');
		$this->db->join('tb_user','tb_user.kd_user=tb_aduan.kd_user');
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik');
		return $this->db->where(['status_aduan'=>'Ditolak'])->get('tb_aduan')->result_array();
	}
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_aduan',$data);
	}
	function hapus($kd_aduan)
	{
		# code...
		$this->db->delete('tb_aduan',['kd_aduan'=>$kd_aduan]);
	}
	function cari($kd_aduan)
	{	
		$this->db->join('tb_user','tb_user.kd_user=tb_aduan.kd_user');
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik');		
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_aduan.kd_dusun');
		return $this->db->where(['kd_aduan'=>$kd_aduan])->get('tb_aduan')->result_array();
	}
	function cekaduan($kd_dusun,$rt)
	{	
		$where = "tb_dusun.kd_dusun='".$kd_dusun."' AND rt='".$rt."' AND tb_aduan.status_aduan='Diterima'";
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik');		
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_aduan.kd_dusun');
		$this->db->join('tb_user','tb_user.kd_user=tb_aduan.kd_user');
		$this->db->where($where);
		return $this->db->get('tb_aduan')->result_array();
	}
	
	function ubah($kd_aduan,$data)
	{	
		return $this->db->where(['kd_aduan'=>$kd_aduan])->update('tb_aduan',$data);
	}
	function get_all_web()
	{	
		return $this->db->get('tb_website')->result_array();
	}
}