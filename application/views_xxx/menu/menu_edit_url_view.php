<script type="text/javascript">
$(document).ready(function(){
    var id_modal         = '<?php echo $id_modal;?>';
    var tokens           = '<?php echo $tokens;?>';
    var id_menu        = '<?php echo $id_row;?>';
    
    $.ajax({
        url       : base_url + 'menu/detail',
        type      : "post",
        dataType  : 'json',
        data      : {id_menu : id_menu,
                    <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                },
        success: function (datas) {
                $("#nama").val(datas.name);
                $("#controller").val(datas.controller);
                $("#punya_sub").val(datas.have_child);
    },
    error: function(jqXHR, textStatus, errorThrown) {
        Command: toastr["error"]("Ajax Error !!", "Error");
    }

    });
    
    $("#btn_update").click(function(){
        
        
        swal({
            title: "Update Menu Web ?",
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
                url       : base_url + 'menu/update',
                type      : "post",
                dataType  : 'json',
                data      : {nama          : $("#nama").val(),
                            controller     : $("#controller").val(),
                            id_menu      : id_menu,
                            punya_sub      : $("#punya_sub").val(),
                            role_edit      : $("#role_edit").val(),
                            <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                success: function (response) {
                if(response == true){ 
                        $('#'+id_modal).modal('hide');
                        swal.close();
                        Command: toastr["success"]("Menu Web berhasil di Update", "Berhasil");
                        getcontents('menu','<?php echo $tokens;?>');  
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

<div id="<?php echo $id_modal;?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header pd-y-20 pd-x-25">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Menu Web</h6>
            <button type="button" class="close btn-clear" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <div class="modal-body">
          <div class="row">  
            <div class="col-md-12">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Nama Menu</label>
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
                    <small>Sumber : <a href="https://ionicons.com/cheatsheet.html" target="_blank">https://ionicons.com/cheatsheet.html</a></small>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Sub Modul</label>
                <input type="text" id="punya_sub" name="punya_sub" class="form-control" placeholder="Y / N">
                    <small>Punya Submenu ? jika tidak silahkan isi dengan 'N' , jika punya : 'Y'</small>
                </div>
            </div>
        </div>      
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-info" id="btn_update"><i class="fa fa-save"></i> Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-refresh"></i> Tutup</button>
      </div>
    </div>

  </div>
</div>

