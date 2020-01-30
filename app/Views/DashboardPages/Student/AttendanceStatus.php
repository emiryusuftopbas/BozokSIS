<div class="column is-9">
	<div class="is-centered">
		<div class="is-table-responsive">
			<table class="table is-hoverable">
				<thead>
					<tr>
						<th>Lesson Name</th>
						<th>Attendance Time</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($attendances as $attendance ): ?>
					<tr>
						<td><?php echo $attendance->lesson_name ?></td>
						<td><?php echo $attendance->attendance_time ?></td>
	
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

		</div>
	</div>


</div>