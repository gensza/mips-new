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

foreach($data_list_assets as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
    
if($b['level'] == 1 && $b['type'] == 'G'){
    $bolds = 'font-weight:bold';
    
    if($b['saldo01d']<>0){
        $saldo01_aset_g += $b['saldo01d']; 
    }else{
        $sal01 = $b['saldo01c']*-1;
        $saldo01_aset_g += $sal01;
    }
    
    if($b['saldo02d']<>0){
        $saldo02_aset_g = $b['saldo02d'];
    }else{
        $sal1_xx = $b['saldo02c']*-1;
        $saldo02_aset_g = $sal1_xx;
    }

    if($b['saldo03d']<>0){
        $saldo03_aset_g = $b['saldo03d'];
    }else{
        $sal1_xx = $b['saldo03c']*-1;
        $saldo03_aset_g = $sal1_xx;
    }

    if($b['saldo04d']<>0){
        $saldo04_aset_g = $b['saldo04d'];
    }else{
        $sal1_xx = $b['saldo04c']*-1;
        $saldo04_aset_g = $sal1_xx;
    }

    if($b['saldo05d']<>0){
        $saldo05_aset_g = $b['saldo05d'];
    }else{
        $sal1_xx = $b['saldo05c']*-1;
        $saldo05_aset_g = $sal1_xx;
    }

    if($b['saldo06d']<>0){
        $saldo06_aset_g = $b['saldo06d'];
    }else{
        $sal1_xx = $b['saldo06c']*-1;
        $saldo06_aset_g = $sal1_xx;
    }

    if($b['saldo07d']<>0){
        $saldo07_aset_g = $b['saldo07d'];
    }else{
        $sal1_xx = $b['saldo07c']*-1;
        $saldo07_aset_g = $sal1_xx;
    }

    if($b['saldo08d']<>0){
        $saldo08_aset_g = $b['saldo08d'];
    }else{
        $sal1_xx = $b['saldo08c']*-1;
        $saldo08_aset_g = $sal1_xx;
    }

    if($b['saldo09d']<>0){
        $saldo09_aset_g = $b['saldo09d'];
    }else{
        $sal1_xx = $b['saldo09c']*-1;
        $saldo09_aset_g = $sal1_xx;
    }

    if($b['saldo10d']<>0){
        $saldo10_aset_g = $b['saldo10d'];
    }else{
        $sal10 = $b['saldo10c']*-1;
        $saldo10_aset_g = $sal10;
    }

    if($b['saldo11d']<>0){
        $saldo11_aset_g = $b['saldo11d'];
    }else{
        $sal10 = $b['saldo11c']*-1;
        $saldo11_aset_g = $sal10;
    }

    if($b['saldo12d']<>0){
        $saldo12_aset_g = $b['saldo12d'];
    }else{
        $sal10 = $b['saldo12c']*-1;
        $saldo12_aset_g = $sal10;
    }
    
}else{
    $bolds = '';
}    
    
if($group_n == 'Asset'){

?>
<tr>
    <td align="center" width="10%" style="<?php echo $bolds;?>">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;<?php echo $bolds;?>"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
        if($b['yeard'] <> 0){
            $saldo_yeard_aset_x += $b['yeard'];
            $saldo_yeard_aset = $b['yeard'];
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            echo $ubahformat;
        }else{
            $nilais = $b['yeard']*-1;
            $saldo_yeard_aset_x += $nilais;
            $saldo_yeard_aset = $nilais;
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilais,0));
            echo $ubahformat;
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo01d']<>0){
        echo number_format($b['saldo01d'],0);
        $saldo01_aset_x += $b['saldo01d']; 
        $saldo01_aset = $b['saldo01d']; 
    }else{
        $sal01 = $b['saldo01c']*-1;
        $saldo01_aset_x += $sal01;
        $saldo01_aset = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo02d']<>0){
        echo number_format($b['saldo02d'],0);
        $saldo02_aset_x += $b['saldo02d'];
        $saldo02_aset    = $b['saldo02d'];
    }else{
        $sal02 = $b['saldo02c']*-1;
        $saldo02_aset_x += $sal02;
        $saldo02_aset = $sal02;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal02,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo03d']<>0){
        $saldo03_aset_x += $b['saldo03d'];
        $saldo03_aset = $b['saldo03d'];
        echo number_format($b['saldo03d'],0);
    }else{
        $sal03 = $b['saldo03c']*-1;
        $saldo03_aset_x += $sal03;
        $saldo03_aset    = $sal03;
        $ubahformat      = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal03,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo04d']<>0){
        $saldo04_aset_x += $b['saldo04d'];
        $saldo04_aset    = $b['saldo04d'];
        echo number_format($b['saldo04d'],0);
    }else{
        $sal04 = $b['saldo04c']*-1;
        $saldo04_aset_x += $sal04;
        $saldo04_aset = $sal04;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal04,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo05d']<>0){
        $saldo05_aset_x += $b['saldo05d'];
        $saldo05_aset    = $b['saldo05d'];
        echo number_format($b['saldo05d'],0);
    }else{
        $sal05 = $b['saldo05c']*-1;
        $saldo05_aset_x += $sal05;
        $saldo05_aset = $sal05;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal05,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo06d']<>0){
        $saldo06_aset_x += $b['saldo06d'];
        $saldo06_aset = $b['saldo06d'];
        echo number_format($b['saldo06d'],0);
    }else{
        $sal06 = $b['saldo06c']*-1;
        $saldo06_aset_x += $sal06;
        $saldo06_aset = $sal06;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal06,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo07d']<>0){
        $saldo07_aset_x += $b['saldo07d'];
        $saldo07_aset = $b['saldo07d'];
        echo number_format($b['saldo07d'],0);
    }else{
        $sal07 = $b['saldo07c']*-1;
        $saldo07_aset_x += $sal07;
        $saldo07_aset = $sal07;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal07,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo08d']<>0){
        $saldo08_aset_x += $b['saldo08d'];
        $saldo08_aset = $b['saldo08d'];
        echo number_format($b['saldo08d'],0);
    }else{
        $sal08 = $b['saldo08c']*-1;
        $saldo08_aset_x += $sal08;
        $saldo08_aset = $sal08;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal08,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo09d']<>0){
        $saldo09_aset_x += $b['saldo09d'];
        $saldo09_aset = $b['saldo09d'];
        echo number_format($b['saldo09d'],0);
    }else{
        $sal09 = $b['saldo09c']*-1;
        $saldo09_aset_x +=$sal09;
        $saldo09_aset =$sal09;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal09,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo10d']<>0){
        $saldo10_aset_x += $b['saldo10d'];
        $saldo10_aset = $b['saldo10d'];
        echo number_format($b['saldo10d'],0);
    }else{
        $sal10 = $b['saldo10c']*-1;
        $saldo10_aset_x += $sal10;
        $saldo10_aset = $sal10;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($saldo10_aset,0));
        //echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo11d']<>0){
        $saldo11_aset_x += $b['saldo11d'];
        $saldo11_aset    = $b['saldo11d'];
        echo number_format($b['saldo11d'],0);
    }else{
        $sal11 = $b['saldo11c']*-1;
        $saldo05_aset_x += $sal11;
        $saldo05_aset = $sal11;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal11,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    if($b['saldo12d']<>0){
        $saldo12_aset_x += $b['saldo12d'];
        $saldo12_aset = $b['saldo12d'];
        echo number_format($b['saldo12d'],0);
    }else{
        $sal12 = $b['saldo12c']*-1;
        $saldo12_aset_x +=$sal12;
        $saldo12_aset = $sal12;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal12,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bolds;?>">
    <?php 
    //+$saldo09_aset+$saldo08_aset+$saldo07_aset+$saldo06_aset+$saldo05_aset+$saldo04_aset+$saldo03_aset+$saldo02_aset+$saldo01_aset
        
//        if($b['yeard'] <> 0){
//            $saldo_yeard_aset_xx = $b['yeard'];
//        }else{
//            $nilais = $b['yeard']*-1;
//            $saldo_yeard_aset_xx = $nilais;
//        }
    
        if($b['saldo01d']<>0){
            $saldo01_aset_xx = $b['saldo01d'];
        }else{
            $sal1_xx = $b['saldo01c']*-1;
            $saldo01_aset_xx = $sal1_xx;
        }
        
        if($b['saldo02d']<>0){
            $saldo02_aset_xx = $b['saldo02d'];
        }else{
            $sal1_xx = $b['saldo02c']*-1;
            $saldo02_aset_xx = $sal1_xx;
        }
        
        if($b['saldo03d']<>0){
            $saldo03_aset_xx = $b['saldo03d'];
        }else{
            $sal1_xx = $b['saldo03c']*-1;
            $saldo03_aset_xx = $sal1_xx;
        }
        
        if($b['saldo04d']<>0){
            $saldo04_aset_xx = $b['saldo04d'];
        }else{
            $sal1_xx = $b['saldo04c']*-1;
            $saldo04_aset_xx = $sal1_xx;
        }
        
        if($b['saldo05d']<>0){
            $saldo05_aset_xx = $b['saldo05d'];
        }else{
            $sal1_xx = $b['saldo05c']*-1;
            $saldo05_aset_xx = $sal1_xx;
        }
        
        if($b['saldo06d']<>0){
            $saldo06_aset_xx = $b['saldo06d'];
        }else{
            $sal1_xx = $b['saldo06c']*-1;
            $saldo06_aset_xx = $sal1_xx;
        }
        
        if($b['saldo07d']<>0){
            $saldo07_aset_xx = $b['saldo07d'];
        }else{
            $sal1_xx = $b['saldo07c']*-1;
            $saldo07_aset_xx = $sal1_xx;
        }
        
        if($b['saldo08d']<>0){
            $saldo08_aset_xx = $b['saldo08d'];
        }else{
            $sal1_xx = $b['saldo08c']*-1;
            $saldo08_aset_xx = $sal1_xx;
        }
        
        if($b['saldo09d']<>0){
            $saldo09_aset_xx = $b['saldo09d'];
        }else{
            $sal1_xx = $b['saldo09c']*-1;
            $saldo09_aset_xx = $sal1_xx;
        }
    
        if($b['saldo10d']<>0){
            $saldo10_aset_xx = $b['saldo10d'];
        }else{
            $sal10 = $b['saldo10c']*-1;
            $saldo10_aset_xx = $sal10;
        }
        
        if($b['saldo11d']<>0){
            $saldo11_aset_xx = $b['saldo11d'];
        }else{
            $sal10 = $b['saldo11c']*-1;
            $saldo11_aset_xx = $sal10;
        }
        
        if($b['saldo12d']<>0){
            $saldo12_aset_xx = $b['saldo12d'];
        }else{
            $sal10 = $b['saldo12c']*-1;
            $saldo12_aset_xx = $sal10;
        }
    
    
        $totalaset      = $saldo01_aset_xx+$saldo02_aset_xx+$saldo03_aset_xx+$saldo04_aset_xx+$saldo05_aset_xx+$saldo06_aset_xx+$saldo07_aset_xx+$saldo08_aset_xx+$saldo09_aset_xx+$saldo10_aset_xx+$saldo11_aset_xx+$saldo12_aset_xx;
        $totaltb_aset   += $totalaset;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalaset,0));
       // var_dump("aset 12 :".$saldo12_aset." | aset 11 :".$saldo11_aset." | aset 10 :".$saldo10_aset_xx);
    ?>
