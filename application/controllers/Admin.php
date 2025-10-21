<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('user_model');
        $this->load->model('admin_model');
        $this->load->library('form_validation');
    }

    // tampil data admin
    public function index()
    {
        $data['row'] = $this->admin_model->get_admin();
        $this->template->load('template', 'admin/data_admin', $data);
    }

    // input admin
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
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, mohon diisi');
        $this->form_validation->set_message('is_unique', '{field} sudah di pakai');
        $this->form_validation->set_message('alpha_numeric', '{field} tidak boleh mengandung spasi');
        $this->form_validation->set_message('numeric', '{field} tidak boleh ada huruf');
        $this->form_validation->set_message('valid_email', 'Format {field} tidak sesuai');

        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'admin/add_admin');
        } else {

            $config['upload_path']      = './assets/dist/img/foto/';
            $config['allowed_types']    = 'jpg|jpeg|png';
            $config['max_size']         = 2048;
            $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {
                    $post = [
                        'username' => $this->input->post('username'),
                        'password' => $this->input->post('password'),
                        'email' => $this->input->post('email'),
                        'alamat' => $this->input->post('alamat'),
                        'no_hp' => $this->input->post('no_hp'),
                        'image' => $this->upload->data('file_name'),
                    ];
                    $this->admin_model->add_admin($post);
                    if ($this->db->affected_rows() > 0) {
                        echo "<script> alert('Data berhasil disimpan'); </script>";
                    }
                    redirect('admin');
                } else {
                    redirect('admin');
                }
            } else {
                $post['image'] = null;
                $post = $this->input->post(null, TRUE);
                $this->admin_model->add_admin($post);

                if ($this->db->affected_rows() > 0) {
                    echo "<script> alert('Data berhasil disimpan'); </script>";
                }
                redirect('admin');
            }

            // $post = $this->input->post(null, TRUE);
            // $this->admin_model->add_admin($post);

            // if ($this->db->affected_rows() > 0) {
            //     echo "<script> alert('Data berhasil disimpan'); </script>";
            // }
            // echo "<script> window.location='" . site_url('admin') . "' </script>";
        }
    }

    // edit admin   
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

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, mohon diisi');
        $this->form_validation->set_message('alpha_numeric', '{field} tidak boleh mengandung spasi');
        $this->form_validation->set_message('numeric', '{field} tidak boleh ada huruf');
        $this->form_validation->set_message('valid_email', 'Format {field} tidak sesuai');

        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->admin_model->get_admin($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->template->load('template', 'admin/edit_admin', $data);
            } else {
                echo "<script> alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('admin') . "' </script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->admin_model->edit_admin($post);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data berhasil diubah'); </script>";
            }
            echo "<script> window.location='" . site_url('admin') . "' </script>";
        }
    }

    // callback untuk edit admin
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

    // hapus admin
    public function del()
    {
        $id = $this->input->post('user_id');

        $admin = $this->admin_model->get_admin($id)->row();
        if ($admin->image != null) {
            $target_file = './assets/dist/img/foto/' . $admin->image;
            unlink($target_file);
        }

        $this->admin_model->del($id);

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data berhasil di hapus');</script>";
        }
        echo "<script>window.location='" . site_url('admin') . "';</script>";
    }

    // view kirim data
    public function view($user)
    {
        $query = $this->admin_model->get_admin($user);
        if ($query->num_rows() > 0) {
            $data['row'] = $query->row();
            $this->template->load('template', 'admin/view_admin', $data);
        }
    }

    public function count_user_admin()
    {
        $count = $this->admin_model->count_admin();
        $result['count'] = $count;
        $result['msg'] = 'berhasil';
        echo json_encode($result);
    }

    public function upload()
    {
        // $config['upload_path']      = './uploads/foto/';
        $config['upload_path']      = './assets/dist/img/foto/';
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['max_size']         = 2048;
        $config['file_name']        = 'admin-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        if (@$_FILES['image']['name'] != null) {
            if ($this->upload->do_upload('image')) {
                $post['image'] = $this->upload->data('file_name');
                $userid = $this->input->post('user_id');

                $admin = $this->admin_model->get_admin($post['user_id'])->row();
                if ($admin->image != null) {
                    $target_file = './assets/dist/img/foto/' . $admin->image;
                    unlink($target_file);
                }

                $this->admin_model->upload_foto_admin($post, $userid);
                redirect('admin/view/' . $userid);
            } else {
                redirect('admin');
            }
        }
    }
}
