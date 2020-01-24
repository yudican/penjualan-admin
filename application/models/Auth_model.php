<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
  protected $id = 'id';
  protected $table = 'users';

  public function cekUser($email)
  {
    return $this->db->get_where($this->table, ['email' => $email]);
  }

}
