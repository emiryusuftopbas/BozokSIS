<?php

class AcademicYear extends Controller {

	public function index(){
		
		if (@$_SESSION['LOGIN_SESSION'] &&  $_SESSION['USER_ROLE'] == 'admin' ) {

			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$academicYearModel = $this->model('AcademicYearModel');

			$academicYears = $academicYearModel->getAcademicYears();
			$academicTerms = $academicYearModel->getAcademicTerms();

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'academicyear',
				'academicYears' => $academicYears,
				'academicTerms' => $academicTerms
			];

			$this->view("Dashboard",$data);
		
		}

	}


	public function addyear(){
		
		if (@$_SESSION['LOGIN_SESSION'] && $_POST &&  $_SESSION['USER_ROLE'] == 'admin' ) {

			$academicYearName = $_POST['academicyearname'];
			$academicYearStartDate = $_POST['academicyearstartdate'];
			$academicYearEndDate = $_POST['academicyearenddate'];
			$academicYearStatus = 1;

			$academicYearModel = $this->model('AcademicYearModel');

			if (!$academicYearName || !$academicYearStartDate || !$academicYearEndDate ) {
				echo 'empty';
			}else  {
				$isAddSuccessful = $academicYearModel->addAcademicYear(
					$academicYearName,
					$academicYearStartDate,
					$academicYearEndDate,
					$academicYearStatus
				);
				if ($isAddSuccessful) {
					echo 'success';
				}
			}
		}
	}


	public function getyear(){
		if (@$_SESSION['LOGIN_SESSION'] && $_POST &&  $_SESSION['USER_ROLE'] == 'admin' ) {
			$id = $_POST['id'];

			$academicYearModel = $this->model('AcademicYearModel');
			$academicYear = $academicYearModel->getAcademicYear($id);

			if ($academicYear != false) {
				echo $academicYear;
			}else{
				echo 'error';
			}
		}
	}

	public function updateyear(){
		if (@$_SESSION['LOGIN_SESSION'] && $_POST &&  $_SESSION['USER_ROLE'] == 'admin' ) {
			$academicYearId = @$_POST['edacademicyearid'];
			$academicYearName = @$_POST['edacademicyearname'];
			$academicYearStartDate = @$_POST['edacademicyearstartdate'];
			$academicYearEndDate = @$_POST['edacademicyearenddate'];
			$academicYearStatus = @$_POST['edacademicyearstatus'];

			$academicYearModel = $this->model('AcademicYearModel');

			if (
			!is_numeric(intval($academicYearId))
			 || !$academicYearName
			 || !$academicYearStartDate
			 || !$academicYearEndDate
			 || !$academicYearStatus
			) {
				echo 'empty';
			}else{
				 $isUpdateSuccessful = $academicYearModel->updateAcademicYear(
				 	$academicYearId,
				 	$academicYearName,
				 	$academicYearStartDate,
				 	$academicYearEndDate,
				 	$academicYearStatus 
				 );

				 if ($isUpdateSuccessful) {
				 	echo 'success';
				 }
			}

		}
	}

	public function addterm(){
		if (@$_SESSION['LOGIN_SESSION'] && $_POST &&  $_SESSION['USER_ROLE'] == 'admin' ) {

			$academicTermName = @$_POST['academictermname'];
			$academicTermStartDate = @$_POST['academictermstartdate'];
			$academicTermEndDate = @$_POST['academictermenddate'];
			$academicTermYear = @$_POST['academictermyear'];

			$academicYearModel = $this->model('AcademicYearModel');

			if (!$academicTermName || !$academicTermStartDate || !$academicTermEndDate || !is_numeric(intval($academicTermYear)) ) {
				echo 'empty';
			}else  {
				$isAddSuccessful = $academicYearModel->addAcademicTerm(
					$academicTermName,
					$academicTermStartDate,
					$academicTermEndDate,
					$academicTermYear
				);
				if ($isAddSuccessful) {
					echo 'success';
				}
			}
		}
	}

	public function getterm(){
		if (@$_SESSION['LOGIN_SESSION'] && $_POST &&  $_SESSION['USER_ROLE'] == 'admin' ) {
			$id = $_POST['id'];
			
			$academicYearModel = $this->model('AcademicYearModel');

			$academicTerm = $academicYearModel->getAcademicTerm($id);

			if ($academicTerm != false) {
				echo $academicTerm;
			}else{
				echo 'error';
			}
		}
	}
 
 	public function updateterm(){
 		if (@$_SESSION['LOGIN_SESSION'] && $_POST &&  $_SESSION['USER_ROLE'] == 'admin' ) {
 			$academicTermId = $_POST['edacademictermid'];
 			$academicTermName = $_POST['edacademictermname'];
 			$academicTermStartDate = $_POST['edacademictermstartdate'];
 			$academicTermEndDate = $_POST['edacademictermenddate'];
 			$academicTermYear = $_POST['edacademictermyear'];

 			$academicYearModel = $this->model('AcademicYearModel');

 			if (!is_numeric(intval($academicTermId))
 				|| !$academicTermName
 				|| !$academicTermStartDate
 				|| !$academicTermEndDate
 				|| !$academicTermYear
 			){
 				echo 'empty';
 			}else{
 				$isUpdateSuccessful = $academicYearModel->updateAcademicTerm(
 					$academicTermId,
 					$academicTermName,
 					$academicTermStartDate,
 					$academicTermEndDate,
 					$academicTermYear 
 				);

 				if ($isUpdateSuccessful) {
 					echo 'success';
 				}
 			}
 		}
 	}

}

?>


