<?php
echo '<h3>Project Title: '.$item_details['title'].'</h3>';
echo '<h5>Start Date: '.$item_details['start_date'].'</h5>';
echo '<h5>Duration (days): '.$item_details['duration'].'</h5>';
echo '<h5>Category: '.$item_details['category'].'</h5>';
echo '<h4>Project Description: <br>'.$item_details['description'].'</h4>';
echo '<h3>Aim: $'.$item_details['aim_amount'].'</h3>';
echo '<h3>Currently raised: $'.$item_details['current_amount'].'</h3>';
echo '<h5>Contact the initiator: '.$item_details['creator_email'].'</h5>';

$path = base_url();
echo anchor($path, 'Back');

if(current_user_email() == $item_details['creator_email']) {
	echo anchor('projects/edit/'.$item_details['id'], 'Edit Project');
}
?>