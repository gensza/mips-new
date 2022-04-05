<script type="text/javascript">
    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

        $('.maskmoney').mask('00.00.00.00.00.00.00.0', {
            reverse: true
        });

        $('.maskmoney_money').maskMoney({
            thousands: ',',
            decimal: '.',
            precision: 2,
        });

        /*$("#nama").on("keyup", function(event) {
        var value = $(this).val();
        if (value.indexOf('#') != -1) {
          $(this).val(value.replace(/\#!/g, ""));
        }
      })
*/

        //$('#nama').keyup(function(evt){

        /*var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode == 222){
            this.value = this.value.toUpperCase();
            return false;
         }*/
        //         
        //

        //});

        /* select grup */
        $.ajax({
            type: 'POST',
            url: base_url + 'gl/master_select_data_grup',
            data: {},
            dataType: 'json',
            success: function(data) {
                $('#grup').empty();
                var $kategori = $('#grup');
                $kategori.append('<option value=0>-Pilih Group-</option>');
                for (var i = 0; i < data.length; i++) {
                    $kategori.append('<option value=' + data[i].value + '>' + data[i].nama + '</option>');
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
                $kategori.append('<option value=0>-Pilih Level-</option>');
                for (var i = 0; i < data.length; i++) {
                    $kategori.append('<option value=' + data[i].value + '>' + data[i].nama + '</option>');
                }
            }
        });
        /* select level */


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


            if ($("#noacc").val() == '') {

                Command: toastr["error"]("No Account tidak boleh kosong !", "Info !");
                $("#noacc").focus();

            }
            else {

                var form_data = new FormData($('#form_input')[0]);

                swal({
                        title: "Simpan COA ?",
                        text: "Jika ingin disimpan, silahkan klik button simpan",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        // showLoaderOnConfirm: true,
                        confirmButtonText: "Simpan",
                        //confirmButtonColor: "#E73D4A"
                        confirmButtonColor: "#286090"
                    },
                    function() {

                        //cek_is_exist_coa();
                        $.ajax({
                            url: base_url + 'gl/cek_is_exist_coa',
                            type: "POST",
                            dataType: 'json',
                            mimeType: 'multipart/form-data',
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(response) {
                                console.log(response);
                                if (response == 0) {
                                    $.ajax({
                                        url: base_url + 'gl/master_simpan',
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

                                } else {
                                    Command: toastr["error"]("Coa Sudah ada, data tidak berhasil disimpan", "Error");
                                    // hide sweetalert
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
                            }

                        });

                    });
            }
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
                <a href="#">Input Account</a>
            </li>
        </ul>
    </div>
</nav>



<style type="text/css">
    .space_kanan {}
</style>




<form id="form_input" method=POST enctype='multipart/form-data'>
    <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">


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
                            <option value="D">D</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>


        <br>
        <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_simpan"> Simpan </button>
        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" id="btn_lihat_coa"><i class="splashy-zoom"></i> Lihat Data COA </button>

    </div>

</form>