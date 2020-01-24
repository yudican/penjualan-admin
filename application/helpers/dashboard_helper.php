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
if ( ! function_exists('input_text'))
{
    function input_text($name)
    {
      $form = "";
      $form .= "<div class=\"form-group row mb-4\">
                  <label for=\"".$name."\" class=\"col-form-label text-md-right col-12 col-md-3 col-lg-3\">".ucfirst(str_replace('_',' ', $name))."</label>
                  <div class=\"col-sm-12 col-md-7\"> 
                    <input id=\"".$name."\" type=\"text\" class=\"form-control <?php echo form_error('".$name."') ? 'invalid' : '' ?>\" placeholder=\"Buat ".ucfirst(str_replace('_', ' ', $name))."\" value=\"".set_value($name)."\" name=\"".$name."\">
                    <?php echo error(form_error('".$name."')) ?>
                  </div>
                </div>"; 
      return $form;
    }   
}