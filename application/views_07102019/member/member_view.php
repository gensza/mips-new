<script type="text/javascript">
$(document).ready(function(){
    
    var tokens   = '<?php echo $this->session->userdata('sess_token');?>';
    
    loading();

    var data_member = function(){
        $('#tabel_member').hide();
        $.ajax({ 
            url: base_url + 'member/data',
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
                    
                    var link_edit = "<a href='javascript:void(0)' onclick=\"getpopup('berita/edit','"+tokens+"','popupedit','"+result[i].id+"');\"><span class='btn btn-info btn-sm fa fa-edit' title='Edit Aksesoris'></span></a>";
                  
                    data.push([no,result[i].nama,result[i].email,result[i].nohp,result[i].perusahaan,result[i].created_at,'<div style="width:100%;text-align:center">'+link_edit+'</div>']);
                }
                $('#tabel_member').DataTable({
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
                loadingPannel.show();
            },
            complete: function () {
                loadingPannel.hide();
                $('#tabel_member').show();
            }
        });
    }
    data_member();
    
   
   
    hapus = function(id_produk){
        swal({
            title: "Hapus Produk ?",
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
                url       : base_url + 'produk/hapus',
                type      : "post",
                dataType  : 'json',
                data      : {id_produk:id_produk,
                            <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                success: function (response) {
                if(response == true){  
                        swal.close();
                        Command: toastr["success"]("Produk berhasil dihapus", "Berhasil");
                        data_produk();
                }else{
                    Command: toastr["error"]("Hapus error, data tidak berhasil dihapus", "Error");
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
            <li class="breadcrumb-item active" aria-current="page">Data Member</li>
        </ol>
    <h6 class="slim-pagetitle">Member</h6>
    </div>


    <div class="section-wrapper">
          <label class="section-title">Data Member</label>
          <p class="mg-b-20 mg-sm-b-40">berikut adalah data member yang tersimpan dalam database, untuk pencarian data silahkan pada kolom " Cari "</p>
          
          <p class="br-section-text"><button class="btn btn-info btn-sm" onclick="getpopup('member/tambah','<?php echo $this->session->userdata('sess_token');?>','popup_tambah')"><i class="fa fa-plus-circle"></i> Tambah Member </button></p>
          
          <div class="table-wrapper">
            <table id="tabel_member" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Hp</th>
                        <th>Perusahaan</th>
                        <th>Tgl Daftar</th>
                        <th>Edit</th>
                    </tr>
                </thead>
            </table>
          </div>
    </div>


    