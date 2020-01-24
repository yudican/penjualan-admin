<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends MY_Controller {

	public function index()
	{
		$data = [
			'title' => 'Product Promo',
			'isi' 	=> 'dashboard/product-promo'
		];
		$this->load->view('layout',$data);
  }
  
  public function save()
  {
    $id = $this->uri->segment(4);
    $data = [
      'promo_barang' => $id,
      'promo_startdate' => $this->input('promo_startdate'),
      'promo_enddate' => $this->input('promo_enddate'),
      'promo_barang' => $this->input('promo_barang'),
      'promo_value' => $this->input('promo_value')
    ];

    if(isset($_POST['save'])){
      $this->insert('promo',$data);
      redirect(site_url('product/variant'));
    }else{
      redirect(site_url('product/variant'));
    }
  }
}
