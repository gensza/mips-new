<script type="text/javascript">
    $(document).ready(function() {
        var tokens = '<?php echo $tokens; ?>';
        var id_modal = '<?php echo $id_modal; ?>';
        var id_pengguna = '<?php echo $id_row; ?>';

        $("#idpengguna").val(id_pengguna);

        $.ajax({
            url: base_url + 'users/detail',
            type: "post",
            dataType: 'json',
            data: {
                id_pengguna: id_pengguna,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(res) {
                $("#nama_edit").val(res.nama);
                $("#role_edit").val(res.id_module_role);
                // $("#pt_edit").val(res.id_pt);

                console.log(res.id_pt);

                $.ajax({
                    type: 'POST',
                    url: base_url + 'users/get_data_lokasi',
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('#lokasi_edit').empty();
                        var $kategori = $('#lokasi_edit');
                        $kategori.append('<option value=0 selected> - Pilih Lokasi - </option>');
                        for (var i = 0; i < data.length; i++) {
                            if (res.id_lokasi == data[i].value) {
                                $kategori.append('<option value=' + data[i].value + ' selected>' + data[i].nama + '</option>');
                            } else {
                                $kategori.append('<option value=' + data[i].value + '>' + data[i].nama + '</option>');
                            }
                        }
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: base_url + 'role/data',
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('#role_edit').empty();
                        var $kategori = $('#role_edit');
                        for (var i = 0; i < data.length; i++) {

                            if (res.id_module_role == data[i].id) {
                                $kategori.append('<option value=' + data[i].id + ' selected>' + data[i].nama + '</option>');
                            } else {
                                $kategori.append('<option value=' + data[i].id + '>' + data[i].nama + '</option>');
                            }


                        }
                    }
                });


                $.ajax({
                    type: 'POST',
                    url: base_url + 'users/get_pt',
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('#pt_edit').empty();
                        var $kategori = $('#pt_edit');
                        $kategori.append('<option value=0>-Pilih PT-</option>');
                        for (var i = 0; i < data.length; i++) {
                            if (res.id_pt == data[i].kode_pt) {
                                $kategori.append('<option value=' + data[i].kode_pt + ' selected>' + data[i].nama_pt + '</option>');
                            } else {
                                $kategori.append('<option value=' + data[i].kode_pt + '>' + data[i].nama_pt + '</option>');
                            }
                        }
                    }
                });


                $.ajax({
                    type: 'POST',
                    url: base_url + 'role/group_modul',
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('#group_modul_edit').empty();
                        var $kategori = $('#group_modul_edit');
                        $kategori.append('<option value=0 selected> -Pilih Group Modul- </option>');
                        for (var i = 0; i < data.length; i++) {
                            if (res.group_modul == data[i].valueid) {
                                $kategori.append('<option value=' + data[i].valueid + ' selected>' + data[i].nama + '</option>');
                            } else {
                                $kategori.append('<option value=' + data[i].valueid + '>' + data[i].nama + '</option>');
                            }
                        }
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: base_url + 'role/dept',
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('#dept_edit').empty();
                        var $kategori = $('#dept_edit');
                        $kategori.append('<option value=0 selected> -Pilih Departement- </option>');
                        for (var i = 0; i < data.length; i++) {
                            if (res.kode_dept == data[i].kode) {
                                $kategori.append('<option value=' + data[i].kode + ' selected>' + data[i].nama + '</option>');
                            } else {
                                $kategori.append('<option value=' + data[i].kode + '>' + data[i].nama + '</option>');
                            }
                        }
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: base_url + 'role/level',
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('#level_edit').empty();
                        var $kategori = $('#level_edit');
                        $kategori.append('<option value=0 selected> -Pilih Departement- </option>');
                        for (var i = 0; i < data.length; i++) {
                            if (res.kode_level == data[i].kode_level) {
                                $kategori.append('<option value=' + data[i].kode_level + ' selected>' + data[i].level + '</option>');
                            } else {
                                $kategori.append('<option value=' + data[i].kode_level + '>' + data[i].level + '</option>');
                            }
                        }
                    }
                });


            },
            error: function(jqXHR, textStatus, errorThrown) {
                Command: toastr["error"]("Ajax Error !!", "Error");
            }

        });



        $("#btn_update_pengguna").click(function() {
            swal({
                    title: "Update Data Pengguna ?",
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

                    var form_data = new FormData($('#form_input')[0]);

                    $.ajax({
                        url: base_url + 'users/update',
                        type: "POST",
                        dataType: 'json',
                        mimeType: 'multipart/form-data',
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {

                            if (data == true) {
                                $('#' + id_modal).modal('hide');
                                swal.close();
                                Command: toastr["success"]("Data Pengguna Berhasil Di Update", "Berhasil");
                                getcontents('users', '<?php echo $tokens; ?>');
                            } else {
                                Command: toastr["error"]("Simpan error, data tidak berhasil disimpan", "Error");
                            }
                        }
                    });

                });


        });



    });
</script>


<div class="modal hide modal-sm" id="<?php echo $id_modal; ?>">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Edit Pengguna</h3>
    </div>
    <div class="modal-body">
        <form id="form_input" method=POST enctype='multipart/form-data'>
            <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" class="form-control" value="<?php echo $id_row; ?>" name="idpengguna" id="idpengguna">

            <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Nama Pengguna</label>
                <input type="text" id="nama_edit" name="nama_edit" class="form-control">
            </div>

            <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Departement</label>
                <select class="form-control" name="dept_edit" id="dept_edit"></select>
            </div>
            <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Level</label>
                <select class="form-control" name="level_edit" id="level_edit"></select>
            </div>

            <div class="form-group">
                <label for="demo-vs-definput" class="control-label">PT / Site</label>
                <select class="form-control" name="pt_edit" id="pt_edit"></select>
            </div>

            <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Group Modul</label>
                <select class="form-control" name="group_modul_edit" id="group_modul_edit"></select>
            </div>

            <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Lokasi </label>
                <select class="form-control" name="lokasi_edit" id="lokasi_edit"></select>
            </div>

            <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Role </label>
                <select class="form-control" id="role_edit" name="role_edit"></select>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info" id="btn_update_pengguna"><i class="fa fa-save"></i> Update</button>
        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
    </div>
</div>