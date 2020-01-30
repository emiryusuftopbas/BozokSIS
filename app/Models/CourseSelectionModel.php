<?php

class CourseSelectionModel extends Model {

	public function getCourseSelectionDates(){
		$get = $this->db->prepare("SELECT 
		course_selection_dates.course_selection_date_id,
		course_selection_dates.course_selection_start_date,
		course_selection_dates.course_selection_end_date,
		course_selection_dates.course_selection_date_status ,
		academic_terms.academic_term
		FROM course_selection_dates
		INNER JOIN academic_terms ON course_selection_dates.academic_term = academic_terms.academic_term_id
		");

		$get->execute();

		$courseSelectionDates = $get->fetchAll(PDO::FETCH_OBJ);

		return $courseSelectionDates;
	}

	public function getCourseSelectionDate($id){
		$get = $this->db->prepare("SELECT
		course_selection_dates.course_selection_date_id,
		course_selection_dates.course_selection_start_date	,
		course_selection_dates.course_selection_end_date ,
		course_selection_dates.course_selection_date_status	,
		academic_terms.academic_term_id
		FROM course_selection_dates
		INNER JOIN academic_terms ON course_selection_dates.academic_term = academic_terms.academic_term_id
		WHERE course_selection_date_id = :id");

		$get->execute([':id' => $id]);

		$row = $get->fetch(PDO::FETCH_OBJ);

		if ($get->rowCount()) {
			return json_encode($row);
		}
		return false;
	}

	public function addCourseSelectionDate($courseSelectionStartDate ,$courseSelectionEndDate, $courseSelectionTerm ){
		$addcourseselectiondate = $this->db->prepare("INSERT INTO course_selection_dates SET
			course_selection_start_date = :s,
			course_selection_end_date = :e,
			course_selection_date_status =  1 ,
			academic_term = :t
		");

		$addcourseselectiondate->execute([
			':s' => $courseSelectionStartDate,
			':e' => $courseSelectionEndDate,
			':t' => $courseSelectionTerm
		]);

		if ($addcourseselectiondate) {
			return true;
		}
		return false;
	}

	public function updateCourseSelectionDate($courseSelectionDateId , 
		$courseSelectionStartDate ,
		$courseSelectionEndDate  ,
		$courseSelectionDateStatus ,
		$courseSelectionDateTerm 
	){
		$updatecourseselectiondate = $this->db->prepare("UPDATE course_selection_dates SET
			course_selection_start_date = :s,
			course_selection_end_date = :e,
			course_selection_date_status = :st,
			academic_term = :t
			WHERE course_selection_date_id = :id
		");
		$updatecourseselectiondate->execute([
		 ':s' => $courseSelectionStartDate,
		 ':e' => $courseSelectionEndDate,
		 ':st' => $courseSelectionDateStatus,
		 ':t' => $courseSelectionDateTerm,
		 ':id' => $courseSelectionDateId
		]);

		if ($updatecourseselectiondate) {
			return true;
		}
		return false;
	}

	public function getCourseSelectionDateMod($modifier){
		
		$get = $this->db->prepare("SELECT * FROM course_selection_dates 
			WHERE course_selection_date_status = 2");
		$get->execute();
		$row = $get->fetch(PDO::FETCH_OBJ);
		if ($modifier == 'start') {
			return $row->course_selection_start_date;
		}else if($modifier == 'end'){
			return $row->course_selection_end_date;
		}
		return false;
	}


	function isCourseSelectionDay(){
			$firstDate = self::getCourseSelectionDateMod('start');
			$secondDate = self::getCourseSelectionDateMod('end'); 
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