<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Command_medicine extends CI_Controller
{
    public $authKey;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    public function create()
    {
        $insert['patient_id'] = $this->input->post('patient_id');
        $insert['given_medicine'] = $this->input->post('given_medicine');
        $insert['Date'] = date("Y-m-d");	
        $insert['time'] = date("h:i:s a");
        
        $result = $this->Main_model->_insert('medicine', $insert);
        return $result;
    }

    public function update()
    {
        $id = $this->input->post('id');

        $update['patient_id'] = $this->input->post('patient_id');
        $update['given_medicine'] = $this->input->post('given_medicine');
        $update['Date'] = date("Y-m-d");	
        $insert['time'] = date("h:i:s a");

        $this->Main_model->_update("medicine", "id", $id, $update);
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete("medicine", "id", $id);
    }

    
    public function testing()
    {
        // $this->load->view('components/includes/header');
        $this->load->view('components/dashboard/testing');
        $this->load->view('components/includes/footer');
    }
    
}
