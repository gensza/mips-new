
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


<title>Neraca Saldo</title>


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

      Periode s/d : 
        <?php 
            if($bln == '01'){
                echo 'Januari';
            }else if($bln == '02'){
                echo 'Februari';
            }else if($bln == '03'){
                echo 'Maret';
            }else if($bln == '04'){
                echo 'April';
            }else if($bln == '05'){
                echo 'Mei';
            }else if($bln == '06'){
                echo 'Juni';
            }else if($bln == '07'){
                echo 'Juli';
            }else if($bln == '08'){
                echo 'Agustus';
            }else if($bln == '09'){
                echo 'September';
            }else if($bln == '10'){
                echo 'Oktober';
            }else if($bln == '11'){
                echo 'November';
            }else if($bln == '12'){
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
    font-family: Verdana, Geneva, sans-serif;
    font-size: 10px;
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

<div style="padding-left:300px">
<table border="1" width="70%" class="font-style" >
<tbody>
<tr>
<td align="center" style="width:10px;height:50px">COA</td>
<td align="center">Name Of Accounts</td>
<td align="center">&nbsp; Ending Balance</td>
</tr>
<?php 
$tot_assets;
foreach($aset_lancar as $b){
    
    $fontbold;
    if($b['level'] == '1'){
        $fontbold   = 'bold';
        $height     = '20px';
        $b_noac     = '';
    }else{
        $fontbold   = '';
        $height     = '';
        $b_noac     = $b['noac'];
    }
    
    //varibale ttldr    
    if($bln == '01'){
        $ttldr = $b['yeard']+$b['saldo01d'];   
    }else if($bln == '02'){
        $ttldr = $b['yeard']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '03'){
        $ttldr = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $ttldr = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
        $ttldr = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
        $ttldr  = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
        $ttldr = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
        $ttldr = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
        $ttldr = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
        $ttldr = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
        $ttldr = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
        $ttldr = $b['yeard'] + $b['saldo12d']+$b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }
    //varibale ttldr
        
    
    
    //varibale ttlcr
    if($bln == '01'){
        $ttlcr = $b['yearc']+$b['saldo01c'];   
    }else if($bln == '02'){
        $ttlcr = $b['yearc']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '03'){
        $ttlcr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '04'){
        $ttlcr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '05'){
        $ttlcr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '06'){
        $ttlcr  = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '07'){
        $ttlcr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '08'){
        $ttlcr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '09'){
        $ttlcr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '10'){
        $ttlcr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '11'){
        $ttlcr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '12'){
        $ttlcr = $b['yearc'] + $b['saldo12c']+$b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }
    //varibale ttlcr
    
?>
<tr>
    <td align="center" style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b_noac;?></td>
    <td style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
    <?php 
    if($b['level'] == '1'){
        //levelnya 1 kepalanya, jadi tidak ada perlu valuenya
    }else{
        if(($ttldr-$ttlcr) > 0){
            $val_assets  = $ttldr-$ttlcr;
            $tot_assets += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }else{
            $val_assets  = $ttldr-$ttlcr;
            $tot_assets += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }
    }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr style="height:25px">
    <td>&nbsp;</td>
    <td>&nbsp;<i><b>Total Aset Lancar</b></i></td>
    <td align="right">&nbsp; <b><i><?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_assets, 0));?></i></b></td>
