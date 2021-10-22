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

<!--<title>Neraca Saldo</title>-->
<title>Laporan Detail Trial Balance</title>

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
                                                echo 'Oktober';
                                            }else if($bln == 11){
                                                echo 'November';
                                            }else if($bln == 12){
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

<!--IF {noac.group}="Asset" THEN "ASSET"
ELSE IF {noac.group}="Capital" THEN "EKUITAS"
ELSE IF {noac.group}="Expenses" THEN "BIAYA"
ELSE IF {noac.group}="Liability" THEN "KEWAJIBAN"
ELSE IF {noac.group}="Other Expenses" THEN "BIAYA LAINNYA"
ELSE IF {noac.group}="Other Revenue" THEN "PENDAPATAN LAINNYA"
ELSE IF {noac.group}="Revenue" THEN "PENDAPATAN"-->

<i><b>Sort By Level <?php echo $level;?></b></i>

<table border="1" width="100%" class="font-style" >
<tbody>
<tr>
<td align="center" rowspan="2">COA</td>
<td align="center" rowspan="2">Name Of Accounts</td>
<td colspan="2" align="center">&nbsp; Beginning Balance</td>
<td colspan="2" align="center">&nbsp; This Month</td>
<td align="center" style="width:150px">&nbsp; Ending Balance</td>
</tr>
<tr>
<td align="center" class="wd_table">&nbsp; Debit</td>
<td align="center" class="wd_table">&nbsp; Credit</td>
<td align="center" class="wd_table">&nbsp; Debit</td>
<td align="center" class="wd_table">&nbsp; Credit</td>
<td>&nbsp;</td>
</tr>


<!-- ASSETS -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="6" style="font-weight:bold">&nbsp;&nbsp; ASSET</td>
</tr>
<?php


$subtotal_aset_bb_c;
$subtotal_aset_bb_d;
$subtotal_aset_tm_cr;
$subtotal_aset_tm_db;
$subtotal_aset_balance;

$subtotal_ekuitas_bb_db;
$subtotal_ekuitas_bb_cr;
$subtotal_ekuitas_tm_db;
$subtotal_ekuitas_tm_cr;
$subtotal_ekuitas_balance;

$subtotal_biaya_bb_db;
$subtotal_biaya_bb_cr;
$subtotal_biaya_tm_db;
$subtotal_biaya_tm_cr;
$subtotal_biaya_balance;

$subtotal_kewajiban_bb_db;
$subtotal_kewajiban_bb_cr;
$subtotal_kewajiban_tm_db;
$subtotal_kewajiban_tm_cr;
$subtotal_kewajiban_balance;

$subtotal_biaya_lainnya_bb_db;
$subtotal_biaya_lainnya_bb_cr; 
$subtotal_biaya_lainnya_tm_db;
$subtotal_biaya_lainnya_tm_cr;
$subtotal_biaya_lainnya_balance;

$subtotal_pendapatan_lainnya_bb_db;
$subtotal_pendapatan_lainnya_bb_cr;
$subtotal_pendapatan_lainnya_tm_db;
$subtotal_pendapatan_lainnya_tm_cr;
$subtotal_pendapatan_lainnya_balance;

$subtotal_pendapatan_bb_db; 
$subtotal_pendapatan_bb_cr; 
$subtotal_pendapatan_tm_db;
$subtotal_pendapatan_tm_cr;
$subtotal_pendapatan_balance;


foreach($data_list_assets as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
if($group_n == 'Asset'){
    
    //start begining balance debit    
    if($bln == '01'){
        $begindb = $b['yeard'];
    }else if($bln == '02'){
        $begindb = $b['yeard'] + $b['saldo01d'];
    }else if($bln == '03'){
        $begindb = $b['yeard'] + $b['saldo02d']+$b['saldo01d'];
    }else if($bln == '04'){
        $begindb = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '05'){
            $begindb = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '06'){
            $begindb = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '07'){
            $begindb = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '08'){
            $begindb = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '09'){
            $begindb = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '10'){
            $begindb = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '11'){
            $begindb = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }else if($bln == '12'){
            $begindb = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
    }  
    
    //end begining balance debit  
        
        
    
    //start : begining balance credit
    $begincr;
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo01c'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }
    //end : begining balance credit
    
    $cr;
    
    
     
    
?>
<tr>
<td align="center" width="10%">&nbsp;<?php echo $noac_n;?></td>
<td>&nbsp;<?php echo $nama_n;?></td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) > 0){
                    $bbd = $begindb-$begincr;
                }else{
                    $bbd = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) < 0){
                    $bbd = ($begincr-$begindb)*-1;
                }else{
                    $bbd = 0;
                }
            }
        }
        $subtotal_aset_bb_d += $bbd;
        echo number_format($bbd, 0);
    ?>
