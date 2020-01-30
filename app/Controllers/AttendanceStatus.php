<?php

class AttendanceStatus extends Controller {

	public function index(){
		if (@$_SESSION['USER_ROLE'] == 'student'  ) {

			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$attendanceModel = $this->model('AttendanceModel');

			$attendances = $attendanceModel->getStudentAttendances($userId);

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'attendancestatus',
				'attendances' => $attendances
			];

			$this->view("Dashboard",$data);
		}
	}

	public function addattedance(){
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
				'atga' => 'addattendance',
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
			$attendanceModel = $this->model('AttendanceModel');



			$studentsThatTakeLes = $lessonModel->getStudentsThatTakeLesson($lessonId);
			
			$attendances = $attendanceModel->getStudentAttendancesForAcademicians($studentsThatTakeLes,$lessonId);
				


			$students =	$studentModel->getStudentsIn($studentsThatTakeLes);

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'addattendance',
				'students' => $students,
				'attendances' => $attendances,
				'lessonId' => $lessonId

			];

			$this->view("Dashboard",$data);
		}
	}

	public function addorupdate(){
		if (@$_SESSION['USER_ROLE'] == 'academician' && $_POST) {
			$attendanceStudent = $_POST['attendancestudent'];
			$attendanceLesson = $_POST['attendancelesson'];
			$attendanceTime = $_POST['attendancetime'];
				
			$attendanceModel = $this->model('AttendanceModel');

			if ( 
				!(intval($attendanceStudent)>=0)
				|| !(intval($attendanceStudent)>=0)
				|| !(intval($attendanceStudent)>=0)
			 ) {
				echo 'empty';
			}else if ($attendanceModel->isAttendanceExists($attendanceStudent,$attendanceLesson)) {
				$isUpdateSuccessful = $attendanceModel->updateAttendanceStatus(
					$attendanceStudent,
					$attendanceLesson,
					$attendanceTime
				);

				if ($isUpdateSuccessful) {
					echo 'successfulyupdated';
				}
			}else{
				$isAddSuccessful = $attendanceModel->addAttendanceStatus(
					$attendanceStudent,
					$attendanceLesson,
					$attendanceTime
				);

				if ($isAddSuccessful) {
					echo 'successfulyadded';
				}
			}
		}
	}
}


?>