</tr>
<?php 
$tot_assets_tidak_lancar;
foreach($aset_tidak_lancar as $b){
    
    $fontbold;
    if($b['level'] == '1'){
        $fontbold   = 'bold';
        $height     = '20px';
        $b_noac     = '';
    }else{
        $fontbold   = '';
        $height     = '';
        $b_noac     = $b['noac'];
    }
    
    //varibale ttldr    
    if($bln == '01'){
        $ttldr = $b['yeard']+$b['saldo01d'];   
    }else if($bln == '02'){
        $ttldr = $b['yeard']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '03'){
        $ttldr = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $ttldr = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
        $ttldr = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
        $ttldr  = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
        $ttldr = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
        $ttldr = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
        $ttldr = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
        $ttldr = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
        $ttldr = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
        $ttldr = $b['yeard'] + $b['saldo12d']+$b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }
    //varibale ttldr
        
        
    
    //varibale ttlcr
    if($bln == '01'){
        $ttlcr = $b['yearc']+$b['saldo01c'];   
    }else if($bln == '02'){
        $ttlcr = $b['yearc']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '03'){
        $ttlcr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '04'){
        $ttlcr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '05'){
        $ttlcr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '06'){
        $ttlcr  = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '07'){
        $ttlcr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '08'){
        $ttlcr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '09'){
        $ttlcr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '10'){
        $ttlcr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '11'){
        $ttlcr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '12'){
        $ttlcr = $b['yearc'] + $b['saldo12c']+$b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }
    //varibale ttlcr
    
    
?>
<tr>
    <td align="center" style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b_noac;?></td>
    <td style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
    <?php 
    if($b['level'] == '1'){
        //levelnya 1 kepalanya, jadi tidak ada perlu valuenya
    }else{
       if(($ttldr-$ttlcr) > 0){
            $val_assets  = $ttldr-$ttlcr;
            $tot_assets_tidak_lancar += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }else{
            $val_assets  = $ttldr-$ttlcr;
            $tot_assets_tidak_lancar += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }
    }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr style="height:25px">
    <td>&nbsp;</td>
    <td>&nbsp;<i><b>Total Aset Tidak Lancar</b></i></td>
    <td align="right">&nbsp; 
        <b>
        <i>
        <?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_assets_tidak_lancar, 0));?>
        </i>
        </b>
    </td>
</tr>
<tr>
    <td style="height:25px">&nbsp;</td>
    <td style="font-weight:bold;font-size:11px" >&nbsp;&nbsp; TOTAL ASET</td>
    <td align="right" style="font-size:11px">&nbsp;
        <b>
        <i>
        <?php 
        $totaset = $tot_assets+$tot_assets_tidak_lancar;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totaset, 0));
        ?>
        </i>
        </b>
    </td>
</tr>




<!-- START KEWAJIBAN -->
<?php 
$tot_kewajiban_lancar;
foreach($kewajiban_lancar as $b){
    
    $fontbold;
    if($b['level'] == '1'){
        $fontbold   = 'bold';
        $height     = '20px';
        $b_noac     = '';
    }else{
        $fontbold   = '';
        $height     = '';
        $b_noac     = $b['noac'];
    }
    
    
    //varibale ttldr    
    if($bln == '01'){
        $ttldr = $b['yeard']+$b['saldo01d'];   
    }else if($bln == '02'){
        $ttldr = $b['yeard']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '03'){
        $ttldr = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $ttldr = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
        $ttldr = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
        $ttldr  = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
        $ttldr = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
        $ttldr = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
        $ttldr = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
        $ttldr = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
        $ttldr = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
        $ttldr = $b['yeard'] + $b['saldo12d']+$b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }
    //varibale ttldr
        
        
    
    //varibale ttlcr
    if($bln == '01'){
        $ttlcr = $b['yearc']+$b['saldo01c'];   
    }else if($bln == '02'){
        $ttlcr = $b['yearc']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '03'){
        $ttlcr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '04'){
        $ttlcr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '05'){
        $ttlcr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '06'){
        $ttlcr  = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '07'){
        $ttlcr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '08'){
        $ttlcr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '09'){
        $ttlcr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '10'){
        $ttlcr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '11'){
        $ttlcr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '12'){
        $ttlcr = $b['yearc'] + $b['saldo12c']+$b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }
    //varibale ttlcr
?>
<tr>
    <td align="center" style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b_noac;?></td>
    <td style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
    <?php 
    if($b['level'] == '1'){
        //levelnya 1 kepalanya, jadi tidak ada perlu valuenya
    }else{
       if(($ttldr-$ttlcr) > 0){
            $val_assets  = $ttldr-$ttlcr;
            $tot_kewajiban_lancar += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }else{
            $val_assets  = $ttldr-$ttlcr;
            $tot_kewajiban_lancar += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }
    }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr style="height:25px">
    <td>&nbsp;</td>
    <td>&nbsp;<i><b>Total Kewajiban Lancar</b></i></td>
    <td align="right">&nbsp; <b><i><?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_kewajiban_lancar, 0));?></i></b></td>
