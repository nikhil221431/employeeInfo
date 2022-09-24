<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/school
	 *	- or -
	 * 		http://example.com/index.php/school/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/school/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');

		$this->load->model('employee_model');

		$this->validateLogin();
    }

	public function index()
	{
		redirect("Employee/employeeinfo");
	}

	public function validateLogin(){

		$this->load->model('validate_model');
		$result = $this->validate_model->validate();
		
		if($result->output == "FALSE"){

			redirect("login");
		}
	}

	public function employeeinfo(){

		$name = "";

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$name = $this->input->post('empname');
		};

		$data['fname'] = $name;
		$data['employeeinfo'] = $this->employee_model->employeeinfo($name);

		$this->load->view('header');
		$this->load->view('employeeinfo', $data);
		$this->load->view('footer');
	}

	public function createemployee(){

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			//this is CI form validations
				$this->form_validation->set_rules('empName','Employee Name','trim|required|required|min_length[5]|max_length[100]|is_unique[employee.name]');
				$this->form_validation->set_rules('empAge','Employee Age','trim|required');
				$this->form_validation->set_rules('empEmail','Employee Email','trim|required|valid_email|is_unique[employee.email]');
				$this->form_validation->set_rules('empDob','Employee Date Of Birth','trim|required');
				$this->form_validation->set_rules('empAddress','Employee Address','trim|required');

			if($this->form_validation->run() == FALSE){

				$this->load->view('header');
				$this->load->view('createemployee');
				$this->load->view('footer');
			}
			else {

				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 2048;
				$config['max_width']            = 1024;
				$config['max_height']           = 768;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('empimg'))
				{
					$error = array('error' => $this->upload->display_errors());

					$this->load->view('header');
					$this->load->view('createemployee', $error);
					$this->load->view('footer');
				}
				else {

					$data = array('upload_data' => $this->upload->data());

					$name = $this->input->post('empName');
					$age = $this->input->post('empAge');
					$email = $this->input->post('empEmail');
					$dob = $this->input->post('empDob');
					$address = $this->input->post('empAddress');
					$photo = $data['upload_data']['file_name'];

					$result = $this->employee_model->createemployee($name, $age, $email, $dob, $address, $photo);

					if($result->output == "TRUE"){

						redirect("Employee");
					}
					else {

						$data['error'] = $result->message;
						$this->load->view('header');
						$this->load->view('createemployee', $data);
						$this->load->view('footer');
					}
				}
			}
		} 
		else {

			$this->load->view('header');
			$this->load->view('createemployee');
			$this->load->view('footer');
		}

	}

	public function editemployeeinfo(){

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			//this is CI form validations
				$this->form_validation->set_rules('empName','Employee Name','trim|required|required|min_length[5]|max_length[100]');
				$this->form_validation->set_rules('empAge','Employee Age','trim|required');
				$this->form_validation->set_rules('empEmail','Employee Email','trim|required|valid_email');
				$this->form_validation->set_rules('empDob','Employee Date Of Birth','trim|required');
				$this->form_validation->set_rules('empAddress','Employee Address','trim|required');

			$empId = $this->input->get_post("for");

			if($this->form_validation->run() == FALSE){

				$data['employeeinfo'] = $this->employee_model->editemployeeinfo($empId);
				$this->load->view('header');
				$this->load->view('editemployee', $data);
				$this->load->view('footer');
			}
			else {
				
				$name = $this->input->post('empName');
				$age = $this->input->post('empAge');
				$email = $this->input->post('empEmail');
				$dob = $this->input->post('empDob');
				$address = $this->input->post('empAddress');

				$result = $this->employee_model->editschoolsave($empId, $name, $age, $email, $dob, $address);
		
				if($result->output == "TRUE"){
		
					redirect('employee/employeeinfo');
				}
				else {
		
					$data['error'] = $result->message;
					$data['employeeinfo'] = $this->employee_model->editemployeeinfo($empId);
					$this->load->view('header');
					$this->load->view('editemployee', $data);
					$this->load->view('footer');
				}
			}
		}
		else {

			$empId = $this->input->get_post('for');
			$data['employeeinfo'] = $this->employee_model->editemployeeinfo($empId);
			$this->load->view('header');
			$this->load->view('editemployee', $data);
			$this->load->view('footer');
		}

	}

	public function deleteEmployee() {

		$empId  = $this->input->get_post("empId");
		$result  = $this->employee_model->deleteEmployee($empId);

		echo json_encode($result);
	}

	public function logoutuser(){

		$this->session->sess_destroy();
		redirect("login");
	}
}
