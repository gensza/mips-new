<script type="text/javascript">
    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

        loading();



        function formatSeconds(seconds) {
            var date = new Date();
            date.setSeconds(seconds);
            return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
        }




        $('#tabel_gl_coa').hide();
        var table = $('#tabel_gl_coa').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "iDisplayLength": 100,
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
                url: base_url + 'gl/gl_mastercode',
                type: 'POST',
                data: {
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                beforeSend: function() {
                    loadingPannel.show();
                    beforeload = new Date();
                },
                complete: function() {
                    loadingPannel.hide();
                    $('#tabel_gl_coa').show();

                    var afterload = new Date();
                    seconds = (afterload - beforeload) / 1000;

                    //var end = new Date().getTime();
                    //var total = end - time;
                    //var seconds = total;
                    // multiply by 1000 because Date() requires miliseconds
                    //var date = new Date(seconds * 1000);
                    //var hh = date.getUTCHours();
                    //var mm = date.getUTCMinutes();
                    //var ss = date.getSeconds();
                    // If you were building a timestamp instead of a duration, you would uncomment the following line to get 12-hour (not 24) time
                    // if (hh > 12) {hh = hh % 12;}
                    // These lines ensure you have two-digits
                    //if (hh < 10) {hh = "0"+hh;}
                    //if (mm < 10) {mm = "0"+mm;}
                    //if (ss < 10) {ss = "0"+ss;}
                    // This formats your string to HH:MM:SS
                    //var t = hh+":"+mm+":"+ss;
                    loadingPannel.hide();
                    //swal("Selesai", "Terima Kasih, Data berhasil di Posting dan tersimpan, Waktu Proses Posting "+t+" Second.", "success");



                    //var seconds = seconds_ols ; // or "2000"
                    seconds = parseInt(seconds) //because moment js dont know to handle number in string format
                    var format = Math.floor(moment.duration(seconds, 'seconds').asHours()) + ':' + moment.duration(seconds, 'seconds').minutes() + ':' + moment.duration(seconds, 'seconds').seconds();



                    //swal("Selesai", "Terima Kasih, Data berhasil di Posting dan tersimpan, Waktu Proses Posting "+ format +" sec(s).", "success");


                }

            },
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $("#btn_cetak_pdf").click(function() {
        cetak_journal('pdf');
    });

    $("#btn_cetak_excel").click(function() {
        cetak_journal('excel');
    });

    function cetak_journal(cetak) {

        var url = '<?php echo base_url('cetak/cetak_coa_all/'); ?>';

        if (cetak == 'pdf') {
            window.open(url + '/' + cetak + '/', '_blank');
        } else {
            window.open(url + '/' + cetak + '/');
        }
        // if (window.focus) {
        //   newwindow.focus()
        // }
        // return false;

    };
</script>

<style type="text/css">
    th,
    td {
        white-space: nowrap;
    }
</style>



<div id="jCrumbs" class="breadCrumb module">
    <ul>
        <li>
            <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token'); ?>')"><i class="icon-home"></i></a>
        </li>
        <li>
            <a href="#">GL</a>
        </li>
        <li>
            <a href="#">Data COA</a>
        </li>
    </ul>
</div>
</nav>
<div>
    <!-- <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1" id="btn_cetak_pdf"><i class="fa fa-print"></i><i class="splashy-printer"></i> PDF </button> -->
    <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" id="btn_cetak_excel"><i class="fa fa-print"></i><i class="splashy-printer"></i> Excel</button>
</div>
<div class="row-fluid">
    <div class="span12">

        <div id="progress"></div>
        <div class="table-responsive">
            <table id="tabel_gl_coa" class="table table-hover table-striped table-responsive table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 5%">Noac</th>
                        <th style="width: 40%">Nama</th>
                        <th style="width: 5%">Sbu</th>
                        <th style="width: 5%">Group</th>
                        <th style="width: 5%">Type</th>
                        <th style="width: 5%">General</th>
                        <th style="width: 5%">Link</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>