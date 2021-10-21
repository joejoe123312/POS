<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Query_diagnoseToSeek extends CI_Controller
{
    public $authKey;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    private $table =  "diagnose_to_seek";

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

    public function getAllFortable()
    {
        $query = $this->Main_model->get($this->table, "id")->result();

        $counter = 0;
        foreach ($query as $data) {
            $counter++;
            
            $fullNameSlice = $this->Main_model->getFullNameSliced("patient_record", "id", $data->patient_id);
            echo '
                <tr>
                    <td>'. $counter .'</td>
                    <td>'. $fullNameSlice["firstname"] .'</td>
                    <td>'. $fullNameSlice["middlename"] .'</td>
                    <td>'. $fullNameSlice["lastname"] .'</td>
                    <td>'. $data->date .'</td>
                    <td>'. $data->time .'</td>
                    <td>
                        <button class="btn btn-primary btn-sm edit" value="'. $data->id .'">edit</button>
                        <button class="btn btn-danger btn-sm delete" value="'. $data->id .'">delete</button>
                    </td>
                </tr>
            ';
        }
    }
}
