<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Product;

class TwitterController extends Controller
{
    /**
     * @Route("/twitter")
     */
    public function indexAction()
    {
        $product = new product();
        $product->setName('bobie')
            ->setPrice("10")
            ->setDescription("description hier");

    $em = $this->getDoctrine()->getManager();
    $em->persist($product);
    $em->flush();
     

    }
}