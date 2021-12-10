<?php
class Cetak_model extends CI_Model
{

    //var $dps;

    function __construct()
    {
        parent::__construct();
        $this->mips_gl  = $this->load->database('mips_gl', TRUE);
        $this->mips_caba = $this->load->database('mips_caba', TRUE);
    }

    function periode()
    {
        return $this->session->userdata('sess_periode');
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

        $sql = "SELECT *,FORMAT(SUM(AMOUNT), 2) amount,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL FROM head_voucher WHERE id = '$id_vouc' and VOUCNO = '$no_vouc' AND MONTH(`DATE`) = '$bulan' AND YEAR(`DATE`) = '$tahun'";

        return $this->mips_caba->query($sql);
    }

    function get_trans_cb_vou($no_vouc, $txtperiode)
    {

        $period = $this->periode();

        $tahun  = substr($txtperiode, 0, 4);
        $bulan  = substr($txtperiode, 4, 6);

        $sql = "SELECT a.*,
                        DATE_FORMAT(a.`DATE`, '%d-%m-%Y') TGL,
                        a.DEBIT DEBET_F2,
                        FORMAT(a.DEBIT, 2) DEBET_F,
                        FORMAT(a.CREDIT, 2) CREDIT_F, 
                        a.DEBIT AS DEBET_NO_F,
                        a.CREDIT AS CREDIT_NO_F,
                        a.ACCTNO AS DT_ACCTNO,
                        b.JENIS AS HV_JENIS,
                        b.ACCTNO AS HV_ACCTNO
                        FROM voucher AS a
                        INNER JOIN head_voucher AS b ON a.VOUCNO = b.VOUCNO
                        WHERE a.VOUCNO = '$no_vouc' AND MONTH(a.`date`) = '$bulan' AND YEAR(a.`date`) = '$tahun' ORDER BY a.ID ASC";

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

        $sql = "SELECT id,ACCTNO,SITENO,ACCTNAME,FORMAT(saldo, 2) saldo_master_f,FORMAT(saldo_" . $var_bulan . ", 2) saldo_f FROM saldo_voucher WHERE thn = $tahun";
        return $this->mips_caba->query($sql);
    }


    function get_list_saldo_akhir_aktifitas_account()
    {

        $period   = $this->periode();
        $tahun    = substr($period, 0, 4);

        $sql = "SELECT * FROM saldo_voucher WHERE thn = '$tahun'";
        return $this->mips_caba->query($sql);
    }


    function get_data_aktifitas_account($tgl_start, $tgl_end)
    {
        $lokasi   = $this->lokasi();
        // $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT CREDIT_F2,DEBIT DEBET_F2,FORMAT(DEBIT, 2) DEBET_F,FORMAT(CREDIT, 2) CREDIT_F FROM voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') and lokasi = '$lokasi' ORDER BY `DATE`,DEBIT DESC";
        $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT CREDIT_F2,DEBIT DEBET_F2,FORMAT(DEBIT, 2) DEBET_F,FORMAT(CREDIT, 2) CREDIT_F FROM voucher WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND lokasi = '$lokasi' ORDER BY `DATE`,DEBIT DESC";
        return $this->mips_caba->query($sql);
    }
}
