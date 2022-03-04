<script type="text/javascript">
    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

        loading();

        $('.dataTables_length').addClass('bs-select');

        var data_role = function() {

            $.ajax({
                url: base_url + 'role/data_level',
                type: "post",
                data: {
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",
                async: 'false',
                success: function(result) {
                    // console.log(result);
                    var data = [];
                    for (var i = 0; i < result.length; i++) {
                        var no = i + 1;
                        var baseurl = '<?php echo base_url(); ?>';
                        var status_lokasi = result[i].status_lokasi;
                        if (status_lokasi == 'SITE') {
                            var lok = 'ESTATE';
                        } else {
                            var lok = result[i].status_lokasi;
                        }

                        var link_edit = "<div class='btn btn-default btn-sm' title='Akses' onclick=\"getpopup('role/edit','" + tokens + "','popupedit','" + result[i].id + "');\" ><i class='splashy-pencil'></i></div>";
                        // var link_akses = "<div class='btn btn-info btn-sm' title='Akses' onclick=\"getpopup('role/permission','" + tokens + "','popupedit','" + result[i].id + "');\" ><i class='splashy-view_outline_detail'></i></div>";
                        // var link_hapus = "<div class='btn btn-default' title='Hapus' onclick=\"hapus('" + result[i].id + "');\"><i class='splashy-gem_remove'></i></div>";

                        data.push([no, result[i].level, lok, link_edit]);

                    }

                    $('#tabel_role').DataTable({
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

                    /*$('#tabel_role').DataTable({
                        aaData                : data,
                        "sDom": "<'row'<'span6'<'dt_actions'>l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
                        "sPaginationType": "bootstrap_alt",
                        "oLanguage": {
                            "sLengthMenu": "_MENU_ records per page"
                        }
                    });*/

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
        data_role();

        //dataTables_paginate
        hapus = function(id_role) {
            alert(id_role)
        }

        $("#btn_simpan").click(function() {
            if ($("#kode_level").val() == '') {
                Command: toastr["warning"]("Silahkan masukan kode level !", "Opps !");
                $("#kode_level").focus();
            }
            else if ($("#nama_level").val() == '') {
                Command: toastr["warning"]("Silahkan masukan kode nama level !", "Opps !");
                $("#nama_level").focus();
            }
            else if ($("#lokasi").val() == '') {
                Command: toastr["warning"]("Silahkan masukan lokasi !", "Opps !");
                $("#lokasi").focus();
            }
            else {

                swal({
                        title: "Simpan Data Role ?",
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
                            url: base_url + 'role/simpan_level',
                            type: "post",
                            dataType: 'json',
                            data: {
                                kode: $("#kode_level").val(),
                                nama: $("#nama_level").val(),
                                lokasi: $("#lokasi").val(),
                                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                            },
                            success: function(response) {
                                if (response == true) {
                                    swal.close();
                                    Command: toastr["success"]("Data Role berhasil disimpan", "Berhasil");
                                    data_role();
                                    $("#kode_level").val('');
                                    $("#nama_level").val('');
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

        $("#tabel_role").addClass('pagination');

        $('#kode_level').keyup(function() {
            // console.log(this.value);
            var kode = this.value;
            $.ajax({
                url: base_url + 'role/kode',
                type: "post",
                dataType: 'json',
                data: {
                    kode: kode,
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(response) {
                    if (response > 0) {
                        Command: toastr["error"]("Kode sudah ada", "Gagal");
                        $('#kode_level').css({
                            "background": "#FFCECE"
                        });
                        $('#btn_simpan').attr('disabled', '');
                    }
                    else {
                        $('#kode_level').css({
                            "background": ""
                        });
                        $('#btn_simpan').removeAttr('disabled', '');


                    }
                }
            });
        });

        var get_lokasi = function() {
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
                        $kategori.append('<option value=' + data[i].nama + '>' + data[i].nama + '</option>');
                    }
                }
            });
            /* select Kategori */
        }
        get_lokasi();


    });
</script>





<nav>
    <div id="jCrumbs" class="breadCrumb module">
        <ul>
            <li>
                <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token'); ?>')"><i class="icon-home"></i></a>
            </li>
            <li>
                <a href="#">Pengaturan</a>
            </li>
            <li>
                <a href="#">Level</a>
            </li>
        </ul>
    </div>
</nav>


<div class="row-fluid">
    <div class="span3">
        <h3 class="heading">Form Input Level</h3>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Kode Level</label>
            <input type="number" id="kode_level" name="kode_level" class="form-control maskmoney">
        </div>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Nama Level</label>
            <input type="text" id="nama_level" name="nama_level" class="form-control maskmoney">
        </div>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Lokasi</label>
            <select class="form-control" name="lokasi" id="lokasi"></select>
        </div>
        <hr>
        <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_simpan"><i class="fa fa-save"></i> Simpan </button>
    </div>
    <div class="span9">
        <h3 class="heading">Data Level</h3>
        <div class="table-responsive">
            <table id="tabel_role" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Level</th>
                        <th>Lokasi</th>
                        <th>Edit</th>
                        <!-- <th>Hapus</th> -->
                        <!-- <th>Akses</th> -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>