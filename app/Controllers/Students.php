<?php

class Students extends Controller {
	public function index(){
		if (@$_SESSION['USER_ROLE'] == 'admin' ) {
			
			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$studentModel = $this->model("StudentModel");
			$facultyModel = $this->model("FacultyModel");
			$departmentModel = $this->model("DepartmentModel");

			$students = $studentModel->getStudents();
			$faculties = $facultyModel->getFaculties();
			$departments = $departmentModel->getDepartments();

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'students',
				'students' => $students,
				'faculties' => $faculties,
				'departments' => $departments
			];

			$this->view("Dashboard",$data);
		}
	}

	public function approved(){
		if (@$_SESSION['USER_ROLE'] == 'admin' ) {
			
			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$studentModel = $this->model("StudentModel");
			$facultyModel = $this->model("FacultyModel");
			$departmentModel = $this->model("DepartmentModel");

			$students = $studentModel->getStudentsByStatus(2);
			$faculties = $facultyModel->getFaculties();
			$departments = $departmentModel->getDepartments();
		

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'students',
				'students' => $students,
				'faculties' => $faculties,
				'departments' => $departments
			];

			$this->view("Dashboard",$data);
		}
	}

	public function unapproved(){

		if (@$_SESSION['USER_ROLE'] == 'admin' ) {
			
			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$studentModel = $this->model("StudentModel");
			$facultyModel = $this->model("FacultyModel");
			$departmentModel = $this->model("DepartmentModel");

				
			$students = $studentModel->getStudentsByStatus(1);
			$faculties = $facultyModel->getFaculties();
			$departments = $departmentModel->getDepartments();

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'students',
				'students' => $students,
				'faculties' => $faculties,
				'departments' => $departments
			];

			$this->view("Dashboard",$data);
		}
	}

	public function get(){
		if (@$_SESSION['USER_ROLE'] == 'admin' ) {
			$id = $_POST['id'];

			$studentModel = $this->model('StudentModel');

			$student = $studentModel->getStudent($id);

			if($student != false){
				echo $student;
			}else{
				echo "error";
			}
		}
	}

	public function update(){
		if (@$_SESSION['USER_ROLE'] == 'admin' ) {
			
			$studentId = $_POST['edstudentid'];
			$studentName = $_POST['edstudentname'];
			$studentYear = $_POST['edstudentyear'];
			$studentFaculty = $_POST['edstudentfaculty'];
			$studentDepartment = $_POST['edstudentdepartment'];
			$studentStatus = $_POST['edstudentstatus'];	

			$facultyModel = $this->model('FacultyModel');
			$departmentModel = $this->model('DepartmentModel');
			$studentModel = $this->model('StudentModel');


			if(!$studentName || !$studentFaculty || !$studentDepartment || !$studentStatus){
				echo 'empty';
			}else if(!$facultyModel->isFacultyExists($studentFaculty)){
				echo 'facultyerror';
			}else if(!$departmentModel->isDepartmentExists($studentDepartment)){
				echo 'departmenterror';
			}else{
				$isUpdateSuccessful = $studentModel->updateStudent($studentId ,$studentName, $studentFaculty,$studentDepartment,$studentYear,$studentStatus);
				if ($isUpdateSuccessful) {
					echo 'success';
				}

			}
			
		}
	}
}

?>