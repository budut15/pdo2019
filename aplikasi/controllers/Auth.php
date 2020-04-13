<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		
		parent::__construct();
	}
	public function index()
	{
		if($this->session->userdata('NIP_APK')){
		//redirect($this->session->userdata('PAGE_APK'));	
		redirect('Dashboard');	
		}else{
		$data['title']="Login Form - Sistem Informasi";
		$this->load->view('_partials/Login_Header',$data);
		$this->load->view('Login/Login');
		$this->load->view('_partials/Login_Footer');
		}
	}
	public function check_login(){  
     
		$username=$this->input->post('username');
		$pass=$this->input->post('password');
		$user=$this->UserModel->get_user($username);
		if($user){
			if($user['HAK']== 1 ){
				//if(md5($pass)==$user['SES_REG']){
					if (password_verify($pass, $user['SES_REG'])) {
					$data=[
					'NIP_APK' 			=> $user['NIP'],
					'LOGIN_APK'	 		=> $user['HAK'],
					'ROLES_APK'	 		=> $user['ROLES'],
					'KDUNIT_APK'	 	=> $user['KDUNIT'],
					'DEPARTEMEN_APK' 	=> $user['DEPARTEMEN'],
					'TANGGAL_APK'	 	=> date("Y-m-d H:i:s"),
					'NAMA_APK'	 		=> $user['NAMA'],
					'PAGE_APK'	 		=> $user['PAGE'],
					'UNIT_APK'			=> $user['UNIT'],
					'REG_SESSION'	 	=> md5('budut15'),
					'HAL_APK'	 		=> '15',
					'ID_APK'		 	=> $user['ID']
					];
					$this->session->set_userdata($data);
					
					$balas=array(
						'balas'=>'1',
						'message'=>'Dashboard'
						);
					echo json_encode($balas);
				}else{
					$balas=array(
						'balas'=>'2',
						'message'=>'Password Salah'
						);
					echo json_encode($balas);
				}
			}else{
				$balas=array(
						'balas'=>'3',
						'message'=>'Username tidak aktif'
						);
				echo json_encode($balas);
				
			}
			
		}else{
			$balas=array(
						'balas'=>'4',
						'message'=>'Username tidak terdaftar'
						);
			echo json_encode($balas);
		}
	}  
	public function logout(){  
		$this->session->unset_userdata('NIP_APK');  
		$this->session->unset_userdata('ROLES_APK');  
		$this->session->unset_userdata('REG_SESSION');  
		$this->session->unset_userdata('KDUNIT_APK');  
		$this->session->unset_userdata('PAGE_APK');  
		redirect('auth'); 
	}
}
