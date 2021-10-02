<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Command_envSanitationRescidentRecord extends CI_Controller
{
    public $authKey;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    public function create()
    {	
        $insert['firstname'] = $this->input->post('firstname');
        $insert['middlename'] = $this->input->post('middlename');
        $insert['lastname'] = $this->input->post('lastname');
        $insert['age'] = $this->input->post('age');
        $insert['purok'] = $this->input->post('purok');
        $insert['has_conpospit'] = $this->input->post('has_conpospit');
        $insert['has_garden'] = $this->input->post('has_garden');
        $insert['has_cr'] = $this->input->post('has_cr');
        
        $result = $this->Main_model->_insert('env_sanitation_rescident_record', $insert);
        return $result;
    }

    public function update()
    {
        $id = $this->input->post('id');

        $update['firstname'] = $this->input->post('firstname');
        $update['middlename'] = $this->input->post('middlename');
        $update['lastname'] = $this->input->post('lastname');
        $update['age'] = $this->input->post('age');
        $update['purok'] = $this->input->post('purok');
        $update['has_conpospit'] = $this->input->post('has_conpospit');
        $update['has_garden'] = $this->input->post('has_garden');
        $update['has_cr'] = $this->input->post('has_cr');


        $this->Main_model->_update("env_sanitation_rescident_record", "id", $id, $update);
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete("env_sanitation_rescident_record", "id", $id);
    }
}
