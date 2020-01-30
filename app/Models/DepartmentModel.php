<?php

class DepartmentModel extends Model {

	public function getDepartments(){
		$getdepartments = $this->db->prepare("SELECT 
			departments.department_id,
			departments.department_code,
			departments.department_name,
			faculties.faculty_name, 
			academicians.academician_fullname 
			FROM departments 
		INNER JOIN faculties ON departments.faculty_id = faculties.faculty_id
		INNER JOIN academicians ON departments.department_head = academicians.academician_id 
		WHERE departments.department_id >0
		ORDER BY department_id 
	 ");

		$getdepartments->execute();

		$rows = $getdepartments->fetchAll(PDO::FETCH_OBJ);

		return $rows;
	}

	public function getDepartment($id){
		$getfaculty = $this->db->prepare("SELECT 
		  departments.department_id ,
		  faculties.faculty_id,
		  academicians.academician_id, 	
		  departments.department_code ,
		  departments.department_name , 
		  faculties.faculty_name , 
		  academicians.academician_fullname 
		  FROM departments 
		  INNER JOIN faculties ON departments.faculty_id = faculties.faculty_id
		  INNER JOIN academicians ON departments.department_head = academicians.academician_id
		  WHERE departments.department_id >0 AND departments.department_id = :id
		  ORDER BY department_id
		");

		$getfaculty->execute([':id' => $id]);

		$faculty = $getfaculty->fetch(PDO::FETCH_OBJ);

		if ($getfaculty->rowCount()) {
			return json_encode($faculty);
		}
		return false;
	}

	public function isDepartmentCodeInUse($departmentCode,$facultyId,$departmentId =0){
		$control = $this->db->prepare("SELECT * FROM departments WHERE department_code = :c AND faculty_id =:id AND department_id <> :di ");
		$control->execute([':c' => $departmentCode,':id' => $facultyId, ':di' => $departmentId]);

		if ($control->rowCount()) {
			return true;
		}
		return false;
	}
	public function isDepartmentExists($departmentId){
		$control = $this->db->prepare("SELECT * FROM departments WHERE department_id = :id");
		$control->execute([':id' => $departmentId]);

		if ($control->rowCount()) {
			return true;
		}
		return false;
	}

	public function addDepartment($departmentCode,$departmentName,$departmentFaculty,$departmentHead){
		$adddepartment = $this->db->prepare("INSERT INTO departments SET 
			department_code = :c,
			department_name = :n,
			faculty_id = :f,
			department_head = :h
		");

		$adddepartment->execute([
			':c' => $departmentCode,
			':n' => $departmentName,
			':f' => $departmentFaculty,
			':h' => $departmentHead	
		]);

		if ($adddepartment) {
			return true;
		}
		return false;	
	}

	public function updateDepartment($departmentId,$departmentCode,$departmentName,$departmentFaculty,$departmentHead){

		$updatedepartment = $this->db->prepare("UPDATE departments SET
			department_code = :c,
			department_name = :n,
			faculty_id = :i,
			department_head = :h
			WHERE department_id = :di
		");
		$updatedepartment->execute([
			':c' => $departmentCode,
			':n' => $departmentName,
			':i' => $departmentFaculty,
			':h' => $departmentHead,
			':di' => $departmentId
		]);
		
		if ($updatedepartment) {
			return true;
		}
		return false;
	}



}


?>