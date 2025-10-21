<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pd_model extends CI_Model
{
    // untuk Fungsi.php di library
    public function get($id)
    {
        $this->db->from('tb_user');
        $this->db->join('tb_pd', 'tb_pd.user_id = tb_user.user_id');
        $this->db->where('tb_pd.user_id', $id);

        $query = $this->db->get();
        return $query;
    }

    // coba join
    public function get_pd($id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_pd', 'tb_pd.user_id = tb_user.user_id'); // join user_id sama
        if ($id != null) {
            $this->db->where('tb_pd.pd_id', $id); // filter berdasarkan => pd_id
        }
        $this->db->order_by('tb_pd.pd_id', 'ASC');

        $query = $this->db->get();
        return $query;
    }

    // input pd
    public function add_pd($post)
    {
        $params_user['username'] = $post['username'];
        $params_user['password'] = sha1($post['password']);
        // $params_user['password'] = $post['password'];
        $params_user['email'] = $post['email'];
        $params_user['no_hp'] = $post['no_hp'];
        $params_user['alamat'] = $post['alamat'];
        $params_user['level'] = 3; // level pd
        $this->db->insert('tb_user', $params_user);

        // $id = user_id($post['username']);
        // $user_id = $this->db->query("select user_id from tb_user where usernasme = '$id'");

        // $this->db->select('user_id');
        // $this->db->from('tb_user');
        // $this->db->where('username', $post['username']);
        // $query = $this->db->get();

        $user = $post['username'];
        $query = $this->db->query("select user_id from tb_user where username = '$user'");

        $row = $query->row();

        $params_pd['user_id'] = $row->user_id;
        $params_pd['nama_pd'] = $post['nama'];
        $params_pd['gender'] = $post['gender'];
        $params_pd['tgl_lahir'] = $post['tgl_lahir'];

        $this->db->insert('tb_pd', $params_pd);
    }

    // edit pd
    public function edit_pd($post)
    {
        $params_user['username'] = $post['username'];
        if (!empty($post['password'])) {
            $params_user['password'] = sha1($post['password']);
        }
        $params_user['email'] = $post['email'];
        $params_user['no_hp'] = $post['no_hp'];
        $params_user['alamat'] = $post['alamat'];
        $this->db->where('user_id', $post['user_id']);
        $this->db->update('tb_user', $params_user);

        $params_pd['user_id'] = $post['user_id'];
        $params_pd['nama_pd'] = $post['nama'];
        $params_pd['gender'] = $post['gender'];
        $params_pd['tgl_lahir'] = $post['tgl_lahir'];
        $this->db->where('user_id', $post['user_id']);
        $this->db->update('tb_pd', $params_pd);
    }

    // public function add_user($post, $id)
    // {
    //     $params_pd['user_id'] = $id;
    //     $params_pd['nama_pd'] = $post['nama'];
    //     $params_pd['gender'] = $post['gender'];
    //     $params_pd['tgl_lahir'] = $post['tgl_lahir'];

    //     $this->db->insert('tb_pd', $params_pd);
    // }

    // public function user_id($user)
    // {
    //     $this->db->select('user_id');
    //     $this->db->from('tb_user');
    //     $this->db->where('username', $user);
    //     $query = $this->db->get();
    //     if ($query->num_rows() > 0) {
    //         return $query->row()->user_id;
    //     }
    //     return false;
    // }

    // hapus pd dari 2 tabel
    public function del($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('tb_user');

        $this->db->where('user_id', $id);
        $this->db->delete('tb_pd');
    }

    public function add_sekolah($post)
    {
        $params['pd_id'] = $post['pd_id'];
        $params['sekolah'] = $post['sekolah'];
        $params['tahun_masuk'] = $post['masuk'];
        $params['tahun_lulus'] = $post['lulus'];

        $this->db->insert('tb_sekolah', $params);
    }
    public function del_sekolah($id, $sekolah)
    {
        $this->db->where('pd_id', $id);
        $this->db->where('sekolah', $sekolah);
        $this->db->delete('tb_sekolah');
    }


    public function add_sertifikat($post)
    {
        $params['pd_id'] = $post['pd_id'];
        $params['pelatihan'] = $post['pelatihan'];
        $params['penyelenggara'] = $post['penyelenggara'];
        $params['tahun'] = $post['tahun'];

        $this->db->insert('tb_sertifikat', $params);
    }
    public function del_sertifikat($id, $pelatihan, $penyelenggara)
    {
        $this->db->where('pd_id', $id);
        $this->db->where('pelatihan', $pelatihan);
        $this->db->where('penyelenggara', $penyelenggara);
        $this->db->delete('tb_sertifikat');
    }

    public function get_sekolah($user_id)
    {
        $this->db->select('*');
        $this->db->from('tb_sekolah');
        $this->db->where('pd_id', $user_id);

        $query = $this->db->get();
        return $query;
    }
    public function get_sertifikat($user_id)
    {
        $this->db->select('*');
        $this->db->from('tb_sertifikat');
        $this->db->where('pd_id', $user_id);

        $query = $this->db->get();
        return $query;
    }


    // filter join not in untuk pengajuan
    // jika sudah diajukan diloker tidak akan tampil di daftar pengajuan
    public function get_pd_pengajuan($lokerid)
    {
        // $this->db->select('tb_pd.pd_id, tb_pd.nama_pd, tb_pd.gender, tb_pd.tgl_lahir');
        $this->db->select('pd_id, nama_pd, gender, tgl_lahir');
        $this->db->from('tb_pd');
        // $this->db->join('tb_pd', 'tb_pd.username = tb_user.username');

        $this->db->where("tb_pd.pd_id NOT IN (
                            SELECT tb_pengajuan_detail.pd_id
                            FROM tb_loker
                            JOIN tb_pengajuan ON tb_pengajuan.loker_id = tb_loker.loker_id
                            JOIN tb_pengajuan_detail ON tb_pengajuan_detail.pengajuan_id = tb_pengajuan.pengajuan_id 
                            WHERE tb_loker.loker_id = '$lokerid' )");

        $this->db->order_by('pd_id', 'ASC');

        $query = $this->db->get();
        return $query;
    }


    // total pd
    // public function count()
    // {
    //     $query = $this->db->get_where('tb_user', ['level' => '3']);
    //     return $query->num_rows();
    // }


    // upload foto
    public function upload_foto_pd($post, $userid)
    {
        $params['image'] = $post['image'];

        $this->db->where('user_id', $userid);
        $this->db->update('tb_user', $params);
    }
}
