<?php
namespace AppBundle\Classy;
class Requesty
{
/*
$r->getGet('foo') // => NULL (foo does not exist)
$r->getGet('foo', 'bla') // => 'bla' (foo does not exist so return default value)
*/

  /*  public function Post($v){
       if(isset($v)){
        return $_POST[$v];
        }
           else {
            return "default_value";
        }
    }
    */
    //without any filtering etcccc 
    public function Get($v){
        if(isset($_GET[$v]) && $_GET[$v] != null){
             return $_GET[$v];}
        else {
            return "default_value";
        }
    }    

}