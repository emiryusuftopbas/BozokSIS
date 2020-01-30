<?php


class Departments extends Controller {

	public function index(){
		if (@$_SESSION['LOGIN_SESSION']) {
			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];

			$departmentModel = $this->model('DepartmentModel');
			$facultyModel = $this->model('FacultyModel');
			$academicianModel = $this->model('AcademicianModel');

			$departments = $departmentModel->getDepartments();
			$faculties = $facultyModel->getFaculties();
			$academicians = $academicianModel->getAcademiciansForSelect();

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'Departments',
				'departments' => $departments,
				'faculties' => $faculties,
				'academicians' => $academicians

			];

			$this->view('Dashboard',$data);
		}
	}

	public function add(){
		if (@$_SESSION['LOGIN_SESSION'] && $_POST) {
			
			$departmentCode = $_POST['departmentcode'];
			$departmentName = $_POST['departmentname'];
			$departmentFaculty = $_POST['departmentfaculty'];
			$departmentHead = $_POST["departmenthead"];

			$academicianModel = $this->model('AcademicianModel');
			$facultyModel = $this->model('FacultyModel');
			$departmentModel = $this->model('DepartmentModel');

			if (!$departmentCode || !$departmentName || !$departmentFaculty || !$departmentHead) {
				echo 'empty';
			}elseif (!$academicianModel->isAcademicianExists($departmentHead)) {
				echo 'academicianerror';
			}else if(!filter_var($departmentCode, FILTER_VALIDATE_INT) || !(strlen(strval($departmentCode)) ==3) || ($departmentCode<0)){
				echo 'departmentcodeerror';
			}else if($departmentModel->isDepartmentCodeInUse($departmentCode,$departmentFaculty)){
				echo 'departmentcodeinuse';
			}else if(!$facultyModel->isFacultyExists($departmentFaculty)){
				echo 'facultyerror';
			}else{
				$isAddSuccessful = $departmentModel->addDepartment($departmentCode,$departmentName,$departmentFaculty,$departmentHead);
				if ($isAddSuccessful) {
					echo 'success';
				}
			}
		}
	}

	public function get(){
		if (@$_SESSION['LOGIN_SESSION'] && $_POST) {
			$id = $_POST['id'];
			
			$departmentModel = $this->model('DepartmentModel');

			$isGetSuccessful = $departmentModel->getDepartment($id);

			if($isGetSuccessful != false){
				echo $departmentModel->getDepartment($id);
			}else{
				echo 'error';
			}
		}
	}

	public function update(){
		if (@$_SESSION['LOGIN_SESSION'] && $_POST) {
			$departmentId = @$_POST['eddepartmentid'];
			$departmentCode = @$_POST['eddepartmentcode'];
			$departmentName = @$_POST['eddepartmentname'];
			$departmentFaculty = @$_POST['eddepartmentfaculty'];
			$departmentHead = @$_POST['eddepartmenthead'];

			$academicianModel = $this->model('AcademicianModel');
			$departmentModel = $this->model('DepartmentModel');
			$facultyModel = $this->model('FacultyModel');


			if (!is_numeric(intval($departmentId)) || !$departmentCode || !$departmentName || !is_numeric(intval($departmentFaculty)) || !is_numeric(intval($departmentHead)) ) {
				echo 'empty';
			}else if (!$academicianModel->isAcademicianExists($departmentHead)) {
				echo 'academicianerror';
			}else if (!filter_var($departmentCode, FILTER_VALIDATE_INT) || !(strlen(strval($departmentCode)) ==3) || ($departmentCode<0) ){
				echo 'facultycodeerror';
			}else if ($departmentModel->isDepartmentCodeInUse($departmentCode,$departmentFaculty,$departmentId)) {
				echo 'departmentcodeinuse';
			}else if(!$facultyModel->isFacultyExists($departmentFaculty)){
				echo 'facultyerror';
			}else{
				$isUpdateSuccessful = $departmentModel->updateDepartment($departmentId,$departmentCode,$departmentName, $departmentFaculty , $departmentHead);
				if ($isUpdateSuccessful) {
					echo 'success';
				}
			}
		}
	}

}


?>