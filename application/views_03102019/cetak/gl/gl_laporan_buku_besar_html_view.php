<table width="100%" border="0" align="center">
                                <tr>
                                    <!--<td rowspan="2" width="0%" height="10px"><img src="<?php echo base_url('assets/theme/adm2/img/logo.jpg');?>" style="width: 30px"></td>-->
                                    <td align="left" style="font-size:14px;font-style: italic;">PT MULIA SAWIT AGRO LESTARI</td>
                                </tr>
                                <tr>
                                    <td align="center" style="font-size:14px;font-weight:bold;">Account Activity Detail Report<br /> 
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                      <?php 
                                        if($this->uri->segment(4) == 0){
                                      ?>

                                      Periode Terkini

                                      <?php 
                                      }else{
                                      ?>

                                      Periode :  <?php echo $this->uri->segment(4);?> s/d <?php echo $this->uri->segment(5);?><br />

                                      <?php 
                                      }
                                      ?>
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">Date : <?php echo date("d/M/Y");?></td>
                                </tr>
                                <tr>
                                    <td align="right">Time : <?php 
  date_default_timezone_set("Asia/Bangkok");
  echo date("h:i:s a",time());?></td>
                                </tr>

                            </table>
                            <br><!-- Periode : 01/02/2019 - 31/01/2019 -->

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
</style>

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

<?php 
foreach ($data_entry_head as $v) {

            $html .='<thead>
                                            <tr class="tbl_tr_top">
                                              <th>'.$v['noac'].'</th>
                                              <th colspan="7" style="text-align:left;padding-left:20px">'.$v['descac'].'</th>
                                          </tr>
                                          <tr class="tbl_tr_top">
                                              <th>Ref</th>
                                              <th>Date</th>
                                              <th align="left"><div style="padding-left:20px">Description<div></th>
                                              <th>Debit</th>
                                              <th>Credit</th>
                                          </tr>
                                          <tr >
                                              <th colspan="2"></th>
                                              <th align="left"><div style="padding-left:20px">Begining Balance<div></th>
                                              <th align="right">0</th>
                                              <th align="right">0</th>
                                          </tr>
                                      </thead>';

            foreach($data_entry as $a){
              
            if($a['noac'] == $v['noac']){
        

            $b = str_replace( ',', '', $a['DEBET_F'] );
            $c = str_replace( ',', '', $a['DEBET_F2'] );

            $oke = number_format($c, 2, ".", ",");

            $html .= '<tr>
              <td align="center" width="10%">'.$a['ref'].'</td>
              <td align="center" width="10%">'.$a['TGL'].'</td>
              <td align="left" width="70%"><div style="padding-left:20px">'.$a['ket'].'</div></td>
              <td align="right" width="10%"><div style="float:right;border-right:1pt solid black;">'.$a['DEBET_F'].'</div></td>
              <td align="right" width="10%"><div style="float:right">('.$a['CREDIT_F'].')</div></td>
              </tr>';

              }
              $nos++;

            }

        $total_debit = $v['DBT'];
        $total_kredit = $v['KRD'];

        
        $total_kredit_nf = $v['KRD_NF'];
        $total_debit_nf = $v['DBT_NF'];

        $bg_color;
        if($total_kredit_nf != $total_debit_nf){
            $bg_color = 'white';
        }else{
            $bg_color = 'white';
        }

        $current_b_kredit = $v['KRD_NF'];
        $current_b_debit  = $v['DBT_NF'];

        $tot_current_b_kredit;
        $tot_current_b_debit;
        if($current_b_kredit > $current_b_debit){
            $tot_current_b_kredit = $current_b_kredit - $current_b_debit;
            $tot_current_b_debit  = 0;
        }else{
            $tot_current_b_debit = $current_b_debit - $current_b_kredit;
            $tot_current_b_kredit  = 0;
        }


          $html .='<tr>  
          <td width="100px" colspan="3" style="text-align: right;color:black;font-weight: bold;">TOTAL</td>
          <td align="right" width="150px" style="background: '.$bg_color.';color: black;font-weight: bold;border-right:1pt solid black;"><div style="float:right">'. $total_debit.'</div></td>
          <td align="right" width="150px" style="background: '.$bg_color.';color: black;font-weight: bold"><div style="float:right"><div style="float:right">('. $total_kredit.')</div></td>
          </tr>
          <tr>  
          <td width="100px" colspan="3" style="text-align: right;color:black;font-weight: bold;">Current Balance</td>
          <td align="right" width="150px" style="background: '.$bg_color.';color: black;font-weight: bold;border-right:1pt solid black;"><div style="float:right">'.number_format($tot_current_b_debit, 2, ".", ",").'</div></td>
          <td align="right" width="150px" style="background: '.$bg_color.';color: black;font-weight: bold"><div style="float:right"><div style="float:right">('.number_format($tot_current_b_kredit, 2, ".", ",").')</div></td>
          </tr>
          ';
        
        }




        
?>

                                  <table id="borderbuttom" style="width: 100%">
                                      <tbody>
                                        <?php echo $html;?>
                                      </tbody>
                                  </table>

<br>
<br>

<table width="100%" border="0" align="center">
                               
                                <tr>
                                    <td align="left" style="font-style: italic;">Generated By System MMOP - Module GL</td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-style: italic;">MIS - PT MULIA SAWIT AGRO LESTARI</td>
                                </tr>

                            </table>