</td>

</tr>
<?php
}
}
?>
<!-- ASSETS -->


<!-- EKUITAS -->
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
    
?>
<tr>
<td align="center" width="10%">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
        if($b['yeard'] <> 0){
            //echo number_format($b['yeard'],0);
            $year_ekuitas_x += $ubahformat;
            $year_ekuitas = $ubahformat;
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            echo $ubahformat;
        }else{
            $nilais = $b['yeard']*-1;
            $year_ekuitas_x += $nilais;
            $year_ekuitas = $nilais;
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilais,0));
            echo $ubahformat;
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo01d']<>0){
        echo number_format($b['saldo01d'],0);
        $saldo01_ekuitas_x += $b['saldo01d'];
        $saldo01_ekuitas = $b['saldo01d'];
    }else{
        $sal01 = $b['saldo01c']*-1;
        $saldo01_ekuitas_x += $sal01;
        $saldo01_ekuitas    = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo02d']<>0){
        echo number_format($b['saldo02d'],0);
        $saldo02_ekuitas_x += $b['saldo02d'];
        $saldo02_ekuitas = $b['saldo02d'];
    }else{
        $sal01 = $b['saldo02c']*-1;
        $saldo02_ekuitas_x += $sal01;
        $saldo02_ekuitas = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo03d']<>0){
        echo number_format($b['saldo03d'],0);
        $saldo03_ekuitas_x += $b['saldo03d'];
        $saldo03_ekuitas = $b['saldo03d'];
    }else{
        $sal01 = $b['saldo03c']*-1;
        $saldo03_ekuitas_x += $sal01;
        $saldo03_ekuitas = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo04d']<>0){
        echo number_format($b['saldo04d'],0);
        $saldo04_ekuitas_x += $b['saldo04d'];
        $saldo04_ekuitas = $b['saldo04d'];
    }else{
        $sal01 = $b['saldo04c']*-1;
        $saldo04_ekuitas_x += $sal01;
        $saldo04_ekuitas = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo05d']<>0){
        echo number_format($b['saldo05d'],0);
        $saldo05_ekuitas_x += $b['saldo05d'];
        $saldo05_ekuitas = $b['saldo05d'];
    }else{
        $sal01 = $b['saldo05c']*-1;
        $saldo05_ekuitas_x += $sal01;
        $saldo05_ekuitas = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo06d']<>0){
        echo number_format($b['saldo06d'],0);
        $saldo06_ekuitas_x += $b['saldo06d'];
        $saldo06_ekuitas = $b['saldo06d'];
    }else{
        $sal01 = $b['saldo06c']*-1;
        $saldo06_ekuitas_x += $sal01;
        $saldo06_ekuitas = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo07d']<>0){
        echo number_format($b['saldo07d'],0);
        $saldo07_ekuitas_x += $b['saldo07d'];
        $saldo07_ekuitas = $b['saldo07d'];
    }else{
        $sal01 = $b['saldo07c']*-1;
        $saldo07_ekuitas_x += $sal01;
        $saldo07_ekuitas = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo08d']<>0){
        echo number_format($b['saldo08d'],0);
        $saldo08_ekuitas_x += $b['saldo08d'];
        $saldo08_ekuitas = $b['saldo08d'];
    }else{
        $sal01 = $b['saldo08c']*-1;
        $saldo08_ekuitas_x += $sal01;
        $saldo08_ekuitas = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo09d']<>0){
        echo number_format($b['saldo09d'],0);
        $saldo09_ekuitas_x += $b['saldo09d'];
        $saldo09_ekuitas = $b['saldo09d'];
    }else{
        $sal01 = $b['saldo09c']*-1;
        $saldo09_ekuitas_x += $sal01;
        $saldo09_ekuitas = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo10d']<>0){
        echo number_format($b['saldo10d'],0);
        $saldo10_ekuitas_x += $b['saldo10d'];
        $saldo10_ekuitas = $b['saldo10d'];
    }else{
        $sal01 = $b['saldo10c']*-1;
        $saldo10_ekuitas_x += $sal01;
        $saldo10_ekuitas = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo11d']<>0){
        echo number_format($b['saldo11d'],0);
        $saldo11_ekuitas_x += $b['saldo11d'];
        $saldo11_ekuitas = $b['saldo11d'];
    }else{
        $sal01 = $b['saldo11c']*-1;
        $saldo11_ekuitas_x += $sal01;
        $saldo11_ekuitas = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    if($b['saldo12d']<>0){
        echo number_format($b['saldo12d'],0);
        $saldo12_ekuitas_x += $b['saldo12d'];
        $saldo12_ekuitas = $b['saldo12d'];
    }else{
        $sal01 = $b['saldo12c']*-1;
        $saldo12_ekuitas_x += $sal01;
        $saldo12_ekuitas = $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_cap;?>">
    <?php 
    
        if($b['saldo01d']<>0){
            $saldo01_ekuitas_xx = $b['saldo01d'];
        }else{
            $sal1_xx = $b['saldo01c']*-1;
            $saldo01_ekuitas_xx = $sal1_xx;
        }
        
        if($b['saldo02d']<>0){
            $saldo02_ekuitas_xx = $b['saldo02d'];
        }else{
            $sal1_xx = $b['saldo02c']*-1;
            $saldo02_ekuitas_xx = $sal1_xx;
        }
        
        if($b['saldo03d']<>0){
            $saldo03_ekuitas_xx = $b['saldo03d'];
        }else{
            $sal1_xx = $b['saldo03c']*-1;
            $saldo03_ekuitas_xx = $sal1_xx;
        }
        
        if($b['saldo04d']<>0){
            $saldo04_ekuitas_xx = $b['saldo04d'];
        }else{
            $sal1_xx = $b['saldo04c']*-1;
            $saldo04_ekuitas_xx = $sal1_xx;
        }
        
        if($b['saldo05d']<>0){
            $saldo05_ekuitas_xx = $b['saldo05d'];
        }else{
            $sal1_xx = $b['saldo05c']*-1;
            $saldo05_ekuitas_xx = $sal1_xx;
        }
        
        if($b['saldo06d']<>0){
            $saldo06_ekuitas_xx = $b['saldo06d'];
        }else{
            $sal1_xx = $b['saldo06c']*-1;
            $saldo06_ekuitas_xx = $sal1_xx;
        }
        
        if($b['saldo07d']<>0){
            $saldo07_ekuitas_xx = $b['saldo07d'];
        }else{
            $sal1_xx = $b['saldo07c']*-1;
            $saldo07_ekuitas_xx = $sal1_xx;
        }
        
        if($b['saldo08d']<>0){
            $saldo08_ekuitas_xx = $b['saldo08d'];
        }else{
            $sal1_xx = $b['saldo08c']*-1;
            $saldo08_ekuitas_xx = $sal1_xx;
        }
        
        if($b['saldo09d']<>0){
            $saldo09_ekuitas_xx = $b['saldo09d'];
        }else{
            $sal1_xx = $b['saldo09c']*-1;
            $saldo09_ekuitas_xx = $sal1_xx;
        }
    
        if($b['saldo10d']<>0){
            $saldo10_ekuitas_xx = $b['saldo10d'];
        }else{
            $sal10 = $b['saldo10c']*-1;
            $saldo10_ekuitas_xx = $sal10;
        }
        
        if($b['saldo11d']<>0){
            $saldo11_ekuitas_xx = $b['saldo11d'];
        }else{
            $sal10 = $b['saldo11c']*-1;
            $saldo11_ekuitas_xx = $sal10;
        }
        
        if($b['saldo12d']<>0){
            $saldo12_ekuitas_xx = $b['saldo12d'];
        }else{
            $sal10 = $b['saldo12c']*-1;
            $saldo12_ekuitas_xx = $sal10;
        }
    
        $totalekuitas = $saldo01_ekuitas_xx+$saldo02_ekuitas_xx+$saldo03_ekuitas_xx+$saldo04_ekuitas_xx+$saldo05_ekuitas_xx+$saldo06_ekuitas_xx+$saldo07_ekuitas_xx+$saldo08_ekuitas_xx+$saldo09_ekuitas_xx+$saldo10_ekuitas_xx+$saldo11_ekuitas_xx+$saldo12_ekuitas_xx;
        $totaltb_ekuitas += $totalekuitas;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalekuitas,0));
        //$total_ekuitas = $saldo01_ekuitas+$saldo02_ekuitas+$saldo03_ekuitas+$saldo04_ekuitas+$saldo05_ekuitas+$saldo06_ekuitas+$saldo07_ekuitas+$saldo08_ekuitas+$saldo09_ekuitas+$saldo10_ekuitas+$saldo11_ekuitas+$saldo12_ekuitas;
        //echo  preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($total_ekuitas,0));
        
    ?>
