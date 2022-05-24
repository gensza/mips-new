<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div style="width: 100%;text-align: center;">
      <span style="font-weight: bold;font-size: 18px">Monitor Jurnal Logistik LPB dan BKB</span>
      <br>
      <?php
      if ($periode_terkini == 1) {
      ?>
            <span style="font-size: 14px">Periode : <?php echo date('01-m-Y'); ?> s/d <?php echo date('30-m-Y'); ?></span>
      <?php
      } else {
      ?>
            <span style="font-size: 14px">Periode : <?php echo $tgl_start; ?> s/d <?php echo $tgl_end; ?></span>
      <?php
      }
      ?>
</div>

<style>
      table.blueTable {
            border: 1px solid #1C6EA4;
            background-color: white;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
      }

      table.blueTable td,
      table.blueTable th {
            border: 1px solid #AAAAAA;
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
            border-bottom: 2px solid #444444;
      }

      table.blueTable thead th {
            font-size: 15px;
            font-weight: bold;
            color: black;
            border-left: 1px solid #1C6EA4;
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
            border-top: 2px solid #444444;
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
            padding: 2px 8px;
            border-radius: 5px;
      }

      .fontsize_global_header {
            font-size: 7px;
      }
</style>

<br>
<br>

<table class="blueTable">
      <thead>
            <tr>
                  <th width="5%">No</th>
                  <th width="6%">Devisi</th>
                  <th width="17%">No Acct</th>
                  <th width="44%">Account Name</th>
                  <th width="14%">LPB(D)</th>
                  <th width="14%">KBK(K)</th>
            </tr>
      </thead>
      <tbody>
            <?php
            $nos = 0 + 1;

            foreach ($data_entry_head as $v) {

                  // $b = str_replace(',', '', $a['DEBET_F']);
                  // $c = str_replace(',', '', $a['DEBET_F2']);

                  // $oke = number_format($c, 2, ".", ",");
            ?>
                  <tr>
                        <td align="center"><?php echo $nos; ?></td>
                        <td align="center"><?php echo $v['sbu']; ?></td>
                        <td align="left"><?php echo $v['noac']; ?></td>
                        <td align="left"><?php echo $v['descac']; ?></td>
                        <td align="right"><?php echo $v['DBT']; ?></td>
                        <td align="right"><?php echo $v['KRD']; ?></td>
                  </tr>

                  <?php

                  $nos++;

                  $grand_tot_dr += $v['DBT_NF'];
                  $grand_tot_cr += $v['KRD_NF'];

                  ?>
            <?php
            }
            $bg_color = '#ffeec3';
            ?>
            <tr>
                  <td width="100px" colspan="4" style="text-align: right;background: white;color:black;font-weight: bold;">TOTAL</td>

                  <td align="right" width="150px" style="background: <?php echo $bg_color; ?>;color: black;font-weight: bold"><?php echo number_format($grand_tot_dr, 2, ".", ","); ?></td>
                  <td align="right" width="150px" style="background: <?php echo $bg_color; ?>;color: black;font-weight: bold"><?php echo number_format($grand_tot_cr, 2, ".", ","); ?></td>
            </tr>

      </tbody>
</table>


<br>

<div style="width: 100%;text-align: left;font-size:10px">
      MIS MSAL
</div>

<div style="width: 100%;text-align: right;">
      Tanggal : <?php echo date("m/d/Y"); ?>
      <br>
      Waktu : <?php
                  date_default_timezone_set("Asia/Bangkok");
                  echo date("h:i:s a", time()); ?>
</div>