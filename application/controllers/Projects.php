<?php 
class Projects extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('projects_model');
		$this->load->helper('url_helper');
	}

	public function index() {
		$data['title'] = 'All Fundraising Campaigns';
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

		$this->load->view('templates/subheader', $data);
		$this->load->view('projects/view', $data);
		$this->load->view('templates/footer', $data);
	}

	public function create(){
			// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$data['title'] = 'Start A Campaign';

		$data['categories'] = $this->post_model->get_categories();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('duration', 'Duration', 'required');
		$this->form_validation->set_rules('duration', 'Duration', 'callback_positive_check');
		$this->form_validation->set_rules('aim_amount', 'Aim Amount', 'required');
		$this->form_validation->set_rules('aim_amount', 'Aim Amount', 'callback_positive_check');

		if($this->form_validation->run() === FALSE){
			$this->load->view('myform');
		} else {
			// Set message
			$this->load->view('formsuccess');
			redirect('posts');
		}
	}

	public function positive_check($num) {
		if ($num <= 0) {
			$this->form_validation->set_message('positive_check', 'The {field} field cannot be less than 0');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function new() {
		$this->load->view('projects/new');
	}
}

?>