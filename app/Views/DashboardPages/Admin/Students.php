<div class="column is-9 ">
  
   <span class="select my-select">
    <select id="studentstatus" >
      <option value="1" onclick="StudentStatusChange(1)">All</option>
      <option value="2" onclick="StudentStatusChange(2)">Approved</option>
      <option value="3" onclick="StudentStatusChange(3)">Unapproved</option>
    </select>
  </span>



  <div class="modal" id="edit-student-modal" >
    <div class="modal-background"></div>
    <div class="modal-content">
      <div class="section modal-wrap">
        <div class="box">
          <form method="POST" onsubmit="return false" id="edit-student-form">
            <input type="hidden" name="edstudentid" id="edstudentid" >
            <div class="field">
              <label class="label">Student Name</label>
              <p class="control has-icons-left ">
                <input class="input" type="text" name="edstudentname" id="edstudentname" >
                <span class="icon is-small is-left">
                  <i class="fa fa-key"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <label class="label">Student Year</label>
              <p class="control has-icons-left">
                <span class="select">
                  <select name="edstudentyear" id="edstudentyear" >
                      <option value="1">First year</option>
                      <option value="2">Second year</option>
                      <option value="3">Third year</option>
                      <option value="4">Last year</option>
                  </select>
                </span>
                <span class="icon is-small is-left">
                  <i class="fa fa-person"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <label class="label">Student Faculty</label>
              <p class="control has-icons-left">
                <span class="select">
                  <select name="edstudentfaculty" id="edstudentfaculty" >
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
              <label class="label">Student Department</label>
              <p class="control has-icons-left">
                <span class="select">
                  <select name="edstudentdepartment" id="edstudentdepartment" >
                    <?php foreach($departments as $department) : ?>
                    <option value="<?php echo  $department->department_id ?>"><?php echo $department->department_name  ?></option>
                    <?php endforeach; ?>
                  </select>
                </span>
                <span class="icon is-small is-left">
                  <i class="fa fa-person"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <label class="label">Student Status</label>
              <p class="control has-icons-left">
                <span class="select">
                  <select name="edstudentstatus" id="edstudentstatus">
                    <option value="2">Approved</option>
                    <option value="1">Unapproved</option>
                  </select>
                </span>
                <span class="icon is-small is-left">
                  <i class="fa fa-person"></i>
                </span>
              </p>
            </div>
            
            <div class="is-centered">
              <button class="button is-success" onclick="UpdateStudent()">Update Student</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <button class="modal-close is-large" aria-label="close" id="edit-student-modal-close-button"></button>
  </div>
  <div class="is-centered">
    <div class="is-table-responsive">
      <table class="table is-hoverable">
        <thead>
          <tr>
            <th>Student Id</th>
            <th>Student Name</th>
            <th>Student Year</th>
            <th>Student Faculty</th>
            <th>Student Department</th>
            <th>Student Status</th>
          </tr>
        </thead>
        
        <tbody>
          <?php foreach($students as $student) : ?>
          <tr >
            <td><?php echo $student->student_id ?></td>
            <td><?php echo $student->student_fullname ?></td>
            <td><?php echo $student->student_year ?></td>
            <td><?php echo $student->faculty_name ?></td>
            <td><?php echo $student->department_name ?></td>
            <td><?php echo ($student->student_status == 2) ? 'approved':'unapproved'; ?></td>
            <td>
              <button class="button" onclick="EditStudent(<?php echo $student->student_id  ?>)">Edit Student</button>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
    </div>
  </div>
</div>