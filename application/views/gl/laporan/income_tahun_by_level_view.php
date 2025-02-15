<?php
$prd = $this->uri->segment(3);
$thn = substr($prd, 0, 4);
$bln = substr($prd, 4, 6);


$account_labarugi = '504500000000000';


?>

<style>
    .spinner-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ff6347;
        z-index: 999999;
    }

    body {
        font-family: Verdana, Geneva, sans-serif;
    }
</style>

<title>Laba rugi By level <?= $level_s ?></title>

<table width="100%" border="0" align="center" class="font-style">
    <tr>
        <!--<td rowspan="2" width="0%" height="10px"><img src="<?php echo base_url('assets/theme/adm2/img/logo.jpg'); ?>" style="width: 30px"></td>-->
        <td align="left" style="font-size:14px;font-style: italic;">PT MULIA SAWIT AGRO LESTARI</td>
    </tr>
    <tr>
        <td align="center" style="font-size:16px;font-weight:bold;">Income Statement<br />
        </td>
    </tr>
    <tr>
        <td align="center">
            <?php
            echo 'Tahun ' . $thn;
            ?>
        </td>
    </tr>
</table>

<br><!-- Periode : 01/02/2019 - 31/01/2019 -->

<style type="text/css">
    table {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        border-collapse: collapse;
    }

    .tbl_tr {
        border-bottom: 1pt solid black;
    }

    .tbl_tr_top {
        border-bottom: 1pt solid black;
        border-top: 1pt solid black;
    }

    .wd_table {
        width: 10%;
    }
</style>


<table width="100%" border="0" align="center" class="font-styles">
    <tr>
        <td align="left" style="font-style: italic;">Generated By System MIPS - GL</td>
    </tr>
    <tr>
        <td align="left" style="font-style: italic;">MIS - MSAL GROUP</td>
    </tr>
</table>

<div style="width: 100%;text-align: right;font-size: 10px" class="font-styles">
    Tanggal : <?php echo date("m/d/Y"); ?>
    <br>
    Waktu : <?php
            date_default_timezone_set("Asia/Bangkok");
            echo date("h:i:s a", time()); ?>
</div>



