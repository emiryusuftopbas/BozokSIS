<div class="column is-9">
	<div class="is-centered">
		<div class="is-table-responsive">
			<table class="table is-hoverable">
				<thead>
					<tr>
						<th>Lesson Name</th>
						<th>Lesson Lecturer</th>
						<th>Midterm Grade</th>
						<th>Final Grade</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($grades as $grade ): ?>
					<tr>
						<td><?php echo $grade->lesson_name ?></td>
						<td><?php echo $grade->academician_fullname ?></td>
						<td><?php echo $grade->midterm_grade ?></td>		
						<td><?php echo $grade->final_grade ?></td>		
					</tr>
					<?php endforeach; ?>
					</form>
				</tbody>
			</table>

		</div>
	</div>


</div>