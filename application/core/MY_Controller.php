<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    if(!$this->session->userdata('isLoggin')){
      redirect(site_url('auth/login'));
    }
  }
  

  public function input($name)
  {
    $input = $this->input->post($name,true);
    return $input;
  }

}