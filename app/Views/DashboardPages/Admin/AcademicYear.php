<div class="column is-9 ">

	<div class="modal" id="edit-academic-term-modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="section modal-wrap">
				<div class="box">
					<form method="POST" onsubmit="return false" id="edit-academic-term-form">
						<input type="hidden" name="edacademictermid" id="edacademictermid" >
						<div class="field">
							<label class="label">Academic Term Name</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="edacademictermname" id="edacademictermname">
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Term Start Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="edacademictermstartdate" id="edacademictermstartdate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Term End Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="edacademictermenddate" id="edacademictermenddate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Term Year</label>
							<p class="control has-icons-left">
								<span class="select">	
									<select name="edacademictermyear" id="edacademictermyear" >
										<?php foreach($academicYears as $academicYear): ?>
										<option value="<?php echo $academicYear->academic_year_id ?>"><?php echo $academicYear->academic_year ?></option>
										<?php endforeach; ?>
									</select>									
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						
						<div class="is-centered">
							<button class="button is-success" onclick="UpdateAcademicTerm()">Update Academic Term</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close" id="edit-academic-term-modal-close-button"></button>
	</div>

	<div class="modal" id="add-academic-term-modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="section modal-wrap">
				<div class="box">
					<form method="POST" onsubmit="return false" id="add-academic-term-form">
						<div class="field">
							<label class="label">Academic Term Name</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="academictermname" id="academictermname">
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Term Start Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="academictermstartdate" id="academictermstartdate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Term End Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="academictermenddate" id="academictermenddate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Term Year</label>
							<p class="control has-icons-left">
								<span class="select">	
									<select name="academictermyear" id="academictermyear" >
										<?php foreach($academicYears as $academicYear): ?>
										<option value="<?php echo $academicYear->academic_year_id ?>"><?php echo $academicYear->academic_year ?></option>
										<?php endforeach; ?>
									</select>									
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						
						<div class="is-centered">
							<button class="button is-success" onclick="AddAcademicTerm()">Add Academic Term</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close" id="add-academic-term-modal-close-button"></button>
	</div>
	<div class="modal" id="add-academic-year-modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="section modal-wrap">
				<div class="box">
					<form method="POST" onsubmit="return false" id="add-academic-year-form">
						<div class="field">
							<label class="label">Academic Year Name</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="academicyearname" id="academicyearname">
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Year Start Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="academicyearstartdate" id="academicyearstartdate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Year End Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="academicyearenddate" id="academicyearenddate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="is-centered">
							<button class="button is-success" onclick="AddAcademicYear()">Add Academic Year</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close" id="add-academic-year-modal-close-button"></button>
	</div>
	<div class="modal" id="edit-academic-year-modal" >
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="section modal-wrap">
				<div class="box">
					<form method="POST" onsubmit="return false" id="edit-academic-year-form">
						<input type="hidden" name="edacademicyearid" id="edacademicyearid" >
						<div class="field">
							<label class="label">Academic Year Name</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="edacademicyearname" id="edacademicyearname">
								<span class="icon is-small is-left">
									<i class="fa fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Year Start Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="edacademicyearstartdate" id="edacademicyearstartdate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Academic Year End Date</label>
							<p class="control has-icons-left ">
								<input class="input" type="text" name="edacademicyearenddate" id="edacademicyearenddate">
								<span class="icon is-small is-left">
									<i class="fa fa-building"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<label class="label">Status</label>
							<p class="control has-icons-left">
								<span class="select">
									<select name="edacademicyearstatus" id="edacademicyearstatus">
										<option value="1">Passive</option>
										<option value="2">Active</option>
									</select>
								</span>
								<span class="icon is-small is-left">
									<i class="fa fa-person"></i>
								</span>
							</p>
						</div>
						<div class="is-centered">
							<button class="button is-success" onclick="UpdateAcademicYear()">Update Academic Year</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close" id="edit-academic-year-modal-close-button"></button>
	</div>
	<h5 class="title is-5 academic-year-title" >Academic Years</h5>
	<button class="button is-small is-success add-academic-year-button" id="add-academic-year-modal-open-button">Add</button>
	<div class="is-centered">
		<div class="is-academic-table-year-responsive">
			<table class="table is-hoverable">
				<thead>
					<tr>
						<th>Academic Year</th>
						<th>Academic Year Start Date</th>
						<th>Academic Year End Date</th>
						<th>Academic Year Status</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($academicYears as $academicYear):?>
					<tr>
						<td><?php echo $academicYear->academic_year ?></td>
						<td><?php echo $academicYear->academic_year_start_date ?></td>
						<td><?php echo $academicYear->academic_year_end_date ?></td>
						<td><?php echo ($academicYear->academic_year_status == 2) ? 'active' : 'passive' ?></td>
						<td>
							<button class="button" onclick="EditAcademicYear(<?php echo $academicYear->academic_year_id ?>)">Edit Academic Year</button>
						</td>
					</tr>
					<?php endforeach;?>
					
				</tbody>
			</table>
		</div>
		
	</div>
	<h5 class="title is-5 academic-year-title" >Academic Terms</h5>
	<button class="button is-small is-success add-academic-year-button" id="add-academic-term-modal-open-button">Add</button>
	<div class="is-centered">
		<div class="is-academic-table-term-responsive">
			<table class="table is-hoverable">
				<thead>
					<tr>
						<th>Academic Term</th>
						<th>Academic Year</th>
						<th>Academic Term Start Date</th>
						<th>Academic Term End Date</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($academicTerms as $academicTerm): ?>
					<tr>
						<td><?php echo $academicTerm->academic_term ?></td>
						<td><?php echo $academicTerm->academic_year ?></td>
						<td><?php echo $academicTerm->academic_term_start_date ?></td>
						<td><?php echo $academicTerm->academic_term_end_date ?></td>
						<td>
							<button class="button" onclick="EditAcademicTerm(<?php echo $academicTerm->academic_term_id ?>)">Edit Academic Term</button>
						</td>
					</tr>
					<?php endforeach; ?>

				</tbody>
			</table>
		</div>
		
	</div>
</div>