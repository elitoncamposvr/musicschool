<?php
class StudentsClasses extends model
{

    public function getList($offset, $school_id)
    {
        $array = array();

        $sql = $this->db->prepare("
            SELECT 
                students_classes.*,
                schools.school_name as school_name,
                series.series_name as series_name,
                series.id as series_id
            FROM 
                students_classes
            LEFT JOIN
                schools ON students_classes.school_id = schools.id
            LEFT JOIN
                series ON students_classes.series_id = series.id
            WHERE 
                students_classes.school_id = :school_id 
            ORDER BY 
                students_classes.name_class_students ASC 
                LIMIT $offset, 15"
    );
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

        $sql = $this->db->prepare("SELECT * FROM students_classes WHERE school_id = :school_id ORDER BY name_class_students ASC");
        $sql->bindValue(":school_id", $school_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getListPilotsRegistrations($tourney_registration, $school_id)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM pilots WHERE  tourney_registration LIKE '%$tourney_registration%'");
        $sql->bindValue(":tourney_registration", $tourney_registration);
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
                students_classes.*,
                series.series_name AS series_name
            FROM 
                students_classes
            LEFT JOIN
                series ON students_classes.series_id = series.id 
            WHERE 
                students_classes.id = :id AND students_classes.school_id = :school_id");
        $sql->bindValue(":id", $id);
        $sql->bindValue("school_id", $school_id);
        $sql->execute();

        if($sql->rowCount() > 0 ){
			$array = $sql->fetch();
		}

        return $array;
    }

    public function getCount($school_id)
    {
        $r = 0;

        $sql = $this->db->prepare("SELECT COUNT(*) as pd FROM students_classes WHERE school_id = :school_id");
        $sql->bindValue('school_id', $school_id);
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['pd'];



        return $r;
    }

    public function create($name_class_students, $series_id, $school_id)
    {

        $sql = $this->db->prepare("INSERT INTO students_classes SET name_class_students = :name_class_students, series_id = :series_id, school_id = :school_id");

        $sql->bindValue(":name_class_students", $name_class_students);
        $sql->bindValue(":series_id", $series_id);
        $sql->bindValue(":school_id", $school_id);
        $sql->execute();
    }


    public function update($id, $school_id, $name_class_students, $series_id)
    {
        $sql = $this->db->prepare("UPDATE students_classes SET name_class_students = :name_class_students, series_id = :series_id WHERE id = :id AND school_id = :school_id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":school_id", $school_id);
        $sql->bindValue(":name_class_students", $name_class_students);
        $sql->bindValue(":series_id", $series_id);
        $sql->execute();
    }

    public function destroy($id, $school_id)
    {
        $sql = $this->db->prepare("DELETE FROM students_classes WHERE id = :id AND school_id = :school_id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(':school_id', $school_id);
        $sql->execute();
    }

    public function studentsOnClass($id, $school_id){

		$sql = $this->db->prepare("UPDATE pilots SET tourney_registration = :tourney_registration WHERE id = :id AND school_id = :school_id");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":school_id", $school_id);
		$sql->execute();
	}

    public function searchClasses($sp, $school_id)
    {
        $array = array();

        $sql = $this->db->prepare("
            SELECT 
                students_classes.*,
                schools.school_name
            FROM 
                students_classes
            LEFT JOIN
                schools ON students_classes.school_id = schools.id
            WHERE 
                students_classes.name_class_students 
            LIKE 
                '%$sp%' 
            ORDER BY 
                students_classes.name_class_students 
            ASC
            ");
        $sql->bindValue(":name_class_students", $sp . '%');
        $sql->bindValue(":school_id", $school_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

}
