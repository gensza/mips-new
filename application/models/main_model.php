<?php
class Main_model extends CI_Model
{

    //var $dps;

    function __construct()
    {
        parent::__construct();
        //$this->dps = $this->load->database('dps', TRUE);
        $db_pt = check_db_pt();
        $this->mips_logistik  = $this->load->database('mips_logistik_' . $db_pt, TRUE);
        $this->mips_center  = $this->load->database('mips_center', TRUE);
    }

    function user_id()
    {
        return $this->session->userdata('sess_id');
    }

    function check_token_main($token, $idus)
    {
        $sql = "SELECT * FROM users WHERE token = '$token' and id = '$idus' and is_deleted = '0' and aktif = '1'";
        return $this->db->query($sql)->num_rows();
    }

    function get_pt()
    {

        $id_pt = $this->session->userdata('sess_id_lokasi');

        $sql = "SELECT  * FROM codegroup WHERE group_n = 'LOKASI_USERS' AND value = '$id_pt' ";
        return $this->db->query($sql);
    }

    function check_passusertoken($token, $idus, $aktif)
    {

        if ($aktif == 1) { //ini kalo aktif
            $sql = "SELECT * FROM users WHERE token = '$token' and id = '$idus' and is_deleted = '0' and aktif = '1'";
            return $this->db->query($sql)->num_rows();
        } else {
            return '0';
        }
    }

    function check_token($token)
    {
        $sql = "SELECT * FROM users WHERE token = '$token' and is_deleted = '0' and aktif = '1'";
        return $this->db->query($sql)->num_rows();
    }

    function users_module()
    {

        $id_users = 13;

        $sql = "SELECT c.id_groups
                        FROM users as a
                        INNER JOIN users_groups as b ON a.id = b.id_users
                        INNER JOIN permission as c ON b.id_groups = c.id_groups and c.is_deleted = 0
                        WHERE a.is_deleted = 0 and a.id = '$id_users'";
        return $this->db->query($sql);
    }

    function get_lokasi()
    {
        $sess_lok = $this->session->userdata('sess_lokasi');
        $sql = "SELECT nama,value FROM codegroup where group_n = 'LOKASI_USERS' and value = '$sess_lok'";
        return $this->db->query($sql);
    }

    function get_modul_app()
    {

        $user_id = $this->user_id();

        $sql = "SELECT a.nama,a.`value` FROM codegroup AS a
                        INNER JOIN users AS b ON a.value= b.`group_modul` AND b.id = '$user_id'
                        WHERE a.group_n = 'GROUP_MODULE'";
        return $this->db->query($sql);
    }

    function update_periode($periode)
    {
        $this->db->where(['id_modul' => $this->session->userdata('sess_level'), 'id_pt' => $this->session->userdata('sess_pt'), 'lokasi' => $this->session->userdata('sess_id_lokasi')]);
        $this->db->set('txtperiode', $periode);
        $this->db->update('tb_setup');
        return TRUE;
    }

    public function count_data()
    {
        $this->mips_logistik->from('ppo_tmp');
        $this->mips_logistik->where('status2', '12');
        $count_spp_no_coa = $this->mips_logistik->count_all_results();
        return $count_spp_no_coa;
    }
}
