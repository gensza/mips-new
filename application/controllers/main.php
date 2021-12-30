<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('module_model');
        $this->load->library('session');
    }

    public function page()
    {
        $token       = $_GET['TokEn'];
        $idus        = $_GET['IdUs'];
        $acv         = $_GET['AkTif'];

        $res_token = $this->main_model->check_token_main($token, $idus);
        $res_passtoken   = $this->main_model->check_passusertoken($token, $idus, $acv);
        $data['tokens']  = $token;
        $data['namapt']  = $this->main_model->get_pt()->row_array();
        $data['namalok'] = $this->main_model->get_lokasi()->row_array();
        $data['namamodul'] = $this->main_model->get_modul_app()->row_array();


        if ($res_passtoken == '1') {
            //auth token
            if ($res_token == '1') {
                $data['modules'] = $this->module_model->get_module()->result_array();
                $this->load->view('main/main_view', $data);
            } else {
                redirect(base_url('main/logout'));
            }
        } else {
            redirect(base_url('main/logout'));
        }
    }

    public function logout()
    {

        $nama_lengkap = $this->session->userdata('sess_nama');
        $username     = $this->session->userdata('sess_username');

        $this->session->sess_destroy();
        redirect(base_url('login'));
    }

    public function error_page()
    {
        $this->load->view('main/main_error_page_view');
    }

    public function set_periode()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;

        if ($result == '1') {
            $this->load->view('main/main_set_periode_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function unset_periode()
    {


        $this->session->unset_userdata('sess_periode');

        $periode = $this->input->post('tglsperiodes_new', TRUE);
        $session_data = array('sess_periode' => $periode);

        $up = $this->main_model->update_periode($periode);
        $this->session->set_userdata($session_data);

        //parameter 
        $tokenss    = $this->session->userdata('sess_token');
        $usid       = $this->session->userdata('sess_id');
        $us_active  = $this->session->userdata('sess_aktif');


        echo json_encode(true);

        //redirect(base_url("index.aspx?TokEn=$tokenss&IdUs=$usid&AkTif=$us_active"));

    }
}
