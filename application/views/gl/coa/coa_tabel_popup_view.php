<script type="text/javascript">
    $(document).ready(function() {
        var id_modal = '<?php echo $id_modal; ?>';
        var tokens = '<?php echo $tokens; ?>';


        $('#tabel_gl_coa').hide();
        $('#tabel_gl_coa').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "iDisplayLength": 10,
            "responsive": true,
            "autoWidth": false,
            rowReorder: true,
            "language": {
                searchPlaceholder: 'Cari',
                sSearch: '',
                lengthMenu: '_MENU_',
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                url: base_url + 'gl/gl_mastercode_popup',
                type: 'POST',
                data: {
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                beforeSend: function() {
                    //loadingPannel.show();
                },
                complete: function() {
                    //loadingPannel.hide();
                    $('#tabel_gl_coa').show();
                }
            },
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });


        selected_account = function(acct_no, acct_id) {

            $.ajax({
                url: base_url + 'gl/master_detail_account',
                type: "post",
                dataType: 'json',
                data: {
                    acct_no: acct_no,
                    acct_id: acct_id,
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(response) {
                    //noid,noac,nama
                    $("#acct").val(response.noac);
                    $("#acct_nama").val(response.nama);
                    //ini untuk di transaksi ghl
                    $("#acctno").val(response.noac);
                    $("#acctname").val(response.nama);
                    $('#' + id_modal).modal('hide');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Command: toastr["error"]("Ajax Error !!", "Error");
                }

            });

        }

    });
</script>

<div class="modal fade" id="<?php echo $id_modal; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-header modal-lg">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Tabel COA</h3>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table id="tabel_gl_coa" class="table table-hover table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 5%">Noac</th>
                        <th style="width: 40%">Nama</th>
                        <th style="width: 5%">Sbu</th>
                        <th style="width: 5%">Group</th>
                        <th style="width: 5%">Type</th>
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