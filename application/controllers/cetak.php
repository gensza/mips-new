<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cetak_model');
        $this->load->model('gl_model');
        $this->load->model('main_model');
        $this->load->model('saldo_akhir');
        $this->load->model('rekap_model');

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
    }

    public function cb_laporan_voucher_register_view()
    {

        $tgl_start      = $this->input->post('tgl_start', TRUE);
        $tgl_end        = $this->input->post('tgl_end', TRUE);
        $chx_periode    = $this->input->post('chx_periode', TRUE);

        $data = $this->cetak_model->get_data_vouch_register($tgl_start, $tgl_end, $chx_periode)->result_array();
        echo json_encode($data);
    }
    public function sum_saldo_register()
    {

        $tgl_start      = $this->input->post('tgl_start', TRUE);
        $tgl_end        = $this->input->post('tgl_end', TRUE);
        $chx_periode    = $this->input->post('chx_periode', TRUE);

        $data = $this->cetak_model->sum_saldo_register($tgl_start, $tgl_end, $chx_periode);
        // $data = "by ali dev";
        echo json_encode($data);
    }
    public function sum_saldo_jurnal()
    {

        $tgl_start      = $this->input->post('tgl_start', TRUE);
        $tgl_end        = $this->input->post('tgl_end', TRUE);
        $chx_periode    = $this->input->post('chx_periode', TRUE);

        $data = $this->cetak_model->sum_saldo_jurnal($tgl_start, $tgl_end, $chx_periode);
        // $data = "by ali dev";
        echo json_encode($data);
    }
    public function sum_saldo_accn()
    {

        $tgl_start      = $this->input->post('tgl_start', TRUE);
        $tgl_end        = $this->input->post('tgl_end', TRUE);
        $accn    = $this->input->post('accn', TRUE);

        $data = $this->cetak_model->sum_saldo_accn($accn, $tgl_start, $tgl_end);
        // $data = "by ali dev";
        echo json_encode($data);
    }

    public function cb_laporan_voucher_journal_view()
    {

        $tgl_start  = $this->input->post('tgl_start', TRUE);
        $tgl_end    = $this->input->post('tgl_end', TRUE);
        $chx_periode    = $this->input->post('chx_periode', TRUE);

        $res_data       = $this->cetak_model->get_data_vouch_journal($tgl_start, $tgl_end, $chx_periode)->result_array();
        $res_data_head  = $this->cetak_model->get_data_vouch_register_head_2($tgl_start, $tgl_end, $chx_periode)->result_array();
        $html = 0;

        $nos = 0 + 1;
        foreach ($res_data_head as $v) {

            foreach ($res_data as $a) {

                if ($a['VOUCNO'] == $v['VOUCNO']) {


                    $b = str_replace(',', '', $a['DEBET_F']);
                    $c = str_replace(',', '', $a['DEBET_F2']);


                    $oke = number_format($c, 2, ".", ",");

                    $html .= '<tr>
              <td width="100px" align="center">' . $a['TGL'] . '</td>
              <td width="100px">' . $a['VOUCNO'] . '</td>
              <td width="100px">' . $a['ACCTNO'] . '</td>
              <td align="left">' . $a['FROM'] . '</td>
              <td align="left" width="500px">' . $a['REMARKS'] . '</td>
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


            $html .= '<tr>
          <td width="100px" colspan="5" style="text-align: right;background:#f7f2a0;color:black;font-weight: bold;">TOTAL</td>

          <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold"><div style="float:right">' . $total_debit . '</div></td>
          <td align="right" width="150px" style="background: ' . $bg_color . ';color: black;font-weight: bold"><div style="float:right"><div style="float:right">' . $total_kredit . '</div></td>
          </tr>';
        }

        echo $html;
    }

    public function cb_laporan_aktifitas_account($tgl_start, $tgl_end, $coa, $cbx_periode)
    {
        // var_dump($coa) . die();
        $nama_dokumen = 'Laporan_CB_Account_' . $tgl_start . '_' . $tgl_end . '';
        $data['res_data'] = $this->cetak_model->get_data_aktifitas_account($coa, $tgl_start, $tgl_end)->result_array();
        $data['res_data_head'] = $this->cetak_model->get_list_saldo_akhir_aktifitas_account($coa, $tgl_start, $tgl_end)->result_array();
        // $data['vou'] = $this->cetak_model->get_vocer();
        // Tentukan path yang tepat ke mPDF
        $this->load->library('mpdf/mpdf');
        $data['namapt']  = $this->main_model->get_pt()->row_array();
        $data['jumlah']  = $this->cetak_model->sum_saldo_accn($coa, $tgl_start, $tgl_end);
        //$result['datapiutang'] = $this->piutang_model->data()->result_array();

        // Define a Landscape page size/format by name
        // $mpdf = new mPDF('utf-8', 'A4-P');
        $mpdf = new mPDF([
            'mode' => 'utf-8',
            'format' => 'A4',
            // 'format' => [190, 236],
            'margin_top' => '3',
            'orientation' => 'P'
        ]);
        //Memulai proses untuk menyimpan variabel php dan html
        ob_start();

        $this->load->view('cetak/cash_bank/lap_voucher_acc', $data);

        //$mpdf->setFooter('{PAGENO}');
        //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
    }

    public function cb_laporan_lpj_gabungan($sumber, $tgl_start, $tgl_end)
    {
        $nama_dokumen = 'Laporan_pertanggung_jawaban_' . $tgl_start . '_' . $tgl_end . '';
        $data['tgl1'] = $tgl_start;
        $data['tgl2'] = $tgl_end;
        // $p = $this->cetak_model->get_data_bank_vou($bank, $tgl_start, $tgl_end)->row();
        // $dt = $p->ACCTNO;
        $data['saldo'] = $this->cetak_model->get_list_all_lpj()->result();
        // var_dump($data['saldo']) . die();
        // $data['saldo'] = $saldo->saldonya;
        $data['namapt']  = $this->main_model->get_pt()->row_array();

<<<<<<< HEAD
        // var_dump($data['namapt']) . die();
=======
        // var_dump($data['saldo']) . die();
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777

        $this->load->library('mpdf/mpdf');

        $mpdf = new mPDF([
            'mode' => 'utf-8',
            'format' => 'A4',
            // 'format' => [190, 236],
            'margin_top' => '3',
            'orientation' => 'P'
        ]);
        //Memulai proses untuk menyimpan variabel php dan html
        ob_start();

        $this->load->view('cetak/cash_bank/lap_lpj_all', $data);

        // $mpdf->setFooter('{PAGENO}');
        //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
    }

    public function cb_laporan_lpj($sumber, $tgl_start, $tgl_end)
    {
        if ($sumber == 1) {
            $pdo = "PDO Gaji";
            if ($this->session->userdata('sess_nama_lokasi') == 'ESTATE') {
                # code...
                $coa = '100101030100000';
            } else {
                # code...
                $coa = '100101040100000';
            }
        } else if ($sumber == 2) {
            $pdo = "PDDO IM";

            if ($this->session->userdata('sess_nama_lokasi') == 'ESTATE') {
                # code...
                $coa = '100101030100000';
            } else {
                var_dump("belum ada") . die();
                # code...
            }

            # code...
        } else if ($sumber == 3) {
            $pdo = "PDDO GRTT";
            if ($this->session->userdata('sess_nama_lokasi') == 'ESTATE') {
                # code...
                $coa = '100101032000000';
            } else {
                $coa = '100101032000000';
                # code...
            }
            # code...
        } else if ($sumber == 4) {
            $pdo = "PDO Remise Kas";
            if ($this->session->userdata('sess_nama_lokasi') == 'ESTATE') {
                # code...
                $coa = '100101031000000';
            } else {
                $coa = '100101041000000';
                # code...
            }
            # code...
        } else if ($sumber == 5) {
            $pdo = "Dana Kontanan";
<<<<<<< HEAD
            $coa = '100101031500000';
=======
            $coa = '100101021500000';
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777

            # code...
        } else {
            /* semua kas */
            $pdo = 0;
            $coa = 0;
        }

<<<<<<< HEAD
        // var_dump($coa) . die();

=======
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777

        $nama_dokumen = 'Laporan_pertanggung_jawaban_' . $tgl_start . '_' . $tgl_end . '';
        // var_dump($pdo, $coa, $tgl_start, $tgl_end) . die();
        $head_vou = $this->cetak_model->get_data_lpj($pdo, $coa, $tgl_start, $tgl_end)->row();
        $data['res_data'] = $this->cetak_model->get_lpj($head_vou->ACCTNO, $tgl_start, $tgl_end)->result_array();
<<<<<<< HEAD
        // var_dump($head_vou->ACCTNO) . die();
=======
        // var_dump($data) . die();
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777

        $saldo = $this->cetak_model->get_list_saldo_akhir_lpj($head_vou->ACCTNO)->row();
        $data['saldo'] = $saldo->saldonya;
        // var_dump($data['saldo']) . die();
        $data['namapt']  = $this->main_model->get_pt()->row_array();

        $this->load->library('mpdf/mpdf');

        $mpdf = new mPDF([
            'mode' => 'utf-8',
            'format' => 'A4',
            // 'format' => [190, 236],
            'margin_top' => '3',
            'orientation' => 'P'
        ]);
        //Memulai proses untuk menyimpan variabel php dan html
        ob_start();

        $this->load->view('cetak/cash_bank/lap_lpj', $data);

        // $mpdf->setFooter('{PAGENO}');
        //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
    }

    public function cb_laporan_bukubank($bank, $tgl_start, $tgl_end)
    {
        $nama_dokumen = 'Laporan_buku_bank_' . $tgl_start . '_' . $tgl_end . '';
        $data['res_data'] = $this->cetak_model->get_data_bank($bank, $tgl_start, $tgl_end)->result_array();
<<<<<<< HEAD
        // var_dump($data['res_data']) . die();
=======
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777
        $data['tgl1'] = $tgl_start;
        $data['tgl2'] = $tgl_end;
        $data['coa'] = $bank;
        // $p = $this->cetak_model->get_data_bank_vou($bank, $tgl_start, $tgl_end)->row();
        // $dt = $p->ACCTNO;
        $data['saldo'] = $this->cetak_model->get_list_bank($bank)->result();
<<<<<<< HEAD
=======
        // var_dump($data['coa']) . die();
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777
        // $data['saldo'] = $saldo->saldonya;
        $data['namapt']  = $this->main_model->get_pt()->row_array();

        // var_dump($data['saldo']) . die();

        $this->load->library('mpdf/mpdf');

        $mpdf = new mPDF([
            'mode' => 'utf-8',
            'format' => 'A4',
            // 'format' => [190, 236],
            'margin_top' => '3',
            'orientation' => 'P'
        ]);
        //Memulai proses untuk menyimpan variabel php dan html
        ob_start();

        $this->load->view('cetak/cash_bank/lap_buku_bank', $data);

        // $mpdf->setFooter('{PAGENO}');
        //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
    }

    public function cb_laporan_aktifitas_account_view()
    {

        $tgl_start      = $this->input->post('tgl_start', TRUE);
        $tgl_end        = $this->input->post('tgl_end', TRUE);
        $accn    = $this->input->post('accn', TRUE);

        $period = $this->session->userdata('sess_periode');
        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 5);

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


        $res_data       = $this->cetak_model->get_data_aktifitas_account($accn, $tgl_start, $tgl_end)->result_array();
        $res_data_head  = $this->cetak_model->get_list_saldo_akhir_aktifitas_account($accn)->result_array();
        $html = 0;

        $nos = 0 + 1;
        $tot_deb = 0;
        $tot_cre = 0;
        $total = 0;
        $tot_dc = 0;
        foreach ($res_data_head as $v) {

            $vou = $this->cetak_model->get_vocer($v['ACCTNO']);

            if ($vou > 0) {
                # code...
                $html .= '<tr>
                  <td width="100px" colspan="4" style="background-color:#cef58e"><b>Account : () ' . $v['ACCTNO'] . ' ' . $v['ACCTNAME'] . '</b></td>
                  <td style="display: none"></td>
                  <td style="display: none"></td>
                  <td style="display: none"></td>
                  <td align="right" width="150px" style="background-color:#cef58e"><div style="float:right">' . number_format($v["saldo_$var_bulan"], 2, ",", ".") . ' </div></td>
                  <td align="right" width="150px" style="background-color:#cef58e"><div style="float:right">0</div></td>
                  </tr>';

                foreach ($res_data as $a) {

                    if ($a['ACCTNO'] == $v['ACCTNO']) {

                        $b = str_replace(',', '', $a['DEBET_F']);
                        $c = str_replace(',', '', $a['DEBET_F2']);


                        $html .= '<tr>
                                    <td width="100px" align="center">' . $a['TGL'] . '</td>
                                    <td width="100px">' . $a['VOUCNO'] . '</td>
                                    <td align="left">' . $a['FROM'] . '</td>
                                    <td align="left" width="500px">' . $a['REMARKS'] . '</td>
                                    <td align="right" width="150px"><div style="float:right">' . $a['DEBET_F'] . '</div></td>
                                    <td align="right" width="150px"><div style="float:right">' . $a['CREDIT_F'] . '</div></td>
                                </tr>';

                        // $tot_deb += $a['DEBET_F2'];
                        // $tot_cre += $a['CREDIT_F2'];
                    }
                    $nos++;
                }
                // $coa = $v['ACCTNO'];
                $dc = $this->cetak_model->get_dc($v['ACCTNO']);
                $sd = $this->cetak_model->saldo_awal($v['ACCTNO']);
                $total = $sd->saldo + $dc->totaldr - $dc->totalcr;
                $html .= '<tr>
                         <td width="100px" colspan="4" style="text-align: right;background:#f7f2a0;color:black;font-weight: bold;">TOTAL Transaki PerAccount :</td>
                         <td style="display: none"></td>
                         <td style="display: none"></td>
                         <td style="display: none"></td>
                         <td align="right" width="150px" style="background: #84ffc5;color: black;font-weight: bold"><div style="float:right">' . number_format($dc->totaldr, 2, ',', '.') . '</div></td>
                         <td align="right" width="150px" style="background: #84ffc5;color: black;font-weight: bold"><div style="float:right"><div style="float:right">' . number_format($dc->totalcr, 2, ',', '.') . '</div></td>
                         </tr>';
                $html .= '<tr>
                         <td width="100px" colspan="4" style="text-align: right;background:#f7f2a0;color:black;font-weight: bold;">SALDO AKHIR :</td>
                         <td style="display: none"></td>
                         <td style="display: none"></td>
                         <td style="display: none"></td>
                         <td  align="right" width="150px" style="background: #84ffc5;color: black;font-weight: bold"><div style="float:right">' . number_format($total, 2, ',', '.') . '</div></td>
                         <td  align="right" width="150px" style="background: #84ffc5;color: black;font-weight: bold"><div style="float:right"></div></td>
                         </tr>';
            }
        }

        echo $html;
    }

    public function cb_laporan_voucher_register($tgl_start, $tgl_end, $cbx_periode)
    {

        $nama_dokumen = 'Laporan_CB_Voucher_Register_' . $tgl_start . '_' . $tgl_end . '';
        $data['res_data'] = $this->cetak_model->get_data_vouch_register($tgl_start, $tgl_end, $cbx_periode)->result_array();

        $period = $this->session->userdata('sess_periode');
        $data['tahun']  = substr($period, 0, 4);
        $data['bulan']  = substr($period, 4, 6);


        $data['namapt']  = $this->main_model->get_pt()->row_array();
        $data['jumlah']  = $this->cetak_model->sum_saldo_register($tgl_start, $tgl_end, $cbx_periode);


        // Tentukan path yang tepat ke mPDF
        $this->load->library('mpdf/mpdf');
        //$result['datapiutang'] = $this->piutang_model->data()->result_array();

        // Define a Landscape page size/format by name
        $mpdf = new mPDF('utf-8', 'A4-L');
        //Memulai proses untuk menyimpan variabel php dan html
        ob_start();

        $this->load->view('cetak/cash_bank/laporan_voucher_register_view', $data);

        //$mpdf->setFooter('{PAGENO}');
        //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
    }


    public function cb_laporan_voucher_journal($tgl_start, $tgl_end, $cbx_periode)
    {

        $nama_dokumen = 'Laporan_CB_Voucher_Journal_' . $tgl_start . '_' . $tgl_end . '';
        $data['res_data'] = $this->cetak_model->get_data_vouch_journal($tgl_start, $tgl_end, $cbx_periode)->result_array();
        $data['res_data_head'] = $this->cetak_model->get_data_vouch_register_head_2($tgl_start, $tgl_end, $cbx_periode)->result_array();
        // Tentukan path yang tepat ke mPDF
        $this->load->library('mpdf/mpdf');
        $data['namapt']  = $this->main_model->get_pt()->row_array();
        $data['jumlah']  = $this->cetak_model->sum_saldo_jurnal($tgl_start, $tgl_end, $cbx_periode);
        //$result['datapiutang'] = $this->piutang_model->data()->result_array();
        // var_dump($data['jumlah']) . die();
        // Define a Landscape page size/format by name
        $mpdf = new mPDF('utf-8', 'A4-L');
        //Memulai proses untuk menyimpan variabel php dan html
        ob_start();

        $this->load->view('cetak/cash_bank/laporan_voucher_journal_view', $data);

        //$mpdf->setFooter('{PAGENO}');
        //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
    }


    public function cb_voucher($no_vouc, $id_vouc, $txtperiode)
    {

        $data['pt']  = $this->main_model->get_pt()->row_array();

        $nama_dokumen = 'Laporan_CB_Voucher_Register_' . $no_vouc . '';
        $data['h_vouc'] = $this->cetak_model->get_data_vouc_header_detail($no_vouc, $id_vouc, $txtperiode)->row_array();
        $data['d_vouc'] = $this->cetak_model->get_trans_cb_vou($data['h_vouc']['ACCTNO'], $no_vouc, $txtperiode)->result_array();

        // var_dump($data['d_vouc']) . die();

        //$data['d_vouc_c'] = $this->cetak_model->get_data_vouc_list_detail_cr($no_vouc,$txtperiode)->result_array();

        // Tentukan path yang tepat ke mPDF
        $this->load->library('mpdf/mpdf');
        //$result['datapiutang'] = $this->piutang_model->data()->result_array();

        // Define a Landscape page size/format by name
        $mpdf = new mPDF('utf-8', 'A4-P');

        //Memulai proses untuk menyimpan variabel php dan html
        ob_start();

        $this->load->view('cetak/cash_bank/laporan_voucher_transaksi_view.php', $data);

        //$mpdf->setFooter('{PAGENO}');
        //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
    }


    public function print_voucher($no_vouc, $id_vouc, $txtperiode)
    {

        $data['pt']  = $this->main_model->get_pt()->row_array();

        $nama_dokumen = 'Laporan_CB_Voucher_Register_' . $no_vouc . '';
        $data['h_vouc'] = $this->cetak_model->get_data_vouc_header_detail($no_vouc, $id_vouc, $txtperiode)->row_array();
        $data['d_vouc'] = $this->cetak_model->get_trans_cb_vou($data['h_vouc']['ACCTNO'], $no_vouc, $txtperiode)->result_array();
        $data['isi_vouc'] = $this->cetak_model->isi_trans_cb_vou($no_vouc, $txtperiode)->num_rows();
        // var_dump($data['isi_vouc']) . die();

        //$data['d_vouc_c'] = $this->cetak_model->get_data_vouc_list_detail_cr($no_vouc,$txtperiode)->result_array();

        // Tentukan path yang tepat ke mPDF
        $this->load->library('mpdf/mpdf');
        //$result['datapiutang'] = $this->piutang_model->data()->result_array();

        // Define a Landscape page size/format by name
        $mpdf = new mPDF('utf-8', 'A4-P');

        //Memulai proses untuk menyimpan variabel php dan html
        ob_start();

        $this->load->view('cetak/cash_bank/laporan_voucher_cetak.php', $data);

        //$mpdf->setFooter('{PAGENO}');
        //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
    }


    public function cb_laporan_saldo_akhir()
    {

        $bln  = $this->input->post('bulan', TRUE);
        $tahun  = $this->input->post('tahun', TRUE);

        $list = $this->saldo_akhir->get_datatables($tahun);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {

            if ($bln == '01') {
                $var_bulan = '1';
            } else if ($bln == '02') {
                $var_bulan = '2';
            } else if ($bln == '03') {
                $var_bulan = '3';
            } else if ($bln == '04') {
                $var_bulan = '4';
            } else if ($bln == '05') {
                $var_bulan = '5';
            } else if ($bln == '06') {
                $var_bulan = '6';
            } else if ($bln == '07') {
                $var_bulan = '7';
            } else if ($bln == '08') {
                $var_bulan = '8';
            } else if ($bln == '09') {
                $var_bulan = '9';
            } else if ($bln == '10') {
                $var_bulan = '10';
            } else if ($bln == '11') {
                $var_bulan = '11';
            } else if ($bln == '12') {
                $var_bulan = '12';
            } else {
                $var_bulan = '-';
            }

            $isi =  $this->mips_caba->query("SELECT saldo_$var_bulan as saldo_f FROM saldo_voucher WHERE id='$customers->id' AND thn = '$tahun'")->row();
            $saldo = $isi->saldo_f;

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->ACCTNO;
            $row[] = $customers->ACCTNAME;
            $row[] = number_format($isi->saldo_f, 2, ",", ".");


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->saldo_akhir->count_all($tahun),
            "recordsFiltered" => $this->saldo_akhir->count_filtered($tahun),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function cb_laporan_rekap()
    {

        $tgl_start  = $this->input->post('tgl_start', TRUE);
        $tgl_end  = $this->input->post('tgl_end', TRUE);
        $chx_periode  = $this->input->post('chx_periode', TRUE);

        $list = $this->rekap_model->get_datatables($tgl_start, $tgl_end, $chx_periode);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $saldo = 0;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->ACCTNO;
            $row[] = $customers->ACCTNAME;
            $row[] = number_format($saldo, 2, ",", ".");


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rekap_model->count_all($tgl_start, $tgl_end, $chx_periode),
            "recordsFiltered" => $this->rekap_model->count_filtered($tgl_start, $tgl_end, $chx_periode),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    function sum_saldo_akhir()
    {
        $lokasi = $this->session->userdata('sess_id_lokasi');
        $bln  = $this->input->post('bulan', TRUE);
        $tahun  = $this->input->post('tahun', TRUE);

        if ($bln == '01') {
            $var_bulan = '1';
        } else if ($bln == '02') {
            $var_bulan = '2';
        } else if ($bln == '03') {
            $var_bulan = '3';
        } else if ($bln == '04') {
            $var_bulan = '4';
        } else if ($bln == '05') {
            $var_bulan = '5';
        } else if ($bln == '06') {
            $var_bulan = '6';
        } else if ($bln == '07') {
            $var_bulan = '7';
        } else if ($bln == '08') {
            $var_bulan = '8';
        } else if ($bln == '09') {
            $var_bulan = '9';
        } else if ($bln == '10') {
            $var_bulan = '10';
        } else if ($bln == '11') {
            $var_bulan = '11';
        } else if ($bln == '12') {
            $var_bulan = '12';
        } else {
            $var_bulan = '-';
        }

        $dt = $this->mips_caba->query("SELECT SUM(saldo_$var_bulan) as saldo_f FROM saldo_voucher WHERE SITENO='$lokasi' AND thn = '$tahun'")->row();
        $saldo = number_format($dt->saldo_f, 2, ",", ".");
        echo json_encode($saldo);
    }

    public function cb_laporan_saldo_akhir_cetak($bulan, $tahun)
    {

        $nama_dokumen = 'Laporan_Saldo_Akhir_' . $bulan . '_' . $tahun . '';

        $data['list_saldo_akhir']       = $this->cetak_model->get_list_saldo_akhir($bulan, $tahun)->result_array();
        $data['total'] = $this->mips_caba->query("SELECT SUM(saldo_$bulan) as saldo_f FROM saldo_voucher WHERE thn = '$tahun'")->row();


        // Tentukan path yang tepat ke mPDF
        $this->load->library('mpdf/mpdf');
        $data['namapt']  = $this->main_model->get_pt()->row_array();
        //$result['datapiutang'] = $this->piutang_model->data()->result_array();

        // Define a Landscape page size/format by name
        $mpdf = new mPDF('utf-8', 'A4-L');
        //Memulai proses untuk menyimpan variabel php dan html
        ob_start();

        $this->load->view('cetak/cash_bank/laporan_saldo_akhir_view', $data);

        //$mpdf->setFooter('{PAGENO}');
        //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
    }




    /* Laporan GL */

    public function gl_lap_jurnal($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end, $cetak)
    {

        $nama_dokumen = 'Laporan_GL_Jurnal_' . $tgl_start . '_' . $tgl_end . '';

        $data['data_entry']        = $this->gl_model->get_data_entry($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $data['data_entry_head']   = $this->gl_model->get_data_entry_head($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();

        if ($cetak == 'pdf') {
            // ini_set('memory_limit', '200M');
            // ini_set('upload_max_filesize', '200M');
            // ini_set('post_max_size', '200M');
            // ini_set('max_input_time', 3600);
            // ini_set('max_execution_time', 3600);

            // ini_set("memory_limit", "512M");

            // Tentukan path yang tepat ke mPDF
            $this->load->library('mpdf/mpdf');
            //$result['datapiutang'] = $this->piutang_model->data()->result_array();

            // Define a Landscape page size/format by name
            $mpdf = new mPDF('utf-8', 'A4-L');
            //Memulai proses untuk menyimpan variabel php dan html
            ob_start();

            $this->load->view('cetak/gl/gl_laporan_jurnal_view', $data);

            //$mpdf->setFooter('{PAGENO}');
            //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
            $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
            ob_end_clean();
            //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
            $mpdf->WriteHTML(utf8_encode($html));
            $mpdf->Output($nama_dokumen . ".pdf", 'I');
            exit;
        } else {
            $this->load->view('cetak/gl/gl_laporan_jurnal_view_excel', $data);
        }
    }


    public function gl_lap_jurnal_popup($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)
    {

        $nama_dokumen = 'Laporan_GL_Jurnal_' . $tgl_start . '_' . $tgl_end . '';

        $data['data_entry']        = $this->gl_model->get_data_entry($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $data['data_entry_head']   = $this->gl_model->get_data_entry_head($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();


        ini_set('memory_limit', '200M');
        ini_set('upload_max_filesize', '200M');
        ini_set('post_max_size', '200M');
        ini_set('max_input_time', 3600);
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit", "512M");

        // Tentukan path yang tepat ke mPDF
        $this->load->library('mpdf/mpdf');
        //$result['datapiutang'] = $this->piutang_model->data()->result_array();

        // Define a Landscape page size/format by name
        $mpdf = new mPDF('utf-8', 'A4-L');
        //Memulai proses untuk menyimpan variabel php dan html
        ob_start();

        $this->load->view('cetak/gl/gl_laporan_jurnal_view', $data);

        //$mpdf->setFooter('{PAGENO}');
        //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
    }


    public function gl_lap_module($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $module, $cetakan, $data_chxbox)
    {
        $nama_dokumen = 'Laporan_GL_Module_' . $tgl_start . '_' . $tgl_end . '';

        $data['tgl_start'] = $tgl_start;
        $data['tgl_end'] = $tgl_end;
        $data['periode_terkini'] = $periode_terkini;
        if ($data_chxbox == 'KHUSUS') {
            $data['jenis_khusus'] = $module;
            $data['data_entry']        = $this->gl_model->get_data_entry_rpt_module($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
            $data['data_entry_head']   = $this->gl_model->get_data_entry_head_rpt_module($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
        } else if ($data_chxbox == 'LOGISTIK') // ini jika LPB vs BKB
        {
            $data['data_entry_head']   = $this->gl_model->get_data_entry_head_rpt_module_lpbbkb($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
        } else if ($data_chxbox == 'ESTPKS') {
            $data['jenis_khusus'] = $module;
            $data['data_entry']        = $this->gl_model->get_data_entry_rpt_module_estpks($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
            $data['data_entry_head']   = $this->gl_model->get_data_entry_head_rpt_module_estpks($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
        } else if ($data_chxbox == 'EST') {
            $data['jenis_khusus'] = $module;
            $data['data_entry']        = $this->gl_model->get_data_entry_rpt_module_est($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
            $data['data_entry_head']   = $this->gl_model->get_data_entry_head_rpt_module_est($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
        } else if ($data_chxbox == 'PKS') {
            $data['jenis_khusus'] = $module;
            $data['data_entry']        = $this->gl_model->get_data_entry_rpt_module_pks($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
            $data['data_entry_head']   = $this->gl_model->get_data_entry_head_rpt_module_pks($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
        } else {
            $data['data_entry']        = $this->gl_model->get_data_entry_rpt_module($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
            $data['data_entry_head']   = $this->gl_model->get_data_entry_head_rpt_module($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)->result_array();
        }

        if ($cetakan == 'pdf') {
            // ini_set('memory_limit', '200M');
            // ini_set('upload_max_filesize', '200M');
            // ini_set('post_max_size', '200M');
            // ini_set('max_input_time', 3600);
            // ini_set('max_execution_time', 3600);

            // ini_set("memory_limit", "512M");

            // Tentukan path yang tepat ke mPDF
            $this->load->library('mpdf/mpdf');
            //$result['datapiutang'] = $this->piutang_model->data()->result_array();

            // Define a Landscape page size/format by name
            $mpdf = new mPDF('utf-8', 'A4-L');
            //Memulai proses untuk menyimpan variabel php dan html
            ob_start();

            if ($data_chxbox == 'KHUSUS') {
                $this->load->view('cetak/gl/gl_laporan_module_view_khusus', $data);
            } else if ($data_chxbox == 'LOGISTIK') { // ini jika LPB vs BKB
                $this->load->view('cetak/gl/gl_laporan_module_view_lpbbkb', $data);
            } else if ($data_chxbox == 'ESTPKS') {
                $this->load->view('cetak/gl/gl_laporan_module_view_estpks', $data);
            } else if ($data_chxbox == 'EST') {
                $this->load->view('cetak/gl/gl_laporan_module_view_est', $data);
            } else if ($data_chxbox == 'PKS') {
                $this->load->view('cetak/gl/gl_laporan_module_view_pks', $data);
            } else {
                $this->load->view('cetak/gl/gl_laporan_module_view', $data);
            }

            //$mpdf->setFooter('{PAGENO}');
            //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
            $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
            ob_end_clean();
            //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
            $mpdf->WriteHTML(utf8_encode($html));
            $mpdf->Output($nama_dokumen . ".pdf", 'I');
            exit;
        } else {
            if ($data_chxbox == 'KHUSUS') {
                $this->load->view('cetak/gl/gl_laporan_module_view_khusus_excel', $data);
            } elseif ($data_chxbox == 'LOGISTIK') { // ini jika LPB vs BKB
                $this->load->view('cetak/gl/gl_laporan_module_view_lpbbkb_excel', $data);
            } elseif ($data_chxbox == 'ESTPKS') {
                $this->load->view('cetak/gl/gl_laporan_module_view_estpks_excel', $data);
            } elseif ($data_chxbox == 'EST') {
                $this->load->view('cetak/gl/gl_laporan_module_view_est_excel', $data);
            } elseif ($data_chxbox == 'PKS') {
                $this->load->view('cetak/gl/gl_laporan_module_view_pks_excel', $data);
            } else {
                $this->load->view('cetak/gl/gl_laporan_module_view_excel', $data);
            }
        }
    }



    public function gl_lap_bukubesar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)
    {

        $nama_dokumen = 'Laporan_GL_Jurnal_' . $tgl_start . '_' . $tgl_end . '';

        $period = $this->session->userdata('sess_periode');
        $data['tahun']  = substr($period, 0, 4);
        $data['bulan']  = substr($period, 4, 6);

        //$res_data_acct  = $this->gl_model->get_data_acct_buku_besar($periode_terkini,$tgl_start,$tgl_end,$divisi_start,$divisi_end,$noacc_start,$noacc_end)->result_array();
        //$res_data       = $this->gl_model->get_data_entry_buku_besar($periode_terkini,$tgl_start,$tgl_end,$divisi_start,$divisi_end,$noacc_start,$noacc_end)->result_array();

        $data['data_entry_head']        = $this->gl_model->get_data_acct_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $data['data_entry']   = $this->gl_model->get_data_entry_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $data['data_entry_sum']   = $this->gl_model->get_data_sum_entry_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->row_array();


        ini_set('memory_limit', '200M');
        ini_set('upload_max_filesize', '200M');
        ini_set('post_max_size', '200M');
        ini_set('max_input_time', 3600);
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit", "512M");

        // Tentukan path yang tepat ke mPDF
        $this->load->library('mpdf/mpdf');
        //$result['datapiutang'] = $this->piutang_model->data()->result_array();

        // Define a Landscape page size/format by name
        $mpdf = new mPDF('utf-8', 'A4-L');
        //Memulai proses untuk menyimpan variabel php dan html
        ob_start();

        $this->load->view('cetak/gl/gl_laporan_buku_besar_view', $data);

        //$mpdf->setFooter('{PAGENO}');
        //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen . ".pdf", 'I');
        exit;
    }


    function gl_lap_bukubesar_popup($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)
    {

        $nama_dokumen = 'Laporan_GL_Jurnal_' . $tgl_start . '_' . $tgl_end . '';

        $period = $this->session->userdata('sess_periode');
        $data['tahun']  = substr($period, 0, 4);
        $data['bulan']  = substr($period, 4, 6);

        //$res_data_acct  = $this->gl_model->get_data_acct_buku_besar($periode_terkini,$tgl_start,$tgl_end,$divisi_start,$divisi_end,$noacc_start,$noacc_end)->result_array();
        //$res_data       = $this->gl_model->get_data_entry_buku_besar($periode_terkini,$tgl_start,$tgl_end,$divisi_start,$divisi_end,$noacc_start,$noacc_end)->result_array();

        $data['data_entry_head']        = $this->gl_model->get_data_acct_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $data['data_entry']   = $this->gl_model->get_data_entry_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->result_array();
        $data['data_entry_sum']   = $this->gl_model->get_data_sum_entry_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)->row_array();

        ini_set('memory_limit', '200M');
        ini_set('upload_max_filesize', '200M');
        ini_set('post_max_size', '200M');
        ini_set('max_input_time', 3600);
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit", "512M");

        $this->load->view('cetak/gl/gl_laporan_buku_besar_popup_view', $data);
    }



    function gl_lap_trialbalance_popup($periode_terkini, $param2, $param3)
    {

        //$nama_dokumen = 'Laporan_Trial_Balance_'.$periode_terkini.'';

        $thn = substr($periode_terkini, 0, 4);
        $bln = substr($periode_terkini, 4, 6);


        $data['bln'] = $bln;

        //$res_data_acct  = $this->gl_model->get_data_acct_buku_besar($periode_terkini,$tgl_start,$tgl_end,$divisi_start,$divisi_end,$noacc_start,$noacc_end)->result_array();
        //$res_data       = $this->gl_model->get_data_entry_buku_besar($periode_terkini,$tgl_start,$tgl_end,$divisi_start,$divisi_end,$noacc_start,$noacc_end)->result_array();

        //asli
        //$data['data_list']   = $this->gl_model->data_list_coa2($thn,$bln)->result_array();

        $data['data_list_assets']        = $this->gl_model->get_coa_assets($thn, $bln)->result_array();
        $data['data_list_capital']       = $this->gl_model->get_coa_capital($thn, $bln)->result_array();
        $data['data_list_expenses']      = $this->gl_model->get_coa_expenses($thn, $bln)->result_array();
        $data['data_list_liability']     = $this->gl_model->get_coa_liability($thn, $bln)->result_array();
        $data['data_list_other_expenses'] = $this->gl_model->get_coa_other_expenses($thn, $bln)->result_array();
        $data['data_list_other_revenue'] = $this->gl_model->get_coa_other_revenue($thn, $bln)->result_array();
        $data['data_list_revenue']       = $this->gl_model->get_coa_revenue($thn, $bln)->result_array();

        ini_set('memory_limit', '500M');
        ini_set('upload_max_filesize', '500M');
        ini_set('post_max_size', '500M');
        ini_set('max_input_time', 3600);
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit", "999M");

        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
        // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();

        $this->load->view('cetak/gl/gl_laporan_trialbalance_popup_view', $data);

        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;



    }

    public function cetak_coa_all($cetak)
    {

        $data['data_coa'] = $this->gl_model->get_data_coa()->result_array();

        if ($cetak == 'pdf') {
            // ini_set('memory_limit', '200M');
            // ini_set('upload_max_filesize', '200M');
            // ini_set('post_max_size', '200M');
            // ini_set('max_input_time', 3600);
            // ini_set('max_execution_time', 3600);

            // ini_set("memory_limit", "512M");

            // Tentukan path yang tepat ke mPDF
            $this->load->library('mpdf/mpdf');
            //$result['datapiutang'] = $this->piutang_model->data()->result_array();

            // Define a Landscape page size/format by name
            $mpdf = new mPDF('utf-8', 'A4-L');
            //Memulai proses untuk menyimpan variabel php dan html
            ob_start();

            $this->load->view('cetak/gl/gl_coa_pdf', $data);

            //$mpdf->setFooter('{PAGENO}');
            //penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
            $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
            ob_end_clean();
            //Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
            $mpdf->WriteHTML(utf8_encode($html));
            $mpdf->Output('COA' . ".pdf", 'I');
            exit;
        } else {
            $this->load->view('cetak/gl/gl_coa_excel', $data);
        }
    }
}
