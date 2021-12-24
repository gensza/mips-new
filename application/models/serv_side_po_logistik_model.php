<?php
class serv_side_po_logistik_model extends CI_Model
{

    //nama tabel dari database
    // var $table = 'pp_logistik';
    // //field yang ada di table user
    // var $order = array('id' => 'DESC'); // default order
    var $table = 'pp_logistik';
    //field yang ada di table user
    var $column_order = array(null, 'nopp', 'nopo', 'ref_po', 'nama_supply', 'bayar', 'status_vou');
    var $column_search = array('nopp', 'ref_po', 'nopo'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order



    function __construct()
    {
        parent::__construct();
        $this->mips_caba = $this->load->database('mips_caba', TRUE);
    }

    private function _get_datatables_query()
    {

        $this->mips_caba->from($this->table);


        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    //$this->db->group_start(); 
                    $this->mips_caba->like($item, $_POST['search']['value']);
                } else {
                    $this->mips_caba->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    //$this->db->group_end(); 
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->mips_caba->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->mips_caba->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->mips_caba->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_caba->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->mips_caba->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->mips_caba->from($this->table);
        return $this->mips_caba->count_all_results();
    }
}
