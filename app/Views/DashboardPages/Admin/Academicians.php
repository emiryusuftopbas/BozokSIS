<div class="column is-9 ">
  
  <span class="select my-select">
    <select id="academicianstatus" >
      <option value="1" onclick="AcademicianStatusChange(1)">All</option>
      <option value="2" onclick="AcademicianStatusChange(2)">Approved</option>
      <option value="3" onclick="AcademicianStatusChange(3)">Unapproved</option>
    </select>
  </span>


  <div class="modal" id="edit-academician-modal" >
    <div class="modal-background"></div>
    <div class="modal-content">
      <div class="section modal-wrap">
        <div class="box">
          <form method="POST" onsubmit="return false" id="edit-academician-form">
            <input type="hidden" name="edacademicianid" id="edacademicianid" >
            <div class="field">
              <label class="label">Academician Name</label>
              <p class="control has-icons-left ">
                <input class="input" type="text" name="edacademicianname" id="edacademicianname" >
                <span class="icon is-small is-left">
                  <i class="fa fa-key"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <label class="label">Academician Faculty</label>
              <p class="control has-icons-left">
                <span class="select">
                  <select name="edacademicianfaculty" id="edacademicianfaculty" >
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
              <label class="label">Academician Department</label>
              <p class="control has-icons-left">
                <span class="select">
                  <select name="edacademiciandepartment" id="edacademiciandepartment" >
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
              <label class="label">Academician Status</label>
              <p class="control has-icons-left">
                <span class="select">
                  <select name="edacademicianstatus" id="edacademicianstatus">
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
              <button class="button is-success" onclick="UpdateAcademician()">Update Academician</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <button class="modal-close is-large" aria-label="close" id="edit-academician-modal-close-button"></button>
  </div>
  <div class="is-centered">
    <div class="is-table-responsive">
      <table class="table is-hoverable">
        <thead>
          <tr>
            <th>Academician Id</th>
            <th>Academician Name</th>
            <th>Academician Faculty</th>
            <th>Academician Department</th>
            <th>Academician Status</th>
          </tr>
        </thead>
        
        <tbody>
          <?php foreach($academicians as $academician) : ?>
          <tr >
            <td><?php echo $academician->academician_id ?></td>
            <td><?php echo $academician->academician_fullname ?></td>
            <td><?php echo $academician->faculty_name ?></td>
            <td><?php echo $academician->department_name ?></td>
            <td><?php echo ($academician->academician_status == 2) ? 'approved':'unapproved'; ?></td>
            <td>
              <button class="button" onclick="EditAcademician(<?php echo $academician->academician_id ?>)">Edit Academician</button>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
    </div>
  </div>
</div>