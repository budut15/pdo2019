<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
	public function get_user($id)
	{
			if($id){
			return $this->db->select("ROLE,PAGE,NIP,SES_REG,ROLES,HAK,
			a.KDUNIT,a.DEPARTEMEN,HAK,TGL,NAMA,ID,UNIT FROM m_login a JOIN m_unit b ON a.kdunit=b.kdunit where a.NIP='".$id."'")->get()->row_array();
			}
	}
	public function get_aplikasi(){
		return $this->db->get('about')->row_array();
	}
	
	public function idxdaftar(){
	$sql_nourut = "SELECT CONCAT(tahun,LPAD(bulan,2,'0'),DATE_FORMAT(CURDATE(),'%d'),LPAD(nomor,5,'0')) as transaksi,nomor
	from m_map where tahun = YEAR(CURDATE()) AND bulan = MONTH(CURDATE()) AND hari = DAY(CURDATE())";
	$get_nourut =q2($sql_nourut);
	$no_trans = $get_nourut['transaksi'];
	if(empty($no_trans)){
	$data = array(
        'tahun' => date('Y'),
        'bulan' => date('m'),
        'hari' => date('d'),
        'nomor' => 2
	);
	$this->db->insert('m_map', $data);
	
	$transaksi=date('Ymd')."00001";
	
	}else{
		
	$data = array(
        'nomor' => $get_nourut['nomor']+1
	);

	$this->db->where('tahun', date('Y'));
	$this->db->where('bulan', date('m'));
	$this->db->where('hari', date('d'));
	$this->db->update('m_map', $data);
	
	$transaksi = $get_nourut['transaksi'];
	}
	return $transaksi;
	}

}