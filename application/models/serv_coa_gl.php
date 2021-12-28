<?php


defined('BASEPATH') or exit('No direct script access allowed');

class serv_coa_gl extends CI_Model
{

    //nama tabel dari database
    var $table = 'noac';
    //field yang ada di table user
    var $column_order = array(null, 'VOUCNO', 'FROM', 'txtperiode', 'AMOUNT');
    var $column_search = array('nama', 'lokasi', 'noac'); //field yang diizin untuk pencarian 
    var $order = array('noac' => 'asc'); // default order



    function __construct()
    {
        parent::__construct();
        //$this->mstcode = $this->load->database('mstcode', TRUE);
        $this->mips_gl = $this->load->database('mips_gl', TRUE);
    }

    private function _get_datatables_query($divisi)
    {

        $this->mips_gl->from($this->table);
        if ($divisi != 0) {
            $this->mips_gl->where('sbu', $divisi);
            # code...
        }


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

    function get_datatables($divisi)
    {
        $this->_get_datatables_query($divisi);
        if ($_POST['length'] != -1)
            $this->mips_gl->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_gl->get();
        return $query->result();
    }

    function count_filtered($divisi)
    {
        $this->_get_datatables_query($divisi);
        $query = $this->mips_gl->get();
        return $query->num_rows();
    }

    public function count_all($divisi)
    {
        $this->mips_gl->from($this->table);
        if ($divisi != 0) {
            $this->mips_gl->where('sbu', $divisi);
            # code...
        }
        return $this->mips_gl->count_all_results();
    }
}

/* End of file Serv_coa_gl.php */
