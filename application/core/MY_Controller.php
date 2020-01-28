<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
  protected $table;
  protected $colId;
  protected $id;
  protected $join = [];
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
    foreach ($dropdown as $val) { 
      $action .= '<a class="dropdown-item has-icon" href="'.$controller.'/'.$val['link'].'/$1"><i class="'.$val['icon'].'"></i> '.$val['label'].'</a>';
    }
    if (sizeof($dropdown) > 0) {
      $body .= '<div class="dropdown d-inline"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button><div class="dropdown-menu dropdown-menu-right">'.$action.'</div></div>';
    }else{
      $body .= '<a href="'.site_url($controller.'/edit/$1').'" class="update_record btn btn-success btn-sm" data-id="$1"><i class="fa fa-edit"></i> Update</a>';
    }
		$this->datatables->select($column);
    $this->datatables->unset_column($id);
		$this->datatables->from($table);
		if (sizeof($this->join) > 0) {
      foreach ($this->join as $val) {
        $this->datatables->join($val['tabel_fk'], $val['tabel_fk'].'.'.$val['pk'].'='.$table.'.'.$val['fk'], $val['type']);
      }
    }
		$this->datatables->add_column('nomor','1');
    $this->datatables->add_column('actions', '<a href="javascript:void(0);" class="hapus_record btn btn-danger btn-sm" data-id="$1"><i class="fa fa-trash"></i> Delete</a> '.$body, $this->new_column.',nomor,actions');

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