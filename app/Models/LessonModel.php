<?php

class LessonModel extends Model {

	public function getLessons(){
		$getlessons = $this->db->prepare("SELECT
		lessons.lesson_id,
		lessons.lesson_name,
		lessons.lesson_year,
		academic_terms.academic_term,
		lessons.lesson_credit,
		lessons.lesson_time,
		faculties.faculty_name,
		departments.department_name,
		academicians.academician_fullname
		FROM lessons
		INNER JOIN academic_terms ON lessons.lesson_term = academic_terms.academic_term_id
		INNER JOIN faculties ON lessons.lesson_faculty = faculties.faculty_id
		INNER JOIN departments ON lessons.lesson_department = departments.department_id
		INNER JOIN academicians ON lessons.lesson_lecturer = academicians.academician_id
		ORDER BY lessons.lesson_id
		");

		$getlessons->execute();

		$lessons = $getlessons->fetchAll(PDO::FETCH_OBJ);
		return $lessons;
	}

	public function getLesson($lessonId){
		$getlesson = $this->db->prepare("SELECT
		lessons.lesson_id,
		lessons.lesson_name,
		lessons.lesson_year,
		academic_terms.academic_term_id,
		lessons.lesson_credit,
		lessons.lesson_time,
		faculties.faculty_id,
		departments.department_id,
		academicians.academician_id
		FROM lessons
		INNER JOIN academic_terms ON lessons.lesson_term = academic_terms.academic_term_id
		INNER JOIN faculties ON lessons.lesson_faculty = faculties.faculty_id
		INNER JOIN departments ON lessons.lesson_department = departments.department_id
		INNER JOIN academicians ON lessons.lesson_lecturer = academicians.academician_id
		WHERE lesson_id = :id
		");

		$getlesson->execute([':id' => $lessonId]);

		if ($getlesson->rowCount()) {
			$lesson = $getlesson->fetch(PDO::FETCH_OBJ);
			return json_encode($lesson);
		}
		return false;
	}

	public function addLesson(
	    $lessonName,
	    $lessonYear,
	    $lessonTerm,
		$lessonCredit,
		$lessonTime,
		$lessonFaculty ,
		$lessonDepartment , 
		$lessonLecturer ){

		$addlesson = $this->db->prepare("INSERT INTO lessons SET
			lesson_name = :n ,
			lesson_year = :y,
			lesson_term = :tr ,
			lesson_credit = :c ,
			lesson_time = :tm ,
			lesson_faculty = :f,
			lesson_department = :d,
			lesson_lecturer = :l
		");

		$addlesson->execute([
			':n' => $lessonName,
			':y' => $lessonYear,
			':tr'=> $lessonTerm,
			':c' => $lessonCredit,
			':tm'=> $lessonTime,
			':f' => $lessonFaculty,
			':d' => $lessonDepartment,
			':l' => $lessonLecturer
		]);

		if ($addlesson) {
			return true;
		}
		return false;
	}

	public function updateLesson(
		$lessonId ,
		$lessonName ,
		$lessonYear,
		$lessonTerm ,
		$lessonCredit ,
		$lessonTime ,
		$lessonFaculty ,
		$lessonDepartment ,
		$lessonLecturer){

		$updatelesson = $this->db->prepare("UPDATE lessons SET
			lesson_name = :n ,
			lesson_year = :y,
			lesson_term = :tr ,
			lesson_credit = :c ,
			lesson_time = :tm ,
			lesson_faculty = :f,
			lesson_department = :d,
			lesson_lecturer = :l
			WHERE lesson_id = :id
		");

		$updatelesson->execute([
			':n' => $lessonName,
			':y' => $lessonYear,
			':tr' =>$lessonTerm,
			':c' => $lessonCredit,
			':tm' => $lessonTime,
			':f' => $lessonFaculty,
			':d' => $lessonDepartment,
			':l' => $lessonLecturer,
			':id' => $lessonId
		]);

		if ($updatelesson) {
			return true;
		}
		return false;
		
	}

	public function getLessonsForAcademician($academicianId){
		$getlessons = $this->db->prepare("SELECT
		lessons.lesson_id,
		lessons.lesson_name,
		lessons.lesson_year,
		academic_terms.academic_term,
		lessons.lesson_credit,
		lessons.lesson_time,
		faculties.faculty_name,
		departments.department_name,
		academicians.academician_fullname
		FROM lessons
		INNER JOIN academic_terms ON lessons.lesson_term = academic_terms.academic_term_id
		INNER JOIN faculties ON lessons.lesson_faculty = faculties.faculty_id
		INNER JOIN departments ON lessons.lesson_department = departments.department_id
		INNER JOIN academicians ON lessons.lesson_lecturer = academicians.academician_id
		WHERE academicians.academician_id = :id
		ORDER BY lessons.lesson_id
		");

		$getlessons->execute([
			':id' => $academicianId 
		]);

		$lessons = $getlessons->fetchAll(PDO::FETCH_OBJ);
		return $lessons;
	}

	public function getLessonsForSelection($facultyId,$departmentId,$lessonYear){
		$getlessons = $this->db->prepare("SELECT
		lessons.lesson_id, 
		lessons.lesson_name,
		lessons.lesson_credit,
		lessons.lesson_time,
		academicians.academician_fullname 
		FROM lessons 
		INNER JOIN academicians ON lessons.lesson_lecturer = academicians.academician_id
		WHERE
		lessons.lesson_faculty = :f AND
		lessons.lesson_department = :d AND
		lessons.lesson_year = :y
		ORDER BY lessons.lesson_id
		");
		$getlessons->execute([
			':f' => $facultyId,
			':d' => $departmentId,
			':y' => $lessonYear
		]);

		$lessons = $getlessons->fetchAll(PDO::FETCH_OBJ);

		return $lessons;
	}

	public function addSelectedLesson($studentId,$studentLessons,$selectedLessonTerm){
		$selectedLessons = '';
		for ($i=0; $i <count($studentLessons); $i++) { 
			$selectedLessons .= $studentLessons[$i];
			if ($i<count($studentLessons)-1) {
				$selectedLessons .= ',';
			}
		}
		
		$add = $this->db->prepare("INSERT INTO selected_lessons SET
			selected_lesson_student = :s,
			selected_lesson_term = :t,
			selected_lessons = :l
		");

		$add->execute([
			':s' => $studentId,
			':t' => $selectedLessonTerm,
			':l' => $selectedLessons
		]);

		if ($add) {
			return true;
		}
		return false;
	}

	public function isStudentSelectedLessons($studentId,$academicTermId){
		$control = $this->db->prepare("SELECT * FROM selected_lessons
		 WHERE selected_lesson_student = :id AND selected_lesson_term = :t ");
		$control->execute([':id' => $studentId , ':t' => $academicTermId]);

		if ($control->rowCount()) {
			return true;
		}
		return false;
	}

	public function getStudentSelectedLessons($studentId){
		$get = $this->db->prepare("SELECT * FROM selected_lessons WHERE selected_lesson_student = :s ");

		$get->execute([':s' => $studentId]);

		$row = $get->fetch(PDO::FETCH_OBJ);
		if ($get->rowCount()) {
			return $row->selected_lessons;
		}
		
	}

	
	public function getStudentGrades($studentId){
		$gradeLessons = self::getStudentSelectedLessons($studentId);

		$getgrades = $this->db->prepare("SELECT
		grades.grade_id, 
		lessons.lesson_name,
		academicians.academician_fullname,
		grades.midterm_grade,
		grades.final_grade
		 FROM grades
		INNER JOIN students ON grades.grade_student = students.student_id
		INNER JOIN lessons ON grades.grade_lesson = lessons.lesson_id
		INNER JOIN academicians ON grades.grade_grader = academicians.academician_id
		WHERE grades.grade_student = :s AND grades.grade_lesson IN ($gradeLessons)
		");

		$getgrades->execute([':s' => $studentId] );

		$grades = $getgrades->fetchAll(PDO::FETCH_OBJ);

		return $grades;
	}

	public function getStudentsThatTakeLesson($lessonId){
		$get = $this->db->prepare("SELECT
		students.student_id,
		selected_lessons.selected_lessons 
		FROM selected_lessons
		INNER JOIN students ON selected_lessons.selected_lesson_student = students.student_id
		");
		$get->execute();

		$rows = $get->fetchAll(PDO::FETCH_OBJ);

		$studentThatTakeLesson = [];
		for ($i=0; $i <count($rows) ; $i++) { 
			$selectedLessons = explode(',', $rows[$i]->selected_lessons);
			if (in_array($lessonId, $selectedLessons)) {
				array_push($studentThatTakeLesson, $rows[$i]->student_id);
			}
		}

		return $studentThatTakeLesson;
	}

	public function whoGivesThatLesson($lessonId){
		$get = $this->db->prepare("SELECT lesson_lecturer FROM lessons WHERE lesson_id = :id ");

		$get->execute([':id' => $lessonId]);

		$row = $get->fetch(PDO::FETCH_OBJ);

		$academician = $row->lesson_lecturer;
		return $academician;
	}


}

?>