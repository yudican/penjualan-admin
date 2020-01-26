<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends MY_Controller {

  
  public function form_save()
  {
    
    $this->form_validation->set_rules('promo_value', 'nominal promo', 'trim|numeric');
    $id = $this->uri->segment(3);

    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title' => 'Product Promo',
        'isi' 	=> 'dashboard/product-promo',
        'action' => site_url('product/add-promo/'.$this->uri->segment(3))
      ];
      $this->load->view('layout',$data);
    } else {
      $start = $this->input('promo_startdate');
      $end = $this->input('promo_enddate');
      $hari_ini = date('Y-m-d');

      if(strtotime($start) < strtotime($hari_ini) || strtotime($end) < strtotime($hari_ini)){
        $this->session->set_flashdata('error', 'Silahkan Masukkan tanggal yang valid');
        $this->session->set_flashdata('value', $this->input('promo_value'));
        redirect(site_url('product/add-promo/'.$this->uri->segment(3)));
        exit;
      }
      if(strtotime($end) < strtotime($start)){
        $this->session->set_flashdata('error', 'Tanggal Mulai tidak boleh kurang dari tanggal akhir');
        $this->session->set_flashdata('value', $this->input('promo_value'));
        redirect(site_url('product/add-promo/'.$this->uri->segment(3)));
        exit;
      }
      if(empty($start)){
        $this->session->set_flashdata('error', 'Tanggal Mulai tidak boleh kosong');
        $this->session->set_flashdata('value', $this->input('promo_value'));
        redirect(site_url('product/add-promo/'.$this->uri->segment(3)));
        exit;
      }
      if(empty($end)){
        $this->session->set_flashdata('error', 'Tanggal Akhir tidak boleh kosong');
        $this->session->set_flashdata('value', $this->input('promo_value'));
        redirect(site_url('product/add-promo/'.$this->uri->segment(3)));
        exit;
      }
      $data = [
        'promo_barang' => $id,
        'promo_startdate' => $start,
        'promo_enddate' => $end,
        'promo_barang' => $this->input('promo_barang'),
        'promo_value' => $this->input('promo_value')
      ];
  
      if(isset($_POST['save'])){
        $this->insert('promo',$data);
        redirect(site_url('product/variant/'.$id));
      }else{
        redirect(site_url('product/variant/'.$id));
      }
    }
    

  }
}
