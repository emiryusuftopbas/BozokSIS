<?php

class SignUpModel extends Model {

	public function isEmailValid($email){
		$emailParts = explode('@',strtolower($email));

		$emailDomains = array('ogr.bozok.edu.tr', 'bozok.edu.tr','yobu.edu.tr');

		if (in_array($emailParts[1], $emailDomains)) {
			if ($emailParts[1] == 'ogr.bozok.edu.tr') {
				$usernameLength = strlen($emailParts[0]);
				if ($usernameLength == 11 && filter_var($emailParts[0], FILTER_VALIDATE_INT)) {
					return true;
				}
				return false;
			}else{
				return true;
			}
		}
		
		return false;
	}

	public function isEmailInUse($email){
		$controlstudentemail= $this->db->prepare("SELECT * FROM students WHERE student_email = :e");
		$controlstudentemail->execute([':e'=>$email]);

		$controlacademicianemail= $this->db->prepare("SELECT * FROM academicians WHERE academician_email = :e");
		$controlacademicianemail->execute([':e'=>$email]);

		$controladminemail= $this->db->prepare("SELECT * FROM admins WHERE admin_email = :e");
		$controladminemail->execute([':e'=>$email]);

		if ($controlstudentemail->rowCount() || $controlacademicianemail->rowCount() || $controladminemail->rowCount() ) {
			return true;
		}
		return false;
	}


	private function getFacultyId($facultyCode){
		$getfacultyid = $this->db->prepare("SELECT * FROM faculties WHERE faculty_code = :c");
		$getfacultyid->execute([':c' => $facultyCode]);

		if ($getfacultyid->rowCount()) {
			$row = $getfacultyid->fetch(PDO::FETCH_OBJ);
			return $row->faculty_id;
		}
		return false;
	}	

	private function getDepartmentId($facultyCode , $departmentCode){
	
		$facultyId = $this->getFacultyId($facultyCode);

		$getdepartmentid = $this->db->prepare("SELECT * FROM departments
		 WHERE department_code = :c AND faculty_id = :i");
		$getdepartmentid->execute([':c' => $departmentCode , ':i' => $facultyId]);

		if ($getdepartmentid->rowCount()) {
			$row = $getdepartmentid->fetch(PDO::FETCH_OBJ);
			return $row->department_id;
		}
		return false;
	}


	public function signUp($name,$email,$password){
		$userRole;
		$password = md5(sha1($password));
		$emailParts = explode('@', strtolower($email));

		$userUsername = $emailParts[0];
		$userFaculty = 0;
		$userDepartment = 0;


		if ($emailParts[1] == 'bozok.edu.tr' || $emailParts[1] == 'yobu.edu.tr') {
			$insertuser = $this->db->prepare("INSERT INTO academicians SET 
				academician_fullname = ?,
				academician_username = ? ,
				academician_email = ?,
				academician_password = ?,
				faculty_id = ?,
				department_id = ?,
				academician_status = ?
				");

				$insertuser->execute(array(
					$name,
					$userUsername,
					$email,
					$password,
					$userFaculty,
					$userDepartment,
					1,
				));

				if ($insertuser) {
					return true;
				}
				return false;


		}else if($emailParts[1] == 'student' ) {
			$facultyCode = substr($userUsername, 0,4);
			$departmentCode = substr($userUsername, 4,-4);

			if(($this->getFacultyId($facultyCode) != false) && ($this->getDepartmentId($facultyCode,$departmentCode) != false)){
				$userFaculty = $this->getFacultyId($facultyCode);
				$userDepartment = $this->getDepartmentId($facultyCode,$departmentCode);
			}

			$insertuser = $this->db->prepare("INSERT INTO students SET 
			student_fullname = ?,
			student_username = ? ,
			student_email = ?,
			student_password = ?,
			faculty_id = ?,
			department_id = ?,
			student_status = ?
			");

			$insertuser->execute(array(
				$name,
				$userUsername,
				$email,
				$password,
				$userFaculty,
				$userDepartment,
				1,
			));

			if ($insertuser) {
				return true;
			}
			return false;
		}


		}


}


?>