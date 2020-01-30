<div class="column is-9">
	<div class="is-centered">
		<div class="is-table-responsive">
			<table class="table is-hoverable">
				<thead>
					<tr>
						<th>Student Name</th>
						<th>Student Username</th>
						<th>Student Attendance Time</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach($students as $student): ?>
					<form method="POST" onsubmit="return false" id="add-attendance-form-<?php echo $student->student_id ?>">
						<input type="hidden" name="attendancestudent" value="<?php echo $student->student_id ?>">
						<input type="hidden" name="attendancelesson" value="<?php echo $lessonId ?>">
						<tr>
							<td><?php echo $student->student_fullname ?></td>
							<td><?php echo $student->student_username ?></td>
							<td><input type="number" name="attendancetime" 
								value="<?php echo @$attendances[$student->student_id]->attendance_time ?>" >
							</td></td>
							<td><button class="button" 
								onclick="AddAttendance(<?php echo $student->student_id ?>,<?php echo $lessonId ?>)">Save Attendance
							</button></td>
						</tr>
					</form>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>