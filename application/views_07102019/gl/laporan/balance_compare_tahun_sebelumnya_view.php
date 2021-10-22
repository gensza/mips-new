<table border="1" width="100%" class="font-style" >
            <tbody>
            <tr>
                <td align="center" style="border:none;font-weight:bold;height: 30px;font-size:14px;">&nbsp;&nbsp; <span style="font-weight:bold;font-size:16px">2016</span></td>
            </tr>   
            <tr>
                <td style="font-weight:bold;height: 30px;font-size:14px">&nbsp;&nbsp; </td>
            </tr>
            <?php 
            foreach($compare_aset_lancar as $a){
            ?>
            <tr>
            <td align="right">&nbsp;
            <?php 
                if($bln == '01'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo01c'];
                }else if($bln == '02'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '03'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '04'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '05'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '06'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '07'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '08'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '09'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo09c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '10'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo10c']+$a['saldo09c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '11'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo11c']+$a['saldo10c']+$a['saldo09c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '12'){
                    $cr_aset_lancar = $a['yearc']+$a['saldo12c']+$a['saldo11c']+$a['saldo10c']+$a['saldo09c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }


                if($bln == '01'){
                    $db_aset_lancar = $a['yeard']+$a['saldo01d'];
                }else if($bln == '02'){
                    $db_aset_lancar = $a['yeard']+$a['saldo02d']+$a['saldo01'];
                }else if($bln == '03'){
                    $db_aset_lancar = $a['yeard']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '04'){
                    $db_aset_lancar = $a['yeard']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '05'){
                    $db_aset_lancar = $a['yeard']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '06'){
                   $db_aset_lancar = $a['yeard']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '07'){
                   $db_aset_lancar = $a['yeard']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '08'){
                    $db_aset_lancar = $a['yeard']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '09'){
                    $db_aset_lancar = $a['yeard']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '10'){
                    $db_aset_lancar = $a['yeard']+$a['saldo10d']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '11'){
                    $db_aset_lancar = $a['yeard']+$a['saldo11d']+$a['saldo10d']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '12'){
                    $db_aset_lancar = $a['yeard']+$a['saldo12d']+$a['saldo11d']+$a['saldo10d']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }

                if($db_aset_lancar <> '0' && $cr_aset_lancar == '0'){
                        $nilaset_lancar = $db_aset_lancar;
                        $tot_aset_lancar += $nilaset_lancar;
                        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilaset_lancar,0));
                }else if($db_aset_lancar == '0' && $cr_aset_lancar <> '0'){
                    if($cr_aset_lancar > '0'){
                        $nilaset_lancar = $cr_aset_lancar*-1;
                        $tot_aset_lancar += $nilaset_lancar;
                        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilaset_lancar,0));
                    }else if($cr_aset_lancar < '0'){
                        $nilaset_lancar = $cr_aset_lancar;
                        $tot_aset_lancar += $nilaset_lancar;
                        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilaset_lancar,0));
                    }
                }else if($db_aset_lancar <> '0' && $cr_aset_lancar <> '0'){
                    $nilaset_lancar = $db_aset_lancar-$cr_aset_lancar;
                    $tot_aset_lancar += $nilaset_lancar;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilaset_lancar,0));
                }
            ?>
            </td>
        </tr>
            <?php 
            }
            ?>
        <tr style="height:30px">
            <td align="right"><b>&nbsp;&nbsp; 
            <?php 
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_aset_lancar,0));
            ?></b>
            </td>
        </tr>
        <tr>
            <td style="font-weight:bold;height: 30px;font-size:14px"><!-- Asset Tidak Lancar --></td>
        </tr>
        <?php 
        $tot_aset_tidak_lancar;
            foreach($compare_aset_tidak_lancar as $a){
            ?>
            <tr>
            <td align="right">&nbsp;
            <?php 
    
                if($bln == '01'){
                    $cr_aset_tidak_lancar = $a['yearc']+$a['saldo01c'];
                }else if($bln == '02'){
                    $cr_aset_tidak_lancar = $a['yearc']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '03'){
                    $cr_aset_tidak_lancar = $a['yearc']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '04'){
                    $cr_aset_tidak_lancar = $a['yearc']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '05'){
                    $cr_aset_tidak_lancar = $a['yearc']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '06'){
                   $cr_aset_tidak_lancar = $a['yearc']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '07'){
                   $cr_aset_tidak_lancar = $a['yearc']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '08'){
                    $cr_aset_tidak_lancar = $a['yearc']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '09'){
                    $cr_aset_tidak_lancar = $a['yearc']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '10'){
                    $cr_aset_tidak_lancar = $a['yearc']+$a['saldo10c']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '11'){
                    $cr_aset_tidak_lancar = $a['yearc']+$a['saldo11c']+$a['saldo10c']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '12'){
                    $cr_aset_tidak_lancar = $a['yearc']+$a['saldo12c']+$a['saldo11c']+$a['saldo10c']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }



                if($bln == '01'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo01d'];
                }else if($bln == '02'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo02d']+$a['saldo01'];
                }else if($bln == '03'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '04'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '05'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '06'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '07'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '08'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '09'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '10'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo10d']+$a['saldo08d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '11'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo11d']+$a['saldo10d']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '12'){
                    $db_aset_tidak_lancar = $a['yeard']+$a['saldo12d']+$a['saldo11d']+$a['saldo10d']+$a['saldo08d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }

                if($db_aset_tidak_lancar <> '0' && $cr_aset_tidak_lancar == '0'){
                        $nilaset_tidak_lancar = $db_aset_tidak_lancar;
                        $tot_aset_tidak_lancar +=$nilaset_tidak_lancar; 
                        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilaset_tidak_lancar,0));
                }else if($db_aset_tidak_lancar == '0' && $cr_aset_tidak_lancar <> '0'){
                    if($cr_aset_tidak_lancar > '0'){
                        $nilaset_tidak_lancar = $cr_aset_tidak_lancar*-1;
                        $tot_aset_tidak_lancar +=$nilaset_tidak_lancar;
                        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilaset_tidak_lancar,0));
                    }else if($cr_aset_tidak_lancar < '0'){
                        $nilaset_tidak_lancar = $cr_aset_tidak_lancar;
                        $tot_aset_tidak_lancar +=$nilaset_tidak_lancar;
                        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilaset_tidak_lancar,0));
                    }
                }else if($db_aset_tidak_lancar <> '0' && $cr_aset_tidak_lancar <> '0'){
                    $nilaset_tidak_lancar = $db_aset_tidak_lancar-$cr_aset_tidak_lancar;
                    $tot_aset_tidak_lancar +=$nilaset_tidak_lancar;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($nilaset_tidak_lancar,0));
                }
            ?>
            </td>
        </tr>
            <?php 
            }
            ?>
        <tr>
            <td align="right" style="height: 30px;font-size:12px">&nbsp;&nbsp;<b>
            <?php 
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_aset_tidak_lancar,0));
            ?></b>
            </td>
        </tr>
        <tr>
            <!-- TOTAL ASET -->
            <td align="right" style="font-weight:bold;font-size: 16px;height: 30px;">&nbsp;&nbsp;<?php 
            echo number_format($tot_aset_lancar+$tot_aset_tidak_lancar,0);?></td>
        </tr>
        
        <!-- KEWAJIBAN LANCAR -->
        <tr style="font-weight:bold;height: 30px;font-size:14px">
            <td>&nbsp;&nbsp; </td>
        </tr>
        <?php 
        $tot_kw_lancar;
        foreach ($balance_kewajiban_lancar as $a){
        ?>
        <tr>
            <td align="right">&nbsp;
            <?php 

                if($bln == '01'){
                    $cr = $a['yearc']+$a['saldo01c'];
                }else if($bln == '02'){
                    $cr = $a['yearc']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '03'){
                    $cr = $a['yearc']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '04'){
                    $cr = $a['yearc']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '05'){
                    $cr = $a['yearc']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '06'){
                   $cr = $a['yearc']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '07'){
                   $cr = $a['yearc']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '08'){
                    $cr = $a['yearc']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '09'){
                    $cr = $a['yearc']+$a['saldo09c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '10'){
                    $cr = $a['yearc']+$a['saldo10c']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '11'){
                    $cr = $a['yearc']+$a['saldo11c']+$a['saldo10c']+$a['saldo09c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }else if($bln == '12'){
                    $cr = $a['yearc']+$a['saldo12c']+$a['saldo11c']+$a['saldo10c']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
                }



                if($bln == '01'){
                    $db = $a['yeard']+$a['saldo01d'];
                }else if($bln == '02'){
                    $db = $a['yeard']+$a['saldo02d']+$a['saldo01'];
                }else if($bln == '03'){
                    $db = $a['yeard']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '04'){
                    $db = $a['yeard']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '05'){
                    $db = $a['yeard']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '06'){
                    $db = $a['yeard']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '07'){
                    $db = $a['yeard']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '08'){
                    $db = $a['yeard']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '09'){
                    $db = $a['yeard']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '10'){
                    $db = $a['yeard']+$a['saldo10d']+$a['saldo08d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '11'){
                    $db = $a['yeard']+$a['saldo11d']+$a['saldo10d']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }else if($bln == '12'){
                    $db = $a['yeard']+$a['saldo12d']+$a['saldo11d']+$a['saldo10d']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
                }




                if($db == '0' && $cr <> '0'){
                    if($cr > '0'){
                        $v_kw_lancar = $cr;
                        $tot_kw_lancar +=$v_kw_lancar;
                        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_kw_lancar,0));
                    }else{
                        $v_kw_lancar = $cr;
                        $tot_kw_lancar +=$v_kw_lancar;
                        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_kw_lancar,0));
                    }
                }else if($db <> '0' && $cr == '0'){
                    if($db > '0'){
                        $v_kw_lancar = $db*-1;
                        $tot_kw_lancar +=$v_kw_lancar;
                        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_kw_lancar,0));
                    }else{
                        $v_kw_lancar = $db;
                        $tot_kw_lancar +=$v_kw_lancar;
                        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_kw_lancar,0));
                    }
                }else if($db <> '0' && $cr <> '0'){
                    $v_kw_lancar = $db-$cr;
                    $tot_kw_lancar +=$v_kw_lancar;
                    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_kw_lancar,0));
                }
            ?>
            </td>
        </tr>
        <?php 
        }
        ?>
        <tr>
            <td style="font-weight:bold;height: 30px;font-size: 12px;" align="right">&nbsp;&nbsp;<?php 
            echo number_format($tot_kw_lancar,0);?></td>
        </tr>
        <!-- KEWAJIBAN LANCAR -->
        
        
        
        
        <tr>
    <td style="font-weight:bold;height: 30px;font-size:14px">&nbsp;
        <!-- KEWAJIBAN TIDAK LANCAR -->
    </td>
