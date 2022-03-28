<script type="text/javascript">
    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';



        // validation file extension
        $('#file_coa').change(function() {
            var file = $('#file_coa')[0].files[0];
            var fileName = file.name;
            var fileExt = fileName.substr(fileName.lastIndexOf('.') + 1);
            var fileSize = file.size;
            var fileSizeMB = fileSize / (1024 * 1024);
            var fileExtVal = ['xls', 'xlsx'];
            if ($.inArray(fileExt.toLowerCase(), fileExtVal) == -1) {
                swal({
                    title: "Gagal",
                    text: "File yang diperbolehkan hanya xls atau xlsx",
                    type: "error",
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#file_coa').val('');
            } else if (fileSizeMB > 10) {
                swal({
                    title: "Gagal",
                    text: "File tidak boleh lebih dari 10MB",
                    type: "error",
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#file_coa').val('');
            }
        });


        // upload file
        // $('#btn_upload_coa').click(function() {
        //     var form_data = new FormData();
        //     var file = $('#file_coa')[0].files[0];
        //     form_data.append('file', file);
        //     form_data.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
        //     $.ajax({
        //         url: '<?php echo base_url(); ?>gl/coa/upload_coa',
        //         dataType: 'text',
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         data: form_data,
        //         type: 'post',
        //         success: function(response) {
        //             var data = $.parseJSON(response);
        //             if (data.status == '200') {
        //                 swal({
        //                     title: "Berhasil",
        //                     text: "Upload Berhasil",
        //                     type: "success",
        //                     timer: 1500,
        //                     showConfirmButton: false
        //                 });
        //                 setTimeout(function() {
        //                     window.location.reload(1);
        //                 }, 1600);
        //             } else {
        //                 swal({
        //                     title: "Gagal",
        //                     text: data.notif,
        //                     type: "error",
        //                     timer: 1500,
        //                     showConfirmButton: false
        //                 });
        //             }
        //         }
        //     });
        // });


        $('#upload_coa').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?php echo base_url(); ?>coa/upload_coa',
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                beforeSend: function() {
                    loadingPannel.show();
                },
                success: function(data) {
                    loadingPannel.hide();
                    $('#file_coa').val('');
                    if (response == true) {
                        swal({
                            title: "Berhasil",
                            text: "Upload Berhasil",
                            type: "success",
                            timer: 1500,
                            showConfirmButton: false
                        });
                        location.reload();

                    } else {
                        swal({
                            title: "Gagal",
                            text: 'data gagal diupload',
                            type: "error",
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                }
            });


        });

    });


    function upload_files() {

        // console.log("Hello WORLD");

        var form_data = new FormData();
        // var file = $('#file_coa').val();
        form_data.append('file', $('#file_coa').val());
        // form_data.append('file', file);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('coa/upload_coa') ?>",
            data: form_data,
            dataType: "json",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                // var data = $.parseJSON(response);
                console.log('ini response nya', response);
                if (response == true) {
                    swal({
                        title: "Berhasil",
                        text: "Upload Berhasil",
                        type: "success",
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 1600);
                } else {
                    swal({
                        title: "Gagal",
                        text: 'data gagal diupload',
                        type: "error",
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            }
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
                <a href="#">GL</a>
            </li>
            <li>
                <a href="#">Upload Coa</a>
            </li>
        </ul>
    </div>
</nav>



<style type="text/css">
    .space_kanan {}
</style>




<form id="upload_coa" method=POST enctype='multipart/form-data'>
    <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">


    <div class="section-wrapper">
        <h3 class="heading">Upload COA</h3>

        <div class="row-fluid">
            <div class="span8">
                <div class="span4">
                    <div class="form-group">
                        <!-- <label for="demo-vs-definput" class="control-label">COA</label> -->
                        <input type="file" id="file_coa" name="file_coa" class="form-control maskmoney span17">
                    </div>
                </div>


            </div>
        </div>



        <br>
        <button type="submit" class="btn btn-info btn-min-width mr-1 mb-1" id="btn_simpan"> Simpan </button>

    </div>

</form>