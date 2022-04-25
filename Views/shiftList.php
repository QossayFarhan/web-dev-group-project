<?php include "sidebar.php";?>

<div class="container">
	<h1>
		Working Schedule
	</h1>
	
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th scope="col">Day</th>
				<th scope="col">Start Time</th>
				<th scope="col">End time</th>
				<th scope="col">Break Duration (minutes)</th>
				<?php if($_SESSION['admin']){ ?>
				<th scope="col">Actions</th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php 
			$length = count($variables);
			for ($i = 0; $i < $length; $i++ )
			{
			?>
				<tr>
					<td scope='col'><?php echo ucfirst($variables[$i]['day']) ?></td>
					<td><?php echo date("h:ia",strtotime($variables[$i]['start_time'])) ?></td> 
					<td><?php echo date("h:ia",strtotime($variables[$i]['end_time'])) ?></td>
					<td><?php echo $variables[$i]['break_duration'] ?></td>
					<?php if($_SESSION['admin']){ ?>
					<td>
						<a class='btn btn-secondary' href='shiftDetails?day=<?php echo $variables[$i]['day'] ?>'>Edit</a>
					</td>
					<?php } ?>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>