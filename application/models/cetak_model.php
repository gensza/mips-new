<?php
class cetak_model extends CI_Model
{

    //var $dps;


    function periode()
    {
        return $this->session->userdata('sess_periode');
    }

    function get_id_lokasi()
    {
        return $this->session->userdata('sess_id_lokasi');
    }

    function lokasi()
    {
        return $this->session->userdata('sess_nama_lokasi');
    }

    function get_data_vouch_register($tgl_start, $tgl_end, $chx_periode)
    {
        //start : 01-09-2016
        //end   : 01-10-2016
        $lokasi   = $this->lokasi();


        if ($chx_periode == 1) {
            $period   = $this->periode();
            $tahun    = substr($period, 0, 4);
            $bulan    = substr($period, 4, 6);

            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,FORMAT(AMOUNT, 2) AMOUNT_F FROM head_voucher WHERE MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' and lokasi = '$lokasi'  ORDER BY `DATE` ASC";
            return $this->mips_caba->query($sql);
        } else {
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,FORMAT(AMOUNT, 2) AMOUNT_F FROM head_voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') and lokasi = '$lokasi' ORDER BY `DATE` ASC";
            return $this->mips_caba->query($sql);
        }
    }
    function sum_saldo_register($tgl_start, $tgl_end, $chx_periode)
    {
        //start : 01-09-2016
        //end   : 01-10-2016
        $lokasi   = $this->lokasi();


        if ($chx_periode == 1) {
            $period   = $this->periode();
            $tahun    = substr($period, 0, 4);
            $bulan    = substr($period, 4, 6);

            $sql = $this->mips_caba->query("SELECT SUM(AMOUNT) as jumlah FROM head_voucher WHERE MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' and lokasi = '$lokasi' ")->row();
            $isi = number_format($sql->jumlah, 2, ",", ".");
            // return $isi;
            // $isi = "GENZA";
        } else {
            $sql = $this->mips_caba->query("SELECT SUM(AMOUNT) as jumlah FROM head_voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') and lokasi = '$lokasi'")->row();
            $isi = number_format($sql->jumlah, 2, ",", ".");
        }
        // $isi = "GENZA";
        return $isi;
    }


    function get_data_vouch_journal($tgl_start, $tgl_end, $chx_periode)
    {

        $lokasi   = $this->lokasi();
        if ($chx_periode == 1) {
            $period   = $this->periode();
            $tahun    = substr($period, 0, 4);
            $bulan    = substr($period, 4, 6);

            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,DEBIT DEBET_F2,FORMAT(DEBIT, 2) DEBET_F,FORMAT(CREDIT, 2) CREDIT_F FROM voucher WHERE MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' and lokasi = '$lokasi' ORDER BY `DATE`,DEBIT DESC";
            return $this->mips_caba->query($sql);
        } else {
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,DEBIT DEBET_F2,FORMAT(DEBIT, 2) DEBET_F,FORMAT(CREDIT, 2) CREDIT_F FROM voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') and lokasi = '$lokasi' ORDER BY `DATE`,DEBIT DESC";
            return $this->mips_caba->query($sql);
        }
    }

    function sum_saldo_jurnal($tgl_start, $tgl_end, $chx_periode)
    {
        $lokasi   = $this->lokasi();
        if ($chx_periode == 1) {
            $period   = $this->periode();
            $tahun    = substr($period, 0, 4);
            $bulan    = substr($period, 4, 6);

            $sql = "SELECT SUM(DEBIT) AS debit, SUM(CREDIT) AS credit FROM voucher WHERE MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' and lokasi = '$lokasi'";
            $isi = $this->mips_caba->query($sql)->row();
        } else {
            $sql = "SELECT SUM(DEBIT) AS debit, SUM(CREDIT) AS credit FROM voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') and lokasi = '$lokasi'";
            $isi = $this->mips_caba->query($sql)->row();
        }
        $data = [
            'debit' => number_format($isi->debit, 2, ",", "."),
            'credit' => number_format($isi->credit, 2, ",", ".")

        ];

        return $data;
        # code...
    }

