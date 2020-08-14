<?php
/**
* 
*/
class PaguAnggaran_model extends CI_Model
{	
	function get_all($tahun)
	{	
		$this->db->join('tb_bidang', 'tb_bidang.kd_bidang = tb_paguanggaran.kd_bidang', 'inner');
		return $this->db->where(['tahun'=>$tahun])->get('tb_paguanggaran')->result_array();
	}
	function get_all_bobot($tahun)
	{	
		$this->db->join('tb_bidang', 'tb_bidang.kd_bidang = tb_paguanggaran.kd_bidang', 'inner');
		return $this->db->where(['tahun'=>$tahun,'jns_akun'=>2,'tipe_akun'=>2])->get('tb_paguanggaran')->result_array();
	}
	function get_all_beranda($tahun,$jns_akun)
	{	
		$this->db->join('tb_bidang', 'tb_bidang.kd_bidang = tb_paguanggaran.kd_bidang', 'inner');
		return $this->db->where(['tahun'=>$tahun,'jns_akun'=>$jns_akun])->get('tb_paguanggaran')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_paguanggaran',$data);
	}
	function hapus($kd_pagu)
	{
		# code...
		$this->db->delete('tb_paguanggaran',['kd_pagu'=>$kd_pagu]);
	}
	function cari($kd_pagu)
	{	
		return $this->db->where(['kd_pagu'=>$kd_pagu])->get('tb_paguanggaran')->result_array();
	}
	function cariakun($kd_induk,$tahun)
	{	
		$this->db->select('SUM(pagu) as pagu');
		$this->db->join('tb_bidang', 'tb_bidang.kd_bidang = tb_paguanggaran.kd_bidang', 'inner');
		return $this->db->where(['tahun'=>$tahun,'kd_induk'=>$kd_induk])->get('tb_paguanggaran')->result_array();
	}
	function totalpendapatan($tahun)
	{	
		$this->db->select('SUM(pagu) as pagupendapatan');
		$this->db->join('tb_bidang', 'tb_bidang.kd_bidang = tb_paguanggaran.kd_bidang', 'inner');
		return $this->db->where(['tahun'=>$tahun,'kd_induk'=>'0','jns_akun'=>'1'])->get('tb_paguanggaran')->result_array();
	}
	function totalpengeluaran($tahun)
	{	
		$this->db->select('SUM(pagu) as pagupengeluaran');
		$this->db->join('tb_bidang', 'tb_bidang.kd_bidang = tb_paguanggaran.kd_bidang', 'inner');
		return $this->db->where(['tahun'=>$tahun,'kd_induk'=>'0','jns_akun'=>'2'])->get('tb_paguanggaran')->result_array();
	}
	function ubah($kd_pagu,$data)
	{	
		return $this->db->where(['kd_pagu'=>$kd_pagu])->update('tb_paguanggaran',$data);
	}
}
function cariakun($kd_induk,$tahun)
	{	
		$this->db->select('SUM(pagu) as pagu');
		$this->db->join('tb_bidang', 'tb_bidang.kd_bidang = tb_paguanggaran.kd_bidang', 'inner');
		return $this->db->where(['tahun'=>$tahun,'kd_induk'=>$kd_induk])->get('tb_paguanggaran')->result_array();
	}