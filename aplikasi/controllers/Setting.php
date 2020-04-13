<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct(){
		
		parent::__construct();
		is_logged_in();
		$this->load->model('UserModel');
	}
	
	public function Backup()
	{
		$data['title']="Backup";
		$data['txttitle']="Sistem Informasi";
		$data['about']=$this->UserModel->get_aplikasi();
		$this->load->view('_partials/Header',$data);
		$this->load->view('_partials/Menu');
		$this->load->view('Aplikasi/admin');
		$this->load->view('_partials/Footer');
	
	}
	
	public function Carabayar()
	{
		$data['title']="Carabayar";
		$data['txttitle']="Sistem Informasi";
		$data['about']=$this->UserModel->get_aplikasi();
		$this->load->view('_partials/Header',$data);
		$this->load->view('_partials/Menu');
		$this->load->view('Aplikasi/admin');
		$this->load->view('_partials/Footer');
	
	}
	
	public function Klinik()
	{
		$data['title']="Klinik";
		$data['txttitle']="Sistem Informasi";
		$data['about']=$this->UserModel->get_aplikasi();
		$this->load->view('_partials/Header',$data);
		$this->load->view('_partials/Menu');
		$this->load->view('Aplikasi/admin');
		$this->load->view('_partials/Footer');
	
	}
	
}