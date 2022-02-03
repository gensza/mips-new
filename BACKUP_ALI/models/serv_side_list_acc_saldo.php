<?php

// defined('BASEPATH') or exit('No direct script access allowed');

class serv_side_list_acc_saldo extends CI_Model
{

      // start datatables
      var $table = 'noac'; //nama tabel dari database
      var $column_order = array(null, 'NOID', 'noac', 'nama', 'group', 'type', 'sbu', 'balancedr', 'balancecr', 'saldo01d', 'saldo01c', 'saldo02d', 'saldo02c', 'saldo03d', 'saldo03c', 'saldo04d', 'saldo04c', 'saldo05d', 'saldo05c', 'saldo06d', 'saldo06c', 'saldo07d', 'saldo07c', 'saldo08d', 'saldo08c', 'saldo09d', 'saldo09c', 'saldo10d', 'saldo10c', 'saldo11d', 'saldo11c', 'saldo12d', 'saldo12c', 'yeard', 'yearc'); //field yang ada di table user
      var $column_search = array('noac', 'nama', 'group', 'type', 'sbu', 'balancedr', 'balancecr', 'saldo01d', 'saldo01c', 'saldo02d', 'saldo02c', 'saldo03d', 'saldo03c', 'saldo04d', 'saldo04c', 'saldo05d', 'saldo05c', 'saldo06d', 'saldo06c', 'saldo07d', 'saldo07c', 'saldo08d', 'saldo08c', 'saldo09d', 'saldo09c', 'saldo10d', 'saldo10c', 'saldo11d', 'saldo11c', 'saldo12d', 'saldo12c', 'yeard', 'yearc'); //field yang diizin untuk pencarian 
      var $order = array('noac' => 'ASC'); // default order 

      public function __construct()
      {
            parent::__construct();
            $this->load->database();
      }

      private function _get_datatables_query()
      {
            // $this->mips_gl->where('level !=', 1);
            $this->mips_gl->from($this->table);

            $i = 0;

            foreach ($this->column_search as $item) // looping awal
            {
                  if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
                  {

                        if ($i === 0) // looping awal
                        {
                              // $this->mips_gl->group_start();
                              $this->mips_gl->like($item, $_POST['search']['value']);
                        } else {
                              $this->mips_gl->or_like($item, $_POST['search']['value']);
                        }

                        if (count($this->column_search) - 1 == $i) {
                              // $this->mips_gl->group_end();
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

      function get_datatables()
      {
            $this->_get_datatables_query();
            if ($_POST['length'] != -1)
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
      // end server side table

}

/* End of file serv_side_list_acc.php */
