<?php
class Gl_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $this->mips_gl = $this->load->database('mips_gl', TRUE);
        //$this->mstcode = $this->load->database('mstcode', TRUE);

    }

    function get_id_lokasi()
    {
        return $this->session->userdata('sess_id_lokasi');
    }

    function get_nama_lokasi()
    {
        return $this->session->userdata('sess_nama_lokasi');
    }

    function get_sess_pt()
    {
        return $this->session->userdata('sess_pt');
    }

    function set_filter_year()
    {

        $field = "AND (saldo01c <> 0 OR saldo01d <> 0  
                    OR saldo02c <> 0 AND saldo02d <> 0 
                    OR saldo03c <> 0 AND saldo03d <> 0
                    OR saldo04c <> 0 AND saldo04d <> 0
                    OR saldo05c <> 0 AND saldo05d <> 0
                    OR saldo06c <> 0 AND saldo06d <> 0
                    OR saldo07c <> 0 AND saldo07d <> 0
                    OR saldo08c <> 0 AND saldo08d <> 0
                    OR saldo09c <> 0 AND saldo09d <> 0
                    OR saldo10c <> 0 AND saldo10d <> 0
                    OR saldo11c <> 0 AND saldo11d <> 0
                    OR saldo12c <> 0 AND saldo12d <> 0
                    OR yearc <> 0
                    OR yeard <> 0)";
        return $field;
    }

    function set_filter_nol()
    {

        $field = "AND (saldo01c <> 0 OR saldo02c <> 0 OR saldo03c <> 0 OR saldo04c <> 0 OR saldo05c <> 0 OR saldo06c <> 0 OR saldo07c <> 0 OR saldo08c <> 0 OR saldo09c <> 0 OR saldo10c <> 0 OR saldo11c <> 0 OR saldo12c <> 0) AND (saldo01d <> 0 OR saldo02d <> 0 OR saldo03d <> 0 OR saldo04d <> 0 OR saldo05d <> 0 OR saldo06d <> 0 OR saldo07d <> 0 OR saldo08d <> 0 OR saldo09d <> 0 OR saldo10d <> 0 OR saldo11d <> 0 OR saldo12d <> 0)";
        return $field;
    }


    function set_filter_year_expensis()
    {

        $field = "AND (saldo01c <> 0 OR saldo01d <> 0  
                    OR saldo02c <> 0 OR saldo02d <> 0 
                    OR saldo03c <> 0 OR saldo03d <> 0
                    OR saldo04c <> 0 OR saldo04d <> 0
                    OR saldo05c <> 0 OR saldo05d <> 0
                    OR saldo06c <> 0 OR saldo06d <> 0
                    OR saldo07c <> 0 OR saldo07d <> 0
                    OR saldo08c <> 0 OR saldo08d <> 0
                    OR saldo09c <> 0 OR saldo09d <> 0
                    OR saldo10c <> 0 OR saldo10d <> 0
                    OR saldo11c <> 0 OR saldo11d <> 0
                    OR saldo12c <> 0 OR saldo12d <> 0
                    OR yearc <> 0
                    OR yeard <> 0)";
        return $field;
    }

    function cek_balance_entry()
    {

        $lokasi  = $this->get_nama_lokasi();

        $period = $this->periode();

        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 6);

        $sql = "SELECT SUM(cr) cr_non_ff ,FORMAT(SUM(cr), 2) cr_ff FROM entry WHERE lokasi = '$lokasi' AND MONTH(periode) = '$bulan' AND YEAR(periode) = '$tahun'";
        return $this->mips_gl->query($sql);
    }

    function data_list_coa($thn, $bln)
    {
        //`type` = 'D' AND 
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        yeard,
                        yearc 
                 FROM noac WHERE  ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }

    function data_list_coa2($thn, $bln)
    {
        //`type` = 'D' AND 
        //noac <> '5030000000'
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        yeard,
                        yearc,
                        `group`,
                        `type`
                 FROM noac ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }

    function user_id()
    {
        return $this->session->userdata('sess_id');
    }

    function periode()
    {
        return $this->session->userdata('sess_periode');
    }

    function lokasi()
    {

        $sess_lok = $this->session->userdata('sess_lokasi');
        $sql  = "SELECT nama,value FROM codegroup where group_n = 'LOKASI_USERS' and value = '$sess_lok'";
        $data =  $this->db->query($sql)->row_array();
        return $data['nama'];
    }

    function gl_transaksi_simpan($data)
    {

        $noacc          = str_replace(".", "", $data['acctno']);

        //ini untuk ambil data ke master noac
        $sqls = "SELECT  sbu,
                    `group`,
                    `type`,
                    `level`,
                    general
                FROM noac WHERE noac = '$noacc'";
        $dt = $this->mips_gl->query($sqls)->row_array();

        if ($data['dc'] == 'C') {
            $nominal_dr = '0';
            $nomin_cr   = str_replace(",", "", $data['dc_nominal']);
            //$nomin_cr_f = str_replace(".","",$nomin_cr);
            $nominal_cr = $nomin_cr;
        } else {
            $nomin_dr   = str_replace(",", "", $data['dc_nominal']);
            //$nomin_dr_f = str_replace(".","",$nomin_dr);
            $nominal_dr = $nomin_dr;
            $nominal_cr = '0';
        }

        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $sess_lokasi = $this->get_nama_lokasi();

        $tgl_ymd = date('Y-m-d', strtotime($data['tanggal']));
        $today = date('Y-m-d');

        $entry_temp['ref'] = $data['no_ref'];
        $entry_temp['noref'] = $data['kode_sementara'];
        $entry_temp['noac'] = $noacc;
        $entry_temp['descac'] = $data['acctname'];
        $entry_temp['dc'] = $data['dc'];
        $entry_temp['dr'] = $nominal_dr;
        $entry_temp['cr'] = $nominal_cr;
        $entry_temp['date'] = $tgl_ymd;
        $entry_temp['periode'] = $tgl_ymd;
        $entry_temp['ket'] = $data['deskripsi'];
        $entry_temp['periodetxt'] = $tgltxt;
        $entry_temp['tglinput'] = $today;
        $entry_temp['sbu'] = $dt['sbu'];
        $entry_temp['group'] = $dt['group'];
        $entry_temp['type'] = $dt['type'];
        $entry_temp['level'] = $dt['level'];
        $entry_temp['general'] = $dt['general'];
        $entry_temp['lokasi'] = $sess_lokasi;
        $entry_temp['kurs'] = $data['dc_kurs'];

        return $this->mips_gl->insert('entry_temp', $entry_temp);
    }


    function gl_transaksi_simpan_dollar($data)
    {

        $noacc          = str_replace(".", "", $data['acctno']);

        //ini untuk ambil data ke master noac
        $sqls = "SELECT  sbu,
                        `group`,
                        `type`,
                        `level`,
                        general
                    FROM noac WHERE noac = '$noacc'";
        $dt = $this->mips_gl->query($sqls)->row_array();


        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $todaya = date("Y-m-d");

        $sql11 = "SELECT rate FROM kursrate WHERE STR_TO_DATE(tgl, '%Y-%m-%d') = '$todaya'";
        $ret = $this->mips_gl->query($sql11)->row_array();

        $krs_rate = $ret['rate'];
        $krs_tgl  = $ret['tgl'];

        if ($data['dc'] == 'C') {
            $nominal_dr = '0';
            $nomin_cr   = str_replace(",", "", $data['dc_nominal']);
            $nomin_cr_f = $nomin_cr * $ret['rate'];
            $nominal_cr = $nomin_cr_f;
        } else {
            $nomin_dr   = str_replace(",", "", $data['dc_nominal']);
            $nomin_dr_f = $nomin_dr * $ret['rate'];
            $nominal_dr = $nomin_dr_f;
            $nominal_cr = '0';
        }

        $sess_lokasi = $this->get_nama_lokasi();

        $sql = "INSERT INTO entry_temp (ref,noref,
                                    noac,
                                    `descac`,
                                    dc,
                                    dr,
                                    cr,
                                    `date`,
                                    periode,
                                    ket,
                                    periodetxt,
                                    tglinput,
                                    sbu,
                                    `group`, 
                                    `type`,
                                    `level`,
                                    general,
                                    kurs,
                                    kursrate,
                                    tglkurs,
                                    lokasi) 
                            VALUES ('$data[no_ref]',
                                    '$data[kode_sementara]',
                                    '$noacc',
                                    '$data[acctname]',
                                    '$data[dc]',
                                    '$nominal_dr',
                                    '$nominal_cr',
                                    STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                    STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                    '$data[deskripsi]',
                                    '$tgltxt',
                                    NOW(),
                                    '$dt[sbu]',
                                    '$dt[group]',
                                    '$dt[type]',
                                    '$dt[level]',
                                    '$dt[general]','$data[dc_kurs]',$krs_rate,'$krs_tgl','$sess_lokasi')";

        return $this->mips_gl->query($sql);
    }


    function transaksi_data_detail($data)
    {

        $sql = "SELECT *,FORMAT(dr, 2) dr_f,FORMAT(cr, 2) cr_f,DATE_FORMAT(date, '%d-%m-%Y') date_f FROM entry_temp WHERE noref = '$data[kode_sementara]'";
        return $this->mips_gl->query($sql);
    }

    function transaksi_data_detail_edit($data)
    {

        $period = $this->periode();

        $sql = "SELECT *,FORMAT(dr, 2) dr_f,FORMAT(cr, 2) cr_f,DATE_FORMAT(DATE, '%d-%m-%Y') date_f FROM entry WHERE ref = '$data[no_ref]' AND  SUBSTR(periodetxt,1,6) = '$period'";

        return $this->mips_gl->query($sql);
    }

    function transaksi_total_credit($data)
    {

        $sql = "SELECT SUM(cr) cr_non_ff ,FORMAT(SUM(cr), 2) cr_ff FROM entry_temp WHERE noref = '$data[kode_sementara]'";
        return $this->mips_gl->query($sql);
    }


    function cek_noref($data)
    {
        $sql = "SELECT COUNT(ref) AS refs FROM header_entry WHERE ref = '$data[no_ref]'";
        return $this->mips_gl->query($sql);
    }


    function transaksi_total_debit($data)
    {

        $sql = "SELECT SUM(dr) dr_non_ff ,FORMAT(SUM(dr), 2) dr_ff FROM entry_temp WHERE noref = '$data[kode_sementara]'";
        return $this->mips_gl->query($sql);
    }

    function cek_kurs_rate($data)
    {
        $sql = "SELECT COUNT(*) as kurs FROM kursrate WHERE STR_TO_DATE(tgl, '%Y-%m-%d') = '$data[tglhariini]'";
        return $this->mips_gl->query($sql);
    }

    function transaksi_update_kurs($data)
    {

        $data['kurs_nominal']     = $this->input->post('kurs_nominal', TRUE);
        $data['tgl_kurs_todays']  = $this->input->post('tgl_kurs_todays', TRUE);

        $kursd   = str_replace(",", "", $data['kurs_nominal']);

        $sql1 = "SELECT COUNT(*) as kurs FROM kursrate WHERE STR_TO_DATE(tgl, '%Y-%m-%d') = '$data[tgl_kurs_todays]'";
        $ret = $this->mips_gl->query($sql1)->row_array();


        if ($ret['kurs'] == 0) {
            $sql2 = "INSERT INTO kursrate (kode,rate,tgl) VALUES ('$',$kursd','$data[tgl_kurs_todays]')";
            return $this->mips_gl->query($sql2);
        } else {
            $sql3 = "UPDATE kursrate SET rate  = '$kursd', tgl = '$data[tgl_kurs_todays]' where ";
            $this->mips_caba->query($sql3);
        }
    }


    function transaksi_simpan_all($data)
    {

        // ini select dulu ke table tmp , lalu insert ke table voucher dengan fungsi insert batch
        // $sql2 = "SELECT date, sbu, noac, desc, group, type, level, general, dc, dr, cr, periode, converse, ref,  noref, descac, ketbegindr, begincr, kurs, kursrate, tglkurs, periodetxt, module, lokasi, POST, tglinput, USER FROM entry_temp where noref = '$data[kode_sementara]'";
        $this->mips_gl->select('date, sbu, noac, desc, group, type, level, general, dc, dr, cr, periode, converse, ref,  noref, descac, ket, begindr, begincr, kurs, kursrate, tglkurs, periodetxt, module, lokasi, POST, tglinput, USER');
        $this->mips_gl->from('entry_temp');
        $n = $this->mips_gl->get()->result_array();
        // fungsi insert batch
        $this->mips_gl->insert_batch('entry', $n);

        //hapus yang ada di table voucher tmp
        $sql3 = "DELETE FROM entry_temp WHERE noref = '$data[kode_sementara]'";
        $this->mips_gl->query($sql3);


        $sql88 = "UPDATE entry SET noref  = 'NULL' , ref = '$data[no_ref]' WHERE noref = '$data[kode_sementara]'";
        $this->mips_gl->query($sql88);

        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $sess_lokasi = $this->get_nama_lokasi();

        $tgl_ymd = date('Y-m-d', strtotime($data['tanggal']));

        $header_entry["date"] = $tgl_ymd;
        $header_entry["periode"] = $tgl_ymd;
        $header_entry["ref"] = $data['no_ref'];
        $header_entry["totaldr"] = $data['totaldr'];
        $header_entry["totalcr"] = $data['totalcr'];
        $header_entry["lokasi"] = $sess_lokasi;
        $header_entry["periodetxt"] = $tgltxtperiode;

        return $this->mips_gl->insert('header_entry', $header_entry);
    }


    function get_trans_gl_detail($data)
    {

        $sql = "SELECT  *,
                        FORMAT(cr, 2) cr_f,
                        FORMAT(dr, 2) dr_f,
                        CONCAT(SUBSTR(noac,1,2), '.', SUBSTR(noac,3,2), '.', SUBSTR(noac,5,2), '.', SUBSTR(noac,7,2), '.', SUBSTR(noac,9,2))  AS kode_noac 
                FROM entry_temp WHERE noid = '$data[noid]'";
        return $this->mips_gl->query($sql);
    }

    function get_trans_gl_detail2($data)
    {

        $sql = "SELECT  *,
                        FORMAT(cr, 2) cr_f,
                        FORMAT(dr, 2) dr_f,
                        CONCAT(SUBSTR(noac,1,2), '.', SUBSTR(noac,3,2), '.', SUBSTR(noac,5,2), '.', SUBSTR(noac,7,2), '.', SUBSTR(noac,9,2))  AS kode_noac 
                FROM entry WHERE noid = '$data[noid]'";
        return $this->mips_gl->query($sql);
    }


    function gl_transaksi_update($data)
    {

        $noacc          = str_replace(".", "", $data['acctno']);

        //ini untuk ambil data ke master noac
        $sqls = "SELECT  sbu,
                        `group`,
                        `type`,
                        `level`,
                        general
                    FROM noac WHERE noac = '$noacc'";
        $dt = $this->mips_gl->query($sqls)->row_array();



        if ($data['dc'] == 'C') {
            $nominal_dr = '0';
            $nomin_cr   = str_replace(",", "", $data['dc_nominal']);
            //$nomin_cr_f = str_replace(".","",$nomin_cr);
            $nominal_cr = $nomin_cr;
        } else {
            $nomin_dr   = str_replace(",", "", $data['dc_nominal']);
            //$nomin_dr_f = str_replace(".","",$nomin_dr);
            $nominal_dr = $nomin_dr;
            $nominal_cr = '0';
        }

        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $sess_lokasi = $this->get_nama_lokasi();

        $sql = "UPDATE entry_temp SET   noac   = '$noacc',
                                        `descac` = '$data[acctname]',
                                        dc     = '$data[dc]',
                                        dr     = '$nominal_dr',
                                        cr     = '$nominal_cr',
                                        ket    = '$data[deskripsi]',
                                        sbu    = '$dt[sbu]',
                                        `group`= '$dt[group]', 
                                        `type` = '$dt[type]',
                                        `level`= '$dt[level]',
                                        general= '$dt[general]',
                                        lokasi = '$sess_lokasi',
                                        kurs   = '$data[dc_kurs]'
                                    WHERE noid = '$data[id_entry]'";

        return $this->mips_gl->query($sql);
    }


    function gl_transaksi_update2($data)
    {

        $noacc          = str_replace(".", "", $data['acctno']);

        //ini untuk ambil data ke master noac
        $sqls = "SELECT  sbu,
                        `group`,
                        `type`,
                        `level`,
                        general
                    FROM noac WHERE noac = '$noacc'";
        $dt = $this->mips_gl->query($sqls)->row_array();



        if ($data['dc'] == 'C') {
            $nominal_dr = '0';
            $nomin_cr   = str_replace(",", "", $data['dc_nominal']);
            //$nomin_cr_f = str_replace(".","",$nomin_cr);
            $nominal_cr = $nomin_cr;
        } else {
            $nomin_dr   = str_replace(",", "", $data['dc_nominal']);
            //$nomin_dr_f = str_replace(".","",$nomin_dr);
            $nominal_dr = $nomin_dr;
            $nominal_cr = '0';
        }

        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $sess_lokasi = $this->get_nama_lokasi();

        $sql = "UPDATE entry SET   noac   = '$noacc',
                                        `descac` = '$data[acctname]',
                                        dc     = '$data[dc]',
                                        dr     = '$nominal_dr',
                                        cr     = '$nominal_cr',
                                        ket    = '$data[deskripsi]',
                                        sbu    = '$dt[sbu]',
                                        `group`= '$dt[group]', 
                                        `type` = '$dt[type]',
                                        `level`= '$dt[level]',
                                        general= '$dt[general]',
                                        lokasi = '$sess_lokasi',
                                        kurs   = '$data[dc_kurs]'
                                    WHERE noid = '$data[id_entry]'";

        return $this->mips_gl->query($sql);
    }


    function gl_transaksi_update_dollar($data)
    {


        $noacc          = str_replace(".", "", $data['acctno']);

        //ini untuk ambil data ke master noac
        $sqls = "SELECT  sbu,
                        `group`,
                        `type`,
                        `level`,
                        general
                    FROM noac WHERE noac = '$noacc'";
        $dt = $this->mips_gl->query($sqls)->row_array();


        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $todaya = date("Y-m-d");

        $sql11 = "SELECT rate FROM kursrate WHERE STR_TO_DATE(tgl, '%Y-%m-%d') = '$todaya'";
        $ret = $this->mips_gl->query($sql11)->row_array();

        $krs_rate = $ret['rate'];
        $krs_tgl  = $ret['tgl'];

        if ($data['dc'] == 'C') {
            $nominal_dr = '0';
            $nomin_cr   = str_replace(",", "", $data['dc_nominal']);
            $nomin_cr_f = $nomin_cr * $ret['rate'];
            $nominal_cr = $nomin_cr_f;
        } else {
            $nomin_dr   = str_replace(",", "", $data['dc_nominal']);
            $nomin_dr_f = $nomin_dr * $ret['rate'];
            $nominal_dr = $nomin_dr_f;
            $nominal_cr = '0';
        }


        $sess_lokasi = $this->get_nama_lokasi();


        $sql = "UPDATE entry_temp SET   noac   = '$noacc',
                                        `descac` = '$data[acctname]',
                                        dc     = '$data[dc]',
                                        dr     = '$nominal_dr',
                                        cr     = '$nominal_cr',
                                        ket    = '$data[deskripsi]',
                                        sbu    = '$dt[sbu]',
                                        `group`= '$dt[group]', 
                                        `type` = '$dt[type]',
                                        `level`= '$dt[level]',
                                        general= '$dt[general]',
                                        kurs   = '$data[dc_kurs]',
                                        kursrate = '$krs_rate',
                                        lokasi   = '$sess_lokasi',
                                        tglkurs  = '$krs_tgl'
                                    WHERE noid = '$data[id_entry]'";

        return $this->mips_gl->query($sql);
    }


    function gl_transaksi_update_dollar2($data)
    {


        $noacc          = str_replace(".", "", $data['acctno']);

        //ini untuk ambil data ke master noac
        $sqls = "SELECT  sbu,
                        `group`,
                        `type`,
                        `level`,
                        general
                    FROM noac WHERE noac = '$noacc'";
        $dt = $this->mips_gl->query($sqls)->row_array();


        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $todaya = date("Y-m-d");

        $sql11 = "SELECT rate FROM kursrate WHERE STR_TO_DATE(tgl, '%Y-%m-%d') = '$todaya'";
        $ret = $this->mips_gl->query($sql11)->row_array();

        $krs_rate = $ret['rate'];
        $krs_tgl  = $ret['tgl'];

        if ($data['dc'] == 'C') {
            $nominal_dr = '0';
            $nomin_cr   = str_replace(",", "", $data['dc_nominal']);
            $nomin_cr_f = $nomin_cr * $ret['rate'];
            $nominal_cr = $nomin_cr_f;
        } else {
            $nomin_dr   = str_replace(",", "", $data['dc_nominal']);
            $nomin_dr_f = $nomin_dr * $ret['rate'];
            $nominal_dr = $nomin_dr_f;
            $nominal_cr = '0';
        }


        $sess_lokasi = $this->get_nama_lokasi();


        $sql = "UPDATE entry SET   noac   = '$noacc',
                                        `descac` = '$data[acctname]',
                                        dc     = '$data[dc]',
                                        dr     = '$nominal_dr',
                                        cr     = '$nominal_cr',
                                        ket    = '$data[deskripsi]',
                                        sbu    = '$dt[sbu]',
                                        `group`= '$dt[group]', 
                                        `type` = '$dt[type]',
                                        `level`= '$dt[level]',
                                        general= '$dt[general]',
                                        kurs   = '$data[dc_kurs]',
                                        kursrate = '$krs_rate',
                                        lokasi   = '$sess_lokasi',
                                        tglkurs  = '$krs_tgl'
                                    WHERE noid = '$data[id_entry]'";

        return $this->mips_gl->query($sql);
    }


    function hapus_trans_gl_detail($data)
    {

        $sql = "DELETE FROM entry_temp WHERE noid = '$data[noid]'";
        return $this->mips_gl->query($sql);
    }

    function hapus_trans_gl_detail2($data)
    {

        $sql = "DELETE FROM entry WHERE noid = '$data[noid]'";
        return $this->mips_gl->query($sql);
    }


    function hapus_trans_gl_headers($data)
    {

        $period = $this->periode();

        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 6);

        $sql = "DELETE FROM header_entry WHERE noid = '$data[noid]' and YEAR(periode) = '$tahun' and MONTH(periode) = '$bulan'";

        $sqlw = "DELETE FROM entry WHERE noid = '$data[ref]' and YEAR(periode) = '$tahun' and MONTH(periode) = '$bulan'";
        $this->mips_gl->query($sqlw);

        return $this->mips_gl->query($sql);
    }

    function get_data_transaksi_gl()
    {

        $sql = "SELECT  ref,
                        DATE_FORMAT(`date`, '%d-%m-%Y') TGL,
                        periodetxt,
                        FORMAT(totaldr, 2) debit_f,
                        FORMAT(totalcr, 2) credit_f,
                        lokasi,
                        noid
                    FROM header_entry";

        return $this->mips_gl->query($sql);
    }




    //MASTER COA
    function master_select_data_grup()
    {
        $sql = "SELECT * FROM codegroup where group_n = 'NOAC_GROUP' and is_deleted = 0 ORDER BY id ASC";
        return $this->db->query($sql);
    }

    function master_select_data_level()
    {
        $sql = "SELECT * FROM codegroup where group_n = 'NOAC_LEVEL' and is_deleted = 0 ORDER BY id ASC";
        return $this->db->query($sql);
    }

    function master_select_data_divisi()
    {
        $sql = "SELECT * FROM codegroup where group_n = 'NOAC_DIVISI' and is_deleted = 0 ORDER BY id ASC";
        return $this->db->query($sql);
    }

    function master_select_data_satuan()
    {
        $sql = "SELECT * FROM codegroup where group_n = 'NOAC_SATUAN' and is_deleted = 0 ORDER BY id ASC";
        return $this->db->query($sql);
    }


    function master_get_datatables_dump()
    {
        $sql = "SELECT noac,nama FROM noac";
        //return $this->mstcode->query($sql);
        return $this->mips_gl->query($sql);
    }


    function master_simpan($data)
    {

        $user_id = $this->user_id();

        $noacc          = str_replace(".", "", $data['noacc']);
        $acc_general    = str_replace(".", "", $data['acc_general']);
        $acc_balance    = str_replace(",", "", $data['acc_balance']);

        $d['noac15'] = $noacc;
        $d['nama'] = $data['nama'];
        $d['group'] = "0";
        $d['type'] = $data['g_d'];
        $d['level'] = $data['level'];
        $d['general'] = $acc_general;
        $d['yeard'] = "0";
        $d['yearc'] = "0";



        if ($data['d_c'] == 'D') {
            $this->mips_gl->insert('noac', $d);

            // $sql = "INSERT INTO noac (noac15,
            //                     nama,
            //                     sbu,
            //                     `group`,
            //                     `type`,
            //                     `level`,
            //                     general,
            //                     yeard,
            //                     yearc) 
            //             VALUES ('$noacc',
            //                     '$data[nama]',
            //                     '0',
            //                     '$data[grup]',
            //                     '$data[g_d]',
            //                     '$data[level]',
            //                     '$acc_general',
            //                     '0',
            //                     '$acc_balance'";

            //return $this->mstcode->query($sql);
            // return $this->mips_gl->query($sql);
            return TRUE;
        } else {

            $this->mips_gl->insert('noac', $d);
            // $sql = "INSERT INTO noac (noac15,
            //                     nama,
            //                     sbu,
            //                     `group`,
            //                     `type`,
            //                     `level`,
            //                     general,
            //                     yeard,
            //                     yearc) 
            //             VALUES ('$noacc',
            //                     '$data[nama]',
            //                     '0',
            //                     '$data[grup]',
            //                     '$data[g_d]',
            //                     '$data[level]',
            //                     '$acc_general',
            //                     '0',
            //                     '$acc_balance'";

            // return $this->mips_gl->query($sql);
            return TRUE;
        }
    }

    function master_coa_detail($id_coa)
    {

        $sql = "SELECT *,CONCAT(SUBSTR(noac,1,2), '.', SUBSTR(noac,3,2), '.', SUBSTR(noac,5,2), '.', SUBSTR(noac,7,2), '.', SUBSTR(noac,9,2))  AS kode_noac,FORMAT(balancedr, 0) AS balancedr FROM noac where noid = '$id_coa'";

        //return $this->mstcode->query($sql);
        return $this->mips_gl->query($sql);
    }


    function master_detail_account($acct_no, $acct_id)
    {

        $sql = "SELECT noid,noac,nama FROM noac where noid = '$acct_id' and noac = '$acct_no'";

        return $this->mips_gl->query($sql);
        //return $this->mstcode->query($sql);
    }

    function master_update_saldo($data)
    {

        $user_id = $this->user_id();

        $acc_balance    = str_replace(",", "", $data['saldoawal_acc']);

        $sql = "UPDATE noac SET balancedr   = '$acc_balance',
                                    updated_by  = '$user_id',
                                    updated_at  = NOW() WHERE noid = '$data[idnoac]'";
        // return $this->mstcode->query($sql);
        return $this->mips_gl->query($sql);
    }

    function master_get_data_detail_coa($id_coa)
    {

        $sql = "SELECT *,type as type_g,
                            CONCAT(SUBSTR(noac,1,2), '.', SUBSTR(noac,3,2), '.', SUBSTR(noac,5,2), '.', SUBSTR(noac,7,2), '.', SUBSTR(noac,9,2))  AS kode_noac,
                            CONCAT(SUBSTR(general,1,2), '.', SUBSTR(general,3,2), '.', SUBSTR(general,5,2), '.', SUBSTR(general,7,2), '.', SUBSTR(general,9,2))  AS noac_general,
                            FORMAT(yearc, 2) AS yearc_f,
                            FORMAT(yeard, 2) AS yeard_f 
                        FROM noac where noid = '$id_coa'";

        return $this->mips_gl->query($sql);
        //return $this->mstcode->query($sql);
    }



    function master_update($data)
    {

        $user_id = $this->user_id();

        $noacc          = str_replace(".", "", $data['noacc']);
        $acc_general    = str_replace(".", "", $data['acc_general']);
        $acc_balance    = str_replace(",", "", $data['acc_balance']);

        if ($data['d_c'] == 'D') {

            $sql = "UPDATE noac SET noac        = '$noacc',
                                    nama        = '$data[nama]',
                                    sbu         = 0,
                                    `group`     = '$data[grup]',
                                    `type`      = '$data[g_d]',
                                    `level`     = '$data[level]',
                                    general     = '$acc_general',
                                    yearc       = 0,
                                    yeard       = '$acc_balance', 
                                    updated_at  = NOW(),
                                    updated_by  = '$user_id'
                                WHERE NOID = '$data[noid_acc]'";

            return $this->mips_gl->query($sql);
            //return $this->mstcode->query($sql);

        } else {

            $sql = "UPDATE noac SET noac        = '$noacc',
                                    nama        = '$data[nama]',
                                    sbu         = 0,
                                    `group`     = '$data[grup]',
                                    `type`      = '$data[g_d]',
                                    `level`     = '$data[level]',
                                    general     = '$acc_general',
                                    yearc       = '$acc_balance',
                                    yeard       = 0,
                                    updated_at  = NOW(),
                                    updated_by  = '$user_id' 
                                WHERE NOID = '$data[noid_acc]'";

            // return $this->mstcode->query($sql);
            return $this->mips_gl->query($sql);
        }
    }



    function get_afd_unit($kategori)
    {

        $query = "SELECT DISTINCT(afd) FROM item_pekerjaan WHERE kategori='$kategori' ORDER BY afd ASC";
        return $this->db_msal_personalia->query($query)->result();
    }

    function get_tahuntanam($kategori, $afd_unit)
    {
        $query_thn_tanam = "SELECT DISTINCT(tahuntanam) FROM masterblok WHERE afd = '$afd_unit' ORDER BY tahuntanam ASC";
        return $this->db_msal_personalia->query($query_thn_tanam)->result();
    }


    function transaksi_header_detail($noid, $ref)
    {

        $sql = "SELECT *,DATE_FORMAT(DATE, '%d-%m-%Y') date_f FROM header_entry where NOID = '$noid' and ref = '$ref'";
        return $this->mips_gl->query($sql);
    }

    function transaksi_total_credit_edit($data)
    {

        $period = $this->periode();

        $sql = "SELECT SUM(cr) cr_non_ff ,FORMAT(SUM(cr), 2) cr_ff FROM entry WHERE ref = '$data[ref]' AND  SUBSTR(periodetxt,1,6) = '$period'";
        return $this->mips_gl->query($sql);
    }

    function transaksi_total_debit_edit($data)
    {

        $period = $this->periode();

        $sql = "SELECT SUM(dr) dr_non_ff ,FORMAT(SUM(dr), 2) dr_ff FROM entry WHERE ref = '$data[ref]' AND  SUBSTR(periodetxt,1,6) = '$period'";
        return $this->mips_gl->query($sql);
    }


    /* Report Journal */

    function get_data_entry($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)
    {

        $sess_lokasi = $this->get_nama_lokasi();
        //$sess_periode = $this->session->userdata('sess_periode');
        $periodes = substr($this->session->userdata('sess_periode'), 0, 4) . '-' . substr($this->session->userdata('sess_periode'), 4, 6);

        $dv_start;
        if (($divisi_start == '-') && ($divisi_end == '-')) {
            $dv_start = "";
        } else if ($divisi_start != '-' && $divisi_end == '-') {
            $dv_start = "AND sbu = '" . $divisi_start . "'";
        } else if ($divisi_start != '-' && $divisi_end != '-') {
            $dv_start = "AND sbu >= '" . $divisi_start . "' AND sbu <= '" . $divisi_end . "'";
        } else {
            $dv_start = "";
        }

        $acc;
        if ($noacc_start == 0 && $noacc_end == 0) {
            $acc = "";
        } else if ($noacc_start != 0 && $noacc_end == 0) {
            $acc = "AND noac = " . $noacc_start . "";
        } else if ($noacc_start != 0 && $noacc_end != 0) {
            $acc = "AND noac >= " . $noacc_start . " AND noac <= " . $noacc_end . "";
        } else {
            $acc = "";
        }

        if ($periode_terkini == 1) { //ini artinya pakai periode, filter tanggal tidak berlaku

            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,cr CREDIT_F2 ,dr DEBET_F2,FORMAT(dr, 0) DEBET_F,FORMAT(cr, 0) CREDIT_F FROM entry WHERE STR_TO_DATE(periode, '%Y-%m') = STR_TO_DATE('$periodes', '%Y-%m') $dv_start $acc ORDER BY `DATE`,dr DESC";
            return $this->mips_gl->query($sql);
        } else {

            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,cr CREDIT_F2,dr DEBET_F2,FORMAT(dr, 0) DEBET_F,FORMAT(cr, 0) CREDIT_F FROM entry WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') $dv_start $acc  ORDER BY `DATE`,dr DESC";
            return $this->mips_gl->query($sql);
        }
    }

    function get_data_entry_head($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)
    {

        $sess_lokasi = $this->get_nama_lokasi();
        $sess_periode = $this->session->userdata('sess_periode');
        $periodes = substr($this->session->userdata('sess_periode'), 0, 4) . '-' . substr($this->session->userdata('sess_periode'), 4, 6);

        $dv_start;
        if ($divisi_start == '-' && $divisi_end == '-') {
            $dv_start = "";
        } else if ($divisi_start != '-' && $divisi_end == '-') {
            $dv_start = "AND sbu = '" . $divisi_start . "'";
        } else if ($divisi_start != '-' && $divisi_end != '-') {
            $dv_start = "AND sbu >= '" . $divisi_start . "' AND sbu <= '" . $divisi_end . "'";
        } else {
            //;
        }

        $acc;
        if ($noacc_start == 0 && $noacc_end == 0) {
            $acc = "";
        } else if ($noacc_start != 0 && $noacc_end == 0) {
            $acc = "AND noac = " . $noacc_start . "";
        } else if ($noacc_start != 0 && $noacc_end != 0) {
            $acc = "AND noac >= " . $noacc_start . " AND noac <= " . $noacc_end . "";
        } else {
            $acc = "";
        }


        if ($periode_terkini == 1) { //ini artinya pakai periode, filter tanggal tidak berlaku

            $sql = "SELECT ref,SUM(dr) AS DBT_NF,FORMAT(SUM(dr), 0) DBT,FORMAT(SUM(cr), 0) KRD,SUM(cr) KRD_NF FROM entry WHERE STR_TO_DATE(periode, '%Y-%m') = STR_TO_DATE('$periodes', '%Y-%m') $dv_start $acc GROUP BY ref ORDER BY `DATE` ASC";
            return $this->mips_gl->query($sql);
        } else {

            $sql = "SELECT ref,SUM(dr) AS DBT_NF,FORMAT(SUM(dr), 0) DBT,FORMAT(SUM(cr), 0) KRD,SUM(cr) KRD_NF FROM entry WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y')  $dv_start $acc GROUP BY ref ORDER BY `DATE` ASC";
            return $this->mips_gl->query($sql);
        }
    }


    function get_data_entry_sum($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)
    {

        $sess_lokasi = $this->get_nama_lokasi();

        $periodes = substr($this->session->userdata('sess_periode'), 0, 4) . '-' . substr($this->session->userdata('sess_periode'), 4, 6);

        $dv_start;
        if (($divisi_start == '-') && ($divisi_end == '-')) {
            $dv_start = "";
        } else if ($divisi_start != '-' && $divisi_end == '-') {
            $dv_start = "AND sbu = '" . $divisi_start . "'";
        } else if ($divisi_start != '-' && $divisi_end != '-') {
            $dv_start = "AND sbu >= '" . $divisi_start . "' AND sbu <= '" . $divisi_end . "'";
        } else {
            $dv_start = "";
        }

        $acc;
        if ($noacc_start == 0 && $noacc_end == 0) {
            $acc = "";
        } else if ($noacc_start != 0 && $noacc_end == 0) {
            $acc = "AND noac = " . $noacc_start . "";
        } else if ($noacc_start != 0 && $noacc_end != 0) {
            $acc = "AND noac >= " . $noacc_start . " AND noac <= " . $noacc_end . "";
        } else {
            $acc = "";
        }

        if ($periode_terkini == 1) { //ini artinya pakai periode, filter tanggal tidak berlaku

            $sql = "SELECT SUM(cr) as grand_total_cr, SUM(dr) as grand_total_dr FROM entry WHERE STR_TO_DATE(periode, '%Y-%m') = STR_TO_DATE('$periodes', '%Y-%m') $dv_start $acc ORDER BY `DATE`,dr DESC";
            return $this->mips_gl->query($sql);
        } else {

            $sql = "SELECT SUM(cr) as grand_total_cr, SUM(dr) as grand_total_dr FROM entry WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') $dv_start $acc  ORDER BY `DATE`,dr DESC";
            return $this->mips_gl->query($sql);
        }
    }

    /* Report Journal */



    /* Report Module */

    function get_data_entry_rpt_module($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)
    {

        $sess_lokasi = $this->get_nama_lokasi();
        $sess_periode = $this->session->userdata('sess_periode');

        $dv_start;
        if ($divisi_start == '-' && $divisi_end == '-') {
            $dv_start = "";
        } else if ($divisi_start != '-' && $divisi_end == '-') {
            $dv_start = "AND sbu = " . $divisi_start . "";
        } else {
            $dv_start = "AND sbu >= '" . $divisi_start . "' AND sbu <= '" . $divisi_end . "'";
        }

        $modules;
        if ($module == '-') {
            $modules = "";
        } else {
            $modules = "AND module = '" . $module . "'";
        }

        if ($periode_terkini == 1) { //ini artinya pakai periode, filter tanggal tidak berlaku

            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,dr DEBET_F2,FORMAT(dr, 2) DEBET_F,FORMAT(cr, 2) CREDIT_F FROM entry WHERE SUBSTR(periodetxt,1,6) = '$sess_periode' AND lokasi = '$sess_lokasi' $dv_start $modules ORDER BY `DATE`,dr DESC";
            return $this->mips_gl->query($sql);
        } else {

            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,dr DEBET_F2,FORMAT(dr, 2) DEBET_F,FORMAT(cr, 2) CREDIT_F FROM entry WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND lokasi = '$sess_lokasi' $dv_start $modules  ORDER BY `DATE`,dr DESC";
            return $this->mips_gl->query($sql);
        }
    }

    function get_data_entry_head_rpt_module($tgl_start, $tgl_end, $periode_terkini, $divisi_start, $divisi_end, $module)
    {

        $sess_lokasi = $this->get_nama_lokasi();
        $sess_periode = $this->session->userdata('sess_periode');

        $dv_start;
        if ($divisi_start == '-' && $divisi_end == '-') {
            $dv_start = "";
        } else if ($divisi_start != '-' && $divisi_end == '-') {
            $dv_start = "AND sbu = " . $divisi_start . "";
        } else if ($divisi_start != '-' && $divisi_end != '-') {
            $dv_start = "AND sbu >= " . $divisi_start . " AND sbu <= " . $divisi_end . "";
        } else {
            $dv_start = "";
        }

        $modules;
        if ($module == '-') {
            $modules = "";
        } else {
            $modules = "AND module = '" . $module . "'";
        }


        if ($periode_terkini == 1) { //ini artinya pakai periode, filter tanggal tidak berlaku

            $sql = "SELECT ref,SUM(dr) AS DBT_NF,FORMAT(SUM(dr), 2) DBT,FORMAT(SUM(cr), 2) KRD,SUM(cr) KRD_NF FROM entry WHERE SUBSTR(periodetxt,1,6) = '$sess_periode' AND lokasi = '$sess_lokasi' $dv_start $modules GROUP BY ref ORDER BY `DATE` ASC ";
            return $this->mips_gl->query($sql);
        } else {

            $sql = "SELECT ref,SUM(dr) AS DBT_NF,FORMAT(SUM(dr), 2) DBT,FORMAT(SUM(cr), 2) KRD,SUM(cr) KRD_NF FROM entry WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND lokasi = '$sess_lokasi' $dv_start $modules GROUP BY ref ORDER BY `DATE` ASC ";
            return $this->mips_gl->query($sql);
        }
    }

    /* Report Journal */



    function get_data_account_detail()
    {
        $sql = "SELECT noac,nama,`level`,`type` FROM noac";
        //return $this->mstcode->query($sql);
        return $this->mips_gl->query($sql);
    }





    /* Report Buku Besar */

    function get_data_acct_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)
    {

        $sess_lokasi = $this->get_nama_lokasi();
        //$sess_periode = $this->session->userdata('sess_periode');
        $periodes = substr($this->session->userdata('sess_periode'), 0, 4) . '-' . substr($this->session->userdata('sess_periode'), 4, 6);

        $dv_start;
        if (($divisi_start == '-') && ($divisi_end == '-')) {
            $dv_start = "";
        } else if ($divisi_start != '-' && $divisi_end == '-') {
            $dv_start = "AND a.sbu = '" . $divisi_start . "'";
        } else if ($divisi_start != '-' && $divisi_end != '-') {
            $dv_start = "AND a.sbu >= '" . $divisi_start . "' AND a.sbu <= '" . $divisi_end . "'";
        } else {
            $dv_start = "";
        }

        $acc;
        if ($noacc_start == 0 && $noacc_end == 0) {
            $acc = "";
        } else if ($noacc_start != 0 && $noacc_end == 0) {
            $acc = "AND a.noac = " . $noacc_start . "";
        } else if ($noacc_start != 0 && $noacc_end != 0) {
            $acc = "AND a.noac >= " . $noacc_start . " AND a.noac <= " . $noacc_end . "";
        } else {
            $acc = "";
        }

        if ($periode_terkini == 1) { //ini artinya pakai periode, filter tanggal tidak berlaku
            //$sql = "SELECT noac,`descac`,SUM(dr) AS DBT_NF,FORMAT(SUM(dr), 2) DBT,FORMAT(SUM(cr), 2) KRD,SUM(cr) KRD_NF FROM entry WHERE SUBSTR(periodetxt,1,6) = '$sess_periode' AND lokasi = '$sess_lokasi' $dv_start $acc GROUP BY noac ORDER BY noac ASC";
            $sql = "SELECT 	a.noac,
                                a.`descac`,
                                SUM(a.dr) AS DBT_NF,
                                SUM(a.cr) AS KRD_NF,
                                b.nama,
                                b.noac AS noac_cs,
                                b.yeard,
                                b.yearc,
                                b.saldo01d,
                                b.saldo01c,
                                b.saldo02d,
                                b.saldo02c,
                                b.saldo03d,
                                b.saldo03c,
                                b.saldo04d,
                                b.saldo04c,
                                b.saldo05d,
                                b.saldo05c,
                                b.saldo06d,
                                b.saldo06c,
                                b.saldo07d,
                                b.saldo07c,
                                b.saldo08d,
                                b.saldo08c,
                                b.saldo09d,
                                b.saldo09c,
                                b.saldo10d,
                                b.saldo10c,
                                b.saldo11d,
                                b.saldo11c,
                                b.saldo12d,
                                b.saldo12c,
                                b.group
                        FROM entry AS a
                        INNER JOIN noac AS b ON a.noac = b.noac 
                        WHERE STR_TO_DATE(a.periode, '%Y-%m') = STR_TO_DATE('$periodes', '%Y-%m') $dv_start $acc
                        GROUP BY a.noac ORDER BY a.noac ASC";
            return $this->mips_gl->query($sql);
        } else {

            //$sql = "SELECT DISTINCT noac,`descac`,SUM(dr) AS DBT_NF,FORMAT(SUM(dr), 2) DBT,FORMAT(SUM(cr), 2) KRD,SUM(cr) KRD_NF FROM entry WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') AND lokasi = '$sess_lokasi' $dv_start $acc  GROUP BY noac ORDER BY noac ASC";
            $sql = "SELECT 	a.noac,
                                a.`descac`,
                                SUM(a.dr) AS DBT_NF,
                                SUM(a.cr) AS KRD_NF,
                                FORMAT(SUM(a.dr), 2) DBT,
                                FORMAT(SUM(a.cr), 2) KRD,
                                b.nama,
                                b.noac AS noac_cs,
                                b.yeard,
                                b.yearc,
                                b.saldo01d,
                                b.saldo01c,
                                b.saldo02d,
                                b.saldo02c,
                                b.saldo03d,
                                b.saldo03c,
                                b.saldo04d,
                                b.saldo04c,
                                b.saldo05d,
                                b.saldo05c,
                                b.saldo06d,
                                b.saldo06c,
                                b.saldo07d,
                                b.saldo07c,
                                b.saldo08d,
                                b.saldo08c,
                                b.saldo09d,
                                b.saldo09c,
                                b.saldo10d,
                                b.saldo10c,
                                b.saldo11d,
                                b.saldo11c,
                                b.saldo12d,
                                b.saldo12c,
                                b.group
                        FROM entry AS a
                        INNER JOIN noac AS b ON a.noac = b.noac 
                        WHERE DATE(a.`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(a.`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') $dv_start $acc
                        GROUP BY a.noac ORDER BY a.noac ASC";

            return $this->mips_gl->query($sql);
        }
    }


    function get_data_entry_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)
    {

        $sess_lokasi = $this->get_nama_lokasi();
        //$//sess_periode = $this->session->userdata('sess_periode');
        $periodes = substr($this->session->userdata('sess_periode'), 0, 4) . '-' . substr($this->session->userdata('sess_periode'), 4, 6);

        $dv_start;
        if (($divisi_start == '-') && ($divisi_end == '-')) {
            $dv_start = "";
        } else if ($divisi_start != '-' && $divisi_end == '-') {
            $dv_start = "AND sbu = '" . $divisi_start . "'";
        } else if ($divisi_start != '-' && $divisi_end != '-') {
            $dv_start = "AND sbu >= '" . $divisi_start . "' AND sbu <= '" . $divisi_end . "'";
        } else {
            $dv_start = "";
        }

        $acc;
        if ($noacc_start == 0 && $noacc_end == 0) {
            $acc = "";
        } else if ($noacc_start != 0 && $noacc_end == 0) {
            $acc = "AND noac = " . $noacc_start . "";
        } else if ($noacc_start != 0 && $noacc_end != 0) {
            $acc = "AND noac >= " . $noacc_start . " AND noac <= " . $noacc_end . "";
        } else {
            $acc = "";
        }

        if ($periode_terkini == 1) { //ini artinya pakai periode, filter tanggal tidak berlaku

            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,cr CREDIT_F2,dr DEBET_F2,FORMAT(dr, 0) DEBET_F,FORMAT(cr, 0) CREDIT_F FROM entry WHERE STR_TO_DATE(periode, '%Y-%m') = STR_TO_DATE('$periodes', '%Y-%m') $dv_start $acc ORDER BY `date`,noac ASC";
            return $this->mips_gl->query($sql);
        } else {

            $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,cr CREDIT_F2,dr DEBET_F2,FORMAT(dr, 0) DEBET_F,FORMAT(cr, 0) CREDIT_F FROM entry WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') $dv_start $acc  ORDER BY `date`,noac ASC"; /*ORDER BY `DATE`,dr DESC*/
            return $this->mips_gl->query($sql);
        }
    }

    function get_data_entry_head_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)
    {

        $sess_lokasi = $this->get_nama_lokasi();
        //$sess_periode = $this->session->userdata('sess_periode');
        $periodes = substr($this->session->userdata('sess_periode'), 0, 4) . '-' . substr($this->session->userdata('sess_periode'), 4, 6);

        $dv_start;
        if ($divisi_start == '-' && $divisi_end == '-') {
            $dv_start = "";
        } else if ($divisi_start != '-' && $divisi_end == '-') {
            $dv_start = "AND sbu = '" . $divisi_start . "'";
        } else if ($divisi_start != '-' && $divisi_end != '-') {
            $dv_start = "AND sbu >= '" . $divisi_start . "' AND sbu <= '" . $divisi_end . "'";
        } else {
            //;
        }

        $acc;
        if ($noacc_start == 0 && $noacc_end == 0) {
            $acc = "";
        } else if ($noacc_start != 0 && $noacc_end == 0) {
            $acc = "AND noac = " . $noacc_start . "";
        } else if ($noacc_start != 0 && $noacc_end != 0) {
            $acc = "AND noac >= " . $noacc_start . " AND noac <= " . $noacc_end . "";
        } else {
            $acc = "";
        }


        if ($periode_terkini == 1) { //ini artinya pakai periode, filter tanggal tidak berlaku

            $sql = "SELECT ref,SUM(dr) AS DBT_NF,FORMAT(SUM(dr), 0) DBT,FORMAT(SUM(cr), 0) KRD,SUM(cr) KRD_NF FROM entry WHERE STR_TO_DATE(periode, '%Y-%m') = STR_TO_DATE('$periodes', '%Y-%m') $dv_start $acc GROUP BY noac ORDER BY noac ASC ";
            return $this->mips_gl->query($sql);
        } else {

            $sql = "SELECT ref,SUM(dr) AS DBT_NF,FORMAT(SUM(dr), 0) DBT,FORMAT(SUM(cr), 0) KRD,SUM(cr) KRD_NF FROM entry WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') $dv_start $acc GROUP BY noac ORDER BY noac ASC ";
            return $this->mips_gl->query($sql);
        }
    }

    /* Report Buku Besar */


    function get_datalist_noac($noacs)
    {

        $saldo = str_replace(",", "", $data['saldo']);
        $bln   = $data['bulan'];

        $var_bulan;
        if ($bln == 01) {
            $var_bulan = 'saldo_1 = ' . $saldo . '';
        } else if ($bln == 02) {
            $var_bulan = 'saldo_2 = ' . $saldo . '';
        } else if ($bln == 03) {
            $var_bulan = 'saldo_3 = ' . $saldo . '';
        } else if ($bln == 04) {
            $var_bulan = 'saldo_4 = ' . $saldo . '';
        } else if ($bln == 05) {
            $var_bulan = 'saldo_5 = ' . $saldo . '';
        } else if ($bln == 06) {
            $var_bulan = 'saldo_6 = ' . $saldo . '';
        } else if ($bln == 07) {
            $var_bulan = 'saldo_7 = ' . $saldo . '';
        } else if ($bln == 08) {
            $var_bulan = 'saldo_8 = ' . $saldo . '';
        } else if ($bln == 09) {
            $var_bulan = 'saldo_9 = ' . $saldo . '';
        } else if ($bln == 10) {
            $var_bulan = 'saldo_10 = ' . $saldo . '';
        } else if ($bln == 11) {
            $var_bulan = 'saldo_11 = ' . $saldo . '';
        } else if ($bln == 12) {
            $var_bulan = 'saldo_12 = ' . $saldo . '';
        } else {
            $var_bulan = '-';
        }


        $sql = "SELECT b.noac_lama AS  noac_lm
                    FROM noac AS a 
                    INNER JOIN noac_mapping AS b ON a.`noac` = b.noac_baru
                    WHERE b.`noac_lama` IN (" . implode(',', $noacs) . ")";
        //return $this->mstcode->query($sql);
        return $this->mips_gl->query($sql);
    }

    function posting_harian()
    {


        //ini group dulu berdasarkan noac
        $period = $this->periode();
        $periodes = substr($this->session->userdata('sess_periode'), 0, 4) . '-' . substr($this->session->userdata('sess_periode'), 4, 6);

        $DEBIT  = 'saldo' . substr($period, 4, 6) . 'd';
        $KREDIT = 'saldo' . substr($period, 4, 6) . 'c';

        //kosongkan dulu saldonya untuk bulan periode
        $sqlclear = "UPDATE noac SET balancedr  = 0,
                                         balancecr  = 0,
                                         " . $DEBIT . " = 0,
                                         " . $KREDIT . "= 0";
        $this->mips_gl->query($sqlclear);

        //SUBSTR(periodetxt,1,6) = '$period'
        $sql = "SELECT  noac,
                    periode,
                    `group`, 
                    SUM(dr) AS SumOfdr, 
                    SUM(cr) AS SumOfcr 
            FROM entry
            WHERE STR_TO_DATE(periode, '%Y-%m') = STR_TO_DATE('$periodes', '%Y-%m')
            GROUP BY periode,noac,`group`
            ORDER BY noac DESC";
        $sql_entry = $this->mips_gl->query($sql)->result_array();

        // start ========= Menghitung Nilai Detail ========
        foreach ($sql_entry as $entry) {

            $KODECOA = $entry['noac'];
            $GROUPS  = $entry['group'];
            //              //start : ========================== step 1 ===================

            if ($GROUPS == 'Asset' || $GROUPS == 'Expenses' || $GROUPS == 'Other Expenses') {

                if ($entry['SumOfcr'] <> 0 && $entry['SumOfdr'] <> 0) {

                    $TOTALDR_TOT = $entry['SumOfdr'] - $entry['SumOfcr'];
                    if ($TOTALDR_TOT > 0) {
                        $TOTALDR1 = $TOTALDR_TOT;
                        $TOTALCR1 = 0;
                    } else {
                        $TOTALCR1 = $TOTALDR_TOT * -1;
                        $TOTALDR1 = 0;
                    }
                } else if ($entry['SumOfcr'] <> 0 && $entry['SumOfdr'] == 0) {

                    if ($entry['SumOfcr'] > 0) {
                        $TOTALCR1 = $entry['SumOfcr'];
                        $TOTALDR1 = 0;
                    } else {
                        $TOTALDR1 = $entry['SumOfcr'] * -1;
                        $TOTALCR1 = 0;
                    }
                } else if ($entry['SumOfdr'] <> 0 && $entry['SumOfcr'] == 0) {

                    if ($entry['SumOfdr'] > 0) {
                        $TOTALDR1 = $entry['SumOfdr'];
                        $TOTALCR1 = 0;
                    } else {
                        $TOTALCR1 = $entry['SumOfdr'] * -1;
                        $TOTALDR1 = 0;
                    }
                }
            } else {


                $TOTALCR_TOT = $entry['SumOfcr'] - $entry['SumOfdr'];

                if ($entry['SumOfdr'] <> 0 && $entry['SumOfcr'] <> 0) {

                    if ($TOTALCR_TOT > 0) {
                        $TOTALCR1 = $TOTALCR_TOT;
                        $TOTALDR1 = 0;
                    } else {
                        $TOTALDR1 = $TOTALCR_TOT * -1;
                        $TOTALCR1 = 0;
                    }
                } else if ($entry['SumOfdr'] <> 0 && $entry['SumOfcr'] == 0) {

                    if ($entry['SumOfdr'] > 0) {
                        $TOTALDR1 = $entry['SumOfdr'];
                        $TOTALCR1 = 0;
                    } else {
                        $TOTALCR1 = $entry['SumOfdr'] * -1;
                        $TOTALDR1 = 0;
                    }
                } else if ($entry['SumOfdr'] == 0 && $entry['SumOfcr'] <> 0) {

                    if ($entry['SumOfcr'] > 0) {
                        $TOTALCR1 = $entry['SumOfcr'];
                        $TOTALDR1 = 0;
                    } else {
                        $TOTALDR1 = $entry['SumOfcr'] * -1;
                        $TOTALCR1 = 0;
                    }
                }
            }


            //echo 'DB :'.$TOTALDR1.' - '.$KODECOA.' - '.$TOTALCR1."<br><hr>";

            $sql3 = "UPDATE noac SET balancedr  = 0,
                                         balancecr  = 0,
                                         " . $DEBIT . " = '$TOTALDR1',
                                         " . $KREDIT . "= '$TOTALCR1' 
                                        WHERE noac  = '$KODECOA'";
            $this->mips_gl->query($sql3);


            //end : ========================== step 1 =====================

            //start : ======================== step 2 ==== Filter Group Expenses
            $sql_act_exp = "SELECT SUM(" . $DEBIT . ") AS TTLDB,
                                       SUM(" . $KREDIT . ") AS TTLCR 
                            FROM noac WHERE `type` = 'D' AND `group` LIKE '%Expenses%'";
            $k_sql_exp   = $this->mips_gl->query($sql_act_exp)->row_array();

            if ($k_sql_exp['TTLDB'] <> 0) {
                $TTLB_DB = $k_sql_exp['TTLDB'];
            } else {
                $TTLB_DB = 0;
            }

            if ($k_sql_exp['TTLCR'] <> 0) {
                $TTLB_CR = $k_sql_exp['TTLCR'];
            } else {
                $TTLB_CR = 0;
            }
            //end : ======================== step 2 ==== Filter Group Expenses


            //start : ======================== step 3 ==== Filter Group Revenue
            $sql_act_rev = "SELECT  SUM(" . $DEBIT . ") AS TTLDB,
                                        SUM(" . $KREDIT . ") AS TTLCR 
                            FROM noac WHERE `type` = 'D' AND `group` LIKE '%Revenue%'";
            $k_sql_rev   = $this->mips_gl->query($sql_act_rev)->row_array();

            if ($k_sql_rev['TTLDB'] <> 0) {
                $TTLR_DB = $k_sql_rev['TTLDB'];
            } else {
                $TTLR_CR = 0;
            }

            if ($k_sql_rev['TTLCR'] <> 0) {
                $TTLR_CR = $k_sql_rev['TTLCR'];
            } else {
                $TTLR_DB = 0;
            }
            //end : ======================== step 3 ==== Filter Group Revenue


            //start : ========= step 4 =========
            if ($TTLB_DB <> 0 && $TTLB_CR <> 0) {
                $TTLBIAYA = $TTLB_DB - $TTLB_CR;
            } else if ($TTLB_DB <> 0 && $TTLB_CR == 0) {
                $TTLBIAYA = $TTLB_DB;
            } else if ($TTLB_DB == 0 && $TTLB_CR <> 0) { //disini
                $TTLBIAYA = 0 - $TTLB_CR;
            }

            if ($TTLR_DB <> 0 && $TTLR_CR <> 0) {
                $TTLDAPAT = $TTLR_CR - $TTLR_DB;
            } else if ($TTLR_DB <> 0 && $TTLR_CR == 0) {
                $TTLDAPAT = 0 - $TTLR_DB;
            } else if ($TTLR_DB == 0 && $TTLR_CR <> 0) {
                $TTLDAPAT = $TTLR_CR;
            }


            if ($TTLDAPAT <> 0 && $TTLBIAYA <> 0) {
                $TTLRL = $TTLDAPAT - $TTLBIAYA;
            } else if ($TTLDAPAT <> 0 && $TTLBIAYA == 0) {
                $TTLRL = $TTLDAPAT;
            } else if ($TTLDAPAT == 0 && $TTLBIAYA <> 0) {
                if ($TTLBIAYA > 0) {
                    $TTLRL = $TTLBIAYA * -1;
                } else {
                    $TTLRL = $TTLBIAYA;
                }
            } else if ($TTLDAPAT == 0 && $TTLBIAYA == 0) {
                $TTLRL = 0;
            }
            //end   : ========= step 4 =========


            //start : ========= step 5 =========
            $LR2 = '504500000000000'; // LABA TAHUN BERJALAN
            $sql_act_lr = "UPDATE noac SET  " . $KREDIT . " = '$TTLRL',
                                                " . $DEBIT . "  = 0,
                                                balancedr   = 0,
                                                balancecr   = '$TTLRL'
                                           WHERE noac = '$LR2'";
            $this->mips_gl->query($sql_act_lr);
            //end   : ========= step 5 ========

        }
        // end ========= Menghitung Nilai Detail ========


        $sql_act_etr = "UPDATE entry SET POST = 1 WHERE periode = '$period'";
        return $this->mips_gl->query($sql_act_etr);
    }


    function posting_harian_x()
    {


        //ini group dulu berdasarkan noac
        $period = $this->periode();
        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 6);

        $DEBIT  = 'saldo' . substr($period, 4, 6) . 'd';
        $KREDIT = 'saldo' . substr($period, 4, 6) . 'c';

        //kosongkan dulu saldonya untuk bulan periode
        $sqlclear = "UPDATE noac SET balancedr  = 0,
                                         balancecr  = 0,
                                         " . $DEBIT . " = 0,
                                         " . $KREDIT . "= 0 WHERE `type` IN ('D','G')";
        $this->mips_gl->query($sqlclear);

        //SUBSTR(periodetxt,1,6) = '$period'
        $sql = "SELECT  noac,
                    periode,
                    `group`, 
                    SUM(dr) AS SumOfdr, 
                    SUM(cr) AS SumOfcr 
            FROM entry
            WHERE YEAR(`date`) = $tahun AND MONTH(`DATE`) = '$bulan'
            GROUP BY periode,noac,`group`
            ORDER BY noac DESC";
        $sql_entry = $this->mips_gl->query($sql)->result_array();

        // start ========= Menghitung Nilai Detail ========
        foreach ($sql_entry as $entry) {

            $KODECOA = $entry['noac'];
            $GROUPS  = $entry['group'];
            //              //start : ========================== step 1 ===================

            if ($GROUPS == 'Asset' || $GROUPS == 'Expenses' || $GROUPS == 'Other Expenses') {

                if ($entry['SumOfcr'] <> 0 && $entry['SumOfdr'] <> 0) {

                    $TOTALDR_TOT = $entry['SumOfdr'] - $entry['SumOfcr'];
                    if ($TOTALDR_TOT > 0) {
                        $TOTALDR1 = $TOTALDR_TOT;
                        $TOTALCR1 = 0;
                    } else {
                        $TOTALCR1 = $TOTALDR_TOT * -1;
                        $TOTALDR1 = 0;
                    }
                } else if ($entry['SumOfcr'] <> 0 && $entry['SumOfdr'] == 0) {

                    if ($entry['SumOfcr'] > 0) {
                        $TOTALCR1 = $entry['SumOfcr'];
                        $TOTALDR1 = 0;
                    } else {
                        $TOTALDR1 = $entry['SumOfcr'] * -1;
                        $TOTALCR1 = 0;
                    }
                } else if ($entry['SumOfdr'] <> 0 && $entry['SumOfcr'] == 0) {

                    if ($entry['SumOfdr'] > 0) {
                        $TOTALDR1 = $entry['SumOfdr'];
                        $TOTALCR1 = 0;
                    } else {
                        $TOTALCR1 = $entry['SumOfdr'] * -1;
                        $TOTALDR1 = 0;
                    }
                }
            } else {


                $TOTALCR_TOT = $entry['SumOfcr'] - $entry['SumOfdr'];

                if ($entry['SumOfdr'] <> 0 && $entry['SumOfcr'] <> 0) {

                    if ($TOTALCR_TOT > 0) {
                        $TOTALCR1 = $TOTALCR_TOT;
                        $TOTALDR1 = 0;
                    } else {
                        $TOTALDR1 = $TOTALCR_TOT * -1;
                        $TOTALCR1 = 0;
                    }
                } else if ($entry['SumOfdr'] <> 0 && $entry['SumOfcr'] == 0) {

                    if ($entry['SumOfdr'] > 0) {
                        $TOTALDR1 = $entry['SumOfdr'];
                        $TOTALCR1 = 0;
                    } else {
                        $TOTALCR1 = $entry['SumOfdr'] * -1;
                        $TOTALDR1 = 0;
                    }
                } else if ($entry['SumOfdr'] == 0 && $entry['SumOfcr'] <> 0) {

                    if ($entry['SumOfcr'] > 0) {
                        $TOTALCR1 = $entry['SumOfcr'];
                        $TOTALDR1 = 0;
                    } else {
                        $TOTALDR1 = $entry['SumOfcr'] * -1;
                        $TOTALCR1 = 0;
                    }
                }
            }


            //echo 'DB :'.$TOTALDR1.' - '.$KODECOA.' - '.$TOTALCR1."<br><hr>";

            $sql3 = "UPDATE noac SET balancedr  = 0,
                                         balancecr  = 0,
                                         " . $DEBIT . " = '$TOTALDR1',
                                         " . $KREDIT . "= '$TOTALCR1' 
                                        WHERE noac  = '$KODECOA'";
            $this->mips_gl->query($sql3);


            //end : ========================== step 1 =====================

            //start : ======================== step 2 ==== Filter Group Expenses
            $sql_act_exp = "SELECT SUM(" . $DEBIT . ") AS TTLDB,
                                       SUM(" . $KREDIT . ") AS TTLCR 
                            FROM noac WHERE `type` = 'D' AND `group` LIKE '%Expenses%'";
            $k_sql_exp   = $this->mips_gl->query($sql_act_exp)->row_array();

            if ($k_sql_exp['TTLDB'] <> 0) {
                $TTLB_DB = $k_sql_exp['TTLDB'];
            } else {
                $TTLB_DB = 0;
            }

            if ($k_sql_exp['TTLCR'] <> 0) {
                $TTLB_CR = $k_sql_exp['TTLCR'];
            } else {
                $TTLB_CR = 0;
            }
            //end : ======================== step 2 ==== Filter Group Expenses


            //start : ======================== step 3 ==== Filter Group Revenue
            $sql_act_rev = "SELECT  SUM(" . $DEBIT . ") AS TTLDB,
                                        SUM(" . $KREDIT . ") AS TTLCR 
                            FROM noac WHERE `type` = 'D' AND `group` LIKE '%Revenue%'";
            $k_sql_rev   = $this->mips_gl->query($sql_act_rev)->row_array();

            if ($k_sql_rev['TTLDB'] <> 0) {
                $TTLR_DB = $k_sql_rev['TTLDB'];
            } else {
                $TTLR_CR = 0;
            }

            if ($k_sql_rev['TTLCR'] <> 0) {
                $TTLR_CR = $k_sql_rev['TTLCR'];
            } else {
                $TTLR_DB = 0;
            }
            //end : ======================== step 3 ==== Filter Group Revenue


            //start : ========= step 4 =========
            if ($TTLB_DB <> 0 && $TTLB_CR <> 0) {
                $TTLBIAYA = $TTLB_DB - $TTLB_CR;
            } else if ($TTLB_DB <> 0 && $TTLB_CR == 0) {
                $TTLBIAYA = $TTLB_DB;
            } else if ($TTLB_DB == 0 && $TTLB_CR == 0) {
                $TTLBIAYA = 0 - $TTLB_CR;
            }

            if ($TTLR_DB <> 0 && $TTLR_CR <> 0) {
                $TTLDAPAT = $TTLR_CR - $TTLR_DB;
            } else if ($TTLR_DB <> 0 && $TTLR_CR == 0) {
                $TTLDAPAT = 0 - $TTLR_DB;
            } else if ($TTLR_DB == 0 && $TTLR_CR == 0) {
                $TTLDAPAT = $TTLB_CR;
            }


            if ($TTLDAPAT <> 0 && $TTLBIAYA <> 0) {
                $TTLRL = $TTLDAPAT - $TTLBIAYA;
            } else if ($TTLDAPAT <> 0 && $TTLBIAYA == 0) {
                $TTLRL = $TTLDAPAT;
            } else if ($TTLDAPAT == 0 && $TTLBIAYA <> 0) {
                if ($TTLBIAYA > 0) {
                    $TTLRL = $TTLBIAYA * -1;
                } else {
                    $TTLRL = $TTLBIAYA;
                }
            } else if ($TTLDAPAT == 0 && $TTLBIAYA == 0) {
                $TTLRL = 0;
            }
            //end   : ========= step 4 =========


            //start : ========= step 5 =========
            $LR2 = '504500000000000';
            $sql_act_lr = "UPDATE noac SET  " . $KREDIT . " = '$TTLRL',
                                                " . $DEBIT . "  = 0,
                                                balancedr   = 0,
                                                balancecr   = '$TTLRL'
                                           WHERE noac = '$LR2'";
            $this->mips_gl->query($sql_act_lr);
            //end   : ========= step 5 ========

        }
        //                // end ========= Menghitung Nilai Detail ========



        // Start : ========= Menghitung Nilai General ======== 
        //                $sqla = "SELECT noac,general,`type`,`group` FROM noac WHERE `type` = 'G' ORDER BY noac ASC";
        //                $res_sql_general_master = $this->mips_gl->query($sqla)->result_array();
        //                
        //                foreach ($res_sql_general_master as $a) {
        //                    
        //                    $sql_sum_g = "SELECT   SUM(".$DEBIT.") AS TTLDB,
        //                                            SUM(".$KREDIT.") AS TTLCR,
        //                                            SUM(YEARD) AS SALDOB,
        //                                            SUM(YEARC) AS SALDOC,
        //                                            SUM(BALANCEDR) AS AWALD,
        //                                            SUM(BALANCECR) AS AWALC,
        //                                            general,
        //                                            `type`,
        //                                            noac,
        //                                            `group`
        //                                FROM noac WHERE general <> '*' and general = '$a[noac]'";   
        //                    $y = $this->mips_gl->query($sql_sum_g)->row_array();
        //
        //                    if($a['group'] == 'Asset' || $a['group'] == 'Expenses' || $a['group'] == 'Other Expenses'){
        //                        
        //                        if($y['TTLCR'] <> 0 && $y['TTLDB'] <> 0){
        //                            $TOTALDR = $y['TTLDB'] - $y['TTLCR'];
        //                            if($TOTALDR > 0){
        //                                $TOTALDR = $TOTALDR;
        //                                $TOTALCR = 0;
        //                            }else{
        //                                $TOTALCR = $TOTALDR *-1;
        //                                $TOTALDR = 0;
        //                            }
        //                        }else if ($y['TTLCR'] <> 0 && $y['TTLDB'] == 0) {
        //                            $TOTALCR = $y['TTLCR'];
        //                            $TOTALDR = 0;
        //                        }else if ($y['TTLDB'] <> 0 && $y['TTLCR'] == 0) {
        //                            $TOTALDR = $y['TTLDB'];
        //                            $TOTALCR = 0;
        //                        }else if ($y['TTLDB'] == 0 && $y['TTLCR'] == 0) {
        //                            $TOTALDR = 0;
        //                            $TOTALCR = 0;
        //                        }
        ////                        
        //                        //and `group` IN ('Asset','Expenses','Other Expenses')
        //                        $sql_act_grs = "UPDATE noac SET ".$KREDIT."= '$TOTALCR',
        //                                                        ".$DEBIT." = '$TOTALDR',
        //                                                        balancedr = 0,
        //                                                        balancecr = 0 WHERE noac = '$a[noac]'";
        //                        $this->mips_gl->query($sql_act_grs);
        //
        //                    }else{
        //
        //                        //'UNTUK REVENUE LIABILITY
        //                        
        //                        if($y['TTLDB'] <> 0 && $y['TTLCR'] <> 0){
        //                            $TOTALCR_R = $y['TTLCR'] - $y['TTLDB'];
        //                            if($TOTALCR_R > 0){
        //                                $TOTALCR_R = $TOTALCR_R;
        //                                $TOTALDR_R = 0;
        //                            }else{
        //                                $TOTALDR_R = $TOTALCR_R *-1;
        //                                $TOTALCR_R = 0;
        //                            }
        //                        }else if ($y['TTLDB'] <> 0 && $y['TTLCR'] == 0) {
        //                            $TOTALDR_R = $y['TTLDB'];
        //                            $TOTALCR_R = 0;
        //                        }else if ($y['TTLDB'] == 0 && $y['TTLCR'] <> 0) {
        //                            $TOTALCR_R = $y['TTLCR'];
        //                            $TOTALDR_R = 0;
        //                        }else if ($y['TTLDB'] == 0 && $y['TTLCR'] == 0) {
        //                            $TOTALDR_R = 0;
        //                            $TOTALCR_R = 0;
        //                        }
        //
        //                        $sql_act_grd = "UPDATE noac SET ".$KREDIT."= '$TOTALCR_R',
        //                                                        ".$DEBIT." = '$TOTALDR_R',
        //                                                        balancedr    = 0,
        //                                                        balanceCr    = 0 WHERE noac = '$a[noac]'";
        //                        $this->mips_gl->query($sql_act_grd);
        //
        //                    }
        //
        //                }

        // End : ========= Menghitung Nilai General ======== 



        $sql_act_etr = "UPDATE entry SET POST = 1 WHERE periode = '$period'";
        return $this->mips_gl->query($sql_act_etr);
    }


    function posting_harian_general()
    {

        //ini group dulu berdasarkan noac
        $period = $this->periode();

        $DEBIT  = 'saldo' . substr($period, 4, 6) . 'd';
        $KREDIT = 'saldo' . substr($period, 4, 6) . 'c';

        // Start : ========= Menghitung Nilai General ======== 
        $sqla = "SELECT noac,general,`type`,`group` FROM noac WHERE `type` = 'G' ORDER BY noac DESC";
        //$sqla = "SELECT noac,general,`type`,`group` FROM noac WHERE `type` = 'G' ORDER BY noac ASC";
        $res_sql_general_master = $this->mips_gl->query($sqla)->result_array();

        foreach ($res_sql_general_master as $a) {


            $sql_sum_g = "SELECT   SUM(" . $DEBIT . ") AS TTLDB,
                                            SUM(" . $KREDIT . ") AS TTLCR,
                                            SUM(YEARD) AS SALDOB,
                                            SUM(YEARC) AS SALDOC,
                                            SUM(BALANCEDR) AS AWALD,
                                            SUM(BALANCECR) AS AWALC,
                                            general,
                                            `type`,
                                            noac,
                                            `group`
                                FROM noac WHERE general <> '*' and general = '$a[noac]'";
            $y = $this->mips_gl->query($sql_sum_g)->row_array();

            if ($a['group'] == 'Asset' || $a['group'] == 'Expenses' || $a['group'] == 'Other Expenses') {

                if ($y['TTLCR'] <> 0 && $y['TTLDB'] <> 0) {
                    $TOTALDR = $y['TTLDB'] - $y['TTLCR'];
                    if ($TOTALDR > 0) {
                        $TOTALDR = $TOTALDR;
                        $TOTALCR = 0;
                    } else {
                        $TOTALCR = $TOTALDR * -1;
                        $TOTALDR = 0;
                    }
                } else if ($y['TTLCR'] <> 0 && $y['TTLDB'] == 0) {
                    $TOTALCR = $y['TTLCR'];
                    $TOTALDR = 0;
                } else if ($y['TTLDB'] <> 0 && $y['TTLCR'] == 0) {
                    $TOTALDR = $y['TTLDB'];
                    $TOTALCR = 0;
                } else if ($y['TTLDB'] == 0 && $y['TTLCR'] == 0) {
                    $TOTALDR = 0;
                    $TOTALCR = 0;
                }

                //and `group` IN ('Asset','Expenses','Other Expenses')
                $sql_act_grs = "UPDATE noac SET " . $KREDIT . " = '$TOTALCR',
                                                        " . $DEBIT . "  = '$TOTALDR',
                                                        balancedr = 0,
                                                        balancecr = 0 WHERE noac = '$a[noac]'";
                $this->mips_gl->query($sql_act_grs);
            } else {

                //'UNTUK REVENUE LIABILITY
                if ($y['TTLDB'] <> 0 && $y['TTLCR'] <> 0) {
                    $TOTALCR_R = $y['TTLCR'] - $y['TTLDB'];
                    if ($TOTALCR_R > 0) {
                        $TOTALCR_R = $TOTALCR_R;
                        $TOTALDR_R = 0;
                    } else {
                        $TOTALDR_R = $TOTALCR_R * -1;
                        $TOTALCR_R = 0;
                    }
                } else if ($y['TTLDB'] <> 0 && $y['TTLCR'] == 0) {
                    $TOTALDR_R = $y['TTLDB'];
                    $TOTALCR_R = 0;
                } else if ($y['TTLDB'] == 0 && $y['TTLCR'] <> 0) {
                    $TOTALCR_R = $y['TTLCR'];
                    $TOTALDR_R = 0;
                } else if ($y['TTLDB'] == 0 && $y['TTLCR'] == 0) {
                    $TOTALDR_R = 0;
                    $TOTALCR_R = 0;
                }

                $sql_act_grd = "UPDATE noac SET " . $KREDIT . " = '$TOTALCR_R',
                                                        " . $DEBIT . "  = '$TOTALDR_R',
                                                        balancedr    = 0,
                                                        balanceCr    = 0 WHERE noac = '$a[noac]'";
                $this->mips_gl->query($sql_act_grd);
            }
        }

        // End : ========= Menghitung Nilai General ======== 


    }

    function get_nama_acct($acct)
    {
        $sqls = "SELECT nama FROM noac WHERE noac LIKE $acct";
        return $this->mips_gl->query($sqls);
    }

    function get_coa_assets($thn, $bln)
    {

        //$filters_null = $this->set_filter_year();

        $filter_nol = $this->set_filter_nol();

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Asset' and `type` = 'D' ORDER BY noac ASC";
        //$filters_null and `type` = 'D'
        return $this->mips_gl->query($sql);
    }


    function get_coa_capital($thn, $bln)
    {

        $filters_null = $this->set_filter_year();

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Capital' and `type` = 'D' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }

    function get_coa_expenses($thn, $bln)
    {

        $filters_null = $this->set_filter_year_expensis();
        //$filters_null
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Expenses' and `type` = 'D' ORDER BY noac ASC"; //AND SUBSTR(noac,1,2) = 70
        //SUBSTR(noac,1,4) IN ('7001','7010','7020','7025')
        return $this->mips_gl->query($sql);
    }


    function get_coa_liability($thn, $bln)
    {
        //pendapatakn jasa giro
        //pendapatan deposito bunga

        $filters_null = $this->set_filter_year();

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Liability' and `type` = 'D' ORDER BY noac ASC";
        //$filters_null and `type` = 'D' 
        return $this->mips_gl->query($sql);
    }


    function get_coa_other_expenses($thn, $bln)
    {

        $filters_null = $this->set_filter_year();

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Other Expenses' and `type` = 'D' ORDER BY noac ASC";

        //$filters_null and `type` = 'D' AND noac NOT IN ('950000000000000','950500000000000','950600000000000','950800000000000','951000000000000')
        return $this->mips_gl->query($sql);
    }


    function get_coa_other_revenue($thn, $bln)
    {

        $filters_null = $this->set_filter_year();

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Other Revenue' and `type` = 'D' ORDER BY noac ASC";
        //$filters_null and `type` = 'D' AND noac IN ('901000000000000','900900000000000','900100000000000','900450000000000','900500000000000','900700000000000')
        return $this->mips_gl->query($sql);
    }


    function get_coa_revenue($thn, $bln)
    {

        $filters_null = $this->set_filter_year();

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Revenue' and `type` = 'D' ORDER BY noac ASC";
        //$filters_null and `type` = 'D' AND noac IN ('600101010000000','600101050000000','600101100000000')
        return $this->mips_gl->query($sql);
    }


    function get_coa_assets_sum($thn, $bln, $level)
    {

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Asset' and `level` = '$level'  ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }


    function get_coa_capital_sum($thn, $bln, $level)
    {

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Capital' and `level` = '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }

    function get_coa_expenses_sum($thn, $bln, $level)
    {

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Expenses' and `level` = '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }


    function get_coa_liability_sum($thn, $bln, $level)
    {
        //pendapatakn jasa giro
        //pendapatan deposito bunga

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Liability' and `level` = '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }


    function get_coa_other_expenses_sum($thn, $bln, $level)
    {

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Other Expenses' and `level` = '$level' AND noac NOT IN ('950000000000000','950500000000000','950600000000000','950800000000000','951000000000000') ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }


    function get_coa_other_revenue_sum($thn, $bln, $level)
    {

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Other Revenue' and `level` = '$level' AND noac IN ('901000000000000','900900000000000','900100000000000','900450000000000','900500000000000','900700000000000') ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }


    function get_coa_revenue_sum($thn, $bln, $level)
    {

        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo" . $bln . "c AS saldo_c,
                        saldo" . $bln . "d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Revenue' AND `level` = '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }


    function get_data_sum_entry_buku_besar($periode_terkini, $tgl_start, $tgl_end, $divisi_start, $divisi_end, $noacc_start, $noacc_end)
    {

        //$//sess_periode = $this->session->userdata('sess_periode');
        $periodes = substr($this->session->userdata('sess_periode'), 0, 4) . '-' . substr($this->session->userdata('sess_periode'), 4, 6);

        $dv_start;
        if (($divisi_start == '-') && ($divisi_end == '-')) {
            $dv_start = "";
        } else if ($divisi_start != '-' && $divisi_end == '-') {
            $dv_start = "AND sbu = '" . $divisi_start . "'";
        } else if ($divisi_start != '-' && $divisi_end != '-') {
            $dv_start = "AND sbu >= '" . $divisi_start . "' AND sbu <= '" . $divisi_end . "'";
        } else {
            $dv_start = "";
        }

        $acc;
        if ($noacc_start == 0 && $noacc_end == 0) {
            $acc = "";
        } else if ($noacc_start != 0 && $noacc_end == 0) {
            $acc = "AND noac = " . $noacc_start . "";
        } else if ($noacc_start != 0 && $noacc_end != 0) {
            $acc = "AND noac >= " . $noacc_start . " AND noac <= " . $noacc_end . "";
        } else {
            $acc = "";
        }

        if ($periode_terkini == 1) { //ini artinya pakai periode, filter tanggal tidak berlaku

            $sql = "SELECT SUM(dr) DEBET,SUM(cr) CREDIT FROM entry WHERE STR_TO_DATE(periode, '%Y-%m') = STR_TO_DATE('$periodes', '%Y-%m') $dv_start $acc ORDER BY `date`,noac ASC";
            return $this->mips_gl->query($sql);
        } else {

            $sql = "SELECT SUM(dr) DEBET,SUM(cr) CREDIT FROM entry WHERE DATE(`DATE`) >= STR_TO_DATE('$tgl_start', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl_end', '%d-%m-%Y') $dv_start $acc  ORDER BY `date`,noac ASC"; /*ORDER BY `DATE`,dr DESC*/
            return $this->mips_gl->query($sql);
        }
    }
}
