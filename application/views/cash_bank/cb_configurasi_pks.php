<script type="text/javascript">
  $(document).ready(function() {

    var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';
    var lokasi = '<?php echo $this->session->userdata('sess_nama_lokasi'); ?>';

    $("#lokasi_s").val(lokasi);

    $('.input_config').prop('readonly', true);

    loading();

    $.ajax({
      url: base_url + 'cash_bank/configurasi_data',
      type: "post",
      dataType: 'json',
      data: {
        lokasi: lokasi,
        <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
      },
      success: function(response) {
        console.log(response);

        //START - KODE PAYMENT (KAS)
        $("#kode_payment_kas_inisial_1").val(response.pay_inikas);
        $("#kode_payment_kas_kode_1").val(response.pay_nokas);
        $("#kode_payment_kas_coa_1").val(response.NOACC_KAS1);

        $("#kode_payment_kas_inisial_2").val(response.pay_inikas2);
        $("#kode_payment_kas_kode_2").val(response.pay_nokas2);
        $("#kode_payment_kas_coa_2").val(response.NOAC_KAS2);

        $("#kode_payment_kas_inisial_3").val(response.pay_inikas3);
        $("#kode_payment_kas_kode_3").val(response.pay_nokas3);
        $("#kode_payment_kas_coa_3").val(response.NOAC_KAS3);

        $("#kode_payment_kas_inisial_4").val(response.pay_inikas4);
        $("#kode_payment_kas_kode_4").val(response.pay_nokas4);
        $("#kode_payment_kas_coa_4").val(response.NOAC_KAS4);


        $("#kode_payment_kas_inisial_5").val(response.pay_inikas5);
        $("#kode_payment_kas_kode_5").val(response.pay_nokas5);
        $("#kode_payment_kas_coa_5").val(response.NOAC_KAS5);
        //END - KODE PAYMENT (KAS)



        //START - KODE PAYMENT (BANK)
        $("#kode_payment_bank_nama_1").val(response.pay_namabank1);
        $("#kode_payment_bank_inisial_1").val(response.pay_inibank1);
        $("#kode_payment_bank_kode_1").val(response.pay_nobank1);
        $("#kode_payment_bank_coa_1").val(response.NOAC_BANK1);

        $("#kode_payment_bank_nama_2").val(response.pay_namabank2);
        $("#kode_payment_bank_inisial_2").val(response.pay_inibank2);
        $("#kode_payment_bank_kode_2").val(response.pay_nobank2);
        $("#kode_payment_bank_coa_2").val(response.NOAC_BANK2);

        $("#kode_payment_bank_nama_3").val(response.pay_namabank3);
        $("#kode_payment_bank_inisial_3").val(response.pay_inibank3);
        $("#kode_payment_bank_kode_3").val(response.pay_nobank3);
        $("#kode_payment_bank_coa_3").val(response.NOAC_BANK3);

        $("#kode_payment_bank_nama_4").val(response.pay_namabank4);
        $("#kode_payment_bank_inisial_4").val(response.pay_inibank4);
        $("#kode_payment_bank_kode_4").val(response.pay_nobank4);
        $("#kode_payment_bank_coa_4").val(response.NOAC_BANK4);
        //END - KODE PAYMENT (BANK)




        //START - KODE RECEIVE (KAS)
        $("#kode_receive_kas_inisial_1").val(response.rec_inikas);
        $("#kode_receive_kas_kode_1").val(response.rec_nokas);
        $("#kode_receive_kas_coa_1").val(response.NOACCKAS1);

        $("#kode_receive_kas_inisial_2").val(response.rec_inikas2);
        $("#kode_receive_kas_kode_2").val(response.rec_nokas2);
        $("#kode_receive_kas_coa_2").val(response.NOACCKAS2);

        $("#kode_receive_kas_inisial_3").val(response.rec_inikas3);
        $("#kode_receive_kas_kode_3").val(response.rec_nokas3);
        $("#kode_receive_kas_coa_3").val(response.NOACCKAS3);

        $("#kode_receive_kas_inisial_4").val(response.rec_inikas4);
        $("#kode_receive_kas_kode_4").val(response.rec_nokas4);
        $("#kode_receive_kas_coa_4").val(response.NOACCKAS4);

        $("#kode_receive_kas_inisial_5").val(response.rec_inikas5);
        $("#kode_receive_kas_kode_5").val(response.rec_nokas5);
        $("#kode_receive_kas_coa_5").val(response.NOACCKAS5);
        //END - KODE RECEIVE (KAS)


        //START - KODE RECEIVE (KAS)
        $("#kode_receive_bank_nama_1").val(response.rec_namabank1);
        $("#kode_receive_bank_inisial_1").val(response.rec_inibank1);
        $("#kode_receive_bank_kode_1").val(response.rec_nobank1);
        $("#kode_receive_bank_coa_1").val(response.NOACC_RECBANK1);

        $("#kode_receive_bank_nama_2").val(response.rec_namabank2);
        $("#kode_receive_bank_inisial_2").val(response.rec_inibank2);
        $("#kode_receive_bank_kode_2").val(response.rec_nobank2);
        $("#kode_receive_bank_coa_2").val(response.NOACC_RECBANK2);
        //END - KODE RECEIVE (KAS)



      },
      error: function(jqXHR, textStatus, errorThrown) {
        Command: toastr["error"]("Ajax Error !!", "Error");
      },
      beforeSend: function() {
        loadingPannel.show();
      },
      complete: function() {
        loadingPannel.hide();
      }

    });


    $("#btn_simpan").click(function() {

      var form_data = new FormData($('#form_input')[0]);

      swal({
          title: "Update Configurasi ?",
          text: "Jika ingin disimpan, silahkan klik button update",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
          confirmButtonText: "Update",
          //confirmButtonColor: "#E73D4A"
          confirmButtonColor: "#286090"
        },
        function() {

          $.ajax({
            url: base_url + 'cash_bank/configurasi_update',
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
                Command: toastr["success"]("Configurasi berhasil di update", "Configurasi Berhasil");
                getcontents('cash_bank/configurasi', '<?php echo $tokens; ?>');
                $('.input_config').prop('readonly', true);
                $("#btn_simpan").hide();
                $("#btn_rubah").show();
              } else {
                Command: toastr["error"]("Configurasi tidak berhasil di update !", "Error");
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
            }

          });

        });

    });


    $('#btn_rubah').click(function() {
      $('.input_config').removeAttr('readonly');
      $("#btn_simpan").show();
      $("#btn_batal").show();
      $("#btn_rubah").hide();
    });



    $('#btn_batal').click(function() {
      $('.input_config').prop('readonly', true);
      $("#btn_simpan").hide();
      $("#btn_batal").hide();
      $("#btn_rubah").show();
    });





  });
