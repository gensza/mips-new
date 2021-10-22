<script type="text/javascript">
$(document).ready(function(){
    
    var tokens   = '<?php echo $this->session->userdata('sess_token');?>';
    
    loading();
    
$('.dataTables_length').addClass('bs-select');

    var data_role = function(){
        
        $.ajax({ 
            url: base_url + 'role/data',
            type: "post",
            data:{<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
            dataType: "json",
            async : 'false',
            success: function(result)
            {
                var data = [];
                for ( var i=0 ; i<result.length ; i++ ) {
                    var no = i+1;
                    var baseurl = '<?php echo base_url();?>';
                    
                    var link_edit  = "<div class='btn btn-default btn-sm' title='Akses' onclick=\"getpopup('role/edit','"+tokens+"','popupedit','"+result[i].id+"');\" ><i class='splashy-pencil'></i></div>";    
                    var link_akses = "<div class='btn btn-info btn-sm' title='Akses' onclick=\"getpopup('role/permission','"+tokens+"','popupedit','"+result[i].id+"');\" ><i class='splashy-view_outline_detail'></i></div>"; 
                    var link_hapus  = "<div class='btn btn-default' title='Hapus' onclick=\"hapus('"+result[i].id+"');\"><i class='splashy-gem_remove'></i></div>";  
                    
                    data.push([no,result[i].nama,link_edit,link_hapus,link_akses]);

                }

                $('#tabel_role').DataTable({
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
                    }

                });

                /*$('#tabel_role').DataTable({
                    aaData                : data,
                    "sDom": "<'row'<'span6'<'dt_actions'>l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
                    "sPaginationType": "bootstrap_alt",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ records per page"
                    }
                });*/
               
            },
            beforeSend: function () {
                loadingPannel.show();
            },
            complete: function () {
                loadingPannel.hide();
                $('#tabel_role').show();
            }
        });
    }
    data_role();
    
    //dataTables_paginate
    hapus = function(id_role){
        alert(id_role)
    }
    
    $("#btn_simpan").click(function(){
        
        swal({
            title: "Simpan Data Role ?",
            text: "Silahkan periksa kembali harga yang ingin disimpan.",
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
                url       : base_url + 'role/simpan',
                type      : "post",
                dataType  : 'json',
                data      : {nama : $("#nama").val(), <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
                success: function (response) {
                    if(response == true){
                        swal.close();
                        Command: toastr["success"]("Data Role berhasil disimpan", "Berhasil");
                        data_role();
                        $("#nama").val('');
                    }else{
                        Command: toastr["error"]("Response Ajax Error !!", "Error");
                    }  
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Command: toastr["error"]("Ajax Error !!", "Error");
                }
            });
            
        });
        
    });

    $("#tabel_role").addClass('pagination');
    
   
});    
</script>




    
                    <nav>
                        <div id="jCrumbs" class="breadCrumb module">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token');?>')"><i class="icon-home"></i></a>
                                </li>
                                <li>
                                    <a href="#">Pengaturan</a>
                                </li>
                                <li>
                                    <a href="#">Role</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    
                    
                    <div class="row-fluid">
                        <div class="span3">
                            <h3 class="heading">Form Input Role</h3>
                            <div class="form-group">
                                <label for="demo-vs-definput" class="control-label">Nama Role</label>
                                <input type="text" id="nama" name="nama" class="form-control maskmoney">
                            </div>
                            <hr>
                            <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_simpan"><i class="fa fa-save"></i> Simpan </button>
                        </div>
                        <div class="span9">
                            <h3 class="heading">Data Role</h3>
                            <div class="table-responsive">
                            <table id="tabel_role" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Role</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                    <th>Akses</th>
                                </tr>
                                </thead>
                            </table> 
                            </div>
                        </div>
                    </div>
                        
              

