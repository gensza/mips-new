<script type="text/javascript">
$(document).ready(function(){
    
    var tokens   = '<?php echo $this->session->userdata('sess_token');?>';
    
    loading();

    var data_berita = function(){
        $('#tabel_berita').hide();
        $.ajax({ 
            url: base_url + 'berita/data',
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
                    var link_print = "<a href='"+baseurl+"cetak/cetak_aksesoris_label/"+result[i].kode+"' target='_blank'><span class='btn btn-success btn-sm fa fa-print' title='Print Label Aksesoris'></span></a>";


                    data.push([no,result[i].judul,result[i].nama_pengguna,result[i].created_at,'<div style="width:100%;text-align:center">'+link_edit+'</div>']);
                }
                $('#tabel_berita').DataTable({
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
                $('#tabel_berita').show();
            }
        });
    }
    data_berita();
    
   
   
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
            <li class="breadcrumb-item active" aria-current="page">Data News & Event</li>
        </ol>
    <h6 class="slim-pagetitle">News & Event</h6>
    </div>


    <div class="section-wrapper">
          <label class="section-title">Data News & Event</label>
          <p class="mg-b-20 mg-sm-b-40">berikut adalah data News & Event yang tersimpan dalam database, untuk pencarian data silahkan pada kolom " Cari "</p>
          
          <p class="br-section-text"><button class="btn btn-info btn-sm" onclick="getpopup('berita/tambah','<?php echo $this->session->userdata('sess_token');?>','popup_tambah')"><i class="fa fa-plus-circle"></i> Tambah News & Event </button></p>
          
          <div class="table-wrapper">
            <table id="tabel_berita" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>User Posting</th>
                        <th>Tgl Posting</th>
                        <th>Edit</th>
                    </tr>
                </thead>
            </table>
          </div>
    </div>


    