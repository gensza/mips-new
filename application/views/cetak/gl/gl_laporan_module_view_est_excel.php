<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div style="width: 100%;text-align: center;">
      <span style="font-weight: bold;font-size: 18px">Journal Report <?= $jenis_khusus; ?> EST</span>
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
                  <th>Date</th>
                  <th>Ref</th>
                  <th>Devisi</th>
                  <th>No Acct</th>
                  <th>Account Name</th>
                  <th>Description</th>
                  <th>Debit</th>
                  <th>Credit</th>
            </tr>
      </thead>
      <tbody>
            <?php
            $nos = 0 + 1;

            foreach ($data_entry_head as $v) {

                  foreach ($data_entry as $a) {
                        if ($a['ref'] == $v['ref']) {



                              $b = str_replace(',', '', $a['DEBET_F']);
                              $c = str_replace(',', '', $a['DEBET_F2']);

                              $oke = number_format($c, 2, ".", ",");
            ?>
                              <tr>
                                    <td align="center"><?php echo $a['TGL']; ?></td>
                                    <td align="center"><?php echo $a['ref']; ?></td>
                                    <td align="center"><?php echo $a['sbu']; ?></td>
                                    <td align="left"><?php echo $a['noac']; ?></td>
                                    <td align="left"><?php echo $a['descac']; ?></td>
                                    <td align="left"><?php echo $a['ket']; ?></td>
                                    <td align="right"><?php echo $a['DEBET_F']; ?></td>
                                    <td align="right"><?php echo $a['CREDIT_F']; ?></td>
                              </tr>

                  <?php


                        }
                        $nos++;
                  }

                  $total_debit = $v['DBT'];
                  $total_kredit = $v['KRD'];

                  $total_kredit_nf = $v['KRD_NF'];
                  $total_debit_nf = $v['DBT_NF'];

                  $bg_color;
                  if ($total_kredit_nf != $total_debit_nf) {
                        $bg_color = 'red';
                  } else {
                        $bg_color = '#ffeec3';
                  }

                  ?>
                  <tr>
                        <td width="100px" colspan="6" style="text-align: right;background: white;color:black;font-weight: bold;">TOTAL</td>

                        <td align="right" width="150px" style="background: <?php echo $bg_color; ?>;color: black;font-weight: bold"><?php echo $total_debit; ?></td>
                        <td align="right" width="150px" style="background: <?php echo $bg_color; ?>;color: black;font-weight: bold"><?php echo $total_kredit; ?></td>
                  </tr>
            <?php
            }
            ?>


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