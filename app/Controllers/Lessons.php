<?php

class Lessons extends Controller {

	public function index(){
		if (@$_SESSION['USER_ROLE'] == 'admin' ) {

			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$lessonModel = $this->model('LessonModel');
			$facultyModel = $this->model('FacultyModel');
			$departmentModel = $this->model('DepartmentModel');
			$academicYearModel = $this->model('AcademicYearModel');
			$academicianModel = $this->model('AcademicianModel');

			$lessons = $lessonModel->getLessons();
			$faculties = $facultyModel->getFaculties();
			$departments = $departmentModel->getDepartments();
			$academicTerms = $academicYearModel->getAcademicTerms();
			$academicians = $academicianModel->getAcademicians();

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'lessons',
				'lessons' => $lessons,
				'faculties' => $faculties,
				'departments' => $departments,
				'academicTerms' => $academicTerms,
				'academicians' => $academicians
			];

			$this->view("Dashboard",$data);
		}
	}

	public function get(){
		if (@$_SESSION['USER_ROLE'] == 'admin' ) {
			$id = $_POST['id'];

			$lessonModel = $this->model('LessonModel');

			$lesson = $lessonModel->getLesson($id);

			if ($lesson != false) {
				echo $lesson;
			}else{
				echo 'error';
			}

		}
	}
	public function add(){
		if (@$_SESSION['USER_ROLE'] == 'admin' ) {

			$lessonName = $_POST['lessonname'];
			$lessonYear = $_POST['lessonyear'];
			$lessonTerm = $_POST['lessonterm'];
			$lessonCredit = $_POST['lessoncredit'];
			$lessonTime = $_POST['lessontime'];
			$lessonFaculty = $_POST['lessonfaculty'];
			$lessonDepartment = $_POST['lessondepartment'];
			$lessonLecturer = $_POST['lessonlecturer'];


			$facultyModel = $this->model('FacultyModel');
			$departmentModel = $this->model('DepartmentModel');
			$academicianModel = $this->model('AcademicianModel');


			if (!$lessonName
				|| !$lessonTerm
				|| !$lessonYear
				|| !$lessonCredit
				|| !$lessonTime
				|| !is_numeric(intval($lessonFaculty))
				|| !is_numeric(intval($lessonDepartment))
				|| !is_numeric(intval($lessonLecturer)) 
			) {
				echo 'empty';
			}else if(!$facultyModel->isFacultyExists($lessonFaculty)){
				echo 'facultyerror';
			}else if(!$departmentModel->isDepartmentExists($lessonFaculty)){
				echo 'departmenterror';
			}else if(!$academicianModel->isAcademicianExists($lessonLecturer)){
				echo 'academicianerror';
			}else{
				$lessonModel = $this->model('LessonModel');

				$isAddSuccessful = $lessonModel->addLesson(
					$lessonName,
					$lessonYear,
					$lessonTerm,
					$lessonCredit,
					$lessonTime ,
					$lessonFaculty,
					$lessonDepartment,
					$lessonLecturer
				);
				if ($isAddSuccessful) {
					echo 'success';
				}
			}
		}
	}

	public function update(){
		if (@$_SESSION['USER_ROLE'] == 'admin' && $_POST) {
			$lessonId = $_POST['edlessonid'];
			$lessonName = $_POST['edlessonname'];
			$lessonYear = $_POST['edlessonyear'];
			$lessonTerm = $_POST['edlessonterm'];
			$lessonCredit = $_POST['edlessoncredit'];
			$lessonTime = $_POST['edlessontime'];
			$lessonFaculty = $_POST['edlessonfaculty'];
			$lessonDepartment = $_POST['edlessondepartment'];
			$lessonLecturer = $_POST['edlessonlecturer'];


			$facultyModel = $this->model('FacultyModel');
			$departmentModel = $this->model('DepartmentModel');
			$academicianModel = $this->model('AcademicianModel');
			$lessonModel = $this->model('LessonModel');

			if (!is_numeric(intval($lessonId))
				|| !$lessonName
				|| !$lessonYear
				|| !$lessonTerm
				|| !$lessonCredit
				|| !$lessonTime
				|| !is_numeric(intval($lessonFaculty))
				|| !is_numeric(intval($lessonDepartment))
				|| !is_numeric(intval($lessonLecturer))
			) {
				echo 'empty';
			}else if (!$facultyModel->isFacultyExists($lessonFaculty)) {
				echo 'facultyerror';
			}else if(!$departmentModel->isDepartmentExists($lessonDepartment)){
				echo 'departmenterror';
			}else if(!$academicianModel->isAcademicianExists($lessonLecturer)){
				echo 'academicianerror';
			}else {
				$isUpdateSuccessful = $lessonModel->updateLesson(
					$lessonId ,
					$lessonName ,
					$lessonYear,
					$lessonTerm ,
					$lessonCredit ,
					$lessonTime ,
					$lessonFaculty ,
					$lessonDepartment ,
					$lessonLecturer
				);

				if ($isUpdateSuccessful) {
					echo 'success';
				}
			}
		}
	}

}

?>