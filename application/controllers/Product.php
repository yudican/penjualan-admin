<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
  protected $table = 'barang';
  protected $id = 'barang_id';

  public function __construct()
  {
    parent::__construct();
    
  }
  

	public function index()
	{
		$data = [
			'title' => 'Product List',
			'isi' 	=> 'dashboard/product-list'
		];
		$this->load->view('layout',$data);
	}

  public function list()
  {
    $column = 'barang_id,barang_nama,barang_kategori,barang_sku,barang_stock,barang_detail';
    echo $this->datatable($column,'barang_id',$this->table,'product');
  }

  public function add()
  {
    $this->_rules();
    
    if ($this->form_validation->run() == false) {
      $data = [
        'title' => 'Product List',
        'isi' 	=> 'dashboard/product-form',
        'action' => site_url('product/add')
      ];
      $this->load->view('layout',$data);
    } else {
      $data = [
        'barang_nama' => $this->input('barang_nama'),
        'barang_kategori' => $this->input('barang_kategori'),
        'barang_sku' => $this->input('barang_sku'),
        'barang_stock' => $this->input('barang_stock'),
        'barang_type' => $this->input('barang_type'),
        'barang_hrg_beli' => $this->input('barang_hrg_beli'),
        'barang_hrg_jual' => $this->input('barang_hrg_jual'),
        'barang_detail' => $this->input('barang_detail'),
      ];

      if($this->insert($this->table,$data)){
        $this->session->set_flashdata('success', 'Produk Berhasil Di input');
        redirect(site_url('product/add-promo/'.$this->input('barang_sku')));
      }else{
        $this->session->set_flashdata('error', 'Produk Gagal Di input');
        redirect(site_url('product/add'));
      }
    }
  }
  public function edit()
  {
    $this->_rules();
    $id = $this->uri->segment(3);
    if ($this->form_validation->run() == false) {
      $data = [
        'title' => 'Product List',
        'isi' 	=> 'dashboard/product-form',
        'action' => site_url('product/edit/'.$id),
        'row' => $this->get($this->table,'barang_id',$id)->row_array()
      ];
      $this->load->view('layout',$data);
    } else {
      $data = [
        'barang_nama' => $this->input('barang_nama'),
        'barang_kategori' => $this->input('barang_kategori'),
        'barang_sku' => $this->input('barang_sku'),
        'barang_stock' => $this->input('barang_stock'),
        'barang_type' => $this->input('barang_type'),
        'barang_hrg_beli' => $this->input('barang_hrg_beli'),
        'barang_hrg_jual' => $this->input('barang_hrg_jual'),
        'barang_detail' => $this->input('barang_detail'),
      ];

      if($this->update($this->table,'barang_id',$data,$id)){
        $this->session->set_flashdata('success', 'Produk Berhasil Di Update');
        redirect(site_url('product'));
      }else{
        $this->session->set_flashdata('error', 'Produk Gagal Di Update');
        redirect(site_url('product'));
      }
    }
  }

  public function delete_data()
  {
    $id = $this->uri->segment(3);
    $status = false;
    if($this->delete($this->table,'barang_id',$id)){
      $this->session->set_flashdata('success', 'Produk Berhasil Di Hapus');
      $status = true;
    }else{
      $this->session->set_flashdata('error', 'Produk Gagal Di Hapus');
      $status = false;
    }
    echo json_encode(['status' => $status]);
  }

  public function _rules()
  {
    $this->form_validation->set_rules('barang_nama', 'Nama Produk', 'trim|required');
    $this->form_validation->set_rules('barang_kategori', 'Kategori Produk', 'trim|required');
    $this->form_validation->set_rules('barang_sku', 'SKU', 'trim|required|numeric');
    $this->form_validation->set_rules('barang_stock', 'Stok Produk', 'trim|required|numeric');
    $this->form_validation->set_rules('barang_type', 'Type Produk', 'trim|required');
    $this->form_validation->set_rules('barang_hrg_beli', 'Harga Beli Produk', 'trim|required');
    $this->form_validation->set_rules('barang_hrg_jual', 'Harga Jual Produk', 'trim|required');
    $this->form_validation->set_rules('barang_detail', 'Deskripsi Produk', 'trim|required');
  }
	
}
