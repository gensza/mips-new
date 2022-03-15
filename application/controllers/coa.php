<?php

defined('BASEPATH') or exit('No direct script access allowed');

class coa extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('main_model');
        $this->load->model('data_approve_coa');
        $this->load->model('get_coa_approved');
    }


    public function index()
    {
    }

    public function approve_coa()
    {
        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/coa/coa_approve', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function data_approve_coa()
    {


        $list = $this->data_approve_coa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $d->kode_dev;
            $row[] = $d->namadept;
            $row[] = $d->nabar;
            $row[] = $d->grup;
            $row[] = "<button class='btn btn-primary btn-sm' onclick=pilih_approved(" . $d->id . ") title=' Pilih- " . $d->nabar . "'>Approved</button>";


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->data_approve_coa->count_all(),
            "recordsFiltered" => $this->data_approve_coa->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_coa_approved()
    {

        $id = $this->input->post('id', TRUE);
        $list = $this->get_coa_approved->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {

            $nabar = '<a href="javascript:;" id="namabarang">
            <input type="text" class="form-control form-control-sm" onkeyup="inputtest(' . $d->id . ')" id="nama_' . $d->id . '" value="' . $d->nabar . '">
            <input type="hidden" id="id_nocoa_' . $d->id . '" value="' . $d->id . '">
            </a>';
            $grp = "<select class='form-control form-control-sm grp_coa' id='grp_coa_" . $d->id . "' onClick='get_grub(" . $d->id . ")'  style='font-size: 12px;'> 
            <option value='" . $d->grup . "' selected>  $d->grup </option>
       </select>";

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $nabar;
            $row[] = $grp;
            $row[] = "<a href='javascript:void(0)' onclick=pilih_setujui(" . $d->id . ") title=' Approve - " .  $d->nabar . "'><i class='splashy-check'></i></a>&nbsp;
            <a href='javascript:void(0)' onclick=pilih_approved(" . $d->id . ") title=' No Approve - " .  $d->nabar . "'><i class='splashy-remove'></i></a>
            ";


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->get_coa_approved->count_all($id),
            "recordsFiltered" => $this->get_coa_approved->count_filtered($id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_grup()
    {
        $data = $this->get_coa_approved->get_grup();
        echo json_encode($data);
    }

    public function modal_approve_coa()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;

        if ($result == '1') {
            $this->load->view('gl/coa/cb_table_approve_popup_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    function approved_coa()
    {
        $id = $this->input->post('id', TRUE);
        // $nabar = $this->input->post('nabar', TRUE);
        $grp = $this->input->post('grp', TRUE);

        /* ambil kode barang */
        $kode_barang = $this->get_coa_approved->get_kode_barang($grp);
        $kodebar = $kode_barang + 1;
        /* update kodebar di item_ppo_tmp */
        $hasil = $this->get_coa_approved->update_kodebar($id, $kodebar);
        /* end */

        /* insert coa baru */
        $kodebarang = $this->get_coa_approved->save_kode_barang($id, $kodebar, $grp);
        $noac = $this->get_coa_approved->save_coa_baru($id, $kodebar, $grp);
        /* end insert coa baru */

        /* proses pindah ppo_tmp dan item_ppo_tmp */
        $dt = $this->get_coa_approved->cut_data_ppo_tmp($id);
        /* end */


        echo json_encode($dt);
    }

    function update_ppo_tmp()
    {
        $id = $this->input->post('id');

        $data = $this->get_coa_approved->update_ppo_tmp($id);
        echo json_encode($data);
    }
}

/* End of file coa.php */
