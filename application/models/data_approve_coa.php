<?php

defined('BASEPATH') or exit('No direct script access allowed');

class data_approve_coa extends CI_Model
{

    var $table = 'item_ppo_tmp'; //nama tabel dari database
    var $column_order = array(null, 'id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket'); //field yang ada di table supplier  
    var $column_search = array('id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'ASC'); // default order 

    function __construct()
    {
        parent::__construct();
        $this->load->database();

        $db_pt = check_db_pt();
        $this->mips_logistik  = $this->load->database('mips_logistik_' . $db_pt, TRUE);
    }

    private function _get_datatables_query()
    {


        $this->mips_logistik->from($this->table);
        $this->mips_logistik->where('grup !=', '0');

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    // $this->mips_logistik->group_start();
                    $this->mips_logistik->like($item, $_POST['search']['value']);
                } else {
                    $this->mips_logistik->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    // $this->mips_logistik->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->mips_logistik->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->mips_logistik->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->mips_logistik->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_logistik->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->mips_logistik->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->mips_logistik->from($this->table);
        return $this->mips_logistik->count_all_results();
    }
}

/* End of file data_approve_coa.php */
