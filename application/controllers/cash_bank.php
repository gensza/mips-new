<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cash_bank extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('cash_bank_model');
        $this->load->model('saldo_awal');
        $this->load->model('aktifitas_account');
        $this->load->model('serv_side_cb_voucher_model');
        $this->load->model('serv_side_po_logistik_model');
        $this->load->model('serv_coa_gl');
        $this->load->model('serv_coa');
        // $this->mips_caba = $this->load->database('mips_caba', TRUE);
        $db_pt = check_db_pt();
        $this->mips_caba = $this->load->database('db_mips_cb_' . $db_pt, TRUE);
        // $db_pt = check_db_pt();
        // $this->mips_caba = $this->load->database('db_mips_cb_' . $db_pt, TRUE);
    }

    public function input_voucher()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        $data['lokasi'] = $this->main_model->get_lokasi()->row_array();
        $period = $this->session->userdata('sess_periode');
        $data['period']        = $period;
        $data['period_tahun']  = substr($period, 0, 4);
        $data['period_bulan']  = substr($period, 4, 6);

        $tahun = date('Y');
        $bulan = date('m');
        // $d = $this->cash_bank_model->cek_voucher();


        if ($result == '1') {
            if ($tahun == $data['period_tahun'] && $bulan == $data['period_bulan']) {
                # code...
                // if ($d > 0) {
                //     # code...
                //     $this->load->view('cash_bank/cb_adavoucher', $data);
                // } else {

                // }
                $this->load->view('cash_bank/cb_input_voucher_view', $data);
            } else {
                $this->load->view('cash_bank/cb_pw_vouc', $data);
                # code...
            }
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    function postVoucher()
    {
        $period = $this->session->userdata('sess_periode');
        $data['period']        = $period;
        $data['period_tahun']  = substr($period, 0, 4);
        $data['period_bulan']  = substr($period, 4, 6);

        $tahun = date('Y');
        $bulan = date('m');

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        $data['lokasi'] = $this->main_model->get_lokasi()->row_array();

        $cekvoucher = $this->cash_bank_model->getvoucher();
        $data['id_rows']     = $cekvoucher->ID;
        $data['id_rows2']     = $cekvoucher->VOUCNO;
        $data['id_rows3']     = $cekvoucher->txtperiode;

        if ($result == '1') {
            if ($tahun == $data['period_tahun'] && $bulan == $data['period_bulan']) {
                # code...

                $this->load->view('cash_bank/cb_lanjut_input_vou', $data);
            } else {
                $this->load->view('cash_bank/cb_pw_vouc', $data);
                # code...
            }
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function input_voucher_new()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        $data['lokasi'] = $this->main_model->get_lokasi()->row_array();
        $period = $this->session->userdata('sess_periode');
        $data['period']        = $period;
        $data['period_tahun']  = substr($period, 0, 4);
        $data['period_bulan']  = substr($period, 4, 6);

        $tahun = date('Y');
        $bulan = date('m');

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

    public function lpj()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('cash_bank/cb_lpj_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }
    public function buku_bank()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('cash_bank/cb_buku_bank', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    function get_bank()
    {
        $period = $this->session->userdata('sess_periode');
        $tahun  = substr($period, 0, 4);

        $mandiri = "100105030000000";
        $bri = "100105110000000";
        $data = $this->mips_caba->query("SELECT ACCTNO, ACCTNAME FROM master_accountcb WHERE ACCTNO in ('$mandiri','$bri')  AND thn='$tahun'")->result();
        echo json_encode($data);
    }

    public function rekap()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('cash_bank/cb_rekap_view', $data);
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

    function data_saldo_awal()
    {
        $list = $this->saldo_awal->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $d->ACCTNO;
            $row[] = $d->ACCTNAME;
            $row[] = number_format($d->saldo, 2, ",", ".");
            $row[] = number_format($d->saldo_1, 2, ",", ".");
            $row[] = number_format($d->saldo_2, 2, ",", ".");
            $row[] = number_format($d->saldo_3, 2, ",", ".");
            $row[] = number_format($d->saldo_4, 2, ",", ".");
            $row[] = number_format($d->saldo_5, 2, ",", ".");
            $row[] = number_format($d->saldo_6, 2, ",", ".");
            $row[] = number_format($d->saldo_7, 2, ",", ".");
            $row[] = number_format($d->saldo_8, 2, ",", ".");
            $row[] = number_format($d->saldo_9, 2, ",", ".");
            $row[] = number_format($d->saldo_10, 2, ",", ".");
            $row[] = number_format($d->saldo_11, 2, ",", ".");
            $row[] = number_format($d->saldo_12, 2, ",", ".");
            $row[] = $d->thn;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->saldo_awal->count_all(),
            "recordsFiltered" => $this->saldo_awal->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    function cb_laporan_aktifitas_account_view()
    {
        $periode = $this->session->userdata('sess_periode');
        $tahun  = substr($periode, 0, 4);
        $bulan  = substr($periode, 4, 5);

        $tglawal = date_format(date_create($this->input->post('tgl_start')), "Y-m-d");
        $tglakhir = date_format(date_create($this->input->post('tgl_end')), "Y-m-d");

        $list = $this->aktifitas_account->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {

            $isi = $this->aktifitas_account->query("SELECT * FROM master_accountcb WHERE ACCTNO='$d->ACCTNO' AND thn='$tahun' ORDER BY ACCTNO DESC")->row();

            $no++;
            $row = array();
            // $row[] = $no;
            $row[] = date_format(date_create($d->DATE), 'd-m-Y');
            $row[] = $d->ACCTNO;
            $row[] = $d->ACCTNAME;
            $row[] = $d->VOUCNO;
            $row[] = $d->FROM;
            $row[] = $d->REMARKS;
            $row[] = number_format($d->DEBIT, 2, ",", ".");
            $row[] = number_format($d->CREDIT, 2, ",", ".");


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->aktifitas_account->count_all(),
            "recordsFiltered" => $this->aktifitas_account->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
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
            $this->load->view('cash_bank/cb_posting_monthly_closing_view', $data);
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

    public function monthly_closing_submit_tes()
    {
        $periode = $this->session->userdata('sess_periode');
        $tahun  = substr($periode, 0, 4);
        $bulan  = substr($periode, 4, 5);

        if ($bulan == '01') {
            $var_bulan = '1';
        } else if ($bulan == '02') {
            $var_bulan = '2';
        } else if ($bulan == '03') {
            $var_bulan = '3';
        } else if ($bulan == '04') {
            $var_bulan = '4';
        } else if ($bulan == '05') {
            $var_bulan = '5';
        } else if ($bulan == '06') {
            $var_bulan = '6';
        } else if ($bulan == '07') {
            $var_bulan = '7';
        } else if ($bulan == '08') {
            $var_bulan = '8';
        } else if ($bulan == '09') {
            $var_bulan = '9';
        } else if ($bulan == '10') {
            $var_bulan = '10';
        } else if ($bulan == '11') {
            $var_bulan = '11';
        } else if ($bulan == '12') {
            $var_bulan = '12';
        }

        if ($var_bulan == '12') {
            $bln = 01;
            $thn = $tahun + 1;
        } else {
            $bln = $bulan + 1;
            $thn = $tahun;
            # code...
        }

        $period =  strtotime($periode);

        $final = date("Ym", strtotime("+1 month", $period));

        echo json_encode($final);
    }

    public function monthly_closing_submit()
    {
        $lokasi = $this->session->userdata('sess_id_lokasi');
        $periode = $this->session->userdata('sess_periode');
        $tahun  = substr($periode, 0, 4);
        $bulan  = substr($periode, 4, 5);

        if ($bulan == '01') {
            $var_bulan = '1';
        } else if ($bulan == '02') {
            $var_bulan = '2';
        } else if ($bulan == '03') {
            $var_bulan = '3';
        } else if ($bulan == '04') {
            $var_bulan = '4';
        } else if ($bulan == '05') {
            $var_bulan = '5';
        } else if ($bulan == '06') {
            $var_bulan = '6';
        } else if ($bulan == '07') {
            $var_bulan = '7';
        } else if ($bulan == '08') {
            $var_bulan = '8';
        } else if ($bulan == '09') {
            $var_bulan = '9';
        } else if ($bulan == '10') {
            $var_bulan = '10';
        } else if ($bulan == '11') {
            $var_bulan = '11';
        } else if ($bulan == '12') {
            $var_bulan = '12';
        }

        if ($var_bulan == '12') {
            $bln = 1;
            # code...
        } else {
            $bln = $var_bulan + 1;
            # code...
        }

        if ($bulan == '12') {

            $saldo_akhir = $this->mips_caba->query("SELECT acctno, acctname, thn,saldo ,saldo_$var_bulan as saldone FROM saldo_voucher WHERE SITENO='$lokasi' AND thn='$tahun'")->result();
            foreach ($saldo_akhir as $d) {
                // $saldo = $d->saldone;
                $saldoawal["SITENO"] = $lokasi;
                $saldoawal["ACCTNO"] = $d->acctno;
                $saldoawal["ACCTNAME"] = $d->acctname;
                $saldoawal["saldo"] = "0";
                $saldoawal["saldo_$var_bulan"] = "0";
                $saldoawal["thn"] = $d->thn + 1;

                $thn = $tahun + 1;

                /* untuk insert/update ke masteraccont_cb */
                $dt = $this->mips_caba->query("SELECT ACCTNO, ACCTNAME FROM master_accountcb WHERE SITENO='$lokasi' AND ACCTNO='$d->acctno' AND thn='$thn'")->num_rows();
                $ms_cb["SITENO"] = $lokasi;
                $ms_cb["ACCTNO"] = $d->acctno;
                $ms_cb["ACCTNAME"] = $d->acctname;
                $ms_cb["saldo"] = $d->saldo;
                $ms_cb["saldo_1"] = $d->saldone;
                $ms_cb["thn"] = $d->thn + 1;

                if ($dt > 0) {
                    # code...
                    $this->mips_caba->set($ms_cb);
                    $this->mips_caba->where(['SITENO' => $lokasi, 'ACCTNO' => $d->acctno, 'thn' => $thn]);
                    $this->mips_caba->update('master_accountcb');
                    if ($this->mips_caba->affected_rows() > 0) {
                        $saldo_awal = TRUE;
                    } else {
                        $saldo_awal = FALSE;
                    }
                } else {
                    # code...
                    $this->mips_caba->insert('master_accountcb', $ms_cb);
                    if ($this->mips_caba->affected_rows() > 0) {
                        $saldo_awal = TRUE;
                    } else {
                        $saldo_awal = FALSE;
                    }
                }
                /* end untuk insert/update ke masteraccont_cb */

                /* untuk insert/update saldo_vocher */
                $cek = $this->mips_caba->query("SELECT ACCTNO, ACCTNAME FROM saldo_voucher WHERE SITENO='$lokasi' AND ACCTNO='$d->acctno' AND thn='$thn'")->num_rows();
                if ($cek > 0) {
                    # code...
                    $this->mips_caba->set($saldoawal);
                    $this->mips_caba->where(['SITENO' => $lokasi, 'ACCTNO' => $d->acctno, 'thn' => $thn]);
                    $this->mips_caba->update('saldo_voucher');
                    if ($this->mips_caba->affected_rows() > 0) {
                        $saldo_akhir = TRUE;
                    } else {
                        $saldo_akhir = FALSE;
                    }
                    // $result = "Diupdate";
                } else {
                    // $result = "insert";
                    # code...
                    $this->mips_caba->insert('saldo_voucher', $saldoawal);
                    if ($this->mips_caba->affected_rows() > 0) {
                        $saldo_akhir = TRUE;
                    } else {
                        $saldo_akhir = FALSE;
                    }
                }
                /* end untuk insert/update saldo_vocher */
            }
        } else {
            # code...
            $saldo_akhir = $this->mips_caba->query("SELECT acctno, acctname, thn,saldo ,saldo_$var_bulan as saldone FROM saldo_voucher WHERE SITENO='$lokasi' AND thn='$tahun'")->result();
            foreach ($saldo_akhir as $dd) {
                $ms_cb["SITENO"] = $lokasi;
                $ms_cb["ACCTNO"] = $dd->acctno;
                $ms_cb["ACCTNAME"] = $dd->acctname;
                $ms_cb["saldo"] = $dd->saldo;
                $ms_cb["saldo_$bln"] = $dd->saldone;
                $ms_cb["thn"] = $dd->thn;

                $this->mips_caba->set($ms_cb);
                $this->mips_caba->where(['SITENO' => $lokasi, 'ACCTNO' => $dd->acctno, 'thn' => $tahun]);
                $this->mips_caba->update('master_accountcb');
                if ($this->mips_caba->affected_rows() > 0) {
                    $saldo_awal = TRUE;
                } else {
                    $saldo_awal = FALSE;
                }

                $saldoawal["SITENO"] = $lokasi;
                $saldoawal["ACCTNO"] = $dd->acctno;
                $saldoawal["ACCTNAME"] = $dd->acctname;
                $saldoawal["saldo"] = $dd->saldo;
                $saldoawal["saldo_$bln"] = $dd->saldone;
                $saldoawal["thn"] = $dd->thn;
                $this->mips_caba->set($saldoawal);
                $this->mips_caba->where(['SITENO' => $lokasi, 'ACCTNO' => $dd->acctno, 'thn' => $tahun]);
                $this->mips_caba->update('saldo_voucher');
                if ($this->mips_caba->affected_rows() > 0) {
                    $saldo_akhir = TRUE;
                } else {
                    $saldo_akhir = FALSE;
                }
            }
        }

        /* ubah periode */
        $p =  strtotime($periode);

        $final = date("Ym", strtotime("+1 month", $p));
        $session_data = array('sess_periode' => $final);
        $up = $this->main_model->update_periode($final);
        $this->session->set_userdata($session_data);

        /* end ubah periode */

        $result = [
            'saldo_akhir' => $saldo_akhir,
            'saldo_awal' => $saldo_awal,
            'update_periode' => $up
        ];


        echo json_encode($result);
    }

    public function transfer_ke_gl_submit()
    {
        $pt = $this->session->userdata('sess_pt');
        $lokasi = $this->session->userdata('sess_id_lokasi');
        $periode = $this->session->userdata('sess_periode');

        $setup = $this->db->query("SELECT txtperiode FROM tb_setup WHERE id_modul='2' AND id_pt='$pt' AND lokasi='$lokasi'")->row();
        if ($setup->txtperiode == $periode) {
            # code...
            $result = $this->cash_bank_model->transfer_ke_gl_submit();
            // $result = true;
        } else {
            $result = false;
            # code...
        }

        echo json_encode($result);
    }

    public function master_tabel_coa_popup()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        // $divisi = $this->input->post('divisi', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;

        if ($result == '1') {
            $this->load->view('cash_bank/coa_tabel_popup_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }
    public function tabel_coa_popup()
    {
        $tokens   = $this->input->post('tokens', TRUE);
        $id_modal = $this->input->post('id_modal', TRUE);
        $id_row = $this->input->post('id_row', TRUE);
        // $divisi = $this->input->post('divisi', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens']     = $tokens;
        $data['id_modal']   = $id_modal;
        $data['id_row']     = $id_row;

        if ($result == '1') {
            $this->load->view('cash_bank/tabel_coa_popup', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }


    /* untuk coa */
    public function gl_mastercode_popup()
    {

        //onclick=\"getpopup('module/edit_sub','"+tokens+"','popupedit','"+result[i].id+"');\"
        $tokensapp = $this->session->userdata('sess_token');
        // $divisi = $this->input->post('divisi');

        $list = $this->serv_coa_gl->get_datatables();
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
            "recordsTotal" => $this->serv_coa_gl->count_all(),
            "recordsFiltered" => $this->serv_coa_gl->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function mastercode_popup()
    {

        //onclick=\"getpopup('module/edit_sub','"+tokens+"','popupedit','"+result[i].id+"');\"
        $tokensapp = $this->session->userdata('sess_token');
        $divisi = $this->session->userdata('sess_id_lokasi');

        $list = $this->serv_coa->get_datatables($divisi);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {


            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->ACCTNO;
            $row[] = $customers->ACCTNAME;
            $row[] = $customers->SITENO;

            $row[] = "<button class='btn btn-success btn-sm' onclick=pilih(" . $customers->ACCTNO . "," . $customers->id . ") title=' Pilih- " . $customers->ACCTNO . " - " . $customers->ACCTNAME . "'>Pilih</button>";



            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->serv_coa->count_all($divisi),
            "recordsFiltered" => $this->serv_coa->count_filtered($divisi),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function master_detail_account()
    {
        $acct_no = $this->input->post('acct_no', TRUE);
        $acct_id = $this->input->post('acct_id', TRUE);
        $result = $this->cash_bank_model->master_detail_account($acct_no, $acct_id)->row_array();
        echo json_encode($result);
    }

    public function detail_account()
    {
        $acct_no = $this->input->post('acct_no', TRUE);
        $acct_id = $this->input->post('acct_id', TRUE);
        $result = $this->serv_coa->master_detail_account($acct_no, $acct_id)->row_array();
        echo json_encode($result);
    }

    /* end coa */

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

    public function update_saldo_akhir()
    {
        $coa = $this->input->post('coa');
        $jml = $this->input->post('jml');
        $pay = $this->input->post('pay');
        $result = $this->cash_bank_model->update_saldo_akhir($coa, $jml, $pay);
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
        // $d = $this->cash_bank_model->cek_voucher();
        // if ($d > 0) {
        // } else {
        //     $result = false;
        // }

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
        // $data['coa']    = $this->input->post('coa', TRUE);

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
            $row[] = "<a href='javascript:void(0)' onclick=edit_trans_voucher('" . $customers->VOUCNO . "'," . $customers->ID . ",'" . $customers->txtperiode . "') title=' Edit - " . $customers->VOUCNO . " - " . $customers->FROM . "'><i class='splashy-document_letter_edit'></i></a>    <a href='javascript:void(0)' onclick=selected_hapus_voucher('" . $customers->VOUCNO . "','" . $customers->txtperiode . "','" . $customers->ACCTNO . "'," . $customers->ID . ") title=' Hapus - " . $customers->VOUCNO . " - " . $customers->FROM . "'><i class='splashy-document_a4_remove'></i></a> <a href='javascript:void(0)' onclick=pdf_voucher('" . $customers->VOUCNO . "','" . $customers->txtperiode . "'," . $customers->ID . ") title=' Pdf - " . $customers->VOUCNO . " - " . $customers->FROM . "'><i class='splashy-download'></i></a>  <a href='javascript:void(0)' onclick=selected_voucher('" . $customers->VOUCNO . "','" . $customers->txtperiode . "'," . $customers->ID . ") title=' Print - " . $customers->VOUCNO . " - " . $customers->FROM . "'><i class='splashy-printer'></i></a>   ";

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
    function get_data_head_vouch2()
    {

        $data['id_vouc'] = $this->input->post('id_vouc', TRUE);
        $result = $this->cash_bank_model->get_data_head_vouch2($data)->row_array();
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
        $data['coa_head'] = $this->input->post('coa_head', TRUE);


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

    function cekvoucher()
    {
        $d = $this->cash_bank_model->cek_voucher();
        if ($d > 0) {
            # code...
            $data = true;
        } else {
            $data = false;
            # code...
        }

        echo json_encode($data);
    }
}
