<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Medicine extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    public function index()
    {
        $data['patientId'] = $this->input->get("id");
        $data['fullname'] = $this->Main_model->getFullName("patient_record", "id", $data['patientId']);
        
        $this->load->view('components/includes/header');
        $this->load->view('medicine/index', $data);
        $this->load->view('components/includes/footer');
    }
}
