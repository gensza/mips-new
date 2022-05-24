<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	
    public function __construct(){
        parent::__construct();		
    	$this->load->model('main_model');
        $this->load->model('member_model');
    }

    public function index(){

        $tokens = $this->input->post('tokens',TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if($result == '1'){
            $this->load->view('member/member_view',$data);
        }else{
            echo "<script> window.location = 'main/logout' </script>";
        }

    }

    public function tambah(){
            $tokens   = $this->input->post('tokens',TRUE);
            $id_modal = $this->input->post('id_modal',TRUE);
            $result = $this->main_model->check_token($tokens);
            $data['tokens'] = $tokens;
            $data['id_modal'] = $id_modal;
            if($result == '1'){
                $this->load->view('member/member_tambah_view',$data);
            }else{
                echo "<script> window.location = 'main/logout' </script>";
            }
    }
    
    public function edit(){
            $tokens   = $this->input->post('tokens',TRUE);
            $id_modal = $this->input->post('id_modal',TRUE);
            $id_row = $this->input->post('id_row',TRUE);
            $result = $this->main_model->check_token($tokens);
            $data['tokens']     = $tokens;
            $data['id_modal']   = $id_modal;
            $data['id_row']     = $id_row;
            if($result == '1'){
                $this->load->view('member/member_edit_view',$data);
            }else{
                echo "<script> window.location = 'main/logout' </script>";
            }
    }
    
    public function data(){
        $result = $this->member_model->data()->result_array();
        echo json_encode($result);
    }
    
    public function detail(){
        $id_berita   = $this->input->post('id_berita',TRUE);
        $result = $this->berita_model->detail($id_berita)->row_array();
        echo json_encode($result);
    }

    public function simpan(){
  
        $data['judul']       = $this->input->post('judul',TRUE);
        $data['deskripsi']   = $this->input->post('deskripsi');
        $data['gambar']      = $this->input->post('gambar',TRUE);
        
        $result = $this->member_model->simpan($data);
        echo json_encode($result);
        
    }
    
    
    public function update(){
       
        $data['judul']       = $this->input->post('judul',TRUE);
        $data['deskripsi']   = $this->input->post('deskripsi');
        $data['id_berita']   = $this->input->post('id_berita',TRUE);
        $data['gambar']      = $this->input->post('gambar',TRUE);

        $result = $this->member_model->update($data);
        echo json_encode($result);
    }
    
    
    public function hapus(){
        $id_member   = $this->input->post('id_member',TRUE);
        $result = $this->member_model->hapus($id_member);
        echo json_encode($result);
    }
    
}
