<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact_page extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    public function index()
    {
        $this->load->view('components/includes/header');
        $this->load->view('components/contact_page');
        $this->load->view('components/includes/footer');
    }
}
