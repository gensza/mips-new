<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Module extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('module_model');
    }

    public function index()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('module/module_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function level()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('role/level_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function tambah()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        $data['id_modal'] = $id_modal;
        if ($result == '1') {
            $this->load->view('module/module_tambah_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function edit()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;
        if ($result == '1') {
            $this->load->view('module/module_edit_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function edit_sub()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;
        if ($result == '1') {
            $this->load->view('module/module_edit_sub_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function edit2()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;
        if ($result == '1') {
            $this->load->view('module/module_edit_url_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function data()
    {
        $result = $this->module_model->data()->result_array();
        echo json_encode($result);
    }


    public function detail()
    {

        $data['id']    = $this->input->post('id', TRUE);
        $result = $this->module_model->detail($data)->row_array();
        echo json_encode($result);
    }


    public function simpan()
    {

        $data['nama']       = $this->input->post('nama', TRUE);
        $data['icon']       = $this->input->post('icon', TRUE);
        $data['punya_sub']  = $this->input->post('punya_sub', TRUE);
        $data['link']       = $this->input->post('link', TRUE);

        $result = $this->module_model->simpan($data);
        echo json_encode($result);
    }


    function module_update()
    {

        $data['nama']               = $this->input->post('nama', TRUE);
        $data['controller']         = $this->input->post('controller', TRUE);
        $data['id_module']          = $this->input->post('id_module', TRUE);
        $data['icon']               = $this->input->post('icon', TRUE);
        $data['punya_sub']          = $this->input->post('punya_sub', TRUE);

        $result = $this->module_model->module_update($data);
        echo json_encode($result);
    }


    //module sub
    public function module_sub_simpan()
    {

        $data['nama']               = $this->input->post('nama', TRUE);
        $data['nama_controller']    = $this->input->post('nama_controller', TRUE);
        $data['have_child']         = $this->input->post('have_child', TRUE);
        $data['id_module']          = $this->input->post('id_module', TRUE);

        $result = $this->module_model->module_sub_simpan($data);
        // $this->module_model->simpan_module_permission($data);
        echo json_encode($result);
    }


    public function module_sub_simpan_sub()
    {

        $data['nama']               = $this->input->post('nama', TRUE);
        $data['nama_controller']    = $this->input->post('nama_controller', TRUE);
        $data['have_child']         = $this->input->post('have_child', TRUE);
        $data['id_module']          = $this->input->post('id_module', TRUE);

        $result = $this->module_model->module_sub_simpan_sub($data);
        echo json_encode($result);
    }

    function data_module_sub()
    {

        $data['id_module']          = $this->input->post('id_module', TRUE);

        $result = $this->module_model->data_module_sub($data)->result_array();
        echo json_encode($result);
    }

    function module_sub_update()
    {


        $data['nama']               = $this->input->post('nama', TRUE);
        $data['nama_controller']    = $this->input->post('nama_controller', TRUE);
        $data['id_module_sub']          = $this->input->post('id_module_sub', TRUE);

        $result = $this->module_model->module_sub_update($data);
        echo json_encode($result);
    }


    function module_sub_hapus()
    {

        $data['id_module_sub']      = $this->input->post('id_module_sub', TRUE);

        $result = $this->module_model->module_sub_hapus($data);
        echo json_encode($result);
    }
}
