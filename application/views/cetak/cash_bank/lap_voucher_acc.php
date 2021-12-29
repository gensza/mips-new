<style>
    table.blueTable {
        border: 1px solid #AAAAAA;
        background-color: white;
        width: 100%;
        text-align: left;
        border-collapse: collapse;
    }

    table.blueTable td,
    table.blueTable th {
        border: 1px solid black;
        padding: 3px 2px;
    }

    table.blueTable tbody td {
        font-size: 13px;
    }

    table.blueTable tr:nth-child(even) {
        background: white;
    }

    table.blueTable thead {
        background: white;
        background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        border-bottom: 1px solid black;
    }

    table.blueTable thead th {
        font-size: 15px;
        font-weight: bold;
        color: black;
        border-left: 1px solid black;
    }

    table.blueTable thead th:first-child {
        border-left: none;
    }

    table.blueTable tfoot {
        font-size: 14px;
        font-weight: bold;
        color: #FFFFFF;
        background: white;
        background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        border-top: 1px solid #444444;
    }

    table.blueTable tfoot td {
        font-size: 14px;
    }

    table.blueTable tfoot .links {
        text-align: right;
    }

    table.blueTable tfoot .links a {
        display: inline-block;
        background: white;
        color: #FFFFFF;
        padding: 2px 4px;
        border-radius: 2px;
    }

    .fontsize_global_header {
        font-size: 7px;
    }

    .font-styles {
        font-family: Verdana, Geneva, sans-serif;
        font-size: 10px;
    }
</style>



<table width="100%" border="0" class="font-styles">
    <tr>
        <td align="left" style="font-size:20px;"><?= $this->session->userdata('sess_nama_pt'); ?></td>
    </tr>
    <!--    <tr>
        <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
        </td>
    </tr>-->
</table>
<div style="width: 100%;text-align: right;font-size: 12px" class="font-styles">
    Tanggal : <?php echo date("m/d/Y"); ?>
    <br>
    Waktu : <?php
            date_default_timezone_set("Asia/Bangkok");
            echo date("h:i:s a", time()); ?>
</div>


<div style="width: 100%;text-align: center;" class="font-styles">
    <span style="font-size: 18px;font-weight: bold;">Perincian Aktivitas/Subledger</span>
    <br>
    <?php
    if ($this->uri->segment(5) == 0) {
    ?>
        <span style="font-size: 14px">Periode : <?php echo $this->uri->segment(3); ?> s/d <?php echo $this->uri->segment(4); ?></span>
    <?php
    } else {

    ?>
        <span style="font-size: 14px">Periode : <?php echo $this->uri->segment(3); ?> s/d <?php echo $this->uri->segment(4); ?></span>
        <!-- <span style="font-size: 14px">Periode ini : <?php echo $bulan; ?> <?php echo $tahun; ?></span> -->
    <?php
    }
    ?>

</div>

<br>
<table class="blueTable font-styles">
    <thead>
        <tr>
            <th>Tgl</th>
            <th>No. Vouc</th>
            <th>Kepada/Dari</th>
            <th>Keterangan</th>
            <th>Debit</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($res_data_head)) { ?>
            <tr>
                <td colspan="6" style="text-align: center;"> Tidak ada data</td>
            <tr>
                <?php } else {

                $period = $this->session->userdata('sess_periode');
                $tahun  = substr($period, 0, 4);
                $bulan  = substr($period, 4, 5);

                if ($bulan == '01') {
                    $var_bulan = '1';
                } else if ($bulan == '02') {
                    $var_bulan = '2';
                } else if ($bulan == '03') {
                    $var_bulan = '3';
                } else if ($bulan == '04') {
                    $var_bulan = '4';
                } else if ($bulan == '05') {
                    $var_bulan = '5';
                } else if ($bulan == '06') {
                    $var_bulan = '6';
                } else if ($bulan == '07') {
                    $var_bulan = '7';
                } else if ($bulan == '08') {
                    $var_bulan = '8';
                } else if ($bulan == '09') {
                    $var_bulan = '9';
                } else if ($bulan == '10') {
                    $var_bulan = '10';
                } else if ($bulan == '11') {
                    $var_bulan = '11';
                } else if ($bulan == '12') {
                    $var_bulan = '12';
                }
                $total = 0;
                foreach ($res_data_head as $v) {

                    $periode = $this->session->userdata('sess_periode');
                    $tahun  = substr($periode, 0, 4);
                    $bulan  = substr($periode, 4, 5);

                    $coa = $v['ACCTNO'];
                    $dc = $this->mips_caba->query("SELECT SUM(DEBIT) AS totaldr, SUM(CREDIT) AS totalcr FROM voucher WHERE ACCTNO='$coa' AND MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' ")->row();
                    $sd = $this->mips_caba->query("SELECT saldo FROM master_accountcb WHERE ACCTNO='$coa' AND thn ='$tahun' ")->row();
                    $total = $sd->saldo + $dc->totaldr - $dc->totalcr;

                    $vou = $this->mips_caba->query("SELECT ACCTNO FROM voucher WHERE ACCTNO='$coa' AND MONTH(`date`) = '$bulan' AND YEAR(`date`) = '$tahun' ")->num_rows();
                    if ($vou > 0) {
                ?>
            <tr>
                <td width="100px" colspan="4"><b>Account : () <?= $v['ACCTNO']; ?> <?= $v['ACCTNAME']; ?> </b></td>
                <td align="right" width="150px"><b><?= number_format($v["saldo_$var_bulan"], 2, ",", ".") ?></b>
                </td>
                <td align="right" width="150px">0
                </td>
            </tr>

            <?php foreach ($res_data as $a) {
                            if ($a['ACCTNO'] == $v['ACCTNO']) {
            ?>
                    <tr>
                        <td width="100px" align="center"><?= $a['TGL'] ?></td>
                        <td width="100px" align="center"><?= $a['VOUCNO'] ?></td>
                        <td align="left" width="100px"><?= $a['FROM'] ?></td>
                        <td align="left" width="250px"><?= $a['REMARKS'] ?></td>
                        <td align="right" width="150px"><?= $a['DEBET_F'] ?></td>
                        <td align="right" width="150px"><?= $a['CREDIT_F'] ?></td>
                    </tr>
            <?php }
                        }


            ?>

            <tr>
                <td width="100px" colspan="4" style="text-align: right;font-weight: bold;">TOTAL Transaki PerAccount :</td>

                <td align="right" width="150px" style="color: black;font-weight: bold"><?= number_format($dc->totaldr, 2, ',', '.') ?>
                </td>
                <td align="right" width="150px" style="color: black;font-weight: bold"><?= number_format($dc->totalcr, 2, ',', '.') ?>
                </td>
            </tr>
            <tr>
                <td width="100px" colspan="4" style="text-align: right;font-weight: bold;">SALDO AKHIR :</td>

                <td align="right" width="150px" style="color: black;font-weight: bold"><?= number_format($total, 2, ',', '.') ?>
                </td>
                <td align="right" width="150px" style="color: black;font-weight: bold">
                </td>
            </tr>
<?php }
                }
            } ?>
    </tbody>
</table>


<br>
<table width="100%" border="0" align="center" class="font-styles">
    <tr>
        <td align="left" style="font-style: italic;">Generated By System MIPS - Module Cash & Bank</td>
    </tr>
    <tr>
        <td align="left" style="font-style: italic;">MIS - MSAL GROUP</td>
    </tr>
</table>