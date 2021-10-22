<script type="text/javascript">
$(document).ready(function(){
    
    var tokens   = '<?php echo $this->session->userdata('sess_token');?>';
    
    $('#tgl_periode_trialbalance').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yymm',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
    
    $("input[type=radio]").click(function(event) {
        var myId = this.id;
        if(myId == 'TBL'){
            $("#div_level").show();
        }else if(myId == 'TBP'){
            $("#div_level").show();
        }else{
            $("#div_level").hide();
        }
    });
    
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

        var url = '<?php echo base_url('cetak/gl_lap_bukubesar/');?>';
        window.open(url+'/'+periode_terkini+'/'+sf_tgl_start+'/'+sf_tgl_end+'/'+divstart+'/'+divisiend+'/'+sf_noac_start+'/'+sf_noac_end,'_blank');
        //if (window.focus) {newwindow.focus()}
        //return false;

    });


    $("#btn_tampilkan_popup").click(function(){

      $("#btn_cetak").show();

        var base_url  = '<?php echo base_url();?>';
      
        var periode  = $("#tgl_periode_trialbalance").val();
        var bygroup  = '';
        var kategori = $("input:radio[name=kategori]:checked").val();
        var bylevel  = $("#bylevel").val();
       
//        Summary Current Year
//        Balance Tahun Level 2
//        Summary Compare Year
//        Balance Tahun Level 3
       
        if(kategori == 'rb_1'){ // current year
            var url  = '<?php echo base_url('gl_lap/balance_summary_current_year/');?>';
            window.open(url+'/'+periode+'/0/'+kategori,'_blank');
            //if (window.focus) {newwindow.focus()}
            //return false;
        }else if(kategori == 'rb_2'){ // compare year
            var url  = '<?php echo base_url('gl_lap/balance_compare_year/');?>';
            window.open(url+'/'+periode+'/0/'+kategori,'_blank');
            //if (window.focus) {newwindow.focus()}
            //return false;
        }else if(kategori == 'rb_3'){ // by trial detail
            var url  = '<?php echo base_url('gl_lap/balance_tahun_level_2/');?>';
            window.open(url+'/'+periode+'/2/'+kategori,'_blank');
            //if (window.focus) {newwindow.focus()}
            //return false;
        }else if(kategori == 'rb_4'){ // by level 2
            var url  = '<?php echo base_url('gl_lap/balance_tahun_level_2/');?>';
            window.open(url+'/'+periode+'/3/'+kategori,'_blank');
            //if (window.focus) {newwindow.focus()}
            //return false;
        }

    });

  $("#btn_tampilkan").click(function(){

      //$("#tbl_vouc_regis").show();
      $("#btn_cetak").show();
      $("#gl_table_jurnal").empty('');
      $.ajax({ 
                url: base_url + 'gl/report_trail_balance_view',
                type: "post",
                data:{periode : $("#tgl_periode_trialbalance").val(),
                    bygroup   : $("#bygroup").val(),
                    kategori  : $("input:radio[name=kategori] :selected").val(),
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
                <a href="#">Balance Sheet</a>
            </li>
        </ul>
        </div>
    </nav>

  <div class="row-fluid">
  <div class="span6" >
      <h3 class="heading">Laporan Balance Sheet</h3>
          
          <div class="row-fluid">
            <div class="span3">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Periode s/d</label>
                  <div class="input-prepend">
                  <input type="text" size="20" class="span9 fc-datepicker1" value="<?php echo $periode;?>" id="tgl_periode_trialbalance" name="tgl_periode_trialbalance"><span class="add-on" id="tgl_start" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                 </div> 
                </div>
            </div>
            <div class="span6">  </div>
          </div>
      
          <div class="row-fluid">
            <div class="span12">
                <input type="radio" name="kategori" value="rb_1" id="rb_1" checked="checked"> Summary Current Year<br>
                <input type="radio" name="kategori" value="rb_2" id="rb_3"> Summary Compare Year<br>
                <input type="radio" name="kategori" value="rb_3" id="rb_2"> Balance Tahun Level 2<br>
                <input type="radio" name="kategori" value="rb_4" id="rb_4"> Balance Tahun Level 3<br>
            </div>
          </div>

      
      
    </div>
  </div>

      <br>

      <!--<button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_tampilkan"><i class="fa fa-save"></i><i class="splashy-zoom"></i> Tampilkan </button>-->
      <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_tampilkan_popup"><i class="fa fa-save"></i><i class="splashy-zoom"></i> Tampilkan </button>
      
      <button type="button" class="btn btn-warning btn-min-width mr-1 mb-1" id="btn_cetak" style="display:none"><i class="fa fa-print"></i><i class="splashy-printer"></i> Cetak </button>

    </form>


    <div class="alert alert-danger" id="table_alert" style="display:none;width:200px">
        Data tidak ditemukan !
    </div>


    <div class="row-fluid">

      <div class="span12" style="display:none" id="tbl_vouc_regis" >

                              <div><!-- style="width: 100%; overflow-x: scroll;" -->
                              <table id="tabel_lap_vouc_jurnal" style="width: 100%">
                                      <tbody id="gl_table_jurnal"></tbody>
                                  </table>
                                  </div>

                                  </div>
                                  </div>


    




    
    

