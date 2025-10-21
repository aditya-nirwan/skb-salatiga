<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		check_not_login();

		$this->load->model(['admin_model', 'loker_model']);
		// $this->load->model('perusahaan_model');
		// $this->load->model('pd_model');
		// $this->load->model('loker_model');

		$data = [
			"admin_count" => $this->admin_model->count_admin(),
			"perusahaan_count" => $this->admin_model->count_perusahaan(),
			"pesertadidik_count" => $this->admin_model->count_pesertadidik(),
			"loker_count" => $this->loker_model->count_loker(),
			"loker" => $this->loker_model->get_loker_dashboard(),
			"pengajuan" => $this->loker_model->get_data_pengajuan()
		];

		// $this->template->load('template', 'dashboard', $data);
		$this->template->load('template', 'dashboard', $data);
	}
}