</tr>
<?php 
$tot_kewajiban_tidak_lancar;
foreach($kewajiban_tidak_lancar as $b){
    
    $fontbold;
    if($b['level'] == '1'){
        $fontbold   = 'bold';
        $height     = '30px';
        $b_noac     = '';
    }else{
        $fontbold   = '';
        $height     = '';
        $b_noac     = $b['noac'];
    }
    
    
    //varibale ttldr    
    if($bln == '01'){
        $ttldr = $b['yeard']+$b['saldo01d'];   
    }else if($bln == '02'){
        $ttldr = $b['yeard']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '03'){
        $ttldr = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $ttldr = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
        $ttldr = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
        $ttldr  = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
        $ttldr = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
        $ttldr = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
        $ttldr = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
        $ttldr = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
        $ttldr = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
        $ttldr = $b['yeard'] + $b['saldo12d']+$b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }
    //varibale ttldr
        
        
    
    //varibale ttlcr
    if($bln == '01'){
        $ttlcr = $b['yearc']+$b['saldo01c'];   
    }else if($bln == '02'){
        $ttlcr = $b['yearc']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '03'){
        $ttlcr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '04'){
        $ttlcr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '05'){
        $ttlcr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '06'){
        $ttlcr  = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '07'){
        $ttlcr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '08'){
        $ttlcr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '09'){
        $ttlcr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '10'){
        $ttlcr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '11'){
        $ttlcr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '12'){
        $ttlcr = $b['yearc'] + $b['saldo12c']+$b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }
    //varibale ttlcr
?>
<tr>
    <td align="center" style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b_noac;?></td>
    <td style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
    <?php 
    if($b['level'] == '1'){
        //levelnya 1 kepalanya, jadi tidak ada perlu valuenya
    }else{
       if(($ttldr-$ttlcr) > 0){
            $val_assets  = $ttldr-$ttlcr;
            $tot_kewajiban_tidak_lancar += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }else{
            $val_assets  = $ttldr-$ttlcr;
            $tot_kewajiban_tidak_lancar += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }
    }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr style="height:25px">
    <td>&nbsp;</td>
    <td>&nbsp;<i><b>Total Kewajiban Tidak Lancar</b></i></td>
    <td align="right">&nbsp; <b><i><?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_kewajiban_tidak_lancar, 0));?></i></b></td>
</tr>
<tr>
    <td style="height:25px">&nbsp;</td>
    <td style="font-weight:bold;font-size:11px" >&nbsp;&nbsp; TOTAL KEWAJIBAN</td>
    <td align="right" style="font-size:11px">&nbsp;
        <b>
        <i>
        <?php 
        $totaset = $tot_kewajiban_lancar+$tot_kewajiban_tidak_lancar;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totaset, 0));
        ?>
        </i>
        </b>
    </td>
</tr>
<!-- END KEWAJIBAN -->



<!-- START EKUITAS -->
<?php 
$tot_ekuitas;
foreach($ekuitas as $b){
    
    $fontbold;
    if($b['level'] == '1'){
        $fontbold   = 'bold';
        $height     = '20px';
        $b_noac     = '';
    }else{
        $fontbold   = '';
        $height     = '';
        $b_noac     = $b['noac'];
    }
    
    
    //varibale ttldr    
    if($bln == '01'){
        $ttldr = $b['yeard']+$b['saldo01d'];   
    }else if($bln == '02'){
        $ttldr = $b['yeard']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '03'){
        $ttldr = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $ttldr = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
        $ttldr = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
        $ttldr  = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
        $ttldr = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
        $ttldr = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
        $ttldr = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
        $ttldr = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
        $ttldr = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
        $ttldr = $b['yeard'] + $b['saldo12d']+$b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }
    //varibale ttldr
        
        
    
    //varibale ttlcr
    if($bln == '01'){
        $ttlcr = $b['yearc']+$b['saldo01c'];   
    }else if($bln == '02'){
        $ttlcr = $b['yearc']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '03'){
        $ttlcr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '04'){
        $ttlcr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '05'){
        $ttlcr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '06'){
        $ttlcr  = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '07'){
        $ttlcr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '08'){
        $ttlcr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '09'){
        $ttlcr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '10'){
        $ttlcr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '11'){
        $ttlcr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '12'){
        $ttlcr = $b['yearc'] + $b['saldo12c']+$b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }
    //varibale ttlcr
?>
<tr>
    <td align="center" style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b_noac;?></td>
    <td style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
    <?php 
    if($b['level'] == '1'){
        //levelnya 1 kepalanya, jadi tidak ada perlu valuenya
    }else{
       if(($ttldr-$ttlcr) > 0){
            $val_assets  = $ttldr-$ttlcr;
            $tot_ekuitas += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }else{
            $val_assets  = $ttldr-$ttlcr;
            $tot_ekuitas += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }
    }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr>
    <td style="height:25px">&nbsp;</td>
    <td style="font-weight:bold;font-size:11px" >&nbsp;&nbsp; TOTAL EKUITAS</td>
    <td align="right" style="font-size:11px">&nbsp;
        <b>
            <i>
        <?php 
        $totaset = $tot_ekuitas;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totaset, 0));
        ?>
            </i>
        </b>
    </td>
