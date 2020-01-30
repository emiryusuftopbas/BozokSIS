<div class="column is-9 ">
	
	
	<div class="modal" id="edit-course-selection-date-modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="section modal-wrap">
				<div class="box">
					<form method="POST" onsubmit="return false" id="edit-course-selection-date-form">
						<input type="hidden" name="edcourseselectiondateid" id="edcourseselectiondateid" >
						<div class="field">
							<label class="label">Course Selection Start Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="edcourseselectionstartdate" id="edcourseselectionstartdate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Course Selection End Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="edcourseselectionenddate" id="edcourseselectionenddate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Course Selection Date Status</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="edcourseselectiondatestatus" id="edcourseselectiondatestatus" >
										<option value="1">Passive</option>
										<option value="2">Active</option>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Term</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="edcourseselectionacademicterm" id="edcourseselectionacademicterm" >
										<?php foreach($academicTerms as $academicTerm): ?>
										<option value="<?php echo $academicTerm->academic_term_id ?>"><?php echo $academicTerm->academic_term ?></option>
										<?php endforeach; ?>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						
						<div class="is-centered">
							<button class="button is-success" onclick="UpdateCourseSelectionDate()">Update Course Selection Date</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close" id="edit-course-selection-date-modal-close-button"></button>
	</div>
	
	<div class="modal" id="add-course-selection-date-modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="section modal-wrap">
				<div class="box">
					<form method="POST" onsubmit="return false" id="add-course-selection-date-form">
						<div class="field">
							<label class="label">Course Selection Start Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="courseselectionstartdate" id="courseselectionstartdate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Course Selection End Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="courseselectionenddate" id="courseselectionenddate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Term</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="courseselectionacademicterm" id="courseselectionacademicterm" >
										<?php foreach($academicTerms as $academicTerm): ?>
										<option value="<?php echo $academicTerm->academic_term_id ?>"><?php echo $academicTerm->academic_term ?></option>
										<?php endforeach; ?>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						
						<div class="is-centered">
							<button class="button is-success" onclick="AddCourseSelectionDate()">Add Academic Term</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close" id="add-course-selection-date-modal-close-button"></button>
	</div>
	
	<h5 class="title is-5 academic-year-title" >Course Selection Dates </h5>
	<button class="button is-small is-success add-academic-year-button" id="add-course-selection-date-modal-open-button">Add</button>
	<div class="is-centered">
		<div class="is-academic-table-year-responsive">
			<table class="table is-hoverable">
				<thead>
					<tr>
						<th>Course Selection Start Date</th>
						<th>Course Selection End Date</th>
						<th>Academic Term</th>
						<th>Status</th>
					</tr>
				</thead>
				<?php foreach($courseSelectionDates as $courseSelectionDate) : ?>
				<tr>
					<td><?php echo $courseSelectionDate->course_selection_start_date ?></td>
					<td><?php echo $courseSelectionDate->course_selection_end_date ?></td>
					<td><?php echo $courseSelectionDate->academic_term ?></td>
					<td><?php echo ($courseSelectionDate->course_selection_date_status  == 2) ? 'Active' : 'Passive' ?></td>
					<td>
						<button class="button"
						onclick="EditCourseSelectionDate(<?php echo $courseSelectionDate->course_selection_date_id ?>)">
						Edit Course Selection Date</button>
					</td>
				</tr>
				<?php endforeach; ?>
				<tbody>
					
				</tbody>
			</table>
		</div>
		
	</div>
</div>