    function get_data_vouch_register_head_2($tgl_start, $tgl_end, $chx_periode)
    {

        $lokasi   = $this->lokasi();
        if ($chx_periode == 1) {
            $period   = $this->periode();
            $tahun    = substr($period, 0, 4);
            $bulan    = substr($period, 4, 6);

            $sql = "SELECT VOUCNO,SUM(DEBIT) AS DBT_NF,FORMAT(SUM(DEBIT), 2) DBT,FORMAT(SUM(CREDIT), 2) KRD,SUM(CREDIT) KRD_NF FROM voucher WHERE MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' and lokasi = '$lokasi'  GROUP BY VOUCNO ORDER BY `DATE` ASC ";
            return $this->mips_caba->query($sql);
        } else {

            $sql = "SELECT VOUCNO,SUM(DEBIT) AS DBT_NF,FORMAT(SUM(DEBIT), 2) DBT,FORMAT(SUM(CREDIT), 2) KRD,SUM(CREDIT) KRD_NF FROM voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y')  GROUP BY VOUCNO ORDER BY `DATE` ASC ";
            return $this->mips_caba->query($sql);
        }
    }

    function get_data_vouch_register_head($tgl_start, $tgl_end)
    {
        //start : 01-09-2016
        //end   : 01-10-2016
        /*$sql = "SELECT DISTINCT VOUCNO FROM voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND VOUCNO IN('EBM001','EBM002') GROUP BY VOUCNO ORDER BY `DATE` ASC ";*/

        $sql = "SELECT VOUCNO,SUM(DEBIT) AS DBT_NF,FORMAT(SUM(DEBIT), 2) DBT,FORMAT(SUM(CREDIT), 2) KRD,SUM(CREDIT) KRD_NF FROM voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y')  GROUP BY VOUCNO ORDER BY `DATE` ASC ";

        //$sql = "SELECT *,FORMAT(AMOUNT, 2) AMOUNT_F FROM head_voucher";
        return $this->mips_caba->query($sql);
    }


    function get_data_vouc_header_detail($no_vouc, $id_vouc, $txtperiode)
    {

        $tahun  = substr($txtperiode, 0, 4);
        $bulan  = substr($txtperiode, 4, 6);

        $sql = "SELECT *,FORMAT(SUM(AMOUNT), 2) as amount, DATE_FORMAT(`DATE`, '%d-%m-%Y') as TGL FROM head_voucher WHERE ID = '$id_vouc' AND VOUCNO = '$no_vouc' AND MONTH(`DATE`) = '$bulan' AND YEAR(`DATE`) = '$tahun' ";

        return $this->mips_caba->query($sql);
    }

    function get_trans_cb_vou($coa, $no_vouc, $txtperiode)
    {

        $period = $this->periode();

        $tahun  = substr($txtperiode, 0, 4);
        $bulan  = substr($txtperiode, 4, 6);
        //OLD
        $sql = "SELECT a.*,
        DATE_FORMAT(a.`DATE`, '%d-%m-%Y') TGL,
        a.DEBIT DEBET_F2,
        FORMAT(a.DEBIT, 2) DEBET_F,
        FORMAT(a.CREDIT, 2) CREDIT_F, 
        a.DEBIT AS DEBET_NO_F,
        a.CREDIT AS CREDIT_NO_F,
        a.ACCTNO AS DT_ACCTNO,
                        a.JENIS AS HV_JENIS,
                        a.ACCTNO AS HV_ACCTNO
                        FROM voucher AS a
                        WHERE a.VOUCNO = '$no_vouc' AND MONTH(a.`date`) = '$bulan' AND YEAR(a.`date`) = '$tahun' AND ACCTNO <> '$coa' ORDER BY a.ID ASC";

        /* NEW BY ALI */


        return $this->mips_caba->query($sql);
    }
    function isi_trans_cb_vou($no_vouc, $txtperiode)
    {

        $period = $this->periode();

        $tahun  = substr($txtperiode, 0, 4);
        $bulan  = substr($txtperiode, 4, 6);
        //OLD
        $sql = "SELECT * FROM voucher WHERE VOUCNO = '$no_vouc' AND MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun'  ORDER BY ID ASC";

        /* NEW BY ALI */
        return $this->mips_caba->query($sql);
    }

    function get_data_vouc_list_detail_dr($no_vouc, $txtperiode)
    {

        $period = $this->periode();

        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 6);

        $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,DEBIT DEBET_F2,FORMAT(DEBIT, 2) DEBET_F,FORMAT(CREDIT, 2) CREDIT_F FROM voucher WHERE VOUCNO = '$no_vouc' AND MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' AND DEBIT != 0 AND CREDIT = 0 ORDER BY ID DESC";

