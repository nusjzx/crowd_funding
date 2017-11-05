<?php
	function current_user_email() {
		$ci=& get_instance();
        
		return $ci->session->userdata('email');
	}

	function is_admin() {
		$ci=& get_instance();

		return $ci->session->userdata('isadmin');
	}
?>