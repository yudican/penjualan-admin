<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_variant extends MY_Controller {

  
  public function index()
  {
    $id = $this->uri->segment(3);
    $data = [
      'title' => 'Product Variant Input',
      'isi' 	=> 'dashboard/product-variant',
      'action' => site_url('product/variant/save/'.$this->uri->segment(3))
    ];
    $this->load->view('layout',$data);
  }
}
