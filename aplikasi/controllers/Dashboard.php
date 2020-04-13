<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		
		parent::__construct();
		is_logged_in();
		$this->load->model('UserModel');
	}
	public function index()
	{
		$data['title']="Dashboard";
		$data['txttitle']="Sistem Informasi";
		$data['about']=$this->UserModel->get_aplikasi();
		$this->load->view('_partials/Header',$data);
		$this->load->view('_partials/Menu');
		$this->load->view('Aplikasi/Dashboard');
		$this->load->view('_partials/Footer');
	
	}
	
}