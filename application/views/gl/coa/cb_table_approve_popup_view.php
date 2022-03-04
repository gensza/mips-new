<script type="text/javascript">
    $(document).ready(function() {
        var id_modal = '<?php echo $id_modal; ?>';
        var tokens = '<?php echo $tokens; ?>';
        var id_row = '<?php echo $id_row; ?>';



        $('#tabel_approved').DataTable().destroy();
        $('#tabel_approved').DataTable({

            "fixedColumns": true,
            "fixedHeader": true,
            // "scrollY": 400,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('coa/get_coa_approved') ?>",
                "type": "POST",
                data: {
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
                    id: id_row
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
            },
        });


    });

    function inputtest(id) {
        // $(this).val($(this).val().toUpperCase());
        $('#nama_' + id).keyup(function() {
            $(this).val($(this).val().toUpperCase());
            // console.log('oke');
        });
    }


    function pilih_setujui(id) {
        swal({
                title: "Apakah anda yakin ?",
                text: "Pastikan data sudah benar !",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Approved",
                closeOnConfirm: false
            },
            function() {
                /* post to noac */
                console.log('hello world');

                $.ajax({
                    url: base_url + 'coa/approved_coa',
                    type: "post",
                    data: {
                        id: id,
                        <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "json",
                    async: 'false',
                    success: function(result) {

                        console.log('oke siappp');
                    },
                    beforeSend: function() {
                        //loadingPannel.show();
                    },
                    complete: function() {
                        //loadingPannel.hide();
                        //$('#tabel_detail_caba').show();
                    }
                });
                /* end noac */
            });
    }


    function get_grub(id) {


        $('.grp_coa').select2({
            ajax: {
                url: "<?php echo site_url('coa/get_grup') ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        grp: params.term, // search term
                    };
                },
                processResults: function(data) {
                    var results = [];
                    $.each(data, function(index, item) {
                        results.push({
                            id: item.grp,
                            text: item.grp
                        });
                    });
                    return {
                        results: results
                    };
                }
            }

        });
    }
</script>

<style type="text/css">
    .tables_nowrap {
        /*white-space: nowrap;*/
    }

    table#tabel_approved td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>

<div class="modal fade modal-lg modal-dialog-lg" id="<?php echo $id_modal; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Approval Spp Tanpa Coa</h3>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table id="tabel_approved" class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 5%; padding:10px">No</th>
                        <th style="width: 20%; padding:10px">Nama&nbsp;Barang </th>
                        <th style="width: 20%; padding:10px">Grup</th>
                        <th style="width: 5%; padding:10px">Pilih</th>
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