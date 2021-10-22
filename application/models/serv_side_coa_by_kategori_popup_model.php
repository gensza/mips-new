<?php 
class Serv_side_coa_by_kategori_popup_model extends CI_Model{	
    
    //nama tabel dari database
    //var $table = 'noac'; 
    //field yang ada di table user
    var $column_order = array(null, 'VOUCNO','FROM','txtperiode','AMOUNT'); 
    var $column_search = array('nama','lokasi','noac'); //field yang diizin untuk pencarian 
    var $order = array('noac' => 'asc'); // default order



    function __construct() {
        parent::__construct();
        //$this->mstcode = $this->load->database('mstcode', TRUE);
        $this->mips_gl = $this->load->database('mips_gl', TRUE);
        
    }
    
    
    private function _get_datatables_query($code_filter,$kategori){
         
        $this->mips_gl->select('NOID,noac,nama,sbu,group,type');
        $this->mips_gl->from('noac');
        if($kategori == 'TBM'){
            $this->mips_gl->where("substr(noac,1,6) = '$code_filter'");
        }else if(mips_gl == 'LAND_CLEARING'){
            $this->mips_gl->where("substr(noac,1,4) = '$code_filter' AND SUBSTR(noac,5,2) <> '00'");
        }else if($kategori == 'PEMBIBITAN'){
            $this->mips_gl->where("substr(noac,1,6) = '$code_filter'");
        }else if($kategori == 'TM'){
            $this->mips_gl->where("SUBSTR(noac,1,6) = '$code_filter' AND SUBSTR(noac,7,8) <> '0000'");
        }
        
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    //$this->db->group_start(); 
                    $this->mstcode->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->mstcode->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i){
                    //$this->db->group_end(); 
                } 
                    
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->mips_gl->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->mips_gl->order_by(key($order), $order[key($order)]);
        }

        }
     
        function get_datatables($code_filter,$kategori)
        {
            $this->_get_datatables_query($code_filter,$kategori);
            if($_POST['length'] != -1)
            $this->mips_gl->limit($_POST['length'], $_POST['start']);
            $query = $this->mips_gl->get();
            return $query->result();
        }
     
        function count_filtered($code_filter,$kategori)
        {
            $this->_get_datatables_query($code_filter,$kategori);
            $query = $this->mips_gl->get();
            return $query->num_rows();
        }
     
        public function count_all($code_filter,$kategori)
        {
            $this->mips_gl->select('NOID,noac,nama,sbu,group,type');
            $this->mips_gl->from('noac');
            if($kategori == 'TBM'){
                $this->mips_gl->where("SUBSTR(noac,1,6) = '$code_filter'");
            }else if($kategori == 'LAND_CLEARING'){
                $this->mips_gl->where("SUBSTR(noac,1,4) = '$code_filter' AND SUBSTR(noac,5,2) <> '00'");
            }else if($kategori == 'PEMBIBITAN'){
                $this->mips_gl->where("SUBSTR(noac,1,6) = '$code_filter'");
            }else if($kategori == 'TM'){
                $this->mips_gl->where("SUBSTR(noac,1,6) = '$code_filter' AND SUBSTR(noac,7,8) <> '0000'");
            }
            return $this->mips_gl->count_all_results();
        }

}
?>