</td>

</tr>
<?php
}
}
?>
<!-- EKUITAS -->



<!-- BIAYA -->
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
    
?>
<tr>
<td align="center" width="10%">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
        if($b['yeard'] <> 0){
            //echo number_format($b['yeard'],0);
            
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            $year_biaya += $ubahformat;
            echo $ubahformat;
        }else{
            $nilais = $b['yeard']*-1;
            $year_biaya += $nilais;
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilais,0));
            echo $ubahformat;
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo01d']<>0){
        $saldo01_biaya = $b['saldo01d'];
        $saldo01_biaya_x += $b['saldo01d'];
        echo number_format($b['saldo01d'],0);
    }else{
        $sal01 = $b['saldo01c']*-1;
        $saldo01_biaya = $sal01;
        $saldo01_biaya_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo02d']<>0){
        $saldo02_biaya = $b['saldo02d'];
        $saldo02_biaya_x += $b['saldo02d'];
        echo number_format($b['saldo02d'],0);
    }else{
        $sal01 = $b['saldo02c']*-1;
        $saldo02_biaya = $sal01;
        $saldo02_biaya_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo03d']<>0){
        $saldo03_biaya = $b['saldo03d'];
        $saldo03_biaya_x += $b['saldo03d'];
        echo number_format($b['saldo03d'],0);
    }else{
        $sal01 = $b['saldo03c']*-1;
        $saldo03_biaya = $sal01;
        $saldo03_biaya_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo04d']<>0){
        $saldo04_biaya = $b['saldo04d'];
        echo number_format($b['saldo04d'],0);
        $saldo04_biaya_x += $b['saldo04d'];
    }else{
        $sal01 = $b['saldo04c']*-1;
        $saldo04_biaya = $sal01;
        $saldo04_biaya_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo05d']<>0){
        $saldo05_biaya = $b['saldo05d'];
        $saldo05_biaya_x += $b['saldo05d'];
        echo number_format($b['saldo05d'],0);
    }else{
        $sal01 = $b['saldo05c']*-1;
        $saldo05_biaya = $sal01;
        $saldo05_biaya_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo06d']<>0){
        $saldo06_biaya = $b['saldo06d'];
        $saldo06_biaya_x += $b['saldo06d'];
        echo number_format($b['saldo06d'],0);
    }else{
        $sal01 = $b['saldo06c']*-1;
        $saldo06_biaya = $sal01;
        $saldo06_biaya_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo07d']<>0){
        $saldo07_biaya = $b['saldo07d'];
        $saldo07_biaya_x += $b['saldo07d'];
        echo number_format($b['saldo07d'],0);
    }else{
        $sal01 = $b['saldo07c']*-1;
        $saldo07_biaya = $sal01;
        $saldo07_biaya_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo08d']<>0){
        $saldo08_biaya = $b['saldo08d'];
        $saldo08_biaya_x += $b['saldo08d'];
        echo number_format($b['saldo08d'],0);
    }else{
        $sal01 = $b['saldo08c']*-1;
        $saldo08_biaya = $sal01;
        $saldo08_biaya_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo09d']<>0){
        $saldo09_biaya = $b['saldo09d'];
        $saldo09_biaya_x += $b['saldo09d'];
        echo number_format($b['saldo09d'],0);
    }else{
        $sal01 = $b['saldo09c']*-1;
        $saldo09_biaya = $sal01;
        $saldo09_biaya_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo10d']<>0){
        $saldo10_biaya = $b['saldo10d'];
        $saldo10_biaya_x += $b['saldo10d'];
        echo number_format($b['saldo10d'],0);
    }else{
        $sal01 = $b['saldo10c']*-1;
        $saldo10_biaya = $b['saldo10d'];
        $saldo10_biaya_x += $b['saldo10d'];
       $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo11d']<>0){
        $saldo11_biaya = $b['saldo11d'];
        $saldo11_biaya_x += $b['saldo11d'];
        echo number_format($b['saldo11d'],0);
    }else{
        $sal01 = $b['saldo11c']*-1;
        $saldo11_biaya = $sal01;
        $saldo11_biaya_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    if($b['saldo12d']<>0){
        $saldo12_biaya = $b['saldo12d'];
        $saldo12_biaya_x += $b['saldo12d'];
        echo number_format($b['saldo12d'],0);
    }else{
        $sal01 = $b['saldo12c']*-1;
        $saldo12_biaya = $sal01;
        $saldo12_biaya_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_exp;?>">
    <?php 
    
        if($b['saldo01d']<>0){
            $saldo01_biaya_xx = $b['saldo01d'];
        }else{
            $sal1_xx = $b['saldo01c']*-1;
            $saldo01_biaya_xx = $sal1_xx;
        }
        
        if($b['saldo02d']<>0){
            $saldo02_biaya_xx = $b['saldo02d'];
        }else{
            $sal1_xx = $b['saldo02c']*-1;
            $saldo02_biaya_xx = $sal1_xx;
        }
        
        if($b['saldo03d']<>0){
            $saldo03_biaya_xx = $b['saldo03d'];
        }else{
            $sal1_xx = $b['saldo03c']*-1;
            $saldo03_biaya_xx = $sal1_xx;
        }
        
        if($b['saldo04d']<>0){
            $saldo04_biaya_xx = $b['saldo04d'];
        }else{
            $sal1_xx = $b['saldo04c']*-1;
            $saldo04_biaya_xx = $sal1_xx;
        }
        
        if($b['saldo05d']<>0){
            $saldo05_biaya_xx = $b['saldo05d'];
        }else{
            $sal1_xx = $b['saldo05c']*-1;
            $saldo05_biaya_xx = $sal1_xx;
        }
        
        if($b['saldo06d']<>0){
            $saldo06_biaya_xx = $b['saldo06d'];
        }else{
            $sal1_xx = $b['saldo06c']*-1;
            $saldo06_biaya_xx = $sal1_xx;
        }
        
        if($b['saldo07d']<>0){
            $saldo07_biaya_xx = $b['saldo07d'];
        }else{
            $sal1_xx = $b['saldo07c']*-1;
            $saldo07_biaya_xx = $sal1_xx;
        }
        
        if($b['saldo08d']<>0){
            $saldo08_biaya_xx = $b['saldo08d'];
        }else{
            $sal1_xx = $b['saldo08c']*-1;
            $saldo08_biaya_xx = $sal1_xx;
        }
        
        if($b['saldo09d']<>0){
            $saldo09_biaya_xx = $b['saldo09d'];
        }else{
            $sal1_xx = $b['saldo09c']*-1;
            $saldo09_biaya_xx = $sal1_xx;
        }
    
        if($b['saldo10d']<>0){
            $saldo10_biaya_xx = $b['saldo10d'];
        }else{
            $sal10 = $b['saldo10c']*-1;
            $saldo10_biaya_xx = $sal10;
        }
        
        if($b['saldo11d']<>0){
            $saldo11_biaya_xx = $b['saldo11d'];
        }else{
            $sal10 = $b['saldo11c']*-1;
            $saldo11_biaya_xx = $sal10;
        }
        
        if($b['saldo12d']<>0){
            $saldo12_biaya_xx = $b['saldo12d'];
        }else{
            $sal10 = $b['saldo12c']*-1;
            $saldo12_biaya_xx = $sal10;
        }
    
        $totalbiaya = $saldo01_biaya_xx+$saldo02_biaya_xx+$saldo03_biaya_xx+$saldo04_biaya_xx+$saldo05_biaya_xx+$saldo06_biaya_xx+$saldo07_biaya_xx+$saldo08_biaya_xx+$saldo09_biaya_xx+$saldo10_biaya_xx+$saldo11_biaya_xx+$saldo12_biaya_xx;
        $totaltb_biaya +=$totalbiaya;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalbiaya,0));
    
    
        //$total_biaya = $saldo01_biaya+$saldo02_biaya+$saldo03_biaya+$saldo04_biaya+$saldo05_biaya+$saldo06_biaya+$saldo07_biaya+$saldo08_biaya+$saldo09_biaya+$saldo10_biaya+$saldo11_biaya+$saldo12_biaya;
        //echo  preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($total_biaya,0));
    ?>
