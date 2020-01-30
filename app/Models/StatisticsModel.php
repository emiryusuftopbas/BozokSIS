<?php

class StatisticsModel extends Model{

	public function getNumberOfFaculties(){
		$query = $this->db->prepare("SELECT * FROM faculties;");
		$query->execute();

		return $query->rowCount();
	}

	public function getNumberOfDepartments(){
		$query = $this->db->prepare("SELECT * FROM departments;");
		$query->execute();

		return $query->rowCount();
	}

	public function getNumberOfLessons(){
		$query = $this->db->prepare("SELECT * FROM lessons");
		$query->execute();

		return $query->rowCount();
	}
	public function getNumberOfStudents(){
		$query = $this->db->prepare("SELECT * FROM students ");
		$query->execute();

		return $query->rowCount();
	}

	public function getNumberOfAcademicians(){
		$query = $this->db->prepare("SELECT * FROM academicians ");
		$query->execute();

		return $query->rowCount();
	}

	public function getStatistics(){
		$numberOfFaculties = self::getNumberOfFaculties();
		$numberOfDepartments = self::getNumberOfDepartments();
		$numberOfLessons = self::getNumberOfLessons();
		$numberOfStudents = self::getNumberOfStudents();
		$numberOfAcademicians = self::getNumberOfAcademicians();

		$data = [
			"numberOfFaculties" => $numberOfFaculties,
			"numberOfDepartments" => $numberOfDepartments,
			"numberOfLessons" => $numberOfLessons,
			"numberOfStudents" => $numberOfStudents,
			"numberOfAcademicians" => $numberOfAcademicians
		];
		return $data;
	}

}


?>