</td>
<td style="text-align: right">
        
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbc = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) < 0){
                    $bbc = ($begindb-$begincr)*-1;
                }else{
                    $bbc = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) > 0){
                    $bbc = ($begincr-$begindb);
                }else{
                    $bbc = 0;
                }
            }
        }
        $subtotal_aset_bb_c += $bbc;
        echo number_format($bbc, 0);
    ?>
    
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo01d'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo02d'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo03d'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo04d'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo05d'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo06d'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo07d'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo08d'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo09d'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo10d'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo11d'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo12d'];
            }
        }
        $subtotal_aset_tm_db += $dbt;
        echo number_format($dbt, 0);
        ?>
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt =  0;
            }else{
                $crt = $b['saldo01c'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo02c'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo03c'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo04c'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo05c'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo06c'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo07c'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo08c'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo09c'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo10c'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo11c'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo12c'];
            }
        }
        $subtotal_aset_tm_cr += $crt;
        echo number_format($crt, 0);
        ?>
</td>
<td style="text-align: right">
    
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($bbd+$dbt)-($bbc+$crt) > 0){
                     $ttls = ($bbd+$dbt)-($bbc+$crt);
                     echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                     $subtotal_aset_balance += $ttls;
                }else{
                    $ttls = (($bbd+$dbt)-($bbc+$crt));
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                    $subtotal_aset_balance += $ttls;
                }
            }else{
                if(($bbc+$crt)-($bbd+$dbt) < 0){
                    $ttlp = ($bbd+$crt)-($bbc+$dbt);
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                    $subtotal_aset_balance += $ttlp;
                }else{
                    $ttlp = (($bbc+$crt)-(($bbd+$dbt)*-1));
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                    $subtotal_aset_balance += $ttlp;
                }
            }
        }
        ?>
</td>
</tr>
<?php
}
}
?>
<tr>
<td colspan="2" align="right">&nbsp;ASSET | Sub Total</td>

<!--$subtotal_aset_bb_c;
$subtotal_aset_bb_d;
$subtotal_aset_tm_db;
$subtotal_aset_tm_cr;
$subtotal_aset_balance-->
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_aset_bb_d, 0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_aset_bb_c, 0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_aset_tm_db, 0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_aset_tm_cr, 0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_aset_balance, 0);?></td>
</tr>
<!-- ASSETS -->





<!-- EKUITAS -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="6" style="font-weight:bold">&nbsp;&nbsp; EKUITAS</td>
</tr>
<?php
foreach($data_list_capital as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
if($group_n == 'Capital'){
    
    //start begining balance debit    
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo01d'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }  
    
    //end begining balance debit  
        
        
    
    //start : begining balance credit
    $begincr;
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo01c'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }
    //end : begining balance credit
    
    
?>
<tr>
<td align="center" width="10%">&nbsp;<?php echo $noac_n;?></td>
<td>&nbsp;<?php echo $nama_n;?></td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) > 0){
                    $bbd = $begindb-$begincr;
                }else{
                    $bbd = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) < 0){
                    $bbd = ($begincr-$begindb)*-1;
                }else{
                    $bbd = 0;
                }
            }
        }
        $subtotal_ekuitas_bb_db += $bbd;
        echo number_format($bbd, 0);
    ?>
</td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbc = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) < 0){
                    $bbc = ($begindb-$begincr)*-1;
                }else{
                    $bbc = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) > 0){
                    $bbc = $begincr-$begindb;
                }else{
                    $bbc = 0;
                }
            }
        }
        $subtotal_ekuitas_bb_cr += $bbc;
        echo number_format($bbc, 0);
    ?>
