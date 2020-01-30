<?php
class Faculty {
	public $id;
	public $name;
	public $dean;

}

class FacultyModel extends Model {

	public function getFaculties(){
		$getfaculties = $this->db->prepare("SELECT
		faculties.faculty_name ,
		faculties.faculty_id , 
	    academicians.academician_fullname 
	    FROM faculties 
	    INNER JOIN academicians ON faculties.faculty_dean = academicians.academician_id 
	    WHERE faculties.faculty_id > 0
		ORDER BY faculties.faculty_id
	     ");
		
		$getfaculties->execute();
		$rows = $getfaculties->fetchAll(PDO::FETCH_OBJ);

		return $rows;
	}

	public function addFaculty($facultyCode,$facultyName,$facultyDean){

		 $addfaculty = $this->db->prepare("INSERT INTO faculties SET 
		 	faculty_code = :c ,
		 	faculty_name = :n ,
		 	faculty_dean = :d
		 ");

		 $addfaculty->execute([':c' => $facultyCode , ':n' => $facultyName ,':d' => $facultyDean]);

		 if ($addfaculty) {
		 	return true;
		 }
		 return false;
	}

	public function getFaculty($id){
		$getfaculty = $this->db->prepare("SELECT faculties.faculty_code ,
		 faculties.faculty_name ,
		 faculties.faculty_id ,
		 academicians.academician_fullname ,
		 academicians.academician_id FROM faculties INNER JOIN academicians ON faculties.faculty_dean = academicians.academician_id WHERE faculties.faculty_id > 0 AND faculties.faculty_id = :id ");
		$getfaculty->execute([':id' => $id]);

		if ($getfaculty->rowCount()) {
			$row = $getfaculty->fetch(PDO::FETCH_OBJ);
			return json_encode($row);
		}
		return false;

	}


	public function isFacultyCodeInUse($facultyCode,$facultyId=0){
		$control = $this->db->prepare("SELECT * FROM faculties WHERE faculty_code = :c AND faculty_id <> :id ");
		$control->execute([':c' => $facultyCode, ':id' => $facultyId]);

		if ($control->rowCount()) {
			return true;
		}
		return false;
	}

	public function isFacultyExists($facultyId){
		$control = $this->db->prepare("SELECT * FROM faculties WHERE faculty_id = :id");
		$control->execute([':id' => $facultyId]);

		if ($control->rowCount()) {
			return true;
		}
		return false;

	}

	public function updateFaculty($facultyId , $facultyCode , $facultyName , $facultyDean){
		$updatefaculty = $this->db->prepare("UPDATE faculties SET
			faculty_code = :c,
			faculty_name = :n,
			faculty_dean = :d
			WHERE faculty_id = :id
		");

		$updatefaculty->execute([
			':c' => $facultyCode,
			':n' => $facultyName,
			':d' => $facultyDean,
			':id' => $facultyId
		]);

		if ($updatefaculty) {
			return true;
		}else{
			return false;
		}

	}

}


?>