<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends MY_Controller {
  protected $table = 'promo';
  protected $id = 'promo_id';

  public function __construct()
  {
    parent::__construct();
    
  }
  

	public function index()
	{
		$data = [
			'title' => 'Promo List',
			'isi' 	=> 'dashboard/promo-list'
		];
		$this->load->view('layout',$data);
	}

  public function list()
  {
    $column = 'promo_id,promo_barang,promo_startdate,promo_enddate,promo_value';
    echo $this->datatable($column,'promo_id',$this->table,'promo');
  }

  public function add()
  {
    $this->_rules();
    
    if ($this->form_validation->run() == false) {
      $data = [
        'title' => 'Promo List',
        'isi' 	=> 'dashboard/promo-form',
        'action' => site_url('promo/add')
      ];
      $this->load->view('layout',$data);
    } else {
      $data = [
        'promo_barang' => $this->input('promo_barang'),
        'promo_startdate' => $this->input('promo_startdate'),
        'promo_enddate' => $this->input('promo_enddate'),
        'promo_value' => $this->input('promo_value'),
      ];

      if($this->insert($this->table,$data)){
        $this->session->set_flashdata('success', 'Promo Berhasil Di input');
        redirect(site_url('promo'));
      }else{
        $this->session->set_flashdata('error', 'Promo Gagal Di input');
        redirect(site_url('promo/add'));
      }
    }
  }
  public function edit()
  {
    $this->_rules();
    $id = $this->uri->segment(3);
    if ($this->form_validation->run() == false) {
      $data = [
        'title' => 'Promo List',
        'isi' 	=> 'dashboard/promo-form',
        'action' => site_url('promo/edit/'.$id),
        'row' => $this->get($this->table,'promo_id',$id)->row_array()
      ];
      $this->load->view('layout',$data);
    } else {
      $data = [
        'promo_barang' => $this->input('promo_barang'),
        'promo_startdate' => $this->input('promo_startdate'),
        'promo_enddate' => $this->input('promo_enddate'),
        'promo_value' => $this->input('promo_value'),
      ];

      if($this->update($this->table,'promo_id',$data,$id)){
        $this->session->set_flashdata('success', 'Promo Berhasil Di Update');
        redirect(site_url('promo'));
      }else{
        $this->session->set_flashdata('error', 'Promo Gagal Di Update');
        redirect(site_url('promo'));
      }
    }
  }

  public function delete_data()
  {
    $id = $this->uri->segment(3);
    $status = false;
    if($this->delete($this->table,'promo_id',$id)){
      $this->session->set_flashdata('success', 'Promo Berhasil Di Hapus');
      $status = true;
    }else{
      $this->session->set_flashdata('error', 'Promo Gagal Di Hapus');
      $status = false;
    }
    echo json_encode(['status' => $status]);
  }

  public function _rules()
  {
    $this->form_validation->set_rules('promo_barang', 'Nama Produk', 'trim|required');
    $this->form_validation->set_rules('promo_startdate', 'Start Date', 'trim|required');
    $this->form_validation->set_rules('promo_enddate', 'End Date', 'trim|required|numeric');
    $this->form_validation->set_rules('promo_value', 'Value', 'trim|required|numeric');
  }
	
}
