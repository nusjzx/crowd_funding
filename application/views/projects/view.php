<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="form-group">
		<?php echo '<h3>Project Title: '.$item_details['title'].'</h3>'; ?>
	</div>
	<div class="form-group">
		<?php echo '<h5>Start Date: '.$item_details['start_date'].'</h5>'; ?>
	</div>
	<div class="form-group">
		<?php echo '<h5>Duration (days): '.$item_details['duration'].'</h5>'; ?>
	</div>
	<div class="form-group">
		<?php echo '<h5>Category: '.$item_details['category'].'</h5>'; ?>
	</div>
	<div class="form-group">
		<?php echo '<h4>Project Description: <br>'.$item_details['description'].'</h4>'; ?>
	</div>
	<div class="form-group">
		<?php echo '<h3>Aim: $'.$item_details['aim_amount'].'</h3>'; ?>
	</div>
	<div class="form-group">
		<?php echo '<h3>Currently raised: $'.$item_details['current_amount'].'</h3>'; ?>
	</div>
	<div class="form-group">
		<?php echo '<h5>Contact the initiator: '.$item_details['creator_email'].'</h5>'; ?>
	</div>

	<label><?php if(current_user_email() == $item_details['creator_email']) {
		echo anchor('projects/edit/'.$item_details['id'], 'Edit Project');
	} ?></label><br>
	<label><?php echo anchor(base_url(), 'Back'); ?></label>

</body>
</html>
