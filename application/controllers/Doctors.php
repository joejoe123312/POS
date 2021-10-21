<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctors extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    public function index()
    {        
        $this->load->view('components/includes/header');
        $this->load->view('doctors/index');
        $this->load->view('components/includes/footer');
    }
}
