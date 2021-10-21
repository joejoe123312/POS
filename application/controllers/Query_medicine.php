<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Query_medicine extends CI_Controller
{
    public $authKey;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    private $table = "medicine";

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

    public function getAllForTable()
    {
        $patientId = $this->input->get("id");

        $result = $this->Main_model->get_where("medicine", "patient_id", $patientId)->result();

        $counter = 0;
        foreach ($result as $row) {
            $counter ++;            
            echo '
                <tr>
                    <td>'. $counter .'</td>
                    <td>'. $row->given_medicine .'</td>
                    <td>' . $row->date . '</td>
                    <td>' . $row->time . '</td>
                    <td>
                        <button class="btn btn-primary btn-sm edit" value="'. $row->id .'">edit</button>
                        <button class="btn btn-danger btn-sm delete" value="'. $row->id .'">delete</button>
                    </td>
                </tr>
            ';
        }
    }
    
}
