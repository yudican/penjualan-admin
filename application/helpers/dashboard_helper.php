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
    function input_text($name,$row_name=null,$type='text')
    {
      $form = "";
      $form .= "<div class=\"form-group row mb-4\">
                  <label for=\"".$name."\" class=\"col-form-label text-md-right col-12 col-md-3 col-lg-3\">".ucfirst(str_replace('_',' ', $name))."</label>
                  <div class=\"col-sm-12 col-md-7\"> 
                    <input id=\"".$name."\" type=\"".$type."\" class=\"form-control\" ".error_border(form_error($name))." placeholder=\"Buat ".ucfirst(str_replace('_', ' ', $name))."\" value=\"".set_value($name,$row_name)."\" name=\"".$name."\" required>
                    ".error(form_error($name))."
                  </div>
                </div>"; 
      return $form;
    }   
}
if ( ! function_exists('input_date'))
{
    function input_date($name,$row_name=null,$type='date')
    {
      $form = "";
      $form .= "<div class=\"form-group row mb-4\">
                  <label for=\"".$name."\" class=\"col-form-label text-md-right col-12 col-md-3 col-lg-3\">".ucfirst(str_replace('_',' ', $name))."</label>
                  <div class=\"col-sm-12 col-md-7\"> 
                    <input id=\"".$name."\" type=\"".$type."\" class=\"form-control\" ".error_border(form_error($name))." placeholder=\"Buat ".ucfirst(str_replace('_', ' ', $name))."\" value=\"".set_value($name,$row_name)."\" name=\"".$name."\">
                    ".error(form_error($name))."
                  </div>
                </div>"; 
      return $form;
    }   
}
if ( ! function_exists('input_hidden'))
{
    function input_hidden($name,$value)
    {
      $form = "";
      $form .= "<input type=\"hidden\" name=\"".$name."\" value=\"".$value."\" >"; 
      return $form;
    }   
}

if ( ! function_exists('input_textarea'))
{
    function input_textarea($name,$row_name=null)
    {
      $form = "";
      $form .= "<div class=\"form-group row mb-4\">
                  <label for=\"".$name."\" class=\"col-form-label text-md-right col-12 col-md-3 col-lg-3\">".ucfirst(str_replace('_',' ', $name))."</label>
                  <div class=\"col-sm-12 col-md-7\"> 
                    <textarea name=\"".$name."\" row=\"10\" placeholder=\"Buat ".ucfirst(str_replace('_', ' ', $name))."\" class=\"form-control\" ".error_border(form_error($name)).">".set_value($name,$row_name)."</textarea>
                    ".error(form_error($name))."
                  </div>
                </div>"; 
      return $form;
    }   
}
if ( ! function_exists('input_select'))
{
    function input_select($name,$row_name=null,$table,$primary,$value)
    {
      $CI =& get_instance();
      $lists = $CI->db->get($table)->result_array();
      $form = "";
      $form .= "<div class=\"form-group row mb-4\">
                  <label for=\"".$name."\" class=\"col-form-label text-md-right col-12 col-md-3 col-lg-3\">".ucfirst(str_replace('_',' ', $name))."</label>
                  <div class=\"col-sm-12 col-md-7\"> 
                    <select name=\"".$name."\" id=\"".$name."\" ".error_border(form_error($name))." class=\"form-control\">
                      <option value=\"\">Pilih ".ucfirst(str_replace('_',' ', $name))."</option>";
                      foreach ($lists as $list) {
                  $form .= "<option value=\"".$list[$primary]."\" ".set_select($name,$row_name,($list[$primary] == $row_name)).">".$list[$value]."</option>";
                        }
                        $form .=  "</select>
                    ".error(form_error($name))."
                  </div>
                </div>"; 
      return $form;
    }   
}

if ( ! function_exists('value'))
{
    function value($name)
    {
      $value = '';
      if (isset($name)) {
        $value = $name;
      }
      return $value;
    }   
}