<?php
class Users_model extends CI_Model
{

    //var $dps;

    function __construct()
    {
        parent::__construct();
        //$this->dps = $this->load->database('dps', TRUE);
    }

    function user_id()
    {
        return $this->session->userdata('sess_id');
    }

    function username()
    {
        return $this->session->userdata('sess_username');
    }

    function data()
    {
        $sql = "SELECT  a.nama, a.dept, a.id, b.nama AS nama_role, a.username, c.nama_pt as nama_pt, d.nama as nama_lokasi, e.nama as groupmodul FROM users AS a INNER JOIN module_role AS b ON a.id_module_role = b.id AND b.is_deleted = 0 INNER JOIN tb_pt AS c ON a.id_pt = c.kode_pt INNER JOIN codegroup AS d ON a.id_lokasi = d.value and d.group_n = 'LOKASI_USERS' LEFT JOIN codegroup AS e ON a.group_modul = e.value AND e.group_n = 'GROUP_MODULE' WHERE a.is_deleted = 0 ORDER BY a.id ASC";
        return $this->db->query($sql);
    }

    function detail($data)
    {
        $sql = "SELECT * FROM users WHERE id = '$data[id_pengguna]' and  is_deleted = 0 ORDER BY id ASC";
        return $this->db->query($sql);
    }

    function simpan($data)
    {

        $username = $this->username();

        $dept = $this->db->query("SELECT * FROM dept WHERE kode='$data[dept]'")->row();
        $level = $this->db->query("SELECT * FROM level_user WHERE kode_level='$data[level]'")->row();

        $d['nama'] = $data['nama'];
        $d['kode_dept'] = $dept->kode;
        $d['dept'] = $dept->nama;
        $d['kode_level'] = $level->kode_level;
        $d['level'] = $level->level;
        $d['id_pt'] = $data['pt'];
        $d['id_module_role'] = $data['role'];
        $d['id_lokasi'] = $data['lokasi'];
        $d['username'] = $data['username'];
        $d['password'] = $data['password'];
        $d['created_by'] = $username;
        $d['created_at'] = date('Y-m-d H:i:s');
        $d['group_modul'] = $data['group_modul'];



        return $this->db->insert('users', $d);
    }

    function update($data)
    {

        $username = $this->username();
        $dept = $this->db->query("SELECT * FROM dept WHERE kode='$data[dept]'")->row();
        $level = $this->db->query("SELECT * FROM level_user WHERE kode_level='$data[level]'")->row();


        $sql = "UPDATE users SET nama           = '$data[nama]',
                                kode_dept           = '$dept->kode',
                                dept           = '$dept->nama',
                                kode_level           = '$level->kode_level',
                                level           = '$level->level',
                                id_module_role  = '$data[role_edit]',
                                id_pt           = '$data[pt_edit]',
                                id_lokasi           = '$data[lokasi]',
                                group_modul     = '$data[group_modul]',
                                updated_at      = NOW() WHERE id = '$data[idpengguna]'";
        return $this->db->query($sql);
    }

    function get_data_lokasi()
    {

        $sql = "SELECT  * FROM codegroup WHERE group_n = 'LOKASI_USERS' ORDER BY `VALUE` asc";

        return $this->db->query($sql);
    }
}
