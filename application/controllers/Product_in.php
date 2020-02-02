<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_in extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->table = 'barang_in';
    $this->id = 'brgin_id';
  }
  

	public function index()
	{
    $id = $this->uri->segment(3);
		$data = [
			'title' => 'Product In',
      'isi' 	=> 'dashboard/product-in',
      'barang_in' => $this->get($this->table,$this->id)->result_array()
    ];
    if($id){
      $data['row'] = $this->get($this->table,$this->colId,$id)->row_array();
    }
		$this->load->view('layout',$data);
	}

  public function list()
  {
    $column = 'brgin_id,brgin_barang,brgin_tanggal,brgin_value';
    echo $this->datatable($column,'brgin_id',$this->table,'barang_in');
  }

  public function add()
  {
    $this->_rules();
    
    if ($this->form_validation->run() == false) {
      $data = [
        'title' => 'Product In',
        'isi' 	=> 'dashboard/product_in-form',
        'action' => site_url('product_in/add')
      ];
      $this->load->view('layout',$data);
    } else {
      $data = [
        'brgin_barang' => $this->input('brgin_barang'),
        'brgin_tanggal' => $this->input('brgin_tanggal'),
        'brgin_value' => $this->input('brgin_value'),
      ];

      if($this->insert($this->table,$data)){
        $this->session->set_flashdata('success', 'Product-In Berhasil Di input');
        redirect(site_url('product_in'));
      }else{
        $this->session->set_flashdata('error', 'Product-In Gagal Di input');
        redirect(site_url('product_in/add'));
      }
    }
  }
  public function edit()
  {
    $this->_rules();
    $id = $this->uri->segment(3);
    if ($this->form_validation->run() == false) {
      $data = [
        'title' => 'Product In',
        'isi' 	=> 'dashboard/product_in-form',
        'action' => site_url('product_in/edit/'.$id),
        'row' => $this->get($this->table,'brgin_id',$id)->row_array()
      ];
      $this->load->view('layout',$data);
    } else {
      $data = [
        'brgin_barang' => $this->input('brgin_barang'),
        'brgin_tanggal' => $this->input('brgin_tanggal'),
        'brgin_value' => $this->input('brgin_value'),
      ];

      if($this->update($this->table,'brgin_id',$data,$id)){
        $this->session->set_flashdata('success', 'Product-In Berhasil Di Update');
        redirect(site_url('product_in'));
      }else{
        $this->session->set_flashdata('error', 'Product-In Gagal Di Update');
        redirect(site_url('product_in'));
      }
    }
  }

  public function delete_data()
  {
    $id = $this->uri->segment(3);
    $status = false;
    if($this->delete($this->table,'brgin_id',$id)){
      $this->session->set_flashdata('success', 'Product-In Berhasil Di Hapus');
      $status = true;
    }else{
      $this->session->set_flashdata('error', 'Product-In Gagal Di Hapus');
      $status = false;
    }
    echo json_encode(['status' => $status]);
  }

  public function _rules()
  {
    $this->form_validation->set_rules('brgin_barang', 'Id Barang', 'trim|required');
    $this->form_validation->set_rules('brgin_tanggal', 'Tanggal In', 'trim|required');
    $this->form_validation->set_rules('brgin_value', 'Value', 'trim|required');
  }
	
}
