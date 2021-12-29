<script type="text/javascript">
  $(document).ready(function() {

    var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

    loading();

    var data_saldo_awal = function() {

      // $('#tabel_saldo_awal').hide();
      $('#tabel_saldo_awal').DataTable().destroy();
      $('#tabel_saldo_awal').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "scrollX": true,
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
          url: base_url + 'cash_bank/data_saldo_awal',
          type: 'POST',
          data: {
            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          dataType: "json",
          beforeSend: function() {
            //loadingPannel.show();
          },
          complete: function() {
            //loadingPannel.hide();
            $('#tabel_saldo_awal').show();
          },

        },
        "columnDefs": [{
          "targets": [0], //first column / numbering column
          "orderable": false, //set not orderable
        }, ],
        "language": {
          "infoFiltered": ""
        }
      });


    }
    data_saldo_awal();


    document.getElementById("acctno").addEventListener("keyup", function(event) {
      event.preventDefault();
      if (event.keyCode === 13) {
        getpopup('gl/master_tabel_coa_popup', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', '1');
      }
    });

    $('.maskmoney_money').maskMoney({
      thousands: ',',
      decimal: '.',
      precision: 0,
    });







    $("#btn_simpan").click(function() {


      if ($("#acctno").val() == '') {
        Command: toastr["error"]("No Account tidak boleh kosong !", "Error");
        $("#acctno").focus();
      }
      else if ($("#acctname").val() == '') {
        Command: toastr["error"]("Nama Account tidak boleh kosong !", "Error");
        $("#acctname").focus();
      }
      else if ($("#nilai_saldo").val() == '') {
        Command: toastr["error"]("Silahkan masukan Nilai Saldo !", "Error");
        $("#nilai_saldo").focus();
      }
      else {


        var periodex = "<?php echo $this->session->userdata('sess_periode'); ?>";
        var tahun_periode = periodex.substr(0, 4);
        var bulan_periode = periodex.substr(4, 2);

        $.ajax({
          url: base_url + 'cash_bank/cek_saldo_awal',
          type: "post",
          data: {
            acctno: $("#acctno").val(),
            tahun: tahun_periode,
            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          dataType: "json",
          async: 'false',
          success: function(result) {
            if (result == 1) {

              swal({
                  title: "Data sudah tersedia !",
                  text: "Apakah anda ingin merubah saldo awal ? kalo ya, silahkan klik tombol update.",
                  type: "info",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  showLoaderOnConfirm: true,
                  confirmButtonText: "Update",
                  //confirmButtonColor: "#E73D4A"
                  confirmButtonColor: "#286090"
                },
                function() {

                  //ini jika ada data noac dan tahun, maka proses update
                  $.ajax({
                    url: base_url + 'cash_bank/update_saldo_awal',
                    type: "post",
                    data: {
                      acctno: $("#acctno").val(),
                      tahun: tahun_periode,
                      bulan: bulan_periode,
                      acctname: $("#acctname").val(),
                      saldo: $("#nilai_saldo").val(),
                      <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "json",
                    async: 'false',
                    success: function(result) {
                      if (result == true) {
                        swal.close();
                        Command: toastr["success"]("Saldo awal berhasil di update.", "Berhasil");
                        getcontents('cash_bank/saldo_awal', '<?php echo $this->session->userdata('sess_token'); ?>');
                        $("#acctno").val('');
                        $("#acctname").val('');
                        $("#nilai_saldo").val('');
                        data_saldo_awal();
                      } else {
                        Command: toastr["success"]("Data belum ke simpan", "Error");
                      }
                    },
                    beforeSend: function() {
                      loadingPannel.show();
                    },
                    complete: function() {
                      loadingPannel.hide();
                    }
                  });

                });


            } else {


              $.ajax({
                url: base_url + 'cash_bank/simpan_saldo_awal',
                type: "post",
                data: {
                  acctno: $("#acctno").val(),
                  tahun: tahun_periode,
                  bulan: bulan_periode,
                  acctname: $("#acctname").val(),
                  saldo: $("#nilai_saldo").val(),
                  <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                async: 'false',
                success: function(result) {
                  if (result.status == true) {
                    swal.close();
                    Command: toastr["success"]("Saldo awal berhasil di simpan.", "Berhasil");
                    getcontents('cash_bank/saldo_awal', '<?php echo $this->session->userdata('sess_token'); ?>');
                    $("#acctno").val('');
                    $("#acctname").val('');
                    $("#nilai_saldo").val('');
                    data_saldo_awal();
                  } else {
                    Command: toastr["success"]("Data belum ke simpan", "Error");
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
          },
          beforeSend: function() {
            //loadingPannel.show();
          },
          complete: function() {
            //loadingPannel.hide();
          },

        });



        /*var form_data = new FormData($('#form_input_transaksi')[0]);

          $.ajax({
              url             : base_url + 'cash_bank/simpan_saldo_awal', 
              type            : "POST",
              dataType        : 'json',
              mimeType        : 'multipart/form-data',
              data            : form_data,
              contentType     : false,
              cache           : false,
              processData     : false,
              success     : function(response){
                  if(response == true){  
                      swal.close();
                      Command: toastr["success"]("Transaksi Voucher detail berhasil disimpan", "Berhasil");
                      $('#divisi_v').val(0);
                      $('.clears').val('');
                      table_caba_detail();
                      getcontents('cash_bank/input_voucher','<?php echo $this->session->userdata('sess_token'); ?>');
                      
                  }else{
                      Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                  } 
          },
          error: function(jqXHR, textStatus, errorThrown) {
              Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
          },
          beforeSend: function () {
              loadingPannel.show();
          },
          complete: function () {
              loadingPannel.hide();
          }

          });*/

      }

    });

  });
</script>
<style>
  table#tabel_saldo_awal td {
    padding: 3px;
    padding-left: 10px;
    font-size: 12px;
  }
</style>


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
        <a href="#">Saldo Awal</a>
      </li>
    </ul>
  </div>
</nav>

<div id="page_posting">

  <form id="form_input" method=POST enctype='multipart/form-data'>
    <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">


    <div class="section-wrapper">
      <h3 class="heading">Saldo Awal Cash Bank</h3>

      <div class="tabbable tabbable-bordered">
        <ul class="nav nav-tabs">
          <li class="active"><a href="javascript:void(0)" data-toggle="tab" style="color:#870505;"><b>Form Input Saldo Awal</b></a></li>
        </ul>
        <div class="tab-content" style="padding-left:10px;padding-right:10px;padding-bottom:10px;padding-top:0px;">
          <div class="tab-pane active" id="tab_br1">
            <p>
            <div>

              <div class="row-fluid">
                <!-- <input type="text" name="" id="" value="<?= $this->session->userdata('sess_id_lokasi'); ?>"> -->
                <div class="span2">
                  <div class="form-group" style="padding-right:20px">
                    <label for="demo-vs-definput" class="control-label">No. Account</label>
                    <input type="text" id="acctno" name="acctno" class="form-control" style="width:118%">
                  </div>
                </div>
                <div class="span2">
                  <div class="form-group">
                    <label for="demo-vs-definput" class="control-label">Nama Account</label>
                    <input type="text" id="acctname" name="acctname" class="form-control" style="width:105%" readonly>
                  </div>
                </div>
                <div class="span2">
                  <div class="form-group">
                    <label for="demo-vs-definput" class="control-label">Nilai Saldo</label>
                    <input type="text" id="nilai_saldo" name="nilai_saldo" class="form-control maskmoney_money" style="width:105%">
                  </div>
                </div>
                <div class="span2">
                  <div class="form-group">
                    <label for="demo-vs-definput" class="control-label" style="color:white">x</label>
                    <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1" id="btn_simpan">Simpan</button>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>


      </div>
    </div>


    <div class="row-fluid">
      <div class="span12">

        <br>

        <table id="tabel_saldo_awal" class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th style="font-size: 12px; padding:10px">No</th>
              <th style="font-size: 12px; padding:10px">No. Account</th>
              <th style="width:auto; font-size: 12px; padding:10px">Nama Account</th>
              <th style="font-size: 12px; padding:10px">Saldo</th>
              <th style="font-size: 12px; padding:10px">1</th>
              <th style="font-size: 12px; padding:10px">2</th>
              <th style="font-size: 12px; padding:10px">3</th>
              <th style="font-size: 12px; padding:10px">4</th>
              <th style="font-size: 12px; padding:10px">5</th>
              <th style="font-size: 12px; padding:10px">6</th>
              <th style="font-size: 12px; padding:10px">7</th>
              <th style="font-size: 12px; padding:10px">8</th>
              <th style="font-size: 12px; padding:10px">9</th>
              <th style="font-size: 12px; padding:10px">10</th>
              <th style="font-size: 12px; padding:10px">11</th>
              <th style="font-size: 12px; padding:10px">12</th>
              <th style="font-size: 12px; padding:10px">Tahun</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
    <!-- footer -->

</div>



</div>

</div>

</form>

</div>