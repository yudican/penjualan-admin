<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {
  protected $table = 'customer';
  protected $id = 'customer_id';

  public function __construct()
  {
    parent::__construct();
    
  }
  

	public function index()
	{
		$data = [
			'title' => 'customer List',
			'isi' 	=> 'dashboard/customer-list'
		];
		$this->load->view('layout',$data);
	}

  public function list()
  {
    $column = 'customer_id,customer_foto,customer_nama,customer_gender,customer_birthday,customer_about';
    echo $this->datatable($column,'customer_id',$this->table,'customer');
  }

  public function edit()
  {
    $this->_rules();
    $id = $this->uri->segment(3);
    if ($this->form_validation->run() == false) {
      $data = [
        'title' => 'Customer List',
        'isi' 	=> 'dashboard/customer-form',
        'action' => site_url('customer/edit/'.$id),
        'row' => $this->get($this->table,'customer_id',$id)->row_array()
      ];
      $this->load->view('layout',$data);
    } else {
      $data = [
        'customer_nama' => $this->input('customer_nama'),
        'customer_gender' => $this->input('customer_gender'),
        'customer_birthday' => $this->input('customer_birthday'),
        'customer_foto' => $this->input('customer_foto'),
        'customer_about' => $this->input('customer_about'),
      ];

      if($this->update($this->table,'customer_id',$data,$id)){
        $this->session->set_flashdata('success', 'Customer Berhasil Di Update');
        redirect(site_url('customer'));
      }else{
        $this->session->set_flashdata('error', 'Customer Gagal Di Update');
        redirect(site_url('customer'));
      }
    }
  }

  public function delete_data()
  {
    $id = $this->uri->segment(3);
    $status = false;
    if($this->delete($this->table,'customer_id',$id)){
      $this->session->set_flashdata('success', 'Customer Berhasil Di Hapus');
      $status = true;
    }else{
      $this->session->set_flashdata('error', 'Customer Gagal Di Hapus');
      $status = false;
    }
    echo json_encode(['status' => $status]);
  }

  public function _rules()
  {
    $this->form_validation->set_rules('customer_nama', 'Nama', 'trim|required');
    $this->form_validation->set_rules('customer_gender', 'Jenis Kelamin', 'trim|required');
    $this->form_validation->set_rules('customer_birthday', 'Tanggal Lahir', 'trim|required');
    $this->form_validation->set_rules('customer_foto', 'Foto', 'trim|required');
    $this->form_validation->set_rules('customer_about', 'Tentang Saya', 'trim|required');
  }
	
}
