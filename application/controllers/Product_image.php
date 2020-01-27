<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_image extends MY_Controller {

  
  public function index()
  {
    $id = $this->uri->segment(3);
    $data = [
      'title' => 'Product Image Input',
      'isi' 	=> 'dashboard/product-image',
      'action' => site_url('product-image/save/'.$this->uri->segment(3)),
    ];
    $this->load->view('layout',$data);
  }


  public function save(){
    $data = array();
    $id = $this->uri->segment(3);
    // If file upload form submitted
    if(!empty($_FILES['product_image']['name'])){
        $filesCount = count($_FILES['product_image']['name']);
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
                $fileData = $this->upload->data();
                $this->resize($fileData['file_name']);
                $uploadData[$i]['gambar_barang_id'] = $id;
                $uploadData[$i]['gambar_nama'] = $fileData['file_name'];
            }
        }
        
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
    
    // Get files data from the database
    $data['files'] = $this->file->getRows();
    
    // Pass the files data to view
    $this->load->view('upload_files/index', $data);
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