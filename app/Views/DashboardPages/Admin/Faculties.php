<div class="column is-9 ">
  <div class="modal" id="add-faculty-modal">
    <div class="modal-background"></div>
    <div class="modal-content">
      <div class="section modal-wrap">
        <div class="box">
          <form method="POST" onsubmit="return false" id="add-faculty-form">
            <div class="field">
              <label class="label">Faculty Code</label>
              <p class="control has-icons-left ">
                <input class="input" type="text" name="facultycode">
                <span class="icon is-small is-left">
                  <i class="fa fa-key"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <label class="label">Faculty Name</label>
              <p class="control has-icons-left ">
                <input class="input" type="text" name="facultyname">
                <span class="icon is-small is-left">
                  <i class="fa fa-building"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <label class="label">Faculty Dean</label>
              <p class="control has-icons-left">
                <span class="select">
                  <select name="facultydean">
                    <?php foreach($academicians as $academician) : ?>
                    <option value="<?php echo  $academician->academician_id ?>"><?php echo $academician->academician_fullname ?></option>
                    <?php endforeach; ?>
                  </select>
                </span>
                <span class="icon is-small is-left">
                  <i class="fa fa-person"></i>
                </span>
              </p>
            </div>
            
            <div class="is-centered">
              <button class="button is-success" onclick="AddFaculty()">Add Faculty</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <button class="modal-close is-large" aria-label="close" id="add-faculty-modal-close-button"></button>
  </div>
  <div class="modal" id="edit-faculty-modal">
    <div class="modal-background"></div>
    <div class="modal-content">
      <div class="section modal-wrap">
        <div class="box">
          <form method="POST" onsubmit="return false" id="edit-faculty-form">
            
            <input type="hidden" name="edfacultyid" id="edfacultyid">
            <div class="field">
              <label class="label">Faculty Code</label>
              <p class="control has-icons-left ">
                <input class="input" type="text" name="edfacultycode" id="edfacultycode">
                <span class="icon is-small is-left">
                  <i class="fa fa-key"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <label class="label">Faculty Name</label>
              <p class="control has-icons-left ">
                <input class="input" type="text" name="edfacultyname" id="edfacultyname">
                <span class="icon is-small is-left">
                  <i class="fa fa-building"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <label class="label">Faculty Dean</label>
              <p class="control has-icons-left">
                <span class="select">
                  <select name="edfacultydean" id="edfacultydean" >
                    <?php foreach($academicians as $academician) : ?>
                    <option value="<?php echo  $academician->academician_id ?>"><?php echo $academician->academician_fullname  ?></option>
                    <?php endforeach; ?>
                  </select>
                </span>
                <span class="icon is-small is-left">
                  <i class="fa fa-person"></i>
                </span>
              </p>
            </div>
            
            <div class="is-centered">
              <button class="button is-success" onclick="UpdateFaculty()">Update Faculty</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <button class="modal-close is-large" aria-label="close" id="edit-faculty-modal-close-button"></button>
  </div>
  <div class="is-centered add-faculty-button">
    <button class="button is-success" id="add-faculty-modal-open-button">Add Faculty</button>
  </div>
  <div class="is-centered">
    <div class="is-table-responsive">
      <table class="table is-hoverable">
        <thead>
          <tr>
            <th>Faculty Id</th>
            <th>Faculty Name</th>
            <th>Faculty Dean</th>
          </tr>
        </thead>
        
        <tbody>
          <?php foreach($faculties as $faculty) : ?>
          <tr >
            <td><?php echo $faculty->faculty_id ?></td>
            <td><?php echo $faculty->faculty_name ?></td>
            <td><?php echo $faculty->academician_fullname ?></td>
            <td>
              <button class="button" onclick="EditFaculty(<?php echo $faculty->faculty_id ?>)">Edit Faculty</button>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
    </div>
  </div>
</div>