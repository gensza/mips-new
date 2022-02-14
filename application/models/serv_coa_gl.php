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

    /* DISINI SAYA UBAH UNTUK EXPOSE KE PKS DARI MIPS_GL KE MIPS_CABA */


    function __construct()
    {
        parent::__construct();
        //$this->mstcode = $this->load->database('mstcode', TRUE);

        $db_pt = check_db_pt();
        $this->mips_caba = $this->load->database('db_mips_cb_' . $db_pt, TRUE);
        $this->mips_gl = $this->load->database('mips_gl_' . $db_pt, TRUE);
    }

    private function _get_datatables_query()
    {

        $this->mips_caba->from($this->table);
        // if ($divisi != 0) {
        //     $this->mips_caba->where('sbu', $divisi);
        //     # code...
        // }
        $this->mips_caba->where('type !=', 'G');


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

/* End of file Serv_coa_gl.php */
