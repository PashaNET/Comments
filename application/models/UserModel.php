<?php

class UserModel extends Model {
    protected $table = 'users';

    public function checkUser($user_name, $password){
        if($user_name && $password){
            $conditions = " name = $user_name";
            $user = $this->select($this->table, $conditions);

            if($user[0]['name'] == $user_name && $user[0]['password'] == $password){
                return true;
            }
            //password_verify())
        }
    }
}