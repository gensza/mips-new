<script type="text/javascript">
$(document).ready(function(){
    var id_modal         = '<?php echo $id_modal;?>';
    var tokens           = '<?php echo $tokens;?>';
    var id_menu        = '<?php echo $id_row;?>';
    
    //loading();
    
    data_menu_sub = function(){

        $('#tabel_menu_sub').hide();
        $.ajax({ 
            url: base_url + 'menu/data_menu_sub',
            type: "post",
            data:{id_menu:id_menu,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
            dataType: "json",
            //async : 'false',
            success: function(result)
            {
                var data = [];
                for ( var i=0 ; i<result.length ; i++ ) {
                    var no = i+1;
                    var link_edit = "<a href='javascript:void(0)' onclick=edit_menu_sub("+result[i].id+")><span class='btn btn-primary btn-sm fa fa-pencil' title='Edit Modul Sub'></span></a>";
                    var link_hapus = "<a href='javascript:void(0)' onclick=hapus_menu_sub("+result[i].id+")><span class='btn btn-danger btn-sm fa fa-trash' title='Hapus Modul Sub'></span></a>";
                    
                    
                    var position;
                    if(result[i].position == 1){
                        position = '<span style="color:#923535">Menu Utama</span>';
                    }else{
                        position = '<span style="color:#42c697">Menu Sub</span>';
                    }
    
                    data.push([no,result[i].name,result[i].controller,position,result[i].have_child,link_edit,link_hapus]);
                }
                $('#tabel_menu_sub').DataTable({
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
                    responsive: true,
                    language: {
                      searchPlaceholder: 'Cari',
                      sSearch: '',
                      lengthMenu: '_MENU_',
                    },
                });
               
            },
            beforeSend: function () {
               // loadingPannel.show();
            },
            complete: function () {
               // loadingPannel.hide();
                $('#tabel_menu_sub').show();
            }
        });
        
        
        
        
    }
    data_menu_sub();
    
    
    edit_module_sub = function(id_menu_sub){
       
        //$('#'+id_modal).animate({ scrollTop: 0 }, 'slow');
        $("#btn_update_module_sub").show();
        $("#btn_simpan_module_sub").hide();
        
        $("#idsub").val(id_menu_sub);

        $.ajax({
                url       : base_url + 'menu/detail',
                type      : "post",
                dataType  : 'json',
                data      : {id : id_menu_sub,
                            <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                success: function (data) {
                        $("#nama").val(data.name);
                        $("#nama_controller").val(data.controller);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Command: toastr["error"]("Ajax Error !!", "Error");
            }

            });

    }
    
    hapus_menu_sub = function(id){
        
        swal({
            title: "Hapus Menu Sub Web ?",
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
                url       : base_url + 'menu/menu_sub_hapus',
                type      : "post",
                dataType  : 'json',
                data      : {id_menu_sub : id,
                            <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                success: function (response) {
                if(response == true){ 
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
            title: "Update Modul Sub ?",
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
                url       : base_url + 'module/menu_sub_update',
                type      : "post",
                dataType  : 'json',
                data      : {nama                   : $("#nama").val(),
                            nama_controller         : $("#nama_controller").val(),
                            id_menu_sub             : $("#idsub").val(),
                            <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                success: function (response) {
                if(response == true){ 
                        swal.close();
                        Command: toastr["success"]("Module Sub berhasil diupdate", "Berhasil");
                        data_module_sub();
                        $("#nama").val('');
                        $("#nama_controller").val('');
                        $("#btn_update_module_sub").hide();
                        $("#btn_simpan_module_sub").show();
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
    

    $("#btn_simpan_menu_sub").click(function(){
        swal({
            title: "Simpan Menu Sub Web ?",
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
                url       : base_url + 'menu/menu_sub_simpan',
                type      : "post",
                dataType  : 'json',
                data      : {nama                   : $("#nama").val(),
                            nama_controller         : $("#nama_controller").val(),
                            id_menu                 : id_menu,
                            <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                success: function (response) {
                if(response == true){ 
                        swal.close();
                        Command: toastr["success"]("Menu Sub berhasil disimpan", "Berhasil");
                        data_menu_sub();
                        $("#nama").val('');
                        $("#nama_controller").val('');
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

<div class="modal fade" id="<?php echo $id_modal;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header pd-y-20 pd-x-25">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Menu Sub</h6>
            <button type="button" class="close btn-clear" data-dismiss="modal" aria-label="Close" onclick="getcontent('menu','<?php echo $this->session->userdata('sess_token');?>')">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
            <div class="row" id="oketop">          
            <div class="col-md-4">   
                <input type="hidden" id="idsub" name="idsub" class="form-control clears">
                <div class="form-group">
                    <label for="demo-vs-definput" class="control-label">Nama Menu Sub</label>
                    <input type="text" id="nama" name="nama" class="form-control clears"/>
                </div>
                <div class="form-group">
                    <label for="demo-vs-definput" class="control-label">Controller</label>
                    <input type="text" id="nama_controller" name="nama_controller" class="form-control clears">
                </div>
            </div> 
            </div> 
            
            
                <button type="button" class="btn btn-info btn-sm" id="btn_simpan_menu_sub"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-success btn-sm" id="btn_update_menu_sub" style="display:none"><i class="fa fa-refresh"></i> Update</button>
            
            <hr>
            <table id="tabel_menu_sub" class="table table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Controller</th>
                        <th>Position</th>
                        <th>Have Child</th>
                        <th>#</th>
                        <th>#</th>
                    </tr>
                </thead>
            </table> 
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-refresh"></i> Tutup</button>
        </div>
    </div> 
    </div>
</div>

