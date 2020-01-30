<div class="column is-9 ">
	
	<div class="modal" id="edit-lesson-modal" >
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="section modal-wrap">
				<div class="box">
					<form method="POST" onsubmit="return false" id="edit-lesson-form">
						<input type="hidden" name="edlessonid" id="edlessonid">
						<div class="field">
							<label class="label">Lesson Name</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="edlessonname" id="edlessonname" >
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Year</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="edlessonyear" id="edlessonyear" >
										<option value="1">First Grade</option>
										<option value="2">Second Grade</option>
										<option value="3">Third Grade</option>
										<option value="4">Last Grade</option>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Term</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="edlessonterm" id="edlessonterm" >
										<?php foreach($academicTerms as $academicTerm): ?>
										<option value="<?php echo $academicTerm->academic_term_id ?>"><?php echo $academicTerm->academic_term ?></option>
										<?php endforeach;?>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Credit</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="edlessoncredit" id="edlessoncredit" >
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Time</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="edlessontime" id="edlessontime" >
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Faculty</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="edlessonfaculty" id="edlessonfaculty" >
										<?php foreach($faculties as $faculty): ?>
										<option value="<?php echo $faculty->faculty_id ?>"><?php echo $faculty->faculty_name ?></option>
										<?php endforeach;?>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Department</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="edlessondepartment" id="edlessondepartment" >
										<?php foreach($departments as $department): ?>
										<option value="<?php echo $department->department_id ?>"><?php echo $department->department_name ?></option>
										<?php endforeach;?>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Lecturer</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="edlessonlecturer" id="edlessonlecturer" >
										<?php foreach($academicians as $academician): ?>
										<option value="<?php echo $academician->academician_id ?>"><?php echo $academician->academician_fullname ?></option>
										<?php endforeach;?>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						
						<div class="is-centered">
							<button class="button is-success" onclick="UpdateLesson()">Update Lesson</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close" id="edit-lesson-modal-close-button"></button>
	</div>
	
	<div class="modal" id="add-lesson-modal" >
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="section modal-wrap">
				<div class="box">
					<form method="POST" onsubmit="return false" id="add-lesson-form">
						<div class="field">
							<label class="label">Lesson Name</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="lessonname" id="lessonname" >
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Year</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="lessonyear" id="lessonyear" >
										<option value="1">First Grade</option>
										<option value="2">Second Grade</option>
										<option value="3">Third Grade</option>
										<option value="4">Last Grade</option>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Term</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="lessonterm" id="lessonterm" >
										<?php foreach($academicTerms as $academicTerm): ?>
										<option value="<?php echo $academicTerm->academic_term_id ?>"><?php echo $academicTerm->academic_term ?></option>
										<?php endforeach;?>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Credit</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="lessoncredit" id="lessoncredit" >
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Time</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="lessontime" id="lessontime" >
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Faculty</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="lessonfaculty" id="lessonfaculty" >
										<?php foreach($faculties as $faculty): ?>
										<option value="<?php echo $faculty->faculty_id ?>"><?php echo $faculty->faculty_name ?></option>
										<?php endforeach;?>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Department</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="lessondepartment" id="lessondepartment" >
										<?php foreach($departments as $department): ?>
										<option value="<?php echo $department->department_id ?>"><?php echo $department->department_name ?></option>
										<?php endforeach;?>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Lesson Lecturer</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="lessonlecturer" id="lessonlecturer" >
										<?php foreach($academicians as $academician): ?>
										<option value="<?php echo $academician->academician_id ?>"><?php echo $academician->academician_fullname ?></option>
										<?php endforeach;?>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						
						<div class="is-centered">
							<button class="button is-success" onclick="AddLesson()">Add Lesson</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close" id="add-lesson-modal-close-button"></button>
	</div>
	<div class="is-centered add-faculty-button">
		<button class="button is-success" id="add-lesson-modal-open-button">Add Lesson</button>
	</div>
	<div class="is-centered">
		<div class="is-table-responsive">
			<table class="table is-hoverable">
				<thead>
					<tr>
						<th>Lesson Name</th>
						<th>Lesson Year</th>
						<th>Lesson Term</th>
						<th>Lesson Credit</th>
						<th>Lesson Time</th>
						<th>Lesson Faculty</th>
						<th>Lesson Department</th>
						<th>Lesson Lecturer</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($lessons as $lesson): ?>
					<tr>
						<td><?php echo $lesson->lesson_name ?></td>
						<td><?php echo $lesson->lesson_year ?></td>
						<td><?php echo $lesson->academic_term ?></td>
						<td><?php echo $lesson->lesson_credit ?></td>
						<td><?php echo $lesson->lesson_time ?></td>
						<td><?php echo $lesson->faculty_name ?></td>
						<td><?php echo $lesson->department_name ?></td>
						<td><?php echo $lesson->academician_fullname ?></td>
						<td> <button class="button" onclick="EditLesson(<?php echo $lesson->lesson_id ?>)">Edit Lesson</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>