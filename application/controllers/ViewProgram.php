<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ViewProgram extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    public function index()
    {
        $db = $this->input->get("db");
        $thAndReturnUrlProcessor = $this->determineTableHeaderByDbAndReturnUrl($db);


        $data['title'] = $this->input->get("title");
        $data['th'] = $thAndReturnUrlProcessor["returnData"];
        $data['returnUrl'] = $thAndReturnUrlProcessor["returnUrl"];
        $data['tr'] = $this->getForTable($db);

        $this->load->view('components/includes/header');
        $this->load->view('components/dashboard/viewProgram', $data);
        $this->load->view('components/includes/footer');
    }

    private function displayCheckboxAccordingly($has)
    {
        return $has ? '<input type="checkbox" checked disabled>' : '<input type="checkbox" disabled>';
    }

    public function getForTable($db)
    {
        $tableData = $this->Main_model->get($db, "id");

        $counter = 0;

        $tableRow = "";

        if ($db == "family_planning") {
            foreach ($tableData->result() as $row) {
                $counter++;
                $patientName = $this->Main_model->getFullName("patient_record", "id", $row->patient_id);

                $tableRow .= '
                        <tr>
                            <td>' . $counter . '</td>
                            <td>' . $patientName . '</td>
                            <td>' . $row->date . '</td>
                            <td>' . $row->time . '</td>
                            <td>' . $row->contraceptive . '</td>
                        </tr>
                    ';
            }

            return $tableRow;
        }

        if ($db == "env_sanitation_rescident_record") {
            foreach ($tableData->result() as $row) {
                $counter++;
                $patientName = $this->Main_model->getFullName("patient_record", "id", $row->patient_id);

                $tableRow .= '
                        <tr>
                            <td>' . $counter . '</td>
                            <td>' . $patientName . '</td>
                            <td>' . $this->displayCheckboxAccordingly($row->no_compostPit) . '</td>
                            <td>' . $this->displayCheckboxAccordingly($row->no_garden) . '</td>
                            <td>' . $this->displayCheckboxAccordingly($row->no_cr) . '</td>
                            <td>' . $row->date . '</td>
                            <td>' . $row->time . '</td>
                        </tr>
                    ';
            }

            return $tableRow;
        }

        foreach ($tableData->result() as $row) {
            $counter++;
            $patientName = $this->Main_model->getFullName("patient_record", "id", $row->patient_id);

            $tableRow .= '
                    <tr>
                        <td>' . $counter . '</td>
                        <td>' . $patientName . '</td>
                        <td>' . $row->date . '</td>
                        <td>' . $row->time . '</td>
                    </tr>
                ';
        }

        return $tableRow;
    }

    public function determineTableHeaderByDbAndReturnUrl($db)
    {
        $thArray = [];
        $returnUrl = "";
        switch ($db) {
            case 'baby_immunization':
                array_push($thArray, "#");
                array_push($thArray, "Name");
                array_push($thArray, "Date");
                array_push($thArray, "Time");
                $returnUrl = "BabiesImmunization";
                break;

            case 'schedule_pregnant_immunization':
                array_push($thArray, "#");
                array_push($thArray, "Name");
                array_push($thArray, "Date");
                array_push($thArray, "Time");
                $returnUrl = "PregnantImmunization";
                break;

            case 'schedule_highblood_maintenance':
                array_push($thArray, "#");
                array_push($thArray, "Name");
                array_push($thArray, "Date");
                array_push($thArray, "Time");
                $returnUrl = "HighbloodMaintenance";
                break;

            case 'schedule_tuberculosis_maintenance':
                array_push($thArray, "#");
                array_push($thArray, "Name");
                array_push($thArray, "Date");
                array_push($thArray, "Time");
                $returnUrl = "TuberculosisMaintenance";
                break;

            case 'family_planning':
                array_push($thArray, "#");
                array_push($thArray, "Name");
                array_push($thArray, "Date");
                array_push($thArray, "Time");
                array_push($thArray, "Contraceptives");
                $returnUrl = "FamilyPlanning";
                break;

            case 'schedule_underweight_children':
                array_push($thArray, "#");
                array_push($thArray, "Name");
                array_push($thArray, "Date");
                array_push($thArray, "Time");
                $returnUrl = "UnderweightChildren";
                break;

            case 'env_sanitation_rescident_record':
                array_push($thArray, "#");
                array_push($thArray, "Name");
                array_push($thArray, "No Garden");
                array_push($thArray, "No Compost Pit");
                array_push($thArray, "No Cr");
                array_push($thArray, "Date");
                array_push($thArray, "Time");
                $returnUrl = "EnvironmentalSanitation";
                break;

            default:
                throw new Exception("Invalid table");
                break;
        }

        $returnData['returnUrl'] = $returnUrl;
        $returnData['returnData'] = $thArray;

        return $returnData;
    }
}
