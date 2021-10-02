<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Command_symptomsComplains extends CI_Controller
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
        $insert['date'] = $this->input->post('date');
        $insert['time'] = $this->input->post('time');
        $insert['complain'] = $this->input->post('complain');
                
        $result = $this->Main_model->_insert('symptoms_complains', $insert);
        return $result;
    }

    public function update()
    {
        $id = $this->input->post('id');

        $update['patient_id'] = $this->input->post('patient_id');
        $update['date'] = $this->input->post('date');
        $update['time'] = $this->input->post('time');
        $update['complain'] = $this->input->post('complain');

        $this->Main_model->_update("symptoms_complains", "id", $id, $update);
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete("symptoms_complains", "id", $id);
    }
}
