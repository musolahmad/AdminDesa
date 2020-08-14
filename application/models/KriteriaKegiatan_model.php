<?php
/**
* 
*/
class KriteriaKegiatan_model extends CI_Model
{	
	function get_all($kd_bobot,$kd_bidang,$kd_rencana)
	{	
		$this->db->join('tb_rencana_pembangunan', 'tb_nilai_kriteria_kegiatan.kd_rencana = tb_rencana_pembangunan.kd_rencana', 'inner');
		return $this->db->where(['tb_rencana_pembangunan.kd_bidang'=>$kd_bidang,'tb_nilai_kriteria_kegiatan.kd_bobot'=>$kd_bobot,"tb_rencana_pembangunan.kd_rencana !="=>$kd_rencana,"tb_rencana_pembangunan.status_pengajuan"=>'2'])->get('tb_nilai_kriteria_kegiatan')->result_array();
	}
	function nomor($kd_rencana)
	{	
		$this->db->order_by('kd_nilai_kriteria', 'DESC');
		$this->db->limit(1);		
		return $this->db->where(['kd_rencana'=>$kd_rencana])->get('tb_nilai_kriteria_kegiatan')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_nilai_kriteria_kegiatan',$data);
	}
	function cek($kd_rencana)
	{
		# code...
		return $this->db->where(['kd_rencana'=>$kd_rencana])->get('tb_nilai_kriteria_kegiatan')->result_array();
	}
	function hapus($kd_nilai_kriteria)
	{
		# code...
		$this->db->delete('tb_nilai_kriteria_kegiatan',['kd_nilai_kriteria'=>$kd_nilai_kriteria]);
	}
	function lihat($kd_rencana)
	{	
		$this->db->join('tb_detailkriteria', 'tb_detailkriteria.kd_dtl_kriteria = tb_nilai_kriteria_kegiatan.kd_dtl_kriteria', 'inner');
		$this->db->join('tb_kriteria', 'tb_detailkriteria.kd_kriteria = tb_kriteria.kd_kriteria', 'inner');
		return $this->db->where(['kd_rencana'=>$kd_rencana])->get('tb_nilai_kriteria_kegiatan')->result_array();
	}
	function lihat1($kd_rencana,$kd_kriteria)
	{	
		$this->db->join('tb_detailkriteria', 'tb_detailkriteria.kd_dtl_kriteria = tb_nilai_kriteria_kegiatan.kd_dtl_kriteria', 'inner');
		$this->db->join('tb_kriteria', 'tb_detailkriteria.kd_kriteria = tb_kriteria.kd_kriteria', 'inner');
		return $this->db->where(['tb_nilai_kriteria_kegiatan.kd_rencana'=>$kd_rencana,'tb_kriteria.kd_kriteria'=>$kd_kriteria])->get('tb_nilai_kriteria_kegiatan')->result_array();
	}

	function ubah($kd_nilai_kriteria,$data)
	{	
		return $this->db->where(['kd_nilai_kriteria'=>$kd_nilai_kriteria])->update('tb_nilai_kriteria_kegiatan',$data);
	}
}