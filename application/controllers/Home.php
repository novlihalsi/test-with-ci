<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
        $this->load->model('Company_model'); // Load model
    }

    public function index()
    {
        $data['title'] = 'Welcome';
        $data['companies'] = $this->Company_model->get_data();
        $this->load->view('home/index', $data);
    }

    public function fetch()
	{
		if ($this->input->is_ajax_request()) {
			$companies = $this->Company_model->get_data();
			$data = array('status' => 'success', 'data' => $companies);
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

    public function fetch_by_id()
	{
		if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
			$data = array('status' => 'success', 'data' => $this->Company_model->get_data_by_id($id));
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

    public function add()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('position', 'Position', 'required');
            $this->form_validation->set_rules('office', 'Office', 'required');
            if ($this->form_validation->run() == false) {
                $data = ['status' => 'error', 'message' => validation_errors()];
            } else {

                $newData = [
                    'name' => $this->input->post('name'),
                    'position' => $this->input->post('position'),
                    'office' => $this->input->post('office')
                ];

                $this->Company_model->create($newData);

                $data = ['status' => 'success'];
            }

            echo json_encode($data);
        } else {
            echo 'No direct script access allowed';
        }
    }

    public function edit()
    {
        $id = $this->input->post('id');

        $newData = [
            'name' => $this->input->post('name'),
            'position' => $this->input->post('position'),
            'office' => $this->input->post('office')
        ];

        $updated = $this->Company_model->update($id, $newData);

        if ($updated) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');

        $deleted = $this->Company_model->delete($id);

        if ($deleted) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
}