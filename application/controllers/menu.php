<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	
    public function __construct(){
        parent::__construct();		
    	$this->load->model('main_model');
        $this->load->model('menu_model');
    }

    public function index(){

        $tokens = $this->input->post('tokens',TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if($result == '1'){
            $this->load->view('menu/menu_view',$data);
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
                $this->load->view('menu/menu_tambah_view',$data);
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
                $this->load->view('menu/menu_edit_view',$data);
            }else{
                echo "<script> window.location = 'main/logout' </script>";
            }
    }
    
    public function edit2(){
            $tokens   = $this->input->post('tokens',TRUE);
            $id_modal = $this->input->post('id_modal',TRUE);
            $id_row = $this->input->post('id_row',TRUE);
            $result = $this->main_model->check_token($tokens);
            $data['tokens']     = $tokens;
            $data['id_modal']   = $id_modal;
            $data['id_row']     = $id_row;
            if($result == '1'){
                $this->load->view('menu/menu_edit_url_view',$data);
            }else{
                echo "<script> window.location = 'main/logout' </script>";
            }
    }
    
    public function data(){
        $result = $this->menu_model->data()->result_array();
        echo json_encode($result);
    }
    
    public function data_select(){
        $result = $this->menu_model->data_select()->result_array();
        echo json_encode($result);
    }
    
    
    public function detail(){
        
        $data['id_menu']    = $this->input->post('id_menu',TRUE);
        $result = $this->menu_model->detail($data)->row_array();
        echo json_encode($result);
    }
    
    
    public function simpan(){
       
        $data['nama']       = $this->input->post('nama',TRUE);
        $data['punya_sub']  = $this->input->post('punya_sub',TRUE);
        $data['link']       = $this->input->post('link',TRUE);
        
        $result = $this->menu_model->simpan($data);
        echo json_encode($result);
    }
    
    
    function update(){
        
        $data['nama']               = $this->input->post('nama',TRUE);
        $data['controller']         = $this->input->post('controller',TRUE);
        $data['id_menu']            = $this->input->post('id_menu',TRUE);
        $data['punya_sub']          = $this->input->post('punya_sub',TRUE);
        
        $result = $this->menu_model->update($data);
        echo json_encode($result);
        
    }
    
    public function hapus(){
        
        $data['id_menu']    = $this->input->post('id_menu',TRUE);
        $result = $this->menu_model->hapus($data);
        echo json_encode($result);
    }
    
    
    //module sub
    public function menu_sub_simpan(){
        
        $data['nama']               = $this->input->post('nama',TRUE);
        $data['nama_controller']    = $this->input->post('nama_controller',TRUE);
        $data['id_menu']          = $this->input->post('id_menu',TRUE);
        
        $result = $this->menu_model->menu_sub_simpan($data);
        echo json_encode($result);
        
    }
    
    function data_menu_sub(){
        
        $data['id_menu']          = $this->input->post('id_menu',TRUE);
        
        $result = $this->menu_model->data_menu_sub($data)->result_array();
        echo json_encode($result);
    }
    
    function menu_sub_update(){
        
        
        $data['nama']               = $this->input->post('nama',TRUE);
        $data['nama_controller']    = $this->input->post('nama_controller',TRUE);
        $data['id_menu_sub']        = $this->input->post('id_menu_sub',TRUE);
        
        $result = $this->menu_model->menu_sub_update($data);
        echo json_encode($result);
        
    }
    
    
    function menu_sub_hapus(){
        
        $data['id_menu_sub']      = $this->input->post('id_menu_sub',TRUE);
        
        $result = $this->menu_model->menu_sub_hapus($data);
        echo json_encode($result);
        
    }
    
    
}
