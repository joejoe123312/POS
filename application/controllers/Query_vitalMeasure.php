<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Query_vitalMeasure extends CI_Controller
{
    public $authKey;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    private $table = "vital_signs_measure";
    
    public function getAll()
    {
        echo json_encode($this->Main_model->get($this->table, 'id')->result_array());
    }

    public function getById()
    {
        $id = $this->input->post("id");
        echo json_encode($this->Main_model->get_where($this->table, "id", $id)->result_array());
    }

    public function multipleWhere()
    {
        // will accept where json object 
        $jsonWhere = json_decode($this->input->post("whereString"));
        echo json_encode($this->Main_model->multiple_where($this->table, $jsonWhere)->result_array());
    }

    public function getForTable()
    {
        $_POST['patient_id'] = 42;
        $patientId = $this->input->post('patient_id');
        $result = $this->Main_model->get_where($this->table, "patient_id", $patientId);

        $counter = 0;
        foreach ($result->result() as $row) {
            $counter ++;
            echo '
            <tr>
                <td>'. $counter .'</td>
                <td>'. $row->date .'</td>
                <td>'. $row->time .'</td>
                <td>' . $row->vital_measure . '</td>
                <td>
                    <button class="btn btn-secondary btn-sm vitalEdit" value="'. $row->id .'">Edit</button>
                    <button class="btn btn-danger btn-sm vitalDelete" value="'. $row->id .'">Delete</button>
                </td>
            </tr>
            ';
        }
    }
}
