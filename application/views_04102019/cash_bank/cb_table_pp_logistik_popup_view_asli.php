<script type="text/javascript">
$(document).ready(function(){
    var id_modal        = '<?php echo $id_modal;?>';
    var tokens          = '<?php echo $tokens;?>';
   

    $('#tabel_pp_logistik').hide();
    $('#tabel_pp_logistik').DataTable({ 
        "processing"    : true, //Feature control the processing indicator.
        "serverSide"    : true, //Feature control DataTables' server-side processing mode.
        "order"         : [], //Initial no order.
        "iDisplayLength": 10,
        "responsive"    : true,
        "autoWidth"     : false,
        'columnDefs': [{
            'targets': 0,
            'checkboxes': {
                'selectRow': true
            }
        }],
        'select': {
            'style': 'multi'
        },
        'fnCreatedRow': function(nRow, aData, iDataIndex) {
            $(nRow).attr('data-id', aData.DT_RowId); // or whatever you choose to set as the id
            $(nRow).attr('id', 'id_' + aData.DT_RowId); // or whatever you choose to set as the id
        },
        rowReorder: true,
        "language"      : {
            searchPlaceholder: 'Cari NO.PP / NO.REF PO',
            sSearch: '',
            lengthMenu: '_MENU_',
        },
        // Load data for the table's content from an Ajax source
        "ajax": {
            url     : base_url + 'cash_bank/get_list_pp_logistik',
            type    :'POST',
            data    :{<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
            dataType: "json",
            beforeSend: function () {
                //loadingPannel.show();
            },
            complete: function () {
                //loadingPannel.hide();
                $('#tabel_pp_logistik').show();
            }
        },
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

    /*$('#tabel_pp_logistik tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );
 
    $('#button').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    });*/
   

    selected_pp_logistik = function(pppo_id,pppo_no){

          $.ajax({
            url       : base_url + 'cash_bank/detail_pp_logistik',
            type      : "post",
            dataType  : 'json',
            data      : {pppo_id : pppo_id,
                        pppo_no : pppo_no,
                        <?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'
                    },
            success: function (response) {
                //noid,noac,nama
                $("#no_ref").val(response.nopp);
                $('#'+id_modal).modal('hide');

                $("#kepada").val(response.nama_supply);
                $("#transaksi_remark").val('PO '+response.ref_po+'-'+response.nama_supply);
                var vals = $("#jumlah").val(response.jumlah_f);
                buttonCode(response.jumlah_f);
                get_balance();


            },
            error: function(jqXHR, textStatus, errorThrown) {
                Command: toastr["error"]("Ajax Error !!", "Error");
            }

        });

    }

    
});    

</script>

<div class="modal fade" id="<?php echo $id_modal;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-header">
                                    <button class="close" data-dismiss="modal">×</button>
                                    <h3>Tabel PP Logistik</h3>
                                </div>
        <div class="modal-body">
            <div class="table-responsive">
            <table id="tabel_pp_logistik" class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 5%">NO PP</th>
                        <th style="width: 5%">NO PO</th>
                        <th style="width: 40%">REF PO</th>
                        <th style="width: 5%">TGL PP</th>
                        <th style="width: 5%">Supply</th>
                        <th style="width: 5%">Bayar</th>
                        <th style="width: 5%">Pilih</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-refresh"></i> Close</button>
        </div>
</div>

