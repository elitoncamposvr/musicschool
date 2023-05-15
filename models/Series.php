<?php
class Series extends model
{

    public function getList($offset, $school_id)
    {
        $array = array();

        $sql = $this->db->prepare("
        SELECT 
            series.*,
            schools.school_name as school_name
        FROM 
            series
        LEFT JOIN
            schools ON series.school_id = schools.id 
        WHERE 
            series.school_id = :school_id 
        ORDER BY 
            series.series_name ASC LIMIT $offset, 10");
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

        $sql = $this->db->prepare("SELECT * FROM series WHERE school_id = :school_id");
        $sql->bindValue(":school_id", $school_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
        
    }

    public function getInfo($id, $school_id){
        $array = array();
    
        $sql = $this->db->prepare("SELECT * FROM series WHERE id = :id AND school_id = :school_id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":school_id", $school_id);
        $sql->execute();
    
        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }
    
        return $array;
    
    }

    public function getCount($school_id){
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM series WHERE school_id = :school_id");
		$sql->bindValue('school_id', $school_id);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];



		return $r;
	}

    public function create($school_id, $series_name)
    {

        $sql = $this->db->prepare("INSERT INTO series SET series_name = :series_name, school_id = :school_id");

        $sql->bindValue(":series_name", $series_name);
        $sql->bindValue(":school_id", $school_id);
        $sql->execute();
    }

    public function update($id, $school_id, $series_name)
    {
        $sql = $this->db->prepare("UPDATE series SET series_name = :series_name WHERE id = :id AND school_id = :school_id");

        $sql->bindValue(":id", $id);
        $sql->bindValue(":series_name", $series_name);
        $sql->bindValue(":school_id", $school_id);
        $sql->execute();
    }


    public function destroy($id, $school_id)
    {
        $sql = $this->db->prepare("DELETE FROM series WHERE id = :id AND school_id = :school_id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":school_id", $school_id);
        $sql->execute();
    }

}
