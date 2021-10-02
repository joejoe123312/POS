<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Command_diagnoseToSeek extends CI_Controller
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
        $insert['Date'] = $this->input->post('date');	
        $insert['time'] = $this->input->post('time');
        
        $result = $this->Main_model->_insert('diagnose_to_seek', $insert);
        return $result;
    }

    public function update()
    {
        $id = $this->input->post('id');

        $update['patient_id'] = $this->input->post('patient_id');
        $update['Date'] = $this->input->post('date');	
        $update['time'] = $this->input->post('time');

        $this->Main_model->_update("diagnose_to_seek", "id", $id, $update);
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete("diagnose_to_seek", "id", $id);
    }
}
