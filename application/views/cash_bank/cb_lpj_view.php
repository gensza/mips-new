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

        $('#tgl_awal').val(format_date(firstDateOfYearMonth(thn, bln)));
        $('#tgl_akhir').val(format_date(lastDateOfYearMonth(thn, bln)));

        // Datepicker
        $('#tgl_awal').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
        });
        $('#tgl_akhir').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
        });

        loading();

        $("#btn_tampilkan").click(function() {
            var base_url = '<?php echo base_url(); ?>';
            var sumber = $('#sumber_dana').val();
            var tgl_start = $("#tgl_awal").val();
            var tgl_end = $("#tgl_akhir").val();
            //window.open(base_url+'cetak/cash_bank_lap_register/'+tgl_start+'/'+tgl_end+'');


            var url = '<?php echo base_url('cetak/cb_laporan_lpj/'); ?>';
            newwindow = window.open(url + '/' + sumber + '/' + tgl_start + '/' + tgl_end + '/0', 'Perincian Aktivitas', '_blank');

        });


        $("#yy").click(function() {

            $("#tbl_vouc_regis").show();
            $("#btn_cetak").show();
            // $("#tabel_lap_vouc_jurnal_list").html('');

            var tgl_start = $("#tgl_awal").val();
            var tgl_end = $("#tgl_akhir").val();



            $.ajax({
                url: base_url + 'cetak/cb_laporan_aktifitas_account_view',
                type: "post",
                data: {
                    tgl_start: tgl_start,
                    tgl_end: tgl_end,
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
                <a href="#">Laporan pertanggung jawaban</a>
            </li>
        </ul>
    </div>
</nav>




<form id="form_input_transaksi" method=POST enctype='multipart/form-data'>
    <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="periode" id="periode" value="<?= $this->session->userdata('sess_periode') ?>">
    <div class="row-fluid">
        <div class="span6">
            <h3 class="heading">Laporan Pertanggung Jawaban</h3>

            <div class="row-fluid">
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Sumber Dana</label>
                        <div class="input-prepend">
                            <select class="span17 form-control" name="sumber_dana" id="sumber_dana">
                                <!-- <option value="0">-Pilih-</option> -->
                                <option value="1">PDO Gaji</option>
                                <option value="2">PDDO IM</option>
                                <option value="3">PDDO GRTT</option>
                                <option value="4">PDO Remise Kas</option>
                                <option value="5">Dana Kontanan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Tanggal Start</label>
                        <div class="input-prepend">
                            <input type="text" size="20" class="span9 form-control" id="tgl_awal" name="tgl_awal"><span class="add-on" id="tgl_awal" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Tanggal End</label>
                        <div class="input-prepend">
                            <input type="text" size="20" class="span9 form-control" id="tgl_akhir" name="tgl_akhir"><span class="add-on" id="tgl_akhir" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                        </div>
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
    <div class="span6" style="display:none" id="div_lap_saldo_akhir">


        <table id="tbl_lap_saldo_akhir" class="table table-hover table-striped table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th style="width:2%">No</th>
                    <th style="width:5%">No Account</th>
                    <th style="width:20%">Nama</th>
                    <th style="width:10%">Saldo</th>
                </tr>
            </thead>
            <tbody id="list_lap_saldo_akhir"></tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right">Total:</th>
                    <th>
                        <p id="total"></p>
                    </th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>