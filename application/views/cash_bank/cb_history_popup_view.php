<script type="text/javascript">
    $(document).ready(function() {
        var id_modal = '<?php echo $id_modal; ?>';
        var tokens = '<?php echo $tokens; ?>';

        loading();

        $('#tabel_vouc_history').hide();
        $('#tabel_vouc_history').DataTable({
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
                url: base_url + 'cash_bank/data_history_vouc',
                type: 'POST',
                data: {
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                beforeSend: function() {
                    loadingPannel.show();
                },
                complete: function() {
                    loadingPannel.hide();
                    $('#tabel_vouc_history').show();
                }
            },
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],
            "language": {
                "infoFiltered": ""
            },

        });


        edit_voucher = function(cb_id) {

            $.ajax({
                url: base_url + 'cash_bank/detail_cash_bank',
                type: "post",
                dataType: 'json',
                data: {
                    cb_id: cb_id,
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(response) {
                    //noid,noac,nama
                    $("#voucno").text(response.VOUCNO);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Command: toastr["error"]("Ajax Error !!", "Error");
                }

            });

        }


        selected_voucher = function(no_vouc, txtperiode, id_vouc) {

            var url = '<?php echo base_url('cetak/cb_voucher/'); ?>';

            newwindow = window.open(url + '/' + no_vouc + '/' + id_vouc + '/' + txtperiode, 'Lembar Cetak Voucher Transaksi', '_blank');
            if (window.focus) {
                newwindow.focus()
            }
            return false;

        }


        edit_trans_voucher = function(no_vouc, id_vouc, txt_periode) {

            $('#' + id_modal).modal('hide');
            //id_rows,id_rows2
            getcontents('cash_bank/edit_voucher', '<?php echo $tokens; ?>', id_vouc, no_vouc, txt_periode);

        }

        selected_hapus_voucher = function(no_vouc, id_vouc, txt_periode) {

            swal({
                    title: "Hapus Transaksi yang dipilih ?",
                    text: "Jika ingin disimpan, silahkan klik button simpan",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Hapus",
                    confirmButtonColor: "#E73D4A"
                    //confirmButtonColor: "#286090"
                },
                function() {

                    $.ajax({
                        url: base_url + 'cash_bank/hapus_vouchers',
                        type: "post",
                        dataType: 'json',
                        data: {
                            no_vouc: no_vouc,
                            id_vouc: id_vouc,
                            txt_periode: txt_periode,
                            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        success: function(response) {
                            if (response == true) {
                                //$('#'+id_modal).modal('hide');
                                $('#tabel_vouc_history').DataTable().ajax.reload();
                                swal.close();
                                Command: toastr["success"]("Input Transaksi berhasil dihapus", "Berhasil");
                                //load_data_voucher_history();
                                $('#' + id_modal).modal('show');
                            } else {
                                Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
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

<div class="modal fade modal-dialog-lg" id="<?php echo $id_modal; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Tabel Data Voucher</h3>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table id="tabel_vouc_history" class="table table-hover table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 2%">No</th>
                        <th style="width: 10%">No.Vouc</th>
                        <th style="width: 40%">From</th>
                        <th style="width: 5%">Txt.Periode</th>
                        <th style="width: 15%">Amount</th>
                        <th style="width: 10%">Link</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-refresh"></i> Close</button>
    </div>
</div>