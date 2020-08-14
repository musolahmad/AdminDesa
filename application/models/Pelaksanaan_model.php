<?php
/**
* 
*/
class Pelaksanaan_model extends CI_Model
{	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_pelaksanaan_pembangunan',$data);
	}
	function hapus($kd_rencana)
	{
		# code...
		$this->db->delete('tb_pelaksanaan_pembangunan',['kd_rencana'=>$kd_rencana]);
	}
	function cari($kd_rencana)
	{	
		return $this->db->where(['kd_rencana'=>$kd_rencana])->get('tb_pelaksanaan_pembangunan')->result_array();
	}
	function ubah($kd_rencana,$data)
	{	
		return $this->db->where(['kd_rencana'=>$kd_rencana])->update('tb_pelaksanaan_pembangunan',$data);
	}
	function get_all($tahun)
	{
		# code...
		$this->db->group_by('tb_rencana_pembangunan.kd_bidang');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_paguanggaran', 'tb_paguanggaran.kd_bidang = tb_bidang.kd_bidang', 'inner');				
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun', 'inner');	
		return $this->db->where(['tb_rencana_pembangunan.tahun'=>$tahun,'status_pengajuan'=>'2'])->get('tb_rencana_pembangunan')->result_array();
	}
	function no($tahun)
	{
		# code...
		$this->db->order_by('tb_rencana_pembangunan.kd_bidang');
		$this->db->limit(1);
		$this->db->group_by('tb_rencana_pembangunan.kd_bidang');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_paguanggaran', 'tb_paguanggaran.kd_bidang = tb_rencana_pembangunan.kd_bidang', 'inner');				
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun', 'inner');	
		return $this->db->where(['tb_rencana_pembangunan.tahun'=>$tahun,'status_pengajuan'=>'2'])->get('tb_rencana_pembangunan')->result_array();
	}
	function no1($tahun,$kd_bidang)
	{
		# code...
		$this->db->order_by('tb_rencana_pembangunan.kd_bidang');
		$this->db->limit(1);
		$this->db->group_by('tb_rencana_pembangunan.kd_bidang');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_paguanggaran', 'tb_paguanggaran.kd_bidang = tb_rencana_pembangunan.kd_bidang', 'inner');				
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun', 'inner');	
		return $this->db->where(['tb_rencana_pembangunan.tahun'=>$tahun,'tb_rencana_pembangunan.kd_bidang'=>$kd_bidang,'status_pengajuan'=>'2'])->get('tb_rencana_pembangunan')->result_array();
	}
	function jml($tahun,$kd_bidang)
	{
		# code...
		$this->db->join('tb_pelaksanaan_pembangunan', 'tb_pelaksanaan_pembangunan.kd_rencana = tb_rencana_pembangunan.kd_rencana', 'inner');
		return $this->db->where(['tahun'=>$tahun,'kd_bidang'=>$kd_bidang])->get('tb_rencana_pembangunan')->num_rows();
	}
	function totaladuan($tahun,$kd_bidang,$status_pengajuan)
	{
		$this->db->join('tb_pelaksanaan_pembangunan', 'tb_pelaksanaan_pembangunan.kd_rencana = tb_rencana_pembangunan.kd_rencana', 'inner');
		return $this->db->where(['tahun'=>$tahun,'kd_bidang'=>$kd_bidang,'tb_pelaksanaan_pembangunan.status_pengajuan'=>$status_pengajuan])->get('tb_rencana_pembangunan')->num_rows();
	}
	function totalanggaran($tahun,$kd_bidang)
	{	
		$this->db->select('sum(biaya) as biaya');
		$this->db->group_by('kd_bidang');
		$this->db->join('tb_pelaksanaan_pembangunan', 'tb_pelaksanaan_pembangunan.kd_rencana = tb_rencana_pembangunan.kd_rencana', 'inner');
		return $this->db->where(['tahun'=>$tahun,'kd_bidang'=>$kd_bidang,'tb_pelaksanaan_pembangunan.status_pengajuan'=>'2'])->get('tb_rencana_pembangunan')->result_array();
	}
	function pelaksanaan($tahun,$kd_bidang)
	{
		$this->db->select('tb_pelaksanaan_pembangunan.*, tb_rencana_pembangunan.rt, tb_dusun.rw, tb_rencana_pembangunan.biaya, tb_bidang.*,tb_kegiatan.*');
		$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_pelaksanaan_pembangunan', 'tb_pelaksanaan_pembangunan.kd_rencana = tb_rencana_pembangunan.kd_rencana', 'inner');			
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun', 'inner');	
		return $this->db->where(['tb_rencana_pembangunan.tahun'=>$tahun,'tb_rencana_pembangunan.kd_bidang'=>$kd_bidang])->get('tb_rencana_pembangunan')->result_array();
	}
	function get_all_bulan($tahun,$bulan)
	{
		$where="tb_rencana_pembangunan.tahun='".$tahun."' AND tb_pelaksanaan_pembangunan.status_pengajuan='2' AND MONTH(tgl_mulai)='".$bulan."' OR MONTH(tgl_akhir)='".$bulan."'";
		$this->db->order_by('tgl_mulai', 'DESC');
		$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');
		$this->db->join('tb_pelaksanaan_pembangunan', 'tb_rencana_pembangunan.kd_rencana = tb_pelaksanaan_pembangunan.kd_rencana', 'inner');
		return $this->db->where($where)->get('tb_rencana_pembangunan')->result_array();
	}
}