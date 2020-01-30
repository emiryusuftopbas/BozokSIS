<?php

class SignInModel extends Model{

	public function isSignInSuccessful($username , $password){
		$password = md5(sha1($password));

		$studentsignin = $this->db->prepare("SELECT * FROM students WHERE student_username = :u AND student_password = :p AND student_status = 2");
		$studentsignin->execute([':u' => $username , ':p' => $password]);


		$academiciansignin = $this->db->prepare("SELECT * FROM academicians WHERE academician_username= :u AND academician_password = :p AND academician_status = 2 ");
		$academiciansignin->execute([':u' => $username , ':p' => $password]);


		$adminsignin = $this->db->prepare("SELECT * FROM admins WHERE admin_username = :u AND admin_password = :p AND admin_status = 2 ");
		$adminsignin->execute([':u' => $username , ':p' => $password]);


		if ($studentsignin->rowCount()) {
			$row = $studentsignin->fetch(PDO::FETCH_OBJ);
			$_SESSION['LOGIN_SESSION'] = true;
			$_SESSION['USER_ID'] = $row->student_id;
			$_SESSION['USER_FULLNAME'] = $row->student_fullname;
			$_SESSION['USER_ROLE'] = 'student';
			return true;
		}else if ($academiciansignin->rowCount()) {
			$row = $academiciansignin->fetch(PDO::FETCH_OBJ);
			$_SESSION['LOGIN_SESSION'] = true;
			$_SESSION['USER_ID'] = $row->academician_id;
			$_SESSION['USER_FULLNAME'] = $row->academician_fullname;
			$_SESSION['USER_ROLE'] = 'academician';
			return true;
		}else if($adminsignin->rowCount()){
			$row = $adminsignin->fetch(PDO::FETCH_OBJ);
			$_SESSION['LOGIN_SESSION'] = true;
			$_SESSION['USER_ID'] = $row->admin_id;
			$_SESSION['USER_FULLNAME'] = $row->admin_fullname;
			$_SESSION['USER_ROLE'] = 'admin';
			return true;
		}

		return false;
	}

	public function isUserApproved($username){
		$studentcontrol = $this->db->prepare("SELECT * FROM students WHERE student_username = :u AND student_status = 2");
		$studentcontrol->execute([':u' => $username]);

		$academiciancontrol = $this->db->prepare("SELECT * FROM academicians WHERE academician_username = :u AND academician_status = 2");
		$academiciancontrol->execute([':u' => $username]);

		$admincontrol = $this->db->prepare("SELECT * FROM admins WHERE admin_username = :u AND admin_status = 2");
		$admincontrol->execute([':u' => $username]); 

		if ($studentcontrol->rowCount() || $academiciancontrol->rowCount() || $admincontrol->rowCount()) {
			return true;
		}
		return false;
	}
}


?>