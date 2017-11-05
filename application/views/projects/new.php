<html>
<head>
	<title>Start A New Project</title>
</head>
<body>

	<?php echo validation_errors(); ?>

	<?php echo form_open('projects/create'); ?>

	<div class="form-group">
		<h5>Title</h5>
		<input type="text" name="title" value="" size="50" />
	</div>

	<div class="form-group">
		<h5>Description</h5>
		<textarea class="form-control" name="description" placeholder="Enter description here..."></textarea>
	</div>

	<input type="hidden" name="start_date" value="<?php echo $start_date; ?>" />

	<div class="form-group">
		<h5>Duartion (Days)</h5>
		<input type="number" name="duration" value="" size="50" />
	</div>

	<div class="form-group">
		<h5>Category</h5>
		<input type="text" name="category" value="" size="50" />
	</div>

	<div class="form-group">
		<h5>Aim Amount</h5>
		<input type="number" name="aim_amount" value="" size="50" />
	</div>

	<input type="hidden" name="current_amount" value="0" />

	<input type="hidden" name="funded_status" value="false" />

	<input type="hidden" name="creator_email" value="<?php echo $creator_email; ?>" />	

	<div class="form-group">
		<div><input type="submit" value="Create Now!" /></div>
	</div>

</form>

</body>
</html>