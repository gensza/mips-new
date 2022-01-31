<script type="text/javascript">
    $(document).ready(function() {
        // var c_tokens = '<?php echo $this->session->userdata("sess_token"); ?>';
        var c_usid = '<?php echo $this->session->userdata("sess_id"); ?>';
        var c_active = '<?php echo $this->session->userdata("sess_aktif"); ?>';

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

        loading_posting();

        //periode session
        swal({
                title: "Selesaikan transaksi anda ",
                text: "Anda memiliki transaksi yang belum diselesaikan, silahkan klik tombol lanjutkan",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                allowEscapeKey: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Lanjutkan",
                confirmButtonColor: "#286090"
            },
            //lanjutkan transaksi
            function(isConfirm) {
                if (isConfirm) {
                    swal.close();
                    $("#swalvou").hide();
                    getcontents('cash_bank/postVoucher', '<?php echo $tokens; ?>');
                } else {
                    window.location.href = base_url + "index.aspx?TokEn=" + tokens + "&IdUs=" + c_usid + "&AkTif=" + c_active + "";
                }
            }
        );

    });
</script>

<style type="text/css">
    .space_kanan {}
</style>

<div id="swalvou" style="display:none">

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


</div>