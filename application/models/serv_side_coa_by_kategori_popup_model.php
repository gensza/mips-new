<?php
class Serv_side_coa_by_kategori_popup_model extends CI_Model
{

    //nama tabel dari database
    //field yang ada di table user
    var $table = 'noac';
    var $column_order = array(null, 'NOID', 'noac', 'nama', 'group', 'type');
    var $column_search = array('NOID', 'noac', 'nama', 'group', 'type'); //field yang diizin untuk pencarian 
    var $order = array('noac' => 'asc'); // default order


    function __construct()
    {
        parent::__construct();
        $this->load->database();

        //$this->mstcode = $this->load->database('mstcode', TRUE);
    }

    private function _get_datatables_query($code_filter, $divisi)
    {

        // $this->mips_center->select('NOID,noac,nama,sbu,group,type');
        // $this->mips_center->from('noac');
        // if ($kategori == 'TBM') {
        //     $this->mips_center->where("substr(noac,1,6) = '$code_filter'");
        // } else if ($kategori == 'LAND_CLEARING') {
        //     $this->mips_center->where("substr(noac,1,4) = '$code_filter' AND SUBSTR(noac,5,2) <> '00'");
        // } else if ($kategori == 'PEMBIBITAN') {
        //     $this->mips_center->where("substr(noac,1,6) = '$code_filter'");
        // } else if ($kategori == 'TM') {
        //     $this->mips_center->where("SUBSTR(noac,1,6) = '$code_filter' AND SUBSTR(noac,7,8) <> '0000'");
        // }
        // $dev_int = (int)($divisi);
        $this->mips_center->where('level !=', 1);
        $this->mips_center->where('type !=', 'G');
        $this->mips_center->like('sbu', (int)($divisi), 'both');
        $this->mips_center->like('noac', $code_filter, 'both');
        $this->mips_center->order_by('sbu', 'asc');
        $this->mips_center->from($this->table);

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

    function get_datatables($code_filter, $divisi)
    {
        $this->_get_datatables_query($code_filter, $divisi);
        if ($_POST['length'] != -1)
            $this->mips_center->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_center->get();
        return $query->result();
    }

    function count_filtered($code_filter, $divisi)
    {
        $this->_get_datatables_query($code_filter, $divisi);
        $query = $this->mips_center->get();
        return $query->num_rows();
    }

    public function count_all($code_filter, $divisi)
    {
        $this->mips_center->where('level !=', 1);
        $this->mips_center->like('noac', $code_filter, 'both');
        $this->mips_center->from($this->table);
        return $this->mips_center->count_all_results();
    }
}
