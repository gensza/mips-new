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

<title>Neraca Saldo Tahunan</title>

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
                                        <?php 
                                            echo 'Tahun '.$thn;
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

<!--IF {noac.group}="Asset" THEN "ASSET"
ELSE IF {noac.group}="Capital" THEN "EKUITAS"
ELSE IF {noac.group}="Expenses" THEN "BIAYA"
ELSE IF {noac.group}="Liability" THEN "KEWAJIBAN"
ELSE IF {noac.group}="Other Expenses" THEN "BIAYA LAINNYA"
ELSE IF {noac.group}="Other Revenue" THEN "PENDAPATAN LAINNYA"
ELSE IF {noac.group}="Revenue" THEN "PENDAPATAN"-->

<span style="font-size:12px;font-weight: bold"><i>Sort By Level <?php echo $level;?></i></span>
<br>
<table border="1" width="100%" class="font-style">
<tbody>
<td align="center" style="width:10px">COA</td>
<td align="center">Name Of Accounts</td>
<td align="center">&nbsp; <?php echo $thn-1;?></td>
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
<td align="center">&nbsp; Total</td>
</tr>
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; ASSET</td>
</tr>
<?php


function nagitive_check($number){
    if ($number > 0){
        return number_format($number,0);
    }else if ($number < 0){
        return preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($number,0));
    }else if ($number == 0){
        //disini angkanya nol
    } else {
        //disini numeric value
    }
}



$saldo_yeard_aset_x;
$saldo01_aset_x;
$saldo02_aset_x;
$saldo03_aset_x;
$saldo04_aset_x;
$saldo05_aset_x;
$saldo06_aset_x;
$saldo07_aset_x;
$saldo08_aset_x;
$saldo09_aset_x;
$saldo10_aset_x;
$saldo11_aset_x;
$saldo12_aset_x;
$totaltb_aset;
$saldo01_aset_g;

$sum01_aset;
$sum02_aset;
$sum03_aset;
$sum04_aset;
$sum05_aset;
$sum06_aset;
$sum07_aset;
$sum08_aset;
$sum09_aset;
$sum10_aset;
$sum11_aset;
$sum12_aset;



