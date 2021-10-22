
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
      var module    = $("#moduleid").val();
        

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

      //window.open(base_url+'cetak/cash_bank_lap_register/'+tgl_start+'/'+tgl_end+'');

        var url = '<?php echo base_url('cetak/gl_lap_module/');?>';
        
        newwindow=window.open(url+'/'+periode_terkini+'/'+sf_tgl_start+'/'+sf_tgl_end+'/'+divstart+'/'+divisiend+'/'+module,'Laporan GL Module','_blank');
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

    if($('#chx_periode').val() == 1){

      //$("#tbl_vouc_regis").show();
      $("#btn_cetak").show();
      $("#gl_table_jurnal").empty('');
      $.ajax({ 
                url: base_url + 'gl/report_module_view',
                type: "post",
                data:{tgl_start     : $("#tgl_start").val(),
                    tgl_end         : $("#tgl_end").val(),
                    periode_terkini : $("#chx_periode").val(),
                    divisi_start    : $("#divisi_start").val(),
                    divisi_end      : $("#divisi_end").val(),
                    module        : $("#moduleid").val(),
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
                      url: base_url + 'gl/report_module_view',
                      type: "post",
                      data:{tgl_start : $("#tgl_start").val(),
                      tgl_end         : $("#tgl_end").val(),
                      divisi_start    : $("#divisi_start").val(),
                      divisi_end      : $("#divisi_end").val(),
                      module     : $("#moduleid").val(),
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

</style>

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
                                    <a href="#">Report GL</a>
                                </li>
                            </ul>
                        </div>
                    </nav>

  <div class="row-fluid">

    <h3 class="heading">Laporan GL</h3>

    <div class="row">

      <div class="col-sm-12">
        <ul class="dshb_icoNav clearfix">
          <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/img_report.png');?>)">Jurnal</a></li>
          <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/img_report.png');?>)">Buku Besar</a></li>  
          <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/img_report.png');?>)">Trial Balance</a></li>
          <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/img_report.png');?>)">Rugi Laba</a></li>
          <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/img_report.png');?>)">Neraca</a></li>
          <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/img_report.png');?>)">Posting Harian</a></li>
        </ul>
      </div>
    </div>
  </div>

    <div class="row-fluid">

    </div>


    




    
    

