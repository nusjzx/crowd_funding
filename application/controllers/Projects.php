<?php 
class Projects extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('projects_model');
		$this->load->helper('url_helper');
		$this->load->library('form_validation');
	}

	public function index() {
		$data['title'] = 'All Fundraising Projects';
		$data['details'] = $this->projects_model->get_all_entries();
		//show_error($data['details'][7]);
		$this->load->view('templates/header', $data);
		$this->load->view('projects/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function view($id = NULL) {
		$data['title'] = 'Detail Page';
		$data['item_details'] = $this->projects_model->get_one_entry($id);

		if (empty($data['item_details']))
		{
			show_404();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('projects/view', $data);
		$this->load->view('templates/footer', $data);
	}

	public function create(){
			// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('duration', 'Duration', 'required');
		$this->form_validation->set_rules('duration', 'Duration', 'callback_positive_check');
		$this->form_validation->set_rules('aim_amount', 'Aim Amount', 'required');
		$this->form_validation->set_rules('aim_amount', 'Aim Amount', 'callback_positive_check');

		if($this->form_validation->run() === FALSE){
			$data['title'] = 'Start A Project';
			$data['start_date'] = date('Y/m/d h:i:s', time());
			$data['creator_email'] = current_user_email();

			$this->load->view('templates/header', $data);
			$this->load->view('projects/new', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$insert_data = $this->input->post();
			//show_error($insert_data);
			$this->projects_model->insert_entry($insert_data);
			$data['title'] = "created";
			$this->load->view('templates/header');
			$this->load->view('projects/formsuccess', $data);
			$this->load->view('templates/footer');
		}
	}

	public function edit($id) {
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('duration', 'Duration', 'required');
		$this->form_validation->set_rules('duration', 'Duration', 'callback_positive_check');
		$this->form_validation->set_rules('aim_amount', 'Aim Amount', 'required');
		$this->form_validation->set_rules('aim_amount', 'Aim Amount', 'callback_positive_check');

		if($this->form_validation->run() === FALSE){
			$data['old'] = $this->projects_model->get_one_entry($id);

			$this->load->view('templates/header');
			$this->load->view('projects/update', $data);
			$this->load->view('templates/footer');
		} else {
			$update_data = $this->input->post();
			//show_error($update_data);
			$this->projects_model->update_entry($update_data);
			$data['title'] = "updated";
			$this->load->view('templates/header');
			$this->load->view('projects/formsuccess', $data);
			$this->load->view('templates/footer');
		}
	}

	public function delete($id) {
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$data['title'] = "deleted";
		$this->projects_model->delete_entry($id);
		$this->load->view('templates/header');
		$this->load->view('projects/formsuccess', $data);
		$this->load->view('templates/footer');
	}

	public function search() {
		$keyword = $this->input->post();
		$data['title'] = 'Results result of '.$keyword['search'];
		$data['details'] = $this->projects_model->search_entry($keyword['search']);
		$this->load->view('templates/header', $data);
		$this->load->view('projects/search', $data);
		$this->load->view('templates/footer', $data);
	}

	public function positive_check($num) {
		if ($num <= 0) {
			$this->form_validation->set_message('positive_check', 'The {field} field cannot be less than 0');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

?>