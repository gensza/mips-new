<script type="text/javascript">
    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';
        var noid_coa = '<?php echo $noid_coa; ?>';

        $("#noid_acc").val(noid_coa);

        $.ajax({
            url: base_url + 'gl/master_get_data_detail_coa',
            type: "post",
            data: {
                noid_coa: noid_coa,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            async: 'false',
            success: function(result) {

                //KAS KEBUN PDO REMISE KAS

                $("#noacc").val(result.kode_noac);
                $("#nama").val(result.nama);
                $("#grup").val(result.group);
                $("#level").val(result.level);
                $("#g_d").val(result.type_g);
                $("#acc_general").val(result.noac_general);

                if (result.yearc == 0 || result.yearc == '') {
                    $("#d_c").val('D');
                    $("#acc_balance").val(result.yeard_f);
                } else if (result.yeard == 0 || result.yeard == '') {
                    $("#d_c").val('C');
                    $("#acc_balance").val(result.yearc_f);
                } else {
                    $("#d_c").val('-');
                    $("#acc_balance").val(0);
                }


                /* select grup */
                $.ajax({
                    type: 'POST',
                    url: base_url + 'gl/master_select_data_grup',
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('#grup').empty();
                        var $kategori = $('#grup');
                        for (var i = 0; i < data.length; i++) {

                            if (result.grup == data[i].value) {
                                $kategori.append('<option value=' + data[i].value + ' selected>' + data[i].nama + '</option>');
                            } else {
                                $kategori.append('<option value=' + data[i].value + '>' + data[i].nama + '</option>');
                            }


                        }
                    }
                });
                /* select grup */


                /* select level */
                $.ajax({
                    type: 'POST',
                    url: base_url + 'gl/master_select_data_level',
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('#level').empty();
                        var $kategori = $('#level');
                        for (var i = 0; i < data.length; i++) {

                            if (result.level == data[i].value) {
                                $kategori.append('<option value=' + data[i].value + ' selected>' + data[i].nama + '</option>');
                            } else {
                                $kategori.append('<option value=' + data[i].value + '>' + data[i].nama + '</option>');
                            }
                        }
                    }
                });
                /* select level */


            },
            beforeSend: function() {
                //loadingPannel.show();
            },
            complete: function() {
                //loadingPannel.hide();
            }
        });



        $('.maskmoney').mask('00.00.00.00.00.00.00.0', {
            reverse: true
        });
        $('.maskmoney_money').maskMoney({
            thousands: ',',
            decimal: '.',
            precision: 2,
        });


        /* select divisi */
        $.ajax({
            type: 'POST',
            url: base_url + 'gl/master_select_data_divisi',
            data: {},
            dataType: 'json',
            success: function(data) {
                $('#divisi').empty();
                var $kategori = $('#divisi');
                for (var i = 0; i < data.length; i++) {
                    $kategori.append('<option value=' + data[i].value + '>' + data[i].value + ' - ' + data[i].nama + ' </option>');
                }
            }
        });
        /* select divisi */


        /* select divisi */
        $.ajax({
            type: 'POST',
            url: base_url + 'gl/master_select_data_satuan',
            data: {},
            dataType: 'json',
            success: function(data) {
                $('#satuan').empty();
                var $kategori = $('#satuan');
                for (var i = 0; i < data.length; i++) {
                    $kategori.append('<option value=' + data[i].value + '>' + data[i].nama + '</option>');
                }
            }
        });
        /* select divisi */


        $("#btn_simpan").click(function() {

            var form_data = new FormData($('#form_input')[0]);

            swal({
                    title: "Update COA ?",
                    text: "Jika ingin disimpan, silahkan klik button simpan",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Simpan",
                    //confirmButtonColor: "#E73D4A"
                    confirmButtonColor: "#286090"
                },
                function() {

                    $.ajax({
                        url: base_url + 'gl/master_update',
                        type: "POST",
                        dataType: 'json',
                        mimeType: 'multipart/form-data',
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            if (response == true) {
                                swal.close();
                                Command: toastr["success"]("COA Baru berhasil disimpan kedalam database", "Berhasil");
                                getcontents('gl/master_tabel', '<?php echo $tokens; ?>');
                            } else {
                                Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
                        }

                    });

                });

        });


        $(".select2").select2({
            //minimumInputLength: 2
        });


        $("#btn_lihat_coa").click(function() {
            getcontents('gl/master_tabel', '<?php echo $this->session->userdata('sess_token'); ?>');
        })


    });
</script>


<nav>
    <div id="jCrumbs" class="breadCrumb module">
        <ul>
            <li>
                <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token'); ?>')"><i class="icon-home"></i></a>
            </li>
            <li>
                <a href="#">GL</a>
            </li>
            <li>
                <a href="#">Edit Account</a>
            </li>
        </ul>
    </div>
</nav>



<style type="text/css">
    .space_kanan {}
</style>




<form id="form_input" method=POST enctype='multipart/form-data'>
    <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type='hidden' class='form-control' name='noid_acc' id="noid_acc">
    <div class="section-wrapper">
        <h3 class="heading">Input Account</h3>

        <div class="row-fluid">
            <div class="span8">
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">No Acc</label>
                        <input type="text" id="noacc" name="noacc" class="form-control maskmoney span17" placeholder="__.__.__.__.__">
                    </div>
                </div>

                <div class="span4">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control span17" onkeyup="validateCustomerName();">
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span8">
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Group</label>
                        <select class="form-control span17" id="grup" name="grup"></select>
                    </div>
                </div>
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Level</label>
                        <select class="form-control span17" id="level" name="level"></select>
                    </div>
                </div>

                <div class="span2">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">G / D</label>
                        <select class="form-control span6" id="g_d" name="g_d">
                            <option value="G">G</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span8">
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">General Account</label>
                        <input type="text" id="acc_general" name="acc_general" class="form-control maskmoney span17" placeholder="__.__.__.__.__">
                    </div>
                </div>
                <div class="span3">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Account Balance</label>
                        <input type="text" id="acc_balance" name="acc_balance" class="form-control maskmoney_money span17">
                    </div>
                </div>
                <div class="span2">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">D / C</label>
                        <select class="form-control span6" id="d_c" name="d_c">
                            <option value="-">-</option>
                            <option value="D">D</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>


        <br>
        <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_simpan"> Update </button>
        <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1" id="btn_lihat_coa"><i class="splashy-refresh_backwards"></i> Batal </button>

    </div>

</form>