<style type = "text/css">
         td {
            border-style:solid; 
            border-width:1px; 
            border-color:black; 
            padding:0px;
			background: white;
         }
         
         
         .ukuran_teks{
             font-size: 12px;
         }
      </style>
<table width="1012" class="one" style="background: gray;border-collapse:collapse;">
  <tbody>
    <tr>
      <td width="63" rowspan="2" class ="b"><img src="./assets/logo/<?php echo $pt['logo'];?>" style="width: 70px"></td>
      <td colspan="3" rowspan="2" align="center"><b>PT. MULIA SAWIT AGRO LESTARI</b></td>
      <td height="27" colspan="3" align="center" class = "b">
        
            <?php 
            if($h_vouc['TRANS'] == 'Kas' && $h_vouc['JENIS'] == 'Payment'){
                echo "<b><span style='font-size:20px'>BUKTI KAS KELUAR</span></b>";
            }else if($h_vouc['TRANS'] == 'Bank' && $h_vouc['JENIS'] == 'Payment'){
                echo "<b><span style='font-size:20px'>BUKTI BANK KELUAR</span> <span style='font-size:15px'>(K)</span></b>";
            }else if($h_vouc['TRANS'] == 'Bank' && $h_vouc['JENIS'] == 'Receive'){
                echo "<b><span style='font-size:20px'>BUKTI BANK MASUK</span> <span style='font-size:15px'>(D)</span></b>";
            }
            ?>
              
      </td>
      <td width="100" class = "b">&nbsp; No. : <?php echo $h_vouc['VOUCNO'];?></td>
    </tr>
    <tr>
      <td colspan="3" class="ukuran_teks">&nbsp; No. Perk .</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" rowspan="2" class="ukuran_teks">&nbsp; Dibayarkan kepada : <?php echo $h_vouc['FROM'];?></td>
      <td width="93" height="32" class="ukuran_teks">&nbsp; Tanggal :</td>
      <td width="170" align="center" class="ukuran_teks"> <?php echo $h_vouc['TGL'];?></td>
    </tr>
    <tr>
      <td height="29" class="ukuran_teks">&nbsp; Lampiran : <?php echo $h_vouc['ACCTNO'];?></td>
      <td align="center" class="ukuran_teks">-</td>
    </tr>
    <tr>
        <td height="40" colspan="2" align="center" class="ukuran_teks">Perkiraan</td>
      <td colspan="5" align="center" class="ukuran_teks">Uraian</td>
      <td align="center" class="ukuran_teks">Jumlah</td>
    </tr>
    <?php 
    $sum = 0;
        foreach ($d_vouc as $v) {
    
        if($v['DT_ACCTNO'] == $h_vouc['ACCTNO']){
            
        }else{
            
            $nominals;
            if($v['HV_JENIS'] == 'Payment'){
                if(($v['CREDIT_NO_F'] <> 0) && ($v['DT_ACCTNO'] <> $h_vouc['ACCTNO'])){
                    $nominals = 0 - $v['CREDIT_NO_F'];
                }else{
                    $nominals = $v['DEBET_NO_F'];
                }
            }else{
                $nominals = $v['CREDIT_NO_F'];
            }
            
        ?>
        <tr>
            <td height="10" colspan="2" align="center" class="ukuran_teks">&nbsp; <?php echo $v['DT_ACCTNO'].'   '.$v['KODE_PT'];?></td>
            <td colspan="5" class="ukuran_teks" style="width:50px;padding:5px"><div><?php echo $v['REMARKS'];?></div></td>
            <td align="right" class="ukuran_teks">&nbsp; <?php echo number_format($nominals, 2);?> &nbsp;</td>
        </tr>
        <?php 
        
            $sum += $nominals;
        
        }    
            
    ?>
    
    <?php 
    
        
    
       }
    ?>
    <tr>
      <td height="100" colspan="7" align="left" class="ukuran_teks" valign="top">&nbsp;
            <br>&nbsp;<i>
      <?php 
      if($h_vouc['TRANS'] == 'Bank'){
          echo $h_vouc['ACCTNO'].'-'.$h_vouc['GENERAL'].', '.$h_vouc['DESCRIPT'];
      }else{
          echo $h_vouc['ACCTNO'].','.$h_vouc['DESCRIPT'];
      }
      ?>
          </i>
      </td>
      <td align="right" class="ukuran_teks">&nbsp; <?php echo number_format($sum, 2);?> &nbsp;</td>
    </tr>
<!--    <tr>
      <td height="100" colspan="7">&nbsp;</td>
    </tr>-->
    <tr>
      <td colspan="2" style="height: 30px"class="ukuran_teks">&nbsp; Terbilang </td>
      <td colspan="6" style="background : gray" class="ukuran_teks">&nbsp; <?php echo $h_vouc['PAY'];?></td>
    </tr>
    <tr>
      <td colspan="3" align="center" style="height: 30px" class="ukuran_teks">Diperiksa Oleh, </td>
      <td colspan="2" align="center" class="ukuran_teks">Mengetahui</td>
      <td align="center" class="ukuran_teks">&nbsp;Menyetujui</td>
      <td align="center" class="ukuran_teks">&nbsp;Kasir</td>
      <td align="center" class="ukuran_teks">&nbsp;Diterima Oleh</td>
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
      <br>
      <div><i> Date : <?php echo date('d-M-Y H:i:s');?></i></div>
      <div><i><b>Created By System MMOP - Module Cash & Bank</b></i></div>