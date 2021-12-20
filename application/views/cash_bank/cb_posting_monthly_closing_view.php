<script type="text/javascript">
    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

        loading_posting();

        //periode session
        var period = '<?php echo $period; ?>';
        var period_tahun = '<?php echo $period_tahun; ?>';
        var period_bulan = '<?php echo $period_bulan; ?>';

        //periode berjalan bulan dan tahun
        var tahun = moment().format('YYYY');
        var bulan = moment().format('MM');

        if (tahun == period_tahun && bulan == period_bulan) {

            var form_data = new FormData($('#form_input')[0]);

            swal({
                    title: "Posting Monthly Closing ?",
                    text: "Jika ingin disimpan, silahkan klik button simpan",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Ya Posting",
                    //confirmButtonColor: "#E73D4A"
                    confirmButtonColor: "#286090"
                },
                function() {

                    swal.close();
                    $("#page_posting").hide();
                    loadingPannel.show();

                    $.ajax({
                        url: base_url + 'cash_bank/monthly_closing_submit',
                        type: "POST",
                        dataType: 'json',
                        mimeType: 'multipart/form-data',
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            console.log("closing bulanan", response);

                            //Command: toastr["success"]("Proses posting selesai", "Ok Posting Tersimpan");
                        },
                        beforeSend: function() {
                            now = moment().format('DD/MM/YYYY HH:mm:ss');
                            loadingPannel.show();
                        },
                        complete: function() {
                            loadingPannel.hide();
                            then = moment().format('DD/MM/YYYY HH:mm:ss');

                            var ms = moment(then, "DD/MM/YYYY HH:mm:ss").diff(moment(now, "DD/MM/YYYY HH:mm:ss"));
                            var d = moment.duration(ms);

                            var formats = d.hours() + ' Jam : ' + d.minutes() + ' Menit : ' + d.seconds() + ' Detik';

                            swal("Selesai", "Terima Kasih, Data berhasil di Posting dan tersimpan, Waktu Proses Posting " + formats + "", "success");

                            //getcontents('cash_bank/posting_harian','<?php echo $tokens; ?>');

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
                        }

                    });

                });
        } else {
            $("#page_posting").show();
        }

        $("#btn_posting").click(function() {

            if ($("#password").val() == '') {
                Command: toastr["error"]("Silahkan masukan password terlebih dahulu !", "Opss..");
                $("#password").focus();
            }
            else {


                if ($("#password").val() != '12345') {
                    Command: toastr["error"]("Password Salah, Silahkan ulangi dan coba ingat kembali !", "Opss..");
                    $("#password").val('');
                    $("#password").focus();
                }
                else {

                    var form_data = new FormData($('#form_input')[0]);

                    swal({
                            title: "Posting Monthly Closing ?",
                            text: "Jika ingin disimpan, silahkan klik button simpan",
                            type: "info",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true,
                            confirmButtonText: "Ya Transfer",
                            //confirmButtonColor: "#E73D4A"
                            confirmButtonColor: "#286090"
                        },
                        function() {

                            swal.close();
                            $("#page_posting").hide();
                            loadingPannel.show();

                            $.ajax({
                                url: base_url + 'cash_bank/monthly_closing_submit',
                                type: "POST",
                                dataType: 'json',
                                mimeType: 'multipart/form-data',
                                data: form_data,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(response) {
                                    //Command: toastr["success"]("Proses posting selesai", "Ok Posting Tersimpan");
                                },
                                beforeSend: function() {
                                    now = moment().format('DD/MM/YYYY HH:mm:ss');
                                    loadingPannel.show();
                                },
                                complete: function() {
                                    loadingPannel.hide();
                                    then = moment().format('DD/MM/YYYY HH:mm:ss');

                                    var ms = moment(then, "DD/MM/YYYY HH:mm:ss").diff(moment(now, "DD/MM/YYYY HH:mm:ss"));
                                    var d = moment.duration(ms);

                                    var formats = d.hours() + ' Jam : ' + d.minutes() + ' Menit : ' + d.seconds() + ' Detik';

                                    swal("Selesai", "Terima Kasih, Data berhasil di Posting dan tersimpan, Waktu Proses Posting " + formats + "", "success");

                                    //getcontents('cash_bank/posting_harian','<?php echo $tokens; ?>');

                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
                                }

                            });

                        });

                }

            }

        });


    });
</script>

<style type="text/css">
    .space_kanan {}
</style>

<div id="page_posting" style="display:none">

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
                    <a href="#">Posting Ke GL</a>
                </li>
            </ul>
        </div>
    </nav>

    <form id="form_input" method=POST enctype='multipart/form-data'>
        <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">

        <div class="alert alert-danger">
            <strong>Info !</strong> Periode Bulan & Tahun tidak sesuai dengan periode berjalan saat ini , silahkan masukan password untuk posting !
        </div>


        <div class="section-wrapper">
            <h3 class="heading">Monthly Closing</h3>
            <div class="row-fluid">
                <div class="span2" style="margin-right:10px;">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Password</label>
                        <input type="text" id="password" name="password" class="form-control maskmoney" placeholder="Password">
                    </div>
                </div>
            </div>

            <br>
            <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1" id="btn_posting">Transfer Sekarang <i class="splashy-arrow_large_right"></i></button>

        </div>

    </form>

</div>