<?php

defined('BASEPATH') or exit('No direct script access allowed');

class get_coa_approved extends CI_Model
{

    var $table = 'item_ppo_tmp'; //nama tabel dari database
    var $column_order = array(null, 'id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket'); //field yang ada di table supplier  
    var $column_search = array('id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'ASC'); // default order 

    function __construct()
    {
        parent::__construct();
        $this->load->database();

        $db_pt = check_db_pt();
        $this->mips_logistik  = $this->load->database('mips_logistik_' . $db_pt, TRUE);
        $this->mips_center  = $this->load->database('mips_center', TRUE);
        $this->mips_gl = $this->load->database('mips_gl_' . $db_pt, TRUE);
    }

    private function _get_datatables_query($id)
    {


        $this->mips_logistik->from($this->table);
        $this->mips_logistik->where('id', $id);

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

    function get_datatables($id)
    {
        $this->_get_datatables_query($id);
        if ($_POST['length'] != -1)
            $this->mips_logistik->limit($_POST['length'], $_POST['start']);
        $query = $this->mips_logistik->get();
        return $query->result();
    }

    function count_filtered($id)
    {
        $this->_get_datatables_query($id);
        $query = $this->mips_logistik->get();
        return $query->num_rows();
    }

    public function count_all($id)
    {
        $this->mips_logistik->from($this->table);
        $this->mips_logistik->where('id', $id);
        return $this->mips_logistik->count_all_results();
    }

    public function get_grup()
    {
        # code...
        $grp = $this->input->get('grp');
        $data = $this->mips_center->query("SELECT DISTINCT(grp) FROM `kodebar` WHERE grp LIKE '%$grp%' ORDER BY id DESC")->result();
        return $data;
    }

    public function get_kode_barang($grp)
    {
        $cari_general = $this->mips_gl->query("SELECT * FROM noac WHERE nama LIKE '$grp' ")->row();
        $cari_last_noac = $this->mips_gl->query("SELECT * FROM noac WHERE general='$cari_general->noac' ORDER BY NOID DESC LIMIT 1")->row();
        return $cari_last_noac->noac;
    }

    public function update_kodebar($id, $kodebar)
    {
        // $id = $this->input->post('id');
        // $kodebar = $this->input->post('kodebar');
        $this->mips_logistik->where('id', $id);
        $this->mips_logistik->update('item_ppo_tmp', ['kodebar' => $kodebar, 'kodebartxt' => $kodebar]);
        return true;
    }

    public function cut_data_ppo_tmp($id)
    {
        $item_ppo = $this->mips_logistik->query("SELECT * FROM item_ppo_tmp WHERE id = '$id'")->row();
        $ppo = $this->mips_logistik->query("SELECT * FROM ppo_tmp WHERE noreftxt = '$item_ppo->noreftxt'")->row();
        $cek = $this->mips_logistik->query("SELECT * FROM ppo WHERE noreftxt = '$item_ppo->noreftxt'")->num_rows();
        /* cek apakah header ppo sudah ada */
        if ($cek == 0) {
            # code...
            /* insert header */
            $data['kpd'] = $ppo->kpd;
            $data['noppo'] = $ppo->noppo;
            $data['noppotxt'] = $ppo->noppotxt;
            $data['jenis'] = $ppo->jenis;
            $data['tglppo'] = $ppo->tglppo;
            $data['tglppotxt'] = $ppo->tglppotxt;
            $data['tgltrm'] = $ppo->tgltrm;
            $data['kodedept'] = $ppo->kodedept;
            $data['namadept'] = $ppo->namadept;
            $data['kode_dev'] = $ppo->kode_dev;
            $data['devisi'] = $ppo->devisi;
            $data['noref'] = $ppo->noref;
            $data['noreftxt'] = $ppo->noreftxt;
            $data['tglref'] = $ppo->tglref;
            $data['ket'] = $ppo->ket;
            $data['no_acc'] = $ppo->no_acc;
            $data['ket_acc'] = $ppo->ket_acc;
            $data['pt'] = $ppo->pt;
            $data['kodept'] = $ppo->kodept;
            $data['periode'] = $ppo->periode;
            $data['periodetxt'] = $ppo->periodetxt;
            $data['thn'] = $ppo->thn;
            $data['tglisi'] = $ppo->tglisi;
            $data['id_user'] = $ppo->id_user;
            $data['user'] = $ppo->user;
            $data['status'] = 'DALAM PROSES';
            $data['status2'] = 0;
            $data['TGL_APPROVE'] = $ppo->TGL_APPROVE;
            $data['lokasi'] = $ppo->lokasi;
            $data['po'] = $ppo->po;
            $data['kode_budget'] = $ppo->kode_budget;
            $data['grup'] = $ppo->grup;
            $data['main_acct'] = $ppo->main_acct;
            $data['nama_main'] = $ppo->nama_main;

            $hasilppo = $this->mips_logistik->insert('ppo', $data);
            $deleteppo = $this->mips_logistik->delete('ppo_tmp', ['noreftxt' => $item_ppo->noreftxt]);
        }

        /* insert item_ppo */
        $dt['noppo'] = $item_ppo->noppo;
        $dt['noppotxt'] = $item_ppo->noppotxt;
        $dt['jenis'] = $item_ppo->jenis;
        $dt['tglppo'] = $item_ppo->tglppo;
        $dt['tglppotxt'] = $item_ppo->tglppotxt;
        $dt['kodedept'] = $item_ppo->kodedept;
        $dt['namadept'] = $item_ppo->namadept;
        $dt['noref'] = $item_ppo->noref;
        $dt['noreftxt'] = $item_ppo->noreftxt;
        $dt['kodebar'] = $item_ppo->kodebar;
        $dt['kodebartxt'] = $item_ppo->kodebartxt;
        $dt['nabar'] = $item_ppo->nabar;
        $dt['sat'] = $item_ppo->sat;
        $dt['qty'] = $item_ppo->qty;
        $dt['qty2'] = $item_ppo->qty2;
        $dt['STOK'] = $item_ppo->STOK;
        $dt['harga'] = $item_ppo->harga;
        $dt['jumharga'] = $item_ppo->jumharga;
        $dt['kodept'] = $item_ppo->kodept;
        $dt['namapt'] = $item_ppo->namapt;
        $dt['kode_dev'] = $item_ppo->kode_dev;
        $dt['devisi'] = $item_ppo->devisi;
        $dt['periode'] = $item_ppo->periode;
        $dt['periodetxt'] = $item_ppo->periodetxt;
        $dt['thn'] = $item_ppo->thn;
        $dt['ket'] = $item_ppo->ket;
        $dt['tglisi'] = $item_ppo->tglisi;
        $dt['id_user'] = $item_ppo->id_user;
        $dt['user'] = $item_ppo->user;
        $dt['status'] = 'DALAM PROSES';
        $dt['status2'] = 0;
        $dt['TGL_APPROVE'] = $item_ppo->TGL_APPROVE;
        $dt['ada_penawar'] = $item_ppo->ada_penawar;
        $dt['LOKASI'] = $item_ppo->LOKASI;
        $dt['po'] = $item_ppo->po;
        $dt['saldo_po'] = $item_ppo->saldo_po;
        $dt['kode_budget'] = $item_ppo->kode_budget;
        $dt['grup'] = $item_ppo->grup;
        $dt['main_acct'] = $item_ppo->main_acct;
        $dt['nama_main'] = $item_ppo->nama_main;

        $hasilitemppo = $this->mips_logistik->insert('item_ppo', $dt);
        $deleteitemppo = $this->mips_logistik->delete('item_ppo_tmp', ['id ' => $item_ppo->id]);
        /* end insert item_ppo */

        return $hasil_semua = [
            'hasilppo' => $hasilppo,
            'hasilitemppo' => $hasilitemppo
        ];
    }

    public function save_kode_barang($id, $kodebar, $grp)
    {

        $item_ppo = $this->mips_logistik->query("SELECT nabar FROM item_ppo_tmp WHERE id = '$id'")->row();
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

    function save_coa_baru($id, $kodebar, $grp)
    {
        $item_ppo = $this->mips_logistik->query("SELECT * FROM item_ppo_tmp WHERE id = '$id'")->row();
        /* cari general di noac */
        $noac1 = $this->mips_gl->query("SELECT * FROM noac WHERE nama LIKE '$grp' ")->row();
        $noac2 = $this->mips_gl->query("SELECT * FROM noac WHERE general='$noac1->noac' ORDER BY NOID DESC LIMIT 1")->row();

        $dt['noac'] = $kodebar;
        $dt['nama'] = $item_ppo->nabar;
        $dt['sbu'] = $item_ppo->kode_dev;
        $dt['group'] = $noac2->group;
        $dt['type'] = 'D';
        $dt['level'] = $noac2->level;
        $dt['general'] = $noac1->noac;
        $dt['costcenter'] = $noac1->noac;
        $dt['depart'] = $item_ppo->kodedept;
        $dt['LOKASI'] = $item_ppo->LOKASI;
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

        $hasil = $this->mips_gl->insert('noac', $dt);   //insert noac

        return $hasil;
    }
}

/* End of file get_coa_approved.php */
