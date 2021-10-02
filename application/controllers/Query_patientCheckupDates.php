<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Query_patientCheckupDates extends CI_Controller
{
    public $authKey;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        $table = "patient_checkup_dates";
    }

    public function getAll()
    {
        return $this->Main_model->get($this->table, 'id');
    }

    public function getById()
    {
        $id = $this->input->post("id");
        return $this->Main_model->get_where($this->table, "id", $id);
    }

    public function multipleWhere()
    {
        // will accept where json object 
        $jsonWhere = json_decode($this->input->post("whereString"));
        return $this->Main_model->multiple_where($this->table, $jsonWhere);
    }
}
