<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('users_model');
        $this->load->library('cipasswordhash');
    }

    public function index()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('users/users_view', $data);
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
            $this->load->view('menu/menu_tambah_view', $data);
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
            $this->load->view('users/users_edit_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function data()
    {
        $result = $this->users_model->data()->result_array();
        echo json_encode($result);
    }


    public function detail()
    {

        $data['id_pengguna']    = $this->input->post('id_pengguna', TRUE);
        $result = $this->users_model->detail($data)->row_array();
        echo json_encode($result);
    }


    public function simpan()
    {

        $key  = $this->config->item('encryption_key');
        $pass = $this->input->post('password', TRUE);


        $data['nama']       = $this->input->post('nama', TRUE);
        $data['dept']      = $this->input->post('dept', TRUE);
        $data['level']      = $this->input->post('level', TRUE);
        $data['username']   = $this->input->post('username', TRUE);
        $data['pt']         = $this->input->post('pt', TRUE);
        $data['role']       = $this->input->post('role', TRUE);
        $data['password']   = $this->cipasswordhash->create_hash($pass, $key);
        $data['lokasi']     = $this->input->post('lokasi', TRUE);
        $data['group_modul'] = $this->input->post('group_modul', TRUE);


        $result = $this->users_model->simpan($data);
        echo json_encode($result);
    }


    function update()
    {

        $data['nama']          = $this->input->post('nama_edit', TRUE);
        $data['dept']         = $this->input->post('dept_edit', TRUE);
        $data['level']         = $this->input->post('level_edit', TRUE);
        $data['idpengguna']    = $this->input->post('idpengguna', TRUE);
        $data['role_edit']     = $this->input->post('role_edit', TRUE);
        $data['pt_edit']        = $this->input->post('pt_edit', TRUE);
        $data['lokasi']        = $this->input->post('lokasi_edit', TRUE);
        $data['group_modul']   = $this->input->post('group_modul_edit', TRUE);

        $result = $this->users_model->update($data);
        echo json_encode($result);
    }


    function get_pt()
    {
        $sql = "SELECT * FROM tb_pt ORDER BY nama_pt ASC";
        $result =  $this->db->query($sql)->result();
        echo json_encode($result);
    }


    //module sub
    public function menu_sub_simpan()
    {

        $data['nama']               = $this->input->post('nama', TRUE);
        $data['nama_controller']    = $this->input->post('nama_controller', TRUE);
        $data['id_menu']          = $this->input->post('id_menu', TRUE);

        $result = $this->menu_model->menu_sub_simpan($data);
        echo json_encode($result);
    }

    function data_menu_sub()
    {

        $data['id_menu']          = $this->input->post('id_menu', TRUE);

        $result = $this->menu_model->data_menu_sub($data)->result_array();
        echo json_encode($result);
    }

    function menu_sub_update()
    {


        $data['nama']               = $this->input->post('nama', TRUE);
        $data['nama_controller']    = $this->input->post('nama_controller', TRUE);
        $data['id_menu_sub']        = $this->input->post('id_menu_sub', TRUE);

        $result = $this->menu_model->menu_sub_update($data);
        echo json_encode($result);
    }

    function menu_sub_hapus()
    {

        $data['id_menu_sub']      = $this->input->post('id_menu_sub', TRUE);

        $result = $this->menu_model->menu_sub_hapus($data);
        echo json_encode($result);
    }

    public function get_data_lokasi()
    {
        $result = $this->users_model->get_data_lokasi()->result_array();
        echo json_encode($result);
    }
}
