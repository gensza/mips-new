<script type="text/javascript">
    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

        loading_posting();

        var periodetxt = $('#periode').val();
        var thn = periodetxt.substring(0, 4);
        var bln = periodetxt.substring(4, 6);

        // var periodenya = bln + thn;
        // $('#tgl_periode').val(periodenya);

        $('.fc-datepicker2').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'mmyy',
            onClose: function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
        });


        $("#btn_tampilkan").click(function() {

            if ($("#tgl_periode").val() == '') {
                Command: toastr["warning"]("Silahkan masukan periode !", "Opps !");
                $("#tgl_periode").focus();
            }
            else {

                // $("#list_lap_saldo_akhir").empty();
                $("#div_lap_saldo_akhir").show();
                $("#btn_cetak").show();

                var tglperiode = $("#tgl_periode").val();
                var bulan_periode = tglperiode.substr(0, 2);
                var tahun_periode = tglperiode.substr(2, 4);

                $('#tbl_lap_saldo_akhir').hide();
                $('#tbl_lap_saldo_akhir').DataTable().destroy();
                $('#tbl_lap_saldo_akhir').DataTable({
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
                        url: base_url + 'cetak/cb_laporan_saldo_akhir',
                        type: 'POST',
                        data: {
                            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
                            bulan: bulan_periode,
                            tahun: tahun_periode,
                        },
                        dataType: "json",
                        beforeSend: function() {
                            //loadingPannel.show();
                        },
                        complete: function() {
                            //loadingPannel.hide();
                            $('#tbl_lap_saldo_akhir').show();
                            sum_saldo(bulan_periode, tahun_periode);
                        },

                    },
                    "columnDefs": [{
                        "targets": [0], //first column / numbering column
                        "orderable": false, //set not orderable
                    }, ],


                });

                // $.ajax({
                //     url: base_url + 'cetak/cb_laporan_saldo_akhir',
                //     type: "post",
                //     data: {
                //         bulan: bulan_periode,
                //         tahun: tahun_periode,
                //         <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                //     },
                //     dataType: "html",
                //     async: 'false',
                //     success: function(result) {

                //         $("#list_lap_saldo_akhir").append(result);

                //     },
                //     beforeSend: function() {
                //         loadingPannel.show();
                //     },
                //     complete: function() {
                //         loadingPannel.hide();
                //     }
                // });
            }
        });



        $("#btn_cetak").click(function() {

            var tglperiode = $("#tgl_periode").val();
            var bulan_periode = tglperiode.substr(0, 2);
            var tahun_periode = tglperiode.substr(2, 4);

            var test = bulan_periode.substr(0, 1);
            if (test == 0) {
                var bln_periode = bulan_periode.replace(/^0+/, '')
            } else {
                var bln_periode = tglperiode.substr(0, 2);
            }
            // console.log(bln_periode);

            var url = '<?php echo base_url('cetak/cb_laporan_saldo_akhir_cetak/'); ?>';

            newwindow = window.open(url + '/' + bln_periode + '/' + tahun_periode, 'Laporan Saldo Akhir', '_blank');
            if (window.focus) {
                newwindow.focus()
            }
            return false;

        });


    });


    function sum_saldo(bulan_periode, tahun_periode) {
        $.ajax({
            url: base_url + 'cetak/sum_saldo_akhir',
            type: 'POST',
            data: {
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
                bulan: bulan_periode,
                tahun: tahun_periode,
            },
            dataType: "json",
            success: function(result) {
                // console.log('totalnya ya', result);
                $('#total').html(result);
            },

        });
    }
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
                <a href="#">Saldo Akhir</a>
            </li>
        </ul>
    </div>
</nav>



<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>

<form id="form_input_transaksi" method=POST enctype='multipart/form-data'>
    <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">

    <div class="row-fluid">
        <div class="span6">
            <h3 class="heading">Laporan Saldo Akhir Cash Bank</h3>

            <div class="row-fluid">
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Periode</label>
                        <input type="hidden" name="periode" id="periode" value="<?= $this->session->userdata('sess_periode') ?>">
                        <div class="input-prepend">
                            <input type="text" size="20" class="span9 fc-datepicker2" id="tgl_periode" name="tgl_periode"><span class="add-on" id="tgl_start" style="cursor: pointer;"><i class="icon-calendar"></i></span>
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