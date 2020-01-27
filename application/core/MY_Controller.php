<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
  protected $table;
  protected $colId;
  protected $id;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('MY_Model');
    $this->load->library('datatables');
    
    if(!$this->session->userdata('isLoggin')){
      redirect(site_url('auth/login'));
    }
  }
  public function input($name)
  {
    $input = $this->input->post($name,true);
    return $input;
  }

  public function datatable($column,$id,$table,$controller)
	{
		$this->datatables->select($column)
                ->unset_column($id)
								->from($table)
								->add_column('nomor','1')
                ->add_column('actions', '<a href="javascript:void(0);" class="hapus_record btn btn-danger btn-sm" data-id="$1"><i class="fa fa-trash"></i> Delete</a> <a href="'.site_url($controller.'/edit/$1').'" class="update_record btn btn-success btn-sm" data-id="$1"><i class="fa fa-edit"></i> Update</a>', $column.',nomor,actions');

    return $this->datatables->generate('json','');
	}

  public function get($table, $where, $id=null)
  {
    return $this->MY_Model->get($table, $where, $id);
  }

  public function insert($table, $data, $status=false)
  {
    return $this->MY_Model->insert($table, $data, $status);
  }

  public function update($table, $where, $data, $id)
  {
    return $this->MY_Model->update_data($table, $where, $data, $id);
  }

  public function delete($table, $where, $id)
  {
    return $this->MY_Model->delete_data($table, $where, $id);
  }
  
}