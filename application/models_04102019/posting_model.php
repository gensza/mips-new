<?php 
function posting_harian(){


            //ini group dulu berdasarkan noac
            $period = $this->periode();


            $DEBIT  = 'saldo'.substr($period, 4, 6).'d';
            $KREDIT = 'saldo'.substr($period, 4, 6).'c';
            
            $sql = "SELECT  noac,
                    periode,
                    `group`, 
                    SUM(dr) AS SumOfdr, 
                    SUM(cr) AS SumOfcr 
            FROM entry
            WHERE SUBSTR(periodetxt,1,6) = '$period'
            GROUP BY periode,noac,`group`";
            $sql_act = $this->mips_gl->query($sql)->result_array();

            //Start : STEP 1
            foreach ($sql_act as $a) {

                $KODECOA = $a['noac'];
                
                //$TOTALDR1;
                //$TOTALCR1;
                
                if($a['group'] == 'Asset' || $a['group'] == 'Expenses' || $a['group'] == 'Other Expenses'){
                    
                    
                    if($a['SumOfcr'] <> 0 && $a['SumOfdr'] <> 0){

                        $TOTALDR_TOT = $a['SumOfdr'] - $a['SumOfcr'];
                        if($TOTALDR_TOT > 0){
                            $TOTALDR1 = $TOTALDR_TOT;
                            $TOTALCR1 = 0;
                        }else{
                            $TOTALCR1 = $TOTALDR_TOT * -1;
                            $TOTALDR1 = 0;
                        }

                    }else if($a['SumOfcr'] <> 0 && $a['SumOfdr'] == 0){

                        if($a['SumOfcr'] > 0){
                            $TOTALCR1 = $a['SumOfcr'];
                            $TOTALDR1 = 0;
                        }else{
                            $TOTALDR1 = $a['SumOfcr'] * -1;
                            $TOTALCR1 = 0;
                        }

                    }else if($a['SumOfdr'] <> 0 && $a['SumOfcr'] == 0){

                        if($a['SumOfdr'] > 0){
                            $TOTALDR1 = $a['SumOfdr'];
                            $TOTALCR1 = 0;
                        }else{
                            $TOTALCR1 = $a['SumOfdr'] * -1;
                            $TOTALDR1 = 0;
                        }

                    }

                }else{

                    $TOTALCR_TOT = $a['SumOfcr'] - $a['SumOfdr'];

                    if($a['SumOfdr'] <> 0 && $a['SumOfcr'] <> 0){

                        if($TOTALCR_TOT > 0){
                            $TOTALCR1 = $TOTALCR_TOT;
                            $TOTALDR1 = 0;
                        }else{
                            $TOTALDR1 = $TOTALCR_TOT * -1;
                            $TOTALCR1 = 0;
                        }

                    }else if($a['SumOfdr'] <> 0 && $a['SumOfcr'] == 0){

                        if($a['SumOfdr'] > 0){
                            $TOTALDR1 = $a['SumOfdr'];
                            $TOTALCR1 = 0;
                        }else{
                            $TOTALCR1 = $a['SumOfdr'] * -1;
                            $TOTALDR1 = 0;
                        }

                    }else if($a['SumOfdr'] == 0 && $a['SumOfcr'] <> 0){

                        if($a['SumOfcr'] > 0){
                            $TOTALCR1 = $a['SumOfcr'];
                            $TOTALDR1 = 0;
                        }else{
                            $TOTALDR1 = $a['SumOfcr'] * -1;
                            $TOTALCR1 = 0;
                        }

                    }

                }


                //$sql2 = "SELECT COUNT(*) as hasil_count FROM noac WHERE noac = '$KODECOA'";
                //$sql_act2 = $this->mips_gl->query($sql2)->row_array();
                
                $sql2 = "SELECT * FROM noac WHERE noac = '$KODECOA'";
                $sql_act2 = $this->mips_gl->query($sql2)->num_rows();
                
                if($sql_act2 >= 1){
                    // Masih Ragu
                    $sql3 = "UPDATE noac SET balancedr  = 0,
                                             balancecr  = 0,
                                             ".$DEBIT." = $TOTALDR1,
                                             ".$KREDIT."= $TOTALCR1 
                                            WHERE noac  = '$KODECOA' ";
                    $this->mips_gl->query($sql3);

                }else{

                }



                //TABLE NOAC FILTER LIKE Expenses
                $sql_act3 = "SELECT SUM(".$DEBIT.") AS TTLDB,
                                    SUM(".$KREDIT.") AS TTLCR 
                            FROM noac WHERE `type` = 'D' AND `group` LIKE '%Expenses%'";
                $k_sql3   = $this->mips_gl->query($sql_act3)->row_array();

                $TTLDB2 = $k_sql3['TTLDB'];
                $TTLCR2 = $k_sql3['TTLCR'];


                if($TTLDB2 <> 0){
                    $TTLB_DB22 = $TTLDB2;
                }else{
                    $TTLB_CR22 = 0;
                }

                if($TTLB_CR22 <> 0){
                    $TTLB_CR22 = $TTLCR2;
                }else{
                    $TTLB_CR22 = 0;
                }


                //TABLE NOAC FILTER LIKE Revenue
                $sql_act4 = "SELECT  SUM(".$DEBIT.") AS TTLDB,
                                SUM(".$KREDIT.") AS TTLCR 
                            FROM noac WHERE `type` = 'D' AND `group` LIKE '%Revenue%'";
                $k_sql4   = $this->mips_gl->query($sql_act4)->row_array();

                $TTLDB4 = $k_sql4['TTLDB'];
                $TTLCR4 = $k_sql4['TTLCR'];
                //$TTLBIAYA;
                //$TTLDAPAT;


                if($TTLDB4 <> 0){
                    $TTLB_DB22 = $TTLDB4;
                }else{
                    $TTLB_DB22 = 0;
                }

                if($TTLCR4 <> 0){
                    $TTLB_CR22 = $TTLCR4;
                }else{
                    $TTLB_CR22 = 0;
                }

                if($TTLB_DB22 <> 0 && $TTLB_CR22 <> 0){
                    $TTLBIAYA = $TTLB_DB22 - $TTLB_CR22;
                }else if($TTLB_DB22 <> 0 && $TTLB_CR22 == 0){
                    $TTLBIAYA = $TTLB_DB22;
                }else if($TTLB_DB22 == 0 && $TTLB_CR22 == 0){
                    $TTLBIAYA = 0-$TTLB_CR22;
                }


                if($TTLB_DB22 <> 0 && $TTLB_CR22 <> 0){
                    $TTLDAPAT = $TTLB_CR22 - $TTLB_DB22;
                }else if($TTLB_DB22 <> 0 && $TTLB_CR22 == 0){
                    $TTLDAPAT = 0 - $TTLB_DB22;
                }else if($TTLB_DB22 == 0 && $TTLB_CR22 == 0){
                    $TTLDAPAT = $TTLB_CR22;
                }


                //$TTLRL;
                if($TTLDAPAT <> 0 && $TTLBIAYA <> 0){
                   $TTLRL = $TTLDAPAT - $TTLBIAYA;     
                }else if($TTLDAPAT <> 0 && $TTLBIAYA == 0){
                   $TTLRL = $TTLDAPAT; 
                }else if($TTLDAPAT == 0 && $TTLBIAYA <> 0){
                   if($TTLBIAYA > 0){
                        $TTLRL = $TTLBIAYA * -1;   
                   }else{
                        $TTLRL = $TTLBIAYA;
                   }
                }else if($TTLDAPAT == 0 && $TTLBIAYA == 0){
                   $TTLRL = 0; 
                }else{

                }
               

                //aku coa 'LABA TAHUN BERJALAN'
                $LR2 = '504500000000000'; //noac 16 digit
                //$LR2 = '5030000000'; //noac 10 digit

                $sql_act5 = "UPDATE noac SET ".$KREDIT." = '$TTLRL',
                                            ".$DEBIT." = 0,
                                            balancedr = 0,
                                            balancecr = '$TTLRL'
                                        WHERE noac = '$LR2'";
                $this->mips_gl->query($sql_act5);

                //}
                //END : STEP 1

                // <SELESAI TABEL ENTRY>

                //HITUNG NILAI GENERAL
                $sql6 = "SELECT * FROM noac WHERE `type` = 'G' ORDER BY NOAC ASC";
                $kk_act = $this->mips_gl->query($sql6)->result_array();

                $sql896 = "SELECT * FROM noac WHERE `type` = 'G' ORDER BY NOAC ASC";
                $kkss = $this->mips_gl->query($sql896)->num_rows();

                if($kkss > 0){

                    foreach ($kk_act as $a) {

                        $sqlm = "SELECT  SUM(saldo01d) AS TTLDB,
                                        SUM(saldo01c) AS TTLCR,
                                        SUM(YEARD) AS SALDOB,
                                        SUM(YEARC) AS SALDOC,
                                        SUM(BALANCEDR) AS AWALD,
                                        SUM(BALANCECR) AS AWALC 
                                    FROM noac WHERE general <> '*' AND general = '$a[general]'";   
                        $sql_ax = $this->mips_gl->query($sqlm)->result_array();

                        foreach ($sql_ax as $y) {

                            if($y['group'] == 'Asset' || $y['group'] == 'Expenses' || $y['group'] == 'Other Expenses'){

                                $nama  = $y['nama'];
                                $TTLDB44 = $y['TTLDB'];
                                $TTLCR44 = $y['TTLCR'];

                                $TOTALDR2;
                                $TOTALCR2;

                                if($TTLCR44 <> 0 && $TTLDB44 <> 0){
                                    $TOTALDR = $TTLDB44 - $TTLCR44;
                                    if($TOTALDR > 0){
                                        $TOTALDR = $TOTALDR;
                                        $TOTALCR = 0;
                                    }else{
                                        $TOTALCR = $TOTALDR *-1;
                                        $TOTALDR = 0;
                                    }
                                }else if ($TTLCR44 <> 0 && $TTLDB44 == 0) {
                                    $TOTALCR = $TTLCR44;
                                    $TOTALDR = 0;
                                }else if ($TTLDB44 <> 0 && $TTLCR44 == 0) {
                                    $TOTALDR = $TTLDB44;
                                    $TOTALCR = 0;
                                }else if ($TTLDB44 == 0 && $TTLCR44 == 0) {
                                    $TOTALDR = 0;
                                    $TOTALCR = 0;
                                }

                                    $sql_act55 = "UPDATE noac SET   ".$KREDIT."= '$TOTALCR',
                                                                    ".$DEBIT." = '$TOTALDR',
                                                                    balancedr    = 0,
                                                                    balanceCr    = 0 ";
                                    $this->mips_gl->query($sql_act55);

                            }else{

                                //'UNTUK REVENUE LIABILITY
                                $TTLDB55 = $y['TTLDB'];
                                $TTLCR55 = $y['TTLCR'];

                                if($TTLDB55 <> 0 && $TTLCR55 <> 0){
                                    $TOTALCR = $TTLCR55 - $TTLDB55;
                                    if($TOTALCR > 0){
                                        $TOTALCR = $TOTALCR;
                                        $TOTALDR = 0;
                                    }else{
                                        $TOTALDR = $TOTALCR *-1;
                                        $TOTALCR = 0;
                                    }
                                }else if ($TTLDB55 <> 0 && $TTLCR55 == 0) {
                                    $TOTALDR = $TTLDB55;
                                    $TOTALCR = 0;
                                }else if ($TTLDB55 == 0 && $TTLCR55 <> 0) {
                                    $TOTALCR = $TTLCR55;
                                    $TOTALDR = 0;
                                }else if ($TTLDB55 == 0 && $TTLCR55 == 0) {
                                    $TOTALDR = 0;
                                    $TOTALCR = 0;
                                }

                                $sql_act66 = "UPDATE noac SET   ".$KREDIT."= '$TOTALCR',
                                                                    ".$DEBIT." = '$TOTALDR',
                                                                    balancedr    = 0,
                                                                    balanceCr    = 0 ";
                                    $this->mips_gl->query($sql_act66);

                            }


                        }
                    }
                }


            $sql_act77 = "UPDATE entry SET POST = 1 WHERE periode = '$period'";
            return $this->mips_gl->query($sql_act77);


        }

    }
?>