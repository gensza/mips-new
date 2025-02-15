<style>
 table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: white;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: white;
}
table.blueTable thead {
  background: white;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 1px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  color: black;
  border-left: 1px solid #1C6EA4;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  color: #FFFFFF;
  background: white;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 1px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: white;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
.fontsize_global_header{
  font-size: 7px;
}
.font-styles{
    font-family: Verdana, Geneva, sans-serif;
}
</style>

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
  <span style="font-size: 14px">Periode : <?php echo $this->uri->segment(4);?> s/d <?php echo $this->uri->segment(5);?></span>
</div>

<br>

<table class="blueTable font-styles">
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

        $oke = number_format($c, 2, ".", ",");
    ?>
      <tr>
      <td align="center"><?php echo $a['TGL'];?></td>
      <td align="center"><?php echo $a['ref'];?></td>
      <td align="center"><?php echo $a['sbu'];?></td>
      <td align="left"><?php echo $a['noac'];?></td>
      <td align="left"><?php echo $a['descac'];?></td>
      <td align="left"><?php echo $a['ket'];?></td>
      <td align="right"><?php echo $a['DEBET_F'];?></td>
      <td align="right"><?php echo $a['CREDIT_F'];?></td>
      </tr>

    <?php
            
   
      }
      $nos++;
    }

    $total_debit = $v['DBT'];
    $total_kredit = $v['KRD'];

        $total_kredit_nf = $v['KRD_NF'];
        $total_debit_nf = $v['DBT_NF'];

        $bg_color;
        if($total_kredit_nf != $total_debit_nf){
            $bg_color = 'red';
        }else{
            $bg_color = '#ffeec3';
        }

    ?>
      <tr>
      <td width="100px" colspan="6" style="text-align: right;background: white;color:black;">TOTAL</td>

      <td align="right" width="150px" style="background: <?php echo $bg_color;?>;color: black;font-weight: bold"><?php echo $total_debit;?></td>
      <td align="right" width="150px" style="background: <?php echo $bg_color;?>;color: black;font-weight: bold"><?php echo $total_kredit;?></td>
      </tr>
    <?php 
}
?>
  

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