<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;


class TwitterController extends Controller
{
    /**
     * @Route("/twitter/{val}")
     */
    public function indexAction($val)
    {
//lame insert - for god knows what reason ^^
/*  $product = new product();
            $product->setName('bobie')
            ->setPrice("10")
            ->setDescription("description hier");
    $em = $this->getDoctrine()->getManager();
    $em->persist($product);
    $em->flush();
    */
//retrieve data   
  $product = new product(); 
  $repository = $this->getDoctrine()
    ->getRepository('AppBundle:Product');

   //$product = $repository->find(10); based on primary key
   $product = $repository->find(10);
   //$product = $repository->findOneByName($val); // search by column  value. findOneByName (Name -> col name)
   // $product = $repository->findAll($val); // find all


  
//parse to twigie, pass $val with twigie
      return $this->render(
        'twitter/twitter.html.twig',
        array('product' => $product,
            'value' => $val
        
             )
        );
     

    }
}