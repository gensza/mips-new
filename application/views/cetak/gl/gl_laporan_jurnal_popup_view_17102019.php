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
  font-family: Arial, Helvetica, sans-serif;
  font-size: 11px;
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


.tr_tabel_s{
  border-bottom:1pt solid black;
  border-top:1pt solid black;
}

.font-styles{
    font-family: Verdana, Geneva, sans-serif;
}
</style>

<title>Journal</title>

<table width="100%" border="0" align="center" class="font-styles">
                                <tr>
                                    <td rowspan="2" width="0%" height="10px"><img src="<?php echo base_url('assets/theme/adm2/img/logo.jpg');?>" style="width: 50px"></td>
                                    <td align="center" style="font-size:25px;">PT Mulia Sawit Agro Lestari</td>
                                </tr>
<!--                                <tr>
                                    <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
                                    </td>
                                </tr>-->
                            </table>

<hr>

<div style="width: 100%;text-align: center;" class="font-styles">
    <span style="font-size: 18px">GL - Journal Report</span>
    <br>
    <span style="font-size: 14px">
        <?php 
            if($this->uri->segment(4) == 0){
        ?>
        Periode : <?php echo $bulan.'/'.$tahun;?>
        <?php 
            }else{
        ?>
        Periode : <?php echo $this->uri->segment(4);?> s/d <?php echo $this->uri->segment(5);?>
        <?php 
        }
        ?>
    </span>
        
      
</div>

<table class="borderbuttom font-styles">
<thead>
<tr>
    <th>Date</th>
    <th>Ref</th>
    <th>Devisi</th>
    <th>No Acct</th>
    <th>Account Name</th>
    <th>Description</th>
    <th>Debit</th>
    <th>Credit</th>
</tr>
</thead>
<tbody>
  <?php 
$nos = 0+1;

foreach ($data_entry_head as $v) {

    foreach($data_entry as $a){
      if($a['ref'] == $v['ref']){

        $b = str_replace( ',', '', $a['DEBET_F'] );
        $c = str_replace( ',', '', $a['DEBET_F2'] );

        $oke = number_format($c, 0, ".", ",");
    ?>
    <tr style="border: 0px solid #FFFFFF;">
        <td align="center" style="width:5%"><?php echo $a['TGL'];?></td>
        <td align="center"><?php echo $a['ref'];?></td>
        <td align="center"><?php echo $a['sbu'];?></td>
        <td align="left"><?php echo $a['noac'];?></td>
        <td align="left"><div style="padding-left:3%"><?php echo $a['descac'];?></div></td>
        <td align="left"><?php echo $a['ket'];?></td>
        <td align="right"><?php echo $a['DEBET_F'];?></td>
        <td align="right">
            <?php 
            $crf = $a['CREDIT_F2']*-1;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($crf, 0));
            ?>
        </td>
    </tr>
    <?php
        }
        $nos++;
    }

    $total_debit = $v['DBT'];
    $total_kredit = $v['KRD_NF'];

        $total_kredit_nf = $v['KRD_NF'];
        $total_debit_nf = $v['DBT_NF'];

        $bg_color;
        if($total_kredit_nf != $total_debit_nf){
            $bg_color = 'white';
        }else{
            $bg_color = 'white';
        }

    ?>
      <tr style="border: 1px solid black;">
      <td width="100px" colspan="6" style="text-align: right;background: white;color:black;font-weight: bold;">Sub Total</td>

      <td align="right" width="150px" style="background: <?php echo $bg_color;?>;color: black;font-weight: bold;"><?php echo $total_debit;?></td>
      <td align="right" width="150px" style="background: <?php echo $bg_color;?>;color: black;font-weight: bold;">
        <?php  
        $crfa = $total_kredit*-1;
        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($crfa, 0));
        ?>
      </td>
      </tr>
    <?php 
}
?>
      
      <tr>
      <td width="100px" colspan="6" style="text-align: right;background: white;color:black;font-size:12px"></td>

      <td align="right" width="150px" style="color: black;font-weight: bold;font-size:12px"></td>
      <td align="right" width="150px" style="color: black;font-weight: bold;font-size:12px"></td>
      </tr>
<br>
<br>
    <tr style="background:#f3f3f3">
        <td width="100px" colspan="6" style="text-align: right;background: white;color:black;font-size:12px">Grand Total</td>
        <td align="right" width="150px" style="color: black;font-weight: bold;font-size:12px"><?php echo number_format($data_entry_sum['grand_total_dr'],2);?></td>
        <td align="right" width="150px" style="color: black;font-weight: bold;font-size:12px">
            <?php
                $crfac = $data_entry_sum['grand_total_cr']*-1;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($crfac, 2));
            ?>
        </td>
    </tr>
  

</tbody>
</table>


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