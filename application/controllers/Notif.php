<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notif extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('notif_model');
    }

    public function count()
    {
        $level = $this->fungsi->user_login()->level;

        if ($level == 1) {
            echo $this->notif_model->notif_admin();
        } else if ($level == 2) {
            echo $this->notif_model->notif_perusahaan();
        } else if ($level == 3) {
            echo $this->notif_model->notif_pd();
        }
    }

    // halaman notif
    public function view($id = null)
    {
        $level = $this->fungsi->user_login()->level;

        if ($level == 3) {
            // PESERTA DIDIK
            $this->notif_model->update_read_pd();

            // cari pd_id dari user_id login
            $query = $this->notif_model->get_pd($id);

            // jika ditemukan ada isinya
            if ($query->num_rows() > 0) {
                // cari notif yang sesuai pd_id user yg login
                $notif = $this->notif_model->get_notif($query->row()->pd_id);
                $data = [
                    "pd" => $query->row(),
                    "notif" => $notif
                ];

                $this->template->load('template', 'notif/view_notif_pd', $data);
            } else {
                $this->template->load('template', 'notif/view_notif_blank');
            }
            // =================================================================
        } else if ($level == 2) {
            // PERUSAHAAN
            $this->notif_model->update_read_perusahaan();

            $query = $this->notif_model->get_notif_perusahaan($id);

            // jika ditemukan ada isinya
            if ($query->num_rows() > 0) {
                // cari notif yang sesuai pd_id user yg login
                // $notif = $this->notif_model->get_notif($query->row()->pd_id);
                $data = [
                    "notif" => $query
                ];

                $this->template->load('template', 'notif/view_notif_perusahaan', $data);
            } else {
                $this->template->load('template', 'notif/view_notif_blank');
            }
            // =================================================================
        } else if ($level == 1) {
            // ADMIN
            $this->notif_model->update_read();
            $notif = $this->notif_model->get_notif_admin();

            if ($notif->num_rows() > 0) {
                $data = [
                    "notif" => $notif
                ];
                $this->template->load('template', 'notif/view_notif_admin', $data);
            } else {
                $this->template->load('template', 'notif/view_notif_blank');
            }
        }
    }


    // hapus notif
    public function del_notif()
    {
        $level = $this->fungsi->user_login()->level;

        if ($level == 1) {
            $lokerid = $this->input->post('lokerid');
            $this->notif_model->del_notif_admin($lokerid);
            echo "<script>window.location='" . site_url('notif/view/' . $this->fungsi->user_login()->user_id) . "';</script>";
        } else if ($level == 2) {
            $notifid = $this->input->post('notifid');
            $this->notif_model->del_notif_perusahaan_by_id($notifid);
            echo "<script>window.location='" . site_url('notif/view/' . $this->fungsi->user_perusahaan()->perusahaan_id) . "';</script>";
        } else if ($level == 3) {
            $lokerid = $this->input->post('lokerid');
            $pdid = $this->input->post('pdid');

            $this->notif_model->del_notif($lokerid, $pdid);
            echo "<script>window.location='" . site_url('notif/view/' . $this->fungsi->user_login()->user_id) . "';</script>";
        }
    }


    public function views($id = null)
    {
        check_not_login();
        $this->load->model('notif_model');

        // cari pd_id dari user_id login
        $query = $this->notif_model->get_pd($id);

        // jika ditemukan ada isinya
        if ($query->num_rows() > 0) {
            // cari notif yang sesuai pd_id user yg login
            $notif = $this->notif_model->get_notif($query->row()->pd_id);
            $data = [
                "pd" => $query->row(),
                "notif" => $notif
            ];

            $this->template->load('template', 'notif/view_notif', $data);
        } else {
            $this->template->load('template', 'notif/view_notif_blank');
        }
    }
}
