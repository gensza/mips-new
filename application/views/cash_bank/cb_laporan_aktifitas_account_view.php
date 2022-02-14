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
    $(document).ready(function() {
        // $('#tb_accn').DataTable();

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

        // $('#chx_periode').attr('checked', true);
        // $('#chx_periode').val('1');

        var periodenya = $('#periode').val();
        var thn = periodenya.substring(0, 4);
        var bln = periodenya.substring(4, 6);

        // console.log(format_date(lastDateOfYearMonth(thn, bln)));

        $('#tgl_1').val(format_date(firstDateOfYearMonth(thn, bln)));
        $('#tgl_2').val(format_date(lastDateOfYearMonth(thn, bln)));

        // Datepicker
        $('#tgl_1').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
        });
        $('#tgl_2').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
        });

        loading();

        $("#btn_cetak").click(function() {
            var base_url = '<?php echo base_url(); ?>';
            var tgl_start = $("#tgl_1").val();
            var tgl_end = $("#tgl_2").val();
            var coa = $('#accn').val();

            if (coa == '') {
                var dt = 0;
            } else {
                var dt = $('#accn').val();
            }
            //window.open(base_url+'cetak/cash_bank_lap_register/'+tgl_start+'/'+tgl_end+'');
            var url = '<?php echo base_url('cetak/cb_laporan_aktifitas_account/'); ?>';
            newwindow = window.open(url + '/' + tgl_start + '/' + tgl_end + '/' + dt + '/0', 'Perincian Aktivitas', '_blank');

        });

        document.getElementById("accn").addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                getpopup('cash_bank/tabel_coa_popup', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', '1');
            }
        });


        $("#btn_tampilkan").click(function() {

            $("#tbl_vouc_regis").show();
            $("#btn_cetak").show();

            var tgl_start = $("#tgl_1").val();
            var tgl_end = $("#tgl_2").val();
            var accn = $("#accn").val();

            if (accn == '') {
                var dt = 0;
            } else {
                var dt = $("#accn").val();
            }

            $.ajax({
                url: base_url + 'cetak/cb_laporan_aktifitas_account_view',
                type: "post",
                data: {
                    tgl_start: tgl_start,
                    tgl_end: tgl_end,
                    accn: dt,
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "html",
                async: 'false',
                success: function(result) {

                    $("#tabel_lap_accn").html("");
                    $("#tabel_lap_accn").append(result);
                },
                beforeSend: function() {
                    loadingPannel.show();
                },
                complete: function() {
                    loadingPannel.hide();
                    // $('#tb_accn').DataTable();
                }
            });
        });

    });
</script>


<style type="text/css">
    table#tb_accn td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }


    #scrolly {
        width: 1000px;
        height: 190px;
        overflow: auto;
        overflow-y: hidden;
        margin: 0 auto;
        white-space: nowrap
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
                    <a href="#">Laporan Aktifitas Account</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="row-fluid">
        <div class="span6">
            <h3 class="heading">Laporan Aktifitas Account</h3>

            <input type="hidden" name="periode" id="periode" value="<?= $this->session->userdata('sess_periode') ?>">
            <div class="row-fluid">
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Account</label>
                        <div class="input-prepend">
                            <input type="text" size="20" class="span9 form-control" id="accn" name="accn" placeholder="Enter disini..." autocomplete="off"><span class="add-on" id="accn" style="cursor: pointer;"><i class="icon-book"></i></span>
                        </div>
                    </div>
                </div>


                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Tanggal Start</label>
                        <div class="input-prepend">
                            <input type="text" size="20" class="span9 fc-datepicker1" id="tgl_1" name="tgl_1" autocomplete="off"><span class="add-on" id="tgl_1" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Tanggal End</label>
                        <div class="input-prepend">
                            <input type="text" size="20" class="span9 fc-datepicker1" id="tgl_2" name="tgl_2" autocomplete="off"><span class="add-on" id="tgl_2" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <!-- <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">All Account</label>
                        <label class="uni-checkbox">
                            <input type="checkbox" id="chx_periode" name="chx_periode" class="uni_style" />
                        </label>
                    </div>
                </div> -->
            </div>


        </div>
    </div>

    <br>

    <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_tampilkan"><i class="fa fa-save"></i><i class="splashy-zoom"></i> Tampilkan </button>
    <button type="button" class="btn btn-warning btn-min-width mr-1 mb-1" id="btn_cetak" style="display:none"><i class="fa fa-print"></i><i class="splashy-printer"></i> Cetak </button>

</form>




<div class="row-fluid">
    <div class="span12" style="display:none" id="tbl_vouc_regis">


        <table id="tb_accn" class="table table-hover table-striped table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th style="font-size: 12px; padding:10px">Tgl</th>
                    <th style="font-size: 12px; padding:10px">No. Vouc</th>
                    <th style="font-size: 12px; padding:10px">Kepada / Dari</th>
                    <th style="font-size: 12px; padding:10px">Keterangan</th>
                    <th style="font-size: 12px; padding:10px">Debit</th>
                    <th style="font-size: 12px; padding:10px">Kredit</th>
                </tr>
            </thead>
            <tbody id="tabel_lap_accn"></tbody>
        </table>



    </div>
</div>