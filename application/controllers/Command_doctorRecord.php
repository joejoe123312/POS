<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Command_doctorRecord extends CI_Controller
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
        $insert['contact_number'] = $this->input->post('contact_number');
        
        $result = $this->Main_model->_insert('doctor_record', $insert);
        return $result;
    }

    public function update()
    {
        $id = $this->input->post('id');

        $update['firstname'] = $this->input->post('firstname');
        $update['middlename'] = $this->input->post('middlename');	
        $update['lastname'] = $this->input->post('lastname');
        $update['contact_number'] = $this->input->post('contact_number');


        $this->Main_model->_update("doctor_record", "id", $id, $update);
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete("doctor_record", "id", $id);
    }
}