</td>


</tr>
<?php 
}
}
?>
<!-- BIAYA -->




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
    
    
?>
<tr>
<td align="center" width="10%" style="<?php echo $bold_liab;?>">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;<?php echo $bold_liab;?>"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
        if($b['yeard'] <> 0){
            //echo number_format($b['yeard'],0);
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            $year_kewajiban_x += $b['yeard'];
            echo $ubahformat;
        }else{
            $nilais = $b['yeard']*-1;
            $year_kewajiban_x += $nilais;
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilais,0));
            echo $ubahformat;
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo01d']<>0){
        $saldo01_kewajiban = $b['saldo01d'];
        $saldo01_kewajiban_x += $b['saldo01d'];
        echo number_format($b['saldo01d'],0);
    }else{
        $sal01 = $b['saldo01c']*-1;
        $saldo01_kewajiban = $sal01;
        $saldo01_kewajiban_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo02d']<>0){
        $saldo02_kewajiban = $b['saldo02d'];
        $saldo02_kewajiban_x += $b['saldo02d'];
        echo number_format($b['saldo02d'],0);
    }else{
        $sal01 = $b['saldo02c']*-1;
        $saldo02_kewajiban = $sal01;
        $saldo02_kewajiban_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo03d']<>0){
        $saldo03_kewajiban = $b['saldo03d'];
        $saldo03_kewajiban_x += $b['saldo03d'];
        echo number_format($b['saldo03d'],0);
    }else{
        $sal01 = $b['saldo03c']*-1;
        $saldo03_kewajiban = $sal01;
        $saldo03_kewajiban_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo04d']<>0){
        $saldo04_kewajiban = $b['saldo04d'];
        $saldo04_kewajiban_x += $b['saldo04d'];
        echo number_format($b['saldo04d'],0);
    }else{
        $sal01 = $b['saldo04c']*-1;
        $saldo04_kewajiban = $sal01;
        $saldo04_kewajiban_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo05d']<>0){
        $saldo05_kewajiban = $b['saldo05d'];
        $saldo05_kewajiban_x += $b['saldo05d'];
        echo number_format($b['saldo05d'],0);
    }else{
        $sal01 = $b['saldo05c']*-1;
        $saldo05_kewajiban = $sal01;
        $saldo05_kewajiban_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo06d']<>0){
        $saldo06_kewajiban = $b['saldo06d'];
        $saldo06_kewajiban_x += $b['saldo06d'];
        echo number_format($b['saldo06d'],0);
    }else{
        $sal01 = $b['saldo06c']*-1;
        $saldo06_kewajiban = $sal01;
        $saldo06_kewajiban_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo07d']<>0){
        $saldo07_kewajiban = $b['saldo07d'];
        $saldo07_kewajiban_x += $b['saldo07d'];
        echo number_format($b['saldo07d'],0);
    }else{
        $sal01 = $b['saldo07c']*-1;
        $saldo07_kewajiban = $sal01;
        $saldo07_kewajiban_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo08d']<>0){
        $saldo08_kewajiban = $b['saldo08d'];
        $saldo08_kewajiban_x += $b['saldo08d'];
        echo number_format($b['saldo08d'],0);
    }else{
        $sal01 = $b['saldo08c']*-1;
        $saldo08_kewajiban = $sal01;
        $saldo08_kewajiban_x += $sal01;
       $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo09d']<>0){
        $saldo09_kewajiban = $b['saldo09d'];
        $saldo09_kewajiban_x += $b['saldo09d'];
        echo number_format($b['saldo09d'],0);
    }else{
        $sal01 = $b['saldo09c']*-1;
        $saldo09_kewajiban = $sal01;
        $saldo09_kewajiban_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo10d']<>0){
        $saldo10_kewajiban = $b['saldo10d'];
        $saldo10_kewajiban_x += $b['saldo10d'];
        echo number_format($b['saldo10d'],0);
    }else{
        $sal01 = $b['saldo10c']*-1;
        $saldo11_kewajiban = $sal01;
        $saldo11_kewajiban_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo11d']<>0){
        $saldo11_kewajiban = $b['saldo11d'];
        $saldo11_kewajiban_x += $b['saldo11d'];
        echo number_format($b['saldo11d'],0);
    }else{
        $sal01 = $b['saldo11c']*-1;
        $saldo11_kewajiban = $sal01;
        $saldo11_kewajiban_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo12d']<>0){
        $saldo12_kewajiban = $b['saldo12d'];
        $saldo12_kewajiban_x += $b['saldo12d'];
        echo number_format($b['saldo12d'],0);
    }else{
        $sal01 = $b['saldo12c']*-1;
        $saldo12_kewajiban = $sal01;
        $saldo12_kewajiban_x += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php
    
        if($b['saldo01d']<>0){
            $saldo01_kewajiban_xx = $b['saldo01d'];
        }else{
            $sal1_xx = $b['saldo01c']*-1;
            $saldo01_kewajiban_xx = $sal1_xx;
        }
        
        if($b['saldo02d']<>0){
            $saldo02_kewajiban_xx = $b['saldo02d'];
        }else{
            $sal1_xx = $b['saldo02c']*-1;
            $saldo02_kewajiban_xx = $sal1_xx;
        }
        
        if($b['saldo03d']<>0){
            $saldo03_kewajiban_xx = $b['saldo03d'];
        }else{
            $sal1_xx = $b['saldo03c']*-1;
            $saldo03_kewajiban_xx = $sal1_xx;
        }
        
        if($b['saldo04d']<>0){
            $saldo04_kewajiban_xx = $b['saldo04d'];
        }else{
            $sal1_xx = $b['saldo04c']*-1;
            $saldo04_kewajiban_xx = $sal1_xx;
        }
        
        if($b['saldo05d']<>0){
            $saldo05_kewajiban_xx = $b['saldo05d'];
        }else{
            $sal1_xx = $b['saldo05c']*-1;
            $saldo05_kewajiban_xx = $sal1_xx;
        }
        
        if($b['saldo06d']<>0){
            $saldo06_kewajiban_xx = $b['saldo06d'];
        }else{
            $sal1_xx = $b['saldo06c']*-1;
            $saldo06_kewajiban_xx = $sal1_xx;
        }
        
        if($b['saldo07d']<>0){
            $saldo07_kewajiban_xx = $b['saldo07d'];
        }else{
            $sal1_xx = $b['saldo07c']*-1;
            $saldo07_kewajiban_xx = $sal1_xx;
        }
        
        if($b['saldo08d']<>0){
            $saldo08_kewajiban_xx = $b['saldo08d'];
        }else{
            $sal1_xx = $b['saldo08c']*-1;
            $saldo08_kewajiban_xx = $sal1_xx;
        }
        
        if($b['saldo09d']<>0){
            $saldo09_kewajiban_xx = $b['saldo09d'];
        }else{
            $sal1_xx = $b['saldo09c']*-1;
            $saldo09_kewajiban_xx = $sal1_xx;
        }
    
        if($b['saldo10d']<>0){
            $saldo10_kewajiban_xx = $b['saldo10d'];
        }else{
            $sal10 = $b['saldo10c']*-1;
            $saldo10_kewajiban_xx = $sal10;
        }
        
        if($b['saldo11d']<>0){
            $saldo11_kewajiban_xx = $b['saldo11d'];
        }else{
            $sal10 = $b['saldo11c']*-1;
            $saldo11_kewajiban_xx = $sal10;
        }
        
        if($b['saldo12d']<>0){
            $saldo12_kewajiban_xx = $b['saldo12d'];
        }else{
            $sal10 = $b['saldo12c']*-1;
            $saldo12_kewajiban_xx = $sal10;
        }
    
        $totalkewajiban = $saldo01_kewajiban_xx+$saldo02_kewajiban_xx+$saldo03_kewajiban_xx+$saldo04_kewajiban_xx+$saldo05_kewajiban_xx+$saldo06_kewajiban_xx+$saldo07_kewajiban_xx+$saldo08_kewajiban_xx+$saldo09_kewajiban_xx+$saldo10_kewajiban_xx+$saldo11_kewajiban_xx+$saldo12_kewajiban_xx;
        $totaltb_kewajiban += $totalkewajiban;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalkewajiban,0));
    
        //$total_kewajiban = $saldo01_kewajiban+$saldo02_kewajiban+$saldo03_kewajiban+$saldo04_kewajiban+$saldo05_kewajiban+$saldo06_kewajiban+$saldo07_kewajiban+$saldo08_kewajiban+$saldo09_kewajiban+$saldo10_kewajiban+$saldo11_kewajiban+$saldo12_kewajiban;
        //echo  preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($total_kewajiban,0));
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

