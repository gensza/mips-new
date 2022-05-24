<script type="text/javascript">
    function saldo_akhir(coa, jml, py) {
        $.ajax({
            url: base_url + 'cash_bank/update_saldo_akhir',
            type: "post",
            data: {
                coa: coa,
                jml: jml,
                pay: py,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            async: 'false',
            success: function(result) {
                console.log('oke berhasil', result);
                // console.log(result);

            },
            beforeSend: function() {
                //loadingPannel.show();
            },
            complete: function() {
                //loadingPannel.hide();
            }
        });
    }
    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';
        var lokasi_usr = '<?php echo $this->session->userdata('sess_id_lokasi'); ?>';

        $("#pay_rec").change(function() {
            $("#kas_bank").val(0);
            $("#bank_descript").val(0);
        });

        $("#kas_bank").change(function() {

            if ($(this).val() == 'Kas') {
                $('#bank_descript').empty();
                var $kategori = $('#bank_descript');
                //$kategori.append('<option value=0>-Pilih Bank-</option>');
                $kategori.append('<option value="-">-</option>');
            } else {
                select_bank();
            }

        });


        $.ajax({
            url: base_url + 'cash_bank/get_data_head_vouch2',
            type: "post",
            data: {
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            async: 'false',
            success: function(result) {

                // console.log('ini datanya', result.DESCRIPT);

                $("#coa_head").val(result.ACCTNO);
                $("#pay_rec").val(result.JENIS);
                $("#kas_bank").val(result.TRANS);
                $("#tanggal").val(result.TGL);
                $("#kepada").val(result.FROM);
                $("#noref_select").val(result.REF_PP);
                $("#no_ref").val(result.NO_PP);
                if (result.JENIS == 'Payment') {
                    $("#jumlah").val(result.DEBIT);
                    buttonCode(result.DEBIT);
                } else {
                    $("#jumlah").val(result.CREDIT);
                    buttonCode(result.CREDIT);
                }

                $('#transaksi_remark').val(result.REMARKS);


                // $("#terbilang").val(result.PAY);
                $("#bank_no").val(result.NOCEKBG);
                $("#bank_nama").val(result.BANKCEK);


                if (result.TGLCEK == '' || result.TGLCEK == null) {
                    $("#bank_tanggal").val('');
                } else {
                    $("#bank_tanggal").val(result.TGLCEK);
                }

                $("#sumber_dana").val(result.PDO);
                $("#sumber_dana_nominal").val(result.sumber);

                //select_bank();

                get_coa_bank();
            },
            beforeSend: function() {
                //loadingPannel.show();
            },
            complete: function() {
                //loadingPannel.hide();
            }
        });

        get_coa_bank = function() {
            $.ajax({
                type: 'POST',
                url: base_url + 'cash_bank/get_coa_bank',
                data: {
                    lokasi: lokasi_usr
                },
                dataType: 'json',
                success: function(data) {

                    console.log();
                    select_bank_get(data.DESCRIPT);
                    $("#bank_descript").val(data.DESCRIPT);
                }
            });
        }






        $('.maskmoney_money').maskMoney({
            thousands: ',',
            decimal: '.',
            precision: 0,
        });

        $("#kas_bank").change(function() {

            if ($(this).val() == 'Kas') {
                $('#bank_descript').empty();
                var $kategori = $('#bank_descript');
                $kategori.append('<option value=0>-Pilih Bank-</option>');
                $kategori.append('<option value=0>-</option>');
            } else {
                select_bank();
            }

        });

        /* select bank */
        select_bank = function() {

            var payrc = $("#pay_rec").val();

            //1 : HO
            //2 : ESTATE
            //3 : RO

            if (lokasi_usr == '01') { // INI HO


                if (payrc == 'Payment') {

                    $.ajax({
                        type: 'POST',
                        url: base_url + 'cash_bank/get_bank_konfig',
                        data: {
                            lokasi: lokasi_usr
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);

                            var str1 = data.pay_namabank1;
                            var str_1 = data.NOAC_BANK1;
                            str1 = str1.replace(/\s+/g, '_');

                            var str2 = data.pay_namabank2;
                            var str_2 = data.NOAC_BANK2;
                            str2 = str2.replace(/\s+/g, '_');

                            var str3 = data.pay_namabank3;
                            var str_3 = data.NOAC_BANK3;
                            str3 = str3.replace(/\s+/g, '_');

                            var str4 = data.pay_namabank4;
                            var str_4 = data.NOAC_BANK4;
                            str4 = str4.replace(/\s+/g, '_');

                            var str5 = data.pay_namabank5;
                            var str_5 = data.NOAC_BANK5;
                            str5 = str5.replace(/\s+/g, '_');

                            var str6 = data.pay_namabank6;
                            var str_6 = data.NOAC_BANK6;
                            str6 = str6.replace(/\s+/g, '_');

                            var str7 = data.pay_namabank7;
                            var str_7 = data.NOAC_BANK7;
                            str7 = str7.replace(/\s+/g, '_');

                            var str8 = data.pay_namabank8;
                            var str_8 = data.NOAC_BANK8;
                            str8 = str8.replace(/\s+/g, '_');

                            var str9 = data.pay_namabank9;
                            var str_9 = data.NOAC_BANK9;
                            str9 = str9.replace(/\s+/g, '_');

                            var str10 = data.pay_namabank10;
                            var str_10 = data.NOAC_BANK10;
                            str10 = str10.replace(/\s+/g, '_');

                            $('#bank_descript').empty();
                            var $kategori = $('#bank_descript');
                            $kategori.append('<option value=0>-Pilih Bank-</option>');
                            $kategori.append('<option value=' + str_1 + '|' + str1 + '|1>' + data.pay_namabank1 + '</option>');
                            $kategori.append('<option value=' + str_2 + '|' + str2 + '|2>' + data.pay_namabank2 + '</option>');
                            $kategori.append('<option value=' + str_3 + '|' + str3 + '|3>' + data.pay_namabank3 + '</option>');
                            $kategori.append('<option value=' + str_4 + '|' + str4 + '|4>' + data.pay_namabank4 + '</option>');
                            $kategori.append('<option value=' + str_5 + '|' + str5 + '|5>' + data.pay_namabank5 + '</option>');
                            $kategori.append('<option value=' + str_6 + '|' + str6 + '|6>' + data.pay_namabank6 + '</option>');
                            $kategori.append('<option value=' + str_7 + '|' + str7 + '|7>' + data.pay_namabank7 + '</option>');
                            $kategori.append('<option value=' + str_8 + '|' + str8 + '|8>' + data.pay_namabank8 + '</option>');
                            $kategori.append('<option value=' + str_9 + '|' + str9 + '|9>' + data.pay_namabank9 + '</option>');
                            $kategori.append('<option value=' + str_10 + '|' + str10 + '|10>' + data.pay_namabank10 + '</option>');
                        }
                    });

                } else if (payrc == 'Receive') {


                    $.ajax({
                        type: 'POST',
                        url: base_url + 'cash_bank/get_bank_konfig',
                        data: {
                            lokasi: lokasi_usr
                        },
                        dataType: 'json',
                        success: function(data) {

                            var str1 = data.rec_namabank1;
                            var strr_1 = data.NOACC_RECBANK1;
                            str1 = str1.replace(/\s+/g, '_');

                            var str2 = data.rec_namabank2;
                            var strr_2 = data.NOACC_RECBANK2;
                            str2 = str2.replace(/\s+/g, '_');

                            var str3 = data.rec_namabank3;
                            var strr_3 = data.NOACC_RECBANK3;
                            str3 = str3.replace(/\s+/g, '_');

                            var str4 = data.rec_namabank4;
                            var strr_4 = data.NOACC_RECBANK4;
                            str4 = str4.replace(/\s+/g, '_');

                            var str5 = data.rec_namabank5;
                            var strr_5 = data.NOACC_RECBANK5;
                            str5 = str5.replace(/\s+/g, '_');

                            var str6 = data.rec_namabank6;
                            var strr_6 = data.NOACC_RECBANK6;
                            str6 = str6.replace(/\s+/g, '_');

                            var str7 = data.rec_namabank7;
                            var strr_7 = data.NOACC_RECBANK7;
                            str7 = str7.replace(/\s+/g, '_');

                            var str8 = data.rec_namabank8;
                            var strr_8 = data.NOACC_RECBANK8;
                            str8 = str8.replace(/\s+/g, '_');

                            var str9 = data.rec_namabank9;
                            var strr_9 = data.NOACC_RECBANK9;
                            str9 = str9.replace(/\s+/g, '_');

                            var str10 = data.rec_namabank10;
                            var strr_10 = data.NOACC_RECBANK10;
                            str10 = str10.replace(/\s+/g, '_');

                            $('#bank_descript').empty();
                            var $kategori = $('#bank_descript');
                            $kategori.append('<option value=0>-Pilih Bank-</option>');
                            $kategori.append('<option value=' + strr_1 + '|' + str1 + '|1>' + data.rec_namabank1 + '</option>');
                            $kategori.append('<option value=' + strr_2 + '|' + str2 + '|2>' + data.rec_namabank2 + '</option>');
                            $kategori.append('<option value=' + strr_3 + '|' + str3 + '|3>' + data.rec_namabank3 + '</option>');
                            $kategori.append('<option value=' + strr_4 + '|' + str4 + '|4>' + data.rec_namabank4 + '</option>');
                            $kategori.append('<option value=' + strr_5 + '|' + str5 + '|5>' + data.rec_namabank5 + '</option>');
                            $kategori.append('<option value=' + strr_6 + '|' + str6 + '|6>' + data.rec_namabank6 + '</option>');
                            $kategori.append('<option value=' + strr_7 + '|' + str7 + '|7>' + data.rec_namabank7 + '</option>');
                            $kategori.append('<option value=' + strr_8 + '|' + str8 + '|8>' + data.rec_namabank8 + '</option>');
                            $kategori.append('<option value=' + strr_9 + '|' + str9 + '|9>' + data.rec_namabank9 + '</option>');
                            $kategori.append('<option value=' + strr_10 + '|' + str10 + '|10>' + data.rec_namabank10 + '</option>');
                        }
                    });


                } else {

                }


            } else if (lokasi_usr == 2) { // INI ESTATE


                if (payrc == 'Payment') {

                    $.ajax({
                        type: 'POST',
                        url: base_url + 'cash_bank/get_bank_konfig',
                        data: {
                            lokasi: lokasi_usr
                        },
                        dataType: 'json',
                        success: function(data) {

                            var str1 = data.pay_namabank1;
                            var str_1 = data.NOAC_BANK1;
                            str1 = str1.replace(/\s+/g, '_');

                            var str2 = data.pay_namabank2;
                            var str_2 = data.NOAC_BANK2;
                            str2 = str2.replace(/\s+/g, '_');

                            var str3 = data.pay_namabank3;
                            var str_3 = data.NOAC_BANK3;
                            str3 = str3.replace(/\s+/g, '_');

                            var str4 = data.pay_namabank4;
                            var str_4 = data.NOAC_BANK4;
                            str4 = str4.replace(/\s+/g, '_');

                            $('#bank_descript').empty();
                            var $kategori = $('#bank_descript');
                            $kategori.append('<option value=0>-Pilih Bank-</option>');
                            $kategori.append('<option value=' + str_1 + '|' + str1 + '|1>' + data.pay_namabank1 + '</option>');
                            $kategori.append('<option value=' + str_2 + '|' + str2 + '|2>' + data.pay_namabank2 + '</option>');
                            $kategori.append('<option value=' + str_3 + '|' + str3 + '|3>' + data.pay_namabank3 + '</option>');
                            $kategori.append('<option value=' + str_4 + '|' + str4 + '|4>' + data.pay_namabank4 + '</option>');
                        }
                    });

                } else if (payrc == 'Receive') {

                    $.ajax({
                        type: 'POST',
                        url: base_url + 'cash_bank/get_bank_konfig',
                        data: {
                            lokasi: lokasi_usr
                        },
                        dataType: 'json',
                        success: function(data) {

                            var str1 = data.rec_namabank1;
                            str1 = str1.replace(/\s+/g, '_');

                            var str2 = data.rec_namabank2;
                            str2 = str2.replace(/\s+/g, '_');

                            $('#bank_descript').empty();
                            var $kategori = $('#bank_descript');
                            $kategori.append('<option value=0>-Pilih Bank-</option>');
                            $kategori.append('<option value=' + str1 + '|1>' + data.rec_namabank1 + '</option>');
                            $kategori.append('<option value=' + str2 + '|2>' + data.rec_namabank2 + '</option>');
                        }
                    });

                }

            } else if (lokasi_usr == 3) {

            } else {

            }



        }
        //select_bank();
        /* select grup */



        select_bank_get = function(bank) {

            var payrc = $("#pay_rec").val();
            console.log('nama bank nya adalah', bank);
            //1 : HO
            //2 : ESTATE
            //3 : RO

            if (lokasi_usr == 1) { // INI HO


                if (payrc == 'Payment') {

                    $.ajax({
                        type: 'POST',
                        url: base_url + 'cash_bank/get_bank_konfig',
                        data: {
                            lokasi: lokasi_usr
                        },
                        dataType: 'json',
                        success: function(data) {


                            var str1 = data.pay_namabank1;
                            var str_1 = data.NOAC_BANK1;
                            str1 = str1.replace(/\s+/g, '_');

                            var str2 = data.pay_namabank2;
                            var str_2 = data.NOAC_BANK2;
                            str2 = str2.replace(/\s+/g, '_');

                            var str3 = data.pay_namabank3;
                            var str_3 = data.NOAC_BANK3;
                            str3 = str3.replace(/\s+/g, '_');

                            var str4 = data.pay_namabank4;
                            var str_4 = data.NOAC_BANK4;
                            str4 = str4.replace(/\s+/g, '_');

                            var str5 = data.pay_namabank5;
                            var str_5 = data.NOAC_BANK5;
                            str5 = str5.replace(/\s+/g, '_');

                            var str6 = data.pay_namabank6;
                            var str_6 = data.NOAC_BANK6;
                            str6 = str6.replace(/\s+/g, '_');

                            var str7 = data.pay_namabank7;
                            var str_7 = data.NOAC_BANK7;
                            str7 = str7.replace(/\s+/g, '_');

                            var str8 = data.pay_namabank8;
                            var str_8 = data.NOAC_BANK8;
                            str8 = str8.replace(/\s+/g, '_');

                            var str9 = data.pay_namabank9;
                            var str_9 = data.NOAC_BANK9;
                            str9 = str9.replace(/\s+/g, '_');

                            var str10 = data.pay_namabank10;
                            var str_10 = data.NOAC_BANK10;
                            str10 = str10.replace(/\s+/g, '_');

                            $('#bank_descript').empty();
                            var $kategori = $('#bank_descript');
                            //$kategori.append('<option value=0>-Pilih Bank-</option>');
                            var selected_bank_1;
                            if (data.pay_namabank1 == bank) {
                                selected_bank_1 = 'selected';
                            } else {
                                selected_bank_1 = '';
                            }

                            var selected_bank_2;
                            if (data.pay_namabank2 == bank) {
                                selected_bank_2 = 'selected';
                            } else {
                                selected_bank_2 = '';
                            }


                            var selected_bank_3;
                            if (data.pay_namabank3 == bank) {
                                selected_bank_3 = 'selected';
                            } else {
                                selected_bank_3 = '';
                            }

                            var selected_bank_4;
                            if (data.pay_namabank4 == bank) {
                                selected_bank_4 = 'selected';
                            } else {
                                selected_bank_4 = '';
                            }

                            var selected_bank_5;
                            if (data.pay_namabank5 == bank) {
                                selected_bank_5 = 'selected';
                            } else {
                                selected_bank_5 = '';
                            }

                            var selected_bank_6;
                            if (data.pay_namabank6 == bank) {
                                selected_bank_6 = 'selected';
                            } else {
                                selected_bank_6 = '';
                            }

                            var selected_bank_7;
                            if (data.pay_namabank7 == bank) {
                                selected_bank_7 = 'selected';
                            } else {
                                selected_bank_7 = '';
                            }

                            var selected_bank_8;
                            if (data.pay_namabank8 == bank) {
                                selected_bank_8 = 'selected';
                            } else {
                                selected_bank_8 = '';
                            }

                            var selected_bank_9;
                            if (data.pay_namabank9 == bank) {
                                selected_bank_9 = 'selected';
                            } else {
                                selected_bank_9 = '';
                            }

                            var selected_bank_10;
                            if (data.pay_namabank10 == bank) {
                                selected_bank_10 = 'selected';
                            } else {
                                selected_bank_10 = '';
                            }
                            $kategori.append('<option value=0>-Pilih Bank-</option>');
                            $kategori.append('<option value=' + str_1 + '|' + str1 + '|1 ' + selected_bank_1 + '>' + data.pay_namabank1 + '</option>');
                            $kategori.append('<option value=' + str_2 + '|' + str2 + '|2 ' + selected_bank_2 + '>' + data.pay_namabank2 + '</option>');
                            $kategori.append('<option value=' + str_3 + '|' + str3 + '|3 ' + selected_bank_3 + '>' + data.pay_namabank3 + '</option>');
                            $kategori.append('<option value=' + str_4 + '|' + str4 + '|4 ' + selected_bank_4 + '>' + data.pay_namabank4 + '</option>');
                            $kategori.append('<option value=' + str_5 + '|' + str5 + '|5 ' + selected_bank_5 + '>' + data.pay_namabank5 + '</option>');
                            $kategori.append('<option value=' + str_6 + '|' + str6 + '|6 ' + selected_bank_6 + '>' + data.pay_namabank6 + '</option>');
                            $kategori.append('<option value=' + str_7 + '|' + str7 + '|7 ' + selected_bank_7 + '>' + data.pay_namabank7 + '</option>');
                            $kategori.append('<option value=' + str_8 + '|' + str8 + '|8 ' + selected_bank_8 + '>' + data.pay_namabank8 + '</option>');
                            $kategori.append('<option value=' + str_9 + '|' + str9 + '|9 ' + selected_bank_9 + '>' + data.pay_namabank9 + '</option>');
                            $kategori.append('<option value=' + str_10 + '|' + str10 + '|10 ' + selected_bank_10 + '>' + data.pay_namabank10 + '</option>');
                        }
                    });

                } else if (payrc == 'Receive') {


                    $.ajax({
                        type: 'POST',
                        url: base_url + 'cash_bank/get_bank_konfig',
                        data: {
                            lokasi: lokasi_usr
                        },
                        dataType: 'json',
                        success: function(data) {

                            var str1 = data.rec_namabank1;
                            str1 = str1.replace(/\s+/g, '_');

                            var str2 = data.rec_namabank2;
                            str2 = str2.replace(/\s+/g, '_');

                            var str3 = data.rec_namabank3;
                            str3 = str3.replace(/\s+/g, '_');

                            var str4 = data.rec_namabank4;
                            str4 = str4.replace(/\s+/g, '_');

                            var str5 = data.rec_namabank5;
                            str5 = str5.replace(/\s+/g, '_');

                            var str6 = data.rec_namabank6;
                            str6 = str6.replace(/\s+/g, '_');

                            var str7 = data.rec_namabank7;
                            str7 = str7.replace(/\s+/g, '_');

                            var str8 = data.rec_namabank8;
                            str8 = str8.replace(/\s+/g, '_');

                            var str9 = data.rec_namabank9;
                            str9 = str9.replace(/\s+/g, '_');

                            var str10 = data.rec_namabank10;
                            str10 = str10.replace(/\s+/g, '_');

                            $('#bank_descript').empty();
                            var $kategori = $('#bank_descript');
                            //$kategori.append('<option value=0>-Pilih Bank-</option>');

                            var selected_bank_1;
                            if (data.pay_namabank1 == bank) {
                                selected_bank_1 = 'selected';
                            } else {
                                selected_bank_1 = '';
                            }

                            var selected_bank_2;
                            if (data.pay_namabank2 == bank) {
                                selected_bank_2 = 'selected';
                            } else {
                                selected_bank_2 = '';
                            }


                            var selected_bank_3;
                            if (data.pay_namabank3 == bank) {
                                selected_bank_3 = 'selected';
                            } else {
                                selected_bank_3 = '';
                            }

                            var selected_bank_4;
                            if (data.pay_namabank4 == bank) {
                                selected_bank_4 = 'selected';
                            } else {
                                selected_bank_4 = '';
                            }

                            var selected_bank_5;
                            if (data.pay_namabank5 == bank) {
                                selected_bank_5 = 'selected';
                            } else {
                                selected_bank_5 = '';
                            }

                            var selected_bank_6;
                            if (data.pay_namabank6 == bank) {
                                selected_bank_6 = 'selected';
                            } else {
                                selected_bank_6 = '';
                            }

                            var selected_bank_7;
                            if (data.pay_namabank7 == bank) {
                                selected_bank_7 = 'selected';
                            } else {
                                selected_bank_7 = '';
                            }

                            var selected_bank_8;
                            if (data.pay_namabank8 == bank) {
                                selected_bank_8 = 'selected';
                            } else {
                                selected_bank_8 = '';
                            }

                            var selected_bank_9;
                            if (data.pay_namabank9 == bank) {
                                selected_bank_9 = 'selected';
                            } else {
                                selected_bank_9 = '';
                            }

                            var selected_bank_10;
                            if (data.pay_namabank10 == bank) {
                                selected_bank_10 = 'selected';
                            } else {
                                selected_bank_10 = '';
                            }

                            $kategori.append('<option value=' + str_1 + '|' + str1 + '|1 ' + selected_bank_1 + '>' + data.rec_namabank1 + '</option>');
                            $kategori.append('<option value=' + str_2 + '|' + str2 + '|2 ' + selected_bank_2 + '>' + data.rec_namabank2 + '</option>');
                            $kategori.append('<option value=' + str_3 + '|' + str3 + '|3 ' + selected_bank_3 + '>' + data.rec_namabank3 + '</option>');
                            $kategori.append('<option value=' + str_4 + '|' + str4 + '|4 ' + selected_bank_4 + '>' + data.rec_namabank4 + '</option>');
                            $kategori.append('<option value=' + str_5 + '|' + str5 + '|5 ' + selected_bank_5 + '>' + data.rec_namabank5 + '</option>');
                            $kategori.append('<option value=' + str_6 + '|' + str6 + '|6 ' + selected_bank_6 + '>' + data.rec_namabank6 + '</option>');
                            $kategori.append('<option value=' + str_7 + '|' + str7 + '|7 ' + selected_bank_7 + '>' + data.rec_namabank7 + '</option>');
                            $kategori.append('<option value=' + str_8 + '|' + str8 + '|8 ' + selected_bank_8 + '>' + data.rec_namabank8 + '</option>');
                            $kategori.append('<option value=' + str_9 + '|' + str9 + '|9 ' + selected_bank_9 + '>' + data.rec_namabank9 + '</option>');
                            $kategori.append('<option value=' + str_10 + '|' + str10 + '|10 ' + selected_bank_10 + '>' + data.rec_namabank10 + '</option>');
                        }
                    });


                } else {

                }


            } else if (lokasi_usr == 2) { // INI ESTATE


                if (payrc == 'Payment') {

                    $.ajax({
                        type: 'POST',
                        url: base_url + 'cash_bank/get_bank_konfig',
                        data: {
                            lokasi: lokasi_usr
                        },
                        dataType: 'json',
                        success: function(data) {

                            var str1 = data.pay_namabank1;
                            str1 = str1.replace(/\s+/g, '_');

                            var str2 = data.pay_namabank2;
                            str2 = str2.replace(/\s+/g, '_');

                            var str3 = data.pay_namabank3;
                            str3 = str3.replace(/\s+/g, '_');

                            var str4 = data.pay_namabank4;
                            str4 = str4.replace(/\s+/g, '_');

                            $('#bank_descript').empty();
                            var $kategori = $('#bank_descript');

                            var selected_bank_1;
                            if (data.pay_namabank1 == bank) {
                                selected_bank_1 = 'selected';
                            } else {
                                selected_bank_1 = '';
                            }

                            var selected_bank_2;
                            if (data.pay_namabank2 == bank) {
                                selected_bank_2 = 'selected';
                            } else {
                                selected_bank_2 = '';
                            }


                            var selected_bank_3;
                            if (data.pay_namabank3 == bank) {
                                selected_bank_3 = 'selected';
                            } else {
                                selected_bank_3 = '';
                            }

                            var selected_bank_4;
                            if (data.pay_namabank4 == bank) {
                                selected_bank_4 = 'selected';
                            } else {
                                selected_bank_4 = '';
                            }


                            //$kategori.append('<option value=0>-Pilih Bank-</option>');
                            $kategori.append('<option value=' + str1 + '|1 ' + selected_bank_1 + '>' + data.pay_namabank1 + '</option>');
                            $kategori.append('<option value=' + str2 + '|2 ' + selected_bank_2 + '>' + data.pay_namabank2 + '</option>');
                            $kategori.append('<option value=' + str3 + '|3 ' + selected_bank_3 + '>' + data.pay_namabank3 + '</option>');
                            $kategori.append('<option value=' + str4 + '|4 ' + selected_bank_4 + '>' + data.pay_namabank4 + '</option>');
                        }
                    });

                } else if (payrc == 'Receive') {

                    $.ajax({
                        type: 'POST',
                        url: base_url + 'cash_bank/get_bank_konfig',
                        data: {
                            lokasi: lokasi_usr
                        },
                        dataType: 'json',
                        success: function(data) {

                            var str1 = data.rec_namabank1;
                            str1 = str1.replace(/\s+/g, '_');

                            var str2 = data.rec_namabank2;
                            str2 = str2.replace(/\s+/g, '_');

                            var selected_bank_1;
                            if (data.pay_namabank1 == bank) {
                                selected_bank_1 = 'selected';
                            } else {
                                selected_bank_1 = '';
                            }

                            var selected_bank_2;
                            if (data.pay_namabank2 == bank) {
                                selected_bank_2 = 'selected';
                            } else {
                                selected_bank_2 = '';
                            }

                            $('#bank_descript').empty();
                            var $kategori = $('#bank_descript');
                            //$kategori.append('<option value=0>-Pilih Bank-</option>');
                            $kategori.append('<option value=' + str1 + '|1 ' + selected_bank_1 + '>' + data.rec_namabank1 + '</option>');
                            $kategori.append('<option value=' + str2 + '|2 ' + selected_bank_2 + '>' + data.rec_namabank2 + '</option>');
                        }
                    });

                }

            } else if (lokasi_usr == 3) {

            } else {

            }



        }


        // Datepicker
        $('.fc-datepicker1').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'dd-mm-yy'
        });

        $('.fc-datepicker2').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'dd-mm-yy'
        });

        $('#datepicker_pointer').click(function() {
            $(".fc-datepicker1").focus();
        });

        $('#datepicker_pointer2').click(function() {
            $(".fc-datepicker2").focus();
        });

        $('.maskmoney_money').maskMoney({
            thousands: ',',
            decimal: '.',
            precision: 2,
        });

        document.getElementById("jumlah").addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                var vals = $("#jumlah").val();
                buttonCode(vals);
                get_balance();
            } else if (event.keyCode == 9) {
                var vals = $("#jumlah").val();
                buttonCode(vals);
                get_balance();
            }
        });

        buttonCode = function(vals_jumlah) {
            var jumlahs = parseFloat(vals_jumlah.replace(/,/g, ''));
            var ammount_desc = toWords(jumlahs);
            var ammount_desc = ammount_desc.replace('SATU RIBU', 'SERIBU');
            var ammount_desc = ammount_desc.replace('SATU RIBU', 'SERIBU');
            var ammount_desc = ammount_desc.replace('SATU RIBU', 'SERIBU');
            var ammount_desc = ammount_desc.replace('SATU RATUS', 'SERATUS');
            var ammount_desc = ammount_desc.replace('SATU RATUS', 'SERATUS');
            var ammount_desc = ammount_desc.replace('SATU RATUS', 'SERATUS');

            var angkahuruf = ammount_desc.toUpperCase();

            $("#terbilang").val('# ' + angkahuruf + ' RUPIAH' + ' #');
        }

        $('.teksbesar').keyup(function() {
            this.value = this.value.toUpperCase();
        });



        $(".select2").select2({
            //minimumInputLength: 2
        });


        document.getElementById("acct").addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                var divisi = $('#divisi_v').val();
                if ($("#acct").val() == '') {
                    getpopup('cash_bank/master_tabel_coa_popup', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', '1');
                } else {

                    $.ajax({
                        url: base_url + 'gl/get_nama_acct',
                        type: "post",
                        data: {
                            acct: $("#acct").val(),
                            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        dataType: "json",
                        async: 'false',
                        success: function(result) {
                            $("#acct_nama").val(result.nama)
                        },
                        beforeSend: function() {
                            loadingPannel.show();
                        },
                        complete: function() {
                            loadingPannel.hide();
                            $('#tabel_detail_caba').show();
                        }
                    });

                }


            }
        });


        document.getElementById("no_ref").addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {

                if ($("#noref_select").val() == '-' || $("#noref_select").val() == '0') {

                } else {
                    getpopup('cash_bank/tabel_pp_logistik', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', '1');
                }


            }
        });


        document.getElementById("kredit").addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                //simpan_voucher_details();
                update_detail_vouc();
            }
        });


        document.getElementById("debet").addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                //simpan_voucher_details(); 
                update_detail_vouc();
            }
        });



        $("#acct_icon").click(function() {
            getpopup('gl_coa/tabel_coa_popup', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', '1');
        });


        $("#btn_simpan_detail").click(function() {

            simpan_voucher_details();

        });

        loading();

        table_caba_detail = function() {

            $.ajax({
                url: base_url + 'cash_bank/get_list_voucher_detail2',
                type: "post",
                data: {
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                async: 'false',
                success: function(result) {
                    var data = [];
                    for (var i = 0; i < result.length; i++) {

                        //var edit = '<div style="text-align:center" onclick=edit_vouc_tmp('+result[i].id_vouc_tmp+')><i class="splashy-pencil" style="cursor:pointer"></i></div>';
                        //var hapus = '<div style="text-align:center" onclick=hapus_vouc_tmp('+result[i].id_vouc_tmp+')><i class="splashy-gem_remove" style="cursor:pointer"></i></div>';

                        var link = "<a href='javascript:void(0)' onclick=\"edit_vouc_tmp(" + result[i].id_vouc_tmp + ",'" + result[i].VOUCNO + "');\" title='Edit'><i class='splashy-document_letter_edit'></i></a> <a href='javascript:void(0)' onclick=\"hapus_vouc_tmp(" + result[i].id_vouc_tmp + ",'" + result[i].VOUCNO + "');\" title='Hapus'><i class='splashy-document_a4_remove'></i></div></a>";


                        data.push([result[i].ACCTNO, result[i].DESCRIPT, result[i].REMARKS, result[i].debit_f, result[i].credit_f, link]);

                    }
                    $('#tabel_detail_caba').DataTable({
                        //"bJQueryUI"     : true,
                        data: data,
                        deferRender: true,
                        processing: true,
                        ordering: true,
                        retrieve: false,
                        paging: true,
                        deferLoading: 57,
                        bDestroy: true,
                        autoWidth: false,
                        bFilter: true,
                        iDisplayLength: 10,
                        //responsive: true,
                        language: {
                            searchPlaceholder: 'Cari',
                            sSearch: '',
                            lengthMenu: '_MENU_',
                        },
                    });

                },
                beforeSend: function() {
                    loadingPannel.show();
                },
                complete: function() {
                    loadingPannel.hide();
                    $('#tabel_detail_caba').show();
                }
            });

        }
        table_caba_detail();


        hapus_vouc_tmp = function(id_vouc, voucno) {

            swal({
                    title: "Hapus Data yang dipilih ?",
                    text: "Jika ingin dihapus, silahkan klik tombol Hapus",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false
                },
                function() {

                    $.ajax({
                        url: base_url + 'cash_bank/hapus_vouc_tmp_detail_edit',
                        type: "post",
                        data: {
                            id_vouc: id_vouc,
                            voucno: voucno,
                            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        dataType: "json",
                        async: 'false',
                        success: function(result) {

                            if (result == true) {
                                swal("Deleted!", "Data berhasil dihapus!", "success");
                                table_caba_detail();
                                get_balance();
                            } else {

                            }

                        },
                        beforeSend: function() {
                            //loadingPannel.show();
                        },
                        complete: function() {
                            //loadingPannel.hide();
                            //$('#tabel_detail_caba').show();
                        }
                    });
                });

        }


        edit_vouc_tmp = function(id_vouc, voucno) {

            // console.table({
            //     id: id_vouc,
            //     voucno: voucno
            // });

            $("#idvouc_details").val(id_vouc);

            $("#btn_update_detail").show();
            $("#btn_simpan_detail").hide();

            // ('#btn_simpan_detail').attr('disabled', true);
            $('#header_voucher,#voucher_detail').find('input,textarea,select').removeAttr('readonly');



            $.ajax({
                url: base_url + 'cash_bank/get_vouc_tmp_detail_edit2',
                type: "post",
                data: {
                    id_vouc: id_vouc,
                    voucno: voucno,
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                async: 'false',
                success: function(result) {
                    console.log(result);
                    $("#acct").val(result.ACCTNO);
                    $("#acct_nama").val(result.DESCRIPT);
                    $("#transaksi_remark").val(result.REMARKS);
                    $("#debet").val(result.debit_f);
                    $("#kredit").val(result.credit_f);
                    $("#kredit").val(result.credit_f);
                    $("#divisi_v").val(result.KODE_PT);

                },
                beforeSend: function() {
                    loadingPannel.show();
                },
                complete: function() {
                    loadingPannel.hide();
                }
            });

        }


        //fungsi untuk update detail - belum selesai
        $("#btn_update_detail").click(function() {
            update_detail_vouc();
        });


        update_detail_vouc = function() {

            $.ajax({
                url: base_url + 'cash_bank/update_vouc_tmp_detail',
                type: "post",
                data: {
                    acctno: $("#acct").val(),
                    acctnama: $("#acct_nama").val(),
                    remark: $("#transaksi_remark").val(),
                    debet: $("#debet").val(),
                    kredit: $("#kredit").val(),
                    idvoucher: $("#idvouc_details").val(),
                    divisi: $("#divisi_v").val(),
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                async: 'false',
                success: function(result) {

                    if (result == true) {
                        swal.close();
                        Command: toastr["success"]("Transaksi Voucher detail berhasil diupdate", "Berhasil");
                        $('#divisi_v').val(0);
                        $('.clears').val('');
                        table_caba_detail();
                        get_balance();
                        $("#btn_update_detail").hide();
                        $("#btn_simpan_detail").show();
                    } else {
                        Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                    }

                },
                beforeSend: function() {
                    loadingPannel.show();
                },
                complete: function() {
                    loadingPannel.hide();
                }
            });

        }

        $('#btn_hapus').click(function() {
            swal({
                    title: "Apakah Anda Yakin ?",
                    text: "Jika ingin dilanjutkan, silahkan klik button delete",
                    type: "info",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Delete",
                    confirmButtonColor: "crimson"
                },
                function() {

                    $.ajax({
                        url: base_url + 'cash_bank/delete_vocher_tmp',
                        type: "POST",
                        dataType: 'json',
                        mimeType: 'multipart/form-data',
                        data: {},
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            swal.close();
                            Command: toastr["success"]("Transaksi Voucher detail berhasil dihapus", "Berhasil");
                            getcontents('cash_bank/input_voucher', '<?php echo $this->session->userdata('sess_token'); ?>');

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
                        }

                    });
                });

        });


        $("#btn_simpan").click(function() {

            var str = $("#balance").text()
            var res = str.replace("Rp. ", "");

            if (res < 0 || res != 0 || res == '' || $("#tot_cred").val() != $("#tot_debt").val()) {
                Command: toastr["error"]("Maaf, Data update belum tersimpan, silahkan periksa jumlah pastikan tidak kosong dan jumlah kredit dan debit harus sesuai, ketidaksamaan jumlah, maka tidak akan bisa disimpan !", "Tidak dapat disimpan !");
            }
            else {

                //alertify.confirm('<i class="fa fa-question-circle"></i> <span style="font-weight:bold">Konfirmasi Simpan Voucher</span>', 'Jika ingin disimpan, silahkan klik button simpan', function(){
                //alertify.success('Ok') 

                var form_data = new FormData($('#form_input_transaksi')[0]);

                $.ajax({
                    url: base_url + 'cash_bank/simpan_voucher_header',
                    type: "POST",
                    dataType: 'json',
                    mimeType: 'multipart/form-data',
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        var coa = response.head;
                        var jml = response.jml;
                        var py = response.pay;

                        if (response.status == true) {
                            swal.close();
                            Command: toastr["success"]("Transaksi Voucher detail berhasil disimpan", "Berhasil");
                            $('#divisi_v').val(0);
                            $('.clears').val('');
                            table_caba_detail();
                            saldo_akhir(coa, jml, py);
                            getcontents('cash_bank/input_voucher', '<?php echo $this->session->userdata('sess_token'); ?>');

                        } else {
                            Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
                    },
                    beforeSend: function() {
                        loadingPannel.show();
                    },
                    complete: function() {
                        loadingPannel.hide();
                    }

                });

            }

            //},function(){ 
            //alertify.error('Cancel')
            //}).set('labels', {ok:'Simpan', cancel:'Batal'});;

        });

        /* untuk update saldo akhir */
        update_saldo_akhir = function(coa) {

            $.ajax({
                url: base_url + 'cash_bank/update_saldo_akhir',
                type: "post",
                data: {
                    coa: coa,
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                async: 'false',
                success: function(result) {

                    console.log(result);

                },
                beforeSend: function() {
                    //loadingPannel.show();
                },
                complete: function() {
                    //loadingPannel.hide();
                }
            });

        }
        /* end untuk update saldo akhir */


        //ini fungsi angka contoh : 5000000 menjadi 5,000,000
        numberWithCommas = function(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }


        get_balance = function() {

            $.ajax({
                url: base_url + 'cash_bank/get_balance_edit2',
                type: "post",
                data: {

                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                async: 'false',
                success: function(result) {

                    var myStr = $("#jumlah").val();
                    var newStr = myStr.replace(/,/g, '');


                    var pengurangan = parseInt(result.tot_debit) - parseInt(result.tot_credit);

                    //var pengurangan = parseInt(result.tot_credit) - parseInt(newStr);  //parseInt(result.tot_debit) - 
                    $("#tot_cred").val(result.tot_credit);
                    $("#tot_debt").val(result.tot_debit);
                    $("#tot_sum").val(numberWithCommas('Rp. ' + pengurangan));
                    $("#tot_sum_noformat").val(pengurangan);

                    //ini untuk teks
                    $("#tot_text_db").text(numberWithCommas('Rp. ' + result.tot_debit));
                    $("#tot_text_cr").text(numberWithCommas('Rp. ' + result.tot_credit));

                    //ini untuk teks balance
                    $("#balance").text(numberWithCommas('Rp. ' + pengurangan));


                    $('#btn_simpan_detail').attr('disabled', true);
                    $('#header_voucher,#voucher_detail').find('input,textarea,select').attr('readonly', true);


                },
                beforeSend: function() {
                    //loadingPannel.show();
                },
                complete: function() {
                    //loadingPannel.hide();
                    //$('#tabel_detail_caba').show();
                }
            });

        }
        get_balance();



        simpan_voucher_details = function() {



            if ($("#acct").val() == '') {
                Command: toastr["warning"]("Silahkan masukan nomor account !", "Opps !");
                $("#acct").focus();
            }

            else if ($("#sumber_dana_nominal").val() == '') {
                Command: toastr["warning"]("No. PDDO tidak boleh kosong !", "Opps !");
                $("#sumber_dana_nominal").focus();
            }

            else if ($("#transaksi_remark").val() == 0) {
                Command: toastr["warning"]("Silahkan isi pada kolom transaksi !", "Opps !");
                $("#transaksi_remark").focus();
            }
            else if ($("#tanggal").val() == 0) {
                Command: toastr["warning"]("Pastikan isi Tanggal !", "Opps !");
                $("#tanggal").focus();
            }
            else if ($("#jumlah").val() == '') {
                Command: toastr["warning"]("Silahkan masukan angka pada kolom jumlah !", "Opps !");
                $("#jumlah").focus();
            }
            else if ($("#kredit").val() != '' && $("#debet").val() != '') {
                Command: toastr["warning"]("Kolom Kredit dan Debet tidak boleh terisi semua !", "Opps !");
                $("#kredit").focus();
                $("#debet").focus();
            }
            else if ($("#terbilang").val() == '') {
                Command: toastr["warning"]("Silahkan lakukans enter di kolom jumlah !", "Opps !");
                $("#jumlah").focus();
            }
            else {

                var form_data = new FormData($('#form_input_transaksi')[0]);

                $.ajax({
                    url: base_url + 'cash_bank/simpan_voucher_detail2',
                    type: "POST",
                    dataType: 'json',
                    mimeType: 'multipart/form-data',
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response == true) {
                            swal.close();
                            Command: toastr["success"]("Transaksi Voucher detail berhasil disimpan", "Berhasil");
                            $('#divisi_v').val(0);
                            $('.clears').val('');
                            table_caba_detail();
                            get_balance();

                        } else {
                            Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
                    }

                });

                //},function(){ 
                //alertify.error('Cancel')
                //}).set('labels', {ok:'Simpan', cancel:'Batal'});;


            }

        }

        simpan_voucher_details_by_po = function() {

            var form_data = new FormData($('#form_input_transaksi')[0]);

            $.ajax({
                url: base_url + 'cash_bank/simpan_voucher_detail_by_po_edit',
                type: "POST",
                dataType: 'json',
                mimeType: 'multipart/form-data',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response == true) {
                        swal.close();
                        Command: toastr["success"]("Transaksi Voucher detail berhasil disimpan", "Berhasil");
                        $('#divisi_v').val(0);
                        $('.clears2').val('');
                        table_caba_detail();
                        get_balance();

                    } else {
                        Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
                }

            });

        }

        set_jumlah_tot = function() {
            var vals = $("#tot_debt").val();
            $("#jumlah").val(numberWithCommas(vals));
            buttonCode(vals);
            $("#balance").text(numberWithCommas('Rp. ' + vals));
        }


        $("#btn_back").click(function() {

            if ($("#tot_cred").val() != $("#tot_debt").val()) {
                Command: toastr["error"]("Oppss Nominal CR dan DR tidak sama.. !, Silahkan periksan kembali nominal CR dan DB", "Error");
            }
            else {
                getcontents('cash_bank/input_voucher', '<?php echo $this->session->userdata('sess_token'); ?>');
            }


        });



    });
</script>

<style type="text/css">
    .tables_nowrap {
        /*white-space: nowrap;*/
    }

    table#tabel_detail_caba td {
        padding: 3px;
        padding-left: 10px;
        font-size: 11px;
    }
</style>



<form id="form_input_transaksi" method=POST enctype='multipart/form-data'>
    <!-- <input type="text" name="" id="" value="<?= $this->session->userdata('sess_id') ?>"> -->
    <!-- <input type="hidden" name="kode_sementara" id="kode_sementara" value="<?php echo $token; ?>"> -->
    <input type="hidden" name="kode_sementara" id="kode_sementara" value="<?php echo $get_vocher_tmp; ?>">
    <input type="hidden" name="lokasi_users" id="lokasi_users" value="<?php echo $lokasi['nama']; ?>">
    <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">


    <!-- penampung total cr dan db -->
    <!--tot_DB -->
    <input type="hidden" name="tot_debt" id="tot_debt" class="tot_debit">
    <!--tot_CR -->
    <input type="hidden" name="tot_cred" id="tot_cred">
    <!--tot_SUM -->
    <input type="hidden" name="tot_sum" id="tot_sum">
    <input type="hidden" name="tot_sum_noformat" id="tot_sum_noformat">

    <input type="hidden" name="debet_by_po" id="debet_by_po">


    <input type="hidden" name="supplier_acct" id="supplier_acct">
    <input type="hidden" name="supplier_nama" id="supplier_nama">
    <input type="hidden" name="kodept" id="kodept">



    <nav>
        <div id="jCrumbs" class="breadCrumb module">
            <ul>
                <li>
                    <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token'); ?>')"><i class="icon-home"></i></a>
                </li>
                <li>
                    <a href="#">Cash Bank</a>
                </li>
                <li>
                    <a href="#">Lanjutkan Input Voucher</a>
                </li>
            </ul>
        </div>
    </nav>





    <div class="row-fluid" id="input_vou">
        <div class="span6">

            <div class="tabbable tabbable-bordered" id="header_voucher">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="javascript:void(0)" data-toggle="tab" style="color:#870505;"><b>Input Voucher Header</b></a></li>
                </ul>
                <div class="tab-content" style="padding-left:10px;padding-right:10px;padding-bottom:10px;padding-top:0px;">
                    <div class="tab-pane active" id="tab_br1">
                        <p>
                        <div>

                            <div class="span12">

                                <div class="span3">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Pay/Rec</label>
                                        <select class="form-control span17" name="pay_rec" id="pay_rec">
                                            <option value="0">-Pilih-</option>
                                            <option value="Payment">Payment</option>
                                            <option value="Receive">Receive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Kas/Bank</label>
                                        <select class="form-control span17" name="kas_bank" id="kas_bank">
                                            <option value="0">-Pilih-</option>
                                            <option value="Kas">Kas</option>
                                            <option value="Bank">Bank</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Bank</label>
                                        <select class="form-control span17" name="bank_descript" id="bank_descript">
                                            <option value="0">-Pilih-</option>
                                            <!--<option value="MANDIRI RUPIAH">MANDIRI RUPIAH</option>
                                      <option value="BANK BRI">BANK BRI</option>
                                      <option value="BRI AGRO">BRI AGRO</option>
                                      <option value="MANDIRI S.PARMAN">MANDIRI S.PARMAN</option>-->
                                        </select>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Tanggal</label>
                                        <div class="input-prepend">
                                            <input type="text" size="20" class="span9 fc-datepicker1" id="tanggal" name="tanggal"><span class="add-on" id="datepicker_pointer" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div>

                                <div class="span6">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Kepada / Dari</label>
                                        <input type="text" class="form-control teksbesar span17" name="kepada" id="kepada">
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Ref PP</label>
                                        <select class="form-control span17" name="noref_select" id="noref_select">
                                            <option value="0">-Pilih-</option>
                                            <option value="PP_PO">PP/PO</option>
                                            <option value="PP_PK">PP/PK</option>
                                            <option value="PP_BUDGET">PP/Budget</option>
                                            <option value="-">-</option>
                                            <!--<option value="PP_PK">PP/PK</option><option value="PP_BUDGET">PP/Budget</option>-->
                                        </select>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Nomor Ref</label>
                                        <input type="text" class="form-control span17" name="no_ref" id="no_ref" placeholder="Enter jika pilih PP">
                                        <input type="hidden" class="form-control span17 clears2" name="ref_po" id="ref_po">
                                    </div>
                                </div>

                            </div>


                            <div>
                                <div class="span3">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Jumlah</label>
                                        <input type="text" class="form-control maskmoney_money span17" name="jumlah" id="jumlah">
                                    </div>
                                </div>

                                <div class="span9">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Terbilang</label>
                                        <input type="text" class="form-control span25" readonly="" name="terbilang" id="terbilang">
                                    </div>
                                </div>

                            </div>

                            <div>

                                <div class="span2">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Bank</label>
                                        <input type="text" class="form-control teksbesar span17" name="bank_nama" id="bank_nama">
                                    </div>
                                </div>

                                <div class="span2">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Nomor</label>
                                        <input type="text" class="form-control teksbesar span17" name="bank_no" id="bank_no">
                                    </div>
                                </div>

                                <div class="span3" style="padding-right: 0px">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Tanggal</label>
                                        <div class="input-prepend">
                                            <input type="text" size="20" class="span8 fc-datepicker2" id="bank_tanggal" name="bank_tanggal"><span class="add-on" id="datepicker_pointer2"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                //sumber dana tidak akan muncul session lokasiny HO
                                if ($this->session->userdata('sess_nama_lokasi') != 'HO') {
                                ?>

                                    <div class="span3">
                                        <div class="form-group">
                                            <label for="demo-vs-definput" class="control-label">Sumber Dana</label>
                                            <select class="form-control span17" name="sumber_dana" id="sumber_dana">
                                                <!-- <option value="0">-Pilih-</option> -->
                                                <option value="PDO Gaji|1">PDO Gaji</option>
                                                <option value="PDDO IM|2">PDDO IM</option>
                                                <option value="PDDO GRTT|3">PDDO GRTT</option>
                                                <option value="PDO Remise Kas|4">PDO Remise Kas</option>
                                                <option value="Dana Kontanan|5">Dana Kontanan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="span2">
                                        <div class="form-group">
                                            <label for="demo-vs-definput" class="control-label" style="color:white">x</label>
                                            <input type="text" class="form-control span50" name="sumber_dana_nominal" id="sumber_dana_nominal">
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>



                        </div>
                    </div>
                </div>
            </div>



            <div class="row-fluid" style="padding-top: 10px">
            </div>

            <div class="tabbable tabbable-bordered" id="voucher_detail">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="javascript:void(0)" data-toggle="tab" style="color:#870505;"><b>Input Voucher Detail</b></a></li>
                </ul>
                <div class="tab-content" style="padding-left:10px;padding-right:10px;padding-bottom:10px;padding-top:0px;">
                    <div class="tab-pane active" id="tab_br1">
                        <p>
                        <div>

                            <div class="span2">
                                <div class="form-group">
                                    <label for="demo-vs-definput" class="control-label">Divisi</label>

                                    <?php
                                    //ini divisa jika login session HO
                                    if ($this->session->userdata('sess_id_lokasi') != 1) {
                                    ?>

                                        <?php if ($this->session->userdata('sess_id_lokasi') == 3) { ?>

                                            <select class="form-control span17" name="divisi_v" id="divisi_v">
                                                <option value="03">03</option>
                                            </select>
                                        <?php } else { ?>
                                            <select class="form-control span17" name="divisi_v" id="divisi_v">
                                                <option value="0">-Pilih-</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                            </select>
                                        <?php } ?>
                                    <?php  } else {
                                    ?>

                                        <select class="form-control span17" name="divisi_v" id="divisi_v">
                                            <option value="0">-Pilih-</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                        </select>

                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="span4">
                                <div class="form-group">
                                    <label for="demo-vs-definput" class="control-label">Acct</label>
                                    <input type="text" class="form-control clears span17" placeholder="Enter disini..." id="acct" name="acct">
                                    <input type="hidden" class="form-control clears span17 clears2" id="idvouc_details" name="idvouc_details">
                                </div>
                            </div>

                            <div class="span6">
                                <div class="form-group">
                                    <label for="demo-vs-definput" class="control-label">Nama Acct</label>
                                    <div class="input-prepend">
                                        <input type="text" class="form-control clears span17 clears2" name="acct_nama" id="acct_nama" readonly="">

                                    </div>
                                </div>
                            </div>

                        </div>



                        <div class="row-fluid">
                            <div class="span12">

                                <div class="span6">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Transaksi</label>
                                        <input type="text" class="form-control teksbesar clears span17" id="transaksi_remark" name="transaksi_remark">
                                    </div>
                                </div>

                                <div class="span2">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Kredit</label>
                                        <input type="text" class="form-control maskmoney_money clears span17 clears2" id="kredit" name="kredit">
                                    </div>
                                </div>

                                <div class="span2">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Debit</label>
                                        <div class="input-prepend">
                                            <input type="text" class="form-control maskmoney_money clears span17 clears2" name="debet" id="debet">

                                        </div>
                                    </div>
                                </div>

                                <div class="span2">
                                    <div class="form-group">
                                        <div style="margin-top: 22px"></div>
                                        <div class="input-prepend">
                                            <button type="button" class="btn btn-info" id="btn_simpan_detail"><i class="splashy-check"></i> Simpan</button>
                                            <button type="button" class="btn btn-danger" id="btn_update_detail" style="display:none"><i class="splashy-refresh"></i> Update</button>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <style type="text/css">
            .tables_nowrap {
                /*white-space: nowrap;*/
            }

            table#tabel_detail_caba td {
                padding: 3px;
                padding-left: 10px;
                font-size: 12px;
            }
        </style>

        <div class="span6">
            <h3 class="heading pull-left">Table Voucher Detail</h3>
            <h3 class="heading pull-right"><span style="font-weight: bold;color:red" id="balance"></span></h3>

            <div class="row-fluid">
                <div class="span12">

                    <table id="tabel_detail_caba" class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <!-- <th style="font-size: 11px; padding:10px">SBU</th> -->
                                <th style="font-size: 11px; padding:10px">Acct</th>
                                <th style="font-size: 11px; padding:10px">Nama Account</th>
                                <th style="font-size: 11px; padding:10px">Keterangan</th>
                                <th style="font-size: 11px; padding:10px">Debit</th>
                                <th style="font-size: 11px; padding:10px">Kredit</th>
                                <th style="font-size: 11px; padding:10px;width: 15%">Link</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>

            <!-- footer -->
            <div class="row-fluid">
                <div class="span12">

                    <span class="label label-success" style="margin-right:3px;background:#f74a25">TOTAL DB : <span id="tot_text_db"></span></span>
                    <span class="label label-info">TOTAL CR : <span id="tot_text_cr"></span></span>



                    <div class="formSep">

                    </div>
                    <button type="button" class="btn btn-danger" id="btn_hapus"><i class="splashy-remove"></i> Hapus semua transaksi </button>
                    <button type="button" class="btn btn-primary pull-right" id="btn_simpan"><i class="splashy-check"></i> Simpan </button>

                </div>
            </div>
            <!-- footer -->

        </div>





    </div>

</form>