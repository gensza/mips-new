<table width="100%" border="0" align="center">
                                <tr>
                                    <td rowspan="2" width="0%" height="10px"><img src="<?php echo base_url('assets/theme/adm2/img/logo.jpg');?>" style="width: 80px"></td>
                                    <td align="center" style="font-size:25px;font-weight:bold;">PT Mulia Sawit Agro Lestari</td>
                                </tr>
<!--                                <tr>
                                    <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
                                    </td>
                                </tr>-->
                            </table>

                            <hr>

<div style="width: 100%;text-align: center;">
	<span style="font-size: 18px;font-weight:bold">Laporan Saldo Kas/Bank</span>
	<br>
	<span style="font-size: 14px">Periode : <?php echo $this->uri->segment(3);?> / <?php echo $this->uri->segment(4);?></span>
</div>

<style>
 table.blueTable {
  border: 1px solid #FFFFFF;
  background-color: #FFFFFF;
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
  background: #FFFFFF;
}
table.blueTable thead {
  background: white;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: black;
  border-left: 1px solid #444444;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #FFFFFF;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #FFFFFF;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
.fontsize_global_header{
	font-size: 7px;
}
</style>

<br>
<br>

<table class="blueTable">
<thead>
<tr>
<th style="width:2%">No</th>
<th style="width:5%">No Account</th>
<th style="width:20%">Nama</th>
<th style="width:10%">Saldo</th>
</tr>
</thead>
<tbody>
<?php 
$nos = 0+1;
foreach ($list_saldo_akhir as $a) {
?>
      <tr>
      <td align="center"><?php echo $nos;?></td>
      <td align="center"><?php echo $a['ACCTNO'];?></td>
      <td><?php echo $a['ACCTNAME'];?></td>
      <td align="right"><?php echo $a['saldo_f'];?></td>
      </tr>
    <?php
    $nos++;
}
?>
</tbody>
</table>

<br>

<div style="width: 100%;text-align: right;">
  Tanggal : <?php echo date("m/d/Y");?>
  <br>
  Waktu   : <?php 
  date_default_timezone_set("Asia/Bangkok");
  echo date("h:i:s a",time());?>
</div>