$yeard_pendapatan;
$saldo01_pendapatan;
$saldo02_pendapatan;
$saldo03_pendapatan;
$saldo04_pendapatan;
$saldo05_pendapatan;
$saldo06_pendapatan;
$saldo07_pendapatan;
$saldo08_pendapatan;
$saldo09_pendapatan;
$saldo10_pendapatan;
$saldo11_pendapatan;
$saldo12_pendapatan;
$totaltb_pendapatan;

$saldo01_pendapatan_g;

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
    
    
?>
<tr>
    <td align="center" width="10%" style="<?php echo $bold_liab;?>">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;<?php echo $bold_liab;?>"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
        if($b['yeard'] <> 0){
            $yeard_pendapatan += $b['yeard'];
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            echo $ubahformat;
        }else{
            $nilais = $b['yeard']*-1;
            $yeard_pendapatan += $nilais;
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilais,0));
            echo $ubahformat;
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo01d']<>0){
        $saldo01_pendapatan += $b['saldo01d'];
        echo number_format($b['saldo01d'],0);
    }else{
        $sal01 = $b['saldo01c']*-1;
        $saldo01_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo02d']<>0){
        $saldo02_pendapatan += $b['saldo02d'];
        echo number_format($b['saldo02d'],0);
    }else{
        $sal01 = $b['saldo02c']*-1;
        $saldo02_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo03d']<>0){
        $saldo03_pendapatan += $b['saldo03d'];
        echo number_format($b['saldo03d'],0);
    }else{
        $sal01 = $b['saldo03c']*-1;
        $saldo03_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo04d']<>0){
        $saldo04_pendapatan += $b['saldo04d'];
        echo number_format($b['saldo04d'],0);
    }else{
        $sal01 = $b['saldo04c']*-1;
        $saldo04_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo05d']<>0){
        $saldo05_pendapatan += $b['saldo05d'];
        echo number_format($b['saldo05d'],0);
    }else{
        $sal01 = $b['saldo05c']*-1;
        $saldo05_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo06d']<>0){
        $saldo06_pendapatan += $b['saldo06d'];
        echo number_format($b['saldo06d'],0);
    }else{
        $sal01 = $b['saldo06c']*-1;
        $saldo06_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo07d']<>0){
        $saldo07_pendapatan += $b['saldo07d'];
        echo number_format($b['saldo07d'],0);
    }else{
        $sal01 = $b['saldo07c']*-1;
        $saldo07_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo08d']<>0){
        $saldo08_pendapatan += $b['saldo08d'];
        echo number_format($b['saldo08d'],0);
    }else{
        $sal01 = $b['saldo08c']*-1;
        $saldo08_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo09d']<>0){
        $saldo09_pendapatan += $b['saldo09d'];
        echo number_format($b['saldo09d'],0);
    }else{
        $sal01 = $b['saldo09c']*-1;
        $saldo09_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo10d']<>0){
        $saldo10_pendapatan += $b['saldo10d'];
        echo number_format($b['saldo10d'],0);
    }else{
        $sal01 = $b['saldo10c']*-1;
        $saldo10_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo11d']<>0){
        $saldo11_pendapatan += $b['saldo11d'];
        echo number_format($b['saldo11d'],0);
    }else{
        $sal01 = $b['saldo11c']*-1;
        $saldo11_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo12d']<>0){
        $saldo12_pendapatan += $b['saldo12d'];
        echo number_format($b['saldo12d'],0);
    }else{
        $sal01 = $b['saldo12c']*-1;
        $saldo12_pendapatan += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    
    if($b['saldo01d']<>0){
            $saldo01_pendapatan_xx = $b['saldo01d'];
        }else{
            $sal1_xx = $b['saldo01c']*-1;
            $saldo01_pendapatan_xx = $sal1_xx;
        }
        
        if($b['saldo02d']<>0){
            $saldo02_pendapatan_xx = $b['saldo02d'];
        }else{
            $sal1_xx = $b['saldo02c']*-1;
            $saldo02_pendapatan_xx = $sal1_xx;
        }
        
        if($b['saldo03d']<>0){
            $saldo03_pendapatan_xx = $b['saldo03d'];
        }else{
            $sal1_xx = $b['saldo03c']*-1;
            $saldo03_pendapatan_xx = $sal1_xx;
        }
        
        if($b['saldo04d']<>0){
            $saldo04_pendapatan_xx = $b['saldo04d'];
        }else{
            $sal1_xx = $b['saldo04c']*-1;
            $saldo04_pendapatan_xx = $sal1_xx;
        }
        
        if($b['saldo05d']<>0){
            $saldo05_pendapatan_xx = $b['saldo05d'];
        }else{
            $sal1_xx = $b['saldo05c']*-1;
            $saldo05_pendapatan_xx = $sal1_xx;
        }
        
        if($b['saldo06d']<>0){
            $saldo06_pendapatan_xx = $b['saldo06d'];
        }else{
            $sal1_xx = $b['saldo06c']*-1;
            $saldo06_pendapatan_xx = $sal1_xx;
        }
        
        if($b['saldo07d']<>0){
            $saldo07_pendapatan_xx = $b['saldo07d'];
        }else{
            $sal1_xx = $b['saldo07c']*-1;
            $saldo07_pendapatan_xx = $sal1_xx;
        }
        
        if($b['saldo08d']<>0){
            $saldo08_pendapatan_xx = $b['saldo08d'];
        }else{
            $sal1_xx = $b['saldo08c']*-1;
            $saldo08_pendapatan_xx = $sal1_xx;
        }
        
        if($b['saldo09d']<>0){
            $saldo09_pendapatan_xx = $b['saldo09d'];
        }else{
            $sal1_xx = $b['saldo09c']*-1;
            $saldo09_pendapatan_xx = $sal1_xx;
        }
    
        if($b['saldo10d']<>0){
            $saldo10_pendapatan_xx = $b['saldo10d'];
        }else{
            $sal10 = $b['saldo10c']*-1;
            $saldo10_pendapatan_xx = $sal10;
        }
        
        if($b['saldo11d']<>0){
            $saldo11_pendapatan_xx = $b['saldo11d'];
        }else{
            $sal10 = $b['saldo11c']*-1;
            $saldo11_pendapatan_xx = $sal10;
        }
        
        if($b['saldo12d']<>0){
            $saldo12_pendapatan_xx = $b['saldo12d'];
        }else{
            $sal10 = $b['saldo12c']*-1;
            $saldo12_pendapatan_xx = $sal10;
        }
    
        $totalpendapatan = $saldo01_pendapatan_xx+$saldo02_pendapatan_xx+$saldo03_pendapatan_xx+$saldo04_pendapatan_xx+$saldo05_pendapatan_xx+$saldo06_pendapatan_xx+$saldo07_pendapatan_xx+$saldo08_pendapatan_xx+$saldo09_pendapatan_xx+$saldo10_pendapatan_xx+$saldo11_pendapatan_xx+$saldo12_pendapatan_xx;
        $totaltb_pendapatan = $totalpendapatan;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalpendapatan,0));
    
    
    //$total_pendapatan = $saldo01_pendapatan+$saldo02_pendapatan+$saldo03_pendapatan+$saldo04_pendapatan+$saldo05_pendapatan+$saldo06_pendapatan+$saldo07_pendapatan+$saldo08_pendapatan+$saldo09_pendapatan+$saldo10_pendapatan+$saldo11_pendapatan+$saldo12_pendapatan;
    //echo  preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($total_pendapatan,0));
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

