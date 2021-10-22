<script type="text/javascript">
$(document).ready(function(){
    var tokens          = '<?php echo $tokens;?>';
    loading();
    
    $("#tambah_jurnal_alokasi").click(function(){
        getcontents('gl/jurnal_alokasi_tambah','<?php echo $tokens;?>');
    });
    
});    

</script>

    <div id="jCrumbs" class="breadCrumb module">
        <ul>
            <li>
                <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token');?>')"><i class="icon-home"></i></a>
            </li>
            <li>
                <a href="#">GL</a>
            </li>
            <li>
                <a href="#">Alokasi Jurnal</a>
            </li>
        </ul>
    </div>

    <button class="btn btn-sm btn-primary" id="tambah_jurnal_alokasi">Buat Jurnal Alokasi</button>
    <br>
    <br>
    
    <div class="row-fluid">
        <div class="span12">
            <div id="progress"></div>
            <div class="table-responsive">
            <table id="tabel_vouc_history" class="table table-hover table-striped table-bordered" style="width: 100%">
                <thead>
                    <tr>
                    <th style="width: 2%">No</th>
                    <th style="width: 10%">Nomor / Keterangan</th>
                    <th style="width: 10%">Tanggal</th>
                    <th style="width: 5%">Periode</th>
                    <th style="width: 5%">Total Debit</th>
                    <th style="width: 5%">Total Kredit</th>
                    <th style="width: 5%">Edit</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
  


    




    
    

