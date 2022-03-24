<?php

defined('BASEPATH') or exit('No direct script access allowed');

class get_new_coa extends CI_Model
{

    var $table = 'item_ppo'; //nama tabel dari database
    var $column_order = array(null,  'kodebar', 'nabar', 'kodept', 'grup', 'STOK', 'ket'); //field yang ada di table supplier  
    var $column_search = array('id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'ASC'); // default order 



    public function getWhere($alias)
    {
        $this->mips_logistik = $this->load->database('mips_logistik_' . $alias, TRUE);
    }

    private function _get_datatables_query($id)
    {



        $this->mips_logistik->from($this->table);
        $this->mips_logistik->where(['noreftxt' => $id]);

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
        $this->mips_logistik->where('noreftxt', $id);
        return $this->mips_logistik->count_all_results();
    }
}

/* End of file get_new_coa.php */