$yeard_pendapatan_lainnya;
$saldo01_pendapatan_lainnya;
$saldo02_pendapatan_lainnya;
$saldo03_pendapatan_lainnya;
$saldo04_pendapatan_lainnya;
$saldo05_pendapatan_lainnya;
$saldo06_pendapatan_lainnya;
$saldo07_pendapatan_lainnya;
$saldo08_pendapatan_lainnya;
$saldo09_pendapatan_lainnya;
$saldo10_pendapatan_lainnya;
$saldo11_pendapatan_lainnya;
$saldo12_pendapatan_lainnya;
$totaltb_pendapatan_lainnya;
$saldo01_pendapatan_lainnya_x;

//sum general
$saldo01pendapatan_lainnya_g;


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
    
?>
<tr>
    <td align="center" width="10%" style="<?php echo $bold_liab;?>">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;<?php echo $bold_liab;?>"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
        if($b['yeard'] <> 0){
            $yeard_pendapatan_lainnya += $b['yeard'];
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            echo $ubahformat;
        }else{
            $nilais = $b['yeard']*-1;
            $yeard_pendapatan_lainnya += $nilais;
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilais,0));
            echo $ubahformat;
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo01d']<>0){
        $saldo01_pendapatan_lainnya += $b['saldo01d'];
        echo number_format($b['saldo01d'],0);
    }else{
        $sal01 = $b['saldo01c']*-1;
        $saldo01_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo02d']<>0){
        $saldo02_pendapatan_lainnya += $b['saldo02d'];
        echo number_format($b['saldo02d'],0);
    }else{
        $sal01 = $b['saldo02c']*-1;
        $saldo02_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo03d']<>0){
        $saldo03_pendapatan_lainnya += $b['saldo03d'];
        echo number_format($b['saldo03d'],0);
    }else{
        $sal01 = $b['saldo03c']*-1;
        $saldo03_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo04d']<>0){
        $saldo04_pendapatan_lainnya += $b['saldo04d'];
        echo number_format($b['saldo04d'],0);
    }else{
        $sal01 = $b['saldo04c']*-1;
        $saldo03_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo05d']<>0){
        $saldo05_pendapatan_lainnya += $b['saldo05d'];
        echo number_format($b['saldo05d'],0);
    }else{
        $sal01 = $b['saldo05c']*-1;
        $saldo05_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo06d']<>0){
        $saldo06_pendapatan_lainnya += $b['saldo06d'];
        echo number_format($b['saldo06d'],0);
    }else{
        $sal01 = $b['saldo06c']*-1;
        $saldo06_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo07d']<>0){
        $saldo07_pendapatan_lainnya += $b['saldo07d'];
        echo number_format($b['saldo07d'],0);
    }else{
        $sal01 = $b['saldo07c']*-1;
        $saldo07_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo08d']<>0){
        $saldo08_pendapatan_lainnya += $b['saldo08d'];
        echo number_format($b['saldo08d'],0);
    }else{
        $sal01 = $b['saldo08c']*-1;
        $saldo08_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo09d']<>0){
        $saldo09_pendapatan_lainnya += $b['saldo09d'];
        echo number_format($b['saldo09d'],0);
    }else{
        $sal01 = $b['saldo09c']*-1;
        $saldo09_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo10d']<>0){
        $saldo10_pendapatan_lainnya += $b['saldo10d'];
        echo number_format($b['saldo10d'],0);
    }else{
        $sal01 = $b['saldo10c']*-1;
        $saldo10_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo11d']<>0){
        $saldo11_pendapatan_lainnya += $b['saldo11d'];
        echo number_format($b['saldo11d'],0);
    }else{
        $sal01 = $b['saldo11c']*-1;
        $saldo11_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo12d']<>0){
        $saldo12_pendapatan_lainnya += $b['saldo12d'];
        echo number_format($b['saldo12d'],0);
    }else{
        $sal01 = $b['saldo12c']*-1;
        $saldo12_pendapatan_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    
    if($b['saldo01d']<>0){
            $saldo01_pendapatan_lainnya_xx = $b['saldo01d'];
        }else{
            $sal1_xx = $b['saldo01c']*-1;
            $saldo01_pendapatan_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo02d']<>0){
            $saldo02_pendapatan_lainnya_xx = $b['saldo02d'];
        }else{
            $sal1_xx = $b['saldo02c']*-1;
            $saldo02_pendapatan_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo03d']<>0){
            $saldo03_pendapatan_lainnya_xx = $b['saldo03d'];
        }else{
            $sal1_xx = $b['saldo03c']*-1;
            $saldo03_pendapatan_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo04d']<>0){
            $saldo04_pendapatan_lainnya_xx = $b['saldo04d'];
        }else{
            $sal1_xx = $b['saldo04c']*-1;
            $saldo04_pendapatan_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo05d']<>0){
            $saldo05_pendapatan_lainnya_xx = $b['saldo05d'];
        }else{
            $sal1_xx = $b['saldo05c']*-1;
            $saldo05_pendapatan_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo06d']<>0){
            $saldo06_pendapatan_lainnya_xx = $b['saldo06d'];
        }else{
            $sal1_xx = $b['saldo06c']*-1;
            $saldo06_pendapatan_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo07d']<>0){
            $saldo07_pendapatan_lainnya_xx = $b['saldo07d'];
        }else{
            $sal1_xx = $b['saldo07c']*-1;
            $saldo07_pendapatan_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo08d']<>0){
            $saldo08_pendapatan_lainnya_xx = $b['saldo08d'];
        }else{
            $sal1_xx = $b['saldo08c']*-1;
            $saldo08_pendapatan_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo09d']<>0){
            $saldo09_pendapatan_lainnya_xx = $b['saldo09d'];
        }else{
            $sal1_xx = $b['saldo09c']*-1;
            $saldo09_pendapatan_lainnya_xx = $sal1_xx;
        }
    
        if($b['saldo10d']<>0){
            $saldo10_pendapatan_lainnya_xx = $b['saldo10d'];
        }else{
            $sal10 = $b['saldo10c']*-1;
            $saldo10_pendapatan_lainnya_xx = $sal10;
        }
        
        if($b['saldo11d']<>0){
            $saldo11_pendapatan_lainnya_xx = $b['saldo11d'];
        }else{
            $sal10 = $b['saldo11c']*-1;
            $saldo11_pendapatan_lainnya_xx = $sal10;
        }
        
        if($b['saldo12d']<>0){
            $saldo12_pendapatan_lainnya_xx = $b['saldo12d'];
        }else{
            $sal10 = $b['saldo12c']*-1;
            $saldo12_pendapatan_lainnya_xx = $sal10;
        }
    
        $totalpendapatan_lainnya    = $saldo01_pendapatan_lainnya_xx+$saldo02_pendapatan_lainnya_xx+$saldo03_pendapatan_lainnya_xx+$saldo04_pendapatan_lainnya_xx+$saldo05_pendapatan_lainnya_xx+$saldo06_pendapatan_lainnya_xx+$saldo07_pendapatan_lainnya_xx+$saldo08_pendapatan_lainnya_xx+$saldo09_pendapatan_lainnya_xx+$saldo10_pendapatan_lainnya_xx+$saldo11_pendapatan_lainnya_xx+$saldo12_pendapatan_lainnya_xx;
        $totaltb_pendapatan_lainnya = $totalpendapatan_lainnya;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalpendapatan_lainnya,0));
    
    //$total_pendapatan_lainnya = $saldo01_pendapatan_lainnya+$saldo02_pendapatan_lainnya+$saldo03_pendapatan_lainnya+$saldo04_pendapatan_lainnya+$saldo05_pendapatan_lainnya+$saldo06_pendapatan_lainnya+$saldo07_pendapatan_lainnya+$saldo08_pendapatan_lainnya+$saldo09_pendapatan_lainnya+$saldo10_pendapatan_lainnya+$saldo11_pendapatan_lainnya+$saldo12_pendapatan_lainnya;
   // echo  preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($total_pendapatan_lainnya,0));
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

