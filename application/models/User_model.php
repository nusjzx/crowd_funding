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
			$result = $this->db->query("SELECT email, isadmin FROM users WHERE username = ? AND password = ?", $insert_values)->row_array();
			if($result){
				return $result;
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

		public function get(){
			$query = $this->db->query("SELECT * FROM users");
			return $query->result_array();
		}

		public function create($post_image){
			$slug = url_title($this->input->post('title'));
			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'body' => $this->input->post('body'),
				'category_id' => $this->input->post('category_id'),
				'user_id' => $this->session->userdata('user_id'),
				'post_image' => $post_image
			);
			return $this->db->insert('posts', $data);
		}

		public function delete_post($id){
			$image_file_name = $this->db->select('post_image')->get_where('posts', array('id' => $id))->row()->post_image;
			$cwd = getcwd(); // save the current working directory
			$image_file_path = $cwd."\\assets\\images\\posts\\";
			chdir($image_file_path);
			unlink($image_file_name);
			chdir($cwd); // Restore the previous working directory
			$this->db->where('id', $id);
			$this->db->delete('posts');
			return true;
		}

		public function update_post(){
			$slug = url_title($this->input->post('title'));
			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'body' => $this->input->post('body'),
				'category_id' => $this->input->post('category_id')
			);
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('posts', $data);
		}

		public function get_categories(){
			$this->db->order_by('name');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function get_posts_by_category($category_id){
			$this->db->order_by('posts.id', 'DESC');
			$this->db->join('categories', 'categories.id = posts.category_id');
				$query = $this->db->get_where('posts', array('category_id' => $category_id));
			return $query->result_array();
		}

	
	}