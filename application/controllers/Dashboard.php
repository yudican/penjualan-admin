<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
		$data = [
			'title' => 'Welcome Dashboard',
			'isi' 	=> 'dashboard/index'
		];
		$this->load->view('layout',$data);
	}

	public function cek()
	{
		echo file_get_contents(APPPATH.'/views/auth/login.php',TRUE);
	}
}
