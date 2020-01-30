<?php

class AcademicianModel extends Model {


	public function getAcademiciansForSelect(){
		$getAcademicians = $this->db->prepare("SELECT * FROM academicians WHERE academician_status = 2 " );
		$getAcademicians->execute();

		$academicians = $getAcademicians->fetchAll(PDO::FETCH_OBJ);

		return $academicians;
	}

	public function isAcademicianExists($id){
		$id = intval($id);
		$controlacademician = $this->db->prepare("SELECT * FROM academicians WHERE academician_status <> 1 AND academician_id = :i ");
		$controlacademician->bindParam(':i',$id,PDO::PARAM_INT);
		$controlacademician->execute();

		if ($controlacademician->rowCount()) {
			return true;
		}
		return false;
	}

	public function getAcademicians(){

		$getacademicians = $this->db->prepare("SELECT
		 academicians.academician_id ,
		 academicians.academician_fullname,
		 faculties.faculty_name,
		 departments.department_name,
		 academicians.academician_status
		 FROM academicians 
		 INNER JOIN faculties ON academicians.faculty_id = faculties.faculty_id
		 INNER JOIN departments ON academicians.department_id = departments.department_id
		 WHERE academicians.academician_id > 0  
		 ORDER BY academicians.academician_id
		 ");
		$getacademicians->execute();

		$academicians = $getacademicians->fetchAll(PDO::FETCH_OBJ);
		return $academicians;
	}

	public function getAcademiciansByStatus($status){
		$getacademicians = $this->db->prepare("SELECT
		 academicians.academician_id ,
		 academicians.academician_fullname,
		 faculties.faculty_name,
		 departments.department_name,
		 academicians.academician_status
		 FROM academicians 
		 INNER JOIN faculties ON academicians.faculty_id = faculties.faculty_id
		 INNER JOIN departments ON academicians.department_id = departments.department_id
		 WHERE academicians.academician_id > 0 AND academicians.academician_status = :s
		 ORDER BY academicians.academician_id
		 ");

		$getacademicians->execute([':s' => $status]);

		$academicians = $getacademicians->fetchAll(PDO::FETCH_OBJ);
		return $academicians;
	}		

	public function getAcademician($id){
		$getacademician = $this->db->prepare("SELECT
			academicians.academician_id,
			academicians.academician_fullname,
			academicians.faculty_id,
		    academicians.department_id,
		    academicians.academician_status
		    FROM academicians
		    INNER JOIN faculties ON academicians.faculty_id = faculties.faculty_id
		    INNER JOIN departments ON academicians.department_id = departments.department_id
		    WHERE academicians.academician_id > 0 AND academician_id = :id
		 	ORDER BY academicians.academician_id		
			");
		$getacademician->execute([':id' => $id]);

		$academician = $getacademician->fetch(PDO::FETCH_OBJ);

		if ($getacademician->rowCount()) {
			return json_encode($academician);
		}
		return false;
	}

	public function updateAcademician($academicianId,$academicianName,$academicianFaculty,$academicianDepartment,$academicianStatus){
		$updateacademician = $this->db->prepare("UPDATE academicians SET
			academician_fullname = :n,
			faculty_id = :f,
			department_id = :d,
			academician_status = :s
			WHERE academician_id = :id
			");
		$updateacademician->execute([
			':n' => $academicianName,
			':f' => $academicianFaculty,
			':d' => $academicianDepartment,
			':s' => $academicianStatus,
			':id' => $academicianId
		]);

		if ($updateacademician) {
			return true;
		}
		return false;
	}

	

}


?>