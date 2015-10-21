<?php
namespace AppBundle\Classy;
class Requesty
{
    //without any filtering etcccc
    public function getPost($v){
        return $_POST[$v];
    }
    public function getGet($v){
        return $_GET[$v];
    }    

}