</td>
<td style="text-align: right">
    
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo01d'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo02d'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo03d'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo04d'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo05d'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo06d'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo07d'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo08d'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo09d'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo10d'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo11d'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo12d'];
            }
        }
        $subtotal_ekuitas_tm_db += $dbt;
        echo number_format($dbt, 0);
        ?>
    
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt =  0;
            }else{
                $crt = $b['saldo01c'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo02c'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo03c'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo04c'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo05c'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo06c'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo07c'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo08c'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo09c'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo10c'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo11c'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo12c'];
            }
        }
        $subtotal_ekuitas_tm_cr += $crt;
        echo number_format($crt, 0);
        ?>
</td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($bbd+$dbt)-($bbc+$crt) > 0){
                     $ttls = ($bbd+$dbt)-($bbc+$crt);
                     $subtotal_ekuitas_balance += $ttls;
                     echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                     
                }else{
                    $ttls = ($bbd+$dbt)-($bbc+$crt);
                    $subtotal_ekuitas_balance += $ttls;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                }
            }else{
                if(($bbc+$crt)-($bbd+$dbt) < 0){
                    $ttlp = ($bbd+$crt)-($bbc+$dbt);
                    $subtotal_ekuitas_balance += $ttlp;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }else{
                    $ttlp = ((($bbc+$crt)-($bbd+$dbt))*-1);
                    $subtotal_ekuitas_balance += $ttlp;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }
            }
        }
        ?>
</td>
</tr>
<?php
}
}
?>

<tr>
<td colspan="2" align="right">&nbsp;EKUITAS | Sub Total</td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_ekuitas_bb_db,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_ekuitas_bb_cr,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_ekuitas_tm_db,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_ekuitas_tm_cr,0);?></td>
	<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;
			<?php
			echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($subtotal_ekuitas_balance,0));
			?>
	</td>
</tr>
<!-- EKUITAS -->



<!-- BIAYA -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="6" style="font-weight:bold">&nbsp;&nbsp; BIAYA</td>
</tr>
<?php
foreach($data_list_expenses as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
if($group_n == 'Expenses'){
    
    //start begining balance debit    
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo01d'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo07d']+$b['saldo06c']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }  
    
    //end begining balance debit  
        
        
    
    //start : begining balance credit
    $begincr;
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo01c'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }
    //end : begining balance credit
    
    
?>
<tr>
<td align="center" width="10%">&nbsp;<?php echo $noac_n;?></td>
<td>&nbsp;<?php echo $nama_n;?></td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) > 0){
                    $bbd = $begindb-$begincr;
                }else{
                    $bbd = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) < 0){
                    $bbd = ($begincr-$begindb)*-1;
                }else{
                    $bbd = 0;
                }
            }
        }
        $subtotal_biaya_bb_db += $bbd;
        echo number_format($bbd, 0);
    ?>
</td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbc = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) < 0){
                    $bbc = ($begindb-$begincr)*-1;
                }else{
                    $bbc = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) > 0){
                    $bbc = $begincr-$begindb;
                }else{
                    $bbc = 0;
                }
            }
        }
        $subtotal_biaya_bb_cr += $bbc;
        echo number_format($bbc, 0);
    ?>
</td>
<td style="text-align: right">
    <?php 
        //debit
    
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo01d'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo02d'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo03d'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo04d'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo05d'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo06d'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo07d'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo08d'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo09d'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo10d'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo11d'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo12d'];
            }
        }
        
        $subtotal_biaya_tm_db += $dbt;
        echo number_format($dbt, 0);
        ?>
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt =  0;
            }else{
                $crt = $b['saldo01c'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo02c'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo03c'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo04c'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo05c'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo06c'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo07c'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo08c'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo09c'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo10c'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo11c'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo12c'];
            }
        }
        
        $subtotal_biaya_tm_cr += $crt;
        echo number_format($crt, 0);
        ?>
