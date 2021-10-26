<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EnvironmentalSanitation extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    private $table = "env_sanitation_rescident_record";
    private $controllerName = "EnvironmentalSanitation";
    private $title = "ENVIRONMENTAL SANITATION";

    public function index()
    {
        $data['controllerName'] = $this->controllerName;
        $data['title'] = $this->title;
        $this->load->view('components/includes/header');
        $this->load->view('environmentalSanitation', $data);
        $this->load->view('components/includes/footer');
    }

    private function displayCheckboxAccordingly($has)
    {
        return $has ? '<input type="checkbox" checked disabled>' : '<input type="checkbox" disabled>';
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
                    <td>' . $this->displayCheckboxAccordingly($row->no_garden) . '</td>
                    <td>' . $this->displayCheckboxAccordingly($row->no_compostPit) . '</td>
                    <td>' . $this->displayCheckboxAccordingly($row->no_cr) . '</td>
                    <td>' . $row->date . '</td>
                    <td>' . $row->time . '</td>
                    <td>
                        <button class="btn btn-info btn-sm update" value="' . $row->id . '">update</button>
                        <button class="btn btn-danger btn-sm delete" value="' . $row->id . '">delete</button>
                    </td>
                </tr>
            ';
        }
    }

    public function create()
    {
        $insert['patient_id'] = $this->input->post("patient_id");
        $insert['no_compostPit'] = $this->input->post("no_compostPit");
        $insert['no_cr'] = $this->input->post("no_cr");
        $insert['no_garden'] = $this->input->post("no_garden");
        $insert['date'] = date("Y-m-d");
        $insert['time'] = date("h:i:s a");

        $this->Main_model->_insert($this->table, $insert);
    }

    public function update()
    {
        $id = $this->input->post("id");


        $update['no_compostPit'] = $this->input->post("no_compostPit");
        $update['no_cr'] = $this->input->post("no_cr");
        $update['no_garden'] = $this->input->post("no_garden");
        $update['date'] = date("Y-m-d");
        $update['time'] = date("h:i:s a");

        $this->Main_model->_update($this->table, "id", $id, $update);
    }

    public function getById()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Main_model->get_where($this->table, "id", $id)->result_array());
    }

    public function delete()
    {
        $id = $this->input->post("id");

        $this->Main_model->_delete($this->table, "id", $id);
    }
}
