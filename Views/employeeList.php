<?php include "sidebar.php";?>

<div class="container">
	<h1>
		Employee Management
		<a class="btn btn-primary" href="employeeCreate">
			<i class="bi bi-plus-lg"></i>
			<span>Create New Employee</span>
		</a>
	</h1>
	
	<?php if($variables['success'] == 'create') { ?>
	<div class="alert alert-success" role="alert">
		Employee successfully created
	</div>
	<?php } else if($variables['success'] == 'delete') { ?>
	<div class="alert alert-success" role="alert">
		Employee successfully deleted
	</div>
	<?php } ?>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$length = count($variables['employees']);
			for ($i = 0; $i < $length; $i++ )
			{
				$name = $variables['employees'][$i]['name'];
				if($variables['employees'][$i]['admin'])
				{
					$name = $variables['employees'][$i]['name'] . " <span class='badge bg-warning'>Admin</span>";
				}
				echo 
				"<tr>
					<td scope='col'>#".$variables['employees'][$i]['id']."</td>
					<td>".$name." </td> 
					<td>".$variables['employees'][$i]['email']."</td>
					<td>
						<a class='btn btn-secondary' href='employeeDetails?id=".$variables['employees'][$i]['id']."'>Edit</a>
						<a class='btn btn-danger' href='employeeDelete?id=".$variables['employees'][$i]['id']."' onclick='return deleteConfirmation();'>Delete</a>
					</td>
				</tr>";		
			}
			?>
		</tbody>
	</table>
</div>

<script>
	function deleteConfirmation()
	{
		return confirm('Are you sure want to delete the employee?');
	}
</script>