<script type="text/javascript">
    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

        $('#chx_periode').attr('checked', true);
        $('#chx_periode').val('1');

        if (!$("#chx_periode").is(":checked")) {

        } else {
            $("#tgl_start").attr('disabled', true);
            $("#tgl_end").attr('disabled', true);
            // var d = new Date();
            // var today = (01) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
            // var today1 = (30) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
            // $('#tgl_start').val(today);
            // $('#tgl_end').val(today1);
        }

        document.getElementById('chx_periode').onchange = function() {
            document.getElementById('tgl_start').disabled = this.checked;
            document.getElementById('tgl_end').disabled = this.checked;
            //ini untuk merubah value checkbox
            if (!$("#chx_periode").is(":checked")) {
                // console.log("ini checked");
                $("#tgl_start").focus();
                $('#chx_periode').val('0');
                $("#tgl_start").val('');
                $("#tgl_end").val('');

            } else {
                // console.log("ini tidak checked");
                // var d = new Date();
                // var today = (01) + '/' + d.getMonth() + '/' + d.getFullYear();
                // var today1 = (30) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
                // $('#tgl_start').val(today);
                // $('#tgl_end').val(today1);
                $("#tgl_start").val('');
                $("#tgl_end").val('');
                $('#chx_periode').val('1');
            }
        };


        loading();

        $("#btn_cetak").click(function() {
            var base_url = '<?php echo base_url(); ?>';
            var tgl_start = $("#tgl_start").val();
            var tgl_end = $("#tgl_end").val();

            var cbxs;
            if ($('#chx_periode').val() == 0) {
                var url = '<?php echo base_url('cetak/cb_laporan_voucher_register/'); ?>';
                newwindow = window.open(url + '/' + tgl_start + '/' + tgl_end + '/0', 'Laporan Voucher Register', '_blank');
                if (window.focus) {
                    newwindow.focus()
                }
                return false;
            } else {
                var d = new Date();
                var today = (01) + '-' + d.getMonth() + '-' + d.getFullYear();
                var today1 = (30) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
                // $('#tgl_start').val(today);
                // $('#tgl_end').val(today1)
                var url = '<?php echo base_url('cetak/cb_laporan_voucher_register/'); ?>';
                newwindow = window.open(url + '/' + today + '/' + today1 + '/1', 'Laporan Voucher Register', '_blank');
                if (window.focus) {
                    newwindow.focus()
                }
                return false;
            }
            //window.open(base_url+'cetak/cash_bank_lap_register/'+tgl_start+'/'+tgl_end+'');



        });


        // Datepicker
        $('.fc-datepicker1').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });

        $('.fc-datepicker2').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });

        $('#datepicker_pointer').click(function() {
            $(".fc-datepicker1").focus();
        });

        $('#datepicker_pointer2').click(function() {
            $(".fc-datepicker2").focus();
        });


        $("#btn_tampilkan").click(function() {

            var tgl_start = $("#tgl_start").val();
            var tgl_end = $("#tgl_end").val();



            $("#tbl_vouc_regis").show();
            $("#btn_cetak").show();
            $('#tabel_rekap').DataTable().destroy();
            $('#tabel_rekap').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                "language": {
                    searchPlaceholder: 'Cari',
                    sSearch: '',
                    lengthMenu: '_MENU_',
                    "emptyTable": "Maaf, Saldo akhir tidak tersedia !"
                },

                // Load data for the table's content from an Ajax source
                "ajax": {
                    url: base_url + 'cetak/cb_laporan_rekap',
                    type: 'POST',
                    data: {
                        <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
                        tgl_start: $("#tgl_start").val(),
                        tgl_end: $("#tgl_end").val(),
                        chx_periode: $('#chx_periode').val(),
                    },
                    dataType: "json",
                    beforeSend: function() {
                        //loadingPannel.show();
                    },
                    complete: function() {
                        //loadingPannel.hide();
                        $('#tabel_rekap').show();
                        // sum_saldo(bulan_periode, tahun_periode);
                    },

                },
                "columnDefs": [{
                    "targets": [0], //first column / numbering column
                    "orderable": false, //set not orderable
                }, ],


            });

            // $('#tabel_rekap').DataTable({
            //     //"bJQueryUI"     : true,
            //     data: data,
            //     deferRender: true,
            //     processing: true,
            //     ordering: true,
            //     retrieve: false,
            //     paging: true,
            //     deferLoading: 57,
            //     bDestroy: true,
            //     autoWidth: false,
            //     bFilter: true,
            //     iDisplayLength: 100,
            //     //responsive: true,
            //     language: {
            //         searchPlaceholder: 'Cari',
            //         sSearch: '',
            //         lengthMenu: '_MENU_',
            //     },
            // });

            // $.ajax({
            //     url: base_url + 'cetak/cb_laporan_voucher_register_view',
            //     type: "post",
            //     data: {
            //         tgl_start: $("#tgl_start").val(),
            //         tgl_end: $("#tgl_end").val(),
            //         chx_periode: $('#chx_periode').val(),
            //         <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            //     },
            //     dataType: "json",
            //     async: 'false',
            //     success: function(result) {
            //         var data = [];
            //         for (var i = 0; i < result.length; i++) {
            //             //<div style="float:left">Rp. </div>
            //             data.push([result[i].TGL, result[i].VOUCNO, result[i].KODE_REF, result[i].FROM, result[i].REMARKS, '<div style="float:right">' + result[i].AMOUNT_F + '</div>']);

            //         }
            //         $('#tabel_lap_vouc_register').DataTable({
            //             //"bJQueryUI"     : true,
            //             data: data,
            //             deferRender: true,
            //             processing: true,
            //             ordering: true,
            //             retrieve: false,
            //             paging: true,
            //             deferLoading: 57,
            //             bDestroy: true,
            //             autoWidth: false,
            //             bFilter: true,
            //             iDisplayLength: 100,
            //             //responsive: true,
            //             language: {
            //                 searchPlaceholder: 'Cari',
            //                 sSearch: '',
            //                 lengthMenu: '_MENU_',
            //             },
            //         });

            //     },
            //     beforeSend: function() {
            //         loadingPannel.show();
            //     },
            //     complete: function() {
            //         loadingPannel.hide();
            //         $('#tabel_lap_vouc_register').show();
            //     }
            // });
        });







    });
