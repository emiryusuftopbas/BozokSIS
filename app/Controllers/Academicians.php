<?php
class Academicians extends Controller {
	public function index(){
		if (@$_SESSION['LOGIN_SESSION'] &&  $_SESSION['USER_ROLE'] == 'admin' ) {
			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];
			

			$academicianModel = $this->model("AcademicianModel");
			$facultyModel = $this->model("FacultyModel");
			$departmentModel = $this->model("DepartmentModel");

			$academicians = $academicianModel->getAcademicians();
			$faculties = $facultyModel->getFaculties();
			$departments = $departmentModel->getDepartments();

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'academicians',
				'academicians' => $academicians,
				'faculties' => $faculties,
				'departments' => $departments
			];
			
			$this->view("Dashboard",$data);
		}
	}
	public function approved(){
		if (@$_SESSION['LOGIN_SESSION'] &&  $_SESSION['USER_ROLE'] == 'admin' ) {
			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];

			$academicianModel = $this->model('AcademicianModel');
			$facultyModel = $this->model("FacultyModel");
			$departmentModel = $this->model("DepartmentModel");

			$academicians = $academicianModel->getAcademiciansByStatus(2);
			$faculties = $facultyModel->getFaculties();
			$departments = $departmentModel->getDepartments();

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'academicians',
				'academicians' => $academicians,
				'faculties' => $faculties,
				'departments' => $departments
			];
			
			$this->view("Dashboard",$data);
		}
	}
	public function unapproved(){
		if (@$_SESSION['LOGIN_SESSION'] &&  $_SESSION['USER_ROLE'] == 'admin' ) {
			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];

			$academicianModel = $this->model('AcademicianModel');
			$facultyModel = $this->model("FacultyModel");
			$departmentModel = $this->model("DepartmentModel");

			$academicians = $academicianModel->getAcademiciansByStatus(1);
			$faculties = $facultyModel->getFaculties();
			$departments = $departmentModel->getDepartments();

			
			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'academicians',
				'academicians' => $academicians,
				'faculties' => $faculties,
				'departments' => $departments
			];
			
			$this->view("Dashboard",$data);
		}
	}

	public function get(){
		if (@$_SESSION['LOGIN_SESSION'] &&  $_SESSION['USER_ROLE'] == 'admin' ) {
			$id = @$_POST['id'];

			$academicianModel = $this->model('AcademicianModel');

			$academician = $academicianModel->getAcademician($id);

			if ($academician != false) {
				echo $academician;
			}else{
				echo 'error';
			}

		}
	}

	public function update(){
		if (@$_SESSION['LOGIN_SESSION'] &&  $_SESSION['USER_ROLE'] == 'admin' ) {
			$academicianId =  @$_POST['edacademicianid'];
			$academicianName = @$_POST['edacademicianname'];
			$academicianFaculty = @$_POST['edacademicianfaculty'];
			$academicianDepartment = @$_POST['edacademiciandepartment'];
			$academicianStatus = @$_POST['edacademicianstatus'];

			$academicianModel = $this->model('AcademicianModel');
			$facultyModel = $this->model('FacultyModel');
			$departmentModel = $this->model('departmentModel');

			if (!is_numeric(intval($academicianId)) || !$academicianName || !is_numeric(intval($academicianFaculty)) || !is_numeric(intval($academicianDepartment)) || !$academicianStatus) {
				echo 'empty';
			}else if(!$facultyModel->isFacultyExists($academicianFaculty)){
				echo 'facultyerror';
			}else if(!$departmentModel->isDepartmentExists($academicianDepartment)){
				echo 'departmenterror';
			}else{
				$isUpdateSuccessful = $academicianModel->updateAcademician(
					$academicianId,
					$academicianName,
					$academicianFaculty,
					$academicianDepartment,
					$academicianStatus);

				if ($isUpdateSuccessful) {
					echo 'success';
				}
			}
		}
	}

}
?>