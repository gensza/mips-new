
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

<table width="100%" border="0" align="center" class="font-style">
                                <tr>
                                    <!--<td rowspan="2" width="0%" height="10px"><img src="<?php echo base_url('assets/theme/adm2/img/logo.jpg');?>" style="width: 30px"></td>-->
                                    <td align="left" style="font-size:14px;font-style: italic;">PT MULIA SAWIT AGRO LESTARI</td>
                                </tr>
                                <tr>
                                    <td align="center" style="font-size:16px;font-weight:bold;">Trial Balance<br /> 
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                      
                                      Periode : 
                                        <?php 
                                            if($bln == 01){
                                                echo 'Januari';
                                            }else if($bln == 02){
                                                echo 'Februari';
                                            }else if($bln == 03){
                                                echo 'Maret';
                                            }else if($bln == 04){
                                                echo 'April';
                                            }else if($bln == 05){
                                                echo 'Mei';
                                            }else if($bln == 06){
                                                echo 'Juni';
                                            }else if($bln == 07){
                                                echo 'Juli';
                                            }else if($bln == 08){
                                                echo 'September';
                                            }else if($bln == 09){
                                                echo 'Oktober';
                                            }else if($bln == 10){
                                                echo 'November';
                                            }else if($bln == 11){
                                                echo 'Desember';
                                            }
                                            
                                            echo ', '.$thn;
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

.tbl_tr{
  border-bottom:1pt solid black;
}

.tbl_tr_top{
  border-bottom:1pt solid black;
  border-top:1pt solid black;
}
.wd_table{
    width:10%;
}
</style>

<table border="1" width="100%" class="font-style" >
<tbody>
<tr>
<td align="center" style="width:10px">COA</td>
<td align="center">Name Of Accounts</td>
<td align="center">&nbsp; </td>
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
</tr>
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; ASSET</td>
</tr>
<?php 

    $saldo01;
    $saldo02;
    $saldo03;
    $saldo04;
    $saldo05;
    $saldo06;
    $saldo07;
    $saldo08;
    $saldo09;
    $saldo10;
    $saldo11;
    $saldo12;

    foreach ($list_noac as $a){
?>
<tr>
    <td align="center">&nbsp;<?php echo $a['noac'];?></td>
    <td>&nbsp;<?php echo $a['nama'];?></td>
    <td align="right">&nbsp;<?php echo number_format($a['yeard'],0);?></td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo01d'] == 0){
                $saldo01 += $a['saldo01c'];
                echo '('.number_format($a['saldo01c'],0).')';
            }else{
                $saldo01 += $a['saldo01d'];
                echo number_format($a['saldo01d'],0);
            }
        ?>
    </td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo02d'] == 0){
                $saldo02 += $a['saldo02c'];
                echo '('.number_format($a['saldo02c'],0).')';
            }else{
                $saldo02 += $a['saldo02d'];
                echo number_format($a['saldo02d'],0);
            }
        ?>
    </td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo03d'] == 0){
                $saldo03 += $a['saldo03c'];
                echo '('.number_format($a['saldo03c'],0).')';
            }else{
                $saldo03 += $a['saldo03d'];
                echo number_format($a['saldo03d'],0);
            }
        ?>
    </td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo04d'] == 0){
                $saldo04 += $a['saldo04c'];
                echo '('.number_format($a['saldo04c'],0).')';
            }else{
                $saldo04 += $a['saldo04d'];
                echo number_format($a['saldo04d'],0);
            }
        ?>
    </td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo05d'] == 0){
                $saldo05 += $a['saldo05c'];
                echo '('.number_format($a['saldo05c'],0).')';
            }else{
                $saldo05 += $a['saldo05d'];
                echo number_format($a['saldo05d'],0);
            }
        ?>
    </td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo06d'] == 0){
                $saldo06 += $a['saldo06c'];
                echo '('.number_format($a['saldo06c'],0).')';
            }else{
                $saldo06 += $a['saldo06d'];
                echo number_format($a['saldo06d'],0);
            }
        ?>
    </td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo07d'] == 0){
                $saldo07 += $a['saldo07c'];
                echo '('.number_format($a['saldo07c'],0).')';
            }else{
                $saldo07 += $a['saldo07d'];
                echo number_format($a['saldo07d'],0);
            }
        ?>
    </td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo08d'] == 0){
                $saldo08 += $a['saldo08c'];
                echo '('.number_format($a['saldo08c'],0).')';
            }else{
                $saldo08 += $a['saldo08d'];
                echo number_format($a['saldo08d'],0);
            }
        ?>
    </td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo09d'] == 0){
                $saldo09 += $a['saldo09c'];
                echo '('.number_format($a['saldo09c'],0).')';
            }else{
                $saldo09 += $a['saldo09d'];
                echo number_format($a['saldo09d'],0);
            }
        ?>
    </td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo10d'] == 0){
                $saldo10 += $a['saldo10c'];
                echo '('.number_format($a['saldo10c'],0).')';
            }else{
                $saldo10 += $a['saldo10d'];
                echo number_format($a['saldo10d'],0);
            }
        ?>
    </td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo11d'] == 0){
                $saldo11 += $a['saldo11c'];
                echo '('.number_format($a['saldo11c'],0).')';
            }else{
                $saldo11 += $a['saldo11d'];
                echo number_format($a['saldo11d'],0);
            }
        ?>
    </td>
    <td align="right">&nbsp;
        <?php
            if($a['saldo12d'] == 0){
                $saldo12 += $a['saldo12c'];
                echo '('.number_format($a['saldo12c'],0).')';
            }else{
                $saldo12 += $a['saldo12d'];
                echo number_format($a['saldo12d'],0);
            }
        ?>
    </td>
</tr>
<?php 
}
?>
<tr>
<td colspan="2" align="right">&nbsp;Saldo Balance</td>
    <td  align="right">&nbsp; <?php echo number_format($saldo01,0);?></td>
    <td  align="right">&nbsp; <?php echo number_format($saldo02,0);?></td>
    <td  align="right">&nbsp; <?php echo number_format($saldo03,0);?></td>
    <td  align="right">&nbsp; <?php echo number_format($saldo04,0);?></td>
    <td  align="right">&nbsp; <?php echo number_format($saldo05,0);?></td>
    <td  align="right">&nbsp; <?php echo number_format($saldo06,0);?></td>
    <td  align="right">&nbsp; <?php echo number_format($saldo07,0);?></td>
    <td  align="right">&nbsp; <?php echo number_format($saldo08,0);?></td>
    <td  align="right">&nbsp; <?php echo number_format($saldo09,0);?></td>
    <td  align="right">&nbsp; <?php echo number_format($saldo10,0);?></td>
    <td  align="right">&nbsp; <?php echo number_format($saldo11,0);?></td>
    <td  align="right">&nbsp; <?php echo number_format($saldo12,0);?></td>
</tr>
</tbody>
</table>

<br>
<br>

<table width="100%" border="0" align="center" class="font-styles">
    <tr>
        <td align="left" style="font-style: italic;">Generated By System MIPS - GL</td>
    </tr>
    <tr>
        <td align="left" style="font-style: italic;">MIS - MSAL GROUP</td>
    </tr>
</table>

<div style="width: 100%;text-align: right;font-size: 10px" class="font-styles">
  Tanggal : <?php echo date("m/d/Y");?>
  <br>
  Waktu   : <?php 
  date_default_timezone_set("Asia/Bangkok");
  echo date("h:i:s a",time());?>
</div>
                     