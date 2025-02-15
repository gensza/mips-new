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

            <span style="font-size: 18px;font-weight: normal;">Laporan Pertanggung Jawaban</span>

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
            <th>Tanggal</th>
            <th>No. Vouc</th>
            <th>Keterangan</th>
            <th>No. PDDO/IM</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($saldo)) { ?>
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
                <td align="right" width="150px"><b></b>
                </td>
                <td align="right" width="150px"><?= number_format($d->saldonya, 2, ",", ".") ?>
                </td>
            </tr>
            <?php
                    $lokasi = $this->session->userdata('sess_nama_lokasi');

<<<<<<< HEAD
                    $sql = $this->mips_caba->query("SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO ='$d->ACCTNO' AND DATE(`DATE`) >= STR_TO_DATE('$tgl1', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl2', '%d-%m-%Y') AND LOKASI = '$lokasi' ORDER BY `DATE`,`VOUCNO` ASC")->result_array();
=======
                    $sql = $this->mips_caba->query("SELECT *,DATE_FORMAT(`DATE`, '%d-%m-%Y') TGL,CREDIT,DEBIT FROM voucher WHERE ACCTNO ='$d->ACCTNO' AND DATE(`DATE`) >= STR_TO_DATE('$tgl1', '%d-%m-%Y') AND DATE(`DATE`) <= STR_TO_DATE('$tgl2', '%d-%m-%Y') AND LOKASI = '$lokasi' ORDER BY `DATE` ASC")->result_array();
>>>>>>> c004719cb0bf198f69ad08e9b02984bb20df2777

                    if (empty($sql)) { ?>
                <tr>
                    <td colspan="7" style="text-align: center;"> Tidak ada data</td>
                <tr>
                    <?php } else {
                        $saldoakhir = $d->saldonya;
                        foreach ($sql as $a) {
                            $saldoakhir =  $saldoakhir + $a['DEBIT'] - $a['CREDIT'];
                    ?>



                <tr>
                    <td width="100px" align="center"><?= $a['TGL'] ?></td>
                    <td width="100px" align="center"><?= $a['VOUCNO'] ?></td>
                    <td align="left" width="250px"><?= $a['REMARKS'] ?></td>
                    <td align="left" width="250px">-</td>
                    <td align="right" width="150px"><?= number_format($a['DEBIT'], 2, ",", ".") ?></td>
                    <td align="right" width="150px"><?= number_format($a['CREDIT'], 2, ",", ".") ?></td>
                    <td align="right" width="150px"><?= number_format($saldoakhir, 2, ",", ".") ?></td>
                </tr>
<?php $sum += $saldoakhir;
                        }
                    }
                }
            }
?>
<tr>
    <td width="100px" align="center"></td>
    <td width="100px" align="center"></td>
    <td width="100px" align="center"></td>
    <td align="left" width="250px">Total Debit/Kredit</td>
    <td align="right" width="150px"><b><?= number_format(0, 2, ",", ".") ?></b></td>
    <td align="right" width="150px"><b><?= number_format(0, 2, ",", ".") ?></b></td>
    <td align="right" width="150px"><b><?= number_format(0, 2, ",", ".") ?></b></td>
</tr>
<tr>
    <td width="100px" align="center"></td>
    <td width="100px" align="center"></td>
    <td width="100px" align="center"></td>
    <td align="left" width="250px">Saldo Akhir</td>
    <td align="right" width="150px"></td>
    <td align="right" width="150px"></td>
    <td align="right" width="150px"><b><?= number_format($sum, 2, ",", ".") ?></b></td>
</tr>

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