<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Command_doctorTimeIn extends CI_Controller
{
    public $authKey;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    public function create()
    {	
        $insert['doctor_id'] = $this->input->post('doctor_id');
        $insert['date'] = $this->input->post('date');
        $insert['time'] = $this->input->post('time');
        
        $result = $this->Main_model->_insert('doctor_time_in', $insert);
        return $result;
    }

    public function update()
    {
        $id = $this->input->post('id');

        $update['doctor_id'] = $this->input->post('doctor_id');
        $update['date'] = $this->input->post('date');
        $update['time'] = $this->input->post('time');


        $this->Main_model->_update("doctor_time_in", "id", $id, $update);
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete("doctor_time_in", "id", $id);
    }
}
