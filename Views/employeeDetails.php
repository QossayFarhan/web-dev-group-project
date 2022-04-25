<?php include "sidebar.php";?>
<script src="Views/common/js/validateFormPassword.js"></script>

<div class="container">
	<h1>Edit Employee</h1>
	<?php if($variables['success'] == 'update') { ?>
	<div class="alert alert-success" role="alert">
		Employee successfully updated
	</div>
	<?php } ?>
	<form action="employeeUpdate" method="POST">
	<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required value="<?php echo $variables['employee']['name']?>">
		</div>
		<div class="form-group">
			<label for="email">Email address</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required value="<?php echo $variables['employee']['email']?>">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-describedby="passwordValidate">
			<small id="passwordValidate" class="form-text text-danger hide">Mismatch password and confirm password</small>
		</div>
		<div class="form-group">
			<label for="c_password">Confirm Password</label>
			<input type="password" class="form-control" id="c_password" name="c_password" placeholder="Confirm Password">
		</div>
		<br/>
		<div class="form-check">
			<input type="hidden" name="admin" value="0">
			<input type="checkbox" class="form-check-input" id="admin" name="admin" value="1" <?php if($variables['employee']['admin']){echo "checked";}?> >
			<label class="form-check-label" for="admin">Mark as admin</label>
		</div>
		<input type="hidden" name="id" value="<?php echo $variables['employee']['id']?>">
		<button type="submit" class="btn btn-primary me-2" onclick="return validatePassword();">Update</button>
		<a href="employeeList">back to list</a>
	</form>
</div>