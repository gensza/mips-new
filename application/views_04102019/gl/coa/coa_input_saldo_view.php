<script type="text/javascript">
$(document).ready(function(){
    var tokens      = '<?php echo $tokens;?>';
    var id_modal    = '<?php echo $id_modal;?>';
    var id_coa    = '<?php echo $id_row;?>';
    
    $("#idnoac").val(id_coa);
    $('.maskmoney').maskMoney({thousands:',', decimal:'.', precision:0,});
    
    $.ajax({
        url       : base_url + 'gl/matser_coa_detail',
        type      : "post",
        dataType  : 'json',
        data      : {id_coa       : id_coa,
                    <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                },
        success: function (res) {
                $("#noacc").val(res.kode_noac);
                $("#nama_acc").val(res.nama);
                $("#d_c_acc").val(res.type);
                $("#saldoawal_acc").val(res.balancedr);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Command: toastr["error"]("Ajax Error !!", "Error");
        }

    });
   
   
    $("#btn_simpan").click(function(){
        swal({
            title: "Update Saldo ?",
            text: "Jika ingin disimpan, silahkan klik button simpan",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonText: "Simpan",
            //confirmButtonColor: "#E73D4A"
            confirmButtonColor: "#286090"
        },
        function(){
            
            var form_data = new FormData($('#form_input')[0]);
            
            $.ajax({
                url       : base_url + 'gl/matser_update_saldo', 
                type      : "POST",
                dataType  : 'json',
                mimeType  : 'multipart/form-data',
                data            : form_data,
                contentType     : false,
                cache           : false,
                processData     : false,
                success     : function(data)
                {

                    if(data == true){
                        $('#'+id_modal).modal('hide');
                        swal.close();
                        Command: toastr["success"]("Saldo Berhasil diUpdate", "Berhasil");
                        getcontents('gl_coa/tabel','<?php echo $tokens;?>');   
                    }else{
                        Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                    }
                }
            });

        });
        
    });

});    

</script>




<div id="<?php echo $id_modal;?>" class="modal fade">
            <div class="modal-dialog" role="document">
              <div class="modal-content bd-0 tx-14">
                <div class="modal-header pd-y-50 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Input Saldo Awal</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
                  
                <form id="form_input" method=POST enctype='multipart/form-data'>
                <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">
                <input type="hidden" class="form-control" name="idnoac" id="idnoac">
                
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">No Acc</label>
                <input type="text" id="noacc" name="noacc" class="form-control" readonly="">
                </div>

                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Nama</label>
                <input type="text" id="nama_acc" name="nama_acc" class="form-control" readonly="">
                </div>

                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Saldo Awal</label>
                <input type="text" id="saldoawal_acc" name="saldoawal_acc" class="form-control maskmoney">
                </div>

                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">D/C</label>
                <select class="form-control" name="d_c_acc" id="d_c_acc">
                    <option value="0">-Pilih-</option>
                    <option value="D">Dr</option>
                    <option value="C">Cr</option>
                </select>
                </div>
                
                </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info" id="btn_simpan"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-refresh"></i> Tutup</button>
                </div>
              </div>
            </div><!-- modal-dialog -->
          </div><!-- modal -->

#