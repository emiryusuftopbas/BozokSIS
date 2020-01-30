<?php

class SignUp extends Controller {

	public  function index(){
		if ($_POST) {
			$name = strtolower(@$_POST['name']);
			$email = strtolower(@$_POST['email']);
			$password = strtolower(@$_POST['password']);

			$signUpModel = $this->model('SignUpModel');

			if(!$name || !$email || !$password){
				echo 'empty';
			}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				echo 'emailisnotvalid';
			}else if(!$signUpModel->isEmailValid($email)){
				echo 'unsupportedemail';
			}else if($signUpModel->isEmailInUse($email)){
				echo 'usedemail';
			}else {
				$isSignUpSuccessful = $signUpModel->signUp($name,$email,$password);
				if ($isSignUpSuccessful) {
					echo 'success';
				}
			}

		}
	}

}


?>