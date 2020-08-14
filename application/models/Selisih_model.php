<?php
/**
* 
*/
class Selisih_model extends CI_Model
{	
	function get_all($kd_rencana1,$kd_rencana2)
	{	
		$this->db->select('a.*,h.parameter,h.bobot,b.kd_rencana as kd_rencana1,d.nilai_dtl_kriteria as nilai1,c.kd_rencana as kd_rencana2,e.nilai_dtl_kriteria as nilai2');
		$this->db->join('tb_nilai_kriteria_kegiatan b', 'b.kd_nilai_kriteria = a.kd_nilai_kriteria_1', 'inner');
		$this->db->join('tb_nilai_kriteria_kegiatan c', 'c.kd_nilai_kriteria = a.kd_nilai_kriteria_2', 'inner');
		$this->db->join('tb_detailkriteria d', 'd.kd_dtl_kriteria = b.kd_dtl_kriteria', 'inner');
		$this->db->join('tb_detailkriteria e', 'e.kd_dtl_kriteria = c.kd_dtl_kriteria', 'inner');
		$this->db->join('tb_bobotkriteria h', 'h.kd_bobot = b.kd_bobot', 'inner');
		$this->db->where(['b.kd_rencana'=>$kd_rencana1,'c.kd_rencana'=>$kd_rencana2]);
		return $this->db->get('tb_selisihnilaikegiatan a')->result_array();
	}	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_selisihnilaikegiatan',$data);
	}
	function hapus1($kd_nilai_kriteria_1)
	{
		# code...
		$this->db->delete('tb_selisihnilaikegiatan',['kd_nilai_kriteria_1'=>$kd_nilai_kriteria_1]);
	}
	function hapus2($kd_nilai_kriteria_2)
	{
		# code...
		$this->db->delete('tb_selisihnilaikegiatan',['kd_nilai_kriteria_2'=>$kd_nilai_kriteria_2]);
	}
	function cari1($kd_rencana1,$kd_rencana2)
	{	
		$this->db->select('g.parameter,d.kd_rencana as kd_rencana1,b.kd_rencana as kd_rencana2,c.nilai_dtl_kriteria as nilai1,e.nilai_dtl_kriteria as nilai2,(c.nilai_dtl_kriteria-e.nilai_dtl_kriteria) as selisih');
		$this->db->join('tb_nilai_kriteria_kegiatan b', 'b.kd_nilai_kriteria = a.kd_nilai_kriteria_1', 'inner');
		$this->db->join('tb_detailkriteria c', 'b.kd_dtl_kriteria = c.kd_dtl_kriteria', 'inner');
		$this->db->join('tb_nilai_kriteria_kegiatan d', 'd.kd_nilai_kriteria = a.kd_nilai_kriteria_2', 'inner');
		$this->db->join('tb_detailkriteria e', 'e.kd_dtl_kriteria = d.kd_dtl_kriteria', 'inner');
		$this->db->join('tb_bobotkriteria g', 'd.kd_bobot = g.kd_bobot', 'inner');
		return $this->db->where(['b.kd_rencana'=>$kd_rencana1,'d.kd_rencana'=>$kd_rencana2])->get('tb_selisihnilaikegiatan a')->result_array();
	}
	function cari2($kd_nilai_kriteria)
	{	
		$this->db->select('g.parameter,c.nilai_dtl_kriteria as nilai1,e.nilai_dtl_kriteria as nilai2,(c.nilai_dtl_kriteria-e.nilai_dtl_kriteria) as selisih');
		$this->db->join('tb_nilai_kriteria_kegiatan b', 'b.kd_nilai_kriteria = a.kd_nilai_kriteria_1', 'inner');
		$this->db->join('tb_detailkriteria c', 'b.kd_dtl_kriteria = c.kd_dtl_kriteria', 'inner');
		$this->db->join('tb_nilai_kriteria_kegiatan d', 'd.kd_nilai_kriteria = a.kd_nilai_kriteria_2', 'inner');
		$this->db->join('tb_detailkriteria e', 'e.kd_dtl_kriteria = d.kd_dtl_kriteria', 'inner');
		$this->db->join('tb_rencana_pembangunan f', 'f.kd_rencana = b.kd_rencana', 'inner');
		$this->db->join('tb_bobotkriteria g', 'd.kd_bobot = g.kd_bobot', 'inner');
		return $this->db->where(['a.kd_nilai_kriteria_2'=>$kd_nilai_kriteria])->get('tb_selisihnilaikegiatan a')->result_array();
	}
	function ubah($kd_nilai_kriteria_1,$data)
	{	
		return $this->db->where(['kd_nilai_kriteria_1'=>$kd_nilai_kriteria_1])->update('tb_selisihnilaikegiatan',$data);
	}
	function simpan1()
	{
		# code...
		$this->db->insert('tb_promethee',$data);
	}
}