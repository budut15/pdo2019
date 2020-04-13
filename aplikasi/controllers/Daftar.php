<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();
		
	}
	
	public function Data_Pasien(){  
		$data['title']="Data Pasien";
		$data['txttitle']="Sistem Informasi";
		$data['json']=json();
		$data['about']=$this->UserModel->get_aplikasi();
		$this->load->view('_partials/Header',$data);
		$this->load->view('_partials/Menu');
		$this->load->view('daftar/Data_Pasien');
		$this->load->view('_partials/Footer');
	}
	public function List_Data_Pasien(){ 
		$key=$this->input->post('keys');
		//$token=$this->security->get_csrf_hash();
		$cari=json_encode($key);
		$cari2=json_decode($cari);
		//echo $cari2[0];
		//print_r(json_decode($cari));
		//die;
		$json=json();
		$page=$this->input->post('page');
		$limit = $json['limit'];
		$limit_start = ($page - 1) * $limit;
		
		
		$hal='"Daftar/List_Data_Pasien"';
		$table='<table class="table table-striped table-hover ">
                <thead>
                <tr >
				<th>#</th>
				<th>'.$json['tb']['rm'].'</th>
				<th class="maxs-width">'.$json['tb']['nama'].'</th>
				<th>'.$json['tb']['alamat'].'</th>
				<th class="min-width">'.$json['tb']['lahir'].'</th>
				<th>'.$json['tb']['umur'].'</th>
				<th>'.$json['tb']['jakel'].'</th>
				
				<th>'.$json['tb']['ktp'].'</th>
				<th >'.$json['tb']['tgl'].'</th>
				</tr>
                </thead><tbody>';
		//$get_jumlah=$this->db->select(' count(nomr) jumlah from m_pasien where NOMR like "%'.$cari2[0].'%" and NAMA like "%'.$cari2[1].'%" and ALAMAT like "%'.$cari2[2].'%"')->get()->row_array();
		if(!empty($cari2[0])){
		$this->db->like('NOMR', $cari2[0]);
		}
		if(!empty($cari2[1])){
		$this->db->like('NAMA', $cari2[1]);
		}
		if(!empty($cari2[2])){
		$this->db->like('ALAMAT', $cari2[2]);
		}
		$this->db->from('m_pasien');
		$get_jumlah=$this->db->count_all_results();
		
		//$pasien = $this->db->query('select NOMR,NAMA,ALAMAT,TGLLAHIR,JENISKELAMIN,NOKTP,TGLDAFTAR 
		//from m_pasien where NOMR like "%'.$cari2[0].'%" and NAMA like "%'.$cari2[1].'%" and ALAMAT like "%'.$cari2[2].'%" order by NOMR LIMIT '.$limit_start.','.$limit)->result_array();
		
		$this->db->select('NOMR,NAMA,ALAMAT,TGLLAHIR,JENISKELAMIN,NOKTP,TGLDAFTAR ');
		if(!empty($cari2[0])){
		$this->db->like('NOMR', $cari2[0]);
		}
		if(!empty($cari2[1])){
		$this->db->like('NAMA', $cari2[1]);
		}
		if(!empty($cari2[2])){
		$this->db->like('ALAMAT', $cari2[2]);
		}
		$this->db->limit($limit, $limit_start);
		$this->db->order_by('NOMR','ASC');
		$pasien = $this->db->get('m_pasien')->result_array();
		//var_dump($pasien);
		//die();
		$NO=0;
		foreach ($pasien as $row):	
		$NO=($NO+1);
        if ($page==0){
        $hal_page=0;
        }else{
        $hal_page=$page-1;
        }
		$umur=datediff($row['TGLLAHIR'],date('Y-m-d'));
		$table.='<tr><td>'.(($hal_page*$limit)+$NO).'</td>';
		$table.='<td>'.$row['NOMR'].'</td>';
		$table.='<td>'.$row['NAMA'].'</td>';
		$table.='<td>'.$row['ALAMAT'].'</td>';
		$table.='<td>'.getTANGGAL($row['TGLLAHIR'],0).'</td>';
		$table.='<td align=center>'.$umur['years'].' thn</td>';
		$table.='<td>'.$row['JENISKELAMIN'].'</td>';
		
		$table.='<td>'.$row['NOKTP'].'</td>';
		$table.='<td>'.getTANGGAL($row['TGLDAFTAR'],6).'</td></tr>';
		endforeach;
		$table.='</tbody></table>';
		$table.='<ul class="pagination pull-right ">';
		if($page == 1){
		$table.='<li class="disabled"><a href="javascript:void(0);">First</a></li>
		<li class="disabled"><a href="javascript:void(0);">&laquo;</a></li>';
		}else{
		$link_prev = ($page > 1)? $page - 1 : 1;
		$table.='<li><a href="javascript:void(0);" ';
		$table.=" onclick='searchWithPagination(1,$hal,$cari)' ";
		$table.='>First</a></li><li><a href="javascript:void(0);"';
		$table.=" onclick='searchWithPagination($link_prev,$hal,$cari)' ";
		$table.='>&laquo;</a></li>';
		}
		$jumlah_page = ceil($get_jumlah / $limit);
		$jumlah_number = 3;
		$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; 
		$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
	
		for($i = $start_number; $i <= $end_number; $i++){
		$link_active = ($page == $i) ? ' class="active" ' : '';
		$table.='<li '.$link_active.'><a href="javascript:void(0);" ';
		$table.=" onclick='searchWithPagination($i,$hal,$cari)' ";
		$table.='>'.$i.'</a></li>';
		}
		if($page == $jumlah_page){
		$table.='<li class="disabled"><a href="javascript:void(0);">&raquo;</a></li>
		<li class="disabled"><a href="javascript:void(0);">Last</a></li>';
		}else{
		$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
		$table.='<li><a href="javascript:void(0);" ';
		$table.=" onclick='searchWithPagination($link_next,$hal,$cari)' ";
		$table.='>&raquo;</a></li>';
		
		$table.='<li><a href="javascript:void(0);" ';
		$table.=" onclick='searchWithPagination($jumlah_page,$hal,$cari)' ";
		$table.='>Last</a></li>';
		}
		$table.='</ul>';
		echo $table;
		
	}
	public function List_Kunjungan_Rajal(){
		$data['title']="Kunjungan Rajal";
		$data['txttitle']="Sistem Informasi";
		$data['json']=json();
		$data['about']=$this->UserModel->get_aplikasi();
		$this->load->view('_partials/Header',$data);
		$this->load->view('_partials/Menu');
		$this->load->view('daftar/Kunjungan_Rajal');
		$this->load->view('_partials/Footer');
	}
	
	public function List_Data_Rajal(){
		$key=$this->input->post('keys');
		$cari=json_encode($key);
		$cari2=json_decode($cari);
		$json=json();
		$page=$this->input->post('page');
		if(!empty($cari2[3])){
		$tgl1 = $cari2[3];
		}else{
		$tgl1 = date("Y-m-d");
		}
				
		if(!empty($cari2[4])){
		$tgl2 = $cari2[4];
		}else{
		$tgl2 = date("Y-m-d");
		}
		
		$limit = $json['limit'];
		$limit_start = ($page - 1) * $limit;
		
		$hal='"Daftar/List_Data_Rajal"';
		$table='<div class="panel"><div class="panel-body"><div class="col-md-12">
				<div class="table-responsive">
                <table class="table table-hover table-striped table-condensed">
                <thead>
                <tr >
				<th></th>
                <th>'.$json['tb']['reg'].'</th>
                <th>'.$json['tb']['rm'].'</th>
                <th class="max-width">'.$json['tb']['nama'].'</th>
				<th>'.$json['tb']['alamat'].'</th>
                <th class="min-width">'.$json['tb']['lahir'].'</th>
                <th >'.$json['tb']['jakel'].'</th>
                <th>'.$json['tb']['klinik'].'</th>
                <th>'.$json['tb']['bayar'].'</th>
                <th class="min-width">'.$json['tb']['tgl'].'</th>
                <th>'.$json['tb']['rujuk'].'</th>
                <th>'.$json['tb']['status'].'</th>
                <th>'.$json['tb']['aksi'].'</th>
				</tr>
                </thead><tbody>';
				
		if(!empty($cari2[0])){
		$this->db->like('NOMR', $cari2[0]);
		}
		if(!empty($cari2[1])){
		$this->db->like('NAMA', $cari2[1]);
		}
		if(!empty($cari2[2])){
		$this->db->like('ALAMAT', $cari2[2]);
		}
		//$this->db->where('a.TGLREG >=', $tgl1);
		//$this->db->where('a.TGLREG <=', $tgl2);
		if(!empty($cari2[5])){
		$this->db->where('a.KDPOLY ', $cari2[5]);
		}
		if(!empty($cari2[6])){
		$this->db->where('a.KDCARABAYAR ', $cari2[6]);
		}
		$this->db->from('t_pendaftaran a');
		$this->db->join('m_pasien b','a.NOMR=b.NOMR');
		$get_jumlah=$this->db->count_all_results();
		
		$this->db->select('a.NOMR,b.NAMA,b.ALAMAT,b.TGLLAHIR,b.JENISKELAMIN,a.STATUS,a.kddokter,a.IDXDAFTAR,a.KDPOLY,a.TGLREG,a.MASUKPOLY,c.NAMADOKTER,a.kdcarabayar,
		d.NAMA AS KLINIK,e.NAMA AS CARABAYAR,f.NAMA AS RUJUKAN,a.KET_RUJUK,g.keterangan as PULANG,"0" as rajal');
		$this->db->from('t_pendaftaran a');
		$this->db->join('m_pasien b', 'a.NOMR=b.NOMR');
		$this->db->join('m_dokter c', 'a.KDDOKTER=c.KDDOKTER','left');
		$this->db->join('m_poly d', 'a.KDPOLY=d.kode');
		$this->db->join('m_carabayar e', 'a.KDCARABAYAR=e.kode');
		$this->db->join('m_rujukan f', 'a.rujukan=f.kode');
		$this->db->join('m_statuskeluar g', 'a.status=g.status','left');
		if(!empty($cari2[0])){
		$this->db->like('a.NOMR', $cari2[0]);
		}
		if(!empty($cari2[1])){
		$this->db->like('b.NAMA', $cari2[1]);
		}
		if(!empty($cari2[2])){
		$this->db->like('b.ALAMAT', $cari2[2]);
		}
		//$this->db->where('a.TGLREG >=', $tgl1);
		//$this->db->where('a.TGLREG <=', $tgl2);
		if(!empty($cari2[5])){
		$this->db->where('a.KDPOLY ', $cari2[5]);
		}
		if(!empty($cari2[6])){
		$this->db->where('a.KDCARABAYAR ', $cari2[6]);
		}
		$this->db->limit($limit, $limit_start);
		$this->db->order_by('a.IDXDAFTAR','ASC');
		$pasien =$this->db->get()->result_array();
		$NO=0;
		foreach ($pasien as $row):	
		$NO=($NO+1);
        if ($page==0){
        $hal_page=0;
        }else{
        $hal_page=$page-1;
        }
		$umur=datediff($row['TGLLAHIR'],date('Y-m-d'));
		$table.='<tr><td class="text-center"><button class="demo-delete-row btn btn-danger btn-xs"><i class="demo-pli-cross"></i></button></td>';
		$table.='<td>'.$row['IDXDAFTAR'].'</td>';
		$table.='<td>'.$row['NOMR'].'</td>';
		$table.='<td>'.$row['NAMA'].'</td>';
		$table.='<td>'.$row['ALAMAT'].'</td>';
		$table.='<td>'.getTANGGAL($row['TGLLAHIR'],0).'</br><small >'.$umur['years'].' thn</small></td>';
		$table.='<td>'.$row['JENISKELAMIN'].'</td>';
		
		$table.='<td>'.$row['KLINIK'].'<br>'.$row ['NAMADOKTER'].'</td>';
		$table.='<td>'.$row['CARABAYAR'].'</td>';
		$table.='<td>'.getTANGGAL($row['TGLREG'],0).'</td>';
		$table.='<td>'.$row ['RUJUKAN'].'<br>'.$row ['KET_RUJUK'].'</td>';
		if($row ['STATUS']!=11){
			if($row ['MASUKPOLY']=="00:00:00"){
			$cek='<font color="green">BELUM DILAYANI</font>';
			}else{
			$cek='<font color="blue">SUDAH DILAYANI</font></br>( '.$row['PULANG'].' )';	
			}
		}elseif($row ['STATUS']==11){
			$cek='<font color="red">BATAL</font>';
		}
		$table.='<td><div id="validbatal'.$row['IDXDAFTAR'].'">'.$cek.'</div></td>';
		$table.='<td>
		<div class="btn-group">
		<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Dropdown <span class="caret"></span></a>
       <ul class="dropdown-menu" role="menu">
       <li role="presentation" class="dropdown-header">Dropdown header</li>
       <li><a href="#">Action</a></li>
       <li><a href="#">Another action</a></li>
       <li><a href="#">Something else here</a></li>                                                    
       </ul>
       </div>
		</td></tr>';
		
		endforeach;
		$table.='</tbody></table></div></div>';
		$table.='<ul class="pagination pull-right">';
		if($page == 1){
		$table.='<li class="disabled"><a href="javascript:void(0);">First</a></li>
		<li class="disabled"><a href="javascript:void(0);">&laquo;</a></li>';
		}else{
		$link_prev = ($page > 1)? $page - 1 : 1;
		$table.='<li><a href="javascript:void(0);" ';
		$table.=" onclick='searchWithPagination(1,$hal,$cari)' ";
		$table.='>First</a></li><li><a href="javascript:void(0);"';
		$table.=" onclick='searchWithPagination($link_prev,$hal,$cari)' ";
		$table.='>&laquo;</a></li>';
		}
		$jumlah_page = ceil($get_jumlah / $limit);
		$jumlah_number = 3;
		$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; 
		$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
	
		for($i = $start_number; $i <= $end_number; $i++){
		$link_active = ($page == $i) ? ' class="active" ' : '';
		$table.='<li '.$link_active.'><a href="javascript:void(0);" ';
		$table.=" onclick='searchWithPagination($i,$hal,$cari)' ";
		$table.='>'.$i.'</a></li>';
		}
		if($page == $jumlah_page){
		$table.='<li class="disabled"><a href="javascript:void(0);">&raquo;</a></li>
		<li class="disabled"><a href="javascript:void(0);">Last</a></li>';
		}else{
		$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
		$table.='<li><a href="javascript:void(0);" ';
		$table.=" onclick='searchWithPagination($link_next,$hal,$cari)' ";
		$table.='>&raquo;</a></li>';
		
		$table.='<li><a href="javascript:void(0);" ';
		$table.=" onclick='searchWithPagination($jumlah_page,$hal,$cari)' ";
		$table.='>Last</a></li>';
		}
		$table.='</ul></div></div>';
		echo $table;
	}
	
}