<script type="text/javascript">
    $(document).ready(function() {
        $('#btn_voucher').click(function() {
            if ($("#pw").val() == '') {
                Command: toastr["error"]("Silahkan masukan password terlebih dahulu !", "Opss..");
                $("#pw").focus();
            }
            else {
                if ($("#pw").val() != '12345') {
                    Command: toastr["error"]("Password Salah, Silahkan ulangi dan coba ingat kembali !", "Opss..");
                    $("#pw").val('');
                    $("#pw").focus();
                }
                else {

                    getcontents('cash_bank/input_voucher_new', '<?php echo $tokens; ?>');

                }
            }

        });
        loading();
    });
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
                <a href="#">Input Voucher</a>
            </li>
        </ul>
    </div>
</nav>


<div class="row-fluid" id="pw_periode">
    <form id="form_input_vou" method=POST enctype='multipart/form-data'>
        <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="alert alert-danger">
            <strong>Info !</strong> Periode Bulan & Tahun tidak sesuai dengan periode berjalan saat ini , silahkan masukan password untuk input voucher !
        </div>
        <div class="section-wrapper">
            <h3 class="heading">Input Voucher Cash Bank</h3>
            <div class="row-fluid">
                <div class="span2" style="margin-right:10px;">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Password</label>
                        <input type="password" id="pw" name="pw" class="form-control maskmoney" placeholder="Password">
                    </div>
                </div>
            </div>
            <br>
            <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1" id="btn_voucher">Submit <i class="splashy-arrow_large_right"></i></button>
        </div>
    </form>
</div>