</td>
<td style="text-align: right">
        
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($bbd+$dbt)-($bbc+$crt) > 0){
                     $ttls = ($bbd+$dbt)-($bbc+$crt);
                     $subtotal_biaya_balance += $ttls;
                     echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                }else{
                    $ttls = ($bbd+$dbt)-($bbc+$crt);
                    $subtotal_biaya_balance += $ttls;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                }
            }else{
                if(($bbc+$crt)-($bbd+$dbt) < 0){
                    $ttlp = ($bbd+$crt)-($bbc+$dbt);
                    $subtotal_biaya_balance += $ttlp;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }else{
                    $ttlp = (($bbc+$crt)-($bbd+$dbt)*-1);
                    $subtotal_biaya_balance += $ttlp;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }
            }
        }
        ?>
</td>
</tr>
<?php 
}
}
?>
<tr>
<td colspan="2" align="right">&nbsp;BIAYA | Sub Total</td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_biaya_bb_db, 0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_biaya_bb_cr, 0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_biaya_tm_db, 0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_biaya_tm_cr, 0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_biaya_balance, 0);?></td>
</tr>
<!-- BIAYA -->




<!-- KEWAJIBAN -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="6" style="font-weight:bold">&nbsp;&nbsp; KEWAJIBAN</td>
</tr>
<?php
foreach($data_list_liability as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
if($group_n == 'Liability'){
    
    
    //start begining balance debit    
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo01d'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo07d']+$b['saldo06c']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }  
    
    //end begining balance debit  
        
        
    
    //start : begining balance credit
    $begincr;
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo01c'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }
    //end : begining balance credit
    
    
?>
<tr>
<td align="center" width="10%">&nbsp;<?php echo $noac_n;?></td>
<td>&nbsp;<?php echo $nama_n;?></td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) > 0){
                    $bbd = $begindb-$begincr;
                }else{
                    $bbd = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) < 0){
                    $bbd = ($begincr-$begindb)*-1;
                }else{
                    $bbd = 0;
                }
            }
        }
        $subtotal_kewajiban_bb_db += $bbd;
        echo number_format($bbd, 0);
    ?>
</td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbc = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) < 0){
                    $bbc = ($begindb-$begincr)*-1;
                }else{
                    $bbc = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) > 0){
                    $bbc = $begincr-$begindb;
                }else{
                    $bbc = 0;
                }
            }
        }
        $subtotal_kewajiban_bb_cr += $bbc;
        echo number_format($bbc, 0);
    ?>
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo01d'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo02d'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo03d'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo04d'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo05d'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo06d'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo07d'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo08d'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo09d'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo10d'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo11d'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo12d'];
            }
        }
        $subtotal_kewajiban_tm_db +=$dbt;
        echo number_format($dbt, 0);
        ?>
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt =  0;
            }else{
                $crt = $b['saldo01c'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo02c'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo03c'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo04c'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo05c'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo06c'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo07c'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo08c'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo09c'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo10c'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo11c'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo12c'];
            }
        }
        
        $subtotal_kewajiban_tm_cr +=$crt;
        echo number_format($crt, 0);
        ?>
</td>
<td style="text-align: right"><?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($bbd+$dbt)-($bbc+$crt) > 0){
                     $ttls = ($bbd+$dbt)-($bbc+$crt);
                     $subtotal_kewajiban_balance += $ttls;
                     echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                }else{
                    $ttls = ($bbd+$dbt)-($bbc+$crt);
                    $subtotal_kewajiban_balance += $ttls;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                }
            }else{
//               if(($bbc+$crt)-($bbd+$dbt) < 0){
//                    $ttlp = ($bbd+$crt)-($bbc+$dbt);
//                    $subtotal_kewajiban_balance += $ttlp;
//                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
//                }else{
//                    $ttlp = ((($bbc+$crt)-($bbd+$dbt))*-1);
//                    $subtotal_kewajiban_balance += $ttlp;
//                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
//                }
//            }
//testing rumus
               //if(($bbc+$crt)-($bbd+$dbt) < 0){
		if(($bbd+$dbt)-($bbc+$crt) < 0){
                    $ttlp = ((($bbc+$crt)-($bbd+$dbt))*-1);
                    $subtotal_kewajiban_balance += $ttlp;
                   echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }else{
                   // $ttlp = ((($bbc+$crt)-($bbd+$dbt)));
                    $ttlp = ((($bbd+$dbt)-($bbc+$crt)));
                    $subtotal_kewajiban_balance += $ttlp;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }
            }
