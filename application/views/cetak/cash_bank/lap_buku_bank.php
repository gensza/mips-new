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
</table>


<table width="100%" border="0">
    <tr>

        <td colspan="2">
            <span style="font-size: 18px;font-weight: normal;">Laporan Buku Bank</span>

        </td>
        <td style="text-align: right;font-size: 10px" rowspan="2">Tanggal : <?php echo date("m/d/Y"); ?>
            <br>
            Waktu : <?php
                    date_default_timezone_set("Asia/Bangkok");
                    echo date("h:i:s a", time()); ?>
        </td>
        </td>
    </tr>
    <tr>

        <td colspan="2"><?php
                        if ($this->uri->segment(5) == 0) {
                        ?>
                <span style="font-size: 14px">Periode : <?php echo $this->uri->segment(4); ?> s/d <?php echo $this->uri->segment(5); ?></span>
            <?php
                        } else {

            ?>
                <span style="font-size: 14px">Periode : <?php echo $this->uri->segment(4); ?> s/d <?php echo $this->uri->segment(5); ?></span>
            <?php
                        }
            ?>
        </td>
    </tr>
</table>




<br>
<table class="blueTable font-styles">
    <thead>
        <tr>
            <th>Tgl</th>
            <th>No. Vouc</th>
            <th>Keterangan</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($res_data)) { ?>
            <tr>
                <td colspan="6" style="text-align: center;"> Tidak ada data</td>
            <tr>
                <?php } else {
                foreach ($saldo as $d) {
                ?>
            <tr>
                <td colspan="2"><?= $d->ACCTNAME ?></td>
                <td width="100px" colspan="1"><b>Saldo Awal&nbsp;&nbsp;<?php echo date_format(date_create($this->uri->segment(4)), 'd-M-Y') ?></b></td>
                <td align="right" width="150px"><b></b>
                </td>
                <td align="right" width="150px"><b></b>
                </td>
                <td align="right" width="150px"><?= number_format($d->saldonya, 2, ",", ".") ?>
                </td>
            </tr>
            <?php
                    $lokasi = $this->session->userdata('sess_nama_lokasi');
                    if ($coa == 0) {
                        $sql = $this->mips_caba->query("SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO ='$d->ACCTNO' AND DATE(`DATE`) >= STR_TO_DATE('$tgl1', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl2', '%d-%m-%Y') AND LOKASI = '$lokasi' ORDER BY `DATE` ASC")->result_array();
                    } else {
                        $sql = $this->mips_caba->query("SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO ='$d->ACCTNO' AND DATE(`DATE`) >= STR_TO_DATE('$tgl1', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl2', '%d-%m-%Y') AND LOKASI = '$lokasi'  ORDER BY `DATE` ASC")->result_array();
                    }
                    if (empty($sql)) { ?>
                <tr>
                    <td colspan="6" style="text-align: center;"> Tidak ada data</td>
                <tr>
                <?php } else { ?>
                    <?php
                        $saldo = $d->saldonya;
                        foreach ($sql as $row) {
                            $saldo = $saldo + $row['DEBIT'] - $row['CREDIT'];
                    ?>
                <tr>
                    <td><?= $row['TGL'] ?></td>
                    <td><?= $row['VOUCNO'] ?></td>
                    <td><?= $row['DESCRIPT'] ?></td>
                    <td align="right"><?= number_format($row['DEBIT'], 2, ",", ".") ?></td>
                    <td align="right"><?= number_format($row['CREDIT'], 2, ",", ".") ?></td>
                    <td align="right"><?= number_format($saldo, 2, ",", ".") ?></td>
                </tr>

<?php
                        }
                    }
                }
            }
?>

    </tbody>
</table>


<table width="100%" border="0" align="center" class="font-styles">
    <tr>
        <td align="left" style="font-style: italic;">Generated By System MIPS - Module Cash & Bank</td>
    </tr>
    <tr>
        <td align="left" style="font-style: italic;">MIS - MSAL GROUP</td>
    </tr>
</table>