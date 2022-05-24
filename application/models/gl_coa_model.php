<?php
class Gl_coa_model extends CI_Model
{

    private $mips_gl;

    //nama tabel dari database
    var $table = 'noac';
    //field yang ada di table user
    var $column_order = array(null, 'noac', 'nama', 'sbu', 'group', 'type');
    var $column_search = array('noac', 'nama'); //field yang diizin untuk pencarian 
    var $order = array('noac' => 'asc'); // default order      

    function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $db_pt = check_db_pt();
        $this->mips_center  = $this->load->database('mips_center', TRUE);
    }

    function user_id()
    {
        return $this->session->userdata('sess_id');
    }


    function select_data_grup()
    {
        $sql = "SELECT * FROM codegroup where group_n = 'NOAC_GROUP' and is_deleted = 0 ORDER BY id ASC";
        return $this->db->query($sql);
    }

    function select_data_level()
    {
        $sql = "SELECT * FROM codegroup where group_n = 'NOAC_LEVEL' and is_deleted = 0 ORDER BY id ASC";
        return $this->db->query($sql);
    }

    function select_data_divisi()
    {
        $sql = "SELECT * FROM codegroup where group_n = 'NOAC_DIVISI' and is_deleted = 0 ORDER BY id ASC";
        return $this->db->query($sql);
    }

    function select_data_satuan()
    {
        $sql = "SELECT * FROM codegroup where group_n = 'NOAC_SATUAN' and is_deleted = 0 ORDER BY id ASC";
        return $this->db->query($sql);
    }


    function get_datatables_dump()
    {
        $sql = "SELECT noac,nama FROM noac";
        return $this->mips_gl->query($sql);
    }

    private function _get_datatables_query()
    {

        $this->mips_gl->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    //$this->db->group_start(); 
                    $this->mips_gl->like($item, $_POST['search']['value']);
                } else {
                    $this->mips_gl->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    //$this->db->group_end(); 
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->mips_gl->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->mips_gl->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->mips_gl->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_gl->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->mips_gl->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->mips_gl->from($this->table);
        return $this->mips_gl->count_all_results();
    }


    function simpan($data)
    {

        $user_id = $this->user_id();

        $noacc          = str_replace(".", "", $data['noacc']);
        $acc_general    = str_replace(".", "", $data['acc_general']);
        $acc_balance    = str_replace(",", "", $data['acc_balance']);


        if ($data['d_c'] == 'D') {

            $sql = "INSERT INTO noac (noac,
                                    nama,
                                    sbu,
                                    `group`,
                                    `type`,
                                    `level`,
                                    general,
                                    yeard,
                                    yearc,
                                    created_by,
                                    created_at) 
                            VALUES ('$noacc',
                                    '$data[nama]',
                                    '0',
                                    '$data[grup]',
                                    '$data[g_d]',
                                    '$data[level]',
                                    '$acc_general',
                                    '$acc_balance',
                                    '0',
                                    '$user_id',
                                    NOW())";

            return $this->mips_gl->query($sql);
        } else {


            $sql = "INSERT INTO noac (noac,
                                    nama,
                                    sbu,
                                    `group`,
                                    `type`,
                                    `level`,
                                    general,
                                    yeard,
                                    yearc,
                                    created_by,
                                    created_at) 
                            VALUES ('$noacc',
                                    '$data[nama]',
                                    '0',
                                    '$data[grup]',
                                    '$data[g_d]',
                                    '$data[level]',
                                    '$acc_general',
                                    '0',
                                    '$acc_balance',
                                    '$user_id',
                                    NOW())";
        }
    }

    function coa_detail($id_coa)
    {

        $sql = "SELECT *,CONCAT(SUBSTR(noac,1,2), '.', SUBSTR(noac,3,2), '.', SUBSTR(noac,5,2), '.', SUBSTR(noac,7,2), '.', SUBSTR(noac,9,2))  AS kode_noac,FORMAT(balancedr, 0) AS balancedr FROM noac where noid = '$id_coa'";

        return $this->mips_gl->query($sql);
    }


    function detail_account($acct_no, $acct_id)
    {

        $sql = "SELECT noid,noac,nama FROM noac where noid = '$acct_id' and noac = '$acct_no'";

        return $this->mips_gl->query($sql);
    }

    function update_saldo($data)
    {

        $user_id = $this->user_id();

        $acc_balance    = str_replace(",", "", $data['saldoawal_acc']);

        $sql = "UPDATE noac SET balancedr   = '$acc_balance',
                                    updated_by  = '$user_id',
                                    updated_at  = NOW() WHERE noid = '$data[idnoac]'";
        return $this->mips_gl->query($sql);
    }

    function get_data_detail_coa($id_coa)
    {

        $sql = "SELECT *,type as type_g,
                            CONCAT(SUBSTR(noac,1,2), '.', SUBSTR(noac,3,2), '.', SUBSTR(noac,5,2), '.', SUBSTR(noac,7,2), '.', SUBSTR(noac,9,2))  AS kode_noac,
                            CONCAT(SUBSTR(general,1,2), '.', SUBSTR(general,3,2), '.', SUBSTR(general,5,2), '.', SUBSTR(general,7,2), '.', SUBSTR(general,9,2))  AS noac_general,
                            FORMAT(yearc, 2) AS yearc_f,
                            FORMAT(yeard, 2) AS yeard_f 
                        FROM noac where noid = '$id_coa'";

        return $this->mips_gl->query($sql);
    }



    function update($data)
    {

        $user_id = $this->user_id();

        $noacc          = str_replace(".", "", $data['noacc']);
        $acc_general    = str_replace(".", "", $data['acc_general']);
        $acc_balance    = str_replace(",", "", $data['acc_balance']);

        if ($data['d_c'] == 'D') {

            $sql = "UPDATE noac SET noac        = '$noacc',
                                    nama        = '$data[nama]',
                                    sbu         = 0,
                                    `group`     = '$data[grup]',
                                    `type`      = '$data[g_d]',
                                    `level`     = '$data[level]',
                                    general     = '$acc_general',
                                    yearc       = 0,
                                    yeard       = '$acc_balance', 
                                    updated_at  = NOW(),
                                    updated_by  = '$user_id'
                                WHERE NOID = '$data[noid_acc]'";

            return $this->mips_gl->query($sql);
        } else {

            $sql = "UPDATE noac SET noac        = '$noacc',
                                    nama        = '$data[nama]',
                                    sbu         = 0,
                                    `group`     = '$data[grup]',
                                    `type`      = '$data[g_d]',
                                    `level`     = '$data[level]',
                                    general     = '$acc_general',
                                    yearc       = '$acc_balance',
                                    yeard       = 0,
                                    updated_at  = NOW(),
                                    updated_by  = '$user_id' 
                                WHERE NOID = '$data[noid_acc]'";

            return $this->mips_gl->query($sql);
        }
    }
}
