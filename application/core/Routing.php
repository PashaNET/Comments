<?php

class Routing {
    static function start() {
        $pieces_of_url = explode('/', $_SERVER['REQUEST_URI']);
        $controller_name = (!empty($pieces_of_url[1])) ? $pieces_of_url[1] : 'main';
        $modelName = ucfirst($controller_name) . 'Model';
        $controller_name = ucfirst($controller_name) . 'Controller';
        $action_name = (!empty($pieces_of_url[2])) ? $pieces_of_url[2] : 'index';
        $without_params = strstr($action_name, '?', true); //substr params if exist
        $action_name = $without_params == null ? $action_name : $without_params;

        $file_with_controller_path = 'application/controllers/' . $controller_name . '.php';

        if (file_exists($file_with_controller_path)){
            include $file_with_controller_path;
        } else {
            include 'application/controllers/MainController.php';
            call_user_func(array(new MainController(), 'notFoundPage'), $pieces_of_url);
            return false;
        }


        $model = '';
        $file_with_model_path	= 'application/models/' . $modelName . '.php';

        if (file_exists($file_with_model_path)){
            include $file_with_model_path;
            $model = new $modelName;
        }

        $controller = new $controller_name;
        $controller->model = $model;

        if (method_exists($controller, $action_name)){
            call_user_func(array($controller, $action_name), $pieces_of_url);
        } else {
            call_user_func(array($controller, 'notFoundPage'), $pieces_of_url);
        }
    }
}