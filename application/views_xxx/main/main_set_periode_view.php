<script type="text/javascript">
$(document).ready(function(){
    var tokens      = '<?php echo $tokens;?>';
    var id_modal    = '<?php echo $id_modal;?>';


    var c_tokens = '<?php echo $this->session->userdata("sess_token");?>';
    var c_usid   = '<?php echo $this->session->userdata("sess_id");?>';
    var c_active = '<?php echo $this->session->userdata("sess_aktif");?>';
   
   
    $("#btn_updates_periodes").click(function(){
        swal({
            title: "Ganti Periode ?",
            text: "Jika ingin diubah, silahkan klik button update",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonText: "Update",
            //confirmButtonColor: "#E73D4A"
            confirmButtonColor: "#286090"
        },
        function(){
            
            var form_data = new FormData($('#form_input_set_periode')[0]);
            
            $.ajax({
                url       : base_url + 'main/unset_periode', 
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
                        Command: toastr["success"]("Periode Berhasil Di Update", "Berhasil");
                        window.location.href = base_url+"index.aspx?TokEn="+c_tokens+"&IdUs="+c_usid+"&AkTif="+c_active+"";
                    }else{
                        Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                    }
                }
            });

        });
        
    });


                $('#tglsperiodes_new').datepicker({
                  changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'yymm',
                    onClose: function(dateText, inst) { 
                        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                    }
                });


});    

</script>

<style type="text/css">
    #popup_set_periode{
        width: 250px;
        text-align: center;
    }

    .ui-datepicker-calendar {
        display: none;
    }
</style>


<div id="<?php echo $id_modal;?>" class="modal fade">
            <div class="modal-dialog" role="document">
              <div class="modal-content bd-0 tx-14">
                <div class="modal-header pd-y-50 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Setting Periode</h6>
                </div>
                <div class="modal-body pd-25">
                  
                <form id="form_input_set_periode" method=POST enctype='multipart/form-data'>
                <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">
                
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Periode</label>
                <input type="text" id="tglsperiodes" name="tglsperiodes" class="form-control" readonly="" value='<?php echo $this->session->userdata('sess_periode');?>'>
                </div>

                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Ubah ke Periode yang diinginkan</label>
                <input type="text" id="tglsperiodes_new" name="tglsperiodes_new" placeholder="Masukan periode yang diinginkan" class="form-control">
                </div>

                </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info" id="btn_updates_periodes"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-refresh"></i> Tutup</button>
                </div>
              </div>
            </div><!-- modal-dialog -->
          </div><!-- modal -->
