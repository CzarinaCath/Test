<div class="row">
	<section class="col-md-12">
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title text-center">USER MANAGER</h3>
			</div>
			<div class="panel-body">
				<table class="table table-responsive table-hover">
					<thead>
						<tr>
							<th class="text-center">Salesforce ID</th>
							<th>Full Name</th>
							<th class="text-center">Username</th>
							<th class="text-center">Access Level</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($users->result() as $user): ?>
						<tr>
							<td class="text-center"><?php echo $user->SalesforceID; ?></td>
							<td><?php echo $user->FirstName. ' '.$user->LastName; ?></td>
							<td class="text-center"><?php echo $user->Username__c; ?></td>
							<td class="text-center"><?php echo $user->Access_Level__c; ?></td>
							<td class="text-center"><a href="<?php echo base_url('users/edit/'.$user->ID); ?>">Edit</a> | <a href="<?php echo base_url('users/delete/'.$user->ID); ?>">Delete</a></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
				<small><span><a href="<?php echo base_url('users/add'); ?>">Add User</a></span></small>
			</div>
		</div>
	</div>
</section>
</div>