//--
        }
        ?></td>
</tr>
<?php
}
}
?>  
<tr>
<td colspan="2" align="right">&nbsp;KEWAJIBAN | Sub Total</td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_kewajiban_bb_db,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_kewajiban_bb_cr,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_kewajiban_tm_db,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_kewajiban_tm_cr,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;
					<?php 
						echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($subtotal_kewajiban_balance,0));
					?>
					</td>
</tr>
<!-- KEWAJIBAN -->




<!-- BIAYA LAINNYA -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="6" style="font-weight:bold">&nbsp;&nbsp; BIAYA LAINNYA</td>
</tr>
<?php
foreach($data_list_other_expenses as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
if($group_n == 'Other Expenses'){
    
    //start begining balance debit    
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo01d'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }  
    
    //end begining balance debit  
        
        
    
    //start : begining balance credit
    $begincr;
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo01c'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }
    //end : begining balance credit
    
?>
<tr>
<td align="center" width="10%">&nbsp;<?php echo $noac_n;?></td>
<td>&nbsp;<?php echo $nama_n;?></td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) > 0){
                    $bbd = $begindb-$begincr;
                }else{
                    $bbd = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) < 0){
                    $bbd = ($begincr-$begindb)*-1;
                }else{
                    $bbd = 0;
                }
            }
        }
        $subtotal_biaya_lainnya_bb_db += $bbd;
        echo number_format($bbd, 0);
    ?>
</td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbc = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) < 0){
                    $bbc = ($begindb-$begincr)*-1;
                }else{
                    $bbc = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) > 0){
                    $bbc = $begincr-$begindb;
                }else{
                    $bbc = 0;
                }
            }
        }
        $subtotal_biaya_lainnya_bb_cr += $bbc;
        echo number_format($bbc, 0);
    ?>
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo01d'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo02d'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo03d'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo04d'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo05d'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo06d'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo07d'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo08d'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo09d'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo10d'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo11d'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo12d'];
            }
        }
        $subtotal_biaya_lainnya_tm_db += $dbt;
        echo number_format($dbt, 0);
        ?>
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt =  0;
            }else{
                $crt = $b['saldo01c'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo02c'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo03c'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo04c'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo05c'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo06c'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo07c'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo08c'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo09c'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo10c'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo11c'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo12c'];
            }
        }
        
        $subtotal_biaya_lainnya_tm_cr += $crt;
        echo number_format($crt, 0);
        ?>
</td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($bbd+$dbt)-($bbc+$crt) > 0){
                    $ttls = ($bbd+$dbt)-($bbc+$crt);
                    $subtotal_biaya_lainnya_balance += $ttls;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                }else{
                    $ttls = ($bbd+$dbt)-($bbc+$crt);
                    $subtotal_biaya_lainnya_balance += $ttls;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                }
            }else{
                if(($bbc+$crt)-($bbd+$dbt) < 0){
                    $ttlp = ($bbd+$crt)-($bbc+$dbt);
                    $subtotal_biaya_lainnya_balance += $ttlp;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }else{
                    $ttlp = (($bbc+$crt)-($bbd+$dbt)*-1);
                    $subtotal_biaya_lainnya_balance += $ttlp;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }
            }
        }
        ?>
</td>
</tr>
<?php
}
}
?>
<tr>
<td colspan="2" align="right">&nbsp;BIAYA LAINNYA | Sub Total</td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_biaya_lainnya_bb_db,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_biaya_lainnya_bb_cr,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_biaya_lainnya_tm_db,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_biaya_lainnya_tm_cr,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_biaya_lainnya_balance,0);?></td>
</tr>
<!-- BIAYA LAINNYA -->




<!-- PENDAPATAN LAINNYA -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="6" style="font-weight:bold">&nbsp;&nbsp; PENDAPATAN LAINNYA</td>
</tr>
<?php
foreach($data_list_other_revenue as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];

if($group_n == 'Other Revenue'){
    
    //start begining balance debit    
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo01d'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo07d']+$b['saldo06c']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }  
    
    //end begining balance debit  
        
        
    
    //start : begining balance credit
    $begincr;
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo01c'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }
    //end : begining balance credit
    
