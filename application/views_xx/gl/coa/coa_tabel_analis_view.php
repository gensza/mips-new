<script type="text/javascript">
$(document).ready(function(){
    
    var tokens   = '<?php echo $this->session->userdata('sess_token');?>';
    
    loading();

    $('#tabel_gl_coa').hide();
    $('#tabel_gl_coa').DataTable({ 
        "processing"    : true, //Feature control the processing indicator.
        "serverSide"    : true, //Feature control DataTables' server-side processing mode.
        "order"         : [], //Initial no order.
        "iDisplayLength": "100",
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
            url     : base_url + 'gl_analis/ajax_list',
            type    :'POST',
            data    :{<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
            dataType: "json",
            beforeSend: function () {
                loadingPannel.show();
            },
            complete: function () {
                loadingPannel.hide();
                $('#tabel_gl_coa').show();
            }
        },
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });



   
});    
</script>
    
    <div id="jCrumbs" class="breadCrumb module">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token');?>')"><i class="icon-home"></i></a>
                                </li>
                                <li>
                                    <a href="#">GL</a>
                                </li>
                                <li>
                                    <a href="#">Data COA</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
<div class="row-fluid">
                        <div class="span12">

            <table id="tabel_gl_coa" class="table table-hover table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 5%">Noac</th>
                        <th style="width: 40%">Nama</th>
                        <th style="width: 5%">Sbu</th>
                        <th style="width: 5%">Group</th>
                        <th style="width: 5%">Type</th>
                        <th style="width: 5%">Tahun</th>
                    </tr>
                </thead>
            </table>

                        </div>
</div>
  


    




    
    

