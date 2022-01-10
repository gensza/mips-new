<style type="text/css">
  /* td {
    border-style: solid;
    border-width: 1px;
    border-color: black;
    padding: 0px;
    background: white;
  } */


  .ukuran_teks {
    font-size: 11px;
    font-family: "Times New Roman", Times, serif;
  }

  .ukuran_teks2 {
    font-size: 11px;
    font-family: "Times New Roman", Times, serif;
  }

  #voucher td {
    padding: 7px;
  }

  #voucher2 td {
    padding: 7px;
  }

  @page {
    margin-top: 1cm;
    margin-left: 1cm;
    margin-right: 1cm;
  }
</style>
<table width="100%" border="0">

  <tr>
    <td height="55px" align="right" rowspan="1" colspan="3"><?php echo $h_vouc['VOUCNO']; ?></td>
  <tr>
  <tr>
    <td width="20%">
      <p style="display: none;">1</p>
    </td>
    <td width="60%" class="ukuran_teks">
      <br>
      <?php echo $h_vouc['FROM']; ?>
    </td>
    <td width="20%" align="right" class="ukuran_teks"><?php echo $h_vouc['TGL']; ?></td>
  </tr>
</table>

<table id="voucher" width="100%" border="0">
  <tr>
    <td height="40" width="20%" colspan="1" align="center" class="ukuran_teks">
      <p style="display: none;">Perkiraan</p>
    </td>
    <td colspan="7" width="65%" align="center" class="ukuran_teks">
      <p style="display: none;">Uraian</p>
    </td>
    <td align="center" width="15%" class="ukuran_teks">
      <p style="display: none;">Jumlah</p>
    </td>
  </tr>
  <?php
  $sum = 0;
  foreach ($d_vouc as $v) {
    if ($v['DT_ACCTNO'] == $h_vouc['ACCTNO']) {
    } else {
      $nominals = 0;
      if ($v['HV_JENIS'] == 'Payment') {
        if (($v['CREDIT_NO_F'] <> 0) && ($v['DT_ACCTNO'] <> $h_vouc['ACCTNO'])) {
          $nominals = 0 - $v['CREDIT_NO_F'];
        } else {
          $nominals = $v['DEBET_NO_F'];
        }
      } else {
        $nominals = $v['CREDIT_NO_F'];
      }
  ?>
      <tr>
        <td height="15" align="left" class="ukuran_teks">&nbsp;<i><?php echo $v['DT_ACCTNO'] ?></i></td>
        <td colspan="7" class="ukuran_teks">
          <?php echo $v['REMARKS']; ?>
        </td>
        <td align="right" class="ukuran_teks">&nbsp; <i><?= number_format($nominals, 2, ",", "."); ?></i></td>
      </tr>
    <?php
      $sum += $nominals;
    } ?>
  <?php

  }
  ?>
  <tr>
    <td colspan="8" align="left" class="ukuran_teks" valign="top">
      <i>
        <?php
        if ($h_vouc['TRANS'] == 'Bank') {
          echo $h_vouc['ACCTNO'] . '-' . $h_vouc['GENERAL'] . ', ' . $h_vouc['DESCRIPT'];
        } else {
          echo $h_vouc['ACCTNO'] . ',&nbsp; ' . $h_vouc['DESCRIPT'];
        } ?>
      </i>
    </td>
    <td align="right" class="ukuran_teks" valign="top"> <?php echo number_format($sum, 2); ?>
    </td>
  </tr>
  <?php if ($isi_vouc < 8) {
    $jml_colom = 9 -  $isi_vouc;
    for ($i = 0; $i < $jml_colom; $i++) {
  ?>

      <tr>
        <td height="15" align="left" class="ukuran_teks">&nbsp;</td>
        <td colspan="7" class="ukuran_teks">
        </td>
        <td colspan="1" align="right" class="ukuran_teks">&nbsp; &nbsp;</td>
      </tr>
  <?php }
  } ?>

</table>
<table id="voucher2" width="100%" border="0">
  <tr>
    <td colspan="9" class="ukuran_teks">
      &emsp;&emsp;&emsp;<i><?php echo $h_vouc['PAY']; ?></i>
    </td>
  </tr>
</table>