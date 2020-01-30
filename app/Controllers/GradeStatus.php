<?php 

class GradeStatus extends Controller {
	public function index(){
		if (@$_SESSION['USER_ROLE'] == 'student'  ) {

			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$lessonModel = $this->model('LessonModel');
	
			$grades = $lessonModel->getStudentGrades($userId);

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'gradestatus',
				'grades' => $grades
			];

			$this->view("Dashboard",$data);
		}
	}


	public function addgrade(){
		if (@$_SESSION['USER_ROLE'] == 'academician'  ) {

			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$lessonModel = $this->model('LessonModel');

			$lessons = $lessonModel->getLessonsForAcademician($userId);

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'lessons',
				'atga' => 'addgrade',
				'lessons' => $lessons
			];

			$this->view("Dashboard",$data);
		}
	}
	
	public function add($lessonId){
		if (@$_SESSION['USER_ROLE'] == 'academician'  ) {

			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	


			$studentModel = $this->model('StudentModel');
			$lessonModel = $this->model('LessonModel');
			$gradeModel = $this->model('GradeModel');



			$studentsThatTakeLes = $lessonModel->getStudentsThatTakeLesson($lessonId);

			$grades = $gradeModel->getGrades($studentsThatTakeLes,$lessonId);

			$students =	$studentModel->getStudentsIn($studentsThatTakeLes);
			$academician = $lessonModel->whoGivesThatLesson($lessonId);

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'addgrade',
				'students' => $students,
				'grades' => $grades,
				'lessonId' => $lessonId,
				'academician' => $academician
			];

			$this->view("Dashboard",$data);
		}
	}
	

	public function addorupdate(){
		if (@$_SESSION['USER_ROLE'] == 'academician' && $_POST) {

			$gradeStudent = $_POST['gradestudent'];
			$gradeGrader = $_POST['gradegrader'];
			$gradeLesson = $_POST['gradelesson'];
			$midtermGrade = $_POST['midtermgrade'];
			$finalGrade = $_POST['finalgrade'];

			$gradeModel = $this->model('GradeModel');

			

			if (!$gradeStudent
			 || !$gradeGrader
			 || !$gradeLesson 
			 || !(intval($midtermGrade)>=0)
			 || !(intval($finalGrade) >=0)
			) {
				echo 'empty';
			}else if( ($midtermGrade>100 || $midtermGrade <0) || ($finalGrade>100 || $finalGrade <0) ) {
				echo 'gradeerror';
			}else if($gradeModel->isGradeExists($gradeStudent,$gradeGrader,$gradeLesson)){
				$isUpdateSuccessful = $gradeModel->updateGrade($gradeStudent,$gradeGrader,$gradeLesson,$midtermGrade,$finalGrade);
				if ($isUpdateSuccessful) {
					echo 'successfulyupdated';
				}
			}else{
				$isAddSuccessful = $gradeModel->addGrade($gradeStudent,$gradeGrader,$gradeLesson,$midtermGrade,$finalGrade);
				if ($isAddSuccessful) {
					echo 'successfulyadded';
				}
			}
		}		
	}
}

?>