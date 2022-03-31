<script type="text/javascript">
    $(document).ready(function() {
        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';
        var lokasi_usr = '<?php echo $this->session->userdata('sess_nama_lokasi'); ?>';

        swal({
                title: "Anda memilik transaksi yang belum selesai",
                text: "Jika ingin dilanjutkan, silahkan klik button lanjutkan",
                type: "info",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Lanjutkan",
            },
            function() {
                getcontents('cash_bank/ada_voucher', '<?php echo $this->session->userdata('sess_token'); ?>');
            });






    });
</script>

<style type="text/css">
    .space_kanan {}
</style>