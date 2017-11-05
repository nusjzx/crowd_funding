<!DOCTYPE html>
<html>
<head>
	<title>All Fundraising Campaigns</title>
	<link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
</head>
<body>

	<?php foreach ($details as $item_details): ?>

		<div class="row">
			<div class="col-lg-4">
				<h2><?php echo $item_details['title']; ?></h2>
				<p><?php echo $item_details['description']; ?></p>
				<p><a class="btn btn-primary" href="projects/".$i	tem_details['id'] role="button">View details »</a></p>
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round($item_details['percentage'], 2); ?>"
					aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $item_details['percentage']; ?>%">
					<span><?php echo $item_details['current_amount'].'/'.$item_details['aim_amount']; ?></span>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</body>
</html>