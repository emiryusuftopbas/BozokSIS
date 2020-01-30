<div class="column is-9 ">
	
	<div class="modal" id="add-department-modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="section modal-wrap">
				<div class="box">
					<form method="POST" onsubmit="return false" id="add-department-form">
						<div class="field">
							<label class="label">Department Code</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="departmentcode">
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Department Name</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="departmentname">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Department Faculty</label>
							<p class="control has-icons-left">
								<span class="select">
								
									<select name="departmentfaculty">
									<?php foreach($faculties as $faculty) : ?>
										<option value="<?php echo $faculty->faculty_id ?>"><?php echo $faculty->faculty_name ?></option>
									<?php endforeach; ?>
									</select>
								
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Head Of Department</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="departmenthead">
									<?php foreach($academicians as $academician) : ?>
										<option value="<?php echo $academician->academician_id ?>">
											<?php echo $academician->academician_fullname	 ?>
										</option>
									<?php endforeach; ?>	
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="is-centered">
							<button class="button is-success" onclick="AddDepartment()">Add Department</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close" id="add-department-modal-close-button"></button>
	</div>


	<div class="modal" id="edit-department-modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="section modal-wrap">
				<div class="box">
					<form method="POST" onsubmit="return false" id="edit-department-form">
						<input type="hidden" name="eddepartmentid" id="eddepartmentid">
						<div class="field">
							<label class="label">Department Code</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="eddepartmentcode" id="eddepartmentcode">
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Department Name</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="eddepartmentname" id="eddepartmentname">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Department Faculty</label>
							<p class="control has-icons-left">
								<span class="select">
								
									<select name="eddepartmentfaculty" id="eddepartmentfaculty">
									<?php foreach($faculties as $faculty) : ?>
										<option value="<?php echo $faculty->faculty_id ?>"><?php echo $faculty->faculty_name ?></option>
									<?php endforeach; ?>
									</select>
								
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Head Of Department</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="eddepartmenthead" id="eddepartmenthead">
									<?php foreach($academicians as $academician) : ?>
										<option value="<?php echo $academician->academician_id ?>">
											<?php echo $academician->academician_fullname ?>
										</option>
									<?php endforeach; ?>	
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="is-centered">
							<button class="button is-success" onclick="UpdateDepartment()">Add Department</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close" id="edit-department-modal-close-button"></button>
	</div>


	<div class="is-centered add-faculty-button">
		<button class="button is-success" id="add-department-modal-open-button">Add Department</button>
	</div>
	<div class="is-centered">
		<div class="is-table-responsive">
			<table class="table is-hoverable">
				<thead>
					<tr>
						<th>Department Id</th>
						<th>Deparment Code</th>
						<th>Deparment Name</th>
						<th>Department Faculty</th>
						<th>Head Of Department</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($departments as $department): ?>
					<tr>
						<td><?php echo $department->department_id ?></td>
						<td><?php echo $department->department_code ?></td>
						<td><?php echo $department->department_name ?></td>
						<td><?php echo $department->faculty_name ?></td>
						<td><?php echo $department->academician_fullname ?></td>
						<td>
							<button class="button" onclick="EditDepartment(<?php echo $department->department_id ?>)">Edit Department</button>
						</td>
					</tr>
					<?php endforeach; ?>
					
				</tbody>
			</table>
		</div>
		
	</div>
</div>