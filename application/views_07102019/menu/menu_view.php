<script type="text/javascript">
$(document).ready(function(){
    
    var tokens   = '<?php echo $this->session->userdata('sess_token');?>';
    
    loading();
    
    var data_module = function(){
        $('#tabel_menu').hide();
        $.ajax({ 
            url: base_url + 'menu/data',
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
                        link_edit  = "<a href='javascript:void(0)' onclick=\"getpopup('menu/edit','"+tokens+"','popupedit','"+result[i].id+"');\"><span class='btn btn-success btn-sm fa fa-plus' title='Tambah Modul'></span></a>";
                    }else{
                        link_edit  = "";
                    }
                    
                    var link_edit_2  = "<a href='javascript:void(0)' onclick=\"getpopup('menu/edit2','"+tokens+"','popupedit','"+result[i].id+"');\"><span class='btn btn-info btn-sm fa fa-pencil' title='Edit Modul'></span></a>";
                    
                    var link_hapus = "<a href='javascript:void(0)' onclick=hapus_menu("+result[i].id+")><span class='btn btn-danger btn-sm fa fa-trash' title='Hapus Modul'></span></a>";
                    
                    var position;
                    if(result[i].position == 1){
                        position = '<span style="color:#923535">Menu Utama</span>';
                    }else{
                        position = '<span style="color:#42c697">Menu Sub</span>';
                    }
    
                    data.push([no,result[i].id,result[i].name,result[i].controller,position,result[i].have_child,result[i].parent,result[i].sequence,link_edit,link_edit_2,link_hapus]);
        
                }
                $('#tabel_menu').DataTable({
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
                loadingPannel.show();
            },
            complete: function () {
                loadingPannel.hide();
                $('#tabel_menu').show();
            }
        });
    }
    data_module();
    
   
    hapus_menu = function(id){
        
        swal({
            title: "Hapus Menu ?",
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
                url       : base_url + 'menu/hapus',
                type      : "post",
                dataType  : 'json',
                data      : {id_menu : id,
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
    
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token');?>')">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Menu</li>
        </ol>
    <h6 class="slim-pagetitle">Menu</h6>
    </div>


    <div class="section-wrapper">
          <label class="section-title">Data Menu</label>
          <p class="mg-b-20 mg-sm-b-40">berikut adalah data modul yang tersimpan dalam database, untuk pencarian data silahkan pada kolom " Cari "</p>
          
          <p class="br-section-text"><button class="btn btn-info btn-sm" onclick="getpopup('menu/tambah','<?php echo $this->session->userdata('sess_token');?>','popup_tambah')"><i class="fa fa-plus-circle"></i> Tambah Menu Web </button></p>
          
          <div class="table-wrapper">
            <table id="tabel_menu" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Controller</th>
                        <th>Position</th>
                        <th>Have Child</th>
                        <th>Parent</th>
                        <th>Seq</th>
                        <th>#</th>
                        <th>#</th>
                        <th>#</th>
                    </tr>
                </thead>
            </table>
          </div>
    </div>
    


    




    
    

