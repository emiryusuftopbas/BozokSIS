<?php

class Faculties extends Controller {

	public function index(){
		if (@$_SESSION['LOGIN_SESSION'] &&  $_SESSION['USER_ROLE'] == 'admin' ) {

			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$facultyModel = $this->model('FacultyModel');
			$academicianModel = $this->model('AcademicianModel');

			$faculties = $facultyModel->getFaculties();
			$academicians = $academicianModel->getAcademiciansForSelect();

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'faculties',
				'faculties'=> $faculties,
				'academicians' => $academicians
			];

			$this->view("Dashboard",$data);
	    }	
	}

	public function add(){
		if (@$_SESSION['LOGIN_SESSION'] && $_POST &&  $_SESSION['USER_ROLE'] == 'admin') {
			$facultyCode = @$_POST['facultycode'];
			$facultyName = @$_POST['facultyname'];
			$facultyDean = @$_POST['facultydean'];

			$academicianModel = $this->model('AcademicianModel');
			$facultyModel = $this->model('FacultyModel');

			if (!$facultyCode || !$facultyName || !$facultyDean) {
				echo 'empty';
			}else if(!$academicianModel->isAcademicianExists($facultyDean)){
				echo 'academicianerror';
			}else if(!filter_var($facultyCode, FILTER_VALIDATE_INT) || !(strlen(strval($facultyCode)) ==4) || ($facultyCode<0) ){
				echo 'facultycodeerror';
			}else if($facultyModel->isFacultyCodeInUse($facultyCode)){
				echo 'facultycodeinuse';
			}else{
				$isAddSucessful = $facultyModel->addFaculty($facultyCode,$facultyName,$facultyDean);

				if ($isAddSucessful) {
					echo 'success';
				} 	
			}
	    }	
	}

	public function get(){
		if (@$_SESSION['LOGIN_SESSION'] && $_POST &&  $_SESSION['USER_ROLE'] == 'admin') {
			$id = $_POST['id'];

			$facultyModel = $this->model('FacultyModel');

			$faculty = $facultyModel->getFaculty($id);

			if ($faculty != false) {
				echo $faculty;
			}else{
				echo 'error';
			}
		}
	}

	public function update(){
		if (@$_SESSION['LOGIN_SESSION'] && $_POST 	&&  $_SESSION['USER_ROLE'] == 'admin') {
			$facultyId = @$_POST['edfacultyid'];
			$facultyCode = @$_POST['edfacultycode'];
			$facultyName = @$_POST['edfacultyname'];
			$facultyDean = @$_POST['edfacultydean'];

			$facultyModel = $this->model('FacultyModel');
			$academicianModel = $this->model('AcademicianModel');


			if (!is_numeric(intval($facultyId)) || !$facultyCode || !$facultyName || !is_numeric(intval($facultyDean))) {
				echo 'empty';
			}else if(!$academicianModel->isAcademicianExists($facultyDean)){
				echo 'deannotexists';
			}else if(!filter_var($facultyCode, FILTER_VALIDATE_INT) || !(strlen(strval($facultyCode)) ==4) || ($facultyCode<0) ){
				echo 'facultycodeerror';
			}else if($facultyModel->isFacultyCodeInUse($facultyId,$facultyCode)){
				echo 'facultycodeinuse';
			}else{
				$isUpdateSuccessful = $facultyModel->updateFaculty($facultyId,$facultyCode,$facultyName,$facultyDean);
				if ($isUpdateSuccessful) {
					echo 'success';
				}
			}

		}
	}
	
}


?>