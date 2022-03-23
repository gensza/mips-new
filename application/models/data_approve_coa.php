<?php

defined('BASEPATH') or exit('No direct script access allowed');

class data_approve_coa extends CI_Model
{

    var $table = 'ppo_tmp'; //nama tabel dari database
    var $column_order = array(null, 'id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'ket', 'namadept', 'pt'); //field yang ada di table supplier  
    var $column_search = array('namadept', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'ASC'); // default order 

    function __construct()
    {
        parent::__construct();
        $this->load->database();

        // $db_pt = check_db_pt();
        // $this->mips_logistik  = $this->load->database('mips_logistik_' . $db_pt, TRUE);
        $this->mips_center  = $this->load->database('mips_center');
    }

    private function _get_datatables_query()
    {


        $this->mips_center->from($this->table);
        $this->mips_center->where('status2', '12');

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    // $this->mips_center->group_start();
                    $this->mips_center->like($item, $_POST['search']['value']);
                } else {
                    $this->mips_center->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    // $this->mips_center->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->mips_center->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->mips_center->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->mips_center->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_center->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->mips_center->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->mips_center->from($this->table);
        return $this->mips_center->count_all_results();
    }
}

/* End of file data_approve_coa.php */
