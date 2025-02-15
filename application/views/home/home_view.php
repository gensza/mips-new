<script type="text/javascript">
  // console.log("<?= $this->session->userdata('sess_id_lokasi') ?>");

  function data_coa(data) {
    $('#coa_approve').DataTable().destroy();
    $('#coa_approve').DataTable({

      "fixedColumns": true,
      "fixedHeader": true,
      // "scrollY": 400,
      "scrollX": true,

      "processing": true,
      "serverSide": true,
      "order": [],

      "ajax": {
        "url": "<?php echo site_url('coa/data_approve_coa') ?>",
        "type": "POST",
        "data": {
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
          data: data,
        },
      },

      "columnDefs": [{
        "targets": [0],
        "orderable": false,
      }, ],
      "language": {
        searchPlaceholder: 'Cari',
        sSearch: '',
        lengthMenu: '_MENU_',
        "infoFiltered": ""
      },
    });

    var rel = setInterval(function() {
      $('#coa_approve').DataTable().ajax.reload();
      clearInterval(rel);
    }, 100);
  }

  function pilih_approved(id, noref, pt, alias) {

    getpopup_coa_approve('coa/modal_approve_coa', '<?php echo $this->session->userdata('sess_token'); ?>', 'approval_coa', id, noref, pt, alias);
  }

  $(document).ready(function() {
    var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

    // loading();
    $('#filter_spp').change(function() {
      var dt = this.value;
      // console.log(data);
      // dataSppFilter(data);
      data_coa(dt)
    });
    var filter = "SEMUA";
    data_coa(filter)


    loading();
  });
</script>
<?php
if ($this->session->userdata('sess_level') == 1) {
?>

  <div class="span2">
    <span style="color:white">&nbsp;</span>
  </div>
  <div class="span8">
    <div class="section-wrapper">
      <h3 class="heading">Hi, Administrator<b></b></h3>
      <div class="row-fluid">
        <span class="alert alert-info">Selamat Datang di <b>MIPS - <?php echo $namapt['nama']; ?>.</b></span>

        <!--<br>
            <br>

              <ul class="dshb_icoNav tac" style="padding: 0px">
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/multi-agents.png'); ?>"><span class="label label-info">+10</span> Pengguna</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/world.png'); ?>)">Map</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/configuration.png'); ?>)">Settings</a></li>
    
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/van.png'); ?>)"><span class="label label-success">$2851</span> Delivery</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/pie-chart.png'); ?>)">Charts</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/edit.png'); ?>)">Add New Article</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/add-item.png'); ?>)"> Add New Page</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/chat-.png'); ?>)"><span class="label label-important">26</span> Comments</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/add-item.png'); ?>)"> Add New Page</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/chat-.png'); ?>)"><span class="label label-important">26</span> Comments</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/add-item.png'); ?>)"> Add New Page</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/chat-.png'); ?>)"><span class="label label-important">26</span> Comments</a></li>
              </ul>

          -->

      </div>
    </div>
  </div>

