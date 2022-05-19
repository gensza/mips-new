<?php


defined('BASEPATH') or exit('No direct script access allowed');

class serv_coa extends CI_Model
{

    //nama tabel dari database
    var $table = 'master_accountcb';
    //field yang ada di table user
    var $column_order = array(null, 'ACCTNO', 'ACCTNAME', 'SITENO');
    var $column_search = array('ACCTNO', 'ACCTNAME'); //field yang diizin untuk pencarian 
    var $order = array('ACCTNO' => 'asc'); // default order




    private function _get_datatables_query($divisi)
    {
        $periode = $this->session->userdata('sess_periode');
        $tahun  = substr($periode, 0, 4);

        $this->mips_caba->from($this->table);
        $this->mips_caba->where('SITENO', $divisi);
        $this->mips_caba->where('thn', $tahun);
        // if ($divisi == '06') {
        //     # code...
        // }


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

    function get_datatables($divisi)
    {
        $this->_get_datatables_query($divisi);
        if ($_POST['length'] != -1)
            $this->mips_caba->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_caba->get();
        return $query->result();
    }

    function count_filtered($divisi)
    {
        $this->_get_datatables_query($divisi);
        $query = $this->mips_caba->get();
        return $query->num_rows();
    }

    public function count_all($divisi)
    {
        $this->mips_caba->from($this->table);
        $this->mips_caba->where('SITENO', $divisi);
        return $this->mips_caba->count_all_results();
    }

    function master_detail_account($acct_no, $acct_id)
    {
        $periode = $this->session->userdata('sess_periode');
        $tahun  = substr($periode, 0, 4);

        $sql = "SELECT id,ACCTNO,ACCTNAME FROM master_accountcb where id = '$acct_id' and ACCTNO = '$acct_no' and thn='$tahun'";

        return $this->mips_caba->query($sql);
        //return $this->mstcode->query($sql);
    }
}

/* End of file Serv_coa_gl.php */