$yeard_biaya_lainnya;
$saldo01_biaya_lainnya;
$saldo02_biaya_lainnya;
$saldo03_biaya_lainnya;
$saldo04_biaya_lainnya;
$saldo05_biaya_lainnya;
$saldo06_biaya_lainnya;
$saldo07_biaya_lainnya;
$saldo08_biaya_lainnya;
$saldo09_biaya_lainnya;
$saldo10_biaya_lainnya;
$saldo11_biaya_lainnya;
$saldo12_biaya_lainnya;
$totaltb_biaya_lainnya;

$saldo01biaya_lainnya_g;
$saldo02biaya_lainnya_g;

foreach($data_list_other_expenses as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
if($group_n == 'Other Expenses'){
   
    if($b['level'] == 1 && $b['type'] == 'G'){
        $bold_liab = 'font-weight:bold';
        
        //sum general
        if($b['saldo01d']<>0){
            $saldo01biaya_lainnya_g += $b['saldo01d'];
        }else{
            $sal1_xx = $b['saldo01c']*-1;
            $saldo01biaya_lainnya_g += $sal1_xx;
        }
        
        if($b['saldo02d']<>0){
            $saldo02biaya_lainnya_g += $b['saldo02d'];
        }else{
            $sal1_xx = $b['saldo02c']*-1;
            $saldo02biaya_lainnya_g += $sal1_xx;
        }
        
        if($b['saldo03d']<>0){
            $saldo03biaya_lainnya_g += $b['saldo03d'];
        }else{
            $sal1_xx = $b['saldo03c']*-1;
            $saldo03biaya_lainnya_g += $sal1_xx;
        }
        
        if($b['saldo04d']<>0){
            $saldo04biaya_lainnya_g += $b['saldo04d'];
        }else{
            $sal1_xx = $b['saldo04c']*-1;
            $saldo04biaya_lainnya_g += $sal1_xx;
        }
        
        if($b['saldo05d']<>0){
            $saldo05biaya_lainnya_g += $b['saldo05d'];
        }else{
            $sal1_xx = $b['saldo05c']*-1;
            $saldo05biaya_lainnya_g += $sal1_xx;
        }
        
        if($b['saldo06d']<>0){
            $saldo06biaya_lainnya_g += $b['saldo06d'];
        }else{
            $sal1_xx = $b['saldo06c']*-1;
            $saldo06biaya_lainnya_g += $sal1_xx;
        }
        
        if($b['saldo07d']<>0){
            $saldo07biaya_lainnya_g += $b['saldo07d'];
        }else{
            $sal1_xx = $b['saldo07c']*-1;
            $saldo07biaya_lainnya_g += $sal1_xx;
        }
        
        if($b['saldo08d']<>0){
            $saldo08biaya_lainnya_g += $b['saldo08d'];
        }else{
            $sal1_xx = $b['saldo08c']*-1;
            $saldo08biaya_lainnya_g += $sal1_xx;
        }
        
        if($b['saldo09d']<>0){
            $saldo09biaya_lainnya_g += $b['saldo09d'];
        }else{
            $sal1_xx = $b['saldo09c']*-1;
            $saldo09biaya_lainnya_g += $sal1_xx;
        }
        
        if($b['saldo10d']<>0){
            $saldo10biaya_lainnya_g += $b['saldo10d'];
        }else{
            $sal1_xx = $b['saldo10c']*-1;
            $saldo10biaya_lainnya_g += $sal1_xx;
        }
        
        if($b['saldo11d']<>0){
            $saldo11biaya_lainnya_g += $b['saldo11d'];
        }else{
            $sal1_xx = $b['saldo11c']*-1;
            $saldo11biaya_lainnya_g += $sal1_xx;
        }
        
        if($b['saldo12d']<>0){
            $saldo12biaya_lainnya_g += $b['saldo12d'];
        }else{
            $sal1_xx = $b['saldo12c']*-1;
            $saldo12biaya_lainnya_g += $sal1_xx;
        }
        
    }else{
        $bold_liab = '';
    }
    
?>
<tr>
<td align="center" width="10%" style="<?php echo $bold_liab;?>">&nbsp;<?php echo $noac_n;?></td>
<td><div style="padding-left:<?php echo $b['level'];?>0px;<?php echo $bold_liab;?>"><?php echo $nama_n;?></div></td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
        if($b['yeard'] <> 0){
            $yeard_biaya_lainnya += $b['yeard'];
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($b['yeard'],0));
            echo $ubahformat;
        }else{
            $nilais = $b['yeard']*-1;
            $yeard_biaya_lainnya += $nilais;
            $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilais,0));
            echo $ubahformat;
        }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo01d']<>0){
        $saldo01_biaya_lainnya += $b['saldo01d'];
        echo number_format($b['saldo01d'],0);
    }else{
        $sal01 = $b['saldo01c']*-1;
        $saldo01_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo02d']<>0){
        $saldo02_biaya_lainnya += $b['saldo02d'];
        echo number_format($b['saldo02d'],0);
    }else{
        $sal01 = $b['saldo02c']*-1;
        $saldo02_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo03d']<>0){
        $saldo03_biaya_lainnya += $b['saldo03d'];
        echo number_format($b['saldo03d'],0);
    }else{
        $sal01 = $b['saldo03c']*-1;
        $saldo03_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo04d']<>0){
        $saldo04_biaya_lainnya += $b['saldo04d'];
        echo number_format($b['saldo04d'],0);
    }else{
        $sal01 = $b['saldo04c']*-1;
        $saldo04_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo05d']<>0){
        $saldo05_biaya_lainnya += $b['saldo05d'];
        echo number_format($b['saldo05d'],0);
    }else{
        $sal01 = $b['saldo05c']*-1;
        $saldo05_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo06d']<>0){
        $saldo06_biaya_lainnya += $b['saldo06d'];
        echo number_format($b['saldo06d'],0);
    }else{
        $sal01 = $b['saldo06c']*-1;
        $saldo06_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo07d']<>0){
        $saldo07_biaya_lainnya += $b['saldo07d'];
        echo number_format($b['saldo07d'],0);
    }else{
        $sal01 = $b['saldo07c']*-1;
        $saldo07_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo08d']<>0){
        $saldo08_biaya_lainnya += $b['saldo08d'];
        echo number_format($b['saldo08d'],0);
    }else{
        $sal01 = $b['saldo08c']*-1;
        $saldo08_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo09d']<>0){
        $saldo09_biaya_lainnya += $b['saldo09d'];
        echo number_format($b['saldo09d'],0);
    }else{
        $sal01 = $b['saldo09c']*-1;
        $saldo09_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo10d']<>0){
        $saldo10_biaya_lainnya += $b['saldo10d'];
        echo number_format($b['saldo10d'],0);
    }else{
        $sal01 = $b['saldo10c']*-1;
        $saldo10_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo11d']<>0){
        $saldo11_biaya_lainnya += $b['saldo11d'];
        echo number_format($b['saldo11d'],0);
    }else{
        $sal01 = $b['saldo11c']*-1;
        $saldo11_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
    if($b['saldo12d']<>0){
        $saldo12_biaya_lainnya += $b['saldo12d'];
        echo number_format($b['saldo12d'],0);
    }else{
        $sal01 = $b['saldo12c']*-1;
        $saldo12_biaya_lainnya += $sal01;
        $ubahformat = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sal01,0));
        echo $ubahformat;
    }
    ?>
