<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Command_vital extends CI_Controller
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
        $insert['date'] = date("Y-m-d");
        $insert['time'] = date("h:i:s a");
        $insert['vital_measure'] = $this->input->post('vital_measure');
                
        $result = $this->Main_model->_insert('vital_signs_measure', $insert);
        return $result;
    }

    public function update()
    {
        $id = $this->input->post('id');

        $update['patient_id'] = $this->input->post('patient_id');
        $update['date'] = date("Y-m-d");
        $update['time'] = date("h:i:s a");
        $update['vital_measure'] = $this->input->post('vital_measure');

        $this->Main_model->_update("vital_signs_measure", "id", $id, $update);
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete("vital_signs_measure", "id", $id);
    }
}