?>
<tr>
<td align="center" width="10%">&nbsp;<?php echo $noac_n;?></td>
<td>&nbsp;<?php echo $nama_n;?></td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) > 0){
                    $bbd = $begindb-$begincr;
                }else{
                    $bbd = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) < 0){
                    $bbd = ($begincr-$begindb)*-1;
                }else{
                    $bbd = 0;
                }
            }
        }
        $subtotal_pendapatan_lainnya_bb_db += $bbd;
        echo number_format($bbd, 0);
    ?>
</td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbc = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) < 0){
                    $bbc = ($begindb-$begincr)*-1;
                }else{
                    $bbc = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) > 0){
                    $bbc = $begincr-$begindb;
                }else{
                    $bbc = 0;
                }
            }
        }
        $subtotal_pendapatan_lainnya_bb_cr += $bbc;
        echo number_format($bbc, 0);
    ?>
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo01d'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo02d'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo03d'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo04d'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo05d'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo06d'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo07d'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo08d'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo09d'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo10d'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo11d'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo12d'];
            }
        }
        
        $subtotal_pendapatan_lainnya_tm_db += $dbt;
        echo number_format($dbt, 0);
        ?>
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt =  0;
            }else{
                $crt = $b['saldo01c'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo02c'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo03c'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo04c'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo05c'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo06c'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo07c'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo08c'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo09c'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo10c'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo11c'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo12c'];
            }
        }
        
        $subtotal_pendapatan_lainnya_tm_cr += $crt;
        echo number_format($crt, 0);
        ?>
</td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($bbd+$dbt)-($bbc+$crt) > 0){
                     $ttls = ($bbd+$dbt)-($bbc+$crt);
                     $subtotal_pendapatan_lainnya_balance += $ttls;
                     echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                }else{
                    $ttls = ($bbd+$dbt)-($bbc+$crt);
                    $subtotal_pendapatan_lainnya_balance += $ttls;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                }
            }else{
//               if(($bbc+$crt)-($bbd+$dbt) < 0){
//                    $ttlp = ($bbd+$crt)-($bbc+$dbt);
//                    $subtotal_pendapatan_lainnya_balance += $ttlp;
//                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
				if(($bbd+$dbt)-($bbc+$crt) < 0){
                    $ttlp = ($bbd+$dbt)-($bbc+$crt);
                    $subtotal_pendapatan_lainnya_balance += $ttlp;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }else{
                    $ttlp = (($bbc+$crt)-($bbd+$dbt)*-1);
                    $subtotal_pendapatan_lainnya_balance += $ttlp;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }
            }
        }
        ?>
</td>
</tr>
<?php
}
}

?>
<tr>
<td colspan="2" align="right">&nbsp;PENDAPATAN LAINNYA | Sub Total</td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_pendapatan_lainnya_bb_db,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_pendapatan_lainnya_bb_cr,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_pendapatan_lainnya_tm_db,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_pendapatan_lainnya_tm_cr,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($subtotal_pendapatan_lainnya_balance, 0));?></td>
</tr>
<!-- PENDAPATAN LAINNYA -->




<!-- PENDAPATAN -->
<tr style="background-color:#e5e5e5;">
    <td>&nbsp;</td>
    <td colspan="6" style="font-weight:bold">&nbsp;&nbsp; PENDAPATAN</td>
</tr>
<?php
foreach($data_list_revenue as $b){
    $noac_n  = $b['noac'];
    $nama_n  = $b['nama'];
    $group_n = $b['group'];
    
if($group_n == 'Revenue'){
    
    //start begining balance debit    
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo01d'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo07d']+$b['saldo06c']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begindb = 0;
        }else{
            $begindb = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08d']+$b['saldo07d']+$b['saldo06d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
        }
    }  
    
    //end begining balance debit  
        
        
    
    //start : begining balance credit
    $begincr;
    if($bln == '01'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'];
        }
    }else if($bln == '02'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo01c'];
        }
    }else if($bln == '03'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '04'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '05'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '06'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '07'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '08'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '09'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '10'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '11'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }else if($bln == '12'){
        if($b['type'] == 'G'){
            $begincr = 0;
        }else{
            $begincr = $b['yearc'] + $b['saldo11c']+$b['saldo10c']+$b['saldo09c']+$b['saldo08c']+$b['saldo07c']+$b['saldo06c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
        }
    }
    //end : begining balance credit
    
    
?>
<tr>
<td align="center" width="10%">&nbsp;<?php echo $noac_n;?></td>
<td>&nbsp;<?php echo $nama_n;?></td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) > 0){
                    $bbd = $begindb-$begincr;
                }else{
                    $bbd = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) < 0){
                    $bbd = ($begincr-$begindb)*-1;
                }else{
                    $bbd = 0;
                }
            }
        }
        $subtotal_pendapatan_bb_db += $bbd;
        echo number_format($bbd, 0);
    ?>
