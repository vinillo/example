<?php
namespace AppBundle\Classy;

class Requesty
{
    /*
    $r->getGet('foo') // => NULL (foo does not exist)
    $r->getGet('foo', 'bla') // => 'bla' (foo does not exist so return default value)
    */
    
    private $post;
    private $get;
    
    private function __construct()
    {
    }
    
    public function Post($v, $d = null)
    {
        \Assert\that($v)->string();
        \Assert\that($d)->nullOr()->string();
        return $this->getKeyByValueOrDefault($this->post, $v, $d);
    }
    
    //without any filtering etcccc 
    public function Get($v, $d = null)
    {
        \Assert\that($v)->string();
        \Assert\that($d)->nullOr()->string();
        return $this->getKeyByValueOrDefault($this->get, $v, $d);

    }
    
    public function getKeyByValueOrDefault(array $array, $v, $d = null)
    {
        return (isset($array[$v]) && $array[$v] != null) ? $array[$v] : $d;
    }
    
    public static function createFromGlobals()
    {
        $r       = new self();
        $r->post = $_POST;
        $r->get  = $_GET;
        return $r;
    }
    
}

class Controller 
{
    public function handle(Requesty $r) {

    }
}