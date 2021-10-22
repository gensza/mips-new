<script type="text/javascript">
$(document).ready(function(){
    
    var tokens   = '<?php echo $this->session->userdata('sess_token');?>';
    
    loading();
    
    var data_module = function(){
        $('#tabel_module').hide();
        $.ajax({ 
            url: base_url + 'module/data',
            type: "post",
            data:{<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
            dataType: "json",
            async : 'false',
            success: function(result)
            {
                var data = [];
                for ( var i=0 ; i<result.length ; i++ ) {
                    var no = i+1;
                    var link_edit; 
                    if(result[i].position == 1 && result[i].have_child == 'Y'){
                        link_edit  = "<span onclick=\"getpopup('module/edit','"+tokens+"','popupedit','"+result[i].id+"');\" class='btn btn-warning btn-sm' title='Tambah Modul Sub'><i class='splashy-folder_classic_add'></i></span>";
                    }else if(result[i].position == 2 && result[i].have_child == 'Y'){
                        link_edit  = "<span onclick=\"getpopup('module/edit_sub','"+tokens+"','popupedit','"+result[i].id+"');\" class='btn btn-info btn-sm' title='Tambah Modul Sub Sub'><i class='splashy-folder_modernist_add'></i></span>";
                    }else{
                        link_edit  = "";
                    }
                    
                    var link_edit_2  = "<span class='btn btn-default btn-sm' title='Edit Modul' onclick=\"getpopup('module/edit2','"+tokens+"','popupedit','"+result[i].id+"');\"><i class='splashy-pencil'></i></span>";
                    
                    var link_hapus = "<span class='btn btn-default btn-sm' title='Hapus Modul' onclick=hapus_module("+result[i].id+")><i class='splashy-gem_remove'></i></span></span>";
                    
                    var position;
                    if(result[i].position == 1){
                        position = '<span style="color:#923535">Menu Utama</span>';
                    }else if(result[i].position == 2){
                        position = '<span style="color:#42c697">Menu Sub</span>';
                    }else{
                        position = '<span style="color:orange">Menu Sub Sub</span>';
                    }
    
                    data.push([no,result[i].id,result[i].name,result[i].icon,result[i].controller,position,result[i].have_child,result[i].parent,result[i].line,link_edit,link_edit_2,link_hapus]);
        
                }
                $('#tabel_module').DataTable({
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
               
            },
            beforeSend: function () {
                loadingPannel.show();
            },
            complete: function () {
                loadingPannel.hide();
                $('#tabel_module').show();
            }
        });
    }
    data_module();
    
   
    hapus_module = function(id){
        
        swal({
            title: "Hapus Modul ?",
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
                        swal.close();
                        Command: toastr["success"]("Module berhasil dihapus", "Berhasil");
                        data_module();
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
                                    <a href="#">Data Modul</a>
                                </li>
                            </ul>
                        </div>
                    </nav>

    <div class="row-fluid">
        <div class="span12">
        <h3 class="heading">Data Module</h3>

         <a href="javascript:void(0)" onclick="getpopup('module/tambah','<?php echo $this->session->userdata('sess_token');?>')"><i class="icon-plus"></i> Tambah Module</a>

        <table id="tabel_module" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Icon</th>
                        <th>Controller</th>
                        <th>Position</th>
                        <th>Have Child</th>
                        <th>Parent</th>
                        <th>Line</th>
                        <th style="width: 10%">Menu&Submenu</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    




    
    

