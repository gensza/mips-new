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
            <?php if ($this->uri->segment(3) == 1) { ?>
                <span style="font-size: 18px;font-weight: normal;">Laporan Pertanggung Jawaban PDO Upah</span>
            <?php } else if ($this->uri->segment(3) == 2) { ?>
                <span style="font-size: 18px;font-weight: normal;">Laporan Pertanggung Jawaban PDO Remise</span>
            <?php } else if ($this->uri->segment(3) == 3) { ?>
                <span style="font-size: 18px;font-weight: normal;">Laporan Pertanggung Jawaban PDDO & IM</span>
            <?php } else if ($this->uri->segment(3) == 4) { ?>
                <span style="font-size: 18px;font-weight: normal;">Laporan Pertanggung Jawaban Dana GRTT</span>
            <?php } else { ?>
                <span style="font-size: 18px;font-weight: normal;">Laporan Pertanggung Jawaban Dana Kontanan</span>
            <?php } ?>

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
            <?php } else { ?>
            <tr>
                <td></td>
                <td></td>
                <td width="100px" colspan="1"><b>Saldo Awal&nbsp;&nbsp;<?php echo date_format(date_create($this->uri->segment(4)), 'd-M-Y') ?></b></td>
                <td align="right" width="150px"><b></b>
                </td>
                <td align="right" width="150px"><b></b>
                </td>
                <td align="right" width="150px"><?= number_format($saldo, 2, ",", ".") ?>
                </td>
            </tr>
            <?php
            $saldoakhir = $saldo;
            foreach ($res_data as $a) {
                $saldoakhir =  $saldoakhir + $a['DEBIT'] - $a['CREDIT'];
            ?>
                <tr>
                    <td width="100px" align="center"><?= date_format(date_create($a['DATE']), 'd-m-Y') ?></td>
                    <td width="100px" align="center"><?= $a['VOUCNO'] ?></td>
                    <td align="left" width="250px"><?= $a['REMARKS'] ?></td>
                    <td align="right" width="150px"><?= number_format($a['DEBIT'], 2, ",", ".") ?></td>
                    <td align="right" width="150px"><?= number_format($a['CREDIT'], 2, ",", ".") ?></td>
                    <td align="right" width="150px"><?= number_format($saldoakhir, 2, ",", ".") ?></td>
                </tr>
        <?php
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