<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Command_users extends CI_Controller
{
    public $authKey;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    public function create()
    {	
        $insert['fullname'] = $this->input->post('fullname');
        $insert['email'] = $this->input->post('email');
        $insert['mobile_number'] = $this->input->post('mobile_number');
        $insert['address'] = $this->input->post('address');
        $insert['credentials_id'] = $this->input->post('credentials_id');
                
        $result = $this->Main_model->_insert('users', $insert);
        return $result;
    }

    public function update()
    {
        $id = $this->input->post('id');

        $update['patient_id'] = $this->input->post('patient_id');
        $update['date'] = $this->input->post('date');
        $update['time'] = $this->input->post('time');
        $update['complain'] = $this->input->post('complain');

        $this->Main_model->_update("users", "id", $id, $update);
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete("users", "id", $id);
    }
}
