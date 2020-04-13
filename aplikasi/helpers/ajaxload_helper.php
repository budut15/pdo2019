<?php
	function q($query){
		$ci = get_instance();
		return $ci->db->query($query)->result_array();
	}
	
	function q2($query){
		$ci = get_instance();
		return $ci->db->query($query)->row_array();
	}
	
	function hapus($table,$where,$id){
		$ci = get_instance();
		return $ci->db->delete($table, array($where => $id));
	}
	
	function csrf_token(){
		$ci = get_instance();
		return $ci->security->get_csrf_hash();
	}
	
	
	function encode($isi){
		$ci = get_instance();
		return $ci->encrypt->encode($isi);
	}
	
	function decode($isi){
		$ci = get_instance();
		return $ci->encrypt->decode($isi);
	}
	
	function idxdaftar(){
	$ci = get_instance();
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
	$ci->db->insert('m_map', $data);
	
	$transaksi=date('Ymd')."00001";
	
	}else{
		
	$data = array(
        'nomor' => $get_nourut['nomor']+1
	);

	$ci->db->where('tahun', date('Y'));
	$ci->db->where('bulan', date('m'));
	$ci->db->where('hari', date('d'));
	$ci->db->update('m_map', $data);
	
	$transaksi = $get_nourut['transaksi'];
	}
	return $transaksi;
	}
	function idxbarang()
	{
		$sql_nourut = "SELECT MAX(kode_barang) as transaksi FROM m_barang";
		$dat_nourut = q2($sql_nourut);
		$no_trans = $dat_nourut['transaksi'];
		if($no_trans==""){
		$transaksi="9901000001";
		}else{				
		$transaksi = $dat_nourut['transaksi']+1;
		}
		return $transaksi;
	}
	
	function hashcode($kode="budut15"){
		return password_hash($kode, PASSWORD_DEFAULT);
	}
	function NobillBarang($jenis)
	{
	$ci = get_instance();
	$sql_nourut = "SELECT CONCAT(jenis,'-',tahun,LPAD(bulan,2,'0'),LPAD(nomor,5,'0')) AS transaksi ,nomor
	FROM m_index_barang WHERE jenis='".$jenis."' and tahun = YEAR(CURDATE()) AND bulan = MONTH(CURDATE())";
	
	$dat_nourut = q2($sql_nourut);
	$no_trans = $dat_nourut['transaksi'];
	if($no_trans==""){
	$data = array(
        'tahun' => date('Y'),
        'bulan' => date('m'),
        'jenis' => $jenis,
        'nomor' => 2
	);
	$ci->db->insert('m_index_barang', $data);
	$idxbarang=$jenis."-".date('Ym')."00001";
	}else{
		
	$data = array(
        'nomor' => $dat_nourut['nomor']+1
	);

	$ci->db->where('tahun', date('Y'));
	$ci->db->where('bulan', date('m'));
	$ci->db->where('jenis', $jenis);
	$ci->db->update('m_map', $data);
	$idxbarang = $dat_nourut['transaksi'];
	}
	return $idxbarang;
	}
	
	function Nobill($jenis)
	{
	$ci = get_instance();
	$sql_nourut = "SELECT CONCAT(jenis,'-',LPAD(hari,2,'0'),LPAD(bulan,2,'0'),RIGHT(tahun,2),LPAD(nomor,5,'0')) AS transaksi,nomor FROM m_index_nobill WHERE jenis='".$jenis."' AND tahun = YEAR(CURDATE()) AND bulan = MONTH(CURDATE()) AND hari = DAY(CURDATE())";
	$dat_nourut = q2($sql_nourut);
	$no_trans = $dat_nourut['transaksi'];
	if($no_trans==""){
	$data = array(
        'tahun' => date('Y'),
        'bulan' => date('m'),
        'hari' => date('d'),
        'jenis' => $jenis,
        'nomor' => 2
	);
	$ci->db->insert('m_index_nobill', $data);
	$idxbarang=$jenis."-".date('dmy')."00001";
	}else{
	$ci->db->where('tahun', date('Y'));
	$ci->db->where('bulan', date('m'));
	$ci->db->where('hari', date('d'));
	$ci->db->where('jenis', $jenis);
	$ci->db->update('m_index_nobill', $data);
	$idxbarang = $dat_nourut['transaksi'];
	}
	return $idxbarang;
	}

	function en($s) {
    $cryptKey  = '97096eeacc9ffbe511e99d4e1cd6fd92';
    $qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $s, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
	}
	
	function de($s) {
		$cryptKey  = '97096eeacc9ffbe511e99d4e1cd6fd92';
		$qDecoded  = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $s ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
		return( $qDecoded );
	}
function fsize($file){
    $a = array("B", "KB", "MB", "GB", "TB", "PB");
    $pos = 0;
    $size = filesize($file);
    while ($size >= 1024)
    {
    $size /= 1024;
    $pos++;
    }
    return round ($size,2)." ".$a[$pos];
    }
