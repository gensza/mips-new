<script type="text/javascript">
    $(document).ready(function() {
        var id_modal = '<?php echo $id_modal; ?>';
        var tokens = '<?php echo $tokens; ?>';
        var selected = [];

        $('#tabel_pp_logistik').hide();
        $('#tabel_pp_logistik').DataTable().destroy();
        $('#tabel_pp_logistik').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "iDisplayLength": 10,
            "responsive": true,
            "autoWidth": false,
            "rowReorder": true,
            "language": {
                searchPlaceholder: 'Cari NO.PP / NO.REF PO',
                sSearch: '',
                lengthMenu: '_MENU_',
                infoFiltered: ""
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                url: base_url + 'cash_bank/get_data_po_logistik',
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
                    $('#tabel_pp_logistik').show();
                }
            },
            "rowCallback": function(row, data) {
                if ($.inArray(data.DT_RowId, selected) !== -1) {
                    $(row).addClass('selected');
                }
            },
            "columnDefs": [{
                "searchable": false,
                "targets": [0, 6], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],


        });

        $('#tabel_pp_logistik tbody').on('click', 'tr', function() {
            var id = this.id;
            var index = $.inArray(id, selected);

            if (index === -1) {
                selected.push(id);
            } else {
                selected.splice(index, 1);
            }

            $(this).toggleClass('selected');
        });

        selected_pp_logistik = function(pppo_id, pppo_no) {

            // console.log('ini log idnya' + pppo_id + 'dan ini no pp nya' + pppo_no);

            $.ajax({
                url: base_url + 'cash_bank/detail_pp_logistik',
                type: "post",
                dataType: 'json',
                data: {
                    pppo_id: pppo_id,
                    pppo_no: pppo_no,
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(response) {

                    console.log('ini respon nya', response);
                    //noid,noac,nama
                    $("#no_ref").val(response.nopp);
                    $("#ref_po").val(response.ref_po);
                    // console.log('ini loh ref po nya', response.ref_po);
                    //$('#'+id_modal).modal('hide');

                    $("#kepada").val(response.nama_supply);
                    $("#transaksi_remark").val('PO ' + response.ref_po + '-' + response.nama_supply);
                    $("#debet_by_po").val(response.jumlah_f);
                    $("#kodept").val(response.kodept);


                    $.ajax({
                        url: base_url + 'cash_bank/cek_pp_logistik',
                        type: "post",
                        dataType: 'json',
                        data: {
                            ref_po: response.ref_po,
                            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        success: function(response_x) {

                            if (response_x == 1) {
                                Command: toastr["error"]("PO dengan no ref :" + response.ref_po + " sudah di input ! ", "Opss");
                            }
                            else {
                                get_acct_supplier(response.kode_supplytxt);
                                $('#' + id_modal).modal('hide');

                                setTimeout(function() {
                                    set_jumlah_tot();
                                }, 3000);
                                // setTimeout(function() {
                                //     set_jumlah_tot();
                                // }, 1000);



                                // selesai();
                            }

                        }
                    })



                    //get_acct_supplier(response.kode_supply);

                    //
                    //simpan_voucher_details_by_po(); /ini untuk insert voucher detail
                    //$("#debet_by_po").val('');

                    //var vals = $("#jumlah").val(response.jumlah_f);
                    //buttonCode(response.jumlah_f);
                    //get_balance();
                    //ini aksi langsung insert ke voucher detail
                    //$("#supplier_acct").val('');
                    //$("#supplier_nama").val('');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Command: toastr["error"]("Ajax Error !!", "Error");
                }

            });

        }



        // $("#btn_selesai_po").click(function() {
        //     $('#' + id_modal).modal('hide');
        //     set_jumlah_tot();
        // });

    });
</script>

<style type="text/css">
    .tables_nowrap {
        /*white-space: nowrap;*/
    }

    table#tabel_pp_logistik td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>

<div class="modal fade modal-lg modal-dialog-lg" id="<?php echo $id_modal; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-header">
        <!--<button class="close" data-dismiss="modal">×</button>-->
        <h3>Tabel PP Logistik</h3>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table id="tabel_pp_logistik" class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 5%; padding:10px">NO PP</th>
                        <th style="width: 5%; padding:10px">NO PO</th>
                        <th style="width: 20%; padding:10px">REF PO</th>
                        <th style="width: 15%; padding:10px">TGL PP</th>
                        <th style="width: 20%; padding:10px">Supply</th>
                        <th style="width: 5%; padding:10px">Bayar</th>
                        <th style="width: 5%; padding:10px">Pilih</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" style="background:white"><img src="<?php echo base_url('assets/img-gif.gif'); ?>" style="width:23px"></button> -->
        <!-- <button type="button" class="btn btn-success" id="btn_selesai_po"><i class="fa fa-refresh"></i> Selesai dan Simpan</button> -->
        <!--<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-refresh"></i> Close</button>-->
    </div>
</div>