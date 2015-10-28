<?php
namespace AppBundle\Controller;

use AppBundle\Form\Type\TwitterType;
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
     * @Route("/twitter")
     * @Route("/twitter/")
     * @Route("/twitter/{val}")
     */
    public function indexAction(Request $request, $val = null)
    {
        $twitter = new Twitter();
        $twitter->setTitle('#titel hier');
        $twitter->setPostContent('#twitter bericht hier');
        $form = $this->createForm(new TwitterType(), $twitter, array(
            'action' => "",
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            return $this->forward('AppBundle:Twitter:thankyou', array(
                    'getTitle' => $twitter->getTitle()
                ));
        }

//retrieve data
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Twitter');

        $twitter = $repository->findAll(); // find all


        //parse to twigie, pass $val with twigie
        return $this->render(
            'twitter/twitter.html.twig',
            array('data_twitter' => $twitter,
                'value' => $val,
                'current_year' => date("Y"),
                'twitter_form' => $form->createView(),
            ));
    }
    /**
     * @Route("/thankyou")
     * @Route("/thankyou/")
     */
    public
    function thankyouAction($getTitle)
    {
        return $this->render(
            'twitter/success.html.twig',
            array('getTitle' => $getTitle,
            ));
    }
}
/*
   if (isset($_POST['twitter_insert'])) {


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
   */
//end post alertie


//$product = $repository->find(10); based on primary key
// $product = $repository->find(10);
//$product = $repository->findOneByName($val); // search by column  value. findOneByName (Name -> col name)
