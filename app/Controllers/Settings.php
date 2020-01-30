<?php 

class Settings extends Controller {

	public function changepassword(){
		if ($_POST) {
			$userId = $_POST['userid'];
			$userRole = $_POST['userrole'];
			$currentPassword = $_POST['currentpassword'];
			$newPassword = $_POST['newpassword'];

			$settingsModel = $this->model('SettingsModel');
				
			
			if (!$userId || !$userRole || !$currentPassword || !$newPassword ) {
				echo 'empty';
			}else if (!$settingsModel->isCurrentPasswordCorrect($userRole,$userId,$currentPassword)) {
				echo 'passworderror';
			}else{
				$isUpdateSuccessful = $settingsModel->updatePassword($userRole,$userId,$currentPassword,$newPassword);
				if ($isUpdateSuccessful) {
					echo 'success';
				}
			}
		
		}
	}

}

?>