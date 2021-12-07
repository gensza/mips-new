<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gl extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('gl_model');
        $this->load->model('module_model');
        $this->load->model('serv_side_gl_transaksi_model');
        $this->load->model('serv_side_gl_popup_model');
        $this->load->model('serv_side_gl_model');
        $this->load->model('serv_side_coa_by_kategori_popup_model');
        $this->load->model('serv_side_gl_account_detail_model');
        $this->load->model('serv_side_gl_transaksi_entry_model');

        $this->db_msal_personalia = $this->load->database('db_msal_personalia', TRUE);

        date_default_timezone_set('Asia/Jakarta');
    }

    public function transaksi_input()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/transaksi/gl_input_transaksi_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function report()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/report/report_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function transaksi_edit()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $id_row = $this->input->post('id_rows', TRUE);
        $id_row2 = $this->input->post('id_rows2', TRUE);
        $data['tokens']  = $tokens;
        $data['id_rows']  = $id_row;
        $data['id_rows2'] = $id_row2;
        if ($result == '1') {
            $this->load->view('gl/transaksi/gl_edit_transaksi_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function transaksi_table()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/transaksi/gl_table_transaksi_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function transaksi_table_entry()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/transaksi/gl_table_transaksi_entry_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function transaksi_simpan()
    {

        $data['kode_sementara'] = $this->input->post('kode_sementara', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['tanggal']        = $this->input->post('tanggal', TRUE);
        $data['divisi_v']       = $this->input->post('divisi_v', TRUE);
        $data['tm_tbm']         = $this->input->post('tm_tbm', TRUE);
        $data['adf_unit']       = $this->input->post('adf_unit', TRUE);
        $data['tahun_tanam']    = $this->input->post('tahun_tanam', TRUE);
        $data['acctno']         = $this->input->post('acctno', TRUE);
        $data['acctname']       = $this->input->post('acctname', TRUE);
        $data['deskripsi']      = $this->input->post('deskripsi', TRUE);
        $data['dc']             = $this->input->post('dc', TRUE);
        $data['dc_kurs']        = $this->input->post('dc_kurs', TRUE);
        $data['dc_nominal']     = $this->input->post('dc_nominal', TRUE);

        $result = $this->gl_model->gl_transaksi_simpan($data);
        echo json_encode($result);
    }

    public function transaksi_simpan_dollar()
    {

        $data['kode_sementara'] = $this->input->post('kode_sementara', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['tanggal']        = $this->input->post('tanggal', TRUE);
        $data['divisi_v']       = $this->input->post('divisi_v', TRUE);
        $data['tm_tbm']         = $this->input->post('tm_tbm', TRUE);
        $data['adf_unit']       = $this->input->post('adf_unit', TRUE);
        $data['tahun_tanam']    = $this->input->post('tahun_tanam', TRUE);
        $data['acctno']         = $this->input->post('acctno', TRUE);
        $data['acctname']       = $this->input->post('acctname', TRUE);
        $data['deskripsi']      = $this->input->post('deskripsi', TRUE);
        $data['dc']             = $this->input->post('dc', TRUE);
        $data['dc_kurs']        = $this->input->post('dc_kurs', TRUE);
        $data['dc_nominal']     = $this->input->post('dc_nominal', TRUE);

        $result = $this->gl_model->gl_transaksi_simpan_dollar($data);
        echo json_encode($result);
    }

    public function transaksi_simpan_all()
    {

        $data['kode_sementara'] = $this->input->post('kode_sementara', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['tanggal']        = $this->input->post('tanggal', TRUE);
        $data['divisi_v']       = $this->input->post('divisi_v', TRUE);
        $data['tm_tbm']         = $this->input->post('tm_tbm', TRUE);
        $data['adf_unit']       = $this->input->post('adf_unit', TRUE);
        $data['tahun_tanam']    = $this->input->post('tahun_tanam', TRUE);
        $data['acctno']         = $this->input->post('acctno', TRUE);
        $data['acctname']       = $this->input->post('acctname', TRUE);
        $data['deskripsi']      = $this->input->post('deskripsi', TRUE);
        $data['dc']             = $this->input->post('dc', TRUE);
        $data['dc_kurs']        = $this->input->post('dc_kurs', TRUE);
        $data['dc_nominal']     = $this->input->post('dc_nominal', TRUE);

        $data['totalcr']        = $this->input->post('totalcr_normal', TRUE);
        $data['totaldr']        = $this->input->post('totaldr_normal', TRUE);



        $result = $this->gl_model->transaksi_simpan_all($data);
        echo json_encode($result);
    }

    public function get_nama_acct()
    {
        $acct     = $this->input->post('acct', TRUE);
        $result = $this->gl_model->get_nama_acct($acct)->row_array();
        echo json_encode($result);
    }

    public function transaksi_data_detail()
    {
        $data['kode_sementara']     = $this->input->post('kode_sementara', TRUE);
        $result = $this->gl_model->transaksi_data_detail($data)->result_array();
        echo json_encode($result);
    }

    public function transaksi_data_detail_edit()
    {
        $data['no_ref']     = $this->input->post('no_ref', TRUE);
        $result = $this->gl_model->transaksi_data_detail_edit($data)->result_array();
        echo json_encode($result);
    }

    public function transaksi_total_credit()
    {
        $data['kode_sementara']     = $this->input->post('kode_sementara', TRUE);
        $result = $this->gl_model->transaksi_total_credit($data)->row_array();
        echo json_encode($result);
    }


    public function transaksi_total_debit()
    {
        $data['kode_sementara']     = $this->input->post('kode_sementara', TRUE);
        $result = $this->gl_model->transaksi_total_debit($data)->row_array();
        echo json_encode($result);
    }

    public function cek_kurs_rate()
    {
        $data['tglhariini']     = $this->input->post('tglhariini', TRUE);
        $result = $this->gl_model->cek_kurs_rate($data)->row_array();
        echo json_encode($result);
    }

    public function transaksi_update_kurs()
    {
        $data['kurs_nominal']     = $this->input->post('kurs_nominal', TRUE);
        // $data['tgl_kurs_todays']  = $this->input->post('tgl_kurs_todays', TRUE);
        $result = $this->gl_model->transaksi_update_kurs($data)->row_array();
        echo json_encode($result);
    }

    public function cek_noref()
    {
        $data['no_ref']     = $this->input->post('no_ref', TRUE);
        $result = $this->gl_model->cek_noref($data)->row_array();
        echo json_encode($result);
    }

    public function get_trans_gl_detail()
    {
        $data['noid']     = $this->input->post('noid', TRUE);
        $result = $this->gl_model->get_trans_gl_detail($data)->row_array();
        echo json_encode($result);
    }

    public function get_trans_gl_detail2()
    {
        $data['noid']     = $this->input->post('noid', TRUE);
        $result = $this->gl_model->get_trans_gl_detail2($data)->row_array();
        echo json_encode($result);
    }


    public function hapus_trans_gl_detail()
    {
        $data['noid']     = $this->input->post('noid', TRUE);
        $result = $this->gl_model->hapus_trans_gl_detail($data);
        echo json_encode($result);
    }

    public function hapus_trans_gl_headers()
    {
        $data['noid']     = $this->input->post('noid', TRUE);
        $data['ref']     = $this->input->post('ref', TRUE);
        $result = $this->gl_model->hapus_trans_gl_headers($data);
        echo json_encode($result);
    }

    public function hapus_trans_gl_detail2()
    {
        $data['noid']     = $this->input->post('noid', TRUE);
        $result = $this->gl_model->hapus_trans_gl_detail2($data);
        echo json_encode($result);
    }

    public function cek_balance_entry()
    {
        $result = $this->gl_model->cek_balance_entry()->row_array();
        echo json_encode($result);
    }

    public function transaksi_update()
    {

        $data['kode_sementara'] = $this->input->post('kode_sementara', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['tanggal']        = $this->input->post('tanggal', TRUE);
        $data['divisi_v']       = $this->input->post('divisi_v', TRUE);
        $data['tm_tbm']         = $this->input->post('tm_tbm', TRUE);
        $data['adf_unit']       = $this->input->post('adf_unit', TRUE);
        $data['tahun_tanam']    = $this->input->post('tahun_tanam', TRUE);
        $data['acctno']         = $this->input->post('acctno', TRUE);
        $data['acctname']       = $this->input->post('acctname', TRUE);
        $data['deskripsi']      = $this->input->post('deskripsi', TRUE);
        $data['dc']             = $this->input->post('dc', TRUE);
        $data['dc_kurs']        = $this->input->post('dc_kurs', TRUE);
        $data['dc_nominal']     = $this->input->post('dc_nominal', TRUE);
        $data['id_entry']       = $this->input->post('id_entrytemp', TRUE);

        $result = $this->gl_model->gl_transaksi_update($data);
        echo json_encode($result);
    }

    public function transaksi_update2()
    {

        $data['kode_sementara'] = $this->input->post('kode_sementara', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['tanggal']        = $this->input->post('tanggal', TRUE);
        $data['divisi_v']       = $this->input->post('divisi_v', TRUE);
        $data['tm_tbm']         = $this->input->post('tm_tbm', TRUE);
        $data['adf_unit']       = $this->input->post('adf_unit', TRUE);
        $data['tahun_tanam']    = $this->input->post('tahun_tanam', TRUE);
        $data['acctno']         = $this->input->post('acctno', TRUE);
        $data['acctname']       = $this->input->post('acctname', TRUE);
        $data['deskripsi']      = $this->input->post('deskripsi', TRUE);
        $data['dc']             = $this->input->post('dc', TRUE);
        $data['dc_kurs']        = $this->input->post('dc_kurs', TRUE);
        $data['dc_nominal']     = $this->input->post('dc_nominal', TRUE);
        $data['id_entry']       = $this->input->post('id_entrytemp', TRUE);

        $result = $this->gl_model->gl_transaksi_update2($data);
        echo json_encode($result);
    }

    public function transaksi_update_dollar()
    {

        $data['kode_sementara'] = $this->input->post('kode_sementara', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['tanggal']        = $this->input->post('tanggal', TRUE);
        $data['divisi_v']       = $this->input->post('divisi_v', TRUE);
        $data['tm_tbm']         = $this->input->post('tm_tbm', TRUE);
        $data['adf_unit']       = $this->input->post('adf_unit', TRUE);
        $data['tahun_tanam']    = $this->input->post('tahun_tanam', TRUE);
        $data['acctno']         = $this->input->post('acctno', TRUE);
        $data['acctname']       = $this->input->post('acctname', TRUE);
        $data['deskripsi']      = $this->input->post('deskripsi', TRUE);
        $data['dc']             = $this->input->post('dc', TRUE);
        $data['dc_kurs']        = $this->input->post('dc_kurs', TRUE);
        $data['dc_nominal']     = $this->input->post('dc_nominal', TRUE);
        $data['id_entry']       = $this->input->post('id_entrytemp', TRUE);

        $result = $this->gl_model->gl_transaksi_update_dollar($data);
        echo json_encode($result);
    }


    public function transaksi_update_dollar2()
    {

        $data['kode_sementara'] = $this->input->post('kode_sementara', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['tanggal']        = $this->input->post('tanggal', TRUE);
        $data['divisi_v']       = $this->input->post('divisi_v', TRUE);
        $data['tm_tbm']         = $this->input->post('tm_tbm', TRUE);
        $data['adf_unit']       = $this->input->post('adf_unit', TRUE);
        $data['tahun_tanam']    = $this->input->post('tahun_tanam', TRUE);
        $data['acctno']         = $this->input->post('acctno', TRUE);
        $data['acctname']       = $this->input->post('acctname', TRUE);
        $data['deskripsi']      = $this->input->post('deskripsi', TRUE);
        $data['dc']             = $this->input->post('dc', TRUE);
        $data['dc_kurs']        = $this->input->post('dc_kurs', TRUE);
        $data['dc_nominal']     = $this->input->post('dc_nominal', TRUE);
        $data['id_entry']       = $this->input->post('id_entrytemp', TRUE);

        $result = $this->gl_model->gl_transaksi_update_dollar2($data);
        echo json_encode($result);
    }


    public function get_data_transaksi_gl()
    {

        $tokensapp = $this->session->userdata('sess_token');

        $list = $this->serv_side_gl_transaksi_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {

            $amount_d = "Rp " . number_format($customers->totaldr, 2, ',', '.');
            $amount_c = "Rp " . number_format($customers->totalcr, 2, ',', '.');

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->ref;
            $row[] = $customers->date;
            $row[] = $customers->periodetxt;
            $row[] = "<div style='text-align:right'>" . $amount_d . "</div>";
            //$row[] = $amount_c;
            $row[] = $customers->lokasi;
            $row[] = "<a href='javascript:void(0)' onclick=edit_trans_gl('" . $customers->NOID . "','" . $customers->ref . "') title=' Edit - " . $customers->ref . "'><i class='splashy-document_letter_edit'></i></a>   <a href='javascript:void(0)' onclick=hapus_trans_gl('" . $customers->NOID . "','" . $customers->ref . "') title=' Hapus - " . $customers->ref . "'><i class='splashy-document_a4_remove'></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->serv_side_gl_transaksi_model->count_all(),
            "recordsFiltered" => $this->serv_side_gl_transaksi_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function get_data_transaksi_gl_entry()
    {

        $tokensapp = $this->session->userdata('sess_token');

        $list = $this->serv_side_gl_transaksi_entry_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {

            $amount_d = "Rp " . number_format($customers->dr, 2, ',', '.');
            $amount_c = "Rp " . number_format($customers->cr, 2, ',', '.');

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->ref;
            $row[] = $customers->date;
            $row[] = $customers->periodetxt;
            $row[] = $amount_d;
            $row[] = $amount_c;
            $row[] = $customers->lokasi;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->serv_side_gl_transaksi_entry_model->count_all(),
            "recordsFiltered" => $this->serv_side_gl_transaksi_entry_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    /* START : MASTER HEAD */

    public function gl_mastercode()
    {

        //onclick=\"getpopup('module/edit_sub','"+tokens+"','popupedit','"+result[i].id+"');\"
        $tokensapp = $this->session->userdata('sess_token');

        $list = $this->serv_side_gl_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->noac;
            $row[] = $customers->nama;
            $row[] = $customers->sbu;
            $row[] = $customers->group;
            $row[] = $customers->type;
            $row[] = "<a href='javascript:void(0)' onclick=getcontents('gl/master_edit','" . $tokensapp . "','" . $customers->NOID . "')><i class='splashy-document_letter_edit' title='Edit COA'></i></a>";
            $data[] = $row;
            //<a href='javascript:void(0)' onclick=getpopup('gl/master_input_saldo','".$tokensapp."','popupedit','".$customers->NOID."') title='Input Saldo - ".$customers->nama."'><i class='splashy-application_windows_edit'></i></a>
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->serv_side_gl_model->count_all(),
            "recordsFiltered" => $this->serv_side_gl_model->count_filtered(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }


    public function gl_mastercode_popup()
    {

        //onclick=\"getpopup('module/edit_sub','"+tokens+"','popupedit','"+result[i].id+"');\"
        $tokensapp = $this->session->userdata('sess_token');

        $list = $this->serv_side_gl_popup_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {

            $name = str_replace(' ', '_', $customers->nama);

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->noac;
            $row[] = $customers->nama;
            $row[] = $customers->sbu;
            $row[] = $customers->group;
            $row[] = $customers->type;

            if ($customers->type == 'D') {
                $row[] = "<button class='btn btn-success btn-sm' onclick=selected_account(" . $customers->noac . "," . $customers->NOID . ") title=' Pilih- " . $customers->noac . " - " . $customers->nama . "'>Pilih</button>";
            } else {
                $row[] = "<button class='btn btn-danger btn-sm'>x</button>";
            }


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->serv_side_gl_popup_model->count_all(),
            "recordsFiltered" => $this->serv_side_gl_popup_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function master_input()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/coa/coa_input_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function master_edit()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $id_rows = $this->input->post('id_rows', TRUE);
        $data['tokens'] = $tokens;
        $data['noid_coa'] = $id_rows;
        if ($result == '1') {
            $this->load->view('gl/coa/coa_edit_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function master_tabel()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/coa/coa_tabel_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function master_tabel_coa_popup()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;

        if ($result == '1') {
            $this->load->view('gl/coa/coa_tabel_popup_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function master_coa_detail()
    {

        $id_coa = $this->input->post('id_coa', TRUE);
        $result = $this->gl_model->master_coa_detail($id_coa)->row_array();
        echo json_encode($result);
    }

    public function master_detail_account()
    {
        $acct_no = $this->input->post('acct_no', TRUE);
        $acct_id = $this->input->post('acct_id', TRUE);
        $result = $this->gl_model->master_detail_account($acct_no, $acct_id)->row_array();
        echo json_encode($result);
    }


    public function master_select_data_grup()
    {
        $result = $this->gl_model->master_select_data_grup()->result_array();
        echo json_encode($result);
    }

    public function master_select_data_level()
    {
        $result = $this->gl_model->master_select_data_level()->result_array();
        echo json_encode($result);
    }

    public function master_select_data_divisi()
    {
        $result = $this->gl_model->master_select_data_divisi()->result_array();
        echo json_encode($result);
    }

    public function master_select_data_satuan()
    {
        $result = $this->gl_model->master_select_data_satuan()->result_array();
        echo json_encode($result);
    }

    public function master_simpan()
    {

        $data['noacc']        = $this->input->post('noacc', TRUE);
        $data['nama']         = $this->input->post('nama', TRUE);
        $data['grup']         = $this->input->post('grup', TRUE);
        $data['g_d']          = $this->input->post('g_d', TRUE);
        $data['level']        = $this->input->post('level', TRUE);
        $data['acc_general']  = $this->input->post('acc_general', TRUE);
        $data['acc_balance']  = $this->input->post('acc_balance', TRUE);
        $data['d_c']          = $this->input->post('d_c', TRUE);
        //$data['divisi']       = $this->input->post('divisi',TRUE);
        //$data['satuan']       = $this->input->post('satuan',TRUE);

        $result = $this->gl_model->master_simpan($data);
        echo json_encode($result);
    }


    public function master_update()
    {

        $data['noacc']        = $this->input->post('noacc', TRUE);
        $data['nama']         = $this->input->post('nama', TRUE);
        $data['grup']         = $this->input->post('grup', TRUE);
        $data['g_d']          = $this->input->post('g_d', TRUE);
        $data['level']        = $this->input->post('level', TRUE);
        $data['acc_general']  = $this->input->post('acc_general', TRUE);
        $data['acc_balance']  = $this->input->post('acc_balance', TRUE);
        $data['d_c']          = $this->input->post('d_c', TRUE);
        $data['noid_acc']     = $this->input->post('noid_acc', TRUE);
        //$data['satuan']       = $this->input->post('satuan',TRUE);

        $result = $this->gl_model->master_update($data);
        echo json_encode($result);
    }


    public function master_input_saldo()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;

        if ($result == '1') {
            $this->load->view('gl/coa/coa_input_saldo_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function master_update_saldo()
    {

        $data['idnoac']       = $this->input->post('idnoac', TRUE);
        $data['saldoawal_acc']       = $this->input->post('saldoawal_acc', TRUE);

        $result = $this->gl_model->master_update_saldo($data);
        echo json_encode($result);
    }


    public function master_get_data_detail_coa()
    {

        $noid_coa       = $this->input->post('noid_coa', TRUE);

        $result = $this->gl_model->master_get_data_detail_coa($noid_coa)->row_array();
        echo json_encode($result);
    }

    /* END : MASTER HEAD */


    public function master_tabel_coa_popup_by_kategori()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        $id_row2 = $this->input->post('id_row2', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;
        $data['id_row2']    = $id_row2;

        if ($result == '1') {
            $this->load->view('gl/coa/coa_tabel_popup_by_kategori_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function gl_mastercode_by_kategori_popup()
    {

        //onclick=\"getpopup('module/edit_sub','"+tokens+"','popupedit','"+result[i].id+"');\"

        $tokensapp   = $this->session->userdata('sess_token');
        $code_filter = $this->input->post('code_filter', TRUE);
        $kategori    = $this->input->post('kategori', TRUE);

        $list = $this->serv_side_coa_by_kategori_popup_model->get_datatables($code_filter, $kategori);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {

            $name = str_replace(' ', '_', $customers->nama);

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->noac;
            $row[] = $customers->nama;
            $row[] = $customers->sbu;
            $row[] = $customers->group;
            $row[] = $customers->type;
            $row[] = "<button class='btn btn-success btn-sm' onclick=selected_account(" . $customers->noac . "," . $customers->NOID . ") title=' Pilih- " . $customers->noac . " - " . $customers->nama . "'>Pilih</button>";

            // tadi nya dibawah ini dikasih kondisi, tapi karna sy ga tau kondisi nya jadi saya buka dulu
            // if ($customers->type == 'D') {
            //     $row[] = "<button class='btn btn-success btn-sm' onclick=selected_account(" . $customers->noac . "," . $customers->NOID . ") title=' Pilih- " . $customers->noac . " - " . $customers->nama . "'>Pilih</button>";
            // } else {
            //     $row[] = "<button class='btn btn-danger btn-sm'>x</button>";
            // }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->serv_side_coa_by_kategori_popup_model->count_all($code_filter, $kategori),
            "recordsFiltered" => $this->serv_side_coa_by_kategori_popup_model->count_filtered($code_filter, $kategori),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    function get_afd_unit()
    {
        $kategori = $this->input->post('kategori', TRUE);

        $result = $this->gl_model->get_afd_unit($kategori);
        echo json_encode($result);
    }

    function get_tahuntanam()
    {
        $kategori = $this->input->post('kategori', TRUE);
        $afd_unit = $this->input->post('afd_unit', TRUE);

        $result = $this->gl_model->get_tahuntanam($kategori, $afd_unit);
        echo json_encode($result);
    }

    function transaksi_header_detail()
    {

        $noid   = $this->input->post('noid', TRUE);
        $ref    = $this->input->post('ref', TRUE);

        $result = $this->gl_model->transaksi_header_detail($noid, $ref)->row_array();
        echo json_encode($result);
    }

    public function transaksi_total_credit_edit()
    {
        $data['ref']     = $this->input->post('ref', TRUE);
        $result = $this->gl_model->transaksi_total_credit_edit($data)->row_array();
        echo json_encode($result);
    }


    public function transaksi_total_debit_edit()
    {
        $data['ref']     = $this->input->post('ref', TRUE);
        $result = $this->gl_model->transaksi_total_debit_edit($data)->row_array();
        echo json_encode($result);
    }



    /* Report Journal*/

    public function report_jurnal()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/report/jurnal_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function report_jurnal_view()
    {

        $tgl_start          = $this->input->post('tgl_start', TRUE);
        $tgl_end            = $this->input->post('tgl_end', TRUE);
        $periode_terkini    = $this->input->post('periode_terkini', TRUE);
        $divisi_start       = $this->input->post('divisi_start', TRUE);
        $divisi_end         = $this->input->post('divisi_end', TRUE);
        $noacc_start        = $this->input->post('noacc_start', TRUE);
        $noacc_end          = $this->input->post('noacc_end', TRUE);



        $res_data       = $this->gl_model->get_data_entry($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $res_data_head  = $this->gl_model->get_data_entry_head($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $html;

        $nos = 0 + 1;
        $grand_tot_db;
        $grand_tot_cr;
        foreach ($res_data_head as $v) {

            foreach ($res_data as $a) {

                if ($a['ref'] == $v['ref']) {


                    $b = str_replace(',', '', $a['DEBET_F']);
                    $c = str_replace(',', '', $a['DEBET_F2']);

                    $oke = number_format($c, 2, ".", ",");

                    $html .= '<tr>
              <td align="center">' . $a['TGL'] . '</td>
              <td align="center">' . $a['ref'] . '</td>
              <td align="center">' . $a['sbu'] . '</td>
              <td align="left">' . $a['noac'] . '</td>
              <td align="left" style="width:50px">' . $a['descac'] . '</td>
              <td align="left" style="width:50px">' . $a['ket'] . '</td>
              <td align="right" width="150px"><div style="float:right">' . $a['DEBET_F'] . '</div></td>
              <td align="right" width="150px"><div style="float:right">' . $a['CREDIT_F'] . '</div></td>
              </tr>';
                }
                $nos++;
            }

            $total_debit = $v['DBT'];
            $total_kredit = $v['KRD'];


            $total_kredit_nf = $v['KRD_NF'];
            $total_debit_nf = $v['DBT_NF'];

            $bg_color;
            if ($total_kredit_nf != $total_debit_nf) {
                $bg_color = 'red';
            } else {
                $bg_color = '#efc43f';
            }

            /*<td align="left" style="background-color:'.$bg_color.'"></td>*/

            $html .= '<tr>  
          <td width="100px" colspan="6" style="text-align: right;background:#f7f2a0;color:black;font-weight: bold;">TOTAL</td>
          <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold"><div style="float:right">' . $total_debit . '</div></td>
          <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold"><div style="float:right"><div style="float:right">' . $total_kredit . '</div></td>
          </tr>';
        }

        $html .= '<tr>  
          <td width="100px" colspan="6" style="text-align: right;background:#f7f2a0;color:black;font-weight: bold;">GRAND TOTAL</td>
          <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold"><div style="float:right">' . $grand_tot_db . '</div></td>
          <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold"><div style="float:right"><div style="float:right">' . $grand_tot_cr . '</div></td>
          </tr>';

        echo $html;
    }

    /* End Report Journal */


    /* Start Report Module */

    public function report_module()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/report/module_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function report_module_view()
    {

        $tgl_start          = $this->input->post('tgl_start', TRUE);
        $tgl_end            = $this->input->post('tgl_end', TRUE);
        $periode_terkini    = $this->input->post('periode_terkini', TRUE);
        $divisi_start       = $this->input->post('divisi_start', TRUE);
        $divisi_end         = $this->input->post('divisi_end', TRUE);
        $module             = $this->input->post('module', TRUE);

        $res_data       = $this->gl_model->get_data_entry_rpt_module($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
        $res_data_head  = $this->gl_model->get_data_entry_head_rpt_module($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
        $html;

        $nos = 0 + 1;
        foreach ($res_data_head as $v) {

            foreach ($res_data as $a) {

                if ($a['ref'] == $v['ref']) {


                    $b = str_replace(',', '', $a['DEBET_F']);
                    $c = str_replace(',', '', $a['DEBET_F2']);

                    $oke = number_format($c, 2, ".", ",");

                    $html .= '<tr>
              <td align="center">' . $a['TGL'] . '</td>
              <td align="center">' . $a['ref'] . '</td>
              <td align="center">' . $a['sbu'] . '</td>
              <td align="left">' . $a['noac'] . '</td>
              <td align="left" style="width:50px">' . $a['desc'] . '</td>
              <td align="left">' . $a['ket'] . '</td>
              <td align="right" width="150px"><div style="float:right">' . $a['DEBET_F'] . '</div></td>
              <td align="right" width="150px"><div style="float:right">' . $a['CREDIT_F'] . '</div></td>
              </tr>';
                }
                $nos++;
            }

            $total_debit = $v['DBT'];
            $total_kredit = $v['KRD'];


            $total_kredit_nf = $v['KRD_NF'];
            $total_debit_nf = $v['DBT_NF'];

            $bg_color;
            if ($total_kredit_nf != $total_debit_nf) {
                $bg_color = 'red';
            } else {
                $bg_color = '#efc43f';
            }

            /*<td align="left" style="background-color:'.$bg_color.'"></td>*/

            $html .= '<tr>  
          <td width="100px" colspan="6" style="text-align: right;background:#f7f2a0;color:black;font-weight: bold;">TOTAL</td>
          <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold"><div style="float:right">' . $total_debit . '</div></td>
          <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold"><div style="float:right"><div style="float:right">' . $total_kredit . '</div></td>
          </tr>';
        }

        echo $html;
    }

    /* End Report Module */


    /* Report Account Detail*/

    public function account_detail()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/report/account_detail_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function account_detail_master()
    {

        //onclick=\"getpopup('module/edit_sub','"+tokens+"','popupedit','"+result[i].id+"');\"

        $tokensapp = $this->session->userdata('sess_token');

        $list = $this->serv_side_gl_account_detail_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {

            $no++;
            $row = array();
            $row[] = $customers->noac;
            $row[] = $customers->general;
            $row[] = "<div style='text-align:center'>" . $customers->level . "</div>";
            $row[] = "<div style='text-align:center'>" . $customers->type . "</div>";
            $row[] = $customers->nama;
            $row[] = $customers->group;
            $data[] = $row;
            //<a href='javascript:void(0)' onclick=getpopup('gl/master_input_saldo','".$tokensapp."','popupedit','".$customers->NOID."') title='Input Saldo - ".$customers->nama."'><i class='splashy-application_windows_edit'></i></a>
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->serv_side_gl_account_detail_model->count_all(),
            "recordsFiltered" => $this->serv_side_gl_account_detail_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function report_buku_besar()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/report/buku_besar_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function report_buku_besar_view()
    {

        $tgl_start          = $this->input->post('tgl_start', TRUE);
        $tgl_end            = $this->input->post('tgl_end', TRUE);
        $periode_terkini    = $this->input->post('periode_terkini', TRUE);
        $divisi_start       = $this->input->post('divisi_start', TRUE);
        $divisi_end         = $this->input->post('divisi_end', TRUE);
        $noacc_start        = $this->input->post('noacc_start', TRUE);
        $noacc_end          = $this->input->post('noacc_end', TRUE);

        $period = $this->session->userdata('sess_periode');
        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 6);

        $res_data_acct  = $this->gl_model->get_data_acct_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $res_data       = $this->gl_model->get_data_entry_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();

        $html;

        $nos = 0 + 1;
        foreach ($res_data_acct as $v) {

            if ($bulan == '01') {
                $begincr = $v['yearc'];
            } else if ($bulan == '02') {
                $begincr = $v['yearc'] + $v['saldo01c'];
            } else if ($bulan == '03') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'];
            } else if ($bulan == '04') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'];
            } else if ($bulan == '05') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'];
            } else if ($bulan == '06') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'];
            } else if ($bulan == '07') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'];
            } else if ($bulan == '08') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'] + $v['saldo07c'];
            } else if ($bulan == '09') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'] + $v['saldo07c'] + $v['saldo08c'];
            } else if ($bulan == '10') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'] + $v['saldo07c'] + $v['saldo08c'] + $v['saldo09c'];
            } else if ($bulan == '11') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'] + $v['saldo07c'] + $v['saldo08c'] + $v['saldo09c'] + $v['saldo10c'];
            } else if ($bulan == '12') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'] + $v['saldo07c'] + $v['saldo08c'] + $v['saldo09c'] + $v['saldo10c'] + $v['saldo11c'];
            }


            //begindr
            if ($bulan == '01') {
                $begindr = $v['yeard'];
            } else if ($bulan == '02') {
                $begindr = $v['yeard'] + $v['saldo01d'];
            } else if ($bulan == '03') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'];
            } else if ($bulan == '04') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'];
            } else if ($bulan == '05') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'];
            } else if ($bulan == '06') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'];
            } else if ($bulan == '07') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'];
            } else if ($bulan == '08') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'] + $v['saldo07d'];
            } else if ($bulan == '09') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'] + $v['saldo07d'] + $v['saldo08d'];
            } else if ($bulan == '10') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'] + $v['saldo07d'] + $v['saldo08d'] + $v['saldo09d'];
            } else if ($bulan == '11') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'] + $v['saldo07d'] + $v['saldo08d'] + $v['saldo09d'] + $v['saldo10d'];
            } else if ($bulan == '12') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'] + $v['saldo07d'] + $v['saldo08d'] + $v['saldo09d'] + $v['saldo10d'] + $v['saldo11d'];
            }


            //begining balance di dapat dari, akumulasi dari saldo dikurang dari periode saat ini (dikurang 1 bulan) + (yearc atau yeard)
            if (($begindr - $begincr) > 0) {
                $saldoawald = $begindr - $begincr;
            } else {
                $saldoawald = 0;
            }

            //$begining_balance_c
            if (($begindr - $begincr) < 0) {
                $saldoawalc = $begindr - $begincr;
            } else {
                $saldoawalc = 0;
            }



            $html .= '<thead>
                                            <tr style="border-bottom:1pt solid black;border-top:1pt solid black;">
                                              <th>' . $v['noac'] . '</th>
                                              <th colspan="7" style="text-align:left;padding-left:20px">' . $v['descac'] . '</th>
                                          </tr>
                                          <tr style="border-bottom:1pt solid black;">
                                              <th>Ref</th>
                                              <th>Date</th>
                                              <th align="left" width="20px" style="width:20px"><div style="padding-left:20px">Description<div></th>
                                              <th>Debit</th>
                                              <th>Credit</th>
                                          </tr>
                                          <tr>
                                              <th colspan="2"></th>
                                              <th align="left"><div style="padding-left:20px">Begining Balance<div></th>
                                              <th align="right">' . number_format($saldoawald, 0) . '</th>
                                              <th align="right">' . number_format($saldoawalc, 0) . '</th>
                                          </tr>
                                      </thead>';

            foreach ($res_data as $a) {

                if ($a['noac'] == $v['noac']) {


                    $b = str_replace(',', '', $a['DEBET_F']);
                    $c = str_replace(',', '', $a['DEBET_F2']);
                    $crdt = $a['CREDIT_F2'];

                    if ($crdt > 0) {
                        $oke = $a['CREDIT_F2'] * -1;
                        $credits = str_replace("-", "", "" . $oke . "");
                        //$hasilcr = '('.number_format($a['CREDIT_F2'], 0, ".", ",").')';
                        $hasilcr = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($oke, 0));
                        //$hasilcr = $credits;
                    } else {
                        //$hasilcr = 'else';
                        $hasilcr =  number_format($a['CREDIT_F2'], 0, ".", ",");
                    }


                    $html .= '<tr style="border-bottom:1pt solid black;">
                <td align="center" width="10%">' . $a['ref'] . '</td>
                <td align="center" width="10%">' . $a['TGL'] . '</td>
                <td align="left" width="10%"><div style="padding-left:20px;">' . $a['ket'] . '</div></td>
                <td align="right" width="10%"><div style="float:right;border-right:0pt solid black;">' . number_format($a['DEBET_F2'], 0, ".", ",") . '</div></td>
                <td align="right" width="10%"><div style="float:right">' . $hasilcr . '</div></td>
                </tr>';
                }
                $nos++;
            }

            $current_b_kredit = $v['KRD_NF'];
            $current_b_debit  = $v['DBT_NF'];

            //START : MENGHITUNG TOTAL DR
            if ($saldoawald <> '0') {
                $ttldr =  $saldoawald + $current_b_debit;
            } else {
                $ttldr = $current_b_debit;
            }
            //START : MENGHITUNG TOTAL DR


            //START : MENGHITUNG TOTAL CR
            if ($v['KRD_NF'] > '0') {
                $cr = $v['KRD_NF'] * -1;
            } else {
                $cr  = $v['KRD_NF'];
            }

            if ($saldoawalc <> 0) {
                $ttlcr =  $saldoawalc + $cr;
            } else {
                $ttlcr = $cr;
            }
            //END : MENGHITUNG TOTAL CR


            //START : MENGHITUNG CURRENT BALANCE DEBIT
            if ($v['group'] == 'Asset' || $v['group'] == 'Expenses' || $v['group'] == 'Other Expenses') {
                if (($ttldr + $ttlcr) > '0') {
                    $curbal = $ttldr - $ttlcr; //diubah25092019
                } else {
                    $curbal = 0;
                }
            } else {
                if (($ttlcr + $ttldr) > '0') {
                    $curbal = 0;
                } else {
                    $curbal = $ttlcr - $ttldr; //diubah25092019 
                }
            }
            //END  : MENGHITUNG CURRENT BALANCE DEBIT


            //START : MENGHITUNG CURRENT BALANCE CREDIT
            if ($v['group'] == 'Asset' || $v['group'] == 'Expenses' || $v['group'] == 'Other Expenses') {
                if (($ttldr + $ttlcr) > '0') {
                    $curbalcr = 0;
                } else {
                    $curbalcr = $ttldr - $ttlcr;  //diubah25092019
                }
            } else {
                if (($ttlcr + $ttldr) > '0') {
                    $curbalcr = $ttlcr - $ttldr; //diubah25092019
                } else {
                    $curbalcr = 0;
                }
            }
            //END  : MENGHITUNG CURRENT BALANCE CREDIT


            if ($ttlcr == '0') {
                $ttlcr_v =  0;
            } else {
                $ttlcrs = $ttlcr * -1;
                $ttlcr_v = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlcrs, 0));
                //$ttlcr_v = '('.number_format($ttlcr, 0, ".", ",").')';
            }

            if ($curbalcr == '0') {
                $curbalcr_v =  0;
            } else {
                $okex = $curbalcr * -1;
                $curbalcr_v = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($okex, 0));
                //$curbalcr_v = '('.number_format($curbalcr, 0, ".", ",").')';
            }



            //        $tot_ttlcr;
            //        $tot_ttldr;
            //        if($tot_ttlcr > $tot_ttldr){
            //            $tot_ttlcr = $tot_ttlcr - $tot_ttldr;
            //            $tot_ttldr  = 0;
            //        }else{
            //            $tot_ttldr = $tot_ttldr - $tot_ttldr;
            //            $tot_ttldr  = 0;
            //        }

            $html .= '<tr>  
        <td width="100px" colspan="3" style="text-align: right;color:black;font-weight: bold;">TOTAL</td>
        <td align="right" width="150px" style="background:;color: black;border-right:0pt solid black;"><div style="float:right">' . number_format($ttldr, 0, ".", ",") . '</div></td>
        <td align="right" width="150px" style="background:;color: black"><div style="float:right">' . $ttlcr_v . '</div></td>
        </tr>
        <tr>  
        <td width="100px" colspan="3" style="text-align: right;color:black;font-weight: bold;">Current Balance</td>
        <td align="right" width="150px" style="background:;color: black;;font-weight: bold;border-right:0pt solid black;"><div style="float:right">' . number_format($curbal, 0, ".", ",") . '</div></td>
        <td align="right" width="150px" style="background:;color: black;font-weight: bold"><div style="float:right">' . $curbalcr_v . '</div></td>
        </tr>';
        }

        echo $html;
    }

    public function posting_harian()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/posting/posting_harian_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function posting_harian_act()
    {

        ini_set('memory_limit', '200M');
        ini_set('upload_max_filesize', '200M');
        ini_set('post_max_size', '200M');
        ini_set('max_input_time', 3600);
        ini_set('max_execution_time', 0);

        ini_set("memory_limit", "512M");

        $result = $this->gl_model->posting_harian();
        $this->gl_model->posting_harian_general();
        echo json_encode($result);
    }

    public function report_trialbalance()
    {

        $data['periode'] = $this->session->userdata('sess_periode');

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/report/trialbalance_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function report_balance()
    {

        $data['periode'] = $this->session->userdata('sess_periode');

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/report/balance_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function income_statement()
    {

        $data['periode'] = $this->session->userdata('sess_periode');

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/report/income_statement_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }



    public function report_trail_balance_view()
    {

        $periode     = $this->input->post('periode', TRUE);
        $bygroup     = $this->input->post('bygroup', TRUE);
        $kategori    = $this->input->post('kategori', TRUE);

        $res_data_acct  = $this->gl_model->get_data_acct_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $res_data       = $this->gl_model->get_data_entry_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();


        $html;
        $nos = 0 + 1;
        foreach ($res_data_acct as $v) {

            $html .= '<thead>
                                            <tr style="border-bottom:1pt solid black;border-top:1pt solid black;">
                                              <th>' . $v['noac'] . '</th>
                                              <th colspan="7" style="text-align:left;padding-left:20px">' . $v['descac'] . '</th>
                                          </tr>
                                          <tr style="border-bottom:1pt solid black;">
                                              <th>Ref</th>
                                              <th>Date</th>
                                              <th align="left"><div style="padding-left:20px">Description<div></th>
                                              <th>Debit</th>
                                              <th>Credit</th>
                                          </tr>
                                          <tr>
                                              <th colspan="2"></th>
                                              <th align="left"><div style="padding-left:20px">Begining Balance<div></th>
                                              <th align="right">0</th>
                                              <th align="right">0</th>
                                          </tr>
                                      </thead>';

            foreach ($res_data as $a) {

                if ($a['noac'] == $v['noac']) {


                    $b = str_replace(',', '', $a['DEBET_F']);
                    $c = str_replace(',', '', $a['DEBET_F2']);

                    $oke = number_format($c, 2, ".", ",");

                    $html .= '<tr style="border-bottom:1pt solid black;">
              <td align="center" width="10%">' . $a['ref'] . '</td>
              <td align="center" width="10%">' . $a['TGL'] . '</td>
              <td align="left" width="70%"><div style="padding-left:20px">' . $a['ket'] . '</div></td>
              <td align="right" width="10%"><div style="float:right;border-right:1pt solid black;">' . $a['DEBET_F'] . '</div></td>
              <td align="right" width="10%"><div style="float:right">(' . $a['CREDIT_F'] . ')</div></td>
              </tr>';
                }
                $nos++;
            }

            $total_debit  = $v['DBT'];
            $total_kredit = $v['KRD'];

            $total_kredit_nf = $v['KRD_NF'];
            $total_debit_nf  = $v['DBT_NF'];

            $bg_color;
            if ($total_kredit_nf != $total_debit_nf) {
                $bg_color = 'white';
            } else {
                $bg_color = 'white';
            }

            $current_b_kredit = $v['KRD_NF'];
            $current_b_debit  = $v['DBT_NF'];

            $tot_current_b_kredit;
            $tot_current_b_debit;
            if ($current_b_kredit > $current_b_debit) {
                $tot_current_b_kredit = $current_b_kredit - $current_b_debit;
                $tot_current_b_debit  = 0;
            } else {
                $tot_current_b_debit = $current_b_debit - $current_b_kredit;
                $tot_current_b_kredit  = 0;
            }


            $html .= '<tr>  
        <td width="100px" colspan="3" style="text-align: right;color:black;font-weight: bold;">TOTAL</td>
        <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold;border-right:1pt solid black;"><div style="float:right">' . $total_debit . '</div></td>
        <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold"><div style="float:right"><div style="float:right">(' . $total_kredit . ')</div></td>
        </tr>
        <tr>  
        <td width="100px" colspan="3" style="text-align: right;color:black;font-weight: bold;">Current Balance</td>
        <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold;border-right:1pt solid black;"><div style="float:right">' . number_format($tot_current_b_debit, 2, ".", ",") . '</div></td>
        <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold"><div style="float:right"><div style="float:right">(' . number_format($tot_current_b_kredit, 2, ".", ",") . ')</div></td>
        </tr>';
        }

        echo $html;
    }



    public function alokasi_jurnal()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/transaksi/gl_alokasi_jurnal_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function alokasi_jurnal_tambah()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('gl/transaksi/gl_alokasi_jurnal_input_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function jurnal_popup_view($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)
    {

        ini_set('memory_limit', '200M');
        ini_set('upload_max_filesize', '200M');
        ini_set('post_max_size', '200M');
        ini_set('max_input_time', 3600);
        ini_set('max_execution_time', 0);

        ini_set("memory_limit", "512M");

        $period = $this->session->userdata('sess_periode');
        $data['tahun']  = substr($period, 0, 4);
        $data['bulan']  = substr($period, 4, 6);

        $data['data_entry']       = $this->gl_model->get_data_entry($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $data['data_entry_head']  = $this->gl_model->get_data_entry_head($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $data['data_entry_sum']       = $this->gl_model->get_data_entry_sum($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->row_array();


        $this->load->view('cetak/gl/gl_laporan_jurnal_popup_view', $data);
    }



    // alokasi jurnal

    public function alokasi_jurnal_simpan()
    {

        $data['kode_sementara'] = $this->input->post('kode_sementara', TRUE);
        $data['tanggal']        = $this->input->post('tanggal', TRUE);
        $data['keterangan']     = $this->input->post('keterangan', TRUE);
        $data['acctno']         = $this->input->post('acctno', TRUE);
        $data['acctname']       = $this->input->post('acctname', TRUE);
        $data['deskripsi']      = $this->input->post('deskripsi', TRUE);
        $data['dc']             = $this->input->post('dc', TRUE);
        $data['dc_nominal']     = $this->input->post('dc_nominal', TRUE);

        $result = $this->gl_model->alokasi_jurnal_simpan($data);
        echo json_encode($result);
    }

    public function alokasi_jurnal_data_detail()
    {
        $data['kode_sementara']     = $this->input->post('kode_sementara', TRUE);
        $result = $this->gl_model->alokasi_jurnal_data_detail($data)->result_array();
        echo json_encode($result);
    }

    public function alokasi_jurnal_transaksi_total_credit()
    {
        $data['kode_sementara']     = $this->input->post('kode_sementara', TRUE);
        $result = $this->gl_model->alokasi_jurnal_transaksi_total_credit($data)->row_array();
        echo json_encode($result);
    }


    public function alokasi_jurnal_transaksi_total_debit()
    {
        $data['kode_sementara']     = $this->input->post('kode_sementara', TRUE);
        $result = $this->gl_model->alokasi_jurnal_transaksi_total_debit($data)->row_array();
        echo json_encode($result);
    }
}
