<script type="text/javascript">
$(document).ready(function(){
    var id_modal         = '<?php echo $id_modal;?>';
    var tokens           = '<?php echo $tokens;?>';
    var id_module        = '<?php echo $id_row;?>';


    $.ajax({
        url       : base_url + 'module/detail',
        type      : "post",
        dataType  : 'json',
        data      : {id : id_module,
                    <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                },
        success: function (data) {
                $("#nama").val(data.name);
                $("#controller").val(data.controller);
                $("#icon").val(data.icon);
                $("#punya_sub").val(data.have_child);
    },
    error: function(jqXHR, textStatus, errorThrown) {
        Command: toastr["error"]("Ajax Error !!", "Error");
    }

    });
    
    $("#btn_update").click(function(){
        
        
        swal({
            title: "Update Modul ?",
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

            $.ajax({
                url       : base_url + 'module/module_update',
                type      : "post",
                dataType  : 'json',
                data      : {nama          : $("#nama").val(),
                            controller     : $("#controller").val(),
                            id_module      : id_module,
                            icon           : $("#icon").val(),
                            punya_sub      : $("#punya_sub").val(),
                            <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                success: function (response) {
                if(response == true){ 
                        $('#'+id_modal).modal('hide');
                        swal.close();
                        Command: toastr["success"]("Module berhasil diupdate", "Berhasil");
                        getcontents('module','<?php echo $tokens;?>');  
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
    

});    

</script>

<div class="modal hide" id="<?php echo $id_modal;?>">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal">×</button>
                                    <h3>Modul Sub</h3>
                                </div>
                                <div class="modal-body">  
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="demo-vs-definput" class="control-label">Nama Modul</label>
                                        <input type="text" id="nama" name="nama" class="form-control">
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="demo-vs-definput" class="control-label">Nama Controller</label>
                                    <input type="text" id="controller" name="controller" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="demo-vs-definput" class="control-label">Masukan Icon</label>
                                        <input type="text" id="icon" name="icon" class="form-control" placeholder="ios-namaicon">
                                        <br>
                                        <small style="font-size: 10px">Sumber : <a href="https://www.iconfinder.com/iconsets/splashyIcons" target="_blank">https://www.iconfinder.com/iconsets/splashyIcons</a></small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="demo-vs-definput" class="control-label">Sub Modul</label>
                                    <input type="text" id="punya_sub" name="punya_sub" class="form-control" placeholder="Y / N">
                                    <br>
                                        <small style="font-size: 10px">Punya Submenu ? jika tidak silahkan isi dengan 'N' , jika punya : 'Y'</small>
                                    </div>
                                </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" id="btn_update"><i class="ft-save"></i> Update</button>
                                    <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                                </div>
                            </div>


