<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PregnantImmunization extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    private $table = "schedule_pregnant_immunization";
    private $controllerName = "PregnantImmunization";
    private $title = "IMMUNIZATION OF PREGNANTS";

    public function index()
    {
        $data['controllerName'] = $this->controllerName;
        $data['title'] = $this->title;
        $this->load->view('components/includes/header');
        $this->load->view('pregnantImmunization', $data);
        $this->load->view('components/includes/footer');
    }

    public function getByFullName()
    {
        $fullname = $this->input->post("fullname");
        $patientId = $this->Main_model->get_where("patient_record", "fullname", $fullname)->row()->id;

        $result = $this->Main_model->get_where($this->table, "patient_id", $patientId);

        $counter = 0;
        foreach ($result->result() as $row) {
            $counter++;
            echo '
                <tr>
                    <td>' . $counter . '</td>
                    <td>' . $row->date . '</td>
                    <td>' . $row->time . '</td>
                    <td>
                        <button class="btn btn-danger btn-sm delete" value="' . $row->id . '">delete</button>
                    </td>
                </tr>
            ';
        }
    }

    public function create()
    {
        $id = $this->input->post('id');
        $insert['patient_id'] = $id;
        $insert['date'] = date("Y-m-d");
        $insert['time'] = date("h:i:s a");

        $this->Main_model->_insert($this->table, $insert);
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete($this->table, "id", $id);
    }
}