</td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbc = 0;
        }else{
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($begindb-$begincr) < 0){
                    $bbc = ($begindb-$begincr)*-1;
                }else{
                    $bbc = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if(($begincr-$begindb) > 0){
                    $bbc = $begincr-$begindb;
                }else{
                    $bbc = 0;
                }
            }
        }
        
        $subtotal_pendapatan_bb_cr += $bbc;
        echo number_format($bbc, 0);
    ?>
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo01d'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo02d'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo03d'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo04d'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo05d'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo06d'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo07d'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo08d'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo09d'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo10d'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo11d'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo12d'];
            }
        }
        
        $subtotal_pendapatan_tm_db   +=$dbt;
        echo number_format($dbt, 0);
        ?>
</td>
<td style="text-align: right">
    <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt =  0;
            }else{
                $crt = $b['saldo01c'];
            }
        }else if($bln == '02'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo02c'];
            }
        }else if($bln == '03'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo03c'];
            }
        }else if($bln == '04'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo04c'];
            }
        }else if($bln == '05'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo05c'];
            }
        }else if($bln == '06'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo06c'];
            }
        }else if($bln == '07'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo07c'];
            }
        }else if($bln == '08'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo08c'];
            }
        }else if($bln == '09'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo09c'];
            }
        }else if($bln == '10'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo10c'];
            }
        }else if($bln == '11'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo11c'];
            }
        }else if($bln == '12'){
            if($b['noac'] == $account_labarugi || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo12c'];
            }
        }
        
        $subtotal_pendapatan_tm_cr +=$crt;
        echo number_format($crt, 0);
        ?>
</td>
<td style="text-align: right">
    <?php 
        if($b['noac'] == $account_labarugi){
            $bbd = 0;
        }else{
            
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($bbd+$dbt)-($bbc+$crt) > 0){
                     $ttls = ($bbd+$dbt)-($bbc+$crt);
                     $subtotal_pendapatan_balance += $ttls;
                     echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                }else{
                    $ttls = ($bbd+$dbt)-($bbc+$crt);
                    $subtotal_pendapatan_balance += $ttls;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttls, 0));
                }
            }else{
		if(($bbd+$dbt)-($bbc+$crt) < 0){
                    $ttlp = ($bbd+$dbt)-($bbc+$crt);
                    $subtotal_pendapatan_balance += $ttlp;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }else{
                    $ttlp = (($bbc+$crt)-($bbd+$dbt)*-1);
                    $subtotal_pendapatan_balance += $ttlp;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlp, 0));
                }
            }
        }
        ?>
</td>
</tr>
<?php 
}
}
?>
<tr>
<td colspan="2" align="right">&nbsp;PENDAPATAN | Sub Total</td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_pendapatan_bb_db,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_pendapatan_bb_cr,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_pendapatan_tm_db,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo number_format($subtotal_pendapatan_tm_cr,0);?></td>
<td style="background:#f1f1f1;text-align: right;font-weight:bold">&nbsp;<?php echo preg_replace('/\-([0-9,.]+)/', '(\1)',number_format($subtotal_pendapatan_balance,0));?></td>
</tr>
<!-- PENDAPATAN -->




 <!-- GRAND TOTAL -->   
