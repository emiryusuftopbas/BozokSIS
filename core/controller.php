<?php



class Controller {

	public function view($name , $data = []){
		extract($data);
		require realpath('.').'/app/views/'.strtolower($name).'.php';
	}

	public function model($name){
		require realpath('.').'/app/models/'.strtolower($name).'.php';
		return new $name();
	}

}

?>