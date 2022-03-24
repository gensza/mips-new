<script type="text/javascript">
    $(document).ready(function() {
        var id_modal = '<?php echo $id_modal; ?>';
        var tokens = '<?php echo $tokens; ?>';
        var noref = '<?php echo $noref; ?>';
        var alias = '<?php echo $alias; ?>';

        // console.log(id_modal);

        loading_coa();

        new_coa(noref, alias);



    });

    function new_coa(id_row, alias) {
        $('#tabel_new_coa').DataTable().destroy();
        $('#tabel_new_coa').DataTable({

            "fixedColumns": true,
            "fixedHeader": true,
            // "scrollY": 400,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('coa/get_new_coa') ?>",
                "type": "POST",
                data: {
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
                    id: id_row,
                    alias: alias,
                },
                dataType: "json",
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
            "language": {
                searchPlaceholder: 'Cari',
                sSearch: '',
                lengthMenu: '_MENU_',
                infoFiltered: ""
            },
        });

        var rel = setInterval(function() {
            $('#tabel_new_coa').DataTable().ajax.reload();
            clearInterval(rel);
        }, 100)

    }
</script>

<style type="text/css">
    .tables_nowrap {
        /*white-space: nowrap;*/
    }

    table#tabel_new_coa td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>

<div class="modal fade modal-lg modal-dialog-lg" id="<?php echo $id_modal; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3 style="color: '#00FF00';">Coa baru berhasil dibuat.</h3>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table id="tabel_new_coa" class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 5%; padding:10px">No</th>
                        <th style="width: 10%; padding:10px">Sbu</th>
                        <th style="width: 20%; padding:10px">Noac</th>
                        <th style="width: 25%; padding:10px">Nama</th>
                        <th style="width: 20%; padding:10px">Grup</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" style="background:white"><img src="<?php echo base_url('assets/img-gif.gif'); ?>" style="width:23px"></button> -->
        <!-- <button type="button" class="btn btn-success" id="btn_selesai_po"><i class="fa fa-refresh"></i> Selesai dan Simpan</button> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-refresh"></i> Close</button>
    </div>
</div>