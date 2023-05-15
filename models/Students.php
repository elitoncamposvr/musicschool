<?php
class Students extends model
{

	public function getList($offset, $school_id)
	{
		$array = array();

		$sql = $this->db->prepare("
			SELECT 
				students.*,
				students_classes.name_class_students as class_name,
				schools.school_name as school_name,
				series.series_name as series_name
			FROM 
				students 
			LEFT JOIN
				students_classes ON students.student_class_id = students_classes.id
			LEFT JOIN
				series ON students.series_id = series.id
			LEFT JOIN
				schools ON students.school_id = schools.id
			WHERE
				students.school_id = :school_id 
			ORDER BY
				series.series_name ASC,
				students_classes.name_class_students ASC,
				students.student_name ASC

			LIMIT $offset, 15");
		$sql->bindValue(":school_id", $school_id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getListSeries($id, $school_id)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT series_id FROM students WHERE id = :id AND school_id = :school_id");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":school_id", $school_id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$r = $sql->fetch();
		}

		$serie_id = $r['series_id'];

		$sql = $this->db->prepare("SELECT * FROM students_classes WHERE series_id = '$serie_id' AND school_id = :school_id");
		$sql->bindValue(":school_id", $school_id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getListEvaluations($offset, $school_id)
	{
		$array = array();

		$sql = $this->db->prepare("
			SELECT 
				students.*,
				students_classes.name_class_students as class_name,
				schools.school_name,
				series.series_name as series_name
			FROM 
				students 
			LEFT JOIN
				students_classes ON students.student_class_id = students_classes.id
			LEFT JOIN
				schools ON students.school_id = schools.id
			LEFT JOIN
				series ON students.series_id = series.id
			WHERE
				students.school_id = :school_id 
			AND
				students.evaluation_stage >= 1
			LIMIT $offset, 15");
		$sql->bindValue(":school_id", $school_id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getListAll($school_id)
	{
		$array = array();

		$sql = $this->db->prepare("
				SELECT 
					students.*,
					students_classes.name_class_students as class_name
				FROM 
					students 
				LEFT JOIN
					students_classes ON students.student_class_id = students_classes.id
				WHERE
					students.school_id = :school_id
			");
		$sql->bindValue(":school_id", $school_id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getListStudentsClass($student_class_id, $school_id)
	{
		$array = array();

		$sql = $this->db->prepare("
				SELECT 
					students.*,
					students_classes.name_class_students as class_name,
					schools.school_name as school_name,
					series.series_name as series_name
				FROM 
					students 
				LEFT JOIN
					students_classes ON students.student_class_id = students_classes.id
				LEFT JOIN
					schools ON students.school_id = schools.id
				LEFT JOIN
					series ON students.series_id = series.id
				WHERE
					students.school_id = :school_id AND
				students.student_class_id = :student_class_id
			");
		$sql->bindValue(":student_class_id", $student_class_id);
		$sql->bindValue(":school_id", $school_id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}


	public function getInfo($id, $school_id)
	{
		$array = array();

		$sql = $this->db->prepare("
		SELECT 
			students.*,
			series.series_name AS series_name
		FROM 
			students 
		LEFT JOIN
			series ON students.series_id = series.id
		WHERE 
			students.id = :id AND students.school_id = :school_id");
		$sql->bindValue(":id", $id);
		$sql->bindValue("school_id", $school_id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getCount()
	{
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM students");
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];



		return $r;
	}

	public function create($school_id, $student_name, $series_id)
	{

		$sql = $this->db->prepare("INSERT INTO  students SET school_id = :school_id, student_name = :student_name, series_id = :series_id");
		$sql->bindValue(":school_id", $school_id);
		$sql->bindValue(":student_name", $student_name);
		$sql->bindValue(":series_id", $series_id);
		$sql->execute();

		$student_id =  $this->db->lastInsertId();
		header("Location: " . BASE_URL . "students/selectclasses/" . $student_id);
	}

	public function updateClasses($id, $school_id, $student_class_id)
	{

		$sql = $this->db->prepare("UPDATE students SET student_class_id = :student_class_id WHERE id = :id AND school_id = :school_id");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":school_id", $school_id);
		$sql->bindValue(":student_class_id", $student_class_id);
		$sql->execute();
	}

	public function update($id, $school_id, $student_name, $series_id)
	{

		$sql = $this->db->prepare("UPDATE students SET student_name = :student_name, series_id = :series_id WHERE id = :id AND school_id = :school_id");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":school_id", $school_id);
		$sql->bindValue(":student_name", $student_name);
		$sql->bindValue(":series_id", $series_id);
		$sql->execute();

		header("Location: " . BASE_URL . "students/selectclasses/" . $id);
	}

	public function searchStudent($sp, $school_id)
	{
		$array = array();

		$sql = $this->db->prepare("
			SELECT 
				students.*,
				schools.school_name,
				students_classes.name_class_students,
				series.series_name as series_name
			FROM 
				students 
			LEFT JOIN
				schools ON students.school_id = schools.id
			LEFT JOIN
				students_classes ON students.student_class_id = students_classes.id
			LEFT JOIN
				series ON students.series_id = series.id
			WHERE 
				students.student_name 
			LIKE 
				'%$sp%' 
			AND 
				students.school_id = '$school_id' 
			ORDER BY 
				students.student_name 
			ASC");
		$sql->bindValue(":student_name", $sp);
		$sql->bindValue(":school_id", $school_id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		return $array;
	}

	public function answers($student_id, $school_id, $stage, $student_class, $series_id, $answers_list)
	{
		$answers = implode(',', $answers_list);

		$sql = $this->db->prepare("INSERT INTO students_answers SET student_id = :student_id, school_id = :school_id, stage = :stage, student_class = :student_class, series_id = :series_id, answers = :answers");
		$sql->bindValue(":student_id", $student_id);
		$sql->bindValue(":school_id", $school_id);
		$sql->bindValue(":stage", $stage);
		$sql->bindValue(":student_class", $student_class);
		$sql->bindValue(":series_id", $series_id);
		$sql->bindValue(":answers", $answers);
		$sql->execute();

		$sql = $this->db->prepare("UPDATE students SET evaluation_stage = '$stage' WHERE id = '$student_id'");
		$sql->bindValue(":evaluation_stage", $stage);
		$sql->bindValue(":id", $student_id);
		$sql->execute();
	}

	public function destroy($id, $school_id)
	{
		$sql = $this->db->prepare("DELETE FROM students WHERE id = :id AND school_id = :school_id");
		$sql->bindValue(":id", $id);
		$sql->bindValue(':school_id', $school_id);
		$sql->execute();
	}
}
