<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesertadidik extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $method = $this->router->fetch_method();
        if ($method != 'profile') {
            check_admin();
        }

        $this->load->model('pd_model');
        $this->load->library('form_validation');
    }

    // tampil data pd
    public function index()
    {
        $data['row'] = $this->pd_model->get_pd();
        $this->template->load('template', 'pesertadidik/data_pd', $data);
    }

    // profile peserta didik
    public function profile($id)
    {
        $query = $this->pd_model->get_pd($id);
        if ($query->num_rows() > 0) {
            $data = [
                'row' => $query->row(),
                'sekolah' => $this->pd_model->get_sekolah($id),
                'sertifikat' => $this->pd_model->get_sertifikat($id)
            ];
            $this->template->load('template', 'pesertadidik/profile_pd', $data);
        }
    }

    // input pd
    public function add()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric');
        $this->form_validation->set_rules(
            'passconf',
            'Konfirmasi password',
            'required|matches[password]',
            array('matches' => '%s tidak sesuai dengan password')
        );
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric');

        $this->form_validation->set_message('required', '%s masih kosong, mohon diisi');
        $this->form_validation->set_message('is_unique', '{field} sudah di pakai');
        $this->form_validation->set_message('alpha_numeric', '{field} tidak boleh mengandung spasi');
        $this->form_validation->set_message('numeric', '{field} tidak boleh ada huruf');
        $this->form_validation->set_message('valid_email', 'Format {field} tidak sesuai');

        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'pesertadidik/add_pd');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->pd_model->add_pd($post);
            // $id = $this->pd_model->user_id($post['username']);
            // $this->pd_model->add_user($post, $id);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data berhasil disimpan'); </script>";
            }
            echo "<script> window.location='" . site_url('pesertadidik') . "' </script>";
        }
    }

    // edit pd
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
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric');

        $this->form_validation->set_message('required', '%s masih kosong, mohon diisi');
        $this->form_validation->set_message('alpha_numeric', '{field} tidak boleh mengandung spasi');
        $this->form_validation->set_message('numeric', '{field} tidak boleh ada huruf');
        $this->form_validation->set_message('valid_email', 'Format {field} tidak sesuai');

        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->pd_model->get_pd($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->template->load('template', 'pesertadidik/edit_pd', $data);
            } else {
                echo "<script> alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('pesertadidik') . "' </script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->pd_model->edit_pd($post);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data berhasil disimpan'); </script>";
            }
            echo "<script> window.location='" . site_url('pesertadidik') . "' </script>";
        }
    }

    //CALLBACK EDIT PERUSAHAAN
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

    // hapus pd
    public function del()
    {
        $id = $this->input->post('user_id');
        $pd_id = $this->input->post('pd_id');

        $pd = $this->pd_model->get_pd($pd_id)->row();
        if ($pd->image != null) {
            $target_file = './assets/dist/img/foto/' . $pd->image;
            unlink($target_file);
        }

        $this->pd_model->del($id);

        if ($this->db->affected_rows() > 0) {
            echo "<script> alert('Data berhasil dihapus'); </script>";
        }
        echo "<script> window.location='" . site_url('pesertadidik') . "' </script>";
    }


    // input histori sekolah
    public function add_sekolah()
    {
        $id = $this->input->post('pd_id');
        $post = $this->input->post(null, TRUE);
        $this->pd_model->add_sekolah($post);

        echo "<script> window.location='" . site_url('pesertadidik/profile/' . $id) . "' </script>";
    }

    // hapus sekolah
    public function del_sekolah()
    {
        $id = $this->input->post('pd_id');
        $sekolah = $this->input->post('sekolah');

        $this->pd_model->del_sekolah($id, $sekolah);

        // if ($this->db->affected_rows() > 0) {
        //     echo "<script> alert('Data berhasil dihapus'); </script>";
        // }
        echo "<script> window.location='" . site_url('pesertadidik/profile/' . $id) . "' </script>";
    }

    // add sertifikat
    public function add_sertifikat()
    {
        $post = $this->input->post(null, TRUE);
        $this->pd_model->add_sertifikat($post);

        $id = $this->input->post('pd_id');
        echo "<script> window.location='" . site_url('pesertadidik/profile/' . $id) . "' </script>";
    }

    // hapus sekolah
    public function del_sertifikat()
    {
        $id = $this->input->post('pd_id');
        $pelatihan = $this->input->post('pelatihan');
        $penyelenggara = $this->input->post('penyelenggara');

        $this->pd_model->del_sertifikat($id, $pelatihan, $penyelenggara);

        echo "<script> window.location='" . site_url('pesertadidik/profile/' . $id) . "' </script>";
    }

    public function upload($userid)
    {
        // $config['upload_path']      = './uploads/foto/';
        $config['upload_path']      = './assets/dist/img/foto/';
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['max_size']         = 2048;
        $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        if (@$_FILES['image']['name'] != null) {
            if ($this->upload->do_upload('image')) {
                $pd_id = $this->input->post('pd_id');
                $pd = $this->pd_model->get_pd($pd_id)->row();
                if ($pd->image != null) {
                    $target_file = './assets/dist/img/foto/' . $pd->image;
                    unlink($target_file);
                }

                $post['image'] = $this->upload->data('file_name');
                $this->pd_model->upload_foto_pd($post, $userid);

                redirect('pesertadidik/profile/' . $pd_id);
            } else {
                $this->upload->display_errors();
                redirect('pesertadidik');
            }
        }
    }
}
