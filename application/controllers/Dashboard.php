<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
	}

	public function index()
	{
		$this->load->view('components/includes/header');
		$this->load->view('components/dashboard/admin_dashboard');
		$this->load->view('components/includes/footer');
	}

	public function getAllItems()
	{
		$items = $this->Main_model->get("items", 'id');

		$result = array();
		foreach ($items->result() as $row) {
			array_push($result, $row->name);
		}

		echo json_encode($result);
	}
}
