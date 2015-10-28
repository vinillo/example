<?php
namespace AppBundle\Controller;
use AppBundle\Form\Type\RegisterType;
use AppBundle\Form\Type\LoginType;
use AppBundle\Form\Type\TwitterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Product;
use AppBundle\Entity\Register;
use AppBundle\Entity\Login;
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
                'getTitle' => $twitter->getTitle(),
                'getPostContent' => $twitter->getPostContent(),
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
    function thankyouAction($getTitle, $getPostContent)
    {
        $twitter = new twitter();
        $twitter->setPostContent($getPostContent);
        $twitter->setTitle($getTitle);
        $twitter->setCreated(time());
        $twitter->setLastEdit($getTitle);
        $em = $this->getDoctrine()->getManager();
        $em->persist($twitter);
        $em->flush();
        return $this->render(
            'twitter/success.html.twig',
            array('getTitle' => $getTitle,
                'getPostContent' => $getPostContent,
                'current_year' => date("Y"),
            ));
    }

    /**
     * @Route("/register")
     * @Route("/register/")
     */
    public
    function register(Request $request)
    {
        $register = new Register();
        $register->setUsername('username');
        $register->setPassword('password');
        $register->setEmail('vincent.provo@tactics.be');
        $form = $this->createForm(new RegisterType(), $register, array(
            'action' => "",
            'method' => 'POST',
        ));
        return $this->render(
            'twitter/register.html.twig',
            array('current_year' => date("Y"),
                'register_form' => $form->createView(),
            ));
    }
    /**
     * @Route("/login")
     * @Route("/login/")
     */
    public
    function login(Request $request)
    {
        $login = new Login();
        $login->setUsername('username');
        $login->setPassword('password');
        $form = $this->createForm(new LoginType(), $login, array(
            'action' => "",
            'method' => 'POST',
        ));
        return $this->render(
            'twitter/login.html.twig',
            array('current_year' => date("Y"),
                  'login_form' => $form->createView(),
            ));
    }
}