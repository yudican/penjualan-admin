<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_model extends CI_Model {
  protected $id;
  protected $table;

  
  public function get($table, $colId, $id=null)
	{
    $this->table = $table;
    $this->id = $colId;
    if($id){
      return $this->db->get_where($this->table, [$this->id => $id]);
    }else{
      return $this->db->get($this->table);
    }
	}

  public function insert($table, $data, $insertId=false)
	{
    $this->table = $table;
    $this->db->insert($this->table, $data);
    return $insertId ? $this->db->insert_id() : $this->db->affected_rows();
  }
  
  public function update_data($table, $colId, $data, $id)
	{
    $this->table = $table;
    $this->id = $colId;
    $this->db->update($this->table, $data, [$this->id => $id]);
    return $this->db->affected_rows();
  }
  
  public function delete_data($table, $colId, $id)
	{
    $this->table = $table;
    $this->id = $colId;
    $this->db->delete($this->table, [$this->id => $id]);
    return $this->db->affected_rows();
  }  
}