</tr>
<!-- END EKUITAS -->



<!-- START PENDAPATAN -->
<?php 
$tot_pendapatan;
foreach($pendapatan as $b){
    
    $fontbold;
    if($b['level'] == '1'){
        $fontbold   = 'bold';
        $height     = '20px';
        $b_noac     = '';
    }else{
        $fontbold   = '';
        $height     = '';
        $b_noac     = $b['noac'];
    }
    
    
    //varibale ttldr    
    if($bln == '01'){
        $ttldr = $b['yeard']+$b['saldo01d'];   
    }else if($bln == '02'){
        $ttldr = $b['yeard']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '03'){
        $ttldr = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $ttldr = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
        $ttldr = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
        $ttldr  = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
        $ttldr = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
        $ttldr = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
        $ttldr = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
        $ttldr = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
        $ttldr = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
        $ttldr = $b['yeard'] + $b['saldo12d']+$b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }
    //varibale ttldr
        
        
    
    //varibale ttlcr
    if($bln == '01'){
        $ttlcr = $b['yearc']+$b['saldo01c'];   
    }else if($bln == '02'){
        $ttlcr = $b['yearc']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '03'){
        $ttlcr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '04'){
        $ttlcr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '05'){
        $ttlcr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '06'){
        $ttlcr  = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '07'){
        $ttlcr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '08'){
        $ttlcr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '09'){
        $ttlcr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '10'){
        $ttlcr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '11'){
        $ttlcr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '12'){
        $ttlcr = $b['yearc'] + $b['saldo12c']+$b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }
    //varibale ttlcr
?>
<tr>
    <td align="center" style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b_noac;?></td>
    <td style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
    <?php 
    if($b['level'] == '1'){
        //levelnya 1 kepalanya, jadi tidak ada perlu valuenya
    }else{
       if(($ttldr-$ttlcr) > 0){
            $val_assets  = $ttldr-$ttlcr;
            $tot_pendapatan += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }else{
            $val_assets  = $ttldr-$ttlcr;
            $tot_pendapatan += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }
    }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr>
    <td style="height:25px">&nbsp;</td>
    <td style="font-weight:bold;font-size:11px" >&nbsp; TOTAL PENDAPATAN</td>
    <td align="right" style="font-size:11px">&nbsp;
        <b>
        <i>
        <?php 
        $totpendapatan = $tot_pendapatan;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totpendapatan, 0));
        ?>
        </i>
        </b>
    </td>
</tr>
<!-- END PENDAPATAN -->


