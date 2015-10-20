<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class TwitterController extends Controller
{
    /**
     * @Route("/twitter")
     */
    public function indexAction()
    {

       $em = $this->getDoctrine()->getManager(); 
       $repository = $this->getDoctrine()
    ->getRepository('AppBundle:Product');
       $lt_data =  $repository->findAll();
   if (!$lt_data) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }

    return $this->render(
        'twitter/twitter.html.twig',
        array('twitter_data' => json_encode($lt_data))
    );

    }
}