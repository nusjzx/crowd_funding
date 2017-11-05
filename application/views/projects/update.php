<html>
<head>
	<title>Edit Project</title>
</head>
<body>

	<?php echo validation_errors(); ?>

	<?php echo form_open('projects/edit/'.$old['id']); ?>

<div class="form-group">
	<h5>Title</h5>
	<input type="text" name="title" value="<?php echo $old['title']; ?>" size="50" />
</div>

<div class="form-group">
	<h5>Description</h5>
	<textarea class="form-control" name="description" placeholder="Enter description here..."><?php echo $old['description'] ?></textarea>
</div>

<div class="form-group">
	<h5>Duartion (Days)</h5>
	<input type="number" name="duration" value="<?php echo $old['duration']; ?>" size="50" />
</div>

<div class="form-group">
	<h5>Category</h5>
	<input type="text" name="category" value="<?php echo $old['category']; ?>" size="50" />
</div>

<div class="form-group">
	<h5>Aim Amount</h5>
	<input type="number" name="aim_amount" value="<?php echo $old['aim_amount']; ?>" size="50" />
</div>

	<input type="hidden" name="id" value="<?php echo $old['id']; ?>"/>

	<div><input type="submit" value="Update" /></div>

</form>

</body>
</html>