<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gl_lap extends CI_Controller {
	
    public function __construct(){
        parent::__construct();		
    	$this->load->model('cetak_model');
        $this->load->model('gl_model');
        $this->load->model('main_model');
        $this->load->model('gl_lap_model');
    }
    
    function trialbalance_by_detail($periode_terkini,$param2,$param3){

        //$nama_dokumen = 'Laporan_Trial_Balance_'.$periode_terkini.'';
        
        $thn = substr($periode_terkini, 0, 4);
        $bln = substr($periode_terkini, 4, 6);
        
        $data['bln'] = $bln;
        
        $data['data_list_assets']        = $this->gl_model->get_coa_assets($thn,$bln)->result_array();
        $data['data_list_capital']       = $this->gl_model->get_coa_capital($thn,$bln)->result_array();
        $data['data_list_expenses']      = $this->gl_model->get_coa_expenses($thn,$bln)->result_array();
        $data['data_list_liability']     = $this->gl_model->get_coa_liability($thn,$bln)->result_array();
        $data['data_list_other_expenses']= $this->gl_model->get_coa_other_expenses($thn,$bln)->result_array();
        $data['data_list_other_revenue'] = $this->gl_model->get_coa_other_revenue($thn,$bln)->result_array();
        $data['data_list_revenue']       = $this->gl_model->get_coa_revenue($thn,$bln)->result_array();
        
        //var_dump($this->gl_model->get_coa_expenses($thn,$bln)->result_array());exit();
        
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/trialbalance_by_detail_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
        
    }
    
    
    function trialbalance_by_group($periode_terkini,$param2,$param3){

        //$nama_dokumen = 'Laporan_Trial_Balance_'.$periode_terkini.'';
        
        $thn = substr($periode_terkini, 0, 4);
        $bln = substr($periode_terkini, 4, 6);
        
        $data['bln'] = $bln;
        
        $data['list_noac']        = $this->gl_lap_model->trialbalance_by_group($param2)->result_array();
        
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/trialbalance_by_group_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
        
    }
    
    function trialbalance_by_summary($periode_terkini,$param2,$param3){

        //$nama_dokumen = 'Laporan_Trial_Balance_'.$periode_terkini.'';
        
        $thn = substr($periode_terkini, 0, 4);
        $bln = substr($periode_terkini, 4, 6);
        
        $data['bln'] = $bln;
        $level       = 2;
        
        $data['aset_lancar']            = $this->gl_lap_model->get_aset_lancar_sum($level)->result_array();
        $data['aset_tidak_lancar']      = $this->gl_lap_model->get_aset_tidak_lancar_sum($level)->result_array();
        $data['kewajiban_lancar']       = $this->gl_lap_model->get_kewajiban_lancar_sum($level)->result_array();
        $data['kewajiban_tidak_lancar'] = $this->gl_lap_model->get_kewajiban_tidak_lancar_sum($level)->result_array();
        $data['ekuitas']                = $this->gl_lap_model->get_ekuitas_sum($level)->result_array();
        $data['pendapatan']             = $this->gl_lap_model->get_pendapatan_sum($level)->result_array();
        $data['running_account']        = $this->gl_lap_model->get_running_account($level)->result_array();
        $data['harga_pokok_penjualan']  = $this->gl_lap_model->get_harga_pokok_penjualan($level)->result_array();
        $data['biaya_admin_umum']       = $this->gl_lap_model->get_biaya_administrasi_umum($level)->result_array();
        $data['pendapatan_lainnya']     = $this->gl_lap_model->get_pendapatan_lainnya($level)->result_array();
        $data['biaya_lainnya']          = $this->gl_lap_model->get_biaya_lainnya($level)->result_array();
        
        
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/trialbalance_by_summary_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
        
    }
    
    
    function trialbalance_by_level($periode_terkini,$bylevel,$param3){
        
        
        $thn = substr($periode_terkini, 0, 4);
        $bln = substr($periode_terkini, 4, 6);
        $data['level'] = $bylevel;
        
        $data['bln'] = $bln;
        
        $data['data_list_assets']        = $this->gl_lap_model->get_coa_assets_by_level2($bylevel,$thn,$bln)->result_array();
        $data['data_list_capital']       = $this->gl_lap_model->get_coa_capital_by_level2($bylevel,$thn,$bln)->result_array();
        $data['data_list_expenses']      = $this->gl_lap_model->get_coa_expenses_by_level2($bylevel,$thn,$bln)->result_array();
        $data['data_list_liability']     = $this->gl_lap_model->get_coa_liability_by_level2($bylevel,$thn,$bln)->result_array();
        $data['data_list_other_expenses']= $this->gl_lap_model->get_coa_other_expenses_by_level2($bylevel,$thn,$bln)->result_array();
        $data['data_list_other_revenue'] = $this->gl_lap_model->get_coa_other_revenue_by_level2($bylevel,$thn,$bln)->result_array();
        $data['data_list_revenue']       = $this->gl_lap_model->get_coa_revenue_by_level2($bylevel,$thn,$bln)->result_array();
        
        //var_dump($this->gl_model->get_coa_expenses($thn,$bln)->result_array());exit();
        
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        
        
        $this->load->view('gl/laporan/trialbalance_by_level_view',$data);
        

        //$nama_dokumen = 'Laporan_Trial_Balance_'.$periode_terkini.'';
        
//        $thn = substr($periode_terkini, 0, 4);
//        $bln = substr($periode_terkini, 4, 6);
//        
//        $data['bln']   = $bln;
//        $data['level'] = $param2;
//        
//        $data['data_list_assets']        = $this->gl_lap_model->get_coa_assets_by_level($thn,$bln,$param2)->result_array();
//        $data['data_list_capital']       = $this->gl_lap_model->get_coa_capital_by_level($thn,$bln,$param2)->result_array();
//        $data['data_list_expenses']      = $this->gl_lap_model->get_coa_expenses_by_level($thn,$bln,$param2)->result_array();
//        $data['data_list_liability']     = $this->gl_lap_model->get_coa_liability_by_level($thn,$bln,$param2)->result_array();
//        $data['data_list_other_expenses']= $this->gl_lap_model->get_coa_other_expenses_by_level($thn,$bln,$param2)->result_array();
//        $data['data_list_other_revenue'] = $this->gl_lap_model->get_coa_other_revenue_by_level($thn,$bln,$param2)->result_array();
//        $data['data_list_revenue']       = $this->gl_lap_model->get_coa_revenue_by_level($thn,$bln,$param2)->result_array();
//        
//        ini_set( 'memory_limit', '500M' );
//        ini_set('upload_max_filesize', '500M');  
//        ini_set('post_max_size', '500M');  
//        ini_set('max_input_time', 3600);  
//        ini_set('max_execution_time', 3600);
//
//        ini_set("memory_limit","999M");
        
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        //$this->load->view('gl/laporan/trialbalance_by_level_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
        
    }
    
    
    function trialbalance_by_level_pertahun($periode_terkini,$param2,$param3){

        //$nama_dokumen = 'Laporan_Trial_Balance_'.$periode_terkini.'';
        
        $thn = substr($periode_terkini, 0, 4);
        $bln = substr($periode_terkini, 4, 6);
        
        $data['bln']   = $bln;
        $data['thn']   = $thn;
        $data['level'] = $param2;
        
        $data['data_list_assets']        = $this->gl_lap_model->get_coa_assets_by_level_tahunan($thn,$bln,$param2)->result_array();
        $data['data_list_capital']       = $this->gl_lap_model->get_coa_capital_by_level_tahunan($thn,$bln,$param2)->result_array();
        $data['data_list_expenses']      = $this->gl_lap_model->get_coa_expenses_by_level_tahunan($thn,$bln,$param2)->result_array();
        $data['data_list_liability']     = $this->gl_lap_model->get_coa_liability_by_level_tahunan($thn,$bln,$param2)->result_array();
        $data['data_list_other_expenses']= $this->gl_lap_model->get_coa_other_expenses_by_level_tahunan($thn,$bln,$param2)->result_array();
        $data['data_list_other_revenue'] = $this->gl_lap_model->get_coa_other_revenue_by_level_tahunan($thn,$bln,$param2)->result_array();
        $data['data_list_revenue']       = $this->gl_lap_model->get_coa_revenue_by_level_tahunan($thn,$bln,$param2)->result_array();
        
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/trialbalance_by_level_pertahun_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
        
    }
    
    
    
    function income_summary_asli($periode_terkini,$param2,$param3){
        
        $thn   = substr($periode_terkini, 0, 4);
        $bln   = substr($periode_terkini, 4, 6);
        $level = 2;
        
        
        $data['bln'] = $bln;
        $data['level'] = 2; // ini bisa diubah fleksibel
        
        //'Revenue','Expenses','Other Revenue','Other Expenses'
        
        $data['ic_revenue']        = $this->gl_lap_model->income_summary_revenue($bln,$level)->result_array();
        $data['ic_expenses']       = $this->gl_lap_model->income_summary_expenses($bln,$level)->result_array();
        $data['ic_other_revenue']  = $this->gl_lap_model->income_summary_other_revenue($bln,$level)->result_array();
        $data['ic_other_expenses'] = $this->gl_lap_model->income_summary_other_expenses($bln,$level)->result_array();
        
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/income_summary_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
        
        
    }
    
    
    function income_summary($periode_terkini,$param2,$param3){
        
        $thn   = substr($periode_terkini, 0, 4);
        $bln   = substr($periode_terkini, 4, 6);
        $level = 2;
        
        
        $data['bln'] = $bln;
        $data['level'] = 2; // ini bisa diubah fleksibel
        
        //'Revenue','Expenses','Other Revenue','Other Expenses' 
        $data['ic_revenue']                     = $this->gl_lap_model->income_summary_revenue($bln,$level)->result_array();
        $data['ic_expenses']                    = $this->gl_lap_model->income_summary_expenses_70($bln,$level)->result_array();
        $data['ic_expenses_biaya_penjualan']    = $this->gl_lap_model->income_summary_expenses_biaya_penjualan_75($bln,$level)->result_array();
        $data['ic_expenses_biaya_running']      = $this->gl_lap_model->income_summary_expenses_biaya_running($bln,$level)->result_array();
        $data['ic_expenses_administrasi_umum']  = $this->gl_lap_model->income_summary_expenses_administrasi_umum_80($bln,$level)->result_array();
        $data['ic_other_revenue']               = $this->gl_lap_model->income_summary_other_revenue($bln,$level)->result_array();
        $data['ic_other_expenses']              = $this->gl_lap_model->income_summary_other_expenses($bln,$level)->result_array();
        
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/income_summary_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
        
        
    }
    
    
    function income_tahun_semua_level($periode_terkini,$param2,$param3){
        $thn   = substr($periode_terkini, 0, 4);
        $bln   = substr($periode_terkini, 4, 6);
        $level = 2;
        
        
        $data['bln'] = $bln;
        $data['level'] = 2; // ini bisa diubah fleksibel
        
        //'Revenue','Expenses','Other Revenue','Other Expenses'
        
        $data['ic_revenue']        = $this->gl_lap_model->income_tahun_semua_level_revenue($bln,$level)->result_array();
        $data['ic_expensise']        = $this->gl_lap_model->income_tahun_semua_level_expenses($bln,$level)->result_array();
        $data['ic_other_revenue']        = $this->gl_lap_model->income_tahun_semua_level_other_revenue($bln,$level)->result_array();
        $data['ic_other_expensise']        = $this->gl_lap_model->income_tahun_semua_level_other_expenses($bln,$level)->result_array();
   
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/income_tahun_semua_level_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
    }
    
    
    
    function income_detail_biaya_langsung_kebun($periode_terkini,$param2,$param3){
        
        $thn   = substr($periode_terkini, 0, 4);
        $bln   = substr($periode_terkini, 4, 6);
        $level = 2;
        $level2 = 5;
        
        
        $data['bln'] = $bln;
        $data['level'] = 2; // ini bisa diubah fleksibel
        
        $data['ic_revenue']        = $this->gl_lap_model->income_summary_revenue_detail($bln,$level,$level2)->result_array();
        $data['ic_expenses']       = $this->gl_lap_model->income_summary_expenses_detail($bln,$level,$level2)->result_array();
        $data['ic_other_revenue']  = $this->gl_lap_model->income_summary_other_revenue_detail($bln,$level,$level2)->result_array();
        $data['ic_other_expenses'] = $this->gl_lap_model->income_summary_other_expenses_detail($bln,$level,$level2)->result_array();
        
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/income_detail_biaya_langsung_kebun_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
        
        
    }
    
    
    
    
    function income_tahun_semua_by_level($periode_terkini,$param3){
        
        
        $thn   = substr($periode_terkini, 0, 4);
        $bln   = substr($periode_terkini, 4, 6);
       
        $data['bln'] = $bln;
        $data['level_s'] = $level; // ini bisa diubah fleksibel
        
        //'Revenue','Expenses','Other Revenue','Other Expenses'
        
        $data['ic_revenue']        = $this->gl_lap_model->income_tahun_semua_level_revenue_by_level($bln,$level)->result_array();
        $data['ic_expensise']        = $this->gl_lap_model->income_tahun_semua_level_expenses_by_level($bln,$level)->result_array();
        $data['ic_other_revenue']        = $this->gl_lap_model->income_tahun_semua_level_other_revenue_by_level($bln,$level)->result_array();
        $data['ic_other_expensise']        = $this->gl_lap_model->income_tahun_semua_level_other_expenses_by_level($bln,$level)->result_array();
   
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/income_tahun_by_level_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
    }
    
    
    function balance_summary_current_year($periode_terkini,$param2,$param3){
        
        $thn   = substr($periode_terkini, 0, 4);
        $bln   = substr($periode_terkini, 4, 6);
        $level = 2;
        
        
        $data['bln'] = $bln;
        $data['level'] = 2; // ini bisa diubah fleksibel
        
        $data['aset_lancar']       = $this->gl_lap_model->balanace_aset_lancar($level)->result_array();
        $data['aset_tidak_lancar'] = $this->gl_lap_model->balance_aset_tidak_lancar($level)->result_array();
        $data['balance_ekuitas'] = $this->gl_lap_model->balance_ekuitas($level)->result_array();
        $data['balance_kewajiban_lancar'] = $this->gl_lap_model->balance_kewajiban_lancar($level)->result_array();
        $data['balance_kewajiban_tidak_lancar'] = $this->gl_lap_model->balance_kewajiban_tidak_lancar($level)->result_array();
       
        
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/balance_summary_current_year_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
        
    }
    
    
    
    function balance_compare_year($periode_terkini,$param2,$param3){
        
        $thn   = substr($periode_terkini, 0, 4);
        $bln   = substr($periode_terkini, 4, 6);
        $level = 2;
        
        
        $data['bln'] = $bln;
        $data['level'] = 2; // ini bisa diubah fleksibel
        
        $data['aset_lancar']       = $this->gl_lap_model->balanace_aset_lancar($bln,$level)->result_array();
        $data['aset_tidak_lancar'] = $this->gl_lap_model->balance_aset_tidak_lancar($bln,$level)->result_array();
        $data['balance_ekuitas'] = $this->gl_lap_model->balance_ekuitas($bln,$level)->result_array();
        $data['balance_kewajiban_lancar'] = $this->gl_lap_model->balance_kewajiban_lancar($bln,$level)->result_array();
        $data['balance_kewajiban_tidak_lancar'] = $this->gl_lap_model->balance_kewajiban_tidak_lancar($bln,$level)->result_array();
       
        $data['compare_aset_lancar']       = $this->gl_lap_model->balance_aset_lancar_compare($bln,$level)->result_array();
        $data['compare_aset_tidak_lancar'] = $this->gl_lap_model->balance_aset_tidak_lancar_compare($bln,$level)->result_array();
        $data['compare_balance_ekuitas'] = $this->gl_lap_model->balance_ekuitas_compare($bln,$level)->result_array();
        $data['compare_balance_kewajiban_lancar'] = $this->gl_lap_model->balance_kewajiban_lancar_compare($bln,$level)->result_array();
        $data['compare_balance_kewajiban_tidak_lancar'] = $this->gl_lap_model->balance_kewajiban_tidak_lancar_compare($bln,$level)->result_array();
        
        
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/balance_compare_year_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
        
    }
    
    
    function balance_tahun_level_2($periode_terkini,$param2,$param3){
        
        $thn   = substr($periode_terkini, 0, 4);
        $bln   = substr($periode_terkini, 4, 6);
        
        
        $data['bln'] = $bln;
        $data['level'] = $param2; // ini bisa diubah fleksibel
        
        $data['aset_lancar']       = $this->gl_lap_model->balance_aset_lancar_tahunan($bln,$level)->result_array();
        $data['aset_tidak_lancar'] = $this->gl_lap_model->balance_aset_tidak_lancar_tahunan($bln,$level)->result_array();
        $data['balance_ekuitas'] = $this->gl_lap_model->balance_ekuitas_tahunan($bln,$level)->result_array();
        $data['balance_kewajiban_lancar'] = $this->gl_lap_model->balance_kewajiban_lancar_tahunan($bln,$level)->result_array();
        $data['balance_kewajiban_tidak_lancar'] = $this->gl_lap_model->balance_kewajiban_tidak_lancar_tahunan($bln,$level)->result_array();
        
        
        
        ini_set( 'memory_limit', '500M' );
        ini_set('upload_max_filesize', '500M');  
        ini_set('post_max_size', '500M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        ini_set("memory_limit","999M");
        // Tentukan path yang tepat ke mPDF
        //$this->load->library('mpdf/mpdf');
       // $mpdf=new mPDF('utf-8', 'A4-L');
        //ob_start();
        
        $this->load->view('gl/laporan/balance_tahun_level_view',$data);
        
        //$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        //ob_end_clean();
        //$mpdf->WriteHTML(utf8_encode($html));
        //$mpdf->Output($nama_dokumen.".pdf" ,'I');
        //exit;
        
    }
    
    
    
}