<?php
} else {
?>
  <div class="span1">
    <span style="color:white">&nbsp;</span>
  </div>
  <div class="span11">
    <div class="section-wrapper">
      <h3 class="heading">Hi, <?php echo $ses_nama; ?> &nbsp; <b>
          <?php
          //                echo substr($this->session->userdata('sess_periode'), 0, 4);
          //                echo "<br>";
          //                echo substr($this->session->userdata('sess_periode'), 4, 6);
          //                echo "<br>";
          //                echo substr($this->session->userdata('sess_periode'), 0, 4).'-'.substr($this->session->userdata('sess_periode'), 4, 6);
          //            
          ?></b></h3>
      <div class="row-fluid">
        <span class="alert alert-info">Selamat Datang di <b>MIPS - <?php echo $namamodul['nama']; ?> - <?php echo $namapt['nama']; ?> - <?= $this->session->userdata('sess_nama_pt') ?></b></span>
        <!-- <input type="text" name="" id="" value="<?= $this->session->userdata('sess_level') ?>"> -->
        <br>
        <br>
      </div>
      <?php if ($this->session->userdata('sess_level') == 3) { ?>

        <div class="row-fluid">
          <div class="col-sm-12">
            <ul class="dshb_icoNav clearfix">
              <li><a href="javascript:void(0)" onclick="getcontents('cash_bank/saldo_awal', '<?php echo $tokens; ?>')" style="background-image: url(assets/img/gCons/dollar.png" )">
                  Saldo Awal</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/edit.png)" onclick="getcontents('cash_bank/input_voucher', '<?php echo $tokens; ?>')">Input Voucher</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/next-item.png)" onclick="getcontents('cash_bank/posting_harian', '<?php echo $tokens; ?>')">Posting harian</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/download.png)" onclick="getcontents('cash_bank/posting_ke_gl', '<?php echo $tokens; ?>')">Transfer Ke GL</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/bookmark.png)" onclick="getcontents('cash_bank/monthly_closing', '<?php echo $tokens; ?>')">Monthly Closing</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/configuration.png)" onclick="getcontents('cash_bank/configurasi', '<?php echo $tokens; ?>')">Konfigurasi</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/copy-item.png)" onclick="getcontents('cash_bank/laporan_vouc_register', '<?php echo $tokens; ?>')">Laporan Register</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/copy-item.png)" onclick="getcontents('cash_bank/laporan_vouc_journal', '<?php echo $tokens; ?>')">Laporan Journal</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/copy-item.png)" onclick="getcontents('cash_bank/laporan_aktifitas_account', '<?php echo $tokens; ?>')">Aktifitas Account</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/copy-item.png)" onclick="getcontents('cash_bank/saldo_akhir', '<?php echo $tokens; ?>')">Saldo Akhir</a></li>

            </ul>
          </div>
        </div>
      <?php } elseif ($this->session->userdata('sess_level') == 2) { ?>


        <div class="row-fluid">
          <div class="span12">
            <ul class="dshb_icoNav clearfix">
              <?php if ($this->session->userdata('sess_nama_lokasi') == 'HO') { ?>
                <li><a href="javascript:void(0)" onclick="getcontents('coa/approve_coa', '<?php echo $tokens; ?>')" style="background-image: url(assets/img/gCons/email.png)"><?php if ($count_data != 0) { ?>
                      <span class="label label-important"><?= $count_data ?></span>
                    <?php } ?>
                    Approval COA</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/edit.png)" onclick="getcontents('gl/master_input', '<?php echo $tokens; ?>')">Input COA</a></li>
              <?php } ?>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/addressbook.png)" onclick="getcontents('gl/master_tabel', '<?php echo $tokens; ?>')">Daftar COA</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/calculator.png)" onclick="getcontents('gl/saldo_awal', '<?php echo $tokens; ?>')">Saldo Awal</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/bar-chart.png)" onclick="getcontents('gl/transaksi_input', '<?php echo $tokens; ?>')">Transaksi Jurnal</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/bookmark.png)">Tutup Buku Tahunan</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/next-item.png)" onclick="getcontents('gl/posting_harian', '<?php echo $tokens; ?>')">Posting harian</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/copy-item.png)" onclick="getcontents('gl/report_jurnal', '<?php echo $tokens; ?>')">Laporan Jurnal</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/copy-item.png)" onclick="getcontents('gl/report_buku_besar', '<?php echo $tokens; ?>')">Laporan Buku Besar</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/copy-item.png)" onclick="getcontents('gl/report_trialbalance', '<?php echo $tokens; ?>')">Laporan Trial Balance</a></li>
              <?php if ($this->session->userdata('sess_nama_lokasi') == 'HO') { ?>

                <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/copy-item.png)" onclick="getcontents('gl/report_balance', '<?php echo $tokens; ?>')">Laporan Neraca</a></li>
              <?php } ?>

            </ul>
          </div>
        </div>

        <?php if ($this->session->userdata('sess_nama_lokasi') == 'HO') { ?>

          <div class="row-fluid">

            <div class="span12">
              <div class="heading clearfix">
                <h3 class="pull-left">Approval COA</h3>
                <div class="pull-right">

                  <select class="form-control form-control-sm" id="filter_spp" name="filter_spp">
                    <option value="SEMUA" selected>TAMPILKAN SEMUA</option>
                    <?php
                    foreach ($pt as $d) : {
                    ?>
                        <option value="<?= $d['alias']; ?>"><?= $d['nama_pt']; ?></option>
                    <?php
                      }
                    endforeach;
                    ?>
                  </select>
                </div>
              </div>
              <div class="mediaTableWrapper">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered mediaTable activeMediaTable" id="coa_approve" style="width: 100%">
                    <thead>

                      <tr>
                        <th width="5%" style="font-size: 12px; padding:10px">Approval</th>
                        <th width="3%" style="font-size: 12px; padding:10px">No</th>
                        <th width="5%" style="font-size: 12px; padding:10px">Sbu</th>
                        <th width="16%" style="font-size: 12px; padding:10px">No. Ref. SPP</th>
                        <th width="18%" style="font-size: 12px; padding:10px">PT</th>
                        <th width="9%" style="font-size: 12px; padding:10px">Dept</th>

                      </tr>
                    </thead>
                    <tbody>


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

      <?php } ?>


    </div>
  </div>


<?php
}
?>