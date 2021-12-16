<script type="text/javascript">
  $(document).ready(function() {

    var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

    $('#chx_periode').attr('checked', true);
    $('#chx_periode').val('1');



    if (!$("#chx_periode").is(":checked")) {

    } else {
      $("#tgl_start").attr('disabled', true);
      $("#tgl_end").attr('disabled', true);

    }

    document.getElementById('chx_periode').onchange = function() {

      document.getElementById('tgl_start').disabled = this.checked;
      document.getElementById('tgl_end').disabled = this.checked;

      //$('#divisi_start').val('10');

      //ini untuk merubah value checkbox
      if (!$("#chx_periode").is(":checked")) {
        $("#tgl_start").focus();
        $('#chx_periode').val('0');
      } else {
        $("#tgl_start").val('');
        $("#tgl_end").val('');
        $('#chx_periode').val('1');
      }

    };


    loading();

    $("#btn_cetak_pdf").click(function() {
      cetak_journal('pdf');
    });

    $("#btn_cetak_excel").click(function() {
      cetak_journal('excel');
    });

    function cetak_journal(cetak) {

      var base_url = '<?php echo base_url(); ?>';
      var tgl_start = $("#tgl_start").val();
      var tgl_end = $("#tgl_end").val();
      var periode_terkini = $("#chx_periode").val();
      var divstart = $("#divisi_start").val();
      var divisiend = $("#divisi_end").val();
      var divisiend = $("#divisi_end").val();
      var noacc_start = $("#no_acc_start").val();
      var noacc_end = $("#no_acc_end").val();

      var sf_tgl_start;
      if ($("#tgl_start").val() == '') {
        sf_tgl_start = '0';
      } else {
        sf_tgl_start = $("#tgl_start").val();
      }

      var sf_tgl_end;
      if ($("#tgl_end").val() == '') {
        sf_tgl_end = '0';
      } else {
        sf_tgl_end = $("#tgl_end").val();
      }

      var sf_noac_start;
      if ($("#no_acc_start").val() == '') {
        sf_noac_start = '0';
      } else {
        sf_noac_start = $("#no_acc_start").val();
      }

      var sf_noac_end;
      if ($("#no_acc_end").val() == '') {
        sf_noac_end = '0';
      } else {
        sf_noac_end = $("#no_acc_end").val();
      }

      //window.open(base_url+'cetak/cash_bank_lap_register/'+tgl_start+'/'+tgl_end+'');

      var url = '<?php echo base_url('cetak/gl_lap_jurnal/'); ?>';

      if (cetak == 'pdf') {
        window.open(url + '/' + periode_terkini + '/' + sf_tgl_start + '/' + sf_tgl_end + '/' + divstart + '/' + divisiend + '/' + sf_noac_start + '/' + sf_noac_end + '/' + cetak + '/' + 'Laporan GL Jurnal', '_blank');
      } else {
        window.open(url + '/' + periode_terkini + '/' + sf_tgl_start + '/' + sf_tgl_end + '/' + divstart + '/' + divisiend + '/' + sf_noac_start + '/' + sf_noac_end + '/' + cetak + '/' + 'Laporan GL Jurnal');
      }
      // if (window.focus) {
      //   newwindow.focus()
      // }
      // return false;

    };


    // Datepicker
    $('.fc-datepicker1').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd-mm-yy'
    });

    $('.fc-datepicker2').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd-mm-yy'
    });

    $('#datepicker_pointer').click(function() {
      $(".fc-datepicker1").focus();
    });

    $('#datepicker_pointer2').click(function() {
      $(".fc-datepicker2").focus();
    });

    $("#btn_tampilkan").click(function() {
      var base_url = '<?php echo base_url(); ?>';
      var tgl_start = $("#tgl_start").val();
      var tgl_end = $("#tgl_end").val();
      var periode_terkini = $("#chx_periode").val();
      var divstart = $("#divisi_start").val();
      var divisiend = $("#divisi_end").val();
      var divisiend = $("#divisi_end").val();
      var noacc_start = $("#no_acc_start").val();
      var noacc_end = $("#no_acc_end").val();

      var sf_tgl_start;
      if ($("#tgl_start").val() == '') {
        sf_tgl_start = '0';
      } else {
        sf_tgl_start = $("#tgl_start").val();
      }

      var sf_tgl_end;
      if ($("#tgl_end").val() == '') {
        sf_tgl_end = '0';
      } else {
        sf_tgl_end = $("#tgl_end").val();
      }

      var sf_noac_start;
      if ($("#no_acc_start").val() == '') {
        sf_noac_start = '0';
      } else {
        sf_noac_start = $("#no_acc_start").val();
      }

      var sf_noac_end;
      if ($("#no_acc_end").val() == '') {
        sf_noac_end = '0';
      } else {
        sf_noac_end = $("#no_acc_end").val();
      }

      //window.open(base_url+'cetak/cash_bank_lap_register/'+tgl_start+'/'+tgl_end+'');

      var url = '<?php echo base_url('gl/jurnal_popup_view/'); ?>';

      window.open(url + '/' + periode_terkini + '/' + sf_tgl_start + '/' + sf_tgl_end + '/' + divstart + '/' + divisiend + '/' + sf_noac_start + '/' + sf_noac_end, '_blank');

    });

    $("#btn_tampilkan_x").click(function() {

      if ($('#chx_periode').val() == 1) {

        //$("#tbl_vouc_regis").show();
        $("#btn_cetak").show();
        $("#gl_table_jurnal").empty('');
        $.ajax({
          url: base_url + 'gl/report_jurnal_view',
          type: "post",
          data: {
            tgl_start: $("#tgl_start").val(),
            tgl_end: $("#tgl_end").val(),
            periode_terkini: $("#chx_periode").val(),
            divisi_start: $("#divisi_start").val(),
            divisi_end: $("#divisi_end").val(),
            noacc_start: $("#no_acc_start").val(),
            noacc_end: $("#no_acc_end").val(),
            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          dataType: "html",
          async: 'false',
          success: function(result) {

            if (result == '' || result == null) {
              $("#table_alert").show();
              $("#tbl_vouc_regis").hide();
            } else {
              $("#tbl_vouc_regis").show();
              $("#table_alert").hide();
              $("#gl_table_jurnal").append(result);
            }

          },
          beforeSend: function() {
            loadingPannel.show();
          },
          complete: function() {
            loadingPannel.hide();

          }
        });

      } else {

        if ($("#tgl_start").val() == '') {
          Command: toastr["error"]("Silahkan isi tanggal !", "Error");
          $("#tgl_start").focus();
        }
        else if ($("#tgl_end").val() == '') {
          Command: toastr["error"]("Silahkan isi tanggal !", "Error");
          $("#tgl_end").focus();
        }
        else {

          $("#tbl_vouc_regis").show();
          $("#btn_cetak").show();
          $("#gl_table_jurnal").empty('');
          $.ajax({
            url: base_url + 'gl/report_jurnal_view',
            type: "post",
            data: {
              tgl_start: $("#tgl_start").val(),
              tgl_end: $("#tgl_end").val(),
              divisi_start: $("#divisi_start").val(),
              divisi_end: $("#divisi_end").val(),
              noacc_start: $("#no_acc_start").val(),
              noacc_end: $("#no_acc_end").val(),
              <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            async: 'false',
            success: function(result) {

              $("#gl_table_jurnal").append(result);

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

    $('#no_acc_start').click(function() {

      get_data_noac();
      $("#start_or_end").empty('');
      $("#start_or_end").val('1');


    });

    $('#no_acc_end').click(function() {

      get_data_noac();
      $("#start_or_end").empty('');
      $("#start_or_end").val('0');


    });

    function get_data_noac() {
      $('#tabel_gl_coa_report').DataTable({
        "destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "iDisplayLength": 10,
        "responsive": true,
        "autoWidth": false,
        rowReorder: true,
        "language": {
          searchPlaceholder: 'Cari',
          sSearch: '',
          lengthMenu: '_MENU_',
          "emptyTable": "Maaf, Data COA tidak tersedia atau belum terdaftar !"
        },
        "ajax": {
          "url": "<?php echo site_url('gl/list_acc') ?>",
          "type": "POST",
          "data": {},
          beforeSend: function() {
            loadingPannel.show();
          },
          complete: function() {
            $('#tableAcc').modal('show');
            loadingPannel.hide();

          }
        },

        "columnDefs": [{
          "targets": [0],
          "orderable": false,
        }, ],
      });
    }

    $(document).on('click', '#pilih_akun', function() {

      var start_end = $('#start_or_end').val();

      // Set data
      $('#tableAcc').modal('hide');
      if (start_end == 1) {
        $("#no_acc_start").val($(this).data('noac'));
      } else if (start_end == 0) {
        $("#no_acc_end").val($(this).data('noac'));
      } else {
        $("#no_acc_start").val('');
        $("#no_acc_end").val('');
      }
    });

  });
</script>

<!-- 
<style type="text/css">
  /* th,
  td {
    white-space: nowrap;
  } */


  #scrolly {
    width: 1000px;
    height: 190px;
    overflow: auto;
    overflow-y: hidden;
    margin: 0 auto;
    white-space: nowrap
  }


  /*table.borderbuttom {
         border-collapse: collapse;
         border: 1pt solid black;
         border-left: 0px solid black;
         border-right: 0px solid black;
        }*/

  table.borderbuttom {
    border: 0px solid #1C6EA4;
    border-collapse: collapse;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
  }

  table.borderbuttom thead th {
    border: 0px solid #1C6EA4;
  }

  table.borderbuttom tr:nth-child(even) {
    border: 1pt solid black;
    border-left: 0px;
    border-right: 0px;
    background: none;
    border-collapse: collapse;
  }


  .tr_tabel_s {
    border-bottom: 1pt solid black;
    border-top: 1pt solid black;
  }

  .font-styles {
    font-family: Verdana, Geneva, sans-serif;
  }
</style> -->

<form id="form_input_transaksi" method=POST enctype='multipart/form-data'>
  <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">

  <nav>
    <div id="jCrumbs" class="breadCrumb module">
      <ul>
        <li>
          <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token'); ?>')"><i class="icon-home"></i></a>
        </li>
        <li>
          <a href="#">GL</a>
        </li>
        <li>
          <a href="#">Report</a>
        </li>
        <li>
          <a href="#">Journal</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="row-fluid">
    <div class="span6">
      <h3 class="heading">Report Journal</h3>

      <div class="row-fluid">
        <div class="span3">
          <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Tanggal Start</label>
            <div class="input-prepend">
              <input type="text" size="20" class="span9 fc-datepicker1" id="tgl_start" name="tgl_start"><span class="add-on" id="tgl_start" style="cursor: pointer;"><i class="icon-calendar"></i></span>
            </div>
          </div>
        </div>
        <div class="span3">
          <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Tanggal End</label>
            <div class="input-prepend">
              <input type="text" size="20" class="span9 fc-datepicker1" id="tgl_end" name="tgl_end"><span class="add-on" id="tgl_end" style="cursor: pointer;"><i class="icon-calendar"></i></span>
            </div>
          </div>
        </div>
        <div class="span3">
          <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Periode Terkini</label>
            <label class="uni-checkbox">
              <input type="checkbox" id="chx_periode" name="chx_periode" class="uni_style" />
            </label>
          </div>
        </div>
      </div>


      <div class="row-fluid">
        <div class="span3">
          <label for="demo-vs-definput" class="control-label">Divisi (From)</label>
          <select class="form-control span12" name="divisi_start" id="divisi_start">
            <option value="-">-</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
          </select>
        </div>
        <div class="span3">
          <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Divisi (Until)</label>
            <select class="form-control span12" name="divisi_end" id="divisi_end">
              <option value="-">-</option>
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
            </select>
            </select>
          </div>
        </div>
      </div>



      <div class="row-fluid">
        <div class="span3">
          <label for="demo-vs-definput" class="control-label">NoAcc (From)</label>
          <input type="text" size="20" class="span12" id="no_acc_start" name="no_acc_start">
        </div>
        <div class="span3">
          <div class="form-group">
            <label for="demo-vs-definput" class="control-label">NoAcc (Until)</label>
            <input type="text" size="20" class="span12" id="no_acc_end" name="no_acc_end">
          </div>
        </div>
      </div>


    </div>
  </div>

  <br>

  <!-- <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_tampilkan"><i class="fa fa-save"></i><i class="splashy-zoom"></i> Tampilkan </button> -->
  <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1" id="btn_cetak_pdf"><i class="fa fa-print"></i><i class="splashy-printer"></i> PDF </button>
  <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" id="btn_cetak_excel"><i class="fa fa-print"></i><i class="splashy-printer"></i> Excel</button>

</form>
<input type="hidden" id="start_or_end">

<div class="alert alert-danger" id="table_alert" style="display:none;width:200px">
  Data tidak ditemukan !
</div>


<div class="row-fluid">

  <div class="span6" style="display:none" id="tbl_vouc_regis">


    <table id="tabel_lap_vouc_jurnal" class="borderbuttom font-styles" style="width: 50%">
      <thead>
        <tr>
          <th>Date</th>
          <th>Ref</th>
          <th>Devisi</th>
          <th>No Acct</th>
          <th style="width:50px">Account Name</th>
          <th style="width:50px">Description</th>
          <th>Debit</th>
          <th>Credit</th>
        </tr>
      </thead>
      <tbody id="gl_table_jurnal"></tbody>
    </table>

  </div>
</div>

<div class="modal fade" id="tableAcc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-header modal-lg">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Tabel COA</h3>
  </div>
  <div class="modal-body">
    <div class="table-responsive">
      <table id="tabel_gl_coa_report" class="table table-hover table-striped" style="width: 100%">
        <thead>
          <tr>
            <th style="width: 5%">Pilih</th>
            <th style="width: 5%">No</th>
            <th style="width: 5%">Noac</th>
            <th style="width: 40%">Nama</th>
            <th style="width: 5%">Sbu</th>
            <th style="width: 5%">Group</th>
            <th style="width: 5%">Type</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-refresh"></i> Close</button>
  </div>
</div>