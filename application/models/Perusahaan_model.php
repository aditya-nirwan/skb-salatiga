<?php defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{
    // untuk Fungsi.php di library
    public function get($id)
    {
        $this->db->from('tb_user');
        $this->db->join('tb_perusahaan', 'tb_perusahaan.user_id = tb_user.user_id');
        $this->db->where('tb_perusahaan.user_id', $id);

        $query = $this->db->get();
        return $query;
    }

    // join tb_user dengan tb_perusahaan
    public function get_perusahaan($id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_perusahaan', 'tb_perusahaan.user_id = tb_user.user_id');
        if ($id != null) {
            $this->db->where('tb_perusahaan.perusahaan_id', $id); // filter berdasarkan => perusahaan_id
        }
        $this->db->order_by('tb_user.user_id', 'ASC');

        $query = $this->db->get();
        return $query;
    }


    // input user perusahaan
    public function add_perusahaan($post)
    {
        $params_user['username'] = $post['username'];
        $params_user['password'] = sha1($post['password']);
        // $params_user['password'] = $post['password'];
        $params_user['email'] = $post['email'];
        $params_user['alamat'] = $post['alamat'];
        $params_user['no_hp'] = $post['nohp'];
        $params_user['level'] = 2; // level perusahaan
        $this->db->insert('tb_user', $params_user);

        $id = $post['username'];
        $query = $this->db->query("select user_id from tb_user where username = '$id'");
        $row = $query->row();

        $params_perusahaan['user_id'] = $row->user_id;
        $params_perusahaan['nama_perusahaan'] = $post['nama'];
        $params_perusahaan['no_telp'] = $post['notelp'];
        $params_perusahaan['bidang'] = $post['bidang'];
        $params_perusahaan['profil'] = $post['deskripsi'];
        $this->db->insert('tb_perusahaan', $params_perusahaan);
    }

    // edit perusahaan
    public function edit_perusahaan($post)
    {
        $params_user['username'] = $post['username'];
        if (!empty($post['password'])) {
            $params_user['password'] = sha1($post['password']);
            // $params_user['passsword'] = $post['password'];
        }

        $params_perusahaan['user_id'] = $post['user_id'];
        $params_user['email'] = $post['email'];
        $params_user['alamat'] = $post['alamat'];
        $params_user['no_hp'] = $post['nohp'];
        $this->db->where('user_id', $post['user_id']);
        $this->db->update('tb_user', $params_user);

        $params_ph['nama_perusahaan'] = $post['nama'];
        $params_ph['no_telp'] = $post['notelp'];
        $params_ph['bidang'] = $post['bidang'];
        $params_ph['profil'] = $post['deskripsi'];
        $this->db->where('user_id', $post['user_id']);
        $this->db->update('tb_perusahaan', $params_ph);
    }

    // hapus perusahaan
    public function del($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('tb_user');

        $this->db->where('user_id', $id);
        $this->db->delete('tb_perusahaan');
    }


    // private $_table = 'tb_ph';

    // public function count()
    // {
    //     return $this->db->count_all($this->_table);
    // }

    // upload foto
    public function upload_foto_perusahaan($post, $userid)
    {
        $params['image'] = $post['image'];

        $this->db->where('user_id', $userid);
        $this->db->update('tb_user', $params);
    }
}
