<?php

class Model {
    private $host = "localhost";
    private $db_name = "test";
    private $username = "root";
    private $password = "";

    private function setConnection(){
        return new PDO("mysql:host={$this->host}; dbname={$this->db_name}", $this->username, $this->password);
    }
    
    public function select($table, $data, $condition = null){
        $query = "SELECT * FROM $this->db_name.$table";

        if($condition){
            $query .= " WHERE $condition";
        }
        if(isset($data['order_by'])){
            $query .= ' ORDER BY '. $data['order_by'].' DESC';
        }

        $connection = $this->setConnection();
        $stmt = $connection->query($query);
        $result = array();
        while ($row = $stmt->fetch()){
            array_push($result, $row);
        }
        return $result;
    }

    public function create($table, $data){
        $keys = array_keys($data);
        $values = '';
        $fields = '';

        $iter = new CachingIterator(new ArrayIterator($keys));
        foreach($iter as $value){
            $fields.= "$value";
            $values.= ":$value";
            if($iter->hasNext()){
                $fields.= ",";
                $values.= ",";
            }
        }

        $connection = $this->setConnection();
        $stmt = $connection->prepare("INSERT INTO $this->db_name.$table ($fields) VALUES ($values)");

        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }

        return ($stmt->execute()) ? 'Record was saved' : 'Unable to save record';
    }

    public function update($table, $data){
        $fields = '';
        $iter = new CachingIterator(new ArrayIterator($data));
        foreach($iter as $key=>$value){
            $fields.= "$key=:$key";
            if($iter->hasNext()){
                $fields.= ", ";
            }
        }

        $connection = $this->setConnection();
        $stmt = $connection->prepare("UPDATE $this->db_name.$table SET $fields WHERE email=:email");

        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }

        return ($stmt->execute()) ? 'Record was updated' : 'Unable to updated record';
    }

    protected function makeDataArray($global_array){
        if(!empty($global_array)){
            $data = array();
            foreach($global_array as $key=>$value){
                $data[$key] = $value;
            }
            return $data;
        }
    }
}