<span style="font-size:12px;font-weight: bold"><i>Order By Level <?php echo $this->uri->segment(4);; ?></i></span>
<br>
<br>
<table border="1" width="100%" class="font-style">
    <tbody>
        <td align="center" style="width:10px">COA</td>
        <td align="center">Name Of Accounts</td>
        <td align="center">&nbsp; Januari</td>
        <td align="center">&nbsp; February</td>
        <td align="center">&nbsp; Maret</td>
        <td align="center">&nbsp; April</td>
        <td align="center">&nbsp; Mei</td>
        <td align="center">&nbsp; Juni</td>
        <td align="center">&nbsp; Juli</td>
        <td align="center">&nbsp; Agustus</td>
        <td align="center">&nbsp; September</td>
        <td align="center">&nbsp; Oktober</td>
        <td align="center">&nbsp; November</td>
        <td align="center">&nbsp; Desember</td>
        <td align="center">&nbsp; Total</td>
        </tr>


        <!-- PENDAPATAN -->
        <tr style="background-color:#e5e5e5;">
            <td>&nbsp;</td>
            <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; Revenue</td>
        </tr>
        <?php
        foreach ($ic_revenue as $b) {
            $noac_n  = $b['noac'];
            $nama_n  = $b['nama'];
            $group_n = $b['group'];
        ?>
            <tr>
                <td align="center" width="10%">&nbsp;<?php echo $noac_n; ?></td>
                <td>
                    <div style="padding-left:<?php echo $b['level']; ?>0px;"><?php echo $nama_n; ?></div>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo01d'] <> 0) {
                        $saldo01_pendapatan = $b['saldo01d'];
                        echo number_format($b['saldo01d'], 0);
                    } else {
                        $sal01 = $b['saldo01c'] * -1;
                        $saldo01_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo02d'] <> 0) {
                        $saldo02_pendapatan = $b['saldo02d'];
                        echo number_format($b['saldo02d'], 0);
                    } else {
                        $sal01 = $b['saldo02c'] * -1;
                        $saldo02_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo03d'] <> 0) {
                        $saldo03_pendapatan = $b['saldo03d'];
                        echo number_format($b['saldo03d'], 0);
                    } else {
                        $sal01 = $b['saldo03c'] * -1;
                        $saldo03_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo04d'] <> 0) {
                        $saldo04_pendapatan = $b['saldo04d'];
                        echo number_format($b['saldo04d'], 0);
                    } else {
                        $sal01 = $b['saldo04c'] * -1;
                        $saldo04_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo05d'] <> 0) {
                        $saldo05_pendapatan = $b['saldo05d'];
                        echo number_format($b['saldo05d'], 0);
                    } else {
                        $sal01 = $b['saldo05c'] * -1;
                        $saldo05_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo06d'] <> 0) {
                        $saldo06_pendapatan = $b['saldo06d'];
                        echo number_format($b['saldo06d'], 0);
                    } else {
                        $sal01 = $b['saldo06c'] * -1;
                        $saldo06_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo07d'] <> 0) {
                        $saldo07_pendapatan = $b['saldo07d'];
                        echo number_format($b['saldo07d'], 0);
                    } else {
                        $sal01 = $b['saldo07c'] * -1;
                        $saldo07_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo08d'] <> 0) {
                        $saldo08_pendapatan = $b['saldo08d'];
                        echo number_format($b['saldo08d'], 0);
                    } else {
                        $sal01 = $b['saldo08c'] * -1;
                        $saldo08_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo09d'] <> 0) {
                        $saldo09_pendapatan = $b['saldo09d'];
                        echo number_format($b['saldo09d'], 0);
                    } else {
                        $sal01 = $b['saldo09c'] * -1;
                        $saldo09_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo10d'] <> 0) {
                        $saldo10_pendapatan = $b['saldo10d'];
                        echo number_format($b['saldo10d'], 0);
                    } else {
                        $sal01 = $b['saldo10c'] * -1;
                        $saldo10_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo11d'] <> 0) {
                        $saldo11_pendapatan = $b['saldo11d'];
                        echo number_format($b['saldo11d'], 0);
                    } else {
                        $sal01 = $b['saldo11c'] * -1;
                        $saldo11_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo12d'] <> 0) {
                        $saldo12_pendapatan = $b['saldo12d'];
                        echo number_format($b['saldo12d'], 0);
                    } else {
                        $sal01 = $b['saldo12c'] * -1;
                        $saldo12_pendapatan = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    $total_pendapatan = $saldo01_pendapatan + $saldo02_pendapatan + $saldo03_pendapatan + $saldo04_pendapatan + $saldo05_pendapatan + $saldo06_pendapatan + $saldo07_pendapatan + $saldo08_pendapatan + $saldo09_pendapatan + $saldo10_pendapatan + $saldo11_pendapatan + $saldo12_pendapatan;
                    echo  preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($total_pendapatan, 0));
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
        <!-- PENDAPATAN -->



        <!-- BIAYA -->
        <tr style="background-color:#e5e5e5;">
            <td>&nbsp;</td>
            <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; Expenses</td>
        </tr>
        <?php
        foreach ($ic_expensise as $b) {
            $noac_n  = $b['noac'];
            $nama_n  = $b['nama'];
            $group_n = $b['group'];

        ?>
            <tr>
                <td align="center" width="10%">&nbsp;<?php echo $noac_n; ?></td>
                <td>
                    <div style="padding-left:<?php echo $b['level']; ?>0px;"><?php echo $nama_n; ?></div>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo01d'] <> 0) {
                        $saldo01_biaya = $b['saldo01d'];
                        echo number_format($b['saldo01d'], 0);
                    } else {
                        $sal01 = $b['saldo01c'] * -1;
                        $saldo01_biaya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo02d'] <> 0) {
                        $saldo02_biaya = $b['saldo02d'];
                        echo number_format($b['saldo02d'], 0);
                    } else {
                        $sal01 = $b['saldo02c'] * -1;
                        $saldo02_biaya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo03d'] <> 0) {
                        $saldo03_biaya = $b['saldo03d'];
                        echo number_format($b['saldo03d'], 0);
                    } else {
                        $sal01 = $b['saldo03c'] * -1;
                        $saldo03_biaya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo04d'] <> 0) {
                        $saldo04_biaya = $b['saldo04d'];
                        echo number_format($b['saldo04d'], 0);
                    } else {
                        $sal01 = $b['saldo04c'] * -1;
                        $saldo04_biaya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo05d'] <> 0) {
                        $saldo05_biaya = $b['saldo05d'];
                        echo number_format($b['saldo05d'], 0);
                    } else {
                        $sal01 = $b['saldo05c'] * -1;
                        $saldo05_biaya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo06d'] <> 0) {
                        $saldo06_biaya = $b['saldo06d'];
                        echo number_format($b['saldo06d'], 0);
                    } else {
                        $sal01 = $b['saldo06c'] * -1;
                        $saldo06_biaya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo07d'] <> 0) {
                        $saldo07_biaya = $b['saldo07d'];
                        echo number_format($b['saldo07d'], 0);
                    } else {
                        $sal01 = $b['saldo07c'] * -1;
                        $saldo07_biaya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo08d'] <> 0) {
                        $saldo08_biaya = $b['saldo08d'];
                        echo number_format($b['saldo08d'], 0);
                    } else {
                        $sal01 = $b['saldo08c'] * -1;
                        $saldo08_biaya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo09d'] <> 0) {
                        $saldo09_biaya = $b['saldo09d'];
                        echo number_format($b['saldo09d'], 0);
                    } else {
                        $sal01 = $b['saldo09c'] * -1;
                        $saldo09_biaya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo10d'] <> 0) {
                        $saldo10_biaya = $b['saldo10d'];
                        echo number_format($b['saldo10d'], 0);
                    } else {
                        $sal01 = $b['saldo10c'] * -1;
                        $saldo10_biaya = $b['saldo10d'];
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo11d'] <> 0) {
                        $saldo11_biaya = $b['saldo11d'];
                        echo number_format($b['saldo11d'], 0);
                    } else {
                        $sal01 = $b['saldo11c'] * -1;
                        $saldo11_biaya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo12d'] <> 0) {
                        $saldo12_biaya = $b['saldo12d'];
                        echo number_format($b['saldo12d'], 0);
                    } else {
                        $sal01 = $b['saldo12c'] * -1;
                        $saldo12_biaya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    $total_biaya = $saldo01_biaya + $saldo02_biaya + $saldo03_biaya + $saldo04_biaya + $saldo05_biaya + $saldo06_biaya + $saldo07_biaya + $saldo08_biaya + $saldo09_biaya + $saldo10_biaya + $saldo11_biaya + $saldo12_biaya;
                    echo  preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($total_biaya, 0));
                    ?>
                </td>


            </tr>
        <?php
        }
        ?>
        <!-- BIAYA -->


        <!-- PENDAPATAN LAINNYA -->
        <tr style="background-color:#e5e5e5;">
            <td>&nbsp;</td>
            <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; Other Revenue</td>
        </tr>
        <?php
        foreach ($ic_other_revenue as $b) {
            $noac_n  = $b['noac'];
            $nama_n  = $b['nama'];
            $group_n = $b['group'];


        ?>
            <tr>
                <td align="center" width="10%">&nbsp;<?php echo $noac_n; ?></td>
                <td>
                    <div style="padding-left:<?php echo $b['level']; ?>0px;"><?php echo $nama_n; ?></div>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo01d'] <> 0) {
                        $saldo01_pendapatan_lainnya = $b['saldo01d'];
                        echo number_format($b['saldo01d'], 0);
                    } else {
                        $sal01 = $b['saldo01c'] * -1;
                        $saldo01_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo02d'] <> 0) {
                        $saldo02_pendapatan_lainnya = $b['saldo02d'];
                        echo number_format($b['saldo02d'], 0);
                    } else {
                        $sal01 = $b['saldo02c'] * -1;
                        $saldo02_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo03d'] <> 0) {
                        $saldo03_pendapatan_lainnya = $b['saldo03d'];
                        echo number_format($b['saldo03d'], 0);
                    } else {
                        $sal01 = $b['saldo03c'] * -1;
                        $saldo03_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo04d'] <> 0) {
                        $saldo04_pendapatan_lainnya = $b['saldo04d'];
                        echo number_format($b['saldo04d'], 0);
                    } else {
                        $sal01 = $b['saldo04c'] * -1;
                        $saldo03_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo05d'] <> 0) {
                        $saldo05_pendapatan_lainnya = $b['saldo05d'];
                        echo number_format($b['saldo05d'], 0);
                    } else {
                        $sal01 = $b['saldo05c'] * -1;
                        $saldo05_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo06d'] <> 0) {
                        $saldo06_pendapatan_lainnya = $b['saldo06d'];
                        echo number_format($b['saldo06d'], 0);
                    } else {
                        $sal01 = $b['saldo06c'] * -1;
                        $saldo06_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo07d'] <> 0) {
                        $saldo07_pendapatan_lainnya = $b['saldo07d'];
                        echo number_format($b['saldo07d'], 0);
                    } else {
                        $sal01 = $b['saldo07c'] * -1;
                        $saldo07_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo08d'] <> 0) {
                        $saldo08_pendapatan_lainnya = $b['saldo08d'];
                        echo number_format($b['saldo08d'], 0);
                    } else {
                        $sal01 = $b['saldo08c'] * -1;
                        $saldo08_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo09d'] <> 0) {
                        $saldo09_pendapatan_lainnya = $b['saldo09d'];
                        echo number_format($b['saldo09d'], 0);
                    } else {
                        $sal01 = $b['saldo09c'] * -1;
                        $saldo09_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo10d'] <> 0) {
                        $saldo10_pendapatan_lainnya = $b['saldo10d'];
                        echo number_format($b['saldo10d'], 0);
                    } else {
                        $sal01 = $b['saldo10c'] * -1;
                        $saldo10_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo11d'] <> 0) {
                        $saldo11_pendapatan_lainnya = $b['saldo11d'];
                        echo number_format($b['saldo11d'], 0);
                    } else {
                        $sal01 = $b['saldo11c'] * -1;
                        $saldo11_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo12d'] <> 0) {
                        $saldo12_pendapatan_lainnya = $b['saldo12d'];
                        echo number_format($b['saldo12d'], 0);
                    } else {
                        $sal01 = $b['saldo12c'] * -1;
                        $saldo12_pendapatan_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    $total_pendapatan_lainnya = $saldo01_pendapatan_lainnya + $saldo02_pendapatan_lainnya + $saldo03_pendapatan_lainnya + $saldo04_pendapatan_lainnya + $saldo05_pendapatan_lainnya + $saldo06_pendapatan_lainnya + $saldo07_pendapatan_lainnya + $saldo08_pendapatan_lainnya + $saldo09_pendapatan_lainnya + $saldo10_pendapatan_lainnya + $saldo11_pendapatan_lainnya + $saldo12_pendapatan_lainnya;
                    echo  preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($total_pendapatan_lainnya, 0));
                    ?>
                </td>
            </tr>
        <?php
        }

        ?>
        <!-- PENDAPATAN LAINNYA -->



        <!-- BIAYA LAINNYA -->
        <tr style="background-color:#e5e5e5;">
            <td>&nbsp;</td>
            <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; Other Expensise</td>
        </tr>
        <?php
        foreach ($ic_other_expensise as $b) {
            $noac_n  = $b['noac'];
            $nama_n  = $b['nama'];
            $group_n = $b['group'];


        ?>
            <tr>
                <td align="center" width="10%">&nbsp;<?php echo $noac_n; ?></td>
                <td>
                    <div style="padding-left:<?php echo $b['level']; ?>0px;"><?php echo $nama_n; ?></div>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo01d'] <> 0) {
                        $saldo01_biaya_lainnya = $b['saldo01d'];
                        echo number_format($b['saldo01d'], 0);
                    } else {
                        $sal01 = $b['saldo01c'] * -1;
                        $saldo01_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo02d'] <> 0) {
                        $saldo02_biaya_lainnya = $b['saldo02d'];
                        echo number_format($b['saldo02d'], 0);
                    } else {
                        $sal01 = $b['saldo02c'] * -1;
                        $saldo02_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo03d'] <> 0) {
                        $saldo03_biaya_lainnya = $b['saldo03d'];
                        echo number_format($b['saldo03d'], 0);
                    } else {
                        $sal01 = $b['saldo03c'] * -1;
                        $saldo03_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo04d'] <> 0) {
                        $saldo04_biaya_lainnya = $b['saldo04d'];
                        echo number_format($b['saldo04d'], 0);
                    } else {
                        $sal01 = $b['saldo04c'] * -1;
                        $saldo04_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo05d'] <> 0) {
                        $saldo05_biaya_lainnya = $b['saldo05d'];
                        echo number_format($b['saldo05d'], 0);
                    } else {
                        $sal01 = $b['saldo05c'] * -1;
                        $saldo05_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo06d'] <> 0) {
                        $saldo06_biaya_lainnya = $b['saldo06d'];
                        echo number_format($b['saldo06d'], 0);
                    } else {
                        $sal01 = $b['saldo06c'] * -1;
                        $saldo06_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo07d'] <> 0) {
                        $saldo07_biaya_lainnya = $b['saldo07d'];
                        echo number_format($b['saldo07d'], 0);
                    } else {
                        $sal01 = $b['saldo07c'] * -1;
                        $saldo07_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo08d'] <> 0) {
                        $saldo08_biaya_lainnya = $b['saldo08d'];
                        echo number_format($b['saldo08d'], 0);
                    } else {
                        $sal01 = $b['saldo08c'] * -1;
                        $saldo08_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo09d'] <> 0) {
                        $saldo09_biaya_lainnya = $b['saldo09d'];
                        echo number_format($b['saldo09d'], 0);
                    } else {
                        $sal01 = $b['saldo09c'] * -1;
                        $saldo09_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo10d'] <> 0) {
                        $saldo10_biaya_lainnya = $b['saldo10d'];
                        echo number_format($b['saldo10d'], 0);
                    } else {
                        $sal01 = $b['saldo10c'] * -1;
                        $saldo10_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo11d'] <> 0) {
                        $saldo11_biaya_lainnya = $b['saldo11d'];
                        echo number_format($b['saldo11d'], 0);
                    } else {
                        $sal01 = $b['saldo11c'] * -1;
                        $saldo11_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    if ($b['saldo12d'] <> 0) {
                        $saldo12_biaya_lainnya = $b['saldo12d'];
                        echo number_format($b['saldo12d'], 0);
                    } else {
                        $sal01 = $b['saldo12c'] * -1;
                        $saldo12_biaya_lainnya = $sal01;
                        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01, 0));
                        echo $ubahformat;
                    }
                    ?>
                </td>
                <td style="text-align: right">
                    <?php
                    $total_biaya_lainnya = $saldo01_biaya_lainnya + $saldo02_biaya_lainnya + $saldo03_biaya_lainnya + $saldo04_biaya_lainnya + $saldo05_biaya_lainnya + $saldo06_biaya_lainnya + $saldo07_biaya_lainnya + $saldo08_biaya_lainnya + $saldo09_biaya_lainnya + $saldo11_biaya_lainnya + $saldo12_biaya_lainnya;
                    echo  preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($total_biaya_lainnya, 0));
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
        <!-- BIAYA LAINNYA -->






        <!-- GRAND TOTAL -->
        <tr>
            <td colspan="2" align="right">&nbsp;Saldo Balance</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <td style="background:#f1f1f1;text-align: right">&nbsp;0</td>
            <!-- GRAND TOTAL -->
        </tr>
    </tbody>
</table>