foreach($data_list_assets as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
    
if($b['level'] == 1 && $b['type'] == 'G'){
    $bolds = 'font-weight:bold';
	
	$sum01_biaya_lainnya = 0;

}else{
    $bolds = '';
}    
    
if($group_n == 'Asset'){
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
        $bold_liab = 'font-weight:bold';
    }else{
        $bold_liab = '';
    }
   
   
    if($b['level'] == 1 && $b['type'] == 'G'){
		$sum01_aset = 0;
    }else{
    
        if($b['saldo01d']<>0){
            $sum01_aset += $b['saldo01d'];
        }else{
            if ($b['saldo01c'] > 0){
                $sum01_aset += $b['saldo01c']*-1;
            }else if ($b['saldo01c'] < 0){
                $sum01_aset += $b['saldo01c'];
            }else if ($b['saldo01c'] == 0){
                $sum01_aset += 0;
            }else{
                //disini numeric value
            }
        }
		
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum02_aset = 0;
    }else{
        if($b['saldo02d']<>0){
            $sum02_aset += $b['saldo02d'];
        }else{
            if ($b['saldo02c'] > 0){
                $sum02_aset += $b['saldo02c']*-1;
            }else if ($b['saldo02c'] < 0){
                $sum02_aset += $b['saldo02c'];
            }else if ($b['saldo02c'] == 0){
                $sum02_aset += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum03_aset = 0;
    }else{
        if($b['saldo03d']<>0){
            $sum03_aset += $b['saldo03d'];
        }else{
            if ($b['saldo03c'] > 0){
                $sum03_aset += $b['saldo03c']*-1;
            }else if ($b['saldo03c'] < 0){
                $sum03_aset += $b['saldo03c'];
            }else if ($b['saldo03c'] == 0){
                $sum03_aset += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum04_aset = 0;
    }else{
        if($b['saldo04d']<>0){
            $sum04_aset += $b['saldo04d'];
        }else{
            if ($b['saldo04c'] > 0){
                $sum04_aset += $b['saldo04c']*-1;
            }else if ($b['saldo04c'] < 0){
                $sum04_aset += $b['saldo04c'];
            }else if ($b['saldo04c'] == 0){
                $sum04_aset += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum05_aset = 0;
    }else{
        if($b['saldo05d']<>0){
            $sum05_aset += $b['saldo04d'];
        }else{
            if ($b['saldo05c'] > 0){
                $sum05_aset += $b['saldo05c']*-1;
            }else if ($b['saldo05c'] < 0){
                $sum05_aset += $b['saldo05c'];
            }else if ($b['saldo05c'] == 0){
                $sum05_aset += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum06_aset = 0;
    }else{
        if($b['saldo06d']<>0){
            $sum06_aset += $b['saldo06d'];
        }else{
            if ($b['saldo06c'] > 0){
                $sum06_aset += $b['saldo06c']*-1;
            }else if ($b['saldo06c'] < 0){
                $sum06_aset += $b['saldo06c'];
            }else if ($b['saldo06c'] == 0){
                $sum06_aset += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum07_aset = 0;
    }else{
        if($b['saldo07d']<>0){
            $sum07_aset += $b['saldo07d'];
        }else{
            if ($b['saldo07c'] > 0){
                $sum07_aset += $b['saldo07c']*-1;
            }else if ($b['saldo07c'] < 0){
                $sum07_aset += $b['saldo07c'];
            }else if ($b['saldo07c'] == 0){
                $sum07_aset += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum08_aset = 0;
    }else{
        if($b['saldo08d']<>0){
            $sum08_aset += $b['saldo08d'];
        }else{
            if ($b['saldo08c'] > 0){
                $sum08_aset += $b['saldo08c']*-1;
            }else if ($b['saldo08c'] < 0){
                $sum08_aset += $b['saldo08c'];
            }else if ($b['saldo08c'] == 0){
                $sum08_aset += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum09_aset = 0;
    }else{
        if($b['saldo09d']<>0){
            $sum09_aset += $b['saldo09d'];
        }else{
            if ($b['saldo09c'] > 0){
                $sum09_aset += $b['saldo09c']*-1;
            }else if ($b['saldo09c'] < 0){
                $sum09_aset += $b['saldo09c'];
            }else if ($b['saldo09c'] == 0){
                $sum09_aset += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum10_aset = 0;
    }else{
        if($b['saldo10d']<>0){
            $sum10_aset += $b['saldo10d'];
        }else{
            if ($b['saldo10c'] > 0){
                $sum10_aset += $b['saldo10c']*-1;
            }else if ($b['saldo10c'] < 0){
                $sum10_aset += $b['saldo10c'];
            }else if ($b['saldo10c'] == 0){
                $sum10_aset += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum11_aset = 0;
    }else{
        if($b['saldo11d']<>0){
            $sum11_aset += $b['saldo11d'];
        }else{
            if ($b['saldo11c'] > 0){
                $sum11_aset += $b['saldo11c']*-1;
            }else if ($b['saldo11c'] < 0){
                $sum11_aset += $b['saldo11c'];
            }else if ($b['saldo11c'] == 0){
                $sum11_aset += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum12_aset = 0;
    }else{
        if($b['saldo12d']<>0){
            $sum12_aset += $b['saldo12d'];
        }else{
            if ($b['saldo12c'] > 0){
                $sum12_aset += $b['saldo12c']*-1;
            }else if ($b['saldo12c'] < 0){
                $sum12_aset += $b['saldo12c'];
            }else if ($b['saldo12c'] == 0){
                $sum12_aset += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	

?>
<tr>
    <td align="center" width="10%" style="<?php echo $bolds;?>">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;<?php echo $bolds;?>"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
        if($b['yeard']<>0){
            $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            $saldo_year_aset_x += $angka;
            echo $angka;
        }else{
            
            if ($b['yearc'] > 0){
                $yearc_c    = $b['yearc']*-1;
                $saldo_year_aset_x += $b['yearc']*-1;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($yearc_c,0));
            }else if ($b['yearc'] < 0){
                $saldo_year_aset_x += $b['yearc'];
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yearc'],0));
            }else if ($b['yearc'] == 0){
                $saldo_year_aset_x += 0;
                echo 0;
            } else {
                //disini numeric value
            }
            
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldoo01d = $b['saldo01d'];
    $saldoo01c = $b['saldo01c'];
    
    if($saldoo01d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoo01d,0));
        $saldo01_aset_x += $angka;
        echo $angka;
    }else{
        if ($saldoo01c > 0){
            $saldo01_aset    = $saldoo01c*-1;
            $saldo01_aset_x += $saldoo01c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo01_aset,0));
        }else if ($saldoo01c < 0){
            $saldo01_aset_x += $saldoo01c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoo01c,0));
        }else if ($saldoo01c == 0){
            $saldo01_aset_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoo02d = $b['saldo02d'];
    $saldoo02c = $b['saldo02c'];
    
    if($saldoo02d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoo02d,0));
        $saldo02_aset_x += $saldoo02d;
        echo $angka;
    }else{
        if ($saldoo02c > 0){
            $saldo02_aset    = $saldoo02c*-1;
            $saldo02_aset_x += $saldoo02c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo02_aset,0));
        }else if ($saldoo02c < 0){
            $saldo02_aset_x += $saldoo02c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoo02c,0));
        }else if ($saldoo02c == 0){
            $saldo02_aset_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooaset03d = $b['saldo03d'];
    $saldooaset03c = $b['saldo03c'];
    
    if($saldooaset03d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset03d,0));
        $saldo03_aset_x += $saldooaset03d;
        echo $angka;
    }else{
        if ($saldooaset03c > 0){
            $saldo03_aset    = $saldooaset03c*-1;
            $saldo03_aset_x += $saldooaset03c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo03_aset,0));
        }else if ($saldooaset03c < 0){
            $saldo03_aset_x += $saldooaset03c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset03c,0));
        }else if ($saldooaset03c == 0){
            $saldo03_aset_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooaset04d = $b['saldo04d'];
    $saldooaset04c = $b['saldo04c'];
    
    if($saldooaset04d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset04d,0));
        $saldo04_aset_x += $saldooaset04d;
        echo $angka;
    }else{
        if ($saldooaset04c > 0){
            $saldo04_aset    = $saldooaset04c*-1;
            $saldo04_aset_x += $saldooaset04c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo04_aset,0));
        }else if ($saldooaset04c < 0){
            $saldo04_aset_x += $saldooaset04c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset04c,0));
        }else if ($saldooaset04c == 0){
            $saldo04_aset_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooaset05d = $b['saldo05d'];
    $saldooaset05c = $b['saldo05c'];
    
    if($saldooaset05d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset05d,0));
        $saldo05_aset_x += $saldooaset05d;
        echo $angka;
    }else{
        if ($saldooaset05c > 0){
            $saldo05_aset    = $saldooaset05c*-1;
            $saldo05_aset_x += $saldooaset05c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo05_aset,0));
        }else if ($saldooaset05c < 0){
            $saldo05_aset_x += $saldooaset05c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset05c,0));
        }else if ($saldooaset05c == 0){
            $saldo05_aset_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooaset06d = $b['saldo06d'];
    $saldooaset06c = $b['saldo06c'];
    
    if($saldooaset06d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset06d,0));
        $saldo06_aset_x += $saldooaset06d;
        echo $angka;
    }else{
        if ($saldooaset06c > 0){
            $saldo06_aset    = $saldooaset06c*-1;
            $saldo06_aset_x += $saldooaset06c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo06_aset,0));
        }else if ($saldooaset06c < 0){
            $saldo06_aset_x += $saldooaset06c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset06c,0));
        }else if ($saldooaset06c == 0){
            $saldo06_aset_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooaset07d = $b['saldo07d'];
    $saldooaset07c = $b['saldo07c'];
    
    if($saldooaset07d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset07d,0));
        $saldo07_aset_x += $saldooaset07d;
        echo $angka;
    }else{
        if ($saldooaset07c > 0){
            $saldo07_aset    = $saldooaset07c*-1;
            $saldo07_aset_x += $saldooaset07c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo07_aset,0));
        }else if ($saldooaset07c < 0){
            $saldo07_aset_x += $saldooaset07c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset07c,0));
        }else if ($saldooaset07c == 0){
            $saldo07_aset_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooaset08d = $b['saldo08d'];
    $saldooaset08c = $b['saldo08c'];
    
    if($saldooaset08d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset08d,0));
        $saldo08_aset_x += $saldooaset08;
        echo $angka;
    }else{
        if ($saldooaset08c > 0){
            $saldo08_aset    = $saldooaset08c*-1;
            $saldo08_aset_x += $saldooaset08c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo08_aset,0));
        }else if ($saldooaset08c < 0){
            $saldo08_aset_x += $saldooaset08c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset08c,0));
        }else if ($saldooaset08c == 0){
            $saldo08_aset_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooaset09d = $b['saldo09d'];
    $saldooaset09c = $b['saldo09c'];
    
    if($saldooaset09d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset09d,0));
        $saldo09_aset_x += $saldooaset09d;
        echo $angka;
    }else{
        if ($saldooaset09c > 0){
            $saldo09_aset    = $saldooaset09c*-1;
            $saldo09_aset_x += $saldooaset09c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo09_aset,0));
        }else if ($saldooaset09c < 0){
            $saldo09_aset_x += $saldooaset09c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset09c,0));
        }else if ($saldooaset09c == 0){
            $saldo09_aset_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooaset10d = $b['saldo10d'];
    $saldooaset10c = $b['saldo10c'];
    
    if($saldooaset10d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset10d,0));
        $saldo10_aset_x += $saldooaset10d;
        echo $angka;
    }else{
        if ($saldooaset10c > 0){
            $saldo10_aset    = $saldooaset10c*-1;
            $saldo10_aset_x += $saldooaset10c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo10_aset,0));
        }else if ($saldooaset10c < 0){
            $saldo10_aset_x += $saldooaset10c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset10c,0));
        }else if ($saldooaset10c == 0){
            $saldo10_aset_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooaset11d = $b['saldo11d'];
    $saldooaset11c = $b['saldo11c'];
    
    if($saldooaset11d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset11d,0));
        $saldo11_aset_x += $saldooaset11d;
        echo $angka;
    }else{
        if ($saldooaset11c > 0){
            $saldo11_aset    = $saldooaset11c*-1;
            $saldo11_aset_x += $saldooaset11c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo11_aset,0));
        }else if ($saldooaset11c < 0){
            $saldo11_aset_x += $saldooaset11c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset11c,0));
        }else if ($saldooaset11c == 0){
            $saldo11_aset_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooaset12d = $b['saldo12d'];
    $saldooaset12c = $b['saldo12c'];
    
    if($saldooaset12d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset12d,0));
        $saldo12_aset_x += $saldooaset12d;
        echo $angka;
    }else{
        if ($saldooaset12c > 0){
            $saldo12_aset    = $saldooaset12c*-1;
            $saldo12_aset_x += $saldooaset12c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo12_aset,0));
        }else if ($saldooaset12c < 0){
            $saldo12_aset_x += $saldooaset11c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset12c,0));
        }else if ($saldooaset12c == 0){
            $saldo12_aset_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldooaset_yeard_xx = $b['yeard'];
    $saldooaset_yearc_xx = $b['yearc'];
	
    $saldooaset01d_xx = $b['saldo01d'];
    $saldooaset01c_xx = $b['saldo01c'];
    //
    $saldooaset02d_xx = $b['saldo02d'];
    $saldooaset02c_xx = $b['saldo02c'];
    //
    $saldooaset03d_xx = $b['saldo03d'];
    $saldooaset03c_xx = $b['saldo03c'];
    //
    $saldooaset04d_xx = $b['saldo04d'];
    $saldooaset04c_xx = $b['saldo04c'];
    //
    $saldooaset05d_xx = $b['saldo05d'];
    $saldooaset05c_xx = $b['saldo05c'];
    //
    $saldooaset06d_xx = $b['saldo06d'];
    $saldooaset06c_xx = $b['saldo06c'];
    //
    $saldooaset07d_xx = $b['saldo07d'];
    $saldooaset07c_xx = $b['saldo07c'];
    //
    $saldooaset08d_xx = $b['saldo08d'];
    $saldooaset08c_xx = $b['saldo08c'];
    //
    $saldooaset09d_xx = $b['saldo09d'];
    $saldooaset09c_xx = $b['saldo09c'];
    //
    $saldooaset10d_xx = $b['saldo10d'];
    $saldooaset10c_xx = $b['saldo10c'];
    //
    $saldooaset11d_xx = $b['saldo11d'];
    $saldooaset11c_xx = $b['saldo11c'];
    //
    $saldooaset12d_xx = $b['saldo12d'];
    $saldooaset12c_xx = $b['saldo12c'];
    
    
    //+$saldo09_aset+$saldo08_aset+$saldo07_aset+$saldo06_aset+$saldo05_aset+$saldo04_aset+$saldo03_aset+$saldo02_aset+$saldo01_aset
        
		if($saldooaset_yeard_xx<>0){
            $saldo_year_aset_xx = $saldooaset_yeard_xx;
        }else{
            if ($saldooaset_yearc_xx > 0){
                $saldo_year_aset_xx = $saldooaset_yearc_xx*-1;
            }else if ($saldooaset_yearc_xx < 0){
                $saldo_year_aset_xx = $saldooaset_yearc_xx;
            }else if ($saldooaset_yearc_xx == 0){
                $saldo_year_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
        if($saldooaset01d_xx<>0){
            $saldo01_aset_xx = $saldooaset01d_xx;
        }else{
            if ($saldooaset01c_xx > 0){
                $saldo01_aset_xx = $saldooaset01c_xx*-1;
            }else if ($saldooaset01c_xx < 0){
                $saldo01_aset_xx = $saldooaset01c_xx;
            }else if ($saldooaset01c_xx == 0){
                $saldo01_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldooaset02d_xx<>0){
            $saldo02_aset_xx = $saldooaset02d_xx;
        }else{
            if ($saldooaset02c_xx > 0){
                $saldo02_aset_xx = $saldooaset02c_xx*-1;
            }else if ($saldooaset02c_xx < 0){
                $saldo02_aset_xx = $saldooaset02c_xx;
            }else if ($saldooaset02c_xx == 0){
                $saldo02_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldooaset03d_xx<>0){
             $saldo03_aset_xx = $saldooaset03d_xx;
        }else{
            if ($saldooaset03c_xx > 0){
                $saldo03_aset_xx = $saldooaset03c_xx*-1;
            }else if ($saldooaset03c_xx < 0){
                $saldo03_aset_xx = $saldooaset03c_xx;
            }else if ($saldooaset03c_xx == 0){
                $saldo03_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldooaset04d_xx<>0){
             $saldo04_aset_xx = $saldooaset04d_xx;
        }else{
            if ($saldooaset04c_xx > 0){
                $saldo04_aset_xx = $saldooaset04c_xx*-1;
            }else if ($saldooaset04c_xx < 0){
                $saldo04_aset_xx = $saldooaset04c_xx;
            }else if ($saldooaset04c_xx == 0){
                $saldo04_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldooaset05d_xx<>0){
             $saldo05_aset_xx = $saldooaset05d_xx;
        }else{
            if ($saldooaset05c_xx > 0){
                $saldo05_aset_xx = $saldooaset05c_xx*-1;
            }else if ($saldooaset04c_xx < 0){
                $saldo05_aset_xx = $saldooaset05c_xx;
            }else if ($saldooaset05c_xx == 0){
                $saldo05_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldooaset06d_xx<>0){
             $saldo06_aset_xx = $saldooaset06d_xx;
        }else{
            if ($saldooaset06c_xx > 0){
                $saldo06_aset_xx = $saldooaset06c_xx*-1;
            }else if ($saldooaset04c_xx < 0){
                $saldo06_aset_xx = $saldooaset06c_xx;
            }else if ($saldooaset06c_xx == 0){
                $saldo06_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldooaset07d_xx<>0){
             $saldo07_aset_xx = $saldooaset07d_xx;
        }else{
            if ($saldooaset07c_xx > 0){
                $saldo07_aset_xx = $saldooaset07c_xx*-1;
            }else if ($saldooaset07c_xx < 0){
                $saldo07_aset_xx = $saldooaset07c_xx;
            }else if ($saldooaset07c_xx == 0){
                $saldo07_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldooaset08d_xx<>0){
             $saldo08_aset_xx = $saldooaset08d_xx;
        }else{
            if ($saldooaset08c_xx > 0){
                $saldo08_aset_xx = $saldooaset08c_xx*-1;
            }else if ($saldooaset08c_xx < 0){
                $saldo08_aset_xx = $saldooaset08c_xx;
            }else if ($saldooaset08c_xx == 0){
                $saldo08_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldooaset09d_xx<>0){
             $saldo09_aset_xx = $saldooaset09d_xx;
        }else{
            if ($saldooaset09c_xx > 0){
                $saldo09_aset_xx = $saldooaset09c_xx*-1;
            }else if ($saldooaset09c_xx < 0){
                $saldo09_aset_xx = $saldooaset09c_xx;
            }else if ($saldooaset09c_xx == 0){
                $saldo09_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldooaset10d_xx<>0){
             $saldo10_aset_xx = $saldooaset10d_xx;
        }else{
            if ($saldooaset10c_xx > 0){
                $saldo10_aset_xx = $saldooaset10c_xx*-1;
            }else if ($saldooaset10c_xx < 0){
                $saldo10_aset_xx = $saldooaset10c_xx;
            }else if ($saldooaset10c_xx == 0){
                $saldo10_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldooaset11d_xx<>0){
             $saldo11_aset_xx = $saldooaset11d_xx;
        }else{
            if ($saldooaset11c_xx > 0){
                $saldo11_aset_xx = $saldooaset11c_xx*-1;
            }else if ($saldooaset11c_xx < 0){
                $saldo11_aset_xx = $saldooaset11c_xx;
            }else if ($saldooaset11c_xx == 0){
                $saldo11_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
        
        if($saldooaset12d_xx<>0){
             $saldo12_aset_xx = $saldooaset12d_xx;
        }else{
            if ($saldooaset12c_xx > 0){
                $saldo12_aset_xx = $saldooaset12c_xx*-1;
            }else if ($saldooaset12c_xx < 0){
                $saldo12_aset_xx = $saldooaset12c_xx;
            }else if ($saldooaset12c_xx == 0){
                $saldo12_aset_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
    
        $totalaset       = $saldo_year_aset_xx+$saldo01_aset_xx+$saldo02_aset_xx+$saldo03_aset_xx+$saldo04_aset_xx+$saldo05_aset_xx+$saldo06_aset_xx+$saldo07_aset_xx+$saldo08_aset_xx+$saldo09_aset_xx+$saldo10_aset_xx+$saldo11_aset_xx+$saldo12_aset_xx;
        $totaltb_aset   += $totalaset;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalaset,0));
        
        //echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalaset,0));
        // var_dump("aset 12 :".$saldo12_aset." | aset 11 :".$saldo11_aset." | aset 10 :".$saldo10_aset_xx);
        
    ?>
</td>

</tr>
<?php
}
}
?>
<!-- END ASSETS -->











<!-- START EKUITAS -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; EKUITAS</td>
</tr>
<?php

$year_ekuitas_x;
$saldo01_ekuitas_x;
$saldo02_ekuitas_x;
$saldo03_ekuitas_x;
$saldo04_ekuitas_x;
$saldo05_ekuitas_x;
$saldo06_ekuitas_x;
$saldo07_ekuitas_x;
$saldo08_ekuitas_x;
$saldo09_ekuitas_x;
$saldo10_ekuitas_x;
$saldo11_ekuitas_x;
$saldo12_ekuitas_x;
$totaltb_ekuitas;
$saldo01_ekuitas_g;


$sum01_ekuitas;
$sum02_ekuitas;
$sum03_ekuitas;
$sum04_ekuitas;
$sum05_ekuitas;
$sum06_ekuitas;
$sum07_ekuitas;
$sum08_ekuitas;
$sum09_ekuitas;
$sum10_ekuitas;
$sum11_ekuitas;
$sum12_ekuitas;


foreach($data_list_capital as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];

if($b['level'] == 1 && $b['type'] == 'G'){
    $bold_cap = 'font-weight:bold';
    
    if($b['saldo01d']<>0){
        $saldo01_ekuitas_g += $b['saldo01d'];
    }else{
        $sal01 = $b['saldo01c']*-1;
        $saldo01_ekuitas_g += $sal01;
    }
    
}else{
    $bold_cap = '';
}
    
if($group_n == 'Capital'){
    
	if($b['level'] == 1 && $b['type'] == 'G'){
        $bold_liab = 'font-weight:bold';
    }else{
        $bold_liab = '';
    }
   
   
    if($b['level'] == 1 && $b['type'] == 'G'){
		$sum01_ekuitas = 0;
    }else{
    
        if($b['saldo01d']<>0){
            $sum01_ekuitas += $b['saldo01d'];
        }else{
            if ($b['saldo01c'] > 0){
                $sum01_ekuitas += $b['saldo01c']*-1;
            }else if ($b['saldo01c'] < 0){
                $sum01_ekuitas += $b['saldo01c'];
            }else if ($b['saldo01c'] == 0){
                $sum01_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
		
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum02_ekuitas = 0;
    }else{
        if($b['saldo02d']<>0){
            $sum02_ekuitas += $b['saldo02d'];
        }else{
            if ($b['saldo02c'] > 0){
                $sum02_ekuitas += $b['saldo02c']*-1;
            }else if ($b['saldo02c'] < 0){
                $sum02_ekuitas += $b['saldo02c'];
            }else if ($b['saldo02c'] == 0){
                $sum02_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum03_ekuitas = 0;
    }else{
        if($b['saldo03d']<>0){
            $sum03_ekuitas += $b['saldo03d'];
        }else{
            if ($b['saldo03c'] > 0){
                $sum03_ekuitas += $b['saldo03c']*-1;
            }else if ($b['saldo03c'] < 0){
                $sum03_ekuitas += $b['saldo03c'];
            }else if ($b['saldo03c'] == 0){
                $sum03_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum04_ekuitas = 0;
    }else{
        if($b['saldo04d']<>0){
            $sum04_ekuitas += $b['saldo04d'];
        }else{
            if ($b['saldo04c'] > 0){
                $sum04_ekuitas += $b['saldo04c']*-1;
            }else if ($b['saldo04c'] < 0){
                $sum04_ekuitas += $b['saldo04c'];
            }else if ($b['saldo04c'] == 0){
                $sum04_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum05_ekuitas = 0;
    }else{
        if($b['saldo05d']<>0){
            $sum05_ekuitas += $b['saldo04d'];
        }else{
            if ($b['saldo05c'] > 0){
                $sum05_ekuitas += $b['saldo05c']*-1;
            }else if ($b['saldo05c'] < 0){
                $sum05_ekuitas += $b['saldo05c'];
            }else if ($b['saldo05c'] == 0){
                $sum05_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum06_ekuitas = 0;
    }else{
        if($b['saldo06d']<>0){
            $sum06_ekuitas += $b['saldo06d'];
        }else{
            if ($b['saldo06c'] > 0){
                $sum06_ekuitas += $b['saldo06c']*-1;
            }else if ($b['saldo06c'] < 0){
                $sum06_ekuitas += $b['saldo06c'];
            }else if ($b['saldo06c'] == 0){
                $sum06_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum07_ekuitas = 0;
    }else{
        if($b['saldo07d']<>0){
            $sum07_ekuitas += $b['saldo07d'];
        }else{
            if ($b['saldo07c'] > 0){
                $sum07_ekuitas += $b['saldo07c']*-1;
            }else if ($b['saldo07c'] < 0){
                $sum07_ekuitas += $b['saldo07c'];
            }else if ($b['saldo07c'] == 0){
                $sum07_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum08_ekuitas = 0;
    }else{
        if($b['saldo08d']<>0){
            $sum08_ekuitas += $b['saldo08d'];
        }else{
            if ($b['saldo08c'] > 0){
                $sum08_ekuitas += $b['saldo08c']*-1;
            }else if ($b['saldo08c'] < 0){
                $sum08_ekuitas += $b['saldo08c'];
            }else if ($b['saldo08c'] == 0){
                $sum08_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum09_ekuitas = 0;
    }else{
        if($b['saldo09d']<>0){
            $sum09_ekuitas += $b['saldo09d'];
        }else{
            if ($b['saldo09c'] > 0){
                $sum09_ekuitas += $b['saldo09c']*-1;
            }else if ($b['saldo09c'] < 0){
                $sum09_ekuitas += $b['saldo09c'];
            }else if ($b['saldo09c'] == 0){
                $sum09_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum10_ekuitas = 0;
    }else{
        if($b['saldo10d']<>0){
            $sum10_ekuitas += $b['saldo10d'];
        }else{
            if ($b['saldo10c'] > 0){
                $sum10_ekuitas += $b['saldo10c']*-1;
            }else if ($b['saldo10c'] < 0){
                $sum10_ekuitas += $b['saldo10c'];
            }else if ($b['saldo10c'] == 0){
                $sum10_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum11_ekuitas = 0;
    }else{
        if($b['saldo11d']<>0){
            $sum11_ekuitas += $b['saldo11d'];
        }else{
            if ($b['saldo11c'] > 0){
                $sum11_ekuitas += $b['saldo11c']*-1;
            }else if ($b['saldo11c'] < 0){
                $sum11_ekuitas += $b['saldo11c'];
            }else if ($b['saldo11c'] == 0){
                $sum11_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum12_ekuitas = 0;
    }else{
        if($b['saldo12d']<>0){
            $sum12_ekuitas += $b['saldo12d'];
        }else{
            if ($b['saldo12c'] > 0){
                $sum12_ekuitas += $b['saldo12c']*-1;
            }else if ($b['saldo12c'] < 0){
                $sum12_ekuitas += $b['saldo12c'];
            }else if ($b['saldo12c'] == 0){
                $sum12_ekuitas += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
?>
<tr>
<td align="center" width="10%" style='<?php echo $bold_cap;?>'>&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;<?php echo $bold_cap;?>"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
        if($b['yeard']<>0){
            $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            $saldo_year_ekuitas_x += $angka;
            echo $angka;
        }else{
            
            if ($b['yearc'] > 0){
                $yearc_c    = $b['yearc']*-1;
                $saldo_year_ekuitas_x += $b['yearc']*-1;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($yearc_c,0));
            }else if ($b['yearc'] < 0){
                $saldo_year_ekuitas_x += $b['yearc'];
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yearc'],0));
            }else if ($b['yearc'] == 0){
                $saldo_year_ekuitas_x += 0;
                echo 0;
            } else {
                //disini numeric value
            }
            
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldooekuitas01d = $b['saldo01d'];
    $saldooekuitas01c = $b['saldo01c'];
    
    if($saldooekuitas01d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas01d,0));
        $saldo01_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas01c > 0){
            $saldo01_ekuitas    = $saldooekuitas01c*-1;
            $saldo01_ekuitas_x += $saldooekuitas01c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo01_ekuitas,0));
        }else if ($saldooekuitas01c < 0){
            $saldo01_ekuitas_x += $saldooekuitas01c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas01c,0));
        }else if ($saldooekuitas01c == 0){
            $saldo01_ekuitas_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooekuitas02d = $b['saldo02d'];
    $saldooekuitas02c = $b['saldo02c'];
    
    if($saldooekuitas02d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas02d,0));
        $saldo02_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas02c > 0){
            $saldo02_ekuitas    = $saldooekuitas02c*-1;
            $saldo02_ekuitas_x += $saldooekuitas02c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo02_ekuitas,0));
        }else if ($saldooekuitas02c < 0){
            $saldo02_ekuitas_x += $saldooekuitas02c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas02c,0));
        }else if ($saldooekuitas02c == 0){
            $saldo02_ekuitas_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooekuitas03d = $b['saldo03d'];
    $saldooekuitas03c = $b['saldo03c'];
    
    if($saldooekuitas03d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas03d,0));
        $saldo03_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas03c > 0){
            $saldo03_ekuitas    = $saldooekuitas03c*-1;
            $saldo03_ekuitas_x += $saldooekuitas03c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo03_ekuitas,0));
        }else if ($saldooekuitas03c < 0){
            $saldo03_ekuitas_x += $saldooekuitas03c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas03c,0));
        }else if ($saldooekuitas03c == 0){
            $saldo03_ekuitas_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooekuitas04d = $b['saldo04d'];
    $saldooekuitas04c = $b['saldo04c'];
    
    if($saldooekuitas04d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas04d,0));
        $saldo04_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas04c > 0){
            $saldo04_ekuitas    = $saldooekuitas04c*-1;
            $saldo04_ekuitas_x += $saldooekuitas04c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo04_ekuitas,0));
        }else if ($saldooekuitas04c < 0){
            $saldo04_ekuitas_x += $saldooekuitas04c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas04c,0));
        }else if ($saldooekuitas04c == 0){
            $saldo04_ekuitas_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooekuitas05d = $b['saldo05d'];
    $saldooekuitas05c = $b['saldo05c'];
    
    if($saldooekuitas05d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas05d,0));
        $saldo05_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas05c > 0){
            $saldo05_ekuitas    = $saldooekuitas05c*-1;
            $saldo05_ekuitas_x += $saldooekuitas05c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo05_ekuitas,0));
        }else if ($saldooekuitas05c < 0){
            $saldo05_ekuitas_x += $saldooekuitas05c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas05c,0));
        }else if ($saldooekuitas05c == 0){
            $saldo05_ekuitas_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooekuitas06d = $b['saldo06d'];
    $saldooekuitas06c = $b['saldo06c'];
    
    if($saldooekuitas06d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas06d,0));
        $saldo06_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas06c > 0){
            $saldo06_ekuitas    = $saldooekuitas06c*-1;
            $saldo06_ekuitas_x += $saldooekuitas06c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo06_ekuitas,0));
        }else if ($saldooekuitas06c < 0){
            $saldo06_ekuitas_x += $saldooekuitas06c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas06c,0));
        }else if ($saldooekuitas06c == 0){
            $saldo06_ekuitas_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooekuitas07d = $b['saldo07d'];
    $saldooekuitas07c = $b['saldo07c'];
    
    if($saldooekuitas07d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas07d,0));
        $saldo07_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas07c > 0){
            $saldo07_ekuitas    = $saldooekuitas07c*-1;
            $saldo07_ekuitas_x += $saldooekuitas07c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo07_ekuitas,0));
        }else if ($saldooekuitas07c < 0){
            $saldo07_ekuitas_x += $saldooekuitas07c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas07c,0));
        }else if ($saldooekuitas07c == 0){
            $saldo07_ekuitas_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooekuitas08d = $b['saldo08d'];
    $saldooekuitas08c = $b['saldo08c'];
    
    if($saldooekuitas08d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas08d,0));
        $saldo08_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas08c > 0){
            $saldo08_ekuitas    = $saldooekuitas08c*-1;
            $saldo08_ekuitas_x += $saldooekuitas08c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo08_ekuitas,0));
        }else if ($saldooekuitas08c < 0){
            $saldo08_ekuitas_x += $saldooekuitas08c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas08c,0));
        }else if ($saldooekuitas08c == 0){
            $saldo08_ekuitas_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooekuitas09d = $b['saldo09d'];
    $saldooekuitas09c = $b['saldo09c'];
    
    if($saldooekuitas09d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas09d,0));
        $saldo09_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas09c > 0){
            $saldo09_ekuitas    = $saldooekuitas09c*-1;
            $saldo09_ekuitas_x += $saldooekuitas09c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo09_ekuitas,0));
        }else if ($saldooekuitas09c < 0){
            $saldo09_ekuitas_x += $saldooekuitas09c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas09c,0));
        }else if ($saldooekuitas09c == 0){
            $saldo09_ekuitas_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooekuitas10d = $b['saldo10d'];
    $saldooekuitas10c = $b['saldo10c'];
    
    if($saldooaset10d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset10d,0));
        $saldo10_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas10c > 0){
            $saldo10_ekuitas    = $saldooekuitas10c*-1;
            $saldo10_ekuitas_x += $saldooekuitas10c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo10_ekuitas,0));
        }else if ($saldooekuitas10c < 0){
            $saldo10_ekuitas_x += $saldooekuitas10c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas10c,0));
        }else if ($saldooekuitas10c == 0){
            $saldo10_ekuitas_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooekuitas11d = $b['saldo11d'];
    $saldooekuitas11c = $b['saldo11c'];
    
    if($saldooekuitas11d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas11d,0));
        $saldo11_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas11c > 0){
            $saldo11_ekuitas    = $saldooekuitas11c*-1;
            $saldo11_ekuitas_x += $saldooekuitas11c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo11_ekuitas,0));
        }else if ($saldooekuitas11c < 0){
            $saldo11_ekuitas_x += $saldooekuitas11c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas11c,0));
        }else if ($saldooekuitas11c == 0){
            $saldo11_ekuitas_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldooekuitas12d = $b['saldo12d'];
    $saldooekuitas12c = $b['saldo12c'];
    
    if($saldooaset12d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooaset12d,0));
        $saldo12_ekuitas_x += $angka;
        echo $angka;
    }else{
        if ($saldooekuitas12c > 0){
            $saldo12_ekuitas    = $saldooekuitas12c*-1;
            $saldo12_ekuitas_x += $saldooekuitas12c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo12_ekuitas,0));
        }else if ($saldooekuitas12c < 0){
            $saldo12_ekuitas_x += $saldooaset11c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldooekuitas12c,0));
        }else if ($saldooekuitas12c == 0){
            $saldo12_ekuitas_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldooekuitas_yeard_xx = $b['yeard'];
    $saldooekuitas_yearc_xx = $b['yearc'];
	
    $saldooekuitas01d_xx = $b['saldo01d'];
    $saldooekuitas01c_xx = $b['saldo01c'];
    //
    $saldooekuitas02d_xx = $b['saldo02d'];
    $saldooekuitas02c_xx = $b['saldo02c'];
    //
    $saldooekuitas03d_xx = $b['saldo03d'];
    $saldooekuitas03c_xx = $b['saldo03c'];
    //
    $saldooekuitas04d_xx = $b['saldo04d'];
    $saldooekuitas04c_xx = $b['saldo04c'];
    //
    $saldooekuitas05d_xx = $b['saldo05d'];
    $saldooekuitas05c_xx = $b['saldo05c'];
    //
    $saldooekuitas06d_xx = $b['saldo06d'];
    $saldooekuitas06c_xx = $b['saldo06c'];
    //
    $saldooekuitas07d_xx = $b['saldo07d'];
    $saldooekuitas07c_xx = $b['saldo07c'];
    //
    $saldooekuitas08d_xx = $b['saldo08d'];
    $saldooekuitas08c_xx = $b['saldo08c'];
    //
    $saldooekuitas09d_xx = $b['saldo09d'];
    $saldooekuitas09c_xx = $b['saldo09c'];
    //
    $saldooekuitas10d_xx = $b['saldo10d'];
    $saldooekuitas10c_xx = $b['saldo10c'];
    //
    $saldooekuitas11d_xx = $b['saldo11d'];
    $saldooekuitas11c_xx = $b['saldo11c'];
    //
    $saldooekuitas12d_xx = $b['saldo12d'];
    $saldooekuitas12c_xx = $b['saldo12c'];
    
    
    //+$saldo09_aset+$saldo08_aset+$saldo07_aset+$saldo06_aset+$saldo05_aset+$saldo04_aset+$saldo03_aset+$saldo02_aset+$saldo01_aset
        
		if($saldooekuitas_yeard_xx<>0){
            $saldo_year_ekuitas_xx = $saldooekuitas_yeard_xx;
        }else{
            if ($saldooekuitas_yearc_xx > 0){
                $saldo_year_ekuitas_xx = $saldooekuitas_yearc_xx*-1;
            }else if ($saldooekuitas_yeard_xx < 0){
                $saldo_year_ekuitas_xx = $saldooekuitas_yearc_xx;
            }else if ($saldooekuitas_yeard_xx == 0){
                $saldo_year_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
        if($saldooekuitas01d_xx<>0){
            $saldo01_ekuitas_xx = $saldooaset01d_xx;
        }else{
            if ($saldooekuitas01c_xx > 0){
                $saldo01_ekuitas_xx = $saldooekuitas01c_xx*-1;
            }else if ($saldooekuitas01c_xx < 0){
                $saldo01_ekuitas_xx = $saldooekuitas01c_xx;
            }else if ($saldooekuitas01c_xx == 0){
                $saldo01_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldooekuitas02d_xx<>0){
            $saldo02_ekuitas_xx = $saldooekuitas02d_xx;
        }else{
            if ($saldooekuitas02c_xx > 0){
                $saldo02_ekuitas_xx = $saldooekuitas02c_xx*-1;
            }else if ($saldooekuitas02c_xx < 0){
                $saldo02_ekuitas_xx = $saldooekuitas02c_xx;
            }else if ($saldooekuitas02c_xx == 0){
                $saldo02_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldooekuitas03d_xx<>0){
             $saldo03_ekuitas_xx = $saldooekuitas03d_xx;
        }else{
            if ($saldooekuitas03c_xx > 0){
                $saldo03_ekuitas_xx = $saldooekuitas03c_xx*-1;
            }else if ($saldooekuitas03c_xx < 0){
                $saldo03_ekuitas_xx = $saldooekuitas03c_xx;
            }else if ($saldooekuitas03c_xx == 0){
                $saldo03_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldooekuitas04d_xx<>0){
             $saldo04_ekuitas_xx = $saldooekuitas04d_xx;
        }else{
            if ($saldooekuitas04c_xx > 0){
                $saldo04_ekuitas_xx = $saldooekuitas04c_xx*-1;
            }else if ($saldooekuitas04c_xx < 0){
                $saldo04_ekuitas_xx = $saldooekuitas04c_xx;
            }else if ($saldooekuitas04c_xx == 0){
                $saldo04_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldooekuitas05d_xx<>0){
             $saldo05_ekuitas_xx = $saldooekuitas05d_xx;
        }else{
            if ($saldooekuitas05c_xx > 0){
                $saldo05_ekuitas_xx = $saldooekuitas05c_xx*-1;
            }else if ($saldooekuitas05c_xx < 0){
                $saldo05_ekuitas_xx = $saldooekuitas05c_xx;
            }else if ($saldooekuitas05c_xx == 0){
                $saldo05_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldooekuitas06d_xx<>0){
             $saldo06_ekuitas_xx = $saldooekuitas06d_xx;
        }else{
            if ($saldooekuitas06c_xx > 0){
                $saldo06_ekuitas_xx = $saldooekuitas06c_xx*-1;
            }else if ($saldooekuitas06c_xx < 0){
                $saldo06_ekuitas_xx = $saldooekuitas06c_xx;
            }else if ($saldooekuitas06c_xx == 0){
                $saldo06_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldooekuitas07d_xx<>0){
             $saldo07_ekuitas_xx = $saldooekuitas07d_xx;
        }else{
            if ($saldooekuitas07c_xx > 0){
                $saldo07_ekuitas_xx = $saldooekuitas07c_xx*-1;
            }else if ($saldooekuitas07c_xx < 0){
                $saldo07_ekuitas_xx = $saldooekuitas07c_xx;
            }else if ($saldooekuitas07c_xx == 0){
                $saldo07_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldooekuitas08d_xx<>0){
             $saldo08_ekuitas_xx = $saldooekuitas08d_xx;
        }else{
            if ($saldooekuitas08c_xx > 0){
                $saldo08_ekuitas_xx = $saldooekuitas08c_xx*-1;
            }else if ($saldooekuitas08c_xx < 0){
                $saldo08_ekuitas_xx = $saldooekuitas08c_xx;
            }else if ($saldooekuitas08c_xx == 0){
                $saldo08_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldooekuitas09d_xx<>0){
             $saldo09_ekuitas_xx = $saldooekuitas09d_xx;
        }else{
            if ($saldooekuitas09c_xx > 0){
                $saldo09_ekuitas_xx = $saldooekuitas09c_xx*-1;
            }else if ($saldooekuitas09c_xx < 0){
                $saldo09_ekuitas_xx = $saldooekuitas09c_xx;
            }else if ($saldooekuitas09c_xx == 0){
                $saldo09_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldooekuitas10d_xx<>0){
             $saldo10_ekuitas_xx = $saldooekuitas10d_xx;
        }else{
            if ($saldooekuitas10c_xx > 0){
                $saldo10_ekuitas_xx = $saldooekuitas10c_xx*-1;
            }else if ($saldooekuitas10c_xx < 0){
                $saldo10_ekuitas_xx = $saldooekuitas10c_xx;
            }else if ($saldooekuitas10c_xx == 0){
                $saldo10_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldooekuitas11d_xx<>0){
             $saldo11_ekuitas_xx = $saldooekuitas11d_xx;
        }else{
            if ($saldooekuitas11c_xx > 0){
                $saldo11_ekuitas_xx = $saldooekuitas11c_xx*-1;
            }else if ($saldooekuitas11c_xx < 0){
                $saldo11_ekuitas_xx = $saldooekuitas11c_xx;
            }else if ($saldooekuitas11c_xx == 0){
                $saldo11_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
        
        if($saldooekuitas12d_xx<>0){
             $saldo12_ekuitas_xx = $saldooekuitas12d_xx;
        }else{
            if ($saldooekuitas12c_xx > 0){
                $saldo12_ekuitas_xx = $saldooekuitas12c_xx*-1;
            }else if ($saldooekuitas12c_xx < 0){
                $saldo12_ekuitas_xx = $saldooekuitas12c_xx;
            }else if ($saldooekuitas12c_xx == 0){
                $saldo12_ekuitas_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
    
        $totalekuitas      = $saldo_year_ekuitas_xx+$saldo01_ekuitas_xx+$saldo02_ekuitas_xx+$saldo03_ekuitas_xx+$saldo04_ekuitas_xx+$saldo05_ekuitas_xx+$saldo06_ekuitas_xx+$saldo07_ekuitas_xx+$saldo08_ekuitas_xx+$saldo09_ekuitas_xx+$saldo10_ekuitas_xx+$saldo11_ekuitas_xx+$saldo12_ekuitas_xx;
        $totaltb_ekuitas   += $totalekuitas;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalekuitas,0));
		
		
    ?>
</td>

</tr>
<?php
}
}
?>
<!-- END EKUITAS -->













<!-- START BIAYA -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; BIAYA</td>
</tr>
<?php

$year_biaya_x;
$saldo01_biaya_x;
$saldo02_biaya_x;
$saldo03_biaya_x;
$saldo04_biaya_x;
$saldo05_biaya_x;
$saldo06_biaya_x;
$saldo07_biaya_x;
$saldo08_biaya_x;
$saldo09_biaya_x;
$saldo10_biaya_x;
$saldo11_biaya_x;
$saldo12_biaya_x;
$totaltb_biaya;


$sum01_biaya;
$sum02_biaya;
$sum03_biaya;
$sum04_biaya;
$sum05_biaya;
$sum06_biaya;
$sum07_biaya;
$sum08_biaya;
$sum09_biaya;
$sum10_biaya;
$sum11_biaya;
$sum12_biaya;


$saldo01_biaya_g;

foreach($data_list_expenses as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
    if($b['level'] == 1 && $b['type'] == 'G'){
        $bold_exp = 'font-weight:bold';
        
        if($b['saldo01d']<>0){
            $saldo01_biaya_g += $b['saldo01d'];
        }else{
            $sal01 = $b['saldo01c']*-1;
            $saldo01_biaya_g += $sal01;
        }
        
    }else{
        $bold_exp = '';
    }
    
    
if($group_n == 'Expenses'){
	
	
   
    if($b['level'] == 1 && $b['type'] == 'G'){
		$sum01_biaya = 0;
    }else{
    
        if($b['saldo01d']<>0){
            $sum01_biaya += $b['saldo01d'];
        }else{
            if ($b['saldo01c'] > 0){
                $sum01_biaya += $b['saldo01c']*-1;
            }else if ($b['saldo01c'] < 0){
                $sum01_biaya += $b['saldo01c'];
            }else if ($b['saldo01c'] == 0){
                $sum01_biaya += 0;
            }else{
                //disini numeric value
            }
        }
		
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum02_biaya = 0;
    }else{
        if($b['saldo02d']<>0){
            $sum02_biaya += $b['saldo02d'];
        }else{
            if ($b['saldo02c'] > 0){
                $sum02_biaya += $b['saldo02c']*-1;
            }else if ($b['saldo02c'] < 0){
                $sum02_biaya += $b['saldo02c'];
            }else if ($b['saldo02c'] == 0){
                $sum02_biaya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum03_biaya = 0;
    }else{
        if($b['saldo03d']<>0){
            $sum03_biaya += $b['saldo03d'];
        }else{
            if ($b['saldo03c'] > 0){
                $sum03_biaya += $b['saldo03c']*-1;
            }else if ($b['saldo03c'] < 0){
                $sum03_biaya += $b['saldo03c'];
            }else if ($b['saldo03c'] == 0){
                $sum03_biaya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum04_biaya = 0;
    }else{
        if($b['saldo04d']<>0){
            $sum04_biaya += $b['saldo04d'];
        }else{
            if ($b['saldo04c'] > 0){
                $sum04_biaya += $b['saldo04c']*-1;
            }else if ($b['saldo04c'] < 0){
                $sum04_biaya += $b['saldo04c'];
            }else if ($b['saldo04c'] == 0){
                $sum04_biaya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum05_biaya = 0;
    }else{
        if($b['saldo05d']<>0){
            $sum05_biaya += $b['saldo04d'];
        }else{
            if ($b['saldo05c'] > 0){
                $sum05_biaya += $b['saldo05c']*-1;
            }else if ($b['saldo05c'] < 0){
                $sum05_biaya += $b['saldo05c'];
            }else if ($b['saldo05c'] == 0){
                $sum05_biaya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum06_biaya = 0;
    }else{
        if($b['saldo06d']<>0){
            $sum06_biaya += $b['saldo06d'];
        }else{
            if ($b['saldo06c'] > 0){
                $sum06_biaya += $b['saldo06c']*-1;
            }else if ($b['saldo06c'] < 0){
                $sum06_biaya += $b['saldo06c'];
            }else if ($b['saldo06c'] == 0){
                $sum06_biaya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum07_biaya = 0;
    }else{
        if($b['saldo07d']<>0){
            $sum07_biaya += $b['saldo07d'];
        }else{
            if ($b['saldo07c'] > 0){
                $sum07_biaya += $b['saldo07c']*-1;
            }else if ($b['saldo07c'] < 0){
                $sum07_biaya += $b['saldo07c'];
            }else if ($b['saldo07c'] == 0){
                $sum07_biaya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum08_biaya = 0;
    }else{
        if($b['saldo08d']<>0){
            $sum08_biaya += $b['saldo08d'];
        }else{
            if ($b['saldo08c'] > 0){
                $sum08_biaya += $b['saldo08c']*-1;
            }else if ($b['saldo08c'] < 0){
                $sum08_biaya += $b['saldo08c'];
            }else if ($b['saldo08c'] == 0){
                $sum08_biaya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum09_biaya = 0;
    }else{
        if($b['saldo09d']<>0){
            $sum09_biaya += $b['saldo09d'];
        }else{
            if ($b['saldo09c'] > 0){
                $sum09_biaya += $b['saldo09c']*-1;
            }else if ($b['saldo09c'] < 0){
                $sum09_biaya += $b['saldo09c'];
            }else if ($b['saldo09c'] == 0){
                $sum09_biaya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum10_biaya = 0;
    }else{
        if($b['saldo10d']<>0){
            $sum10_biaya += $b['saldo10d'];
        }else{
            if ($b['saldo10c'] > 0){
                $sum10_biaya += $b['saldo10c']*-1;
            }else if ($b['saldo10c'] < 0){
                $sum10_biaya += $b['saldo10c'];
            }else if ($b['saldo10c'] == 0){
                $sum10_biaya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum11_biaya = 0;
    }else{
        if($b['saldo11d']<>0){
            $sum11_biaya += $b['saldo11d'];
        }else{
            if ($b['saldo11c'] > 0){
                $sum11_biaya += $b['saldo11c']*-1;
            }else if ($b['saldo11c'] < 0){
                $sum11_biaya += $b['saldo11c'];
            }else if ($b['saldo11c'] == 0){
                $sum11_biaya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum12_biaya = 0;
    }else{
        if($b['saldo12d']<>0){
            $sum12_biaya += $b['saldo12d'];
        }else{
            if ($b['saldo12c'] > 0){
                $sum12_biaya += $b['saldo12c']*-1;
            }else if ($b['saldo12c'] < 0){
                $sum12_biaya += $b['saldo12c'];
            }else if ($b['saldo12c'] == 0){
                $sum12_biaya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	

    
?>
<tr>
<td align="center" width="10%">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
        if($b['yeard']<>0){
            $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            $saldo_year_biaya_x += $angka;
            echo $angka;
        }else{
            
            if ($b['yearc'] > 0){
                $yearc_c    = $b['yearc']*-1;
                $saldo_year_biaya_x += $b['yearc']*-1;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($yearc_c,0));
            }else if ($b['yearc'] < 0){
                $saldo_year_biaya_x += $b['yearc'];
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yearc'],0));
            }else if ($b['yearc'] == 0){
                $saldo_year_biaya_x += 0;
                echo 0;
            } else {
                //disini numeric value
            }
            
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldoobiaya01d = $b['saldo01d'];
    $saldoobiaya01c = $b['saldo01c'];
    
    if($saldoobiaya01d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya01d,0));
        $saldo01_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya01c > 0){
            $saldo01_biaya    = $saldoobiaya01c*-1;
            $saldo01_biaya_x += $saldoobiaya01c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo01_biaya,0));
        }else if ($saldoobiaya01c < 0){
            $saldo01_biaya_x += $saldoobiaya01c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya01c,0));
        }else if ($saldoobiaya01c == 0){
            $saldo01_biaya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiaya02d = $b['saldo02d'];
    $saldoobiaya02c = $b['saldo02c'];
    
    if($saldoobiaya02d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya02d,0));
        $saldo02_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya02c > 0){
            $saldo02_biaya    = $saldoobiaya02c*-1;
            $saldo02_biaya_x += $saldoobiaya02c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo02_biaya,0));
        }else if ($saldoobiaya02c < 0){
            $saldo02_biaya_x += $saldoobiaya02c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya02c,0));
        }else if ($saldoobiaya02c == 0){
            $saldo02_biaya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiaya03d = $b['saldo03d'];
    $saldoobiaya03c = $b['saldo03c'];
    
    if($saldoobiaya03d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya03d,0));
        $saldo03_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya03c > 0){
            $saldo03_biaya    = $saldoobiaya03c*-1;
            $saldo03_biaya_x += $saldoobiaya03c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo03_biaya,0));
        }else if ($saldoobiaya03c < 0){
            $saldo03_biaya_x += $saldoobiaya03c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya03c,0));
        }else if ($saldoobiaya03c == 0){
            $saldo03_biaya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiaya04d = $b['saldo04d'];
    $saldoobiaya04c = $b['saldo04c'];
    
    if($saldoobiaya04d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya04d,0));
        $saldo04_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya04c > 0){
            $saldo04_biaya    = $saldoobiaya04c*-1;
            $saldo04_biaya_x += $saldoobiaya04c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo04_biaya,0));
        }else if ($saldoobiaya04c < 0){
            $saldo04_biaya_x += $saldoobiaya04c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya04c,0));
        }else if ($saldoobiaya04c == 0){
            $saldo04_biaya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiaya05d = $b['saldo05d'];
    $saldoobiaya05c = $b['saldo05c'];
    
    if($saldoobiaya05d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya05d,0));
        $saldo05_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya05c > 0){
            $saldo05_biaya    = $saldoobiaya05c*-1;
            $saldo05_biaya_x += $saldoobiaya05c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo05_biaya,0));
        }else if ($saldoobiaya05c < 0){
            $saldo05_biaya_x += $saldoobiaya05c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya05c,0));
        }else if ($saldoobiaya05c == 0){
            $saldo05_biaya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiaya06d = $b['saldo06d'];
    $saldoobiaya06c = $b['saldo06c'];
    
    if($saldoobiaya06d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya06d,0));
        $saldo06_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya06c > 0){
            $saldo06_biaya    = $saldoobiaya06c*-1;
            $saldo06_biaya_x += $saldoobiaya06c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo06_biaya,0));
        }else if ($saldoobiaya06c < 0){
            $saldo06_biaya_x += $saldoobiaya06c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya06c,0));
        }else if ($saldoobiaya06c == 0){
            $saldo06_biaya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiaya07d = $b['saldo07d'];
    $saldoobiaya07c = $b['saldo07c'];
    
    if($saldoobiaya07d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya07d,0));
        $saldo07_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya07c > 0){
            $saldo07_biaya    = $saldoobiaya07c*-1;
            $saldo07_biaya_x += $saldoobiaya07c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo07_biaya,0));
        }else if ($saldoobiaya07c < 0){
            $saldo07_biaya_x += $saldoobiaya07c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya07c,0));
        }else if ($saldoobiaya07c == 0){
            $saldo07_biaya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiaya08d = $b['saldo08d'];
    $saldoobiaya08c = $b['saldo08c'];
    
    if($saldoobiaya08d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya08d,0));
        $saldo08_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya08c > 0){
            $saldo08_biaya    = $saldoobiaya08c*-1;
            $saldo08_biaya_x += $saldoobiaya08c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo08_biaya,0));
        }else if ($saldoobiaya08c < 0){
            $saldo08_biaya_x += $saldoobiaya08c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya08c,0));
        }else if ($saldoobiaya08c == 0){
            $saldo08_biaya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiaya09d = $b['saldo09d'];
    $saldoobiaya09c = $b['saldo09c'];
    
    if($saldoobiaya09d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya09d,0));
        $saldo09_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya09c > 0){
            $saldo09_biaya    = $saldoobiaya09c*-1;
            $saldo09_biaya_x += $saldoobiaya09c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo09_biaya,0));
        }else if ($saldoobiaya09c < 0){
            $saldo09_biaya_x += $saldoobiaya09c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya09c,0));
        }else if ($saldoobiaya09c == 0){
            $saldo09_biaya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiaya10d = $b['saldo10d'];
    $saldoobiaya10c = $b['saldo10c'];
    
    if($saldoobiaya10d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya10d,0));
        $saldo10_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya10c > 0){
            $saldo10_biaya    = $saldoobiaya10c*-1;
            $saldo10_biaya_x += $saldoobiaya10c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo10_biaya,0));
        }else if ($saldoobiaya10c < 0){
            $saldo10_biaya_x += $saldoobiaya10c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya10c,0));
        }else if ($saldoobiaya10c == 0){
            $saldo10_biaya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiaya11d = $b['saldo11d'];
    $saldoobiaya11c = $b['saldo11c'];
    
    if($saldoobiaya11d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya11d,0));
        $saldo11_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya11c > 0){
            $saldo11_biaya    = $saldoobiaya11c*-1;
            $saldo11_biaya_x += $saldoobiaya11c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo11_biaya,0));
        }else if ($saldoobiaya11c < 0){
            $saldo11_biaya_x += $saldoobiaya11c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya11c,0));
        }else if ($saldoobiaya11c == 0){
            $saldo11_biaya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiaya12d = $b['saldo12d'];
    $saldoobiaya12c = $b['saldo12c'];
    
    if($saldoobiaya12d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya12d,0));
        $saldo12_biaya_x += $angka;
        echo $angka;
    }else{
        if ($saldoobiaya12c > 0){
            $saldo12_biaya    = $saldoobiaya12c*-1;
            $saldo12_biaya_x += $saldoobiaya12c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo12_biaya,0));
        }else if ($saldoobiaya12c < 0){
            $saldo12_biaya_x += $saldoobiaya12c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiaya12c,0));
        }else if ($saldoobiaya12c == 0){
            $saldo12_biaya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldoobiaya_yeard_xx = $b['yeard'];
    $saldoobiaya_yearc_xx = $b['yearc'];
	
    $saldoobiaya01d_xx = $b['saldo01d'];
    $saldoobiaya01c_xx = $b['saldo01c'];
    //
    $saldoobiaya02d_xx = $b['saldo02d'];
    $saldoobiaya02c_xx = $b['saldo02c'];
    //
    $saldoobiaya03d_xx = $b['saldo03d'];
    $saldoobiaya03c_xx = $b['saldo03c'];
    //
    $saldoobiaya04d_xx = $b['saldo04d'];
    $saldoobiaya04c_xx = $b['saldo04c'];
    //
    $saldoobiaya05d_xx = $b['saldo05d'];
    $saldoobiaya05c_xx = $b['saldo05c'];
    //
    $saldoobiaya06d_xx = $b['saldo06d'];
    $saldoobiaya06c_xx = $b['saldo06c'];
    //
    $saldoobiaya07d_xx = $b['saldo07d'];
    $saldoobiaya07c_xx = $b['saldo07c'];
    //
    $saldoobiaya08d_xx = $b['saldo08d'];
    $saldoobiaya08c_xx = $b['saldo08c'];
    //
    $saldoobiaya09d_xx = $b['saldo09d'];
    $saldoobiaya09c_xx = $b['saldo09c'];
    //
    $saldoobiaya10d_xx = $b['saldo10d'];
    $saldoobiaya10c_xx = $b['saldo10c'];
    //
    $saldoobiaya11d_xx = $b['saldo11d'];
    $saldoobiaya11c_xx = $b['saldo11c'];
    //
    $saldoobiaya12d_xx = $b['saldo12d'];
    $saldoobiaya12c_xx = $b['saldo12c'];
    
    
    //+$saldo09_aset+$saldo08_aset+$saldo07_aset+$saldo06_aset+$saldo05_aset+$saldo04_aset+$saldo03_aset+$saldo02_aset+$saldo01_aset
        
		if($saldoobiaya_yeard_xx<>0){
            $saldo_year_biaya_xx = $saldoobiaya_yeard_xx;
        }else{
            if ($saldoobiaya_yearc_xx > 0){
                $saldo_year_biaya_xx = $saldoobiaya_yearc_xx*-1;
            }else if ($saldoobiaya_yearc_xx < 0){
                $saldo_year_biaya_xx = $saldoobiaya_yearc_xx;
            }else if ($saldoobiaya_yearc_xx == 0){
                $saldo_year_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
        if($saldoobiaya01d_xx<>0){
            $saldo01_biaya_xx = $saldoobiaya01d_xx;
        }else{
            if ($saldoobiaya01c_xx > 0){
                $saldo01_biaya_xx = $saldoobiaya01c_xx*-1;
            }else if ($saldoobiaya01c_xx < 0){
                $saldo01_biaya_xx = $saldoobiaya01c_xx;
            }else if ($saldoobiaya01c_xx == 0){
                $saldo01_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoobiaya02d_xx<>0){
            $saldo02_biaya_xx = $saldoobiaya02d_xx;
        }else{
            if ($saldoobiaya02c_xx > 0){
                $saldo02_biaya_xx = $saldoobiaya02c_xx*-1;
            }else if ($saldoobiaya02c_xx < 0){
                $saldo02_biaya_xx = $saldoobiaya02c_xx;
            }else if ($saldoobiaya02c_xx == 0){
                $saldo02_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoobiaya03d_xx<>0){
             $saldo03_biaya_xx = $saldoobiaya03d_xx;
        }else{
            if ($saldoobiaya03c_xx > 0){
                $saldo03_biaya_xx = $saldoobiaya03c_xx*-1;
            }else if ($saldoobiaya03c_xx < 0){
                $saldo03_biaya_xx = $saldoobiaya03c_xx;
            }else if ($saldoobiaya03c_xx == 0){
                $saldo03_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoobiaya04d_xx<>0){
             $saldo04_biaya_xx = $saldoobiaya04d_xx;
        }else{
            if ($saldoobiaya04c_xx > 0){
                $saldo04_biaya_xx = $saldoobiaya04c_xx*-1;
            }else if ($saldoobiaya04c_xx < 0){
                $saldo04_biaya_xx = $saldoobiaya04c_xx;
            }else if ($saldoobiaya04c_xx == 0){
                $saldo04_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldoobiaya05d_xx<>0){
             $saldo05_biaya_xx = $saldoobiaya05d_xx;
        }else{
            if ($saldoobiaya05c_xx > 0){
                $saldo05_biaya_xx = $saldoobiaya05c_xx*-1;
            }else if ($saldoobiaya05c_xx < 0){
                $saldo05_biaya_xx = $saldoobiaya05c_xx;
            }else if ($saldoobiaya05c_xx == 0){
                $saldo05_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoobiaya06d_xx<>0){
             $saldo06_biaya_xx = $saldoobiaya06d_xx;
        }else{
            if ($saldoobiaya06c_xx > 0){
                $saldo06_biaya_xx = $saldoobiaya06c_xx*-1;
            }else if ($saldoobiaya06c_xx < 0){
                $saldo06_biaya_xx = $saldoobiaya06c_xx;
            }else if ($saldoobiaya06c_xx == 0){
                $saldo06_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoobiaya07d_xx<>0){
             $saldo07_biaya_xx = $saldoobiaya07d_xx;
        }else{
            if ($saldoobiaya07c_xx > 0){
                $saldo07_biaya_xx = $saldoobiaya07c_xx*-1;
            }else if ($saldoobiaya07c_xx < 0){
                $saldo07_biaya_xx = $saldoobiaya07c_xx;
            }else if ($saldoobiaya07c_xx == 0){
                $saldo07_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoobiaya08d_xx<>0){
             $saldo08_biaya_xx = $saldoobiaya08d_xx;
        }else{
            if ($saldoobiaya08c_xx > 0){
                $saldo08_biaya_xx = $saldoobiaya08c_xx*-1;
            }else if ($saldoobiaya08c_xx < 0){
                $saldo08_biaya_xx = $saldoobiaya08c_xx;
            }else if ($saldoobiaya08c_xx == 0){
                $saldo08_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoobiaya09d_xx<>0){
             $saldo09_biaya_xx = $saldoobiaya09d_xx;
        }else{
            if ($saldoobiaya09c_xx > 0){
                $saldo09_biaya_xx = $saldoobiaya09c_xx*-1;
            }else if ($saldoobiaya09c_xx < 0){
                $saldo09_biaya_xx = $saldoobiaya09c_xx;
            }else if ($saldoobiaya09c_xx == 0){
                $saldo09_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldoobiaya10d_xx<>0){
             $saldo10_biaya_xx = $saldoobiaya10d_xx;
        }else{
            if ($saldoobiaya10c_xx > 0){
                $saldo10_biaya_xx = $saldoobiaya10c_xx*-1;
            }else if ($saldoobiaya10c_xx < 0){
                $saldo10_biaya_xx = $saldoobiaya10c_xx;
            }else if ($saldoobiaya10c_xx == 0){
                $saldo10_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoobiaya11d_xx<>0){
             $saldo11_biaya_xx = $saldoobiaya11d_xx;
        }else{
            if ($saldoobiaya11c_xx > 0){
                $saldo11_biaya_xx = $saldoobiaya11c_xx*-1;
            }else if ($saldoobiaya11c_xx < 0){
                $saldo11_biaya_xx = $saldoobiaya11c_xx;
            }else if ($saldoobiaya11c_xx == 0){
                $saldo11_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
        
        if($saldoobiaya12d_xx<>0){
             $saldo12_biaya_xx = $saldoobiaya12d_xx;
        }else{
            if ($saldoobiaya12c_xx > 0){
                $saldo12_biaya_xx = $saldoobiaya12c_xx*-1;
            }else if ($saldoobiaya12c_xx < 0){
                $saldo12_biaya_xx = $saldoobiaya12c_xx;
            }else if ($saldoobiaya12c_xx == 0){
                $saldo12_biaya_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
    
        $totalbiaya_x      = $saldo_year_biaya_xx+$saldo01_biaya_xx+$saldo02_biaya_xx+$saldo03_biaya_xx+$saldo04_biaya_xx+$saldo05_biaya_xx+$saldo06_biaya_xx+$saldo07_biaya_xx+$saldo08_biaya_xx+$saldo09_biaya_xx+$saldo10_biaya_xx+$saldo11_biaya_xx+$saldo12_biaya_xx;
        $totaltb_biaya   += $totalbiaya_x;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalbiaya_x,0));
		
		//$saldo01_biaya_xx+$saldo02_biaya_xx+$saldo03_biaya_xx+$saldo04_biaya_xx+$saldo04_biaya_xx+$saldo05_biaya_xx+$saldo06_biaya_xx+$saldo07_biaya_xx+$saldo08_biaya_xx+$saldo09_biaya_xx+$saldo10_biaya_xx+$saldo11_biaya_xx+$saldo12_biaya_xx
		//$saldo01_biaya_xx+$saldo02_biaya_xx+$saldo03_biaya_xx+$saldo04_biaya_xx+$saldo05_biaya_xx+$saldo06_biaya_xx+$saldo07_biaya_xx+$saldo08_biaya_xx+$saldo09_biaya_xx+$saldo10_biaya_xx+$saldo11_biaya_xx+$saldo12_biaya_xx
		
		//+
		//$saldo_year_biaya_xx+$saldo01_biaya_xx+$saldo02_biaya_xx+$saldo03_biaya_xx+$saldo04_biaya_xx+$saldo05_biaya_xx+$saldo06_biaya_xx+$saldo07_biaya_xx+$saldo08_biaya_xx+$saldo09_biaya_xx+$saldo10_biaya_xx+$saldo10_biaya_xx+$saldo11_biaya_xx+$saldo12_biaya_xx;
		
    ?>
</td>


</tr>
<?php 
}
}
?>
<!-- END BIAYA -->










<!-- KEWAJIBAN -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; KEWAJIBAN</td>
</tr>
<?php

$year_kewajiban_x;
$saldo01_kewajiban_x;
$saldo02_kewajiban_x;
$saldo03_kewajiban_x;
$saldo04_kewajiban_x;
$saldo05_kewajiban_x;
$saldo06_kewajiban_x;
$saldo07_kewajiban_x;
$saldo08_kewajiban_x;
$saldo09_kewajiban_x;
$saldo10_kewajiban_x;
$saldo11_kewajiban_x;
$saldo12_kewajiban_x;
$totaltb_kewajiban;
$saldo01_kewajiban_g;


$sum01_kewajiban;
$sum02_kewajiban;
$sum03_kewajiban;
$sum04_kewajiban;
$sum05_kewajiban;
$sum06_kewajiban;
$sum07_kewajiban;
$sum08_kewajiban;
$sum09_kewajiban;
$sum10_kewajiban;
$sum11_kewajiban;
$sum12_kewajiban;


foreach($data_list_liability as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
    if($b['level'] == 1 && $b['type'] == 'G'){
        $bold_liab = 'font-weight:bold';
        
        if($b['saldo01d']<>0){
            $saldo01_kewajiban_g += $b['saldo01d'];
        }else{
            $sal01 = $b['saldo01c']*-1;
            $saldo01_kewajiban_g += $sal01;
        }
        
    }else{
        $bold_liab = '';
    }
    
    
if($group_n == 'Liability'){
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum01_kewajiban = 0;
    }else{
    
        if($b['saldo01d']<>0){
            $sum01_kewajiban += $b['saldo01d'];
        }else{
            if ($b['saldo01c'] > 0){
                $sum01_kewajiban += $b['saldo01c']*-1;
            }else if ($b['saldo01c'] < 0){
                $sum01_kewajiban += $b['saldo01c'];
            }else if ($b['saldo01c'] == 0){
                $sum01_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
		
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum02_kewajiban = 0;
    }else{
        if($b['saldo02d']<>0){
            $sum02_kewajiban += $b['saldo02d'];
        }else{
            if ($b['saldo02c'] > 0){
                $sum02_kewajiban += $b['saldo02c']*-1;
            }else if ($b['saldo02c'] < 0){
                $sum02_kewajiban += $b['saldo02c'];
            }else if ($b['saldo02c'] == 0){
                $sum02_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum03_kewajiban = 0;
    }else{
        if($b['saldo03d']<>0){
            $sum03_kewajiban += $b['saldo03d'];
        }else{
            if ($b['saldo03c'] > 0){
                $sum03_kewajiban += $b['saldo03c']*-1;
            }else if ($b['saldo03c'] < 0){
                $sum03_kewajiban += $b['saldo03c'];
            }else if ($b['saldo03c'] == 0){
                $sum03_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum04_kewajiban = 0;
    }else{
        if($b['saldo04d']<>0){
            $sum04_kewajiban += $b['saldo04d'];
        }else{
            if ($b['saldo04c'] > 0){
                $sum04_kewajiban += $b['saldo04c']*-1;
            }else if ($b['saldo04c'] < 0){
                $sum04_kewajiban += $b['saldo04c'];
            }else if ($b['saldo04c'] == 0){
                $sum04_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum05_kewajiban = 0;
    }else{
        if($b['saldo05d']<>0){
            $sum05_kewajiban += $b['saldo04d'];
        }else{
            if ($b['saldo05c'] > 0){
                $sum05_kewajiban += $b['saldo05c']*-1;
            }else if ($b['saldo05c'] < 0){
                $sum05_kewajiban += $b['saldo05c'];
            }else if ($b['saldo05c'] == 0){
                $sum05_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum06_kewajiban = 0;
    }else{
        if($b['saldo06d']<>0){
            $sum06_kewajiban += $b['saldo06d'];
        }else{
            if ($b['saldo06c'] > 0){
                $sum06_kewajiban += $b['saldo06c']*-1;
            }else if ($b['saldo06c'] < 0){
                $sum06_kewajiban += $b['saldo06c'];
            }else if ($b['saldo06c'] == 0){
                $sum06_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum07_kewajiban = 0;
    }else{
        if($b['saldo07d']<>0){
            $sum07_kewajiban += $b['saldo07d'];
        }else{
            if ($b['saldo07c'] > 0){
                $sum07_kewajiban += $b['saldo07c']*-1;
            }else if ($b['saldo07c'] < 0){
                $sum07_kewajiban += $b['saldo07c'];
            }else if ($b['saldo07c'] == 0){
                $sum07_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum08_kewajiban = 0;
    }else{
        if($b['saldo08d']<>0){
            $sum08_kewajiban += $b['saldo08d'];
        }else{
            if ($b['saldo08c'] > 0){
                $sum08_kewajiban += $b['saldo08c']*-1;
            }else if ($b['saldo08c'] < 0){
                $sum08_kewajiban += $b['saldo08c'];
            }else if ($b['saldo08c'] == 0){
                $sum08_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum09_kewajiban = 0;
    }else{
        if($b['saldo09d']<>0){
            $sum09_kewajiban += $b['saldo09d'];
        }else{
            if ($b['saldo09c'] > 0){
                $sum09_kewajiban += $b['saldo09c']*-1;
            }else if ($b['saldo09c'] < 0){
                $sum09_kewajiban += $b['saldo09c'];
            }else if ($b['saldo09c'] == 0){
                $sum09_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum10_kewajiban = 0;
    }else{
        if($b['saldo10d']<>0){
            $sum10_kewajiban += $b['saldo10d'];
        }else{
            if ($b['saldo10c'] > 0){
                $sum10_kewajiban += $b['saldo10c']*-1;
            }else if ($b['saldo10c'] < 0){
                $sum10_kewajiban += $b['saldo10c'];
            }else if ($b['saldo10c'] == 0){
                $sum10_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum11_kewajiban = 0;
    }else{
        if($b['saldo11d']<>0){
            $sum11_kewajiban += $b['saldo11d'];
        }else{
            if ($b['saldo11c'] > 0){
                $sum11_kewajiban += $b['saldo11c']*-1;
            }else if ($b['saldo11c'] < 0){
                $sum11_kewajiban += $b['saldo11c'];
            }else if ($b['saldo11c'] == 0){
                $sum11_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum12_kewajiban = 0;
    }else{
        if($b['saldo12d']<>0){
            $sum12_kewajiban += $b['saldo12d'];
        }else{
            if ($b['saldo12c'] > 0){
                $sum12_kewajiban += $b['saldo12c']*-1;
            }else if ($b['saldo12c'] < 0){
                $sum12_kewajiban += $b['saldo12c'];
            }else if ($b['saldo12c'] == 0){
                $sum12_kewajiban += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
    
    
?>
<tr>
<td align="center" width="10%" style="<?php echo $bold_liab;?>">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;<?php echo $bold_liab;?>"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
        if($b['yeard']<>0){
            $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            $saldo_year_kewajiban_x += $angka;
            echo $angka;
        }else{
            
            if ($b['yearc'] > 0){
                $yearc_c    = $b['yearc']*-1;
                $saldo_year_kewajiban_x += $b['yearc']*-1;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($yearc_c,0));
            }else if ($b['yearc'] < 0){
                $saldo_year_kewajiban_x += $b['yearc'];
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yearc'],0));
            }else if ($b['yearc'] == 0){
                $saldo_year_kewajiban_x += 0;
                echo 0;
            } else {
                //disini numeric value
            }
            
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldookewajiban01d = $b['saldo01d'];
    $saldookewajiban01c = $b['saldo01c'];
    
    if($saldookewajiban01d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban01d,0));
        $saldo01_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban01c > 0){
            $saldo01_kewajiban    = $saldookewajiban01c*-1;
            $saldo01_kewajiban_x += $saldookewajiban01c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo01_kewajiban,0));
        }else if ($saldookewajiban01c < 0){
            $saldo01_kewajiban_x += $saldookewajiban01c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban01c,0));
        }else if ($saldookewajiban01c == 0){
            $saldo01_kewajiban_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldookewajiban02d = $b['saldo02d'];
    $saldookewajiban02c = $b['saldo02c'];
    
    if($saldookewajiban02d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban02d,0));
        $saldo02_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban02c > 0){
            $saldo02_kewajiban    = $saldookewajiban02c*-1;
            $saldo02_kewajiban_x += $saldookewajiban02c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo02_kewajiban,0));
        }else if ($saldookewajiban02c < 0){
            $saldo02_kewajiban_x += $saldookewajiban02c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban02c,0));
        }else if ($saldookewajiban02c == 0){
            $saldo02_kewajiban_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldookewajiban03d = $b['saldo03d'];
    $saldookewajiban03c = $b['saldo03c'];
    
    if($saldookewajiban03d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban03d,0));
        $saldo03_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban03c > 0){
            $saldo03_kewajiban    = $saldookewajiban03c*-1;
            $saldo03_kewajiban_x += $saldookewajiban03c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo03_kewajiban,0));
        }else if ($saldookewajiban03c < 0){
            $saldo03_kewajiban_x += $saldookewajiban03c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban03c,0));
        }else if ($saldookewajiban03c == 0){
            $saldo03_kewajiban_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldookewajiban04d = $b['saldo04d'];
    $saldookewajiban04c = $b['saldo04c'];
    
    if($saldookewajiban04d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban04d,0));
        $saldo04_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban04c > 0){
            $saldo04_kewajiban = $saldookewajiban04c*-1;
            $saldo04_kewajiban_x += $saldookewajiban04c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo04_kewajiban,0));
        }else if ($saldookewajiban04c < 0){
            $saldo04_kewajiban_x += $saldookewajiban04c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban04c,0));
        }else if ($saldookewajiban04c == 0){
            $saldo04_kewajiban_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldookewajiban05d = $b['saldo05d'];
    $saldookewajiban05c = $b['saldo05c'];
    
    if($saldookewajiban05d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban05d,0));
        $saldo05_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban05c > 0){
            $saldo05_kewajiban    = $saldookewajiban05c*-1;
            $saldo05_kewajiban_x += $saldookewajiban05c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo05_kewajiban,0));
        }else if ($saldookewajiban05c < 0){
            $saldo05_kewajiban_x += $saldookewajiban05c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban05c,0));
        }else if ($saldookewajiban05c == 0){
            $saldo05_kewajiban_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldookewajiban06d = $b['saldo06d'];
    $saldookewajiban06c = $b['saldo06c'];
    
    if($saldookewajiban06d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban06d,0));
        $saldo06_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban06c > 0){
            $saldo06_kewajiban    = $saldookewajiban06c*-1;
            $saldo06_kewajiban_x += $saldookewajiban06c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo06_kewajiban,0));
        }else if ($saldookewajiban06c < 0){
            $saldo06_kewajiban_x += $saldookewajiban06c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban06c,0));
        }else if ($saldookewajiban06c == 0){
            $saldo06_kewajiban_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldookewajiban07d = $b['saldo07d'];
    $saldookewajiban07c = $b['saldo07c'];
    
    if($saldookewajiban07d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban07d,0));
        $saldo07_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban07c > 0){
            $saldo07_kewajiban    = $saldookewajiban07c*-1;
            $saldo07_kewajiban_x += $saldookewajiban07c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo07_kewajiban,0));
        }else if ($saldookewajiban07c < 0){
            $saldo07_kewajiban_x += $saldookewajiban07c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban07c,0));
        }else if ($saldookewajiban07c == 0){
            $saldo07_kewajiban_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldookewajiban08d = $b['saldo08d'];
    $saldookewajiban08c = $b['saldo08c'];
    
    if($saldookewajiban08d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban08d,0));
        $saldo08_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban08c > 0){
            $saldo08_kewajiban    = $saldookewajiban08c*-1;
            $saldo08_kewajiban_x += $saldookewajiban08c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo08_kewajiban,0));
        }else if ($saldookewajiban08c < 0){
            $saldo08_kewajiban_x += $saldookewajiban08c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban08c,0));
        }else if ($saldookewajiban08c == 0){
            $saldo08_kewajiban_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldookewajiban09d = $b['saldo09d'];
    $saldookewajiban09c = $b['saldo09c'];
    
    if($saldookewajiban09d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban09d,0));
        $saldo09_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban09c > 0){
            $saldo09_kewajiban    = $saldookewajiban09c*-1;
            $saldo09_kewajiban_x += $saldookewajiban09c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo09_kewajiban,0));
        }else if ($saldookewajiban09c < 0){
            $saldo09_kewajiban_x += $saldookewajiban09c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban09c,0));
        }else if ($saldookewajiban09c == 0){
            $saldo09_kewajiban_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldookewajiban10d = $b['saldo10d'];
    $saldookewajiban10c = $b['saldo10c'];
    
    if($saldookewajiban10d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban10d,0));
        $saldo10_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban10c > 0){
            $saldo10_kewajiban    = $saldookewajiban10c*-1;
            $saldo10_kewajiban_x += $saldookewajiban10c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo10_kewajiban,0));
        }else if ($saldookewajiban10c < 0){
            $saldo10_kewajiban_x += $saldookewajiban10c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban10c,0));
        }else if ($saldookewajiban10c == 0){
            $saldo10_kewajiban_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldookewajiban11d = $b['saldo11d'];
    $saldookewajiban11c = $b['saldo11c'];
    
    if($saldookewajiban11d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban11d,0));
        $saldo11_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban11c > 0){
            $saldo11_kewajiban    = $saldookewajiban11c*-1;
            $saldo11_kewajiban_x += $saldookewajiban11c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo11_kewajiban,0));
        }else if ($saldookewajiban11c < 0){
            $saldo11_kewajiban_x += $saldookewajiban11c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban11c,0));
        }else if ($saldookewajiban11c == 0){
            $saldo11_kewajiban_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldookewajiban12d = $b['saldo12d'];
    $saldookewajiban12c = $b['saldo12c'];
    
    if($saldookewajiban12d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban12d,0));
        $saldo12_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldookewajiban12c > 0){
            $saldo12_kewajiban    = $saldookewajiban12c*-1;
            $saldo12_kewajiban_x += $saldookewajiban12c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo12_kewajiban,0));
        }else if ($saldookewajiban12c < 0){
            $saldo12_kewajiban_x += $saldookewajiban12c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban12c,0));
        }else if ($saldookewajiban12c == 0){
            $saldo12_kewajiban_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldookewajiban_yeard_xx = $b['yeard'];
    $saldookewajiban_yearc_xx = $b['yearc'];
	
    $saldookewajiban01d_xx = $b['saldo01d'];
    $saldookewajiban01c_xx = $b['saldo01c'];
    //
    $saldookewajiban02d_xx = $b['saldo02d'];
    $saldookewajiban02c_xx = $b['saldo02c'];
    //
    $saldookewajiban03d_xx = $b['saldo03d'];
    $saldookewajiban03c_xx = $b['saldo03c'];
    //
    $saldookewajiban04d_xx = $b['saldo04d'];
    $saldookewajiban04c_xx = $b['saldo04c'];
    //
    $saldookewajiban05d_xx = $b['saldo05d'];
    $saldookewajiban05c_xx = $b['saldo05c'];
    //
    $saldookewajiban06d_xx = $b['saldo06d'];
    $saldookewajiban06c_xx = $b['saldo06c'];
    //
    $saldookewajiban07d_xx = $b['saldo07d'];
    $saldookewajiban07c_xx = $b['saldo07c'];
    //
    $saldookewajiban08d_xx = $b['saldo08d'];
    $saldookewajiban08c_xx = $b['saldo08c'];
    //
    $saldookewajiban09d_xx = $b['saldo09d'];
    $saldookewajiban09c_xx = $b['saldo09c'];
    //
    $saldookewajiban10d_xx = $b['saldo10d'];
    $saldookewajiban10c_xx = $b['saldo10c'];
    //
    $saldookewajiban11d_xx = $b['saldo11d'];
    $saldookewajiban11c_xx = $b['saldo11c'];
    //
    $saldookewajiban12d_xx = $b['saldo12d'];
    $saldookewajiban12c_xx = $b['saldo12c'];
    
    
    //+$saldo09_aset+$saldo08_aset+$saldo07_aset+$saldo06_aset+$saldo05_aset+$saldo04_aset+$saldo03_aset+$saldo02_aset+$saldo01_aset
        
		if($saldookewajiban_yeard_xx<>0){
            $saldo_year_kewajiban_xx = $saldookewajiban_yeard_xx;
        }else{
            if ($saldookewajiban_yearc_xx > 0){
                $saldo_year_kewajiban_xx = $saldookewajiban_yearc_xx*-1;
            }else if ($saldookewajiban_yearc_xx < 0){
                $saldo_year_kewajiban_xx = $saldookewajiban_yearc_xx;
            }else if ($saldookewajiban_yearc_xx == 0){
                $saldo_year_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
        if($saldookewajiban01d_xx<>0){
            $saldo01_kewajiban_xx = $saldookewajiban01d_xx;
        }else{
            if ($saldookewajiban01c_xx > 0){
                $saldo01_kewajiban_xx = $saldookewajiban01c_xx*-1;
            }else if ($saldookewajiban01c_xx < 0){
                $saldo01_kewajiban_xx = $saldookewajiban01c_xx;
            }else if ($saldookewajiban01c_xx == 0){
                $saldo01_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldookewajiban02d_xx<>0){
            $saldo02_kewajiban_xx = $saldookewajiban02d_xx;
        }else{
            if ($saldookewajiban02c_xx > 0){
                $saldo02_kewajiban_xx = $saldookewajiban02c_xx*-1;
            }else if ($saldookewajiban02c_xx < 0){
                $saldo02_kewajiban_xx = $saldookewajiban02c_xx;
            }else if ($saldookewajiban02c_xx == 0){
                $saldo02_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldookewajiban03d_xx<>0){
             $saldo03_kewajiban_xx = $saldookewajiban03d_xx;
        }else{
            if ($saldookewajiban03c_xx > 0){
                $saldo03_kewajiban_xx = $saldookewajiban03c_xx*-1;
            }else if ($saldookewajiban03c_xx < 0){
                $saldo03_kewajiban_xx = $saldookewajiban03c_xx;
            }else if ($saldookewajiban03c_xx == 0){
                $saldo03_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldookewajiban04d_xx<>0){
             $saldo04_kewajiban_xx = $saldookewajiban04d_xx;
        }else{
            if ($saldookewajiban04c_xx > 0){
                $saldo04_kewajiban_xx = $saldookewajiban04c_xx*-1;
            }else if ($saldookewajiban04c_xx < 0){
                $saldo04_kewajiban_xx = $saldookewajiban04c_xx;
            }else if ($saldookewajiban04c_xx == 0){
                $saldo04_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldookewajiban05d_xx<>0){
             $saldo05_kewajiban_xx = $saldookewajiban05d_xx;
        }else{
            if ($saldookewajiban05c_xx > 0){
                $saldo05_kewajiban_xx = $saldookewajiban05c_xx*-1;
            }else if ($saldookewajiban05c_xx < 0){
                $saldo05_kewajiban_xx = $saldookewajiban05c_xx;
            }else if ($saldookewajiban05c_xx == 0){
                $saldo05_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldookewajiban06d_xx<>0){
             $saldo06_kewajiban_xx = $saldookewajiban06d_xx;
        }else{
            if ($saldookewajiban06c_xx > 0){
                $saldo06_kewajiban_xx = $saldookewajiban06c_xx*-1;
            }else if ($saldookewajiban06c_xx < 0){
                $saldo06_kewajiban_xx = $saldookewajiban06c_xx;
            }else if ($saldookewajiban06c_xx == 0){
                $saldo06_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldookewajiban07d_xx<>0){
             $saldo07_kewajiban_xx = $saldookewajiban07d_xx;
        }else{
            if ($saldookewajiban07c_xx > 0){
                $saldo07_kewajiban_xx = $saldookewajiban07c_xx*-1;
            }else if ($saldookewajiban07c_xx < 0){
                $saldo07_kewajiban_xx = $saldookewajiban07c_xx;
            }else if ($saldookewajiban07c_xx == 0){
                $saldo07_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldookewajiban08d_xx<>0){
             $saldo08_kewajiban_xx = $saldookewajiban08d_xx;
        }else{
            if ($saldookewajiban08c_xx > 0){
                $saldo08_kewajiban_xx = $saldookewajiban08c_xx*-1;
            }else if ($saldookewajiban08c_xx < 0){
                $saldo08_kewajiban_xx = $saldookewajiban08c_xx;
            }else if ($saldookewajiban08c_xx == 0){
                $saldo08_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldookewajiban09d_xx<>0){
             $saldo09_kewajiban_xx = $saldookewajiban09d_xx;
        }else{
            if ($saldookewajiban09c_xx > 0){
                $saldo09_kewajiban_xx = $saldookewajiban09c_xx*-1;
            }else if ($saldookewajiban09c_xx < 0){
                $saldo09_kewajiban_xx = $saldookewajiban09c_xx;
            }else if ($saldookewajiban09c_xx == 0){
                $saldo09_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldookewajiban10d_xx<>0){
             $saldo10_kewajiban_xx = $saldookewajiban10d_xx;
        }else{
            if ($saldookewajiban10c_xx > 0){
                $saldo10_kewajiban_xx = $saldookewajiban10c_xx*-1;
            }else if ($saldookewajiban10c_xx < 0){
                $saldo10_kewajiban_xx = $saldookewajiban10c_xx;
            }else if ($saldookewajiban10c_xx == 0){
                $saldo10_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldookewajiban11d_xx<>0){
             $saldo11_kewajiban_xx = $saldookewajiban11d_xx;
        }else{
            if ($saldookewajiban11c_xx > 0){
                $saldo11_kewajiban_xx = $saldookewajiban11c_xx*-1;
            }else if ($saldookewajiban11c_xx < 0){
                $saldo11_kewajiban_xx = $saldookewajiban11c_xx;
            }else if ($saldookewajiban11c_xx == 0){
                $saldo11_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
        
        if($saldookewajiban12d_xx<>0){
             $saldo12_kewajiban_xx = $saldookewajiban12d_xx;
        }else{
            if ($saldookewajiban12c_xx > 0){
                $saldo12_kewajiban_xx = $saldookewajiban12c_xx*-1;
            }else if ($saldookewajiban12c_xx < 0){
                $saldo12_kewajiban_xx = $saldookewajiban12c_xx;
            }else if ($saldookewajiban12c_xx == 0){
                $saldo12_kewajiban_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
        $totalkewajiban_x      = $saldo_year_kewajiban_xx+$saldo01_kewajiban_xx+$saldo02_kewajiban_xx+$saldo03_kewajiban_xx+$saldo04_kewajiban_xx+$saldo05_kewajiban_xx+$saldo06_kewajiban_xx+$saldo07_kewajiban_xx+$saldo08_kewajiban_xx+$saldo09_kewajiban_xx+$saldo10_kewajiban_xx+$saldo11_kewajiban_xx+$saldo12_kewajiban_xx;
        $totaltb_kewajiban    += $totalkewajiban_x;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalkewajiban_x,0));
		
		//$saldo_year_kewajiban_xx+$saldo01_kewajiban_xx+$saldo02_kewajiban_xx+$saldo03_kewajiban_xx+$saldo04_kewajiban_xx+$saldo05_kewajiban_xx+$saldo06_kewajiban_xx+$saldo07_kewajiban_xx+$saldo08_kewajiban_xx+$saldo09_kewajiban_xx+$saldo10_kewajiban_xx+$saldo11_kewajiban_xx+$saldo12_kewajiban_xx
		
    ?>
</td>
</tr>
<?php
}
}
?>  
<!-- KEWAJIBAN -->


<!-- PENDAPATAN -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; PENDAPATAN</td>
</tr>
<?php

$saldo_year_pendapatan_x;
$saldo01_pendapatan_x;
$saldo02_pendapatan_x;
$saldo03_pendapatan_x;
$saldo04_pendapatan_x;
$saldo05_pendapatan_x;
$saldo06_pendapatan_x;
$saldo07_pendapatan_x;
$saldo08_pendapatan_x;
$saldo09_pendapatan_x;
$saldo10_pendapatan_x;
$saldo11_pendapatan_x;
$saldo12_pendapatan_x;
$totaltb_pendapatan_x;
$saldo01_pendapatan_g;


$sum01_pendapatan;
$sum02_pendapatan;
$sum03_pendapatan;
$sum04_pendapatan;
$sum05_pendapatan;
$sum06_pendapatan;
$sum07_pendapatan;
$sum08_pendapatan;
$sum09_pendapatan;
$sum10_pendapatan;
$sum11_pendapatan;
$sum12_pendapatan;



foreach($data_list_revenue as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
if($group_n == 'Revenue'){
    
    if($b['level'] == 1 && $b['type'] == 'G'){
        $bold_liab = 'font-weight:bold';
        
        if($b['saldo01d']<>0){
            $saldo01_pendapatan_g += $b['saldo01d'];
        }else{
            $sal01 = $b['saldo01c']*-1;
            $saldo01_pendapatan_g += $sal01;
        }
        
    }else{
        $bold_liab = '';
    }
	
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum01_pendapatan = 0;
    }else{
    
        if($b['saldo01d']<>0){
            $sum01_pendapatan += $b['saldo01d'];
        }else{
            if ($b['saldo01c'] > 0){
                $sum01_pendapatan += $b['saldo01c']*-1;
            }else if ($b['saldo01c'] < 0){
                $sum01_pendapatan += $b['saldo01c'];
            }else if ($b['saldo01c'] == 0){
                $sum01_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
		
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum02_pendapatan = 0;
    }else{
        if($b['saldo02d']<>0){
            $sum02_pendapatan += $b['saldo02d'];
        }else{
            if ($b['saldo02c'] > 0){
                $sum02_pendapatan += $b['saldo02c']*-1;
            }else if ($b['saldo02c'] < 0){
                $sum02_pendapatan += $b['saldo02c'];
            }else if ($b['saldo02c'] == 0){
                $sum02_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum03_pendapatan = 0;
    }else{
        if($b['saldo03d']<>0){
            $sum03_pendapatan += $b['saldo03d'];
        }else{
            if ($b['saldo03c'] > 0){
                $sum03_pendapatan += $b['saldo03c']*-1;
            }else if ($b['saldo03c'] < 0){
                $sum03_pendapatan += $b['saldo03c'];
            }else if ($b['saldo03c'] == 0){
                $sum03_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum04_pendapatan = 0;
    }else{
        if($b['saldo04d']<>0){
            $sum04_pendapatan += $b['saldo04d'];
        }else{
            if ($b['saldo04c'] > 0){
                $sum04_pendapatan += $b['saldo04c']*-1;
            }else if ($b['saldo04c'] < 0){
                $sum04_pendapatan += $b['saldo04c'];
            }else if ($b['saldo04c'] == 0){
                $sum04_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum05_pendapatan = 0;
    }else{
        if($b['saldo05d']<>0){
            $sum05_pendapatan += $b['saldo04d'];
        }else{
            if ($b['saldo05c'] > 0){
                $sum05_pendapatan += $b['saldo05c']*-1;
            }else if ($b['saldo05c'] < 0){
                $sum05_pendapatan += $b['saldo05c'];
            }else if ($b['saldo05c'] == 0){
                $sum05_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum06_pendapatan = 0;
    }else{
        if($b['saldo06d']<>0){
            $sum06_pendapatan += $b['saldo06d'];
        }else{
            if ($b['saldo06c'] > 0){
                $sum06_pendapatan += $b['saldo06c']*-1;
            }else if ($b['saldo06c'] < 0){
                $sum06_pendapatan += $b['saldo06c'];
            }else if ($b['saldo06c'] == 0){
                $sum06_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum07_pendapatan = 0;
    }else{
        if($b['saldo07d']<>0){
            $sum07_pendapatan += $b['saldo07d'];
        }else{
            if ($b['saldo07c'] > 0){
                $sum07_pendapatan += $b['saldo07c']*-1;
            }else if ($b['saldo07c'] < 0){
                $sum07_pendapatan += $b['saldo07c'];
            }else if ($b['saldo07c'] == 0){
                $sum07_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum08_pendapatan = 0;
    }else{
        if($b['saldo08d']<>0){
            $sum08_pendapatan += $b['saldo08d'];
        }else{
            if ($b['saldo08c'] > 0){
                $sum08_pendapatan += $b['saldo08c']*-1;
            }else if ($b['saldo08c'] < 0){
                $sum08_pendapatan += $b['saldo08c'];
            }else if ($b['saldo08c'] == 0){
                $sum08_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum09_pendapatan = 0;
    }else{
        if($b['saldo09d']<>0){
            $sum09_pendapatan += $b['saldo09d'];
        }else{
            if ($b['saldo09c'] > 0){
                $sum09_pendapatan += $b['saldo09c']*-1;
            }else if ($b['saldo09c'] < 0){
                $sum09_pendapatan += $b['saldo09c'];
            }else if ($b['saldo09c'] == 0){
                $sum09_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum10_pendapatan = 0;
    }else{
        if($b['saldo10d']<>0){
            $sum10_pendapatan += $b['saldo10d'];
        }else{
            if ($b['saldo10c'] > 0){
                $sum10_pendapatan += $b['saldo10c']*-1;
            }else if ($b['saldo10c'] < 0){
                $sum10_pendapatan += $b['saldo10c'];
            }else if ($b['saldo10c'] == 0){
                $sum10_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum11_pendapatan = 0;
    }else{
        if($b['saldo11d']<>0){
            $sum11_pendapatan += $b['saldo11d'];
        }else{
            if ($b['saldo11c'] > 0){
                $sum11_pendapatan += $b['saldo11c']*-1;
            }else if ($b['saldo11c'] < 0){
                $sum11_pendapatan += $b['saldo11c'];
            }else if ($b['saldo11c'] == 0){
                $sum11_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum12_pendapatan = 0;
    }else{
        if($b['saldo12d']<>0){
            $sum12_pendapatan += $b['saldo12d'];
        }else{
            if ($b['saldo12c'] > 0){
                $sum12_pendapatan += $b['saldo12c']*-1;
            }else if ($b['saldo12c'] < 0){
                $sum12_pendapatan += $b['saldo12c'];
            }else if ($b['saldo12c'] == 0){
                $sum12_pendapatan += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	
    
    
?>
<tr>
    <td align="center" width="10%" style="<?php echo $bold_liab;?>">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;<?php echo $bold_liab;?>"><?php echo $nama_n;?></div></td>

<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
        if($b['yeard']<>0){
            $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            $saldo_year_pendapatan_x += $angka;
            echo $angka;
        }else{
            
            if ($b['yearc'] > 0){
                $yearc_c    = $b['yearc']*-1;
                $saldo_year_pendapatan_x += $b['yearc']*-1;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($yearc_c,0));
            }else if ($b['yearc'] < 0){
                $saldo_year_pendapatan_x += $b['yearc'];
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yearc'],0));
            }else if ($b['yearc'] == 0){
                $saldo_year_pendapatan_x += 0;
                echo 0;
            } else {
                //disini numeric value
            }
            
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldoopendapatan01d = $b['saldo01d'];
    $saldoopendapatan01c = $b['saldo01c'];
    
    if($saldoopendapatan01d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan01d,0));
        $saldo01_pendapatan_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan01c > 0){
            $saldo01_pendapatan    = $saldoopendapatan01c*-1;
            $saldo01_pendapatan_x += $saldoopendapatan01c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo01_pendapatan,0));
        }else if ($saldoopendapatan01c < 0){
            $saldo01_pendapatan_x += $saldoopendapatan01c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan01c,0));
        }else if ($saldoopendapatan01c == 0){
            $saldo01_pendapatan_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatan02d = $b['saldo02d'];
    $saldoopendapatan02c = $b['saldo02c'];
    
    if($saldoopendapatan02d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan02d,0));
        $saldo02_pendapatan_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan02c > 0){
            $saldo02_pendapatan    = $saldoopendapatan02c*-1;
            $saldo02_pendapatan_x += $saldoopendapatan02c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo02_pendapatan,0));
        }else if ($saldoopendapatan02c < 0){
            $saldo02_pendapatan_x += $saldoopendapatan02c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan02c,0));
        }else if ($saldoopendapatan02c == 0){
            $saldo02_pendapatan_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatan03d = $b['saldo03d'];
    $saldoopendapatan03c = $b['saldo03c'];
    
    if($saldoopendapatan03d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan03d,0));
        $saldo03_pendapatan_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan03c > 0){
            $saldo03_pendapatan    = $saldoopendapatan03c*-1;
            $saldo03_pendapatan_x += $saldoopendapatan03c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo03_pendapatan,0));
        }else if ($saldoopendapatan03c < 0){
            $saldo03_pendapatan_x += $saldoopendapatan03c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan03c,0));
        }else if ($saldoopendapatan03c == 0){
            $saldo03_pendapatan_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatan04d = $b['saldo04d'];
    $saldoopendapatan04c = $b['saldo04c'];
    
    if($saldoopendapatan04d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan04d,0));
        $saldo04_pendapatan_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan04c > 0){
            $saldo04_pendapatan = $saldoopendapatan04c*-1;
            $saldo04_pendapatan_x += $saldoopendapatan04c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo04_pendapatan,0));
        }else if ($saldoopendapatan04c < 0){
            $saldo04_pendapatan_x += $saldoopendapatan04c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan04c,0));
        }else if ($saldookewajiban04c == 0){
            $saldo04_pendapatan_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatan05d = $b['saldo05d'];
    $saldoopendapatan05c = $b['saldo05c'];
    
    if($saldoopendapatan05d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan05d,0));
        $saldo05_pendapatan_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan05c > 0){
            $saldo05_pendapatan   = $saldoopendapatan05c*-1;
            $saldo05_pendapatan_x += $saldoopendapatan05c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo05_pendapatan,0));
        }else if ($saldoopendapatan05c < 0){
            $saldo05_pendapatan_x += $saldoopendapatan05c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan05c,0));
        }else if ($saldoopendapatan05c == 0){
            $saldo05_pendapatan_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatan06d = $b['saldo06d'];
    $saldoopendapatan06c = $b['saldo06c'];
    
    if($saldoopendapatan06d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan06d,0));
        $saldo06_pendapatan_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan06c > 0){
            $saldo06_pendapatan    = $saldoopendapatan06c*-1;
            $saldo06_pendapatan_x += $saldoopendapatan06c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo06_pendapatan,0));
        }else if ($saldoopendapatan06c < 0){
            $saldo06_pendapatan_x += $saldoopendapatan06c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan06c,0));
        }else if ($saldoopendapatan06c == 0){
            $saldo06_pendapatan_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatan07d = $b['saldo07d'];
    $saldoopendapatan07c = $b['saldo07c'];
    
    if($saldoopendapatan07d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan07d,0));
        $saldo07_pendapatan_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan07c > 0){
            $saldo07_pendapatan    = $saldoopendapatan07c*-1;
            $saldo07_pendapatan_x += $saldoopendapatan07c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo07_pendapatan,0));
        }else if ($saldoopendapatan07c < 0){
            $saldo07_pendapatan_x += $saldoopendapatan07c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan07c,0));
        }else if ($saldoopendapatan07c == 0){
            $saldo07_pendapatan_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatan08d = $b['saldo08d'];
    $saldoopendapatan08c = $b['saldo08c'];
    
    if($saldoopendapatan08d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan08d,0));
        $saldo08_pendapatan_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan08c > 0){
            $saldo08_pendapatan    = $saldoopendapatan08c*-1;
            $saldo08_pendapatan_x += $saldoopendapatan08c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo08_pendapatan,0));
        }else if ($saldoopendapatan08c < 0){
            $saldo08_pendapatan_x += $saldoopendapatan08c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan08c,0));
        }else if ($saldoopendapatan08c == 0){
            $saldo08_pendapatan_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatan09d = $b['saldo09d'];
    $saldoopendapatan09c = $b['saldo09c'];
    
    if($saldoopendapatan09d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan09d,0));
        $saldo09_pendapatan_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan09c > 0){
            $saldo09_pendapatan    = $saldoopendapatan09c*-1;
            $saldo09_pendapatan_x += $saldoopendapatan09c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo09_pendapatan,0));
        }else if ($saldoopendapatan09c < 0){
            $saldo09_pendapatan_x += $saldoopendapatan09c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan09c,0));
        }else if ($saldoopendapatan09c == 0){
            $saldo09_pendapatan_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatan10d = $b['saldo10d'];
    $saldoopendapatan10c = $b['saldo10c'];
    
    if($saldoopendapatan10d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldookewajiban10d,0));
        $saldo10_kewajiban_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan10c > 0){
            $saldo10_pendapatan    = $saldoopendapatan10c*-1;
            $saldo10_pendapatan_x += $saldoopendapatan10c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo10_pendapatan,0));
        }else if ($saldoopendapatan10c < 0){
            $saldo10_pendapatan_x += $saldoopendapatan10c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan10c,0));
        }else if ($saldoopendapatan10c == 0){
            $saldo10_pendapatan_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatan11d = $b['saldo11d'];
    $saldoopendapatan11c = $b['saldo11c'];
    
    if($saldoopendapatan11d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan11d,0));
        $saldo11_pendapatan_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan11c > 0){
            $saldo11_pendapatan    = $saldoopendapatan11c*-1;
            $saldo11_pendapatan_x += $saldoopendapatan11c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo11_pendapatan,0));
        }else if ($saldoopendapatan11c < 0){
            $saldo11_pendapatan_x += $saldoopendapatan11c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan11c,0));
        }else if ($saldoopendapatan11c == 0){
            $saldo11_pendapatan_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatan12d = $b['saldo12d'];
    $saldoopendapatan12c = $b['saldo12c'];
    
    if($saldoopendapatan12d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan12d,0));
        $saldo12_pendapatan_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatan12c > 0){
            $saldo12_pendapatan    = $saldoopendapatan12c*-1;
            $saldo12_pendapatan_x += $saldoopendapatan12c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo12_pendapatan,0));
        }else if ($saldoopendapatan12c < 0){
            $saldo12_pendapatan_x += $saldoopendapatan12c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatan12c,0));
        }else if ($saldoopendapatan12c == 0){
            $saldo12_pendapatan_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldoopendapatan_yeard_xx = $b['yeard'];
    $saldoopendapatan_yearc_xx = $b['yearc'];
	
    $saldoopendapatan01d_xx = $b['saldo01d'];
    $saldoopendapatan01c_xx = $b['saldo01c'];
    //
    $saldoopendapatan02d_xx = $b['saldo02d'];
    $saldoopendapatan02c_xx = $b['saldo02c'];
    //
    $saldoopendapatan03d_xx = $b['saldo03d'];
    $saldoopendapatan03c_xx = $b['saldo03c'];
    //
    $saldoopendapatan04d_xx = $b['saldo04d'];
    $saldoopendapatan04c_xx = $b['saldo04c'];
    //
    $saldoopendapatan05d_xx = $b['saldo05d'];
    $saldoopendapatan05c_xx = $b['saldo05c'];
    //
    $saldoopendapatan06d_xx = $b['saldo06d'];
    $saldoopendapatan06c_xx = $b['saldo06c'];
    //
    $saldoopendapatan07d_xx = $b['saldo07d'];
    $saldoopendapatan07c_xx = $b['saldo07c'];
    //
    $saldoopendapatan08d_xx = $b['saldo08d'];
    $saldoopendapatan08c_xx = $b['saldo08c'];
    //
    $saldoopendapatan09d_xx = $b['saldo09d'];
    $saldoopendapatan09c_xx = $b['saldo09c'];
    //
    $saldoopendapatan10d_xx = $b['saldo10d'];
    $saldoopendapatan10c_xx = $b['saldo10c'];
    //
    $saldoopendapatan11d_xx = $b['saldo11d'];
    $saldoopendapatan11c_xx = $b['saldo11c'];
    //
    $saldoopendapatan12d_xx = $b['saldo12d'];
    $saldoopendapatan12c_xx = $b['saldo12c'];
    
    
    //+$saldo09_aset+$saldo08_aset+$saldo07_aset+$saldo06_aset+$saldo05_aset+$saldo04_aset+$saldo03_aset+$saldo02_aset+$saldo01_aset
        
		if($saldoopendapatan_yeard_xx<>0){
            $saldo_year_pendapatan_xx = $saldoopendapatan_yeard_xx;
        }else{
            if ($saldoopendapatan_yearc_xx > 0){
                $saldo_year_pendapatan_xx = $saldoopendapatan_yearc_xx*-1;
            }else if ($saldoopendapatan_yearc_xx < 0){
                $saldo_year_pendapatan_xx = $saldoopendapatan_yearc_xx;
            }else if ($saldoopendapatan_yearc_xx == 0){
                $saldo_year_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
        if($saldoopendapatan01d_xx<>0){
            $saldo01_pendapatan_xx = $saldoopendapatan01d_xx;
        }else{
            if ($saldoopendapatan01c_xx > 0){
                $saldo01_pendapatan_xx = $saldoopendapatan01c_xx*-1;
            }else if ($saldoopendapatan01c_xx < 0){
                $saldo01_pendapatan_xx = $saldoopendapatan01c_xx;
            }else if ($saldoopendapatan01c_xx == 0){
                $saldo01_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoopendapatan02d_xx<>0){
            $saldo02_pendapatan_xx = $saldoopendapatan02d_xx;
        }else{
            if ($saldoopendapatan02c_xx > 0){
                $saldo02_pendapatan_xx = $saldoopendapatan02c_xx*-1;
            }else if ($saldoopendapatan02c_xx < 0){
                $saldo02_pendapatan_xx = $saldoopendapatan02c_xx;
            }else if ($saldoopendapatan02c_xx == 0){
                $saldo02_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoopendapatan03d_xx<>0){
             $saldo03_pendapatan_xx = $saldoopendapatan03d_xx;
        }else{
            if ($saldoopendapatan03c_xx > 0){
                $saldo03_pendapatan_xx = $saldoopendapatan03c_xx*-1;
            }else if ($saldoopendapatan03c_xx < 0){
                $saldo03_pendapatan_xx = $saldoopendapatan03c_xx;
            }else if ($saldoopendapatan03c_xx == 0){
                $saldo03_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoopendapatan04d_xx<>0){
             $saldo04_pendapatan_xx = $saldoopendapatan04d_xx;
        }else{
            if ($saldoopendapatan04c_xx > 0){
                $saldo04_pendapatan_xx = $saldoopendapatan04c_xx*-1;
            }else if ($saldoopendapatan04c_xx < 0){
                $saldo04_pendapatan_xx = $saldoopendapatan04c_xx;
            }else if ($saldoopendapatan04c_xx == 0){
                $saldo04_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldoopendapatan05d_xx<>0){
             $saldo05_pendapatan_xx = $saldoopendapatan05d_xx;
        }else{
            if ($saldoopendapatan05c_xx > 0){
                $saldo05_pendapatan_xx = $saldoopendapatan05c_xx*-1;
            }else if ($saldoopendapatan05c_xx < 0){
                $saldo05_pendapatan_xx = $saldoopendapatan05c_xx;
            }else if ($saldoopendapatan05c_xx == 0){
                $saldo05_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoopendapatan06d_xx<>0){
             $saldo06_pendapatan_xx = $saldoopendapatan06d_xx;
        }else{
            if ($saldoopendapatan06c_xx > 0){
                $saldo06_pendapatan_xx = $saldoopendapatan06c_xx*-1;
            }else if ($saldoopendapatan06c_xx < 0){
                $saldo06_pendapatan_xx = $saldoopendapatan06c_xx;
            }else if ($saldoopendapatan06c_xx == 0){
                $saldo06_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoopendapatan07d_xx<>0){
             $saldo07_pendapatan_xx = $saldoopendapatan07d_xx;
        }else{
            if ($saldoopendapatan07c_xx > 0){
                $saldo07_pendapatan_xx = $saldoopendapatan07c_xx*-1;
            }else if ($saldoopendapatan07c_xx < 0){
                $saldo07_pendapatan_xx = $saldoopendapatan07c_xx;
            }else if ($saldoopendapatan07c_xx == 0){
                $saldo07_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoopendapatan08d_xx<>0){
             $saldo08_pendapatan_xx = $saldoopendapatan08d_xx;
        }else{
            if ($saldoopendapatan08c_xx > 0){
                $saldo08_pendapatan_xx = $saldoopendapatan08c_xx*-1;
            }else if ($saldoopendapatan08c_xx < 0){
                $saldo08_pendapatan_xx = $saldoopendapatan08c_xx;
            }else if ($saldoopendapatan08c_xx == 0){
                $saldo08_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoopendapatan09d_xx<>0){
             $saldo09_pendapatan_xx = $saldoopendapatan09d_xx;
        }else{
            if ($saldoopendapatan09c_xx > 0){
                $saldo09_pendapatan_xx = $saldoopendapatan09c_xx*-1;
            }else if ($saldoopendapatan09c_xx < 0){
                $saldo09_pendapatan_xx = $saldoopendapatan09c_xx;
            }else if ($saldoopendapatan09c_xx == 0){
                $saldo09_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldoopendapatan10d_xx<>0){
             $saldo10_pendapatan_xx = $saldoopendapatan10d_xx;
        }else{
            if ($saldoopendapatan10c_xx > 0){
                $saldo10_pendapatan_xx = $saldoopendapatan10c_xx*-1;
            }else if ($saldoopendapatan10c_xx < 0){
                $saldo10_pendapatan_xx = $saldoopendapatan10c_xx;
            }else if ($saldoopendapatan10c_xx == 0){
                $saldo10_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoopendapatan11d_xx<>0){
             $saldo11_pendapatan_xx = $saldoopendapatan11d_xx;
        }else{
            if ($saldoopendapatan11c_xx > 0){
                $saldo11_pendapatan_xx = $saldoopendapatan11c_xx*-1;
            }else if ($saldoopendapatan11c_xx < 0){
                $saldo11_pendapatan_xx = $saldoopendapatan11c_xx;
            }else if ($saldoopendapatan11c_xx == 0){
                $saldo11_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
        
        if($saldoopendapatan12d_xx<>0){
             $saldo12_pendapatan_xx = $saldoopendapatan12d_xx;
        }else{
            if ($saldoopendapatan12c_xx > 0){
                $saldo12_pendapatan_xx = $saldoopendapatan12c_xx*-1;
            }else if ($saldoopendapatan12c_xx < 0){
                $saldo12_pendapatan_xx = $saldoopendapatan12c_xx;
            }else if ($saldoopendapatan12c_xx == 0){
                $saldo12_pendapatan_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
        $totalpendapatan_x      = $saldo_year_pendapatan_xx+$saldo01_pendapatan_xx+$saldo02_pendapatan_xx+$saldo03_pendapatan_xx+$saldo04_pendapatan_xx+$saldo05_pendapatan_xx+$saldo06_pendapatan_xx+$saldo07_pendapatan_xx+$saldo08_pendapatan_xx+$saldo09_pendapatan_xx+$saldo10_pendapatan_xx+$saldo11_pendapatan_xx+$saldo12_pendapatan_xx;
        $totaltb_pendapatan    += $totalpendapatan_x;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalpendapatan_x,0));
		
		//$saldo_year_kewajiban_xx+$saldo01_kewajiban_xx+$saldo02_kewajiban_xx+$saldo03_kewajiban_xx+$saldo04_kewajiban_xx+$saldo05_kewajiban_xx+$saldo06_kewajiban_xx+$saldo07_kewajiban_xx+$saldo08_kewajiban_xx+$saldo09_kewajiban_xx+$saldo10_kewajiban_xx+$saldo11_kewajiban_xx+$saldo12_kewajiban_xx
		
    ?>
</td>
</tr>
<?php 
}
}
?>
<!-- PENDAPATAN -->








<!-- PENDAPATAN LAINNYA -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; Other Revenue</td>
</tr>
<?php

$yeard_pendapatan_lainnya_x;
$saldo01_pendapatan_lainnya_x;
$saldo02_pendapatan_lainnya_x;
$saldo03_pendapatan_lainnya_x;
$saldo04_pendapatan_lainnya_x;
$saldo05_pendapatan_lainnya_x;
$saldo06_pendapatan_lainnya_x;
$saldo07_pendapatan_lainnya_x;
$saldo08_pendapatan_lainnya_x;
$saldo09_pendapatan_lainnya_x;
$saldo10_pendapatan_lainnya_x;
$saldo11_pendapatan_lainnya_x;
$saldo12_pendapatan_lainnya_x;
$totaltb_pendapatan_lainnya_x;
$saldo01_pendapatan_lainnya_x;

//sum general
$saldo01pendapatan_lainnya_g;


$sum01_pendapatan_lainnya;
$sum02_pendapatan_lainnya;
$sum03_pendapatan_lainnya;
$sum04_pendapatan_lainnya;
$sum05_pendapatan_lainnya;
$sum06_pendapatan_lainnya;
$sum07_pendapatan_lainnya;
$sum08_pendapatan_lainnya;
$sum09_pendapatan_lainnya;
$sum10_pendapatan_lainnya;
$sum11_pendapatan_lainnya;
$sum12_pendapatan_lainnya;


foreach($data_list_other_revenue as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];

if($group_n == 'Other Revenue'){
    
    if($b['level'] == 1 && $b['type'] == 'G'){
        $bold_liab = 'font-weight:bold';
        
        if($b['saldo01d']<>0){
            $saldo01pendapatan_lainnya_g += $b['saldo01d'];
        }else{
            $sal1_xx = $b['saldo01c']*-1;
            $saldo01pendapatan_lainnya_g += $sal1_xx;
        }
        
    }else{
        $bold_liab = '';
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum01_pendapatan_lainnya = 0;
    }else{
    
        if($b['saldo01d']<>0){
            $sum01_pendapatan_lainnya += $b['saldo01d'];
        }else{
            if ($b['saldo01c'] > 0){
                $sum01_pendapatan_lainnya += $b['saldo01c']*-1;
            }else if ($b['saldo01c'] < 0){
                $sum01_pendapatan_lainnya += $b['saldo01c'];
            }else if ($b['saldo01c'] == 0){
                $sum01_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
		
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum02_pendapatan_lainnya = 0;
    }else{
        if($b['saldo02d']<>0){
            $sum02_pendapatan_lainnya += $b['saldo02d'];
        }else{
            if ($b['saldo02c'] > 0){
                $sum02_pendapatan_lainnya += $b['saldo02c']*-1;
            }else if ($b['saldo02c'] < 0){
                $sum02_pendapatan_lainnya += $b['saldo02c'];
            }else if ($b['saldo02c'] == 0){
                $sum02_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum03_pendapatan_lainnya = 0;
    }else{
        if($b['saldo03d']<>0){
            $sum03_pendapatan_lainnya += $b['saldo03d'];
        }else{
            if ($b['saldo03c'] > 0){
                $sum03_pendapatan_lainnya += $b['saldo03c']*-1;
            }else if ($b['saldo03c'] < 0){
                $sum03_pendapatan_lainnya += $b['saldo03c'];
            }else if ($b['saldo03c'] == 0){
                $sum03_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum04_pendapatan_lainnya = 0;
    }else{
        if($b['saldo04d']<>0){
            $sum04_pendapatan_lainnya += $b['saldo04d'];
        }else{
            if ($b['saldo04c'] > 0){
                $sum04_pendapatan_lainnya += $b['saldo04c']*-1;
            }else if ($b['saldo04c'] < 0){
                $sum04_pendapatan_lainnya += $b['saldo04c'];
            }else if ($b['saldo04c'] == 0){
                $sum04_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum05_pendapatan_lainnya = 0;
    }else{
        if($b['saldo05d']<>0){
            $sum05_pendapatan_lainnya += $b['saldo04d'];
        }else{
            if ($b['saldo05c'] > 0){
                $sum05_pendapatan_lainnya += $b['saldo05c']*-1;
            }else if ($b['saldo05c'] < 0){
                $sum05_pendapatan_lainnya += $b['saldo05c'];
            }else if ($b['saldo05c'] == 0){
                $sum05_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum06_pendapatan_lainnya = 0;
    }else{
        if($b['saldo06d']<>0){
            $sum06_pendapatan_lainnya += $b['saldo06d'];
        }else{
            if ($b['saldo06c'] > 0){
                $sum06_pendapatan_lainnya += $b['saldo06c']*-1;
            }else if ($b['saldo06c'] < 0){
                $sum06_pendapatan_lainnya += $b['saldo06c'];
            }else if ($b['saldo06c'] == 0){
                $sum06_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum07_pendapatan_lainnya = 0;
    }else{
        if($b['saldo07d']<>0){
            $sum07_pendapatan_lainnya += $b['saldo07d'];
        }else{
            if ($b['saldo07c'] > 0){
                $sum07_pendapatan_lainnya += $b['saldo07c']*-1;
            }else if ($b['saldo07c'] < 0){
                $sum07_pendapatan_lainnya += $b['saldo07c'];
            }else if ($b['saldo07c'] == 0){
                $sum07_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum08_pendapatan_lainnya = 0;
    }else{
        if($b['saldo08d']<>0){
            $sum08_pendapatan_lainnya += $b['saldo08d'];
        }else{
            if ($b['saldo08c'] > 0){
                $sum08_pendapatan_lainnya += $b['saldo08c']*-1;
            }else if ($b['saldo08c'] < 0){
                $sum08_pendapatan_lainnya += $b['saldo08c'];
            }else if ($b['saldo08c'] == 0){
                $sum08_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum09_pendapatan_lainnya = 0;
    }else{
        if($b['saldo09d']<>0){
            $sum09_pendapatan_lainnya += $b['saldo09d'];
        }else{
            if ($b['saldo09c'] > 0){
                $sum09_pendapatan_lainnya += $b['saldo09c']*-1;
            }else if ($b['saldo09c'] < 0){
                $sum09_pendapatan_lainnya += $b['saldo09c'];
            }else if ($b['saldo09c'] == 0){
                $sum09_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum10_pendapatan_lainnya = 0;
    }else{
        if($b['saldo10d']<>0){
            $sum10_pendapatan_lainnya += $b['saldo10d'];
        }else{
            if ($b['saldo10c'] > 0){
                $sum10_pendapatan_lainnya += $b['saldo10c']*-1;
            }else if ($b['saldo10c'] < 0){
                $sum10_pendapatan_lainnya += $b['saldo10c'];
            }else if ($b['saldo10c'] == 0){
                $sum10_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum11_pendapatan_lainnya = 0;
    }else{
        if($b['saldo11d']<>0){
            $sum11_pendapatan_lainnya += $b['saldo11d'];
        }else{
            if ($b['saldo11c'] > 0){
                $sum11_pendapatan_lainnya += $b['saldo11c']*-1;
            }else if ($b['saldo11c'] < 0){
                $sum11_pendapatan_lainnya += $b['saldo11c'];
            }else if ($b['saldo11c'] == 0){
                $sum11_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum12_pendapatan_lainnya = 0;
    }else{
        if($b['saldo12d']<>0){
            $sum12_pendapatan_lainnya += $b['saldo12d'];
        }else{
            if ($b['saldo12c'] > 0){
                $sum12_pendapatan_lainnya += $b['saldo12c']*-1;
            }else if ($b['saldo12c'] < 0){
                $sum12_pendapatan_lainnya += $b['saldo12c'];
            }else if ($b['saldo12c'] == 0){
                $sum12_pendapatan_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	
	
    
?>
<tr>
    <td align="center" width="10%" style="<?php echo $bold_liab;?>">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;<?php echo $bold_liab;?>"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
        if($b['yeard']<>0){
            $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            $yeard_pendapatan_lainnya_x += $angka;
            echo $angka;
        }else{
            
            if ($b['yearc'] > 0){
                $yearc_c    = $b['yearc']*-1;
                $yeard_pendapatan_lainnya_x += $b['yearc']*-1;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($yearc_c,0));
            }else if ($b['yearc'] < 0){
                $yeard_pendapatan_lainnya_x += $b['yearc'];
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yearc'],0));
            }else if ($b['yearc'] == 0){
                $yeard_pendapatan_lainnya_x += 0;
                echo 0;
            } else {
                //disini numeric value
            }
            
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldoopendapatanlainnya01d = $b['saldo01d'];
    $saldoopendapatanlainnya01c = $b['saldo01c'];
    
    if($saldoopendapatanlainnya01d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya01d,0));
        $saldo01_pendapatan_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya01c > 0){
            $saldo01_pendapatanlainnya    = $saldoopendapatanlainnya01c*-1;
            $saldo01_pendapatan_lainnya_x += $saldoopendapatanlainnya01c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo01_pendapatanlainnya,0));
        }else if ($saldoopendapatanlainnya01c < 0){
            $saldo01_pendapatan_lainnya_x += $saldoopendapatanlainnya01c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya01c,0));
        }else if ($saldoopendapatanlainnya01c == 0){
            $saldo01_pendapatan_lainnya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatanlainnya02d = $b['saldo02d'];
    $saldoopendapatanlainnya02c = $b['saldo02c'];
    
    if($saldoopendapatanlainnya02d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya02d,0));
        $saldo02_pendapatan_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya02c > 0){
            $saldo02_pendapatanlainnya    = $saldoopendapatanlainnya02c*-1;
            $saldo02_pendapatan_lainnya_x += $saldoopendapatanlainnya02c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo02_pendapatanlainnya,0));
        }else if ($saldoopendapatanlainnya02c < 0){
            $saldo02_pendapatan_lainnya_x += $saldoopendapatanlainnya02c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya02c,0));
        }else if ($saldoopendapatanlainnya02c == 0){
            $saldo02_pendapatan_lainnya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatanlainnya03d = $b['saldo03d'];
    $saldoopendapatanlainnya03c = $b['saldo03c'];
    
    if($saldoopendapatanlainnya03d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya03d,0));
        $saldo03_pendapatan_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya03c > 0){
            $saldo03_pendapatanlainnya    = $saldoopendapatanlainnya03c*-1;
            $saldo03_pendapatan_lainnya_x += $saldoopendapatanlainnya03c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo03_pendapatanlainnya,0));
        }else if ($saldoopendapatanlainnya03c < 0){
            $saldo03_pendapatan_lainnya_x += $saldoopendapatanlainnya03c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya03c,0));
        }else if ($saldoopendapatanlainnya03c == 0){
            $saldo03_pendapatan_lainnya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatanlainnya04d = $b['saldo04d'];
    $saldoopendapatanlainnya04c = $b['saldo04c'];
    
    if($saldoopendapatanlainnya04d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya04d,0));
        $saldo04_pendapatan_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya04c > 0){
            $saldo04_pendapatanlainnya = $saldoopendapatanlainnya04c*-1;
            $saldo04_pendapatan_lainnya_x += $saldoopendapatanlainnya04c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo04_pendapatanlainnya,0));
        }else if ($saldoopendapatanlainnya04c < 0){
            $saldo04_pendapatan_lainnya_x += $saldoopendapatanlainnya04c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya04c,0));
        }else if ($saldoopendapatanlainnya04c == 0){
            $saldo04_pendapatan_lainnya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatanlainnya05d = $b['saldo05d'];
    $saldoopendapatanlainnya05c = $b['saldo05c'];
    
    if($saldoopendapatanlainnya05d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya05d,0));
        $saldo05_pendapatan_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya05c > 0){
            $saldo05_pendapatanlainnya   = $saldoopendapatanlainnya05c*-1;
            $saldo05_pendapatan_lainnya_x += $saldoopendapatanlainnya05c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo05_pendapatanlainnya,0));
        }else if ($saldoopendapatanlainnya05c < 0){
            $saldo05_pendapatan_lainnya_x += $saldoopendapatanlainnya05c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya05c,0));
        }else if ($saldoopendapatanlainnya05c == 0){
            $saldo05_pendapatan_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatanlainnya06d = $b['saldo06d'];
    $saldoopendapatanlainnya06c = $b['saldo06c'];
    
    if($saldoopendapatanlainnya06d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya06d,0));
        $saldo06_pendapatan_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya06c > 0){
            $saldo06_pendapatan    = $saldoopendapatanlainnya06c*-1;
            $saldo06_pendapatan_lainnya_x += $saldoopendapatanlainnya06c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo06_pendapatan,0));
        }else if ($saldoopendapatanlainnya06c < 0){
            $saldo06_pendapatan_lainnya_x += $saldoopendapatanlainnya06c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya06c,0));
        }else if ($saldoopendapatanlainnya06c == 0){
            $saldo06_pendapatan_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatanlainnya07d = $b['saldo07d'];
    $saldoopendapatanlainnya07c = $b['saldo07c'];
    
    if($saldoopendapatanlainnya07d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya07d,0));
        $saldo07_pendapatan_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya07c > 0){
            $saldo07_pendapatanlainnya    = $saldoopendapatanlainnya07c*-1;
            $saldo07_pendapatan_lainnya_x += $saldoopendapatanlainnya07c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo07_pendapatanlainnya,0));
        }else if ($saldoopendapatanlainnya07c < 0){
            $saldo07_pendapatan_lainnya_x += $saldoopendapatanlainnya07c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya07c,0));
        }else if ($saldoopendapatanlainnya07c == 0){
            $saldo07_pendapatan_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatanlainnya08d = $b['saldo08d'];
    $saldoopendapatanlainnya08c = $b['saldo08c'];
    
    if($saldoopendapatanlainnya08d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya08d,0));
        $saldo08_pendapatan_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya08c > 0){
            $saldo08_pendapatanlainnya    = $saldoopendapatanlainnya08c*-1;
            $saldo08_pendapatan_lainnya_x += $saldoopendapatanlainnya08c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo08_pendapatanlainnya,0));
        }else if ($saldoopendapatanlainnya08c < 0){
            $saldo08_pendapatan_lainnya_x += $saldoopendapatanlainnya08c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya08c,0));
        }else if ($saldoopendapatanlainnya08c == 0){
            $saldo08_pendapatan_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatanlainnya09d = $b['saldo09d'];
    $saldoopendapatanlainnya09c = $b['saldo09c'];
    
    if($saldoopendapatanlainnya09d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya09d,0));
        $saldo09_pendapatan_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya09c > 0){
            $saldo09_pendapatanlainnya    = $saldoopendapatanlainnya09c*-1;
            $saldo09_pendapatan_lainnya_x += $saldoopendapatanlainnya09c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo09_pendapatanlainnya,0));
        }else if ($saldoopendapatanlainnya09c < 0){
            $saldo09_pendapatan_lainnya_x += $saldoopendapatanlainnya09c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya09c,0));
        }else if ($saldoopendapatanlainnya09c == 0){
            $saldo09_pendapatan_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatanlainnya10d = $b['saldo10d'];
    $saldoopendapatanlainnya10c = $b['saldo10c'];
    
    if($saldoopendapatanlainnya10d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya10d,0));
        $saldo10_kewajiban_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya10c > 0){
            $saldo10_pendapatanlainnya    = $saldoopendapatanlainnya10c*-1;
            $saldo10_kewajiban_lainnya_x += $saldoopendapatanlainnya10c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo10_pendapatanlainnya,0));
        }else if ($saldoopendapatanlainnya10c < 0){
            $saldo10_kewajiban_lainnya_x += $saldoopendapatanlainnya10c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya10c,0));
        }else if ($saldoopendapatanlainnya10c == 0){
            $saldo10_kewajiban_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatanlainnya11d = $b['saldo11d'];
    $saldoopendapatanlainnya11c = $b['saldo11c'];
    
    if($saldoopendapatanlainnya11d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya11d,0));
        $saldo11_pendapatan_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya11c > 0){
            $saldo11_pendapatanlainnya    = $saldoopendapatanlainnya11c*-1;
            $saldo11_pendapatan_lainnya_x += $saldoopendapatanlainnya11c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo11_pendapatanlainnya,0));
        }else if ($saldoopendapatanlainnya11c < 0){
            $saldo11_pendapatan_lainnya_x += $saldoopendapatanlainnya11c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya11c,0));
        }else if ($saldoopendapatanlainnya11c == 0){
            $saldo11_pendapatan_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoopendapatanlainnya12d = $b['saldo12d'];
    $saldoopendapatanlainnya12c = $b['saldo12c'];
    
    if($saldoopendapatanlainnya12d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya12d,0));
        $saldo12_pendapatan_lainnya_x += $angka;
        echo $angka;
    }else{
        if ($saldoopendapatanlainnya12c > 0){
            $saldo12_pendapatanlainnya    = $saldoopendapatanlainnya12c*-1;
            $saldo12_pendapatan_lainnya_x += $saldoopendapatanlainnya12c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo12_pendapatanlainnya,0));
        }else if ($saldoopendapatanlainnya12c < 0){
            $saldo12_pendapatan_lainnya_x += $saldoopendapatanlainnya12c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoopendapatanlainnya12c,0));
        }else if ($saldoopendapatanlainnya12c == 0){
            $saldo12_pendapatan_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldoopendapatanlainnya_yeard_xx = $b['yeard'];
    $saldoopendapatanlainnya_yearc_xx = $b['yearc'];
	
    $saldoopendapatanlainnya01d_xx = $b['saldo01d'];
    $saldoopendapatanlainnya01c_xx = $b['saldo01c'];
    //
    $saldoopendapatanlainnya02d_xx = $b['saldo02d'];
    $saldoopendapatanlainnya02c_xx = $b['saldo02c'];
    //
    $saldoopendapatanlainnya03d_xx = $b['saldo03d'];
    $saldoopendapatanlainnya03c_xx = $b['saldo03c'];
    //
    $saldoopendapatanlainnya04d_xx = $b['saldo04d'];
    $saldoopendapatanlainnya04c_xx = $b['saldo04c'];
    //
    $saldoopendapatanlainnya05d_xx = $b['saldo05d'];
    $saldoopendapatanlainnya05c_xx = $b['saldo05c'];
    //
    $saldoopendapatanlainnya06d_xx = $b['saldo06d'];
    $saldoopendapatanlainnya06c_xx = $b['saldo06c'];
    //
    $saldoopendapatanlainnya07d_xx = $b['saldo07d'];
    $saldoopendapatanlainnya07c_xx = $b['saldo07c'];
    //
    $saldoopendapatanlainnya08d_xx = $b['saldo08d'];
    $saldoopendapatanlainnya08c_xx = $b['saldo08c'];
    //
    $saldoopendapatanlainnya09d_xx = $b['saldo09d'];
    $saldoopendapatanlainnya09c_xx = $b['saldo09c'];
    //
    $saldoopendapatanlainnya10d_xx = $b['saldo10d'];
    $saldoopendapatanlainnya10c_xx = $b['saldo10c'];
    //
    $saldoopendapatanlainnya11d_xx = $b['saldo11d'];
    $saldoopendapatanlainnya11c_xx = $b['saldo11c'];
    //
    $saldoopendapatanlainnya12d_xx = $b['saldo12d'];
    $saldoopendapatanlainnya12c_xx = $b['saldo12c'];
    
    
    //+$saldo09_aset+$saldo08_aset+$saldo07_aset+$saldo06_aset+$saldo05_aset+$saldo04_aset+$saldo03_aset+$saldo02_aset+$saldo01_aset
        
		if($saldoopendapatanlainnya_yeard_xx<>0){
            $saldo_year_pendapatanlainnya_xx = $saldoopendapatanlainnya_yeard_xx;
        }else{
            if ($saldoopendapatanlainnya_yearc_xx > 0){
                $saldo_year_pendapatanlainnya_xx = $saldoopendapatanlainnya_yearc_xx*-1;
            }else if ($saldoopendapatanlainnya_yearc_xx< 0){
                $saldo_year_pendapatanlainnya_xx = $saldoopendapatanlainnya_yearc_xx;
            }else if ($saldoopendapatanlainnya_yearc_xx == 0){
                $saldo_year_pendapatanlainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
        if($saldoopendapatanlainnya01d_xx<>0){
            $saldo01_pendapatan_lainnya_xx = $saldoopendapatanlainnya01d_xx;
        }else{
            if ($saldoopendapatanlainnya01c_xx > 0){
                $saldo01_pendapatan_lainnya_xx = $saldoopendapatanlainnya01c_xx*-1;
            }else if ($saldoopendapatanlainnya01c_xx < 0){
                $saldo01_pendapatan_lainnya_xx = $saldoopendapatanlainnya01c_xx;
            }else if ($saldoopendapatanlainnya01c_xx == 0){
                $saldo01_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoopendapatanlainnya02d_xx<>0){
            $saldo02_pendapatan_lainnya_xx = $saldoopendapatanlainnya02d_xx;
        }else{
            if ($saldoopendapatanlainnya02c_xx > 0){
                $saldo02_pendapatan_lainnya_xx = $saldoopendapatanlainnya02c_xx*-1;
            }else if ($saldoopendapatanlainnya02c_xx < 0){
                $saldo02_pendapatan_lainnya_xx = $saldoopendapatanlainnya02c_xx;
            }else if ($saldoopendapatanlainnya02c_xx == 0){
                $saldo02_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoopendapatanlainnya03d_xx<>0){
             $saldo03_pendapatan_lainnya_xx = $saldoopendapatanlainnya03d_xx;
        }else{
            if ($saldoopendapatanlainnya03c_xx > 0){
                $saldo03_pendapatan_lainnya_xx = $saldoopendapatanlainnya03c_xx*-1;
            }else if ($saldoopendapatanlainnya03c_xx < 0){
                $saldo03_pendapatan_lainnya_xx = $saldoopendapatanlainnya03c_xx;
            }else if ($saldoopendapatanlainnya03c_xx == 0){
                $saldo03_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoopendapatanlainnya04d_xx<>0){
             $saldo04_pendapatan_lainnya_xx = $saldoopendapatanlainnya04d_xx;
        }else{
            if ($saldoopendapatanlainnya04c_xx > 0){
                $saldo04_pendapatan_lainnya_xx = $saldoopendapatanlainnya04c_xx*-1;
            }else if ($saldoopendapatanlainnya04c_xx < 0){
                $saldo04_pendapatan_lainnya_xx = $saldoopendapatanlainnya04c_xx;
            }else if ($saldoopendapatanlainnya04c_xx == 0){
                $saldo04_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldoopendapatanlainnya05d_xx<>0){
             $saldo05_pendapatan_lainnya_xx = $saldoopendapatanlainnya05d_xx;
        }else{
            if ($saldoopendapatanlainnya05c_xx > 0){
                $saldo05_pendapatan_lainnya_xx = $saldoopendapatanlainnya05c_xx*-1;
            }else if ($saldoopendapatanlainnya05c_xx < 0){
                $saldo05_pendapatan_lainnya_xx = $saldoopendapatanlainnya05c_xx;
            }else if ($saldoopendapatanlainnya05c_xx == 0){
                $saldo05_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoopendapatanlainnya06d_xx<>0){
             $saldo06_pendapatan_lainnya_xx = $saldoopendapatanlainnya06d_xx;
        }else{
            if ($saldoopendapatanlainnya06c_xx > 0){
                $saldo06_pendapatan_lainnya_xx = $saldoopendapatanlainnya06c_xx*-1;
            }else if ($saldoopendapatanlainnya06c_xx < 0){
                $saldo06_pendapatan_lainnya_xx = $saldoopendapatanlainnya06c_xx;
            }else if ($saldoopendapatanlainnya06c_xx == 0){
                $saldo06_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoopendapatanlainnya07d_xx<>0){
             $saldo07_pendapatan_lainnya_xx = $saldoopendapatanlainnya07d_xx;
        }else{
            if ($saldoopendapatanlainnya07c_xx > 0){
                $saldo07_pendapatan_lainnya_xx = $saldoopendapatanlainnya07c_xx*-1;
            }else if ($saldoopendapatanlainnya07c_xx < 0){
                $saldo07_pendapatan_lainnya_xx = $saldoopendapatanlainnya07c_xx;
            }else if ($saldoopendapatanlainnya07c_xx == 0){
                $saldo07_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoopendapatanlainnya08d_xx<>0){
             $saldo08_pendapatan_lainnya_xx = $saldoopendapatanlainnya08d_xx;
        }else{
            if ($saldoopendapatanlainnya08c_xx > 0){
                $saldo08_pendapatan_lainnya_xx = $saldoopendapatanlainnya08c_xx*-1;
            }else if ($saldoopendapatanlainnya08c_xx < 0){
                $saldo08_pendapatan_lainnya_xx = $saldoopendapatanlainnya08c_xx;
            }else if ($saldoopendapatanlainnya08c_xx == 0){
                $saldo08_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoopendapatanlainnya09d_xx<>0){
             $saldo09_pendapatan_lainnya_xx = $saldoopendapatanlainnya09d_xx;
        }else{
            if ($saldoopendapatanlainnya09c_xx > 0){
                $saldo09_pendapatan_lainnya_xx = $saldoopendapatanlainnya09c_xx*-1;
            }else if ($saldoopendapatanlainnya09c_xx < 0){
                $saldo09_pendapatan_lainnya_xx = $saldoopendapatanlainnya09c_xx;
            }else if ($saldoopendapatanlainnya09c_xx == 0){
                $saldo09_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldoopendapatanlainnya10d_xx<>0){
             $saldo10_pendapatan_lainnya_xx = $saldoopendapatanlainnya10d_xx;
        }else{
            if ($saldoopendapatanlainnya10c_xx > 0){
                $saldo10_pendapatan_lainnya_xx = $saldoopendapatanlainnya10c_xx*-1;
            }else if ($saldoopendapatanlainnya10c_xx < 0){
                $saldo10_pendapatan_lainnya_xx = $saldoopendapatanlainnya10c_xx;
            }else if ($saldoopendapatanlainnya10c_xx == 0){
                $saldo10_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoopendapatanlainnya11d_xx<>0){
             $saldo11_pendapatan_lainnya_xx = $saldoopendapatanlainnya11d_xx;
        }else{
            if ($saldoopendapatanlainnya11c_xx > 0){
                $saldo11_pendapatan_lainnya_xx = $saldoopendapatanlainnya11c_xx*-1;
            }else if ($saldoopendapatanlainnya11c_xx < 0){
                $saldo11_pendapatan_lainnya_xx = $saldoopendapatanlainnya11c_xx;
            }else if ($saldoopendapatanlainnya11c_xx == 0){
                $saldo11_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
        
        if($saldoopendapatanlainnya12d_xx<>0){
             $saldo12_pendapatan_lainnya_xx = $saldoopendapatanlainnya12d_xx;
        }else{
            if ($saldoopendapatanlainnya12c_xx > 0){
                $saldo12_pendapatan_lainnya_xx = $saldoopendapatanlainnya12c_xx*-1;
            }else if ($saldoopendapatanlainnya12c_xx < 0){
                $saldo12_pendapatan_lainnya_xx = $saldoopendapatanlainnya12c_xx;
            }else if ($saldoopendapatanlainnya12c_xx == 0){
                $saldo12_pendapatan_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
        $totalpendapatanlainnya_x      = $saldo_year_pendapatan_lainnya_xx+$saldo01_pendapatan_lainnya_xx+$saldo02_pendapatan_lainnya_xx+$saldo03_pendapatan_lainnya_xx+$saldo04_pendapatan_lainnya_xx+$saldo05_pendapatan_lainnya_xx+$saldo06_pendapatan_lainnya_xx+$saldo07_pendapatan_lainnya_xx+$saldo08_pendapatan_lainnya_xx+$saldo09_pendapatan_lainnya_xx+$saldo10_pendapatan_lainnya_xx+$saldo11_pendapatan_lainnya_xx+$saldo12_pendapatan_lainnya_xx;
        $totaltb_pendapatanlainnya    += $totalpendapatanlainnya_x;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalpendapatanlainnya_x,0));
		
    ?>
</td>
</tr>
<?php
}
}

?>
<!-- PENDAPATAN LAINNYA -->



<!-- BIAYA LAINNYA -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="15" style="font-weight:bold">&nbsp;&nbsp; Other Expenses</td>
</tr>
<?php

$yeard_biaya_lainnya_x;
$saldo01_biaya_lainnya_x;
$saldo02_biaya_lainnya_x;
$saldo03_biaya_lainnya_x;
$saldo04_biaya_lainnya_x;
$saldo05_biaya_lainnya_x;
$saldo06_biaya_lainnya_x;
$saldo07_biaya_lainnya_x;
$saldo08_biaya_lainnya_x;
$saldo09_biaya_lainnya_x;
$saldo10_biaya_lainnya_x;
$saldo11_biaya_lainnya_x;
$saldo12_biaya_lainnya_x;
$totaltb_biaya_lainnya_x;

$saldo01biaya_lainnya_g;
$saldo02biaya_lainnya_g;


$sum01_biaya_lainnya;
$sum02_biaya_lainnya;
$sum03_biaya_lainnya;
$sum04_biaya_lainnya;
$sum05_biaya_lainnya;
$sum06_biaya_lainnya;
$sum07_biaya_lainnya;
$sum08_biaya_lainnya;
$sum09_biaya_lainnya;
$sum10_biaya_lainnya;
$sum11_biaya_lainnya;
$sum12_biaya_lainnya;

foreach($data_list_other_expenses as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
if($group_n == 'Other Expenses'){
    
	if($b['level'] == 1 && $b['type'] == 'G'){
        $bold_liab = 'font-weight:bold';
    }else{
        $bold_liab = '';
    }
   
   
    if($b['level'] == 1 && $b['type'] == 'G'){
		$sum01_biaya_lainnya = 0;
    }else{
    
        if($b['saldo01d']<>0){
            $sum01_biaya_lainnya += $b['saldo01d'];
        }else{
            if ($b['saldo01c'] > 0){
                $sum01_biaya_lainnya += $b['saldo01c']*-1;
            }else if ($b['saldo01c'] < 0){
                $sum01_biaya_lainnya += $b['saldo01c'];
            }else if ($b['saldo01c'] == 0){
                $sum01_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
		
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum02_biaya_lainnya = 0;
    }else{
        if($b['saldo02d']<>0){
            $sum02_biaya_lainnya += $b['saldo02d'];
        }else{
            if ($b['saldo02c'] > 0){
                $sum02_biaya_lainnya += $b['saldo02c']*-1;
            }else if ($b['saldo02c'] < 0){
                $sum02_biaya_lainnya += $b['saldo02c'];
            }else if ($b['saldo02c'] == 0){
                $sum02_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum03_biaya_lainnya = 0;
    }else{
        if($b['saldo03d']<>0){
            $sum03_biaya_lainnya += $b['saldo03d'];
        }else{
            if ($b['saldo03c'] > 0){
                $sum03_biaya_lainnya += $b['saldo03c']*-1;
            }else if ($b['saldo03c'] < 0){
                $sum03_biaya_lainnya += $b['saldo03c'];
            }else if ($b['saldo03c'] == 0){
                $sum03_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum04_biaya_lainnya = 0;
    }else{
        if($b['saldo04d']<>0){
            $sum04_biaya_lainnya += $b['saldo04d'];
        }else{
            if ($b['saldo04c'] > 0){
                $sum04_biaya_lainnya += $b['saldo04c']*-1;
            }else if ($b['saldo04c'] < 0){
                $sum04_biaya_lainnya += $b['saldo04c'];
            }else if ($b['saldo04c'] == 0){
                $sum04_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum05_biaya_lainnya = 0;
    }else{
        if($b['saldo05d']<>0){
            $sum05_biaya_lainnya += $b['saldo04d'];
        }else{
            if ($b['saldo05c'] > 0){
                $sum05_biaya_lainnya += $b['saldo05c']*-1;
            }else if ($b['saldo05c'] < 0){
                $sum05_biaya_lainnya += $b['saldo05c'];
            }else if ($b['saldo05c'] == 0){
                $sum05_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    } 
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum06_biaya_lainnya = 0;
    }else{
        if($b['saldo06d']<>0){
            $sum06_biaya_lainnya += $b['saldo06d'];
        }else{
            if ($b['saldo06c'] > 0){
                $sum06_biaya_lainnya += $b['saldo06c']*-1;
            }else if ($b['saldo06c'] < 0){
                $sum06_biaya_lainnya += $b['saldo06c'];
            }else if ($b['saldo06c'] == 0){
                $sum06_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum07_biaya_lainnya = 0;
    }else{
        if($b['saldo07d']<>0){
            $sum07_biaya_lainnya += $b['saldo07d'];
        }else{
            if ($b['saldo07c'] > 0){
                $sum07_biaya_lainnya += $b['saldo07c']*-1;
            }else if ($b['saldo07c'] < 0){
                $sum07_biaya_lainnya += $b['saldo07c'];
            }else if ($b['saldo07c'] == 0){
                $sum07_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum08_biaya_lainnya = 0;
    }else{
        if($b['saldo08d']<>0){
            $sum08_biaya_lainnya += $b['saldo08d'];
        }else{
            if ($b['saldo08c'] > 0){
                $sum08_biaya_lainnya += $b['saldo08c']*-1;
            }else if ($b['saldo08c'] < 0){
                $sum08_biaya_lainnya += $b['saldo08c'];
            }else if ($b['saldo08c'] == 0){
                $sum08_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum09_biaya_lainnya = 0;
    }else{
        if($b['saldo09d']<>0){
            $sum09_biaya_lainnya += $b['saldo09d'];
        }else{
            if ($b['saldo09c'] > 0){
                $sum09_biaya_lainnya += $b['saldo09c']*-1;
            }else if ($b['saldo09c'] < 0){
                $sum09_biaya_lainnya += $b['saldo09c'];
            }else if ($b['saldo09c'] == 0){
                $sum09_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum10_biaya_lainnya = 0;
    }else{
        if($b['saldo10d']<>0){
            $sum10_biaya_lainnya += $b['saldo10d'];
        }else{
            if ($b['saldo10c'] > 0){
                $sum10_biaya_lainnya += $b['saldo10c']*-1;
            }else if ($b['saldo10c'] < 0){
                $sum10_biaya_lainnya += $b['saldo10c'];
            }else if ($b['saldo10c'] == 0){
                $sum10_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum11_biaya_lainnya = 0;
    }else{
        if($b['saldo11d']<>0){
            $sum11_biaya_lainnya += $b['saldo11d'];
        }else{
            if ($b['saldo11c'] > 0){
                $sum11_biaya_lainnya += $b['saldo11c']*-1;
            }else if ($b['saldo11c'] < 0){
                $sum11_biaya_lainnya += $b['saldo11c'];
            }else if ($b['saldo11c'] == 0){
                $sum11_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
	
	if($b['level'] == 1 && $b['type'] == 'G'){
		$sum12_biaya_lainnya = 0;
    }else{
        if($b['saldo12d']<>0){
            $sum12_biaya_lainnya += $b['saldo12d'];
        }else{
            if ($b['saldo12c'] > 0){
                $sum12_biaya_lainnya += $b['saldo12c']*-1;
            }else if ($b['saldo12c'] < 0){
                $sum12_biaya_lainnya += $b['saldo12c'];
            }else if ($b['saldo12c'] == 0){
                $sum12_biaya_lainnya += 0;
            }else{
                //disini numeric value
            }
        }
    }
	
    
    
?>
<tr>
<td align="center" width="10%" style="<?php echo $bold_liab;?>">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;<?php echo $bold_liab;?>"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
        if($b['yeard']<>0){
            $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            $saldo_year_biaya_lainnya_x += $angka;
            echo $angka;
        }else{
            
            if ($b['yearc'] > 0){
                $yearc_c    = $b['yearc']*-1;
                $saldo_year_biaya_lainnya_x += $b['yearc']*-1;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($yearc_c,0));
            }else if ($b['yearc'] < 0){
                $saldo_year_biaya_lainnya_x += $b['yearc'];
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yearc'],0));
            }else if ($b['yearc'] == 0){
                $saldo_year_biaya_lainnya_x += 0;
                echo 0;
            } else {
                //disini numeric value
            }
            
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldoobiayalainnya01d = $b['saldo01d'];
    $saldoobiayalainnya01c = $b['saldo01c'];
    
    if($saldoobiayalainnya01d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya01d,0));
        $saldo01_biaya_lainnya_x += $saldoobiayalainnya01d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya01c > 0){
            $saldo01_biayalainnya    = $saldoobiayalainnya01c*-1;
            $saldo01_biaya_lainnya_x += $saldoobiayalainnya01c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo01_biayalainnya,0));
        }else if ($saldoobiayalainnya01c < 0){
            $saldo01_biaya_lainnya_x += $saldoobiayalainnya01c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya01c,0));
        }else if ($saldoobiayalainnya01c == 0){
            $saldo01_biaya_lainnya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiayalainnya02d = $b['saldo02d'];
    $saldoobiayalainnya02c = $b['saldo02c'];
    
    if($saldoobiayalainnya02d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya02d,0));
        $saldo02_biaya_lainnya_x += $saldoobiayalainnya02d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya02c > 0){
            $saldo02_biayalainnya    = $saldoobiayalainnya02c*-1;
            $saldo02_biaya_lainnya_x += $saldoobiayalainnya02c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo02_biayalainnya,0));
        }else if ($saldoobiayalainnya02c < 0){
            $saldo02_biaya_lainnya_x += $saldoobiayalainnya02c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya02c,0));
        }else if ($saldoobiayalainnya02c == 0){
            $saldo02_biaya_lainnya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiayalainnya03d = $b['saldo03d'];
    $saldoobiayalainnya03c = $b['saldo03c'];
    
    if($saldoobiayalainnya03d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya03d,0));
        $saldo03_biaya_lainnya_x += $saldoobiayalainnya03d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya03c > 0){
            $saldo03_biayalainnya    = $saldoobiayalainnya03c*-1;
            $saldo03_biaya_lainnya_x += $saldoobiayalainnya03c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo03_biayalainnya,0));
        }else if ($saldoobiayalainnya03c < 0){
            $saldo03_biaya_lainnya_x += $saldoobiayalainnya03c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya03c,0));
        }else if ($saldoobiayalainnya03c == 0){
            $saldo03_biaya_lainnya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiayalainnya04d = $b['saldo04d'];
    $saldoobiayalainnya04c = $b['saldo04c'];
    
    if($saldoobiayalainnya04d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya04d,0));
        $saldo04_biaya_lainnya_x += $saldoobiayalainnya04d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya04c > 0){
            $saldo04_biayalainnya    = $saldoobiayalainnya04c*-1;
            $saldo04_biaya_lainnya_x += $saldoobiaya04c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo04_biayalainnya,0));
        }else if ($saldoobiayalainnya04c < 0){
            $saldo04_biaya_lainnya_x += $saldoobiayalainnya04c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya04c,0));
        }else if ($saldoobiayalainnya04c == 0){
            $saldo04_biaya_lainnya_x += 0;
            echo 0;
        } else {
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiayalainnya05d = $b['saldo05d'];
    $saldoobiayalainnya05c = $b['saldo05c'];
    
    if($saldoobiayalainnya05d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya05d,0));
        $saldo05_biaya_lainnya_x += $saldoobiayalainnya05d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya05c > 0){
            $saldo05_biayalainnya    = $saldoobiayalainnya05c*-1;
            $saldo05_biaya_lainnya_x += $saldoobiayalainnya05c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo05_biayalainnya,0));
        }else if ($saldoobiayalainnya05c < 0){
            $saldo05_biaya_lainnya_x += $saldoobiayalainnya05c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya05c,0));
        }else if ($saldoobiayalainnya05c == 0){
            $saldo05_biaya_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiayalainnya06d = $b['saldo06d'];
    $saldoobiayalainnya06c = $b['saldo06c'];
    
    if($saldoobiayalainnya06d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya06d,0));
        $saldo06_biaya_lainnya_x += $saldoobiayalainnya06d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya06c > 0){
            $saldo06_biayalainnya    = $saldoobiayalainnya06c*-1;
            $saldo06_biaya_lainnya_x += $saldoobiayalainnya06c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo06_biayalainnya,0));
        }else if ($saldoobiayalainnya06c < 0){
            $saldo06_biaya_lainnya_x += $saldoobiayalainnya06c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya06c,0));
        }else if ($saldoobiayalainnya06c == 0){
            $saldo06_biaya_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiayalainnya07d = $b['saldo07d'];
    $saldoobiayalainnya07c = $b['saldo07c'];
    
    if($saldoobiayalainnya07d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya07d,0));
        $saldo07_biaya_lainnya_x += $saldoobiayalainnya07d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya07c > 0){
            $saldo07_biayalainnya    = $saldoobiayalainnya07c*-1;
            $saldo07_biaya_lainnya_x += $saldoobiayalainnya07c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo07_biayalainnya,0));
        }else if ($saldoobiayalainnya07c < 0){
            $saldo07_biaya_lainnya_x += $saldoobiayalainnya07c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya07c,0));
        }else if ($saldoobiayalainnya07c == 0){
            $saldo07_biaya_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiayalainnya08d = $b['saldo08d'];
    $saldoobiayalainnya08c = $b['saldo08c'];
    
    if($saldoobiayalainnya08d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya08d,0));
        $saldo08_biaya_lainnya_x += $saldoobiayalainnya08d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya08c > 0){
            $saldo08_biayalainnya    = $saldoobiayalainnya08c*-1;
            $saldo08_biaya_lainnya_x += $saldoobiayalainnya08c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo08_biayalainnya,0));
        }else if ($saldoobiayalainnya08c < 0){
            $saldo08_biaya_lainnya_x += $saldoobiayalainnya08c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya08c,0));
        }else if ($saldoobiayalainnya08c == 0){
            $saldo08_biaya_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiayalainnya09d = $b['saldo09d'];
    $saldoobiayalainnya09c = $b['saldo09c'];
    
    if($saldoobiayalainnya09d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya09d,0));
        $saldo09_biaya_lainnya_x += $saldoobiayalainnya09d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya09c > 0){
            $saldo09_biayalainnya    = $saldoobiayalainnya09c*-1;
            $saldo09_biaya_lainnya_x += $saldoobiayalainnya09c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo09_biayalainnya,0));
        }else if ($saldoobiayalainnya09c < 0){
            $saldo09_biaya_lainnya_x += $saldoobiayalainnya09c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya09c,0));
        }else if ($saldoobiayalainnya09c == 0){
            $saldo09_biaya_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiayalainnya10d = $b['saldo10d'];
    $saldoobiayalainnya10c = $b['saldo10c'];
    
    if($saldoobiayalainnya10d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya10d,0));
        $saldo10_biaya_lainnya_x += $saldoobiayalainnya10d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya10c > 0){
            $saldo10_biayalainnya    = $saldoobiayalainnya10c*-1;
            $saldo10_biaya_lainnya_x += $saldoobiayalainnya10c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo10_biayalainnya,0));
        }else if ($saldoobiayalainnya10c < 0){
            $saldo10_biaya_lainnya_x += $saldoobiayalainnya10c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya10c,0));
        }else if ($saldoobiayalainnya10c == 0){
            $saldo10_biaya_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiayalainnya11d = $b['saldo11d'];
    $saldoobiayalainnya11c = $b['saldo11c'];
    
    if($saldoobiayalainnya11d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya11d,0));
        $saldo11_biaya_lainnya_x += $saldoobiayalainnya11d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya11c > 0){
            $saldo11_biayalainnya    = $saldoobiayalainnya11c*-1;
            $saldo11_biaya_lainnya_x += $saldoobiayalainnya11c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo11_biayalainnya,0));
        }else if ($saldoobiayalainnya11c < 0){
            $saldo11_biaya_lainnya_x += $saldoobiayalainnya11c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya11c,0));
        }else if ($saldoobiayalainnya11c == 0){
            $saldo11_biaya_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    $saldoobiayalainnya12d = $b['saldo12d'];
    $saldoobiayalainnya12c = $b['saldo12c'];
    
    if($saldoobiayalainnya12d<>0){
        $angka = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya12d,0));
        $saldo12_biaya_lainnya_x += $saldoobiayalainnya12d;
        echo $angka;
    }else{
        if ($saldoobiayalainnya12c > 0){
            $saldo12_biayalainnya     = $saldoobiayalainnya12c*-1;
            $saldo12_biaya_lainnya_x += $saldoobiayalainnya12c*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo12_biayalainnya,0));
        }else if ($saldoobiayalainnya12c < 0){
            $saldo12_biaya_lainnya_x += $saldoobiayalainnya12c;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldoobiayalainnya12c,0));
        }else if ($saldoobiayalainnya12c == 0){
            $saldo12_biaya_lainnya_x += 0;
            echo 0;
        }else{
            //disini numeric value
        }
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    
    $saldoobiayalainnya_yeard_xx = $b['yeard'];
    $saldoobiayalainnya_yearc_xx = $b['yearc'];
	
    $saldoobiayalainnya01d_xx = $b['saldo01d'];
    $saldoobiayalainnya01c_xx = $b['saldo01c'];
    //
    $saldoobiayalainnya02d_xx = $b['saldo02d'];
    $saldoobiayalainnya02c_xx = $b['saldo02c'];
    //
    $saldoobiayalainnya03d_xx = $b['saldo03d'];
    $saldoobiayalainnya03c_xx = $b['saldo03c'];
    //
    $saldoobiayalainnya04d_xx = $b['saldo04d'];
    $saldoobiayalainnya04c_xx = $b['saldo04c'];
    //
    $saldoobiayalainnya05d_xx = $b['saldo05d'];
    $saldoobiayalainnya05c_xx = $b['saldo05c'];
    //
    $saldoobiayalainnya06d_xx = $b['saldo06d'];
    $saldoobiayalainnya06c_xx = $b['saldo06c'];
    //
    $saldoobiayalainnya07d_xx = $b['saldo07d'];
    $saldoobiayalainnya07c_xx = $b['saldo07c'];
    //
    $saldoobiayalainnya08d_xx = $b['saldo08d'];
    $saldoobiayalainnya08c_xx = $b['saldo08c'];
    //
    $saldoobiayalainnya09d_xx = $b['saldo09d'];
    $saldoobiayalainnya09c_xx = $b['saldo09c'];
    //
    $saldoobiayalainnya10d_xx = $b['saldo10d'];
    $saldoobiayalainnya10c_xx = $b['saldo10c'];
    //
    $saldoobiayalainnya11d_xx = $b['saldo11d'];
    $saldoobiayalainnya11c_xx = $b['saldo11c'];
    //
    $saldoobiayalainnya12d_xx = $b['saldo12d'];
    $saldoobiayalainnya12c_xx = $b['saldo12c'];
    
    
    //+$saldo09_aset+$saldo08_aset+$saldo07_aset+$saldo06_aset+$saldo05_aset+$saldo04_aset+$saldo03_aset+$saldo02_aset+$saldo01_aset
        
		if($saldoobiayalainnya_yeard_xx<>0){
            $saldo_year_biaya_lainnya_xx = $saldoobiayalainnya_yeard_xx;
        }else{
            if ($saldoobiayalainnya_yearc_xx > 0){
                $saldo_year_biaya_lainnya_xx = $saldoobiayalainnya_yearc_xx*-1;
            }else if ($saldoobiayalainnya_yearc_xx < 0){
                $saldo_year_biaya_lainnya_xx = $saldoobiayalainnya_yearc_xx;
            }else if ($saldoobiayalainnya_yearc_xx == 0){
                $saldo_year_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
        if($saldoobiayalainnya01d_xx<>0){
            $saldo01_biaya_lainnya_xx = $saldoobiayalainnya01d_xx;
        }else{
            if ($saldoobiayalainnya01c_xx > 0){
                $saldo01_biaya_lainnya_xx = $saldoobiayalainnya01c_xx*-1;
            }else if ($saldoobiayalainnya01c_xx < 0){
                $saldo01_biaya_lainnya_xx = $saldoobiayalainnya01c_xx;
            }else if ($saldoobiayalainnya01c_xx == 0){
                $saldo01_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoobiayalainnya02d_xx<>0){
            $saldo02_biaya_lainnya_xx = $saldoobiayalainnya02d_xx;
        }else{
            if ($saldoobiayalainnya02c_xx > 0){
                $saldo02_biaya_lainnya_xx = $saldoobiayalainnya02c_xx*-1;
            }else if ($saldoobiayalainnya02c_xx < 0){
                $saldo02_biaya_lainnya_xx = $saldoobiayalainnya02c_xx;
            }else if ($saldoobiayalainnya02c_xx == 0){
                $saldo02_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoobiayalainnya03d_xx<>0){
             $saldo03_biaya_lainnya_xx = $saldoobiayalainnya03d_xx;
        }else{
            if ($saldoobiayalainnya03c_xx > 0){
                $saldo03_biaya_lainnya_xx = $saldoobiayalainnya03c_xx*-1;
            }else if ($saldoobiayalainnya03c_xx < 0){
                $saldo03_biaya_lainnya_xx = $saldoobiayalainnya03c_xx;
            }else if ($saldoobiayalainnya03c_xx == 0){
                $saldo03_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoobiayalainnya04d_xx<>0){
             $saldo04_biaya_lainnya_xx = $saldoobiayalainnya04d_xx;
        }else{
            if ($saldoobiayalainnya04c_xx > 0){
                $saldo04_biaya_lainnya_xx = $saldoobiayalainnya04c_xx*-1;
            }else if ($saldoobiayalainnya04c_xx < 0){
                $saldo04_biaya_lainnya_xx = $saldoobiayalainnya04c_xx;
            }else if ($saldoobiayalainnya04c_xx == 0){
                $saldo04_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldoobiayalainnya05d_xx<>0){
             $saldo05_biaya_lainnya_xx = $saldoobiayalainnya05d_xx;
        }else{
            if ($saldoobiayalainnya05c_xx > 0){
                $saldo05_biaya_lainnya_xx = $saldoobiayalainnya05c_xx*-1;
            }else if ($saldoobiayalainnya05c_xx < 0){
                $saldo05_biaya_lainnya_xx = $saldoobiayalainnya05c_xx;
            }else if ($saldoobiayalainnya05c_xx == 0){
                $saldo05_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoobiayalainnya06d_xx<>0){
             $saldo06_biaya_lainnya_xx = $saldoobiayalainnya06d_xx;
        }else{
            if ($saldoobiayalainnya06c_xx > 0){
                $saldo06_biaya_lainnya_xx = $saldoobiayalainnya06c_xx*-1;
            }else if ($saldoobiayalainnya06c_xx < 0){
                $saldo06_biaya_lainnya_xx = $saldoobiayalainnya06c_xx;
            }else if ($saldoobiayalainnya06c_xx == 0){
                $saldo06_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
        
        if($saldoobiayalainnya07d_xx<>0){
             $saldo07_biaya_lainnya_xx = $saldoobiayalainnya07d_xx;
        }else{
            if ($saldoobiayalainnya07c_xx > 0){
                $saldo07_biaya_lainnya_xx = $saldoobiayalainnya07c_xx*-1;
            }else if ($saldoobiayalainnya07c_xx < 0){
                $saldo07_biaya_lainnya_xx = $saldoobiayalainnya07c_xx;
            }else if ($saldoobiayalainnya07c_xx == 0){
                $saldo07_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoobiayalainnya08d_xx<>0){
             $saldo08_biaya_lainnya_xx = $saldoobiayalainnya08d_xx;
        }else{
            if ($saldoobiayalainnya08c_xx > 0){
                $saldo08_biaya_lainnya_xx = $saldoobiayalainnya08c_xx*-1;
            }else if ($saldoobiayalainnya08c_xx < 0){
                $saldo08_biaya_lainnya_xx = $saldoobiayalainnya08c_xx;
            }else if ($saldoobiayalainnya08c_xx == 0){
                $saldo08_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoobiayalainnya09d_xx<>0){
             $saldo09_biaya_lainnya_xx = $saldoobiayalainnya09d_xx;
        }else{
            if ($saldoobiayalainnya09d_xx > 0){
                $saldo09_biaya_lainnya_xx = $saldoobiayalainnya09d_xx*-1;
            }else if ($saldoobiayalainnya09d_xx < 0){
                $saldo09_biaya_lainnya_xx = $saldoobiayalainnya09d_xx;
            }else if ($saldoobiayalainnya09d_xx == 0){
                $saldo09_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		
		if($saldoobiayalainnya10d_xx<>0){
             $saldo10_biaya_lainnya_xx = $saldoobiayalainnya10d_xx;
        }else{
            if ($saldoobiayalainnya10c_xx > 0){
                $saldo10_biaya_lainnya_xx = $saldoobiayalainnya10c_xx*-1;
            }else if ($saldoobiayalainnya10c_xx < 0){
                $saldo10_biaya_lainnya_xx = $saldoobiayalainnya10c_xx;
            }else if ($saldoobiayalainnya10c_xx == 0){
                $saldo10_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
		if($saldoobiayalainnya11d_xx<>0){
             $saldo11_biaya_lainnya_xx = $saldoobiayalainnya11d_xx;
        }else{
            if ($saldoobiayalainnya11c_xx > 0){
                $saldo11_biaya_lainnya_xx = $saldoobiayalainnya11c_xx*-1;
            }else if ($saldoobiayalainnya11c_xx < 0){
                $saldo11_biaya_lainnya_xx = $saldoobiayalainnya11c_xx;
            }else if ($saldoobiayalainnya11c_xx == 0){
                $saldo11_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
		
        
        if($saldoobiayalainnya12d_xx<>0){
             $saldo12_biaya_lainnya_xx = $saldoobiayalainnya12d_xx;
        }else{
            if ($saldoobiayalainnya12c_xx > 0){
                $saldo12_biaya_lainnya_xx = $saldoobiayalainnya12c_xx*-1;
            }else if ($saldoobiayalainnya12c_xx < 0){
                $saldo12_biaya_lainnya_xx = $saldoobiayalainnya12c_xx;
            }else if ($saldoobiayalainnya12c_xx == 0){
                $saldo12_biaya_lainnya_xx = 0;
            }else{
                //disini numeric value
            }
        }
    
    
        $totalbiayalainnya_x      = $saldo_year_biaya_lainnya_xx+$saldo01_biaya_lainnya_xx+$saldo02_biaya_lainnya_xx+$saldo03_biaya_lainnya_xx+$saldo04_biaya_lainnya_xx+$saldo05_biaya_lainnya_xx+$saldo06_biaya_lainnya_xx+$saldo07_biaya_lainnya_xx+$saldo08_biaya_lainnya_xx+$saldo09_biaya_lainnya_xx+$saldo10_biaya_lainnya_xx+$saldo11_biaya_lainnya_xx+$saldo12_biaya_lainnya_xx;
        $totaltb_biaya   += $totalbiayalainnya_x;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalbiayalainnya_x,0));
		
		//$saldo01_biaya_xx+$saldo02_biaya_xx+$saldo03_biaya_xx+$saldo04_biaya_xx+$saldo04_biaya_xx+$saldo05_biaya_xx+$saldo06_biaya_xx+$saldo07_biaya_xx+$saldo08_biaya_xx+$saldo09_biaya_xx+$saldo10_biaya_xx+$saldo11_biaya_xx+$saldo12_biaya_xx
		//$saldo01_biaya_xx+$saldo02_biaya_xx+$saldo03_biaya_xx+$saldo04_biaya_xx+$saldo05_biaya_xx+$saldo06_biaya_xx+$saldo07_biaya_xx+$saldo08_biaya_xx+$saldo09_biaya_xx+$saldo10_biaya_xx+$saldo11_biaya_xx+$saldo12_biaya_xx
		
		//+
		//$saldo_year_biaya_xx+$saldo01_biaya_xx+$saldo02_biaya_xx+$saldo03_biaya_xx+$saldo04_biaya_xx+$saldo05_biaya_xx+$saldo06_biaya_xx+$saldo07_biaya_xx+$saldo08_biaya_xx+$saldo09_biaya_xx+$saldo10_biaya_xx+$saldo10_biaya_xx+$saldo11_biaya_xx+$saldo12_biaya_xx;
		
    ?>
</td>
</tr>
<?php
}
}
?>
<!-- BIAYA LAINNYA -->

<?php 


//$tot_1 = ($tot_assets+$tot_assets_tidak_lancar)+($tot_kewajiban_lancar+$tot_kewajiban_tidak_lancar);
//$tot_2 = $tot_ekuitas+$tot_pendapatan+$tot_harga_pokok_penjualan+$tot_biaya_administrasi_umum+$tot_running_account+$tot_pendapatan_lainnya+$tot_biaya_lainnya;

//$tot_yeard   = ($saldo_yeard_aset_x+$year_kewajiban_x)+($year_ekuitas_x+$year_biaya_x+$yeard_pendapatan+$yeard_pendapatan_lainnya+$yeard_biaya_lainnya);
//$tot_saldo01 = $sum01_biaya_lainnya;
//$tot_saldo01 = ($saldo01_aset_x+$saldo01_kewajiban_x)+($saldo01_ekuitas_x+$saldo01_biaya_x+$saldo01_pendapatan+$saldo01_pendapatan_lainnya+$saldo01_biaya_lainnya);
//$tot_saldo02 = ($saldo02_aset_x+$saldo02_kewajiban_x)+($saldo02_ekuitas_x+$saldo02_biaya_x+$saldo02_pendapatan+$saldo02_pendapatan_lainnya+$saldo02_biaya_lainnya);
//$tot_saldo03 = ($saldo03_aset_x+$saldo03_kewajiban_x)+($saldo03_ekuitas_x+$saldo03_biaya_x+$saldo03_pendapatan+$saldo03_pendapatan_lainnya+$saldo03_biaya_lainnya);
//$tot_saldo04 = ($saldo04_aset_x+$saldo04_kewajiban_x)+($saldo04_ekuitas_x+$saldo04_biaya_x+$saldo04_pendapatan+$saldo04_pendapatan_lainnya+$saldo04_biaya_lainnya);
//$tot_saldo05 = ($saldo05_aset_x+$saldo05_kewajiban_x)+($saldo05_ekuitas_x+$saldo05_biaya_x+$saldo05_pendapatan+$saldo05_pendapatan_lainnya+$saldo05_biaya_lainnya);
//$tot_saldo06 = ($saldo06_aset_x+$saldo06_kewajiban_x)+($saldo06_ekuitas_x+$saldo06_biaya_x+$saldo06_pendapatan+$saldo06_pendapatan_lainnya+$saldo06_biaya_lainnya);
//$tot_saldo07 = ($saldo07_aset_x+$saldo07_kewajiban_x)+($saldo07_ekuitas_x+$saldo07_biaya_x+$saldo07_pendapatan+$saldo07_pendapatan_lainnya+$saldo07_biaya_lainnya);
//$tot_saldo08 = ($saldo08_aset_x+$saldo08_kewajiban_x)+($saldo08_ekuitas_x+$saldo08_biaya_x+$saldo08_pendapatan+$saldo08_pendapatan_lainnya+$saldo08_biaya_lainnya);
//$tot_saldo09 = ($saldo09_aset_x+$saldo09_kewajiban_x)+($saldo09_ekuitas_x+$saldo09_biaya_x+$saldo09_pendapatan+$saldo09_pendapatan_lainnya+$saldo09_biaya_lainnya);
//$tot_saldo10 = ($saldo10_aset_x+$saldo10_kewajiban_x)+($saldo10_ekuitas_x+$saldo10_biaya_x+$saldo10_pendapatan+$saldo10_pendapatan_lainnya+$saldo10_biaya_lainnya);
//$tot_saldo11 = ($saldo11_aset_x+$saldo11_kewajiban_x)+($saldo11_ekuitas_x+$saldo11_biaya_x+$saldo11_pendapatan+$saldo11_pendapatan_lainnya+$saldo11_biaya_lainnya);
//$tot_saldo12 = ($saldo12_aset_x+$saldo12_kewajiban_x)+($saldo12_ekuitas_x+$saldo12_biaya_x+$saldo12_pendapatan+$saldo12_pendapatan_lainnya+$saldo12_biaya_lainnya);
//$tot_total   = ($totaltb_aset+$totaltb_kewajiban)+($totaltb_capital+$totaltb_biaya+$totaltb_pendapatan+$totaltb_pendapatan_lainnya+$totaltb_biaya_lainnya);
//echo  'aset :'.$saldo01_aset_x.' - kwajiban :'.$saldo01_kewajiban_x.' - ekuitas:'.$saldo01_ekuitas_x.' - biaya:'.$saldo01_biaya_x.' - pendapatan:'.$saldo01_pendapatan.' - pendapatan lainnya:'.$saldo01_pendapatan_lainnya_x.' - biaya lainnya:'.$saldo01_biaya_lainnya;
//$tot_saldo01_g = ($saldo01_aset_g+$saldo01_kewajiban_g)+($saldo01_ekuitas_g+$saldo01_biaya_g+$saldo01_pendapatan_g+$saldo01_pendapatan_lainnya_g+$saldo01biaya_lainnya_g);
//$tot_saldo02_g = $saldo02biaya_lainnya_g;


$tot_sum_01 = ($sum01_aset+$sum01_kewajiban)+($sum01_ekuitas+$sum01_biaya+$sum01_pendapatan_lainnya+$sum01_pendapatan+$sum01_biaya_lainnya);


?>


 <!-- GRAND TOTAL -->   
<tr>
<td colspan="2" align="right">&nbsp;Saldo Balance</td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_yeard,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_sum_01,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo02_g,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo03,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo04,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo05,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo06,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo07,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo08,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo09,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo10,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo11,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo12,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_total,0));?></td>
<!-- GRAND TOTAL -->
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
                     