<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
  protected $table;
  protected $colId;
  protected $id;
  protected $dt_join = [];
  protected $dt_where = [];
  protected $new_column;
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

  public function datatable($column,$id,$table,$controller,$dropdown=[])
	{
    $this->new_column = str_replace($table.'.'.$id, $id, $column);
    $body = '';
    $action = '';
    $action .= '<a class="hapus_record dropdown-item has-icon" href="javascript:void(0);"><i class="fas fa-times"></i> Hapus</a>';
    foreach ($dropdown as $val) { 
      $action .= '<a class="dropdown-item has-icon" href="'.$controller.'/'.$val['link'].'/$1"><i class="'.$val['icon'].'"></i> '.$val['label'].'</a>';
    }
    if (sizeof($dropdown) > 0) {
      $body .= '<div class="dropdown d-inline"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button><div class="dropdown-menu dropdown-menu-right">'.$action.'</div></div>';
    }else{
      $body .= '<a href="javascript:void(0);" class="hapus_record btn btn-danger btn-sm" data-id="$1"><i class="fa fa-trash"></i> Delete</a> <a href="'.site_url($controller.'/edit/$1').'" class="update_record btn btn-success btn-sm" data-id="$1"><i class="fa fa-edit"></i> Update</a>';
    }
		$this->datatables->select($column);
    $this->datatables->unset_column($id);
		$this->datatables->from($table);
		if (sizeof($this->dt_join) > 0) {
      foreach ($this->dt_join as $val) {
        $this->datatables->join($val['tabel_fk'], $val['tabel_fk'].'.'.$val['pk'].'='.$table.'.'.$val['fk'], $val['type']);
      }
    }
		if (sizeof($this->dt_where) > 0) {
      foreach ($this->dt_where as $where) {
        $this->datatables->where($where['column'], $where['value']);
      }
    }
		$this->datatables->add_column('nomor','1');
    $this->datatables->add_column('actions', $body, $this->new_column.',nomor,actions');

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