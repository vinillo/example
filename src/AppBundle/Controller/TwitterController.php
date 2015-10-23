<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Product;
use AppBundle\Entity\Twitter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Classy\Requesty;


class TwitterController extends Controller
{

      /**
     * @Route("/requesty")
     */
public function requestieAction(){
       $requesty = new requesty(); 
       // /requesty?hello=example
         echo $requesty->Get("hello");
         //echo $requesty->Post("hello");
         exit;

}
    /**
     * @Route("/twitter")
     * @Route("/twitter/") 
     * @Route("/twitter/{val}")
     */
public function indexAction($val=null)
    {

        $msg = null;
//lame insert - for god knows what reason ^^
/*  $product = new product();
            $product->setName('bobie')
            ->setPrice("10")
            ->setDescription("description hier");
    $em = $this->getDoctrine()->getManager();
    $em->persist($product);
    $em->flush();
    */

//post alertie
    $request = new request();
     $form = $this->createFormBuilder()
        // ...
        ->getForm();

            $form->handleRequest($request);

    if ($form->isValid()) {
        // perform some action...

        return $this->redirectToRoute('task_success');
    }

    
    if(isset($_POST['twitter_insert'])) {
                var_dump($request->request->get('twitter_insert', 'twitter_insert'));
        exit;   

            $twitter = new twitter();
            $twitter->setName('bobie')
                    ->setPrice("10")
                    ->setDescription("description hier");
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            echo "inserted row";
            exit;
    }
//end post alertie    
//retrieve data   
  $product = new product(); 
  $repository = $this->getDoctrine()
    ->getRepository('AppBundle:Product');

   //$product = $repository->find(10); based on primary key
  // $product = $repository->find(10);
   //$product = $repository->findOneByName($val); // search by column  value. findOneByName (Name -> col name)
    $product = $repository->findAll($val); // find all


  
//parse to twigie, pass $val with twigie
      return $this->render(
        'twitter/twitter.html.twig',
        array('product' => $product,
            'value' => $val,
            'current_year' => date("Y"),
            'callback_msg' => $msg
        
             )
        );
     

    }
}