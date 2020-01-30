<?php
class AttendanceObj{
	public $attendance_time;
	function __construct($attendance_time)
	{
		$this->attendance_time = $attendance_time;
	}
}

class AttendanceModel extends Model {
	public function getStudentAttendances($studentId){
		$get = $this->db->prepare("SELECT
		lessons.lesson_name,
		attendance.attendance_time
		FROM attendance 
		INNER JOIN lessons ON attendance.attendance_lesson = lessons.lesson_id
		WHERE attendance_student = :s
		");
		$get->execute([':s' => $studentId]);

		$rows = $get->fetchAll(PDO::FETCH_OBJ);

		return $rows;
	}

	public function getStudentAttendancesForAcademicians($studentId,$lessonId){
		$studentId = implode(',', $studentId);

		$attendances = [];

		$getattendances = $this->db->prepare("SELECT * FROM attendance 
			WHERE attendance_student IN ($studentId) AND attendance_lesson = :l
		");

		$getattendances->execute([':l' => $lessonId]);

		$attendancestemp = $getattendances->fetchAll(PDO::FETCH_OBJ);

		for ($i=0; $i <count($attendancestemp) ; $i++) { 
			$attendances[$attendancestemp[$i]->attendance_student] = new AttendanceObj($attendancestemp[$i]->attendance_time);
		}
		return $attendances;
	}

	public function isAttendanceExists($attendanceStudent,$attendanceLesson){
		$control = $this->db->prepare("SELECT * FROM attendance 
			WHERE attendance_student = :s AND attendance_lesson = :l
		");
		$control->execute([':s' => $attendanceStudent , ':l' => $attendanceLesson]);

		if ($control->rowCount()) {
			return true;
		}
		return false;
	}
	public function getAttendanceId($attendanceStudent,$attendanceLesson){
		$control = $this->db->prepare("SELECT * FROM attendance 
			WHERE attendance_student = :s AND attendance_lesson = :l
		");
		$control->execute([':s' => $attendanceStudent , ':l' => $attendanceLesson]);

		if ($control->rowCount()) {
			$row = $control->fetch(PDO::FETCH_OBJ);
			return $row->attendance_id;
		}

		return false;
	}

	public function updateAttendanceStatus($attendanceStudent,$attendanceLesson,$attendanceTime){
		$attendanceId = self::getAttendanceId($attendanceStudent,$attendanceLesson);

		$update = $this->db->prepare("UPDATE attendance SET
			attendance_time = :t
			WHERE attendance_id = :id
		");
		$update->execute([':t' => $attendanceTime , ':id' => $attendanceId]);

		if ($update) {
			return true;
		}
		return false;
	}

	public function addAttendanceStatus($attendanceStudent,$attendanceLesson,$attendanceTime){
		$add = $this->db->prepare("INSERT INTO attendance SET
			attendance_student = :s,
			attendance_lesson = :l,
			attendance_time = :t
		");
		$add->execute([
			':s' => $attendanceStudent,
			':l' => $attendanceLesson,
			':t' => $attendanceTime
		]);

		if ($add) {
			return true;
		}
		return false;
	}

}

?>