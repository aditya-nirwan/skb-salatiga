<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $method = $this->router->fetch_method();
        if ($method != 'profile') {
            check_admin();
        }

        $this->load->model('perusahaan_model');
        $this->load->model('loker_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['row'] = $this->perusahaan_model->get_perusahaan();
        $this->template->load('template', 'perusahaan/data_perusahaan', $data);
    }

    // input perusahaan
    public function add()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric');
        $this->form_validation->set_rules('passconf', 'Konfirmasi password', 'required|matches[password]');
        $this->form_validation->set_rules('nama', 'Nama perusahaan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_emails');
        $this->form_validation->set_rules('notelp', 'Nomor Telp', 'required');
        $this->form_validation->set_rules('bidang', 'Bidang', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
        $this->form_validation->set_message('is_unique', '{field} sudah di pakai');
        $this->form_validation->set_message('alpha_numeric', '{field} tidak boleh mengandung spasi');
        $this->form_validation->set_message('matches', 'password tidak sama');
        $this->form_validation->set_message('valid_emails', 'Format email salah');

        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'perusahaan/add_perusahaan');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->perusahaan_model->add_perusahaan($post);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data Berhasil disimpan'); </script>";
            }
            echo "<script> window.location='" . site_url('perusahaan') . "' </script>";
        }
    }


    // edit perusahaan
    public function edit($id)
    {
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|callback_username_check');
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'alpha_numeric');
            $this->form_validation->set_rules(
                'passconf',
                'Konfirmasi password',
                'matches[password]',
                array('matches' => '%s tidak sesuai dengan password')
            );
        }
        if ($this->input->post('passconf')) {
            $this->form_validation->set_rules(
                'passconf',
                'Konfirmasi password',
                'matches[password]',
                array('matches' => '%s tidak sesuai dengan password')
            );
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_emails');
        $this->form_validation->set_rules('notelp', 'Nomor Telp', 'required');
        $this->form_validation->set_rules('bidang', 'Bidang', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
        $this->form_validation->set_message('alpha_numeric', '{field} tidak boleh mengandung spasi');
        $this->form_validation->set_message('matches', 'password tidak sama');
        $this->form_validation->set_message('valid_emails', 'Format email salah');

        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->perusahaan_model->get_perusahaan($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->template->load('template', 'perusahaan/edit_perusahaan', $data);
            } else {
                echo "<script> alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('perusahaan') . "' </script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->perusahaan_model->edit_perusahaan($post);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data berhasil disimpan'); </script>";
            }
            echo "<script> window.location='" . site_url('perusahaan') . "' </script>";
        }
    }

    // callback
    function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tb_user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', '{field} ini sudah di pakai, silakan ganti');
            return false;
        } else {
            return true;
        }
    }

    // hapus perusahaan
    public function del()
    {
        $id = $this->input->post('user_id');
        $perusahaan_id = $this->input->post('perusahaan_id');

        $perusahaan = $this->perusahaan_model->get_perusahaan($perusahaan_id)->row();
        if ($perusahaan->image != null) {
            $target_file = './assets/dist/img/foto/' . $perusahaan->image;
            unlink($target_file);
        }

        $this->perusahaan_model->del($id);

        if ($this->db->affected_rows() > 0) {
            echo "<script> alert('Data berhasil dihapus'); </script>";
        }
        echo "<script> window.location='" . site_url('perusahaan') . "' </script>";
    }






    public function view($user)
    {
        $query = $this->perusahaan_model->get_ph($user);
        if ($query->num_rows() > 0) {
            $data['row'] = $query->row();
            $this->template->load('template', 'perusahaan/view_ph', $data);
        }
    }

    // halaman profil perusahaan
    public function profile($id)
    {
        $query = $this->perusahaan_model->get_perusahaan($id);
        if ($query->num_rows() > 0) {
            $data = [
                'row' => $query->row(),
                'loker' => $this->loker_model->get_loker_by_perusahaan($id),
            ];
            $this->template->load('template', 'perusahaan/profile_perusahaan', $data);
        }
    }

    // upload image perusahaan
    public function upload($userid)
    {
        $config['upload_path']      = './assets/dist/img/foto/';
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['max_size']         = 2048;
        $config['file_name']        = 'perusahaan-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        if (@$_FILES['image']['name'] != null) {
            if ($this->upload->do_upload('image')) {
                $perusahaan_id = $this->input->post('perusahaan_id');
                $perusahaan = $this->perusahaan_model->get_perusahaan($perusahaan_id)->row();
                if ($perusahaan->image != null) {
                    $target_file = './assets/dist/img/foto/' . $perusahaan->image;
                    unlink($target_file);
                }

                $post['image'] = $this->upload->data('file_name');
                $this->perusahaan_model->upload_foto_perusahaan($post, $userid);

                redirect('perusahaan/profile/' . $perusahaan_id);
            } else {
                redirect('perusahaan');
            }
        }
    }
}
