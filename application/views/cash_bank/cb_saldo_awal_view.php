<script type="text/javascript">
  $(document).ready(function() {

    var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

    loading();

    var data_saldo_awal = function() {

      $('#tabel_saldo_awal').hide();

      $.ajax({
        url: base_url + 'cash_bank/get_data_saldo_awal',
        type: "post",
        data: {
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        async: 'false',
        success: function(result) {
          var data = [];
          for (var i = 0; i < result.length; i++) {
            var no = i + 1;

            var baseurl = '<?php echo base_url(); ?>';

            var link_edit = "<a href='javascript:void(0)' onclick=\"getpopup('cash_bank/saldo_awal_edit','" + tokens + "','popupedit','" + result[i].id + "');\"><span class='btn btn-sm btn-default' title='Edit'>" + result[i].ACCTNO + "</span></a>";
            //,'<div style="width:100%;text-align:center">'+link_edit+'</div>'
            data.push([no, result[i].ACCTNO, result[i].ACCTNAME, result[i].saldo_f, result[i].saldo1_f, result[i].saldo2_f, result[i].saldo3_f, result[i].saldo4_f, result[i].saldo5_f, result[i].saldo6_f, result[i].saldo7_f, result[i].saldo8_f, result[i].saldo9_f, result[i].saldo10_f, result[i].saldo11_f, result[i].saldo12_f, result[i].thn]);
          }

          $('#tabel_saldo_awal').DataTable({
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
          $('#tabel_saldo_awal').show();
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
          }
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
        <table id="tabel_saldo_awal" class="table table-striped table-bordered table-condensed" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>No. Account</th>
              <th style="width:auto">Nama Account</th>
              <th>Saldo</th>
              <th>1</th>
              <th>2</th>
              <th>3</th>
              <th>4</th>
              <th>5</th>
              <th>6</th>
              <th>7</th>
              <th>8</th>
              <th>9</th>
              <th>10</th>
              <th>11</th>
              <th>12</th>
              <th>Tahun</th>
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