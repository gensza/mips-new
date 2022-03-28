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
        $this->load->model('get_new_coa');
        // $this->load->library(array('excel', 'session'));

        $db_pt = check_db_pt();

        if ($this->session->userdata('sess_id_lokasi') == '01') {
            $this->mips_gl = $this->load->database('mips_gl_' . $db_pt, TRUE); //HO
        } elseif ($this->session->userdata('sess_id_lokasi') == '02') {
            $this->mips_gl = $this->load->database('mips_gl_' . $db_pt . '_ro', TRUE); //RO
        } elseif ($this->session->userdata('sess_id_lokasi') == '03') {
            $this->mips_gl = $this->load->database('mips_gl_' . $db_pt . '_pks', TRUE); //PKS
        } else {
            $this->mips_gl = $this->load->database('mips_gl_' . $db_pt . '_site', TRUE); //SITE
        }

        $this->mips_center  = $this->load->database('mips_center', TRUE);
    }


    public function index()
    {
    }

    public function upload()
    {
        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/coa/coa_upload_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    function upload_coa()
    {
        //phpexcel to mysql database
        if (isset($_FILES["file_coa"]["name"])) {
            // upload
            $file_tmp = $_FILES['file_coa']['tmp_name'];
            $file_name = $_FILES['file']['name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];
            // move_uploaded_file($file_tmp,"uploads/".$file_name); // simpan filenya di folder uploads

            $object = PHPExcel_IOFactory::load($file_tmp);

            foreach ($object->getWorksheetIterator() as $worksheet) {

                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();

                for ($row = 5; $row <= $highestRow; $row++) {

                    $noac = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $sbu = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $group = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $type = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $level = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $general = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $tgl = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

                    $date = DateTime::createFromFormat('d/m/Y', $tgl);
                    $data[] = array(
                        'noac'          => $noac,
                        'nama'          => $nama,
                        'sbu'         => $sbu,
                        'group'         => $group,
                        'type'         => $type,
                        'level'         => $level,
                        'general'         => $general,
                        'TGLINPUT'         => $date->format('Y-m-d H:i:s'),
                    );
                }
            }

            $data = $this->mips_center->insert_batch('noac', $data);

            echo json_encode($data);
        } else {
            $data = false;
            echo json_encode($data);
        }
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

        $filter = $this->input->post('data');
        $list = $this->data_approve_coa->get_datatables($filter);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {;

            $norefspp = "'" . $d->noreftxt . "'";
            $pt = "'" . $d->pt . "'";
            $alias = "'" . $d->alias . "'";

            $no++;
            $row = array();
            $row[] = '<a href="javascript:;" id="spp_appproval">
            <button class="btn btn-info btn-xs" id="detail_spp_approval" name="detail_spp_approval" data-toggle="tooltip" data-placement="top" title="Approval" onClick="pilih_approved(' . $d->id . ',' . $norefspp . ',' . $pt . ',' . $alias . ')" > Approval
            </button>
        </a>';
            $row[] = $no;
            $row[] = $d->kode_dev;
            $row[] = $d->noreftxt;
            $row[] = $d->pt;
            $row[] = $d->namadept;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->data_approve_coa->count_all($filter),
            "recordsFiltered" => $this->data_approve_coa->count_filtered($filter),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_coa_approved()
    {

        $id = $this->input->post('id');
        $pt = $this->input->post('pt');
        $alias = strtolower($this->input->post('alias'));
        $this->get_coa_approved->getWhere($alias);
        $get_noref = $this->get_coa_approved->get_noref($id);
        $list = $this->get_coa_approved->get_datatables($get_noref, $pt);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            $pt = "'" . $alias . "'";

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

            $row[] = $d->kodebar;
            $row[] = $nabar;
            $row[] = $grp;
            $row[] = "<a href='javascript:void(0)' onClick=pilih_setujui(" . $d->id . "," . $d->kodebar . "," . $pt . ") title=' Approve - " .  $d->nabar . "'><i class='splashy-check'></i></a>&nbsp;
            <a href='javascript:void(0)' onClick=pilih_approved(" . $d->id . ") title=' No Approve - " .  $d->nabar . "'><i class='splashy-remove'></i></a>
            ";


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->get_coa_approved->count_all($get_noref, $pt),
            "recordsFiltered" => $this->get_coa_approved->count_filtered($get_noref, $pt),
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
        $noref = $this->input->post('noref', TRUE);
        $pt = $this->input->post('pt', TRUE);
        $alias = $this->input->post('alias', TRUE);

        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;
        $data['noref']     = $noref;
        $data['pt']     = $pt;
        $data['alias']     = $alias;

        if ($result == '1') {
            $this->load->view('gl/coa/cb_table_approve_popup_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }
    public function modal_new_coa()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $noref = $this->input->post('noref', TRUE);
        $alias = $this->input->post('alias', TRUE);


        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['noref']     = $noref;
        $data['alias']     = $alias;

        if ($result == '1') {
            $this->load->view('gl/coa/popup_coa_baru', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function get_new_coa()
    {
        $id = $this->input->post('id');
        $alias = strtolower($this->input->post('alias'));
        $this->get_new_coa->getWhere($alias);

        $list = $this->get_new_coa->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {


            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $d->kodept;
            $row[] = $d->kodebar;
            $row[] = $d->nabar;
            $row[] = $d->grup;



            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->get_new_coa->count_all($id),
            "recordsFiltered" => $this->get_new_coa->count_filtered($id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function approved_coa()
    {
        $id = $this->input->post('id', TRUE);
        // $nabar = $this->input->post('nabar', TRUE);
        $grp = $this->input->post('grp', TRUE);
        $kodebar = $this->input->post('kodebar', TRUE);
        $alias = $this->input->post('alias', TRUE);

        $this->get_coa_approved->delete_itemppo_tmp($id, $kodebar, $alias);

        /* ambil kode barang */
        $kode_barang = $this->get_coa_approved->get_kode_barang($grp);
        $kodebar = $kode_barang + 1;
        /* update kodebar di item_ppo_tmp */
        $hasil = $this->get_coa_approved->update_kodebar($id, $kodebar, $alias);
        /* end */

        /* insert coa baru */
        $kodebarang = $this->get_coa_approved->save_kode_barang($id, $kodebar, $grp, $alias);
        $noac = $this->get_coa_approved->save_coa_baru($id, $kodebar, $grp, $alias);
        /* end insert coa baru */

        /* proses pindah ppo_tmp dan item_ppo_tmp */
        $dt = $this->get_coa_approved->update_item_spp($id, $alias);
        /* end */


        echo json_encode($dt);
    }

    function update_ppo_tmp()
    {
        $id = $this->input->post('id');
        $alias = $this->input->post('alias');


        $data = $this->get_coa_approved->update_ppo_tmp($id, $alias);
        echo json_encode($data);
    }
}

/* End of file coa.php */
