<h2><?= $title ?></h2>
<?php foreach($users as $user) : ?>
	<div class="row">
		<div class="col-md-12">
			<strong><?php echo $user['username']; ?></strong>
			<a class="btn btn-default pull-right" href="<?php echo site_url('/users/update'); ?>">Update</a>
			<hr/>
		</div>
	</div>
<?php endforeach; ?>
<!-- <div class="pagination-links">
	<?php echo $this->pagination->create_links(); ?>
</div> -->