<!-- RUNNING ACCOUNT -->
<?php 
$tot_running_account;
foreach($running_account as $b){
    
    $fontbold;
    if($b['level'] == '1'){
        $fontbold   = 'bold';
        $height     = '20px';
        $b_noac     = '';
    }else{
        $fontbold   = '';
        $height     = '';
        $b_noac     = $b['noac'];
    }
    
    
    //varibale ttldr    
    if($bln == '01'){
        $ttldr = $b['yeard']+$b['saldo01d'];   
    }else if($bln == '02'){
        $ttldr = $b['yeard']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '03'){
        $ttldr = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $ttldr = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
        $ttldr = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
        $ttldr  = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
        $ttldr = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
        $ttldr = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
        $ttldr = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
        $ttldr = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
        $ttldr = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
        $ttldr = $b['yeard'] + $b['saldo12d']+$b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }
    //varibale ttldr
        
        
    
    //varibale ttlcr
    if($bln == '01'){
        $ttlcr = $b['yearc']+$b['saldo01c'];   
    }else if($bln == '02'){
        $ttlcr = $b['yearc']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '03'){
        $ttlcr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '04'){
        $ttlcr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '05'){
        $ttlcr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '06'){
        $ttlcr  = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '07'){
        $ttlcr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '08'){
        $ttlcr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '09'){
        $ttlcr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '10'){
        $ttlcr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '11'){
        $ttlcr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '12'){
        $ttlcr = $b['yearc'] + $b['saldo12c']+$b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }
    //varibale ttlcr
?>
<tr>
    <td align="center" style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b_noac;?></td>
    <td style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
    <?php 
    if($b['level'] == '1'){
        //levelnya 1 kepalanya, jadi tidak ada perlu valuenya
    }else{
       if(($ttldr-$ttlcr) > 0){
            $val_assets  = $ttldr-$ttlcr;
            $tot_running_account += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }else{
            $val_assets  = $ttldr-$ttlcr;
            $tot_running_account += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }
    }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr style="height:25px">
    <td>&nbsp;</td>
    <td>&nbsp;<i><b>Total Running Account</b></i></td>
    <td align="right">&nbsp; <b><i><?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_running_account, 0));?></i></b></td>
</tr>
<!-- RUNNING ACCOUNT -->




<!-- HARGA POKOK PENJUALAN -->
<?php
$tot_harga_pokok_penjualan;
foreach($harga_pokok_penjualan as $b){
    
    $fontbold;
    if($b['level'] == '1'){
        $fontbold   = 'bold';
        $height     = '20px';
        $b_noac     = '';
    }else{
        $fontbold   = '';
        $height     = '';
        $b_noac     = $b['noac'];
    }
    
    
    //varibale ttldr    
    if($bln == '01'){
        $ttldr = $b['yeard']+$b['saldo01d'];   
    }else if($bln == '02'){
        $ttldr = $b['yeard']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '03'){
        $ttldr = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $ttldr = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
        $ttldr = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
        $ttldr  = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
        $ttldr = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
        $ttldr = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
        $ttldr = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
        $ttldr = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
        $ttldr = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
        $ttldr = $b['yeard'] + $b['saldo12d']+$b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }
    //varibale ttldr
        
        
    
    //varibale ttlcr
    if($bln == '01'){
        $ttlcr = $b['yearc']+$b['saldo01c'];   
    }else if($bln == '02'){
        $ttlcr = $b['yearc']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '03'){
        $ttlcr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '04'){
        $ttlcr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '05'){
        $ttlcr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '06'){
        $ttlcr  = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '07'){
        $ttlcr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '08'){
        $ttlcr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '09'){
        $ttlcr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '10'){
        $ttlcr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '11'){
        $ttlcr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '12'){
        $ttlcr = $b['yearc'] + $b['saldo12c']+$b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }
    //varibale ttlcr
?>
<tr>
    <td align="center" style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b_noac;?></td>
    <td style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
    <?php 
    if($b['level'] == '1'){
        //levelnya 1 kepalanya, jadi tidak ada perlu valuenya
    }else{
       if(($ttldr-$ttlcr) > 0){
            $val_assets  = $ttldr-$ttlcr;
            $tot_harga_pokok_penjualan += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }else{
            $val_assets  = $ttldr-$ttlcr;
            $tot_harga_pokok_penjualan += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }
    }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr style="height:25px">
    <td>&nbsp;</td>
    <td>&nbsp;<i><b>Total Harga Penjualan</b></i></td>
    <td align="right">&nbsp; <b><i><?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_harga_pokok_penjualan, 0));?></i></b></td>
</tr>
<!-- HARGA POKOK PENJUALAN -->



