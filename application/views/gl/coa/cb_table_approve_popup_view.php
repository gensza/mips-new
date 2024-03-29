<script type="text/javascript">
    $(document).ready(function() {
        var id_modal = '<?php echo $id_modal; ?>';
        var tokens = '<?php echo $tokens; ?>';
        var id_row = '<?php echo $id_row; ?>';
        var noref = '<?php echo $noref; ?>';
        var pt = '<?php echo $pt; ?>';
        var alias = '<?php echo $alias; ?>';

        // console.log(id_modal);

        loading_coa();

        data_spp(id_row, pt, alias);



    });

    function data_spp(id_row, pt, alias) {
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
                    id: id_row,
                    pt: pt,
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
            $('#tabel_approved').DataTable().ajax.reload();
            clearInterval(rel);
        }, 100)

    }

    function inputtest(id) {
        // $(this).val($(this).val().toUpperCase());
        $('#nama_' + id).keyup(function() {
            $(this).val($(this).val().toUpperCase());
            // console.log('oke');
        });
    }


    function pilih_setujui(id, kodebar, alias) {
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
                // console.log('hello world');
                swal.close();
                // $('#' + '<?php echo $id_modal; ?>').modal('hide');

                loadingPannel.show();

                $.ajax({
                    url: base_url + 'coa/approved_coa',
                    type: "post",
                    data: {
                        id: id,
                        kodebar: kodebar,
                        alias: alias,
                        nama: $('#nama_' + id).val(),
                        grp: $('#grp_coa_' + id).val(),
                        <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "json",
                    async: 'false',
                    success: function(result) {
                        // console.log(result);
                        if (result == true) {
                            loadingPannel.hide();
                            update_ppo_tmp(id, alias)

                            Command: toastr["success"]("COA berhasil dibuatkan", "Berhasil");



                        } else {
                            alert('Ada Kesalahan!');
                        }
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


    function update_ppo_tmp(id, alias) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('coa/update_ppo_tmp'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                id: id,
                alias: alias,
            },
            success: function(data) {
                var kode = $('#hidden_id_ppo').val();
                console.log(data);
                if (data.delete == true) {
                    data_spp('<?php echo $id_row; ?>', '<?php echo $pt; ?>', alias)
                    $('#' + '<?php echo $id_modal; ?>').modal('hide');
                    getpopup_new_coa('coa/modal_new_coa', '<?php echo $this->session->userdata('sess_token'); ?>', 'detail_newcoa', '<?php echo $noref; ?>', alias);
                    var filter = "SEMUA";
                    data_coa(filter);
                } else {
                    data_spp('<?php echo $id_row; ?>', '<?php echo $pt; ?>', alias)
                    var filter = "SEMUA";
                    data_coa(filter);
                }
                // spp_approval_noCoa(kode)
            },
            error: function(request) {
                console.log(request.responseText);
            }
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
                            id: item.nama,
                            text: item.nama
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
                        <th style="width: 20%; padding:10px">Noac&nbsp;Sementara</th>
                        <th style="width: 30%; padding:10px">Nama&nbsp;Barang</th>
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
        <button type="close" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-refresh"></i> Close</button>
    </div>
</div>