<?php
class GradeObj{
	public $midterm_grade;
	public $final_grade;
	function __construct($midterm_grade,$final_grade)
	{
		$this->midterm_grade = $midterm_grade;
		$this->final_grade = $final_grade;
	}
}

class GradeModel extends Model {
	public function getGrades($studentId,$studentLesson){
		$studentId = implode(',', $studentId);

		$grades = [];

		$getgrades = $this->db->prepare("SELECT
			grades.grade_id,
			grades.midterm_grade ,
			grades.final_grade,
			grades.grade_student
			FROM grades 
			WHERE grades.grade_student IN ($studentId) AND grades.grade_lesson = :l
		");
		$getgrades->execute([':l' => $studentLesson]);

		$gradestemp = $getgrades->fetchAll(PDO::FETCH_OBJ);

		for ($i=0; $i <count($gradestemp) ; $i++) { 
			$grades[$gradestemp[$i]->grade_student] = new GradeObj($gradestemp[$i]->midterm_grade,$gradestemp[$i]->final_grade);
		}

		return $grades;
	}

	public function isGradeExists($gradeStudent,$gradeGrader,$gradeLesson){
		$control = $this->db->prepare("SELECT * FROM grades 
			WHERE grade_lesson = :l AND grade_student = :s AND grade_grader = :g
		");

		$control->execute([
			':l' => $gradeLesson,
			':s' => $gradeStudent,
			':g' => $gradeGrader
		]);
		if ($control->rowCount()) {
			return true;
		}
		return false;
	}

	public function addGrade($gradeStudent,$gradeGrader,$gradeLesson,$midtermGrade,$finalGrade){
		$addgrade = $this->db->prepare("INSERT INTO grades SET
			grade_lesson = :l,
			grade_student = :s,
			grade_grader = :g,
			midterm_grade = :m,
			final_grade = :f
		");
		$addgrade->execute([
			':l' => $gradeLesson,
			':s' => $gradeStudent,
			':g' => $gradeGrader,
			':m' => $midtermGrade,
			':f' => $finalGrade
		]);
		if ($addgrade) {
			return true;
		}
		return false;
	}

	public function findGradeId($gradeStudent,$gradeGrader,$gradeLesson){
		$control = $this->db->prepare("SELECT * FROM grades 
			WHERE grade_lesson = :l AND grade_student = :s AND grade_grader = :g
		");

		$control->execute([
			':l' => $gradeLesson,
			':s' => $gradeStudent,
			':g' => $gradeGrader
		]);
		if ($control->rowCount()) {
			$row = $control->fetch(PDO::FETCH_OBJ);
			return $row->grade_id;
		}
		return false;
	}

	public function updateGrade($gradeStudent,$gradeGrader,$gradeLesson,$midtermGrade,$finalGrade){
		$gradeId = self::findGradeId($gradeStudent,$gradeGrader,$gradeLesson);



		$updategrade = $this->db->prepare("UPDATE grades SET
			midterm_grade = :m,
			final_grade = :f
			WHERE grade_id = :id
		");
		$updategrade->execute([
			':m' => $midtermGrade,
			':f' => $finalGrade,
			':id' => $gradeId
		]);
		if ($updategrade) {
			return true;
		}
		return false;
	}
}


?>