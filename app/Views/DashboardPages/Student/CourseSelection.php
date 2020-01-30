<div class="column is-9">
	<?php
		if (!$courseSelectionDate || $isStudentSelectedLessons) {
			echo '<div class="column is-8 is-centered">
			<article class="message is-danger" id="error-messagebox">
				<div class="message-header">
				<p>Error</p>
				<button class="delete" aria-label="delete" id="error-messagebox-close-button"></button>
			</div>
			<div class="message-body">
				Its not time to choose a course or you are already selected lessons, if you want to change your selected lessons contact student administration of your faculty.
			</div>
		</article>
			</div>';
	}else{ ?>
	<div class="is-centered">
		<div class="is-table-responsive">
			<table class="table is-hoverable">
				<thead>
					<tr>
						<th>Lesson Name</th>
						<th>Lesson Credit</th>
						<th>Lesson Time</th>
						<th>Lesson Lecturer</th>
					</tr>
				</thead>
				<tbody>
					<form method="POST" onsubmit="return false" id="select-lesson-form">
						<?php foreach($lessons as $lesson) : ?>
						<tr>
							<td><?php echo $lesson->lesson_name ?></td>
							<td><?php echo $lesson->lesson_credit ?></td>
							<td><?php echo $lesson->lesson_time ?></td>
							<td><?php echo $lesson->academician_fullname ?></td>
							<td><label class="checkbox is-centered"><input type="checkbox"
								name="lessons[]" value="<?php echo $lesson->lesson_id ?>"
							></label></td>
						</tr>
						<?php endforeach;?>
					</form>
				</tbody>
			</table>
			<div class="is-centered add-faculty-button">
				<button class="button is-success" id="select-lesson" onclick="SelectLessons()">Select lessons</button>
			</div>
		</div>
	</div>
	<?php } ?>
</div>