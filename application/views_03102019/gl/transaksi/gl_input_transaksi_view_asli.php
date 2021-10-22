<script type="text/javascript">
$(document).ready(function(){
    
    var tokens   = '<?php echo $this->session->userdata('sess_token');?>';

    loading();

    $("#btn_simpan_detail").click(function(){
      simpan_trans_details();   
    });


    $('.fc-datepicker1').datepicker({
          showOtherMonths: true,
          selectOtherMonths: true,
          dateFormat: 'dd-mm-yy'
        });


    document.getElementById("acctno").addEventListener("keyup", function(event) {
          event.preventDefault();
          if (event.keyCode === 13) {
              getpopup('gl_coa/tabel_coa_popup','<?php echo $this->session->userdata('sess_token');?>','popupedit','1');
          }
      });

    simpan_trans_details = function(){

  if($("#no_ref").val() == ''){
        Command: toastr["error"]("Silahkan masukan nomor ref !", "Info, Ada kolom yang masih kosong !");
        $("#no_ref").focus(); 
    }else if($("#tanggal").val() == 0){
      Command: toastr["error"]("Silahkan masukan tanggal !", "Info, Ada kolom yang masih kosong !");
        $("#tanggal").focus(); 
    }else{

            var form_data = new FormData($('#form_input_transaksi')[0]);

            $.ajax({
                url             : base_url + 'gl/transaksi_simpan', 
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
                        Command: toastr["success"]("Transaksi GL detail berhasil disimpan", "Berhasil");
                        //$('#divisi_v').val(0);
                        //$('.clears').val('');
                        //table_caba_detail();
                        //get_balance();

                    }else{
                        Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                    } 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
            }

            });
    }

 }

  $('.teksbesar').keyup(function(){
    this.value = this.value.toUpperCase();
  });

  $('.maskmoney_coa').mask('00.00.00.00.00', {reverse: true});

  $('.maskmoney_money').maskMoney({thousands:',', decimal:'.', precision:2,});


  table_caba_detail = function(){
        
        $.ajax({ 
            url: base_url + 'gl/transaksi_data_detail',
            type: "post",
            data:{kode_sementara : $("#kode_sementara").val(),
              <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
            dataType: "json",
            async : 'false',
            success: function(result)
            {
                var data = [];
                for ( var i=0 ; i<result.length ; i++ ) {
                    
                    data.push([result[i].KODE_PT,result[i].ACCTNO,result[i].DESCRIPT,result[i].REMARKS,result[i].debit_f,result[i].credit_f]);

                }
                $('#tabel_detail_transaksi_gl').DataTable({
                    //"bJQueryUI"     : true,
                    data                : data,
                    deferRender         : true,
                    processing          : true,
                    ordering            : true,
                    retrieve            : false,
                    paging              : true,
                    deferLoading        : 57,
                    bDestroy            : true,
                    autoWidth           : false,
                    bFilter             : true,
                    iDisplayLength      : 10,
                    //responsive: true,
                    language: {
                      searchPlaceholder: 'Cari',
                      sSearch: '',
                      lengthMenu: '_MENU_',
                    },
                });
               
            },
            beforeSend: function () {
                loadingPannel.show();
            },
            complete: function () {
                loadingPannel.hide();
                $('#tabel_detail_transaksi_gl').show();
            }
        });
    
 }
 table_caba_detail();


});    
</script>
   
<?php 
  //ini kode random untuk token
        $token = "";
        $codeAlphabet = "334448795225885";
        $codeAlphabet.= "673431639981256";
        $codeAlphabet.= "044224123456789";

        $max = strlen($codeAlphabet) - 1;
        for ($i=0; $i < 6; $i++) {
            $token .= $codeAlphabet[mt_rand(0, $max)];
        } 
        //ini kode random untuk token
?>

<form id="form_input_transaksi"  method=POST enctype='multipart/form-data'>
    <input type="hidden" name="kode_sementara" id="kode_sementara" value="<?php echo $token;?>">
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
                                    <a href="#">Input Transaksi</a>
                                </li>
                            </ul>
                        </div>
                    </nav>


