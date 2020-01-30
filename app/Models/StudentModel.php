<?php

class StudentModel extends Model {

	public function getStudents(){
		$getstudents = $this->db->prepare("SELECT
			students.student_id,
			students.student_fullname,
			students.student_year,
			faculties.faculty_name,
		    departments.department_name,
		    students.student_status
		    FROM students
		    INNER JOIN faculties ON students.faculty_id = faculties.faculty_id
		    INNER JOIN departments ON students.department_id = departments.department_id
		 	ORDER BY students.student_id		
			");
		$getstudents->execute();

		$students = $getstudents->fetchAll(PDO::FETCH_OBJ);

		return $students;
	}

	public function getStudentsByStatus($status){
		$getstudents = $this->db->prepare("SELECT
		 students.student_id ,
		 students.student_fullname,
		 students.student_year,
		 faculties.faculty_name,
		 departments.department_name,
		 students.student_status
		 FROM students 
		 INNER JOIN faculties ON students.faculty_id = faculties.faculty_id
		 INNER JOIN departments ON students.department_id = departments.department_id
		 WHERE students.student_status = :s
		 ORDER BY students.student_id
		 ");

		$getstudents->execute([':s' => $status]);

		$students = $getstudents->fetchAll(PDO::FETCH_OBJ);
		return $students;

	}

	public function getStudent($id){
		$getstudent = $this->db->prepare("SELECT
			students.student_id,
			students.student_fullname,
			students.student_year,
			students.faculty_id,
		    students.department_id,
		    students.student_status
		    FROM students
		    INNER JOIN faculties ON students.faculty_id = faculties.faculty_id
		    INNER JOIN departments ON students.department_id = departments.department_id
		    WHERE  students.student_id = :id
		 	ORDER BY students.student_id		
			");
		$getstudent->execute([':id' => $id]);

		$student = $getstudent->fetch(PDO::FETCH_OBJ);

		if ($getstudent->rowCount()) {
			return json_encode($student);
		}
		return false;
	}

	public function updateStudent($studentId,$studentName,$studentFaculty,$studentDepartment,$studentYear,$studentStatus){
		$updatestudent = $this->db->prepare("UPDATE students SET
			student_fullname = :n,
			faculty_id = :f,
			department_id = :d,
			student_year = :y,
			student_status = :s
			WHERE student_id = :id
			");
		$updatestudent->execute([
			':n' => $studentName,
			':f' => $studentFaculty,
			':d' => $studentDepartment,
			':y' => $studentYear,
			':s' => $studentStatus,
			':id' => $studentId
		]);

		if ($updatestudent) {
			return true;
		}
		return false;
	}

	public function getStudentFaculty($studentId){
		$get = $this->db->prepare("SELECT faculty_id FROM students WHERE student_id = :id");
		$get->execute([':id' => $studentId]);

		$row = $get->fetch(PDO::FETCH_OBJ);

		return $row->faculty_id;
	}
	public function getStudentDepartment($studentId){
		$get = $this->db->prepare("SELECT department_id FROM students WHERE student_id = :id");
		$get->execute([':id' => $studentId]);

		$row = $get->fetch(PDO::FETCH_OBJ);

		return $row->department_id;
	}
	public function getStudentYear($studentId){
		$get = $this->db->prepare("SELECT student_year FROM students WHERE student_id = :id");
		$get->execute([':id' => $studentId ]);

		$row = $get->fetch(PDO::FETCH_OBJ);

		return $row->student_year;
	}

	public function getStudentsIn($studentId){
		$studentId = implode(',', $studentId);
		$getstudents = $this->db->prepare("SELECT
			students.student_id,
			students.student_fullname,
			students.student_username,
		    students.student_status
		    FROM students
			WHERE student_id IN ($studentId)		
			");
		$getstudents->execute();

		$students = $getstudents->fetchAll(PDO::FETCH_OBJ);

		return $students;
	}
}

?>