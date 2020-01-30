<?php

class CourseSelection extends Controller {

	public function index(){
		if (@$_SESSION['USER_ROLE'] == 'student' ) {
			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$courseSelectionModel = $this->model('CourseSelectionModel');
			$studentModel = $this->model('StudentModel');
			$lessonModel = $this->model('LessonModel');
			$academicYearModel = $this->model('AcademicYearModel');
			
			$courseSelectionDate = $courseSelectionModel->isCourseSelectionDay();
			$studentFaculty = $studentModel->getStudentFaculty($userId);
			$studentDepartment = $studentModel->getStudentDepartment($userId);
			$studentYear = $studentModel->getStudentYear($userId);
			$lessons = $lessonModel->getLessonsForSelection($studentFaculty,$studentFaculty,$studentYear);
			$academicTermId = $academicYearModel->isWeInWhichAcademicTerm();

			$isStudentSelectedLessons = $lessonModel->isStudentSelectedLessons($userId,$academicTermId);

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'courseselection',
				'courseSelectionDate' => $courseSelectionDate,
				'lessons' => $lessons,
				'isStudentSelectedLessons' => $isStudentSelectedLessons
			];

			$this->view("Dashboard",$data);
		}
	}

	public function select(){
		if (@$_SESSION['USER_ROLE'] == 'student' && $_POST) {
			$userId = $_SESSION['USER_ID'];

			$lessons = $_POST['lessons'];

			$lessonModel = $this->model('LessonModel');

			$academicYearModel = $this->model('AcademicYearModel');

			$academicTermId = $academicYearModel->isWeInWhichAcademicTerm();

			$isSelectSuccessful = $lessonModel->addSelectedLesson($userId,$lessons,$academicTermId);

			if ($isSelectSuccessful) {
				echo 'success';
			}

		}else{
			echo 'empty';
		}
	}

}

?>