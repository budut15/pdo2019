<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct(){
		
		parent::__construct();
		
	}
	public function Get_Idxdaftar(){  
	    $nomr=$this->input->post('nomr');
	    $idx=$this->input->post('idx');
		$sql = "SELECT a.NOMR,b.NAMA,b.TEMPAT,b.ALAMAT,b.NOTELP,b.PENDIDIKAN,b.AGAMA,b.NOKTP,b.PEKERJAAN,b.TGLLAHIR,b.JENISKELAMIN,b.STATUS,a.IDXDAFTAR,a.TGLREG,a.MASUKPOLY,c.NAMADOKTER,a.PENANGGUNGJAWAB_NAMA,
		d.NAMA AS KLINIK,e.NAMA AS CARABAYAR,a.KDCARABAYAR,a.KET_RUJUK,a.RUJUKAN,g.DESCRIPTION,a.KDPOLY,a.KDDOKTER,d.kdpoli,
		h.ASAL_RUJUKAN FASKES,h.NO_RUJUKAN,h.PPK_RUJUKAN KDPPK,h.TGL_RUJUKAN,h.DIAG_AWAL DIAGNOSA_AWAL,h.CATATAN,h.LAKALANTAS,h.PENJAMIN,a.SEP,
		b.NO_KARTU,b.JNS_PASIEN,b.KDPROVIDER,b.Kelas,h.cob
		FROM t_pendaftaran a JOIN m_pasien b ON a.NOMR=b.NOMR 
		LEFT JOIN m_dokter c ON a.KDDOKTER=c.KDDOKTER
		JOIN m_poly d ON a.KDPOLY=d.kode
		JOIN m_carabayar e ON a.KDCARABAYAR=e.kode
		JOIN m_rujukan f ON a.rujukan=f.kode
		LEFT JOIN t_bpjs h ON a.SEP=h.no_sep 
		LEFT JOIN ref_diagnosis g ON h.DIAG_AWAL=g.code
		where a.NOMR='".$nomr."' and a.IDXDAFTAR='".$idx."'";
		$pasien=$this->db->query($sql)->row_array();
		echo json_encode($pasien);
	}
	public function Get_Pasien(){ 
	$nomr=$this->input->post('nomr');
	$aql="SELECT NOMR,NAMA,TEMPAT,TGLLAHIR,JENISKELAMIN,ALAMAT,
			NOTELP,STATUS,PENDIDIKAN,PEKERJAAN,AGAMA,NOKTP,
			KDCARABAYAR,TGLDAFTAR,KDPROVINSI,KDKOTA,
			KDKECAMATAN,KDDESA FROM m_pasien WHERE NOMR='".$nomr."'";
	$pasien=$this->db->query($sql)->row_array();
	echo json_encode($pasien);
	}
	public function csrf(){
	echo $this->security->get_csrf_hash();
	}
}