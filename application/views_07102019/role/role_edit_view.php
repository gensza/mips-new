<script type="text/javascript">
$(document).ready(function(){
    var tokens      = '<?php echo $tokens;?>';
    var id_modal    = '<?php echo $id_modal;?>';
    var id_role    = '<?php echo $id_row;?>';
    
    $("#idrole").val(id_role);
    
    $.ajax({
        url       : base_url + 'role/detail',
        type      : "post",
        dataType  : 'json',
        data      : {id_role       : id_role,
                    <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                },
        success: function (res) {
                $("#nama_role").val(res.nama);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Command: toastr["error"]("Ajax Error !!", "Error");
        }

    });
   
   
    $("#btn_simpan_role").click(function(){
        swal({
            title: "Update Nama Role ?",
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
                url       : base_url + 'role/role_update', 
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
                        Command: toastr["success"]("Nama Role Akses  Berhasil Di Update", "Berhasil");
                        getcontents('role','<?php echo $tokens;?>');   
                    }else{
                        Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                    }
                }
            });

        });
        
    });

});    

</script>

<div class="modal hide" id="<?php echo $id_modal;?>">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal">×</button>
                                    <h3>Edit Role</h3>
                                </div>
                                <div class="modal-body">
                                    <form id="form_input" method=POST enctype='multipart/form-data'>
                <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <input type="hidden" class="form-control" name="idrole" id="idrole">
                
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Nama Role</label>
                <input type="text" id="nama_role" name="nama_role" class="form-control">
                </div>
                </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" id="btn_simpan_role"><i class="fa fa-save"></i> Update</button>
                                    <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                                </div>
                            </div>

