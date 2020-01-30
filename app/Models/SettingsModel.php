<?php 

class SettingsModel extends Model {

	public function isCurrentPasswordCorrect($userRole,$userId,$currentPassword){
	
		$controlstudent = $this->db->prepare("SELECT * FROM students WHERE student_id = :i AND student_password = :p");

		$controlstudent->execute([
			':i' => $userId,
			':p'=> md5(sha1($currentPassword))
		]);

		$controlacademician = $this->db->prepare("SELECT * FROM academicians WHERE academician_id = :i AND academician_password	= :p");

		$controlacademician->execute([
			':i' => $userId,
			':p'=> md5(sha1($currentPassword))
		]);

		$controladmin = $this->db->prepare("SELECT * FROM admins WHERE admin_id = :i AND admin_password = :p");

		$controladmin->execute([
			':i' => $userId,
			':p'=> md5(sha1($currentPassword))
		]);

		if ($controlstudent->rowCount() || $controlacademician->rowCount() || $controladmin->rowCount() ) {
			return true;
		}
		return false;
	}

	public function updatePassword($userRole,$userId,$currentPassword,$newPassword){
		if ($userRole == 'student') {
			$update = $this->db->prepare("UPDATE students SET
				student_password = :p
				WHERE student_id = :i
			"); 
			$update->execute([':p' => md5(sha1($newPassword)) , ':i' => $userId]);
			if ($update) {
				return true;
			}
		}else if ($userRole == 'academician') {
			$update = $this->db->prepare("UPDATE academicians SET
				academician_password = :p
				WHERE academician_id = :i
			"); 
			$update->execute([':p' => md5(sha1($newPassword)) , ':i' => $userId]);
			if ($update) {
				return true;
			}
		}else if ($userRole == 'admin') {
			$update = $this->db->prepare("UPDATE admins SET
				admin_password = :p
				WHERE admin_id = :i
			"); 
			$update->execute([':p' => md5(sha1($newPassword)) , ':i' => $userId]);
			if ($update) {
				return true;
			}
		}
	}
}

?>