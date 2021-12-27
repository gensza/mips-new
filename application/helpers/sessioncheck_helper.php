<?php
// $ip_server = $_SERVER['SERVER_ADDR'];
// $domain = gethostbyaddr($ip_server);
// if(!empty($domain) && $domain == "localhost"){
// 	$alamat = $domain;
// }
// else{
// 	$alamat = $ip_server;
// }



function check_db_pt()
{
	$CI = &get_instance();
	$session_db_pt = strtolower($CI->session->userdata('sess_db'));
	if (empty($session_db_pt)) {
		$db_pt = "msal";
	} elseif ($session_db_pt == 'msal') {
		$db_pt = 'msal';
	} elseif ($session_db_pt == 'mapa') {
		$db_pt = 'mapa';
	} elseif ($session_db_pt == 'psam') {
		$db_pt = 'psam';
	} elseif ($session_db_pt == 'peak') {
		$db_pt = 'peak';
	} elseif ($session_db_pt == 'kpp') {
		$db_pt = 'kpp';
	}
	return $db_pt;
}
