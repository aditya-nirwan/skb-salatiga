<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loker extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();

        $this->load->model(['loker_model', 'pd_model', 'notif_model']);
        $this->load->library('form_validation');
    }

    // tampil halaman lowongan kerja
    public function index()
    {
        // $data['row'] = $this->loker_model->get_loker();
        // $this->template->load('template', 'loker/data_loker', $data);

        $this->load->library('pagination');

        $config['base_url'] = site_url('/loker');
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->loker_model->get_loker_count();
        $config['per_page'] = 9;

        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['previous_link'] = '&gt;';
        $config['previous_tag_open'] = '<li class="page-item">';
        $config['previous_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"> <a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        $limit = $config['per_page'];
        $offset = html_escape($this->input->get('per_page'));

        $data['loker'] = $this->loker_model->get_data_loker($limit, $offset);

        if (count($data['loker']) > 0) {
            $this->template->load('template', 'loker/data_loker', $data);
        } else {
            $this->template->load('template', 'loker/data_loker_empty');
        }
    }

    // form loker 
    public function add()
    {
        check_perusahaan(); // hanya bisa dibuka user perusahaan

        $this->form_validation->set_rules('posisi', 'Posisi', 'required');
        $this->form_validation->set_rules('tipe', 'Tipe kontrak', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis industri', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi pekerjaan', 'required');
        $this->form_validation->set_rules('syarat', 'Syarat', 'required');
        $this->form_validation->set_rules('deadline', 'Deadline', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, mohon diisi');
        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'loker/add_loker');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->loker_model->add($post);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data Berhasil disimpan'); </script>";
            }
            echo "<script> window.location='" . site_url('perusahaan/profile/' . $this->fungsi->user_perusahaan()->perusahaan_id) . "' </script>";
        }
    }

    // edit loker
    public function edit($id)
    {
        check_perusahaan(); // hanya bisa dibuka user perusahaan

        $this->form_validation->set_rules('posisi', 'Posisi', 'required');
        $this->form_validation->set_rules('tipe', 'Tipe kontrak', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis industri', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi pekerjaan', 'required');
        $this->form_validation->set_rules('syarat', 'Syarat', 'required');
        $this->form_validation->set_rules('deadline', 'Deadline', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, mohon diisi');
        $this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');


        if ($this->form_validation->run() == FALSE) {
            $query = $this->loker_model->get_loker($id);
            if ($query->num_rows() > 0) {
                if ($this->fungsi->user_perusahaan()->perusahaan_id == $query->row()->perusahaan_id) {
                    $data['row'] = $query->row();
                    $this->template->load('template', 'loker/edit_loker', $data);
                } else {
                    redirect('loker');
                }
            } else {
                echo "<script> alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('loker') . "' </script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->loker_model->edit($post);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data berhasil disimpan'); </script>";
            }
            echo "<script> window.location='" . site_url('perusahaan/profile/' . $this->fungsi->user_perusahaan()->perusahaan_id) . "' </script>";
            // echo "<script> window.location='" . site_url('loker') . "' </script>";
        }
    }

    // hapus loker
    public function del()
    {
        $id = $this->input->post('loker_id');
        $this->loker_model->del($id);

        // del notif admin
        $this->notif_model->del_notif_admin($id);

        if ($this->db->affected_rows() > 0) {
            echo "<script> alert('Data berhasil dihapus'); </script>";
        }
        echo "<script> window.location='" . site_url('perusahaan/profile/' . $this->fungsi->user_perusahaan()->perusahaan_id) . "' </script>";
    }



    // detail loker
    public function detail($loker_id)
    {
        $query = $this->loker_model->get_loker($loker_id);
        if ($query->num_rows() > 0) {
            $data = [
                'row' => $query->row(),
                'pesertadidik' => $this->pd_model->get_pd_pengajuan($loker_id)->result(), // daftar semua pd
                'pengajuan' => $this->loker_model->get_pengajuan($loker_id)->result() // pd yg sudah diajukan
            ];

            $this->template->load('template', 'loker/detail_loker', $data);
        }
    }
    // pengajuan pd pada loker
    public function pengajuan_pd($lokerid)
    {
        $post = $this->input->post(null, TRUE);
        $this->loker_model->pengajuan_pd($post);

        // if ($this->db->affected_rows() > 0) {
        //     echo "<script> alert('Peserta Didik Telah Diajukan'); </script>";
        // }
        echo "<script> window.location='" . site_url('loker/detail/' . $lokerid) . "' </script>";
    }
    // hapus pengajuan oleh admin
    public function del_pengajuan($lokerid)
    {
        $pengajuan_id = $this->input->post('pengajuan_id');
        $pd_id = $this->input->post('pd_id');
        $this->loker_model->del_pengajuan($pengajuan_id, $pd_id);

        // hapus notif
        $this->notif_model->del_notif($lokerid, $pd_id);

        $query = $this->db->query("select perusahaan_id from tb_loker where loker_id = '$lokerid'");
        $perusahaan_id = $query->row()->perusahaan_id;
        $this->notif_model->del_notif_perusahaan($lokerid, $pd_id, $perusahaan_id);

        echo "<script>window.location='" . site_url('loker/detail/' . $lokerid) . "';</script>";
    }


    public function terima_pengajuan($lokerid)
    {
        $post = $this->input->post(null, TRUE);
        $this->loker_model->terima_pengajuan($post);

        echo "<script> window.location='" . site_url('loker/detail/' . $lokerid) . "' </script>";
    }

    public function batal_pengajuan($lokerid)
    {
        $post = $this->input->post(null, TRUE);
        $this->loker_model->batal_pengajuan($post);

        echo "<script> window.location='" . site_url('loker/detail/' . $lokerid) . "' </script>";
    }
}
