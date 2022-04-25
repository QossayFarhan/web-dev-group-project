<?php include "sidebar.php";?>

<div class="container">
	<h1>Edit <?php echo ucfirst($variables['shift']['day'])?> Schedule</h1>
	<?php if($variables['success'] == 'update') { ?>
	<div class="alert alert-success" role="alert">
		Schedule successfully updated
	</div>
	<?php } ?>
	<form action="shiftUpdate" method="POST">
		<div class="form-group">
			<label for="start_time">Start Time</label>
			<input type="time" class="form-control" id="start_time" name="start_time" required value="<?php echo $variables['shift']['start_time']?>">
		</div>
		<div class="form-group">
			<label for="end_time">End Time</label>
			<input type="time" class="form-control" id="end_time" name="end_time" required value="<?php echo $variables['shift']['end_time']?>">
		</div>
		<div class="form-group">
			<label for="break_duration">Break Duration (minutes)</label>
			<input type="number" class="form-control" id="break_duration" name="break_duration" required value="<?php echo $variables['shift']['break_duration']?>">
		</div>
		<br/>
		<input type="hidden" name="day" value="<?php echo $variables['shift']['day']?>">
		<button type="submit" class="btn btn-primary me-2">Update</button>
		<a href="shiftList">back to list</a>
	</form>
</div>