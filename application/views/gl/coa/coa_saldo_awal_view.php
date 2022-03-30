<script type="text/javascript">
      $(document).ready(function() {

            var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

            loading();

            // document.getElementById("acctno").addEventListener("keyup", function(event) {
            //       event.preventDefault();
            //       if (event.keyCode === 13) {
            //             getpopup('gl/master_tabel_coa_popup', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', '1');
            //       }
            // });

            $('.maskmoney_money').maskMoney({
                  thousands: ',',
                  decimal: '.',
                  precision: 0,
            });

            // $("#btn_simpan").click(function() {


            //       if ($("#acctno").val() == '') {
            //             Command: toastr["error"]("No Account tidak boleh kosong !", "Error");
            //             $("#acctno").focus();
            //       }
            //       else if ($("#acctname").val() == '') {
            //             Command: toastr["error"]("Nama Account tidak boleh kosong !", "Error");
            //             $("#acctname").focus();
            //       }
            //       else if ($("#nilai_saldo").val() == '') {
            //             Command: toastr["error"]("Silahkan masukan Nilai Saldo !", "Error");
            //             $("#nilai_saldo").focus();
            //       }
            //       else {


            //             var periodex = "<?php echo $this->session->userdata('sess_periode'); ?>";
            //             var tahun_periode = periodex.substr(0, 4);
            //             var bulan_periode = periodex.substr(4, 2);

            //             $.ajax({
            //                   url: base_url + 'cash_bank/cek_saldo_awal',
            //                   type: "post",
            //                   data: {
            //                         acctno: $("#acctno").val(),
            //                         tahun: tahun_periode,
            //                         <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            //                   },
            //                   dataType: "json",
            //                   async: 'false',
            //                   success: function(result) {
            //                         if (result == 1) {

            //                               swal({
            //                                           title: "Data sudah tersedia !",
            //                                           text: "Apakah anda ingin merubah saldo awal ? kalo ya, silahkan klik tombol update.",
            //                                           type: "info",
            //                                           showCancelButton: true,
            //                                           closeOnConfirm: false,
            //                                           showLoaderOnConfirm: true,
            //                                           confirmButtonText: "Update",
            //                                           //confirmButtonColor: "#E73D4A"
            //                                           confirmButtonColor: "#286090"
            //                                     },
            //                                     function() {

            //                                           //ini jika ada data noac dan tahun, maka proses update
            //                                           $.ajax({
            //                                                 url: base_url + 'cash_bank/update_saldo_awal',
            //                                                 type: "post",
            //                                                 data: {
            //                                                       acctno: $("#acctno").val(),
            //                                                       tahun: tahun_periode,
            //                                                       bulan: bulan_periode,
            //                                                       acctname: $("#acctname").val(),
            //                                                       saldo: $("#nilai_saldo").val(),
            //                                                       <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            //                                                 },
            //                                                 dataType: "json",
            //                                                 async: 'false',
            //                                                 success: function(result) {
            //                                                       if (result == true) {
            //                                                             swal.close();
            //                                                             Command: toastr["success"]("Saldo awal berhasil di update.", "Berhasil");
            //                                                             getcontents('cash_bank/saldo_awal', '<?php echo $this->session->userdata('sess_token'); ?>');
            //                                                             $("#acctno").val('');
            //                                                             $("#acctname").val('');
            //                                                             $("#nilai_saldo").val('');
            //                                                             data_saldo_awal();
            //                                                       } else {
            //                                                             Command: toastr["success"]("Data belum ke simpan", "Error");
            //                                                       }
            //                                                 },
            //                                                 beforeSend: function() {
            //                                                       loadingPannel.show();
            //                                                 },
            //                                                 complete: function() {
            //                                                       loadingPannel.hide();
            //                                                 }
            //                                           });

            //                                     });


            //                         } else {


            //                               $.ajax({
            //                                     url: base_url + 'cash_bank/simpan_saldo_awal',
            //                                     type: "post",
            //                                     data: {
            //                                           acctno: $("#acctno").val(),
            //                                           tahun: tahun_periode,
            //                                           bulan: bulan_periode,
            //                                           acctname: $("#acctname").val(),
            //                                           saldo: $("#nilai_saldo").val(),
            //                                           <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            //                                     },
            //                                     dataType: "json",
            //                                     async: 'false',
            //                                     success: function(result) {
            //                                           if (result.status == true) {
            //                                                 swal.close();
            //                                                 Command: toastr["success"]("Saldo awal berhasil di simpan.", "Berhasil");
            //                                                 getcontents('cash_bank/saldo_awal', '<?php echo $this->session->userdata('sess_token'); ?>');
            //                                                 $("#acctno").val('');
            //                                                 $("#acctname").val('');
            //                                                 $("#nilai_saldo").val('');
            //                                                 data_saldo_awal();
            //                                           } else {
            //                                                 Command: toastr["success"]("Data belum ke simpan", "Error");
            //                                           }
            //                                     },
            //                                     beforeSend: function() {
            //                                           loadingPannel.show();
            //                                     },
            //                                     complete: function() {
            //                                           loadingPannel.hide();
            //                                     }
            //                               });

            //                         }
            //                   },
            //                   beforeSend: function() {
            //                         //loadingPannel.show();
            //                   },
            //                   complete: function() {
            //                         //loadingPannel.hide();
            //                   }
            //             });

            //       }

            // });

            //datatables
            table = $('#tabel_saldo_awal').DataTable({

                  // "scrollY": 400,
                  "scrollX": true,

                  "processing": true,
                  "serverSide": true,
                  "order": [],

                  "ajax": {
                        "url": "<?php echo site_url('gl/list_acc_saldo') ?>",
                        "type": "POST"
                  },

                  "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                  }, ],
                  "language": {
                        "infoFiltered": ""
                  },
            });

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
                        <a href="#">Saldo Awal</a>
                  </li>
            </ul>
      </div>
</nav>

<div id="page_posting">

      <form id="form_input" method=POST enctype='multipart/form-data'>
            <input type='hidden' class='form-control' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>">


            <div class="section-wrapper">
                  <h3 class="heading">Saldo Awal GL</h3>

                  <!-- <div class="tabbable tabbable-bordered">
                        <ul class="nav nav-tabs">
                              <li class="active"><a href="javascript:void(0)" data-toggle="tab" style="color:#870505;"><b>Form Input Saldo Awal</b></a></li>
                        </ul>
                        <div class="tab-content" style="padding-left:10px;padding-right:10px;padding-bottom:10px;padding-top:0px;">
                              <div class="tab-pane active" id="tab_br1">
                                    <p>
                                    <div>

                                          <div class="row-fluid">
                                                <div class="span2">
                                                      <div class="form-group" style="padding-right:20px">
                                                            <label for="demo-vs-definput" class="control-label">No. Account</label>
                                                            <input type="text" id="acctno" name="acctno" class="form-control" style="width:118%">
                                                      </div>
                                                </div>
                                                <div class="span2">
                                                      <div class="form-group">
                                                            <label for="demo-vs-definput" class="control-label">Nama Account</label>
                                                            <input type="text" id="acctname" name="acctname" class="form-control" style="width:105%" readonly>
                                                      </div>
                                                </div>
                                                <div class="span2">
                                                      <div class="form-group">
                                                            <label for="demo-vs-definput" class="control-label">Nilai Saldo</label>
                                                            <input type="text" id="nilai_saldo" name="nilai_saldo" class="form-control maskmoney_money" style="width:105%">
                                                      </div>
                                                </div>
                                                <div class="span1">
                                                      <div class="form-group">
                                                            <label for="demo-vs-definput" class="control-label">Nilai Saldo</label>
                                                            <select class="form-control" name="divisi_v" id="divisi_v" style="width:125%">
                                                                  <option value="0">-Pilih-</option>
                                                                  <option value="01">01</option>
                                                                  <option value="02">02</option>
                                                                  <option value="06">06</option>
                                                            </select>
                                                      </div>
                                                </div>
                                                <div class="span2">
                                                      <div class="form-group">
                                                            <label for="demo-vs-definput" class="control-label" style="color:white">x</label>
                                                            <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1" id="btn_simpan">Simpan</button>
                                                      </div>
                                                </div>

                                          </div>
                                    </div>
                              </div>
                        </div>


                  </div> -->
            </div>

            <!-- footer -->
</div>

<div class="row-fluid" style="margin-top: -30px;">
      <div class="span12">

            <br>
            <table id="tabel_saldo_awal" class="table table-striped table-bordered table-condensed" width="100%">
                  <thead>
                        <tr>
                              <th>No</th>
                              <th>No. Account</th>
                              <th style="width:auto">Nama&nbsp;Account</th>
                              <th>Group</th>
                              <th>Type</th>
                              <th>Level</th>
                              <th>balancedr</th>
                              <th>balancecr</th>
                              <th>1d</th>
                              <th>1c</th>
                              <th>2d</th>
                              <th>2c</th>
                              <th>3d</th>
                              <th>3c</th>
                              <th>4d</th>
                              <th>4c</th>
                              <th>5d</th>
                              <th>5c</th>
                              <th>6d</th>
                              <th>6c</th>
                              <th>7d</th>
                              <th>7c</th>
                              <th>8d</th>
                              <th>8c</th>
                              <th>9d</th>
                              <th>9c</th>
                              <th>10d</th>
                              <th>10c</th>
                              <th>11d</th>
                              <th>11c</th>
                              <th>12d</th>
                              <th>12c</th>
                              <th>Yeard</th>
                              <th>Yearc</th>
                        </tr>
                  </thead>
                  <tbody></tbody>
            </table>
      </div>
</div>



</div>

</div>

</form>

</div>