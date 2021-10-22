
<script type="text/javascript">
$(document).ready(function(){
    
    var tokens   = '<?php echo $this->session->userdata('sess_token');?>';
    
    $('#chx_periode').attr('checked', true);
    $('#chx_periode').val('1');



    if (!$("#chx_periode").is(":checked")) {

    }else{
        $("#tgl_start").attr('disabled',true);
        $("#tgl_end").attr('disabled',true);
        
    }

    document.getElementById('chx_periode').onchange = function() {

      document.getElementById('tgl_start').disabled = this.checked;
      document.getElementById('tgl_end').disabled = this.checked;

      //$('#divisi_start').val('10');

      //ini untuk merubah value checkbox
      if (!$("#chx_periode").is(":checked")) {
        $("#tgl_start").focus();
        $('#chx_periode').val('0');
      }else{
        $("#tgl_start").val('');
        $("#tgl_end").val('');
        $('#chx_periode').val('1');
      }

    };


    loading();
      
    $("#btn_cetak").click(function(){
      var base_url  = '<?php echo base_url();?>';
      var tgl_start = $("#tgl_start").val();  
      var tgl_end   = $("#tgl_end").val();
      var periode_terkini   = $("#chx_periode").val();   
      var divstart  = $("#divisi_start").val();
      var divisiend = $("#divisi_end").val();
      var divisiend = $("#divisi_end").val();
      var noacc_start = $("#no_acc_start").val();
      var noacc_end   = $("#no_acc_end").val();

      var sf_tgl_start;
      if($("#tgl_start").val() == ''){
        sf_tgl_start = '0';
      }else{
        sf_tgl_start = $("#tgl_start").val();
      }

      var sf_tgl_end;
      if($("#tgl_end").val() == ''){
        sf_tgl_end = '0';
      }else{
        sf_tgl_end = $("#tgl_end").val();
      }

      var sf_noac_start;
      if($("#no_acc_start").val() == ''){
        sf_noac_start = '0';
      }else{
        sf_noac_start = $("#no_acc_start").val();
      }

      var sf_noac_end;
      if($("#no_acc_end").val() == ''){
        sf_noac_end = '0';
      }else{
        sf_noac_end = $("#no_acc_end").val();
      }

      //window.open(base_url+'cetak/cash_bank_lap_register/'+tgl_start+'/'+tgl_end+'');

        var url = '<?php echo base_url('cetak/gl_lap_jurnal/');?>';
        
        newwindow=window.open(url+'/'+periode_terkini+'/'+sf_tgl_start+'/'+sf_tgl_end+'/'+divstart+'/'+divisiend+'/'+sf_noac_start+'/'+sf_noac_end,'Laporan GL Jurnal','_blank');
        if (window.focus) {newwindow.focus()}
        return false;

    });


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

    $("#btn_tampilkan").click(function(){
        var base_url  = '<?php echo base_url();?>';
        var tgl_start = $("#tgl_start").val();  
        var tgl_end   = $("#tgl_end").val();
        var periode_terkini   = $("#chx_periode").val();   
        var divstart  = $("#divisi_start").val();
        var divisiend = $("#divisi_end").val();
        var divisiend = $("#divisi_end").val();
        var noacc_start = $("#no_acc_start").val();
        var noacc_end   = $("#no_acc_end").val();

        var sf_tgl_start;
        if($("#tgl_start").val() == ''){
          sf_tgl_start = '0';
        }else{
          sf_tgl_start = $("#tgl_start").val();
        }

        var sf_tgl_end;
        if($("#tgl_end").val() == ''){
          sf_tgl_end = '0';
        }else{
          sf_tgl_end = $("#tgl_end").val();
        }

        var sf_noac_start;
        if($("#no_acc_start").val() == ''){
          sf_noac_start = '0';
        }else{
          sf_noac_start = $("#no_acc_start").val();
        }

        var sf_noac_end;
        if($("#no_acc_end").val() == ''){
          sf_noac_end = '0';
        }else{
          sf_noac_end = $("#no_acc_end").val();
        }

      //window.open(base_url+'cetak/cash_bank_lap_register/'+tgl_start+'/'+tgl_end+'');

        var url = '<?php echo base_url('gl/jurnal_popup_view/');?>';
        
        window.open(url+'/'+periode_terkini+'/'+sf_tgl_start+'/'+sf_tgl_end+'/'+divstart+'/'+divisiend+'/'+sf_noac_start+'/'+sf_noac_end,'_blank');

    });

    $("#btn_tampilkan_x").click(function(){

    if($('#chx_periode').val() == 1){

      //$("#tbl_vouc_regis").show();
      $("#btn_cetak").show();
      $("#gl_table_jurnal").empty('');
      $.ajax({ 
                url: base_url + 'gl/report_jurnal_view',
                type: "post",
                data:{tgl_start     : $("#tgl_start").val(),
                    tgl_end         : $("#tgl_end").val(),
                    periode_terkini : $("#chx_periode").val(),
                    divisi_start    : $("#divisi_start").val(),
                    divisi_end      : $("#divisi_end").val(),
                    noacc_start     : $("#no_acc_start").val(),
                    noacc_end       : $("#no_acc_end").val(),
                    <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
                dataType: "html",
                async : 'false',
                success: function(result)
                {

                    if(result == '' || result == null){
                        $("#table_alert").show();
                        $("#tbl_vouc_regis").hide();
                    }else{
                        $("#tbl_vouc_regis").show();
                        $("#table_alert").hide();
                        $("#gl_table_jurnal").append(result);
                    }
                   
                },
                beforeSend: function () {
                    loadingPannel.show();
                },
                complete: function () {
                    loadingPannel.hide();

                }
            });

    }else{

        if($("#tgl_start").val() == ''){
            Command: toastr["error"]("Silahkan isi tanggal !", "Error");
            $("#tgl_start").focus();
          }else if($("#tgl_end").val() == ''){
            Command: toastr["error"]("Silahkan isi tanggal !", "Error");
            $("#tgl_end").focus();
          }else{

            $("#tbl_vouc_regis").show();
            $("#btn_cetak").show();
            $("#gl_table_jurnal").empty('');
            $.ajax({ 
                      url: base_url + 'gl/report_jurnal_view',
                      type: "post",
                      data:{tgl_start : $("#tgl_start").val(),
                      tgl_end         : $("#tgl_end").val(),
                      divisi_start    : $("#divisi_start").val(),
                      divisi_end      : $("#divisi_end").val(),
                      noacc_start     : $("#no_acc_start").val(),
                      noacc_end       : $("#no_acc_end").val(),
                        <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
                      dataType: "html",
                      async : 'false',
                      success: function(result)
                      {

                          $("#gl_table_jurnal").append(result);
                         
                      },
                      beforeSend: function () {
                          loadingPannel.show();
                      },
                      complete: function () {
                          loadingPannel.hide();
                      }
                  });

          } 

    }


});

});    
</script>
    

    <style type="text/css">
    th, td { 
    white-space: nowrap;
    }


    #scrolly{
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


        .tr_tabel_s{
          border-bottom:1pt solid black;
          border-top:1pt solid black;
        }

        .font-styles{
            font-family: Verdana, Geneva, sans-serif;
        }

</style>

<form id="form_input_transaksi"  method=POST enctype='multipart/form-data'>
<input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">

  <nav>
                      <div id="jCrumbs" class="breadCrumb module">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token');?>')"><i class="icon-home"></i></a>
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
  <div class="span6" >
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

      <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_tampilkan"><i class="fa fa-save"></i><i class="splashy-zoom"></i> Tampilkan </button>
      <button type="button" class="btn btn-warning btn-min-width mr-1 mb-1" id="btn_cetak" style="display:none"><i class="fa fa-print"></i><i class="splashy-printer"></i> Cetak </button>

    </form>


    <div class="alert alert-danger" id="table_alert" style="display:none;width:200px">
        Data tidak ditemukan !
    </div>


    <div class="row-fluid">

      <div class="span6" style="display:none" id="tbl_vouc_regis" >


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


    




    
    

