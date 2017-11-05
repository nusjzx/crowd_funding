<html>
<head>
	<title>Start A New Campaign</title>
</head>
<body>

	<?php echo validation_errors(); ?>

	<?php echo form_open('form'); ?>

	<h5>Title</h5>
	<input type="text" name="title" value="" size="50" />

	<h5>Description</h5>
	<input type="text" name="description" value="" size="50" />

	<input type="hidden" name="start_date" value="" size="50"/>

	<h5>Duration (Days)</h5>
	<input type="number" name="duration" value="" size="50" />

	<h5>Category</h5>
	<input type="text" name="category" value="" size="50" />

	<h5>Aim Amount (in Singapore Dollars)</h5>
	<input type="number" name="aim_amount" value="" size="50" />

	<h5>Your contact email:</h5>
	<input type="text" name="category" value="" size="50" />

	<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>