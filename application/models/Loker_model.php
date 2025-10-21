<?php defined('BASEPATH') or exit('No direct script access allowed');

class Loker_model extends CI_Model
{
    // simpan loker
    public function add($post)
    {
        $params['perusahaan_id'] = $this->fungsi->user_perusahaan()->perusahaan_id; // sesuai yg login
        $params['posisi'] = ucfirst($post['posisi']);
        $params['tipe'] = ucfirst($post['tipe']);
        $params['jenis'] = ucfirst($post['jenis']);
        $params['lokasi'] = ucfirst($post['lokasi']);
        $params['deskripsi_loker'] = $post['deskripsi'];
        $params['syarat'] = $post['syarat'];
        $params['gaji'] = $post['gaji'] != "" ? $post['gaji'] : null;
        $params['deadline'] = $post['deadline'];

        $this->db->insert('tb_loker', $params);

        // mencari id loker
        $id = $this->fungsi->user_perusahaan()->perusahaan_id;
        $posisi = $post['posisi'];
        $query = $this->db->query("select loker_id, nama_perusahaan from tb_perusahaan join tb_loker 
                                    on tb_perusahaan.perusahaan_id = tb_loker.perusahaan_id 
                                    where tb_loker.perusahaan_id = '$id' and tb_loker.posisi = '$posisi'");
        $row = $query->row();

        // insert notif admin
        $params_notif['loker_id'] = $row->loker_id;
        $params_notif['perusahaan'] = $row->nama_perusahaan;
        $params_notif['posisi'] = $posisi;
        $params_notif['read'] = 'N';
        $this->db->insert('tb_notif_admin', $params_notif);
    }

    public function edit($post)
    {
        // $params['perusahaan_id'] = $this->fungsi->user_perusahaan()->perusahaan_id; // sesuai yg login
        $params['posisi'] = ucfirst($post['posisi']);
        $params['tipe'] = ucfirst($post['tipe']);
        $params['jenis'] = ucfirst($post['jenis']);
        $params['lokasi'] = ucfirst($post['lokasi']);
        $params['deskripsi_loker'] = $post['deskripsi'];
        $params['syarat'] = $post['syarat'];
        $params['gaji'] = $post['gaji'] != "" ? $post['gaji'] : null;
        $params['deadline'] = $post['deadline'];

        $this->db->where('loker_id', $post['loker_id']);
        $this->db->update('tb_loker', $params);
    }

    public function get_loker($loker_id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_loker');
        $this->db->join('tb_perusahaan', 'tb_perusahaan.perusahaan_id = tb_loker.perusahaan_id');
        if ($loker_id != null) {
            $this->db->where('tb_loker.loker_id', $loker_id);
        }
        $this->db->order_by('tb_loker.loker_id', 'DESC');

        $query = $this->db->get();
        return $query;
    }


    // untuk halaman profil berdasarkan => perusahaan_id
    public function get_loker_by_perusahaan($perusahaan_id)
    {
        $this->db->from('tb_loker');
        $this->db->where('perusahaan_id', $perusahaan_id);
        $this->db->order_by('deadline', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    // coba join
    public function get_detail($id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_loker');
        $this->db->join('tb_ph', 'tb_ph.username = tb_loker.username');
        // $this->db->order_by('tb_user.user_id', 'ASC');

        if ($id != null) {
            $this->db->where('tb_loker.loker_id', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    // hapus loker
    public function del($id)
    {
        $this->db->where('loker_id', $id);
        $this->db->delete('tb_loker');
    }



    public function get_pengajuan($lokerid)
    {
        $this->db->select('tb_pengajuan.pengajuan_id, tb_pd.pd_id, tb_pd.nama_pd, tb_pengajuan_detail.tgl_pengajuan, tb_pengajuan_detail.status, tb_pd.user_id, tb_user.image');
        $this->db->from('tb_loker');
        $this->db->join('tb_pengajuan', 'tb_pengajuan.loker_id = tb_loker.loker_id');
        $this->db->join('tb_pengajuan_detail', 'tb_pengajuan_detail.pengajuan_id = tb_pengajuan.pengajuan_id');
        $this->db->join('tb_pd', 'tb_pd.pd_id = tb_pengajuan_detail.pd_id');
        $this->db->join('tb_user', 'tb_pd.user_id = tb_user.user_id');
        $this->db->where('tb_loker.loker_id', $lokerid);
        // $this->db->order_by('tb_pengajuan_detail.user_id', 'ASC');

        $query = $this->db->get();
        return $query;
    }

    // pengajuan pd
    public function pengajuan_pd($post)
    {
        // mencari pengajuan_id sesuai loker_id
        $lokerid = $post['loker_id'];
        $query = $this->db->query("select pengajuan_id from tb_pengajuan where loker_id = '$lokerid'");
        if ($query->num_rows() == 0) {
            // simpan ke tb_pengajuan
            $params_pengajuan['loker_id'] = $post['loker_id'];
            $this->db->insert('tb_pengajuan', $params_pengajuan);
        }

        // mencari pengajuan_id sesuai loker_id
        $query = $this->db->query("select pengajuan_id from tb_pengajuan where loker_id = '$lokerid'");
        $row = $query->row();

        // simpan ke tb_pengajuan_detail
        // $pengajuan_id = $this->db->insert_id();
        $params_detail['pengajuan_id'] = $row->pengajuan_id;
        $params_detail['pd_id'] = $post['pd_id'];
        $params_detail['status'] = 'W';
        $this->db->insert('tb_pengajuan_detail', $params_detail);


        // insert notif pd
        $params_notif['loker_id'] = $post['loker_id'];
        $params_notif['pd_id'] = $post['pd_id'];
        $params_notif['jenis'] = 'Pengajuan';
        $params_notif['perusahaan'] = $post['perusahaan'];
        $params_notif['posisi'] = $post['posisi'];
        $params_notif['read_pd'] = 'N';
        $this->db->insert('tb_notif', $params_notif);


        $query = $this->db->query("select perusahaan_id from tb_loker where loker_id = '$lokerid'");
        $row = $query->row();

        // insert notif perusahaan
        $params_notif_perusahaan['perusahaan_id'] = $row->perusahaan_id;
        $params_notif_perusahaan['pd_id'] = $post['pd_id'];
        $params_notif_perusahaan['loker_id'] = $post['loker_id'];
        $params_notif_perusahaan['posisi'] = $post['posisi'];
        $params_notif_perusahaan['read_perusahaan'] = 'N';
        $this->db->insert('tb_notif_perusahaan', $params_notif_perusahaan);
    }

    // hapus pengajuan 
    public function del_pengajuan($pengajuan_id, $pd_id)
    {
        // hapus per item
        $this->db->where('pengajuan_id', $pengajuan_id);
        $this->db->where('pd_id', $pd_id);
        $this->db->delete('tb_pengajuan_detail');

        // mencari pengajuan_id
        $query = $this->db->query("select pengajuan_id from tb_pengajuan_detail where pengajuan_id = '$pengajuan_id'");
        if ($query->num_rows() == 0) {
            // hapus tabel induk tb_pengajuan
            $this->db->where('pengajuan_id', $pengajuan_id);
            $this->db->delete('tb_pengajuan');
        }
    }


    public function terima_pengajuan($post)
    {
        $params['status'] = 'Y';

        $this->db->where('pengajuan_id', $post['pengajuan_id']);
        $this->db->where('pd_id', $post['pd_id']);
        $this->db->update('tb_pengajuan_detail', $params);
    }
    public function batal_pengajuan($post)
    {
        $params['status'] = 'W';

        $this->db->where('pengajuan_id', $post['pengajuan_id']);
        $this->db->where('pd_id', $post['pd_id']);
        $this->db->update('tb_pengajuan_detail', $params);
    }



    // ================================================================
    // pagination loker
    public function get_data_loker($limit = null, $offset = null, $keywoard = null)
    {
        $this->db->select('tb_loker.*, tb_perusahaan.*, tb_user.image');
        $this->db->from('tb_loker');
        $this->db->join('tb_perusahaan', 'tb_perusahaan.perusahaan_id = tb_loker.perusahaan_id');
        $this->db->join('tb_user', 'tb_perusahaan.user_id = tb_user.user_id');
        $this->db->limit($limit, $offset);
        $this->db->order_by('tb_loker.loker_id', 'DESC');
        $query =  $this->db->get();
        return $query->result();
    }

    public function count_loker()
    {
        return $this->db->count_all('tb_loker');
    }

    public function get_loker_count()
    {
        $query = $this->db->get('tb_loker');
        return $query->num_rows();
    }

    // limit 3
    public function get_loker_dashboard()
    {
        $this->db->select('tb_loker.*, tb_perusahaan.nama_perusahaan, tb_user.image');
        $this->db->from('tb_loker');
        $this->db->join('tb_perusahaan', 'tb_perusahaan.perusahaan_id = tb_loker.perusahaan_id');
        $this->db->join('tb_user', 'tb_perusahaan.user_id = tb_user.user_id');
        $this->db->limit(3);
        $this->db->order_by('tb_loker.loker_id', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // join pengajuan
    public function get_data_pengajuan()
    {
        $this->db->select('tb_loker.posisi, tb_perusahaan.nama_perusahaan, tb_pd.nama_pd, tb_pengajuan_detail.tgl_pengajuan, tb_pengajuan_detail.status, tb_pengajuan.loker_id');
        $this->db->from('tb_pengajuan');
        $this->db->join('tb_pengajuan_detail', 'tb_pengajuan.pengajuan_id = tb_pengajuan_detail.pengajuan_id');
        $this->db->join('tb_loker', 'tb_pengajuan.loker_id = tb_loker.loker_id');
        $this->db->join('tb_pd', 'tb_pengajuan_detail.pd_id = tb_pd.pd_id');
        $this->db->join('tb_perusahaan', 'tb_loker.perusahaan_id = tb_perusahaan.perusahaan_id');
        $this->db->order_by('tb_pengajuan_detail.tgl_pengajuan', 'DESC');

        $query =  $this->db->get();
        return $query->result();
    }
}
