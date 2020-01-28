<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_image extends MY_Controller {

  
  public function index()
  {
    $id = $this->uri->segment(3);
    $action = 'save';
    if ($this->uri->segment(2) == 'image-update') {
      $action = 'save-edit';
    }
    $data = [
      'title' => 'Product Image Input',
      'isi' 	=> 'dashboard/product-image',
      'action' => site_url('product-image/'.$action.'/'.$this->uri->segment(3)),
    ];
    if ($this->uri->segment(2) == 'image-update') {
      $data['images'] = $this->get('gambar', 'gambar_barang_id', $this->uri->segment(3));
    }
    $this->load->view('layout',$data);
  }


  public function save(){
    $data = array();
    $id = $this->uri->segment(3);
    // If file upload form submitted
    if(!empty($_FILES['product_image']['name'])){
        $filesCount = 0;
        if ($this->uri->segment(2) == 'save-edit') {
          $filesCount = count($this->input('gambar_id'));
        }else{
          $filesCount = count($_FILES['product_image']['name']);
        }
        for($i = 0; $i < $filesCount; $i++){
            $_FILES['file']['name']     = $_FILES['product_image']['name'][$i];
            $_FILES['file']['type']     = $_FILES['product_image']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['product_image']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['product_image']['error'][$i];
            $_FILES['file']['size']     = $_FILES['product_image']['size'][$i];
            
            // File upload configuration
            $uploadPath = FCPATH.'/upload/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['overwrite'] = TRUE;
            $config['encrypt_name'] = TRUE;
            
            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            // Upload file to server
            if($this->upload->do_upload('file')){
                // Uploaded file data
                if ($this->uri->segment(2) == 'save-edit') {
                  $img_id = $this->input('gambar_id');
                  $fileData = $this->upload->data();
                  $this->resize($fileData['file_name']);
                  $uploadData[$i]['gambar_id'] = $img_id[$i];
                  $uploadData[$i]['gambar_nama'] = $fileData['file_name'];

                  $row[$i] = $this->get('gambar', 'gambar_id', $img_id[$i])->row_array();
                  if(file_exists($small=FCPATH.'/upload/small/'.$row[$i]['gambar_nama'])){
                    unlink($small);
                  }
                  if(file_exists($large=FCPATH.'/upload/large/'.$row[$i]['gambar_nama'])){
                    unlink($large);
                  }
                  if(file_exists($original=FCPATH.'/upload/'.$row[$i]['gambar_nama'])){
                    unlink($original);
                  }
                  // die;
                }else{
                  $fileData = $this->upload->data();
                  $this->resize($fileData['file_name']);
                  $uploadData[$i]['gambar_barang_id'] = $id;
                  $uploadData[$i]['gambar_nama'] = $fileData['file_name'];
                }
            }
        }
        if ($this->uri->segment(2) == 'save-edit') {
          $this->db->update_batch('gambar',$uploadData, 'gambar_id'); 
          $this->session->set_flashdata('success','gambar berhasil di Update');
          redirect(site_url('product'));
        }else{
          if(!empty($uploadData)){
              // Insert files data into the database
              $insert = $this->db->insert_batch('gambar', $uploadData);
              // Upload status message
              $this->session->set_flashdata('success','gambar berhasil di input');
              redirect(site_url('product'));
          }else{
            $this->session->set_flashdata('error','gambar gagal di input');
              redirect(site_url('product'));
          }
        }
    }
    
  }

  function resize($file_name){
    // Image resizing config
    $config = array(
        // Large Image
        array(
            'image_library' => 'GD2',
            'source_image'  => FCPATH.'./upload/'.$file_name,
            'maintain_ratio'=> FALSE,
            'width'         => 700,
            'height'        => 700,
            'new_image'     => FCPATH.'./upload/large/'.$file_name,
            ),
        // Medium Image
        array(
            'image_library' => 'GD2',
            'source_image'  => FCPATH.'./upload/'.$file_name,
            'maintain_ratio'=> FALSE,
            'width'         => 200,
            'height'        => 200,
            'new_image'     => FCPATH.'./upload/small/'.$file_name,
            ));

    $this->load->library('image_lib', $config[0]);
    foreach ($config as $item){
        $this->image_lib->initialize($item);
        if(!$this->image_lib->resize()){
            return false;
        }
        $this->image_lib->clear();
    }
  }
}