<?php

class UserController extends Controller{

    public function login(){
        $user_name = isset($_POST['name']) ? $_POST['name'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        if($this->model->checkUser($user_name, $password)){
            $_SESSION['login_user'] = $user_name;
            //header("Location: /main/admin");
        } else {
            return json_encode(array('Error'));
        }
    }
}