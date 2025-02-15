<?php
class Serv_side_gl_account_detail_model extends CI_Model
{

    //nama tabel dari database
    var $table = 'noac';
    //field yang ada di table user
    var $column_order = array(null, 'noac', 'general', 'level', 'type', 'nama', 'group');
    var $column_search = array('noac', 'general', 'level', 'type', 'nama', 'group'); //field yang diizin untuk pencarian 
    var $order = array('noac' => 'asc'); // default order



    function __construct()
    {
        parent::__construct();
        //$this->mstcode = $this->load->database('mstcode', TRUE);

        $db_pt = check_db_pt();
    }

    private function _get_datatables_query()
    {

        $this->mips_gl->select('noac,general,level,type,nama,group');
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
}
