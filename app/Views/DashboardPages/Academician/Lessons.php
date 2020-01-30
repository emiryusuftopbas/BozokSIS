<div class="column is-9">
	<div class="is-centered">
		<div class="is-table-responsive">
			<table class="table is-hoverable">
				<thead>
					<tr>
						<th>Lesson Name</th>
						<th>Lesson Term</th>
						<th>Lesson Credit</th>
						<th>Lesson Time</th>
						<th>Lesson Faculty</th>
						<th>Lesson Department</th>
					</tr>
				</thead>
					
				<?php foreach($lessons as $lesson): ?>
					
					<tr>
						<td><a href="<?php echo SITE_URL.'/'.$atga.'/'.$lesson->lesson_id ?>"
							><?php echo $lesson->lesson_name ?></a></td>
						<td><?php echo $lesson->academic_term ?></td>
						<td><?php echo $lesson->lesson_credit ?></td>
						<td><?php echo $lesson->lesson_time ?></td>
						<td><?php echo $lesson->faculty_name ?></td>
						<td><?php echo $lesson->department_name ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