<tr>
<td colspan="2" align="right">&nbsp;Grand Total</td>
<td style="background:#f1f1f1;text-align: right;font-weight: bold">&nbsp;
    <?php 
        
        $sum_debit_begining = ($subtotal_aset_bb_d+$subtotal_kewajiban_bb_db)+($subtotal_ekuitas_bb_db+$subtotal_pendapatan_bb_db+$subtotal_pendapatan_lainnya_bb_db+$subtotal_biaya_lainnya_bb_db+$subtotal_biaya_bb_db);
        $sum_tot_debit_begining = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sum_debit_begining, 0));
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sum_debit_begining, 0));
        
        //$sub1 = ($subtotal_aset_bb_c+$subtotal_ekuitas_bb_db+$subtotal_biaya_bb_db+$subtotal_kewajiban_bb_db+$subtotal_biaya_lainnya_bb_db)-($subtotal_pendapatan_lainnya_bb_db+$subtotal_pendapatan_bb_db);
        //$tot_1 = ($tot_assets+$tot_assets_tidak_lancar)+($tot_kewajiban_lancar+$tot_kewajiban_tidak_lancar);
        //$tot_2 = $tot_ekuitas+$tot_pendapatan+$tot_harga_pokok_penjualan+$tot_biaya_administrasi_umum+$tot_running_account+$tot_pendapatan_lainnya+$tot_biaya_lainnya;
        //$total_keseluruhan = $tot_1+$tot_2;
        
    ?>
</td>
<td style="background:#f1f1f1;text-align: right;font-weight: bold">&nbsp;
    <?php 
        //+$subtotal_ekuitas_bb_db+$subtotal_pendapatan_bb_db+$subtotal_pendapatan_lainnya_bb_db+$subtotal_biaya_lainnya_bb_db+$subtotal_biaya_bb_db
        $sum_credit_begining = $subtotal_aset_bb_c+$subtotal_kewajiban_bb_cr+$subtotal_ekuitas_bb_cr+$subtotal_biaya_bb_cr+$subtotal_biaya_lainnya_bb_cr+$subtotal_pendapatan_lainnya_bb_cr+$subtotal_pendapatan_bb_cr;
        $sum_tot_credit_begining = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sum_credit_begining, 0));
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sum_credit_begining, 0));
    ?>
</td>
<td style="background:#f1f1f1;text-align: right;font-weight: bold">&nbsp;
    <?php 
        $sum_debit_tm = $subtotal_aset_tm_db+$subtotal_ekuitas_tm_db+$subtotal_ekuitas_tm_db+$subtotal_biaya_tm_db+$subtotal_kewajiban_tm_db+$subtotal_biaya_lainnya_tm_db+$subtotal_pendapatan_lainnya_tm_db+$subtotal_pendapatan_tm_db;
        $sum_tot_debit_tm = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sum_debit_tm, 0));
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sum_debit_tm, 0));
    ?>
</td>
<td style="background:#f1f1f1;text-align: right;font-weight: bold">&nbsp;
    <?php 
        $sum_credit_tm = ($subtotal_aset_tm_cr+$subtotal_kewajiban_tm_cr)+($subtotal_ekuitas_tm_cr+$subtotal_pendapatan_tm_cr+$subtotal_pendapatan_lainnya_tm_cr+$subtotal_biaya_lainnya_tm_cr+$subtotal_biaya_tm_cr);
        $sum_tot_credit_tm = preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sum_credit_tm, 0));
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sum_credit_tm, 0));
    ?>
</td>
<td style="background:#f1f1f1;text-align: right;font-weight: bold">&nbsp;
    <?php 
        //$sum_ending_balance = ($subtotal_aset_balance+$subtotal_kewajiban_balance)-($subtotal_ekuitas_balance+$subtotal_pendapatan_balance+$subtotal_pendapatan_lainnya_balance+$subtotal_biaya_lainnya_balance+$subtotal_biaya_balance);
        //echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($sum_ending_balance, 0));
		$tot_cccc = ($sum_tot_debit_begining+$sum_tot_debit_tm)-($sum_tot_credit_begining+$sum_tot_credit_tm);
                
                
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_cccc, 0));
//                
//                var_dump("db begining : ".number_format($sum_debit_begining)." ");
//                var_dump("db this mont : ".number_format($sum_debit_tm)." ");
//                var_dump("cr begining : ".number_format($sum_credit_begining)." ");
//                var_dump("cr this mont : ".number_format($sum_credit_tm)." ");
//                
                
    ?>
</td>
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
                     