<div class="row-fluid">
  <div class="span6" >
      <h3 class="heading">Input Transaksi</h3>

      <div class="row-fluid">
      <div class="span12" >

            <div class="span4">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Ref #</label>
                    <input type="text" class="form-control teksbesar span17" name="no_ref" id="no_ref">
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
      </div>

      <div class="row-fluid">
     


      <h4 class="heading">Input Detail Transaksi</h4>

      <div class="row-fluid ">
      <div class="span12" >

            <div class="span2">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Divisi</label>
                <select class="form-control span17" name="divisi_v" id="divisi_v">
                                            <option value="0">-Pilih-</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="06">06</option>
                                        </select>
                </div>
            </div>

            <div class="span3">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">TM/TBM</label>
                <select class="form-control span17" name="tm_tbm" id="tm_tbm">
                                            <option value="0">-Pilih-</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="06">06</option>
                                        </select>
                </div>
            </div>


            <div class="span4">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Adf/Unit</label>
                <select class="form-control span17" name="adf_unit" id="adf_unit">
                                            <option value="0">-Pilih-</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="06">06</option>
                                        </select>
                </div>
            </div>

            <div class="span3">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Tahun Tanam</label>
                <select class="form-control span17" name="tahun_tanam" id="tahun_tanam">
                                            <option value="0">-Pilih-</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="06">06</option>
                                        </select>
                </div>
            </div>


      </div>
      </div>



      <div class="row-fluid">
      <div class="span12" >

            <div class="span3">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">No Acct</label>
                <input type="text" placeholder="00.00.00.00.00" class="form-control maskmoney_coa clears span17" id="acctno" name="acctno" >
                </div>
            </div>

            <div class="span9">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Acct Name</label>
                <input type="text" class="form-control teksbesar clears span17" id="acctname" readonly="" name="acctname">
                </div>
            </div>


      </div>
      </div>

      <div class="row-fluid">
      <div class="span12" >

            <div class="span12">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Deskripsi</label>
                <input type="text" class="form-control teksbesar clears span23" id="deskripsi" name="deskripsi">
                </div>
            </div>

      </div>
      </div>


      <div class="row-fluid ">
      <div class="span12" >

            <div class="span3">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">DC</label>
                <select class="form-control span17" name="dc" id="dc">
                                            <option value="0">-Pilih-</option>
                                            <option value="D">Dr</option>
                                            <option value="C">Cr</option>
                                        </select>
                </div>
            </div>

            <div class="span3">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Kurs</label>
                <select class="form-control span17" name="dc_kurs" id="dc_kurs">
                                            <option value="0">-Pilih-</option>
                                            <option value="01">Rp</option>
                                            <option value="02">$</option>
                                        </select>
                </div>
            </div>


            <div class="span6">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Nominal</label>
                <input type="text" class="form-control maskmoney_money clears span17" id="dc_nominal" name="dc_nominal">
                </div>
            </div>


            <div class="span2">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Nominal</label>
                <input type="text" class="form-control maskmoney_money clears span17" id="dc_nominal" name="dc_nominal">
                </div>
            </div>
      </div>
      </div>

      	<!-- footer -->
		<div class="row-fluid">
		<div class="span12">
		<div class="formSep">

		</div>

		<button type="button" class="btn btn-primary pull-right" id="btn_simpan_detail"> Simpan Trans Detail </button>
		</div>
		</div>
		<!-- footer --> 


      </div>
  </div>


  <div class="span6">
      <h3 class="heading pull-left">Table Transaksi Detail</h3>
      <h3 class="heading pull-right"><span style="font-weight: bold;color:red" id="balance"></span></h3>

      <div class="row-fluid">
      <div class="span12" >

      <table id="tabel_detail_transaksi_gl" class="table table-hover table-striped table-bordered" style="width: 100%">
                                      <thead>
                                          <tr>
                                              <th style="width: 5%">SBU</th>
                                              <th style="width: 5%">Acct</th>
                                              <th style="width: 40%">Nama Account</th>
                                              <th style="width: 5%">Keterangan</th>
                                              <th style="width: 5%">Debit</th>
                                              <th style="width: 5%">Kredit</th>
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

<button type="button" class="btn btn-danger pull-right" id="btn_simpan"> Simpan </button>

</div>
</div>
<!-- footer -->                            

  </div>





</div>

</form>




    
            





    




    
    

