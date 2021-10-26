<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Query_patientRecord extends CI_Controller
{
    public $authKey;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    private $table = "patient_record";

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
        // $_POST['whereString'] = ' [{
        //     "fullname": Joel John Centeno
        // }]';
        // will accept where json object 
        $jsonWhere = json_decode($this->input->post("whereString"), true);

        echo json_encode($this->Main_model->multiple_where($this->table, $jsonWhere[0])->result_array());
    }

    public function getPatientFullNames()
    {
        $result = $this->Main_model->get("patient_record", "id")->result_array();

        $nameHolder = [];
        foreach ($result as $data) {
            array_push($nameHolder, $data["fullname"]);
        }

        echo json_encode($nameHolder);
    }

    public function getAllPatientsForTable()
    {
        $query = $this->Main_model->get($this->table, "id")->result();

        $counter = 0;
        foreach ($query as $data) {
            $counter++;
            echo '
                <tr>
                    <td>' . $counter . '</td>
                    <td>' . $data->firstname . '</td>
                    <td>' . $data->middlename . '</td>
                    <td>' . $data->lastname . '</td>
                    <td>' . $data->age . '</td>
                    <td>' . $data->gender . '</td>
                    <td>' . $data->height . '</td>
                    <td>' . $data->weight . '</td>
                    <td>' . $data->civil_status . '</td>
                    <td>
                        <button class="btn btn-primary btn-sm edit" value="' . $data->id . '">edit</button>
                        <button class="btn btn-danger btn-sm delete" value="' . $data->id . '">delete</button>
                    </td>
                </tr>
            ';
        }
    }
}
