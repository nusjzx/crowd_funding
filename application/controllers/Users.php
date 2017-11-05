<?php
	class Users extends CI_Controller{
		// Register user
		public function register(){
			$data['title'] = 'Sign Up';
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_not_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_not_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			} else {
				// Encrypt password
				$enc_password = $this->input->post('password');
				$this->user_model->register($enc_password);
				// Set message
				$this->session->set_flashdata('user_registered', 'You are now registered and can log in');
				redirect(base_url());
			}
		}
		// Log in user
		public function login(){
			$data['title'] = 'Sign In';
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			} else {
				
				// Get username
				$username = $this->input->post('username');
				// Get and encrypt the password
				$password = $this->input->post('password');
				// Login user
				$result = $this->user_model->login($username, $password);

				if($result){
					// Create session
					$user_data = array(
						'email' => $result['email'],
						'username' => $result['username'],
						'isadmin' => $result['isadmin'],
						'logged_in' => true
					);
					$this->session->set_userdata($user_data);
					// Set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');
					redirect(base_url());
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Login is invalid');
					redirect('users/login');
				}		
			}
		}
		// Log user out
		public function logout(){
			// Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('isadmin');
			// Set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');
			redirect(base_url());
		}
		// Check if username exists
		public function check_username_not_exists($username){
			$this->form_validation->set_message('check_username_not_exists', 'That username is taken. Please choose a different one');
			return $this->user_model->check_username_not_exists($username);
		}
		// Check if email exists
		public function check_email_not_exists($email){
			$this->form_validation->set_message('check_email_not_exists', 'That email is taken. Please choose a different one');
			return $this->user_model->check_email_not_exists($email);
		}

		public function index($offset = 0){	
			// // Pagination Config	
			// $config['base_url'] = base_url() . 'posts/index/';
			// $config['total_rows'] = $this->db->count_all('posts');
			// $config['per_page'] = 3;
			// $config['uri_segment'] = 3;
			// $config['attributes'] = array('class' => 'pagination-link');

			// // Init Pagination
			// $this->pagination->initialize($config);

			if(is_admin()) {
				$data['title'] = 'Users';

				$data['users'] = $this->user_model->get_all_entries();

				$this->load->view('templates/header');
				$this->load->view('users/index', $data);
				$this->load->view('templates/footer');
			} else {
				redirect(base_url());
			}
		}

		public function edit($email){

			$data['user'] = $this->user_model->get_one_entry($email);

			$data['title'] = 'Edit Profile';

			$this->load->view('templates/header');
			$this->load->view('users/edit', $data);
			$this->load->view('templates/footer');
		}

		public function update(){

			$this->user_model->update();

			// Set message
			$this->session->set_flashdata('post_updated', 'Your post has been updated');

			redirect(base_url());
		}

		public function delete($id){
			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$this->post_model->delete_post($id);

			// Set message
			$this->session->set_flashdata('post_deleted', 'Your post has been deleted');

			redirect('posts');
		}
	}