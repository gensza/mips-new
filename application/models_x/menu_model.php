<?php 
class Menu_model extends CI_Model{	
    
    function __construct() {
        parent::__construct();
    }
    
    function username(){
        return $this->session->userdata('sess_id');
    }
    
    function data(){
        $sql = "SELECT * FROM menu WHERE is_deleted = 0 ORDER BY id ASC ";
        
        return $this->db->query($sql);
    }
    
    function data_select(){
        $sql = "SELECT * FROM menu WHERE is_deleted = 0 and parent = 46 ORDER BY id ASC ";
        
        return $this->db->query($sql);
    }
    
    function detail($data){
        $sql = "SELECT * FROM menu WHERE id = '$data[id_menu]' and is_deleted = 0 ";
        return $this->db->query($sql);
    }
    
    function get_module(){

        $username = $this->username();    
        if(empty($username)){
            redirect(base_url('main/logout'));
        }else{
            
            $sql = "SELECT a.id,
                        a.name,
                        a.name,
                        a.controller,
                        a.position,
                        a.have_child,
                        a.parent,
                        a.icon,
                        b.cbx
                    FROM module AS a
                    INNER JOIN module_permission AS b ON a.id = b.id_module
                    INNER JOIN users AS c ON b.`id_module_role` = c.`id_module_role` AND c.is_deleted = 0 AND c.`id` = '$username'
                    WHERE a.is_deleted = 0  
                    GROUP BY a.id";

            return $this->db->query($sql);

        }
        
    }
    
    
    
    function simpan($data){
        //$sql = "SELECT * FROM module WHERE is_deleted = 0 ORDER BY id ASC ";
        $user_nik = $this->username();    
        
        $sql ="INSERT INTO menu ( name,
                                            controller,
                                            position,
                                            have_child,
                                            parent,
                                            sequence,
                                            created_by,
                                            created_at) 
                                    VALUES ('$data[nama]',
                                            '$data[link]',
                                            '1',
                                            '$data[punya_sub]',
                                            '0',
                                            '0',
                                            '$user_nik',
                                            NOW())";     
           
        return $this->db->query($sql);
    }
    
    function hapus($data){
        
        $username = $this->username();
        
        $sql = "UPDATE menu SET is_deleted = '1', updated_by   = '$username',updated_at   = NOW() WHERE id = '$data[id_menu]'";
        
        return $this->db->query($sql);
    }
    
    
    function update($data){
        
        $username = $this->username();
        
        $sql = "UPDATE menu SET name       = '$data[nama]',
                                controller   = '$data[controller]',
                                have_child   = '$data[punya_sub]',
                                updated_by   = '$username',
                                updated_at   = NOW() WHERE id = '$data[id_menu]'";
        
        return $this->db->query($sql);
    }
    
    function menu_sub_simpan($data){
        
        $user_nik = $this->username();
        
        $sql ="INSERT INTO menu (name,
                                    controller,
                                    position,
                                    have_child,
                                    parent,
                                    sequence,
                                    created_by,
                                    created_at) 
                                    VALUES ('$data[nama]',
                                            '$data[nama_controller]',
                                            '2',
                                            'N',
                                            '$data[id_menu]',
                                            '0',
                                            '$user_nik',
                                            NOW())";     
           
        return $this->db->query($sql);
        
    }
    
    function data_menu_sub($data){
        $sql = "SELECT * FROM menu WHERE parent = '$data[id_menu]' and position = 2 AND  is_deleted = 0 ORDER BY id ASC ";
        return $this->db->query($sql);
    }
    
    function menu_sub_update($data){
        
        $username = $this->username();
        
        $sql = "UPDATE menu SET name          = '$data[nama]',
                                        controller         = '$data[nama_controller]',
                                        updated_by          = '$username',
                                        updated_at          = NOW() WHERE id = '$data[id_menu_sub]'";
        
        return $this->db->query($sql);
    }
    
    
    function menu_sub_hapus($data){
        
        $username = $this->username();
        
        $sql = "UPDATE menu SET is_deleted          = '1',updated_by          = '$username',
                                        updated_at          = NOW() WHERE id = '$data[id_menu_sub]'";
        
        return $this->db->query($sql);
    }
    
    function get_module_all(){

        $sql = "SELECT * FROM module AS a WHERE a.is_deleted = 0  ";

 
        $return = $this->db->query($sql);
       
        return $return;
        
    }
    
    function get_module_permission_users($id_role){

        
        $sql = "SELECT  a.name,
                        a.controller,
                        a.id as id_modules,
                        a.*,
                        (SELECT b.cbx FROM module_permission AS b WHERE a.id = b.`id_module` AND b.id_module_role = $id_role) cbx
                FROM module AS a 
                WHERE a.`is_deleted` = 0";
        
        return $this->db->query($sql);
       
    }
    
    
    function get_module_master(){
        
        $sql = "SELECT * FROM module WHERE is_deleted = '0' ORDER BY id";
        
        $return = $this->db->query($sql);
       
        return $return;
        
    }
    
    
    
    
    

}
?>