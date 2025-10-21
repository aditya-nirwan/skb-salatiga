<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    // ambil user admin dari tabel tb_user
    public function get_admin($id = null)
    {
        $this->db->from('tb_user');
        $this->db->where('level', 1);
        if ($id != null) {
            $this->db->where('user_id', $id);
        }

        $query = $this->db->get();
        return $query;
    }


    // input admin
    public function add_admin($post)
    {
        $params['username'] = $post['username'];
        $params['password'] = sha1($post['password']);
        $params['email'] = $post['email'];
        $params['alamat'] = $post['alamat'];
        $params['no_hp'] = $post['no_hp'];
        $params['image'] = $post['image'];
        $params['level'] = 1; // level admin

        $this->db->insert('tb_user', $params);
    }

    public function edit_admin($post)
    {
        $params['username'] = $post['username'];
        if (!empty($post['password'])) {
            $params['password'] = sha1($post['password']);
            // $params['password'] = $post['password'];
        }
        $params['email'] = $post['email'];
        $params['alamat'] = $post['alamat'];
        $params['no_hp'] = $post['no_hp'];

        $this->db->where('user_id', $post['user_id']);
        $this->db->update('tb_user', $params);
    }

    // total admin
    public function count_admin()
    {
        $query = $this->db->get_where('tb_user', ['level' => '1']);
        return $query->num_rows();
    }
    // total perusahaan
    public function count_perusahaan()
    {
        $query = $this->db->get_where('tb_user', ['level' => '2']);
        return $query->num_rows();
    }
    // total peserta didik
    public function count_pesertadidik()
    {
        $query = $this->db->get_where('tb_user', ['level' => '3']);
        return $query->num_rows();
    }



    // delete admin
    public function del($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('tb_user');
    }

    // upload foto
    public function upload_foto_admin($post, $userid)
    {
        $params['image'] = $post['image'];

        $this->db->where('user_id', $userid);
        $this->db->update('tb_user', $params);
    }
}