</script>




<form id="form_input" method=POST enctype='multipart/form-data'>

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
          <a href="#">Configurasi (ESTATE)</a>
        </li>
      </ul>
    </div>
  </nav>

  <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">
  <input type='hidden' class='form-control' name='lokasi_s' id='lokasi_s'>



  <style type="text/css">
    .space_bottom {
      padding-bottom: 5px;
    }

    .teks_inisial_field {
      margin-bottom: 10px;
      margin-left: 2px;
      margin-right: 2px
    }
  </style>


  <div class="row-fluid">
    <div class="span6">


      <div class="tabbable tabbable-bordered">
        <ul class="nav nav-tabs">
          <li class="active"><a href="javascript:void(0)" data-toggle="tab" style="color:#870505;"><b>Kode Payment</b></a></li>
        </ul>
        <div class="tab-content" style="padding-left:10px;padding-right:10px;padding-bottom:10px;padding-top:0px;">
          <div class="tab-pane active" id="tab_br1">
            <p>
            <div>

              <div class="span12">

                <table>
                  <thead>
                    <tr>
                      <th colspan="9">
                        <div style="float:left;padding-bottom:10px">KAS</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    for ($i = 0; $i < 5; $i++) {
                      $kd_payment_kas = $i + 1;
                    ?>
                      <tr>
                        <th>
                          <div class="teks_inisial_field"><?php echo $kd_payment_kas; ?>.</div>
                        </th>
                        <td>
                          <div class="teks_inisial_field">Inisial</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_payment_kas_inisial_<?php echo $kd_payment_kas; ?>" id="kode_payment_kas_inisial_<?php echo $kd_payment_kas; ?>"></td>
                        <td>
                          <div class="teks_inisial_field">Kode</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_payment_kas_kode_<?php echo $kd_payment_kas; ?>" id="kode_payment_kas_kode_<?php echo $kd_payment_kas; ?>"></td>
                        <td>
                          <div class="teks_inisial_field">COA</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_payment_kas_coa_<?php echo $kd_payment_kas; ?>" id="kode_payment_kas_coa_<?php echo $kd_payment_kas; ?>"></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>

                <hr>

                <table>
                  <thead>
                    <tr>
                      <th colspan="9">
                        <div style="float:left;padding-bottom:10px">BANK</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    for ($i = 0; $i < 4; $i++) {
                      $kd_payment_bank = $i + 1;
                    ?>
                      <tr>
                        <th>
                          <div class="teks_inisial_field"><?php echo $kd_payment_bank; ?>.</div>
                        </th>
                        <td>
                          <div class="teks_inisial_field">Nama</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_payment_bank_nama_<?php echo $kd_payment_bank; ?>" id="kode_payment_bank_nama_<?php echo $kd_payment_bank; ?>"></td>
                        <td>
                          <div class="teks_inisial_field">Inisial</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_payment_bank_inisial_<?php echo $kd_payment_bank; ?>" id="kode_payment_bank_inisial_<?php echo $kd_payment_bank; ?>"></td>
                        <td>
                          <div class="teks_inisial_field">Kode</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_payment_bank_kode_<?php echo $kd_payment_bank; ?>" id="kode_payment_bank_kode_<?php echo $kd_payment_bank; ?>"></td>
                        <td>
                          <div class="teks_inisial_field">COA</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_payment_bank_coa_<?php echo $kd_payment_bank; ?>" id="kode_payment_bank_coa_<?php echo $kd_payment_bank; ?>"></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>


      <br>

    </div>





    <div class="span6">


      <div class="tabbable tabbable-bordered">
        <ul class="nav nav-tabs">
          <li class="active"><a href="javascript:void(0)" data-toggle="tab" style="color:#870505;"><b>Kode Receive</b></a></li>
        </ul>
        <div class="tab-content" style="padding-left:10px;padding-right:10px;padding-bottom:10px;padding-top:0px;">
          <div class="tab-pane active" id="tab_br1">
            <p>
            <div>

              <div class="span12">

                <table>
                  <thead>
                    <tr>
                      <th colspan="9">
                        <div style="float:left;padding-bottom:10px">KAS</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    for ($i = 0; $i < 5; $i++) {
                      $kd_receive_kas = $i + 1;
                    ?>
                      <tr>
                        <th>
                          <div class="teks_inisial_field"><?php echo $kd_receive_kas; ?>.</div>
                        </th>
                        <td>
                          <div class="teks_inisial_field">Inisial</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_receive_kas_inisial_<?php echo $kd_receive_kas; ?>" id="kode_receive_kas_inisial_<?php echo $kd_receive_kas; ?>"></td>
                        <td>
                          <div class="teks_inisial_field">Kode</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_receive_kas_kode_<?php echo $kd_receive_kas; ?>" id="kode_receive_kas_kode_<?php echo $kd_receive_kas; ?>"></td>
                        <td>
                          <div class="teks_inisial_field">COA</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_receive_kas_coa_<?php echo $kd_receive_kas; ?>" id="kode_receive_kas_coa_<?php echo $kd_receive_kas; ?>"></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>

                <hr>

                <table>
                  <thead>
                    <tr>
                      <th colspan="9">
                        <div style="float:left;padding-bottom:10px">BANK</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    for ($i = 0; $i < 2; $i++) {
                      $kd_recive_bank = $i + 1;
                    ?>
                      <tr>
                        <th>
                          <div class="teks_inisial_field"><?php echo $kd_recive_bank; ?>.</div>
                        </th>
                        <td>
                          <div class="teks_inisial_field">Nama</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" readonly name="kode_receive_bank_nama_<?php echo $kd_recive_bank; ?>" id="kode_receive_bank_nama_<?php echo $kd_recive_bank; ?>"></td>
                        <td>
                          <div class="teks_inisial_field">Inisial</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_receive_bank_inisial_<?php echo $kd_recive_bank; ?>" id="kode_receive_bank_inisial_<?php echo $kd_recive_bank; ?>"></td>
                        <td>
                          <div class="teks_inisial_field">Kode</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_receive_bank_kode_<?php echo $kd_recive_bank; ?>" id="kode_receive_bank_kode_<?php echo $kd_recive_bank; ?>"></td>
                        <td>
                          <div class="teks_inisial_field">COA</div>
                        </td>
                        <td><input type="text" class="form-control span12 input_config" name="kode_receive_bank_coa_<?php echo $kd_recive_bank; ?>" id="kode_receive_bank_coa_<?php echo $kd_recive_bank; ?>"></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>


      <br>
      <br>
      <br>

      <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" id="btn_simpan" style="display:none"><i class="fa fa-save"></i> Update </button>
      <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_rubah"><i class="fa fa-save"></i> Rubah </button>
      <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1" id="btn_batal" style="display:none"><i class="fa fa-save"></i> Batal </button>
    </div>


</form>