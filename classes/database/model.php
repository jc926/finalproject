<?php
namespace database;
abstract class model {

    public function save()
    {
        $modelName=static::$modelName;
        $tableName = $modelName::getTablename();
        $array = get_object_vars($this);

        if ($this->id != '') {
            $sql = $this->update();
        } else {
           $sql = $this->insert();
           $INSERT = TRUE;
        }
        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $array = get_object_vars($this);

        if($INSERT == TRUE) {

            unset($array['id']);

        }

        foreach (array_flip($array) as $key=>$value){
            $statement->bindParam(":$value", $this->$value);
        }
        $statement->execute();
        if($INSERT == TRUE) {

            $this->id = $db->lastInsertId();

        }


        return $this->id;

    }
    private function insert() {


        unset($array['id']);
        print_r($array);
	    $columnString = implode(',', array_flip($array));
	    echo '</br>' . $columnString . '</br>';
        $valueString = ':'.implode(',:', array_flip($array));
	    $sql =  'INSERT INTO '.$tableName.' ('.$columnString.') VALUES ('.$valueString.')';
        return $sql;
    }

    private function update() {
        
        $comma = " ";
        $sql = 'UPDATE '.$tableName.' SET ';
        foreach ($array as $key=>$value){
            if( ! empty($value)) {
                $sql .= $comma . $key . ' = "'. $value .'"';
                $comma = ", ";
            }
        }
        $sql .= ' WHERE id='.$this->id;
        return $sql;

    }
    public function delete() {
        $db = dbConn::getConnection();
        $modelName=static::$modelName;
        $tableName = $modelName::getTablename();
        $sql = 'DELETE FROM '.$tableName.' WHERE id='.$this->id;
        $statement = $db->prepare($sql);
        $statement->execute();
    }
}

?>
