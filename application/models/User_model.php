<?php
	class User_model extends CI_Model{
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function register($enc_password){
			// User data array
			$data = array( $this->input->post('email'), $this->input->post('username'), false, $enc_password);

			// Insert user
			$this->db->query('INSERT INTO users VALUES (?, ?, ?, ?)', $data);
		}

		// Log user in
		public function login($username, $password){
			// Validate

			$insert_values = array($username, $password);

			$result = $this->db->query("SELECT email FROM users WHERE username = ? AND password = ?", $insert_values)->row_array();

			if($result['email']){
				return $result['email'];
			} else {
				return false;
			}
		}

		// Check username exists
		public function check_username_not_exists($username){

			$query = $this->db->query("SELECT * FROM users WHERE username = ?", array($username))->result();

			if(!$query){
				return true;
			} else {
				return false;
			}
		}

		// Check email exists
		public function check_email_not_exists($email){
			$query = $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->result();

			if(!$query) {
				return true;
			} else {
				return false;
			}
		}

		public function is_admin($email) {
			$query = $this->db->query("SELECT isadmin FROM users WHERE email = ?", array($email))->row_array();
		}
	}