<?php

class ImageController extends Controller {

    function upload(){
        $uploaddir = $_SERVER['DOCUMENT_ROOT']."/assets/images/";

        foreach( $_FILES as $file ){
            if(move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name']))){
                echo $file['name'];
            } else {
                echo 'Error!';
            }
        }
    }

    function croppedImage(){

    }

}