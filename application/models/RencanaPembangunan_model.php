<?php
/**
* 
*/
class RencanaPembangunan_model extends CI_Model
{	
	function get_all($tahun)
	{	
		$this->db->select('COUNT(tb_rencana_pembangunan.kd_rencana) as jml,tb_bobotkriteria.kd_bidang,tb_bidang.nm_bidang,tb_paguanggaran.pagu');
		$this->db->join('tb_bidang', 'tb_bobotkriteria.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_paguanggaran', 'tb_paguanggaran.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_rencana_pembangunan', 'tb_bobotkriteria.kd_bidang=tb_rencana_pembangunan.kd_bidang', 'left');
		$this->db->group_by('tb_bobotkriteria.kd_bidang');
		return $this->db->where(['tb_bobotkriteria.tahun'=>$tahun])->get('tb_bobotkriteria')->result_array();
	}
	function nomor($tahun)
	{	
		$this->db->limit(1);		
		$this->db->select('COUNT(tb_rencana_pembangunan.kd_rencana) as jml,tb_bobotkriteria.kd_bidang,tb_bidang.nm_bidang,tb_paguanggaran.pagu');
		$this->db->join('tb_bidang', 'tb_bobotkriteria.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_paguanggaran', 'tb_paguanggaran.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_rencana_pembangunan', 'tb_bobotkriteria.kd_bidang=tb_rencana_pembangunan.kd_bidang', 'left');
		$this->db->group_by('tb_bobotkriteria.kd_bidang');
		return $this->db->where(['tb_bobotkriteria.tahun'=>$tahun])->get('tb_bobotkriteria')->result_array();
	}
	function bidang($tahun,$kd_bidang)
	{	
		$this->db->limit(1);		
		$this->db->select('COUNT(tb_rencana_pembangunan.kd_rencana) as jml,tb_bobotkriteria.kd_bidang,tb_bidang.nm_bidang,tb_paguanggaran.pagu');
		$this->db->join('tb_bidang', 'tb_bobotkriteria.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_paguanggaran', 'tb_paguanggaran.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_rencana_pembangunan', 'tb_bobotkriteria.kd_bidang=tb_rencana_pembangunan.kd_bidang', 'left');
		$this->db->group_by('tb_bobotkriteria.kd_bidang');
		return $this->db->where(['tb_bobotkriteria.tahun'=>$tahun,'tb_bobotkriteria.kd_bidang'=>$kd_bidang])->get('tb_bobotkriteria')->result_array();
	}
	function jml($tahun,$kd_bidang)
	{	
		$this->db->select('COUNT(*) as jml');
		$this->db->group_by('kd_bidang');
		return $this->db->where(['tahun'=>$tahun,'kd_bidang'=>$kd_bidang])->get('tb_rencana_pembangunan')->result_array();
	}
	function totalanggaran($tahun,$kd_bidang)
	{	
		$this->db->select('sum(biaya) as biaya');
		$this->db->group_by('kd_bidang');
		return $this->db->where(['tahun'=>$tahun,'kd_bidang'=>$kd_bidang,'status_pengajuan'=>'2'])->get('tb_rencana_pembangunan')->result_array();
	}
	function rencana($tahun,$kd_bidang)
	{
		$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');		
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun', 'inner');	
		return $this->db->where(['tb_rencana_pembangunan.tahun'=>$tahun,'tb_rencana_pembangunan.kd_bidang'=>$kd_bidang])->get('tb_rencana_pembangunan')->result_array();
	}
	function rencana1($tahun,$kd_bidang)
	{
		$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun', 'inner');	
		return $this->db->where(['tb_rencana_pembangunan.tahun'=>$tahun,'tb_rencana_pembangunan.kd_bidang'=>$kd_bidang,'tb_rencana_pembangunan.status_pengajuan'=>'2'])->get('tb_rencana_pembangunan')->result_array();
	}
	function rencana2($tahun,$kd_bidang)
	{
		$this->db->order_by('nilai_net_flow', 'DESC');
		$this->db->join('tb_promethee', 'tb_promethee.kd_rencana = tb_rencana_pembangunan.kd_rencana', 'inner');
		$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');			
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun', 'inner');	
		return $this->db->where('tb_rencana_pembangunan.tahun ="'.$tahun.'" AND tb_rencana_pembangunan.kd_bidang="'.$kd_bidang.'" AND tb_rencana_pembangunan.status_pengajuan = "2" AND tb_rencana_pembangunan.kd_rencana NOT IN (SELECT kd_rencana FROM tb_pelaksanaan_pembangunan)')->get('tb_rencana_pembangunan')->result_array();
	}
	function kd_rencana($tahun,$kd_bidang)
	{
		$this->db->order_by('kd_rencana', 'DESC');
		$this->db->limit(1);
		return $this->db->where(['tahun'=>$tahun,'kd_bidang'=>$kd_bidang])->get('tb_rencana_pembangunan')->result_array();
	}
	function totaladuan($tahun,$kd_bidang,$status_pengajuan)
	{
		return $this->db->where(['tahun'=>$tahun,'kd_bidang'=>$kd_bidang,'status_pengajuan'=>$status_pengajuan])->get('tb_rencana_pembangunan')->num_rows();
	}
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_rencana_pembangunan',$data);
	}
	function hapus($kd_rencana)
	{
		# code...
		$this->db->delete('tb_rencana_pembangunan',['kd_rencana'=>$kd_rencana]);
	}
	function cari($kd_rencana)
	{	
		$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
		$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');			
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun', 'inner');	
		return $this->db->where(['kd_rencana'=>$kd_rencana])->get('tb_rencana_pembangunan')->result_array();
	}
	function ubah($kd_rencana,$data)
	{	
		return $this->db->where(['kd_rencana'=>$kd_rencana])->update('tb_rencana_pembangunan',$data);
	}
}