</script>

<form id="form_input_transaksi" method=POST enctype='multipart/form-data'>
    <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">

    <nav>
        <div id="jCrumbs" class="breadCrumb module">
            <ul>
                <li>
                    <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token'); ?>')"><i class="icon-home"></i></a>
                </li>
                <li>
                    <a href="#">Cash Bank</a>
                </li>
                <li>
                    <a href="#">Laporan Rekap Journal</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="row-fluid">
        <div class="span6">
            <h3 class="heading">Laporan Rekap Journal</h3>

            <div class="row-fluid">
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Tanggal Start</label>
                        <div class="input-prepend">
                            <input type="text" size="20" class="span9 fc-datepicker1" id="tgl_start" name="tgl_start"><span class="add-on" id="tgl_start" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Tanggal End</label>
                        <div class="input-prepend">
                            <input type="text" size="20" class="span9 fc-datepicker1" id="tgl_end" name="tgl_end"><span class="add-on" id="tgl_end" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Divisi</label>
                        <div class="input-prepend">
                            <?php
                            //ini divisa jika login session HO
                            if ($this->session->userdata('sess_id_lokasi') != 1) {
                            ?>

                                <select class="form-control span17" name="divisi_v" id="divisi_v">
                                    <option value="0">Semua</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                </select>
                            <?php
                            } else {
                            ?>

                                <select class="form-control span17" name="divisi_v" id="divisi_v">
                                    <option value="01">Semua</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                </select>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Periode Terkini</label>
                        <label class="uni-checkbox">
                            <input type="checkbox" id="chx_periode" name="chx_periode" class="uni_style" />
                        </label>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <br>

    <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_tampilkan"><i class="fa fa-save"></i><i class="splashy-zoom"></i> Tampilkan </button>
    <button type="button" class="btn btn-warning btn-min-width mr-1 mb-1" id="btn_cetak" style="display:none"><i class="fa fa-print"></i><i class="splashy-printer"></i> Cetak </button>

</form>

<div class="row-fluid">
    <div class="span12" style="display:none" id="tbl_vouc_regis">

        <table id="tabel_rekap" class="table table-hover table-striped table-bordered" style="width: 100%">
            <thead>
                <tr role="row">
                    <th rowspan="2">Account</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Debet</th>
                    <th rowspan="2">Credit</th>
                    <th style="text-align: center;" colspan="3" rowspan="1">Net Transaksi</th>

                </tr>
                <tr role="row">
                    <th rowspan="2">Debet</th>
                    <th rowspan="2">Credit</th>
                </tr>
            </thead>
            <tbody>


            </tbody>
        </table>

    </div>
</div>