<?php
/**
* 
*/
class Pembangunan_model extends CI_Model
{	
	function get_all()
	{	
		$this->db->where(['tipe_akun'=>'2','jns_akun'=>'2']);
		return $this->db->get('tb_bidang')->result_array();
	}
	function get_all_bidang($kd_bidang)
	{	
		$this->db->where(['kd_bidang'=>$kd_bidang]);
		return $this->db->get('tb_bidang')->result_array();
	}
	function get_all1()
	{	
		$this->db->limit(1);
		$this->db->where(['tipe_akun'=>'2','jns_akun'=>'2']);	
		return $this->db->get('tb_bidang')->result_array();
	}
	function detail($kd_bidang,$tahun,$limit,$start)
	{	
		$this->db->join('tb_kegiatan','tb_kegiatan.kd_kegiatan=tb_rencana_pembangunan.kd_kegiatan','inner');	
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');	
		$this->db->where(['kd_bidang'=>$kd_bidang,'tahun'=>$tahun,'status_pengajuan'=>'2']);	
		return $this->db->get('tb_rencana_pembangunan',$limit,$start)->result_array();
	}
	function detail1($kd_bidang,$tahun)
	{	
		$this->db->order_by('nilai_net_flow','DESC');
		$this->db->join('tb_promethee','tb_promethee.kd_rencana=tb_rencana_pembangunan.kd_rencana','inner');
		$this->db->join('tb_kegiatan','tb_kegiatan.kd_kegiatan=tb_rencana_pembangunan.kd_kegiatan','inner');		
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');	
		$this->db->join('tb_bidang','tb_bidang.kd_bidang=tb_rencana_pembangunan.kd_bidang','inner');
		$this->db->where(['tb_rencana_pembangunan.kd_bidang'=>$kd_bidang,'tahun'=>$tahun]);
		return $this->db->get('tb_rencana_pembangunan')->result_array();
	}
	function lihat($kd_rencana)
	{	
		$this->db->join('tb_detailkriteria', 'tb_detailkriteria.kd_dtl_kriteria = tb_nilai_kriteria_kegiatan.kd_dtl_kriteria', 'inner');
		$this->db->join('tb_kriteria', 'tb_detailkriteria.kd_kriteria = tb_kriteria.kd_kriteria', 'inner');
		$this->db->join('tb_bobotkriteria', 'tb_bobotkriteria.kd_bobot = tb_nilai_kriteria_kegiatan.kd_bobot', 'inner');	
		return $this->db->where(['kd_rencana'=>$kd_rencana])->get('tb_nilai_kriteria_kegiatan')->result_array();
	}
	function lihat1($kd_rencana)
	{	
		$this->db->join('tb_kegiatan','tb_kegiatan.kd_kegiatan=tb_rencana_pembangunan.kd_kegiatan','inner');		
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');	
		return $this->db->where(['kd_rencana'=>$kd_rencana])->get('tb_rencana_pembangunan')->result_array();
	}
	function jml($kd_bidang,$tahun)
	{	
		$this->db->where(['kd_bidang'=>$kd_bidang,'tahun'=>$tahun,'status_pengajuan'=>'2']);
		return $this->db->get('tb_rencana_pembangunan')->num_rows();
	}
	function cari($kd_aduan)
	{
		# code...
		$this->db->where(['kd_aduan'=>$kd_aduan]);
		return $this->db->get('tb_referensi_aduan')->result_array();
	}
	function cari1($kd_rencana)
	{
		# code...
		$this->db->where(['kd_rencana'=>$kd_rencana]);
		return $this->db->get('tb_referensi_aduan')->result_array();
	}
	function cari2($kd_rencana)
	{	
		$this->db->join('tb_aduan', 'tb_aduan.kd_aduan = tb_referensi_aduan.kd_aduan', 'inner');		
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik', 'inner');
		return $this->db->where(['kd_rencana'=>$kd_rencana])->get('tb_referensi_aduan')->result_array();
	}
	function pagu($tahun)
	{
		# code...
		$this->db->where(['tahun'=>$tahun]);
		$this->db->join('tb_bidang','tb_bidang.kd_bidang=tb_paguanggaran.kd_bidang','inner');
		return $this->db->get('tb_paguanggaran')->result_array();
	}
}