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
        font-size: 12px;
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


    .tr_tabel_s {
        border-bottom: 1pt solid black;
        border-top: 1pt solid black;
    }

    .font-styles {
        font-family: Verdana, Geneva, sans-serif;
    }
</style>

<table width="100%" border="0" align="center" class="font-styles">
    <tr>
        <td rowspan="2" width="0%" height="10px"><img src="<?php echo base_url('assets/theme/adm2/img/logo.jpg'); ?>" style="width: 50px"></td>
        <td align="center" style="font-size:25px;">PT Mulia Sawit Agro Lestari</td>
    </tr>
    <!--                                <tr>
        <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
        </td>
    </tr>-->
</table>

<hr>

<table width="100%" border="0" align="center" class="font-styles">
    <tr>
        <td align="center" style="font-size:16px;font-weight:bold;">Account Activity Detail Report<br />
        </td>
    </tr>
    <tr>
        <td align="center">
            <?php
            if ($this->uri->segment(4) == 0) {
            ?>

                Periode Terkini

            <?php
            } else {
            ?>

                Periode : <?php echo $this->uri->segment(4); ?> s/d <?php echo $this->uri->segment(5); ?><br />

            <?php
            }
            ?>

        </td>
    </tr>
</table>



<table class="borderbuttom font-styles">
    <thead></thead>
    <tbody>
        <?php
        $nos = 0 + 1;

        foreach ($data_entry_head as $v) {
            /*
    <th>No Acct</th>
    <th>Account Name</th>
  */

            //begincr
            if ($bulan == '01') {
                $begincr = $v['yearc'];
            } else if ($bulan == '02') {
                $begincr = $v['yearc'] + $v['saldo01c'];
            } else if ($bulan == '03') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'];
            } else if ($bulan == '04') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'];
            } else if ($bulan == '05') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'];
            } else if ($bulan == '06') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'];
            } else if ($bulan == '07') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'];
            } else if ($bulan == '08') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'] + $v['saldo07c'];
            } else if ($bulan == '09') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'] + $v['saldo07c'] + $v['saldo08c'];
            } else if ($bulan == '10') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'] + $v['saldo07c'] + $v['saldo08c'] + $v['saldo09c'];
            } else if ($bulan == '11') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'] + $v['saldo07c'] + $v['saldo08c'] + $v['saldo09c'] + $v['saldo10c'];
            } else if ($bulan == '12') {
                $begincr = $v['yearc'] + $v['saldo01c'] + $v['saldo02c'] + $v['saldo03c'] + $v['saldo04c'] + $v['saldo05c'] + $v['saldo06c'] + $v['saldo07c'] + $v['saldo08c'] + $v['saldo09c'] + $v['saldo10c'] + $v['saldo11c'];
            }


            //begindr
            if ($bulan == '01') {
                $begindr = $v['yeard'];
            } else if ($bulan == '02') {
                $begindr = $v['yeard'] + $v['saldo01d'];
            } else if ($bulan == '03') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'];
            } else if ($bulan == '04') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'];
            } else if ($bulan == '05') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'];
            } else if ($bulan == '06') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'];
            } else if ($bulan == '07') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'];
            } else if ($bulan == '08') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'] + $v['saldo07d'];
            } else if ($bulan == '09') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'] + $v['saldo07d'] + $v['saldo08d'];
            } else if ($bulan == '10') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'] + $v['saldo07d'] + $v['saldo08d'] + $v['saldo09d'];
            } else if ($bulan == '11') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'] + $v['saldo07d'] + $v['saldo08d'] + $v['saldo09d'] + $v['saldo10d'];
            } else if ($bulan == '12') {
                $begindr = $v['yeard'] + $v['saldo01d'] + $v['saldo02d'] + $v['saldo03d'] + $v['saldo04d'] + $v['saldo05d'] + $v['saldo06d'] + $v['saldo07d'] + $v['saldo08d'] + $v['saldo09d'] + $v['saldo10d'] + $v['saldo11d'];
            }

            //
            if (($begindr - $begincr) > 0) {
                $saldoawald = $begindr - $begincr;
            } else {
                $saldoawald = 0;
            }

            //$begining_balance_c
            if (($begindr - $begincr) < 0) {
                $saldoawalc = $begindr - $begincr;
            } else {
                $saldoawalc = 0;
            }

            echo "<tr style='border-bottom:1pt solid black;border-top:1pt solid black;'>
        <th>" . $v['noac'] . "</th>
        <th colspan='7' align='left' style='text-align:left;padding-left:20px'>" . $v['descac'] . "</th>
        </tr>
        <tr style='border-bottom:1pt solid black;'>
            <th align='center'>Ref</th>
            <th align='center'>Date</th>
            <th colspan='4' align='left'>Description</th>
            <th align='center'>Debit</th>
            <th align='center'>Credit</th>
        </tr>
        <tr>
            <th colspan='5'></th>
            <th>Begining Balance</th>
            <th align='right'>" . number_format($saldoawald, 0) . "</th>
            <th align='right'>" . number_format($saldoawalc, 0) . "</th>
        </tr>";

            foreach ($data_entry as $a) {
                if ($a['noac'] == $v['noac']) {

                    $b = str_replace(',', '', $a['DEBET_F']);
                    $c = str_replace(',', '', $a['DEBET_F2']);

                    //$oke = number_format($c, 2, ".", ",");
        ?>
                    <tr style="border-bottom:1pt solid black;">
                        <td align="center" width="10%"><?php echo $a['ref']; ?></td>
                        <td align="center" width="10%"><?php echo $a['TGL']; ?></td>
                        <td align="left" width="70%" colspan='4'><?php echo $a['ket']; ?></td>
                        <td align="right" width="10%"><?php echo number_format($a['DEBET_F2'], 0); ?></td>
                        <td align="right" width="10%"><?php
                                                        if ($a['CREDIT_F2'] > '0') {
                                                            $oke = $a['CREDIT_F2'] * '-1';
                                                            $credits = str_replace("-", "", "" . $oke . "");
                                                            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($credits, 0));
                                                            //echo '('.number_format($credits, 0).')';
                                                        } else {
                                                            echo '' . number_format($a['CREDIT_F2'], 0) . '';
                                                        }
                                                        ?></td>
                    </tr>

            <?php


                }
                $nos++;
            }

            $current_b_kredit = $v['KRD_NF'];
            $current_b_debit  = $v['DBT_NF'];


            //START : MENGHITUNG TOTAL DR
            if ($saldoawald <> '0') {
                $ttldr =  $saldoawald + $current_b_debit;
            } else {
                $ttldr = $current_b_debit;
            }
            //START : MENGHITUNG TOTAL DR


            //START : MENGHITUNG TOTAL CR
            if ($v['KRD_NF'] > '0') {
                $oke = $v['KRD_NF'] * -1;
                $cr  = str_replace("-", "", "" . $oke . "");
            } else {
                $cr  = $v['KRD_NF'];
            }

            if ($saldoawalc <> 0) {
                $ttlcr =  $saldoawalc + $cr;
            } else {
                $ttlcr = $cr;
            }
            //END : MENGHITUNG TOTAL CR

            //START : MENGHITUNG CURRENT BALANCE DEBIT
            if ($v['group'] == 'Asset' || $v['group'] == 'Expenses' || $v['group'] == 'Other Expenses') {
                if (($ttldr + $ttlcr) > '0') {
                    $curbal = $ttldr + $ttlcr;
                } else {
                    $curbal = 0;
                }
            } else {
                if (($ttlcr + $ttldr) > '0') {
                    $curbal = 0;
                } else {
                    $curbal = $ttlcr + $ttldr;
                }
            }
            //END  : MENGHITUNG CURRENT BALANCE DEBIT


            //START : MENGHITUNG CURRENT BALANCE CREDIT
            if ($v['group'] == 'Asset' || $v['group'] == 'Expenses' || $v['group'] == 'Other Expenses') {
                if (($ttldr + $ttlcr) > '0') {
                    $curbalcr = 0;
                } else {
                    $curbalcr = $ttldr + $ttlcr;
                }
            } else {
                if (($ttlcr + $ttldr) > '0') {
                    $curbalcr = $ttlcr + $ttldr;
                } else {
                    $curbalcr = 0;
                }
            }
            //END  : MENGHITUNG CURRENT BALANCE CREDIT


            ?>
            <tr style="border-bottom: 1px solid white;">
                <td width="100px" colspan="6" style="text-align: right;;color:black;border-bottom: 1px solid white;">Total</td>
                <td align="right" width="150px" style="background: <?php echo $bg_color; ?>;color: black;border-bottom: 1px solid white;"><?php echo number_format($ttldr, 0, ".", ","); ?></td> <!-- $total_debit-->
                <td align="right" width="150px" style="background: <?php echo $bg_color; ?>;color: black;border-bottom: 1px solid white;">
                    <?php
                    if ($ttlcr == '0') {
                        echo 0;
                    } else {
                        echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($ttlcr, 0));
                        //echo '('.number_format($ttlcr, 0, ".", ",").')';
                    }
                    ?>
                </td>
            </tr>
            <tr style="border-top: 1px solid white;">
                <td width="100px" colspan="6" style="text-align: right;color:black;">Current Balance</td>
                <td align="right" width="150px" style=";color: black;"><b><?php echo number_format($curbal, 0, ".", ","); ?></b></td>
                <td align="right" width="150px" style=";color: black;"><b>
                        <?php
                        if ($curbalcr == '0') {
                            echo 0;
                        } else {
                            echo preg_replace('/\-([0-9,.]+)/', '(\1)', number_format($curbalcr, 0));
                            //echo '('.number_format($curbalcr, 0, ".", ",").')';
                        }
                        ?></b></td>
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
    Tanggal : <?php echo date("m/d/Y"); ?>
    <br>
    Waktu : <?php
            date_default_timezone_set("Asia/Bangkok");
            echo date("h:i:s a", time()); ?>
</div>