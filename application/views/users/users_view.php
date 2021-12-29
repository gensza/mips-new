<script type="text/javascript">
    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

        loading();

        var data_users = function() {

            $.ajax({
                url: base_url + 'users/data',
                type: "post",
                data: {
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                async: 'false',
                success: function(result) {
                    console.log(result);
                    var data = [];
                    for (var i = 0; i < result.length; i++) {
                        var no = i + 1;
                        var baseurl = '<?php echo base_url(); ?>';

                        var link_edit = "<a href='javascript:void(0)' onclick=\"getpopup('users/edit','" + tokens + "','popupedit','" + result[i].id + "');\"><div class='btn btn-default' title='Akses' ><i class='splashy-contact_blue_edit'></i></div></a>";

                        data.push([no, result[i].nama, result[i].nama_pt, result[i].username, result[i].email, result[i].nama_role, result[i].nama_lokasi, result[i].groupmodul, link_edit]);

                    }

                    /*$('#tabel_role').dataTable({
                        "sDom": "<'row'<'span6'><'span6'f>r>t<'row'<'span6'i><'span6'>S>",
                        "sScrollY": "200px",
                        "aaData": data,
                        "bDestroy": true,
                        "bDeferRender": true
                    });*/

                    $('#tabel_role').dataTable({
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
                        iDisplayLength: 10,
                        //responsive: true,
                        language: {
                            searchPlaceholder: 'Cari',
                            sSearch: '',
                            lengthMenu: '_MENU_',
                        }
                    });

                },
                beforeSend: function() {
                    loadingPannel.show();
                },
                complete: function() {
                    loadingPannel.hide();
                    $('#tabel_role').show();
                }
            });
        }
        data_users();

        var get_data_group_modul = function() {
            /* select role */
            $.ajax({
                type: 'POST',
                url: base_url + 'role/group_modul',
                data: {},
                dataType: 'json',
                success: function(data) {
                    $('#group_modul').empty();
                    var $kategori = $('#group_modul');
                    $kategori.append('<option value=0 selected> -Pilih Group Modul- </option>');
                    for (var i = 0; i < data.length; i++) {
                        $kategori.append('<option value=' + data[i].valueid + '>' + data[i].nama + '</option>');
                    }
                }
            });
            /* select Kategori */
        }
        get_data_group_modul();

        var get_data_users = function() {
            /* select role */
            $.ajax({
                type: 'POST',
                url: base_url + 'role/data',
                data: {},
                dataType: 'json',
                success: function(data) {
                    $('#role').empty();
                    var $kategori = $('#role');
                    $kategori.append('<option value=0 selected> -Pilih Role- </option>');
                    for (var i = 0; i < data.length; i++) {
                        $kategori.append('<option value=' + data[i].id + '>' + data[i].nama + '</option>');
                    }
                }
            });
            /* select Kategori */
        }
        get_data_users();


        var get_data_lokasi = function() {
            /* select role */
            $.ajax({
                type: 'POST',
                url: base_url + 'users/get_data_lokasi',
                data: {},
                dataType: 'json',
                success: function(data) {
                    $('#lokasi').empty();
                    var $kategori = $('#lokasi');
                    $kategori.append('<option value=0 selected> - Pilih Lokasi - </option>');
                    for (var i = 0; i < data.length; i++) {
                        $kategori.append('<option value=' + data[i].value + '>' + data[i].nama + '</option>');
                    }
                }
            });
            /* select Kategori */
        }
        get_data_lokasi();




        $("#btn_simpan").click(function() {
            if ($("#nama").val() == '') {
                Command: toastr["warning"]("Silahkan masukan nama !", "Opps !");
                $("#nama").focus();
            }
            else if ($("#email").val() == '') {
                Command: toastr["warning"]("Silahkan masukan email !", "Opps !");
                $("#email").focus();
            }
            else if ($("#role").val() == 0) {
                Command: toastr["warning"]("Silahkan pilih role !", "Opps !");
                $("#role").focus();
            }
            else if ($("#pt").val() == 0) {
                Command: toastr["warning"]("Silahkan pilih pt !", "Opps !");
                $("#pt").focus();
            }
            else if ($("#group_modul").val() == 0) {
                Command: toastr["warning"]("Silahkan pilih modul !", "Opps !");
                $("#group_modul").focus();
            }
            else if ($("#lokasi").val() == 0) {
                Command: toastr["warning"]("Silahkan pilih lokasi !", "Opps !");
                $("#lokasi").focus();
            }
            else if ($("#username").val() == 0) {
                Command: toastr["warning"]("Silahkan masukan username !", "Opps !");
                $("#username").focus();
            }
            else if ($("#pass_word").val() == 0) {
                Command: toastr["warning"]("Silahkan masukan password !", "Opps !");
                $("#pass_word").focus();
            }
            else {

                swal({
                        title: "Simpan Data Pengguna ?",
                        text: "Silahkan periksa kembali harga yang ingin disimpan.",
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
                            url: base_url + 'users/simpan',
                            type: "post",
                            dataType: 'json',
                            data: {
                                lokasi: $("#lokasi").val(),
                                pt: $("#pt").val(),
                                nama: $("#nama").val(),
                                username: $("#username").val(),
                                email: $("#email").val(),
                                role: $("#role").val(),
                                password: $("#pass_word").val(),
                                group_modul: $("#group_modul").val(),
                                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                            },
                            success: function(response) {
                                if (response == true) {
                                    swal.close();
                                    Command: toastr["success"]("Data Pengguna berhasil disimpan", "Berhasil");
                                    get_data_users();
                                    data_users();
                                    get_pt();
                                    $("#nama").val('');
                                    $("#email").val('');
                                    $("#role").val(0);
                                    $("#pt").val(0);
                                    $("#group_modul").val(0);
                                    $("#lokasi").val(0);
                                    $("#username").val('');
                                    $("#pass_word").val('');
                                } else {
                                    Command: toastr["error"]("Response Ajax Error !!", "Error");
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                Command: toastr["error"]("Ajax Error !!", "Error");
                            }
                        });

                    });
            }

        });


        var get_pt = function() {
            /* select role */
            $.ajax({
                type: 'POST',
                url: base_url + 'login/get_pt',
                data: {},
                dataType: 'json',
                success: function(data) {
                    $('#pt').empty();
                    var $kategori = $('#pt');
                    $kategori.append('<option value=0>-Pilih PT-</option>');
                    for (var i = 0; i < data.length; i++) {
                        $kategori.append('<option value=' + data[i].kode_pt + '>' + data[i].nama_pt + '</option>');
                    }
                }
            });
            /* select Kategori */
        }
        get_pt();


    });

    //Command: toastr["error"]("Silahkan Masukan Angka, Tidak Boleh Huruf !", "Info");
