<?php

class MainController extends Controller {

    public function index(){
        $data = $this->model->getComments('is_published = 1');
        $this->view->generate('main.php', 'template.php', $data);
    }

    public function admin(){
        $data = $this->model->getComments();
        $this->view->generate('admin.php', 'template.php', $data);
    }

    public function notFoundPage(){
        $this->view->generate('404.php', 'template.php');
    }

    public function addComment(){
        if($this->model->addComment()){
            return json_encode(array('status' => 'success'));
        }
    }

    public function updateComment(){
        if($this->model->updateComment()){
            return json_encode(array('status' => 'success'));
        }
    }

}