<?php
class Cash_bank_model extends CI_Model
{

    //nama tabel dari database
    var $table = 'pp_logistik';
    //field yang ada di table user
    var $column_order = array(null, 'user_nama', 'user_email', 'user_alamat');
    var $column_search = array('nopp', 'ref_po', 'nopo'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'asc'); // default order

    function __construct()
    {
        parent::__construct();
        // $this->mips_caba = $this->load->database('mips_caba', TRUE);
        $db_pt = check_db_pt();

        // db center noac
        $this->mips_center  = $this->load->database('mips_center', TRUE);

        $this->mstcode = $this->load->database('mstcode', TRUE);
        $this->mips_logistik = $this->load->database('mips_logistik_' . $db_pt, TRUE);
    }


    function master_detail_account($acct_no, $acct_id)
    {
        /* selama expose ke pks saya ubah mips caba */
        $sql = "SELECT noid,noac,nama FROM noac where noid = '$acct_id' and noac = '$acct_no'";

        return $this->mips_center->query($sql);
        //return $this->mstcode->query($sql);
    }

    function username()
    {
        return $this->session->userdata('sess_id');
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

    function get_acct_supplier()
    {
        return '3010';
    }

    function periode()
    {
        return $this->session->userdata('sess_periode');
    }

    function get_bank()
    {
        /* sementar di ubah selama expose ke pks */
        $sql = "SELECT * FROM noac ORDER BY NOID ASC";
        return $this->mips_center->query($sql);
    }

    function get_data_noac()
    {
        $sql = "SELECT * FROM noac ORDER BY NOID ASC";
        return $this->mips_center->query($sql);
    }

    function simpan_voucher_header_lanjutan($data)
    {

        $user_id = $this->session->userdata('sess_nama');
        $lokasi  = $this->get_nama_lokasi();

        $id_user = $this->session->userdata('sess_id');

        $jumlah_amount    = str_replace(",", "", $data['jumlah']);


        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $ceknoref = 0;
        $nopp = 0;

        $ceknoref = $data['noref_select'] . ' ' . $data['no_ref'];
        $nopp     = $data['no_ref'];

        $sql1 = "SELECT * FROM voucher_tmp where id_user = '$id_user' ORDER BY ID DESC";
        $m = $this->mips_caba->query($sql1)->row_array();

        $k = $this->mips_caba->query("SELECT VOUCNO FROM voucher_tmp where id_user = '$id_user' AND PAY != ''")->row();
        /* GET VOCHER ITEM */
        $voucher_item = $this->mips_caba->query("SELECT VOUCNO FROM voucher_tmp where id_user = '$id_user' AND PAY = ''")->row();
        /* END */

        // ini select dulu ke table tmp , lalu insert ke table voucher dengan fungsi insert batch
        if ($lokasi != 'HO') {

            $sql2 = "SELECT  `TRANS`, `VOUCNO`, `DATE`, `ACCTNO`, `DEBIT`, `CREDIT`, `DESCRIPT`, `JENIS`, `CHEQNO`, `TO`, `FROM`, `PAY`, `AMOUNT`, `BANK`, `POSTED`, `REMARKS`, `LOKASI`, `PROJECT`, `PRINTED`, `TGLTXT`, `KODE_PT`, `txtperiode`, `MODULE`, `user`, `NO_PP`, `NO_PO`, `PDO`, `sumber` FROM `voucher_tmp` WHERE `id_user` = '$id_user' ORDER BY ID ASC";
        } else {
            $sql2 = "SELECT  `TRANS`, `VOUCNO`, `DATE`, `ACCTNO`, `DEBIT`, `CREDIT`, `DESCRIPT`, `JENIS`, `CHEQNO`, `TO`, `FROM`, `PAY`, `AMOUNT`, `BANK`, `POSTED`, `REMARKS`, `LOKASI`, `PROJECT`, `PRINTED`, `TGLTXT`, `KODE_PT`, `txtperiode`, `MODULE`, `user`, `NO_PP`, `NO_PO` FROM `voucher_tmp` WHERE `id_user` = '$id_user' ORDER BY ID ASC";
        }
        // $n = $this->mips_caba->query($sql2)->result_array();
        $n = $this->mips_caba->query($sql2)->result();

        // fungsi insert batch
        foreach ($n as $ds) {
            $dt_vou['TRANS'] = $ds->TRANS;
            $dt_vou['VOUCNO'] = $ds->VOUCNO;
            $dt_vou['DATE'] = $ds->DATE;
            $dt_vou['ACCTNO'] = $ds->ACCTNO;
            $dt_vou['DEBIT'] = $ds->DEBIT;
            $dt_vou['CREDIT'] = $ds->CREDIT;
            $dt_vou['DESCRIPT'] = $ds->DESCRIPT;
            $dt_vou['JENIS'] = $ds->JENIS;
            $dt_vou['CHEQNO'] = $ds->CHEQNO;
            $dt_vou['TO'] = $ds->TO;
            $dt_vou['FROM'] = $ds->FROM;
            $dt_vou['PAY'] = $ds->PAY;
            $dt_vou['AMOUNT'] = $ds->AMOUNT;
            $dt_vou['BANK'] = $ds->BANK;
            $dt_vou['POSTED'] = $ds->POSTED;
            $dt_vou['REMARKS'] = $ds->REMARKS;
            $dt_vou['LOKASI'] = $ds->LOKASI;
            $dt_vou['PROJECT'] = $ds->PROJECT;
            $dt_vou['PRINTED'] = $ds->PRINTED;
            $dt_vou['TGLTXT'] = $ds->TGLTXT;
            $dt_vou['KODE_PT'] = $ds->KODE_PT;
            $dt_vou['txtperiode'] = $ds->txtperiode;
            $dt_vou['MODULE'] = $ds->MODULE;
            $dt_vou['user'] = $ds->user;
            $dt_vou['NO_PP'] = $ds->NO_PP;
            $dt_vou['NO_PO'] = $ds->NO_PO;
            if ($lokasi != 'HO') {

                $dt_vou['PDO'] = $ds->PDO;
                $dt_vou['sumber'] = $ds->sumber;
            }

            $this->mips_caba->insert('voucher', $dt_vou);
        }


        // $this->mips_caba->insert_batch('voucher', $n)

        //hapus yang ada di table voucher tmp

        //ini untuk ambil urutan BANK, karna di select bank saya kasih 3 value {1:NO ACCOUNT, 2:NAMA BANK , 3:NO URUT SELECT : 1-10}
        $value_bank = $data['bank_descript'];
        $exploded_value_bank = explode('|', $value_bank);
        $value_one_bank   = $exploded_value_bank[0]; // NO ACCOUNT
        $value_two_bank   = $exploded_value_bank[1]; // NAMA BANG
        $value_three_bank = $exploded_value_bank[2]; // NO URUT

        $namabankvalue = str_replace("_", " ", $value_two_bank);
        //sebelumnya : $data[bank_descript]


        //ini untuk insert noac
        $noacs = "SELECT general FROM noac WHERE noac = '$value_one_bank'";
        $ks = $this->mips_center->query($noacs)->row_array();

        $noacsa = "SELECT nama FROM noac WHERE noac = '$ks[general]'";
        $kss = $this->mips_center->query($noacsa)->row_array();
        $namageneral = str_replace("_", " ", $kss['nama']);






        if ($data['pay_rec'] == 'Payment') {
            $headvocher = $this->mips_caba->query("SELECT ACCTNO, DESCRIPT, DEBIT, CREDIT FROM voucher WHERE VOUCNO='$k->VOUCNO' AND CREDIT <> 0 ORDER BY ID DESC LIMIT 1")->row();
        } else {
            $headvocher = $this->mips_caba->query("SELECT ACCTNO, DESCRIPT, DEBIT, CREDIT FROM voucher WHERE VOUCNO='$k->VOUCNO' AND DEBIT <> 0 ORDER BY ID DESC LIMIT 1")->row();
        }


        //selain ho maka ada PDO dan SUMBER
        if ($lokasi != 'HO') { // INI ESTATE


            //$nominalsumber = str_replace(",","",$data['sumber_dana_nominal']);

            $nomorsumber = $data['sumber_dana_nominal'];


            //ini untuk ambil urutan BANK, karna di select bank saya kasih 2 value {1:NAMA BANK , 2:NO URUT SELECT : 1-10}
            $value_sumber_dana              = $data['sumber_dana'];
            $exploded_value_sumber_dana     = explode('|', $value_sumber_dana);
            $value_one_sumber_dana          = $exploded_value_sumber_dana[0]; // INI NAMA
            $value_two_sumber_dana          = $exploded_value_sumber_dana[1]; // NO URUT


            $sql['TRANS'] = $data['kas_bank'];
            $sql['VOUCNO'] = $k->VOUCNO;
            // $sql['DATE'] = $data['tanggal'];
            $sql['DATE'] = date('Y-m-d', strtotime($data['tanggal']));
            $sql['ACCTNO'] = $headvocher->ACCTNO;
            $sql['DESCRIPT'] = $headvocher->DESCRIPT;
            $sql['GENERAL'] = $namageneral;
            $sql['JENIS'] = $data['pay_rec'];
            $sql['FROM'] = $data['kepada'];
            $sql['PAY'] = $data['terbilang'];
            $sql['AMOUNT'] = $jumlah_amount;
            $sql['BANK'] = $namabankvalue;
            $sql['POSTED'] = 0;
            $sql['REMARKS'] = $m['REMARKS'];
            $sql['LOKASI'] = $lokasi;
            $sql['TGLTXT'] = $tgltxt;
            $sql['KODE_PT'] = $m['KODE_PT'];
            $sql['txtperiode'] = $tgltxtperiode;
            $sql['NAMA_REF'] = $data['noref_select'];
            $sql['KODE_REF'] = $data['KODE_REF'];
            $sql['TGLCEK'] = date('Y-m-d H:i:s');
            $sql['user'] = $user_id;
            $sql['PDO'] = $value_one_sumber_dana;
            $sql['sumber'] = $nomorsumber;
            $sql['tglinput'] = date('Y-m-d H:i:s');

            $headrs = $this->mips_caba->insert('head_voucher', $sql);




            /* end posting harian */
        } else { // INI HO



            $sql['TRANS'] = $data['kas_bank'];
            $sql['VOUCNO'] = $k->VOUCNO;
            // $sql['DATE'] = $data['tanggal'];
            $sql['DATE'] = date('Y-m-d', strtotime($data['tanggal']));
            $sql['ACCTNO'] = $headvocher->ACCTNO;
            $sql['DESCRIPT'] = $headvocher->DESCRIPT;
            $sql['GENERAL'] = $namageneral;
            $sql['JENIS'] = $data['pay_rec'];
            $sql['FROM'] = $data['kepada'];
            $sql['PAY'] = $data['terbilang'];
            $sql['AMOUNT'] = $jumlah_amount;
            $sql['BANK'] = $namabankvalue;
            $sql['REMARKS'] = $m['REMARKS'];
            $sql['LOKASI'] = $lokasi;
            $sql['TGLTXT'] = $tgltxt;
            $sql['KODE_PT'] = $m['KODE_PT'];
            $sql['txtperiode'] = $tgltxtperiode;
            $sql['NAMA_REF'] = $data['noref_select'];
            $sql['KODE_REF'] = $data['KODE_REF'];
            $sql['TGLCEK'] = date('Y-m-d H:i:s');
            $sql['user'] = $user_id;
            $sql['tglinput'] = date('Y-m-d H:i:s');
            $headrs = $this->mips_caba->insert('head_voucher', $sql);
        }

        $sql3 = "DELETE FROM voucher_tmp WHERE id_user = '$id_user'";
        $this->mips_caba->query($sql3);



        //parameter untuk pengkategorian payment dan receive untuk memanggil configuration.
        // $pt          = $this->get_sess_pt();
        $pt = $this->session->userdata('sess_pt');
        //$lokasi      = $data['lokasi_users'];
        $kas_or_bank = $data['kas_bank'];




        //Ini untuk pengambilan kode urut
        if ($lokasi == 'HO') { // HO


            //filter : payment
            if ($data['pay_rec'] == 'Payment') {

                //filter : kas
                if ($kas_or_bank == 'Kas') {

                    $sql4 = "SELECT pay_nokas, pay_inikas FROM konfigur WHERE lokasi = '$lokasi' and pt = '$pt'";
                    $res = $this->mips_caba->query($sql4)->row_array();

                    $no_urut_pay      = $res['pay_nokas'];
                    $ditambah         = 1;
                    $no_urut_terakhir = $ditambah + $no_urut_pay;

                    //ini fungsi untuk menambah angka nol di depan
                    // $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                    $inisial_pay      = $res['pay_inikas'];
                    // $nofix            = $inisial_pay . '' . $fzeropadded;
                    $nofix            = $inisial_pay . sprintf("%03s", $no_urut_terakhir);

                    //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                    //voucher detail
                    $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                    $this->mips_caba->query($sql88);
                    //voucher header
                    $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                    $this->mips_caba->query($sql99);

                    //START : ini fungsi untuk update table pp_logistik
                    if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                    } else {

                        //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                        $slq_logistik = "SELECT NO_PP, NO_PO, DEBIT FROM voucher WHERE voucno  = '$nofix'";
                        $k = $this->mips_caba->query($slq_logistik)->result_array();

                        foreach ($k as $c) {
                            $cls_date = new DateTime($data['tanggal']);
                            $tgls     = $cls_date->format('Ymd');
                            $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1
                                                            WHERE nopp  = '$c[NO_PP]'";
                            $this->mips_caba->query($sq_logistik);

                            $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                        no_voutxt  = '$nofix',
                                                        tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                        tgl_voutxt = '$tgls',
                                                        status_vou = 1,
                                                        kasir_bayar = '$c[DEBIT]'
                                                        WHERE nopp  = '$c[NO_PP]'";
                            $this->mips_logistik->query($pplogis);

                            //update status logistik menjadi 1 kalo sudah lunas
                            $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                            $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                            $sum_item_po = $r_ipo['jumlah'];

                            $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                            $r_icb = $this->mips_caba->query($icb)->row_array();
                            $sum_item_cb = $r_icb['jumlah'];

                            if ($sum_item_cb >= $sum_item_po) {
                                $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar   = '1',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                $this->mips_logistik->query($ipoa);
                            } else {
                                //belum diupdate menjadi lunas
                                $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                $this->mips_logistik->query($ipoa);
                            }
                        }
                    }
                    //END : ini fungsi untuk update table pp_logistik



                    //update configur
                    $sql11 = "UPDATE konfigur SET pay_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                    $this->mips_caba->query($sql11);
                } else if ($kas_or_bank == 'Bank') {

                    //untuk select 'PAYMENT' HO, VALUE BANK ADA 10 JUMLAHNYA, jadi kita harus pecah satu satu

                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT pay_nobank1 as no_bank,pay_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            /*$no_urut_pay      = $res['no_bank'];
                        //ini fungsi untuk menambah angka nol di depan
                        $fzeropadded      = sprintf("%03d", $no_urut_pay);

                        $inisial_pay      = $res['ini_bank'];
                        $nofix            = $inisial_pay.''.$fzeropadded;
                        $ditambah         = 1;
                        $no_urut_terakhir = $no_urut_pay+$ditambah;*/

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                            no_voutxt  = '$nofix',
                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                            tgl_voutxt = '$tgls',
                                                            status_vou = 1,
                                                            kasir_bayar = '$c[DEBIT]'
                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '1',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT pay_nobank2 as no_bank,pay_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                            no_voutxt  = '$nofix',
                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                            tgl_voutxt = '$tgls',
                                                            status_vou = 1,
                                                            kasir_bayar = '$c[DEBIT]'
                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '1',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT pay_nobank3 as no_bank,pay_inibank3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                        no_voutxt  = '$nofix',
                                                        tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                        tgl_voutxt = '$tgls',
                                                        status_vou = 1,
                                                        kasir_bayar = '$c[DEBIT]'
                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    //where nya di tambah account depannya 3010
                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '1',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT pay_nobank4 as no_bank,pay_inibank4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();


                            if ($res['no_bank'] == 0) {
                                $no_urut_pay = 1;
                            } else {
                                $no_urut_pay = $res['no_bank'];
                            }

                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT pay_nobank5 as no_bank,pay_inibank5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "6":

                            $sql4 = "SELECT pay_nobank6 as no_bank,pay_inibank6 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank6  = '$no_urut_terakhir',lokasi = '$lokasi' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "7":

                            $sql4 = "SELECT pay_nobank7 as no_bank,pay_inibank7 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank7  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "8":

                            $sql4 = "SELECT pay_nobank8 as no_bank,pay_inibank8 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank8  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "9":

                            $sql4 = "SELECT pay_nobank9 as no_bank,pay_inibank9 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank9  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "10":

                            $sql4 = "SELECT pay_nobank10 as no_bank,pay_inibank10 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank10  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                } else {
                    //ini untuk RO kayany
                }
            } else if ($data['pay_rec'] == 'Receive') {


                if ($kas_or_bank == 'Kas') {

                    $sql4 = "SELECT rec_nokas,rec_inikas FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                    $res = $this->mips_caba->query($sql4)->row_array();

                    $no_urut_rec    = $res['rec_nokas'];
                    //ini fungsi untuk menambah angka nol di depan
                    $fzeropadded      = sprintf("%03d", $no_urut_rec);


                    $inisial_rec    = $res['rec_inikas'];
                    $nofix            = $inisial_rec . '' . $fzeropadded;
                    $ditambah         = 1;
                    $no_urut_terakhir = $ditambah + $no_urut_rec;
                    //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                    //voucher detail
                    $sql88 = "UPDATE voucher SET voucno  = '$nofix' WHERE voucno = '$voucher_item->VOUCNO'";
                    $this->mips_caba->query($sql88);
                    //voucher header
                    $sql99 = "UPDATE head_voucher SET voucno  = '$nofix' WHERE voucno = '$k->VOUCNO'";
                    $this->mips_caba->query($sql99);

                    //START : ini fungsi untuk update table pp_logistik
                    if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                    } else {

                        //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                        $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                        $k = $this->mips_caba->query($slq_logistik)->result_array();

                        foreach ($k as $c) {
                            $cls_date = new DateTime($data['tanggal']);
                            $tgls     = $cls_date->format('Ymd');
                            $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                            $this->mips_caba->query($sq_logistik);

                            $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                            $this->mips_logistik->query($pplogis);

                            //update status logistik menjadi 1 kalo sudah lunas
                            $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                            $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                            $sum_item_po = $r_ipo['jumlah'];

                            $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                            $r_icb = $this->mips_caba->query($icb)->row_array();
                            $sum_item_cb = $r_icb['jumlah'];

                            if ($sum_item_cb >= $sum_item_po) {
                                $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                $this->mips_logistik->query($ipoa);
                            } else {
                                //belum diupdate menjadi lunas
                                $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                $this->mips_logistik->query($ipoa);
                            }
                        }
                    }
                    //END : ini fungsi untuk update table pp_logistik

                    //update configur
                    $sql11 = "UPDATE konfigur SET rec_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                    $this->mips_caba->query($sql11);
                } else if ($kas_or_bank == 'Bank') {

                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT rec_nobank1 as no_bank,rec_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            /*$no_urut_rec      = $res['no_bank'];
                        //ini fungsi untuk menambah angka nol di depan
                        $fzeropadded      = sprintf("%03d", $no_urut_rec);

                        $inisial_rec      = $res['ini_bank'];
                        $nofix            = $inisial_rec.''.$fzeropadded;
                        $ditambah         = 1;
                        $no_urut_terakhir = $no_urut_rec+$ditambah;*/

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT rec_nobank2 as no_bank,rec_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT rec_nobank3 as no_bank,rec_inibank3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT rec_nobank4 as no_bank,rec_inibank4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;

                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT rec_nobank5 as no_bank,rec_inibank5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "6":

                            $sql4 = "SELECT rec_nobank6 as no_bank,rec_inibank6 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank6  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "7":

                            $sql4 = "SELECT rec_nobank7 as no_bank,rec_inibank7 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank7  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "8":

                            $sql4 = "SELECT rec_nobank8 as no_bank,rec_inibank8 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar   = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank8  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "9":

                            $sql4 = "SELECT rec_nobank9 as no_bank,rec_inibank9 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank9  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "10":

                            $sql4 = "SELECT rec_nobank10 as no_bank,rec_inibank10 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank10  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                }
            } else {

                // jika else tidak ada aksi apa2

            }
        } else if ($lokasi == 'ESTATE') { // ESTATE


            //ini untuk ambil urutan BANK, karna di select bank saya kasih 2 value {1:NAMA BANK , 2:NO URUT SELECT : 1-10}
            $value_sumber_dana              = $data['sumber_dana'];
            $exploded_value_sumber_dana     = explode('|', $value_sumber_dana);
            $value_one_sumber_dana          = $exploded_value_sumber_dana[0]; // INI NAMA
            $value_two_sumber_dana          = $exploded_value_sumber_dana[1]; // NO URUT



            //filter : payment atau Receive
            if ($data['pay_rec'] == 'Payment') {

                //filter : kas atau bank
                if ($kas_or_bank == 'Kas') {

                    switch ($value_two_sumber_dana) {
                        case "1":

                            $sql4 = "SELECT pay_nokas as no_bank,pay_inikas as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix', lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix', lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT pay_nokas2 as no_bank,pay_inikas2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT pay_nokas3 as no_bank,pay_inikas3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT pay_nokas4 as no_bank,pay_inikas4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT pay_nokas5 as no_bank, pay_inikas5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);


                            break;
                        default:
                            echo "Konten Tidak Tersedia !";
                    }
                } else if ($kas_or_bank == 'Bank') {


                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT pay_nobank1 as no_bank,pay_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            /*$no_urut_pay      = $res['no_bank'];
                                    //ini fungsi untuk menambah angka nol di depan
                                    $fzeropadded      = sprintf("%03d", $no_urut_pay);

                                    $inisial_pay      = $res['ini_bank'];
                                    $nofix            = $inisial_pay.''.$fzeropadded;
                                    $ditambah         = 1;
                                    $no_urut_terakhir = $no_urut_pay+$ditambah;*/

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT pay_nobank2 as no_bank,pay_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT pay_nobank3 as no_bank,pay_inibank3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT pay_nobank4 as no_bank,pay_inibank4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;

                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                } else {
                }
            } else if ($data['pay_rec'] == 'Receive') {

                //filter : kas atau bank
                if ($kas_or_bank == 'Kas') {

                    switch ($value_two_sumber_dana) {
                        case "1":

                            $sql4 = "SELECT rec_nokas as no_bank,rec_inikas as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT rec_nokas2 as no_bank,rec_inikas2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT rec_nokas3 as no_bank,rec_inikas3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT rec_nokas4 as no_bank,rec_inikas4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT rec_nokas5 as no_bank,rec_inikas5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');

                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp     = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                         terbayar  = '2',
                                                                         nopp     = '$c[NO_PP]'
                                                                WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);


                            break;
                        default:
                            echo "Konten Tidak Tersedia !";
                    }
                } else if ($kas_or_bank == 'Bank') {


                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT rec_nobank1 as no_bank,rec_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET  voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT rec_nobank2 as no_bank,rec_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;

                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                } else {
                }
            }
        } else {

            //ini untuk ambil urutan BANK, karna di select bank saya kasih 2 value {1:NAMA BANK , 2:NO URUT SELECT : 1-10}
            $value_sumber_dana              = $data['sumber_dana'];
            $exploded_value_sumber_dana     = explode('|', $value_sumber_dana);
            $value_one_sumber_dana          = $exploded_value_sumber_dana[0]; // INI NAMA
            $value_two_sumber_dana          = $exploded_value_sumber_dana[1]; // NO URUT



            //filter : payment atau Receive
            if ($data['pay_rec'] == 'Payment') {

                //filter : kas atau bank
                if ($kas_or_bank == 'Kas') {

                    switch ($value_two_sumber_dana) {
                        case "1":

                            $sql4 = "SELECT pay_nokas as no_bank,pay_inikas as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix', lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix', lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT pay_nokas2 as no_bank,pay_inikas2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT pay_nokas3 as no_bank,pay_inikas3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT pay_nokas4 as no_bank,pay_inikas4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT pay_nokas5 as no_bank, pay_inikas5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);


                            break;
                        default:
                            echo "Konten Tidak Tersedia !";
                    }
                } else if ($kas_or_bank == 'Bank') {


                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT pay_nobank1 as no_bank,pay_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            /*$no_urut_pay      = $res['no_bank'];
                                    //ini fungsi untuk menambah angka nol di depan
                                    $fzeropadded      = sprintf("%03d", $no_urut_pay);

                                    $inisial_pay      = $res['ini_bank'];
                                    $nofix            = $inisial_pay.''.$fzeropadded;
                                    $ditambah         = 1;
                                    $no_urut_terakhir = $no_urut_pay+$ditambah;*/

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT pay_nobank2 as no_bank,pay_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT pay_nobank3 as no_bank,pay_inibank3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT pay_nobank4 as no_bank,pay_inibank4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;

                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                } else {
                }
            } else if ($data['pay_rec'] == 'Receive') {

                //filter : kas atau bank
                if ($kas_or_bank == 'Kas') {

                    switch ($value_two_sumber_dana) {
                        case "1":

                            $sql4 = "SELECT rec_nokas as no_bank,rec_inikas as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT rec_nokas2 as no_bank,rec_inikas2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT rec_nokas3 as no_bank,rec_inikas3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT rec_nokas4 as no_bank,rec_inikas4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT rec_nokas5 as no_bank,rec_inikas5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');

                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp     = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                         terbayar  = '2',
                                                                         nopp     = '$c[NO_PP]'
                                                                WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);


                            break;
                        default:
                            echo "Konten Tidak Tersedia !";
                    }
                } else if ($kas_or_bank == 'Bank') {


                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT rec_nobank1 as no_bank,rec_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET  voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT rec_nobank2 as no_bank,rec_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$voucher_item->VOUCNO'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$k->VOUCNO'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;

                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                } else {
                }
            }
        }
        $pay = $data['pay_rec'];
        $status = [
            'status' => $headrs,
            'head' => $sql['ACCTNO'],
            'jml' => $jumlah_amount,
            'pay' => $data['pay_rec']
        ];
        return $status;
    }

    function simpan_voucher_header($data)
    {

        $user_id = $this->session->userdata('sess_nama');
        $lokasi  = $this->get_nama_lokasi();

        $jumlah_amount    = str_replace(",", "", $data['jumlah']);


        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $ceknoref = 0;
        $nopp = 0;

        $ceknoref = $data['noref_select'] . ' ' . $data['no_ref'];
        $nopp     = $data['no_ref'];

        $sql1 = "SELECT * FROM voucher_tmp where VOUCNO = '$data[kode_sementara]' ORDER BY ID DESC";
        $m = $this->mips_caba->query($sql1)->row_array();

        // ini select dulu ke table tmp , lalu insert ke table voucher dengan fungsi insert batch
        $sql2 = "SELECT  `TRANS`, `VOUCNO`, `DATE`, `ACCTNO`, `DEBIT`, `CREDIT`, `DESCRIPT`, `JENIS`, `CHEQNO`, `TO`, `FROM`, `PAY`, `AMOUNT`, `BANK`, `POSTED`, `REMARKS`, `LOKASI`, `PROJECT`, `PRINTED`, `TGLTXT`, `KODE_PT`, `txtperiode`, `MODULE`, `user`, `NO_PP`, `NO_PO`, `PDO`, `sumber` FROM `voucher_tmp` WHERE `VOUCNO` = '$data[kode_sementara]' ORDER BY ID ASC";
        // $n = $this->mips_caba->query($sql2)->result_array();
        $n = $this->mips_caba->query($sql2)->result();

        // fungsi insert batch
        foreach ($n as $ds) {
            $dt_vou['TRANS'] = $ds->TRANS;
            $dt_vou['VOUCNO'] = $ds->VOUCNO;
            $dt_vou['DATE'] = $ds->DATE;
            $dt_vou['ACCTNO'] = $ds->ACCTNO;
            $dt_vou['DEBIT'] = $ds->DEBIT;
            $dt_vou['CREDIT'] = $ds->CREDIT;
            $dt_vou['DESCRIPT'] = $ds->DESCRIPT;
            $dt_vou['JENIS'] = $ds->JENIS;
            $dt_vou['CHEQNO'] = $ds->CHEQNO;
            $dt_vou['TO'] = $ds->TO;
            $dt_vou['FROM'] = $ds->FROM;
            $dt_vou['PAY'] = $ds->PAY;
            $dt_vou['AMOUNT'] = $ds->AMOUNT;
            $dt_vou['BANK'] = $ds->BANK;
            $dt_vou['POSTED'] = $ds->POSTED;
            $dt_vou['REMARKS'] = $ds->REMARKS;
            $dt_vou['LOKASI'] = $ds->LOKASI;
            $dt_vou['PROJECT'] = $ds->PROJECT;
            $dt_vou['PRINTED'] = $ds->PRINTED;
            $dt_vou['TGLTXT'] = $ds->TGLTXT;
            $dt_vou['KODE_PT'] = $ds->KODE_PT;
            $dt_vou['txtperiode'] = $ds->txtperiode;
            $dt_vou['MODULE'] = $ds->MODULE;
            $dt_vou['user'] = $ds->user;
            $dt_vou['NO_PP'] = $ds->NO_PP;
            $dt_vou['NO_PO'] = $ds->NO_PO;
            if ($lokasi != 'HO') {

                $dt_vou['PDO'] = $ds->PDO;
                $dt_vou['sumber'] = $ds->sumber;
            }

            $this->mips_caba->insert('voucher', $dt_vou);
        }


        // $this->mips_caba->insert_batch('voucher', $n)

        //hapus yang ada di table voucher tmp

        //ini untuk ambil urutan BANK, karna di select bank saya kasih 3 value {1:NO ACCOUNT, 2:NAMA BANK , 3:NO URUT SELECT : 1-10}
        $value_bank = $data['bank_descript'];
        $exploded_value_bank = explode('|', $value_bank);
        $value_one_bank   = $exploded_value_bank[0]; // NO ACCOUNT
        $value_two_bank   = $exploded_value_bank[1]; // NAMA BANG
        $value_three_bank = $exploded_value_bank[2]; // NO URUT

        $namabankvalue = str_replace("_", " ", $value_two_bank);
        //sebelumnya : $data[bank_descript]


        //ini untuk insert noac
        $noacs = "SELECT general FROM noac WHERE noac = '$value_one_bank'";
        $ks = $this->mips_center->query($noacs)->row_array();

        $noacsa = "SELECT nama FROM noac WHERE noac = '$ks[general]'";
        $kss = $this->mips_center->query($noacsa)->row_array();
        $namageneral = str_replace("_", " ", $kss['nama']);




        if ($data['pay_rec'] == 'Payment') {
            $headvocher = $this->mips_caba->query("SELECT ACCTNO, DESCRIPT, DEBIT, CREDIT FROM voucher WHERE VOUCNO='$data[kode_sementara]' AND CREDIT <> 0 ORDER BY ID DESC LIMIT 1")->row();
        } else {
            $headvocher = $this->mips_caba->query("SELECT ACCTNO, DESCRIPT, DEBIT, CREDIT FROM voucher WHERE VOUCNO='$data[kode_sementara]' AND DEBIT <> 0 ORDER BY ID DESC LIMIT 1")->row();
        }


        //selain ho maka ada PDO dan SUMBER
        if ($lokasi != 'HO') { // INI ESTATE


            //$nominalsumber = str_replace(",","",$data['sumber_dana_nominal']);

            $nomorsumber = $data['sumber_dana_nominal'];


            //ini untuk ambil urutan BANK, karna di select bank saya kasih 2 value {1:NAMA BANK , 2:NO URUT SELECT : 1-10}
            $value_sumber_dana              = $data['sumber_dana'];
            $exploded_value_sumber_dana     = explode('|', $value_sumber_dana);
            $value_one_sumber_dana          = $exploded_value_sumber_dana[0]; // INI NAMA
            $value_two_sumber_dana          = $exploded_value_sumber_dana[1]; // NO URUT


            $sql['TRANS'] = $data['kas_bank'];
            $sql['VOUCNO'] = $data['kode_sementara'];
            // $sql['DATE'] = $data['tanggal'];
            $sql['DATE'] = date('Y-m-d', strtotime($data['tanggal']));
            $sql['ACCTNO'] = $headvocher->ACCTNO;
            $sql['DESCRIPT'] = $headvocher->DESCRIPT;
            $sql['GENERAL'] = $namageneral;
            $sql['JENIS'] = $data['pay_rec'];
            $sql['FROM'] = $data['kepada'];
            $sql['PAY'] = $data['terbilang'];
            $sql['AMOUNT'] = $jumlah_amount;
            $sql['BANK'] = $namabankvalue;
            $sql['POSTED'] = 0;
            $sql['REMARKS'] = $m['REMARKS'];
            $sql['LOKASI'] = $lokasi;
            $sql['TGLTXT'] = $tgltxt;
            $sql['KODE_PT'] = $m['KODE_PT'];
            $sql['txtperiode'] = $tgltxtperiode;
            $sql['NAMA_REF'] = $data['noref_select'];
            $sql['KODE_REF'] = $data['KODE_REF'];
            $sql['TGLCEK'] = date('Y-m-d H:i:s');
            $sql['user'] = $user_id;
            $sql['PDO'] = $value_one_sumber_dana;
            $sql['sumber'] = $nomorsumber;
            $sql['tglinput'] = date('Y-m-d H:i:s');

            $headrs = $this->mips_caba->insert('head_voucher', $sql);




            /* end posting harian */
        } else { // INI HO



            $sql['TRANS'] = $data['kas_bank'];
            $sql['VOUCNO'] = $data['kode_sementara'];
            // $sql['DATE'] = $data['tanggal'];
            $sql['DATE'] = date('Y-m-d', strtotime($data['tanggal']));
            $sql['ACCTNO'] = $headvocher->ACCTNO;
            $sql['DESCRIPT'] = $headvocher->DESCRIPT;
            $sql['GENERAL'] = $namageneral;
            $sql['JENIS'] = $data['pay_rec'];
            $sql['FROM'] = $data['kepada'];
            $sql['PAY'] = $data['terbilang'];
            $sql['AMOUNT'] = $jumlah_amount;
            $sql['BANK'] = $namabankvalue;
            $sql['REMARKS'] = $m['REMARKS'];
            $sql['LOKASI'] = $lokasi;
            $sql['TGLTXT'] = $tgltxt;
            $sql['KODE_PT'] = $m['KODE_PT'];
            $sql['txtperiode'] = $tgltxtperiode;
            $sql['NAMA_REF'] = $data['noref_select'];
            $sql['KODE_REF'] = $data['KODE_REF'];
            $sql['TGLCEK'] = date('Y-m-d H:i:s');
            $sql['user'] = $user_id;
            $sql['tglinput'] = date('Y-m-d H:i:s');
            $headrs = $this->mips_caba->insert('head_voucher', $sql);
        }

        $sql3 = "DELETE FROM voucher_tmp WHERE voucno = '$data[kode_sementara]'";
        $this->mips_caba->query($sql3);



        //parameter untuk pengkategorian payment dan receive untuk memanggil configuration.
        // $pt          = $this->get_sess_pt();
        $pt = $this->session->userdata('sess_pt');
        //$lokasi      = $data['lokasi_users'];
        $kas_or_bank = $data['kas_bank'];


        //Ini untuk pengambilan kode urut
        if ($lokasi == 'HO') { // HO


            //filter : payment
            if ($data['pay_rec'] == 'Payment') {

                //filter : kas
                if ($kas_or_bank == 'Kas') {

                    $sql4 = "SELECT pay_nokas, pay_inikas FROM konfigur WHERE lokasi = '$lokasi' and pt = '$pt'";
                    $res = $this->mips_caba->query($sql4)->row_array();

                    $no_urut_pay      = $res['pay_nokas'];
                    $ditambah         = 1;
                    $no_urut_terakhir = $ditambah + $no_urut_pay;

                    //ini fungsi untuk menambah angka nol di depan
                    // $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                    $inisial_pay      = $res['pay_inikas'];
                    // $nofix            = $inisial_pay . '' . $fzeropadded;
                    $nofix            = $inisial_pay . sprintf("%03s", $no_urut_terakhir);

                    //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                    //voucher detail
                    $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                    $this->mips_caba->query($sql88);
                    //voucher header
                    $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                    $this->mips_caba->query($sql99);

                    //START : ini fungsi untuk update table pp_logistik
                    if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                    } else {

                        //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                        $slq_logistik = "SELECT NO_PP, NO_PO, DEBIT FROM voucher WHERE voucno  = '$nofix'";
                        $k = $this->mips_caba->query($slq_logistik)->result_array();

                        foreach ($k as $c) {
                            $cls_date = new DateTime($data['tanggal']);
                            $tgls     = $cls_date->format('Ymd');
                            $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1
                                                            WHERE nopp  = '$c[NO_PP]'";
                            $this->mips_caba->query($sq_logistik);

                            $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                        no_voutxt  = '$nofix',
                                                        tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                        tgl_voutxt = '$tgls',
                                                        status_vou = 1,
                                                        kasir_bayar = '$c[DEBIT]'
                                                        WHERE nopp  = '$c[NO_PP]'";
                            $this->mips_logistik->query($pplogis);

                            //update status logistik menjadi 1 kalo sudah lunas
                            $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                            $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                            $sum_item_po = $r_ipo['jumlah'];

                            $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                            $r_icb = $this->mips_caba->query($icb)->row_array();
                            $sum_item_cb = $r_icb['jumlah'];

                            if ($sum_item_cb >= $sum_item_po) {
                                $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar   = '1',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                $this->mips_logistik->query($ipoa);
                            } else {
                                //belum diupdate menjadi lunas
                                $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                $this->mips_logistik->query($ipoa);
                            }
                        }
                    }
                    //END : ini fungsi untuk update table pp_logistik



                    //update configur
                    $sql11 = "UPDATE konfigur SET pay_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                    $this->mips_caba->query($sql11);
                } else if ($kas_or_bank == 'Bank') {

                    //untuk select 'PAYMENT' HO, VALUE BANK ADA 10 JUMLAHNYA, jadi kita harus pecah satu satu

                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT pay_nobank1 as no_bank,pay_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            /*$no_urut_pay      = $res['no_bank'];
                        //ini fungsi untuk menambah angka nol di depan
                        $fzeropadded      = sprintf("%03d", $no_urut_pay);

                        $inisial_pay      = $res['ini_bank'];
                        $nofix            = $inisial_pay.''.$fzeropadded;
                        $ditambah         = 1;
                        $no_urut_terakhir = $no_urut_pay+$ditambah;*/

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                            no_voutxt  = '$nofix',
                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                            tgl_voutxt = '$tgls',
                                                            status_vou = 1,
                                                            kasir_bayar = '$c[DEBIT]'
                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '1',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT pay_nobank2 as no_bank,pay_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                            no_voutxt  = '$nofix',
                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                            tgl_voutxt = '$tgls',
                                                            status_vou = 1,
                                                            kasir_bayar = '$c[DEBIT]'
                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '1',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT pay_nobank3 as no_bank,pay_inibank3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                        no_voutxt  = '$nofix',
                                                        tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                        tgl_voutxt = '$tgls',
                                                        status_vou = 1,
                                                        kasir_bayar = '$c[DEBIT]'
                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    //where nya di tambah account depannya 3010
                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '1',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT pay_nobank4 as no_bank,pay_inibank4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();


                            if ($res['no_bank'] == 0) {
                                $no_urut_pay = 1;
                            } else {
                                $no_urut_pay = $res['no_bank'];
                            }

                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT pay_nobank5 as no_bank,pay_inibank5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "6":

                            $sql4 = "SELECT pay_nobank6 as no_bank,pay_inibank6 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank6  = '$no_urut_terakhir',lokasi = '$lokasi' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "7":

                            $sql4 = "SELECT pay_nobank7 as no_bank,pay_inibank7 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank7  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "8":

                            $sql4 = "SELECT pay_nobank8 as no_bank,pay_inibank8 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank8  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "9":

                            $sql4 = "SELECT pay_nobank9 as no_bank,pay_inibank9 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank9  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "10":

                            $sql4 = "SELECT pay_nobank10 as no_bank,pay_inibank10 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank10  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                } else {
                    //ini untuk RO kayany
                }
            } else if ($data['pay_rec'] == 'Receive') {


                if ($kas_or_bank == 'Kas') {

                    $sql4 = "SELECT rec_nokas,rec_inikas FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                    $res = $this->mips_caba->query($sql4)->row_array();

                    $no_urut_rec    = $res['rec_nokas'];
                    //ini fungsi untuk menambah angka nol di depan
                    $fzeropadded      = sprintf("%03d", $no_urut_rec);


                    $inisial_rec    = $res['rec_inikas'];
                    $nofix            = $inisial_rec . '' . $fzeropadded;
                    $ditambah         = 1;
                    $no_urut_terakhir = $ditambah + $no_urut_rec;
                    //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                    //voucher detail
                    $sql88 = "UPDATE voucher SET voucno  = '$nofix' WHERE voucno = '$data[kode_sementara]'";
                    $this->mips_caba->query($sql88);
                    //voucher header
                    $sql99 = "UPDATE head_voucher SET voucno  = '$nofix' WHERE voucno = '$data[kode_sementara]'";
                    $this->mips_caba->query($sql99);

                    //START : ini fungsi untuk update table pp_logistik
                    if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                    } else {

                        //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                        $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                        $k = $this->mips_caba->query($slq_logistik)->result_array();

                        foreach ($k as $c) {
                            $cls_date = new DateTime($data['tanggal']);
                            $tgls     = $cls_date->format('Ymd');
                            $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                            $this->mips_caba->query($sq_logistik);

                            $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                            $this->mips_logistik->query($pplogis);

                            //update status logistik menjadi 1 kalo sudah lunas
                            $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                            $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                            $sum_item_po = $r_ipo['jumlah'];

                            $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                            $r_icb = $this->mips_caba->query($icb)->row_array();
                            $sum_item_cb = $r_icb['jumlah'];

                            if ($sum_item_cb >= $sum_item_po) {
                                $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                $this->mips_logistik->query($ipoa);
                            } else {
                                //belum diupdate menjadi lunas
                                $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                $this->mips_logistik->query($ipoa);
                            }
                        }
                    }
                    //END : ini fungsi untuk update table pp_logistik

                    //update configur
                    $sql11 = "UPDATE konfigur SET rec_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                    $this->mips_caba->query($sql11);
                } else if ($kas_or_bank == 'Bank') {

                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT rec_nobank1 as no_bank,rec_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            /*$no_urut_rec      = $res['no_bank'];
                        //ini fungsi untuk menambah angka nol di depan
                        $fzeropadded      = sprintf("%03d", $no_urut_rec);

                        $inisial_rec      = $res['ini_bank'];
                        $nofix            = $inisial_rec.''.$fzeropadded;
                        $ditambah         = 1;
                        $no_urut_terakhir = $no_urut_rec+$ditambah;*/

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT rec_nobank2 as no_bank,rec_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT rec_nobank3 as no_bank,rec_inibank3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT rec_nobank4 as no_bank,rec_inibank4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;

                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT rec_nobank5 as no_bank,rec_inibank5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "6":

                            $sql4 = "SELECT rec_nobank6 as no_bank,rec_inibank6 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank6  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "7":

                            $sql4 = "SELECT rec_nobank7 as no_bank,rec_inibank7 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank7  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "8":

                            $sql4 = "SELECT rec_nobank8 as no_bank,rec_inibank8 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar   = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank8  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "9":

                            $sql4 = "SELECT rec_nobank9 as no_bank,rec_inibank9 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank9  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "10":

                            $sql4 = "SELECT rec_nobank10 as no_bank,rec_inibank10 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            //ini fungsi untuk menambah angka nol di depan
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                    no_voutxt  = '$nofix',
                                                                    tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                    tgl_voutxt = '$tgls',
                                                                    status_vou = 1
                                                                WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                no_voutxt  = '$nofix',
                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                tgl_voutxt = '$tgls',
                                                                status_vou = 1,
                                                                kasir_bayar = '$c[DEBIT]'
                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                            terbayar  = '1',
                                                            nopp       = '$c[NO_PP]'
                                                            WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank10  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                }
            } else {

                // jika else tidak ada aksi apa2

            }
        } else if ($lokasi == 'ESTATE') { // ESTATE


            //ini untuk ambil urutan BANK, karna di select bank saya kasih 2 value {1:NAMA BANK , 2:NO URUT SELECT : 1-10}
            $value_sumber_dana              = $data['sumber_dana'];
            $exploded_value_sumber_dana     = explode('|', $value_sumber_dana);
            $value_one_sumber_dana          = $exploded_value_sumber_dana[0]; // INI NAMA
            $value_two_sumber_dana          = $exploded_value_sumber_dana[1]; // NO URUT



            //filter : payment atau Receive
            if ($data['pay_rec'] == 'Payment') {

                //filter : kas atau bank
                if ($kas_or_bank == 'Kas') {

                    switch ($value_two_sumber_dana) {
                        case "1":

                            $sql4 = "SELECT pay_nokas as no_bank,pay_inikas as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix', lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix', lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT pay_nokas2 as no_bank,pay_inikas2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT pay_nokas3 as no_bank,pay_inikas3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT pay_nokas4 as no_bank,pay_inikas4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT pay_nokas5 as no_bank, pay_inikas5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);


                            break;
                        default:
                            echo "Konten Tidak Tersedia !";
                    }
                } else if ($kas_or_bank == 'Bank') {


                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT pay_nobank1 as no_bank,pay_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            /*$no_urut_pay      = $res['no_bank'];
                                    //ini fungsi untuk menambah angka nol di depan
                                    $fzeropadded      = sprintf("%03d", $no_urut_pay);

                                    $inisial_pay      = $res['ini_bank'];
                                    $nofix            = $inisial_pay.''.$fzeropadded;
                                    $ditambah         = 1;
                                    $no_urut_terakhir = $no_urut_pay+$ditambah;*/

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT pay_nobank2 as no_bank,pay_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT pay_nobank3 as no_bank,pay_inibank3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT pay_nobank4 as no_bank,pay_inibank4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;

                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                } else {
                }
            } else if ($data['pay_rec'] == 'Receive') {

                //filter : kas atau bank
                if ($kas_or_bank == 'Kas') {

                    switch ($value_two_sumber_dana) {
                        case "1":

                            $sql4 = "SELECT rec_nokas as no_bank,rec_inikas as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT rec_nokas2 as no_bank,rec_inikas2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT rec_nokas3 as no_bank,rec_inikas3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT rec_nokas4 as no_bank,rec_inikas4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT rec_nokas5 as no_bank,rec_inikas5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');

                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp     = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                         terbayar  = '2',
                                                                         nopp     = '$c[NO_PP]'
                                                                WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);


                            break;
                        default:
                            echo "Konten Tidak Tersedia !";
                    }
                } else if ($kas_or_bank == 'Bank') {


                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT rec_nobank1 as no_bank,rec_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET  voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT rec_nobank2 as no_bank,rec_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;

                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                } else {
                }
            }
        } else {

            //ini untuk ambil urutan BANK, karna di select bank saya kasih 2 value {1:NAMA BANK , 2:NO URUT SELECT : 1-10}
            $value_sumber_dana              = $data['sumber_dana'];
            $exploded_value_sumber_dana     = explode('|', $value_sumber_dana);
            $value_one_sumber_dana          = $exploded_value_sumber_dana[0]; // INI NAMA
            $value_two_sumber_dana          = $exploded_value_sumber_dana[1]; // NO URUT



            //filter : payment atau Receive
            if ($data['pay_rec'] == 'Payment') {

                //filter : kas atau bank
                if ($kas_or_bank == 'Kas') {

                    switch ($value_two_sumber_dana) {
                        case "1":

                            $sql4 = "SELECT pay_nokas as no_bank,pay_inikas as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix', lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix', lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT pay_nokas2 as no_bank,pay_inikas2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT pay_nokas3 as no_bank,pay_inikas3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT pay_nokas4 as no_bank,pay_inikas4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT pay_nokas5 as no_bank, pay_inikas5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nokas5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);


                            break;
                        default:
                            echo "Konten Tidak Tersedia !";
                    }
                } else if ($kas_or_bank == 'Bank') {


                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT pay_nobank1 as no_bank,pay_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            /*$no_urut_pay      = $res['no_bank'];
                                    //ini fungsi untuk menambah angka nol di depan
                                    $fzeropadded      = sprintf("%03d", $no_urut_pay);

                                    $inisial_pay      = $res['ini_bank'];
                                    $nofix            = $inisial_pay.''.$fzeropadded;
                                    $ditambah         = 1;
                                    $no_urut_terakhir = $no_urut_pay+$ditambah;*/

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT pay_nobank2 as no_bank,pay_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT pay_nobank3 as no_bank,pay_inibank3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT pay_nobank4 as no_bank,pay_inibank4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET pay_nobank4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;

                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                } else {
                }
            } else if ($data['pay_rec'] == 'Receive') {

                //filter : kas atau bank
                if ($kas_or_bank == 'Kas') {

                    switch ($value_two_sumber_dana) {
                        case "1":

                            $sql4 = "SELECT rec_nokas as no_bank,rec_inikas as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT rec_nokas2 as no_bank,rec_inikas2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "3":

                            $sql4 = "SELECT rec_nokas3 as no_bank,rec_inikas3 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik

                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas3  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "4":

                            $sql4 = "SELECT rec_nokas4 as no_bank,rec_inikas4 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas4  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "5":

                            $sql4 = "SELECT rec_nokas5 as no_bank,rec_inikas5 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_rec      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_rec;
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_rec      = $res['ini_bank'];
                            $nofix            = $inisial_rec . '' . $fzeropadded;


                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');

                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp     = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                         terbayar  = '2',
                                                                         nopp     = '$c[NO_PP]'
                                                                WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nokas5  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);


                            break;
                        default:
                            echo "Konten Tidak Tersedia !";
                    }
                } else if ($kas_or_bank == 'Bank') {


                    switch ($value_three_bank) {
                        case "1":

                            $sql4 = "SELECT rec_nobank1 as no_bank,rec_inibank1 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);

                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET  voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank1  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;
                        case "2":

                            $sql4 = "SELECT rec_nobank2 as no_bank,rec_inibank2 as ini_bank FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
                            $res = $this->mips_caba->query($sql4)->row_array();

                            $no_urut_pay      = $res['no_bank'];
                            $ditambah         = 1;
                            $no_urut_terakhir = $ditambah + $no_urut_pay;

                            //ini fungsi untuk menambah angka nol di depan
                            $fzeropadded      = sprintf("%03d", $no_urut_terakhir);

                            $inisial_pay      = $res['ini_bank'];
                            $nofix            = $inisial_pay . '' . $fzeropadded;

                            //update semua kode voucher yang tadinya generate kode sementara dengan kode dari konfigurasi ini : 
                            //voucher detail
                            $sql88 = "UPDATE voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql88);
                            //voucher header
                            $sql99 = "UPDATE head_voucher SET voucno  = '$nofix',lokasi = '$lokasi' WHERE voucno = '$data[kode_sementara]'";
                            $this->mips_caba->query($sql99);


                            //START : ini fungsi untuk update table pp_logistik
                            if ($data['noref_select'] == 0 && $data['noref_select'] == '-' && $data['no_ref'] == '') {
                            } else {

                                //ini kalo noref_select ada isinya dan no ref tidak kosong, maka lakukan 

                                $slq_logistik = "SELECT NO_PP,NO_PO,DEBIT FROM voucher WHERE voucno  = '$nofix'";
                                $k = $this->mips_caba->query($slq_logistik)->result_array();

                                foreach ($k as $c) {
                                    $cls_date = new DateTime($data['tanggal']);
                                    $tgls     = $cls_date->format('Ymd');
                                    $sq_logistik = "UPDATE pp_logistik SET no_vou  = '$no_urut_terakhir',
                                                                                no_voutxt  = '$nofix',
                                                                                tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                                tgl_voutxt = '$tgls',
                                                                                status_vou = 1
                                                                            WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_caba->query($sq_logistik);

                                    $pplogis = "UPDATE pp SET   no_vou  = '$no_urut_terakhir',
                                                                            no_voutxt  = '$nofix',
                                                                            tgl_vou    = STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                                                            tgl_voutxt = '$tgls',
                                                                            status_vou = 1,
                                                                            kasir_bayar = '$c[DEBIT]'
                                                                        WHERE nopp  = '$c[NO_PP]'";
                                    $this->mips_logistik->query($pplogis);

                                    //update status logistik menjadi 1 kalo sudah lunas
                                    $ipo = "SELECT SUM(harga*qty) AS jumlah FROM item_po where noref = '$c[NO_PO]'";
                                    $r_ipo = $this->mips_logistik->query($ipo)->row_array();
                                    $sum_item_po = $r_ipo['jumlah'];

                                    $icb = "SELECT SUM(debit) AS jumlah FROM voucher WHERE NO_PO = '$c[NO_PO]' AND SUBSTR(ACCTNO,1,4) = '3010'";
                                    $r_icb = $this->mips_caba->query($icb)->row_array();
                                    $sum_item_cb = $r_icb['jumlah'];

                                    if ($sum_item_cb >= $sum_item_po) {
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                                        terbayar  = '1',
                                                                        nopp       = '$c[NO_PP]'
                                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    } else {
                                        //belum diupdate menjadi lunas
                                        $ipoa = "UPDATE po SET   voucher   = '$nofix',
                                                        terbayar  = '2',
                                                        nopp       = '$c[NO_PP]'
                                                        WHERE noreftxt  = '$c[NO_PO]'";
                                        $this->mips_logistik->query($ipoa);
                                    }
                                }
                            }
                            //END : ini fungsi untuk update table pp_logistik


                            //update configur
                            $sql11 = "UPDATE konfigur SET rec_nobank2  = '$no_urut_terakhir' where lokasi = '$lokasi' and pt = '$pt'";
                            $this->mips_caba->query($sql11);

                            break;

                        default:
                            echo "BANK TIDAK TERSEDIA !";
                    }
                } else {
                }
            }
        }
        $pay = $data['pay_rec'];
        $status = [
            'status' => $headrs,
            'head' => $sql['ACCTNO'],
            'jml' => $jumlah_amount,
            'pay' => $data['pay_rec']
        ];
        return $status;
    }

    function update_saldo_akhir($coa, $jml, $pay)
    {
        $period = $this->periode();

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

        $saldoawal = $this->mips_caba->query("SELECT saldo, saldo_$var_bulan as saldone FROM saldo_voucher WHERE ACCTNO='$coa' AND thn='$tahun'")->row();

        if ($pay == 'Payment') {
            # code...
            $saldos = $saldoawal->saldone - $jml;
        } else {
            $saldos = $saldoawal->saldone + $jml;
            # code...
        }

        $saldo_vou["saldo"] = $saldos;
        $saldo_vou["saldo_$var_bulan"] = $saldos;
        $this->mips_caba->set($saldo_vou);
        $this->mips_caba->where(['ACCTNO' => $coa, 'thn' => $tahun]);
        $this->mips_caba->update('saldo_voucher');

        return true;
    }

    function cobacoba()
    {
        $sql4 = "SELECT pay_nokas,pay_inikas FROM konfigur";
        $res = $this->mips_caba->query($sql4)->row_array();

        $no_urut_rec    = $res['pay_nokas'];
        $inisial_rec    = $res['pay_inikas'];
        $nofix            = $inisial_rec . $no_urut_rec;
        $ditambah         = 1;
        $no_urut_terakhir = $no_urut_rec + $ditambah;


        return $no_urut_terakhir;
    }

    function simpan_voucher_detail($data)
    {

        $user_id = $this->username();

        $jumlah_amount    = str_replace(",", "", $data['jumlah']);

        if ($data['kredit'] == '') {
            $val_kredit = '0';
        } else {
            $val_kredit = str_replace(",", "", $data['kredit']);;
        }

        if ($data['debit'] == '') {
            $val_debet = '0';
        } else {
            $val_debet = str_replace(",", "", $data['debit']);
        }

        if ($data['noref_select'] == '-') {
            $ceknoref = '-';
            $nopp     = '-';
        } else {
            $ceknoref = $data['noref_select'] . ' ' . $data['no_ref'];
            $nopp     = $data['no_ref'];
        }

        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $lokasi = $this->get_nama_lokasi();
        $nama_user = $this->session->userdata('sess_nama');
        $id_user = $this->session->userdata('sess_id');

        $tgl_ymd = date('Y-m-d', strtotime($data['tanggal']));
        $vou['TRANS'] = $data['kas_bank'];
        $vou['VOUCNO'] = $data['kode_sementara'];
        $vou['DATE'] = $tgl_ymd;
        $vou['ACCTNO'] = $data['acct'];
        $vou['DEBIT'] = $val_debet;
        $vou['CREDIT'] = $val_kredit;
        $vou['DESCRIPT'] = $data['acct_nama'];
        $vou['JENIS'] = $data['pay_rec'];
        $vou['CHEQNO'] = $ceknoref;
        $vou['TO'] = '-';
        $vou['FROM'] = $data['kepada'];
        $vou['PAY'] = $data['terbilang'];
        $vou['AMOUNT'] = $jumlah_amount;
        $vou['BANK'] = $data['bank_nama'];
        $vou['POSTED'] = 0;
        $vou['REMARKS'] = $data['transaksi_remark'];
        $vou['LOKASI'] = $lokasi;
        $vou['PROJECT'] = '-';
        $vou['PRINTED'] = 0;
        $vou['TGLTXT'] = $tgltxt;
        $vou['KODE_PT'] = $data['divisi_v'];
        $vou['txtperiode'] = $tgltxtperiode;
        $vou['MODULE'] = $tgltxtperiode;
        $vou['user'] = $nama_user;
        $vou['id_user'] = $id_user;
        $vou['NO_PP'] = $id_user;
        $vou['NO_PO'] = $id_user;
        if ($lokasi != 'HO') {
            $vou['PDO'] = '-';
            $vou['sumber'] = '-';
        }

        return $this->mips_caba->insert('voucher_tmp', $vou);
    }

    function simpan_voucher_detail_by_po($data)
    {

        $user_id = $this->username();

        $jumlah_amount    = str_replace(",", "", $data['jumlah']);

        if ($data['debit'] == '') {
            $val_debet = '0';
        } else {
            $val_debet = str_replace(",", "", $data['debit']);
        }

        if ($data['noref_select'] == '-') {
            $ceknoref = '-';
            $nopp     = '-';
        } else {
            $ceknoref = $data['noref_select'] . ' ' . $data['no_ref'];
            $nopp     = $data['no_ref'];
        }

        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $lokasi = $this->get_nama_lokasi();
        $nama_user = $this->session->userdata('sess_nama');
        $id_user = $this->session->userdata('sess_id');


        ///*$data[nomor_voucher]*/
        $sql = "INSERT INTO voucher_tmp (trans,
                                    voucno,
                                    date,
                                    acctno,
                                    debit,
                                    descript,
                                    jenis,
                                    cheqno,
                                    `to`,
                                    `from`,
                                    pay,
                                    amount,
                                    bank,
                                    remarks,
                                    lokasi,
                                    project,
                                    kode_pt,
                                    id_user,
                                    user,
                                    no_pp,
                                    if ($lokasi != 'HO') {

                                    pdo,
                                    sumber,
                                    }
                                    tgltxt,
                                    txtperiode,
                                    no_po,
                                    posted,
                                    printed) 
                            VALUES ('$data[kas_bank]',
                                    '$data[kode_sementara]',
                                    STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                    '$data[supp_acct]',
                                    '$val_debet',
                                    '$data[supp_nama]',
                                    '$data[pay_rec]',
                                    '$ceknoref',
                                    '-',
                                    '$data[kepada]',
                                    '$data[terbilang]',
                                    '$jumlah_amount',
                                    '$data[bank_nama]',
                                    '$data[transaksi_remark]',
                                    '$lokasi',
                                    '-',
                                    '$data[kodept]',
                                    '$id_user',
                                    '$nama_user',
                                    '$nopp',
                                    if ($lokasi != 'HO') {
                                    '-',
                                    '-',
                                    }
                                    $tgltxt,
                                    $tgltxtperiode,
                                    '$data[ref_po]','0','0')";


        return $this->mips_caba->query($sql);
    }

    function simpan_voucher_detail_by_po_edit($data)
    {

        $lokasi     = $this->get_nama_lokasi();
        $nama_user  = $this->session->userdata('sess_nama');

        $user_id = $this->username();

        $jumlah_amount    = str_replace(",", "", $data['jumlah']);

        $val_debet = 0;
        if ($data['debit'] == '') {
            $val_debet = '0';
        } else {
            $val_debet = str_replace(",", "", $data['debit']);
        }

        $ceknoref = 0;
        $nopp = 0;
        if ($data['noref_select'] == '-') {
            $ceknoref = '-';
            $nopp     = '-';
        } else {
            $ceknoref = $data['noref_select'] . ' ' . $data['no_ref'];
            $nopp     = $data['no_ref'];
        }

        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        ///*$data[nomor_voucher]*/
        $sql = "INSERT INTO voucher (trans,
                                    voucno,
                                    date,
                                    acctno,
                                    debit,
                                    descript,
                                    jenis,
                                    cheqno,
                                    `to`,
                                    `from`,
                                    pay,
                                    amount,
                                    bank,
                                    remarks,
                                    lokasi,
                                    project,
                                    kode_pt,
                                    user,
                                    no_pp,
                                    if ($lokasi != 'HO') {
                                    pdo,
                                    sumber,
                                        }
                                    tgltxt,
                                    txtperiode) 
                            VALUES ('$data[kas_bank]',
                                    '$data[no_vouc]',
                                    STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                    '$data[acct]',
                                    '$val_debet',
                                    '$data[acct_nama]',
                                    '$data[pay_rec]',
                                    '$ceknoref',
                                    '-',
                                    '$data[kepada]',
                                    '$data[terbilang]',
                                    '$jumlah_amount',
                                    '$data[bank_nama]',
                                    '$data[transaksi_remark]',
                                    '$lokasi',
                                    '-',
                                    '$data[divisi_v]',
                                    '$nama_user',
                                    '$nopp',
                                    if ($lokasi != 'HO') {
                                    '-',
                                    '-',
                                    }
                                    $tgltxt,
                                    $tgltxtperiode
                                )";


        return $this->mips_caba->query($sql);
    }

    function data_list_voucher_detail($data)
    {
        $id = $this->session->userdata('sess_id');

        $sql = "SELECT *,FORMAT(debit, 2) debit_f
                            ,FORMAT(credit, 2) credit_f,
                            ID as id_vouc_tmp 
        FROM voucher_tmp where VOUCNO = '$data[kode_sementara]' ORDER BY ID DESC";
        // -- FROM voucher_tmp where id_user = '$id' ";
        return $this->mips_caba->query($sql);
    }

    function cek_voucher()
    {
        $period = $this->periode();
        $id = $this->session->userdata('sess_id');
        $data = $this->mips_caba->query("SELECT * FROM voucher_tmp WHERE id_user='$id' AND txtperiode='$period' ")->num_rows();
        return $data;
    }

    function getvoucher()
    {
        $period = $this->periode();
        $id = $this->session->userdata('sess_id');
        $data = $this->mips_caba->query("SELECT * FROM voucher_tmp WHERE id_user='$id' AND txtperiode='$period'")->row();
        return $data;
    }



    function coba_data()
    {

        $sql = "SELECT *,FORMAT(debit, 2) debit_f
                            ,FORMAT(credit, 2) credit_f 
                        FROM voucher_tmp";
        return $this->mips_caba->query($sql);
    }

    function configurasi_data($lokasi)
    {

        //1 : HO
        //2 : ESTATE
        //3 : RO

        // $pt = $this->get_sess_pt();
        $pt = $this->session->userdata('sess_pt');

        $sql = "SELECT * FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
        return $this->mips_caba->query($sql);
    }


    function configurasi_update($data)
    {

        // $pt = $this->get_sess_pt();
        $pt = $this->session->userdata('sess_pt');

        if ($data['lokasi'] == 'HO') { //HO

            $sql = "UPDATE konfigur SET pay_inikas  = '$data[kode_payment_kas_inisial_1]',
                                            pay_nokas   = '$data[kode_payment_kas_kode_1]',
                                            NOACC_KAS1  = '$data[kode_payment_kas_coa_1]',
                                            pay_namabank1 = '$data[kode_payment_bank_nama_1]',
                                            NOAC_BANK1    = '$data[kode_payment_bank_coa_1]',
                                            pay_nobank1   = '$data[kode_payment_bank_kode_1]',
                                            pay_inibank1  = '$data[kode_payment_bank_inisial_1]',
                                            pay_namabank2 = '$data[kode_payment_bank_nama_2]',
                                            NOAC_BANK2    = '$data[kode_payment_bank_coa_2]',
                                            pay_nobank2   = '$data[kode_payment_bank_kode_2]',
                                            pay_inibank2  = '$data[kode_payment_bank_inisial_2]',
                                            pay_namabank3 = '$data[kode_payment_bank_nama_3]',
                                            NOAC_BANK3    = '$data[kode_payment_bank_coa_3]',
                                            pay_nobank3   = '$data[kode_payment_bank_kode_3]',
                                            pay_inibank3  = '$data[kode_payment_bank_inisial_3]',
                                            pay_namabank4 = '$data[kode_payment_bank_nama_4]',
                                            NOAC_BANK4    = '$data[kode_payment_bank_coa_4]',
                                            pay_nobank4   = '$data[kode_payment_bank_kode_4]',
                                            pay_inibank4  = '$data[kode_payment_bank_inisial_4]',
                                            pay_namabank5 = '$data[kode_payment_bank_nama_5]',
                                            NOAC_BANK5    = '$data[kode_payment_bank_coa_5]',
                                            pay_nobank5   = '$data[kode_payment_bank_kode_5]',
                                            pay_inibank5  = '$data[kode_payment_bank_inisial_5]',
                                            pay_namabank6 = '$data[kode_payment_bank_nama_6]',
                                            NOAC_BANK6    = '$data[kode_payment_bank_coa_6]',
                                            pay_nobank6   = '$data[kode_payment_bank_kode_6]',
                                            pay_inibank6  = '$data[kode_payment_bank_inisial_6]',
                                            pay_namabank7 = '$data[kode_payment_bank_nama_7]',
                                            NOAC_BANK7    = '$data[kode_payment_bank_coa_7]',
                                            pay_nobank7   = '$data[kode_payment_bank_kode_7]',
                                            pay_inibank7  = '$data[kode_payment_bank_inisial_7]',
                                            pay_namabank8 = '$data[kode_payment_bank_nama_8]',
                                            NOAC_BANK8    = '$data[kode_payment_bank_coa_8]',
                                            pay_nobank8   = '$data[kode_payment_bank_kode_8]',
                                            pay_inibank8  = '$data[kode_payment_bank_inisial_8]',
                                            pay_namabank9 = '$data[kode_payment_bank_nama_9]',
                                            NOAC_BANK9    = '$data[kode_payment_bank_coa_9]',
                                            pay_nobank9   = '$data[kode_payment_bank_kode_9]',
                                            pay_inibank9  = '$data[kode_payment_bank_inisial_9]',
                                            pay_namabank10 = '$data[kode_payment_bank_nama_10]',
                                            NOAC_BANK10    = '$data[kode_payment_bank_coa_10]',
                                            pay_nobank10   = '$data[kode_payment_bank_kode_10]',
                                            pay_inibank10  = '$data[kode_payment_bank_inisial_10]',
                                            rec_nokas     = '$data[kode_receive_kas_kode_1]',
                                            NOACCKAS1     = '$data[kode_receive_kas_coa_1]',
                                            rec_inikas    = '$data[kode_receive_kas_inisial_1]',
                                            rec_namabank1  = '$data[kode_receive_bank_nama_1]',
                                            NOACC_RECBANK1 = '$data[kode_receive_bank_coa_1]',
                                            rec_nobank1    = '$data[kode_receive_bank_kode_1]',
                                            rec_inibank1   = '$data[kode_receive_bank_inisial_1]',
                                            rec_namabank2  = '$data[kode_receive_bank_nama_2]', 
                                            NOACC_RECBANK2 = '$data[kode_receive_bank_coa_2]',
                                            rec_nobank2    = '$data[kode_receive_bank_kode_2]',
                                            rec_inibank2   = '$data[kode_receive_bank_inisial_2]',
                                            rec_namabank3  = '$data[kode_receive_bank_nama_3]', 
                                            NOACC_RECBANK3 = '$data[kode_receive_bank_coa_3]',
                                            rec_nobank3    = '$data[kode_receive_bank_kode_3]',
                                            rec_inibank3   = '$data[kode_receive_bank_inisial_3]',
                                            rec_namabank4  = '$data[kode_receive_bank_nama_4]', 
                                            NOACC_RECBANK4 = '$data[kode_receive_bank_coa_4]',
                                            rec_nobank4    = '$data[kode_receive_bank_kode_4]',
                                            rec_inibank4   = '$data[kode_receive_bank_inisial_4]',
                                            rec_namabank5  = '$data[kode_receive_bank_nama_5]', 
                                            NOACC_RECBANK5 = '$data[kode_receive_bank_coa_5]',
                                            rec_nobank5    = '$data[kode_receive_bank_kode_5]',
                                            rec_inibank5   = '$data[kode_receive_bank_inisial_5]',
                                            rec_namabank6  = '$data[kode_receive_bank_nama_6]', 
                                            NOACC_RECBANK6 = '$data[kode_receive_bank_coa_6]',
                                            rec_nobank6    = '$data[kode_receive_bank_kode_6]',
                                            rec_inibank6   = '$data[kode_receive_bank_inisial_6]',
                                            rec_namabank7  = '$data[kode_receive_bank_nama_7]', 
                                            NOACC_RECBANK7 = '$data[kode_receive_bank_coa_7]',
                                            rec_nobank7    = '$data[kode_receive_bank_kode_7]',
                                            rec_inibank7   = '$data[kode_receive_bank_inisial_7]',
                                            rec_namabank8  = '$data[kode_receive_bank_nama_8]', 
                                            NOACC_RECBANK8 = '$data[kode_receive_bank_coa_8]',
                                            rec_nobank8    = '$data[kode_receive_bank_kode_8]',
                                            rec_inibank8   = '$data[kode_receive_bank_inisial_8]',
                                            rec_namabank9  = '$data[kode_receive_bank_nama_9]', 
                                            NOACC_RECBANK9 = '$data[kode_receive_bank_coa_9]',
                                            rec_nobank9    = '$data[kode_receive_bank_kode_9]',
                                            rec_inibank9   = '$data[kode_receive_bank_inisial_9]',
                                            rec_namabank10  = '$data[kode_receive_bank_nama_10]', 
                                            NOACC_RECBANK10 = '$data[kode_receive_bank_coa_10]',
                                            rec_nobank10    = '$data[kode_receive_bank_kode_10]',
                                            rec_inibank10   = '$data[kode_receive_bank_inisial_10]'
                                            WHERE lokasi = 'HO' and pt = '$pt'";

            return $this->mips_caba->query($sql);
        } else if ($data['lokasi'] == 'ESTATE') { //ESTATE


            $sql = "UPDATE konfigur SET pay_inikas  = '$data[kode_payment_kas_inisial_1]',
                                            pay_nokas   = '$data[kode_payment_kas_kode_1]',
                                            NOACC_KAS1  = '$data[kode_payment_kas_coa_1]',
                                            pay_inikas2 = '$data[kode_payment_kas_inisial_2]',
                                            pay_nokas2  = '$data[kode_payment_kas_kode_2]',
                                            NOAC_KAS2   = '$data[kode_payment_kas_coa_2]',
                                            pay_inikas3 = '$data[kode_payment_kas_inisial_3]',
                                            pay_nokas3  = '$data[kode_payment_kas_kode_3]',
                                            NOAC_KAS3   = '$data[kode_payment_kas_coa_3]',
                                            pay_inikas4 = '$data[kode_payment_kas_inisial_4]',
                                            pay_nokas4  = '$data[kode_payment_kas_kode_4]',
                                            NOAC_KAS4   = '$data[kode_payment_kas_coa_4]',
                                            pay_inikas5 = '$data[kode_payment_kas_inisial_5]',
                                            pay_nokas5  = '$data[kode_payment_kas_kode_5]',
                                            NOAC_KAS5   = '$data[kode_payment_kas_coa_5]',
                                            pay_namabank1 = '$data[kode_payment_bank_nama_1]',
                                            NOAC_BANK1    = '$data[kode_payment_bank_coa_1]',
                                            pay_nobank1   = '$data[kode_payment_bank_kode_1]',
                                            pay_inibank1  = '$data[kode_payment_bank_inisial_1]',
                                            pay_namabank2 = '$data[kode_payment_bank_nama_2]',
                                            NOAC_BANK2    = '$data[kode_payment_bank_coa_2]',
                                            pay_nobank2   = '$data[kode_payment_bank_kode_2]',
                                            pay_inibank2  = '$data[kode_payment_bank_inisial_2]',
                                            pay_namabank3 = '$data[kode_payment_bank_nama_3]',
                                            NOAC_BANK3    = '$data[kode_payment_bank_coa_3]',
                                            pay_nobank3   = '$data[kode_payment_bank_kode_3]',
                                            pay_inibank3  = '$data[kode_payment_bank_inisial_3]',
                                            pay_namabank4 = '$data[kode_payment_bank_nama_4]',
                                            NOAC_BANK4    = '$data[kode_payment_bank_coa_4]',
                                            pay_nobank4   = '$data[kode_payment_bank_kode_4]',
                                            pay_inibank4  = '$data[kode_payment_bank_inisial_4]',
                                            rec_nokas     = '$data[kode_receive_kas_kode_1]',
                                            NOACCKAS1     = '$data[kode_receive_kas_coa_1]',
                                            rec_inikas    = '$data[kode_receive_kas_inisial_1]',
                                            rec_nokas2    = '$data[kode_receive_kas_kode_2]',
                                            NOACCKAS2     = '$data[kode_receive_kas_coa_2]',
                                            rec_inikas2   = '$data[kode_receive_kas_inisial_2]',
                                            rec_nokas3    = '$data[kode_receive_kas_kode_3]',
                                            NOACCKAS3     = '$data[kode_receive_kas_coa_3]',
                                            rec_inikas3   = '$data[kode_receive_kas_inisial_3]',
                                            rec_nokas4    = '$data[kode_receive_kas_kode_4]',
                                            NOACCKAS4     = '$data[kode_receive_kas_coa_4]',
                                            rec_inikas4   = '$data[kode_receive_kas_inisial_4]',
                                            rec_nokas5    = '$data[kode_receive_kas_kode_5]',
                                            NOACCKAS5     = '$data[kode_receive_kas_coa_5]',
                                            rec_inikas5   = '$data[kode_receive_kas_inisial_5]',
                                            rec_namabank1  = '$data[kode_receive_bank_nama_1]',
                                            NOACC_RECBANK1 = '$data[kode_receive_bank_coa_1]',
                                            rec_nobank1    = '$data[kode_receive_bank_kode_1]',
                                            rec_inibank1   = '$data[kode_receive_bank_inisial_1]',
                                            rec_namabank2  = '$data[kode_receive_bank_nama_2]', 
                                            NOACC_RECBANK2 = '$data[kode_receive_bank_coa_2]',
                                            rec_nobank2    = '$data[kode_receive_bank_kode_2]',
                                            rec_inibank2   = '$data[kode_receive_bank_inisial_2]'
                                            WHERE lokasi = 'ESTATE' and pt = '$pt'";

            return $this->mips_caba->query($sql);
        } else if ($data['lokasi'] == 'RO') { //RO
            $sql = "UPDATE konfigur SET pay_inikas  = '$data[kode_payment_kas_inisial_1]',
            pay_nokas   = '$data[kode_payment_kas_kode_1]',
            NOACC_KAS1  = '$data[kode_payment_kas_coa_1]',
            pay_inikas2 = '$data[kode_payment_kas_inisial_2]',
            pay_nokas2  = '$data[kode_payment_kas_kode_2]',
            NOAC_KAS2   = '$data[kode_payment_kas_coa_2]',
            pay_inikas3 = '$data[kode_payment_kas_inisial_3]',
            pay_nokas3  = '$data[kode_payment_kas_kode_3]',
            NOAC_KAS3   = '$data[kode_payment_kas_coa_3]',
            pay_inikas4 = '$data[kode_payment_kas_inisial_4]',
            pay_nokas4  = '$data[kode_payment_kas_kode_4]',
            NOAC_KAS4   = '$data[kode_payment_kas_coa_4]',
            pay_inikas5 = '$data[kode_payment_kas_inisial_5]',
            pay_nokas5  = '$data[kode_payment_kas_kode_5]',
            NOAC_KAS5   = '$data[kode_payment_kas_coa_5]',
            pay_namabank1 = '$data[kode_payment_bank_nama_1]',
            NOAC_BANK1    = '$data[kode_payment_bank_coa_1]',
            pay_nobank1   = '$data[kode_payment_bank_kode_1]',
            pay_inibank1  = '$data[kode_payment_bank_inisial_1]',
            pay_namabank2 = '$data[kode_payment_bank_nama_2]',
            NOAC_BANK2    = '$data[kode_payment_bank_coa_2]',
            pay_nobank2   = '$data[kode_payment_bank_kode_2]',
            pay_inibank2  = '$data[kode_payment_bank_inisial_2]',
            pay_namabank3 = '$data[kode_payment_bank_nama_3]',
            NOAC_BANK3    = '$data[kode_payment_bank_coa_3]',
            pay_nobank3   = '$data[kode_payment_bank_kode_3]',
            pay_inibank3  = '$data[kode_payment_bank_inisial_3]',
            pay_namabank4 = '$data[kode_payment_bank_nama_4]',
            NOAC_BANK4    = '$data[kode_payment_bank_coa_4]',
            pay_nobank4   = '$data[kode_payment_bank_kode_4]',
            pay_inibank4  = '$data[kode_payment_bank_inisial_4]',
            rec_nokas     = '$data[kode_receive_kas_kode_1]',
            NOACCKAS1     = '$data[kode_receive_kas_coa_1]',
            rec_inikas    = '$data[kode_receive_kas_inisial_1]',
            rec_nokas2    = '$data[kode_receive_kas_kode_2]',
            NOACCKAS2     = '$data[kode_receive_kas_coa_2]',
            rec_inikas2   = '$data[kode_receive_kas_inisial_2]',
            rec_nokas3    = '$data[kode_receive_kas_kode_3]',
            NOACCKAS3     = '$data[kode_receive_kas_coa_3]',
            rec_inikas3   = '$data[kode_receive_kas_inisial_3]',
            rec_nokas4    = '$data[kode_receive_kas_kode_4]',
            NOACCKAS4     = '$data[kode_receive_kas_coa_4]',
            rec_inikas4   = '$data[kode_receive_kas_inisial_4]',
            rec_nokas5    = '$data[kode_receive_kas_kode_5]',
            NOACCKAS5     = '$data[kode_receive_kas_coa_5]',
            rec_inikas5   = '$data[kode_receive_kas_inisial_5]',
            rec_namabank1  = '$data[kode_receive_bank_nama_1]',
            NOACC_RECBANK1 = '$data[kode_receive_bank_coa_1]',
            rec_nobank1    = '$data[kode_receive_bank_kode_1]',
            rec_inibank1   = '$data[kode_receive_bank_inisial_1]',
            rec_namabank2  = '$data[kode_receive_bank_nama_2]', 
            NOACC_RECBANK2 = '$data[kode_receive_bank_coa_2]',
            rec_nobank2    = '$data[kode_receive_bank_kode_2]',
            rec_inibank2   = '$data[kode_receive_bank_inisial_2]'
            WHERE lokasi = 'RO' and pt = '$pt'";

            return $this->mips_caba->query($sql);
        } elseif ($data['lokasi'] == 'PKS') {
            # code...
            $sql = "UPDATE konfigur SET pay_inikas  = '$data[kode_payment_kas_inisial_1]',
            pay_nokas   = '$data[kode_payment_kas_kode_1]',
            NOACC_KAS1  = '$data[kode_payment_kas_coa_1]',
            pay_inikas2 = '$data[kode_payment_kas_inisial_2]',
            pay_nokas2  = '$data[kode_payment_kas_kode_2]',
            NOAC_KAS2   = '$data[kode_payment_kas_coa_2]',
            pay_inikas3 = '$data[kode_payment_kas_inisial_3]',
            pay_nokas3  = '$data[kode_payment_kas_kode_3]',
            NOAC_KAS3   = '$data[kode_payment_kas_coa_3]',
            pay_inikas4 = '$data[kode_payment_kas_inisial_4]',
            pay_nokas4  = '$data[kode_payment_kas_kode_4]',
            NOAC_KAS4   = '$data[kode_payment_kas_coa_4]',
            pay_inikas5 = '$data[kode_payment_kas_inisial_5]',
            pay_nokas5  = '$data[kode_payment_kas_kode_5]',
            NOAC_KAS5   = '$data[kode_payment_kas_coa_5]',
            pay_namabank1 = '$data[kode_payment_bank_nama_1]',
            NOAC_BANK1    = '$data[kode_payment_bank_coa_1]',
            pay_nobank1   = '$data[kode_payment_bank_kode_1]',
            pay_inibank1  = '$data[kode_payment_bank_inisial_1]',
            pay_namabank2 = '$data[kode_payment_bank_nama_2]',
            NOAC_BANK2    = '$data[kode_payment_bank_coa_2]',
            pay_nobank2   = '$data[kode_payment_bank_kode_2]',
            pay_inibank2  = '$data[kode_payment_bank_inisial_2]',
            pay_namabank3 = '$data[kode_payment_bank_nama_3]',
            NOAC_BANK3    = '$data[kode_payment_bank_coa_3]',
            pay_nobank3   = '$data[kode_payment_bank_kode_3]',
            pay_inibank3  = '$data[kode_payment_bank_inisial_3]',
            pay_namabank4 = '$data[kode_payment_bank_nama_4]',
            NOAC_BANK4    = '$data[kode_payment_bank_coa_4]',
            pay_nobank4   = '$data[kode_payment_bank_kode_4]',
            pay_inibank4  = '$data[kode_payment_bank_inisial_4]',
            rec_nokas     = '$data[kode_receive_kas_kode_1]',
            NOACCKAS1     = '$data[kode_receive_kas_coa_1]',
            rec_inikas    = '$data[kode_receive_kas_inisial_1]',
            rec_nokas2    = '$data[kode_receive_kas_kode_2]',
            NOACCKAS2     = '$data[kode_receive_kas_coa_2]',
            rec_inikas2   = '$data[kode_receive_kas_inisial_2]',
            rec_nokas3    = '$data[kode_receive_kas_kode_3]',
            NOACCKAS3     = '$data[kode_receive_kas_coa_3]',
            rec_inikas3   = '$data[kode_receive_kas_inisial_3]',
            rec_nokas4    = '$data[kode_receive_kas_kode_4]',
            NOACCKAS4     = '$data[kode_receive_kas_coa_4]',
            rec_inikas4   = '$data[kode_receive_kas_inisial_4]',
            rec_nokas5    = '$data[kode_receive_kas_kode_5]',
            NOACCKAS5     = '$data[kode_receive_kas_coa_5]',
            rec_inikas5   = '$data[kode_receive_kas_inisial_5]',
            rec_namabank1  = '$data[kode_receive_bank_nama_1]',
            NOACC_RECBANK1 = '$data[kode_receive_bank_coa_1]',
            rec_nobank1    = '$data[kode_receive_bank_kode_1]',
            rec_inibank1   = '$data[kode_receive_bank_inisial_1]',
            rec_namabank2  = '$data[kode_receive_bank_nama_2]', 
            NOACC_RECBANK2 = '$data[kode_receive_bank_coa_2]',
            rec_nobank2    = '$data[kode_receive_bank_kode_2]',
            rec_inibank2   = '$data[kode_receive_bank_inisial_2]'
            WHERE lokasi = 'PKS' and pt = '$pt'";

            return $this->mips_caba->query($sql);
        }
    }

    function get_balance($kode_sementara)
    {

        $sql = "SELECT (SUM(debit)+SUM(credit)) AS Total,
                            FORMAT((SUM(debit)+SUM(credit)), 2) AS total_f,
                            SUM(debit) tot_debit,
                            SUM(credit) tot_credit,
                            (SUM(debit)+SUM(credit)) AS total_detail_trans,
                            FORMAT((SUM(debit)-SUM(credit)), 2) AS total_detail_trans2
                            FROM voucher_tmp WHERE VOUCNO = '$kode_sementara'
                            GROUP BY VOUCNO";

        return $this->mips_caba->query($sql);
    }


    function get_balance_edit($no_vouc, $periode)
    {

        $sql = "SELECT  (SUM(debit)+SUM(credit)) AS Total,
                            FORMAT((SUM(debit)+SUM(credit)), 2) AS total_f,
                            SUM(debit) tot_debit,
                            SUM(credit) tot_credit,
                            (SUM(debit)+SUM(credit)) AS total_detail_trans,
                            FORMAT((SUM(debit)-SUM(credit)), 2) AS total_detail_trans2
                            FROM voucher WHERE VOUCNO = '$no_vouc' AND txtperiode = '$periode'
                            GROUP BY VOUCNO";


        /*$sql = "SELECT  (SUM(debit)+SUM(credit)) AS Total,
                            FORMAT((SUM(debit)+SUM(credit)), 2) AS total_f,
                            SUM(debit) tot_debit,
                            SUM(credit) tot_credit
                            FROM voucher WHERE VOUCNO = '$no_vouc' AND txtperiode = '$periode'
                            GROUP BY VOUCNO";*/

        return $this->mips_caba->query($sql);
    }
    function get_balance_edit2($no_vouc)
    {

        $sql = "SELECT (SUM(debit)+SUM(credit)) AS Total,
                            FORMAT((SUM(debit)+SUM(credit)), 2) AS total_f,
                            SUM(debit) tot_debit,
                            SUM(credit) tot_credit,
                            (SUM(debit)+SUM(credit)) AS total_detail_trans,
                            FORMAT((SUM(debit)-SUM(credit)), 2) AS total_detail_trans2
                            FROM voucher_tmp WHERE id_user = '$no_vouc' 
                            GROUP BY TRANS";


        /*$sql = "SELECT  (SUM(debit)+SUM(credit)) AS Total,
                            FORMAT((SUM(debit)+SUM(credit)), 2) AS total_f,
                            SUM(debit) tot_debit,
                            SUM(credit) tot_credit
                            FROM voucher WHERE VOUCNO = '$no_vouc' AND txtperiode = '$periode'
                            GROUP BY VOUCNO";*/

        return $this->mips_caba->query($sql);
    }

    function count_all()
    {
        $this->mips_caba->from($this->table);
        return $this->mips_caba->count_all_results();
    }

    public function detail_pp_logistik($pppo_id, $pppo_no)
    {

        $sql = "SELECT kode_supplytxt,kodept,ref_po,kode_supply,nama_supply,nopp,FORMAT(jumlah, 2) jumlah_f FROM pp_logistik where id = '$pppo_id' and nopp = '$pppo_no'";
        return $this->mips_caba->query($sql);
    }

    public function get_bank_konfig()
    {

        /*$sql = "SELECT  pay_namabank1,
                            NOAC_BANK1,
                            pay_namabank2,
                            NOAC_BANK2,
                            pay_namabank3,
                            NOAC_BANK3,
                            pay_namabank4,
                            NOAC_BANK4
                        FROM konfigur";*/

        $pt = $this->get_sess_pt();
        $lokasi  = $this->get_nama_lokasi();
        $sql = "SELECT * FROM konfigur where lokasi = '$lokasi' and pt = '$pt'";
        return $this->mips_caba->query($sql);
    }


    function detail_cash_bank($cb_id)
    {

        $sql = "SELECT * FROM head_voucher where id = '$cb_id'";
        return $this->mips_caba->query($sql);
    }

    function hapus_vouc_tmp_detail($data)
    {

        $sql = "DELETE FROM voucher_tmp WHERE ID = '$data[id_vouc_tmp]' and VOUCNO = '$data[voucno]'";
        return $this->mips_caba->query($sql);
    }

    function get_vouc_tmp_detail($data)
    {

        $sql = "SELECT *,FORMAT(DEBIT, 2) debit_f
                            ,FORMAT(CREDIT, 2) credit_f FROM voucher_tmp where ID = '$data[id_vouc_tmp]' and VOUCNO = '$data[voucno]'";
        return $this->mips_caba->query($sql);
    }

    function update_vouc_tmp_detail($data)
    {

        $user_id = $this->username();

        $val_kredit = 0;
        if ($data['kredit'] == '') {
            $val_kredit = '0';
        } else {
            $val_kredit = str_replace(",", "", $data['kredit']);;
        }

        $val_debet = 0;
        if ($data['debit'] == '') {
            $val_debet = '0';
        } else {
            $val_debet = str_replace(",", "", $data['debit']);
        }


        $sql = "UPDATE voucher_tmp SET  acctno  = '$data[acct]',
                                            descript= '$data[acct_nama]',
                                            debit   = $val_debet,
                                            credit  = $val_kredit,
                                            remarks = '$data[transaksi_remark]',
                                            kode_pt = '$data[divisi_v]'
                                        WHERE id = '$data[idvoucher]'";

        return $this->mips_caba->query($sql);
    }


    function get_data_head_vouch($data)
    {

        $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,
                            SUBSTRING(CHEQNO, 1, 5) REF_PP,
                            SUBSTRING(CHEQNO, 7, 100) NOMOR_REF_PP,
                            FORMAT(AMOUNT, 2) amount,
                            DATE_FORMAT(TGLCEK, '%d-%m-%Y') TGLCEK
                             FROM head_voucher where id = '$data[id_vouc]'";
        return $this->mips_caba->query($sql);
    }
    function get_data_head_vouch2($data)
    {
        // $cek =  $this->mips_caba->query("SELECT DEBIT, CREDIT, JENIS FROM voucher_tmp WHERE id_user='$data[id_user]' AND PAY = ''")->row();
        // if ($cek->JENIS == "Payment") {
        // } else {
        // }
        $sql = "SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL, SUBSTRING(CHEQNO, 1, 5) REF_PP, SUBSTRING(CHEQNO, 7, 100) NOMOR_REF_PP, FORMAT(DEBIT, 2) DEBIT, FORMAT(CREDIT, 2) CREDIT,DATE_FORMAT(DATE, '%d-%m-%Y') TGLCEK FROM voucher_tmp where id_user = '$data[id_user]' AND PAY = ''";
        return $this->mips_caba->query($sql);
    }


    function get_list_voucher_detail($data)
    {

        $sql = "SELECT *,FORMAT(debit, 2) debit_f
                            ,FORMAT(credit, 2) credit_f,
                            ID as id_vouc_tmp 
                        FROM voucher where voucno = '$data[kode_vouch]' AND txtperiode = '$data[kode_periode]'";
        return $this->mips_caba->query($sql);
    }
    function get_list_voucher_detail2($data)
    {

        $sql = "SELECT *,FORMAT(debit, 2) debit_f
                            ,FORMAT(credit, 2) credit_f,
                            ID as id_vouc_tmp 
                        FROM voucher_tmp where id_user = '$data[id_user]'";
        return $this->mips_caba->query($sql);
    }


    function simpan_vouc_tmp_detail_update($data)
    {

        $sess_lok = $this->session->userdata('sess_lokasi');
        $sqlE      = "SELECT nama,value FROM codegroup where group_n = 'LOKASI_USERS' and value = '$sess_lok'";
        $d        = $this->db->query($sqlE)->row_array();
        $nama_user = $this->session->userdata('sess_nama');
        $user_id = $this->username();

        $jumlah_amount    = str_replace(",", "", $data['jumlah']);

        $val_kredit = 0;
        if ($data['kredit'] == '') {
            $val_kredit = '0';
        } else {
            $val_kredit = str_replace(",", "", $data['kredit']);;
        }

        $val_debet = 0;
        if ($data['debit'] == '') {
            $val_debet = '0';
        } else {
            $val_debet = str_replace(",", "", $data['debit']);
        }

        $ceknoref = 0;
        $nopp = 0;
        if ($data['noref_select'] == '-') {
            $ceknoref = '-';
            $nopp     = '-';
        } else {
            $ceknoref = $data['noref_select'] . ' ' . $data['no_ref'];
            $nopp     = $data['no_ref'];
        }

        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];

        $lokasi = $d['nama'];
        ///*$data[nomor_voucher]*/
        $sql = "INSERT INTO voucher (trans,
                                    voucno,
                                    date,
                                    acctno,
                                    debit,
                                    credit,
                                    descript,
                                    jenis,
                                    cheqno,
                                    `to`,
                                    `from`,
                                    pay,
                                    amount,
                                    bank,
                                    remarks,
                                    lokasi,
                                    project,
                                    kode_pt,
                                    user,
                                    no_pp,
                                    if ($lokasi != 'HO') {
                                    pdo,
                                    sumber,
                                        }
                                    tgltxt,
                                    txtperiode) 
                            VALUES ('$data[kas_bank]',
                                    '$data[no_vouc]',
                                    STR_TO_DATE('$data[tanggal]', '%d-%m-%Y'),
                                    '$data[acct]',
                                    '$val_debet',
                                    '$val_kredit',
                                    '$data[acct_nama]',
                                    '$data[pay_rec]',
                                    '$ceknoref',
                                    '-',
                                    '$data[kepada]',
                                    '$data[terbilang]',
                                    '$jumlah_amount',
                                    '$data[bank_nama]',
                                    '$data[transaksi_remark]',
                                    '$lokasi',
                                    '-',
                                    '$data[divisi_v]',
                                    '$nama_user',
                                    '$nopp',
                                    if ($lokasi != 'HO') {
                                    '-',
                                    '-',
                                    }
                                    $tgltxt,
                                    $tgltxtperiode
                                )";


        return $this->mips_caba->query($sql);
    }




    function simpan_voucher_header_update($data)
    {

        $user_id = $this->username();
        $lokasi  = $this->get_nama_lokasi();
        $jumlah_amount    = str_replace(",", "", $data['jumlah']);

        $ceknoref = 0;
        $nopp = 0;
        if ($data['noref_select'] == '-') {
            $ceknoref = '-';
            $nopp     = '-';
        } else {
            $ceknoref = $data['noref_select'] . ' ' . $data['no_ref'];
            $nopp     = $data['no_ref'];
        }

        $tgl_explode    = explode("-", $data['tanggal']);
        $tgltxt         = $tgl_explode[2] . $tgl_explode[1] . $tgl_explode[0];
        $tgltxtperiode  = $tgl_explode[2] . $tgl_explode[1];


        //selain ho maka ada PDO dan SUMBER
        if ($this->session->userdata('sess_lokasi') != 1) {

            $nominalsumber = str_replace(",", "", $data['sumber_dana_nominal']);

            $sql = "UPDATE head_voucher SET `to`     = '-',
                                            `from`   = '$data[kepada]',
                                            nama_ref = '$data[noref_select]',
                                            kode_ref = '$data[no_ref]',
                                            pay      = '$data[terbilang]',
                                            amount   = '$jumlah_amount',
                                            bankcek  = '$data[bank_nama]',
                                            tglcek   = STR_TO_DATE('$data[bank_tanggal]','%d-%m-%Y'),
                                            if ($lokasi != 'HO') {
                                            pdo      = '$data[sumber_dana]',
                                            sumber   = '$nominalsumber',
                                                }
                                            nocekbg  = '$data[bank_no]' where id = '$data[id_vouc]' and voucno = '$data[no_vouc]'";

            $headrs = $this->mips_caba->query($sql);
        } else {


            $sql = "UPDATE head_voucher SET `to`     = '-',
                                            `from`   = '$data[kepada]',
                                            nama_ref = '$data[noref_select]',
                                            kode_ref = '$data[no_ref]',
                                            pay      = '$data[terbilang]',
                                            amount   = '$jumlah_amount',
                                            bankcek  = '$data[bank_nama]',
                                            tglcek   = STR_TO_DATE('$data[bank_tanggal]','%d-%m-%Y'),
                                            nocekbg  = '$data[bank_no]' where id = '$data[id_vouc]' and voucno = '$data[no_vouc]'";

            $headrs = $this->mips_caba->query($sql);
        }


        $status = [
            'status' => $headrs,
            'head' => $data['coa_head']
        ];
        return $status;
    }

    function get_vouc_tmp_detail_edit($data)
    {

        $sql = "SELECT *,FORMAT(DEBIT, 2) debit_f
                            ,FORMAT(CREDIT, 2) credit_f FROM voucher_tmp where ID = '$data[id_vouc]' and VOUCNO = '$data[voucno]'";
        return $this->mips_caba->query($sql);
    }
    function get_vouc_tmp_detail_edit2($data)
    {

        $sql = "SELECT *,FORMAT(DEBIT, 2) debit_f
                            ,FORMAT(CREDIT, 2) credit_f FROM voucher_tmp where ID = '$data[id_vouc]' and VOUCNO = '$data[voucno]'";
        return $this->mips_caba->query($sql);
    }

    function update_vouc_tmp_detail_edit($data)
    {

        $user_id = $this->username();

        $val_kredit = 0;
        if ($data['kredit'] == '') {
            $val_kredit = '0';
        } else {
            $val_kredit = str_replace(",", "", $data['kredit']);;
        }

        $val_debet = 0;
        if ($data['debit'] == '') {
            $val_debet = '0';
        } else {
            $val_debet = str_replace(",", "", $data['debit']);
        }


        $sql = "UPDATE voucher SET  acctno  = '$data[acct]',
                                            descript= '$data[acct_nama]',
                                            debit   = $val_debet,
                                            credit  = $val_kredit,
                                            remarks = '$data[transaksi_remark]',
                                            kode_pt = '$data[divisi_v]'
                                        WHERE id = '$data[idvoucher]'";

        return $this->mips_caba->query($sql);
    }

    function hapus_vouc_tmp_detail_edit($data)
    {

        $sql = "DELETE FROM voucher WHERE ID = '$data[id_vouc]' and VOUCNO = '$data[voucno]'";
        return $this->mips_caba->query($sql);
    }

    function get_data_saldo_awal()
    {

        $sql = "SELECT *,FORMAT(saldo, 2) saldo_f,
                            FORMAT(saldo_1, 2) saldo1_f,
                            FORMAT(saldo_2, 2) saldo2_f,
                            FORMAT(saldo_3, 2) saldo3_f,
                            FORMAT(saldo_4, 2) saldo4_f,
                            FORMAT(saldo_5, 2) saldo5_f,
                            FORMAT(saldo_6, 2) saldo6_f,
                            FORMAT(saldo_7, 2) saldo7_f,
                            FORMAT(saldo_8, 2) saldo8_f,
                            FORMAT(saldo_9, 2) saldo9_f,
                            FORMAT(saldo_10, 2) saldo10_f,
                            FORMAT(saldo_11, 2) saldo11_f,
                            FORMAT(saldo_12, 2) saldo12_f
                             FROM master_accountcb ORDER BY id DESC";
        return $this->mips_caba->query($sql);
    }

    function get_detail_supplier($data)
    {

        $sql = "SELECT account,nama_account FROM supplier where kode = '$data[kode_supplier]'";
        return $this->mstcode->query($sql);
    }

    function cek_saldo_awal($data)
    {

        $sql = "SELECT * FROM master_accountcb where acctno = '$data[acctno]' AND thn = '$data[tahun]'";
        return $this->mips_caba->query($sql);
    }


    function update_saldo_awal($data)
    {


        $saldo = str_replace(",", "", $data['saldo']);
        // $bln   = $data['bulan'];

        $period = $this->periode();

        $tahun  = substr($period, 0, 4);
        $bln  = substr($period, 4, 5);





        $var_bulan = 0;
        if ($bln == '01') {
            $var_bulan = 'saldo_1 = ' . $saldo . '';
        } else if ($bln == '02') {
            $var_bulan = 'saldo_2 = ' . $saldo . '';
        } else if ($bln == '03') {
            $var_bulan = 'saldo_3 = ' . $saldo . '';
        } else if ($bln == '04') {
            $var_bulan = 'saldo_4 = ' . $saldo . '';
        } else if ($bln == '05') {
            $var_bulan = 'saldo_5 = ' . $saldo . '';
        } else if ($bln == '06') {
            $var_bulan = 'saldo_6 = ' . $saldo . '';
        } else if ($bln == '07') {
            $var_bulan = 'saldo_7 = ' . $saldo . '';
        } else if ($bln == '08') {
            $var_bulan = 'saldo_8 = ' . $saldo . '';
        } else if ($bln == '09') {
            $var_bulan = 'saldo_9 = ' . $saldo . '';
        } else if ($bln == '10') {
            $var_bulan = 'saldo_10 = ' . $saldo . '';
        } else if ($bln == '11') {
            $var_bulan = 'saldo_11 = ' . $saldo . '';
        } else if ($bln == '12') {
            $var_bulan = 'saldo_12 = ' . $saldo . '';
        } else {
            $var_bulan = '-';
        }

        $sql = "UPDATE master_accountcb SET  saldo  = '$saldo', $var_bulan WHERE ACCTNO = '$data[acctno]' AND thn = '$tahun'";

        return $this->mips_caba->query($sql);
    }

    function simpan_saldo_awal($data)
    {
        $saldo = str_replace(",", "", $data['saldo']);
        $bln   = $data['bulan'];

        $var_bulan = 0;
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

        $saldoawal["SITENO"] = $this->session->userdata('sess_id_lokasi');
        $saldoawal["ACCTNO"] = $data['acctno'];
        $saldoawal["ACCTNAME"] = $data['acctname'];
        $saldoawal["saldo"] = $saldo;
        if ($var_bulan != '-') {
            # code...
            $saldoawal["saldo_$var_bulan"] = $saldo;
        }

        $saldoawal["thn"] = $data['tahun'];

        $this->mips_caba->insert('master_accountcb', $saldoawal);
        if ($this->mips_caba->affected_rows() > 0) {
            $bool_saldo_awal = TRUE;
        } else {
            $bool_saldo_awal = FALSE;
        }
        $this->mips_caba->insert('saldo_voucher', $saldoawal);
        if ($this->mips_caba->affected_rows() > 0) {
            $bool_saldo_akhir = TRUE;
        } else {
            $bool_saldo_akhir = FALSE;
        }


        if ($bool_saldo_awal === TRUE && $bool_saldo_akhir === TRUE) {
            return array('status' => TRUE);
        } else {
            return FALSE;
        }
    }

    function saldo_awal_detail($data)
    {


        $bln   = $data['bulan'];

        $var_bulan = 0;
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

        $sql = "SELECT *,FORMAT(saldo_" . $var_bulan . ", 2) saldo_f FROM master_accountcb WHERE id = '$data[id_saldo]' and thn = '$data[tahun]'";
        return $this->mips_caba->query($sql);
    }


    function saldo_awal_update($data)
    {


        $saldo = str_replace(",", "", $data['saldo']);
        $bln   = $data['bulan'];

        $var_bulan = 0;
        if ($bln == '01') {
            $var_bulan = 'saldo_1 = ' . $saldo . '';
        } else if ($bln == '01') {
            $var_bulan = 'saldo_2 = ' . $saldo . '';
        } else if ($bln == '03') {
            $var_bulan = 'saldo_3 = ' . $saldo . '';
        } else if ($bln == '04') {
            $var_bulan = 'saldo_4 = ' . $saldo . '';
        } else if ($bln == '05') {
            $var_bulan = 'saldo_5 = ' . $saldo . '';
        } else if ($bln == '06') {
            $var_bulan = 'saldo_6 = ' . $saldo . '';
        } else if ($bln == '07') {
            $var_bulan = 'saldo_7 = ' . $saldo . '';
        } else if ($bln == '08') {
            $var_bulan = 'saldo_8 = ' . $saldo . '';
        } else if ($bln == '09') {
            $var_bulan = 'saldo_9 = ' . $saldo . '';
        } else if ($bln == '10') {
            $var_bulan = 'saldo_10 = ' . $saldo . '';
        } else if ($bln == '11') {
            $var_bulan = 'saldo_11 = ' . $saldo . '';
        } else if ($bln == '12') {
            $var_bulan = 'saldo_12 = ' . $saldo . '';
        } else {
            $var_bulan = '-';
        }

        $sql = "UPDATE master_accountcb SET  saldo  = '$saldo',
                                            $var_bulan
                                            WHERE id = '$data[id_saldo]' AND thn = '$data[tahun]'";

        return $this->mips_caba->query($sql);
    }


    function hapus_vouchers($data)
    {

        //header
        $sql = "DELETE FROM head_voucher WHERE ID = '$data[id_vouc]' AND VOUCNO = '$data[no_vouc]' AND txtperiode = '$data[txt_periode]' ";
        $this->mips_caba->query($sql);

        //detail
        $sql1 = "DELETE FROM voucher WHERE VOUCNO = '$data[no_vouc]' AND txtperiode = '$data[txt_periode]' ";
        return $this->mips_caba->query($sql1);
    }


    function cek_pp_logistik($data)
    {

        $sql = "SELECT NO_PO FROM voucher_tmp where NO_PO = '$data[ref_po]'";
        return $this->mips_caba->query($sql);
    }

    function transfer_to_gl()
    {
    }

    function posting_harian_submit()
    {

        $lokasi = $this->get_id_lokasi();
        $nama_lokasi = $this->get_nama_lokasi();
        $period = $this->periode();

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
        // return $tahun . 'dan' . $bulan;

        $dt = $this->mips_caba->query("SELECT DISTINCT(ACCTNO) FROM voucher WHERE MONTH(`DATE`) = '$bulan' AND YEAR(`DATE`) = '$tahun' AND  POSTED = 0 AND LOKASI='$nama_lokasi' GROUP BY ACCTNO")->result();
        // $arr = [];
        foreach ($dt as $d) {
            // $arr[] = array(
            //     'ACCTNO' => $d->ACCTNO
            // );
            $saldoawal = $this->mips_caba->query("SELECT saldo, saldo_$var_bulan as saldone FROM master_accountcb WHERE SITENO='$lokasi' AND ACCTNO='$d->ACCTNO' AND thn='$tahun'")->row();

            $sql = "SELECT SUM(DEBIT) AS sum_debit, SUM(CREDIT) AS sum_credit FROM voucher WHERE MONTH(`DATE`) = '$bulan' AND YEAR(`DATE`) = '$tahun' AND ACCTNO='$d->ACCTNO' AND LOKASI='$nama_lokasi' GROUP BY ACCTNO";
            $sd = $this->mips_caba->query($sql)->row();

            $coa = $d->ACCTNO;
            $sal = $saldoawal->saldone + $sd->sum_debit;
            $saldos = $sal - $sd->sum_credit;
            $saldo_vou["saldo"] = $saldos;
            $saldo_vou["saldo_$var_bulan"] = $saldos;
            $this->mips_caba->set($saldo_vou);
            $this->mips_caba->where(['SITENO' => $lokasi, 'ACCTNO' => $coa, 'thn' => $tahun]);
            $this->mips_caba->update('saldo_voucher');
        }
        // return $saldo_vou;
        //$h = "b'1'";
        $sqlc = "UPDATE voucher SET POSTED = 1 AND MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' WHERE POSTED = 0 AND LOKASI='$nama_lokasi'";
        return $this->mips_caba->query($sqlc);
    }


    function transfer_ke_gl_submit()
    {

        $period = $this->periode();

        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 5);

        $lokasi = $this->get_nama_lokasi();


        $periodes = $tahun . '-' . $bulan . '-' . '-01';
        //head entry
        $sql_head = "SELECT VOUCNO,DATE,txtperiode,LOKASI,KODE_PT FROM head_voucher WHERE MONTH(`DATE`) = '$bulan' AND YEAR(`DATE`) = '$tahun' AND LOKASI='$lokasi'";
        $result_head = $this->mips_caba->query($sql_head)->result_array();
        $ses_nama = $this->session->userdata('sess_nama');
        foreach ($result_head as $a) {

            $sql_cek_head = "SELECT ref FROM header_entry WHERE MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' AND modul = 'CABA' AND ref = '$a[VOUCNO]' AND lokasi='$lokasi'";
            $kd = $this->mips_gl->query($sql_cek_head)->num_rows();

            if ($kd == 0) {

                $saaa = "SELECT SUM(DEBIT) AS totaldr, SUM(CREDIT) AS totalcr FROM voucher WHERE VOUCNO='$a[VOUCNO]'";
                $bb = $this->mips_caba->query($saaa)->row();


                $head['date'] =  $a['DATE'];
                $head['periode'] =  $periodes;
                $head['ref'] =  $a['VOUCNO'];
                $head['totaldr'] =  $bb->totaldr;
                $head['totalcr'] =  $bb->totalcr;
                $head['periodetxt'] =  $a['txtperiode'];
                $head['modul'] =  "CABA";
                $head['lokasi'] =  $a['LOKASI'];
                $head['user'] =  $ses_nama;
                $head['SBU'] =  $a['KODE_PT'];

                $this->mips_gl->insert('header_entry', $head);
            }
        }

        //entry

        $sql = "SELECT DATE, VOUCNO, ACCTNO, DEBIT, CREDIT, KODE_PT, DESCRIPT, REMARKS, txtperiode, LOKASI FROM voucher WHERE MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' AND LOKASI = '$lokasi' AND POSTED = 1";
        $result = $this->mips_caba->query($sql)->result_array();
        $nama = $this->session->userdata('sess_nama');
        foreach ($result as $a) {

            //cek dulu di entry GL sudah tersedia atau belum disini untuk voucher ini
            $sql_cek = "SELECT ref FROM entry WHERE MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' AND module = 'CABA' AND ref = '$a[VOUCNO]' AND noac = '$a[ACCTNO]' AND lokasi='$lokasi'";
            $k = $this->mips_gl->query($sql_cek)->num_rows();

            if ($a['DEBIT'] == 0) {
                $types = 'C';
            } else if ($a['CREDIT'] == 0) {
                $types = 'D';
            }

            $coax = $a['ACCTNO'];
            $jk = "SELECT  `type`,`level`,`group`,general FROM noac WHERE noac = '$coax'";
            $as = $this->mips_center->query($jk)->row_array();
            $noac_type    = $as['type'];
            $noac_level   = $as['level'];
            $noac_group   = $as['group'];
            $noac_general = $as['general'];


            if ($k == 0) {
                $sql_ins['date'] = $a['DATE'];
                $sql_ins['sbu'] = $a['KODE_PT'];
                $sql_ins['noac'] = $a['ACCTNO'];
                $sql_ins['type'] = $noac_type;
                $sql_ins['level'] = $noac_level;
                $sql_ins['group'] = $noac_group;
                $sql_ins['general'] = $noac_general;
                $sql_ins['dr'] = $a['DEBIT'];
                $sql_ins['cr'] = $a['CREDIT'];
                $sql_ins['periode'] = $periodes;
                $sql_ins['descac'] = $a['DESCRIPT'];
                $sql_ins['ket'] = $a['REMARKS'];
                $sql_ins['periodetxt'] = $a['txtperiode'];
                $sql_ins['module'] = 'CABA';
                $sql_ins['dc'] = $types;
                $sql_ins['lokasi'] = $lokasi;
                $sql_ins['tglinput'] = date('Y-m-d H:i:s');
                $sql_ins['user'] = $nama;
                $sql_ins['ref'] = $a['VOUCNO'];
                $sql_ins['POST'] = 0;
                $sql_ins['begindr'] = 0;
                $sql_ins['begincr'] = 0;
                $sql_ins['converse'] = 0;
                $sql_ins['noref'] = 0;

                $this->mips_gl->insert('entry', $sql_ins);
            } else {
            }
        }
        return true;
    }

    function monthly_closing_submit()
    {
        $period = $this->periode();

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

        // $saldo_akhir = $this->mips_caba->query("SELECT acctno, acctname, thn FROM saldo_voucher WHERE thn='$tahun'")->result();
        // foreach ($saldo_akhir as $d) {
        //     // $saldo = $d->saldone;
        //     $saldoawal["ACCTNO"] = $d->acctno;
        //     $saldoawal["ACCTNAME"] = $d->acctname;
        //     $saldoawal["saldo"] = "0";
        //     if ($var_bulan != '-') {
        //         # code...
        //         $saldoawal["saldo_$var_bulan"] = "0";
        //     }

        //     $saldoawal["thn"] = $d->thn + 1;
        //     // $this->mips_caba->insert('saldo_voucher', $saldoawal);
        //     // if ($this->mips_caba->affected_rows() > 0) {
        //     //     $bool_saldo_akhir = TRUE;
        //     // } else {
        //     //     $bool_saldo_akhir = FALSE;
        //     // }
        // }
        // if ($bulan == '12') {
        // } else {
        //     # code...
        // }

        return $this->session->userdata('sess_periode');
    }

    function monthly_closing_submit_old()
    {

        $period = $this->periode();

        $tahun  = substr($period, 0, 4);
        $bulan  = substr($period, 4, 5);

        $lokasi = $this->get_nama_lokasi();

        $sql = "SELECT  * FROM voucher WHERE MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' and lokasi = '$lokasi' and POSTED = 1";
        $result = $this->mips_caba->query($sql)->result_array();
        $nama = $this->session->userdata('sess_nama');
        foreach ($result as $a) {

            //cek dulu di entry GL sudah tersedia atau belum disini untuk voucher ini
            $sql_cek = "SELECT  * FROM entry WHERE MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' AND module = 'CABA' AND ref = '$a[VOUCNO]' AND noac = '$a[ACCTNO]'";
            $k = $this->mips_gl->query($sql_cek)->num_rows();

            if ($a['DEBIT'] == 0) {
                $types = 'C';
            } else if ($a['KREDIT'] == 0) {
                $types = 'D';
            }

            $coax = $a['ACCTNO'];
            $jk = "SELECT  `type`,`level`,`group`,general FROM noac WHERE noac = '$coax'";
            $as = $this->mips_center->query($jk)->row_array();
            $noac_type    = $as['type'];
            $noac_level   = $as['level'];
            $noac_group   = $as['group'];
            $noac_general = $as['general'];


            if ($k == 0) {
                $sql_ins = "INSERT INTO entry (`date`,
                                    sbu,
                                    noac,
                                    `type`,
                                    `level`,
                                    `group`,
                                    general,
                                    dr,
                                    cr,
                                    periode,
                                    descac,
                                    ket,
                                    periodetxt,
                                    module,
                                    dc,
                                    lokasi,
                                    tglinput,
                                    user,
                                    ref,
                                    begindr,
                                    begincr,
                                    `POST`,
                                    noref,
                                    converse) 
                            VALUES ('$a[DATE]',
                                    '$a[KODE_PT]',
                                    '$a[ACCTNO]',
                                    '$noac_type',
                                    '$noac_level',
                                    '$noac_group',
                                    '$noac_general',
                                    '$a[DEBIT]',
                                    '$a[CREDIT]',
                                    '$a[DATE]',
                                    '$a[DESCRIPT]',
                                    '$a[REMARKS]',
                                    '$a[TGLTXT]',
                                    'CABA',
                                    '$types',
                                    '$a[LOKASI]',NOW(),'$nama','$a[VOUCNO]',0,0,0,0,0)";

                $this->mips_gl->query($sql_ins);
            } else {
            }
        }
    }




    public function delete_vocher_tmp($id_user)
    {
        $cek = $this->mips_caba->query("SELECT SUBSTRING(CHEQNO, 7, 100) nopp FROM voucher_tmp WHERE id_user = '$id_user' AND PAY =''")->row();

        //update pp_logistik
        $this->mips_caba->where(['nopp' => $cek->nopp]);
        $this->mips_caba->set('status_vou', 0);
        $this->mips_caba->update('pp_logistik');

        $this->mips_caba->delete('voucher_tmp', array('id_user' => $id_user));
        return true;
    }

    public function get_vocher_tmp()
    {
        $id_user = $this->session->userdata('sess_id');
        $cek = $this->mips_caba->query("SELECT VOUCNO FROM voucher_tmp WHERE id_user = '$id_user' ")->row();
        $dt = $cek->VOUCNO;
        return $dt;
    }


    public function get_coa_bank()
    {
        $id = $this->session->userdata('sess_id');
        $data = $this->mips_caba->query("SELECT ACCTNO, DESCRIPT FROM voucher_tmp WHERE id_user='$id' AND pay !=''");
        return $data;
    }
}