</td>
<td style="text-align: right;<?php echo $bold_liab;?>">
    <?php 
        
        if($b['saldo01d']<>0){
            $saldo01biaya_lainnya_xx = $b['saldo01d'];
        }else{
            $sal1_xx = $b['saldo01c']*-1;
            $saldo01biaya_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo02d']<>0){
            $saldo02biaya_lainnya_xx = $b['saldo02d'];
        }else{
            $sal1_xx = $b['saldo02c']*-1;
            $saldo02biaya_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo03d']<>0){
            $saldo03biaya_lainnya_xx = $b['saldo03d'];
        }else{
            $sal1_xx = $b['saldo03c']*-1;
            $saldo03biaya_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo04d']<>0){
            $saldo04biaya_lainnya_xx = $b['saldo04d'];
        }else{
            $sal1_xx = $b['saldo04c']*-1;
            $saldo04biaya_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo05d']<>0){
            $saldo05biaya_lainnya_xx = $b['saldo05d'];
        }else{
            $sal1_xx = $b['saldo05c']*-1;
            $saldo05biaya_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo06d']<>0){
            $saldo06biaya_lainnya_xx = $b['saldo06d'];
        }else{
            $sal1_xx = $b['saldo06c']*-1;
            $saldo06biaya_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo07d']<>0){
            $saldo07biaya_lainnya_xx = $b['saldo07d'];
        }else{
            $sal1_xx = $b['saldo07c']*-1;
            $saldo07biaya_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo08d']<>0){
            $saldo08biaya_lainnya_xx = $b['saldo08d'];
        }else{
            $sal1_xx = $b['saldo08c']*-1;
            $saldo08biaya_lainnya_xx = $sal1_xx;
        }
        
        if($b['saldo09d']<>0){
            $saldo09biaya_lainnya_xx = $b['saldo09d'];
        }else{
            $sal1_xx = $b['saldo09c']*-1;
            $saldo09biaya_lainnya_xx = $sal1_xx;
        }
    
        if($b['saldo10d']<>0){
            $saldo10biaya_lainnya_xx = $b['saldo10d'];
        }else{
            $sal10 = $b['saldo10c']*-1;
            $saldo10biaya_lainnya_xx = $sal10;
        }
        
        if($b['saldo11d']<>0){
            $saldo11biaya_lainnya_xx = $b['saldo11d'];
        }else{
            $sal10 = $b['saldo11c']*-1;
            $saldo11biaya_lainnya_xx = $sal10;
        }
        
        if($b['saldo12d']<>0){
            $saldo12biaya_lainnya_xx = $b['saldo12d'];
        }else{
            $sal10 = $b['saldo12c']*-1;
            $saldo12biaya_lainnya_xx = $sal10;
        }
    
        $totalbiaya_lainnya     = $saldo01biaya_lainnya_xx+$saldo02biaya_lainnya_xx+$saldo03biaya_lainnya_xx+$saldo04biaya_lainnya_xx+$saldo05biaya_lainnya_xx+$saldo06biaya_lainnya_xx+$saldo07biaya_lainnya_xx+$saldo08biaya_lainnya_xx+$saldo09biaya_lainnya_xx+$saldo10biaya_lainnya_xx+$saldo11biaya_lainnya_xx+$saldo12biaya_lainnya_xx;
        $totaltb_biaya_lainnya += $totalbiaya_lainnya;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totalbiaya_lainnya,0));
    
        //$total_biaya_lainnya = $saldo01_biaya_lainnya+$saldo02_biaya_lainnya+$saldo03_biaya_lainnya+$saldo04_biaya_lainnya+$saldo05_biaya_lainnya+$saldo06_biaya_lainnya+$saldo07_biaya_lainnya+$saldo08_biaya_lainnya+$saldo09_biaya_lainnya+$saldo11_biaya_lainnya+$saldo12_biaya_lainnya;
        //echo  preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($total_biaya_lainnya,0));
        
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

$tot_yeard   = ($saldo_yeard_aset_x+$year_kewajiban_x)+($year_ekuitas_x+$year_biaya_x+$yeard_pendapatan+$yeard_pendapatan_lainnya+$yeard_biaya_lainnya);
$tot_saldo01 = ($saldo01_aset_x+$saldo01_kewajiban_x)+($saldo01_ekuitas_x+$saldo01_biaya_x+$saldo01_pendapatan+$saldo01_pendapatan_lainnya+$saldo01_biaya_lainnya);
$tot_saldo02 = ($saldo02_aset_x+$saldo02_kewajiban_x)+($saldo02_ekuitas_x+$saldo02_biaya_x+$saldo02_pendapatan+$saldo02_pendapatan_lainnya+$saldo02_biaya_lainnya);
$tot_saldo03 = ($saldo03_aset_x+$saldo03_kewajiban_x)+($saldo03_ekuitas_x+$saldo03_biaya_x+$saldo03_pendapatan+$saldo03_pendapatan_lainnya+$saldo03_biaya_lainnya);
$tot_saldo04 = ($saldo04_aset_x+$saldo04_kewajiban_x)+($saldo04_ekuitas_x+$saldo04_biaya_x+$saldo04_pendapatan+$saldo04_pendapatan_lainnya+$saldo04_biaya_lainnya);
$tot_saldo05 = ($saldo05_aset_x+$saldo05_kewajiban_x)+($saldo05_ekuitas_x+$saldo05_biaya_x+$saldo05_pendapatan+$saldo05_pendapatan_lainnya+$saldo05_biaya_lainnya);
$tot_saldo06 = ($saldo06_aset_x+$saldo06_kewajiban_x)+($saldo06_ekuitas_x+$saldo06_biaya_x+$saldo06_pendapatan+$saldo06_pendapatan_lainnya+$saldo06_biaya_lainnya);
$tot_saldo07 = ($saldo07_aset_x+$saldo07_kewajiban_x)+($saldo07_ekuitas_x+$saldo07_biaya_x+$saldo07_pendapatan+$saldo07_pendapatan_lainnya+$saldo07_biaya_lainnya);
$tot_saldo08 = ($saldo08_aset_x+$saldo08_kewajiban_x)+($saldo08_ekuitas_x+$saldo08_biaya_x+$saldo08_pendapatan+$saldo08_pendapatan_lainnya+$saldo08_biaya_lainnya);
$tot_saldo09 = ($saldo09_aset_x+$saldo09_kewajiban_x)+($saldo09_ekuitas_x+$saldo09_biaya_x+$saldo09_pendapatan+$saldo09_pendapatan_lainnya+$saldo09_biaya_lainnya);
$tot_saldo10 = ($saldo10_aset_x+$saldo10_kewajiban_x)+($saldo10_ekuitas_x+$saldo10_biaya_x+$saldo10_pendapatan+$saldo10_pendapatan_lainnya+$saldo10_biaya_lainnya);
$tot_saldo11 = ($saldo11_aset_x+$saldo11_kewajiban_x)+($saldo11_ekuitas_x+$saldo11_biaya_x+$saldo11_pendapatan+$saldo11_pendapatan_lainnya+$saldo11_biaya_lainnya);
$tot_saldo12 = ($saldo12_aset_x+$saldo12_kewajiban_x)+($saldo12_ekuitas_x+$saldo12_biaya_x+$saldo12_pendapatan+$saldo12_pendapatan_lainnya+$saldo12_biaya_lainnya);
$tot_total   = ($totaltb_aset+$totaltb_kewajiban)+($totaltb_capital+$totaltb_biaya+$totaltb_pendapatan+$totaltb_pendapatan_lainnya+$totaltb_biaya_lainnya);

//echo  'aset :'.$saldo01_aset_x.' - kwajiban :'.$saldo01_kewajiban_x.' - ekuitas:'.$saldo01_ekuitas_x.' - biaya:'.$saldo01_biaya_x.' - pendapatan:'.$saldo01_pendapatan.' - pendapatan lainnya:'.$saldo01_pendapatan_lainnya_x.' - biaya lainnya:'.$saldo01_biaya_lainnya;


$tot_saldo01_g = ($saldo01_aset_g+$saldo01_kewajiban_g)+($saldo01_ekuitas_g+$saldo01_biaya_g+$saldo01_pendapatan_g+$saldo01_pendapatan_lainnya_g+$saldo01biaya_lainnya_g);
$tot_saldo02_g = $saldo02biaya_lainnya_g;
?>


 <!-- GRAND TOTAL -->   
<tr>
<td colspan="2" align="right">&nbsp;Saldo Balance</td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_yeard,0));?></td>
<td style="background:#f1f1f1;text-align: right">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_saldo01_g,0));?></td>
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
                     