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
}
