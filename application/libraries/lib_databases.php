<?php
class Lib_databases {
   
    public function __construct() {
      $CI = & get_instance();
      $this->ci = $CI;
    }


    function inis_config(){
        return 'conf';
    }
    
    function inis_db(){
        return 'msal';
//        if(!$this->session->userdata('sess_inis_db')) {
//            return $this->session->userdata('sess_inis_db');
//        }else{
//            return '';
//        }
    }


}