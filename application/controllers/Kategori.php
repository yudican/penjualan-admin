<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->table = 'kategori';
    $this->id = 'kategori_id';
  }
  

	public function index()
	{
    $id = $this->uri->segment(3);
		$data = [
			'title' => 'Kategori List',
      'isi' 	=> 'dashboard/kategori-list',
      'kategori' => $this->get($this->table,$this->id)->result_array()
    ];
    if($id){
      $data['row'] = $this->get($this->table,$this->colId,$id)->row_array();
    }
		$this->load->view('layout',$data);
	}

  public function list()
  {
    $column = 'kategori_id,kategori_nama';
    echo $this->datatable($column,'kategori_id',$this->table,'kategori');
  }

  public function add()
  {
    $this->_rules();
    
    if ($this->form_validation->run() == false) {
      $data = [
        'title' => 'Kategori List',
        'isi' 	=> 'dashboard/kategori-form',
        'action' => site_url('kategori/add')
      ];
      $this->load->view('layout',$data);
    } else {
      $data = [
        'kategori_nama' => $this->input('kategori_nama'),
        'kategori_jenis' => $this->input('kategori_jenis'),
      ];

      if($this->insert($this->table,$data)){
        $this->session->set_flashdata('success', 'Kategori Berhasil Di input');
        redirect(site_url('kategori'));
      }else{
        $this->session->set_flashdata('error', 'Kategori Gagal Di input');
        redirect(site_url('kategori/add'));
      }
    }
  }
  public function edit()
  {
    $this->_rules();
    $id = $this->uri->segment(3);
    if ($this->form_validation->run() == false) {
      $data = [
        'title' => 'Kategori List',
        'isi' 	=> 'dashboard/kategori-form',
        'action' => site_url('kategori/edit/'.$id),
        'row' => $this->get($this->table,'kategori_id',$id)->row_array()
      ];
      $this->load->view('layout',$data);
    } else {
      $data = [
        'kategori_nama' => $this->input('kategori_nama'),
        'kategori_jenis' => $this->input('kategori_jenis'),
      ];

      if($this->update($this->table,'kategori_id',$data,$id)){
        $this->session->set_flashdata('success', 'Kategori Berhasil Di Update');
        redirect(site_url('kategori'));
      }else{
        $this->session->set_flashdata('error', 'Kategori Gagal Di Update');
        redirect(site_url('kategori'));
      }
    }
  }

  public function delete_data()
  {
    $id = $this->uri->segment(3);
    $status = false;
    if($this->delete($this->table,'kategori_id',$id)){
      $this->session->set_flashdata('success', 'Kategori Berhasil Di Hapus');
      $status = true;
    }else{
      $this->session->set_flashdata('error', 'Kategori Gagal Di Hapus');
      $status = false;
    }
    echo json_encode(['status' => $status]);
  }

  public function _rules()
  {
    $this->form_validation->set_rules('kategori_nama', 'Nama Kategori', 'trim|required');
  }
	
}
