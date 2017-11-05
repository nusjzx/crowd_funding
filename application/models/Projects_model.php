<?php 
class Projects_model extends CI_Model {
	public $id;
	public $title;
	public $description;
	public $start_date;
	public $duration;
	public $category;
	public $aim_amount;
	public $current_amount;
	public $fund_status;
	public $creator_email;

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_percentage() {
		$query = $this->db->query("SELECT current_amount, aim_amount FROM projects");
		$data = $query->result_array();
		for ($i = 0; $i < count($data); ++$i) {
			$result[$i] = round($data[$i]['current_amount']/$data[$i]['aim_amount'], 2);
		}
		return $result;
	}

	public function get_all_entries() {
		$query = $this->db->query("SELECT * FROM projects");
		return $query->result_array();
	}

	public function get_one_entry($id) {
		$query = $this->db->query("SELECT * FROM projects WHERE id = ".$id);
		return $query->row_array();
	}

	public function insert_entry() {
		$this->$title = $_POST['title'];
		$this->$description = $_POST['description'];
		$this->$start_date = $_POST['start_date'];
		$this->$duration = $_POST['duration'];
		$this->$category = $_POST['category'];
		$this->$aim_amount = $_POST['aim_amount'];
		$this->$current_amount = $_POST['current_amount'];
		$this->$fund_status = $_POST['fund_status'];
		$this->$creator_email = $_POST['creator_email'];
		$sql = "INSERT INTO projects (title, description, start_date, duration, category, aim_amount, current_amount, fund_status, creator_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$this->db->query($sql, array($title, $description, $start_date, $duration, $category, $aim_amount, $current_amount, $fund_status, $creator_email));
	}

	public function update_entry() {
		$this->$id = $_POST['id'];
		$this->$title = $_POST['title'];
		$this->$description = $_POST['description'];
		$this->$start_date = $_POST['start_date'];
		$this->$duration = $_POST['duration'];
		$this->$category = $_POST['category'];
		$this->$aim_amount = $_POST['aim_amount'];
		$this->$current_amount = $_POST['current_amount'];
		$this->$fund_status = $_POST['fund_status'];
		$this->$creator_email = $_POST['creator_email'];
		$this->db->update('projects', $this);
	}

	public function delete_entry() {
		$query = $this->db->query("DELETE FROM projects WHERE id = '".$_POST['id']."'");
		return $query->result();
	}
}
?>