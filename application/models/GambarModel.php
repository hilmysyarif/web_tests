<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GambarModel extends CI_Model {
  // Fungsi untuk menampilkan semua data gambar
  public function view(){
    return $this->db->get('users')->result();
  }
  
  // Fungsi untuk melakukan proses upload file
  public function upload($username, $email){
    $config['upload_path']="./assets/images";
    $config['allowed_types']='gif|jpg|png';
    $config['encrypt_name'] = TRUE;
     
    $this->load->library('upload',$config);
    if($this->upload->do_upload("file")){
        $data = array('upload_data' => $this->upload->data());

        $image= $data['upload_data']['file_name']; 
         
        $result= $this->simpan_upload($username,$email,$image);
        echo json_decode($result);
    }
 
  }

 
  function simpan_upload($username, $email, $image){
      $data = array(
              'username' => $username,
              'email' => $email,
              'image' => $image
          );  
      $result= $this->db->insert('users',$data);
      return $result;
  }  
}