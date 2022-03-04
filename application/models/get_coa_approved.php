<?php

defined('BASEPATH') or exit('No direct script access allowed');

class get_coa_approved extends CI_Model
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
        $this->mips_center  = $this->load->database('mips_center', TRUE);
    }

    private function _get_datatables_query($id)
    {


        $this->mips_logistik->from($this->table);
        $this->mips_logistik->where('id', $id);

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

    function get_datatables($id)
    {
        $this->_get_datatables_query($id);
        if ($_POST['length'] != -1)
            $this->mips_logistik->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_logistik->get();
        return $query->result();
    }

    function count_filtered($id)
    {
        $this->_get_datatables_query($id);
        $query = $this->mips_logistik->get();
        return $query->num_rows();
    }

    public function count_all($id)
    {
        $this->mips_logistik->from($this->table);
        $this->mips_logistik->where('id', $id);
        return $this->mips_logistik->count_all_results();
    }

    public function get_grup()
    {
        # code...
        $grp = $this->input->get('grp');
        $data = $this->mips_center->query("SELECT DISTINCT(grp) FROM `kodebar` WHERE grp LIKE '%$grp%' ORDER BY id DESC")->result();
        return $data;
    }
}

/* End of file get_coa_approved.php */