</tr>
<?php 
$tot_kw_tidak_lancar;
foreach ($balance_kewajiban_tidak_lancar as $a){
?>
<tr>
    <td align="right">&nbsp;
    <?php 
    
        if($bln == '01'){
            $cr_kw_tidak_lancar = $a['yearc']+$a['saldo01c'];
        }else if($bln == '02'){
            $cr_kw_tidak_lancar = $a['yearc']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '03'){
            $cr_kw_tidak_lancar = $a['yearc']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '04'){
            $cr_kw_tidak_lancar = $a['yearc']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '05'){
            $cr_kw_tidak_lancar = $a['yearc']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '06'){
           $cr_kw_tidak_lancar = $a['yearc']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '07'){
           $cr_kw_tidak_lancar = $a['yearc']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '08'){
            $cr_kw_tidak_lancar = $a['yearc']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '09'){
            $cr_kw_tidak_lancar = $a['yearc']+$a['saldo09c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '10'){
            $cr_kw_tidak_lancar = $a['yearc']+$a['saldo10c']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '11'){
            $cr_kw_tidak_lancar = $a['yearc']+$a['saldo11c']+$a['saldo10c']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '12'){
            $cr_kw_tidak_lancar = $a['yearc']+$a['saldo12c']+$a['saldo11c']+$a['saldo10c']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }
        
        
        
        if($bln == '01'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo01d'];
        }else if($bln == '02'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo02d']+$a['saldo01'];
        }else if($bln == '03'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '04'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '05'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '06'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '07'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '08'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '09'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '10'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo10d']+$a['saldo08d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '11'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo11d']+$a['saldo10d']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '12'){
            $db_kw_tidak_lancar = $a['yeard']+$a['saldo12d']+$a['saldo11d']+$a['saldo10d']+$a['saldo09d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }
        
        if($db_kw_tidak_lancar == '0' && $cr_kw_tidak_lancar <> '0'){
            if($cr_kw_tidak_lancar > '0'){
                $v_kw_tidak_lancar = $cr_kw_tidak_lancar;
                $tot_kw_tidak_lancar +=$v_kw_tidak_lancar;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_kw_tidak_lancar,0));
            }else{
                $v_kw_tidak_lancar = $cr_kw_tidak_lancar;
                $tot_kw_tidak_lancar +=$v_kw_tidak_lancar;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_kw_tidak_lancar,0));
            }
        }else if($db_kw_tidak_lancar <> '0' && $cr_kw_tidak_lancar == '0'){
            if($db_kw_tidak_lancar > '0'){
                $v_kw_tidak_lancar = $db_kw_tidak_lancar*-1;
                $tot_kw_tidak_lancar +=$v_kw_tidak_lancar;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_kw_tidak_lancar,0));
            }else{
                $v_kw_tidak_lancar = $db_kw_tidak_lancar;
                $tot_kw_tidak_lancar +=$v_kw_tidak_lancar;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_kw_tidak_lancar,0));
            }
        }else if($db_kw_tidak_lancar <> '0' && $cr_kw_tidak_lancar <> '0'){
            $v_kw_tidak_lancar = $db_kw_tidak_lancar-$cr_kw_tidak_lancar;
            $tot_kw_tidak_lancar +=$v_kw_tidak_lancar;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_kw_tidak_lancar,0));
        }
    ?>
    </td>
