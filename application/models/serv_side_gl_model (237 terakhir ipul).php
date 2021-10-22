<?php 
class Serv_side_gl_model extends CI_Model{	
    
    //nama tabel dari database
    //var $table = 'noac_2014'; 
    //field yang ada di table user
    var $column_order = array(null, 'VOUCNO','FROM','txtperiode','AMOUNT'); 
    var $column_search = array('nama','lokasi','noac'); //field yang diizin untuk pencarian 
    var $order = array('noid' => 'asc'); // default order
    
    function __construct() {
        parent::__construct();
        $this->mstcode = $this->load->database('mstcode', TRUE);
        $this->mips_gl = $this->load->database('mips_gl', TRUE);
        
    }
	
	function periode(){
        
        $period = $this->session->userdata('sess_periode');
        $tahun  = substr($period, 0, 4);
        return $tahun;
        
    }
    
    private function _get_datatables_query(){

    $tahun = $this->periode();
	
	// $this->mips_gl->select("a.*");
    // $this->mips_gl->from('noac_'.$tahun.' as a');
	// $this->mips_gl->join($db1->database.'.noac as b','a.noac = b.noac');
	
	$query = "SELECT a.*, b.nama FROM db_mips_gl_msal.`noac_2014` AS a
	INNER JOIN db_mips_mscode.`noac` AS b ON a.`noac` = b.`noac` LIMIT 100";
	$this->mips_gl->query($query)->result();
	//var_dump($hasil);exit();
    
   
	/*SELECT a.*, b.nama FROM db_mips_gl_msal.`noac_2014` AS a
	INNER JOIN db_mips_mscode.`noac` AS b ON a.`noac` = b.`noac`
	*/
	
    //$db  = $this->load->database('mstcode', TRUE);
    //$db2 = $this->load->database('mips_gl', TRUE); 
    //$db2 = $this->load->database('mips_gl', TRUE);
   
    //$this->mips_gl->select("a.*");//,b.nama
    //$this->mips_gl->from('noac_'.$tahun.' as a');
    //$this->mips_gl->join($DB1->database.'.noac as b','a.noac = b.noac');
    //var_dump($this->mips_gl->last_query());exit();
	
    $i = 0;
    foreach ($this->column_search as $item) // looping awal
    {
        if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
        {
            if($i===0)// looping awal
            {
                //$this->db->group_start(); 
                $this->mips_gl->like($item, $_POST['search']['value']);
            }
            else
            {
                $this->mips_gl->or_like($item, $_POST['search']['value']);
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

    function get_datatables1()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->mips_gl->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_gl->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->mips_gl->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->mips_gl->from($this->table);
        return $this->mips_gl->count_all_results();
    }
	
	function get_datatables(){
        $data = array();
        $start = $_POST['start'];
        $length = $_POST['length'];
        $no = $start+1;
		
		// var_dump("uiiuiuiiui");exit();

		if(!empty($_POST['search']['value'])){
            $keyword = $_POST['search']['value'];
            $query = "SELECT id, noppo, noppotxt, tglppo, noref, noreftxt, tglref, tglppo, tgltrm, namadept, ket, pt, kodept, lokasi, status, status2, user FROM ppo
                        WHERE (status2 IN ('1','2','3') $keyfilter1 $jenis_spp) AND
                        (noppotxt LIKE '%$keyword%'
                        OR noreftxt LIKE '%$keyword%'
                        OR tglref LIKE '%$keyword%'
                        -- OR tglppo LIKE '%$keyword%'
                        OR tgltrm LIKE '%$keyword%'
                        OR namadept LIKE '%$keyword%'
                        OR ket LIKE '%$keyword%'
                        OR lokasi LIKE '%$keyword%'
                        OR status LIKE '%$keyword%')
                        ORDER BY tglisi DESC";
            $count_all = $this->mips_gl->query($query)->num_rows();
            $list = $this->mips_gl->query($query." LIMIT $start,$length")->result();
        }
        else{
            // $query = "SELECT id, noppo, noppotxt, tglppo, noref, noreftxt, tglref, tglppo, tgltrm, namadept, ket, pt, kodept, lokasi, status, status2, user FROM ppo WHERE status2 IN ('1','2','3') $keyfilter1 $jenis_spp ORDER BY tglisi DESC";
			$query = "SELECT a.*,b.* FROM db_mips_mscode.`noac` AS a LEFT JOIN db_mips_gl_msal.`noac_2014` AS b ON a.`noac` = b.`noac`";
        
            $count_all = $this->mips_gl->query($query)->num_rows();
            $list = $this->mips_gl->query($query." LIMIT $start,$length")->result();
            // $list = $this->mips_gl->query($query." LIMIT 100")->result();
        }
		
        foreach ($list as $customers) {
            $row   = array();
            $id = $hasil->id;
		
			$row[] = $no;
            $row[] = $customers->noac;
            $row[] = $customers->nama;
            $row[] = $customers->sbu;
            $row[] = $customers->group;
            $row[] = $customers->type;
            $row[] = "<a href='javascript:void(0)' onclick=getcontents('gl/master_edit','".$tokensapp."','".$customers->NOID."')><i class='splashy-document_letter_edit' title='Edit COA'></i></a>";
            $data[] = $row;
		}
		
		$output = array(
            "draw"              => $_POST['draw'], 
            "recordsTotal"      => $count_all, 
            "recordsFiltered"   => $count_all, 
            "data"              => $data, 
        );
        return $output;
	}

}
?>