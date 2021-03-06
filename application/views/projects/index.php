<!DOCTYPE html>
<html>
<head>
	<title>All Fundraising Campaigns</title>
	<link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
</head>
<body>
	<div class="container pull-left">
		<div class="row">
			<div class="col-md-6 col-md-offset-5">
				<h3>Search Projects</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-5">
				<form action="<?php echo base_url().'projects/search'; ?>" class="search-form" method="post">
					<div class="form-group has-feedback">
						<label for="search" class="sr-only">Search</label>
						<input type="text" class="form-control" name="search" id="search" placeholder="search">
						<span class="glyphicon glyphicon-search form-control-feedback"></span>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="row">
		<h1><?php echo ''.$title; ?></h1>
	</div>

	<div class="row">
		<?php foreach ($details as $item_details): ?>
			<div class="col-lg-4">
				<h2><?php echo $item_details['title']; ?></h2>
				<p><?php echo $item_details['description']; ?></p>
				<p><a class="btn btn-primary" href="<?php echo site_url('projects/view/'.$item_details['id']); ?>" role="button">View details »</a></p>
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round($item_details['percentage'], 2); ?>"
						aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $item_details['percentage']; ?>%">
						<span><?php echo $item_details['current_amount'].'/'.$item_details['aim_amount']; ?></span>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</body>
</html>
