<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    // login dari tabel tb_user
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('tb_user');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    // public function get_admin($id = null)
    // {
    //     $this->db->from('tb_user');
    //     $this->db->where('level', 1);
    //     if ($id != null) {
    //         $this->db->where('user_id', $id);
    //     }

    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function get_ph($id = null)
    // {
    //     $this->db->from('qr_ph');
    //     // $this->db->where('level', 2);
    //     if ($id != null) {
    //         $this->db->where('user_id', $id);
    //     }

    //     $query = $this->db->get();
    //     return $query;
    // }


    // public function get_pd($id = null)
    // {
    //     $this->db->from('qr_pd');
    //     // $this->db->where('level', 3);
    //     if ($id != null) {
    //         $this->db->where('user_id', $id);
    //     }

    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function add_pd($post)
    // {
    //     $params_user['username'] = $post['username'];
    //     $params_user['password'] = sha1($post['password']);
    //     $params_user['nama'] = $post['nama'];
    //     $params_user['level'] = 3;

    //     $params_pd['username'] = $post['username'];
    //     $params_pd['alamat'] = $post['alamat'];
    //     $params_pd['gender'] = $post['gender'];
    //     $params_pd['no_hp'] = $post['nohp'];
    //     $params_pd['asal_sekolah'] = $post['asal'];

    //     $this->db->insert('tb_user', $params_user);
    //     $this->db->insert('tb_pd', $params_pd);
    // }

    // public function add_ph($post)
    // {
    //     $params_user['username'] = $post['username'];
    //     $params_user['password'] = sha1($post['password']);
    //     $params_user['nama'] = $post['nama'];
    //     $params_user['level'] = 2;

    //     $params_ph['alamat'] = $post['alamat'];
    //     $params_ph['username'] = $post['username'];
    //     $params_ph['email'] = $post['email'];
    //     $params_ph['no_telp'] = $post['notelp'];
    //     $params_ph['profil'] = $post['profil'];

    //     $this->db->insert('tb_user', $params_user);
    //     $this->db->insert('tb_ph', $params_ph);
    // }
}
