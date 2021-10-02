<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Command_patient extends CI_Controller
{
    public $authKey;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    public function create()
    {
        $insert['firstname'] = $this->input->post("firstname");
		$insert['middlename'] = $this->input->post("middlename");	
		$insert['lastname'] = $this->input->post("lastname");
		$insert['age'] = $this->input->post("age");
		$insert['gender'] = $this->input->post("gender");
		$insert['height'] = $this->input->post("height");
		$insert['weight'] = $this->input->post("weight");
		$insert['civil_status'] = $this->input->post("civil_status");
        
        $result = $this->Main_model->_insert('patient_record', $insert);
        return $result;
    }

    public function update()
    {
        $id = $this->input->post('id');

        $update['firstname'] = $this->input->post("firstname");
		$update['middlename'] = $this->input->post("middlename");	
		$update['lastname'] = $this->input->post("lastname");
		$update['age'] = $this->input->post("age");
		$update['gender'] = $this->input->post("gender");
		$update['height'] = $this->input->post("height");
		$update['weight'] = $this->input->post("weight");
		$update['civilStatus'] = $this->input->post("civil_status"); 
		$update['concern'] = $this->input->post("concern");

        $this->Main_model->_update("patient_record", "id", $id, $update);
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete("patient_record", "id", $id);
    }

    
    public function testing()
    {
        // $this->load->view('components/includes/header');
        $this->load->view('components/dashboard/testing');
        $this->load->view('components/includes/footer');
    }
    
}
