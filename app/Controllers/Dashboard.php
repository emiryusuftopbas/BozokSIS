<?php

class Dashboard extends Controller {

	public function index(){
		if (@$_SESSION['LOGIN_SESSION']) {

			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	

			$statisticsModel = $this->model('StatisticsModel');

			$statistics = $statisticsModel->getStatistics();

			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'statistics' => $statistics
			];
			
			$this->view('Dashboard',$data);
		
		}
	}
	public function signout(){
		$pathParts = explode('/', SITE_PATH);
		session_destroy();
		ob_clean();
		header("Location:/".$pathParts[1]);
	}

	public function settings(){
		if (@$_SESSION['LOGIN_SESSION']) {

			$userId = $_SESSION['USER_ID'];
			$userFullName = $_SESSION['USER_FULLNAME'];
			$userRole = $_SESSION['USER_ROLE'];	
			
			$data = [
				'userId' => $userId,
				'userFullName' => $userFullName,
				'userRole' => $userRole,
				'page' => 'settings'
				
			];

			$this->view('Dashboard',$data);
	    }
	}

}

?>