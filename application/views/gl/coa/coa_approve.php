<script type="text/javascript">
    $(document).ready(function() {

        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';

        // loading();

        data_coa()

        function formatSeconds(seconds) {
            var date = new Date();
            date.setSeconds(seconds);
            return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
        }

        loading();

    });



    function data_coa() {
        $('#approve_coa').DataTable().destroy();
        $('#approve_coa').DataTable({

            "fixedColumns": true,
            "fixedHeader": true,
            // "scrollY": 400,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('coa/data_approve_coa') ?>",
                "type": "POST"
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
            $('#approve_coa').DataTable().ajax.reload();
            clearInterval(rel);
        }, 100);
    }

    function pilih_approved(id) {
        // console.log(id);
        getpopup('coa/modal_approve_coa', '<?php echo $this->session->userdata('sess_token'); ?>', 'popupedit', id);
    }
</script>

<style type="text/css">
    table#approve_coa td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>



<div id="jCrumbs" class="breadCrumb module">
    <ul>
        <li>
            <a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token'); ?>')"><i class="icon-home"></i></a>
        </li>
        <li>
            <a href="#">GL</a>
        </li>
        <li>
            <a href="#">Data Approval COA</a>
        </li>
    </ul>
</div>
</nav>
<div class="row-fluid">
    <div class="span12">

        <div id="progress"></div>
        <div class="table-responsive">
            <table id="approve_coa" class="table table-hover table-striped table-responsive table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th width="5%" style="font-size: 12px; padding:10px">Approval</th>
                        <th width="4%" style="font-size: 12px; padding:10px">No</th>
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