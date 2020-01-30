<?php

class Mylessons extends Controller {

	public function index(){	
		if (@$_SESSION['USER_ROLE'] == 'academician' ) {

			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$lessonModel = $this->model('LessonModel');

			$lessons = $lessonModel->getLessonsForAcademician($userId);

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'mylessons',
				'lessons' => $lessons
			];

			$this->view("Dashboard",$data);
		}
	}

}


?>