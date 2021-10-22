

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Transaksi Voucher</title>
	
</head>


<style type="text/css">

{ margin: 0; padding: 0; }
body { font: 14px/1.4 Georgia, serif; }
#page-wrap { width: 100%; margin: 0 auto; }

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 5px; }

#header {width: 100%; margin: 0px 0; background: #f0f0f0;border :1px solid black; text-align: center; color: black; font: bold 20px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 10px; padding: 8px 0px; }
#header2 { width: 100%; background: white;border :1px solid black; text-align: center; color: black; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase;padding: 10px 0px; }

#customer { overflow: hidden; }

#logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
#logo:hover, #logo.edit { border: 1px solid #000; margin-top: 0px; max-height: 125px; }
#logoctr { display: none; }
#logo:hover #logoctr, #logo.edit #logoctr { display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px; }
#logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
#logohelp input { margin-bottom: 5px; }
.edit #logohelp { display: block; }
.edit #save-logo, .edit #cancel-logo { display: inline; }
.edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
#customer-title { font-size: 20px; font-weight: bold; float: left; }

#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 800px; }
#items td.item-name { width: 255px; }
#items td.jumlah { width: 200px;text-align: right; }
#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { text-transform: uppercase; font: 10px Helvetica, Sans-Serif; letter-spacing: 5px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms textarea { width: 100%; text-align: center;}



table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
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
  background: #D0E4F5;
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
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
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
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
.fontsize_global_header{
	font-size: 7px;
}

</style>

<body>

	<div id="page-wrap">
		<div id="header2"><img src="./assets/logo/<?php echo $pt['logo'];?>" style="width: 50px">
		<br> <?php echo $pt['nama'];?></div>
		<div id="header">BUKTI BANK KELUAR</div>
		
		
		
		<div style="clear:both"></div>
		
		<br>

		<div style="width: 100%">
		<div id="customer" style="float: left;width: 80%">

            <table id="me-ta" width="95%">
            	<tr>
                    <td class="meta-head" style="width: 140px">No. </td>
                    <td>: <?php echo $h_vouc['VOUCNO'];?> / No. Perk :</td>
                </tr>
                <tr>
                    <td class="meta-head">Dibayarkan Kepada </td>
                    <td>: <?php echo $h_vouc['FROM'];?></td>
                </tr>

            </table>
		
		</div>

		<div id="customerc" style="width: 20%;float: right;">

            <table id="me-ta" width="95%">
                <tr>
                    <td class="meta-head" style="width: 60px">Tanggal</td>
                    <td>: <?php echo $h_vouc['TGL'];?></td>
                </tr>
                <tr>
                    <td class="meta-head">Lampiran</td>
                    <td>: -</td>
                </tr>

            </table>
		
		</div>
		</div>
		
		<table id="items" class="blueTable" style="font-size: 15px">
		
		  <tr>
		      <th>Perkiraan</th>
		      <th>Uraian</th>
		      <th>Jumlah</th>
		  </tr>
			  <?php 
			  foreach ($d_vouc as $v) {
			  ?>
			<tr>
			      <td class="item-name"><?php echo $v['ACCTNO'];?></td>
			      <td class="description"><?php echo $v['REMARKS'];?></td>
			      <td class="jumlah"><?php echo $v['CREDIT_F'];?></td>
			</tr>
		  	<?php 
				}
		  	?>
		  
		  <tr>
		      <td colspan="2" class="blank"><br><br><br></td>
		      <td colspan="2" class="total-line" style="text-align: right;"><b><?php echo $h_vouc['amount'];?></b></td>
		  </tr>

		  <tr id="hiderow" style="background: #f0f0f0">
		    <td colspan="5" class="total-value balance"><b>TERBILANG</b> : <?php echo $h_vouc['PAY'];?></td>
		  </tr>
		
		</table>
		

		<table style="width: 100%">
		  <tr>
		    <th style="width: 200px">Diperiksa Oleh,</th>
		    <th>Mengetahui</th>
		    <th>Menyetujui</th>
		    <th style="width: 200px">Kasir</th>
		    <th>Di Terima Oleh,</th>
		  </tr>
		  <tr>
		    <td style="height:100px"></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		  </tr>
		</table>



		<div id="terms">
		  <h5>Cash & Bank System / <?php echo date('d-M-Y H:i:s');?></h5>
		</div>
	
	</div>
	
</body>

</html><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

