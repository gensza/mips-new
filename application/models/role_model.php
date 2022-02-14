<?php 
class Role_model extends CI_Model{	
    
    //var $dps;
    
    function __construct() {
        parent::__construct();
        //$this->dps = $this->load->database('dps', TRUE);
    }
    
    function username(){
        return $this->session->userdata('sess_id');
    }
    
    function data($data){
        $sql = "SELECT * FROM module_role WHERE is_deleted = 0 ORDER BY id ASC";  
        return $this->db->query($sql);
    }
    
    function group_modul(){
        $sql = "SELECT `value` AS valueid,nama FROM codegroup WHERE is_deleted = 0 AND group_n = 'GROUP_MODULE' ORDER BY id ASC";  
        return $this->db->query($sql);
    }

    function data_by_users(){
        $role = $this->session->userdata('sess_level');
        
        if($role == 1){
            $sql = "SELECT * FROM menu WHERE is_deleted = 0 ORDER BY id ASC";  
        return $this->db->query($sql);
        }else{
            $sql = "SELECT * FROM menu WHERE is_deleted = 0 and id_module_role = '$role' ORDER BY id ASC";  
            return $this->db->query($sql);
        }
        
        
    }
    
    
    function detail($data){
        $sql = "SELECT * FROM module_role WHERE id = '$data[id_role]' and  is_deleted = 0 ORDER BY id ASC";  
        return $this->db->query($sql);
    }
      
    function simpan($data){
        //$sql = "SELECT * FROM module WHERE is_deleted = 0 ORDER BY id ASC ";
        $username = $this->username();    
        
        $sql ="INSERT INTO module_role (nama,
                                    created_by,
                                    created_at) 
                            VALUES ('$data[nama]',
                                    '$username',
                                    NOW())";     
           
        return $this->db->query($sql);
    }
    
    
    function role_akses_update($data){

        $username = $this->username();
        $idrole    = $data['idrole'];
        $cbx_module  = $data['cbx_module'];

        //kita hapus dulu module_permission yang sebelumnya, baru insert ulang yang baru
        $sql3 = "DELETE FROM module_permission WHERE id_module_role = $idrole";
        $hasil = $this->db->query($sql3);


        //ini insert ulang
        $i = 0;
        foreach ($cbx_module as $i => $r){
            $cbx  = isset($r) ? "1" : "0";
            $sql_permission ="INSERT INTO module_permission (id_module_role,id_module,cbx) VALUES ('$idrole','".$r."','".$cbx."')";     
            $this->db->query($sql_permission);
        }

        return $hasil;

    }


    function role_update($data){
        
        $username = $this->username();
        
        $sql = "UPDATE role SET name       = '$data[nama]',
                                controller   = '$data[controller]',
                                icon         = '$data[icon]',
                                have_child   = '$data[punya_sub]',
                                updated_by   = '$username',
                                updated_at   = NOW() WHERE id = '$data[id_module]'";
        
        return $this->db->query($sql);
    }
    
}
