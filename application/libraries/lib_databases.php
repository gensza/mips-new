<?php
class Lib_databases
{

    // public function __construct()
    // {
    //     $CI = &get_instance();
    //     $this->ci = $CI;
    // }


    function inis_config()
    {
        return 'conf';
    }

    function inis_db()
    {

        return 'msal';
        // $session_db_pt = strtolower($this->CI->session->userdata('sess_db'));
        // if (empty($session_db_pt)) {
        //     $db_pt = "msal";
        // } elseif ($session_db_pt == 'msal') {
        //     $db_pt = 'msal';
        // } elseif ($session_db_pt == 'mapa') {
        //     $db_pt = 'mapa';
        // } elseif ($session_db_pt == 'psam') {
        //     $db_pt = 'psam';
        // } elseif ($session_db_pt == 'peak') {
        //     $db_pt = 'peak';
        // } elseif ($session_db_pt == 'kpp') {
        //     $db_pt = 'kpp';
        // }
        // return $db_pt;
        //        if(!$this->session->userdata('sess_inis_db')) {
        //            return $this->session->userdata('sess_inis_db');
        //        }else{
        //            return '';
        //        }
    }
}
