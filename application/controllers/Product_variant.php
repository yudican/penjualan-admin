<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_variant extends MY_Controller {

  
  public function index()
  {
    $id = $this->uri->segment(3);
    $data = [
      'title' => 'Product Variant Input',
      'isi' 	=> 'dashboard/product-variant',
      'action' => site_url('product-variant/save/'.$this->uri->segment(3)),
      'product' => $this->get('barang','barang_id',$this->uri->segment(3))->row_array(),
      'variant' => $this->get('variant_option','product_id',$this->uri->segment(3))->result_array()
    ];
    $this->load->view('layout',$data);
  }

  public function active()
  {
    $id = $this->uri->segment(3);
    $response = ['status' => false];
    $data = array(
      array(
         'product_id' => $id,
         'variant_nama' => $this->input('warna')
      ),
      array(
        'product_id' => $id,
        'variant_nama' => $this->input('ukuran'),
      )
   );
   if($this->db->insert_batch('variant_option', $data)){
     $this->update('barang', 'barang_id', ['barang_variant' => 1] , $id);
     $response = ['status' => true];
   }
   echo json_encode($response);
  }

  public function new_variant()
  {
    $id = $this->uri->segment(3);
    $response = ['status' => false];
    $data = array(
      'product_id' => $id,
      'variant_nama' => $this->input('variant_nama')
   );
   $new_variant = $this->insert('variant_option', $data,true);
   if($new_variant){
     $response = ['status' => true, 'id' => $new_variant];
   }
   echo json_encode($response);
  }

  public function delete_variant()
  {
    $id = $this->uri->segment(3);
    $response = ['status' => false];
   if($this->delete('variant_option', 'variant_id', $id)){
     $response = ['status' => true, 'id' => $id];
   }
   echo json_encode($response);
  }
  public function update_variant()
  {
    $id = $this->uri->segment(3);
    $response = ['status' => false];
    $data = ['variant_nama' => $this->input('variant_nama')];
    $update = !empty($this->input('variant_nama')) ? $this->update('variant_option', 'variant_id', $data, $id) : false;
    if($update){
      $response = ['status' => true, 'id' => $id];
    }
    echo json_encode($response);
  }


  public function save()
  {
    $id = $this->uri->segment(3);
    $variant_id = $this->input('variant_id');
    $variant_value = $this->input('variant_value');
    // $result = array();
    // $data = array();
    foreach($variant_value AS $key => $val){
      $str = rtrim($_POST['variant_value'][$key], ',');
      $value = explode(',', $str);
      for ($i=0; $i < count($value); $i++) { 
        $result = array(
        'variant_iotion_id'   => $_POST['variant_id'][$key],
        'variant_nama_values'   => $value[$i]
        );
        
        $ids = $this->insert('variant_values', $result,true);

        $data = array(
        'product_id' => $this->uri->segment(3),
        'variant_option_id'   => $_POST['variant_id'][$key],
        'variant_values_id'   => $ids
        );
        $this->insert('variant_option_values', $data);
      }
      
      redirect(site_url('product/image/'.$id),'refresh');
      
    }   
  }
}
