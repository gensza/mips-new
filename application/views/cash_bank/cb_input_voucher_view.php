<script type="text/javascript">
  window.onbeforeunload = function() {
    // return "Apakah anda akan meninggalkan halaman ini ?";
    alert("Apakah anda akan meninggalkan halaman ini ?");
  };

  $(document).ready(function() {

    var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';
    var lokasi_usr = '<?php echo $this->session->userdata('sess_nama_lokasi'); ?>';

    $('.maskmoney_money').maskMoney({
      thousands: ',',
      decimal: '.',
      precision: 0,
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

    /* select bank */
    select_bank = function() {

      var payrc = $("#pay_rec").val();

      //1 : HO
      //2 : ESTATE
      //3 : RO

      if (lokasi_usr == 'HO') { // INI HO


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


      } else if (lokasi_usr == 'ESTATE') { // INI ESTATE


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
              //var strr_1 = data.NOACC_RECBANK1;
              str1 = str1.replace(/\s+/g, '_');

              var str2 = data.rec_namabank2;
              //var strr_2 = data.NOACC_RECBANK1;
              str2 = str2.replace(/\s+/g, '_');

              $('#bank_descript').empty();
              var $kategori = $('#bank_descript');
              $kategori.append('<option value=0>-Pilih Bank-</option>');
              $kategori.append('<option value=' + str1 + '|1>' + data.rec_namabank1 + '</option>');
              $kategori.append('<option value=' + str2 + '|2>' + data.rec_namabank2 + '</option>');
            }
          });

        }

      } else if (lokasi_usr == 'RO') {

      } else {

      }



    }
    //select_bank();
    /* select grup */

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
      precision: 0,
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

        if ($("#acct").val() == '') {
          getpopup('gl/master_tabel_coa_popup', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', '1');
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

          if ($("#pay_rec").val() == 0) {
            Command: toastr["warning"]("Silahkan Pilih Payment atau Receive !", "Opps !");
            $("#pay_rec").focus();
          }
          else if ($("#kas_bank").val() == 0) {
            Command: toastr["warning"]("Silahkan Pilih Kas atau Bank !", "Opps !");
            $("#kas_bank").focus();
          }
          else if ($("#tanggal").val() == 0) {
            Command: toastr["warning"]("Silahkan isi Tanggal !", "Opps !");
            $("#tanggal").focus();
          }
          else {

            getpopup('cash_bank/tabel_pp_logistik', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', '1');

          }

        }







      }
    });


    document.getElementById("kredit").addEventListener("keyup", function(event) {
      event.preventDefault();
      if (event.keyCode === 13) {
        if ($("#idvouc_details").val() == '') {
          simpan_voucher_details();
        } else {
          update_voucher_details();
        }

      }
    });


    document.getElementById("debet").addEventListener("keyup", function(event) {
      event.preventDefault();
      if (event.keyCode === 13) {
        if ($("#idvouc_details").val() == '') {
          simpan_voucher_details();
        } else {
          update_voucher_details();
        }
      }
    });



    $("#acct_icon").click(function() {
      getpopup('gl/gl_mastercode_popup', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', '1');
    });


    $("#btn_simpan_detail").click(function() {

      simpan_voucher_details();

    });

    loading();

    table_caba_detail = function() {

      $.ajax({
        url: base_url + 'cash_bank/data_list_voucher_detail',
        type: "post",
        data: {
          kode_sementara: $("#kode_sementara").val(),
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        async: 'false',
        success: function(result) {
          var data = [];
          for (var i = 0; i < result.length; i++) {

            //var edit = '<a href="javascript:void(0)" onclick=edit_vouc_tmp('+result[i].id_vouc_tmp+')><i class="splashy-pencil"></i></a> <a href="javascript:void(0)" onclick=hapus_vouc_tmp('+result[i].id_vouc_tmp+')><i class="splashy-gem_remove"></i></a>';
            //var hapus = '<a href="javascript:void(0)" onclick=hapus_vouc_tmp('+result[i].id_vouc_tmp+')><i class="splashy-gem_remove"></i></a>';

            var link = "<a href='javascript:void(0)' onclick=\"edit_vouc_tmp(" + result[i].id_vouc_tmp + ",'" + result[i].VOUCNO + "');\" title='Edit'><i class='splashy-document_letter_edit'></i></a> <a href='javascript:void(0)' onclick=\"hapus_vouc_tmp(" + result[i].id_vouc_tmp + ",'" + result[i].VOUCNO + "');\" title='Hapus'><i class='splashy-document_a4_remove'></i></div></a>";


            data.push([result[i].KODE_PT, result[i].ACCTNO, result[i].DESCRIPT, result[i].REMARKS, result[i].debit_f, result[i].credit_f, link]);

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

    hapus_vouc_tmp = function(id_vouc_tmp, voucno) {

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
            url: base_url + 'cash_bank/hapus_vouc_tmp_detail',
            type: "post",
            data: {
              id_vouc_tmp: id_vouc_tmp,
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


    edit_vouc_tmp = function(id_vouc_tmp, voucno) {

      $("#idvouc_details").val(id_vouc_tmp);

      $("#btn_update_detail").show();
      $("#btn_simpan_detail").hide();


      $.ajax({
        url: base_url + 'cash_bank/get_vouc_tmp_detail',
        type: "post",
        data: {
          id_vouc_tmp: id_vouc_tmp,
          voucno: voucno,
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        async: 'false',
        success: function(result) {

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
      update_voucher_details();
    });


    $("#btn_simpan").click(function() {

      var str = $("#balance").text()
      var res = str.replace("Rp. ", "");


      if (res < 0 || res != 0 || res == '' || $("#tot_cred").val() != $("#tot_debt").val()) {
        Command: toastr["error"]("Maaf, inputan belum tersimpan, silahkan periksa jumlah pastikan tidak kosong dan jumlah kredit dan debit harus sesuai, ketidaksamaan jumlah, maka tidak akan bisa disimpan !", "Tidak dapat disimpan !");
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

            if (response == true) {
              swal.close();
              Command: toastr["success"]("Transaksi Voucher detail berhasil disimpan", "Berhasil");
              $('#divisi_v').val(0);
              $('.clears').val('');
              table_caba_detail();
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


    //ini fungsi angka contoh : 5000000 menjadi 5,000,000
    numberWithCommas = function(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    get_balance = function() {

      $.ajax({
        url: base_url + 'cash_bank/get_balance',
        type: "post",
        data: {
          kode_sementara: $("#kode_sementara").val(),
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        async: 'false',
        success: function(result) {

          var myStr = $("#jumlah").val();
          var newStr = myStr.replace(/,/g, '');

          var totf = result.total_f;
          var totd = result.tot_debit;

          if (result == '') {
            $("#balance").text('Rp. ' + myStr);
          } else {

            var pengurangan = parseInt(newStr) - parseInt(result.tot_credit); //parseInt(result.tot_debit) - 

            $("#tot_cred").val(result.tot_credit);
            $("#tot_debt").val(result.tot_debit);
            $("#tot_sum").val(numberWithCommas('Rp. ' + pengurangan));
            $("#tot_sum_noformat").val(pengurangan);

            //ini untuk teks
            $("#tot_text_db").text(numberWithCommas('Rp. ' + result.tot_debit));
            $("#tot_text_cr").text(numberWithCommas('Rp. ' + result.tot_credit));

            //ini untuk teks balance
            $("#balance").text(numberWithCommas('Rp. ' + pengurangan));



            //aslinya
            //var pengurangan = parseInt(newStr) - parseInt(result.Total);
            //var pengurangan = parseInt(newStr) - parseInt(result.tot_credit); 
            //$("#balance").text(numberWithCommas('Rp. '+result.total_detail_trans2));
            /*if(result.tot_debit == result.tot_credit){
                $("#balance").text(0);
            }else{
                $("#balance").text(numberWithCommas(pengurangan));
            }*/

            //if(isNaN(pengurangan) === true){
            //  $("#balance").val(0);
            //}else{
            //  $("#balance").val(numberWithCommas(pengurangan));
            //}
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
      else if ($("#divisi_v").val() == 0) {
        Command: toastr["warning"]("Silahkan pilih divisi !", "Opps !");
        $("#divisi_v").focus();
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

        //alertify.confirm('<i class="fa fa-question-circle"></i> <span style="font-weight:bold">Konfirmasi Simpan Voucher</span>', 'Jika ingin disimpan, silahkan klik button simpan', function(){
        //alertify.success('Ok') 

        var form_data = new FormData($('#form_input_transaksi')[0]);

        $.ajax({
          url: base_url + 'cash_bank/simpan_voucher_detail',
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


    update_voucher_details = function() {
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



    $("#btn_history").click(function() {
      getpopup('cash_bank/history', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', '1');
    });


    $("#pay_rec").change(function() {
      $("#kas_bank").val(0);
      $("#bank_descript").val(0);
    });

    $("#btn_reset").click(function() {
      getcontents('cash_bank/input_voucher', '<?php echo $this->session->userdata('sess_token'); ?>');
    });




    get_acct_supplier = function(kode_supplier) {

      $.ajax({
        url: base_url + 'cash_bank/get_detail_supplier',
        type: "post",
        data: {
          kode_supplier: kode_supplier,
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        async: 'false',
        success: function(result) {


          if (result.account == '' || result.account == null) {

            Command: toastr["error"]("Silahkan cek pada Data Master Supplier.", "Account Supplier Tidak Tersedia !");

          }
          else {
            $("#supplier_acct").val(result.account);
            $("#supplier_nama").val(result.nama_account);

            simpan_voucher_details_by_po();
            $("#debet_by_po").val('');
          }



        },
        beforeSend: function() {
          //loadingPannel.show();
        },
        complete: function() {
          //loadingPannel.hide();
        }
      });

    }


    simpan_voucher_details_by_po = function() {

      var form_data = new FormData($('#form_input_transaksi')[0]);

      $.ajax({
        url: base_url + 'cash_bank/simpan_voucher_detail_by_po',
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

    window.onbeforeunload = function() {
      if (data_needs_saving()) {
        return "Do you really want to leave our brilliant application?";
      } else {
        return;
      }
    };


  });
</script>

<?php
//ini kode random untuk token
$token = "";
$codeAlphabet = "8795225885";
$codeAlphabet .= "6399812567";
$codeAlphabet .= "0123456789";

$max = strlen($codeAlphabet) - 1;
for ($i = 0; $i < 6; $i++) {
  $token .= $codeAlphabet[mt_rand(0, $max)];
}
//ini kode random untuk token
?>


<form id="form_input_transaksi" method=POST enctype='multipart/form-data'>
  <input type="hidden" name="kode_sementara" id="kode_sementara" value="<?php echo $token; ?>">
  <input type="hidden" name="kode_sementara" id="kode_sementara" value="<?php echo $token; ?>">
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
          <a href="#">Input Voucher</a>
        </li>
      </ul>
    </div>
  </nav>


  <div class="row-fluid">
    <div class="span6">

      <div class="tabbable tabbable-bordered">
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
                    <input type="text" class="form-control span17" name="no_ref" id="no_ref">
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

      <div class="tabbable tabbable-bordered">
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

                    <select class="form-control span17" name="divisi_v" id="divisi_v">
                      <option value="0">-Pilih-</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                    </select>
                  <?php
                  } else {
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
                  <input type="text" class="form-control clears span17" id="acct" name="acct">
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
        <div class="span12" style="overflow-y: auto; height:350px; ">

          <table id="tabel_detail_caba" class="tables_nowrap table table-hover table-striped table-bordered" style="width: 100%">
            <thead>
              <tr>
                <th style="font-size: 12px; padding:10px">SBU</th>
                <th style="font-size: 12px; padding:10px">Acct</th>
                <th style="font-size: 12px; padding:10px">Nama Account</th>
                <th style="font-size: 12px; padding:10px">Keterangan</th>
                <th style="font-size: 12px; padding:10px">Debit</th>
                <th style="font-size: 12px; padding:10px">Kredit</th>
                <th style="font-size: 12px; padding:10px;width: 15%">Link</th>
              </tr>
            </thead>
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
          <button type="button" class="btn btn-warning" id="btn_history"><i class="splashy-zoom"></i> Lihat History Voucher </button>
          <button type="button" class="btn btn-default" id="btn_reset"><i class="splashy-refresh"></i> Reset </button>
          <button type="button" class="btn btn-danger pull-right" id="btn_simpan"><i class="splashy-check"></i> Simpan </button>

        </div>
      </div>
      <!-- footer -->

    </div>





  </div>

</form>