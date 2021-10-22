<script type="text/javascript">
$(document).ready(function(){

    var tokens          = '<?php echo $tokens;?>';
    
    loading();

    $('#tabel_vouc_history').hide();
    $('#tabel_vouc_history').DataTable({ 
        "processing"    : true, //Feature control the processing indicator.
        "serverSide"    : true, //Feature control DataTables' server-side processing mode.
        "order"         : [], //Initial no order.
        "iDisplayLength": 100,
        "responsive"    : true,
        "autoWidth"     : false,
        rowReorder: true,
        "language"      : {
            searchPlaceholder: 'Cari',
            sSearch: '',
            lengthMenu: '_MENU_',
        },
        // Load data for the table's content from an Ajax source
        "ajax": {
            url     : base_url + 'gl/get_data_transaksi_gl_entry',
            type    :'POST',
            data    :{<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
            dataType: "json",
            beforeSend: function () {
                loadingPannel.show();
            },
            complete: function () {
                loadingPannel.hide();
                $('#tabel_vouc_history').show();
            }
        },
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

    edit_trans_gl = function(noid,ref){
        //id_rows,id_rows2
        getcontents('gl/transaksi_edit','<?php echo $tokens;?>',noid,ref); 

    }
    
    $("#cek_balance").click(function(){
        $.ajax({
            url       : base_url + 'gl/cek_balance_entry',
            type      : "post",
            dataType  : 'json',
            data      : {<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                    },
            success: function (response) {
                if(response.cr_ff == null){
                    swal("Info", "Maaf, Balance di Periode ini belum tersedia !", "info");
                }else{
                    swal("BALANCE","Rp. " + response.cr_ff, "info");
                    //alert('BALANCE :' + response.cr_ff);
                }
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
    });

    
});    

</script>

<style type="text/css">
th, td { 
    white-space: nowrap;
    }
</style>

    
    <div id="jCrumbs" class="breadCrumb module">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token');?>')"><i class="icon-home"></i></a>
                                </li>
                                <li>
                                    <a href="#">GL</a>
                                </li>
                                <li>
                                    <a href="#">Tabel Koreksi Transaksi</a>
                                </li>
                            </ul>
                        </div>




<div class="row-fluid">
        <div class="span12">
            
            <button class="btn btn-primary" id="cek_balance">Cek Balance</button>
            <br>
            <br>
            <div id="progress"></div>
            <div class="table-responsive">
            <table id="tabel_vouc_history" class="table table-hover table-striped table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 2%">No</th>
                        <th style="width: 10%">No.Ref</th>
                        <th style="width: 10%">Tanggal</th>
                        <th style="width: 5%">Periode</th>
                        <th style="width: 5%">Total Dr</th>
                        <th style="width: 5%">Total Cr</th>
                        <th style="width: 5%">Lokasi</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
</div>
  


    




    
    

