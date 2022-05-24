<table width="100%" border="0" align="center">
  <tr>
    <td rowspan="2" width="0%" height="10px"><img src="<?php echo base_url('assets/theme/adm2/img/logo.jpg'); ?>" style="width: 80px"></td>
    <td align="center" style="font-size:25px;font-weight:bold;">PT Mulia Sawit Agro Lestari</td>
  </tr>
  <tr>
    <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru, JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
    </td>
  </tr>
</table>

<hr>


<style>
  /*table.borderbuttom {
 border-collapse: collapse;
 border: 1pt solid black;
 border-left: 0px solid black;
 border-right: 0px solid black;
}*/

  table.borderbuttom {
    border: 0px solid #1C6EA4;
    border-collapse: collapse;
  }

  table.borderbuttom thead th {
    border: 0px solid #1C6EA4;
  }

  table.borderbuttom tr:nth-child(even) {
    border: 1pt solid black;
    border-left: 0px;
    border-right: 0px;
    background: none;
    border-collapse: collapse;
  }
</style>

<div style="width: 100%;text-align: center;">
  <span style="font-weight: bold;font-size: 18px">Account Activity Detail Report</span>
  <br>
  <span style="font-size: 14px">Periode : <?php echo $this->uri->segment(4); ?> s/d <?php echo $this->uri->segment(5); ?></span>
</div>


<br>
<br>

<table class="borderbuttom">
  <thead>
    <!--<tr >
        <th>Ref</th>
        <th>Date</th>
        <th>No Acct</th>
        <th>Account Name</th>
        <th>Description</th>
        <th>Debit</th>
        <th>Credit</th>
    </tr>-->
  </thead>
  <tbody>
    <?php
    $nos = 0 + 1;

    foreach ($data_entry_head as $v) {
      /*
    <th>No Acct</th>
    <th>Account Name</th>
  */
      echo "<tr >
        <th>" . $v['noac'] . "</th>
        <th colspan='7' align='left' style='text-align:left;padding-left:20px'>" . $v['descac'] . "</th>
        </tr>
        <tr style='height:100px'>
          <th style='height:40px' align='center'>Ref</th>
          <th align='center'>Date</th>
          <th colspan='4' align='left'>Description</th>
          <th align='center'>Debit</th>
          <th align='center'>Credit</th>
        </tr>
        <tr>
                                              <th colspan='5'></th>
                                              <th>Begining Balance</th>
                                              <th align='right'>0</th>
                                              <th align='right'>0</th>
                                          </tr>
        ";

      foreach ($data_entry as $a) {
        if ($a['noac'] == $v['noac']) {

          $b = str_replace(',', '', $a['DEBET_F']);
          $c = str_replace(',', '', $a['DEBET_F2']);

          $oke = number_format($c, 2, ".", ",");
    ?>
          <tr>
            <td align="center"><?php echo $a['ref']; ?></td>
            <td align="center"><?php echo $a['TGL']; ?></td>
            <td align="left" colspan='4'><?php echo $a['ket']; ?></td>
            <td align="right"><?php echo $a['DEBET_F']; ?></td>
            <td align="right">(<?php echo $a['CREDIT_F']; ?>)</td>
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
        $bg_color = '#fda8a7';
      } else {
        $bg_color = 'white';
      }

      ?>
      <tr style="border-bottom: 1px solid white;">
        <td width="100px" colspan="6" style="text-align: right;;color:black;border-bottom: 1px solid white;">Total</td>
        <td align="right" width="150px" style="background: <?php echo $bg_color; ?>;color: black;border-bottom: 1px solid white;"><?php echo $total_debit; ?></td>
        <td align="right" width="150px" style="background: <?php echo $bg_color; ?>;color: black;border-bottom: 1px solid white;">(<?php echo $total_kredit; ?>)</td>
      </tr>
      <tr style="border-top: 1px solid white;">
        <td width="100px" colspan="6" style="text-align: right;color:black;">Current Balance</td>
        <td align="right" width="150px" style=";color: black;">0</td>
        <td align="right" width="150px" style=";color: black;">0</td>
      </tr>
    <?php
    }
    ?>

  </tbody>
</table>

<br>


<div style="width: 100%;text-align: right;">
  Tanggal : <?php echo date("m/d/Y"); ?>
  <br>
  Waktu : <?php
          date_default_timezone_set("Asia/Bangkok");
          echo date("h:i:s a", time()); ?>
</div>