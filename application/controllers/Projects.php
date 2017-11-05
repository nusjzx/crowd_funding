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
		$data['percentage'] = $this->projects_model->get_percentage();;

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

	public function new() {
		$this->load->view('projects/new');
	}
}

?>