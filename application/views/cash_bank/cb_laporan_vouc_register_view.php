<script type="text/javascript">
    function firstDateOfYearMonth(y, m) {
        var firstDay = new Date(y, m - 1, 1);
        return firstDay;
    }

    function lastDateOfYearMonth(y, m) {
        var lastDay = new Date(y, m, 0);
        return lastDay;

    }

    function format_date(d) {
        month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [day, month, year].join('-');
    }

    function sum_saldo() {
        $.ajax({
            url: base_url + 'cetak/sum_saldo_register',
            type: 'POST',
            data: {
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
                tgl_start: $("#tgl_start").val(),
                tgl_end: $("#tgl_end").val(),
                chx_periode: $('#chx_periode').val(),
            },
            dataType: "json",
            success: function(result) {
                // console.log('totalnya ya', result);
                $('#total_reg').html(result);
            },

        });
    }


    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

        var periodenya = $('#periode').val();
        var thn = periodenya.substring(0, 4);
        var bln = periodenya.substring(4, 6);

        $('#chx_periode').attr('checked', true);
        $('#chx_periode').val('1');
        sum_saldo();
        // $('#tgl_start').val(format_date(firstDateOfYearMonth(thn, bln)));
        // $('#tgl_end').val(format_date(lastDateOfYearMonth(thn, bln)));


        if (!$("#chx_periode").is(":checked")) {

        } else {
            $("#tgl_start").attr('disabled', true);
            $("#tgl_end").attr('disabled', true);
            $('#tgl_start').val(format_date(firstDateOfYearMonth(thn, bln)));
            $('#tgl_end').val(format_date(lastDateOfYearMonth(thn, bln)));
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
                $('#tgl_start').val(format_date(firstDateOfYearMonth(thn, bln)));
                $('#tgl_end').val(format_date(lastDateOfYearMonth(thn, bln)));

            } else {
                // console.log("ini tidak checked");
                // var d = new Date();
                // var today = (01) + '/' + d.getMonth() + '/' + d.getFullYear();
                // var today1 = (30) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
                // $('#tgl_start').val(today);
                // $('#tgl_end').val(today1);
                $('#tgl_start').val(format_date(firstDateOfYearMonth(thn, bln)));
                $('#tgl_end').val(format_date(lastDateOfYearMonth(thn, bln)));
                $('#chx_periode').val('1');
            }
        };


        loading();

        $("#btn_cetak").click(function() {
            var base_url = '<?php echo base_url(); ?>';
            var tgl_start = $("#tgl_start").val();
            var tgl_end = $("#tgl_end").val();

            // console.log(tgl_start);

            if ($('#chx_periode').val() == 0) {
                var url = '<?php echo base_url('cetak/cb_laporan_voucher_register/'); ?>';
                newwindow = window.open(url + '/' + tgl_start + '/' + tgl_end + '/0', 'Laporan Voucher Register', '_blank');
                if (window.focus) {
                    newwindow.focus()
                }
                return false;
            } else {
                // $('#tgl_start').val(today);
                // $('#tgl_end').val(today1)
                var url = '<?php echo base_url('cetak/cb_laporan_voucher_register/'); ?>';
                newwindow = window.open(url + '/' + tgl_start + '/' + tgl_end + '/1', 'Laporan Voucher Register', '_blank');
                if (window.focus) {
                    newwindow.focus()
                }
                return false;
            }
            window.open(base_url + 'cetak/cash_bank_lap_register/' + tgl_start + '/' + tgl_end + '');



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

            $("#tbl_vouc_regis").show();
            $("#btn_cetak").show();

            $.ajax({
                url: base_url + 'cetak/cb_laporan_voucher_register_view',
                type: "post",
                data: {
                    tgl_start: $("#tgl_start").val(),
                    tgl_end: $("#tgl_end").val(),
                    chx_periode: $('#chx_periode').val(),
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                async: 'false',
                success: function(result) {
                    var data = [];
                    for (var i = 0; i < result.length; i++) {
                        //<div style="float:left">Rp. </div>
                        data.push([result[i].TGL, result[i].VOUCNO, result[i].KODE_REF, result[i].FROM, result[i].REMARKS, '<div style="float:right">' + result[i].AMOUNT_F + '</div>']);

                    }
                    $('#tabel_lap_vouc_register').DataTable({
                        //"bJQueryUI"     : true,
                        data: data,
                        deferRender: true,
                        processing: true,
                        ordering: true,
                        retrieve: false,
                        paging: true,
                        deferLoading: 57,
                        bDestroy: true,
                        autoWidth: false,
                        bFilter: true,
                        iDisplayLength: 25,
                        //responsive: true,
                        language: {
                            searchPlaceholder: 'Cari',
                            sSearch: '',
                            lengthMenu: '_MENU_',
                        },
                    });



                },
                beforeSend: function() {
                    loadingPannel.show();
                },
                complete: function() {
                    loadingPannel.hide();
                    $('#tabel_lap_vouc_register').show();

                    // sum_saldo();
                    // console.log('totalnya ya');
                    $.ajax({
                        url: base_url + 'cetak/sum_saldo_register',
                        type: 'POST',
                        data: {
                            tgl_start: $("#tgl_start").val(),
                            tgl_end: $("#tgl_end").val(),
                            chx_periode: $('#chx_periode').val(),
                            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        dataType: "json",
                        success: function(result) {
                            // console.log('totalnya ya', result);
                            $('#total_reg').html(result);
                        },

                    });
                }
            });
        });


    });
</script>

<style>
    table#tabel_lap_vouc_register td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>

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
                    <a href="#">Laporan Voucher Register</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="row-fluid">
        <div class="span6">
            <h3 class="heading">Laporan Voucher Register</h3>
            <input type="hidden" name="periode" id="periode" value="<?= $this->session->userdata('sess_periode') ?>">
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

        <table id="tabel_lap_vouc_register" class="table table-hover table-striped table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th style="font-size: 12px; padding:10px">Tgl</th>
                    <th style="font-size: 12px; padding:10px">No. Vouc</th>
                    <th style="font-size: 12px; padding:10px">No. Ref</th>
                    <th style="font-size: 12px; padding:10px">Kepada / Dari</th>
                    <th style="font-size: 12px; padding:10px">Keterangan</th>
                    <th style="font-size: 12px; padding:10px">Nilai</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th colspan="5" style="text-align:right">Grand Total:</th>
                    <th>
                        <p id="total_reg"></p>
                    </th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>