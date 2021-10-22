<script type="text/javascript">
$(document).ready(function(){
    var id_modal         = '<?php echo $id_modal;?>';
    var tokens           = '<?php echo $tokens;?>';
    var id_saldo        = '<?php echo $id_row;?>';

    loading();

    var periodex = "<?php echo $this->session->userdata('sess_periode');?>";
    var tahun_periode = periodex.substr(0,4);
    var bulan_periode = periodex.substr(4,2);

            $.ajax({
                url       : base_url + 'cash_bank/saldo_awal_detail',
                type      : "post",
                dataType  : 'json',
                data      : {id_saldo : id_saldo,tahun_periode:tahun_periode,bulan_periode:bulan_periode,
                            <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                success: function (data) {
                        $("#acct_no_edit").val(data.ACCTNO);
                        $("#acct_nm_edit").val(data.ACCTNAME);
                        $("#acct_saldo").val(data.saldo_f);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Command: toastr["error"]("Ajax Error !!", "Error");
                },
                beforeSend: function () {
                    loadingPannel.show();
                },
                complete: function () {
                    loadingPannel.hide();
                }

            });
    
    hapus_module_sub = function(id){
        
        swal({
            title: "Hapus Modul Sub ?",
            text: "Jika ingin disimpan, silahkan klik button simpan",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonText: "Hapus",
            confirmButtonColor: "#E73D4A"
            //confirmButtonColor: "#286090"
        },
        function(){

            $.ajax({
                url       : base_url + 'module/module_sub_hapus',
                type      : "post",
                dataType  : 'json',
                data      : {id_module_sub           : id,
                            <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                success: function (response) {
                if(response == true){ 
                        $('#'+id_modal).modal('hide');
                        swal.close();
                        Command: toastr["success"]("Module Sub berhasil dihapus", "Berhasil");
                        data_module_sub();
                }else{
                    Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                } 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Command: toastr["error"]("Ajax Error !!", "Error");
            }

            });

        }); 
        
    }
    
    $("#btn_update_module_sub").click(function(){
        
        
        swal({
            title: "Yakin Ubah Saldo Awal ?",
            text: "Jika yakin, silahkan klik button update",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonText: "Update",
            //confirmButtonColor: "#E73D4A"
            confirmButtonColor: "#286090"
        },
        function(){

            $.ajax({
                url       : base_url + 'cash_bank/saldo_awal_update',
                type      : "post",
                dataType  : 'json',
                data      : {id_saldo       : id_saldo,
                            tahun           : tahun_periode,
                            bulan           : bulan_periode,
                            saldo           : $("#acct_saldo").val(),
                            <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                success: function (response) {
                if(response == true){ 
                        $('#'+id_modal).modal('hide');
                        swal.close();
                        Command: toastr["success"]("Saldo berhasil diubah", "Berhasil");
                        getcontents('cash_bank/saldo_awal','<?php echo $this->session->userdata('sess_token');?>');
                }else{
                    Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                } 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Command: toastr["error"]("Ajax Error !!", "Error");
            }

            });

        }); 
    });
    

$('.maskmoney_money_edit').maskMoney({thousands:',', decimal:'.', precision:0,});
   
   
});    

</script>


<div class="modal hide" id="<?php echo $id_modal;?>" style="width:auto">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal">×</button>
                                    <h3>Saldo Awal Edit</h3>
                                </div>
                                <div class="modal-body">  
                                    <input type="hidden" id="idsub" name="idsub" class="form-control">
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">No Account</label>
                                        <input type="text" id="acct_no_edit" name="acct_no_edit" class="form-control" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Nama Account</label>
                                        <input type="text" id="acct_nm_edit" name="acct_nm_edit" readonly class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="demo-vs-definput" class="control-label">Nominal</label>
                                        <input type="text" id="acct_saldo" name="acct_saldo" class="form-control maskmoney_money_edit">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success btn-sm" id="btn_update_module_sub"><i class="fa fa-refresh"></i> Update</button>
                                    <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                                </div>
                            </div>


