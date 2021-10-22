<?php 
class Gl_lap_model extends CI_Model{	
    
    function __construct() {
        parent::__construct();
        //$this->load->database();
        $this->mips_gl = $this->load->database('mips_gl', TRUE);
        //$this->mstcode = $this->load->database('mstcode', TRUE);
        
    }
    
    function get_id_lokasi(){
        return $this->session->userdata('sess_id_lokasi');
    }
    
    function get_nama_lokasi(){
        return $this->session->userdata('sess_nama_lokasi');
    }
    
    function get_sess_pt(){
        return $this->session->userdata('sess_pt');
    }
    
    function periode(){
        
        $period = $this->session->userdata('sess_periode');
        $tahun  = substr($period, 0, 4);
        return $tahun;
        
    }
    
    function set_filter_year(){
        
        $field = "AND (saldo01c <> 0 OR saldo01d <> 0  
                    OR saldo02c <> 0 AND saldo02d <> 0 
                    OR saldo03c <> 0 AND saldo03d <> 0
                    OR saldo04c <> 0 AND saldo04d <> 0
                    OR saldo05c <> 0 AND saldo05d <> 0
                    OR saldo06c <> 0 AND saldo06d <> 0
                    OR saldo07c <> 0 AND saldo07d <> 0
                    OR saldo08c <> 0 AND saldo08d <> 0
                    OR saldo09c <> 0 AND saldo09d <> 0
                    OR saldo10c <> 0 AND saldo10d <> 0
                    OR saldo11c <> 0 AND saldo11d <> 0
                    OR saldo12c <> 0 AND saldo12d <> 0
                    OR yearc <> 0
                    OR yeard <> 0)";
        return $field;
        
    }
    
    function trialbalance_by_group($noac){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        `group`,
                        `type`,
                        level
                 FROM noac WHERE general = '$noac' $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    
    function get_coa_assets_by_level($thn,$bln,$level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`,
                        `level`
                 FROM noac WHERE `group` = 'Asset' and `level` <= '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_coa_capital_by_level($thn,$bln,$level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`,
                        `level`
                 FROM noac WHERE `group` = 'Capital' and `level` <= '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function get_coa_expenses_by_level($thn,$bln,$level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`,
                        `level`
                 FROM noac WHERE `group` = 'Expenses' and `level` <= '$level' ORDER BY noac ASC";
        
        //$filters_null 
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_coa_liability_by_level($thn,$bln,$level){
        //pendapatakn jasa giro
        //pendapatan deposito bunga
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`,
                        `level`
                 FROM noac WHERE `group` = 'Liability' and `level` <= '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_coa_other_expenses_by_level($thn,$bln,$level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`,
                        `level`
                 FROM noac WHERE `group` = 'Other Expenses' and `level` <= '$level' ORDER BY noac ASC";
        //AND noac NOT IN ('950000000000000','950500000000000','950600000000000','950800000000000','951000000000000')
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_coa_other_revenue_by_level($thn,$bln,$level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`,
                        `level`
                 FROM noac WHERE `group` = 'Other Revenue' and `level` <= '$level' ORDER BY noac ASC";
        //AND noac IN ('901000000000000','900900000000000','900100000000000','900450000000000','900500000000000','900700000000000') $filters_null
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_coa_revenue_by_level($thn,$bln,$level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`,
                        `level`
                 FROM noac WHERE `group` = 'Revenue' and `level` <= '$level' ORDER BY noac ASC";
        //AND noac IN ('600101010000000','600101050000000','600101100000000') $filters_null
        return $this->mips_gl->query($sql);
        
    }
    
    function income_list_income($bln,$level){
        
        $sql = "SELECT * FROM noac WHERE `group` IN ('Revenue','Expenses','Other Revenue','Other Expenses') and `level` IN ('2','3') ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function income_summary_revenue($bln,$level){
        
        $sql = "SELECT * FROM noac where `group` = 'Revenue' and `level` = '$level' AND (saldo01c <> 0 OR saldo01d <> 0  
OR saldo02c <> 0 OR saldo02d <> 0 
OR saldo03c <> 0 OR saldo03d <> 0
OR saldo04c <> 0 OR saldo04d <> 0
OR saldo05c <> 0 OR saldo05d <> 0
OR saldo06c <> 0 OR saldo06d <> 0
OR saldo07c <> 0 OR saldo07d <> 0
OR saldo08c <> 0 OR saldo08d <> 0
OR saldo09c <> 0 OR saldo09d <> 0
OR saldo10c <> 0 OR saldo10d <> 0
OR saldo11c <> 0 OR saldo11d <> 0
OR saldo12c <> 0 OR saldo12d <> 0) ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function income_summary_expenses_70($bln,$level){
        
        $sql = "SELECT * FROM noac where `group` = 'Expenses' and `level` = '$level' AND SUBSTR(noac,1,2) = '70' AND (saldo01c <> 0 OR saldo01d <> 0  
OR saldo02c <> 0 OR saldo02d <> 0 
OR saldo03c <> 0 OR saldo03d <> 0
OR saldo04c <> 0 OR saldo04d <> 0
OR saldo05c <> 0 OR saldo05d <> 0
OR saldo06c <> 0 OR saldo06d <> 0
OR saldo07c <> 0 OR saldo07d <> 0
OR saldo08c <> 0 OR saldo08d <> 0
OR saldo09c <> 0 OR saldo09d <> 0
OR saldo10c <> 0 OR saldo10d <> 0
OR saldo11c <> 0 OR saldo11d <> 0
OR saldo12c <> 0 OR saldo12d <> 0) ORDER BY nama ASC ";
        return $this->mips_gl->query($sql);
        
    }
    
    function income_summary_expenses_biaya_penjualan_75($bln,$level){
        $sql = "SELECT * FROM noac where `group` = 'Expenses' and `level` = '$level' AND SUBSTR(noac,1,2) = '75' AND (saldo01c <> 0 OR saldo01d <> 0  
OR saldo02c <> 0 OR saldo02d <> 0 
OR saldo03c <> 0 OR saldo03d <> 0
OR saldo04c <> 0 OR saldo04d <> 0
OR saldo05c <> 0 OR saldo05d <> 0
OR saldo06c <> 0 OR saldo06d <> 0
OR saldo07c <> 0 OR saldo07d <> 0
OR saldo08c <> 0 OR saldo08d <> 0
OR saldo09c <> 0 OR saldo09d <> 0
OR saldo10c <> 0 OR saldo10d <> 0
OR saldo11c <> 0 OR saldo11d <> 0
OR saldo12c <> 0 OR saldo12d <> 0) ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }
    
    function income_summary_expenses_administrasi_umum_80($bln,$level){
        $sql = "SELECT * FROM noac where `group` = 'Expenses' and `level` = '$level' AND SUBSTR(noac,1,2) = '80' AND (saldo01c <> 0 OR saldo01d <> 0  
OR saldo02c <> 0 OR saldo02d <> 0 
OR saldo03c <> 0 OR saldo03d <> 0
OR saldo04c <> 0 OR saldo04d <> 0
OR saldo05c <> 0 OR saldo05d <> 0
OR saldo06c <> 0 OR saldo06d <> 0
OR saldo07c <> 0 OR saldo07d <> 0
OR saldo08c <> 0 OR saldo08d <> 0
OR saldo09c <> 0 OR saldo09d <> 0
OR saldo10c <> 0 OR saldo10d <> 0
OR saldo11c <> 0 OR saldo11d <> 0
OR saldo12c <> 0 OR saldo12d <> 0) ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }
    
    function income_summary_expenses_biaya_running($bln,$level){
        $sql = "SELECT * FROM noac where `group` = 'Expenses' and `level` = '$level' AND SUBSTR(noac,1,2) = '40' AND (saldo01c <> 0 OR saldo01d <> 0  
OR saldo02c <> 0 OR saldo02d <> 0 
OR saldo03c <> 0 OR saldo03d <> 0
OR saldo04c <> 0 OR saldo04d <> 0
OR saldo05c <> 0 OR saldo05d <> 0
OR saldo06c <> 0 OR saldo06d <> 0
OR saldo07c <> 0 OR saldo07d <> 0
OR saldo08c <> 0 OR saldo08d <> 0
OR saldo09c <> 0 OR saldo09d <> 0
OR saldo10c <> 0 OR saldo10d <> 0
OR saldo11c <> 0 OR saldo11d <> 0
OR saldo12c <> 0 OR saldo12d <> 0) ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }
            
    function income_summary_other_revenue($bln,$level){
        
        $sql = "SELECT * FROM noac where `group` = 'Other Revenue' and `level` = '$level' AND (saldo01c <> 0 OR saldo01d <> 0  
OR saldo02c <> 0 OR saldo02d <> 0 
OR saldo03c <> 0 OR saldo03d <> 0
OR saldo04c <> 0 OR saldo04d <> 0
OR saldo05c <> 0 OR saldo05d <> 0
OR saldo06c <> 0 OR saldo06d <> 0
OR saldo07c <> 0 OR saldo07d <> 0
OR saldo08c <> 0 OR saldo08d <> 0
OR saldo09c <> 0 OR saldo09d <> 0
OR saldo10c <> 0 OR saldo10d <> 0
OR saldo11c <> 0 OR saldo11d <> 0
OR saldo12c <> 0 OR saldo12d <> 0) ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function income_summary_other_expenses($bln,$level){
        
        $sql = "SELECT * FROM noac where `group` = 'Other Expenses' and `level` = '$level' AND (saldo01c <> 0 OR saldo01d <> 0  
OR saldo02c <> 0 OR saldo02d <> 0 
OR saldo03c <> 0 OR saldo03d <> 0
OR saldo04c <> 0 OR saldo04d <> 0
OR saldo05c <> 0 OR saldo05d <> 0
OR saldo06c <> 0 OR saldo06d <> 0
OR saldo07c <> 0 OR saldo07d <> 0
OR saldo08c <> 0 OR saldo08d <> 0
OR saldo09c <> 0 OR saldo09d <> 0
OR saldo10c <> 0 OR saldo10d <> 0
OR saldo11c <> 0 OR saldo11d <> 0
OR saldo12c <> 0 OR saldo12d <> 0) ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    function  income_tahun_all_level(){
        $sql = "SELECT * FROM noac where `group` IN ('Revenue','Expenses','Other Revenue','Other Expenses') ORDER BY noac ASC";
        //`level` = '$level'
        return $this->mips_gl->query($sql);
    }
            
    
    function income_summary_revenue_detail($bln,$level,$level2){
        
        $filters_null = $this->set_filter_year();
        //IN ('$level','$level2')
        $sql = "SELECT * FROM noac where `group` = 'Revenue' and `level` = 2  $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    function income_summary_expenses_detail($bln,$level,$level2){
        //IN ('$level','$level2')
        $filters_null = $this->set_filter_year();
        $sql = "SELECT * FROM noac where `group` = 'Expenses' and `level` = 2 $filters_null  ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function income_summary_other_revenue_detail($bln,$level,$level2){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac where `group` = 'Other Revenue' and `level` = 2 $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function income_summary_other_expenses_detail($bln,$level,$level2){
        //IN ('$level','$level2')
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac where `group` = 'Other Expenses' and `level` = 2 $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    
    function income_tahun_semua_level_revenue($thn,$bln,$level){
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Revenue' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function income_tahun_semua_level_expenses(){
        $sql = "SELECT * FROM noac WHERE `group` = 'Expenses' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }
    
    function income_tahun_semua_level_other_revenue(){
        $sql = "SELECT * FROM noac WHERE `group` = 'Other Revenue' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }
    
    function income_tahun_semua_level_other_expenses(){
        $sql = "SELECT * FROM noac WHERE `group` = 'Other Expenses' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }

    
    
    
    function income_tahun_semua_level_revenue_by_level($bln,$level){
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Revenue' and level <= '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function income_tahun_semua_level_expenses_by_level($bln,$level){
        $sql = "SELECT * FROM noac WHERE `group` = 'Expenses' and level <= '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }
    
    function income_tahun_semua_level_other_revenue_by_level($bln,$level){
        $sql = "SELECT * FROM noac WHERE `group` = 'Other Revenue' and level <= '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }
    
    function income_tahun_semua_level_other_expenses_by_level($bln,$level){
        $sql = "SELECT * FROM noac WHERE `group` = 'Other Expenses' and level <= '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }
    
    function balanace_aset_lancar($level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Asset' AND `level` = '$level' AND SUBSTR(noac,1,2) = '10' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function balance_aset_tidak_lancar($level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac where general IN ('203500000000000','200000000000000') AND noac NOT IN ('203500000000000')";
        
        //$sql = "SELECT * FROM noac WHERE `group` = 'Asset' AND `level` IN ('2','3') AND noac NOT IN ('203500000000000') AND general NOT IN ('202500000000000','202400000000000','209500000000000','209000000000000','100000000000000','101000000000000','102000000000000','102500000000000','103000000000000','100100000000000') $filters_null AND `type` = 'G' ORDER BY noac ASC";
        //$sql = "SELECT * FROM noac WHERE `group` = 'Asset' AND `level` IN ('2','3') and noac <> '203500000000000' AND SUBSTR(noac,1,2) = '20' AND `type` = 'G' $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
        //AND `type` = 'G'
        
    }
    
    function balance_ekuitas($level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Capital' and noac <> '203500000000000' AND `level` = '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function balance_kewajiban_lancar($level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Liability' AND `level` = '$level' and noac <> '203500000000000' AND SUBSTR(noac,1,2) = '30' $filters_null ORDER BY noac ASC";
         return $this->mips_gl->query($sql);
    }
    
    function balance_kewajiban_tidak_lancar($level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Liability' AND `level` = '$level' and noac <> '203500000000000' AND SUBSTR(noac,1,2) = '40' $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function balance_tahun_level($level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Liability' AND `level` = '$level' $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    
    
    function balance_aset_lancar_tahunan($level,$bulan){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Asset' AND `level` <= '$level' $filters_null and noac <> '203500000000000' AND SUBSTR(noac,1,2) = '10' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    function balance_aset_tidak_lancar_tahunan($level,$bulan){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Asset' AND `level` <= '$level' $filters_null and noac <> '203500000000000' AND SUBSTR(noac,1,2) = '20' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function balance_kewajiban_lancar_tahunan($level,$bulan){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Liability' AND `level` <= '$level' and noac <> '203500000000000' AND SUBSTR(noac,1,2) = '30' $filters_null ORDER BY noac ASC";
         return $this->mips_gl->query($sql);
        
    }
    
    function balance_kewajiban_tidak_lancar_tahunan($level,$bulan){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Liability' AND `level` <= '$level' and noac <> '203500000000000' AND SUBSTR(noac,1,2) = '40' $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    function balance_ekuitas_tahunan($level,$bulan){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Capital' and noac <> '203500000000000' AND `level` <= '$level' $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    
    //ini berdasarkan
    function balance_aset_lancar_compare($level,$bulan){
        
        $filters_null = $this->set_filter_year();
        
        //untuk tahun compare dikurang 1
        $tahun_compare = $this->periode()-1;
                
        $sql = "SELECT * FROM noac_".$tahun_compare." WHERE `group` = 'Asset' AND `level` = '$level' $filters_null and noac <> '203500000000000' AND SUBSTR(noac,1,2) = '10' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function balance_aset_tidak_lancar_compare($level,$bulan){
        
        $filters_null = $this->set_filter_year();
        //untuk tahun compare dikurang 1
        $tahun_compare = $this->periode()-1;
        
        $sql = "SELECT * FROM noac_".$tahun_compare." WHERE `group` = 'Asset' AND `level` = '$level' and noac <> '203500000000000' AND SUBSTR(noac,1,2) = '20' $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function balance_ekuitas_compare($level,$bulan){
        
        $filters_null = $this->set_filter_year();
        //untuk tahun compare dikurang 1
        $tahun_compare = $this->periode()-1;
        
        $sql = "SELECT * FROM noac_".$tahun_compare." WHERE `group` = 'Capital' and noac <> '203500000000000' AND `level` = '$level' $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function balance_kewajiban_lancar_compare($level,$bulan){
        
        $filters_null = $this->set_filter_year();
        //untuk tahun compare dikurang 1
        $tahun_compare = $this->periode()-1;
        
        $sql = "SELECT * FROM noac_".$tahun_compare." WHERE `group` = 'Liability' AND `level` = '$level' and noac <> '203500000000000' AND SUBSTR(noac,1,2) = '30' $filters_null ORDER BY noac ASC";
         return $this->mips_gl->query($sql);
    }
    
    function balance_kewajiban_tidak_lancar_compare($level,$bulan){
        
        $filters_null = $this->set_filter_year();
        //untuk tahun compare dikurang 1
        $tahun_compare = $this->periode()-1;
        
        $sql = "SELECT * FROM noac_".$tahun_compare." WHERE `group` = 'Liability' AND `level` = '$level' and noac <> '203500000000000' AND SUBSTR(noac,1,2) = '40' $filters_null ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    
    
    
    
    
    
    function get_aset_lancar_sum($level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Asset' AND `level` <= '$level' AND SUBSTR(noac,1,2) = '10' $filters_null  ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }
    
    
    function get_aset_tidak_lancar_sum($level){
        
        $filters_null = $this->set_filter_year();
        
        $sql = "SELECT * FROM noac WHERE `group` = 'Asset' AND `level` <= '$level' AND SUBSTR(noac,1,2) = '20' $filters_null  ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
    }
    
    
    function get_kewajiban_lancar_sum($level){
        
        $filters_null = $this->set_filter_year();
        $sql = "SELECT * FROM noac WHERE `group` = 'Liability' AND `level` <= '$level' AND SUBSTR(noac,1,2) = '30' $filters_null  ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function get_kewajiban_tidak_lancar_sum($level){
        
        $filters_null = $this->set_filter_year();
        $sql = "SELECT * FROM noac WHERE `group` = 'Liability' AND `level` <= '$level' AND SUBSTR(noac,1,2) = '40' $filters_null  ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_ekuitas_sum($level){
        
        $filters_null = $this->set_filter_year();
        //DISINI LABA TAHUN BERJALAN TIDAK DIMASUKAN
        $sql = "SELECT * FROM noac WHERE `group` = 'Capital' AND `level` <= '$level' AND noac <> 504500000000000 AND SUBSTR(noac,1,2) = '50' $filters_null  ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_pendapatan_sum($level){
       
        $filters_null = $this->set_filter_year();
        $sql = "SELECT * FROM noac WHERE `level` <= '$level' AND SUBSTR(noac,1,2) = '60'  ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function get_running_account($level){
        
        $filters_null = $this->set_filter_year();
        $sql = "SELECT * FROM noac WHERE `group` = 'Expenses' AND `level` <= '$level' AND SUBSTR(noac,1,2) = '40' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function get_harga_pokok_penjualan($level){
        
        $filters_null = $this->set_filter_year();
        $sql = "SELECT * FROM noac WHERE `group` = 'Expenses' AND `level` <= '$level' AND SUBSTR(noac,1,2) IN ('70','75') ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function get_biaya_administrasi_umum($level){
        
        $filters_null = $this->set_filter_year();
        $sql = "SELECT * FROM noac WHERE `group` = 'Expenses' AND `level` <= '$level' AND SUBSTR(noac,1,2) = '80' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_pendapatan_lainnya($level){
        
        $filters_null = $this->set_filter_year();
        $sql = "SELECT * FROM noac WHERE `group` = 'Other Revenue' AND `level` <= '$level' AND SUBSTR(noac,1,2) = '90'  ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_biaya_lainnya($level){
        
        $filters_null = $this->set_filter_year();
        $sql = "SELECT * FROM noac WHERE `group` = 'Other Expenses' AND `level` <= '$level' AND SUBSTR(noac,1,2) = '95'  ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    
    
    // start : get noac by Trial Balance by level =======================================
    
    function get_coa_assets_by_level2($bylevel,$thn,$bln){
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Asset' and `level` <= '$bylevel' ORDER BY noac ASC";
        //$filters_null and `type` = 'D'
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_coa_capital_by_level2($level,$thn,$bln){
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Capital' and `level` <= '$level' ORDER BY noac ASC";
        return $this->mips_gl->query($sql);
        
    }
    
    function get_coa_expenses_by_level2($level,$thn,$bln){
        
        //$filters_null
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Expenses' and `level` <= '$level' ORDER BY noac ASC"; //AND SUBSTR(noac,1,2) = 70
                 //SUBSTR(noac,1,4) IN ('7001','7010','7020','7025')
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_coa_liability_by_level2($level,$thn,$bln){
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Liability' and `level` <= '$level' ORDER BY noac ASC";
        //$filters_null and `type` = 'D' 
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_coa_other_expenses_by_level2($level,$thn,$bln){
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Other Expenses' and `level` <= '$level' ORDER BY noac ASC";
        
        //$filters_null and `type` = 'D' AND noac NOT IN ('950000000000000','950500000000000','950600000000000','950800000000000','951000000000000')
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_coa_other_revenue_by_level2($level,$thn,$bln){
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Other Revenue' and `level` <= '$level' ORDER BY noac ASC";
        //$filters_null and `type` = 'D' AND noac IN ('901000000000000','900900000000000','900100000000000','900450000000000','900500000000000','900700000000000')
        return $this->mips_gl->query($sql);
        
    }
    
    
    function get_coa_revenue_by_level2($level,$thn,$bln){
        
        $sql = "SELECT  saldo01c,
                        saldo02c,
                        saldo03c,
                        saldo04c,
                        saldo05c,
                        saldo06c,
                        saldo07c,
                        saldo08c,
                        saldo09c,
                        saldo10c,
                        saldo11c,
                        saldo12c,
                        saldo01d,
                        saldo02d,
                        saldo03d,
                        saldo04d,
                        saldo05d,
                        saldo06d,
                        saldo07d,
                        saldo08d,
                        saldo09d,
                        saldo10d,
                        saldo11d,
                        saldo12d,
                        noac,
                        nama,
                        yeard,
                        yearc,
                        saldo".$bln."c AS saldo_c,
                        saldo".$bln."d AS saldo_d,
                        `group`,
                        `type`
                 FROM noac WHERE `group` = 'Revenue' and `level` <= '$level' ORDER BY noac ASC";
        //$filters_null and `type` = 'D' AND noac IN ('600101010000000','600101050000000','600101100000000')
        return $this->mips_gl->query($sql);
        
    }
    
    // end : get noac by Trial Balance by level =======================================
    
    
    
    
}
?>