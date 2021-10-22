<script type="text/javascript">
$(document).ready(function(){
    
    var tokens   = '<?php echo $this->session->userdata('sess_token');?>';
    
    loading_posting();

    $("#btn_posting").click(function(){
        
        if($("#password").val() == ''){
            Command: toastr["error"]("Silahkan masukan password terlebih dahulu !", "Opss..");
            $("#password").focus();
        }else{


            if($("#password").val() != '12345'){
                Command: toastr["error"]("Password Salah, Silahkan ulangi dan coba ingat kembali !", "Opss..");
                $("#password").val('');
                $("#password").focus();
            }else{



                var form_data = new FormData($('#form_input')[0]);
        
                swal({
                    title: "Posting Sekarang ?",
                    text: "Jika ingin disimpan, silahkan klik button simpan",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Ya Posting",
                    //confirmButtonColor: "#E73D4A"
                    confirmButtonColor: "#286090"
                },
                function(){

                    swal.close();
                    $("#page_posting").hide();
                    loadingPannel.show();
                    
                    $.ajax({
                        url             : base_url + 'gl_analis/posting_act', 
                        type            : "POST",
                        dataType        : 'json',
                        mimeType        : 'multipart/form-data',
                        data            : form_data,
                        contentType     : false,
                        cache           : false,
                        processData     : false,
                        success     : function(response){

                            //Command: toastr["success"]("Proses posting selesai", "Ok Posting Tersimpan");
                    },
                    beforeSend: function () {
                        time = new Date();
                        loadingPannel.show();
                    },
                    complete: function () {
                        var end = new Date().getTime();
                        var total = end - time;
                        loadingPannel.hide();
                        swal("Selesai", "Terima Kasih, Data berhasil di Posting dan tersimpan, Waktu Proses Posting "+total+" Second.", "success");

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Command: toastr["error"]("Opps..Maaf terjadi kesahalan pada saat simpan data! Data Belum tersimpan.", "Error");
                    }

                    });

                });

            }

        } 
        
    });


    $(".select2").select2({
        //minimumInputLength: 2
    });


});    
</script>
    

     <nav>
                    <div id="jCrumbs" class="breadCrumb module">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token');?>')"><i class="icon-home"></i></a>
                                </li>
                                <li>
                                    <a href="#">GL</a>
                                </li>
                                <li>
                                    <a href="#">Posting Transaksi</a>
                                </li>
                            </ul>
                        </div>
                    </nav>



<style type="text/css">
    .space_kanan{
        
    }
</style>
    
    <div id="page_posting">

    <form id="form_input"  method=POST enctype='multipart/form-data'>
            <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">


    <div class="section-wrapper">
         <h3 class="heading">Posting Transaksi</h3>
        <div class="row-fluid">
            <div class="span2" style="margin-right:10px;">
                <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Password</label>
                    <input type="text" id="password" name="password" class="form-control maskmoney" placeholder="Password">
                    <div class="checkbox">
                        <label><input type="checkbox" value="1" name="total">Posting Total</label>
                    </div>
                </div>
            </div> 
        </div>

        <br>
            <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1" id="btn_posting">Posting Sekarang <i class="splashy-arrow_large_right"></i></button>

    </div>
    
    </form>

    </div>


    




    
    

