<?php

defined('BASEPATH') or exit('No direct script access allowed');

class serv_caba_detail extends CI_Model
{

    var $table = 'voucher_tmp';
    //field yang ada di table user
    var $column_order = array(null, 'VOUCNO', 'ACCTNO', 'DESCRIPT', 'REMARKS', 'DEBIT', 'CREDIT');
    var $column_search = array('VOUCNO', 'ACCTNO', 'DESCRIPT'); //field yang diizin untuk pencarian 
    var $order = array('VOUCNO' => 'asc'); // default order



    function __construct()
    {
        parent::__construct();
        $db_pt = check_db_pt();
        $this->mips_caba = $this->load->database('db_mips_cb_' . $db_pt, TRUE);
    }

    // function data_list_voucher_detail($data)
    // {
    //     $nama = $this->session->userdata('sess_nama');

    //     $sql = "SELECT *,FORMAT(debit, 2) debit_f
    //                         ,FORMAT(credit, 2) credit_f,
    //                         ID as id_vouc_tmp 
    //                     FROM voucher_tmp where voucno = '$data[kode_sementara]' and user='$nama'";
    //     return $this->mips_caba->query($sql);
    // }

    private function _get_datatables_query($no_voc)
    {

        $this->mips_caba->from($this->table);
        $this->mips_caba->where('VOUCNO', $no_voc);
        // if ($divisi != 0) {
        //     $this->mips_caba->where('sbu', $divisi);
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

    function get_datatables($no_voc)
    {
        $this->_get_datatables_query($no_voc);
        if ($_POST['length'] != -1)
            $this->mips_caba->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_caba->get();
        return $query->result();
    }

    function count_filtered($no_voc)
    {
        $this->_get_datatables_query($no_voc);
        $query = $this->mips_caba->get();
        return $query->num_rows();
    }

    public function count_all($no_voc)
    {
        $this->mips_caba->from($this->table);
        $this->mips_caba->where('VOUCNO', $no_voc);
        # code...

        return $this->mips_caba->count_all_results();
    }
}

/* End of file serv_caba_detail.php */
