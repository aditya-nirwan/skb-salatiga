<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();

        $this->load->model(['loker_model', 'admin_model']);
    }

    // public function profil($user)
    // {
    //     // $this->load->model('ph_model');


    //     $data['row'] = $this->loker_model->get_loker_by_user($user);
    //     $this->template->load('template', 'menu/profil', $data);
    // }

    public function about()
    {
        $this->template->load('template', 'menu/about');
    }

    public function kebijakan()
    {
        $this->template->load('template', 'menu/kebijakan');
    }

    public function kontak()
    {
        $data['row'] = $this->admin_model->get_admin();
        $this->template->load('template', 'menu/kontak', $data);
    }

    public function faq()
    {
        $this->template->load('template', 'menu/faq');
    }
}
