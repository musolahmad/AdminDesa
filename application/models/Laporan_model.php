<?php
/**
* 
*/
class Laporan_model extends CI_Model
{	
	function rencana($tahun)
	{	
		$this->db->select('tb_rencana_pembangunan.kd_bidang,nm_bidang');
		$this->db->group_by('tb_rencana_pembangunan.kd_bidang');	
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
		return $this->db->where(['tahun'=>$tahun,'status_pengajuan'=>'2'])->get('tb_rencana_pembangunan')->result_array();
	}
	function rencana1($tahun,$kd_bidang)
	{	
		$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');
		return $this->db->where(['tahun'=>$tahun,'status_pengajuan'=>'2','kd_bidang'=>$kd_bidang])->get('tb_rencana_pembangunan')->result_array();
	}
	function prioritas($tahun)
	{	
		$this->db->select('tb_rencana_pembangunan.kd_bidang,nm_bidang');
		$this->db->group_by('tb_rencana_pembangunan.kd_bidang');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_promethee', 'tb_promethee.kd_rencana = tb_rencana_pembangunan.kd_rencana', 'inner');
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');
		return $this->db->where(['tahun'=>$tahun,'status_pengajuan'=>'2'])->get('tb_rencana_pembangunan')->result_array();
	}
	function prioritas1($tahun,$kd_bidang)
	{	
		$this->db->order_by('nilai_net_flow', 'DESC');
		$this->db->join('tb_promethee', 'tb_promethee.kd_rencana = tb_rencana_pembangunan.kd_rencana', 'inner');
		$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');
		return $this->db->where(['tahun'=>$tahun,'status_pengajuan'=>'2','kd_bidang'=>$kd_bidang])->get('tb_rencana_pembangunan')->result_array();
	}
	function pelaksanaan($tahun)
	{	
		$this->db->select('tb_rencana_pembangunan.kd_bidang,nm_bidang');
		$this->db->group_by('tb_rencana_pembangunan.kd_bidang');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_pelaksanaan_pembangunan', 'tb_pelaksanaan_pembangunan.kd_rencana = tb_rencana_pembangunan.kd_rencana', 'inner');
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');
		return $this->db->where(['tahun'=>$tahun,'tb_pelaksanaan_pembangunan.status_pengajuan'=>'2'])->get('tb_rencana_pembangunan')->result_array();
	}
	function pelaksanaan1($tahun,$kd_bidang)
	{	
		$this->db->order_by('tgl_mulai', 'DESC');
		$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
		$this->db->join('tb_pelaksanaan_pembangunan', 'tb_pelaksanaan_pembangunan.kd_rencana = tb_rencana_pembangunan.kd_rencana', 'inner');
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');
		return $this->db->where(['tahun'=>$tahun,'tb_pelaksanaan_pembangunan.status_pengajuan'=>'2','kd_bidang'=>$kd_bidang])->get('tb_rencana_pembangunan')->result_array();
	}
}