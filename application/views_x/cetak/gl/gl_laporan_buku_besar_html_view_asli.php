<table width="100%" border="0" align="center">
                                <tr>
                                    <td rowspan="2" width="0%" height="10px"><img src="<?php echo base_url('assets/theme/adm2/img/logo.jpg');?>" style="width: 60px"></td>
                                    <td align="center" style="font-size:25px;font-weight:bold;">PT Mulia Sawit Agro Lestari</td>
                                </tr>
                                <tr>
                                    <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
                                    </td>
                                </tr>
                            </table>
<style type="text/css">
table {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    border-collapse: collapse;
}

.tbl_tr{
  border-bottom:1pt solid black;
  border-collapse: collapse;
}

</style>

<?php 
foreach ($data_entry_head as $v) {

            $html .='<thead>
                                            <tr class="tbl_tr">
                                              <th>'.$v['noac'].'</th>
                                              <th colspan="7" style="text-align:left;padding-left:20px">'.$v['descac'].'</th>
                                          </tr>
                                          <tr class="tbl_tr">
                                              <th>Ref</th>
                                              <th>Date</th>
                                              <th>No Acct</th>
                                              <th>Account Name</th>
                                              <th>Description</th>
                                              <th>Debit</th>
                                              <th>Credit</th>
                                          </tr>
                                          <tr class="tbl_tr">
                                              <th colspan="4"></th>
                                              <th>Begining Balance</th>
                                              <th>Debit</th>
                                              <th>Credit</th>
                                          </tr>
                                      </thead>';

            foreach($data_entry as $a){
              
            if($a['noac'] == $v['noac']){
        

            $b = str_replace( ',', '', $a['DEBET_F'] );
            $c = str_replace( ',', '', $a['DEBET_F2'] );

            $oke = number_format($c, 2, ".", ",");

            $html .= '<tr class="tbl_tr">
              <td align="center">'.$a['ref'].'</td>
              <td align="center">'.$a['TGL'].'</td>
              <td align="left"><div style="padding-left:5px">'.$a['noac'].'</div></td>
              <td align="left"><div style="padding-left:5px">'.$a['descac'].'</div></td>
              <td align="left"><div style="padding-left:5px">'.$a['ket'].'</div></td>
              <td align="right" width="150px"><div style="float:right;">'.$a['DEBET_F'].'</div></td>
              <td align="right" width="150px"><div style="float:right">('.$a['CREDIT_F'].')</div></td>
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
            $bg_color = 'red';
        }else{
            $bg_color = '#efc43f';
        }

        /*<td align="left" style="background-color:'.$bg_color.'"></td>*/
        /*background:#f7f2a0 */
          $html .='<tr>  
          <td width="100px" colspan="5" style="text-align: right;color:black;font-weight: bold;">TOTAL</td>
          <td align="right" width="150px" style="background: '.$bg_color.';color: black;font-weight: bold;border-right:1pt solid black;"><div style="float:right">'. $total_debit.'</div></td>
          <td align="right" width="150px" style="background: '.$bg_color.';color: black;font-weight: bold"><div style="float:right"><div style="float:right">('. $total_kredit.')</div></td>
          </tr>';
        
        }




        
?>

                                  <table id="borderbuttom" style="width: 100%">
                                      <tbody>
                                        <?php echo $html;?>
                                      </tbody>
                                  </table>
