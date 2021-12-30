<style type="text/css">
  /* td {
    border-style: solid;
    border-width: 1px;
    border-color: black;
    padding: 0px;
    background: white;
  } */


  .ukuran_teks {
    font-size: 14px;
  }

  @page {
    margin-top: 1cm;
    margin-left: 1cm;
    margin-right: 1cm;
  }
</style>
<table width="100" border="0">
  <tbody>
    <tr>
      <td width="63" rowspan="2" style="border-right: 0px solid #FFF;"><img src="./assets/logo/<?= $this->session->userdata('sess_logo'); ?>" style="display: none;width: 70px"></td>
      <td colspan="3" rowspan="2" style="border-left: 0px solid #FFF;" align="center"><b style="display: none;"><?= $this->session->userdata('sess_nama_pt'); ?></b></td>
      <td height="27" colspan="3" align="center" class="b">

        <!-- <?php
              if ($h_vouc['TRANS'] == 'Kas' && $h_vouc['JENIS'] == 'Payment') {
                echo "<b><span style='font-size:16px; display: none;'>BUKTI KAS KELUAR</span></b>";
              } else if ($h_vouc['TRANS'] == 'Bank' && $h_vouc['JENIS'] == 'Payment') {
                echo "<b><span style='font-size:16px; display: none;'>BUKTI BANK KELUAR</span> <span style='font-size:15px'>(K)</span></b>";
              } else if ($h_vouc['TRANS'] == 'Bank' && $h_vouc['JENIS'] == 'Receive') {
                echo "<b><span style='font-size:16px; display: none;'>BUKTI BANK MASUK</span> <span style='font-size:15px'>(D)</span></b>";
              }
              ?> -->

      </td>
      <td width="100" rowspan="2" class="b" align="right">&nbsp; <?php echo $h_vouc['VOUCNO']; ?></td>
    </tr>
    <tr>
      <td colspan="3" class="ukuran_teks">&nbsp; <p style="display: none; ">No. Perk .</p>
      </td>
      <!-- <td>&nbsp;</td> -->
    </tr>
    <tr>
      <td width="118"></td>
      <td colspan="3" rowspan="2" class="ukuran_teks" style="text-align: center;">&nbsp;
        <br>
        <br>
        <br>
        <p style="bottom: 300%; "><?php echo $h_vouc['FROM']; ?></p>
      </td>
      <td width="93" height="32" colspan="4" class="ukuran_teks" align="right">
        <br>
        <?php echo $h_vouc['TGL']; ?>
      </td>
    </tr>
    <tr>
      <td height="29" class="ukuran_teks" style="border-right: 0px solid #FFF;"></td>
      <td align="center" class="ukuran_teks" style="border-left: 0px solid #FFF;"></td>
    </tr>
    <tr>
      <td height="73" colspan="3" align="center" class="ukuran_teks">
        <p style="display: none;">Perkiraan</p>
      </td>
      <td colspan="4" align="center" class="ukuran_teks">
        <p style="display: none;">Uraian</p>
      </td>
      <td align="center" class="ukuran_teks">
        <p style="display: none;">Jumlah</p>
      </td>
    </tr>
    <?php
    $sum = 0;
    // $nominals = 0;
    // $nilai = array();
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
          <td height="10" colspan="3" align="left" class="ukuran_teks">&nbsp; <?php echo $v['DT_ACCTNO'] . '   ' . $v['KODE_PT']; ?></td>
          <td colspan="4" class="ukuran_teks" style="width:50px;padding:5px">
            <div><?php echo $v['REMARKS']; ?></div>
          </td>
          <td align="right" class="ukuran_teks">&nbsp; <?= number_format($nominals, 2, ",", "."); ?> &nbsp;</td>
        </tr>
      <?php
        $sum += $nominals;
      } ?>
    <?php

    }
    ?>
    <tr>
      <td height="281" colspan="7" align="left" class="ukuran_teks" valign="top">&nbsp;<br>
        <i>
          <?php
          if ($h_vouc['TRANS'] == 'Bank') {
            echo $h_vouc['ACCTNO'] . '-' . $h_vouc['GENERAL'] . ', ' . $h_vouc['DESCRIPT'];
          } else {
            echo $h_vouc['ACCTNO'] . ',&nbsp; ' . $h_vouc['DESCRIPT'];
          } ?>
        </i>
      </td>
      <td align="right" class="ukuran_teks" valign="top">
        &nbsp;<br> <?php echo number_format($sum, 2); ?> &nbsp;
      </td>
    </tr>
    <!-- <tr>
      <td height="100" colspan="7">&nbsp;</td>
    </tr>-->
    <tr>
      <td colspan="2" style="height: 30px" class="ukuran_teks">&nbsp; </td>
      <td colspan="6" style="background : gray" class="ukuran_teks">&nbsp; <?php echo $h_vouc['PAY']; ?></td>
    </tr>
    <tr>
      <td colspan="3" align="center" style="height: 30px" class="ukuran_teks"></td>
      <td colspan="2" align="center" class="ukuran_teks"></td>
      <td align="center" class="ukuran_teks">&nbsp;</td>
      <td align="center" class="ukuran_teks">&nbsp;</td>
      <td align="center" class="ukuran_teks">&nbsp;</td>
    </tr>
    <tr>
      <td height="96" style="width: 30px" colspan="2">&nbsp;</td>
      <td width="200">&nbsp;</td>
      <td width="150" colspan="2">&nbsp;</td>
      <td width="150">&nbsp;</td>
      <td width="150">&nbsp;</td>
      <td width="150">&nbsp;</td>
    </tr>
  </tbody>
</table>