<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Command_scheduleUnderWeightChildren extends CI_Controller
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
        $insert['is_given_medicine'] = $this->input->post('is_given_medicine');
        
        $result = $this->Main_model->_insert('schedule_underweight_children', $insert);
        return $result;
    }

    public function update()
    {
        $id = $this->input->post('id');

        $update['patient_id'] = $this->input->post('patient_id');
        $update['date'] = $this->input->post('date');
        $update['time'] = $this->input->post('time');
        $update['is_given_medicine'] = $this->input->post('is_given_medicine');

        $this->Main_model->_update("schedule_underweight_children", "id", $id, $update);
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete("schedule_underweight_children", "id", $id);
    }
}
