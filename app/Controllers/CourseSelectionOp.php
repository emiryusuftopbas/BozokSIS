<?php

class CourseSelectionOp extends Controller {
		
	public function index(){
		if (@$_SESSION['LOGIN_SESSION'] &&  $_SESSION['USER_ROLE'] == 'admin'  ) {

			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$academicYearModel = $this->model('AcademicYearModel');
			$courseSelectionModel = $this->model('CourseSelectionModel');

			$academicYears = $academicYearModel->getAcademicYears();
			$academicTerms = $academicYearModel->getAcademicTerms();
			$courseSelectionDates = $courseSelectionModel->getCourseSelectionDates();


			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'courseselectionop',
				'academicTerms' => $academicTerms,
				'courseSelectionDates' => $courseSelectionDates
			];

			$this->view("Dashboard",$data);
		
		}
	}

	public function add(){
		if (@$_SESSION['LOGIN_SESSION'] &&  $_SESSION['USER_ROLE'] == 'admin' && $_POST ) {
			$courseSelectionStartDate = $_POST['courseselectionstartdate'];
			$courseSelectionEndDate = $_POST['courseselectionenddate'];
			$courseSelectionTerm = $_POST['courseselectionacademicterm'];

			$courseSelectionModel = $this->model('CourseSelectionModel');

			if (!$courseSelectionStartDate || !$courseSelectionEndDate ||  !is_numeric(intval($courseSelectionTerm)) ) {
				echo 'empty';
			}else {
				$isAddSuccessful = $courseSelectionModel->addCourseSelectionDate($courseSelectionStartDate , $courseSelectionEndDate,$courseSelectionTerm);

				if ($isAddSuccessful) {
					echo 'success';
				}
			}

		}
	}

	public function get(){
		if (@$_SESSION['LOGIN_SESSION'] && $_SESSION['USER_ROLE'] == 'admin' && $_POST ) {
			$id = $_POST['id'];
			$courseSelectionModel = $this->model('CourseSelectionModel');

			$courseSelectionDate = $courseSelectionModel->getCourseSelectionDate($id);

			if ($courseSelectionDate != false) {
				echo $courseSelectionDate;
			}else{
				echo 'error';
			}
		}
	}

	public function update(){
		if ($_SESSION['USER_ROLE'] == 'admin' && $_POST ) {
			$courseSelectionDateId  = $_POST['edcourseselectiondateid'];
			$courseSelectionStartDate  = $_POST['edcourseselectionstartdate'];
			$courseSelectionEndDate  = $_POST['edcourseselectionenddate'];
			$courseSelectionDateStatus  = $_POST['edcourseselectiondatestatus'];
			$courseSelectionDateTerm  = $_POST['edcourseselectionacademicterm'];

			$courseSelectionModel = $this->model('CourseSelectionModel');

			if (!is_numeric(intval($courseSelectionDateId))
				|| !$courseSelectionStartDate
				|| !$courseSelectionEndDate
				|| !is_numeric(intval($courseSelectionDateStatus))
				|| !is_numeric(intval($courseSelectionDateTerm))
			) {
				echo 'empty';
			}else {
				$isUpdateSuccessful = $courseSelectionModel->updateCourseSelectionDate(
					$courseSelectionDateId  ,
					$courseSelectionStartDate  ,
					$courseSelectionEndDate  ,
					$courseSelectionDateStatus ,
					$courseSelectionDateTerm 
				);
				if ($isUpdateSuccessful) {
					echo 'success';
				}
			}
		}
	}


}


?>