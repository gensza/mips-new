<?php

defined('BASEPATH') or exit('No direct script access allowed');

class rekap_model extends CI_Model
{

    //nama tabel dari database
    var $table = 'saldo_voucher';
    //field yang ada di table user
    var $column_order = array(null, 'id', 'ACCTNO', 'ACCTNAME');
    var $column_search = array('ACCTNO', 'ACCTNAME'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order




    private function _get_datatables_query($tgl_start, $tgl_end, $chx_periode)
    {

        $this->mips_caba->where('thn', $chx_periode);
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

    function get_datatables($tgl_start, $tgl_end, $chx_periode)
    {
        $this->_get_datatables_query($tgl_start, $tgl_end, $chx_periode);
        if ($_POST['length'] != -1)
            $this->mips_caba->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_caba->get();
        return $query->result();
    }

    function count_filtered($tgl_start, $tgl_end, $chx_periode)
    {
        $this->_get_datatables_query($tgl_start, $tgl_end, $chx_periode);
        $query = $this->mips_caba->get();
        return $query->num_rows();
    }

    public function count_all($tgl_start, $tgl_end, $chx_periode)
    {
        $this->mips_caba->from($this->table);
        $this->mips_caba->where('thn', $chx_periode);
        return $this->mips_caba->count_all_results();
    }
}

/* End of file rekap_model.php */
