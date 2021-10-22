
<?php 
$prd = $this->uri->segment(3);
$thn = substr($prd, 0, 4);
$bln = substr($prd, 4, 6);
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

<table width="100%" border="0" align="center">
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

</style>


<table border="1" width="100%" >
<tbody>
<tr>
<td align="center" rowspan="2">COA</td>
<td align="center" rowspan="2">Name Of Accounts</td>
<td colspan="2" align="center">&nbsp; Beginning Balance</td>
<td colspan="2" align="center">&nbsp; This Month</td>
<td align="center">&nbsp; Ending Balance</td>
</tr>
<tr>
<td align="center" style="width:10%;">&nbsp; Debit</td>
<td align="center" style="width:10%;">&nbsp; Credit</td>
<td align="center" style="width:10%;">&nbsp; Debit</td>
<td align="center" style="width:10%;">&nbsp; Credit</td>
<td>&nbsp;</td>
</tr>
<?php 
    foreach($data_list as $b){
    
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
            $begindb = $b['yeard'] + $b['saldo07d']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
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
            $begindb = $b['yeard'] + $b['saldo11d']+$b['saldo10d']+$b['saldo09d']+$b['saldo08cd']+$b['saldo07cd']+$b['saldo06cd']+$b['saldo05d']+$b['saldo04d']+$b['saldo03d']+$b['saldo02d']+$b['saldo01d'];
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
            $begincr = $b['yearc'] + $b['saldo07c']+$b['saldo05c']+$b['saldo04c']+$b['saldo03c']+$b['saldo02c']+$b['saldo01c'];
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
    <td align="center" width="10%">&nbsp;<?php echo $b['noac'];?></td>
    <td>&nbsp;<?php echo $b['nama'];?></td>
    <td align="right">&nbsp;
        <?php 
            $jums = $begindb - $begincr;
            $jums2 = $begincr-$begindb;
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                $jums = $begindb - $begincr;
                if($jums > 0){
                    $bbd = $jums;
                }else{
                    $bbd = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if($jums2 > 0){
                    $bbd = $jums2*-1;
                }else{
                    $bbd = 0;;
                }
            }
            
            //echo $bbd;
            echo number_format($bbd, 0, ".", ",");
        ?>
    </td>
    <td align="right">&nbsp;
        <?php 
            $jums = $begindb - $begincr;
            $jums2 = $begincr-$begindb;
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                $jums = $begindb - $begincr;
                if($jums < 0){
                    $bbc = $jums*-1;
                }else{
                    $bbc = 0;
                }
            }else if($b['group'] == 'Capital' || $b['group'] == 'Liability' || $b['group'] == 'Revenue' || $b['group'] == 'Other Revenue'){
                if($jums2 > 0){
                    $bbc = $jums2;
                }else{
                    $bbc = 0;
                }
            }
            
           // echo $bbc;
            echo number_format($bbc, 0, ".", ",");
        ?>
    
    </td>
    <td align="right">&nbsp;
        
        <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo01d'];
            }
        }else if($bln == '02'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo02d'];
            }
        }else if($bln == '03'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo03d'];
            }
        }else if($bln == '04'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo04d'];
            }
        }else if($bln == '05'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo05d'];
            }
        }else if($bln == '06'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo06d'];
            }
        }else if($bln == '07'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo07d'];
            }
        }else if($bln == '08'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo08d'];
            }
        }else if($bln == '09'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo09d'];
            }
        }else if($bln == '10'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo10d'];
            }
        }else if($bln == '11'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo11d'];
            }
        }else if($bln == '12'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $dbt = 0;
            }else{
                $dbt = $b['saldo12d'];
            }
        }
        
       // echo $dbt;
        echo number_format($dbt, 0, ".", ",");
        ?>
        </td>
    <td align="right">&nbsp;
        
        <?php 
        //debit
        if($bln == '01'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt =  0;
            }else{
                $crt = $b['saldo01c'];
            }
        }else if($bln == '02'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo02c'];
            }
        }else if($bln == '03'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo03c'];
            }
        }else if($bln == '04'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo04c'];
            }
        }else if($bln == '05'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo05c'];
            }
        }else if($bln == '06'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo06c'];
            }
        }else if($bln == '07'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo07c'];
            }
        }else if($bln == '08'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo08c'];
            }
        }else if($bln == '09'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo09c'];
            }
        }else if($bln == '10'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo10c'];
            }
        }else if($bln == '11'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo11c'];
            }
        }else if($bln == '12'){
            if($b['noac'] == '5030000000' || $b['type'] == 'G'){
                $crt = 0;
            }else{
                $crt = $b['saldo12c'];
            }
        }
        
        echo number_format($crt, 0, ".", ",");
        ?>
    
    </td>
    <td align="right">&nbsp;
        <?php 
            if($b['group'] == 'Expenses' || $b['group'] == 'Asset' || $b['group'] == 'Other Expenses'){
                if(($bbd+$dbt)-($bbc+$crt) > 0){
                    $aaa = ($bbd+$dbt)-($bbc+$crt);
                    echo number_format($aaa, 0, ".", ",");
                }else{
                    $bbb = ($bbd+$dbt)-($bbc+$crt);
                    echo number_format($bbb, 0, ".", ",");
                }
            }else{
                if(($bbc+$crt)-($bbd+$dbt) < 0){
                    $ccc = ($bbd+$crt)-($bbc+$dbt);
                    echo number_format($ccc, 0, ".", ",");
                }else{
                    $ddd = (($bbc+$crt)-($bbd+$dbt)*-1);
                    echo number_format($ddd, 0, ".", ",");
                }
            }
        ?>
    </td>
    </tr>
<?php 
    }    
?>
</tbody>
</table>

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
