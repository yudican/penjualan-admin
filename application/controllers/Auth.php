<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Auth_model','auth');
    
  }
  

	public function index()
	{
		$this->load->view('auth/login');
  }
  
  public function login()
	{
    if($this->session->userdata('isLoggin')){
      redirect(site_url('dashboard'));
    }

    $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'password', 'trim|required');

    
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('auth/login');
    } else {
      $email = input('email');
      $password = input('password');

      $user = $this->auth->cekUser($email);
      if($user->num_rows() > 0){
        $row = $user->row_array();

        if(password_verify($password, $row['password'])){
          $userdata = [
            'user_id' => $row['id'],
            'isLoggin' => true,
          ];

          $this->session->set_userdata($userdata);
          $this->session->set_flashdata('success', 'Welcome, Login Successfuly');
          redirect(site_url('dashboard'));
        }else{
          $this->session->set_flashdata('email', $email);
          $this->session->set_flashdata('error', 'Login Gagal, Email atau Password salah');
          redirect(site_url('auth/login'));
        }
      }else{
        $this->session->set_flashdata('email', $email);
        $this->session->set_flashdata('error', 'Login Gagal, Email tidak terdaftar');
        redirect(site_url('auth/login'));
      }
    }
  }
  
  public function logout()
  {
    $userdata = [
      'user_id' => $row['id'],
      'isLoggin' => true,
    ];

    $this->session->unset_userdata(['user_id', 'isLoggin']);
    $this->session->sess_destroy();
    redirect(site_url('auth/login'));
  }
}