<!-- BIAYA ADMINISTRASI UMUM -->
<?php
$tot_biaya_administrasi_umum;
foreach($biaya_admin_umum as $b){
    
    $fontbold;
    if($b['level'] == '1'){
        $fontbold   = 'bold';
        $height     = '20px';
        $b_noac     = '';
    }else{
        $fontbold   = '';
        $height     = '';
        $b_noac     = $b['noac'];
    }
    
    
    //varibale ttldr    
    if($bln == '01'){
        $ttldr = $b['yeard']+$b['saldo01d'];   
    }else if($bln == '02'){
        $ttldr = $b['yeard']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '03'){
        $ttldr = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $ttldr = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
        $ttldr = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
        $ttldr  = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
        $ttldr = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
        $ttldr = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
        $ttldr = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
        $ttldr = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
        $ttldr = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
        $ttldr = $b['yeard'] + $b['saldo12d']+$b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }
    //varibale ttldr
        
        
    
    //varibale ttlcr
    if($bln == '01'){
        $ttlcr = $b['yearc']+$b['saldo01c'];   
    }else if($bln == '02'){
        $ttlcr = $b['yearc']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '03'){
        $ttlcr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '04'){
        $ttlcr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '05'){
        $ttlcr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '06'){
        $ttlcr  = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '07'){
        $ttlcr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '08'){
        $ttlcr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '09'){
        $ttlcr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '10'){
        $ttlcr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '11'){
        $ttlcr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '12'){
        $ttlcr = $b['yearc'] + $b['saldo12c']+$b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }
    //varibale ttlcr
?>
<tr>
    <td align="center" style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b_noac;?></td>
    <td style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
    <?php 
    if($b['level'] == '1'){
        //levelnya 1 kepalanya, jadi tidak ada perlu valuenya
    }else{
       if(($ttldr-$ttlcr) > 0){
            $val_assets  = $ttldr-$ttlcr;
            $tot_biaya_administrasi_umum += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }else{
            $val_assets  = $ttldr-$ttlcr;
            $tot_biaya_administrasi_umum += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }
    }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr style="height:25px">
    <td>&nbsp;</td>
    <td>&nbsp;<i><b>Total Biaya Administasi Umum</b></i></td>
    <td align="right">&nbsp; <b><i><?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_biaya_administrasi_umum, 0));?></i></b></td>
</tr>
<tr>
    <td style="height:25px">&nbsp;</td>
    <td style="font-weight:bold;font-size:11px" >&nbsp;&nbsp; TOTAL BIAYA</td>
    <td align='right' style='font-size:11px'>&nbsp;
        <b>
            <i>
    <?php 
    $totbiaya = $tot_harga_pokok_penjualan+$tot_biaya_administrasi_umum+$tot_running_account;
    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totbiaya, 0));
    ?>
        </i>
        </b>
    </td>
</tr>
<!-- HARGA POKOK PENJUALAN -->




<!-- PENDAPATAN LAINNYA -->
<?php
$tot_pendapatan_lainnya;
foreach($pendapatan_lainnya as $b){
    
    $fontbold;
    if($b['level'] == '1'){
        $fontbold   = 'bold';
        $height     = '20px';
        $b_noac     = '';
    }else{
        $fontbold   = '';
        $height     = '';
        $b_noac     = $b['noac'];
    }
    
    
    //varibale ttldr    
    if($bln == '01'){
        $ttldr = $b['yeard']+$b['saldo01d'];   
    }else if($bln == '02'){
        $ttldr = $b['yeard']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '03'){
        $ttldr = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $ttldr = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
        $ttldr = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
        $ttldr  = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
        $ttldr = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
        $ttldr = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
        $ttldr = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
        $ttldr = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
        $ttldr = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
        $ttldr = $b['yeard'] + $b['saldo12d']+$b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }
    //varibale ttldr
        
        
    
    //varibale ttlcr
    if($bln == '01'){
        $ttlcr = $b['yearc']+$b['saldo01c'];   
    }else if($bln == '02'){
        $ttlcr = $b['yearc']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '03'){
        $ttlcr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '04'){
        $ttlcr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '05'){
        $ttlcr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '06'){
        $ttlcr  = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '07'){
        $ttlcr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '08'){
        $ttlcr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '09'){
        $ttlcr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '10'){
        $ttlcr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '11'){
        $ttlcr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '12'){
        $ttlcr = $b['yearc'] + $b['saldo12c']+$b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }
    //varibale ttlcr
?>
<tr>
    <td align="center" style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b_noac;?></td>
    <td style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
    <?php 
    if($b['level'] == '1'){
        //levelnya 1 kepalanya, jadi tidak ada perlu valuenya
    }else{
       if(($ttldr-$ttlcr) > 0){
            $val_assets  = $ttldr-$ttlcr;
            $tot_pendapatan_lainnya += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }else{
            $val_assets  = $ttldr-$ttlcr;
            $tot_pendapatan_lainnya += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }
    }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr style="height:25px">
    <td>&nbsp;</td>
    <td style="font-size:11px">&nbsp;<b>TOTAL PENDAPATAN LAINNYA</b></td>
    <td align="right" style="font-size:11px">&nbsp; <b><i><?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_pendapatan_lainnya, 0));?></i></b></td>
