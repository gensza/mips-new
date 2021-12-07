<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cash_bank extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('cash_bank_model');
        $this->load->model('module_model');
        $this->load->model('serv_side_cb_voucher_model');
        $this->load->model('serv_side_po_logistik_model');
    }

    public function input_voucher()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        $data['lokasi'] = $this->main_model->get_lokasi()->row_array();
        if ($result == '1') {
            $this->load->view('cash_bank/cb_input_voucher_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function hapus_vouc_tmp_detail()
    {

        $data['id_vouc_tmp'] = $this->input->post('id_vouc_tmp', TRUE);
        $data['voucno'] = $this->input->post('voucno', TRUE);
        $result = $this->cash_bank_model->hapus_vouc_tmp_detail($data);
        echo json_encode($result);
    }


    public function saldo_awal()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('cash_bank/cb_saldo_awal_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function saldo_akhir()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('cash_bank/cb_saldo_akhir_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    function get_vouc_tmp_detail()
    {

        $data['id_vouc_tmp'] = $this->input->post('id_vouc_tmp', TRUE);
        $data['voucno'] = $this->input->post('voucno', TRUE);
        $result = $this->cash_bank_model->get_vouc_tmp_detail($data)->row_array();
        echo json_encode($result);
    }

    function get_data_saldo_awal()
    {

        $result = $this->cash_bank_model->get_data_saldo_awal()->result_array();
        echo json_encode($result);
    }


    public function edit_voucher()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_rows = $this->input->post('id_rows', TRUE);
        $id_rows2 = $this->input->post('id_rows2', TRUE);
        $id_rows3 = $this->input->post('id_rows3', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_rows']     = $id_rows;
        $data['id_rows2']     = $id_rows2;
        $data['id_rows3']     = $id_rows3;
        $data['lokasi'] = $this->main_model->get_lokasi()->row_array();
        if ($result == '1') {
            $this->load->view('cash_bank/cb_edit_voucher_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function posting_harian()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);

        $period = $this->session->userdata('sess_periode');
        $data['period']        = $period;
        $data['period_tahun']  = substr($period, 0, 4);
        $data['period_bulan']  = substr($period, 4, 6);

        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('cash_bank/cb_posting_harian_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function posting_ke_gl()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);

        $period = $this->session->userdata('sess_periode');
        $data['period']        = $period;
        $data['period_tahun']  = substr($period, 0, 4);
        $data['period_bulan']  = substr($period, 4, 6);


        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('cash_bank/cb_posting_ke_gl_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function monthly_closing()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);

        $period = $this->session->userdata('sess_periode');
        $data['period']        = $period;
        $data['period_tahun']  = substr($period, 0, 4);
        $data['period_bulan']  = substr($period, 4, 6);


        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('cash_bank/cb_monthly_closing_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function get_data_noac()
    {
        $result = $this->cash_bank_model->get_data_noac()->result_array();
        echo json_encode($result);
    }

    public function get_bank_konfig()
    {

        $result = $this->cash_bank_model->get_bank_konfig()->row_array();
        echo json_encode($result);
    }

    public function posting_harian_submit()
    {
        $result = $this->cash_bank_model->posting_harian_submit();
        echo json_encode($result);
    }

    public function transfer_to_gl()
    {
        $result = $this->cash_bank_model->transfer_to_gl();
        echo json_encode($result);
    }

    public function monthly_closing_submit()
    {
        $result = $this->cash_bank_model->monthly_closing_submit();
        echo json_encode($result);
    }

    public function transfer_ke_gl_submit()
    {
        $result = $this->cash_bank_model->transfer_ke_gl_submit();
        echo json_encode($result);
    }

    public function simpan_ali()
    {
        $data['kode_sementara']  = $this->input->post('kode_sementara', TRUE);
        $data['nomor_voucher']   = $this->input->post('nomor_voucher', TRUE);
        $data['pay_rec']         = $this->input->post('pay_rec', TRUE);
        $data['kas_bank']        = $this->input->post('kas_bank', TRUE);
        $data['bank_descript']   = $this->input->post('bank_descript', TRUE);
        $data['tanggal']         = $this->input->post('tanggal', TRUE);
        $data['kepada']          = $this->input->post('kepada', TRUE);
        $data['jumlah']          = $this->input->post('jumlah', TRUE);
        $data['terbilang']       = $this->input->post('terbilang', TRUE);
        $data['bank_nama']       = $this->input->post('bank_nama', TRUE);
        $data['bank_no']         = $this->input->post('bank_no', TRUE);
        $data['bank_tanggal']    = $this->input->post('bank_tanggal', TRUE);
        $data['sumber_dana']     = $this->input->post('sumber_dana', TRUE);
        $data['sumber_dana_nominal'] = $this->input->post('sumber_dana_nominal', TRUE);
        $data['lokasi_users']    = $this->input->post('lokasi_users', TRUE);

        $data['noref_select']    = $this->input->post('noref_select', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);


        $result = $this->cash_bank_model->simpan_voucher_header($data);
        echo json_encode($result);
    }

    public function simpan_voucher_header()
    {

        //voucher header
        $data['kode_sementara']  = $this->input->post('kode_sementara', TRUE);
        $data['nomor_voucher']   = $this->input->post('nomor_voucher', TRUE);
        $data['pay_rec']         = $this->input->post('pay_rec', TRUE);
        $data['kas_bank']        = $this->input->post('kas_bank', TRUE);
        $data['bank_descript']   = $this->input->post('bank_descript', TRUE);
        $data['tanggal']         = $this->input->post('tanggal', TRUE);
        $data['kepada']          = $this->input->post('kepada', TRUE);
        $data['jumlah']          = $this->input->post('jumlah', TRUE);
        $data['terbilang']       = $this->input->post('terbilang', TRUE);
        $data['bank_nama']       = $this->input->post('bank_nama', TRUE);
        $data['bank_no']         = $this->input->post('bank_no', TRUE);
        $data['bank_tanggal']    = $this->input->post('bank_tanggal', TRUE);
        $data['sumber_dana']     = $this->input->post('sumber_dana', TRUE);
        $data['sumber_dana_nominal'] = $this->input->post('sumber_dana_nominal', TRUE);
        $data['lokasi_users']    = $this->input->post('lokasi_users', TRUE);

        $data['noref_select']    = $this->input->post('noref_select', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);


        $result = $this->cash_bank_model->simpan_voucher_header($data);
        echo json_encode($result);
    }

    public function simpan_voucher_detail()
    {

        //voucher header
        $data['kode_sementara']   = $this->input->post('kode_sementara', TRUE);
        $data['nomor_voucher']   = $this->input->post('nomor_voucher', TRUE);
        $data['pay_rec']         = $this->input->post('pay_rec', TRUE);
        $data['kas_bank']        = $this->input->post('kas_bank', TRUE);
        $data['bank_descript']   = $this->input->post('bank_descript', TRUE);
        $data['tanggal']         = $this->input->post('tanggal', TRUE);
        $data['kepada']          = $this->input->post('kepada', TRUE);
        $data['noref_select']    = $this->input->post('noref_select', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['jumlah']          = $this->input->post('jumlah', TRUE);
        $data['terbilang']       = $this->input->post('terbilang', TRUE);
        $data['bank_nama']       = $this->input->post('bank_nama', TRUE);
        $data['bank_no']         = $this->input->post('bank_no', TRUE);
        $data['bank_tanggal']    = $this->input->post('bank_tanggal', TRUE);

        //fieldset voucher detail
        $data['divisi_v']        = $this->input->post('divisi_v', TRUE);
        $data['acct']            = $this->input->post('acct', TRUE);
        $data['acct_nama']       = $this->input->post('acct_nama', TRUE);
        $data['kredit']          = $this->input->post('kredit', TRUE);
        $data['debit']           = $this->input->post('debet', TRUE);
        $data['transaksi_remark'] = $this->input->post('transaksi_remark', TRUE);



        $result = $this->cash_bank_model->simpan_voucher_detail($data);
        echo json_encode($result);
    }


    public function simpan_voucher_detail_by_po()
    {

        //voucher header
        $data['kode_sementara']   = $this->input->post('kode_sementara', TRUE);
        $data['nomor_voucher']   = $this->input->post('nomor_voucher', TRUE);
        $data['pay_rec']         = $this->input->post('pay_rec', TRUE);
        $data['kas_bank']        = $this->input->post('kas_bank', TRUE);
        $data['bank_descript']   = $this->input->post('bank_descript', TRUE);
        $data['tanggal']         = $this->input->post('tanggal', TRUE);
        $data['kepada']          = $this->input->post('kepada', TRUE);
        $data['noref_select']    = $this->input->post('noref_select', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['jumlah']          = $this->input->post('jumlah', TRUE);
        $data['terbilang']       = $this->input->post('terbilang', TRUE);
        $data['bank_nama']       = $this->input->post('bank_nama', TRUE);
        $data['bank_no']         = $this->input->post('bank_no', TRUE);
        $data['bank_tanggal']    = $this->input->post('bank_tanggal', TRUE);

        //fieldset voucher detail
        $data['divisi_v']        = $this->input->post('divisi_v', TRUE);
        $data['acct']            = $this->input->post('acct', TRUE);
        $data['acct_nama']       = $this->input->post('acct_nama', TRUE);
        $data['debit']           = $this->input->post('debet_by_po', TRUE);
        $data['transaksi_remark'] = $this->input->post('transaksi_remark', TRUE);

        //detail supplier
        $data['supp_acct']       = $this->input->post('supplier_acct', TRUE);
        $data['supp_nama']       = $this->input->post('supplier_nama', TRUE);

        //kodept
        $data['kodept']       = $this->input->post('kodept', TRUE);


        $data['ref_po']       = $this->input->post('ref_po', TRUE);


        $result = $this->cash_bank_model->simpan_voucher_detail_by_po($data);
        echo json_encode($result);
    }


    public function simpan_voucher_detail_by_po_edit()
    {


        //voucher header
        $data['kode_sementara']   = $this->input->post('kode_sementara', TRUE);
        $data['nomor_voucher']   = $this->input->post('nomor_voucher', TRUE);
        $data['pay_rec']         = $this->input->post('pay_rec', TRUE);
        $data['kas_bank']        = $this->input->post('kas_bank', TRUE);
        $data['bank_descript']   = $this->input->post('bank_descript', TRUE);
        $data['tanggal']         = $this->input->post('tanggal', TRUE);
        $data['kepada']          = $this->input->post('kepada', TRUE);
        $data['noref_select']    = $this->input->post('noref_select', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['jumlah']          = $this->input->post('jumlah', TRUE);
        $data['terbilang']       = $this->input->post('terbilang', TRUE);
        $data['bank_nama']       = $this->input->post('bank_nama', TRUE);
        $data['bank_no']         = $this->input->post('bank_no', TRUE);
        $data['bank_tanggal']    = $this->input->post('bank_tanggal', TRUE);

        //fieldset voucher detail
        $data['no_vouc']         = $this->input->post('kode_novoucher', TRUE);
        $data['divisi_v']        = $this->input->post('divisi_v', TRUE);
        $data['acct']            = $this->input->post('acct', TRUE);
        $data['acct_nama']       = $this->input->post('acct_nama', TRUE);
        $data['debit']           = $this->input->post('debet_by_po', TRUE);
        $data['transaksi_remark'] = $this->input->post('transaksi_remark', TRUE);


        $result = $this->cash_bank_model->simpan_voucher_detail_by_po_edit($data);
        echo json_encode($result);
    }


    function data_list_voucher_detail()
    {

        $data['kode_sementara'] = $this->input->post('kode_sementara', TRUE);

        $result = $this->cash_bank_model->data_list_voucher_detail($data)->result_array();
        echo json_encode($result);
    }

    function transaksi_vouc_head()
    {

        $data['id_vouc'] = $this->input->post('id_vouc', TRUE);
        $data['no_vouc'] = $this->input->post('no_vouc', TRUE);

        $result = $this->cash_bank_model->transaksi_vouc_head($data)->row_array();
        echo json_encode($result);
    }


    public function configurasi()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;

        $data['lokasi'] = $this->session->userdata('sess_nama_lokasi');

        if ($result == '1') {
            $this->load->view('cash_bank/cb_configurasi_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function configurasi_data()
    {

        $lokasi = $this->input->post('lokasi', TRUE);

        $result = $this->cash_bank_model->configurasi_data($lokasi)->row_array();
        echo json_encode($result);
    }


    public function configurasi_update()
    {


        $data['lokasi'] = $this->input->post('lokasi_s', TRUE);

        //1 : HO
        //2 : ESTATE
        //3 : RO


        if ($this->input->post('lokasi_s', TRUE) == 'HO') {


            //START - KODE PAYMENT (KAS)
            $data['kode_payment_kas_inisial_1'] = $this->input->post('kode_payment_kas_inisial_1', TRUE);
            $data['kode_payment_kas_kode_1']    = $this->input->post('kode_payment_kas_kode_1', TRUE);
            $data['kode_payment_kas_coa_1']     = $this->input->post('kode_payment_kas_coa_1', TRUE);
            //END - KODE PAYMENT (KAS)


            //START - KODE PAYMENT (BANK)
            $data['kode_payment_bank_nama_1']   = $this->input->post('kode_payment_bank_nama_1', TRUE);
            $data['kode_payment_bank_inisial_1'] = $this->input->post('kode_payment_bank_inisial_1', TRUE);
            $data['kode_payment_bank_kode_1']   = $this->input->post('kode_payment_bank_kode_1', TRUE);
            $data['kode_payment_bank_coa_1']    = $this->input->post('kode_payment_bank_coa_1', TRUE);

            $data['kode_payment_bank_nama_2']   = $this->input->post('kode_payment_bank_nama_2', TRUE);
            $data['kode_payment_bank_inisial_2'] = $this->input->post('kode_payment_bank_inisial_2', TRUE);
            $data['kode_payment_bank_kode_2']   = $this->input->post('kode_payment_bank_kode_2', TRUE);
            $data['kode_payment_bank_coa_2']    = $this->input->post('kode_payment_bank_coa_2', TRUE);

            $data['kode_payment_bank_nama_3']   = $this->input->post('kode_payment_bank_nama_3', TRUE);
            $data['kode_payment_bank_inisial_3'] = $this->input->post('kode_payment_bank_inisial_3', TRUE);
            $data['kode_payment_bank_kode_3']   = $this->input->post('kode_payment_bank_kode_3', TRUE);
            $data['kode_payment_bank_coa_3']    = $this->input->post('kode_payment_bank_coa_3', TRUE);

            $data['kode_payment_bank_nama_4']   = $this->input->post('kode_payment_bank_nama_4', TRUE);
            $data['kode_payment_bank_inisial_4'] = $this->input->post('kode_payment_bank_inisial_4', TRUE);
            $data['kode_payment_bank_kode_4']   = $this->input->post('kode_payment_bank_kode_4', TRUE);
            $data['kode_payment_bank_coa_4']    = $this->input->post('kode_payment_bank_coa_4', TRUE);

            $data['kode_payment_bank_nama_5']   = $this->input->post('kode_payment_bank_nama_5', TRUE);
            $data['kode_payment_bank_inisial_5'] = $this->input->post('kode_payment_bank_inisial_5', TRUE);
            $data['kode_payment_bank_kode_5']   = $this->input->post('kode_payment_bank_kode_5', TRUE);
            $data['kode_payment_bank_coa_5']    = $this->input->post('kode_payment_bank_coa_5', TRUE);

            $data['kode_payment_bank_nama_6']   = $this->input->post('kode_payment_bank_nama_6', TRUE);
            $data['kode_payment_bank_inisial_6'] = $this->input->post('kode_payment_bank_inisial_6', TRUE);
            $data['kode_payment_bank_kode_6']   = $this->input->post('kode_payment_bank_kode_6', TRUE);
            $data['kode_payment_bank_coa_6']    = $this->input->post('kode_payment_bank_coa_6', TRUE);

            $data['kode_payment_bank_nama_7']   = $this->input->post('kode_payment_bank_nama_7', TRUE);
            $data['kode_payment_bank_inisial_7'] = $this->input->post('kode_payment_bank_inisial_7', TRUE);
            $data['kode_payment_bank_kode_7']   = $this->input->post('kode_payment_bank_kode_7', TRUE);
            $data['kode_payment_bank_coa_7']    = $this->input->post('kode_payment_bank_coa_7', TRUE);

            $data['kode_payment_bank_nama_8']   = $this->input->post('kode_payment_bank_nama_8', TRUE);
            $data['kode_payment_bank_inisial_8'] = $this->input->post('kode_payment_bank_inisial_8', TRUE);
            $data['kode_payment_bank_kode_8']   = $this->input->post('kode_payment_bank_kode_8', TRUE);
            $data['kode_payment_bank_coa_8']    = $this->input->post('kode_payment_bank_coa_8', TRUE);

            $data['kode_payment_bank_nama_9']   = $this->input->post('kode_payment_bank_nama_9', TRUE);
            $data['kode_payment_bank_inisial_9'] = $this->input->post('kode_payment_bank_inisial_9', TRUE);
            $data['kode_payment_bank_kode_9']   = $this->input->post('kode_payment_bank_kode_9', TRUE);
            $data['kode_payment_bank_coa_9']    = $this->input->post('kode_payment_bank_coa_9', TRUE);

            $data['kode_payment_bank_nama_10']   = $this->input->post('kode_payment_bank_nama_10', TRUE);
            $data['kode_payment_bank_inisial_10'] = $this->input->post('kode_payment_bank_inisial_10', TRUE);
            $data['kode_payment_bank_kode_10']   = $this->input->post('kode_payment_bank_kode_10', TRUE);
            $data['kode_payment_bank_coa_10']    = $this->input->post('kode_payment_bank_coa_10', TRUE);
            //END - KODE PAYMENT (BANK)




            //START - KODE RECEIVE (KAS)
            $data['kode_receive_kas_inisial_1'] = $this->input->post('kode_receive_kas_inisial_1', TRUE);
            $data['kode_receive_kas_kode_1']    = $this->input->post('kode_receive_kas_kode_1', TRUE);
            $data['kode_receive_kas_coa_1']     = $this->input->post('kode_receive_kas_coa_1', TRUE);
            //END - KODE RECEIVE (KAS)


            //START - KODE RECEIVE (BANK)
            $data['kode_receive_bank_nama_1']   = $this->input->post('kode_receive_bank_nama_1', TRUE);
            $data['kode_receive_bank_inisial_1'] = $this->input->post('kode_receive_bank_inisial_1', TRUE);
            $data['kode_receive_bank_kode_1']   = $this->input->post('kode_receive_bank_kode_1', TRUE);
            $data['kode_receive_bank_coa_1']    = $this->input->post('kode_receive_bank_coa_1', TRUE);

            $data['kode_receive_bank_nama_2']   = $this->input->post('kode_receive_bank_nama_2', TRUE);
            $data['kode_receive_bank_inisial_2'] = $this->input->post('kode_receive_bank_inisial_2', TRUE);
            $data['kode_receive_bank_kode_2']   = $this->input->post('kode_receive_bank_kode_2', TRUE);
            $data['kode_receive_bank_coa_2']    = $this->input->post('kode_receive_bank_coa_2', TRUE);

            $data['kode_receive_bank_nama_3']   = $this->input->post('kode_receive_bank_nama_3', TRUE);
            $data['kode_receive_bank_inisial_3'] = $this->input->post('kode_receive_bank_inisial_3', TRUE);
            $data['kode_receive_bank_kode_3']   = $this->input->post('kode_receive_bank_kode_3', TRUE);
            $data['kode_receive_bank_coa_3']    = $this->input->post('kode_receive_bank_coa_3', TRUE);

            $data['kode_receive_bank_nama_4']   = $this->input->post('kode_receive_bank_nama_4', TRUE);
            $data['kode_receive_bank_inisial_4'] = $this->input->post('kode_receive_bank_inisial_4', TRUE);
            $data['kode_receive_bank_kode_4']   = $this->input->post('kode_receive_bank_kode_4', TRUE);
            $data['kode_receive_bank_coa_4']    = $this->input->post('kode_receive_bank_coa_4', TRUE);

            $data['kode_receive_bank_nama_5']   = $this->input->post('kode_receive_bank_nama_5', TRUE);
            $data['kode_receive_bank_inisial_5'] = $this->input->post('kode_receive_bank_inisial_5', TRUE);
            $data['kode_receive_bank_kode_5']   = $this->input->post('kode_receive_bank_kode_5', TRUE);
            $data['kode_receive_bank_coa_5']    = $this->input->post('kode_receive_bank_coa_5', TRUE);

            $data['kode_receive_bank_nama_6']   = $this->input->post('kode_receive_bank_nama_6', TRUE);
            $data['kode_receive_bank_inisial_6'] = $this->input->post('kode_receive_bank_inisial_6', TRUE);
            $data['kode_receive_bank_kode_6']   = $this->input->post('kode_receive_bank_kode_6', TRUE);
            $data['kode_receive_bank_coa_6']    = $this->input->post('kode_receive_bank_coa_6', TRUE);

            $data['kode_receive_bank_nama_7']   = $this->input->post('kode_receive_bank_nama_7', TRUE);
            $data['kode_receive_bank_inisial_7'] = $this->input->post('kode_receive_bank_inisial_7', TRUE);
            $data['kode_receive_bank_kode_7']   = $this->input->post('kode_receive_bank_kode_7', TRUE);
            $data['kode_receive_bank_coa_7']    = $this->input->post('kode_receive_bank_coa_7', TRUE);

            $data['kode_receive_bank_nama_8']   = $this->input->post('kode_receive_bank_nama_8', TRUE);
            $data['kode_receive_bank_inisial_8'] = $this->input->post('kode_receive_bank_inisial_8', TRUE);
            $data['kode_receive_bank_kode_8']   = $this->input->post('kode_receive_bank_kode_8', TRUE);
            $data['kode_receive_bank_coa_8']    = $this->input->post('kode_receive_bank_coa_8', TRUE);

            $data['kode_receive_bank_nama_9']   = $this->input->post('kode_receive_bank_nama_9', TRUE);
            $data['kode_receive_bank_inisial_9'] = $this->input->post('kode_receive_bank_inisial_9', TRUE);
            $data['kode_receive_bank_kode_9']   = $this->input->post('kode_receive_bank_kode_9', TRUE);
            $data['kode_receive_bank_coa_9']    = $this->input->post('kode_receive_bank_coa_9', TRUE);

            $data['kode_receive_bank_nama_10']   = $this->input->post('kode_receive_bank_nama_10', TRUE);
            $data['kode_receive_bank_inisial_10'] = $this->input->post('kode_receive_bank_inisial_10', TRUE);
            $data['kode_receive_bank_kode_10']   = $this->input->post('kode_receive_bank_kode_10', TRUE);
            $data['kode_receive_bank_coa_10']    = $this->input->post('kode_receive_bank_coa_10', TRUE);
            //END - KODE RECEIVE (BANK)


        } else if ($this->input->post('lokasi_s', TRUE) == 'ESTATE') {

            //START - KODE PAYMENT (KAS)
            $data['kode_payment_kas_inisial_1'] = $this->input->post('kode_payment_kas_inisial_1', TRUE);
            $data['kode_payment_kas_kode_1']    = $this->input->post('kode_payment_kas_kode_1', TRUE);
            $data['kode_payment_kas_coa_1']     = $this->input->post('kode_payment_kas_coa_1', TRUE);

            $data['kode_payment_kas_inisial_2'] = $this->input->post('kode_payment_kas_inisial_2', TRUE);
            $data['kode_payment_kas_kode_2']    = $this->input->post('kode_payment_kas_kode_2', TRUE);
            $data['kode_payment_kas_coa_2']     = $this->input->post('kode_payment_kas_coa_2', TRUE);

            $data['kode_payment_kas_inisial_3'] = $this->input->post('kode_payment_kas_inisial_3', TRUE);
            $data['kode_payment_kas_kode_3']    = $this->input->post('kode_payment_kas_kode_3', TRUE);
            $data['kode_payment_kas_coa_3']     = $this->input->post('kode_payment_kas_coa_3', TRUE);

            $data['kode_payment_kas_inisial_4'] = $this->input->post('kode_payment_kas_inisial_4', TRUE);
            $data['kode_payment_kas_kode_4']    = $this->input->post('kode_payment_kas_kode_4', TRUE);
            $data['kode_payment_kas_coa_4']     = $this->input->post('kode_payment_kas_coa_4', TRUE);

            $data['kode_payment_kas_inisial_5'] = $this->input->post('kode_payment_kas_inisial_5', TRUE);
            $data['kode_payment_kas_kode_5']    = $this->input->post('kode_payment_kas_kode_5', TRUE);
            $data['kode_payment_kas_coa_5']     = $this->input->post('kode_payment_kas_coa_5', TRUE);
            //END - KODE PAYMENT (KAS)


            //START - KODE PAYMENT (BANK)
            $data['kode_payment_bank_nama_1']   = $this->input->post('kode_payment_bank_nama_1', TRUE);
            $data['kode_payment_bank_inisial_1'] = $this->input->post('kode_payment_bank_inisial_1', TRUE);
            $data['kode_payment_bank_kode_1']   = $this->input->post('kode_payment_bank_kode_1', TRUE);
            $data['kode_payment_bank_coa_1']    = $this->input->post('kode_payment_bank_coa_1', TRUE);

            $data['kode_payment_bank_nama_2']   = $this->input->post('kode_payment_bank_nama_2', TRUE);
            $data['kode_payment_bank_inisial_2'] = $this->input->post('kode_payment_bank_inisial_2', TRUE);
            $data['kode_payment_bank_kode_2']   = $this->input->post('kode_payment_bank_kode_2', TRUE);
            $data['kode_payment_bank_coa_2']    = $this->input->post('kode_payment_bank_coa_2', TRUE);

            $data['kode_payment_bank_nama_3']   = $this->input->post('kode_payment_bank_nama_3', TRUE);
            $data['kode_payment_bank_inisial_3'] = $this->input->post('kode_payment_bank_inisial_3', TRUE);
            $data['kode_payment_bank_kode_3']   = $this->input->post('kode_payment_bank_kode_3', TRUE);
            $data['kode_payment_bank_coa_3']    = $this->input->post('kode_payment_bank_coa_3', TRUE);

            $data['kode_payment_bank_nama_4']   = $this->input->post('kode_payment_bank_nama_4', TRUE);
            $data['kode_payment_bank_inisial_4'] = $this->input->post('kode_payment_bank_inisial_4', TRUE);
            $data['kode_payment_bank_kode_4']   = $this->input->post('kode_payment_bank_kode_4', TRUE);
            $data['kode_payment_bank_coa_4']    = $this->input->post('kode_payment_bank_coa_4', TRUE);
            //END - KODE PAYMENT (BANK)




            //START - KODE RECEIVE (KAS)
            $data['kode_receive_kas_inisial_1'] = $this->input->post('kode_receive_kas_inisial_1', TRUE);
            $data['kode_receive_kas_kode_1']    = $this->input->post('kode_receive_kas_kode_1', TRUE);
            $data['kode_receive_kas_coa_1']     = $this->input->post('kode_receive_kas_coa_1', TRUE);

            $data['kode_receive_kas_inisial_2'] = $this->input->post('kode_receive_kas_inisial_2', TRUE);
            $data['kode_receive_kas_kode_2']    = $this->input->post('kode_receive_kas_kode_2', TRUE);
            $data['kode_receive_kas_coa_2']     = $this->input->post('kode_receive_kas_coa_2', TRUE);

            $data['kode_receive_kas_inisial_3'] = $this->input->post('kode_receive_kas_inisial_3', TRUE);
            $data['kode_receive_kas_kode_3']    = $this->input->post('kode_receive_kas_kode_3', TRUE);
            $data['kode_receive_kas_coa_3']     = $this->input->post('kode_receive_kas_coa_3', TRUE);

            $data['kode_receive_kas_inisial_4'] = $this->input->post('kode_receive_kas_inisial_4', TRUE);
            $data['kode_receive_kas_kode_4']    = $this->input->post('kode_receive_kas_kode_4', TRUE);
            $data['kode_receive_kas_coa_4']     = $this->input->post('kode_receive_kas_coa_4', TRUE);

            $data['kode_receive_kas_inisial_5'] = $this->input->post('kode_receive_kas_inisial_5', TRUE);
            $data['kode_receive_kas_kode_5']    = $this->input->post('kode_receive_kas_kode_5', TRUE);
            $data['kode_receive_kas_coa_5']     = $this->input->post('kode_receive_kas_coa_5', TRUE);
            //END - KODE RECEIVE (KAS)


            //START - KODE RECEIVE (BANK)
            $data['kode_receive_bank_nama_1']   = $this->input->post('kode_receive_bank_nama_1', TRUE);
            $data['kode_receive_bank_inisial_1'] = $this->input->post('kode_receive_bank_inisial_1', TRUE);
            $data['kode_receive_bank_kode_1']   = $this->input->post('kode_receive_bank_kode_1', TRUE);
            $data['kode_receive_bank_coa_1']    = $this->input->post('kode_receive_bank_coa_1', TRUE);

            $data['kode_receive_bank_nama_2']   = $this->input->post('kode_receive_bank_nama_2', TRUE);
            $data['kode_receive_bank_inisial_2'] = $this->input->post('kode_receive_bank_inisial_2', TRUE);
            $data['kode_receive_bank_kode_2']   = $this->input->post('kode_receive_bank_kode_2', TRUE);
            $data['kode_receive_bank_coa_2']    = $this->input->post('kode_receive_bank_coa_2', TRUE);
            //END - KODE RECEIVE (BANK)

        } else if ($this->input->post('lokasi_s', TRUE) == 'RO') {
        } else {
        }

        $result = $this->cash_bank_model->configurasi_update($data);
        echo json_encode($result);
    }


    function get_balance()
    {
        $kode_sementara = $this->input->post('kode_sementara', TRUE);
        $result = $this->cash_bank_model->get_balance($kode_sementara)->row_array();
        echo json_encode($result);
    }

    function get_balance_edit()
    {
        $novouc = $this->input->post('novouc', TRUE);
        $periode = $this->input->post('periode', TRUE);
        $result = $this->cash_bank_model->get_balance_edit($novouc, $periode)->row_array();
        echo json_encode($result);
    }


    public function laporan_vouc_register()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;

        if ($result == '1') {
            $this->load->view('cash_bank/cb_laporan_vouc_register_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function laporan_aktifitas_account()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;

        if ($result == '1') {
            $this->load->view('cash_bank/cb_laporan_aktifitas_account_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function laporan_vouc_journal()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;

        if ($result == '1') {
            $this->load->view('cash_bank/cb_laporan_vouc_journal_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function tabel_pp_logistik()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;

        if ($result == '1') {
            $this->load->view('cash_bank/cb_table_pp_logistik_popup_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    public function detail_pp_logistik()
    {

        $pppo_id = $this->input->post('pppo_id', TRUE);
        $pppo_no = $this->input->post('pppo_no', TRUE);
        $result = $this->cash_bank_model->detail_pp_logistik($pppo_id, $pppo_no)->row_array();
        echo json_encode($result);
    }


    public function detail_cash_bank()
    {

        $cb_id = $this->input->post('cb_id', TRUE);
        $result = $this->cash_bank_model->detail_cash_bank($cb_id)->row_array();
        echo json_encode($result);
    }



    public function history()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;

        if ($result == '1') {
            $this->load->view('cash_bank/cb_history_popup_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function hapus_vouchers()
    {

        $data['no_vouc']        = $this->input->post('no_vouc', TRUE);
        $data['id_vouc']        = $this->input->post('id_vouc', TRUE);
        $data['txt_periode']    = $this->input->post('txt_periode', TRUE);

        $result = $this->cash_bank_model->hapus_vouchers($data);
        echo json_encode($result);
    }


    public function data_history_vouc()
    {

        //onclick=\"getpopup('module/edit_sub','"+tokens+"','popupedit','"+result[i].id+"');\"

        $tokensapp = $this->session->userdata('sess_token');

        $list = $this->serv_side_cb_voucher_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {

            $amount = "Rp " . number_format($customers->AMOUNT, 2, ',', '.');

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->VOUCNO;
            $row[] = $customers->FROM;
            $row[] = $customers->txtperiode;
            $row[] = $amount;
            $row[] = "<a href='javascript:void(0)' onclick=edit_trans_voucher('" . $customers->VOUCNO . "'," . $customers->ID . ",'" . $customers->txtperiode . "') title=' Edit - " . $customers->VOUCNO . " - " . $customers->FROM . "'><i class='splashy-document_letter_edit'></i></a>    <a href='javascript:void(0)' onclick=selected_hapus_voucher('" . $customers->VOUCNO . "','" . $customers->txtperiode . "'," . $customers->ID . ") title=' Hapus - " . $customers->VOUCNO . " - " . $customers->FROM . "'><i class='splashy-document_a4_remove'></i></a>   <a href='javascript:void(0)' onclick=selected_voucher('" . $customers->VOUCNO . "','" . $customers->txtperiode . "'," . $customers->ID . ") title=' Print - " . $customers->VOUCNO . " - " . $customers->FROM . "'><i class='splashy-printer'></i></a>   ";

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->serv_side_cb_voucher_model->count_all(),
            "recordsFiltered" => $this->serv_side_cb_voucher_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    function get_data_head_vouch()
    {

        $data['id_vouc'] = $this->input->post('id_vouc', TRUE);
        $result = $this->cash_bank_model->get_data_head_vouch($data)->row_array();
        echo json_encode($result);
    }

    function get_list_voucher_detail()
    {

        $data['kode_vouch']  = $this->input->post('kode_vouch', TRUE);
        $data['kode_periode'] = $this->input->post('kode_periode', TRUE);

        $result = $this->cash_bank_model->get_list_voucher_detail($data)->result_array();
        echo json_encode($result);
    }

    public function update_vouc_tmp_detail()
    {

        //fieldset voucher detail
        $data['divisi_v']        = $this->input->post('divisi', TRUE);
        $data['acct']            = $this->input->post('acctno', TRUE);
        $data['acct_nama']       = $this->input->post('acctnama', TRUE);
        $data['kredit']          = $this->input->post('kredit', TRUE);
        $data['debit']           = $this->input->post('debet', TRUE);
        $data['transaksi_remark'] = $this->input->post('remark', TRUE);
        $data['idvoucher']       = $this->input->post('idvoucher', TRUE);

        $result = $this->cash_bank_model->update_vouc_tmp_detail($data);
        echo json_encode($result);
    }

    public function simpan_vouc_tmp_detail_update()
    {

        //voucher header
        $data['kode_sementara']   = $this->input->post('kode_sementara', TRUE);
        $data['nomor_voucher']   = $this->input->post('nomor_voucher', TRUE);
        $data['pay_rec']         = $this->input->post('pay_rec', TRUE);
        $data['kas_bank']        = $this->input->post('kas_bank', TRUE);
        $data['bank_descript']   = $this->input->post('bank_descript', TRUE);
        $data['tanggal']         = $this->input->post('tanggal', TRUE);
        $data['kepada']          = $this->input->post('kepada', TRUE);
        $data['noref_select']    = $this->input->post('noref_select', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['jumlah']          = $this->input->post('jumlah', TRUE);
        $data['terbilang']       = $this->input->post('terbilang', TRUE);
        $data['bank_nama']       = $this->input->post('bank_nama', TRUE);
        $data['bank_no']         = $this->input->post('bank_no', TRUE);
        $data['bank_tanggal']    = $this->input->post('bank_tanggal', TRUE);

        //fieldset voucher detail
        $data['no_vouc']         = $this->input->post('kode_novoucher', TRUE);
        $data['divisi_v']        = $this->input->post('divisi_v', TRUE);
        $data['acct']            = $this->input->post('acct', TRUE);
        $data['acct_nama']       = $this->input->post('acct_nama', TRUE);
        $data['kredit']          = $this->input->post('kredit', TRUE);
        $data['debit']           = $this->input->post('debet', TRUE);
        $data['transaksi_remark'] = $this->input->post('transaksi_remark', TRUE);



        $result = $this->cash_bank_model->simpan_vouc_tmp_detail_update($data);
        echo json_encode($result);
    }


    public function simpan_voucher_header_update()
    {

        $data['id_vouc']         = $this->input->post('kode_idvoucher', TRUE);
        $data['no_vouc']         = $this->input->post('kode_novoucher', TRUE);
        $data['kode_sementara']  = $this->input->post('kode_sementara', TRUE);
        $data['nomor_voucher']   = $this->input->post('nomor_voucher', TRUE);
        $data['pay_rec']         = $this->input->post('pay_rec', TRUE);
        $data['kas_bank']        = $this->input->post('kas_bank', TRUE);
        $data['bank_descript']   = $this->input->post('bank_descript', TRUE);
        $data['tanggal']         = $this->input->post('tanggal', TRUE);
        $data['kepada']          = $this->input->post('kepada', TRUE);
        $data['noref_select']    = $this->input->post('noref_select', TRUE);
        $data['no_ref']          = $this->input->post('no_ref', TRUE);
        $data['jumlah']          = $this->input->post('jumlah', TRUE);
        $data['terbilang']       = $this->input->post('terbilang', TRUE);
        $data['bank_nama']       = $this->input->post('bank_nama', TRUE);
        $data['bank_no']         = $this->input->post('bank_no', TRUE);
        $data['bank_tanggal']    = $this->input->post('bank_tanggal', TRUE);
        $data['sumber_dana']     = $this->input->post('sumber_dana', TRUE);
        $data['sumber_dana_nominal'] = $this->input->post('sumber_dana_nominal', TRUE);


        $result = $this->cash_bank_model->simpan_voucher_header_update($data);
        echo json_encode($result);
    }

    function get_vouc_tmp_detail_edit()
    {

        $data['id_vouc'] = $this->input->post('id_vouc', TRUE);
        $data['voucno'] = $this->input->post('voucno', TRUE);
        $result = $this->cash_bank_model->get_vouc_tmp_detail_edit($data)->row_array();
        echo json_encode($result);
    }

    public function update_vouc_tmp_detail_edit()
    {

        //fieldset voucher detail
        $data['divisi_v']        = $this->input->post('divisi', TRUE);
        $data['acct']            = $this->input->post('acctno', TRUE);
        $data['acct_nama']       = $this->input->post('acctnama', TRUE);
        $data['kredit']          = $this->input->post('kredit', TRUE);
        $data['debit']           = $this->input->post('debet', TRUE);
        $data['transaksi_remark'] = $this->input->post('remark', TRUE);
        $data['idvoucher']       = $this->input->post('idvoucher', TRUE);


        $result = $this->cash_bank_model->update_vouc_tmp_detail_edit($data);
        echo json_encode($result);
    }

    public function hapus_vouc_tmp_detail_edit()
    {

        $data['id_vouc'] = $this->input->post('id_vouc', TRUE);
        $data['voucno'] = $this->input->post('voucno', TRUE);
        $result = $this->cash_bank_model->hapus_vouc_tmp_detail_edit($data);
        echo json_encode($result);
    }


    public function cek_saldo_awal()
    {

        $data['acctno'] = $this->input->post('acctno', TRUE);
        $data['tahun']  = $this->input->post('tahun', TRUE);

        $result = $this->cash_bank_model->cek_saldo_awal($data)->num_rows();
        echo json_encode($result);
    }

    public function update_saldo_awal()
    {

        $data['acctno']     = $this->input->post('acctno', TRUE);
        $data['acctname']   = $this->input->post('acctname', TRUE);
        $data['tahun']      = $this->input->post('tahun', TRUE);
        $data['bulan']      = $this->input->post('bulan', TRUE);
        $data['saldo']      = $this->input->post('saldo', TRUE);

        $result = $this->cash_bank_model->update_saldo_awal($data);
        echo json_encode($result);
    }

    public function simpan_saldo_awal()
    {

        //fieldset voucher detail
        $data['acctno']     = $this->input->post('acctno', TRUE);
        $data['acctname']   = $this->input->post('acctname', TRUE);
        $data['tahun']      = $this->input->post('tahun', TRUE);
        $data['bulan']      = $this->input->post('bulan', TRUE);
        $data['saldo']      = $this->input->post('saldo', TRUE);

        $result = $this->cash_bank_model->simpan_saldo_awal($data);
        echo json_encode($result);
    }

    public function get_data_po_logistik()
    {

        //onclick=\"getpopup('module/edit_sub','"+tokens+"','popupedit','"+result[i].id+"');\"

        $tokensapp = $this->session->userdata('sess_token');

        $list = $this->serv_side_po_logistik_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {

            $name = str_replace(' ', '_', $customers->nama);

            $cls_date = new DateTime($customers->tglpp);

            // $date = date("d/m/Y", $customers->tglpp);
            $no++;
            $row = array();
            //$row[] = $no;
            $row[] = $customers->nopp;
            $row[] = $customers->nopo;
            $row[] = $customers->ref_po;
            $row[] = $cls_date->format('d-m-Y');
            $row[] = $customers->nama_supply;
            $row[] = $customers->bayar;
            $row[] = "<button class='btn btn-warning btn-sm' onclick=selected_pp_logistik(" . $customers->id . "," . $customers->nopp . ") title=' Pilih - " . $customers->nopp . " - " . $customers->ref_po . "'>Pilih</button>";

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->serv_side_po_logistik_model->count_all(),
            "recordsFiltered" => $this->serv_side_po_logistik_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function get_detail_supplier()
    {
        $data['kode_supplier'] = $this->input->post('kode_supplier', TRUE);
        $result = $this->cash_bank_model->get_detail_supplier($data)->row_array();
        echo json_encode($result);
    }

    public function saldo_awal_edit()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;
        if ($result == '1') {
            $this->load->view('cash_bank/cb_saldo_awal_edit_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function saldo_awal_detail()
    {

        $data['id_saldo']       = $this->input->post('id_saldo', TRUE);
        $data['tahun']  = $this->input->post('tahun_periode', TRUE);
        $data['bulan']  = $this->input->post('bulan_periode', TRUE);

        $result = $this->cash_bank_model->saldo_awal_detail($data)->row_array();
        echo json_encode($result);
    }


    public function saldo_awal_update()
    {

        $data['id_saldo']   = $this->input->post('id_saldo', TRUE);
        $data['tahun']      = $this->input->post('tahun', TRUE);
        $data['bulan']      = $this->input->post('bulan', TRUE);
        $data['saldo']      = $this->input->post('saldo', TRUE);

        $result = $this->cash_bank_model->saldo_awal_update($data);
        echo json_encode($result);
    }


    /*function get_data_head_vouch(){

        $data['id_vouc'] = $this->input->post('id_vouc',TRUE);        
        $result = $this->cash_bank_model->get_data_head_vouch($data)->row_array();
        echo json_encode($result);

    }

    function get_list_voucher_detail(){

        $data['kode_vouch']  = $this->input->post('kode_vouch',TRUE); 
        $data['kode_periode']= $this->input->post('kode_periode',TRUE);       

        $result = $this->cash_bank_model->get_list_voucher_detail($data)->result_array();
        echo json_encode($result);
    }*/


    function cek_pp_logistik()
    {
        $data['ref_po'] = $this->input->post('ref_po', TRUE);
        $result = $this->cash_bank_model->cek_pp_logistik($data)->num_rows();
        echo json_encode($result);
    }
}
