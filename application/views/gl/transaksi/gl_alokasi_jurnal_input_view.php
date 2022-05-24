<script type="text/javascript">
$(document).ready(function(){
    
    var tokens   = '<?php echo $this->session->userdata('sess_token');?>';
    $("#no_ref").focus();
    loading();

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
    <input type="hidden" name="id_entrytemp" id="id_entrytemp">

<h3 class="heading">GL : Alokasi Jurnal</h3>

<div class="row-fluid">
  <div class="span12" >
      <div class="row-fluid">
      <div class="span4" >

            <div class="span4">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Tanggal</label>
                  <div class="input-prepend">
                  <input type="text" size="20" class="span9 fc-datepicker1" id="tanggal" name="tanggal"><span class="add-on" id="datepicker_pointer" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                 </div> 
                </div>
            </div>
          
            <div class="span8">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Keterangan</label>
                  <div class="input-prepend">
                  <input type="text" class="span17" id="keterangan" name="keterangan"></span>
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

          </div>

      </div>


      <div class="row-fluid">
     
      <h4 class="heading">Input Detail Transaksi</h4>

      <div class="row-fluid ">
      <div class="span12" >

            <div class="span2">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">No Acct</label>
                <input type="text" class="form-control clears span17" id="acctno" name="acctno" >
                <!-- placeholder="00.00.00.00.00"  class="maskmoney_coa"-->
                </div>
            </div>

            <div class="span2">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Acct Name</label>
                <input type="text" class="form-control teksbesar clears span17" id="acctname" readonly="" name="acctname">
                </div>
            </div>
          
            <div class="span4">
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
          
            <div class="span2">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Nominal</label>
                <input type="text" class="form-control maskmoney_money clears span17" id="dc_nominal" name="dc_nominal" placeholder="0">
                </div>
            </div>
          
          
            <div class="span1">
               <label for="demo-vs-definput" class="control-label" style="color:white">x</label>
                <button type="button" class="btn btn-primary pull-left" id="btn_simpan_trans_detail"> Simpan </button>
                <button type="button" class="btn btn-success pull-left" id="btn_update_trans_detail" style="display:none"> Update Trans Detail </button>
            </div>


      </div>
      </div>

      </div>
  </div>


  <div >
      <h3 class="heading pull-right"><span style="padding-top:10px;font-weight: bold;color:red" id="balance"></span></h3>

      <div class="row-fluid">
      <div class="span12" >
        <br>
      <table id="tabel_detail_transaksi_gl" class="table table-hover table-striped table-bordered" style="width: 100%">
                                      <thead>
                                          <tr>
                                              <th style="width: 5%">Tanggal</th>
                                              <th style="width: 5%">No.Acc</th>
                                              <th style="width: 5%">Nama Acc</th>
                                              <th style="width: 5%">Keterangan</th>
                                              <th style="width: 5%">Debet</th>
                                              <th style="width: 5%">Kredit</th>
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
  <div class="span9" >
  </div>
      <div class="span3" >

            <div class="span3" style="width: 50px">
            </div>

            <div class="span3" style="width: 50px">
            </div>

            <div class="span3" style="width: 50px">
                <img src="<?php echo base_url('assets/img-gif.gif');?>">
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




    
            





    




    
    

