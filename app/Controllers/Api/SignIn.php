<?php

class SignIn extends Controller {
	
	public  function index(){
		if($_POST){
			$username = @$_POST['username'];
			$password = @$_POST['password'];

			$signInModel = $this->model("SignInModel");

			
			if (!$username || !$password) {
				echo 'empty';
			}else if($signInModel->isUserApproved($username) == false){
				echo 'unapproveduser';	
			}else{
				if ($signInModel->isSignInSuccessful($username,$password)) {
					echo 'success';
				}else{
					echo 'unsuccessful';
				}
			}
		}
	}

}


?>