<div class="column is-9">

	<div class="is-centered">
		<div class="is-table-responsive">
			<table class="table is-hoverable">
				<thead>
					<tr>
						<th>Student Name</th>
						<th>Student Username</th>
						<th>Midterm Grade</th>
						<th>Final Grade</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($students) == 0) { ?>
						<article class="message is-warning">
	  						There are no students taking this course.
						</article>
					<?php } ?>
				
				<?php if (count($students) >= 1) { ?>
				<?php foreach($students as $student): ?>
				<form method="POST" onsubmit="return false" id="add-grade-form-<?php echo $student->student_id ?>">
					

					<input type="hidden" name="gradestudent" value="<?php echo $student->student_id ?>">
					<input type="hidden" name="gradegrader" value="<?php echo $academician ?>">
					<input type="hidden" name="gradelesson" value="<?php echo $lessonId ?>">

					<tr>
						<td><?php echo $student->student_fullname ?></td>
						<td><?php echo $student->student_username ?></td>
						<td><input type="number" name="midtermgrade"
						 value="<?php echo @$grades[$student->student_id]->midterm_grade ?>" ></td>
						<td><input type="number" name="finalgrade" 
						value="<?php echo @$grades[$student->student_id]->final_grade ?>" ></td>
						<td><button class="button" onclick="SaveGrade(<?php echo $student->student_id ?>,<?php echo $lessonId ?>)">Save Grade</button></td>
					</tr>
				</form>
				<?php endforeach; ?>
				<?php } ?>

				</tbody>
			</table>
		</div>
	</div>
</div>

