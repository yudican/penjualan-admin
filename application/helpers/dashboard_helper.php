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
if ( ! function_exists('input_select2'))
{
    function input_select2($name,$row_name=null,$table,$primary,$value)
    {
      $CI =& get_instance();
      $lists = $CI->db->get($table)->result_array();
      $form = "";
      $form .= "<div class=\"form-group row mb-4\">
                  <label for=\"".$name."\" class=\"col-form-label text-md-right col-12 col-md-3 col-lg-3\">".ucfirst(str_replace('_',' ', $name))."</label>
                  <div class=\"col-sm-12 col-md-7\"> 
                    <select name=\"".$name."\" id=\"".$name."\" ".error_border(form_error($name))." class=\"form-control select2\">
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


if ( ! function_exists('dd'))
{
    function dd($data = [])
    {
      $result = '';
      $result .= '<pre>';
      $result .= print_r($data);
      $result .= '</pre>';
      return $result;
      die;
    }   
}
if ( ! function_exists('getCategoryTree'))
{
  function getCategoryTree($level = null, $prefix = '') {
    
    $CI =& get_instance();
    
    $rows = $CI->db
        ->select('kategori.kategori_id,kategori.kategori_nama, kategori.kategori_jenis')
        ->join('kategori_produk', 'kategori_produk.id_kategori=kategori.kategori_id', 'inner')
        ->where('kategori_jenis', $level)
        ->order_by('kategori_id','asc')
        ->get('kategori')
        ->result();

    $category = "";
    $i = 1;
    if (count($rows) > 0) {
      foreach ($rows as $row) {
        $lev =  strlen($prefix) == 0 ? 'sub' : 'super sub';
        $action = strlen($prefix) == 0 ? 'onchange="selectSubCategory();" id="barang_subkategori"' : 'id="barang_kategori"';
        $kategori = $CI->db->get_where('kategori', ['kategori_jenis' => $row->kategori_jenis])->result_array();
            $category .= "<div class=\"form-group row mb-4\" id=\"data_kategori-".$row->kategori_jenis."\">
                            <label for=\"barang_kategori\" class=\"col-form-label text-md-right col-12 col-md-3 col-lg-3\"> ".$lev." Kategori</label>
                            <div class=\"col-sm-12 col-md-7\"> 
                              <select name=\"barang_kategori[]\" onchange=\"selectCategory(".$row->kategori_jenis.");\" id=\"barang_kategori-".$row->kategori_jenis."\" class=\"form-control\">
                                <option value=\"\">Pilih Kategori </option>";
                                foreach ($kategori as $list) {
                                  $category .= "<option value=\"".$list['kategori_id']."\" ".set_select('barang_kategori',isset($row->kategori_id) ? $row->kategori_id : '',$list['kategori_id'] == $row->kategori_id).">".$list['kategori_nama']."</option>";
                                }
                $category .= "</select>
                            </div>
                          </div>";
            // Append subcategories
            $category .= getCategoryTree($row->kategori_id, $prefix . $i);
            
        }
    }
    return $category;
  }   
}
