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

	<input type="hidden" name="start_date" value="">

	<h5>Duartion (Days)</h5>
	<input type="text" name="duartion" value="" size="50" />

	<h5>Category</h5>
	<input type="text" name="category" value="" size="50" />

	<h5>Aim Amount</h5>
	<input type="text" name="aim_amount" value="" size="50" />

	<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>