        return $this->mips_caba->query($sql);
    }

    function get_data_vouc_list_detail_cr($no_vouc, $txtperiode)
    {

        $period = $this->periode();

        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 6);

        $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,DEBIT DEBET_F2,FORMAT(DEBIT, 2) DEBET_F,FORMAT(CREDIT, 2) CREDIT_F FROM voucher WHERE VOUCNO = '$no_vouc' AND MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' AND CREDIT != 0 and DEBIT = 0  ORDER BY ID DESC";

        return $this->mips_caba->query($sql);
    }

    function get_list_saldo_akhir($bln, $tahun)
    {

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

        $sql = "SELECT id,ACCTNO,SITENO,ACCTNAME,saldo as saldo_master_f, saldo_$var_bulan as saldo_f FROM saldo_voucher WHERE thn = '$tahun'";
        return $this->mips_caba->query($sql);
    }

    function get_saldo_awal($coa)
    {
        $period = $this->periode();

        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 6);
        $cek = $this->mips_caba->query("SELECT ACCTNO FROM voucher WHERE ACCTNO='$coa' AND MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun'")->num_rows();
        if ($cek > 0) {
            # code...
            return $this->mips_caba->query("SELECT saldo FROM master_accountcb WHERE ACCTNO='$coa' ")->row();
        } else {
            return "alidev";
            # code...
        }
    }

    function get_list_saldo_akhir_aktifitas_account($accn)
    {

        $period   = $this->periode();
        $lokasi   = $this->get_id_lokasi();
        $tahun    = substr($period, 0, 4);

        if ($accn != '0') {
            # code...
            $sql = "SELECT * FROM master_accountcb WHERE ACCTNO='$accn' AND SITENO='$lokasi' AND thn = '$tahun'";
        } else {
            # code...
            $sql = "SELECT * FROM master_accountcb WHERE SITENO='$lokasi' AND thn = '$tahun'";
        }


        return $this->mips_caba->query($sql);
    }
    function get_list_saldo_akhir_lpj($dt)
    {

        $lokasi   = $this->get_id_lokasi();
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
        $sql = "SELECT ACCTNAME, saldo_$var_bulan as saldonya FROM master_accountcb WHERE ACCTNO='$dt' AND SITENO='$lokasi' AND thn = '$tahun'";
        return $this->mips_caba->query($sql);
    }
    function get_list_bank($coa)
    {
        $mandiri = "100105030000000";
        $bri = "100105110000000";

        $lokasi   = $this->get_id_lokasi();
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
        if ($coa == 0) {
            # code...
            $sql = "SELECT ACCTNO, ACCTNAME, saldo_$var_bulan as saldonya FROM master_accountcb WHERE ACCTNO IN ('$mandiri','$bri') AND SITENO='$lokasi' AND thn = '$tahun'";
            return $this->mips_caba->query($sql);
        } else {
            $sql = "SELECT ACCTNO, ACCTNAME, saldo_$var_bulan as saldonya FROM master_accountcb WHERE ACCTNO ='$coa' AND SITENO='$lokasi' AND thn = '$tahun'";
            return $this->mips_caba->query($sql);
            # code...
        }
    }


    function get_data_aktifitas_account($accn, $tgl_start, $tgl_end)
    {
        $lokasi   = $this->lokasi();

        if ($accn != '0') {
            # code...
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT CREDIT_F2,DEBIT DEBET_F2,FORMAT(DEBIT, 2) DEBET_F,FORMAT(CREDIT, 2) CREDIT_F FROM voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi' AND ACCTNO='$accn' ORDER BY `DATE`,DEBIT DESC";
        } else {
            # code...
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT CREDIT_F2,DEBIT DEBET_F2,FORMAT(DEBIT, 2) DEBET_F,FORMAT(CREDIT, 2) CREDIT_F FROM voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi' ORDER BY `DATE`,DEBIT DESC";
        }
        return $this->mips_caba->query($sql);
    }

    function sum_saldo_accn($accn, $tgl_start, $tgl_end)
    {
        $lokasi   = $this->lokasi();

        if ($accn != 0) {
            # code...
            $sql = "SELECT SUM(DEBIT) AS debit, SUM(CREDIT) AS credit FROM voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi' AND ACCTNO='$accn'";
            $isi = $this->mips_caba->query($sql)->row();
            // $isi = "Hello 1";
        } else {
            # code...
            $sql = "SELECT SUM(DEBIT) AS debit, SUM(CREDIT) AS credit FROM voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi'";
            // $isi = "Hello 2";
            $isi = $this->mips_caba->query($sql)->row();
        }

        $data = [
            'debit' => number_format($isi->debit, 2, ",", "."),
            'credit' => number_format($isi->credit, 2, ",", ".")

        ];

        return $data;
        // return $isi;
        # code...
    }

    function get_data_lpj($sumber, $coa, $tgl_start, $tgl_end)
    {
        $lokasi   = $this->lokasi();

        if ($sumber == '0') {
            # code...
<<<<<<< HEAD
            $sql = "SELECT * FROM `head_voucher` WHERE LOKASI = '$lokasi' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y')  ORDER BY `DATE`,`VOUCNO` ASC";
        } else {
            # code...

            $sql = "SELECT * FROM `head_voucher` WHERE `ACCTNO` LIKE '$coa' AND LOKASI = '$lokasi' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y')  ORDER BY `DATE`,`VOUCNO` ASC";
=======
            $sql = "SELECT * FROM `head_voucher` WHERE LOKASI = '$lokasi' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y')  ORDER BY `DATE` ASC";
        } else {
            # code...
            // $sql = "SELECT * FROM head_voucher WHERE ACCTNO LIKE '$coa' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi' AND PDO='$sumber' ORDER BY `DATE` ASC";
            $sql = "SELECT * FROM `head_voucher` WHERE `ACCTNO` LIKE '$coa' AND LOKASI = '$lokasi' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND PDO='$sumber' ORDER BY `DATE` ASC";
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777
        }

        return $this->mips_caba->query($sql);
    }
    function get_lpj($coa, $tgl_start, $tgl_end)
    {
        $lokasi   = $this->lokasi();
        // $sql = "SELECT * FROM head_voucher WHERE ACCTNO LIKE '$coa' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi' AND PDO='$sumber' ORDER BY `DATE` ASC";
<<<<<<< HEAD
        $sql = "SELECT * FROM `voucher` WHERE `ACCTNO` LIKE '$coa' AND LOKASI = '$lokasi' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') ORDER BY `DATE`,`VOUCNO` ASC";
=======
        $sql = "SELECT * FROM `voucher` WHERE `ACCTNO` LIKE '$coa' AND LOKASI = '$lokasi' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') ORDER BY `DATE` ASC";
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777
        return $this->mips_caba->query($sql);
    }


    public function get_data_lpj_all($tgl_start, $tgl_end)
    {
        $lokasi   = $this->lokasi();
        if ($lokasi == 'ESTATE') {
            $remise = '100101031000000';
            $pddo = '100101030500000';
            $kontanan = '100101031500000';
            $grtt = '100101032000000';
            $gaji = '100101030100000';

<<<<<<< HEAD
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO IN ('$remise','$pddo', '$kontanan', '$grtt', '$gaji') AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi'  ORDER BY `DATE`,`VOUCNO` ASC";
=======
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO IN ('$remise','$pddo', '$kontanan', '$grtt', '$gaji') AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi'  ORDER BY `DATE` ASC";
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777
        } else if ($lokasi == 'PKS') {
            $remise = '100101041000000';
            $pddo = '100101040500000';
            $gaji = '100101040100000';

<<<<<<< HEAD
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO IN ('$remise','$pddo', '$gaji') AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi'  ORDER BY `DATE`,`VOUCNO` ASC";
=======
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO IN ('$remise','$pddo', '$gaji') AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi'  ORDER BY `DATE` ASC";
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777
            # code...
        } else {
            $remise = '100101031000000';
            $pddo = '100101030500000';
            $kontanan = '100101031500000';
            $grtt = '100101032000000';
            $gaji = '100101030100000';

<<<<<<< HEAD
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO IN ('$remise','$pddo', '$kontanan', '$grtt', '$gaji') AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi'  ORDER BY `DATE`,`VOUCNO` ASC";
=======
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO IN ('$remise','$pddo', '$kontanan', '$grtt', '$gaji') AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi'  ORDER BY `DATE` ASC";
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777
            # code...
        }

        return $this->mips_caba->query($sql);
        # code...
    }

    function get_list_all_lpj()
    {
        $lokasi   = $this->get_id_lokasi();
        $period = $this->session->userdata('sess_periode');
        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 5);

        $lok   = $this->lokasi();

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


        if ($lok == 'ESTATE') {
            $remise = '100101031000000';
            $pddo = '100101030500000';
            $kontanan = '100101031500000';
            $grtt = '100101032000000';
            $gaji = '100101030100000';

            $sql = "SELECT ACCTNO, ACCTNAME, saldo_$var_bulan as saldonya FROM master_accountcb WHERE ACCTNO IN ('$remise','$pddo', '$kontanan', '$grtt', '$gaji') AND SITENO='$lokasi' AND thn = '$tahun'";
            return $this->mips_caba->query($sql);
        } else if ($lok == 'PKS') {
            $remise = '100101041000000';
            $pddo = '100101040500000';
            $gaji = '100101040100000';

            $sql = "SELECT ACCTNO, ACCTNAME, saldo_$var_bulan as saldonya FROM master_accountcb WHERE ACCTNO IN ('$remise','$pddo', '$gaji') AND SITENO='$lokasi' AND thn = '$tahun'";
            # code...
            return $this->mips_caba->query($sql);
        } else {
            $remise = '100101031000000';
            $pddo = '100101030500000';
            $kontanan = '100101031500000';
            $grtt = '100101032000000';
            $gaji = '100101030100000';
            # code...

            $sql = "SELECT ACCTNO, ACCTNAME, saldo_$var_bulan as saldonya FROM master_accountcb WHERE ACCTNO IN ('$remise','$pddo', '$kontanan', '$grtt', '$gaji') AND SITENO='$lokasi' AND thn = '$tahun'";
            return $this->mips_caba->query($sql);
        }
    }


    function get_data_bank($coa, $tgl_start, $tgl_end)
    {
        $mandiri = "100105030000000";
        $bri = "100105110000000";
        $lokasi   = $this->lokasi();
        if ($coa == 0) {
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO IN ('$mandiri','$bri') AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi'  ORDER BY `DATE` ASC";
        } else {
            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO ='$coa' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi'  ORDER BY `DATE` ASC";
        }

        return $this->mips_caba->query($sql);
    }

    function get_data_lpj_vou($sumber, $coa, $tgl_start, $tgl_end)
    {
        $lokasi   = $this->lokasi();
<<<<<<< HEAD
        $sql = "SELECT * FROM voucher WHERE ACCTNO='$coa' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi' AND sumber = '$sumber' ORDER BY `DATE`,`VOUCNO` ASC";
=======
        $sql = "SELECT * FROM voucher WHERE ACCTNO='$coa' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi' AND sumber = '$sumber' ORDER BY `DATE` DESC";
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777
        return $this->mips_caba->query($sql);
    }
    function get_data_bank_vou($coa, $tgl_start, $tgl_end)
    {
        $lokasi   = $this->lokasi();
        $mandiri = "100105030000000";
        $bri = "100105110000000";

        if ($coa == 0) {
            # code...
            $sql = "SELECT * FROM voucher WHERE ACCTNO IN ('$mandiri','$bri') AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi' ORDER BY `DATE` DESC";
        } else {
            # code...
            $sql = "SELECT * FROM voucher WHERE ACCTNO='$coa' AND DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND LOKASI = '$lokasi' ORDER BY `DATE` DESC";
        }

        return $this->mips_caba->query($sql);
    }

    function get_vocer($coa)
    {
        $period = $this->periode();

        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 5);
        return $this->mips_caba->query("SELECT ACCTNO FROM voucher WHERE ACCTNO='$coa' AND MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' ")->num_rows();
    }
    function get_dc($coa)
    {
        $lokasi   = $this->lokasi();
        $period = $this->periode();

        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 5);
        return $this->mips_caba->query("SELECT SUM(DEBIT) AS totaldr, SUM(CREDIT) AS totalcr FROM voucher WHERE ACCTNO='$coa' AND MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' AND LOKASI = '$lokasi'")->row();
    }
    function saldo_awal($coa)
    {
        $period = $this->periode();
        $lokasi   = $this->get_id_lokasi();
        $tahun  = substr($period, 0, 4);
        return $this->mips_caba->query("SELECT saldo FROM master_accountcb WHERE SITENO='$lokasi' AND ACCTNO='$coa' AND thn ='$tahun'")->row();
    }
}
