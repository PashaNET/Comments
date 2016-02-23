<?php

class MainModel extends Model{
    protected $table = 'comments';

    public function getComments($condition = null){
        $data = $this->makeDataArray($_GET);
        return $this->select($this->table, $data, $condition);
    }

    public function addComment(){
        $data = $this->makeDataArray($_POST);
        $data['published_date'] = date('Y-m-d H:i:s');
        return $this->create($this->table, $data);
    }

    public function updateComment(){
        $data = $this->makeDataArray($_POST);
        return $this->update($this->table, $data);
    }

}