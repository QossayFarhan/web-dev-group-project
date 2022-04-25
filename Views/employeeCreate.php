<?php include "sidebar.php";?>

<div class="container">
	<h1>Create New Employee</h1>
	<form action="employeeCreate" method="POST">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
		</div>
		<div class="form-group">
			<label for="email">Email address</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" required aria-describedby="passwordValidate">
			<small id="passwordValidate" class="form-text text-danger hide">Mismatch password and confirm password</small>
		</div>
		<div class="form-group">
			<label for="c_password">Confirm Password</label>
			<input type="password" class="form-control" id="c_password" name="c_password" placeholder="Confirm Password" required>
		</div>
		<br/>
		<div class="form-check">
			<input type="hidden" name="admin" value="0">
			<input type="checkbox" class="form-check-input" id="admin" name="admin" value="1">
			<label class="form-check-label" for="admin">Mark as admin</label>
		</div>
		<button type="submit" class="btn btn-primary me-2" onclick="return validatePassword();">Create</button>
		<a href="employeeList">back to list</a>
	</form>
</div>

<?php include "Views/common/js/validateFormPassword.php"; ?>