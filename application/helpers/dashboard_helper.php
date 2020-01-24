<?php

if ( ! function_exists('input'))
{
    function input($name)
    {
      $CI =& get_instance();
      
      $form_input = $CI->input->post($name,true);
      return $form_input;
    }   
}
if ( ! function_exists('getUser'))
{
    function getUser($params='id')
    {
      $CI =& get_instance();
      
      $user = $CI->db->get_where('users',['id' => $CI->session->userdata('user_id')],1)->row_array();
      return $user[$params];
    }   
}