<?php

defined('BASEPATH') or exit('No direct script access allowed');

class get_coa_approved extends CI_Model
{

    var $table = 'item_ppo'; //nama tabel dari database
    var $column_order = array(null, 'id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket'); //field yang ada di table supplier  
    var $column_search = array('id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'ASC'); // default order 

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->mips_center  = $this->load->database('mips_center', TRUE);
    }

    public function getWhere($alias)
    {
        $this->mips_logistik = $this->load->database('mips_logistik_' . $alias, TRUE);
    }

    private function _get_datatables_query($id, $pt)
    {



        $this->mips_logistik->from($this->table);
        $this->mips_logistik->where(['noreftxt' => $id, 'status2' => '12']);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    // $this->mips_logistik->group_start();
                    $this->mips_logistik->like($item, $_POST['search']['value']);
                } else {
                    $this->mips_logistik->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    // $this->mips_logistik->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->mips_logistik->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->mips_logistik->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($id, $pt)
    {
        $this->_get_datatables_query($id, $pt);
        if ($_POST['length'] != -1)
            $this->mips_logistik->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_logistik->get();
        return $query->result();
    }

    function count_filtered($id, $pt)
    {
        $this->_get_datatables_query($id, $pt);
        $query = $this->mips_logistik->get();
        return $query->num_rows();
    }

    public function count_all($id, $pt)
    {
        $this->mips_logistik->from($this->table);
        $this->mips_logistik->where('noreftxt', $id);
        return $this->mips_logistik->count_all_results();
    }

    public function get_grup()
    {
        # code...
        $grp = $this->input->get('grp');
        $data = $this->mips_center->query("SELECT DISTINCT(nama) FROM `noac` WHERE nama LIKE '%$grp%' AND `noac` LIKE '%1025%' AND `type` LIKE 'G' ORDER BY NOID DESC")->result();
        return $data;
    }

    public function get_kode_barang($grp)
    {
        $cari_general = $this->mips_center->query("SELECT * FROM noac WHERE nama LIKE '$grp' ")->row();
        $cari_last_noac = $this->mips_center->query("SELECT * FROM noac WHERE general='$cari_general->noac' ORDER BY NOID DESC LIMIT 1")->row();
        return $cari_last_noac->noac;
    }

    public function update_kodebar($id, $kodebar, $alias)
    {
        // $id = $this->input->post('id');
        // $kodebar = $this->input->post('kodebar');
        $this->db_logistik = $this->load->database('mips_logistik_' . $alias, TRUE);
        $this->db_logistik->where('id', $id);
        $this->db_logistik->update('item_ppo', ['kodebar' => $kodebar, 'kodebartxt' => $kodebar]);
        return true;
    }

    public function update_item_spp($id, $alias)
    {
        // $item_ppo = $this->mips_logistik->query("SELECT * FROM item_ppo WHERE id = '$id'")->row();
        // $ppo = $this->mips_logistik->query("SELECT * FROM ppo WHERE noreftxt = '$item_ppo->noreftxt'")->row();
        /* cek apakah header ppo sudah ada */
        // $data['status'] = 'DALAM PROSES';
        // $data['status2'] = 0;

        // $this->mips_logistik->where('id', $ppo->noreftxt);
        // $update_ppo = $this->mips_logistik->update('ppo', ['status' => 'DALAM PROSES', 'status2' => 0]);
        // $deleteppo = $this->mips_logistik->delete('ppo_tmp', ['noreftxt' => $item_ppo->noreftxt]);

        $this->db_logistik = $this->load->database('mips_logistik_' . $alias, TRUE);
        $this->db_logistik->where('id', $id);
        $update_item = $this->db_logistik->update('item_ppo', ['status' => 'DALAM PROSES', 'status2' => 0]);
        // $deleteitemppo = $this->mips_logistik->delete('item_ppo_tmp', ['id ' => $item_ppo->id]);
        /* end insert item_ppo */



        return $update_item;
    }

    public function update_ppo_tmp($id, $alias)
    {
        $this->db_logistik = $this->load->database('mips_logistik_' . $alias, TRUE);
        $d = $this->db_logistik->query("SELECT * FROM item_ppo WHERE id='$id'")->row();
        $noref = $d->noreftxt;
        $item1 = $this->db_logistik->query("SELECT * FROM item_ppo WHERE noreftxt='$noref'")->num_rows();
        $item2 = $this->db_logistik->query("SELECT * FROM item_ppo WHERE noreftxt='$noref' AND status2='0'")->num_rows();

        if ($item1 == $item2) {
            $data = array('status' => 'DALAM PROSES', 'status2' => '0');
            $update = $this->db_logistik->update('ppo', $data, array('noreftxt' => $noref));
            $delete = $this->mips_center->delete('ppo_tmp', array('noreftxt' => $noref));
        } else {
            $data = array('status' => 'SEBAGIAN', 'status2' => '11');
            $update = $this->db_logistik->update('ppo', $data, array('noreftxt' => $noref));
            $delete = false;
        }
        $data = [
            'update' => $update,
            'delete' => $delete,
        ];
        return $data;
    }

    public function save_kode_barang($id, $kodebar, $grp, $alias)
    {
        $this->db_logistik = $this->load->database('mips_logistik_' . $alias, TRUE);

        $item_ppo = $this->db_logistik->query("SELECT nabar FROM item_ppo WHERE id = '$id'")->row();
        # code...
        $data['kodebar'] = $kodebar;
        $data['kodebartxt'] = $kodebar;
        $data['nabar'] = $item_ppo->nabar;
        $data['grp'] = $grp;
        $data['satuan'] = $item_ppo->sat;
        $data['satuan'] = $item_ppo->sat;
        $data['spek'] = '-';
        $data['nopart'] = '-';
        $data['ket'] = '-';
        $data['inputtgl'] = date('Y-m-d H:i:s');
        $data['pt'] = $item_ppo->devisi;
        $data['kode'] = $item_ppo->kode_dev;

        $hasil = $this->mips_center->insert('kodebar', $data);
        return $hasil;
    }

    function save_coa_baru($id, $kodebar, $grp, $alias)
    {
        $this->db_logistik = $this->load->database('mips_logistik_' . $alias, TRUE);
        $item_ppo = $this->db_logistik->query("SELECT nabar, kode_dev, kodedept, LOKASI FROM item_ppo WHERE id = '$id'")->row();
        /* cari general di noac */
        $noac1 = $this->mips_center->query("SELECT * FROM noac WHERE nama LIKE '$grp' ")->row();
        $noac2 = $this->mips_center->query("SELECT * FROM noac WHERE general='$noac1->noac' ORDER BY NOID DESC LIMIT 1")->row();

        $lokasi = $item_ppo->LOKASI;

        $dt['noac'] = $kodebar;
        $dt['nama'] = $item_ppo->nabar;
        $dt['sbu'] = $item_ppo->kode_dev;
        $dt['group'] = $noac2->group;
        $dt['type'] = 'D';
        $dt['level'] = $noac2->level;
        $dt['general'] = $noac1->noac;
        $dt['costcenter'] = 0;
        $dt['depart'] = $item_ppo->kodedept;
        $dt['LOKASI'] = $lokasi;
        $dt['balancedr'] = 0;
        $dt['balancecr'] = 0;
        $dt['saldo01d'] = 0;
        $dt['saldo01c'] = 0;
        $dt['saldo02d'] = 0;
        $dt['saldo02c'] = 0;
        $dt['saldo03d'] = 0;
        $dt['saldo03c'] = 0;
        $dt['saldo04d'] = 0;
        $dt['saldo04c'] = 0;
        $dt['saldo05d'] = 0;
        $dt['saldo05c'] = 0;
        $dt['saldo06d'] = 0;
        $dt['saldo06c'] = 0;
        $dt['saldo07d'] = 0;
        $dt['saldo07c'] = 0;
        $dt['saldo08d'] = 0;
        $dt['saldo08c'] = 0;
        $dt['saldo09d'] = 0;
        $dt['saldo09c'] = 0;
        $dt['saldo10d'] = 0;
        $dt['saldo10c'] = 0;
        $dt['saldo11d'] = 0;
        $dt['saldo11c'] = 0;
        $dt['saldo12d'] = 0;
        $dt['saldo12c'] = 0;
        $dt['yeard'] = 0;
        $dt['yearc'] = 0;
        $dt['TGLINPUT'] = date('Y-m-d H:i:s');

        $hasil = $this->mips_center->insert('noac', $dt);   //insert noac
        $lok = strtolower($lokasi);
        // mips_gl_msal_site
        $this->gl = $this->load->database('mips_gl_' . $alias . '_' . $lok, TRUE);
        if ($lokasi != 'HO') {
            # code...
            $this->gl->insert('noac', $dt);
        }
        $this->mips_gl->insert('noac', $dt);

        return $hasil;
    }

    public function delete_itemppo_tmp($id, $kodebar, $alias)
    {
        $this->db_logistik = $this->load->database('mips_logistik_' . $alias, TRUE);
        $d = $this->db_logistik->query("SELECT noreftxt FROM item_ppo WHERE id='$id'")->row();
        $noref = $d->noreftxt;
        $this->mips_center->delete('item_ppo_tmp', array('noreftxt' => $noref, 'kodebar' => $kodebar));
        return TRUE;
    }


    public function get_noref($id)
    {
        $d = $this->mips_center->query("SELECT noreftxt FROM ppo_tmp WHERE id='$id'")->row();
        return $d->noreftxt;
    }
}

/* End of file get_coa_approved.php */
