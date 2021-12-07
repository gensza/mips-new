<script type="text/javascript">
  $(document).ready(function() {

    var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';
    $("#no_ref").focus();
    loading();

    $("#btn_simpan_trans_detail").click(function() {

      //ini cek dulu , dia rupiah apa dollar, kalo dollar ada validasi cek kurs hari ini tersedia atau belum, kalo belum , update kurs dulu hari ini
      if ($("#dc_kurs").val() == '$') {
        var todays = new Date();
        var tglhariini = moment(todays).format('YYYY-MM-DD');

        $.ajax({
          url: base_url + 'gl/cek_kurs_rate',
          type: "post",
          data: {
            tglhariini: tglhariini,
            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          dataType: "json",
          async: 'false',
          success: function(result) {
            if (result.kurs == 0) {
              Command: toastr["error"]("Kurs hari ini belum tersedia, silahkan update terlebih dahulu, dikolom kurs !", "Kurs Hari ini Belum Tersedia !");
              $("#kurs_nominal").focus();
            }
            else {

              if ($("#no_ref").val() == '') {
                Command: toastr["error"]("Silahkan masukan nomor ref !", "Info, Ada kolom yang masih kosong !");
                $("#no_ref").focus();
              }
              else if ($("#tanggal").val() == '') {
                Command: toastr["error"]("Silahkan masukan tanggal !", "Info, Ada kolom yang masih kosong !");
                $("#tanggal").focus();
              }
              else if ($("#acctno").val() == '') {
                Command: toastr["error"]("Silahkan masukan no acc !", "Info, Ada kolom yang masih kosong !");
                $("#acctno").focus();
              }
              else if ($("#deskripsi").val() == '') {
                Command: toastr["error"]("Silahkan isi deskripsi !", "Info, Ada kolom yang masih kosong !");
                $("#deskripsi").focus();
              }
              else if ($("#dc").val() == 0) {
                Command: toastr["error"]("Silahkan pilih DC !", "Info, Ada kolom yang masih kosong !");
                $("#dc").focus();
              }
              else if ($("#dc_kurs").val() == 0) {
                Command: toastr["error"]("Silahkan pilih Kurs !", "Info, Ada kolom yang masih kosong !");
                $("#dc_kurs").focus();
              }
              else {

                var form_data = new FormData($('#form_input_transaksi')[0]);

                $.ajax({
                  url: base_url + 'gl/transaksi_simpan_dollar',
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
                      Command: toastr["success"]("Transaksi GL detail berhasil disimpan", "Berhasil");

                      tabel_gl_transaksi_detail();

                      $('.reset').val(0);
                      $('.clears').val('');
                      document.getElementById('no_ref').readOnly = true;
                      document.getElementById('tanggal').readOnly = true;
                      total_credit();
                      total_debit();
                      //table_caba_detail();
                      //get_balance();

                    } else {
                      Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                    Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
                  }

                });
              }

            }
          },
          beforeSend: function() {

          },
          complete: function() {

          }
        });

      } else {


        if ($("#no_ref").val() == '') {
          Command: toastr["error"]("Silahkan masukan nomor ref !", "Info, Ada kolom yang masih kosong !");
          $("#no_ref").focus();
        }
        else if ($("#tanggal").val() == '') {
          Command: toastr["error"]("Silahkan masukan tanggal !", "Info, Ada kolom yang masih kosong !");
          $("#tanggal").focus();
        }
        else if ($("#acctno").val() == '') {
          Command: toastr["error"]("Silahkan masukan no acc !", "Info, Ada kolom yang masih kosong !");
          $("#acctno").focus();
        }
        else if ($("#deskripsi").val() == '') {
          Command: toastr["error"]("Silahkan isi deskripsi !", "Info, Ada kolom yang masih kosong !");
          $("#deskripsi").focus();
        }
        else if ($("#dc").val() == 0) {
          Command: toastr["error"]("Silahkan pilih DC !", "Info, Ada kolom yang masih kosong !");
          $("#dc").focus();
        }
        else if ($("#dc_kurs").val() == 0) {
          Command: toastr["error"]("Silahkan pilih Kurs !", "Info, Ada kolom yang masih kosong !");
          $("#dc_kurs").focus();
        }
        else {

          var form_data = new FormData($('#form_input_transaksi')[0]);

          $.ajax({
            url: base_url + 'gl/transaksi_simpan',
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
                Command: toastr["success"]("Transaksi GL detail berhasil disimpan", "Berhasil");

                tabel_gl_transaksi_detail();

                $('.reset').val(0);
                $('.clears').val('');
                document.getElementById('no_ref').readOnly = true;
                document.getElementById('tanggal').readOnly = true;
                total_credit();
                total_debit();
                //table_caba_detail();
                //get_balance();

              } else {
                Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
            }

          });
        }


      }

    });




    $("#btn_update_trans_detail").click(function() {

      //ini cek dulu , dia rupiah apa dollar, kalo dollar ada validasi cek kurs hari ini tersedia atau belum, kalo belum , update kurs dulu hari ini
      if ($("#dc_kurs").val() == '$') {
        var todays = new Date();
        var tglhariini = moment(todays).format('YYYY-MM-DD');

        $.ajax({
          url: base_url + 'gl/cek_kurs_rate',
          type: "post",
          data: {
            tglhariini: tglhariini,
            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          dataType: "json",
          async: 'false',
          success: function(result) {
            if (result.kurs == 0) {
              Command: toastr["error"]("Kurs hari ini belum tersedia, silahkan update terlebih dahulu, dikolom kurs !", "Kurs Hari ini Belum Tersedia !");
              $("#kurs_nominal").focus();
            }
            else {

              if ($("#no_ref").val() == '') {
                Command: toastr["error"]("Silahkan masukan nomor ref !", "Info, Ada kolom yang masih kosong !");
                $("#no_ref").focus();
              }
              else if ($("#tanggal").val() == '') {
                Command: toastr["error"]("Silahkan masukan tanggal !", "Info, Ada kolom yang masih kosong !");
                $("#tanggal").focus();
              }
              else if ($("#acctno").val() == '') {
                Command: toastr["error"]("Silahkan masukan no acc !", "Info, Ada kolom yang masih kosong !");
                $("#acctno").focus();
              }
              else if ($("#deskripsi").val() == '') {
                Command: toastr["error"]("Silahkan isi deskripsi !", "Info, Ada kolom yang masih kosong !");
                $("#deskripsi").focus();
              }
              else if ($("#dc").val() == 0) {
                Command: toastr["error"]("Silahkan pilih DC !", "Info, Ada kolom yang masih kosong !");
                $("#dc").focus();
              }
              else if ($("#dc_kurs").val() == 0) {
                Command: toastr["error"]("Silahkan pilih Kurs !", "Info, Ada kolom yang masih kosong !");
                $("#dc_kurs").focus();
              }
              else {

                var form_data = new FormData($('#form_input_transaksi')[0]);

                $.ajax({
                  url: base_url + 'gl/transaksi_update_dollar',
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
                      Command: toastr["success"]("Transaksi GL detail berhasil disimpan", "Berhasil");

                      tabel_gl_transaksi_detail();

                      $('.reset').val(0);
                      $('.clears').val('');
                      document.getElementById('no_ref').readOnly = true;
                      document.getElementById('tanggal').readOnly = true;
                      total_credit();
                      total_debit();
                      //table_caba_detail();
                      //get_balance();

                      $("#btn_simpan_trans_detail").show();
                      $("#btn_update_trans_detail").hide();


                    } else {
                      Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                    Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
                  }

                });
              }

            }
          },
          beforeSend: function() {

          },
          complete: function() {

          }
        });

      } else {


        if ($("#no_ref").val() == '') {
          Command: toastr["error"]("Silahkan masukan nomor ref !", "Info, Ada kolom yang masih kosong !");
          $("#no_ref").focus();
        }
        else if ($("#tanggal").val() == '') {
          Command: toastr["error"]("Silahkan masukan tanggal !", "Info, Ada kolom yang masih kosong !");
          $("#tanggal").focus();
        }
        else if ($("#acctno").val() == '') {
          Command: toastr["error"]("Silahkan masukan no acc !", "Info, Ada kolom yang masih kosong !");
          $("#acctno").focus();
        }
        else if ($("#deskripsi").val() == '') {
          Command: toastr["error"]("Silahkan isi deskripsi !", "Info, Ada kolom yang masih kosong !");
          $("#deskripsi").focus();
        }
        else if ($("#dc").val() == 0) {
          Command: toastr["error"]("Silahkan pilih DC !", "Info, Ada kolom yang masih kosong !");
          $("#dc").focus();
        }
        else if ($("#dc_kurs").val() == 0) {
          Command: toastr["error"]("Silahkan pilih Kurs !", "Info, Ada kolom yang masih kosong !");
          $("#dc_kurs").focus();
        }
        else {

          var form_data = new FormData($('#form_input_transaksi')[0]);

          $.ajax({
            url: base_url + 'gl/transaksi_update',
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
                Command: toastr["success"]("Transaksi GL detail berhasil disimpan", "Berhasil");

                tabel_gl_transaksi_detail();

                $('.reset').val(0);
                $('.clears').val('');
                document.getElementById('no_ref').readOnly = true;
                document.getElementById('tanggal').readOnly = true;
                total_credit();
                total_debit();
                //table_caba_detail();
                //get_balance();

              } else {
                Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
            }

          });
        }


      }

    });





    $('.fc-datepicker1').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: 'dd-mm-yy'
    });


    $('.teksbesar').keyup(function() {
      this.value = this.value.toUpperCase();
    });

    $('.maskmoney_coa').mask('00.00.00.00.00', {
      reverse: true
    });

    $('.maskmoney_money').maskMoney({
      thousands: ',',
      decimal: '.',
      precision: 2,
    });
    $('.maskmoney_money_kurs').maskMoney({
      thousands: ',',
      decimal: '.',
      precision: 0,
    });


    tabel_gl_transaksi_detail = function() {

      $.ajax({
        url: base_url + 'gl/transaksi_data_detail',
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
            //,result[i].sbu

            //var edit = '<div style="text-align:center" onclick=edit_gl_trans_tmp('+result[i].noid+')><i class="splashy-pencil" style="cursor:pointer"></i></div>';
            //var hapus = '<div style="text-align:center" onclick=hapus_gl_trans_tmp('+result[i].noid+')><i class="splashy-gem_remove" style="cursor:pointer"></i></div>';

            var link = "<a href='javascript:void(0)' onclick=\"edit_gl_trans_tmp(" + result[i].noid + ");\" title='Edit'><i class='splashy-document_letter_edit'></i></a> <a href='javascript:void(0)' onclick=\"hapus_gl_trans_tmp(" + result[i].noid + ");\" title='Hapus'><i class='splashy-document_a4_remove'></i></div></a>";


            data.push([result[i].ref, result[i].date_f, result[i].noac, result[i].descac, result[i].ket, result[i].dr_f, result[i].cr_f, result[i].kurs, result[i].kursrate, link]);

          }
          $('#tabel_detail_transaksi_gl').DataTable({
            //"bJQueryUI"     : true,
            data: data,
            deferRender: true,
            processing: true,
            ordering: false,
            retrieve: false,
            paging: true,
            deferLoading: 57,
            "lengthChange": false,
            bDestroy: true,
            autoWidth: false,
            bFilter: true,
            "searching": false,
            iDisplayLength: 10,
            //responsive: true,
            language: {
              searchPlaceholder: 'Cari',
              sSearch: 'false',
              lengthMenu: '_MENU_',
            },
          });

        },
        beforeSend: function() {
          loadingPannel.show();
        },
        complete: function() {
          loadingPannel.hide();
          $('#tabel_detail_transaksi_gl').show();
        }
      });

    }
    tabel_gl_transaksi_detail();


    edit_gl_trans_tmp = function(noid) {

      $("#btn_simpan_trans_detail").hide();
      $("#btn_update_trans_detail").show();
      $("#id_entrytemp").val(noid);

      $("#noid_trans_gl_details").val(noid);

      $.ajax({
        url: base_url + 'gl/get_trans_gl_detail',
        type: "post",
        data: {
          noid: noid,
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        async: 'false',
        success: function(result) {

          $("#acctno").val(result.kode_noac);
          $("#acctname").val(result.descac);
          $("#deskripsi").val(result.ket);
          $("#dc").val(result.dc);
          $("#dc_kurs").val(result.kurs);

          if (result.dc == 'D') {
            $("#dc_nominal").val(result.dr_f);
          } else {
            $("#dc_nominal").val(result.cr_f);
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



    hapus_gl_trans_tmp = function(noid) {

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
            url: base_url + 'gl/hapus_trans_gl_detail',
            type: "post",
            data: {
              noid: noid,
              <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            async: 'false',
            success: function(result) {

              if (result == true) {
                swal("Deleted!", "Data berhasil dihapus!", "success");
                tabel_gl_transaksi_detail();

                $('.reset').val(0);
                $('.clears').val('');
                document.getElementById('no_ref').readOnly = true;
                document.getElementById('tanggal').readOnly = true;
                total_credit();
                total_debit();
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


    total_credit = function() {

      $.ajax({
        url: base_url + 'gl/transaksi_total_credit',
        type: "post",
        data: {
          kode_sementara: $("#kode_sementara").val(),
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        async: 'false',
        success: function(result) {
          if (result.cr_ff == null) {
            $("#totalcr").val(0.00);
          } else {
            $("#totalcr").val(result.cr_ff);
            $("#totalcr_normal").val(result.cr_non_ff);
          }
        },
        beforeSend: function() {

        },
        complete: function() {

        }
      });
    }
    total_credit();


    total_debit = function() {

      $.ajax({
        url: base_url + 'gl/transaksi_total_debit',
        type: "post",
        data: {
          kode_sementara: $("#kode_sementara").val(),
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        async: 'false',
        success: function(result) {
          if (result.dr_ff == null) {
            $("#totaldr").val(0.00);
          } else {
            $("#totaldr").val(result.dr_ff);
            $("#totaldr_normal").val(result.dr_non_ff);
          }

        },
        beforeSend: function() {

        },
        complete: function() {

        }
      });

    }
    total_debit();



    $("#btn_simpan").click(function() {

      //alert($("#totalcr_normal").val()+' - '+$("#totaldr_normal").val())

      if ($("#totaldr_normal").val() == '') {
        Command: toastr["error"]("Belum bisa disimpan, data belum lengkap !", "Lengkapi Inputan !");
      }
      else if ($("#totalcr_normal").val() == '') {
        Command: toastr["error"]("Belum bisa disimpan, data belum lengkap !", "Lengkapi Inputan !");
      }
      else {

        if ($("#totaldr_normal").val() != $("#totalcr_normal").val()) {
          Command: toastr["error"]("Oppss..Total Nominal Kredit dan Debit tidak sama, silahkan periksa kembali inputannya !", "Ada yang belum sesuai !");
          $("#totaldr").focus();
        }
        else {


          $.ajax({
            url: base_url + 'gl/cek_noref',
            type: "post",
            data: {
              no_ref: $("#no_ref").val(),
              <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            async: 'false',
            success: function(result) {

              if (result.refs == 0) {

                var form_data = new FormData($('#form_input_transaksi')[0]);

                $.ajax({
                  url: base_url + 'gl/transaksi_simpan_all',
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
                      //Command: toastr["success"]("Data Transkasi disimpan", "Transaksi Selesai & Tersimpan");
                      getcontents('gl/transaksi_input', '<?php echo $tokens; ?>');

                    } else {
                      Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                    Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Proses Simpan Error !");
                  }

                });

              } else {

                Command: toastr["error"]("Silahkan gunakan nomor ref yang lain, nomor ini " + $("#no_ref").val() + " sudah terdaftar di database !", "No.Ref Sudah Terdaftar !");

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

      }

    });


    $("#btn_update_kurs").click(function() {
      var todaysx = new Date();
      var tgl_kurs_todays = moment(todaysx).format('YYYY-MM-DD');

      $.ajax({
        url: base_url + 'gl/transaksi_update_kurs',
        type: "post",
        data: {
          tgl_kurs_todays: tgl_kurs_todays,
          kurs_nominal: $("#kurs_nominal").val(),
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        async: 'false',
        success: function(result) {
          if (result == true) {
            Command: toastr["success"]("Kurs berhasil diupdate", "Berhasil");
          }
        },
        beforeSend: function() {

        },
        complete: function() {

        }
      });
    });


    // ***** START :  FUNGSI UNTUK MENCARI ITEM PEKERJAAN BERDASARKAN 3 KOMPONEN
    // 1. Kategori
    // 2. Afd / Unit
    // 3. Tahun Tanam


    // TM            : 23
    // TBM           : 22
    // LAND CLEARING : 26
    // PEMBIBITAN    : 27


    // ****** ------------------------------------------------------ ****** //


    /* start : ini untuk select divisi */
    $('#divisi_v').change(function() {
      get_kategori();
      var afds = 0;
      get_afdunit();
      get_tahun(afds);
    });
    /* end : ini untuk select divisi */

    /* start : ini untuk select valuenya Afd/Unit */
    $('#kategori').change(function() {

      var afds = 0;

      get_afdunit();
      get_tahun(afds);

    });
    /* end : ini untuk select valuenya Afd/Unit */

    /* start : ini untuk select valuenya Tahun Tanam */
    $('#afd_unit').change(function() {

      var afds = $(this).val();

      get_tahun(afds);

    });
    /* end : ini untuk select valuenya Tahun Tanam */

    get_kategori = function() {
      $('#kategori').empty();
      var $kategori = $('#kategori');
      if ($("#divisi_v").val() == '06') {
        $kategori.append('<option value="0">- Pilih -</option><option value="TM">TM</option><option value="TBM">TBM</option><option value="LAND_CLEARING">LAND CLEARING</option><option value="PEMBIBITAN">PEMBIBITAN</option>');
      } else {
        $kategori.append('<option value="-">-</option>');
      }

    }
    get_kategori();


    get_afdunit = function() {

      var kategori = $("#kategori").val();
      $('#afd_unit').empty();
      $.ajax({
        type: 'POST',
        url: base_url + 'gl/get_afd_unit',
        data: {
          kategori: kategori
        },
        dataType: 'json',
        success: function(data) {
          var $kategori = $('#afd_unit');
          $kategori.append('<option value="0">- Pilih -</option>');
          for (var i = 0; i < data.length; i++) {
            $kategori.append('<option value=' + data[i].afd + '>' + data[i].afd + ' </option>');
          }
          $kategori.append('<option value="-">-</option>');
        },
        beforeSend: function() {
          loadingPannel.show();
        },
        complete: function() {
          loadingPannel.hide();
        }
      });

    }


    get_tahun = function(val_afd) {

      var kategori = $("#kategori").val();
      $('#tahun_tanam').empty();

      $.ajax({
        type: 'POST',
        url: base_url + 'gl/get_tahuntanam',
        data: {
          kategori: $("#kategori").val(),
          afd_unit: val_afd
        },
        dataType: 'json',
        success: function(data) {
          var $kategori = $('#tahun_tanam');
          $kategori.append('<option value="0">- Pilih -</option>');
          for (var i = 0; i < data.length; i++) {
            $kategori.append('<option value=' + data[i].tahuntanam + '>' + data[i].tahuntanam + ' </option>');
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

    // ****** ------------------------------------------------------ ****** //
    // ***** END :  FUNGSI UNTUK MENCARI ITEM PEKERJAAN BERDASARKAN 3 KOMPONEN  ****** //

    document.getElementById("acctno").addEventListener("keyup", function(event) {

      var afd = $("#afd_unit").val();
      var thn_tanam = $("#tahun_tanam").val();

      var tm_tbm = $("#kategori").val();
      if (tm_tbm == 'TM') {
        tm_tbm1 = '7005';
      } else if (tm_tbm == 'TBM') {
        tm_tbm1 = '2024';
      } else if (tm_tbm == 'LANDCLEARING') {
        tm_tbm1 = '2090';
      } else {
        tm_tbm1 = '2095';
      }
      var dt = tm_tbm1 + afd + thn_tanam;

      src_noac = afd + '' + thn_tanam;
      getpopup('gl/master_tabel_coa_popup_by_kategori', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', 'TM', src_noac);

      $.ajax({
        url: base_url + 'gl/get_nama_acct',
        type: "post",
        data: {
          acct: dt,
        },
        dataType: "json",
        async: 'false',
        success: function(result) {
          $("#acctname").val(result.nama)
        },
        beforeSend: function() {
          loadingPannel.show();
        },
        complete: function() {
          loadingPannel.hide();
          $('#tabel_detail_caba').show();
        }
      });

    });


  });
</script>

<?php
//ini kode random untuk token
$token = "";
$codeAlphabet = "334448795225885";
$codeAlphabet .= "673431639981256";
$codeAlphabet .= "044224123456789";

$max = strlen($codeAlphabet) - 1;
for ($i = 0; $i < 6; $i++) {
  $token .= $codeAlphabet[mt_rand(0, $max)];
}
//ini kode random untuk token
?>

<form id="form_input_transaksi" method=POST enctype='multipart/form-data'>
  <input type="hidden" name="kode_sementara" id="kode_sementara" value="<?php echo $token; ?>">
  <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">
  <input type="hidden" name="id_entrytemp" id="id_entrytemp">

  <h3 class="heading">GL : Input Transaksi</h3>

  <div class="row-fluid">
    <div class="span12">
      <div class="row-fluid">
        <div class="span4">

          <div class="span6">
            <div class="form-group">
              <label for="demo-vs-definput" class="control-label">Ref #</label>
              <input type="text" class="form-control teksbesar span17" name="no_ref" id="no_ref">
            </div>
          </div>

          <div class="span5">
            <div class="form-group">
              <label for="demo-vs-definput" class="control-label">Tanggal</label>
              <div class="input-prepend">
                <input type="date" class="form-control span17" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>">
              </div>
            </div>
          </div>
        </div>


        <div class="span8">

          <div class="span2">

          </div>


          <div class="span2">
            <label for="demo-vs-definput" class="control-label">Total (Dr)</label>
            <input type="text" class="form-control span17 maskmoney_money" name="totaldr" id="totaldr" placeholder="0" style="border-width: 2px;background:black;color:yellow">
            <input type="hidden" name="totaldr_normal" id="totaldr_normal" placeholder="0">
          </div>

          <div class="span2">
            <label for="demo-vs-definput" class="control-label">Total (Cr)</label>
            <input type="text" class="form-control span17 maskmoney_money" style="border-width: 2px;background:black;color:yellow" name="totalcr" id="totalcr" placeholder="0">
            <input type="hidden" name="totalcr_normal" id="totalcr_normal" placeholder="0">
          </div>

          <div class="span2">
            <label for="demo-vs-definput" class="control-label">Update Kurs</label>
            <input type="text" class="form-control span17 maskmoney_money_kurs" name="kurs_nominal" id="kurs_nominal" placeholder="0" style="border-width: 2px;background:black;color:yellow;border-color: red;">
          </div>


          <div class="span2">
            <label for="demo-vs-definput" class="control-label" style="color:white">x</label>
            <button type="button" class="btn btn-success" id="btn_update_kurs"> Update </button>
          </div>

        </div>

      </div>


      <div class="row-fluid">

        <h4 class="heading">Input Detail Transaksi</h4>

        <div class="row-fluid ">
          <div class="span12">

            <div class="span1">
              <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Divisi</label>
                <select class="form-control span17 reset" name="divisi_v" id="divisi_v">
                  <option value="0">-Pilih-</option>
                  <option value="01">01</option>
                  <option value="02">02</option>
                  <option value="06">06</option>
                </select>
              </div>
            </div>

            <div class="span2">
              <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Kategori</label>
                <select class="form-control span17 reset" name="kategori" id="kategori"></select>
              </div>
            </div>



            <div class="span2">
              <div class="form-group">
                <label for="demo-vs-definput" class="control-label">AFD / Unit</label>
                <select class="form-control span17 reset" name="afd_unit" id="afd_unit"></select>
              </div>
            </div>

            <div class="span1">
              <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Thn. Tanam</label>
                <select class="form-control span17 reset" name="tahun_tanam" id="tahun_tanam"></select>
                <!--<input type="text" name="tahun_tanam" id="tahun_tanam" style="width:70px"> -->
              </div>
            </div>


            <div class="span2">
              <div class="form-group">
                <label for="demo-vs-definput" class="control-label">No Acct</label>
                <input type="text" class="form-control clears span17" id="acctno" name="acctno">
                <!-- placeholder="00.00.00.00.00"  class="maskmoney_coa"-->
              </div>
            </div>

            <div class="span4">
              <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Acct Name</label>
                <input type="text" class="form-control teksbesar clears span17" id="acctname" readonly="" name="acctname">
              </div>
            </div>


          </div>
        </div>


        <div class="row-fluid ">
          <div class="span12">

            <div class="span6">
              <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Deskripsi</label>
                <input type="text" class="form-control teksbesar span23" id="deskripsi" name="deskripsi">
              </div>
            </div>

            <div class="span1">
              <div class="form-group">
                <label for="demo-vs-definput" class="control-label">DC</label>
                <select class="form-control span17 reset" name="dc" id="dc">
                  <option value="0">-Pilih-</option>
                  <option value="D">Dr</option>
                  <option value="C">Cr</option>
                </select>
              </div>
            </div>

            <div class="span1">
              <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Kurs</label>
                <select class="form-control span17" name="dc_kurs" id="dc_kurs">
                  <option value="0">-Pilih-</option>
                  <option value="RP" selected>Rp</option>
                  <option value="$">$</option>
                </select>
              </div>
            </div>


            <div class="span2">
              <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Nominal</label>
                <input type="text" class="form-control maskmoney_money clears span17" id="dc_nominal" name="dc_nominal" placeholder="0">
              </div>
            </div>

            <div class="span2">
              <label for="demo-vs-definput" class="control-label" style="color:white">x</label>
              <button type="button" class="btn btn-primary pull-left" id="btn_simpan_trans_detail"> Simpan Trans Detail </button>
              <button type="button" class="btn btn-success pull-left" id="btn_update_trans_detail" style="display:none"> Update Trans Detail </button>
            </div>
          </div>
        </div>

        <!-- footer -->
        <div class="row-fluid">
          <div class="span12">


          </div>
        </div>
        <!-- footer -->


      </div>
    </div>


    <div>
      <h3 class="heading pull-right"><span style="padding-top:10px;font-weight: bold;color:red" id="balance"></span></h3>

      <div class="row-fluid">
        <div class="span12">
          <br>
          <table id="tabel_detail_transaksi_gl" class="table table-hover table-striped table-bordered" style="width: 100%">
            <thead>
              <tr>
                <th style="width: 5%">Ref</th>
                <th style="width: 5%">Tgl</th>
                <!--<th style="width: 5%">SBU</th>-->
                <th style="width: 5%">No.Acc</th>
                <th style="width: 5%">Nama Acc</th>
                <th style="width: 5%">Ket. Transaksi</th>
                <th style="width: 5%">Debet</th>
                <th style="width: 5%">Kredit</th>
                <th style="width: 5%">Kurs</th>
                <th style="width: 5%">Harga Kurs</th>
                <th style="width: 5%">Link</th>
              </tr>
            </thead>
          </table>

        </div>
      </div>

      <!-- footer -->
      <div class="row-fluid">
        <div class="span12">
          <div class="formSep">

          </div>

          <div class="row-fluid pull-right">
            <div class="span9">
            </div>
            <div class="span3">

              <div class="span3" style="width: 50px">
              </div>

              <div class="span3" style="width: 50px">
              </div>

              <div class="span3" style="width: 50px">
                <img src="<?php echo base_url('assets/img-gif.gif'); ?>">
              </div>

              <div class="span3">
                <button type="button" class="btn btn-danger pull-right" id="btn_simpan"> Simpan </button>
              </div>
            </div>
          </div>








        </div>
      </div>
      <!-- footer -->

    </div>





  </div>

</form>