</tr>
<!-- PENDAPATAN LAINNYA -->



<!-- BIAYA LAINNYA -->
<?php
$tot_biaya_lainnya;
foreach($biaya_lainnya as $b){
    
    $fontbold;
    if($b['level'] == '1'){
        $fontbold   = 'bold';
        $height     = '20px';
        $b_noac     = '';
    }else{
        $fontbold   = '';
        $height     = '';
        $b_noac     = $b['noac'];
    }
    
    
    //varibale ttldr    
    if($bln == '01'){
        $ttldr = $b['yeard']+$b['saldo01d'];   
    }else if($bln == '02'){
        $ttldr = $b['yeard']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '03'){
        $ttldr = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $ttldr = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
        $ttldr = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
        $ttldr  = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
        $ttldr = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
        $ttldr = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
        $ttldr = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
        $ttldr = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
        $ttldr = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
        $ttldr = $b['yeard'] + $b['saldo12d']+$b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }
    //varibale ttldr
        
        
    
    //varibale ttlcr
    if($bln == '01'){
        $ttlcr = $b['yearc']+$b['saldo01c'];   
    }else if($bln == '02'){
        $ttlcr = $b['yearc']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '03'){
        $ttlcr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '04'){
        $ttlcr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '05'){
        $ttlcr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '06'){
        $ttlcr  = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '07'){
        $ttlcr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '08'){
        $ttlcr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '09'){
        $ttlcr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '10'){
        $ttlcr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '11'){
        $ttlcr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }else if($bln == '12'){
        $ttlcr = $b['yearc'] + $b['saldo12c']+$b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
    }
    //varibale ttlcr
?>
<tr>
    <td align="center" style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b_noac;?></td>
    <td style="font-weight:<?php echo $fontbold;?>;height:<?php echo $height;?>">&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
    <?php 
    if($b['level'] == '1'){
        //levelnya 1 kepalanya, jadi tidak ada perlu valuenya
    }else{
       if(($ttldr-$ttlcr) > 0){
            $val_assets  = $ttldr-$ttlcr;
            $tot_biaya_lainnya += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }else{
            $val_assets  = $ttldr-$ttlcr;
            $tot_biaya_lainnya += $val_assets;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($val_assets, 0));
        }
    }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr style="height:25px">
    <td>&nbsp;</td>
    <td style="font-size:11px">&nbsp;<b>TOTAL BIAYA LAINNYA</b></td>
    <td align="right" style="font-size:11px">&nbsp; <b><i><?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_biaya_lainnya, 0));?></i></b></td>
</tr>
<!-- BIAYA LAINNYA -->


<tr style="height:40px;font-weight: bold">
<td colspan="2" align="right">&nbsp;BALANCE</td>
    <td align="right">&nbsp; <?php 
        $tot_1 = ($tot_assets+$tot_assets_tidak_lancar)+($tot_kewajiban_lancar+$tot_kewajiban_tidak_lancar);
        $tot_2 = $tot_ekuitas+$tot_pendapatan+$tot_harga_pokok_penjualan+$tot_biaya_administrasi_umum+$tot_running_account+$tot_pendapatan_lainnya+$tot_biaya_lainnya;
        $total_keseluruhan = $tot_1+$tot_2;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($total_keseluruhan, 0));
    ?></td>
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

</div>
                     