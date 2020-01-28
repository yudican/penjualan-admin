<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->table = 'barang';
    $this->colId = 'barang_id';
  }
  

	public function index()
	{
		$data = [
			'title' => 'Product List',
			'isi' 	=> 'dashboard/product-list',
		];
		$this->load->view('layout',$data);
	}
  /**
   * $column = daftar nama kolom yang akan di tampilkan
   * $this->colId = kolom primary key
   * $this->table = nama tabel
   * product = adalah nama controller 
   */
  public function list()
  {
    $dropdown_data = [
      [
        'link' => 'add-promo',
        'icon' => 'fas fa-tags',
        'label' => 'input promo'
      ],
      [
        'link' => 'image-update',
        'icon' => 'fas fa-images',
        'label' => 'Update Gambar'
      ],
      [
        'link' => 'edit',
        'icon' => 'fas fa-edit',
        'label' => 'Update Data'
      ]
    ];
    $column = 'barang_id,barang_nama,barang_kategori,barang_barcode,barang_stock,barang_detail';
    echo $this->datatable($column,$this->colId,$this->table,'product',$dropdown_data); //  
  }

  public function form()
  {
    $this->_rules();
    $id = $this->uri->segment(3);
    $type = !$id ? 'add' : 'edit';
    $kategori = $this->input('barang_kategori');
    if ($this->form_validation->run() == false) {
      $data = [
        'title' => 'Product List',
        'isi' 	=> 'dashboard/product-form',
        'action' => site_url('product/'.$type),
        'kategori' => $this->db->get_where('kategori',['kategori_jenis' => null])->result_array(),
      ];
      if($id){
        $data['row'] = $this->get($this->table,$this->colId,$id)->row_array();
      }
      $this->load->view('layout',$data);
    } else {
      $data = [
        'barang_nama' => $this->input('barang_nama'),
        'barang_kategori' =>$kategori[0],
        'barang_barcode' => $this->input('barang_barcode'),
        'barang_stock' => $this->input('barang_stock'),
        'barang_type' => $this->input('barang_type'),
        'barang_hrg_beli' => $this->input('barang_hrg_beli'),
        'barang_hrg_jual' => $this->input('barang_hrg_jual'),
        'barang_detail' => $this->input('barang_detail'),
      ];
      $insert_or_update = !$id ? $this->insert($this->table,$data,true) : $this->update($this->table,$this->colId,$data,$id);
      !$id ? $this->save_category($kategori,$insert_or_update) : null;
      if($insert_or_update){
        $this->session->set_flashdata('success', 'Produk Berhasil Di '.$type);
        !$id ? redirect(site_url('product/variant/'.$insert_or_update)) : redirect(site_url('product'));
      }else{
        $this->session->set_flashdata('error', 'Produk Gagal Di '.$type);
        redirect(site_url('product/add'));
      }
    }
  }

  public function delete_data()
  {
    $id = $this->uri->segment(3);
    $status = false;
    if($this->delete($this->table,$this->colId,$id)){
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
    // $this->form_validation->set_rules('barang_kategori', 'Kategori Produk', 'trim|required');
    $this->form_validation->set_rules('barang_barcode', 'SKU', 'trim|required|numeric');
    $this->form_validation->set_rules('barang_stock', 'Stok Produk', 'trim|required|numeric');
    $this->form_validation->set_rules('barang_type', 'Type Produk', 'trim|required');
    $this->form_validation->set_rules('barang_hrg_beli', 'Harga Beli Produk', 'trim|required');
    $this->form_validation->set_rules('barang_hrg_jual', 'Harga Jual Produk', 'trim|required');
    $this->form_validation->set_rules('barang_detail', 'Deskripsi Produk', 'trim|required');
  }


  function get_category(){
    $id = $this->uri->segment(3);

    $response = ['status' => false, 'data' => []];
    $data = $this->get('kategori', 'kategori_jenis', $id)->result_array();
    if($data){
      $response = ['status' => true, 'data' => $data];
    }
    echo json_encode($response);
  }

  function save_category($kategori,$id){
    
    $data = [];
    foreach($kategori as $key => $val){
      $data[] = [
        'id_produk' => $id,
        'id_kategori' => $val
      ];
    }
    return $this->db->insert_batch('kategori_produk', $data) ? true : false;
  }
	
}