</tr>
<?php 
}
?>
<tr>
    <!-- TOTAL KEWAJIBAN TIDAK LANCAR -->
    <td align="right" style="font-weight:bold;font-size: 12px;height: 30px;">&nbsp;&nbsp;<?php 
    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($tot_kw_tidak_lancar,0));?></td>
</tr>


<tr>
    <td align="right" style="font-size:12px;height: 30px;"><b>&nbsp;&nbsp; <?php 
    $totals_kw = $tot_kw_lancar+$tot_kw_tidak_lancar;
    echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($totals_kw,0));?>
        </b>
    </td>
</tr>

<!-- EKUITAS -->
<tr style="font-weight:bold;height: 30px;font-size:14px">
    <td>&nbsp;&nbsp; </td>
</tr>

<?php 
$tot_ekuitas;
foreach ($balance_ekuitas as $a){
?>
<tr>
    <td align="right">&nbsp;
    <?php 
    
        if($bln == '01'){
            $cr_ekuitas = $a['yearc']+$a['saldo01c'];
        }else if($bln == '02'){
            $cr_ekuitas = $a['yearc']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '03'){
            $cr_ekuitas = $a['yearc']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '04'){
            $cr_ekuitas = $a['yearc']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '05'){
            $cr_ekuitas = $a['yearc']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '06'){
           $cr_ekuitas = $a['yearc']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '07'){
           $cr_ekuitas = $a['yearc']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '08'){
            $cr_ekuitas = $a['yearc']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '09'){
            $cr_ekuitas = $a['yearc']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '10'){
            $cr_ekuitas = $a['yearc']+$a['saldo10c']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '11'){
            $cr_ekuitas = $a['yearc']+$a['saldo11c']+$a['saldo10c']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }else if($bln == '12'){
            $cr_ekuitas = $a['yearc']+$a['saldo12c']+$a['saldo11c']+$a['saldo10c']+$a['saldo08c']+$a['saldo08c']+$a['saldo07c']+$a['saldo06c']+$a['saldo05c']+$a['saldo04c']+$a['saldo03c']+$a['saldo02c']+$a['saldo01c'];
        }
        
        
        
        if($bln == '01'){
            $db_ekuitas = $a['yeard']+$a['saldo01d'];
        }else if($bln == '02'){
            $db_ekuitas = $a['yeard']+$a['saldo02d']+$a['saldo01'];
        }else if($bln == '03'){
            $db_ekuitas = $a['yeard']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '04'){
            $db_ekuitas = $a['yeard']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '05'){
            $db_ekuitas = $a['yeard']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '06'){
            $db_ekuitas = $a['yeard']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '07'){
            $db_ekuitas = $a['yeard']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '08'){
            $db_ekuitas = $a['yeard']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '09'){
            $db_ekuitas = $a['yeard']+$a['saldo08d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '10'){
            $db_ekuitas = $a['yeard']+$a['saldo10d']+$a['saldo08d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '11'){
            $db_ekuitas = $a['yeard']+$a['saldo11d']+$a['saldo10d']+$a['saldo08d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }else if($bln == '12'){
            $db_ekuitas = $a['yeard']+$a['saldo12d']+$a['saldo11d']+$a['saldo10d']+$a['saldo08d']+$a['saldo08d']+$a['saldo07d']+$a['saldo06d']+$a['saldo05d']+$a['saldo04d']+$a['saldo03d']+$a['saldo02d']+$a['saldo01d'];
        }
        

        
        
        if($db_ekuitas == '0' && $cr_ekuitas <> '0'){
            if($cr_ekuitas > '0'){
                $v_ekuitas = $cr_ekuitas;
                $tot_ekuitas +=$v_ekuitas;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_ekuitas,0));
            }else{
                $v_ekuitas = $cr_ekuitas;
                $tot_ekuitas +=$v_ekuitas;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_ekuitas,0));
            }
        }else if($db_ekuitas <> '0' && $cr_ekuitas == '0'){
            if($db_ekuitas > '0'){
                $v_ekuitas = $db_ekuitas*-1;
                $tot_ekuitas +=$v_ekuitas;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_ekuitas,0));
            }else{
                $v_ekuitas = $db_ekuitas;
                $tot_ekuitas +=$v_ekuitas;
                echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_ekuitas,0));
            }
        }else if($db_ekuitas <> '0' && $cr_ekuitas <> '0'){
            $v_ekuitas = $db_ekuitas-$cr_ekuitas;
            $tot_ekuitas +=$v_ekuitas;
            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($v_ekuitas,0));
        }
    ?>
    </td>
</tr>
<?php 
}
?>

<tr>
    <!-- TOTAL EKUITAS -->
    <td align="right" style="font-weight:bold;font-size:12px;height: 30px;">&nbsp;&nbsp;<?php 
    echo number_format($tot_ekuitas,0);?></td>
</tr>

<tr>
    <!-- KEWAJIBAN + EQUITAS -->
    <td align="right" style="font-weight:bold;height: 30px;font-size: 17px">&nbsp;&nbsp;<?php 
    $ok = $tot_kw_lancar+$tot_kw_tidak_lancar;
    echo number_format($tot_ekuitas+$ok,0);?></td>
</tr>
        
</tbody>
</table>