</script>


<?php
//ini kode random untuk token
$tokenx = "";
$codeAlphabet = "7539883715";
$codeAlphabet .= "8763487683";
$codeAlphabet .= "123456789";

$max = strlen($codeAlphabet) - 1;
for ($i = 0; $i < 5; $i++) {
    $tokenx .= $codeAlphabet[mt_rand(0, $max)];
}
//ini kode random untuk token
?>

<nav>
    <div id="jCrumbs" class="breadCrumb module">
        <ul>
            <li>
                <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token'); ?>')"><i class="icon-home"></i></a>
            </li>
            <li>
                <a href="#">Pengguna</a>
            </li>
            <li>
                <a href="#">Data Pengguna</a>
            </li>
        </ul>
    </div>
</nav>


<div class="row-fluid">
    <div class="span3">
        <h3 class="heading">Form Input Pengguna</h3>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Nama </label>
            <input type="text" id="nama" name="nama" class="form-control">
        </div>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Email </label>
            <input type="email" id="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Role </label>
            <select class="form-control" id="role" name="role"></select>
        </div>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">PT / Site </label>
            <select class="form-control" name="pt" id="pt"></select>
        </div>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Group Modul</label>
            <select class="form-control" name="group_modul" id="group_modul"></select>
        </div>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Lokasi </label>
            <select class="form-control" name="lokasi" id="lokasi"></select>
        </div>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Username </label>
            <input type="text" id="username" name="username" class="form-control" style="border-color:blue" placeholder="Masukan Username Disini">
        </div>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Password </label>
            <!-- <input type="text" id="pass_word" name="pass_word" class="form-control" value="<?php echo $tokenx; ?>" style="border-color:blue" readonly=""> -->
            <input type="password" id="pass_word" name="pass_word" class="form-control" style="border-color:blue" placeholder="Masukan Password Disini">
            <!-- <br>
            <span style="font-size: 12px;color:red">* Silahkan catat password ini.</span> -->
        </div>
        <hr>
        <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_simpan"><i class="fa fa-save"></i> Simpan </button>
    </div>
    <div class="span9">
        <h3 class="heading">Data Pengguna</h3>
        <div class="table-responsive">
            <table id="tabel_role" class="table table-striped table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 2%">No</th>
                        <th style="width: 20%">Nama Role</th>
                        <th style="width: 20%">PT / Site</th>
                        <th style="width: 10%">Username</th>
                        <th style="width: 10%">Email</th>
                        <th style="width: 10%">Role</th>
                        <th style="width: 10%">Lokasi</th>
                        <th style="width: 10%">Modul</th>
                        <th style="width: 10%">Edit</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>