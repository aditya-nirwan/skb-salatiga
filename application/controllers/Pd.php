<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pd extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $method = $this->router->fetch_method();
        if ($method != 'profile') {
            check_admin();
        }

        // $this->load->model('user_model');
        $this->load->model('pd_model');
        $this->load->library('form_validation');
    }

    // tampil data pd
    public function index()
    {
        $data['row'] = $this->pd_model->get_pd();
        $this->template->load('template', 'pd/data_pd', $data);
    }

    // profile peserta didik
    public function profile($id)
    {
        // $query = $this->pd_model->get_pd($user_id);
        // if ($query->num_rows() > 0) {
        //     $data['row'] = $query->row();
        //     $this->template->load('template', 'pd/profile_pd', $data);
        // }

        $query = $this->pd_model->get_pd($id);
        if ($query->num_rows() > 0) {
            $data = [
                'row' => $query->row(),
                'sekolah' => $this->pd_model->get_sekolah($id),
                'sertifikat' => $this->pd_model->get_sertifikat($id)
            ];
            $this->template->load('template', 'pd/profile_pd', $data);
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
            $this->template->load('template', 'pd/add_pd');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->pd_model->add_pd($post);
            // $id = $this->pd_model->user_id($post['username']);
            // $this->pd_model->add_user($post, $id);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data berhasil disimpan'); </script>";
            }
            echo "<script> window.location='" . site_url('pd') . "' </script>";
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
                $this->template->load('template', 'pd/edit_pd', $data);
            } else {
                echo "<script> alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('pd') . "' </script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->pd_model->edit_pd($post);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data berhasil disimpan'); </script>";
            }
            echo "<script> window.location='" . site_url('pd') . "' </script>";
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
        $this->pd_model->del($id);

        if ($this->db->affected_rows() > 0) {
            echo "<script> alert('Data berhasil dihapus'); </script>";
        }
        echo "<script> window.location='" . site_url('pd') . "' </script>";
    }


    // input histori sekolah
    public function add_sekolah()
    {
        $post = $this->input->post(null, TRUE);
        $this->pd_model->add_sekolah($post);

        if ($this->db->affected_rows() > 0) {
            echo "<script> alert('Data berhasil disimpan'); </script>";
        }
        echo "<script> window.location='" . site_url('pd/profile/' . $post['pd_id']) . "' </script>";

        // $this->form_validation->set_rules('sekolah', 'Sekolah', 'required');
        // $this->form_validation->set_rules('masuk', 'Tahun Masuk', 'required');
        // $this->form_validation->set_rules('keluar', 'Tahun Keluar', 'required');
        // $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        // $this->form_validation->set_message('required', '%s masih kosong, mohon diisi');

        // $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');

        // if ($this->form_validation->run() == FALSE) {
        //     $this->template->load('template', 'pd/profile/' . $id);
        // } else {
        //     $post = $this->input->post(null, TRUE);
        //     $this->pd_model->add_sekolah($post);

        //     if ($this->db->affected_rows() > 0) {
        //         echo "<script> alert('Data berhasil disimpan'); </script>";
        //     }
        //     echo "<script> window.location='" . site_url('pd/profile/' . $post['pd_id']) . "' </script>";
        // }
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
        echo "<script> window.location='" . site_url('pd/profile/' . $id) . "' </script>";
    }

    public function add_sertifikat()
    {
        $post = $this->input->post(null, TRUE);
        $this->pd_model->add_sertifikat($post);

        $id = $this->input->post('pd_id');
        echo "<script> window.location='" . site_url('pd/profile/' . $id) . "' </script>";
    }

    // hapus sekolah
    public function del_sertifikat()
    {
        $id = $this->input->post('pd_id');
        $pelatihan = $this->input->post('pelatihan');
        $penyelenggara = $this->input->post('penyelenggara');

        $this->pd_model->del_sertifikat($id, $pelatihan, $penyelenggara);

        echo "<script> window.location='" . site_url('pd/profile/' . $id) . "' </script>";
    }

    // input dan edit
    // input pd
    public function form()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules(
            'passconf',
            'Konfirmasi password',
            'required|matches[password]',
            array('matches' => '%s tidak sesuai dengan password')
        );
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nohp', 'No HP', 'required');
        $this->form_validation->set_rules('asal', 'Asal Sekolah', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, mohon diisi');
        $this->form_validation->set_message('is_unique', '{field} sudah di pakai');

        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'pd/form_pd');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->pd_model->add_pd($post);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data berhasil disimpan'); </script>";
            }
            echo "<script> window.location='" . site_url('pd') . "' </script>";
        }
    }



    // view kirim data
    public function view($user)
    {
        $query = $this->pd_model->get_pd($user);
        if ($query->num_rows() > 0) {
            $data['row'] = $query->row();
            $this->template->load('template', 'pd/view_pd', $data);
        }
    }
}