function getTANGGAL($tgl,$kode){
	if($kode==1){
		if($tgl!="0000-00-00" and $tgl!=""){
	$gettgl= date("d/m/Y",strtotime($tgl));
		}
	}elseif($kode==2){
		if($tgl!="0000-00-00" and $tgl!=""){
	$gettgl= date("d-F-Y",strtotime($tgl));
		}
	}elseif($kode==3){
		if($tgl!="0000-00-00" and $tgl!=""){
	$gettgl= date("d/M/Y H:i:s",strtotime($tgl));
		}
	}elseif($kode==4){
		if($tgl!="0000-00-00" and $tgl!=""){
	$gettgl= date("Y-m-d",strtotime($tgl));
		}
	}elseif($kode==5){
		if($tgl!="0000-00-00" and $tgl!=""){
	$gettgl= date("d-M-y",strtotime($tgl));
		}
	}elseif($kode==6){
		if($tgl!="0000-00-00" and $tgl!=""){
	$gettgl= date("d-M-Y H:i:s",strtotime($tgl));
		}
	}elseif($kode==7){
		if($tgl!="0000-00-00" and $tgl!=""){
	$gettgl= date("d-m-y",strtotime($tgl));
		}
	}else{
		if($tgl!="0000-00-00" and $tgl!=""){
	$gettgl= date("d-M-Y",strtotime($tgl));	
		}
	}
	return $gettgl;
}
function getRealIpAddr() {
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip=$_SERVER['HTTP_CLIENT_IP']; // share internet
    } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR']; // pass from proxy
    } else {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
  return $ip;
}

function browser_user()
{
	$browser = _userAgent();
	return $browser['name'] . ' v.'.$browser['version'];
}
function _userAgent()
{
	$u_agent 	= $_SERVER['HTTP_USER_AGENT']; 
    $bname   	= 'Unknown';
    $platform 	= 'Unknown';
    $version 	= "";
	$os_array   =   array(
                    '/windows nt 10.0/i'    =>  'Windows 10',
                    '/windows nt 6.2/i'     =>  'Windows 8',
                    '/windows nt 6.1/i'     =>  'Windows 7',
                    '/windows nt 6.0/i'     =>  'Windows Vista',
                    '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                    '/windows nt 5.1/i'     =>  'Windows XP',
                    '/windows xp/i'         =>  'Windows XP',
                    '/windows nt 5.0/i'     =>  'Windows 2000',
                    '/windows me/i'         =>  'Windows ME',
                    '/win98/i'              =>  'Windows 98',
                    '/win95/i'              =>  'Windows 95',
                    '/win16/i'              =>  'Windows 3.11',
                    '/macintosh|mac os x/i' =>  'Mac OS X',
                    '/mac_powerpc/i'        =>  'Mac OS 9',
                    '/linux/i'              =>  'Linux',
                    '/ubuntu/i'             =>  'Ubuntu',
                    '/iphone/i'             =>  'iPhone',
                    '/ipod/i'               =>  'iPod',
                    '/ipad/i'               =>  'iPad',
                    '/android/i'            =>  'Android',
                    '/blackberry/i'         =>  'BlackBerry',
                    '/webos/i'              =>  'Mobile'
                );
	foreach ($os_array as $regex => $value) { 
	    if (preg_match($regex, $u_agent)) {
	        $platform    =   $value;
            break;
	    }
	}
    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    
    } elseif(preg_match('/Firefox/i',$u_agent)) { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    
    } elseif(preg_match('/Chrome/i',$u_agent)) { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } elseif (preg_match('/Safari/i',$u_agent)) { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } elseif (preg_match('/Opera/i',$u_agent)) { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    
    } elseif (preg_match('/Netscape/i',$u_agent)) { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    }
    //  finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
   
    if (! preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        
        } else {
            $version= $matches['version'][1];
        }
    } else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    $version = ( $version == null || $version == "" ) ? "?" : $version;
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'   => $pattern
    );
}
function os_user()
{
	$OS = _userAgent();
	return $OS['platform'];
}
function jeniskelamin($P){
	if($P == 'P'){
		$v = "Perempuan (P)";
	}else{
		$v = "Laki - Laki (L)";
	}
	return $v;
}
function datediff($d1, $d2){
	$diff 	= abs(strtotime($d2) - strtotime($d1));
	$a	= array();
	$a['years'] = floor($diff / (365*60*60*24));
	$a['months']= floor(($diff - $a['years'] * 365*60*60*24) / (30*60*60*24));
	$a['days'] 	= floor(($diff - $a['years'] * 365*60*60*24 - $a['months']*30*60*60*24)/ (60*60*24));
	return $a;
}
function getserial(){
	exec("wmic bios get serialnumber",$getbios);
	return $getbios[1];
}
function getRacikan($r){
	$a=substr($r,0,1);
	$b=substr($r,1);
	$c="Racikan ".$b;
	return $c;
}
function getbulan($id){
	$bln=array(1=>"Januari","Februari","Maret","April","Mei",
												"Juni","July","Agustus","September","Oktober",
												"November","Desember");
	return $bln[$id];
}
function Terbilang($x)
{
  //$abil = array("", "first", "second", "third", "four", "five", "six", "seven", "eight", "nine", "teen", "eleven");
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}
function json(){
	$file=file_get_contents('./assets/data.json');
	//$data = file_get_contents($file);
	$json = json_decode($file,true);
	return $json;
}

function cetak($str){
    echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}
