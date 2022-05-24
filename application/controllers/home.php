<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');

        $db_pt = check_db_pt();

        if ($this->session->userdata('sess_id_lokasi') == '01') {
            $this->mips_caba = $this->load->database('db_mips_cb_' . $db_pt, TRUE); //HO
            $this->mips_gl = $this->load->database('mips_gl_' . $db_pt, TRUE); //HO
        } elseif ($this->session->userdata('sess_id_lokasi') == '02') {
            $this->mips_caba = $this->load->database('db_mips_cb_' . $db_pt . '_ro', TRUE); //RO
            $this->mips_gl = $this->load->database('mips_gl_' . $db_pt . '_ro', TRUE); //RO
        } elseif ($this->session->userdata('sess_id_lokasi') == '03') {
            $this->mips_caba = $this->load->database('db_mips_cb_' . $db_pt . '_pks', TRUE); //PKS
            $this->mips_gl = $this->load->database('mips_gl_' . $db_pt . '_pks', TRUE); //PKS
        } else {
            $this->mips_caba = $this->load->database('db_mips_cb_' . $db_pt . '_site', TRUE); //SITE
            $this->mips_gl = $this->load->database('mips_gl_' . $db_pt . '_site', TRUE); //SITE
        }

        $this->mips_center  = $this->load->database('mips_center', TRUE);
    }

    public function index()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        $data['ses_nama'] = $this->session->userdata('sess_nama');
        $data['namamodul'] = $this->main_model->get_modul_app()->row_array();
        $data['namapt']  = $this->main_model->get_pt()->row_array();
        $data['count_data']  = $this->main_model->count_data();
        $data['pt'] = $this->mips_center->get('tb_pt')->result_array();
        // var_export($data) . die();
        if ($result == '1') {
            $this->load->view('home/home_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }
}
