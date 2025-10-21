<?php
class Fungsi
{
    protected $ci;
    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('user_model');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->user_model->get($user_id)->row();
        return $user_data;
    }

    // mendapatkan data perusahaan dari user yang login
    function user_perusahaan()
    {
        $this->ci->load->model('perusahaan_model');
        $user_id = $this->ci->session->userdata('userid');
        $perusahaan = $this->ci->perusahaan_model->get($user_id)->row();
        return $perusahaan;
    }

    function user_pd()
    {
        $this->ci->load->model('pd_model');
        $user_id = $this->ci->session->userdata('userid');
        $pd = $this->ci->pd_model->get($user_id)->row();
        return $pd;
    }

    // function pd_detail()
    // {
    //     $this->ci->load->model('user_model');
    //     $user_id = $this->ci->session->userdata('userid');
    //     $user_data = $this->ci->user_model->get_pd($user_id)->row();
    //     return $user_data;
    // }
    // function ph_detail()
    // {
    //     $this->ci->load->model('user_model');
    //     $user_id = $this->ci->session->userdata('userid');
    //     $user_data = $this->ci->user_model->get_ph($user_id)->row();
    //     return $user_data;
    // }

    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}
