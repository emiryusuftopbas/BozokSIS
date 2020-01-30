<?php

class AcademicYearModel extends Model {

	public function addAcademicYear($academicYearName,$academicYearStart,$academicYearEnd,$academicYearStatus){
		$addacademicyear = $this->db->prepare("INSERT INTO academic_years SET
			academic_year = :n,
			academic_year_start_date = :s,
			academic_year_end_date = :e,
			academic_year_status = :st
		");

		$addacademicyear->execute([
			':n' => $academicYearName ,
			':s' => $academicYearStart,
			':e' => $academicYearEnd,
			':st' => $academicYearStatus
		]);

		if ($addacademicyear) {
			return true;
		}
		return false;
	}

	public function getAcademicYears(){
		$getacademicyears = $this->db->prepare("SELECT * FROM academic_years");
		$getacademicyears->execute();

		$academicyears = $getacademicyears->fetchAll(PDO::FETCH_OBJ);
		return $academicyears;
	}

	public function getAcademicYear($acedemicYearId){
		$getacademicyear = $this->db->prepare("SELECT * FROM academic_years WHERE academic_year_id = :id");
		$getacademicyear->execute([':id' => $acedemicYearId]);

		$academicYear = $getacademicyear->fetch(PDO::FETCH_OBJ);

		if ($getacademicyear->rowCount()) {
			return json_encode($academicYear);
		}
		return false;
	}

	public function updateAcademicYear($academicYearId,$academicYearName,$academicYearStartDate,$academicYearEndDate,$academicYearStatus){
		$updateacademicyear = $this->db->prepare("UPDATE academic_years SET
			academic_year = :n,
			academic_year_start_date = :s,
			academic_year_end_date = :e,
			academic_year_status = :st
			WHERE academic_year_id = :id
		");

		$updateacademicyear->execute([
			':n' => $academicYearName,
			':s' => $academicYearStartDate,
			':e' => $academicYearEndDate,
			':st' => $academicYearStatus,
			':id' =>$academicYearId
		]);

		if ($updateacademicyear) {
			return true;
		}
		return false;
	}
	public function addAcademicTerm($academicTermName,$academicTermStartDate,$academicTermEndDate,$academicTermYear){
		$addacademicterm = $this->db->prepare("INSERT INTO academic_terms SET 
			academic_term = :n,
			academic_term_start_date = :s,
			academic_term_end_date = :e,
			academic_year = :y
		");

		$addacademicterm->execute([
			':n' => $academicTermName,
			':s' => $academicTermStartDate,
			':e' => $academicTermEndDate,
			':y' => $academicTermYear
		]);

		if ($addacademicterm) {
			return true;
		}
		return false;
	}
	public function getAcademicTerms(){
		$getacademicterms = $this->db->prepare("SELECT 
		academic_terms.academic_term_id,
		academic_terms.academic_term,
		academic_terms.academic_term_start_date ,
		academic_terms.academic_term_end_date ,
		academic_years.academic_year 
		FROM academic_terms 
		INNER JOIN academic_years ON academic_terms.academic_year = academic_years.academic_year_id
		");

		$getacademicterms->execute();
		
		$academicterms = $getacademicterms->fetchAll(PDO::FETCH_OBJ);
		
		return $academicterms;
	}

	public function getAcademicTerm($id){
		$getacademicterm = $this->db->prepare("SELECT 
		academic_terms.academic_term_id,
		academic_terms.academic_term,
		academic_terms.academic_term_start_date ,
		academic_terms.academic_term_end_date ,
		academic_years.academic_year_id
		FROM academic_terms 
		INNER JOIN academic_years ON academic_terms.academic_year = academic_years.academic_year_id
		WHERE academic_term_id = :id
		");

		$getacademicterm->execute([':id' => $id]);

		if ($getacademicterm->rowCount()) {
			$academicterm = $getacademicterm->fetch(PDO::FETCH_OBJ);
			return json_encode($academicterm);
		}
		return false;
	}

	public function updateAcademicTerm(
		$academicTermId ,
 		$academicTermName, 
 		$academicTermStartDate, 
 		$academicTermEndDate,
 		$academicTermYear ){

		$updateacademicterm = $this->db->prepare("UPDATE academic_terms SET
			academic_term = :n,
			academic_term_start_date = :s,
			academic_term_end_date = :e,
			academic_year = :y
			WHERE academic_term_id = :id
		");

		$updateacademicterm->execute([
			':n' => $academicTermName,
			':s' => $academicTermStartDate,
			':e' => $academicTermEndDate,
			':y' => $academicTermYear,
			':id' => $academicTermId
		]);
		if ($updateacademicterm) {
			return true;
		}
		return false;
	}

	public function getActiveAcademicYear(){
		$get = $this->db->prepare("SELECT * FROM academic_years WHERE academic_year_status = 2");
		$get->execute();
		$row =  $get->fetch(PDO::FETCH_OBJ);
		return $row->academic_year_id;
	}

	public function isWeInWhichAcademicTerm(){
		$getacademicterms = $this->db->prepare("SELECT * FROM academic_terms WHERE academic_year = :y ");
		$getacademicterms->execute([':y' => self::getActiveAcademicYear()]);

		$academicTerms = $getacademicterms->fetchAll(PDO::FETCH_OBJ);

		for ($i=0; $i <count($academicTerms) ; $i++) { 

			if (self::isWeInRange($academicTerms[$i]->academic_term_start_date ,$academicTerms[$i]->academic_term_end_date )) {
				return $academicTerms[$i]->academic_term_id;
			}
		}
	}

	public function isWeInRange($firstDate,$secondDate){

		$dateTime = new DateTime();
		$date = $dateTime->format('Y-m-d');    

		$firstDateParts = explode('-', $firstDate);
		$secondDateParts = explode('-', $secondDate);
		$givenDateParts = explode('-', $date);

		$firstDateYear = intval($firstDateParts[0]);
		$firstDateMonth = intval($firstDateParts[1]);
		$firstDateDay = intval($firstDateParts[2]);

		$secondDateYear = intval($secondDateParts[0]);
		$secondDateMonth = intval($secondDateParts[1]);
		$secondDateDay = intval($secondDateParts[2]);

		$givenDateYear = intval($givenDateParts[0]);
		$givenDateMonth = intval($givenDateParts[1]);
		$givenDateDay  = intval($givenDateParts[2]);
		if ($givenDateYear >= $firstDateYear && $givenDateYear <= $secondDateYear) {
				if ($givenDateMonth >= $firstDateMonth && $givenDateMonth <= $secondDateMonth ) {
					if ($givenDateDay >= $firstDateDay && $givenDateDay <= $secondDateDay) {
						return true;
					}
				}
			}
		return false;
	}
}

?>