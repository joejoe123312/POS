<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
	}

	public function index()
	{
		$this->load->view('components/includes/header');
		$this->load->view('product');
		$this->load->view('components/includes/footer');
	}

	public function add()
	{
		$insert['name'] = $this->input->post("name");
		$insert['srp'] = $this->input->post("srp");
		$insert['markup'] = $this->input->post("markup");
		$insert['date'] = Date("Y-m-d");
		$insert['quantity'] = $this->input->post("quantity");

		$this->Main_model->_insert('items', $insert);
	}

	public function refresh()
	{
		$result = $this->Main_model->get("items", "id");

		$counter = 0;
		foreach ($result->result() as $row) {
			$counter++;

			echo '
				<tr>
					<td>' .  $counter . '</td>
					<td>' . $row->name . '</td>
					<td>' . $row->srp . '</td>
					<td>' . $row->markup . '</td>
					<td> &#8369 ' . ($row->srp + $row->markup) . '</td>
					<td>' . $row->quantity . '</td>
					<td>
						<button class="btn btn-primary btn-sm edit" value="' . $row->id . '">Edit</button>
						<button class="btn btn-danger btn-sm delete" value="' . $row->id . '">Delete</button>
					</td>
				</tr>
			';
		}
	}

	public function getProdById()
	{
		$id = $this->input->post("id");

		echo json_encode($this->Main_model->get_where("items", "id", $id)->result_array());
	}

	public function edit()
	{
		$id = $this->input->post("id");

		$update['name'] = $this->input->post("name");
		$update['srp'] = $this->input->post("srp");
		$update['markup'] = $this->input->post("markup");
		$update['quantity'] = $this->input->post("quantity");

		$this->Main_model->_update("items", "id", $id, $update);
	}

	public function delete()
	{
		$id = $this->input->post("id");

		$this->Main_model->_delete("items", "id", $id);
	}
}
